<?php

/* $Id: tbl_move_copy.php,v 2.9 2004/08/01 17:19:23 lem9 Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:

// Check parameters

require_once __DIR__ . '/libraries/grab_globals.lib.php';
require_once __DIR__ . '/libraries/common.lib.php';

PMA_checkParameters(['db', 'table']);

/**
 * Insert data from one table to another one
 *
 * @param mixed $sql_insert
 *
 * @global  string  the database name
 * @global  string  the original table name
 * @global  string  the target database and table names
 * @global  string  the sql query used to copy the data
 */
function PMA_myHandler($sql_insert = '')
{
    global $db, $table, $target;

    global $sql_insert_data;

    $sql_insert = preg_replace('~INSERT INTO (`?)' . $table . '(`?)~i', 'INSERT INTO ' . $target, $sql_insert);

    $result = PMA_DBI_query($sql_insert);

    $sql_insert_data .= $sql_insert . ';' . "\n";
} // end of the 'PMA_myHandler()' function

/**
 * Inserts existing entries in a PMA_* table by reading a value from an old entry
 *
 * @param mixed $work
 * @param mixed $pma_table
 * @param mixed $get_fields
 * @param mixed $where_fields
 * @param mixed $new_fields
 * @return bool|int
 * @global  string  relation variable
 *
 * @author          Garvin Hicking <me@supergarv.de>
 */
function PMA_duplicate_table($work, $pma_table, $get_fields, $where_fields, $new_fields)
{
    global $cfgRelation;

    $last_id = -1;

    if ($cfgRelation[$work]) {
        $select_parts = [];

        $row_fields = [];

        foreach ($get_fields as $nr => $get_field) {
            $select_parts[] = PMA_backquote($get_field);

            $row_fields[$get_field] = 'cc';
        }

        $where_parts = [];

        foreach ($where_fields as $_where => $_value) {
            $where_parts[] = PMA_backquote($_where) . ' = \'' . PMA_sqlAddslashes($_value) . '\'';
        }

        $new_parts = [];

        $new_value_parts = [];

        foreach ($new_fields as $_where => $_value) {
            $new_parts[] = PMA_backquote($_where);

            $new_value_parts[] = PMA_sqlAddslashes($_value);
        }

        $table_copy_query = 'SELECT ' . implode(', ', $select_parts)
                          . ' FROM ' . PMA_backquote($cfgRelation[$pma_table])
                          . ' WHERE ' . implode(' AND ', $where_parts);

        $table_copy_rs = PMA_query_as_cu($table_copy_query);

        while (false !== ($table_copy_row = @PMA_DBI_fetch_assoc($table_copy_rs))) {
            $value_parts = [];

            foreach ($table_copy_row as $_key => $_val) {
                if (isset($row_fields[$_key]) && 'cc' == $row_fields[$_key]) {
                    $value_parts[] = PMA_sqlAddslashes($_val);
                }
            }

            $new_table_query = 'INSERT IGNORE INTO ' . PMA_backquote($cfgRelation[$pma_table])
                            . ' (' . implode(', ', $select_parts) . ', ' . implode(', ', $new_parts) . ')'
                            . ' VALUES '
                            . ' (\'' . implode('\', \'', $value_parts) . '\', \'' . implode('\', \'', $new_value_parts) . '\')';

            $new_table_rs = PMA_query_as_cu($new_table_query);

            $last_id = PMA_DBI_insert_id();
        } // end while

        return $last_id;
    }

    return true;
} // end of 'PMA_duplicate_table()' function

/**
 * Gets some core libraries
 */
require_once __DIR__ . '/libraries/grab_globals.lib.php';
require_once __DIR__ . '/libraries/common.lib.php';

/**
 * Defines the url to return to in case of error in a sql statement
 */
$err_url = 'tbl_properties.php?' . PMA_generate_common_url($db, $table);

/**
 * Selects the database to work with
 */
PMA_DBI_select_db($db);

/**
 * A target table name has been sent to this script -> do the work
 */
if (isset($new_name) && '' != trim($new_name)) {
    $use_backquotes = 1;

    $asfile = 1;

    // Ensure the target is valid

    if (count($dblist) > 0 &&
        (-1 == PMA_isInto($db, $dblist) || -1 == PMA_isInto($target_db, $dblist))) {
        exit();
    }

    if ($db == $target_db && $new_name == $table) {
        $message = (isset($submit_move) ? $strMoveTableSameNames : $strCopyTableSameNames);
    } else {
        $source = PMA_backquote($db) . '.' . PMA_backquote($table);

        if (empty($target_db)) {
            $target_db = $db;
        }

        // This could avoid some problems with replicated databases, when

        // moving table from replicated one to not replicated one

        PMA_DBI_select_db($target_db);

        $target = PMA_backquote($target_db) . '.' . PMA_backquote($new_name);

        // do not create the table if dataonly

        if ('dataonly' != $what) {
            require __DIR__ . '/libraries/export/sql.php';

            $no_constraints_comments = true;

            $sql_structure = PMA_getTableDef($db, $table, "\n", $err_url);

            unset($no_constraints_comments);

            $parsed_sql = PMA_SQP_parse($sql_structure);

            /* nijel: Find table name in query and replace it */

            $i = 0;

            while ('quote_backtick' != $parsed_sql[$i]['type']) {
                $i++;
            }

            /* no need to PMA_backquote() */

            $parsed_sql[$i]['data'] = $target;

            /* Generate query back */

            $sql_structure = PMA_SQP_formatHtml($parsed_sql, 'query_only');

            // If table exists, and 'add drop table' is selected: Drop it!

            $drop_query = '';

            if (isset($drop_if_exists) && 'true' == $drop_if_exists) {
                $drop_query = 'DROP TABLE IF EXISTS ' . PMA_backquote($target_db) . '.' . PMA_backquote($new_name);

                $result = PMA_DBI_query($drop_query);

                if (isset($sql_query)) {
                    $sql_query .= "\n" . $drop_query . ';';
                } else {
                    $sql_query = $drop_query . ';';
                }

                // garvin: If an existing table gets deleted, maintain any entries

                // for the PMA_* tables

                $maintain_relations = true;
            }

            $result = @PMA_DBI_query($sql_structure);

            if (isset($sql_query)) {
                $sql_query .= "\n" . $sql_structure . ';';
            } else {
                $sql_query = $sql_structure . ';';
            }

            if ((isset($submit_move) || isset($constraints)) && isset($sql_constraints)) {
                $parsed_sql = PMA_SQP_parse($sql_constraints);

                $i = 0;

                while ('quote_backtick' != $parsed_sql[$i]['type']) {
                    $i++;
                }

                /* no need to PMA_backquote() */

                $parsed_sql[$i]['data'] = $target;

                /* Generate query back */

                $sql_constraints = PMA_SQP_formatHtml($parsed_sql, 'query_only');

                $result = PMA_DBI_query($sql_constraints);

                if (isset($sql_query)) {
                    $sql_query .= "\n" . $sql_constraints;
                } else {
                    $sql_query = $sql_constraints;
                }
            }
        } else {
            $sql_query = '';
        }

        // Copy the data

        //if ($result !== false && ($what == 'data' || $what == 'dataonly')) {

        if ('data' == $what || 'dataonly' == $what) {
            $sql_insert_data = 'INSERT INTO ' . $target . ' SELECT * FROM ' . $source;

            PMA_DBI_query($sql_insert_data);

            $sql_query .= "\n\n" . $sql_insert_data . ';';
        }

        require_once __DIR__ . '/libraries/relation.lib.php';

        $cfgRelation = PMA_getRelationsParam();

        // Drops old table if the user has requested to move it

        if (isset($submit_move)) {
            // This could avoid some problems with replicated databases, when

            // moving table from replicated one to not replicated one

            PMA_DBI_select_db($db);

            $sql_drop_table = 'DROP TABLE ' . $source;

            PMA_DBI_query($sql_drop_table);

            // garvin: Move old entries from PMA-DBs to new table

            if ($cfgRelation['commwork']) {
                $remove_query = 'UPDATE ' . PMA_backquote($cfgRelation['column_info'])
                              . ' SET     table_name = \'' . PMA_sqlAddslashes($new_name) . '\', '
                              . '        db_name    = \'' . PMA_sqlAddslashes($target_db) . '\''
                              . ' WHERE db_name  = \'' . PMA_sqlAddslashes($db) . '\''
                              . ' AND table_name = \'' . PMA_sqlAddslashes($table) . '\'';

                $rmv_rs = PMA_query_as_cu($remove_query);

                unset($rmv_query);
            }

            // garvin: updating bookmarks is not possible since only a single table is moved,

            // and not the whole DB.

            // if ($cfgRelation['bookmarkwork']) {

            //     $remove_query = 'UPDATE ' . PMA_backquote($cfgRelation['bookmark'])

            //                   . ' SET     dbase = \'' . PMA_sqlAddslashes($target_db) . '\''

            //                   . ' WHERE dbase  = \'' . PMA_sqlAddslashes($db) . '\'';

            //     $rmv_rs    = PMA_query_as_cu($remove_query);

            //     unset($rmv_query);

            // }

            if ($cfgRelation['displaywork']) {
                $table_query = 'UPDATE ' . PMA_backquote($cfgRelation['table_info'])
                                . ' SET     db_name = \'' . PMA_sqlAddslashes($target_db) . '\', '
                                . '         table_name = \'' . PMA_sqlAddslashes($new_name) . '\''
                                . ' WHERE db_name  = \'' . PMA_sqlAddslashes($db) . '\''
                                . ' AND table_name = \'' . PMA_sqlAddslashes($table) . '\'';

                $tb_rs = PMA_query_as_cu($table_query);

                unset($table_query);

                unset($tb_rs);
            }

            if ($cfgRelation['relwork']) {
                $table_query = 'UPDATE ' . PMA_backquote($cfgRelation['relation'])
                                . ' SET     foreign_table = \'' . PMA_sqlAddslashes($new_name) . '\','
                                . '         foreign_db = \'' . PMA_sqlAddslashes($target_db) . '\''
                                . ' WHERE foreign_db  = \'' . PMA_sqlAddslashes($db) . '\''
                                . ' AND foreign_table = \'' . PMA_sqlAddslashes($table) . '\'';

                $tb_rs = PMA_query_as_cu($table_query);

                unset($table_query);

                unset($tb_rs);

                $table_query = 'UPDATE ' . PMA_backquote($cfgRelation['relation'])
                                . ' SET     master_table = \'' . PMA_sqlAddslashes($new_name) . '\','
                                . '         master_db = \'' . PMA_sqlAddslashes($target_db) . '\''
                                . ' WHERE master_db  = \'' . PMA_sqlAddslashes($db) . '\''
                                . ' AND master_table = \'' . PMA_sqlAddslashes($table) . '\'';

                $tb_rs = PMA_query_as_cu($table_query);

                unset($table_query);

                unset($tb_rs);
            }

            // garvin: [TODO] Can't get moving PDFs the right way. The page numbers always

            // get screwed up independently from duplication because the numbers do not

            // seem to be stored on a per-database basis. Would the author of pdf support

            // please have a look at it?

            if ($cfgRelation['pdfwork']) {
                $table_query = 'UPDATE ' . PMA_backquote($cfgRelation['table_coords'])
                                . ' SET     table_name = \'' . PMA_sqlAddslashes($new_name) . '\','
                                . '         db_name = \'' . PMA_sqlAddslashes($target_db) . '\''
                                . ' WHERE db_name  = \'' . PMA_sqlAddslashes($db) . '\''
                                . ' AND table_name = \'' . PMA_sqlAddslashes($table) . '\'';

                $tb_rs = PMA_query_as_cu($table_query);

                unset($table_query);

                unset($tb_rs);

                /*
                $pdf_query = 'SELECT pdf_page_number '
                           . ' FROM ' . PMA_backquote($cfgRelation['table_coords'])
                           . ' WHERE db_name  = \'' . PMA_sqlAddslashes($target_db) . '\''
                           . ' AND table_name = \'' . PMA_sqlAddslashes($new_name) . '\'';
                $pdf_rs = PMA_query_as_cu($pdf_query);

                while (false !== ($pdf_copy_row = PMA_DBI_fetch_assoc($pdf_rs))) {
                    $table_query = 'UPDATE ' . PMA_backquote($cfgRelation['pdf_pages'])
                                    . ' SET     db_name = \'' . PMA_sqlAddslashes($target_db) . '\''
                                    . ' WHERE db_name  = \'' . PMA_sqlAddslashes($db) . '\''
                                    . ' AND page_nr = \'' . PMA_sqlAddslashes($pdf_copy_row['pdf_page_number']) . '\'';
                    $tb_rs    = PMA_query_as_cu($table_query);
                    unset($table_query);
                    unset($tb_rs);
                }
                */
            }

            $sql_query .= "\n\n" . $sql_drop_table . ';';
        } else {
            // garvin: Create new entries as duplicates from old PMA DBs

            if ('dataonly' != $what && !isset($maintain_relations)) {
                if ($cfgRelation['commwork']) {
                    // Get all comments and MIME-Types for current table

                    $comments_copy_query = 'SELECT
                                                column_name, ' . PMA_backquote('comment') . ($cfgRelation['mimework'] ? ', mimetype, transformation, transformation_options' : '') . '
                                            FROM ' . PMA_backquote($cfgRelation['column_info']) . '
                                            WHERE
                                                db_name = \'' . PMA_sqlAddslashes($db) . '\' AND
                                                table_name = \'' . PMA_sqlAddslashes($table) . '\'';

                    $comments_copy_rs = PMA_query_as_cu($comments_copy_query);

                    // Write every comment as new copied entry. [MIME]

                    while (false !== ($comments_copy_row = PMA_DBI_fetch_assoc($comments_copy_rs))) {
                        $new_comment_query = 'REPLACE INTO ' . PMA_backquote($cfgRelation['column_info'])
                                    . ' (db_name, table_name, column_name, ' . PMA_backquote('comment') . ($cfgRelation['mimework'] ? ', mimetype, transformation, transformation_options' : '') . ') '
                                    . ' VALUES('
                                    . '\'' . PMA_sqlAddslashes($target_db) . '\','
                                    . '\'' . PMA_sqlAddslashes($new_name) . '\','
                                    . '\'' . PMA_sqlAddslashes($comments_copy_row['column_name']) . '\''
                                    . ($cfgRelation['mimework'] ? ',\'' . PMA_sqlAddslashes($comments_copy_row['comment']) . '\','
                                            . '\'' . PMA_sqlAddslashes($comments_copy_row['mimetype']) . '\','
                                            . '\'' . PMA_sqlAddslashes($comments_copy_row['transformation']) . '\','
                                            . '\'' . PMA_sqlAddslashes($comments_copy_row['transformation_options']) . '\'' : '')
                                    . ')';

                        $new_comment_rs = PMA_query_as_cu($new_comment_query);
                    } // end while
                }

                if ($db != $target_db) {
                    $get_fields = ['user', 'label', 'query'];

                    $where_fields = ['dbase' => $db];

                    $new_fields = ['dbase' => $target_db];

                    PMA_duplicate_table('bookmarkwork', 'bookmark', $get_fields, $where_fields, $new_fields);
                }

                $get_fields = ['display_field'];

                $where_fields = ['db_name' => $db, 'table_name' => $table];

                $new_fields = ['db_name' => $target_db, 'table_name' => $new_name];

                PMA_duplicate_table('displaywork', 'table_info', $get_fields, $where_fields, $new_fields);

                $get_fields = ['master_field', 'foreign_db', 'foreign_table', 'foreign_field'];

                $where_fields = ['master_db' => $db, 'master_table' => $table];

                $new_fields = ['master_db' => $target_db, 'master_table' => $new_name];

                PMA_duplicate_table('relwork', 'relation', $get_fields, $where_fields, $new_fields);

                $get_fields = ['foreign_field', 'master_db', 'master_table', 'master_field'];

                $where_fields = ['foreign_db' => $db, 'foreign_table' => $table];

                $new_fields = ['foreign_db' => $target_db, 'foreign_table' => $new_name];

                PMA_duplicate_table('relwork', 'relation', $get_fields, $where_fields, $new_fields);

                // garvin: [TODO] Can't get duplicating PDFs the right way. The page numbers always
                // get screwed up independently from duplication because the numbers do not
                // seem to be stored on a per-database basis. Would the author of pdf support
                // please have a look at it?
                /*
                $get_fields = array('page_descr');
                $where_fields = array('db_name' => $db);
                $new_fields = array('db_name' => $target_db);
                $last_id = PMA_duplicate_table('pdfwork', 'pdf_pages', $get_fields, $where_fields, $new_fields);

                if (isset($last_id) && $last_id >= 0) {
                    $get_fields = array('x', 'y');
                    $where_fields = array('db_name' => $db, 'table_name' => $table);
                    $new_fields = array('db_name' => $target_db, 'table_name' => $new_name, 'pdf_page_number' => $last_id);
                    PMA_duplicate_table('pdfwork', 'table_coords', $get_fields, $where_fields, $new_fields);
                }
                */
            }
        }

        $message = (isset($submit_move) ? $strMoveTableOK : $strCopyTableOK);

        $message = sprintf($message, htmlspecialchars($source, ENT_QUOTES | ENT_HTML5), htmlspecialchars($target, ENT_QUOTES | ENT_HTML5));

        $reload = 1;

        $js_to_run = 'functions.js';

        /* Check: Work on new table or on old table? */

        if (isset($submit_move)) {
            $db = $target_db;

            $table = $new_name;
        } else {
            $pma_uri_parts = parse_url($cfg['PmaAbsoluteUri']);

            if (isset($switch_to_new) && 'true' == $switch_to_new) {
                setcookie('pma_switch_to_new', 'true', 0, mb_substr($pma_uri_parts['path'], 0, mb_strrpos($pma_uri_parts['path'], '/')), '', ('https' == $pma_uri_parts['scheme']));

                $db = $target_db;

                $table = $new_name;
            } else {
                setcookie('pma_switch_to_new', '', 0, mb_substr($pma_uri_parts['path'], 0, mb_strrpos($pma_uri_parts['path'], '/')), '', ('https' == $pma_uri_parts['scheme']));

                // garvin:Keep original table for work.
            }
        }
    }

    require_once __DIR__ . '/header.inc.php';
} // end is target table name

/**
 * No new name for the table!
 */
else {
    require_once __DIR__ . '/header.inc.php';

    PMA_mysqlDie($strTableEmpty, '', '', $err_url);
}

/**
 * Back to the calling script
 */
require __DIR__ . '/tbl_properties.php';
