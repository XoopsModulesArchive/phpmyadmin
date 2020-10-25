<?php

/* $Id: db_details_qbe.php,v 2.11 2004/07/08 14:41:07 lem9 Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:

/**
 * Get the values of the variables posted or sent to this script and display
 * the headers
 */
require_once __DIR__ . '/libraries/grab_globals.lib.php';
require_once __DIR__ . '/libraries/common.lib.php';
require_once __DIR__ . '/libraries/relation.lib.php';

/**
 * Gets the relation settings
 */
$cfgRelation = PMA_getRelationsParam();

/**
 * A query has been submitted -> execute it, else display the headers
 */
if (isset($submit_sql) && 0 === stripos($encoded_sql_query, "SELECT")) {
    $goto = 'db_details.php';

    $zero_rows = htmlspecialchars($strSuccess, ENT_QUOTES | ENT_HTML5);

    $sql_query = urldecode($encoded_sql_query);

    require __DIR__ . '/sql.php';

    exit();
}
    $sub_part = '_qbe';
    require __DIR__ . '/db_details_common.php';
    $url_query .= '&amp;goto=db_details_qbe.php';
    require __DIR__ . '/db_details_db_info.php';

if (isset($submit_sql) && 0 !== stripos($encoded_sql_query, "SELECT")) {
    echo '<p class="warning">' . $strHaveToShow . '</p>';
}

/**
 * Initialize some variables
 */
if (empty($Columns)) {
    $Columns = 3;  // Initial number of columns
}
if (!isset($Add_Col)) {
    $Add_Col = '';
}
if (!isset($Add_Row)) {
    $Add_Row = '';
}
if (!isset($Rows)) {
    $Rows = '';
}
if (!isset($InsCol)) {
    $InsCol = [];
}
if (!isset($DelCol)) {
    $DelCol = [];
}
if (!isset($prev_Criteria)) {
    $prev_Criteria = '';
}
if (!isset($Criteria)) {
    $Criteria = [];

    for ($i = 0; $i < $Columns; $i++) {
        $Criteria[$i] = '';
    }
}
if (!isset($InsRow)) {
    $InsRow = [];

    for ($i = 0; $i < $Columns; $i++) {
        $InsRow[$i] = '';
    }
}
if (!isset($DelRow)) {
    $DelRow = [];

    for ($i = 0; $i < $Columns; $i++) {
        $DelRow[$i] = '';
    }
}
if (!isset($AndOrRow)) {
    $AndOrRow = [];

    for ($i = 0; $i < $Columns; $i++) {
        $AndOrRow[$i] = '';
    }
}
if (!isset($AndOrCol)) {
    $AndOrCol = [];

    for ($i = 0; $i < $Columns; $i++) {
        $AndOrCol[$i] = '';
    }
}
// minimum width
$wid = 12;
$col = $Columns + $Add_Col;
if ($col < 0) {
    $col = 0;
}
$row = $Rows + $Add_Row;
if ($row < 0) {
    $row = 0;
}

/**
 * Prepares the form
 */
$tbl_result = PMA_DBI_query('SHOW TABLES FROM ' . PMA_backquote($db) . ';', null, PMA_DBI_QUERY_STORE);
$tbl_result_cnt = PMA_DBI_num_rows($tbl_result);
$i = 0;
$k = 0;

// The tables list sent by a previously submitted form
if (!empty($TableList)) {
    $cnt_table_list = count($TableList);

    for ($x = 0; $x < $cnt_table_list; $x++) {
        $tbl_names[urldecode($TableList[$x])] = ' selected="selected"';
    }
} // end if

// The tables list gets from MySQL
while ($i < $tbl_result_cnt) {
    [$tbl] = PMA_DBI_fetch_row($tbl_result);

    $fld_results = PMA_DBI_get_fields($db, $tbl);

    $fld_results_cnt = ($fld_results) ? count($fld_results) : 0;

    $j = 0;

    if (empty($tbl_names[$tbl]) && !empty($TableList)) {
        $tbl_names[$tbl] = '';
    } else {
        $tbl_names[$tbl] = ' selected="selected"';
    } //  end if

    // The fields list per selected tables

    if (' selected="selected"' == $tbl_names[$tbl]) {
        $fld[$k++] = PMA_backquote($tbl) . '.*';

        while ($j < $fld_results_cnt) {
            $fld[$k] = PMA_convert_display_charset($fld_results[$j]['Field']);

            $fld[$k] = PMA_backquote($tbl) . '.' . PMA_backquote($fld[$k]);

            // increase the width if necessary

            if (mb_strlen($fld[$k]) > $wid) {
                $wid = mb_strlen($fld[$k]);
            } //end if

            $k++;

            $j++;
        } // end while
    } // end if

    $i++;
} // end if
PMA_DBI_free_result($tbl_result);

// largest width found
$realwidth = $wid . 'ex';

/**
 * Displays the form
 */
?>

<!-- Query by example form -->
<form action="db_details_qbe.php" method="post">
<table border="<?php echo $cfg['Border']; ?>" cellpadding="2" cellspacing="1">

    <!-- Fields row -->
    <tr>
        <td align="<?php echo $cell_align_right; ?>" bgcolor="<?php echo $cfg['ThBgcolor']; ?>">
            <b><?php echo $strField; ?>:&nbsp;</b>
        </td>
<?php
$z = 0;
for ($x = 0; $x < $col; $x++) {
    if (!empty($InsCol) && isset($InsCol[$x]) && 'on' == $InsCol[$x]) {
        ?>
        <td align="center" bgcolor="<?php echo $cfg['BgcolorOne']; ?>">
            <select style="width: <?php echo $realwidth; ?>" name="Field[<?php echo $z; ?>]" size="1">
                <option value=""></option>
        <?php
        echo "\n";

        for ($y = 0, $yMax = count($fld); $y < $yMax; $y++) {
            if ('' == $fld[$y]) {
                $sel = ' selected="selected"';
            } else {
                $sel = '';
            }

            echo '                ';

            echo '<option value="' . htmlspecialchars($fld[$y], ENT_QUOTES | ENT_HTML5) . '"' . $sel . '>' . htmlspecialchars($fld[$y], ENT_QUOTES | ENT_HTML5) . '</option>' . "\n";
        } // end for?>
            </select>
        </td>
        <?php
        $z++;
    } // end if
    echo "\n";

    if (!empty($DelCol) && isset($DelCol[$x]) && 'on' == $DelCol[$x]) {
        continue;
    } ?>
        <td align="center" bgcolor="<?php echo $cfg['BgcolorOne']; ?>">
            <select style="width: <?php echo $realwidth; ?>" name="Field[<?php echo $z; ?>]" size="1">
                <option value=""></option>
    <?php
    echo "\n";

    for ($y = 0, $yMax = count($fld); $y < $yMax; $y++) {
        if (isset($Field[$x]) && $fld[$y] == urldecode($Field[$x])) {
            $curField[$z] = urldecode($Field[$x]);

            $sel = ' selected="selected"';
        } else {
            $sel = '';
        } // end if

        echo '                ';

        echo '<option value="' . htmlspecialchars($fld[$y], ENT_QUOTES | ENT_HTML5) . '"' . $sel . '>' . htmlspecialchars($fld[$y], ENT_QUOTES | ENT_HTML5) . '</option>' . "\n";
    } // end for?>
            </select>
        </td>
    <?php
    $z++;

    echo "\n";
} // end for
?>
    </tr>

    <!-- Sort row -->
    <tr>
        <td align="<?php echo $cell_align_right; ?>" bgcolor="<?php echo $cfg['ThBgcolor']; ?>">
            <b><?php echo $strSort; ?>:&nbsp;</b>
        </td>
<?php
$z = 0;
for ($x = 0; $x < $col; $x++) {
    if (!empty($InsCol) && isset($InsCol[$x]) && 'on' == $InsCol[$x]) {
        ?>
        <td align="center" bgcolor="<?php echo $cfg['BgcolorTwo']; ?>">
            <select style="width: <?php echo $realwidth; ?>" name="Sort[<?php echo $z; ?>]" size="1">
                <option value=""></option>
                <option value="ASC"><?php echo $strAscending; ?></option>
                <option value="DESC"><?php echo $strDescending; ?></option>
            </select>
        </td>
        <?php
        $z++;
    } // end if

    echo "\n";

    if (!empty($DelCol) && isset($DelCol[$x]) && 'on' == $DelCol[$x]) {
        continue;
    } ?>
        <td align="center" bgcolor="<?php echo $cfg['BgcolorTwo']; ?>">
            <select style="width: <?php echo $realwidth; ?>" name="Sort[<?php echo $z; ?>]" size="1">
                <option value=""></option>
    <?php
    echo "\n";

    // If they have chosen all fields using the * selector,

    // then sorting is not available

    // Robbat2 - Fix for Bug #570698

    if (isset($Sort[$x]) && isset($Field[$x]) && ('.*' == mb_substr(urldecode($Field[$x]), -2))) {
        $Sort[$x] = '';
    } //end if

    if (isset($Sort[$x]) && 'ASC' == $Sort[$x]) {
        $curSort[$z] = $Sort[$x];

        $sel = ' selected="selected"';
    } else {
        $sel = '';
    } // end if

    echo '                ';

    echo '<option value="ASC"' . $sel . '>' . $strAscending . '</option>' . "\n";

    if (isset($Sort[$x]) && 'DESC' == $Sort[$x]) {
        $curSort[$z] = $Sort[$x];

        $sel = ' selected="selected"';
    } else {
        $sel = '';
    } // end if

    echo '                ';

    echo '<option value="DESC"' . $sel . '>' . $strDescending . '</option>' . "\n"; ?>
            </select>
        </td>
    <?php
    $z++;

    echo "\n";
} // end for
?>
    </tr>

    <!-- Show row -->
    <tr>
        <td align="<?php echo $cell_align_right; ?>" bgcolor="<?php echo $cfg['ThBgcolor']; ?>">
            <b><?php echo $strShow; ?>:&nbsp;</b>
        </td>
<?php
$z = 0;
for ($x = 0; $x < $col; $x++) {
    if (!empty($InsCol) && isset($InsCol[$x]) && 'on' == $InsCol[$x]) {
        ?>
        <td align="center" bgcolor="<?php echo $cfg['BgcolorOne']; ?>">
            <input type="checkbox" name="Show[<?php echo $z; ?>]">
        </td>
        <?php
        $z++;
    } // end if

    echo "\n";

    if (!empty($DelCol) && isset($DelCol[$x]) && 'on' == $DelCol[$x]) {
        continue;
    }

    if (isset($Show[$x])) {
        $checked = ' checked';

        $curShow[$z] = $Show[$x];
    } else {
        $checked = '';
    } ?>
        <td align="center" bgcolor="<?php echo $cfg['BgcolorOne']; ?>">
            <input type="checkbox" name="Show[<?php echo $z; ?>]"<?php echo $checked; ?>>
        </td>
    <?php
    $z++;

    echo "\n";
} // end for
?>
    </tr>

    <!-- Criteria row -->
    <tr>
        <td align="<?php echo $cell_align_right; ?>" bgcolor="<?php echo $cfg['ThBgcolor']; ?>">
            <b><?php echo $strCriteria; ?>:&nbsp;</b>
        </td>
<?php
$z = 0;
for ($x = 0; $x < $col; $x++) {
    if (!empty($InsCol) && isset($InsCol[$x]) && 'on' == $InsCol[$x]) {
        ?>
        <td align="center" bgcolor="<?php echo $cfg['BgcolorTwo']; ?>">
            <input type="text" name="Criteria[<?php echo $z; ?>]" value="" class="textfield" style="width: <?php echo $realwidth; ?>" size="20">
        </td>
        <?php
        $z++;
    } // end if

    echo "\n";

    if (!empty($DelCol) && isset($DelCol[$x]) && 'on' == $DelCol[$x]) {
        continue;
    }

    if (isset($Criteria[$x])) {
        $stripped_Criteria = $Criteria[$x];
    }

    if ((empty($prev_Criteria) || !isset($prev_Criteria[$x]))
        || urldecode($prev_Criteria[$x]) != htmlspecialchars($stripped_Criteria, ENT_QUOTES | ENT_HTML5)) {
        $curCriteria[$z] = $stripped_Criteria;

        $encoded_Criteria = urlencode($stripped_Criteria);
    } else {
        $curCriteria[$z] = urldecode($prev_Criteria[$x]);

        $encoded_Criteria = $prev_Criteria[$x];
    } ?>
        <td align="center" bgcolor="<?php echo $cfg['BgcolorTwo']; ?>">
            <input type="hidden" name="prev_Criteria[<?php echo $z; ?>]" value="<?php echo $encoded_Criteria; ?>">
            <input type="text" name="Criteria[<?php echo $z; ?>]" value="<?php echo htmlspecialchars($stripped_Criteria, ENT_QUOTES | ENT_HTML5); ?>" class="textfield" style="width: <?php echo $realwidth; ?>" size="20">
        </td>
    <?php
    $z++;

    echo "\n";
} // end for
?>
    </tr>

    <!-- And/Or columns and rows -->
<?php
$w = 0;
for ($y = 0; $y <= $row; $y++) {
    $bgcolor = ($y % 2) ? $cfg['BgcolorOne'] : $cfg['BgcolorTwo'];

    if (isset($InsRow[$y]) && 'on' == $InsRow[$y]) {
        $chk['or'] = ' checked';

        $chk['and'] = ''; ?>
    <tr>
        <td align="<?php echo $cell_align_right; ?>" bgcolor="<?php echo $bgcolor; ?>" nowrap="nowrap">
            <!-- Row controls -->
            <table bgcolor="<?php echo $bgcolor; ?>" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td align="<?php echo $cell_align_right; ?>" nowrap="nowrap">
                    <small><?php echo $strQBEIns; ?>:</small>
                    <input type="checkbox" name="InsRow[<?php echo $w; ?>]">
                </td>
                <td align="<?php echo $cell_align_right; ?>">
                    <b><?php echo $strAnd; ?>&nbsp;:</b>
                </td>
                <td>
                    <input type="radio" name="AndOrRow[<?php echo $w; ?>]" value="and"<?php echo $chk['and']; ?>>
                    &nbsp;
                </td>
            </tr>
            <tr>
                <td align="<?php echo $cell_align_right; ?>" nowrap="nowrap">
                    <small><?php echo $strQBEDel; ?>:</small>
                    <input type="checkbox" name="DelRow[<?php echo $w; ?>]">
                </td>
                <td align="<?php echo $cell_align_right; ?>">
                    <b><?php echo $strOr; ?>:</b>
                </td>
                <td>
                    <input type="radio" name="AndOrRow[<?php echo $w; ?>]" value="or"<?php echo $chk['or']; ?>>
                    &nbsp;
                </td>
            </tr>
            </table>
        </td>
        <?php
        $z = 0;

        for ($x = 0; $x < $col; $x++) {
            if (isset($InsCol[$x]) && 'on' == $InsCol[$x]) {
                echo "\n";

                $or = 'Or' . $w . '[' . $z . ']'; ?>
        <td align="center" bgcolor="<?php echo $bgcolor; ?>">
            <textarea cols="20" rows="2" style="width: <?php echo $realwidth; ?>" name="<?php echo $or; ?>" dir="<?php echo $text_dir; ?>"></textarea>
        </td>
                <?php
                $z++;
            } // end if

            if (isset($DelCol[$x]) && 'on' == $DelCol[$x]) {
                continue;
            }

            echo "\n";

            $or = 'Or' . $w . '[' . $z . ']'; ?>
        <td align="center" bgcolor="<?php echo $bgcolor; ?>">
            <textarea cols="20" rows="2" style="width: <?php echo $realwidth; ?>" name="<?php echo $or; ?>" dir="<?php echo $text_dir; ?>"></textarea>
        </td>
            <?php
            $z++;
        } // end for

        $w++;

        echo "\n"; ?>
    </tr>
        <?php
    } // end if

    if (isset($DelRow[$y]) && 'on' == $DelRow[$y]) {
        continue;
    }

    if (isset($AndOrRow[$y])) {
        $curAndOrRow[$w] = $AndOrRow[$y];
    }

    if (isset($AndOrRow[$y]) && 'and' == $AndOrRow[$y]) {
        $chk['and'] = ' checked';

        $chk['or'] = '';
    } else {
        $chk['or'] = ' checked';

        $chk['and'] = '';
    }

    echo "\n"; ?>
    <tr>
        <td align="<?php echo $cell_align_right; ?>" bgcolor="<?php echo $bgcolor; ?>" nowrap="nowrap">
            <!-- Row controls -->
            <table bgcolor="<?php echo $bgcolor; ?>" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td align="<?php echo $cell_align_right; ?>" nowrap="nowrap">
                    <small><?php echo $strQBEIns; ?>:</small>
                    <input type="checkbox" name="InsRow[<?php echo $w; ?>]">
                </td>
                <td align="<?php echo $cell_align_right; ?>">
                    <b><?php echo $strAnd; ?>:</b>
                </td>
                <td>
                    <input type="radio" name="AndOrRow[<?php echo $w; ?>]" value="and"<?php echo $chk['and']; ?>>
                </td>
            </tr>
            <tr>
                <td align="<?php echo $cell_align_right; ?>" nowrap="nowrap">
                    <small><?php echo $strQBEDel; ?>:</small>
                    <input type="checkbox" name="DelRow[<?php echo $w; ?>]">
                </td>
                <td align="<?php echo $cell_align_right; ?>">
                    <b><?php echo $strOr; ?>:</b>
                </td>
                <td>
                    <input type="radio" name="AndOrRow[<?php echo $w; ?>]" value="or"<?php echo $chk['or']; ?>>
                </td>
            </tr>
            </table>
        </td>
    <?php
    $z = 0;

    for ($x = 0; $x < $col; $x++) {
        if (!empty($InsCol) && isset($InsCol[$x]) && 'on' == $InsCol[$x]) {
            echo "\n";

            $or = 'Or' . $w . '[' . $z . ']'; ?>
        <td align="center" bgcolor="<?php echo $bgcolor; ?>">
            <textarea cols="20" rows="2" style="width: <?php echo $realwidth; ?>" name="<?php echo $or; ?>" dir="<?php echo $text_dir; ?>"></textarea>
        </td>
            <?php
            $z++;
        } // end if

        if (!empty($DelCol) && isset($DelCol[$x]) && 'on' == $DelCol[$x]) {
            continue;
        }

        echo "\n";

        $or = 'Or' . $y;

        if (!isset(${$or})) {
            ${$or} = '';
        }

        if (!empty(${$or}) && isset(${$or}[$x])) {
            $stripped_or = ${$or}[$x];
        } else {
            $stripped_or = '';
        } ?>
        <td align="center" bgcolor="<?php echo $bgcolor; ?>">
            <textarea cols="20" rows="2" style="width: <?php echo $realwidth; ?>" name="Or<?php echo $w . '[' . $z . ']'; ?>" dir="<?php echo $text_dir; ?>"><?php echo htmlspecialchars($stripped_or, ENT_QUOTES | ENT_HTML5); ?></textarea>
        </td>
        <?php
        if (!empty(${$or}) && isset(${$or}[$x])) {
            ${'cur' . $or}[$z] = ${$or}[$x];
        }

        $z++;
    } // end for

    $w++;

    echo "\n"; ?>
    </tr>
    <?php
    echo "\n";
} // end for
?>

    <!-- Modify columns -->
    <tr>
        <td align="<?php echo $cell_align_right; ?>" bgcolor="<?php echo $cfg['ThBgcolor']; ?>">
            <b><?php echo $strModify; ?>:&nbsp;</b>
        </td>
<?php
$z = 0;
for ($x = 0; $x < $col; $x++) {
    if (!empty($InsCol) && isset($InsCol[$x]) && 'on' == $InsCol[$x]) {
        $curAndOrCol[$z] = $AndOrCol[$y];

        if ('or' == $AndOrCol[$z]) {
            $chk['or'] = ' checked';

            $chk['and'] = '';
        } else {
            $chk['and'] = ' checked';

            $chk['or'] = '';
        } ?>
        <td align="center" bgcolor="<?php echo $cfg['BgcolorTwo']; ?>">
            <b><?php echo $strOr; ?>:</b>
            <input type="radio" name="AndOrCol[<?php echo $z; ?>]" value="or"<?php echo $chk['or']; ?>>
            &nbsp;&nbsp;<b><?php echo $strAnd; ?>:</b>
            <input type="radio" name="AndOrCol[<?php echo $z; ?>]" value="and"<?php echo $chk['and']; ?>>
            <br>
            <?php echo $strQBEIns . "\n"; ?>
            <input type="checkbox" name="InsCol[<?php echo $z; ?>]">
            &nbsp;&nbsp;<?php echo $strQBEDel . "\n"; ?>
            <input type="checkbox" name="DelCol[<?php echo $z; ?>]">
        </td>
        <?php
        $z++;
    } // end if

    echo "\n";

    if (!empty($DelCol) && isset($DelCol[$x]) && 'on' == $DelCol[$x]) {
        continue;
    }

    if (isset($AndOrCol[$y])) {
        $curAndOrCol[$z] = $AndOrCol[$y];
    }

    if (isset($AndOrCol[$z]) && 'or' == $AndOrCol[$z]) {
        $chk['or'] = ' checked';

        $chk['and'] = '';
    } else {
        $chk['and'] = ' checked';

        $chk['or'] = '';
    } ?>
        <td align="center" bgcolor="<?php echo $cfg['BgcolorTwo']; ?>">
            <b><?php echo $strOr; ?>:</b>
            <input type="radio" name="AndOrCol[<?php echo $z; ?>]" value="or"<?php echo $chk['or']; ?>>
            &nbsp;&nbsp;<b><?php echo $strAnd; ?>:</b>
            <input type="radio" name="AndOrCol[<?php echo $z; ?>]" value="and"<?php echo $chk['and']; ?>>
            <br>
            <?php echo $strQBEIns . "\n"; ?>
            <input type="checkbox" name="InsCol[<?php echo $z; ?>]">
            &nbsp;&nbsp;<?php echo $strQBEDel . "\n"; ?>
            <input type="checkbox" name="DelCol[<?php echo $z; ?>]">
        </td>
    <?php
    $z++;

    echo "\n";
} // end for
?>
    </tr>
</table>

<!-- Other controls -->
<?php echo PMA_generate_common_hidden_inputs(); ?>
<table border="0" cellpadding="2" cellspacing="1">
    <tr>
        <td nowrap="nowrap"><input type="hidden" value="<?php echo htmlspecialchars($db, ENT_QUOTES | ENT_HTML5); ?>" name="db">
                <input type="hidden" value="<?php echo $z; ?>" name="Columns">
                <?php
                    $w--;
                ?>
                <input type="hidden" value="<?php echo $w; ?>" name="Rows">
                <?php echo $strAddDeleteRow; ?>:
                <select size="1" name="Add_Row" style="vertical-align: middle">
                    <option value="-3">-3</option>
                    <option value="-2">-2</option>
                    <option value="-1">-1</option>
                    <option value="0" selected="selected">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>           
        </td>
        <td width="10">&nbsp;</td>
        <td nowrap="nowrap"><?php echo $strAddDeleteColumn; ?>:
                <select size="1" name="Add_Col" style="vertical-align: middle">
                    <option value="-3">-3</option>
                    <option value="-2">-2</option>
                    <option value="-1">-1</option>
                    <option value="0" selected="selected">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
        </td>
        <td width="10">&nbsp;</td>
        <!-- Generates a query -->
        <td><input type="submit" name="modify" value="<?php echo $strUpdateQuery; ?>"></td>
    </tr>
</table><br>

<table border="0" cellpadding="2" cellspacing="1">
    <tr>
        <td class="tblHeaders">&nbsp;<?php echo $strUseTables; ?>:&nbsp;</td>
        <td width="20">&nbsp;</td>
        <td class="tblHeaders">&nbsp;<?php echo sprintf($strQueryOnDb, htmlspecialchars($db, ENT_QUOTES | ENT_HTML5)); ?>&nbsp;</td>
    </tr>
    <tr>
        <td bgcolor="<?php echo $cfg['BgcolorOne']; ?>">
<?php
$strTableListOptions = '';
$numTableListOptions = 0;
foreach ($tbl_names as $key => $val) {
    $strTableListOptions .= '                        ';

    $strTableListOptions .= '<option value="' . htmlspecialchars($key, ENT_QUOTES | ENT_HTML5) . '"' . $val . '>' . htmlspecialchars($key, ENT_QUOTES | ENT_HTML5) . '</option>' . "\n";

    $numTableListOptions++;
}
?>
            <select name="TableList[]" size="<?php echo ($numTableListOptions > 30) ? '15' : '7'; ?>" multiple="multiple" id="listTable">
            <?php echo $strTableListOptions; ?>
            </select>
        </td>
        <td>&nbsp;&nbsp;</td>
        <!-- Displays the current query -->
        <td bgcolor="<?php echo $cfg['BgcolorOne']; ?>">
            <textarea cols="30" rows="<?php echo ($numTableListOptions > 30) ? '15' : '7'; ?>" name="sql_query" dir="<?php echo $text_dir; ?>" id="textSqlquery">
<?php
// 1. SELECT
$last_select = 0;
$encoded_qry = '';
if (!isset($qry_select)) {
    $qry_select = '';
}
for ($x = 0; $x < $col; $x++) {
    if (!empty($curField[$x]) && isset($curShow[$x]) && 'on' == $curShow[$x]) {
        if ($last_select) {
            $qry_select .= ', ';
        }

        $qry_select .= $curField[$x];

        $last_select = 1;
    }
} // end for
if (!empty($qry_select)) {
    $encoded_qry .= urlencode('SELECT ' . $qry_select . "\n");

    echo 'SELECT ' . htmlspecialchars($qry_select, ENT_QUOTES | ENT_HTML5) . "\n";
}

// 2. FROM

// Create LEFT JOINS out of Relations
// Code originally by Mike Beck <mike.beck@ibmiller.de>
// If we can use Relations we could make some left joins.
// First find out if relations are available in this database.

// First we need the really needed Tables - those in TableList might still be
// all Tables.
if (isset($Field) && count($Field) > 0) {
    // Initialize some variables

    $tab_all = [];

    $col_all = [];

    $tab_wher = [];

    $tab_know = [];

    $tab_left = [];

    $col_where = [];

    $fromclause = '';

    // We only start this if we have fields, otherwise it would be dumb

    foreach ($Field as $value) {
        $parts = explode('.', $value);

        if (!empty($parts[0]) && !empty($parts[1])) {
            $tab_raw = urldecode($parts[0]);

            $tab = str_replace('`', '', $tab_raw);

            $tab_all[$tab] = $tab;

            $col_raw = urldecode($parts[1]);

            $col_all[] = $tab . '.' . str_replace('`', '', $col_raw);
        }
    } // end while

    // Check 'where' clauses

    if ($cfgRelation['relwork'] && count($tab_all) > 0) {
        // Now we need all tables that we have in the where clause

        $crit_cnt = count($Criteria);

        for ($x = 0; $x < $crit_cnt; $x++) {
            $curr_tab = explode('.', urldecode($Field[$x]));

            if (!empty($curr_tab[0]) && !empty($curr_tab[1])) {
                $tab_raw = urldecode($curr_tab[0]);

                $tab = str_replace('`', '', $tab_raw);

                $col_raw = urldecode($curr_tab[1]);

                $col1 = str_replace('`', '', $col_raw);

                $col1 = $tab . '.' . $col1;

                // Now we know that our array has the same numbers as $Criteria

                // we can check which of our columns has a where clause

                if (!empty($Criteria[$x])) {
                    if ('=' == mb_substr($Criteria[$x], 0, 1) || mb_stristr($Criteria[$x], 'is')) {
                        $col_where[$col] = $col1;

                        $tab_wher[$tab] = $tab;
                    }
                } // end if
            } // end if
        } // end for

        // Cleans temp vars w/o further use

        unset($tab_raw);

        unset($col_raw);

        unset($col1);

        if (1 == count($tab_wher)) {
            // If there is exactly one column that has a decent where-clause

            // we will just use this

            $master = key($tab_wher);
        } else {
            // Now let's find out which of the tables has an index

            // ( When the control user is the same as the normal user

            // because he is using one of his databases as pmadb,

            // the last db selected is not always the one where we need to work)

            PMA_DBI_select_db($db);

            foreach ($tab_all as $tab) {
                $ind_rs = PMA_DBI_query('SHOW INDEX FROM ' . PMA_backquote($tab) . ';');

                while (false !== ($ind = PMA_DBI_fetch_assoc($ind_rs))) {
                    $col1 = $tab . '.' . $ind['Column_name'];

                    if (isset($col_all[$col1])) {
                        if (0 == $ind['non_unique']) {
                            if (isset($col_where[$col1])) {
                                $col_unique[$col1] = 'Y';
                            } else {
                                $col_unique[$col1] = 'N';
                            }
                        } else {
                            if (isset($col_where[$col1])) {
                                $col_index[$col1] = 'Y';
                            } else {
                                $col_index[$col1] = 'N';
                            }
                        }
                    }
                } // end while (each col of tab)
            } // end while (each tab)
            // now we want to find the best.
            if (isset($col_unique) && count($col_unique) > 0) {
                $col_cand = $col_unique;

                $needsort = 1;
            } else {
                if (isset($col_index) && count($col_index) > 0) {
                    $col_cand = $col_index;

                    $needsort = 1;
                } else {
                    if (isset($col_where) && count($col_where) > 0) {
                        $col_cand = $tab_wher;

                        $needsort = 0;
                    } else {
                        $col_cand = $tab_all;

                        $needsort = 0;
                    }
                }
            }

            // If we came up with $col_unique (very good) or $col_index (still

            // good) as $col_cand we want to check if we have any 'Y' there

            // (that would mean that they were also found in the whereclauses

            // which would be great). if yes, we take only those

            if (1 == $needsort) {
                foreach ($col_cand as $col => $is_where) {
                    $tab = explode('.', $col);

                    $tab = $tab[0];

                    if ('Y' == $is_where) {
                        $vg[$col] = $tab;
                    } else {
                        $sg[$col] = $tab;
                    }
                }

                $col_cand = $vg ?? $sg;
            }

            // If our array of candidates has more than one member we'll just

            // find the smallest table.

            // Of course the actual query would be faster if we check for

            // the Criteria which gives the smallest result set in its table,

            // but it would take too much time to check this

            if (count($col_cand) > 1) {
                // Of course we only want to check each table once

                $checked_tables = $col_cand;

                foreach ($col_cand as $tab) {
                    if (1 != $checked_tables[$tab]) {
                        $rows_qry = 'SELECT COUNT(1) AS anz '
                                  . 'FROM ' . PMA_backquote($tab);

                        $rows_rs = PMA_DBI_query($rows_qry);

                        while (false !== ($res = PMA_DBI_fetch_assoc($rows_rs))) {
                            $tsize[$tab] = $res['anz'];
                        }

                        PMA_DBI_free_result($rows_rs);

                        unset($rows_rs);

                        $checked_tables[$tab] = 1;
                    }

                    $csize[$tab] = $tsize[$tab];
                }

                asort($csize);

                reset($csize);

                $master = key($csize); // Smallest
            } else {
                reset($col_cand);

                $master = current($col_cand); // Only one single candidate
            }
        } // end if (exactly one where clause)

        /**
         * Removes unwanted entries from an array (PHP3 compliant)
         *
         * @param mixed $array
         * @param mixed $key
         *
         * @return  array  the cleaned up array
         */

        function PMA_arrayShort($array, $key)
        {
            foreach ($array as $k => $v) {
                if ($k != $key) {
                    $reta[$k] = $v;
                }
            }

            if (!isset($reta)) {
                $reta = [];
            }

            return $reta;
        } // end of the "PMA_arrayShort()" function

        /**
         * Finds all related tables
         *
         * @param mixed $from
         *
         * @return  bool  always TRUE
         *
         * @global  array    the list of tables that we still couldn't connect
         * @global  array    the list of allready connected tables
         * @global  string   the current databse name
         * @global  string   the super user connection id
         * @global  array    the list of relation settings
         */

        function PMA_getRelatives($from)
        {
            global $tab_left, $tab_know, $fromclause;

            global $dbh, $db, $cfgRelation;

            if ('master' == $from) {
                $to = 'foreign';
            } else {
                $to = 'master';
            }

            $in_know = '(\'' . implode('\', \'', $tab_know) . '\')';

            $in_left = '(\'' . implode('\', \'', $tab_left) . '\')';

            $rel_query = 'SELECT *'
                       . ' FROM ' . PMA_backquote($cfgRelation['relation'])
                       . ' WHERE ' . $from . '_db   = \'' . PMA_sqlAddslashes($db) . '\''
                       . ' AND ' . $to . '_db   = \'' . PMA_sqlAddslashes($db) . '\''
                       . ' AND ' . $from . '_table IN ' . $in_know
                       . ' AND ' . $to . '_table IN ' . $in_left;

            PMA_DBI_select_db($cfgRelation['db'], $dbh);

            $relations = @PMA_DBI_query($rel_query, $dbh);

            PMA_DBI_select_db($db, $dbh);

            while (false !== ($row = PMA_DBI_fetch_assoc($relations))) {
                $found_table = $row[$to . '_table'];

                if (isset($tab_left[$found_table])) {
                    $fromclause .= "\n" . ' LEFT JOIN '
                                            . PMA_backquote($row[$to . '_table']) . ' ON '
                                            . PMA_backquote($row[$from . '_table']) . '.'
                                            . PMA_backquote($row[$from . '_field']) . ' = '
                                            . PMA_backquote($row[$to . '_table']) . '.'
                                            . PMA_backquote($row[$to . '_field']) . ' ';

                    $tab_know[$found_table] = $found_table;

                    $tab_left = PMA_arrayShort($tab_left, $found_table);
                }
            } // end while

            return true;
        } // end of the "PMA_getRelatives()" function

        $tab_left = PMA_arrayShort($tab_all, $master);

        $tab_know[$master] = $master;

        $run = 0;

        $emerg = '';

        while (count($tab_left) > 0) {
            if (0 == $run % 2) {
                PMA_getRelatives('master');
            } else {
                PMA_getRelatives('foreign');
            }

            $run++;

            if ($run > 5) {
                foreach ($tab_left as $tab) {
                    $emerg .= ', ' . $tab;

                    $tab_left = PMA_arrayShort($tab_left, $tab);
                }
            }
        } // end while

        $qry_from = $master . $emerg . $fromclause;
    } // end if ($cfgRelation['relwork'] && count($tab_all) > 0)
} // end count($Field) > 0

// In case relations are not defined, just generate the FROM clause
// from the list of tables, however we don't generate any JOIN

if (empty($qry_from) && isset($tab_all)) {
    $qry_from = implode(', ', $tab_all);
}
// Now let's see what we got
if (!empty($qry_from)) {
    $encoded_qry .= urlencode('FROM ' . $qry_from . "\n");

    echo 'FROM ' . htmlspecialchars($qry_from, ENT_QUOTES | ENT_HTML5) . "\n";
}

// 3. WHERE
$qry_where = '';
$criteria_cnt = 0;
for ($x = 0; $x < $col; $x++) {
    if (!empty($curField[$x]) && !empty($curCriteria[$x]) && $x && isset($last_where) && isset($curAndOrCol)) {
        $qry_where .= ' ' . mb_strtoupper($curAndOrCol[$last_where]) . ' ';
    }

    if (!empty($curField[$x]) && !empty($curCriteria[$x])) {
        $qry_where .= '(' . $curField[$x] . ' ' . $curCriteria[$x] . ')';

        $last_where = $x;

        $criteria_cnt++;
    }
} // end for
if ($criteria_cnt > 1) {
    $qry_where = '(' . $qry_where . ')';
}
// OR rows ${'cur' . $or}[$x]
if (!isset($curAndOrRow)) {
    $curAndOrRow = [];
}
for ($y = 0; $y <= $row; $y++) {
    $criteria_cnt = 0;

    $qry_orwhere = '';

    $last_orwhere = '';

    for ($x = 0; $x < $col; $x++) {
        if (!empty($curField[$x]) && !empty(${'curOr' . $y}[$x]) && $x) {
            $qry_orwhere .= ' ' . mb_strtoupper($curAndOrCol[$last_orwhere]) . ' ';
        }

        if (!empty($curField[$x]) && !empty(${'curOr' . $y}[$x])) {
            $qry_orwhere .= '(' . $curField[$x]
                          . ' '
                          . ${'curOr' . $y}[$x]
                          . ')';

            $last_orwhere = $x;

            $criteria_cnt++;
        }
    } // end for

    if ($criteria_cnt > 1) {
        $qry_orwhere = '(' . $qry_orwhere . ')';
    }

    if (!empty($qry_orwhere)) {
        $qry_where .= "\n"
                   . mb_strtoupper(isset($curAndOrRow[$y]) ? $curAndOrRow[$y] . ' ' : '')
                   . $qry_orwhere;
    } // end if
} // end for

if (!empty($qry_where) && '()' != $qry_where) {
    $encoded_qry .= urlencode('WHERE ' . $qry_where . "\n");

    echo 'WHERE ' . htmlspecialchars($qry_where, ENT_QUOTES | ENT_HTML5) . "\n";
} // end if

// 4. ORDER BY
$last_orderby = 0;
if (!isset($qry_orderby)) {
    $qry_orderby = '';
}
for ($x = 0; $x < $col; $x++) {
    if ($last_orderby && $x && !empty($curField[$x]) && !empty($curSort[$x])) {
        $qry_orderby .= ', ';
    }

    if (!empty($curField[$x]) && !empty($curSort[$x])) {
        // if they have chosen all fields using the * selector,

        // then sorting is not available

        // Robbat2 - Fix for Bug #570698

        if ('.*' != mb_substr($curField[$x], -2)) {
            $qry_orderby .= $curField[$x] . ' ' . $curSort[$x];

            $last_orderby = 1;
        }
    }
} // end for
if (!empty($qry_orderby)) {
    $encoded_qry .= urlencode('ORDER BY ' . $qry_orderby);

    echo 'ORDER BY ' . htmlspecialchars($qry_orderby, ENT_QUOTES | ENT_HTML5) . "\n";
}
?>
            </textarea>
            <input type="hidden" name="encoded_sql_query" value="<?php echo $encoded_qry; ?>">
        </td>
    </tr>
    <tr>
        <!-- Generates a query -->
        <td align="right" class="tblHeaders"><input type="submit" name="modify" value="<?php echo $strUpdateQuery; ?>"></td>
        <td>&nbsp;</td>
        <!-- Execute a query -->
        <td align="right" class="tblHeaders"><input type="submit" name="submit_sql" value="<?php echo $strRunQuery; ?>"></td>
    </tr>
</table>   
</form>
<?php
/**
 * Displays the footer
 */
require_once __DIR__ . '/footer.inc.php';
?>