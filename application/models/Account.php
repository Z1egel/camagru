<?php

namespace application\models;

use application\core\Model;

class Account extends Model
{
    public function getUsers($condition = '', $params = [])
    {
        $result = $this->db->row('SELECT * FROM users '.$condition, $params);
        return $result;
    }

    public function registerUser($login, $email, $passwd, $confirm_link)
    {
        $sql = 'INSERT INTO users (login, email, password, confirm_link) VALUES (?, ?, ?, ?)';
        $params = [
            $login,
            $email,
            $passwd,
            $confirm_link
        ];
        $this->db->query($sql, $params);
    }

    public function updatePassword($password, $login)
    {
        $sql = 'UPDATE users SET password = ? WHERE login = ?';
        $params = [
            $password,
            $login,
        ];
        $this->db->query($sql, $params);
    }

    public function confirmUser($confirm_link)
    {
        $sql = 'UPDATE users SET confirmed = 1 WHERE confirm_link = ?';
        $params = [
            $confirm_link,
        ];
        $this->db->query($sql, $params);
    }

    public function isLinkExists($link)
    {
        $params = [
            'link' => $link,
        ];
        $result = $this->db->row('SELECT * FROM users WHERE confirm_link = :link', $params);
        return $result;
    }
}