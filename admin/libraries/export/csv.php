<?php

/* $Id: csv.php,v 2.7 2004/04/14 13:48:41 nijel Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:

/**
 * Set of functions used to build CSV dumps of tables
 * @param mixed $text
 */

/**
 * Outputs comment
 *
 * @param  string  $text      Text of comment
 *
 * @return  bool        Whether it suceeded
 */
function PMA_exportComment($text)
{
    return true;
}

/**
 * Outputs export footer
 *
 * @return  bool        Whether it suceeded
 */
function PMA_exportFooter()
{
    return true;
}

/**
 * Outputs export header
 *
 * @return  bool        Whether it suceeded
 */
function PMA_exportHeader()
{
    global $what;

    global $add_character;

    global $separator;

    global $enclosed;

    global $escaped;

    // Here we just prepare some values for export

    if ('excel' == $what) {
        $add_character = "\015\012";

        $separator = isset($GLOBALS['excel_edition']) && 'mac' == $GLOBALS['excel_edition'] ? ';' : ',';

        $enclosed = '"';

        $escaped = '"';

        if (isset($GLOBALS['showexcelnames']) && 'yes' == $GLOBALS['showexcelnames']) {
            $GLOBALS['showcsvnames'] = 'yes';
        }
    } else {
        if (empty($add_character)) {
            $add_character = $GLOBALS['crlf'];
        } else {
            $add_character = str_replace('\\r', "\015", $add_character);

            $add_character = str_replace('\\n', "\012", $add_character);

            $add_character = str_replace('\\t', "\011", $add_character);
        } // end if

        $separator = str_replace('\\t', "\011", $separator);
    }

    return true;
}

/**
 * Outputs database header
 *
 * @param mixed $db
 *
 * @return  bool        Whether it suceeded
 */
function PMA_exportDBHeader($db)
{
    return true;
}

/**
 * Outputs database footer
 *
 * @param mixed $db
 *
 * @return  bool        Whether it suceeded
 */
function PMA_exportDBFooter($db)
{
    return true;
}

/**
 * Outputs create database database
 *
 * @param mixed $db
 *
 * @return  bool        Whether it suceeded
 */
function PMA_exportDBCreate($db)
{
    return true;
}

/**
 * Outputs the content of a table in CSV format
 *
 * @param mixed $db
 * @param mixed $table
 * @param mixed $crlf
 * @param mixed $error_url
 * @param mixed $sql_query
 *
 * @return  bool        Whether it suceeded
 */
function PMA_exportData($db, $table, $crlf, $error_url, $sql_query)
{
    global $what;

    global $add_character;

    global $separator;

    global $enclosed;

    global $escaped;

    // Gets the data from the database

    $result = PMA_DBI_query($sql_query, null, PMA_DBI_QUERY_UNBUFFERED);

    $fields_cnt = PMA_DBI_num_fields($result);

    // If required, get fields name at the first line

    if (isset($GLOBALS['showcsvnames']) && 'yes' == $GLOBALS['showcsvnames']) {
        $schema_insert = '';

        for ($i = 0; $i < $fields_cnt; $i++) {
            if ('' == $enclosed) {
                $schema_insert .= stripslashes(PMA_DBI_field_name($result, $i));
            } else {
                $schema_insert .= $enclosed
                               . str_replace($enclosed, $escaped . $enclosed, stripslashes(PMA_DBI_field_name($result, $i)))
                               . $enclosed;
            }

            $schema_insert .= $separator;
        } // end for

        $schema_insert = trim(mb_substr($schema_insert, 0, -1));

        if (!PMA_exportOutputHandler($schema_insert . $add_character)) {
            return false;
        }
    } // end if

    // Format the data

    while (false !== ($row = PMA_DBI_fetch_row($result))) {
        $schema_insert = '';

        for ($j = 0; $j < $fields_cnt; $j++) {
            if (!isset($row[$j]) || null === $row[$j]) {
                $schema_insert .= $GLOBALS[$what . '_replace_null'];
            } else {
                if ('0' == $row[$j] || '' != $row[$j]) {
                    // loic1 : always enclose fields

                    if ('excel' == $what) {
                        $row[$j] = preg_replace("\015(\012)?", "\012", $row[$j]);
                    }

                    if ('' == $enclosed) {
                        $schema_insert .= $row[$j];
                    } else {
                        $schema_insert .= $enclosed
                                   . str_replace($enclosed, $escaped . $enclosed, $row[$j])
                                   . $enclosed;
                    }
                } else {
                    $schema_insert .= '';
                }
            }

            if ($j < $fields_cnt - 1) {
                $schema_insert .= $separator;
            }
        } // end for

        if (!PMA_exportOutputHandler($schema_insert . $add_character)) {
            return false;
        }
    } // end while

    PMA_DBI_free_result($result);

    return true;
} // end of the 'PMA_getTableCsv()' function
