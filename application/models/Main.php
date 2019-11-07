<?php

namespace application\models;

use application\core\Model;

class Main extends Model
{
    public function getStickers()
    {
        $result = $this->db->row('SELECT url, category FROM stickers');
        return $result;
    }

    public function getUserPhotos($condition = '', $params = [])
    {
        $result = $this->db->row('SELECT url, thumb_url FROM photos '.$condition, $params);
        return $result;
    }

}