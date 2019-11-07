<?php

require "../application/config/database.php";
require_once "../application/lib/functions.php";

session_start();

$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);

if (isset($_POST['comment'])) {
    $sql = 'INSERT INTO comments (user_id, photo_id, comment) VALUES (?, ?, ?)';
    $user_id = $_SESSION['user_id'];
    $photo_id = $_POST['photo_id'];
    $comment = $_POST['comment'];
    $params = [
        $user_id,
        $photo_id,
        $comment,
    ];
    $query = $dbh->prepare($sql);
    if (!empty($params))
    {
        foreach ($params as $key => $val)
            $query->bindValue(':'.$key, $val);
    }
    $query->execute($params);

    $sql = 'SELECT u.login, u.email, u.inform
            FROM users u
            LEFT JOIN photos p ON u.user_id = p.user_id
            WHERE photo_id = ?';
    $params = [
        $photo_id,
    ];
    $query = $dbh->prepare($sql);
    if (!empty($params))
    {
        foreach ($params as $key => $val)
            $query->bindValue(':'.$key, $val);
    }
    $query->execute($params);
    $result = $query->fetch();
    if ($result['inform']) {
        mail($result['email'], "Новый комментарий", "Привет, ".$result['login']."! Пользователь ".$_SESSION['login']." только что прокомментировал твою фотографию.");
    }
}