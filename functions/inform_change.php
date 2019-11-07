<?php

require "../application/config/database.php";
require_once "../application/lib/functions.php";

session_start();

$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);

if (isset($_POST['inform'])) {
    $sql = 'UPDATE users SET inform = ? WHERE login = ?';
    $inform = $_POST['inform'];
    $user_id = $_SESSION['login'];
    $params = [
        $inform,
        $user_id,
    ];
    $query = $dbh->prepare($sql);
    if (!empty($params))
    {
        foreach ($params as $key => $val)
            $query->bindValue(':'.$key, $val);
    }
    $query->execute($params);
    $_SESSION['inform'] = $inform;
}