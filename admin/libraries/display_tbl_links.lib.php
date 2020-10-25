<?php

/* $Id: display_tbl_links.lib.php,v 2.9 2004/05/16 17:32:15 rabus Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:

// modified 2004-05-08 by Michael Keck <mail_at_michaelkeck_dot_de>
// - bugfix for select all checkboxes
// - copy right to left (or left to right) if user click on a check box
// - reversed the right modify links: 1. drop, 2. edit, 3. checkbox
// - also changes made in libraries/functions.js

if ('left' == $doWriteModifyAt) {
    if (!empty($del_url) && 'kp' != $is_display['del_lnk']) {
        echo '    <td width="16" align="center" valign="top" bgcolor="' . $bgcolor . '">' . "\n"
           . '        <input type="checkbox" id="id_rows_to_delete' . $row_no . '" name="rows_to_delete[' . $uva_condition . ']"'
           . ' onclick="copyCheckboxesRange(\'rowsDeleteForm\', \'id_rows_to_delete' . $row_no . '\',\'l\');"'
           . ' value="' . $del_query . '" ' . (isset($GLOBALS['checkall']) ? 'checked' : '') . '>' . "\n"
           . '    </td>' . "\n";
    }

    if (!empty($edit_url)) {
        echo '    <td width="16" align="center" valign="top" bgcolor="' . $bgcolor . '">' . "\n"
           . PMA_linkOrButton($edit_url, $edit_str, '', false)
           . $bookmark_go
           . '    </td>' . "\n";
    }

    if (!empty($del_url)) {
        echo '    <td width="16" align="center" valign="top" bgcolor="' . $bgcolor . '">' . "\n"
           . PMA_linkOrButton($del_url, $del_str, ($js_conf ?? ''), false)
           . '    </td>' . "\n";
    }
} else {
    if ('right' == $doWriteModifyAt) {
        if (!empty($del_url)) {
            echo '    <td width="16" align="center" valign="top" bgcolor="' . $bgcolor . '">' . "\n"
           . PMA_linkOrButton($del_url, $del_str, ($js_conf ?? ''), false)
           . '    </td>' . "\n";
        }

        if (!empty($edit_url)) {
            echo '    <td width="16" align="center" valign="top" bgcolor="' . $bgcolor . '">' . "\n"
           . PMA_linkOrButton($edit_url, $edit_str, '', false)
           . $bookmark_go
           . '    </td>' . "\n";
        }

        if (!empty($del_url) && 'kp' != $is_display['del_lnk']) {
            echo '    <td width="16" align="center" valign="top" bgcolor="' . $bgcolor . '">' . "\n"
           . '        <input type="checkbox" id="id_rows_to_delete' . $row_no . 'r" name="rows_to_delete[' . $uva_condition . ']"'
           . ' onclick="copyCheckboxesRange(\'rowsDeleteForm\', \'id_rows_to_delete' . $row_no . '\',\'r\');"'
                                            . ' value="' . $del_query . '" ' . (isset($GLOBALS['checkall']) ? 'checked' : '') . '>' . "\n"
           . '    </td>' . "\n";
        }
    }
}
