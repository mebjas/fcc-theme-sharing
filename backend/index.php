<?php
if (!isset($j)) {
    if (!isset($_GET['j'])) {
       echo json_encode(array('error' => true, 'message' => 'insufficient credentials'));
       exit;
    }
    $j = json_decode($_GET['j'], true);
}

$name = (isset($_GET['n'])) ? $_GET['n'] : 'James';

function image_gradientrect($img,$x,$y,$x1,$y1,$start,$end) {
   if($x > $x1 || $y > $y1) {
      return false;
   }
   $s = array(
      hexdec(substr($start,0,2)),
      hexdec(substr($start,2,2)),
      hexdec(substr($start,4,2))
   );
   $e = array(
      hexdec(substr($end,0,2)),
      hexdec(substr($end,2,2)),
      hexdec(substr($end,4,2))
   );
   $steps = $y1 - $y;
   for($i = 0; $i < $steps; $i++) {
      $r = $s[0] - ((($s[0]-$e[0])/$steps)*$i);
      $g = $s[1] - ((($s[1]-$e[1])/$steps)*$i);
      $b = $s[2] - ((($s[2]-$e[2])/$steps)*$i);
      $color = imagecolorallocate($img,$r,$g,$b);
      imagefilledrectangle($img,$x,$y+$i,$x1,$y+$i+1,$color);
   }
   return true;
}

$font_file = "Tahoma.ttf";
$font_file_bold = "tahomabd.ttf";
$font_file_italics = "tahomaitalic.ttf";
$font_file_bold_italics = "tahomabolditalic.ttf";


//setting the image header in order to proper display the image
header("Content-Type: image/png");
//try to create an image
$im = @imagecreatefrompng ("download.png")
    or die("Cannot Initialize new GD image stream");

// Make title bar colors as per colors in JSON
$titlebar_bg_hex = $j['titlebar']['background'];
$titlebar_color_hex = $j['titlebar']['color'];
$body_bg_hex = $j['body']['background'];

preg_match("/\#*([\dA-Fa-f]{2})([\dA-Fa-f]{2})([\dA-Fa-f]{2})/", $titlebar_bg_hex, $op);
$titlebar_bg = imagecolorallocatealpha($im, hexdec($op[1]), hexdec($op[2]), hexdec($op[3]), round(127 * (100 - intval($j['titlebar']['opacity']))/ 100));

preg_match("/\#*([\dA-Fa-f]{2})([\dA-Fa-f]{2})([\dA-Fa-f]{2})/", $titlebar_color_hex, $op);
$titlebar_color = imagecolorallocatealpha($im, hexdec($op[1]), hexdec($op[2]), hexdec($op[3]), 0);

preg_match("/\#*([\dA-Fa-f]{2})([\dA-Fa-f]{2})([\dA-Fa-f]{2})/", $body_bg_hex, $op);
$body_bg = imagecolorallocatealpha($im, hexdec($op[1]), hexdec($op[2]), hexdec($op[3]), round(127 * (100 - intval($j['body']['opacity']))/ 100));


$dp = @imagecreatefromjpeg("dp.jpg");
// if ($j['message_r']['isDPCircular'] === true) {
//    include __DIR__ .'/dp.php';
// }

$white = imagecolorallocatealpha($im, 255, 255, 255, 0);
$black = imagecolorallocatealpha($im, 0, 0, 0, 0);
$silver = imagecolorallocatealpha($im, 221, 221, 221, 20);
$silver_bg = imagecolorallocatealpha($im, 221, 221, 221, 100);
$green = imagecolorallocatealpha($im, 0, 255, 0, 40);


imagefilledrectangle ($im , 100 , 100 , 340 , 128 , $titlebar_bg);
imagettftext($im, 13, 0, 125, 120, $titlebar_color, $font_file, $name);
imagefilledellipse ( $im , 115 , 113 , 6 , 6 , $green);

imagefilledrectangle ($im , 100 , 128 , 340 , 525 , $silver_bg);
imagefilledrectangle ($im , 101 , 129 , 339 , 524 , $body_bg);

// Chat bubble by sender
// Border of color bg-1
preg_match("/\#*([\dA-Fa-f]{2})([\dA-Fa-f]{2})([\dA-Fa-f]{2})/", $j['message_r']['background'][1], $op);
$message_r_border = imagecolorallocatealpha($im, hexdec($op[1]), hexdec($op[2]), hexdec($op[3]), 0);
preg_match("/\#*([\dA-Fa-f]{2})([\dA-Fa-f]{2})([\dA-Fa-f]{2})/", $j['message_r']['color'], $op);
$message_r_color = imagecolorallocatealpha($im, hexdec($op[1]), hexdec($op[2]), hexdec($op[3]), 0);

// Chat bubble by me
// Border of color bg-1
preg_match("/\#*([\dA-Fa-f]{2})([\dA-Fa-f]{2})([\dA-Fa-f]{2})/", $j['message_s']['background'][0], $op);
$message_s_border = imagecolorallocatealpha($im, hexdec($op[1]), hexdec($op[2]), hexdec($op[3]), 0);
preg_match("/\#*([\dA-Fa-f]{2})([\dA-Fa-f]{2})([\dA-Fa-f]{2})/", $j['message_s']['color'], $op);
$message_s_color = imagecolorallocatealpha($im, hexdec($op[1]), hexdec($op[2]), hexdec($op[3]), 0);

if ($j['message_r']['bold'] === true) {
   if ($j['message_r']['italics'] === true) $f_r = $font_file_bold_italics;
   else $f_r = $font_file_bold;
} else {
   if ($j['message_r']['italics'] === true) $f_r = $font_file_italics;
   else $f_r = $font_file;
}

if ($j['message_s']['bold'] === true) {
   if ($j['message_s']['italics'] === true) $f_s = $font_file_bold_italics;
   else $f_s = $font_file_bold;
} else {
   if ($j['message_s']['italics'] === true) $f_s = $font_file_italics;
   else $f_s = $font_file;
}


if (intval($j['message_r']['fontsize']) > 14) $j['message_r']['fontsize'] = 14;
if (intval($j['message_s']['fontsize']) > 14) $j['message_s']['fontsize'] = 14;


imagefilledrectangle ($im , 145 , 160 , 320 , 210 , $message_r_border);
image_gradientrect($im, 146, 161, 319, 209, substr($j['message_r']['background'][1],1), substr($j['message_r']['background'][0],1));
imagecopy($im, $dp, 110, 163, 0, 0, 32, 32);
imagettftext($im, intval($j['message_r']['fontsize']) - 2, 0, 155, 180 , $message_r_color, $f_r, "Hey are you using fb");
imagettftext($im, intval($j['message_r']['fontsize']) - 2, 0, 155, 195 , $message_r_color, $f_r, "Chat Customiser?");


imagefilledrectangle ($im , 155 , 220 , 335 , 275 , $message_s_border);
image_gradientrect($im, 156, 221, 334, 274, substr($j['message_s']['background'][1],1), substr($j['message_s']['background'][0],1));
imagettftext($im, intval($j['message_s']['fontsize']) - 2, 0, 165, 235 , $message_r_color, $f_s, "Yeah!!");
imagettftext($im, intval($j['message_s']['fontsize']) - 2, 0, 165, 250 , $message_r_color, $f_s, "Its super awesome!");
imagettftext($im, intval($j['message_s']['fontsize']) - 2, 0, 165, 265 , $message_r_color, $f_s, "wbu?");

imagefilledrectangle ($im , 145 , 285 , 320 , 420 , $message_r_border);
image_gradientrect($im, 146, 286, 319, 419, substr($j['message_r']['background'][1],1), substr($j['message_r']['background'][0],1));
imagecopy($im, $dp, 110, 288, 0, 0, 32, 32);
imagettftext($im, intval($j['message_r']['fontsize']) - 2, 0, 155, 305 , $message_r_color, $f_r, "Yup");
imagettftext($im, intval($j['message_r']['fontsize']) - 2, 0, 155, 320 , $message_r_color, $f_r, "Its great the way we");
imagettftext($im, intval($j['message_r']['fontsize']) - 2, 0, 155, 335 , $message_r_color, $f_r, "cn chnge chat height,");
imagettftext($im, intval($j['message_r']['fontsize']) - 2, 0, 155, 350 , $message_r_color, $f_r, "font, color, backgrnd");
imagettftext($im, intval($j['message_r']['fontsize']) - 2, 0, 155, 375 , $message_r_color, $f_r, "transparecny...., or");
imagettftext($im, intval($j['message_r']['fontsize']) - 2, 0, 155, 390 , $message_r_color, $f_r, "Choose from Themes,");
imagettftext($im, intval($j['message_r']['fontsize']) - 2, 0, 155, 405 , $message_r_color, $f_r, "its just awesome :)");

// Chat text area
imagefilledrectangle ($im , 100 , 525 , 340 , 555 , $silver);
imagefilledrectangle ($im , 101 , 526 , 339 , 554 , $white);
imagettftext($im, 11, 0, 105, 545 , $black, "Tahoma.ttf", "awesome :) lets share it|");


//outputs the image as png
imagepng($im);
//frees any memory associated with the image
imagedestroy($im);
?>