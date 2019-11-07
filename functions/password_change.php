<?php

require "../application/config/database.php";
require_once "../application/lib/functions.php";

session_start();

$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);

if (isset($_POST['new_pass']) && isset($_POST['old_pass'])) {
    $sql = 'SELECT password FROM users WHERE login = ?';
    $login = $_SESSION['login'];
    $params = [
        $login,
    ];
    $query = $dbh->prepare($sql);
    if (!empty($params))
    {
        foreach ($params as $key => $val)
            $query->bindValue(':'.$key, $val);
    }
    $query->execute($params);
    $pass = $query->fetch();
    $passwd = hash('whirlpool', $_POST['old_pass']);
    if ($pass[0] !== $passwd)
        exit("INVALID_PASSWORD");
    $sql = 'UPDATE users SET password = ? WHERE login = ?';
    $password = hash('whirlpool', $_POST['new_pass']);
    $params = [
        $password,
        $login,
    ];
    $query = $dbh->prepare($sql);
    if (!empty($params))
    {
        foreach ($params as $key => $val)
            $query->bindValue(':'.$key, $val);
    }
    $query->execute($params);
}