<?php

/* $Id: tbl_properties_structure.php,v 2.23 2004/07/28 14:17:44 nijel Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:

require_once __DIR__ . '/libraries/grab_globals.lib.php';
require_once __DIR__ . '/libraries/common.lib.php';
require_once __DIR__ . '/libraries/mysql_charsets.lib.php';

/**
 * Drop multiple fields if required
 */

// workaround for IE problem:
if (isset($submit_mult_change_x)) {
    $submit_mult = $strChange;
}
if (isset($submit_mult_drop_x)) {
    $submit_mult = $strDrop;
}

if ((!empty($submit_mult) && isset($selected_fld))
    || isset($mult_btn)) {
    $action = 'tbl_properties_structure.php';

    $err_url = 'tbl_properties_structure.php?' . PMA_generate_common_url($db, $table);

    require __DIR__ . '/mult_submits.inc.php';
}

/**
 * Runs common work
 */
require __DIR__ . '/tbl_properties_common.php';
$url_query .= '&amp;goto=tbl_properties_structure.php&amp;back=tbl_properties_structure.php';

/**
 * Prepares the table structure display
 */
// 1. Get table information/display tabs;
require __DIR__ . '/tbl_properties_table_info.php';

/**
 * Show result of multi submit operation
 */
if ((!empty($submit_mult) && isset($selected_fld))
    || isset($mult_btn)) {
    PMA_showMessage($strSuccess);
}

// 2. Gets table keys and retains them
$result = PMA_DBI_query('SHOW KEYS FROM ' . PMA_backquote($table) . ';');
$primary = '';
$ret_keys = [];
$pk_array = []; // will be use to emphasis prim. keys in the table view
while (false !== ($row = PMA_DBI_fetch_assoc($result))) {
    $ret_keys[] = $row;

    // Backups the list of primary keys

    if ('PRIMARY' == $row['Key_name']) {
        $primary .= $row['Column_name'] . ', ';

        $pk_array[$row['Column_name']] = 1;
    }
} // end while
PMA_DBI_free_result($result);

// 3. Get fields
$fields_rs = PMA_DBI_query('SHOW FULL FIELDS FROM ' . PMA_backquote($table) . ';', null, PMA_DBI_QUERY_STORE);
$fields_cnt = PMA_DBI_num_rows($fields_rs);

/**
 * Displays the table structure ('show table' works correct since 3.23.03)
 */
?>

<!-- TABLE INFORMATION -->

<form method="post" action="tbl_properties_structure.php" name="fieldsForm">
    <?php echo PMA_generate_common_hidden_inputs($db, $table); ?>
<table border="<?php echo $cfg['Border']; ?>" cellpadding="2" cellspacing="1">
<tr>
    <th id="th1">&nbsp;</th>
    <th id="th2">&nbsp;<?php echo $strField; ?>&nbsp;</th>
    <th id="th3"><?php echo $strType; ?></th>
<?php echo PMA_MYSQL_INT_VERSION >= 40100 ? '    <th>' . $strCollation . '</th>' . "\n" : ''; ?>
    <th id="th4"><?php echo $strAttr; ?></th>
    <th id="th5"><?php echo $strNull; ?></th>
    <th id="th5"><?php echo $strDefault; ?></th>
    <th id="th7"><?php echo $strExtra; ?></th>
    <th colspan="6" id="th8"><?php echo $strAction; ?></th>
</tr>

<?php
$comments_map = [];
$mime_map = [];

if ($GLOBALS['cfg']['ShowPropertyComments']) {
    require_once __DIR__ . '/libraries/relation.lib.php';

    require_once __DIR__ . '/libraries/transformations.lib.php';

    $cfgRelation = PMA_getRelationsParam();

    if ($cfgRelation['commwork']) {
        $comments_map = PMA_getComments($db, $table);

        if ($cfgRelation['mimework'] && $cfg['BrowseMIME']) {
            $mime_map = PMA_getMIME($db, $table, true);
        }
    }
}

$i = 0;
$aryFields = [];
$checked = (!empty($checkall) ? ' checked' : '');
$save_row = [];

while (false !== ($row = PMA_DBI_fetch_assoc($fields_rs))) {
    $save_row[] = $row;

    $i++;

    $bgcolor = ($i % 2) ? $cfg['BgcolorOne'] : $cfg['BgcolorTwo'];

    $aryFields[] = $row['Field'];

    if (true === $GLOBALS['cfg']['BrowsePointerEnable']) {
        $on_mouse = ' onmouseover="setPointer(this, ' . $i . ', \'over\', \'' . $bgcolor . '\', \'' . $GLOBALS['cfg']['BrowsePointerColor'] . '\', \'' . $GLOBALS['cfg']['BrowseMarkerColor'] . '\');"'
                  . ' onmouseout="setPointer(this, ' . $i . ', \'out\', \'' . $bgcolor . '\', \'' . $GLOBALS['cfg']['BrowsePointerColor'] . '\', \'' . $GLOBALS['cfg']['BrowseMarkerColor'] . '\');"';
    } else {
        $on_mouse = '';
    }

    if (true === $GLOBALS['cfg']['BrowseMarkerEnable']) {
        $on_mouse .= ' onmousedown="setPointer(this, ' . $i . ', \'click\', \'' . $bgcolor . '\', \'' . $GLOBALS['cfg']['BrowsePointerColor'] . '\', \'' . $GLOBALS['cfg']['BrowseMarkerColor'] . '\');"';
    }

    $click_mouse = ' onmousedown="document.getElementById(\'checkbox_row_' . $i . '\').checked = (document.getElementById(\'checkbox_row_' . $i . '\').checked ? false : true);" ';

    $type = $row['Type'];

    // reformat mysql query output - staybyte - 9. June 2001

    // loic1: set or enum types: slashes single quotes inside options

    if (preg_match('@^(set|enum)\((.+)\)$@i', $type, $tmp)) {
        $tmp[2] = mb_substr(preg_replace('@([^,])\'\'@', '\\1\\\'', ',' . $tmp[2]), 1);

        $type = $tmp[1] . '(' . str_replace(',', ', ', $tmp[2]) . ')';

        $type_nowrap = '';

        $binary = 0;

        $unsigned = 0;

        $zerofill = 0;
    } else {
        $type_nowrap = ' nowrap="nowrap"';

        $type = str_ireplace("BINARY", '', $type);

        $type = str_ireplace("ZEROFILL", '', $type);

        $type = str_ireplace("UNSIGNED", '', $type);

        if (empty($type)) {
            $type = '&nbsp;';
        }

        $binary = mb_stristr($row['Type'], 'blob') || mb_stristr($row['Type'], 'binary');

        $unsigned = mb_stristr($row['Type'], 'unsigned');

        $zerofill = mb_stristr($row['Type'], 'zerofill');
    }

    // rabus: Devide charset from the rest of the type definition (MySQL >= 4.1)

    unset($field_charset);

    if (PMA_MYSQL_INT_VERSION >= 40100) {
        if ((
            'char' == mb_substr($type, 0, 4) || 'varchar' == mb_substr($type, 0, 7) || 'text' == mb_substr($type, 0, 4) || 'tinytext' == mb_substr($type, 0, 8) || 'mediumtext' == mb_substr($type, 0, 10) || 'longtext' == mb_substr($type, 0, 8) || 'set' == mb_substr($type, 0, 3) || 'enum' == mb_substr($type, 0, 4)
        ) && !$binary) {
            if (mb_strpos($type, ' character set ')) {
                $type = mb_substr($type, 0, mb_strpos($type, ' character set '));
            }

            if (!empty($row['Collation'])) {
                $field_charset = $row['Collation'];
            } else {
                $field_charset = '';
            }
        } else {
            $field_charset = '';
        }
    }

    // garvin: Display basic mimetype [MIME]

    if ($cfgRelation['commwork'] && $cfgRelation['mimework'] && $cfg['BrowseMIME'] && isset($mime_map[$row['Field']]['mimetype'])) {
        $type_mime = '<br>MIME: ' . str_replace('_', '/', $mime_map[$row['Field']]['mimetype']);
    } else {
        $type_mime = '';
    }

    $strAttribute = '&nbsp;';

    if ($binary) {
        $strAttribute = 'BINARY';
    }

    if ($unsigned) {
        $strAttribute = 'UNSIGNED';
    }

    if ($zerofill) {
        $strAttribute = 'UNSIGNED ZEROFILL';
    }

    if (!isset($row['Default'])) {
        if ('' != $row['Null']) {
            $row['Default'] = '<i>NULL</i>';
        }
    } else {
        $row['Default'] = htmlspecialchars($row['Default'], ENT_QUOTES | ENT_HTML5);
    }

    $field_encoded = urlencode($row['Field']);

    $field_name = htmlspecialchars($row['Field'], ENT_QUOTES | ENT_HTML5);

    // garvin: underline commented fields and display a hover-title (CSS only)

    $comment_style = '';

    if (isset($comments_map[$row['Field']])) {
        $field_name = '<span style="border-bottom: 1px dashed black;" title="' . htmlspecialchars($comments_map[$row['Field']], ENT_QUOTES | ENT_HTML5) . '">' . $field_name . '</span>';
    }

    if (isset($pk_array[$row['Field']])) {
        $field_name = '<u>' . $field_name . '</u>';
    }

    echo "\n";

    $titles = [];

    if (true === $cfg['PropertiesIconic']) {
        // We need to copy the value or else the == 'both' check will always return true

        $propicon = (string)$cfg['PropertiesIconic'];

        if ('both' == $propicon) {
            $iconic_spacer = '<div class="nowrap">';
        } else {
            $iconic_spacer = '';
        }

        // images replaced 2004-05-08 by mkkeck

        $titles['Change'] = $iconic_spacer . '<img hspace="2" width="16" height="16" src="' . $pmaThemeImage . 'b_edit.png" alt="' . $strChange . '" title="' . $strChange . '" border="0">';

        $titles['Drop'] = $iconic_spacer . '<img hspace="2" width="16" height="16" src="' . $pmaThemeImage . 'b_drop.png" alt="' . $strDrop . '" title="' . $strDrop . '" border="0">';

        $titles['NoDrop'] = $iconic_spacer . '<img hspace="2" width="16" height="16" src="' . $pmaThemeImage . 'b_drop.png" alt="' . $strDrop . '" title="' . $strDrop . '" border="0">';

        $titles['Primary'] = $iconic_spacer . '<img hspace="2" width="16" height="16" src="' . $pmaThemeImage . 'b_primary.png" alt="' . $strPrimary . '" title="' . $strPrimary . '" border="0">';

        $titles['Index'] = $iconic_spacer . '<img hspace="2" width="16" height="16" src="' . $pmaThemeImage . 'b_index.png" alt="' . $strIndex . '" title="' . $strIndex . '" border="0">';

        $titles['Unique'] = $iconic_spacer . '<img hspace="2" width="16" height="16" src="' . $pmaThemeImage . 'b_unique.png" alt="' . $strUnique . '" title="' . $strUnique . '" border="0">';

        $titles['IdxFulltext'] = $iconic_spacer . '<img hspace="2" width="16" height="16" src="' . $pmaThemeImage . 'b_ftext.png" alt="' . $strIdxFulltext . '" title="' . $strIdxFulltext . '" border="0">';

        $titles['NoPrimary'] = $iconic_spacer . '<img hspace="2" width="16" height="16" src="' . $pmaThemeImage . 'bd_primary.png" alt="' . $strPrimary . '" title="' . $strPrimary . '" border="0">';

        $titles['NoIndex'] = $iconic_spacer . '<img hspace="2" width="16" height="16" src="' . $pmaThemeImage . 'bd_index.png" alt="' . $strIndex . '" title="' . $strIndex . '" border="0">';

        $titles['NoUnique'] = $iconic_spacer . '<img hspace="2" width="16" height="16" src="' . $pmaThemeImage . 'bd_unique.png" alt="' . $strUnique . '" title="' . $strUnique . '" border="0">';

        $titles['NoIdxFulltext'] = $iconic_spacer . '<img hspace="2" width="16" height="16" src="' . $pmaThemeImage . 'bd_ftext.png" alt="' . $strIdxFulltext . '" title="' . $strIdxFulltext . '" border="0">';

        if ('both' == $propicon) {
            $titles['Change'] .= '&nbsp;' . $strChange . '</div>';

            $titles['Drop'] .= '&nbsp;' . $strDrop . '</div>';

            $titles['NoDrop'] .= '&nbsp;' . $strDrop . '</div>';

            $titles['Primary'] .= '&nbsp;' . $strPrimary . '</div>';

            $titles['Index'] .= '&nbsp;' . $strIndex . '</div>';

            $titles['Unique'] .= '&nbsp;' . $strUnique . '</div>';

            $titles['IdxFulltext'] .= '&nbsp;' . $strIdxFulltext . '</div>';

            $titles['NoPrimary'] .= '&nbsp;' . $strPrimary . '</div>';

            $titles['NoIndex'] .= '&nbsp;' . $strIndex . '</div>';

            $titles['NoUnique'] .= '&nbsp;' . $strUnique . '</div>';

            $titles['NoIdxFulltext'] .= '&nbsp;' . $strIdxFulltext . '</div>';
        }
    } else {
        $titles['Change'] = $strChange;

        $titles['Drop'] = $strDrop;

        $titles['NoDrop'] = $strDrop;

        $titles['Primary'] = $strPrimary;

        $titles['Index'] = $strIndex;

        $titles['Unique'] = $strUnique;

        $titles['IdxFulltext'] = $strIdxFulltext;

        $titles['NoPrimary'] = $strPrimary;

        $titles['NoIndex'] = $strIndex;

        $titles['NoUnique'] = $strUnique;

        $titles['NoIdxFulltext'] = $strIdxFulltext;
    } ?>
<tr <?php echo $on_mouse; ?>>
    <td align="center" bgcolor="<?php echo $bgcolor; ?>">
        <input type="checkbox" name="selected_fld[]" value="<?php echo $field_encoded; ?>" id="checkbox_row_<?php echo $i; ?>" <?php echo $checked; ?>>
    </td>
    <td <?php echo $click_mouse; ?> bgcolor="<?php echo $bgcolor; ?>" nowrap="nowrap">&nbsp;<label onClick="javascript: return (document.getElementById('checkbox_row_<?php echo $i; ?>') ? false : true)" for="checkbox_row_<?php echo $i; ?>"><?php echo $field_name; ?></label>&nbsp;</td>
    <td <?php echo $click_mouse; ?> bgcolor="<?php echo $bgcolor; ?>"<?php echo $type_nowrap; ?>><?php echo $type;

    echo $type_mime; ?><bdo dir="ltr"></bdo></td>
<?php echo PMA_MYSQL_INT_VERSION >= 40100 ? '    <td bgcolor="' . $bgcolor . '" ' . $click_mouse . '>' . (empty($field_charset) ? '&nbsp;' : '<dfn title="' . PMA_getCollationDescr($field_charset) . '">' . $field_charset . '</dfn>') . '</td>' . "\n" : '' ?>
    <td <?php echo $click_mouse; ?> bgcolor="<?php echo $bgcolor; ?>" nowrap="nowrap"><?php echo $strAttribute; ?></td>
    <td <?php echo $click_mouse; ?> bgcolor="<?php echo $bgcolor; ?>"><?php echo(('' == $row['Null']) ? $strNo : $strYes); ?>&nbsp;</td>
    <td <?php echo $click_mouse; ?> bgcolor="<?php echo $bgcolor; ?>" nowrap="nowrap"><?php if (isset($row['Default'])) {
        echo $row['Default'];
    } ?>&nbsp;</td>
    <td <?php echo $click_mouse; ?> bgcolor="<?php echo $bgcolor; ?>" nowrap="nowrap"><?php echo $row['Extra']; ?>&nbsp;</td>
    <td align="center" bgcolor="<?php echo $bgcolor; ?>">
        <a href="tbl_alter.php?<?php echo $url_query; ?>&field=<?php echo $field_encoded; ?>">
            <?php echo $titles['Change']; ?></a>
    </td>
    <td align="center" bgcolor="<?php echo $bgcolor; ?>">
        <?php
        // loic1: Drop field only if there is more than one field in the table
        if ($fields_cnt > 1) {
            echo "\n"; ?>
        <a href="sql.php?<?php echo $url_query; ?>&sql_query=<?php echo urlencode('ALTER TABLE ' . PMA_backquote($table) . ' DROP ' . PMA_backquote($row['Field'])); ?>&cpurge=1&purgekey=<?php echo urlencode($row['Field']); ?>&zero_rows=<?php echo urlencode(sprintf($strFieldHasBeenDropped,
                                                                                                                                                                                                                                                                         htmlspecialchars(
                                                                                                                                                                                                                                                                             $row['Field'],
                                                                                                                                                                                                                                                                             ENT_QUOTES | ENT_HTML5
                                                                                                                                                                                                                                                                         )
                                                                                                                                                                                                                                                                 )); ?>"
            onclick="return confirmLink(this, 'ALTER TABLE <?php echo PMA_jsFormat($table); ?> DROP <?php echo PMA_jsFormat($row['Field']); ?>')">
            <?php echo $titles['Drop']; ?></a>
            <?php
        } else {
            echo "\n" . '        ' . $titles['NoDrop'];
        }

    echo "\n"; ?>
    </td>
    <td align="center" bgcolor="<?php echo $bgcolor; ?>">
        <?php
        if ('text' == $type || 'blob' == $type) {
            echo $titles['NoPrimary'] . "\n";
        } else {
            echo "\n"; ?>
        <a href="sql.php?<?php echo $url_query; ?>&sql_query=<?php echo urlencode('ALTER TABLE ' . PMA_backquote($table) . (empty($primary) ? '' : ' DROP PRIMARY KEY,') . ' ADD PRIMARY KEY(' . PMA_backquote($row['Field']) . ')'); ?>&zero_rows=<?php echo urlencode(sprintf($strAPrimaryKey,
                                                                                                                                                                                                                                                                                htmlspecialchars(
                                                                                                                                                                                                                                                                                    $row['Field'],
                                                                                                                                                                                                                                                                                    ENT_QUOTES | ENT_HTML5
                                                                                                                                                                                                                                                                                )
                                                                                                                                                                                                                                                                        )); ?>"
            onclick="return confirmLink(this, 'ALTER TABLE <?php echo PMA_jsFormat($table) . (empty($primary) ? '' : ' DROP PRIMARY KEY,'); ?> ADD PRIMARY KEY(<?php echo PMA_jsFormat($row['Field']); ?>)')">
            <?php echo $titles['Primary']; ?></a>
            <?php
        }

    echo "\n"; ?>
    </td>
    <td align="center" bgcolor="<?php echo $bgcolor; ?>">
        <?php
        if ('text' == $type || 'blob' == $type) {
            echo $titles['NoIndex'] . "\n";
        } else {
            echo "\n"; ?>
        <a href="sql.php?<?php echo $url_query; ?>&sql_query=<?php echo urlencode('ALTER TABLE ' . PMA_backquote($table) . ' ADD INDEX(' . PMA_backquote($row['Field']) . ')'); ?>&zero_rows=<?php echo urlencode(sprintf($strAnIndex, htmlspecialchars($row['Field'], ENT_QUOTES | ENT_HTML5))); ?>">
            <?php echo $titles['Index']; ?></a>
            <?php
        }

    echo "\n"; ?>
    </td>
    <td align="center" bgcolor="<?php echo $bgcolor; ?>">
        <?php
        if ('text' == $type || 'blob' == $type) {
            echo $titles['NoUnique'] . "\n";
        } else {
            echo "\n"; ?>
        <a href="sql.php?<?php echo $url_query; ?>&sql_query=<?php echo urlencode('ALTER TABLE ' . PMA_backquote($table) . ' ADD UNIQUE(' . PMA_backquote($row['Field']) . ')'); ?>&zero_rows=<?php echo urlencode(sprintf($strAnIndex, htmlspecialchars($row['Field'], ENT_QUOTES | ENT_HTML5))); ?>">
            <?php echo $titles['Unique']; ?></a>
            <?php
        }

    echo "\n"; ?>
    </td>
    <?php
        if ((!empty($tbl_type) && 'MYISAM' == $tbl_type)
            && (mb_strpos(' ' . $type, 'text') || mb_strpos(' ' . $type, 'varchar'))) {
            echo "\n"; ?>
    <td align="center" bgcolor="<?php echo $bgcolor; ?>" nowrap="nowrap">
        <a href="sql.php?<?php echo $url_query; ?>&sql_query=<?php echo urlencode('ALTER TABLE ' . PMA_backquote($table) . ' ADD FULLTEXT(' . PMA_backquote($row['Field']) . ')'); ?>&zero_rows=<?php echo urlencode(sprintf($strAnIndex, htmlspecialchars($row['Field'], ENT_QUOTES | ENT_HTML5))); ?>">
            <?php echo $titles['IdxFulltext']; ?></a>
    </td>
            <?php
        } else {
            echo "\n"; ?>
    <td align="center" bgcolor="<?php echo $bgcolor; ?>" nowrap="nowrap">
        <?php echo $titles['NoIdxFulltext'] . "\n"; ?>
    </td>
        <?php
        } // end if... else...

    echo "\n"
    ?>
</tr>
    <?php
    unset($field_charset);
} // end while

echo "\n";

$checkall_url = 'tbl_properties_structure.php?' . PMA_generate_common_url($db, $table);
?>

<tr>
    <td colspan="<?php echo PMA_MYSQL_INT_VERSION >= 40100 ? '14' : '13'; ?>">
        <table>
            <tr>
                <td>
                    <img src="<?php echo $pmaThemeImage . 'arrow_' . $text_dir . '.png'; ?>" border="0" width="38" height="22" alt="<?php echo $strWithChecked; ?>">
        <a href="<?php echo $checkall_url; ?>&amp;checkall=1" onClick="setCheckboxes('fieldsForm', true); return false;">
            <?php echo $strCheckAll; ?></a>
        &nbsp;/&nbsp;
        <a href="<?php echo $checkall_url; ?>" onClick="setCheckboxes('fieldsForm', false); return false;">
            <?php echo $strUncheckAll; ?></a>
        &nbsp;&nbsp;&nbsp;
        <i><?php echo $strWithChecked; ?></i>&nbsp;&nbsp;
                </td>
                <td>
                    <?php

if ($cfg['PropertiesIconic']) {
    /* Opera has trouble with <input type="image"> */

    /* IE has trouble with <button> */

    if (PMA_USR_BROWSER_AGENT != 'IE') {
        echo '<button class="mult_submit" type="submit" name="submit_mult" value="' . $strChange . '" title="' . $strChange . '">' . "\n"
           . '<img src="' . $pmaThemeImage . 'b_edit.png" title="' . $strChange . '" alt="' . $strChange . '" width="16" height="16">' . (('both' == $propicon) ? '&nbsp;' . $strChange : '') . "\n"
           . '</button>' . "\n";
    } else {
        echo '                    <input type="image" name="submit_mult_change" value="' . $strChange . '" title="' . $strChange . '" src="' . $pmaThemeImage . 'b_edit.png">' . (('both' == $propicon) ? '&nbsp;' . $strChange : '') . "\n";
    }

    // Drop button if there is at least two fields

    if ($fields_cnt > 1) {
        if (PMA_USR_BROWSER_AGENT != 'IE') {
            echo '                    <button class="mult_submit" type="submit" name="submit_mult" value="' . $strDrop . '" title="' . $strDrop . '">' . "\n"
               . '<img src="' . $pmaThemeImage . 'b_drop.png" title="' . $strDrop . '" alt="' . $strDrop . '" width="16" height="16">' . (('both' == $propicon) ? '&nbsp;' . $strDrop : '') . "\n"
               . '</button>' . "\n";
        } else {
            echo '                    <input type="image" name="submit_mult_drop" value="' . $strDrop . '" title="' . $strDrop . '" src="' . $pmaThemeImage . 'b_drop.png">' . (('both' == $propicon) ? '&nbsp;' . $strDrop : '') . "\n";
        }
    }
} else {
    echo '                    <input type="submit" name="submit_mult" value="' . $strChange . '" title="' . $strChange . '">' . "\n";

    // Drop button if there is at least two fields

    if ($fields_cnt > 1) {
        echo '                    &nbsp;<i>' . $strOr . '</i>&nbsp;' . "\n"
           . '                    <input type="submit" name="submit_mult" value="' . $strDrop . '" title="' . $strDrop . '">' . "\n";
    }
}

?>
                </td>
            </tr>
        </table>
    </td>
</tr>
</table>
</form>

<hr>


<?php
/**
 * Work on the table
 */
?>
<!-- TABLE WORK -->
<table border="0" cellpadding="2" cellspacing="0">
    <tr><td>
    <!-- Printable view of the table -->
        <a href="tbl_printview.php?<?php echo $url_query; ?>"><?php
            if ($cfg['PropertiesIconic']) {
                echo '<img src="' . $pmaThemeImage . 'b_print.png" border="0" hspace="2" align="absmiddle" width="16" height="16">';
            }
            echo $strPrintView;
            ?></a>&nbsp;&nbsp;
                    
<?php
// if internal relations are available, or the table type is INNODB
// ($tbl_type comes from tbl_properties_table_info.php)

if ($cfg['Server']['relation'] || 'INNODB' == $tbl_type) {
    ?>
    <!-- Work on Relations -->
        <a href="tbl_relation.php?<?php echo $url_query; ?>"><?php
            if ($cfg['PropertiesIconic']) {
                echo '<img src="' . $pmaThemeImage . 'b_relations.png" border="0" hspace="2" align="absmiddle" width="16" height="16">';
            }

    echo $strRelationView; ?></a>&nbsp;&nbsp;
    <?php
}
?>
    <!-- Let MySQL propose the optimal structure -->
        <a href="sql.php?<?php echo $url_query; ?>&amp;session_max_rows=all&amp;sql_query=<?php echo urlencode('SELECT * FROM ' . PMA_backquote($table) . ' PROCEDURE ANALYSE()'); ?>"><?php
            if ($cfg['PropertiesIconic']) {
                echo '<img src="' . $pmaThemeImage . 'b_tblanalyse.png" border="0" hspace="2" align="absmiddle" width="16" height="16">';
            }
            echo $strStructPropose;
        ?></a><?php
            echo PMA_showMySQLDocu('Extending_MySQL', 'procedure_analyse') . "\n";
        ?>
        </td></tr>
    <!-- Add some new fields -->
        <form method="post" action="tbl_addfield.php"
            onsubmit="return checkFormElementInRange(this, 'num_fields', 1)">
       <tr><td>
            <?php
                  echo PMA_generate_common_hidden_inputs($db, $table);
                  if ($cfg['PropertiesIconic']) {
                      echo '<img src="' . $pmaThemeImage . 'b_insrow.png" width="16" height="16" border="0" hspace="2" align="absmiddle">';
                  }
                  echo $strAddNewField . ':&nbsp;';
            ?>
            <input type="text" name="num_fields" size="2" maxlength="2" value="1" style="vertical-align: middle" onFocus="this.select()">
            <select name="after_field" style="vertical-align: middle">
                <option value="--end--"><?php echo $strAtEndOfTable; ?></option>
                <option value="--first--"><?php echo $strAtBeginningOfTable; ?></option>
                  <optgroup label="<?php printf($strAfter, ''); ?>" title="<?php printf($strAfter, ''); ?>">
<?php
foreach ($aryFields as $junk => $fieldname) {
                echo '                <option value="' . htmlspecialchars($fieldname, ENT_QUOTES | ENT_HTML5) . '">' . htmlspecialchars($fieldname, ENT_QUOTES | ENT_HTML5) . '</option>' . "\n";
            }
unset($aryFields);
?>
                 </optgroup>
            </select>
            <input type="submit" value="<?php echo $strGo; ?>" style="vertical-align: middle">
        </td></tr></form>
</table>
<hr>

<?php
/**
 * If there are more than 20 rows, displays browse/select/insert/empty/drop
 * links again
 */
if ($fields_cnt > 20) {
    ?>
<!-- Browse links -->
    <?php
    echo "\n";

    require __DIR__ . '/tbl_properties_links.php';
} // end if ($fields_cnt > 20)
echo "\n\n";

/**
 * Displays indexes
 */
?>
<!-- Indexes, space usage and row statistics -->
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td valign="top">
<?php
define('PMA_IDX_INCLUDED', 1);
require('./tbl_indexes.php');
?>
    </td>

<?php
/**
 * Displays Space usage and row statistics
 */
// BEGIN - Calc Table Space - staybyte - 9 June 2001
// loic1, 22 feb. 2002: updated with patch from
//                      Joshua Nye <josh at boxcarmedia.com> to get valid
//                      statistics whatever is the table type
if ($cfg['ShowStats']) {
    $nonisam = false;

    $is_innodb = (isset($showtable['Type']) && 'InnoDB' == $showtable['Type']);

    if (isset($showtable['Type']) && !preg_match('@ISAM|HEAP@i', $showtable['Type'])) {
        $nonisam = true;
    }

    if (false === $nonisam || $is_innodb) {
        // Gets some sizes

        $mergetable = false;

        if (isset($showtable['Type']) && 'MRG_MyISAM' == $showtable['Type']) {
            $mergetable = true;
        }

        [$data_size, $data_unit] = PMA_formatByteDown($showtable['Data_length']);

        if (false === $mergetable) {
            [$index_size, $index_unit] = PMA_formatByteDown($showtable['Index_length']);
        }

        if (isset($showtable['Data_free']) && $showtable['Data_free'] > 0) {
            [$free_size, $free_unit] = PMA_formatByteDown($showtable['Data_free']);

            [$effect_size, $effect_unit] = PMA_formatByteDown($showtable['Data_length'] + $showtable['Index_length'] - $showtable['Data_free']);
        } else {
            [$effect_size, $effect_unit] = PMA_formatByteDown($showtable['Data_length'] + $showtable['Index_length']);
        }

        [$tot_size, $tot_unit] = PMA_formatByteDown($showtable['Data_length'] + $showtable['Index_length']);

        if ($table_info_num_rows > 0) {
            [$avg_size, $avg_unit] = PMA_formatByteDown(($showtable['Data_length'] + $showtable['Index_length']) / $showtable['Rows'], 6, 1);
        }

        // Displays them?>

    <!-- Space usage -->
    <td width="20">&nbsp;</td>
    <td valign="top">
        <a name="showusage"></a>
        <table border="<?php echo $cfg['Border']; ?>" cellpadding="2" cellspacing="1">
        <tr><td class="tblHeaders" colspan="3"><?php echo $strSpaceUsage . ':&nbsp;' . "\n"; ?></td></tr>
        <tr>
            <th><?php echo $strType; ?></th>
            <th colspan="2" align="center"><?php echo $strUsage; ?></th>
        </tr>
        <tr>
            <td bgcolor="<?php echo $cfg['BgcolorTwo']; ?>" style="padding-right: 10px"><?php echo $strData; ?></td>
            <td bgcolor="<?php echo $cfg['BgcolorTwo']; ?>" align="right" nowrap="nowrap"><?php echo $data_size; ?></td>
            <td bgcolor="<?php echo $cfg['BgcolorTwo']; ?>"><?php echo $data_unit; ?></td>
        </tr>
        <?php
        if (isset($index_size)) {
            echo "\n"; ?>
        <tr>
            <td bgcolor="<?php echo $cfg['BgcolorTwo']; ?>" style="padding-right: 10px"><?php echo $strIndex; ?></td>
            <td bgcolor="<?php echo $cfg['BgcolorTwo']; ?>" align="right" nowrap="nowrap"><?php echo $index_size; ?></td>
            <td bgcolor="<?php echo $cfg['BgcolorTwo']; ?>"><?php echo $index_unit; ?></td>
        </tr>
            <?php
        }

        if (isset($free_size)) {
            echo "\n"; ?>
        <tr style="color: #bb0000">
            <td bgcolor="<?php echo $cfg['BgcolorTwo']; ?>" style="padding-right: 10px"><?php echo $strOverhead; ?></td>
            <td bgcolor="<?php echo $cfg['BgcolorTwo']; ?>" align="right" nowrap="nowrap"><?php echo $free_size; ?></td>
            <td bgcolor="<?php echo $cfg['BgcolorTwo']; ?>"><?php echo $free_unit; ?></td>
        </tr>
        <tr>
            <td bgcolor="<?php echo $cfg['BgcolorOne']; ?>" style="padding-right: 10px"><?php echo $strEffective; ?></td>
            <td bgcolor="<?php echo $cfg['BgcolorOne']; ?>" align="right" nowrap="nowrap"><?php echo $effect_size; ?></td>
            <td bgcolor="<?php echo $cfg['BgcolorOne']; ?>"><?php echo $effect_unit; ?></td>
        </tr>
            <?php
        }

        if (isset($tot_size) && false === $mergetable) {
            echo "\n"; ?>
        <tr>
            <td bgcolor="<?php echo $cfg['BgcolorOne']; ?>" style="padding-right: 10px"><?php echo $strTotalUC; ?></td>
            <td bgcolor="<?php echo $cfg['BgcolorOne']; ?>" align="right" nowrap="nowrap"><?php echo $tot_size; ?></td>
            <td bgcolor="<?php echo $cfg['BgcolorOne']; ?>"><?php echo $tot_unit; ?></td>
        </tr>
            <?php
        }

        // Optimize link if overhead

        if (isset($free_size) && ('MYISAM' == $tbl_type || 'BDB' == $tbl_type)) {
            echo "\n"; ?>
        <tr>
            <td colspan="3" align="center" bgcolor="<?php echo $cfg['BgcolorTwo']; ?>">
                <a href="sql.php?<?php echo $url_query; ?>&pos=0&sql_query=<?php echo urlencode('OPTIMIZE TABLE ' . PMA_backquote($table)); ?>"><?php
                    if ($cfg['PropertiesIconic']) {
                        echo '<img src="' . $pmaThemeImage . 'b_tbloptimize.png" width="16" height="16" border="0" hspace="2" align="absmiddle" alt="' . $strOptimizeTable . '">';
                    }

            echo $strOptimizeTable; ?></a>
            </td>
        </tr>
            <?php
        }

        echo "\n"; ?>
        </table>
    </td>

    <!-- Rows Statistic -->
    <td width="20">&nbsp;</td>
    <td valign="top">
        <table border="<?php echo $cfg['Border']; ?>" cellpadding="2" cellspacing="1">
        <tr><td class="tblHeaders" colspan="2"><?php echo $strRowsStatistic . ':&nbsp;' . "\n"; ?></td></tr>
        <tr>
            <th><?php echo $strStatement; ?></th>
            <th align="center"><?php echo $strValue; ?></th>
        </tr>
        <?php
        $i = 0;

        if (isset($showtable['Row_format'])) {
            $bgcolor = ((++$i % 2) ? $cfg['BgcolorTwo'] : $cfg['BgcolorOne']);

            echo "\n"; ?>
        <tr>
            <td bgcolor="<?php echo $bgcolor; ?>"><?php echo $strFormat; ?></td>
            <td bgcolor="<?php echo $bgcolor; ?>" align="<?php echo $cell_align_left; ?>" nowrap="nowrap">
            <?php
            echo '                ';

            if ('Fixed' == $showtable['Row_format']) {
                echo $strFixed;
            } else {
                if ('Dynamic' == $showtable['Row_format']) {
                    echo $strDynamic;
                } else {
                    echo $showtable['Row_format'];
                }
            }

            echo "\n"; ?>
            </td>
        </tr>
            <?php
        }

        if (PMA_MYSQL_INT_VERSION >= 40100) {
            $bgcolor = ((++$i % 2) ? $cfg['BgcolorTwo'] : $cfg['BgcolorOne']); ?>
        <tr>
            <td bgcolor="<?php echo $bgcolor; ?>"><?php echo $strCollation; ?></td>
            <td bgcolor="<?php echo $bgcolor; ?>" align="<?php echo $cell_align_left; ?>" nowrap="nowrap">
            <?php
            echo '<dfn title="' . PMA_getCollationDescr($tbl_collation) . '">' . $tbl_collation . '</dfn>'; ?>
            </td>
        </tr>
            <?php
        }

        if (!$is_innodb && isset($showtable['Rows'])) {
            $bgcolor = ((++$i % 2) ? $cfg['BgcolorTwo'] : $cfg['BgcolorOne']);

            echo "\n"; ?>
        <tr>
            <td bgcolor="<?php echo $bgcolor; ?>"><?php echo $strRows; ?></td>
            <td bgcolor="<?php echo $bgcolor; ?>" align="right" nowrap="nowrap">
                <?php echo number_format($showtable['Rows'], 0, $number_decimal_separator, $number_thousands_separator) . "\n"; ?>
            </td>
        </tr>
            <?php
        }

        if (!$is_innodb && isset($showtable['Avg_row_length']) && $showtable['Avg_row_length'] > 0) {
            $bgcolor = ((++$i % 2) ? $cfg['BgcolorTwo'] : $cfg['BgcolorOne']);

            echo "\n"; ?>
        <tr>
            <td bgcolor="<?php echo $bgcolor; ?>"><?php echo $strRowLength; ?>&nbsp;&oslash;</td>
            <td bgcolor="<?php echo $bgcolor; ?>" align="right" nowrap="nowrap">
                <?php echo number_format($showtable['Avg_row_length'], 0, $number_decimal_separator, $number_thousands_separator) . "\n"; ?>
            </td>
        </tr>
            <?php
        }

        if (!$is_innodb && isset($showtable['Data_length']) && $showtable['Rows'] > 0 && false === $mergetable) {
            $bgcolor = ((++$i % 2) ? $cfg['BgcolorTwo'] : $cfg['BgcolorOne']);

            echo "\n"; ?>
        <tr>
            <td bgcolor="<?php echo $bgcolor; ?>"><?php echo $strRowSize; ?>&nbsp;&oslash;</td>
            <td bgcolor="<?php echo $bgcolor; ?>" align="right" nowrap="nowrap">
                <?php echo $avg_size . ' ' . $avg_unit . "\n"; ?>
            </td>
        </tr>
            <?php
        }

        if (isset($showtable['Auto_increment'])) {
            $bgcolor = ((++$i % 2) ? $cfg['BgcolorTwo'] : $cfg['BgcolorOne']);

            echo "\n"; ?>
        <tr>
            <td bgcolor="<?php echo $bgcolor; ?>"><?php echo $strNext; ?>&nbsp;Autoindex</td>
            <td bgcolor="<?php echo $bgcolor; ?>" align="right" nowrap="nowrap">
                <?php echo number_format($showtable['Auto_increment'], 0, $number_decimal_separator, $number_thousands_separator) . "\n"; ?>
            </td>
        </tr>
            <?php
        }

        echo "\n";

        if (isset($showtable['Create_time'])) {
            $bgcolor = ((++$i % 2) ? $cfg['BgcolorTwo'] : $cfg['BgcolorOne']);

            echo "\n"; ?>
        <tr>
            <td bgcolor="<?php echo $bgcolor; ?>"><?php echo $strStatCreateTime; ?></td>
            <td<?php if ('original' == $theme || '' == $theme) {
                echo ' style="font-size:' . $font_smaller . '"';
            } ?> align="right" bgcolor="<?php echo $bgcolor; ?>" nowrap="nowrap">
                <?php echo PMA_localisedDate(strtotime($showtable['Create_time'])) . "\n"; ?>
            </td>
        </tr>
                <?php
        }

        echo "\n";

        if (isset($showtable['Update_time'])) {
            $bgcolor = ((++$i % 2) ? $cfg['BgcolorTwo'] : $cfg['BgcolorOne']);

            echo "\n"; ?>
        <tr>
            <td bgcolor="<?php echo $bgcolor; ?>"><?php echo $strStatUpdateTime; ?></td>
            <td<?php if ('original' == $theme || '' == $theme) {
                echo ' style="font-size:' . $font_smaller . '"';
            } ?> align="right" bgcolor="<?php echo $bgcolor; ?>" nowrap="nowrap">
                <?php echo PMA_localisedDate(strtotime($showtable['Update_time'])) . "\n"; ?>
            </td>
        </tr>
                <?php
        }

        echo "\n";

        if (isset($showtable['Check_time'])) {
            $bgcolor = ((++$i % 2) ? $cfg['BgcolorTwo'] : $cfg['BgcolorOne']);

            echo "\n"; ?>
        <tr>
            <td bgcolor="<?php echo $bgcolor; ?>"><?php echo $strStatCheckTime; ?></td>
            <td<?php if ('original' == $theme || '' == $theme) {
                echo ' style="font-size:' . $font_smaller . '"';
            } ?> align="right" bgcolor="<?php echo $bgcolor; ?>" nowrap="nowrap">
                <?php echo PMA_localisedDate(strtotime($showtable['Check_time'])) . "\n"; ?>
            </td>
        </tr>
            <?php
        }

        echo "\n"; ?>
        </table>
    </td>
        <?php
    }
}
// END - Calc Table Space
echo "\n";
?>
</tr>
</table>
<hr>
<?php
/**
 * Query box, bookmark, insert data from textfile
 */
$goto = 'tbl_properties_structure.php';
require __DIR__ . '/tbl_query_box.php';

/**
 * Displays the footer
 */
require_once __DIR__ . '/footer.inc.php';
?>
