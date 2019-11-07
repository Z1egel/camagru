<?php

require "../application/config/database.php";
require_once "../application/lib/functions.php";

session_start();

$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);

if (isset($_POST['email'])) {
    $sql = 'SELECT * FROM users';
    $users = $dbh->query($sql);
    foreach ($users as $row) {
        if ($row['email'] == $_POST['email']) {
            exit("EMAIL_EXISTS");
        }
    }
    $sql = 'UPDATE users SET email = ? WHERE email = ?';
    $new_email = $_POST['email'];
    $old_email = $_SESSION['email'];
    $params = [
        $new_email,
        $old_email,
    ];
    $query = $dbh->prepare($sql);
    if (!empty($params))
    {
        foreach ($params as $key => $val)
            $query->bindValue(':'.$key, $val);
    }
    $query->execute($params);
    $_SESSION['email'] = $new_email;
}