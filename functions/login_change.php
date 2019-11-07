<?php

require "../application/config/database.php";
require_once "../application/lib/functions.php";

session_start();

$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);

if (isset($_POST['login'])) {
    $sql = 'SELECT * FROM users';
    $users = $dbh->query($sql);
    foreach ($users as $row) {
        if ($row['login'] == $_POST['login']) {
            exit("LOGIN_EXISTS");
        }
    }
    $sql = 'UPDATE users SET login = ? WHERE login = ?';
    $new_login = $_POST['login'];
    $old_login = $_SESSION['login'];
    $params = [
        $new_login,
        $old_login,
    ];
    $query = $dbh->prepare($sql);
    if (!empty($params))
    {
        foreach ($params as $key => $val)
            $query->bindValue(':'.$key, $val);
    }
    $query->execute($params);
    $_SESSION['login'] = $new_login;
}