<?php

/* $Id: transformations.lib.php,v 2.7 2004/06/15 16:46:36 lem9 Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:

/**
 * Set of functions used with the relation and pdf feature
 * @param mixed $string
 * @return array|false|string[]
 * @return array|false|string[]
 */
function PMA_transformation_getOptions($string)
{
    $transform_options = [];

    if ('' != $string) {
        if ("'" == $string[0] && "'" == $string[mb_strlen($string) - 1]) {
            $transform_options = explode('\',\'', mb_substr($string, 1, -1));
        } else {
            $transform_options = [0 => $string];
        }
    }

    return $transform_options;
}

/**
 * Gets all available MIME-types
 *
 * @return  array    array[mimetype], array[transformation]
 *
 * @author  Garvin Hicking <me@supergarv.de>
 */
function PMA_getAvailableMIMEtypes()
{
    $handle = opendir('./libraries/transformations');

    $stack = [];

    $filestack = [];

    while (false !== ($file = readdir($handle))) {
        $filestack[$file] = $file;
    }

    closedir($handle);

    if (is_array($filestack)) {
        @ksort($filestack);

        foreach ($filestack as $key => $file) {
            if (preg_match('|^.*__.*\.inc\.php(3?)$|', trim($file), $match)) {
                // File contains transformation functions.

                $base = explode('__', str_replace('.inc.php' . $match[1], '', $file));

                $mimetype = str_replace('_', '/', $base[0]);

                $stack['mimetype'][$mimetype] = $mimetype;

                $stack['transformation'][] = $mimetype . ': ' . $base[1];

                $stack['transformation_file'][] = $file;
            } else {
                if (preg_match('|^.*\.inc\.php(3?)$|', trim($file), $match)) {
                    // File is a plain mimetype, no functions.

                    $base = str_replace('.inc.php' . $match[1], '', $file);

                    if ('global' != $base) {
                        $mimetype = str_replace('_', '/', $base);

                        $stack['mimetype'][$mimetype] = $mimetype;

                        $stack['empty_mimetype'][$mimetype] = $mimetype;
                    }
                }
            }
        }
    }

    return $stack;
}

/**
 * Gets the mimetypes for all rows of a table
 *
 * @param mixed $db
 * @param mixed $table
 * @param mixed $strict
 *
 * @return  array    [field_name][field_key] = field_value
 *
 * @global  array    the list of relations settings
 *
 * @author  Mike Beck <mikebeck@users.sourceforge.net> / Garvin Hicking <me@supergarv.de>
 */
function PMA_getMIME($db, $table, $strict = false)
{
    global $cfgRelation;

    $com_qry = 'SELECT column_name, mimetype, transformation, transformation_options FROM ' . PMA_backquote($cfgRelation['column_info'])
              . ' WHERE db_name = \'' . PMA_sqlAddslashes($db) . '\''
              . ' AND table_name = \'' . PMA_sqlAddslashes($table) . '\''
              . ' AND (mimetype != \'\'' . (!$strict ? ' OR transformation != \'\' OR transformation_options != \'\'' : '') . ')';

    $com_rs = PMA_query_as_cu($com_qry);

    while (false !== ($row = @PMA_DBI_fetch_assoc($com_rs))) {
        $col = $row['column_name'];

        $mime[$col]['mimetype'] = $row['mimetype'];

        $mime[$col]['transformation'] = $row['transformation'];

        $mime[$col]['transformation_options'] = $row['transformation_options'];
    } // end while

    if (isset($mime) && is_array($mime)) {
        return $mime;
    }

    return false;
} // end of the 'PMA_getMIME()' function

/**
 * Set a single mimetype to a certain value.
 *
 * @param mixed $db
 * @param mixed $table
 * @param mixed $key
 * @param mixed $mimetype
 * @param mixed $transformation
 * @param mixed $transformation_options
 * @param mixed $forcedelete
 *
 * @return  bool  true, if comment-query was made.
 *
 * @global  array    the list of relations settings
 */
function PMA_setMIME($db, $table, $key, $mimetype, $transformation, $transformation_options, $forcedelete = false)
{
    global $cfgRelation;

    $test_qry = 'SELECT mimetype, ' . PMA_backquote('comment') . ' FROM ' . PMA_backquote($cfgRelation['column_info'])
                . ' WHERE db_name = \'' . PMA_sqlAddslashes($db) . '\''
                . ' AND table_name = \'' . PMA_sqlAddslashes($table) . '\''
                . ' AND column_name = \'' . PMA_sqlAddslashes($key) . '\'';

    $test_rs = PMA_query_as_cu($test_qry);

    if ($test_rs && PMA_DBI_num_rows($test_rs) > 0) {
        $row = @PMA_DBI_fetch_assoc($test_rs);

        if (!$forcedelete && (mb_strlen($mimetype) > 0 || mb_strlen($transformation) > 0 || mb_strlen($transformation_options) > 0 || mb_strlen($row['comment']) > 0)) {
            $upd_query = 'UPDATE ' . PMA_backquote($cfgRelation['column_info'])
                   . ' SET mimetype = \'' . PMA_sqlAddslashes($mimetype) . '\','
                   . '     transformation = \'' . PMA_sqlAddslashes($transformation) . '\','
                   . '     transformation_options = \'' . PMA_sqlAddslashes($transformation_options) . '\''
                   . ' WHERE db_name  = \'' . PMA_sqlAddslashes($db) . '\''
                   . ' AND table_name = \'' . PMA_sqlAddslashes($table) . '\''
                   . ' AND column_name = \'' . PMA_sqlAddslashes($key) . '\'';
        } else {
            $upd_query = 'DELETE FROM ' . PMA_backquote($cfgRelation['column_info'])
                   . ' WHERE db_name  = \'' . PMA_sqlAddslashes($db) . '\''
                   . ' AND table_name = \'' . PMA_sqlAddslashes($table) . '\''
                   . ' AND column_name = \'' . PMA_sqlAddslashes($key) . '\'';
        }
    } else {
        if (mb_strlen($mimetype) > 0 || mb_strlen($transformation) > 0 || mb_strlen($transformation_options) > 0) {
            $upd_query = 'INSERT INTO ' . PMA_backquote($cfgRelation['column_info'])
                   . ' (db_name, table_name, column_name, mimetype, transformation, transformation_options) '
                   . ' VALUES('
                   . '\'' . PMA_sqlAddslashes($db) . '\','
                   . '\'' . PMA_sqlAddslashes($table) . '\','
                   . '\'' . PMA_sqlAddslashes($key) . '\','
                   . '\'' . PMA_sqlAddslashes($mimetype) . '\','
                   . '\'' . PMA_sqlAddslashes($transformation) . '\','
                   . '\'' . PMA_sqlAddslashes($transformation_options) . '\')';
        }
    }

    if (isset($upd_query)) {
        $upd_rs = PMA_query_as_cu($upd_query);

        unset($upd_query);

        return true;
    }

    return false;
} // end of 'PMA_setMIME()' function

/**
 * Returns the real filename of a configured transformation
 *
 * @param mixed $filename
 *
 * @return  string   the new filename
 */
function PMA_sanitizeTransformationFile(&$filename)
{
    // garvin: for security, never allow to break out from transformations directory

    $include_file = PMA_securePath($filename);

    // This value can also contain a 'php3' value, in which case we map this filename to our new 'php' variant

    $testfile = preg_replace('@\.inc\.php3$@', '.inc.php', $include_file);

    if ('3' == $include_file[mb_strlen($include_file) - 1] && file_exists('./libraries/transformations/' . $testfile)) {
        $include_file = $testfile;

        $filename = $testfile; // Corrects the referenced variable for further actions on the filename;
    }

    return $include_file;
} // end of 'PMA_sanitizeTransformationFile()' function
