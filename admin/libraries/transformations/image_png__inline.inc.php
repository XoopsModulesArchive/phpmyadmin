<?php

/* $Id: image_png__inline.inc.php,v 2.2 2003/12/02 15:49:21 lem9 Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:

function PMA_transformation_image_png__inline($buffer, $options = [], $meta = '')
{
    require_once __DIR__ . '/libraries/transformations/global.inc.php';

    if (PMA_IS_GD2) {
        $transform_options = ['string' => '<a href="transformation_wrapper.php' . $options['wrapper_link'] . '" target="_blank"><img src="transformation_wrapper.php' . $options['wrapper_link'] . '&amp;resize=png&amp;newWidth=' . ($options[0] ?? '100') . '&amp;newHeight=' . ($options[1] ?? 100) . '" alt="[__BUFFER__]" border="0"></a>'];
    } else {
        $transform_options = ['string' => '<img src="transformation_wrapper.php' . $options['wrapper_link'] . '" alt="[__BUFFER__]" width="320" height="240">'];
    }

    $buffer = PMA_transformation_global_html_replace($buffer, $transform_options);

    return $buffer;
}
