<?php

/* $Id: text_plain__imagelink.inc.php,v 2.2 2003/12/02 15:49:21 lem9 Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:

function PMA_transformation_text_plain__imagelink($buffer, $options = [], $meta = '')
{
    require_once __DIR__ . '/libraries/transformations/global.inc.php';

    $transform_options = ['string' => '<a href="' . ($options[0] ?? '') . $buffer . '" target="_blank"><img src="' . ($options[0] ?? '') . $buffer . '" border="0" width="' . ($options[1] ?? 100) . '" height="' . ($options[2] ?? 50) . '">' . $buffer . '</a>'];

    $buffer = PMA_transformation_global_html_replace($buffer, $transform_options);

    return $buffer;
}
