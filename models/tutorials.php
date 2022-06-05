<?php

class TutorialsModel extends Model
{
    public function index()
    {
        $this->query("SELECT t.id, t.title, t.short_desc, 
                             tc.name category, tc.description categ_desc
                      FROM tutorial AS t
                      LEFt JOIN tutorialcategory AS tc ON t.id_Category = tc.id
                      WHERE t.visible = 1
                      ORDER BY tc.sortOrder, tc.name, t.id");
        $rows = $this->resultSet();
        $this->close();
        return $rows;
    }
}
?>