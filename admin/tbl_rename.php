<?php

/* $Id: tbl_rename.php,v 2.5 2004/01/22 02:13:47 rabus Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:

/**
 * Gets some core libraries
 */
require_once __DIR__ . '/libraries/grab_globals.lib.php';
$js_to_run = 'functions.js';
require_once __DIR__ . '/libraries/common.lib.php';

PMA_checkParameters(['db', 'table']);

/**
 * Defines the url to return to in case of error in a sql statement
 */
$err_url = 'tbl_properties.php?' . PMA_generate_common_url($db, $table);

/**
 * A new name has been submitted -> do the work
 */
if (isset($new_name) && '' != trim($new_name) && false === mb_strpos($new_name, '.')) {
    $old_name = $table;

    $table = $new_name;

    // Ensure the target is valid

    if (count($dblist) > 0 && -1 == PMA_isInto($db, $dblist)) {
        exit();
    }

    require_once __DIR__ . '/header.inc.php';

    PMA_DBI_select_db($db);

    $sql_query = 'ALTER TABLE ' . PMA_backquote($old_name) . ' RENAME ' . PMA_backquote($new_name) . ';';

    $result = PMA_DBI_query($sql_query);

    $message = sprintf($strRenameTableOK, htmlspecialchars($old_name, ENT_QUOTES | ENT_HTML5), htmlspecialchars($table, ENT_QUOTES | ENT_HTML5));

    $reload = 1;

    // garvin: Move old entries from comments to new table

    require_once __DIR__ . '/libraries/relation.lib.php';

    $cfgRelation = PMA_getRelationsParam();

    if ($cfgRelation['commwork']) {
        $remove_query = 'UPDATE ' . PMA_backquote($cfgRelation['column_info'])
                      . ' SET     table_name = \'' . PMA_sqlAddslashes($table) . '\''
                      . ' WHERE db_name  = \'' . PMA_sqlAddslashes($db) . '\''
                      . ' AND table_name = \'' . PMA_sqlAddslashes($old_name) . '\'';

        $rmv_rs = PMA_query_as_cu($remove_query);

        unset($rmv_query);
    }

    if ($cfgRelation['displaywork']) {
        $table_query = 'UPDATE ' . PMA_backquote($cfgRelation['table_info'])
                        . ' SET     table_name = \'' . PMA_sqlAddslashes($table) . '\''
                        . ' WHERE db_name  = \'' . PMA_sqlAddslashes($db) . '\''
                        . ' AND table_name = \'' . PMA_sqlAddslashes($old_name) . '\'';

        $tb_rs = PMA_query_as_cu($table_query);

        unset($table_query);

        unset($tb_rs);
    }

    if ($cfgRelation['relwork']) {
        $table_query = 'UPDATE ' . PMA_backquote($cfgRelation['relation'])
                        . ' SET     foreign_table = \'' . PMA_sqlAddslashes($table) . '\''
                        . ' WHERE foreign_db  = \'' . PMA_sqlAddslashes($db) . '\''
                        . ' AND foreign_table = \'' . PMA_sqlAddslashes($old_name) . '\'';

        $tb_rs = PMA_query_as_cu($table_query);

        unset($table_query);

        unset($tb_rs);

        $table_query = 'UPDATE ' . PMA_backquote($cfgRelation['relation'])
                        . ' SET     master_table = \'' . PMA_sqlAddslashes($table) . '\''
                        . ' WHERE master_db  = \'' . PMA_sqlAddslashes($db) . '\''
                        . ' AND master_table = \'' . PMA_sqlAddslashes($old_name) . '\'';

        $tb_rs = PMA_query_as_cu($table_query);

        unset($table_query);

        unset($tb_rs);
    }

    if ($cfgRelation['pdfwork']) {
        $table_query = 'UPDATE ' . PMA_backquote($cfgRelation['table_coords'])
                        . ' SET     table_name = \'' . PMA_sqlAddslashes($table) . '\''
                        . ' WHERE db_name  = \'' . PMA_sqlAddslashes($db) . '\''
                        . ' AND table_name = \'' . PMA_sqlAddslashes($old_name) . '\'';

        $tb_rs = PMA_query_as_cu($table_query);

        unset($table_query);

        unset($tb_rs);
    }
}

/**
 * No new name for the table!
 */
else {
    require_once __DIR__ . '/header.inc.php';

    if (false === mb_strpos($new_name, '.')) {
        PMA_mysqlDie($strTableEmpty, '', '', $err_url);
    } else {
        PMA_mysqlDie($strError . ': ' . $new_name, '', '', $err_url);
    }
}

/**
 * Back to the calling script
 */
require __DIR__ . '/tbl_properties_operations.php';
