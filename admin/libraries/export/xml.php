<?php

/* $Id: xml.php,v 2.7 2004/04/14 13:51:11 nijel Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:

/**
 * Set of functions used to build XML dumps of tables
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
    return PMA_exportOutputHandler('<!-- ' . $text . ' -->' . $GLOBALS['crlf']);
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
    global $crlf;

    global $cfg;

    if ($GLOBALS['output_charset_conversion']) {
        $charset = $GLOBALS['charset_of_file'];
    } else {
        $charset = $GLOBALS['charset'];
    }

    $head = '<?xml version="1.0" encoding="' . $charset . '" ?>' . $crlf
           . '<!--' . $crlf
           . '-' . $crlf
           . '- phpMyAdmin XML Dump' . $crlf
           . '- version ' . PMA_VERSION . $crlf
           . '- http://www.phpmyadmin.net' . $crlf
           . '-' . $crlf
           . '- ' . $GLOBALS['strHost'] . ': ' . $cfg['Server']['host'];

    if (!empty($cfg['Server']['port'])) {
        $head .= ':' . $cfg['Server']['port'];
    }

    $head .= $crlf
           . '- ' . $GLOBALS['strGenTime'] . ': ' . PMA_localisedDate() . $crlf
           . '- ' . $GLOBALS['strServerVersion'] . ': ' . mb_substr(PMA_MYSQL_INT_VERSION, 0, 1) . '.' . (int) mb_substr(PMA_MYSQL_INT_VERSION, 1, 2) . '.' . (int) mb_substr(PMA_MYSQL_INT_VERSION, 3) . $crlf
           . '- ' . $GLOBALS['strPHPVersion'] . ': ' . phpversion() . $crlf
           . '-->' . $crlf . $crlf;

    return PMA_exportOutputHandler($head);
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
    global $crlf;

    $head = '<!--' . $crlf
          . '- ' . $GLOBALS['strDatabase'] . ': ' . (isset($GLOBALS['use_backquotes']) ? PMA_backquote($db) : '\'' . $db . '\'') . $crlf
          . '-->' . $crlf
          . '<' . $db . '>' . $crlf;

    return PMA_exportOutputHandler($head);
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
    global $crlf;

    return PMA_exportOutputHandler('</' . $db . '>' . $crlf);
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
 * Outputs the content of a table
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
    $result = PMA_DBI_query($sql_query, null, PMA_DBI_QUERY_UNBUFFERED);

    $columns_cnt = PMA_DBI_num_fields($result);

    for ($i = 0; $i < $columns_cnt; $i++) {
        $columns[$i] = stripslashes(PMA_DBI_field_name($result, $i));
    }

    unset($i);

    $buffer = '  <!-- ' . $GLOBALS['strTable'] . ' ' . $table . ' -->' . $crlf;

    if (!PMA_exportOutputHandler($buffer)) {
        return false;
    }

    while (false !== ($record = PMA_DBI_fetch_row($result))) {
        $buffer = '    <' . $table . '>' . $crlf;

        for ($i = 0; $i < $columns_cnt; $i++) {
            if (isset($record[$i]) && null !== $record[$i]) {
                $buffer .= '        <' . $columns[$i] . '>' . htmlspecialchars($record[$i], ENT_QUOTES | ENT_HTML5)
                        . '</' . $columns[$i] . '>' . $crlf;
            }
        }

        $buffer .= '    </' . $table . '>' . $crlf;

        if (!PMA_exportOutputHandler($buffer)) {
            return false;
        }
    }

    PMA_DBI_free_result($result);

    return true;
} // end of the 'PMA_getTableXML()' function
