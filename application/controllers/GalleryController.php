<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Db;

class GalleryController extends Controller
{
    public function showAction() {
        $condition = 'ORDER BY photo_id DESC LIMIT 32';
        $photos = $this->model->getPhotos($condition);
        $vars = [
            'photos' => $photos,
        ];
        $this->view->render('Галерея', $vars);
    }

    public function photoAction() {
        $this->view->layout = 'account';
        $condition = 'WHERE photo_id = :photo_id';
        $params = [
            'photo_id' => $this->route['id'],
        ];
        $photo = $this->model->getPhotos($condition, $params);
        if ($photo) {
            $vars = [
                'photo' => $photo[0],
            ];
        }
        else {
            $this->view->errorCode(404);
        }
        return $vars;
    }
}