<?php
    require_once('database.php');

    $DB_DBH = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $DB_DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = file_get_contents('bd.sql');
    $query = $DB_DBH->exec($sql);
    echo ("OK");