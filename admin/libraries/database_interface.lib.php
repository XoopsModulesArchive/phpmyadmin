<?php

/* $Id: database_interface.lib.php,v 2.8 2004/08/03 00:26:46 lem9 Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:

/**
 * Common Option Constants For DBI Functions
 */
// PMA_DBI_try_query()
define('PMA_DBI_QUERY_STORE', 1);  // Force STORE_RESULT method, ignored by classic MySQL.
define('PMA_DBI_QUERY_UNBUFFERED', 2);  // Do not read whole query
// PMA_DBI_get_variable()
define('PMA_DBI_GETVAR_SESSION', 1);
define('PMA_DBI_GETVAR_GLOBAL', 2);

/**
 * Including The DBI Plugin
 */
require_once __DIR__ . '/libraries/dbi/' . $cfg['Server']['extension'] . '.dbi.lib.php';

/**
 * Common Functions
 * @param mixed      $query
 * @param null|mixed $link
 * @param mixed      $options
 * @return bool|resource|\mysqli_result
 * @return bool|resource|\mysqli_result
 */
function PMA_DBI_query($query, $link = null, $options = 0)
{
    $res = PMA_DBI_try_query($query, $link, $options) or PMA_mysqlDie(PMA_DBI_getError($link), $query);

    return $res;
}

function PMA_DBI_get_dblist($link = null)
{
    if (empty($link)) {
        if (isset($GLOBALS['userlink'])) {
            $link = $GLOBALS['userlink'];
        } else {
            return false;
        }
    }

    $res = PMA_DBI_try_query('SHOW DATABASES;', $link);

    $dbs_array = [];

    while (false !== ($row = PMA_DBI_fetch_row($res))) {
        // Before MySQL 4.0.2, SHOW DATABASES could send the

        // whole list, so check if we really have access:

        if (PMA_MYSQL_CLIENT_API < 40002) {
            $dblink = @PMA_DBI_select_db($row[0], $link);

            if (!$dblink) {
                continue;
            }
        }

        $dbs_array[] = $row[0];
    }

    PMA_DBI_free_result($res);

    unset($res);

    return $dbs_array;
}

function PMA_DBI_get_tables($database, $link = null)
{
    $result = PMA_DBI_query('SHOW TABLES FROM ' . PMA_backquote($database) . ';', null, PMA_DBI_QUERY_STORE);

    $tables = [];

    while (list($current) = PMA_DBI_fetch_row($result)) {
        $tables[] = $current;
    }

    PMA_DBI_free_result($result);

    return $tables;
}

function PMA_DBI_get_fields($database, $table, $link = null)
{
    if (empty($link)) {
        if (isset($GLOBALS['userlink'])) {
            $link = $GLOBALS['userlink'];
        } else {
            return false;
        }
    }

    $result = PMA_DBI_query('SHOW FULL FIELDS FROM ' . PMA_backquote($database) . '.' . PMA_backquote($table), $link);

    $fields = [];

    while (false !== ($row = PMA_DBI_fetch_assoc($result))) {
        $fields[] = $row;
    }

    return $fields;
}

function PMA_DBI_get_variable($var, $type = PMA_DBI_GETVAR_SESSION, $link = null)
{
    if (null === $link) {
        if (isset($GLOBALS['userlink'])) {
            $link = $GLOBALS['userlink'];
        } else {
            return false;
        }
    }

    if (PMA_MYSQL_INT_VERSION < 40002) {
        $type = 0;
    }

    switch ($type) {
        case PMA_DBI_GETVAR_SESSION:
            $modifier = ' SESSION';
            break;
        case PMA_DBI_GETVAR_GLOBAL:
            $modifier = ' GLOBAL';
            break;
        default:
            $modifier = '';
    }

    $res = PMA_DBI_query('SHOW' . $modifier . ' VARIABLES LIKE \'' . $var . '\';', $link);

    $row = PMA_DBI_fetch_row($res);

    PMA_DBI_free_result($res);

    if (empty($row)) {
        return false;
    }

    return $row[0] == $var ? $row[1] : false;
}

function PMA_DBI_postConnect($link)
{
    global $collation_connection;

    if (!defined('PMA_MYSQL_INT_VERSION')) {
        $result = PMA_DBI_query('SELECT VERSION() AS version', $link, PMA_DBI_QUERY_STORE);

        if (false !== $result && @PMA_DBI_num_rows($result) > 0) {
            $row = PMA_DBI_fetch_row($result);

            $match = explode('.', $row[0]);

            PMA_DBI_free_result($result);
        }

        if (!isset($row)) {
            define('PMA_MYSQL_INT_VERSION', 32332);

            define('PMA_MYSQL_STR_VERSION', '3.23.32');
        } else {
            define('PMA_MYSQL_INT_VERSION', (int)sprintf('%d%02d%02d', $match[0], $match[1], (int)$match[2]));

            define('PMA_MYSQL_STR_VERSION', $row[0]);

            unset($result, $row, $match);
        }
    }

    if (PMA_MYSQL_INT_VERSION >= 40100) {
        // If $lang is defined and we are on MySQL >= 4.1.x,

        // we auto-switch the lang to its UTF-8 version (if it exists)

        if (!empty($GLOBALS['lang']) && ('utf-8' != mb_substr($GLOBALS['lang'], -5))) {
            $lang_utf_8_version = mb_substr($GLOBALS['lang'], 0, mb_strpos($GLOBALS['lang'], '-')) . '-utf-8';

            if (!empty($GLOBALS['available_languages'][$lang_utf_8_version])) {
                $GLOBALS['lang'] = $lang_utf_8_version;

                $GLOBALS['charset'] = $charset = 'utf-8';
            }
        }

        $mysql_charset = $GLOBALS['mysql_charset_map'][$GLOBALS['charset']];

        if (empty($collation_connection) || (mb_strpos('_', $collation_connection) ? mb_substr($collation_connection, 0, mb_strpos('_', $collation_connection)) : $collation_connection) == $mysql_charset) {
            PMA_DBI_query('SET NAMES ' . $mysql_charset . ';', $link, PMA_DBI_QUERY_STORE);
        } else {
            PMA_DBI_query('SET CHARACTER SET ' . $mysql_charset . ';', $link, PMA_DBI_QUERY_STORE);
        }

        if (!empty($collation_connection)) {
            PMA_DBI_query('SET collation_connection = \'' . $collation_connection . '\';', $link, PMA_DBI_QUERY_STORE);
        }

        $collation_connection = PMA_DBI_get_variable('collation_connection', PMA_DBI_GETVAR_SESSION, $link);
    } else {
        require_once __DIR__ . '/libraries/charset_conversion.lib.php';
    }
}
