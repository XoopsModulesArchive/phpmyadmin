<?php

/* $Id: browse_foreigners.php,v 2.13 2004/06/23 14:11:53 lem9 Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:

/**
 * Get the variables sent or posted to this script and displays the header
 */
require_once __DIR__ . '/libraries/grab_globals.lib.php';

/**
 * Gets a core script and starts output buffering work
 */
require_once __DIR__ . '/libraries/common.lib.php';

PMA_checkParameters(['db', 'table', 'field']);

require_once __DIR__ . '/libraries/ob.lib.php';
if ($cfg['OBGzip']) {
    $ob_mode = PMA_outBufferModeGet();

    if ($ob_mode) {
        PMA_outBufferPre($ob_mode);
    }
}
require_once __DIR__ . '/libraries/header_http.inc.php';
$field = urldecode($field);

/**
 * Displays the frame
 */
// Gets the font sizes to use
PMA_setFontSizes();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $available_languages[$lang][2]; ?>" lang="<?php echo $available_languages[$lang][2]; ?>" dir="<?php echo $text_dir; ?>">

<head>
    <title>phpMyAdmin</title>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charset; ?>">
    <base<?php if (!empty($cfg['PmaAbsoluteUri'])) {
    echo ' href="' . $cfg['PmaAbsoluteUri'] . '"';
} ?>>
    <link rel="stylesheet" type="text/css" href="./css/phpmyadmin.css.php?lang=<?php echo $lang; ?>&amp;js_frame=right">
    <script src="libraries/functions.js" type="text/javascript" language="javascript"></script>
    <script type="text/javascript" language="javascript">
    self.focus();
    function formupdate(field, key) {
        if (opener && opener.document && opener.document.insertForm && opener.document.insertForm.elements['field_' + field + '<?php echo(isset($pk) ? '[multi_edit][' . urlencode($pk) . ']' : ''); ?>[]']) {
            opener.document.insertForm.elements['field_' + field + '<?php echo(isset($pk) ? '[multi_edit][' . urlencode($pk) . ']' : ''); ?>[]'].value = key;
            self.close();
        } else {
            alert('<?php echo PMA_jsFormat($strWindowNotFound); ?>');
        }
    }
    </script>
</head>

<body bgcolor="<?php echo $cfg['LeftBgColor']; ?>" style="margin-left: 5px; margin-top: 5px; margin-right: 5px; margin-bottom: 0px">
<?php
$per_page = 200;
require_once __DIR__ . '/libraries/relation.lib.php'; // foreign keys
require_once __DIR__ . '/libraries/transformations.lib.php'; // Transformations
$cfgRelation = PMA_getRelationsParam();
$foreigners = ($cfgRelation['relwork'] ? PMA_getForeigners($db, $table) : false);

$override_total = true;

if (!isset($pos)) {
    $pos = 0;
}

$foreign_limit = 'LIMIT ' . $pos . ', ' . $per_page . ' ';
if (isset($foreign_navig) && $foreign_navig == $strShowAll) {
    unset($foreign_limit);
}

require __DIR__ . '/libraries/get_foreign.lib.php';
?>

<form action="browse_foreigners.php" method="post">
<?php echo PMA_generate_common_hidden_inputs($db, $table); ?>
<input type="hidden" name="field" value="<?php echo urlencode($field); ?>">
<?php
if (isset($pk)) {
    $pk_uri = '&amp;pk=' . urlencode($pk); ?>
<input type="hidden" name="pk" value="<?php echo urlencode($pk); ?>">
<?php
} else {
        $pk_uri = '&amp;';
    }
?>

<table width="100%">
<?php
if ($cfg['ShowAll'] && ($the_total > $per_page)) {
    $showall = '<input type="submit" name="foreign_navig" value="' . $strShowAll . '">';
} else {
    $showall = '';
}

$session_max_rows = $per_page;
$pageNow = @floor($pos / $session_max_rows) + 1;
$nbTotalPage = @ceil($the_total / $session_max_rows);

if ($the_total > $per_page) {
    $gotopage = '<br>' . $GLOBALS['strPageNumber']
              . '<select name="goToPage" onChange="goToUrl(this, \'browse_foreigners.php?field=' . urlencode($field) . '&amp;' . PMA_generate_common_url($db, $table) . $pk_uri . '\');">';

    if ($nbTotalPage < 200) {
        $firstPage = 1;

        $lastPage = $nbTotalPage;
    } else {
        $range = 20;

        $firstPage = ($pageNow - $range < 1 ? 1 : $pageNow - $range);

        $lastPage = ($pageNow + $range > $nbTotalPage ? $nbTotalPage : $pageNow + $range);
    }

    for ($i = $firstPage; $i <= $lastPage; $i++) {
        if ($i == $pageNow) {
            $selected = 'selected="selected"';
        } else {
            $selected = '';
        }

        $gotopage .= '                <option ' . $selected . ' value="' . (($i - 1) * $session_max_rows) . '">' . $i . '</option>' . "\n";
    }
} else {
    $gotopage = '';
}

$header = '    <tr>
    <th align="left" nowrap="nowrap">' . $strKeyname . '</th>
    <th>' . $strDescription . '</th>
    <td align="center" width="20%" valign="top">
        ' . $showall . '
        ' . $gotopage . '
    </td>
    <th>' . $strDescription . '</th>
    <th align="left" nowrap="nowrap">' . $strKeyname . '</th>
</tr>';

echo $header;

if (isset($disp_row) && is_array($disp_row)) {
    function dimsort($arrayA, $arrayB)
    {
        $keyA = key($arrayA);

        $keyB = key($arrayB);

        if ($arrayA[$keyA] == $arrayB[$keyB]) {
            return 0;
        }

        return ($arrayA[$keyA] < $arrayB[$keyB]) ? -1 : 1;
    }

    $mysql_key_relrow = [];

    $mysql_val_relrow = [];

    $count = 0;

    foreach ($disp_row as $disp_row_key => $relrow) {
        if (false !== $foreign_display) {
            $val = $relrow[$foreign_display];
        } else {
            $val = '';
        }

        $mysql_key_relrow[$count] = [$relrow[$foreign_field] => $val];

        $mysql_val_relrow[$count] = [$val => $relrow[$foreign_field]];

        $count++;
    }

    usort($mysql_val_relrow, 'dimsort');

    $hcount = 0;

    for ($i = 0; $i < $count; $i++) {
        $hcount++;

        $bgcolor = ($hcount % 2) ? $cfg['BgcolorOne'] : $cfg['BgcolorTwo'];

        if ($cfg['RepeatCells'] > 0 && $hcount > $cfg['RepeatCells']) {
            echo $header;

            $hcount = -1;
        }

        $val = key($mysql_val_relrow[$i]);

        $key = $mysql_val_relrow[$i][$val];

        if (mb_strlen($val) <= $cfg['LimitChars']) {
            $value = htmlspecialchars($val, ENT_QUOTES | ENT_HTML5);

            $vtitle = '';
        } else {
            $vtitle = htmlspecialchars($val, ENT_QUOTES | ENT_HTML5);

            $value = htmlspecialchars(PMA_substr($val, 0, $cfg['LimitChars']) . '...', ENT_QUOTES | ENT_HTML5);
        }

        $key_equals_data = isset($data) && $key == $data; ?>
    <tr>
        <td nowrap="nowrap" bgcolor="<?php echo $bgcolor; ?>"><?php echo($key_equals_data ? '<b>' : '') . '<a href="#" title="' . $strUseThisValue . ('' != $vtitle ? ': ' . $vtitle : '') . '" onclick="formupdate(\'' . md5($field) . '\', \'' . htmlspecialchars($key, ENT_QUOTES | ENT_HTML5)
                                                                        . '\'); return false;">' . htmlspecialchars($key, ENT_QUOTES | ENT_HTML5)
                                                                        . '</a>' . ($key_equals_data ? '</b>' : ''); ?></td>
        <td bgcolor="<?php echo $bgcolor; ?>"><?php echo($key_equals_data ? '<b>' : '') . '<a href="#" title="' . $strUseThisValue . ('' != $vtitle ? ': ' . $vtitle : '') . '" onclick="formupdate(\'' . md5($field) . '\', \'' . htmlspecialchars($key, ENT_QUOTES | ENT_HTML5)
                                                        . '\'); return false;">' . $value . '</a>' . ($key_equals_data ? '</b>' : ''); ?></td>
        <td width="20%"><img src="<?php echo $GLOBALS['pmaThemeImage'] . 'spacer.png'; ?>" alt="" width="1" height="1"></td>
<?php
        $key = key($mysql_key_relrow[$i]);

        $val = $mysql_key_relrow[$i][$key];

        if (mb_strlen($val) <= $cfg['LimitChars']) {
            $value = htmlspecialchars($val, ENT_QUOTES | ENT_HTML5);

            $vtitle = '';
        } else {
            $vtitle = htmlspecialchars($val, ENT_QUOTES | ENT_HTML5);

            $value = htmlspecialchars(mb_substr($val, 0, $cfg['LimitChars']) . '...', ENT_QUOTES | ENT_HTML5);
        }

        $key_equals_data = isset($data) && $key == $data; ?>
        <td bgcolor="<?php echo $bgcolor; ?>"><?php echo($key_equals_data ? '<b>' : '') . '<a href="#" title="' . $strUseThisValue . ('' != $vtitle ? ': ' . $vtitle : '') . '" onclick="formupdate(\'' . md5($field) . '\', \'' . htmlspecialchars($key, ENT_QUOTES | ENT_HTML5)
                                                        . '\'); return false;">' . $value . '</a>' . ($key_equals_data ? '</b>' : ''); ?></td>
        <td nowrap="nowrap" bgcolor="<?php echo $bgcolor; ?>"><?php echo($key_equals_data ? '<b>' : '') . '<a href="#" title="' . $strUseThisValue . ('' != $vtitle ? ': ' . $vtitle : '') . '" onclick="formupdate(\'' . md5($field) . '\', \'' . htmlspecialchars($key, ENT_QUOTES | ENT_HTML5)
                                                                        . '\'); return false;">' . htmlspecialchars($key, ENT_QUOTES | ENT_HTML5)
                                                                        . '</a>' . ($key_equals_data ? '</b>' : ''); ?></td>
    </tr>
<?php
        unset($key_equals_data);
    } // end while
}

echo $header;
?>
</table>
</form>

</body>
</html>

<?php
/**
 * Close MySql connections
 */
if (isset($dbh) && $dbh) {
    @PMA_DBI_close($dbh);
}
if (isset($userlink) && $userlink) {
    @PMA_DBI_close($userlink);
}

/**
 * Sends bufferized data
 */
if (isset($cfg['OBGzip']) && $cfg['OBGzip']
    && isset($ob_mode) && $ob_mode) {
    PMA_outBufferPost($ob_mode);
}
?>
