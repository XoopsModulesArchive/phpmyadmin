<?php

/* $Id: tbl_properties_table_info.php,v 2.8 2004/06/02 13:31:04 rabus Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:

// this should be recoded as functions, to avoid messing with global
// variables

// Check parameters

require_once __DIR__ . '/libraries/common.lib.php';

PMA_checkParameters(['db', 'table']);

/**
 * Gets table informations
 */
// The 'show table' statement works correct since 3.23.03
$table_info_result = PMA_DBI_query('SHOW TABLE STATUS LIKE \'' . PMA_sqlAddslashes($table, true) . '\';');
$showtable = PMA_DBI_fetch_assoc($table_info_result);
if (!isset($showtable['Type']) && isset($showtable['Engine'])) {
    $showtable['Type'] = &$showtable['Engine'];
}
$tbl_type = isset($showtable['Type']) ? mb_strtoupper($showtable['Type']) : '';
$tbl_collation = empty($showtable['Collation']) ? '' : $showtable['Collation'];
$table_info_num_rows = ($showtable['Rows'] ?? 0);
$show_comment = ($showtable['Comment'] ?? '');
$auto_increment = ($showtable['Auto_increment'] ?? '');

$tmp = isset($showtable['Create_options']) ? explode(' ', $showtable['Create_options']) : [];
$tmp_cnt = count($tmp);
for ($i = 0; $i < $tmp_cnt; $i++) {
    $tmp1 = explode('=', $tmp[$i]);

    if (isset($tmp1[1])) {
        $$tmp1[0] = $tmp1[1];
    }
} // end for
unset($tmp1, $tmp);
PMA_DBI_free_result($table_info_result);

/**
 * Displays top menu links
 */
echo '<!-- top menu -->' . "\n";
require __DIR__ . '/tbl_properties_links.php';

/**
 * Displays table comment
 */
if (!empty($show_comment) && !isset($avoid_show_comment)) {
    ?>
<!-- Table comment -->
<p><i>
    <?php echo htmlspecialchars($show_comment, ENT_QUOTES | ENT_HTML5) . "\n"; ?>
</i></p>
    <?php
} // end if

echo "\n\n";
?>
