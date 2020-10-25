<?php

/* $Id: tbl_properties.php,v 2.3 2004/06/13 21:32:17 lem9 Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:

/**
 * Runs common work
 */
require __DIR__ . '/tbl_properties_common.php';
$err_url = 'tbl_properties.php' . $err_url;
$url_query .= '&amp;goto=tbl_properties.php&amp;back=tbl_properties.php';

/**
 * Top menu
 */
require __DIR__ . '/tbl_properties_table_info.php';

?>
<!-- TABLE WORK -->
<?php
/**
 * Query box, bookmark, insert data from textfile
 */
$goto = 'tbl_properties.php';
require __DIR__ . '/tbl_query_box.php';

/**
 * Displays the footer
 */
echo "\n";
require_once __DIR__ . '/footer.inc.php';
?>
