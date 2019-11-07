<?php

require "../application/config/database.php";
require_once "../application/lib/functions.php";

session_start();

$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);

if (isset($_POST['sticker']) && isset($_POST['image'])) {
    $sql = 'INSERT INTO photos (user_id, url, thumb_url) VALUES (?, ?, ?)';
    $user_id = $_SESSION['user_id'];
    $date = implode('', getdate());
    $url = "../public/img/photos/".substr(hash('whirlpool', randomPassword()), 0, 20).".jpg";
    $thumb_url = preg_replace('/.jpg/i', '', $url);
    $thumb_url .= "_thumb.jpg";
    $image_data = base64_decode($_POST['image']);
    $sticker_data = base64_decode($_POST['sticker']);
    $image1 = imagecreatefromstring($image_data);
    $image2 = imagecreatefromstring($sticker_data);
    $image3 = imagecreatetruecolor(400, imagesy($image1)/(imagesx($image1)/400));
    imagecopy($image1, $image2, $_POST['left'], $_POST['top'], 0, 0, imagesx($image2), imagesy($image2));
    imagejpeg($image1, $url);
    imagecopyresampled($image3, $image1, 0, 0, 0, 0, 400, imagesy($image1)/(imagesx($image1)/400), imagesx($image1), imagesy($image1));
    imagejpeg($image3, $thumb_url);
    imagedestroy($image1);
    imagedestroy($image2);
    imagedestroy($image3);

    $params = [
        $user_id,
        $url,
        $thumb_url
    ];
    $query = $dbh->prepare($sql);
    if (!empty($params))
    {
        foreach ($params as $key => $val)
            $query->bindValue(':'.$key, $val);
    }
    $query->execute($params);
    $urls = [
        'url' => $url,
        'thumb_url' => $thumb_url,
    ];
    $urls = json_encode($urls);
    echo $urls;
}