<?php

/* $Id: text_plain__external.inc.php,v 2.1 2003/11/26 22:52:24 rabus Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:

function PMA_EscapeShellArg($string, $prepend = '\'')
{
    return $prepend . preg_replace("'", "'\\''", $string) . $prepend;
}

function PMA_transformation_text_plain__external_nowrap($options = [])
{
    if (!isset($options[3]) || '' == $options[3]) {
        $nowrap = true;
    } elseif ('1' == $options[3] || 1 == $options[3]) {
        $nowrap = true;
    } else {
        $nowrap = false;
    }

    return $nowrap;
}

function PMA_transformation_text_plain__external($buffer, $options = [], $meta = '')
{
    // possibly use a global transform and feed it with special options:

    // require __DIR__ . '/libraries/transformations/global.inc.php';

    // further operations on $buffer using the $options[] array.

    $allowed_programs = [];

    $allowed_programs[0] = '/usr/local/bin/tidy';

    $allowed_programs[1] = '/usr/local/bin/validate';

    if (!isset($options[0]) || '' == $options[0]) {
        $program = $allowed_programs[0];
    } else {
        $program = $allowed_programs[$options[0]];
    }

    if (!isset($options[1]) || '' == $options[1]) {
        $poptions = '-f /dev/null -i -wrap -q';
    } else {
        $poptions = $options[1];
    }

    if (!isset($options[2]) || '' == $options[2]) {
        $options[2] = 1;
    }

    if (!isset($options[3]) || '' == $options[3]) {
        $options[3] = 1;
    }

    $cmdline = 'echo ' . PMA_EscapeShellArg($buffer) . ' | ' . $program . ' ' . PMA_EscapeShellArg($poptions, '');

    $newstring = `$cmdline`;

    if (1 == $options[2] || '2' == $options[2]) {
        $retstring = htmlspecialchars($newstring, ENT_QUOTES | ENT_HTML5);
    } else {
        $retstring = $newstring;
    }

    return $retstring;
}
