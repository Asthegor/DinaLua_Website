<?php

class ToolsModel extends Model
{
    public function index()
    {
        //return array_reverse(glob("files/tools/*.zip"));
        $this->query("SELECT t.id, t.title, t.description, t.file, t.date, ".
                            "t.id_Tutorial, tu.title tutorial ".
                     "FROM tools AS t ".
                        "LEFT JOIN tutorial as tu ON t.id_Tutorial = tu.id ".
                     "WHERE t.visible = 1 ".
                     "ORDER BY t.sortOrder, t.title");
        $rows = $this->resultSet();
        $this->close();
        return $rows;
    }

}
?>