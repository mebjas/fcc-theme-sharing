<?php
$radius = 16;
$colour = "FFFFFF";

/*
 * open source image and calculate properties
 */

$source_width= 32;
$source_height=32;
/*
 * create mask for top-left corner in memory
 */

$corner_image = imagecreatetruecolor(
    $radius,
    $radius
);

$clear_colour = $body_bg;

$solid_colour = imagecolorallocatealpha(
    $corner_image,
    255,
    255,
    255,
    0
);

imagecolortransparent(
    $corner_image,
    $clear_colour
);

imagefill(
    $corner_image,
    0,
    0,
    $solid_colour
);

imagefilledellipse(
    $corner_image,
    $radius,
    $radius,
    $radius * 2,
    $radius * 2,
    $clear_colour
);

/*
 * render the top-left, bottom-left, bottom-right, top-right corners by rotating and copying the mask
 */

imagecopymerge(
    $dp,
    $corner_image,
    0,
    0,
    0,
    0,
    $radius,
    $radius,
    100
);

$corner_image = imagerotate($corner_image, 90, 0);

imagecopymerge(
    $dp,
    $corner_image,
    0,
    $source_height - $radius,
    0,
    0,
    $radius,
    $radius,
    100
);

$corner_image = imagerotate($corner_image, 90, 0);

imagecopymerge(
    $dp,
    $corner_image,
    $source_width - $radius,
    $source_height - $radius,
    0,
    0,
    $radius,
    $radius,
    100
);

$corner_image = imagerotate($corner_image, 90, 0);

imagecopymerge(
    $dp,
    $corner_image,
    $source_width - $radius,
    0,
    0,
    0,
    $radius,
    $radius,
    100
);

?>