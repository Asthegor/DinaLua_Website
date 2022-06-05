<?php

class NavBarModel extends Model
{
    public function getVisibleItems()
    {
        $this->query("SELECT title, destination, bPage, bRight
                      FROM navbar
                      WHERE visible = 1
                      ORDER BY sortOrder");
        $rows = $this->resultSet();
        $this->close();
        return $rows;
    }

}

?>