<?php

/* $Id: bookmark.lib.php,v 2.6 2004/03/25 10:25:22 nijel Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:

/**
 * Set of functions used with the bookmark feature
 */

/**
 * Defines the bookmark parameters for the current user
 *
 * @return string the bookmark parameters for the current user
 *
 * @global  int  the id of the current server
 */
function PMA_getBookmarksParam()
{
    global $server;

    $cfgBookmark = '';

    // No server selected -> no bookmark table

    if (0 == $server) {
        return '';
    }

    $cfgBookmark['user'] = $GLOBALS['cfg']['Server']['user'];

    $cfgBookmark['db'] = $GLOBALS['cfg']['Server']['pmadb'];

    $cfgBookmark['table'] = $GLOBALS['cfg']['Server']['bookmarktable'];

    return $cfgBookmark;
} // end of the 'PMA_getBookmarksParam()' function

/**
 * Gets the list of bookmarks defined for the current database
 *
 * @param mixed $db
 * @param mixed $cfgBookmark
 *
 * @return  mixed     the bookmarks list if defined, false else
 * @global  resource  the controluser db connection handle
 *
 */
function PMA_listBookmarks($db, $cfgBookmark)
{
    global $dbh;

    $query = 'SELECT label, id FROM ' . PMA_backquote($cfgBookmark['db']) . '.' . PMA_backquote($cfgBookmark['table'])
            . ' WHERE dbase = \'' . PMA_sqlAddslashes($db) . '\''
            . ' AND (user = \'' . PMA_sqlAddslashes($cfgBookmark['user']) . '\''
            . '      OR user = \'\')';

    $result = PMA_DBI_query($query, $dbh);

    // There is some bookmarks -> store them

    if ($result > 0 && PMA_DBI_num_rows($result) > 0) {
        $flag = 1;

        while (false !== ($row = PMA_DBI_fetch_row($result))) {
            $bookmark_list[$flag . ' - ' . $row[0]] = $row[1];

            $flag++;
        } // end while

        return $bookmark_list;
    }

    // No bookmarks for the current database

    return false;
} // end of the 'PMA_listBookmarks()' function

/**
 * Gets the sql command from a bookmark
 *
 * @param mixed $db
 * @param mixed $cfgBookmark
 * @param       $id
 * @param mixed $id_field
 * @param mixed $action_bookmark_all
 *
 * @return  string    the sql query
 * @global  resource  the controluser db connection handle
 *
 */
function PMA_queryBookmarks($db, $cfgBookmark, $id, $id_field = 'id', $action_bookmark_all = false)
{
    global $dbh;

    if (empty($cfgBookmark['db']) || empty($cfgBookmark['table'])) {
        return '';
    }

    $query = 'SELECT query FROM ' . PMA_backquote($cfgBookmark['db']) . '.' . PMA_backquote($cfgBookmark['table'])
                    . ' WHERE dbase = \'' . PMA_sqlAddslashes($db) . '\''
                    . ($action_bookmark_all ? '' : ' AND (user = \'' . PMA_sqlAddslashes($cfgBookmark['user']) . '\''
                    . '      OR user = \'\')')
                    . ' AND ' . PMA_backquote($id_field) . ' = ' . $id;

    $result = PMA_DBI_try_query($query, $dbh);

    if (!$result) {
        return false;
    }

    list($bookmark_query) = PMA_DBI_fetch_row($result) or [false];

    return $bookmark_query;
} // end of the 'PMA_queryBookmarks()' function

/**
 * Adds a bookmark
 *
 * @param mixed $fields
 * @param mixed $cfgBookmark
 * @param mixed $all_users
 *
 * @return  bool   whether the INSERT succeeds or not
 * @global  resource  the controluser db connection handle
 *
 */
function PMA_addBookmarks($fields, $cfgBookmark, $all_users = false)
{
    global $dbh;

    $query = 'INSERT INTO ' . PMA_backquote($cfgBookmark['db']) . '.' . PMA_backquote($cfgBookmark['table'])
           . ' (id, dbase, user, query, label) VALUES (\'\', \'' . PMA_sqlAddslashes($fields['dbase']) . '\', \'' . ($all_users ? '' : PMA_sqlAddslashes($fields['user'])) . '\', \'' . PMA_sqlAddslashes(urldecode($fields['query'])) . '\', \'' . PMA_sqlAddslashes($fields['label']) . '\')';

    $result = PMA_DBI_query($query, $dbh);

    return true;
} // end of the 'PMA_addBookmarks()' function

/**
 * Deletes a bookmark
 *
 * @param mixed $db
 * @param mixed $cfgBookmark
 * @param mixed $id
 * @global  resource  the controluser db connection handle
 *
 */
function PMA_deleteBookmarks($db, $cfgBookmark, $id)
{
    global $dbh;

    $query = 'DELETE FROM ' . PMA_backquote($cfgBookmark['db']) . '.' . PMA_backquote($cfgBookmark['table'])
            . ' WHERE (user = \'' . PMA_sqlAddslashes($cfgBookmark['user']) . '\''
            . '        OR user = \'\')'
            . ' AND id = ' . $id;

    $result = PMA_DBI_try_query($query, $dbh);
} // end of the 'PMA_deleteBookmarks()' function

/**
 * Bookmark Support
 */
$cfg['Bookmark'] = PMA_getBookmarksParam();
