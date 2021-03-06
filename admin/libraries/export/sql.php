<?php

/* $Id: sql.php,v 2.30 2004/08/02 09:07:54 nijel Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:
error_reporting(E_ALL);
/**
 * Set of functions used to build SQL dumps of tables
 */

/**
 * Marker for comments, -- is needed for ANSI SQL.
 */
$comment_marker = '-- ';

/**
 * Outputs comment
 *
 * @param mixed $text
 *
 * @return  bool        Whether it suceeded
 */
function PMA_exportComment($text)
{
    return PMA_exportOutputHandler($GLOBALS['comment_marker'] . $text . $GLOBALS['crlf']);
}

/**
 * Outputs export footer
 *
 * @return  bool        Whether it suceeded
 */
function PMA_exportFooter()
{
    global $crlf;

    $foot = '';

    if (isset($GLOBALS['disable_fk'])) {
        $foot .= $crlf . 'SET FOREIGN_KEY_CHECKS=1;' . $crlf;
    }

    if (isset($GLOBALS['use_transaction'])) {
        $foot .= $crlf . 'COMMIT;' . $crlf;
    }

    return PMA_exportOutputHandler($foot);
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

    $head = $GLOBALS['comment_marker'] . 'phpMyAdmin SQL Dump' . $crlf
           . $GLOBALS['comment_marker'] . 'version ' . PMA_VERSION . $crlf
           . $GLOBALS['comment_marker'] . 'http://www.phpmyadmin.net' . $crlf
           . $GLOBALS['comment_marker'] . $crlf
           . $GLOBALS['comment_marker'] . $GLOBALS['strHost'] . ': ' . $cfg['Server']['host'];

    if (!empty($cfg['Server']['port'])) {
        $head .= ':' . $cfg['Server']['port'];
    }

    $head .= $crlf
           . $GLOBALS['comment_marker'] . $GLOBALS['strGenTime'] . ': ' . PMA_localisedDate() . $crlf
           . $GLOBALS['comment_marker'] . $GLOBALS['strServerVersion'] . ': ' . mb_substr(PMA_MYSQL_INT_VERSION, 0, 1) . '.' . (int) mb_substr(PMA_MYSQL_INT_VERSION, 1, 2) . '.' . (int) mb_substr(PMA_MYSQL_INT_VERSION, 3) . $crlf
           . $GLOBALS['comment_marker'] . $GLOBALS['strPHPVersion'] . ': ' . phpversion() . $crlf;

    if (isset($GLOBALS['header_comment']) && !empty($GLOBALS['header_comment'])) {
        $lines = explode('\n', $GLOBALS['header_comment']);

        $head .= $GLOBALS['comment_marker'] . $crlf
               . $GLOBALS['comment_marker'] . implode($crlf . $GLOBALS['comment_marker'], $lines) . $crlf
               . $GLOBALS['comment_marker'] . $crlf;
    }

    if (isset($GLOBALS['disable_fk'])) {
        $head .= $crlf . 'SET FOREIGN_KEY_CHECKS=0;' . $crlf;
    }

    if (isset($GLOBALS['use_transaction'])) {
        $head .= $crlf . 'SET AUTOCOMMIT=0;' . $crlf
                . 'START TRANSACTION;' . $crlf . $crlf;
    }

    return PMA_exportOutputHandler($head);
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
    global $crlf;

    if (isset($GLOBALS['drop_database'])) {
        if (!PMA_exportOutputHandler('DROP DATABASE ' . (isset($GLOBALS['use_backquotes']) ? PMA_backquote($db) : $db) . ';' . $crlf)) {
            return false;
        }
    }

    $create_query = 'CREATE DATABASE ' . (isset($GLOBALS['use_backquotes']) ? PMA_backquote($db) : $db);

    if (PMA_MYSQL_INT_VERSION >= 40101) {
        $collation = PMA_getDbCollation($db);

        if (mb_strpos($collation, '_')) {
            $create_query .= ' DEFAULT CHARACTER SET ' . mb_substr($collation, 0, mb_strpos($collation, '_')) . ' COLLATE ' . $collation;
        } else {
            $create_query .= ' DEFAULT CHARACTER SET ' . $collation;
        }
    }

    $create_query .= ';' . $crlf;

    if (!PMA_exportOutputHandler($create_query)) {
        return false;
    }

    return PMA_exportOutputHandler('USE ' . $db . ';' . $crlf);
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

    $head = $GLOBALS['comment_marker'] . $crlf
          . $GLOBALS['comment_marker'] . $GLOBALS['strDatabase'] . ': ' . (isset($GLOBALS['use_backquotes']) ? PMA_backquote($db) : '\'' . $db . '\'') . $crlf
          . $GLOBALS['comment_marker'] . $crlf;

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
    if (isset($GLOBALS['sql_constraints'])) {
        return PMA_exportOutputHandler($GLOBALS['sql_constraints']);
    }

    return true;
}

/**
 * Returns $table's CREATE definition
 *
 * @param mixed $db
 * @param mixed $table
 * @param mixed $crlf
 * @param mixed $error_url
 * @param mixed $show_dates
 *
 * @return  string   resulting schema
 *
 * @global  bool  whether to add 'drop' statements or not
 * @global  bool  whether to use backquotes to allow the use of special
 *                   characters in database, table and fields names or not
 */
function PMA_getTableDef($db, $table, $crlf, $error_url, $show_dates = false)
{
    global $drop;

    global $use_backquotes;

    global $cfgRelation;

    global $sql_constraints;

    $schema_create = '';

    $auto_increment = '';

    $new_crlf = $crlf;

    $result = PMA_DBI_query('SHOW TABLE STATUS FROM ' . PMA_backquote($db) . ' LIKE \'' . PMA_sqlAddslashes($table) . '\'');

    if (false !== $result) {
        if (PMA_DBI_num_rows($result) > 0) {
            $tmpres = PMA_DBI_fetch_assoc($result);

            if (isset($GLOBALS['auto_increment']) && !empty($tmpres['Auto_increment'])) {
                $auto_increment .= ' AUTO_INCREMENT=' . $tmpres['Auto_increment'] . ' ';
            }

            if ($show_dates && isset($tmpres['Create_time']) && !empty($tmpres['Create_time'])) {
                $schema_create .= $GLOBALS['comment_marker'] . $GLOBALS['strStatCreateTime'] . ': ' . PMA_localisedDate(strtotime($tmpres['Create_time'])) . $crlf;

                $new_crlf = $GLOBALS['comment_marker'] . $crlf . $crlf;
            }

            if ($show_dates && isset($tmpres['Update_time']) && !empty($tmpres['Update_time'])) {
                $schema_create .= $GLOBALS['comment_marker'] . $GLOBALS['strStatUpdateTime'] . ': ' . PMA_localisedDate(strtotime($tmpres['Update_time'])) . $crlf;

                $new_crlf = $GLOBALS['comment_marker'] . $crlf . $crlf;
            }

            if ($show_dates && isset($tmpres['Check_time']) && !empty($tmpres['Check_time'])) {
                $schema_create .= $GLOBALS['comment_marker'] . $GLOBALS['strStatCheckTime'] . ': ' . PMA_localisedDate(strtotime($tmpres['Check_time'])) . $crlf;

                $new_crlf = $GLOBALS['comment_marker'] . $crlf . $crlf;
            }
        }

        PMA_DBI_free_result($result);
    }

    $schema_create .= $new_crlf;

    if (!empty($drop)) {
        $schema_create .= 'DROP TABLE IF EXISTS ' . PMA_backquote($table, $use_backquotes) . ';' . $crlf;
    }

    // Steve Alberty's patch for complete table dump,

    // Whether to quote table and fields names or not

    if ($use_backquotes) {
        PMA_DBI_query('SET SQL_QUOTE_SHOW_CREATE = 1');
    } else {
        PMA_DBI_query('SET SQL_QUOTE_SHOW_CREATE = 0');
    }

    $result = PMA_DBI_query('SHOW CREATE TABLE ' . PMA_backquote($db) . '.' . PMA_backquote($table), null, PMA_DBI_QUERY_UNBUFFERED);

    if (false !== $result && ($row = PMA_DBI_fetch_row($result))) {
        $create_query = $row[1];

        unset($row);

        // Should we use IF NOT EXISTS?

        if (isset($GLOBALS['if_not_exists'])) {
            $create_query = preg_replace('/^CREATE TABLE/', 'CREATE TABLE IF NOT EXISTS', $create_query);
        }

        // are there any constraints to cut out?

        if (preg_match('@CONSTRAINT|FOREIGN[\s]+KEY@', $create_query)) {
            // split the query into lines, so we can easilly handle it

            if (false === mb_strpos(",\r\n ", $create_query)) {
                $sql_lines = preg_preg_split('@\r|\n@', $create_query);
            } else {
                $sql_lines = preg_preg_split('@\r\n@', $create_query);
            }

            $sql_count = count($sql_lines);

            // lets find first line with constraints

            for ($i = 0; $i < $sql_count; $i++) {
                if (preg_match('@CONSTRAINT|FOREIGN[\s]+KEY@', $sql_lines[$i])) {
                    break;
                }
            }

            // remove , from the end of create statement

            $sql_lines[$i - 1] = preg_replace('@,$@', '', $sql_lines[$i - 1]);

            // prepare variable for constraints

            if (!isset($sql_constraints)) {
                if (isset($GLOBALS['no_constraints_comments'])) {
                    $sql_constraints = '';
                } else {
                    $sql_constraints = $crlf . $GLOBALS['comment_marker'] .
                                       $crlf . $GLOBALS['comment_marker'] . $GLOBALS['strConstraintsForDumped'] .
                                       $crlf . $GLOBALS['comment_marker'] . $crlf;
                }
            }

            // comments for current table

            if (!isset($GLOBALS['no_constraints_comments'])) {
                $sql_constraints .= $crlf . $GLOBALS['comment_marker'] .
                                    $crlf . $GLOBALS['comment_marker'] . $GLOBALS['strConstraintsForTable'] . ' ' . PMA_backquote($table) .
                                    $crlf . $GLOBALS['comment_marker'] . $crlf;
            }

            // let's do the work

            $sql_constraints .= 'ALTER TABLE ' . PMA_backquote($table) . $crlf;

            $first = true;

            for ($j = $i; $j < $sql_count; $j++) {
                if (preg_match('@CONSTRAINT|FOREIGN[\s]+KEY@', $sql_lines[$j])) {
                    if (!$first) {
                        $sql_constraints .= $crlf;
                    }

                    if (false === mb_strpos($sql_lines[$j], 'CONSTRAINT')) {
                        $sql_constraints .= preg_replace('/(FOREIGN[\s]+KEY)/', 'ADD \1', $sql_lines[$j]);
                    } else {
                        $sql_constraints .= preg_replace('/(CONSTRAINT)/', 'ADD \1', $sql_lines[$j]);
                    }

                    $first = false;
                } else {
                    break;
                }
            }

            $sql_constraints .= ';' . $crlf;

            $create_query = implode($crlf, array_slice($sql_lines, 0, $i)) . $crlf . implode($crlf, array_slice($sql_lines, $j, $sql_count - 1));

            unset($sql_lines);
        }

        $schema_create .= $create_query;
    }

    $schema_create .= $auto_increment;

    PMA_DBI_free_result($result);

    return $schema_create;
} // end of the 'PMA_getTableDef()' function

/**
 * Returns $table's comments, relations etc.
 *
 * @param mixed $db
 * @param mixed $table
 * @param mixed $crlf
 * @param mixed $do_relation
 * @param mixed $do_comments
 * @param mixed $do_mime
 *
 * @return  string   resulting comments
 */
function PMA_getTableComments($db, $table, $crlf, $do_relation = false, $do_comments = false, $do_mime = false)
{
    global $cfgRelation;

    global $use_backquotes;

    global $sql_constraints;

    $schema_create = '';

    if ($do_comments && $cfgRelation['commwork']) {
        if (!($comments_map = PMA_getComments($db, $table))) {
            unset($comments_map);
        }
    }

    // Check if we can use Relations (Mike Beck)

    if ($do_relation && !empty($cfgRelation['relation'])) {
        // Find which tables are related with the current one and write it in

        // an array

        $res_rel = PMA_getForeigners($db, $table);

        if ($res_rel && count($res_rel) > 0) {
            $have_rel = true;
        } else {
            $have_rel = false;
        }
    } else {
        $have_rel = false;
    } // end if

    if ($do_mime && $cfgRelation['mimework']) {
        if (!($mime_map = PMA_getMIME($db, $table, true))) {
            unset($mime_map);
        }
    }

    if (isset($comments_map) && count($comments_map) > 0) {
        $schema_create .= $crlf . $GLOBALS['comment_marker'] . $crlf
                       . $GLOBALS['comment_marker'] . $GLOBALS['strCommentsForTable'] . ' ' . PMA_backquote($table, $use_backquotes) . ':' . $crlf;

        foreach ($comments_map as $comment_field => $comment) {
            $schema_create .= $GLOBALS['comment_marker'] . '  ' . PMA_backquote($comment_field, $use_backquotes) . $crlf
                            . $GLOBALS['comment_marker'] . '      ' . PMA_backquote($comment, $use_backquotes) . $crlf;
        }

        $schema_create .= $GLOBALS['comment_marker'] . $crlf;
    }

    if (isset($mime_map) && count($mime_map) > 0) {
        $schema_create .= $crlf . $GLOBALS['comment_marker'] . $crlf
                       . $GLOBALS['comment_marker'] . $GLOBALS['strMIMETypesForTable'] . ' ' . PMA_backquote($table, $use_backquotes) . ':' . $crlf;

        @reset($mime_map);

        foreach ($mime_map as $mime_field => $mime) {
            $schema_create .= $GLOBALS['comment_marker'] . '  ' . PMA_backquote($mime_field, $use_backquotes) . $crlf
                            . $GLOBALS['comment_marker'] . '      ' . PMA_backquote($mime['mimetype'], $use_backquotes) . $crlf;
        }

        $schema_create .= $GLOBALS['comment_marker'] . $crlf;
    }

    if ($have_rel) {
        $schema_create .= $crlf . $GLOBALS['comment_marker'] . $crlf
                       . $GLOBALS['comment_marker'] . $GLOBALS['strRelationsForTable'] . ' ' . PMA_backquote($table, $use_backquotes) . ':' . $crlf;

        foreach ($res_rel as $rel_field => $rel) {
            $schema_create .= $GLOBALS['comment_marker'] . '  ' . PMA_backquote($rel_field, $use_backquotes) . $crlf
                            . $GLOBALS['comment_marker'] . '      ' . PMA_backquote($rel['foreign_table'], $use_backquotes)
                            . ' -> ' . PMA_backquote($rel['foreign_field'], $use_backquotes) . $crlf;
        }

        $schema_create .= $GLOBALS['comment_marker'] . $crlf;
    }

    return $schema_create;
} // end of the 'PMA_getTableComments()' function

/**
 * Outputs table's structure
 *
 * @param mixed $db
 * @param mixed $table
 * @param mixed $crlf
 * @param mixed $error_url
 * @param mixed $relation
 * @param mixed $comments
 * @param mixed $mime
 * @param mixed $dates
 *
 * @return  bool     Whether it suceeded
 */
function PMA_exportStructure($db, $table, $crlf, $error_url, $relation = false, $comments = false, $mime = false, $dates = false)
{
    $formatted_table_name = (isset($GLOBALS['use_backquotes'])) ? PMA_backquote($table) : '\'' . $table . '\'';

    $dump = $crlf
          . $GLOBALS['comment_marker'] . '--------------------------------------------------------' . $crlf
          . $crlf . $GLOBALS['comment_marker'] . $crlf
          . $GLOBALS['comment_marker'] . $GLOBALS['strTableStructure'] . ' ' . $formatted_table_name . $crlf
          . $GLOBALS['comment_marker'] . $crlf
          . PMA_getTableDef($db, $table, $crlf, $error_url, $dates) . ';' . $crlf
          . PMA_getTableComments($db, $table, $crlf, $relation, $comments, $mime);

    return PMA_exportOutputHandler($dump);
}

/**
 * Dispatches between the versions of 'getTableContent' to use depending
 * on the php version
 *
 * @param mixed $db
 * @param mixed $table
 * @param mixed $crlf
 * @param mixed $error_url
 * @param mixed $sql_query
 *
 * @return  bool        Whether it suceeded
 *
 * @global  bool  whether to use backquotes to allow the use of special
 *                   characters in database, table and fields names or not
 * @global  int  the number of records
 * @global  int  the current record position
 *
 * @see     PMA_getTableContentFast(), PMA_getTableContentOld()
 *
 * @author  staybyte
 */
function PMA_exportData($db, $table, $crlf, $error_url, $sql_query)
{
    global $use_backquotes;

    global $rows_cnt;

    global $current_row;

    $formatted_table_name = (isset($GLOBALS['use_backquotes'])) ? PMA_backquote($table) : '\'' . $table . '\'';

    $head = $crlf
          . $GLOBALS['comment_marker'] . $crlf
          . $GLOBALS['comment_marker'] . $GLOBALS['strDumpingData'] . ' ' . $formatted_table_name . $crlf
          . $GLOBALS['comment_marker'] . $crlf . $crlf;

    if (!PMA_exportOutputHandler($head)) {
        return false;
    }

    $buffer = '';

    // analyze the query to get the true column names, not the aliases

    // (this fixes an undefined index, also if Complete inserts

    //  are used, we did not get the true column name in case of aliases)

    $analyzed_sql = PMA_SQP_analyze(PMA_SQP_parse($sql_query));

    $result = PMA_DBI_query($sql_query, null, PMA_DBI_QUERY_UNBUFFERED);

    if (false !== $result) {
        $fields_cnt = PMA_DBI_num_fields($result);

        // Get field information

        $fields_meta = PMA_DBI_get_fields_meta($result);

        $field_flags = [];

        for ($j = 0; $j < $fields_cnt; $j++) {
            $field_flags[$j] = PMA_DBI_field_flags($result, $j);
        }

        for ($j = 0; $j < $fields_cnt; $j++) {
            if (isset($analyzed_sql[0]['select_expr'][$j]['column'])) {
                $field_set[$j] = PMA_backquote($analyzed_sql[0]['select_expr'][$j]['column'], $use_backquotes);
            } else {
                $field_set[$j] = PMA_backquote($fields_meta[$j]->name, $use_backquotes);
            }
        }

        if (isset($GLOBALS['sql_type']) && 'update' == $GLOBALS['sql_type']) {
            // update

            $schema_insert = 'UPDATE ';

            if (isset($GLOBALS['sql_ignore'])) {
                $schema_insert .= 'IGNORE ';
            }

            $schema_insert .= PMA_backquote($table, $use_backquotes) . ' SET ';
        } else {
            // insert or replace

            if (isset($GLOBALS['sql_type']) && 'replace' == $GLOBALS['sql_type']) {
                $sql_command = 'REPLACE';
            } else {
                $sql_command = 'INSERT';
            }

            // delayed inserts?

            if (isset($GLOBALS['delayed'])) {
                $insert_delayed = ' DELAYED';
            } else {
                $insert_delayed = '';
            }

            // insert ignore?

            if (isset($GLOBALS['sql_type']) && 'insert' == $GLOBALS['sql_type'] && isset($GLOBALS['sql_ignore'])) {
                $insert_delayed .= ' IGNORE';
            }

            // scheme for inserting fields

            if (isset($GLOBALS['showcolumns'])) {
                $fields = implode(', ', $field_set);

                $schema_insert = $sql_command . $insert_delayed . ' INTO ' . PMA_backquote($table, $use_backquotes)
                               . ' (' . $fields . ') VALUES (';
            } else {
                $schema_insert = $sql_command . $insert_delayed . ' INTO ' . PMA_backquote($table, $use_backquotes)
                               . ' VALUES (';
            }
        }

        $search = ["\x00", "\x0a", "\x0d", "\x1a"]; //\x08\\x09, not required

        $replace = ['\0', '\n', '\r', '\Z'];

        $current_row = 0;

        $separator = isset($GLOBALS['extended_ins']) ? ',' : ';';

        while (false !== ($row = PMA_DBI_fetch_row($result))) {
            $current_row++;

            for ($j = 0; $j < $fields_cnt; $j++) {
                // NULL

                if (!isset($row[$j]) || null === $row[$j]) {
                    $values[] = 'NULL';

                // a number
                } elseif ($fields_meta[$j]->numeric) {
                    $values[] = $row[$j];

                // a binary field
                // Note: with mysqli, under MySQL 4.1.3, we get the flag
                // "binary" for a datetime (I don't know why)
                } else {
                    if (mb_stristr($field_flags[$j], 'BINARY') && isset($GLOBALS['hexforbinary']) && 'datetime' != $fields_meta[$j]->type) {
                        $values[] = '0x' . bin2hex($row[$j]);

                    // something else -> treat as a string
                    } else {
                        $values[] = '\'' . str_replace($search, $replace, PMA_sqlAddslashes($row[$j])) . '\'';
                    }
                } // end if
            } // end for

            // should we make update?

            if (isset($GLOBALS['sql_type']) && 'update' == $GLOBALS['sql_type']) {
                $insert_line = $schema_insert;

                for ($i = 0; $i < $fields_cnt; $i++) {
                    if ($i > 0) {
                        $insert_line .= ', ';
                    }

                    $insert_line .= $field_set[$i] . ' = ' . $values[$i];
                }

                $insert_line .= ' WHERE ' . PMA_getUvaCondition($result, $fields_cnt, $fields_meta, $row);
            } else {
                // Extended inserts case

                if (isset($GLOBALS['extended_ins'])) {
                    if (1 == $current_row) {
                        $insert_line = $schema_insert . implode(', ', $values) . ')';
                    } else {
                        $insert_line = '(' . implode(', ', $values) . ')';
                    }
                }

                // Other inserts case

                else {
                    $insert_line = $schema_insert . implode(', ', $values) . ')';
                }
            }

            unset($values);

            if (!PMA_exportOutputHandler((1 == $current_row ? '' : $separator . $crlf) . $insert_line)) {
                return false;
            }
        } // end while

        if ($current_row > 0) {
            if (!PMA_exportOutputHandler(';' . $crlf)) {
                return false;
            }
        }
    } // end if ($result !== false)

    PMA_DBI_free_result($result);

    return true;
} // end of the 'PMA_exportData()' function
