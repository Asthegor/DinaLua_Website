<?php

class HomeModel extends Model
{
    public function index()
    {
        $get = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
        $query = " SELECT date_news, title, content, new_version, new_example, new_tutorial, new_tool ".
                 " FROM news ".
                 " WHERE visible = 1 ".
                 " ORDER BY date_news DESC, id DESC".
                 " LIMIT 5 ";
        $num = isset($get['id']) ? intval($get['id']) : 0;
        if ($num > 0 && $num % 5 == 0)
            $query .= " OFFSET ".$num." ";
        $this->query($query);
        return $this->resultSet();
    }

    public function GetAnnounce()
    {
        $this->query("SELECT content
                      FROM configs
                      WHERE data = 'announce'");
        return $this->single();
    }
    
    public function NbNews()
    {
        $this->query("SELECT count(*) Nb
                      FROM news
                      WHERE visible = 1");
        $rows = $this->single();
        return $rows['Nb'];
    }
}

?>