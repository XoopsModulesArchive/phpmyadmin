<?php

/* $Id: xls.php,v 1.2 2004/07/06 17:53:28 lem9 Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:

require_once __DIR__ . '/Spreadsheet/Excel/Writer.php';

/**
 * Set of functions used to build MS Excel dumps of tables
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
    global $workbook;

    global $tmp_filename;

    $res = $workbook->close();

    if (PEAR::isError($res)) {
        echo $res->getMessage();

        return false;
    }

    if (!PMA_exportOutputHandler(file_get_contents($tmp_filename))) {
        return false;
    }

    unlink($tmp_filename);

    return true;
}

/**
 * Outputs export header
 *
 * @return  bool        Whether it suceeded
 */
function PMA_exportHeader()
{
    global $workbook;

    global $tmp_filename;

    if (empty($GLOBALS['cfg']['TempDir'])) {
        return false;
    }

    $tmp_filename = tempnam(realpath($GLOBALS['cfg']['TempDir']), 'pma_xls_');

    $workbook = new Spreadsheet_Excel_Writer($tmp_filename);

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

    global $workbook;

    $worksheet = &$workbook->addWorksheet($table);

    $workbook->setTempDir(realpath($GLOBALS['cfg']['TempDir']));

    // Gets the data from the database

    $result = PMA_DBI_query($sql_query, null, PMA_DBI_QUERY_UNBUFFERED);

    $fields_cnt = PMA_DBI_num_fields($result);

    $col = 0;

    // If required, get fields name at the first line

    if (isset($GLOBALS['xls_shownames']) && 'yes' == $GLOBALS['xls_shownames']) {
        $schema_insert = '';

        for ($i = 0; $i < $fields_cnt; $i++) {
            $worksheet->write(0, $i, stripslashes(PMA_DBI_field_name($result, $i)));
        } // end for

        $col++;
    } // end if

    // Format the data

    while (false !== ($row = PMA_DBI_fetch_row($result))) {
        $schema_insert = '';

        for ($j = 0; $j < $fields_cnt; $j++) {
            if (!isset($row[$j]) || null === $row[$j]) {
                $worksheet->write($col, $j, $GLOBALS['xls_replace_null']);
            } else {
                if ('0' == $row[$j] || '' != $row[$j]) {
                    // FIXME: we should somehow handle character set here!

                    $worksheet->write($col, $j, $row[$j]);
                } else {
                    $worksheet->write($col, $j, '');
                }
            }
        } // end for

        $col++;
    } // end while

    PMA_DBI_free_result($result);

    return true;
}
