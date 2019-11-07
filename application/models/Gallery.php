<?php

namespace application\models;

use application\core\Model;

class Gallery extends Model
{
    public function getPhotos($condition = '', $params = [])
    {
        $result = $this->db->row('SELECT p.photo_id, p.url, p.thumb_url, (SELECT count(l.photo_id) FROM likes l WHERE p.photo_id = l.photo_id) AS likes, (SELECT count(c.photo_id) FROM comments c WHERE p.photo_id = c.photo_id) AS comments FROM photos p
GROUP BY p.photo_id '.$condition, $params);
        return $result;
    }

    public function getPhoto($id)
    {
        $params = [
            'photo_id' => $id,
        ];
        $result = $this->db->row('SELECT photo_id, url, thumb_url FROM photos WHERE photo_id = :photo_id', $params);
        return $result;
    }
}