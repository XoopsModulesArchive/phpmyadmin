<?php

/* $Id: transformation_wrapper.php,v 2.6 2004/05/20 16:14:09 nijel Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:

$is_transformation_wrapper = true;

/**
 * Get the variables sent or posted to this script and displays the header
 */
require_once __DIR__ . '/libraries/grab_globals.lib.php';

/**
 * Gets a core script and starts output buffering work
 */
require_once __DIR__ . '/libraries/common.lib.php';
require_once __DIR__ . '/libraries/relation.lib.php'; // foreign keys
require_once __DIR__ . '/libraries/transformations.lib.php'; // Transformations
$cfgRelation = PMA_getRelationsParam();

/**
 * Ensures db and table are valid, else moves to the "parent" script
 */
require_once __DIR__ . '/libraries/db_table_exists.lib.php';

/**
 * Get the list of the fields of the current table
 */
PMA_DBI_select_db($db);
$table_def = PMA_DBI_query('SHOW FIELDS FROM ' . PMA_backquote($table));
if (isset($primary_key)) {
    $result = PMA_DBI_query('SELECT * FROM ' . PMA_backquote($table) . ' WHERE ' . $primary_key . ';');

    $row = PMA_DBI_fetch_assoc($result);
} else {
    $result = PMA_DBI_query('SELECT * FROM ' . PMA_backquote($table) . ' LIMIT 1;');

    $row = PMA_DBI_fetch_assoc($result);
}

// No row returned
if (!$row) {
    exit;
} // end if (no record returned)

$default_ct = 'application/octet-stream';

if ($cfgRelation['commwork'] && $cfgRelation['mimework']) {
    $mime_map = PMA_getMIME($db, $table);

    $mime_options = PMA_transformation_getOptions(($mime_map[urldecode($transform_key)]['transformation_options'] ?? ''));

    foreach ($mime_options as $key => $option) {
        if ('; charset=' == mb_substr($option, 0, 10)) {
            $mime_options['charset'] = $option;
        }
    }
}

// garvin: For re-usability, moved http-headers and stylesheets
// to a seperate file. It can now be included by header.inc.php,
// queryframe.php, querywindow.php.

require_once __DIR__ . '/libraries/header_http.inc.php';
// [MIME]
if (isset($ct) && !empty($ct)) {
    $content_type = 'Content-Type: ' . urldecode($ct);
} else {
    $content_type = 'Content-Type: ' . (isset($mime_map[urldecode($transform_key)]['mimetype']) ? str_replace('_', '/', $mime_map[urldecode($transform_key)]['mimetype']) : $default_ct) . ($mime_options['charset'] ?? '');
}

if (isset($cn) && !empty($cn)) {
    $content_type .= "\n" . 'Content-Disposition: attachment; filename=' . urldecode($cn);
}

header($content_type);

if (!isset($resize)) {
    echo $row[urldecode($transform_key)];
} else {
    // if image_*__inline.inc.php finds that we can resize,

    // it sets $resize to jpeg or png

    $srcImage = imagecreatefromstring($row[urldecode($transform_key)]);

    $srcWidth = imagesx($srcImage);

    $srcHeight = imagesy($srcImage);

    // Check to see if the width > height or if width < height

    // if so adjust accordingly to make sure the image

    // stays smaller then the $newWidth and $newHeight

    $ratioWidth = $srcWidth / $newWidth;

    $ratioHeight = $srcHeight / $newHeight;

    if ($ratioWidth < $ratioHeight) {
        $destWidth = $srcWidth / $ratioHeight;

        $destHeight = $newHeight;
    } else {
        $destWidth = $newWidth;

        $destHeight = $srcHeight / $ratioWidth;
    }

    if ($resize) {
        $destImage = imagecreatetruecolor($destWidth, $destHeight);
    }

//    ImageCopyResized( $destImage, $srcImage, 0, 0, 0, 0, $destWidth, $destHeight, $srcWidth, $srcHeight );

    // better quality but slower:

    imagecopyresampled($destImage, $srcImage, 0, 0, 0, 0, $destWidth, $destHeight, $srcWidth, $srcHeight);

    if ('jpeg' == $resize) {
        imagejpeg($destImage, '', 75);
    }

    if ('png' == $resize) {
        imagepng($destImage);
    }

    imagedestroy($srcImage);

    imagedestroy($destImage);
}

/**
 * Close MySql non-persistent connections
 */
if (isset($GLOBALS['dbh']) && $GLOBALS['dbh']) {
    @PMA_DBI_close($GLOBALS['dbh']);
}
if (isset($GLOBALS['userlink']) && $GLOBALS['userlink']) {
    @PMA_DBI_close($GLOBALS['userlink']);
}
