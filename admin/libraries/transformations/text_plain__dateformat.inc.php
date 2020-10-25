<?php

/* $Id: text_plain__dateformat.inc.php,v 2.3 2003/12/05 11:02:14 garvinhicking Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:

function PMA_transformation_text_plain__dateformat($buffer, $options = [], $meta = '')
{
    // possibly use a global transform and feed it with special options:

    // require __DIR__ . '/libraries/transformations/global.inc.php';

    // further operations on $buffer using the $options[] array.

    if (!isset($options[0]) || '' == $options[0]) {
        $options[0] = 0;
    }

    if (!isset($options[1]) || '' == $options[1]) {
        $options[1] = $GLOBALS['datefmt'];
    }

    $timestamp = -1;

    // Detect TIMESTAMP(6 | 8 | 10 | 12 | 14), (2 | 4) not supported here.

    if (preg_match('/^(\d{2}){3,7}$/', $buffer)) {
        if (14 == mb_strlen($buffer) || 8 == mb_strlen($buffer)) {
            $offset = 4;
        } else {
            $offset = 2;
        }

        $d = [];

        $d['year'] = mb_substr($buffer, 0, $offset);

        $d['month'] = mb_substr($buffer, $offset, 2);

        $d['day'] = mb_substr($buffer, $offset + 2, 2);

        $d['hour'] = mb_substr($buffer, $offset + 4, 2);

        $d['minute'] = mb_substr($buffer, $offset + 6, 2);

        $d['second'] = mb_substr($buffer, $offset + 8, 2);

        if (checkdate($d['month'], $d['day'], $d['year'])) {
            $timestamp = mktime($d['hour'], $d['minute'], $d['second'], $d['month'], $d['day'], $d['year']);
        }

        // If all fails, assume one of the dozens of valid strtime() syntaxes (http://www.gnu.org/manual/tar-1.12/html_chapter/tar_7.html)
    } else {
        $timestamp = strtotime($buffer);
    }

    // If all above failed, maybe it's a Unix timestamp already?

    if ($timestamp < 0 && preg_match('/^[1-9]\d{1,9}$/', $buffer)) {
        $timestamp = $buffer;
    }

    // Reformat a valid timestamp

    if ($timestamp >= 0) {
        $timestamp -= $options[0] * 60 * 60;

        $source = $buffer;

        $buffer = '<dfn onclick="alert(\'' . $source . '\');" title="' . $source . '">' . PMA_localisedDate($timestamp, $options[1]) . '</dfn>';
    }

    return $buffer;
}
