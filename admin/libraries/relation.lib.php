<?php

/* $Id: relation.lib.php,v 2.18 2004/08/01 16:44:04 lem9 Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:
error_reporting(E_ALL);
 /**
  * Set of functions used with the relation and pdf feature
  * @param mixed $sql
  * @param mixed $show_error
  * @param mixed $options
  */

/**
 * Executes a query as controluser if possible, otherwise as normal user
 *
 * @param string $sql        the query to execute
 * @param bool   $show_error whether to display SQL error messages or not
 *
 * @param int    $options
 * @return  int   the result id
 *
 * @global  string    the URL of the page to show in case of error
 * @global  string    the name of db to come back to
 * @global  resource  the resource id of DB connect as controluser
 * @global  array     configuration infos about the relations stuff
 *
 * @author  Mike Beck <mikebeck@users.sourceforge.net>
 */
 function PMA_query_as_cu($sql, $show_error = true, $options = 0)
 {
     global $err_url_0, $db, $dbh, $cfgRelation;

     PMA_DBI_select_db($cfgRelation['db'], $dbh);

     if ($show_error) {
         $result = PMA_DBI_query($sql, $dbh, $options);
     } else {
         $result = @PMA_DBI_try_query($sql, $dbh, $options);
     } // end if... else...

     PMA_DBI_select_db($db, $dbh);

     if ($result) {
         return $result;
     }

     return false;
 } // end of the "PMA_query_as_cu()" function

/**
 * Defines the relation parameters for the current user
 * just a copy of the functions used for relations ;-)
 * but added some stuff to check what will work
 *
 * @param mixed $verbose
 *
 * @return  array    the relation parameters for the current user
 *
 * @global  array    the list of settings for servers
 * @global  int  the id of the current server
 * @global  string   the URL of the page to show in case of error
 * @global  string   the name of the current db
 * @global  string   the name of the current table
 * @global  array    configuration infos about the relations stuff
 *
 * @author  Mike Beck <mikebeck@users.sourceforge.net>
 */
function PMA_getRelationsParam($verbose = false)
{
    global $cfg, $server, $err_url_0, $db, $table;

    global $cfgRelation;

    $cfgRelation = [];

    $cfgRelation['relwork'] = false;

    $cfgRelation['displaywork'] = false;

    $cfgRelation['bookmarkwork'] = false;

    $cfgRelation['pdfwork'] = false;

    $cfgRelation['commwork'] = false;

    $cfgRelation['mimework'] = false;

    $cfgRelation['historywork'] = false;

    $cfgRelation['allworks'] = false;

    // No server selected -> no bookmark table

    // we return the array with the FALSEs in it,

    // to avoid some 'Unitialized string offset' errors later

    if (0 == $server
       || empty($cfg['Server'])
       || empty($cfg['Server']['pmadb'])) {
        if (true === $verbose) {
            echo 'PMA Database ... '
                 . '<font color="red"><b>' . $GLOBALS['strNotOK'] . '</b></font>'
                 . '[ <a href="Documentation.html#pmadb">' . $GLOBALS['strDocu'] . '</a> ]<br>' . "\n"
                 . $GLOBALS['strGeneralRelationFeat']
                 . ' <font color="green">' . $GLOBALS['strDisabled'] . '</font>' . "\n";
        }

        return $cfgRelation;
    }

    $cfgRelation['user'] = $cfg['Server']['user'];

    $cfgRelation['db'] = $cfg['Server']['pmadb'];

    //  Now I just check if all tables that i need are present so I can for

    //  example enable relations but not pdf...

    //  I was thinking of checking if they have all required columns but I

    //  fear it might be too slow

    // PMA_DBI_select_db($cfgRelation['db']);

    $tab_query = 'SHOW TABLES FROM ' . PMA_backquote($cfgRelation['db']);

    $tab_rs = PMA_query_as_cu($tab_query, false, PMA_DBI_QUERY_STORE);

    if ($tab_rs) {
        while (false !== ($curr_table = @PMA_DBI_fetch_row($tab_rs))) {
            if ($curr_table[0] == $cfg['Server']['bookmarktable']) {
                $cfgRelation['bookmark'] = $curr_table[0];
            } else {
                if ($curr_table[0] == $cfg['Server']['relation']) {
                    $cfgRelation['relation'] = $curr_table[0];
                } else {
                    if ($curr_table[0] == $cfg['Server']['table_info']) {
                        $cfgRelation['table_info'] = $curr_table[0];
                    } else {
                        if ($curr_table[0] == $cfg['Server']['table_coords']) {
                            $cfgRelation['table_coords'] = $curr_table[0];
                        } else {
                            if ($curr_table[0] == $cfg['Server']['column_info']) {
                                $cfgRelation['column_info'] = $curr_table[0];
                            } else {
                                if ($curr_table[0] == $cfg['Server']['pdf_pages']) {
                                    $cfgRelation['pdf_pages'] = $curr_table[0];
                                } else {
                                    if ($curr_table[0] == $cfg['Server']['history']) {
                                        $cfgRelation['history'] = $curr_table[0];
                                    }
                                }
                            }
                        }
                    }
                }
            }
        } // end while
    }

    if (isset($cfgRelation['relation'])) {
        $cfgRelation['relwork'] = true;

        if (isset($cfgRelation['table_info'])) {
            $cfgRelation['displaywork'] = true;
        }
    }

    if (isset($cfgRelation['table_coords']) && isset($cfgRelation['pdf_pages'])) {
        $cfgRelation['pdfwork'] = true;
    }

    if (isset($cfgRelation['column_info'])) {
        $cfgRelation['commwork'] = true;

        if ($cfg['Server']['verbose_check']) {
            $mime_query = 'SHOW FIELDS FROM ' . PMA_backquote($cfgRelation['db']) . '.' . PMA_backquote($cfgRelation['column_info']);

            $mime_rs = PMA_query_as_cu($mime_query, false);

            $mime_field_mimetype = false;

            $mime_field_transformation = false;

            $mime_field_transformation_options = false;

            while (false !== ($curr_mime_field = @PMA_DBI_fetch_row($mime_rs))) {
                if ('mimetype' == $curr_mime_field[0]) {
                    $mime_field_mimetype = true;
                } else {
                    if ('transformation' == $curr_mime_field[0]) {
                        $mime_field_transformation = true;
                    } else {
                        if ('transformation_options' == $curr_mime_field[0]) {
                            $mime_field_transformation_options = true;
                        }
                    }
                }
            }

            if (true === $mime_field_mimetype
                && true === $mime_field_transformation
                && true === $mime_field_transformation_options) {
                $cfgRelation['mimework'] = true;
            }
        } else {
            $cfgRelation['mimework'] = true;
        }
    }

    if (isset($cfgRelation['history'])) {
        $cfgRelation['historywork'] = true;
    }

    if (isset($cfgRelation['bookmark'])) {
        $cfgRelation['bookmarkwork'] = true;
    }

    if (true === $cfgRelation['relwork'] && true === $cfgRelation['displaywork']
        && true === $cfgRelation['pdfwork'] && true === $cfgRelation['commwork'] && true === $cfgRelation['mimework'] && true === $cfgRelation['historywork']
        && true === $cfgRelation['bookmarkwork']) {
        $cfgRelation['allworks'] = true;
    }

    if ($tab_rs) {
        PMA_DBI_free_result($tab_rs);
    } else {
        $cfg['Server']['pmadb'] = false;
    }

    if (true === $verbose) {
        $shit = '<font color="red"><b>' . $GLOBALS['strNotOK'] . '</b></font> [ <a href="Documentation.html#%s">' . $GLOBALS['strDocu'] . '</a> ]';

        $hit = '<font color="green"><b>' . $GLOBALS['strOK'] . '</b></font>';

        $enabled = '<font color="green">' . $GLOBALS['strEnabled'] . '</font>';

        $disabled = '<font color="red">' . $GLOBALS['strDisabled'] . '</font>';

        echo '<table>' . "\n";

        echo '    <tr><th align="left">$cfg[\'Servers\'][$i][\'pmadb\'] ... </th><td align="right">'
             . ((false === $cfg['Server']['pmadb']) ? sprintf($shit, 'pmadb') : $hit)
             . '</td></tr>' . "\n";

        echo '    <tr><td>&nbsp;</td></tr>' . "\n";

        echo '    <tr><th align="left">$cfg[\'Servers\'][$i][\'relation\'] ... </th><td align="right">'
             . ((isset($cfgRelation['relation'])) ? $hit : sprintf($shit, 'relation'))
             . '</td></tr>' . "\n";

        echo '    <tr><td colspan=2 align="center">' . $GLOBALS['strGeneralRelationFeat'] . ': '
             . ((true === $cfgRelation['relwork']) ? $enabled : $disabled)
             . '</td></tr>' . "\n";

        echo '    <tr><td>&nbsp;</td></tr>' . "\n";

        echo '    <tr><th align="left">$cfg[\'Servers\'][$i][\'table_info\']   ... </th><td align="right">'
             . ((false === $cfgRelation['displaywork']) ? sprintf($shit, 'table_info') : $hit)
             . '</td></tr>' . "\n";

        echo '    <tr><td colspan=2 align="center">' . $GLOBALS['strDisplayFeat'] . ': '
             . ((true === $cfgRelation['displaywork']) ? $enabled : $disabled)
             . '</td></tr>' . "\n";

        echo '    <tr><td>&nbsp;</td></tr>' . "\n";

        echo '    <tr><th align="left">$cfg[\'Servers\'][$i][\'table_coords\'] ... </th><td align="right">'
             . ((isset($cfgRelation['table_coords'])) ? $hit : sprintf($shit, 'table_coords'))
             . '</td></tr>' . "\n";

        echo '    <tr><th align="left">$cfg[\'Servers\'][$i][\'pdf_pages\'] ... </th><td align="right">'
             . ((isset($cfgRelation['pdf_pages'])) ? $hit : sprintf($shit, 'table_coords'))
             . '</td></tr>' . "\n";

        echo '    <tr><td colspan=2 align="center">' . $GLOBALS['strCreatePdfFeat'] . ': '
             . ((true === $cfgRelation['pdfwork']) ? $enabled : $disabled)
             . '</td></tr>' . "\n";

        echo '    <tr><td>&nbsp;</td></tr>' . "\n";

        echo '    <tr><th align="left">$cfg[\'Servers\'][$i][\'column_info\'] ... </th><td align="right">'
             . ((isset($cfgRelation['column_info'])) ? $hit : sprintf($shit, 'col_com'))
             . '</td></tr>' . "\n";

        echo '    <tr><td colspan=2 align="center">' . $GLOBALS['strColComFeat'] . ': '
             . ((true === $cfgRelation['commwork']) ? $enabled : $disabled)
             . '</td></tr>' . "\n";

        echo '    <tr><td colspan=2 align="center">' . $GLOBALS['strBookmarkQuery'] . ': '
             . ((true === $cfgRelation['bookmarkwork']) ? $enabled : $disabled)
             . '</td></tr>' . "\n";

        echo '    <tr><th align="left">MIME ...</th><td align="right">'
             . ((true === $cfgRelation['mimework']) ? $hit : sprintf($shit, 'col_com'))
             . '</td></tr>' . "\n";

        if ((true === $cfgRelation['commwork']) && (true !== $cfgRelation['mimework'])) {
            echo '<tr><td colspan=2 align="left">' . $GLOBALS['strUpdComTab'] . '</td></tr>' . "\n";
        }

        echo '    <tr><th align="left">$cfg[\'Servers\'][$i][\'history\'] ... </th><td align="right">'
             . ((isset($cfgRelation['history'])) ? $hit : sprintf($shit, 'history'))
             . '</td></tr>' . "\n";

        echo '    <tr><td colspan=2 align="center">' . $GLOBALS['strQuerySQLHistory'] . ': '
             . ((true === $cfgRelation['historywork']) ? $enabled : $disabled)
             . '</td></tr>' . "\n";

        echo '</table>' . "\n";
    } // end if ($verbose === true) {

    return $cfgRelation;
} // end of the 'PMA_getRelationsParam()' function

/**
 * Gets all Relations to foreign tables for a given table or
 * optionally a given column in a table
 *
 * @param mixed $db
 * @param mixed $table
 * @param mixed $column
 * @param mixed $source
 *
 * @return  array    db,table,column
 *
 * @global  array    the list of relations settings
 * @global  string   the URL of the page to show in case of error
 *
 * @author  Mike Beck <mikebeck@users.sourceforge.net> and Marc Delisle
 */
function PMA_getForeigners($db, $table, $column = '', $source = 'both')
{
    global $cfgRelation, $err_url_0;

    if ($cfgRelation['relwork'] && ('both' == $source || 'internal' == $source)) {
        $rel_query = 'SELECT master_field, foreign_db, foreign_table, foreign_field'
                       . ' FROM ' . PMA_backquote($cfgRelation['relation'])
                       . ' WHERE master_db =  \'' . PMA_sqlAddslashes($db) . '\' '
                       . ' AND   master_table = \'' . PMA_sqlAddslashes($table) . '\' ';

        if (!empty($column)) {
            $rel_query .= ' AND master_field = \'' . PMA_sqlAddslashes($column) . '\'';
        }

        $relations = PMA_query_as_cu($rel_query);

        $i = 0;

        while (false !== ($relrow = @PMA_DBI_fetch_assoc($relations))) {
            $field = $relrow['master_field'];

            $foreign[$field]['foreign_db'] = $relrow['foreign_db'];

            $foreign[$field]['foreign_table'] = $relrow['foreign_table'];

            $foreign[$field]['foreign_field'] = $relrow['foreign_field'];

            $i++;
        } // end while

        PMA_DBI_free_result($relations);

        unset($relations);
    }

    if (('both' == $source || 'innodb' == $source) && !empty($table)) {
        $show_create_table_query = 'SHOW CREATE TABLE '
            . PMA_backquote($db) . '.' . PMA_backquote($table);

        $show_create_table_res = PMA_DBI_query($show_create_table_query);

        [, $show_create_table] = PMA_DBI_fetch_row($show_create_table_res);

        PMA_DBI_free_result($show_create_table_res);

        unset($show_create_table_res);

        $analyzed_sql = PMA_SQP_analyze(PMA_SQP_parse($show_create_table));

        foreach ($analyzed_sql[0]['foreign_keys'] as $one_key) {
            // the analyzer may return more than one column name in the

            // index list or the ref_index_list

            foreach ($one_key['index_list'] as $i => $field) {
                // If a foreign key is defined in the 'internal' source (pmadb)

                // and in 'innodb', we won't get it twice if $source='both'

                // because we use $field as key

                // The parser looks for a CONSTRAINT clause just before

                // the FOREIGN KEY clause. It finds it (as output from

                // SHOW CREATE TABLE) in MySQL 4.0.13, but not in older

                // versions like 3.23.58.

                // In those cases, the FOREIGN KEY parsing will put numbers

                // like -1, 0, 1... instead of the constraint number.

                if (isset($one_key['constraint'])) {
                    $foreign[$field]['constraint'] = $one_key['constraint'];
                }

                if (isset($one_key['ref_db_name'])) {
                    $foreign[$field]['foreign_db'] = $one_key['ref_db_name'];
                } else {
                    $foreign[$field]['foreign_db'] = $db;
                }

                $foreign[$field]['foreign_table'] = $one_key['ref_table_name'];

                $foreign[$field]['foreign_field'] = $one_key['ref_index_list'][$i];

                if (isset($one_key['on_delete'])) {
                    $foreign[$field]['on_delete'] = $one_key['on_delete'];
                }

                if (isset($one_key['on_update'])) {
                    $foreign[$field]['on_update'] = $one_key['on_update'];
                }
            }
        }
    }

    if (isset($foreign) && is_array($foreign)) {
        return $foreign;
    }

    return false;
} // end of the 'PMA_getForeigners()' function

/**
 * Gets the display field of a table
 *
 * @param mixed $db
 * @param mixed $table
 *
 * @return  string   field name
 *
 * @global  array    the list of relations settings
 *
 * @author  Mike Beck <mikebeck@users.sourceforge.net>
 */
function PMA_getDisplayField($db, $table)
{
    global $cfgRelation;

    if ('' == trim(@$cfgRelation['table_info'])) {
        return false;
    }

    $disp_query = 'SELECT display_field FROM ' . PMA_backquote($cfgRelation['table_info'])
                . ' WHERE db_name  = \'' . PMA_sqlAddslashes($db) . '\''
                . ' AND table_name = \'' . PMA_sqlAddslashes($table) . '\'';

    $disp_res = PMA_query_as_cu($disp_query);

    $row = ($disp_res ? PMA_DBI_fetch_assoc($disp_res) : '');

    PMA_DBI_free_result($disp_res);

    return $row['display_field'] ?? false;
} // end of the 'PMA_getDisplayField()' function

/**
 * Gets the comments for all rows of a table
 *
 * @param mixed $db
 * @param mixed $table
 *
 * @return  array    [field_name] = comment
 *
 * @global  array    the list of relations settings
 *
 * @author  Mike Beck <mikebeck@users.sourceforge.net>
 */
function PMA_getComments($db, $table = '')
{
    global $cfgRelation;

    if ('' != $table) {
        $com_qry = 'SELECT column_name, ' . PMA_backquote('comment') . ' FROM ' . PMA_backquote($cfgRelation['column_info'])
                  . ' WHERE db_name = \'' . PMA_sqlAddslashes($db) . '\''
                  . ' AND table_name = \'' . PMA_sqlAddslashes($table) . '\'';

        $com_rs = PMA_query_as_cu($com_qry, true);
    } else {
        $com_qry = 'SELECT comment FROM ' . PMA_backquote($cfgRelation['column_info'])
                  . ' WHERE db_name = \'' . PMA_sqlAddslashes($db) . '\''
                  . ' AND table_name = \'\''
                  . ' AND column_name = \'(db_comment)\'';

        $com_rs = PMA_query_as_cu($com_qry, true);
    }

    $i = 0;

    while (false !== ($row = PMA_DBI_fetch_assoc($com_rs))) {
        $i++;

        $col = ('' != $table ? $row['column_name'] : $i);

        if (mb_strlen($row['comment']) > 0) {
            $comment[$col] = $row['comment'];
        }
    } // end while

    PMA_DBI_free_result($com_rs);

    if (isset($comment) && is_array($comment)) {
        return $comment;
    }

    return false;
} // end of the 'PMA_getComments()' function

/**
 * Adds/removes slashes if required
 *
 * @param mixed $val
 *
 * @return  string  the slashed string
 */
function PMA_handleSlashes($val)
{
    return (get_magic_quotes_gpc() ? str_replace('\\"', '"', $val) : PMA_sqlAddslashes($val));
} // end of the "PMA_handleSlashes()" function

/**
 * Set a single comment to a certain value.
 *
 * @param mixed $db
 * @param mixed $table
 * @param mixed $key
 * @param mixed $value
 * @param mixed $removekey
 *
 * @return  bool  true, if comment-query was made.
 *
 * @global  array    the list of relations settings
 */
function PMA_setComment($db, $table, $key, $value, $removekey = '')
{
    global $cfgRelation;

    if ('' != $removekey and $removekey != $key) {
        $remove_query = 'DELETE FROM ' . PMA_backquote($cfgRelation['column_info'])
                    . ' WHERE db_name  = \'' . PMA_sqlAddslashes($db) . '\''
                    . ' AND table_name = \'' . PMA_sqlAddslashes($table) . '\''
                    . ' AND column_name = \'' . PMA_sqlAddslashes($removekey) . '\'';

        $rmv_rs = PMA_query_as_cu($remove_query);

        unset($rmv_query);
    }

    $test_qry = 'SELECT ' . PMA_backquote('comment') . ', mimetype, transformation, transformation_options FROM ' . PMA_backquote($cfgRelation['column_info'])
                . ' WHERE db_name = \'' . PMA_sqlAddslashes($db) . '\''
                . ' AND table_name = \'' . PMA_sqlAddslashes($table) . '\''
                . ' AND column_name = \'' . PMA_sqlAddslashes($key) . '\'';

    $test_rs = PMA_query_as_cu($test_qry, true, PMA_DBI_QUERY_STORE);

    if ($test_rs && PMA_DBI_num_rows($test_rs) > 0) {
        $row = PMA_DBI_fetch_assoc($test_rs);

        PMA_DBI_free_result($res);

        if (mb_strlen($value) > 0 || mb_strlen($row['mimetype']) > 0 || mb_strlen($row['transformation']) > 0 || mb_strlen($row['transformation_options']) > 0) {
            $upd_query = 'UPDATE ' . PMA_backquote($cfgRelation['column_info'])
                   . ' SET ' . PMA_backquote('comment') . ' = \'' . PMA_sqlAddslashes($value) . '\''
                   . ' WHERE db_name  = \'' . PMA_sqlAddslashes($db) . '\''
                   . ' AND table_name = \'' . PMA_sqlAddslashes($table) . '\''
                   . ' AND column_name = \'' . PMA_sqlAddSlashes($key) . '\'';
        } else {
            $upd_query = 'DELETE FROM ' . PMA_backquote($cfgRelation['column_info'])
                   . ' WHERE db_name  = \'' . PMA_sqlAddslashes($db) . '\''
                   . ' AND table_name = \'' . PMA_sqlAddslashes($table) . '\''
                   . ' AND column_name = \'' . PMA_sqlAddslashes($key) . '\'';
        }
    } else {
        if (mb_strlen($value) > 0) {
            $upd_query = 'INSERT INTO ' . PMA_backquote($cfgRelation['column_info'])
                   . ' (db_name, table_name, column_name, ' . PMA_backquote('comment') . ') '
                   . ' VALUES('
                   . '\'' . PMA_sqlAddslashes($db) . '\','
                   . '\'' . PMA_sqlAddslashes($table) . '\','
                   . '\'' . PMA_sqlAddslashes($key) . '\','
                   . '\'' . PMA_sqlAddslashes($value) . '\')';
        }
    }

    if (isset($upd_query)) {
        $upd_rs = PMA_query_as_cu($upd_query);

        unset($upd_query);

        return true;
    }

    return false;
} // end of 'PMA_setComment()' function

/**
 * Set a SQL history entry
 *
 * @param mixed $db
 * @param mixed $table
 * @param mixed $username
 * @param mixed $sqlquery
 *
 * @return  bool  true
 */
function PMA_setHistory($db, $table, $username, $sqlquery)
{
    global $cfgRelation;

    $hist_rs = PMA_query_as_cu('INSERT INTO ' . PMA_backquote($cfgRelation['history']) . ' ('
                . PMA_backquote('username') . ','
                . PMA_backquote('db') . ','
                . PMA_backquote('table') . ','
                . PMA_backquote('timevalue') . ','
                . PMA_backquote('sqlquery')
                . ') VALUES ('
                . '\'' . PMA_sqlAddslashes($username) . '\','
                . '\'' . PMA_sqlAddslashes($db) . '\','
                . '\'' . PMA_sqlAddslashes($table) . '\','
                . 'NOW(),'
                . '\'' . PMA_sqlAddslashes($sqlquery) . '\')');

    return true;
} // end of 'PMA_setHistory()' function

/**
 * Gets a SQL history entry
 *
 * @param mixed $username
 *
 * @return  array    list of history items
 */
function PMA_getHistory($username)
{
    global $cfgRelation;

    $hist_rs = PMA_query_as_cu('SELECT '
                    . PMA_backquote('db') . ','
                    . PMA_backquote('table') . ','
                    . PMA_backquote('sqlquery')
                    . ' FROM ' . PMA_backquote($cfgRelation['history']) . ' WHERE username = \'' . PMA_sqlAddslashes($username) . '\' ORDER BY id DESC');

    $history = [];

    while (false !== ($row = PMA_DBI_fetch_assoc($hist_rs))) {
        $history[] = $row;
    }

    PMA_DBI_free_result($hist_rs);

    return $history;
} // end of 'PMA_getHistory()' function

/**
 * Set a SQL history entry
 *
 * @param mixed $username
 *
 * @return  bool  true
 */
function PMA_purgeHistory($username)
{
    global $cfgRelation, $cfg;

    $purge_rs = PMA_query_as_cu('SELECT timevalue FROM ' . PMA_backquote($cfgRelation['history']) . ' WHERE username = \'' . PMA_sqlAddSlashes($username) . '\' ORDER BY timevalue DESC LIMIT ' . $cfg['QueryHistoryMax'] . ', 1');

    $i = 0;

    $row = PMA_DBI_fetch_row($purge_rs);

    PMA_DBI_free_result($purge_rs);

    if (is_array($row) && isset($row[0]) && $row[0] > 0) {
        $maxtime = $row[0];

        // quotes added around $maxtime to prevent a difficult to

        // reproduce problem

        $remove_rs = PMA_query_as_cu('DELETE FROM ' . PMA_backquote($cfgRelation['history']) . ' WHERE timevalue <= "' . $maxtime . '"');
    }

    return true;
} // end of 'PMA_purgeHistory()' function

/**
 * Outputs dropdown with values of foreign fields
 *
 * @param mixed $disp
 * @param mixed $foreign_field
 * @param mixed $foreign_display
 * @param mixed $data
 * @param mixed $max
 *
 * @return  string   the <option value=""><option>s
 */
function PMA_foreignDropdown($disp, $foreign_field, $foreign_display, $data, $max = 100)
{
    global $cfg;

    $ret = '<option value=""></option>' . "\n";

    $reloptions = ['content-id' => [], 'id-content' => []];

    foreach ($disp as $disp_key => $relrow) {
        $key = $relrow[$foreign_field];

        if (PMA_strlen($relrow[$foreign_display]) <= $cfg['LimitChars']) {
            $value = ((false !== $foreign_display) ? htmlspecialchars($relrow[$foreign_display], ENT_QUOTES | ENT_HTML5) : '');

            $vtitle = '';
        } else {
            $vtitle = htmlspecialchars($relrow[$foreign_display], ENT_QUOTES | ENT_HTML5);

            $value = ((false !== $foreign_display) ? htmlspecialchars(mb_substr($vtitle, 0, $cfg['LimitChars']) . '...', ENT_QUOTES | ENT_HTML5) : '');
        }

        $reloption = '<option value="' . htmlspecialchars($key, ENT_QUOTES | ENT_HTML5) . '"';

        if ('' != $vtitle) {
            $reloption .= ' title="' . $vtitle . '"';
        }

        if ($key == $data) {
            $reloption .= ' selected="selected"';
        } // end if

        $reloptions['id-content'][] = $reloption . '>' . $value . '&nbsp;-&nbsp;' . htmlspecialchars($key, ENT_QUOTES | ENT_HTML5) . '</option>' . "\n";

        $reloptions['content-id'][] = $reloption . '>' . htmlspecialchars($key, ENT_QUOTES | ENT_HTML5) . '&nbsp;-&nbsp;' . $value . '</option>' . "\n";
    } // end while

    if (-1 == $max || count($reloptions['content-id']) < $max) {
        $ret .= implode('', $reloptions['content-id']);

        if (count($reloptions['content-id']) > 0) {
            $ret .= '<option value=""></option>' . "\n";

            $ret .= '<option value=""></option>' . "\n";
        }
    }

    $ret .= implode('', $reloptions['id-content']);

    return $ret;
} // end of 'PMA_foreignDropdown()' function
