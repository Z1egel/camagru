<?php

require "../application/config/database.php";
require_once "../application/lib/functions.php";

session_start();

$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);

if (isset($_POST['photo_id'])) {
    $sql = 'DELETE FROM likes WHERE user_id = ? AND photo_id = ?';
    $user_id = $_SESSION['user_id'];
    $photo_id = $_POST['photo_id'];
    $params = [
        $user_id,
        $photo_id,
    ];
    $query = $dbh->prepare($sql);
    if (!empty($params))
    {
        foreach ($params as $key => $val)
            $query->bindValue(':'.$key, $val);
    }
    $query->execute($params);
}