<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    function debug($str) {
        echo '<pre>';
        var_dump($str);
        echo '</pre>';
        exit;
    }

    function isLoggedIn()
    {
        if (isset($_SESSION['login']))
            return true;
        return false;
    }

    function isConfirmed()
    {
        if (isset($_SESSION['confirmed']))
            return true;
        return false;
    }

    function baseStickerURL() {
        return "/public/img/stickers/";
    }

    function basePhotoURL() {
        return "/public/img/photos/";
    }

    function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }