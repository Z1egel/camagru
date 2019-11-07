<?php

require "../application/config/database.php";
require_once "../application/lib/functions.php";

session_start();

$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);

if (isset($_POST['id'])) {
    $sql = 'SELECT p.photo_id, p.url, p.thumb_url, (SELECT count(l.photo_id) FROM likes l WHERE p.photo_id = l.photo_id) AS likes, (SELECT count(c.photo_id) FROM comments c WHERE p.photo_id = c.photo_id) AS comments FROM photos p
WHERE p.photo_id < ? GROUP BY p.photo_id ORDER BY p.photo_id DESC LIMIT 16';
    $id = $_POST['id'];
    $params = [
        $id,
    ];
    $query = $dbh->prepare($sql);
    if (!empty($params))
    {
        foreach ($params as $key => $val)
            $query->bindValue(':'.$key, $val);
    }
    $query->execute($params);
    $result = json_encode($query->fetchAll());
    exit($result);
}