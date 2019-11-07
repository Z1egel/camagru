<?php

require "../application/config/database.php";
require_once "../application/lib/functions.php";

session_start();

$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);

if (isset($_POST['photo_id'])) {

    $sql = 'SELECT p.photo_id, p.url, p.thumb_url, u.login, COUNT( l.photo_id ) AS likes
            FROM photos p
            LEFT JOIN users u ON p.user_id = u.user_id
            LEFT JOIN likes l ON p.photo_id = l.photo_id
            WHERE p.photo_id = ?
            GROUP BY p.photo_id';
    $query = $dbh->prepare($sql);
    $id = $_POST['photo_id'];
    $params = [
        $id,
    ];
    if (!empty($params))
    {
        foreach ($params as $key => $val)
            $query->bindValue(':'.$key, $val);
    }
    $query->execute($params);
    $result = $query->fetch();

    $sql = 'SELECT u.login, c.comment, c.`date` FROM comments c LEFT JOIN users u ON u.user_id = c.user_id WHERE photo_id = ?';
    $query = $dbh->prepare($sql);
    $params = [
        $id,
    ];
    if (!empty($params))
    {
        foreach ($params as $key => $val)
            $query->bindValue(':'.$key, $val);
    }
    $query->execute($params);
    $comments = $query->fetchAll();

        $sql = 'SELECT status FROM likes WHERE user_id = ? AND photo_id = ?';
    $query = $dbh->prepare($sql);
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
    $params = [
        $user_id,
        $id,
    ];
    if (!empty($params))
    {
        foreach ($params as $key => $val)
            $query->bindValue(':'.$key, $val);
    }
    $query->execute($params);
    $status = $query->fetch();

    $vars = [
        'photo' => [
            'url' => $result['url'],
            'thumb_url' => $result['thumb_url'],
            'author' => $result['login'],
            'likes' => $result['likes'],
            'status' => $status['status'],
        ],
        'comments' => $comments,
    ];
    exit(json_encode($vars));
}