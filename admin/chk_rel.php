<?php

/* $Id: chk_rel.php,v 2.2 2003/11/26 22:52:24 rabus Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:

/**
 * Gets some core libraries
 */
require_once __DIR__ . '/libraries/grab_globals.lib.php';
require_once __DIR__ . '/libraries/common.lib.php';
require_once __DIR__ . '/db_details_common.php';
require_once __DIR__ . '/libraries/relation.lib.php';

/**
 * Gets the relation settings
 */
$cfgRelation = PMA_getRelationsParam(true);

/**
 * Displays the footer
 */
require_once __DIR__ . '/footer.inc.php';
