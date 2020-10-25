<?php

/* $Id: tbl_relation.php,v 2.15 2004/07/14 14:28:39 lem9 Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:

/**
 * Gets some core libraries
 */
require_once __DIR__ . '/libraries/grab_globals.lib.php';
require_once __DIR__ . '/libraries/common.lib.php';
require __DIR__ . '/tbl_properties_common.php';
$url_query .= '&amp;goto=tbl_properties.php';

// Note: in tbl_properties_table_info we get and display the table comment.
// For InnoDB, this comment contains the REFER information but any update
// has not been done yet (will be done in tbl_relation.php later).
$avoid_show_comment = true;
require __DIR__ . '/tbl_properties_table_info.php';
require_once __DIR__ . '/libraries/relation.lib.php';

$options_array = ['CASCADE' => 'CASCADE', 'SET_NULL' => 'SET NULL', 'NO_ACTION' => 'NO ACTION', 'RESTRICT' => 'RESTRICT'];

/**
 * Generate dropdown choices
 *
 * @param mixed $dropdown_question
 * @param mixed $radio_name
 * @param mixed $choices
 * @param mixed $selected_value
 * @return  string   The existing value (for selected)
 */
function PMA_generate_dropdown($dropdown_question, $radio_name, $choices, $selected_value)
{
    global $font_smallest;

    echo $dropdown_question . '&nbsp;&nbsp;';

    //echo '<select name="' . $radio_name . '" style="font-size: ' . $font_smallest . '">' . "\n";

    //echo '<option value="nix" style="font-size: ' . $font_smallest . '" >--</option>' . "\n";

    echo '<select name="' . $radio_name . '">' . "\n";

    echo '<option value="nix">--</option>' . "\n";

    foreach ($choices as $one_value => $one_label) {
        echo '<option value="' . $one_value . '"';

        if ($selected_value == $one_value) {
            echo ' selected="selected" ';
        }

        //echo ' style="font-size: ' . $font_smallest . '">'

        echo '>' . $one_label . '</option>' . "\n";
    }

    echo '</select>' . "\n";

    echo "\n";
}

/**
 * Gets the relation settings
 */
$cfgRelation = PMA_getRelationsParam();

/**
 * Updates
 */
if ($cfgRelation['relwork']) {
    $existrel = PMA_getForeigners($db, $table, '', 'internal');
}
if ('INNODB' == $tbl_type) {
    $existrel_innodb = PMA_getForeigners($db, $table, '', 'innodb');
}
if ($cfgRelation['displaywork']) {
    $disp = PMA_getDisplayField($db, $table);
}

// updates for internal relations or innodb?
if (isset($submit_rel) && 'true' == $submit_rel) {
    // u p d a t e s   f o r   I n t e r n a l    r e l a t i o n s

    if ($cfgRelation['relwork']) {
        foreach ($destination as $master_field => $foreign_string) {
            if ('nix' != $foreign_string) {
                [$foreign_db, $foreign_table, $foreign_field] = explode('.', $foreign_string);

                if (!isset($existrel[$master_field])) {
                    $upd_query = 'INSERT INTO ' . PMA_backquote($cfgRelation['relation'])
                                . '(master_db, master_table, master_field, foreign_db, foreign_table, foreign_field)'
                                . ' values('
                                . '\'' . PMA_sqlAddslashes($db) . '\', '
                                . '\'' . PMA_sqlAddslashes($table) . '\', '
                                . '\'' . PMA_sqlAddslashes($master_field) . '\', '
                                . '\'' . PMA_sqlAddslashes($foreign_db) . '\', '
                                . '\'' . PMA_sqlAddslashes($foreign_table) . '\','
                                . '\'' . PMA_sqlAddslashes($foreign_field) . '\')';
                } else {
                    if ($existrel[$master_field]['foreign_db'] . '.' . $existrel[$master_field]['foreign_table'] . '.' . $existrel[$master_field]['foreign_field'] != $foreign_string) {
                        $upd_query = 'UPDATE ' . PMA_backquote($cfgRelation['relation']) . ' SET'
                                . ' foreign_db       = \'' . PMA_sqlAddslashes($foreign_db) . '\', '
                                . ' foreign_table    = \'' . PMA_sqlAddslashes($foreign_table) . '\', '
                                . ' foreign_field    = \'' . PMA_sqlAddslashes($foreign_field) . '\' '
                                . ' WHERE master_db  = \'' . PMA_sqlAddslashes($db) . '\''
                                . ' AND master_table = \'' . PMA_sqlAddslashes($table) . '\''
                                . ' AND master_field = \'' . PMA_sqlAddslashes($master_field) . '\'';
                    }
                } // end if... else....
            } else {
                if (isset($existrel[$master_field])) {
                    $upd_query = 'DELETE FROM ' . PMA_backquote($cfgRelation['relation'])
                                . ' WHERE master_db  = \'' . PMA_sqlAddslashes($db) . '\''
                                . ' AND master_table = \'' . PMA_sqlAddslashes($table) . '\''
                                . ' AND master_field = \'' . PMA_sqlAddslashes($master_field) . '\'';
                }
            } // end if... else....

            if (isset($upd_query)) {
                $upd_rs = PMA_query_as_cu($upd_query);

                unset($upd_query);
            }
        } // end while
    } // end if (updates for internal relations)

    // u p d a t e s   f o r   I n n o D B

    // ( for now, one index name only; we keep the definitions if the

    // foreign db is not the same)

    if (isset($destination_innodb)) {
        foreach ($destination_innodb as $master_field => $foreign_string) {
            if ('nix' != $foreign_string) {
                [$foreign_db, $foreign_table, $foreign_field] = explode('.', $foreign_string);

                if (!isset($existrel_innodb[$master_field])) {
                    // no key defined for this field

                    // The next few lines are repeated below, so they

                    // could be put in an include file

                    // Note: I tried to enclose the db and table name with

                    // backquotes but MySQL 4.0.16 did not like the syntax

                    // (for example: `base2`.`table1` )

                    $upd_query = 'ALTER TABLE ' . $table
                                . ' ADD FOREIGN KEY ('
                                . PMA_backquote(PMA_sqlAddslashes($master_field)) . ')'
                                . ' REFERENCES '
                                . PMA_backquote(PMA_sqlAddslashes($foreign_db) . '.'
                                . PMA_sqlAddslashes($foreign_table)) . '('
                                . PMA_backquote(PMA_sqlAddslashes($foreign_field)) . ')';

                    if ('nix' != ${$master_field . '_on_delete'}) {
                        $upd_query .= ' ON DELETE ' . $options_array[${$master_field . '_on_delete'}];
                    }

                    if ('nix' != ${$master_field . '_on_update'}) {
                        $upd_query .= ' ON UPDATE ' . $options_array[${$master_field . '_on_update'}];
                    }

                    // end repeated code
                } else {
                    if (($existrel_innodb[$master_field]['foreign_db'] . '.' . $existrel_innodb[$master_field]['foreign_table'] . '.' . $existrel_innodb[$master_field]['foreign_field'] != $foreign_string)
                  || (${$master_field . '_on_delete'} != (!empty($existrel_innodb[$master_field]['on_delete']) ? $existrel_innodb[$master_field]['on_delete'] : '')) || (${$master_field . '_on_update'} != (!empty($existrel_innodb[$master_field]['on_update']) ? $existrel_innodb[$master_field]['on_update'] : ''))
                       ) {
                        // another foreign key is already defined for this field

                        // or

                        // an option has been changed for ON DELETE or ON UPDATE

                        // remove existing key

                        if (PMA_MYSQL_INT_VERSION >= 40013) {
                            $upd_query = 'ALTER TABLE ' . $table
                                    . ' DROP FOREIGN KEY '
                                    . PMA_backquote($existrel_innodb[$master_field]['constraint']);

                            // I tried to send both in one query but it failed

                            $upd_rs = PMA_DBI_query($upd_query);
                        }

                        // add another

                        $upd_query = 'ALTER TABLE ' . $table
                                . ' ADD FOREIGN KEY ('
                                . PMA_backquote(PMA_sqlAddslashes($master_field)) . ')'
                                . ' REFERENCES '
                                . PMA_backquote(PMA_sqlAddslashes($foreign_db) . '.'
                                . PMA_sqlAddslashes($foreign_table)) . '('
                                . PMA_backquote(PMA_sqlAddslashes($foreign_field)) . ')';

                        if ('nix' != ${$master_field . '_on_delete'}) {
                            $upd_query .= ' ON DELETE ' . $options_array[${$master_field . '_on_delete'}];
                        }

                        if ('nix' != ${$master_field . '_on_update'}) {
                            $upd_query .= ' ON UPDATE ' . $options_array[${$master_field . '_on_update'}];
                        }
                    }
                } // end if... else....
            } else {
                if (isset($existrel_innodb[$master_field])) {
                    if (PMA_MYSQL_INT_VERSION >= 40013) {
                        $upd_query = 'ALTER TABLE ' . $table
                                . ' DROP FOREIGN KEY '
                                . PMA_backquote($existrel_innodb[$master_field]['constraint']);
                    }
                }
            } // end if... else....

            if (isset($upd_query)) {
                $upd_rs = PMA_DBI_try_query($upd_query);

                if ('1005' == mb_substr(PMA_DBI_getError(), 1, 4)) {
                    echo '<p class="warning">' . $strNoIndex . ' (' . $master_field . ')</p>' . PMA_showMySQLDocu('manual_Table_types', 'InnoDB_foreign_key_constraints') . "\n";
                }

                unset($upd_query);
            }
        } // end while
    } // end if isset($destination_innodb)
} // end if (updates for internal relations or InnoDB)

// U p d a t e s   f o r   d i s p l a y   f i e l d

if ($cfgRelation['displaywork']
    && isset($submit_show) && 'true' == $submit_show) {
    if ($disp) {
        if ('' != $display_field) {
            $upd_query = 'UPDATE ' . PMA_backquote($cfgRelation['table_info'])
                       . ' SET display_field = \'' . PMA_sqlAddslashes($display_field) . '\''
                       . ' WHERE db_name  = \'' . PMA_sqlAddslashes($db) . '\''
                       . ' AND table_name = \'' . PMA_sqlAddslashes($table) . '\'';
        } else {
            $upd_query = 'DELETE FROM ' . PMA_backquote($cfgRelation['table_info'])
                       . ' WHERE db_name  = \'' . PMA_sqlAddslashes($db) . '\''
                       . ' AND table_name = \'' . PMA_sqlAddslashes($table) . '\'';
        }
    } elseif ('' != $display_field) {
        $upd_query = 'INSERT INTO ' . PMA_backquote($cfgRelation['table_info'])
                   . '(db_name, table_name, display_field) '
                   . ' VALUES('
                   . '\'' . PMA_sqlAddslashes($db) . '\','
                   . '\'' . PMA_sqlAddslashes($table) . '\','
                   . '\'' . PMA_sqlAddslashes($display_field) . '\')';
    }

    if (isset($upd_query)) {
        $upd_rs = PMA_query_as_cu($upd_query);
    }
} // end if

if ($cfgRelation['commwork']
    && isset($submit_comm) && 'true' == $submit_comm) {
    foreach ($comment as $key => $value) {
        // garvin: I exported the snippet here to a function (relation.lib.php) , so it can be used multiple times throughout other pages where you can set comments.

        PMA_setComment($db, $table, $key, $value);
    }  // end while (transferred data)
} // end if (commwork)

// If we did an update, refresh our data
if (isset($submit_rel) && 'true' == $submit_rel) {
    if ($cfgRelation['relwork']) {
        $existrel = PMA_getForeigners($db, $table, '', 'internal');
    }

    if ('INNODB' == $tbl_type) {
        $existrel_innodb = PMA_getForeigners($db, $table, '', 'innodb');
    }
}
if ($cfgRelation['displaywork']) {
    $disp = PMA_getDisplayField($db, $table);
}
if ($cfgRelation['commwork']) {
    $comments = PMA_getComments($db, $table);
}

/**
 * Dialog
 */
if ($cfgRelation['relwork'] || 'INNODB' == $tbl_type) {
    // To choose relations we first need all tables names in current db

    // and if PMA version permits and the main table is innodb,

    // we use SHOW TABLE STATUS because we need to find other InnoDB tables

    if ('INNODB' == $tbl_type) {
        $tab_query = 'SHOW TABLE STATUS FROM ' . PMA_backquote($db);

    // [0] of the row is the name
    // [1] is the type
    } else {
        $tab_query = 'SHOW TABLES FROM ' . PMA_backquote($db);
    }

    // [0] of the row is the name

    $tab_rs = PMA_DBI_query($tab_query, null, PMA_DBI_QUERY_STORE);

    $selectboxall['nix'] = '--';

    $selectboxall_innodb['nix'] = '--';

    while (false !== ($curr_table = @PMA_DBI_fetch_row($tab_rs))) {
        if (($curr_table[0] != $table) && ($curr_table[0] != $cfg['Server']['relation'])) {
            // need to use PMA_DBI_QUERY_STORE with PMA_DBI_num_rows() in mysqli

            $fi_rs = PMA_DBI_query('SHOW KEYS FROM ' . PMA_backquote($curr_table[0]) . ';', null, PMA_DBI_QUERY_STORE);

            if ($fi_rs && PMA_DBI_num_rows($fi_rs) > 0) {
                $seen_a_primary = false;

                while (false !== ($curr_field = PMA_DBI_fetch_assoc($fi_rs))) {
                    if (isset($curr_field['Key_name']) && 'PRIMARY' == $curr_field['Key_name']) {
                        $seen_a_primary = true;

                        $field_full = $db . '.' . $curr_field['Table'] . '.' . $curr_field['Column_name'];

                        $field_v = $curr_field['Table'] . '->' . $curr_field['Column_name'];

                        $selectboxall[$field_full] = $field_v;

                        // there could be more than one segment of the primary

                        // so do not break

                        // Please watch here, tbl_type is INNODB but the

                        // resulting value of SHOW KEYS is InnoDB

                        if ('INNODB' == $tbl_type && isset($curr_table[1]) && 'InnoDB' == $curr_table[1]) {
                            $selectboxall_innodb[$field_full] = $field_v;
                        }
                    } else {
                        if (isset($curr_field['Non_unique']) && 0 == $curr_field['Non_unique'] && false == $seen_a_primary) {
                            // if we can't find a primary key we take any unique one

                            // (in fact, we show all segments of unique keys

                            //  and all unique keys)

                            $field_full = $db . '.' . $curr_field['Table'] . '.' . $curr_field['Column_name'];

                            $field_v = $curr_field['Table'] . '->' . $curr_field['Column_name'];

                            $selectboxall[$field_full] = $field_v;

                            if ('INNODB' == $tbl_type && isset($curr_table[1]) && 'InnoDB' == $curr_table[1]) {
                                $selectboxall_innodb[$field_full] = $field_v;
                            }

                            // for InnoDB, any index is allowed
                        } else {
                            if ('INNODB' == $tbl_type && isset($curr_table[1]) && 'InnoDB' == $curr_table[1]) {
                                $field_full = $db . '.' . $curr_field['Table'] . '.' . $curr_field['Column_name'];

                                $field_v = $curr_field['Table'] . '->' . $curr_field['Column_name'];

                                $selectboxall_innodb[$field_full] = $field_v;
                            }
                        }
                    } // end if
                } // end while over keys
            } // end if (PMA_DBI_num_rows)
            PMA_DBI_free_result($fi_rs);

            unset($fi_rs);

        // Mike Beck - 24.07.02: i've been asked to add all keys of the
        // current table (see bug report #574851)
        } else {
            if ($curr_table[0] == $table) {
                // need to use PMA_DBI_QUERY_STORE with PMA_DBI_num_rows() in mysqli

                $fi_rs = PMA_DBI_query('SHOW KEYS FROM ' . PMA_backquote($curr_table[0]) . ';', null, PMA_DBI_QUERY_STORE);

                if ($fi_rs && PMA_DBI_num_rows($fi_rs) > 0) {
                    while (false !== ($curr_field = PMA_DBI_fetch_assoc($fi_rs))) {
                        $field_full = $db . '.' . $curr_field['Table'] . '.' . $curr_field['Column_name'];

                        $field_v = $curr_field['Table'] . '->' . $curr_field['Column_name'];

                        $selectboxall[$field_full] = $field_v;

                        if ('INNODB' == $tbl_type && isset($curr_table[1]) && 'InnoDB' == $curr_table[1]) {
                            $selectboxall_innodb[$field_full] = $field_v;
                        }
                    } // end while
                } // end if (PMA_DBI_num_rows)
            PMA_DBI_free_result($fi_rs);

                unset($fi_rs);
            }
        }
    } // end while over tables
} // end if

// Now find out the columns of our $table
// need to use PMA_DBI_QUERY_STORE with PMA_DBI_num_rows() in mysqli
$col_rs = PMA_DBI_try_query('SHOW COLUMNS FROM ' . PMA_backquote($table) . ';', null, PMA_DBI_QUERY_STORE);

if ($col_rs && PMA_DBI_num_rows($col_rs) > 0) {
    while (false !== ($row = PMA_DBI_fetch_assoc($col_rs))) {
        $save_row[] = $row;
    }

    $saved_row_cnt = count($save_row);

    echo 'INNODB' == $tbl_type ? '' : '<table border="0" cellpadding="0" cellspacing="0">' . "\n"
                                  . '    <tr><td valign="top">' . "\n\n"; ?>

<form method="post" action="tbl_relation.php">
    <?php echo PMA_generate_common_hidden_inputs($db, $table); ?>
    <input type="hidden" name="submit_rel" value="true">

    <table cellpadding="2" cellspacing="1">
    <tr>
        <th colspan="<?php echo 'INNODB' == $tbl_type ? '4' : '2'; ?>" align="center" class="tblHeaders"><b><?php echo $strLinksTo; ?></b></th>
    </tr>
    <tr>
        <th></th>
        <?php
        if ($cfgRelation['relwork']) {
            echo '        <th><b>' . $strInternalRelations;

            if ('INNODB' == $tbl_type) {
                echo '&nbsp;(*)';
            }

            echo '</b></th>';
        }

    if ('INNODB' == $tbl_type) {
        echo '<th colspan="2">InnoDB';

        if (PMA_MYSQL_INT_VERSION < 40013) {
            echo '&nbsp;(**)';
        }

        echo '</th>';
    } ?>
    </tr>
    <?php
    for ($i = 0; $i < $saved_row_cnt; $i++) {
        $myfield = $save_row[$i]['Field'];

        echo "\n"; ?>
    <tr>
        <td align="center" bgcolor="<?php echo ($i % 2) ? $GLOBALS['cfg']['BgcolorOne'] : $GLOBALS['cfg']['BgcolorTwo']; ?>"><b><?php echo $save_row[$i]['Field']; ?></b></td>
        <?php
        if ($cfgRelation['relwork']) {
            ?>
        <td bgcolor="<?php echo ($i % 2) ? $GLOBALS['cfg']['BgcolorOne'] : $GLOBALS['cfg']['BgcolorTwo']; ?>">
            <select name="destination[<?php echo htmlspecialchars($save_row[$i]['Field'], ENT_QUOTES | ENT_HTML5); ?>]">
            <?php
            echo "\n";

            // PMA internal relations

            if (isset($existrel[$myfield])) {
                $foreign_field = $existrel[$myfield]['foreign_db'] . '.'
                         . $existrel[$myfield]['foreign_table'] . '.'
                         . $existrel[$myfield]['foreign_field'];
            } else {
                $foreign_field = false;
            }

            $seen_key = false;

            foreach ($selectboxall as $key => $value) {
                echo '                '
                     . '<option value="' . htmlspecialchars($key, ENT_QUOTES | ENT_HTML5) . '"';

                if ($foreign_field && $key == $foreign_field) {
                    echo ' selected="selected"';

                    $seen_key = true;
                }

                echo '>' . $value . '</option>' . "\n";
            } // end while

            // if the link defined in relationtable points to a foreign field

            // that is not a key in the foreign table, we show the link

            // (will not be shown with an arrow)

            if ($foreign_field && !$seen_key) {
                echo '                '
                     . '<option value="' . htmlspecialchars($foreign_field, ENT_QUOTES | ENT_HTML5) . '"';

                echo ' selected="selected"';

                echo '>' . $foreign_field . '</option>' . "\n";
            } ?>
            </select>
        </td>
        <?php
        } // end if (internal relations)

        if ('INNODB' == $tbl_type) {
            ?>
        <td bgcolor="<?php echo ($i % 2) ? $GLOBALS['cfg']['BgcolorOne'] : $GLOBALS['cfg']['BgcolorTwo']; ?>">
            <select name="destination_innodb[<?php echo htmlspecialchars($save_row[$i]['Field'], ENT_QUOTES | ENT_HTML5); ?>]">
        <?php
            if (isset($existrel_innodb[$myfield])) {
                $foreign_field = $existrel_innodb[$myfield]['foreign_db'] . '.'
                         . $existrel_innodb[$myfield]['foreign_table'] . '.'
                         . $existrel_innodb[$myfield]['foreign_field'];
            } else {
                $foreign_field = false;
            }

            $found_foreign_field = false;

            foreach ($selectboxall_innodb as $key => $value) {
                echo '                '
                     . '<option value="' . htmlspecialchars($key, ENT_QUOTES | ENT_HTML5) . '"';

                if ($foreign_field && $key == $foreign_field) {
                    echo ' selected="selected"';

                    $found_foreign_field = true;
                }

                echo '>' . $value . '</option>' . "\n";
            } // end while

            // we did not find the foreign field in the tables of current db,

            // must be defined in another db so show it to avoid erasing it

            if (!$found_foreign_field && $foreign_field) {
                echo '                '
                     . '<option value="' . htmlspecialchars($foreign_field, ENT_QUOTES | ENT_HTML5) . '"';

                echo ' selected="selected"';

                echo '>' . $foreign_field . '</option>' . "\n";
            } ?>
                </select>
        </td>
        <td bgcolor="<?php echo ($i % 2) ? $GLOBALS['cfg']['BgcolorOne'] : $GLOBALS['cfg']['BgcolorTwo']; ?>">
        <?php
              PMA_generate_dropdown(
                  'ON DELETE',
                  htmlspecialchars($save_row[$i]['Field'], ENT_QUOTES | ENT_HTML5) . '_on_delete',
                  $options_array,
                ($existrel_innodb[$myfield]['on_delete'] ?? '')
            );

            echo '&nbsp;&nbsp;&nbsp;';

            PMA_generate_dropdown(
                'ON UPDATE',
                htmlspecialchars($save_row[$i]['Field'], ENT_QUOTES | ENT_HTML5) . '_on_update',
                $options_array,
                ($existrel_innodb[$myfield]['on_update'] ?? '')
            );
        } ?>
        </td>
    </tr>
        <?php
    } // end for

    echo "\n"; ?>
    <tr>
        <td colspan="<?php echo 'INNODB' == $tbl_type ? '4' : '2'; ?>" align="center" class="tblFooters">
            <input type="submit" value="<?php echo '  ' . $strGo . '  '; ?>">
        </td>
    </tr>
    </table>
    <?php
        if ('INNODB' == $tbl_type) {
            if ($cfgRelation['relwork']) {
                echo $strInternalNotNecessary . '<br>';
            }

            if (PMA_MYSQL_INT_VERSION < 40013) {
                echo '** ' . sprintf($strUpgrade, 'MySQL', '4.0.13') . '<br>';
            }
        } ?>
</form>

    <?php
    echo 'INNODB' == $tbl_type ? '' : "\n\n" . '    </td>' . "\n";

    if ($cfgRelation['displaywork']) {
        echo 'INNODB' == $tbl_type ? '' : '    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>' . "\n"
            . '    <td valign="top" align="center">' . "\n\n";

        // Get "display_field" infos

        $disp = PMA_getDisplayField($db, $table);

        echo "\n"; ?>
<form method="post" action="tbl_relation.php">
    <?php echo PMA_generate_common_hidden_inputs($db, $table); ?>
    <input type="hidden" name="submit_show" value="true">

    <p><b><?php echo $strChangeDisplay . ': '; ?></b><br>
    <select name="display_field" onchange="this.form.submit();" style="vertical-align: middle">
        <option value="">---</option>
        <?php
        echo "\n";

        foreach ($save_row as $row) {
            echo '        <option value="' . htmlspecialchars($row['Field'], ENT_QUOTES | ENT_HTML5) . '"';

            if (isset($disp) && $row['Field'] == $disp) {
                echo ' selected="selected"';
            }

            echo '>' . htmlspecialchars($row['Field'], ENT_QUOTES | ENT_HTML5) . '</option>' . "\n";
        } // end while?>
    </select>
    <script type="text/javascript" language="javascript">
    <!--
    // Fake js to allow the use of the <noscript> tag
    //-->
    </script>
    <noscript>
        <input type="submit" value="<?php echo $strGo; ?>" style="vertical-align: middle">
    </noscript>
    </p>
</form>
        <?php
        echo 'INNODB' == $tbl_type ? '' : "\n\n" . '    </td>' . "\n";
    } // end if (displayworks)

    if ($cfgRelation['commwork']) {
        echo 'INNODB' == $tbl_type ? "\n" : '    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>' . "\n"
                                        . '    <td valign="top">' . "\n\n"; ?>
<form method="post" action="tbl_relation.php">
    <?php echo PMA_generate_common_hidden_inputs($db, $table); ?>
    <input type="hidden" name="submit_comm" value="true">

    <table border="0" cellpadding="2" cellspacing="1">
    <tr>
        <th colspan="2" align="center" class="tblHeaders"><b><?php echo $strComments; ?></b></th>
    </tr>
        <?php
        for ($i = 0; $i < $saved_row_cnt; $i++) {
            $field = $save_row[$i]['Field'];

            echo "\n"; ?>
    <tr>
        <td align="center" bgcolor="<?php echo ($i % 2) ? $GLOBALS['cfg']['BgcolorOne'] : $GLOBALS['cfg']['BgcolorTwo']; ?>"><b><?php echo $field; ?></b></td>
        <td bgcolor="<?php echo ($i % 2) ? $GLOBALS['cfg']['BgcolorOne'] : $GLOBALS['cfg']['BgcolorTwo']; ?>">
            <input type="text" name="comment[<?php echo $field; ?>]" value="<?php echo(isset($comments[$field]) ? htmlspecialchars($comments[$field], ENT_QUOTES | ENT_HTML5) : ''); ?>">
        </td>
    </tr>
            <?php
        } // end for

        echo "\n"; ?>
    <tr>
        <td colspan="2" align="center" class="tblFooters">
            <input type="submit" value="<?php echo '  ' . $strGo . '  '; ?>">
        </td>
    </tr>
    </table>
</form>
        <?php
    } //    end if (comments work)

    echo 'INNODB' == $tbl_type ? '' : "\n\n" . '    </td></tr>' . "\n"
                                  . '</table>' . "\n\n";
} // end if (we have columns in this table)

/**
 * Displays the footer
 */
require_once __DIR__ . '/footer.inc.php';
?>
