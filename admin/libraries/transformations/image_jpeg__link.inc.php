<?php

/* $Id: image_jpeg__link.inc.php,v 2.2 2003/12/02 15:49:21 lem9 Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:

function PMA_transformation_image_jpeg__link($buffer, $options = [], $meta = '')
{
    require_once __DIR__ . '/libraries/transformations/global.inc.php';

    $transform_options = ['string' => '<a href="transformation_wrapper.php' . $options['wrapper_link'] . '" alt="[__BUFFER__]">[BLOB]</a>'];

    $buffer = PMA_transformation_global_html_replace($buffer, $transform_options);

    return $buffer;
}
