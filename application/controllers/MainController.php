<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Db;

class MainController extends Controller
{
    public function indexAction() {
        if (isLoggedIn()) {
            $stickers = $this->model->getStickers();
            $condition = "WHERE user_id = :user_id ORDER BY photo_id DESC";
            $params = [
               'user_id' => $_SESSION['user_id'],
            ];
            $photos = $this->model->getUserPhotos($condition, $params);
            $vars = [
                'stickers' => $stickers,
                'photos' => $photos,
            ];
            $this->view->render('Camagru', $vars);
        }
        else
            $this->view->redirect('/gallery');
    }

    public function refreshAction() {
        return "qwe";
    }

    public function contactAction() {
        echo 'Контакты';
    }

    public function profileAction() {
        $this->view->render('Профиль пользователя');
    }
}