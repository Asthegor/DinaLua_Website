<?php

class HomeModel extends Model
{
    public function index()
    {
        $this->query("SELECT date_news, title, content, new_version, new_example
                      FROM news 
                      WHERE visible = 1
                      ORDER BY date_news DESC, id DESC
                      LIMIT 5");
        return $this->resultSet();
    }

    public function GetAnnounce()
    {
        $this->query("SELECT content
                      FROM configs
                      WHERE data = 'announce'");
        return $this->single();
    }
}

?>