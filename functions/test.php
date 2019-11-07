<?php
    require_once '../application/lib/functions.php';

    $url = "../public/img/photos/".hash('whirlpool', $_POST['sticker']).".jpg";
    $image = imagecreate(200, 200);
    $blue = imagecolorallocate($image, 0, 0, 255);
    $red = imagecolorallocate($image, 255, 0, 0);
    imagejpeg($image, $file);
    imagedestroy($image);
