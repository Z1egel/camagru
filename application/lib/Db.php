<?php

namespace application\lib;

use PDO;

class Db
{
    protected $dbh;

    public function __construct()
    {
        require 'application/config/database.php';
        $this->dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    }

    public function query($sql, $params = []) {
        $query = $this->dbh->prepare($sql);
        if (!empty($params))
        {
            foreach ($params as $key => $val)
                $query->bindValue(':'.$key, $val);
        }
        $query->execute($params);
        return $query;
    }

    public function row($sql, $params = []) {
        $result = $this->query($sql, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function column($sql, $params =[]) {
        $result = $this->query($sql, $params);
        return $result->fetchColumn();
    }
}