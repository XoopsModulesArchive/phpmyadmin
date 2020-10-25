<?php
/* $Id: mysql.dbi.lib.php,v 2.30 2004/07/17 22:58:31 rabus Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:

/**
 * Interface to the classic MySQL extension
 */

/**
 * Loads the mysql extensions if it is not loaded yet
 */
if (!@function_exists('mysql_connect')) {
    PMA_dl('mysql');
}

// check whether mysql is available
if (!@function_exists('mysql_connect')) {
    require_once __DIR__ . '/libraries/header_http.inc.php';
    echo sprintf($strCantLoad, 'mysql') . '<br>' . "\n"
         . '<a href="./Documentation.html#faqmysql" target="documentation">' . $GLOBALS['strDocu'] . '</a>' . "\n";
    exit;
}

// MySQL client API
if (!defined('PMA_MYSQL_CLIENT_API')) {
    if (function_exists('mysql_get_client_info')) {
        $client_api = explode('.', mysql_get_client_info());
        define('PMA_MYSQL_CLIENT_API', (int)sprintf('%d%02d%02d', $client_api[0], $client_api[1], (int) $client_api[2]));
        unset($client_api);
    } else {
        define('PMA_MYSQL_CLIENT_API', 32332); // always expect the worst...
    }
}

function PMA_DBI_connect($user, $password) {
    global $cfg, $php_errormsg;

    $server_port   = (empty($cfg['Server']['port']))
                   ? ''
                   : ':' . $cfg['Server']['port'];

    if (strtolower($cfg['Server']['connect_type']) == 'tcp') {
        $cfg['Server']['socket'] = '';
    }

    $server_socket = (empty($cfg['Server']['socket']))
                   ? ''
                   : ':' . $cfg['Server']['socket'];

    if (PMA_MYSQL_CLIENT_API >= 32349) {
        $client_flags = $cfg['Server']['compress'] && defined('MYSQL_CLIENT_COMPRESS') ? MYSQL_CLIENT_COMPRESS : 0;
    }

    if (empty($client_clags)) {
        $connect_func = 'mysql_' . ($cfg['PersistentConnections'] ? 'p' : '') . 'connect';
        $link = @$connect_func($cfg['Server']['host'] . $server_port . $server_socket, $user, $password);
    } else {
        if ($cfg['PersistentConnections']) {
            $link = @mysql_pconnect($cfg['Server']['host'] . $server_port . $server_socket, $user, $password, $client_flags);
        } else {
            $link = @mysql_connect($cfg['Server']['host'] . $server_port . $server_socket, $user, $password, FALSE, $client_flags);
        }
    }

    if (empty($link)) {
        PMA_auth_fails();
    } // end if
    
    PMA_DBI_postConnect($link);

    return $link;
}

function PMA_DBI_select_db($dbname, $link = NULL) {
    if (empty($link)) {
        if (isset($GLOBALS['userlink'])) {
            $link = $GLOBALS['userlink'];
        } else {
            return FALSE;
        }
    }
    if (PMA_MYSQL_INT_VERSION < 40100) {
        $dbname = PMA_convert_charset($dbname);
    }
    return mysqli_select_db($GLOBALS['xoopsDB']->conn, $dbname, $link);
}

function PMA_DBI_try_query($query, $link = NULL, $options = 0) {
    if (empty($link)) {
        if (isset($GLOBALS['userlink'])) {
            $link = $GLOBALS['userlink'];
        } else {
            return FALSE;
        }
    }
    if (defined('PMA_MYSQL_INT_VERSION') && PMA_MYSQL_INT_VERSION < 40100) {
        $query = PMA_convert_charset($query);
    }
    if ($options == ($options | PMA_DBI_QUERY_STORE)) {
        return @$GLOBALS['xoopsDB']->queryF($query, $link);
    } elseif ($options == ($options | PMA_DBI_QUERY_UNBUFFERED)) {
        return @mysql_unbuffered_query($query, $link);
    } else {
        return @$GLOBALS['xoopsDB']->queryF($query, $link);
    }
}

// The following function is meant for internal use only.
// Do not call it from outside this library!
function PMA_$GLOBALS['xoopsDB']->fetchBoth($result, $type = FALSE) {
    global $cfg, $allow_recoding, $charset, $convcharset;

    if ($type !== false) {
        $data = $GLOBALS['xoopsDB']->fetchBoth($result, $type);
    } else {
        $data = $GLOBALS['xoopsDB']->fetchBoth($result);
    }

    /* No data returned => do not touch it */
    if (! $data) return $data;
    
    if (!defined('PMA_MYSQL_INT_VERSION') || PMA_MYSQL_INT_VERSION >= 40100
        || !(isset($cfg['AllowAnywhereRecoding']) && $cfg['AllowAnywhereRecoding'] && $allow_recoding)) {
        /* No recoding -> return data as we got them */
        return $data;
    } else {
        $ret = [];
        $num = mysqli_num_fields($result);
        $i = 0;
        for ($i = 0; $i < $num; $i++) {
            $name = $GLOBALS['xoopsDB']->getFieldName($result, $i);
            $flags = mysql_field_flags($result, $i);
            /* Field is BINARY (either marked manually, or it is BLOB) => do not convert it */
            if (false !== stripos($flags, 'BINARY')) {
                if (isset($data[$i])) $ret[$i] = $data[$i];
                if (isset($data[$name])) $ret[PMA_convert_display_charset($name)] = $data[$name];
            } else {
                if (isset($data[$i])) $ret[$i] = PMA_convert_display_charset($data[$i]);
                if (isset($data[$name])) $ret[PMA_convert_display_charset($name)] = PMA_convert_display_charset($data[$name]);
            }
        }
        return $ret;
    }
}

function PMA_DBI_fetch_array($result) {
    return PMA_$GLOBALS['xoopsDB']->fetchBoth($result);
}

function PMA_DBI_fetch_assoc($result) {
    return PMA_$GLOBALS['xoopsDB']->fetchBoth($result, MYSQL_ASSOC);
}

function PMA_DBI_fetch_row($result) {
    return PMA_$GLOBALS['xoopsDB']->fetchBoth($result, MYSQL_NUM);
}

function PMA_DBI_free_result($result) {
    return @$GLOBALS['xoopsDB']->freeRecordSet($result);
}

function PMA_DBI_getError($link = NULL) {
    unset($GLOBALS['errno']); 
    if (empty($link)) {
        if (isset($GLOBALS['userlink'])) {
            $link = $GLOBALS['userlink'];

// Do not stop now. On the initial connection, we don't have a $link,
// we don't have a $GLOBALS['userlink'], but we can catch the error code
//        } else {
//            return FALSE;
       }
    }

    if ($GLOBALS['xoopsDB']->errno()) {
        $error = $GLOBALS['xoopsDB']->errno();
        $error_message = $GLOBALS['xoopsDB']->error();
    } elseif ($link) {
        $error = $GLOBALS['xoopsDB']->errno($link);
        $error_message = $GLOBALS['xoopsDB']->error($link);
    }

    // keep the error number for further check after the call to PMA_DBI_getError() 
    if (isset($error) && $error) {
        $GLOBALS['errno'] = $error;
    } else {
        return FALSE;
    }

// Some errors messages cannot be obtained by $GLOBALS['xoopsDB']->error()
    if ($error && $error == 2003) {
        $error = '#' . ((string) $error) . ' - ' . $GLOBALS['strServerNotResponding'];
    } elseif ($error && defined('PMA_MYSQL_INT_VERSION') && PMA_MYSQL_INT_VERSION >= 40100) {
        $error = '#' . ((string) $error) . ' - ' . $error_message;
    } elseif ($error) {
        $error = '#' . ((string) $error) . ' - ' . PMA_convert_display_charset($error_message);
    }
    return $error;
}

function PMA_DBI_close($link = NULL) {
    if (empty($link)) {
        if (isset($GLOBALS['userlink'])) {
            $link = $GLOBALS['userlink'];
        } else {
            return FALSE;
        }
    }
    return @$GLOBALS['xoopsDB']->close($link);
}

function PMA_DBI_num_rows($result) {
    return $GLOBALS['xoopsDB']->getRowsNum($result);
}

function PMA_DBI_insert_id($link = NULL) {
    if (empty($link)) {
        if (isset($GLOBALS['userlink'])) {
            $link = $GLOBALS['userlink'];
        } else {
            return FALSE;
        }
    }
    return $GLOBALS['xoopsDB']->getInsertId($link);
}

function PMA_DBI_affected_rows($link = NULL) {
    if (empty($link)) {
        if (isset($GLOBALS['userlink'])) {
            $link = $GLOBALS['userlink'];
        } else {
            return FALSE;
        }
    }
    return $GLOBALS['xoopsDB']->getAffectedRows($link);
}

function PMA_DBI_get_fields_meta($result) {
    $fields       = [];
    $num_fields   = mysqli_num_fields($result);
    for ($i = 0; $i < $num_fields; $i++) {
        $fields[] = PMA_convert_display_charset(mysql_fetch_field($result, $i));
    }
    return $fields;
}

function PMA_DBI_num_fields($result) {
    return mysqli_num_fields($result);
}

function PMA_DBI_field_len($result, $i) {
    return mysql_field_len($result, $i);
}

function PMA_DBI_field_name($result, $i) {
    return $GLOBALS['xoopsDB']->getFieldName($result, $i);
}

function PMA_DBI_field_flags($result, $i) {
    return PMA_convert_display_charset(mysql_field_flags($result, $i));
}


