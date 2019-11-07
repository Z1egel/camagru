<?php

require "../application/config/database.php";

$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);

if (isset($_POST['url'])) {
    $sql = 'DELETE FROM photos WHERE thumb_url = :url';
    $query = $dbh->prepare($sql);
    $query->bindValue(':url', $_POST['url']);
    $query->execute();
}