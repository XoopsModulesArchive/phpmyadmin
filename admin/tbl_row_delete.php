<?php

/* $Id: tbl_row_delete.php,v 2.13 2004/05/20 16:14:09 nijel Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:
require_once __DIR__ . '/libraries/grab_globals.lib.php';
require_once __DIR__ . '/libraries/common.lib.php';
require_once __DIR__ . '/libraries/mysql_charsets.lib.php';

/**
 * No rows were selected => show again the query and tell that user.
 */
if ((!isset($rows_to_delete) || !is_array($rows_to_delete)) && !isset($mult_btn)) {
    $disp_message = $strNoRowsSelected;

    $disp_query = '';

    require __DIR__ . '/sql.php';

    require_once __DIR__ . '/footer.inc.php';
}

/**
 * Drop multiple rows if required
 */

// workaround for IE problem:
if (isset($submit_mult_x)) {
    $submit_mult = 'row_delete';
} elseif (isset($submit_mult_edit_x)) {
    $submit_mult = 'row_edit';
} elseif (isset($submit_mult_export_x)) {
    $submit_mult = 'row_export';
}

// garvin: If the 'Ask for confirmation' button was pressed, this can only come from 'delete' mode,
// so we set it straight away.
if (isset($mult_btn)) {
    $submit_mult = 'row_delete';
}

switch ($submit_mult) {
    case 'row_delete':
    case 'row_edit':
    case 'row_export':
        // leave as is
        break;
    case $GLOBALS['strExport']:
        $submit_mult = 'row_export';
        break;
    case $GLOBALS['strDelete']:
    case $GLOBALS['strKill']:
        $submit_mult = 'row_delete';
        break;
    default:
    case $GLOBALS['strEdit']:
        $submit_mult = 'row_edit';
        break;
}

if ('row_edit' == $submit_mult) {
    $js_to_run = 'tbl_change.js';
}

if ('row_delete' == $submit_mult || 'row_export' == $submit_mult) {
    $js_to_run = 'functions.js';
}

require_once __DIR__ . '/header.inc.php';

if (!empty($submit_mult)) {
    switch ($submit_mult) {
        case 'row_edit':
            $primary_key = [];
            // garvin: As we got the fields to be edited from the 'rows_to_delete' checkbox, we use the index of it as the
            // indicating primary key. Then we built the array which is used for the tbl_change.php script.
            foreach ($rows_to_delete as $i_primary_key => $del_query) {
                $primary_key[] = urldecode($i_primary_key);
            }

            $active_page = 'tbl_change.php';
            require __DIR__ . '/tbl_change.php';
            break;
        case 'row_export':
            // Needed to allow SQL export
            $single_table = true;

            $primary_key = [];
            $sql_query = urldecode($sql_query);
            // garvin: As we got the fields to be edited from the 'rows_to_delete' checkbox, we use the index of it as the
            // indicating primary key. Then we built the array which is used for the tbl_change.php script.
            foreach ($rows_to_delete as $i_primary_key => $del_query) {
                $primary_key[] = urldecode($i_primary_key);
            }

            $active_page = 'tbl_properties_export.php';
            require __DIR__ . '/tbl_properties_export.php';
            break;
        case 'row_delete':
        default:
            $action = 'tbl_row_delete.php';
            $err_url = 'tbl_row_delete.php?' . PMA_generate_common_url($db, $table);
            if (!isset($mult_btn)) {
                $original_sql_query = $sql_query;

                $original_url_query = $url_query;

                $original_pos = $pos;
            }
            require __DIR__ . '/mult_submits.inc.php';
            $url_query = PMA_generate_common_url($db, $table)
                       . '&amp;goto=tbl_properties.php';

            /**
             * Show result of multi submit operation
             */
            if (!empty($submit_mult) || isset($mult_btn)) {
                $disp_message = $strSuccess;

                $disp_query = $sql_query;
            }

            if (isset($original_sql_query)) {
                $sql_query = urldecode($original_sql_query);
            }

            if (isset($original_url_query)) {
                $url_query = $original_url_query;
            }

            if (isset($original_pos)) {
                $pos = $original_pos;
            }

            // this is because sql.php could call tbl_properties_structure
            // which would think it needs to call mult_submits.inc.php:
            unset($submit_mult);
            unset($mult_btn);

            $active_page = 'sql.php';
            require __DIR__ . '/sql.php';

            /**
             * Displays the footer
             */
            require_once __DIR__ . '/footer.inc.php';
        break;
    }
}
