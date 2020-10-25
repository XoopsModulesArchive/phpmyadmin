<?php

/* $Id: url_generating.lib.php,v 2.3 2004/07/17 22:58:31 rabus Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:

/**
 * URL/hidden inputs generating.
 * @param mixed $db
 * @param mixed $table
 * @param mixed $indent
 * @param mixed $skip
 */

/**
 * Generates text with hidden inputs.
 *
 * @param string $db     optional database name
 * @param string $table  optional table name
 * @param int    $indent indenting level
 *
 * @param array  $skip
 * @return  string   string with input fields
 *
 * @global  string   the current language
 * @global  string   the current conversion charset
 * @global  string   the current connection collation
 * @global  string   the current server
 * @global  array    the configuration array
 * @global  bool  whether recoding is allowed or not
 *
 * @author  nijel
 */
function PMA_generate_common_hidden_inputs($db = '', $table = '', $indent = 0, $skip = [])
{
    global $lang, $convcharset, $collation_connection, $server;

    global $cfg, $allow_recoding;

    if (!is_array($skip)) {
        $skip = [$skip];
    }

    $spaces = '';

    for ($i = 0; $i < $indent; $i++) {
        $spaces .= '    ';
    }

    $result = $spaces . '<input type="hidden" name="lang" value="' . $lang . '">' . "\n"
            . $spaces . '<input type="hidden" name="server" value="' . $server . '">' . "\n";

    if (!in_array('convcharset', $skip, true) && isset($cfg['AllowAnywhereRecoding']) && $cfg['AllowAnywhereRecoding'] && $allow_recoding) {
        $result .= $spaces . '<input type="hidden" name="convcharset" value="' . $convcharset . '">' . "\n";
    }

    if (!in_array('collation_connection', $skip, true) && isset($collation_connection)) {
        $result .= $spaces . '<input type="hidden" name="collation_connection" value="' . $collation_connection . '">' . "\n";
    }

    if (!in_array('db', $skip, true) && !empty($db)) {
        $result .= $spaces . '<input type="hidden" name="db" value="' . htmlspecialchars($db, ENT_QUOTES | ENT_HTML5) . '">' . "\n";
    }

    if (!in_array('table', $skip, true) && !empty($table)) {
        $result .= $spaces . '<input type="hidden" name="table" value="' . htmlspecialchars($table, ENT_QUOTES | ENT_HTML5) . '">' . "\n";
    }

    return $result;
}

/**
 * Generates text with URL parameters.
 *
 * @param mixed $db
 * @param mixed $table
 * @param mixed $amp
 *
 * @return  string   string with URL parameters
 *
 * @global  string   the current language
 * @global  string   the current conversion charset
 * @global  string   the current connection collation
 * @global  string   the current server
 * @global  array    the configuration array
 * @global  bool  whether recoding is allowed or not
 *
 * @author  nijel
 */
function PMA_generate_common_url($db = '', $table = '', $amp = '&amp;')
{
    global $lang, $convcharset, $collation_connection, $server;

    global $cfg, $allow_recoding;

    $result = 'lang=' . $lang
       . $amp . 'server=' . $server;

    if (isset($cfg['AllowAnywhereRecoding']) && $cfg['AllowAnywhereRecoding'] && $allow_recoding) {
        $result .= $amp . 'convcharset=' . urlencode($convcharset);
    }

    if (isset($collation_connection)) {
        $result .= $amp . 'collation_connection=' . urlencode($collation_connection);
    }

    if (!empty($db)) {
        $result .= $amp . 'db=' . urlencode($db);
    }

    if (!empty($table)) {
        $result .= $amp . 'table=' . urlencode($table);
    }

    return $result;
}
