<?php

class TutorialsModel extends Model
{
    public function TutorialsByCategory($Id_Categ)
    {
        $query = "SELECT id, title, short_desc ".
                 "FROM tutorial ".
                 "WHERE visible = 1 ".
                 "AND id_Category = :id_Category ".
                 "ORDER BY id_Previous, id_Next, id";
        $this->query($query);
        $this->bind(":id_Category", $Id_Categ);
        $rows = $this->resultSet();
        $this->close();
        return $rows;
    }
    
    public function SubCategByCategId($Id)
    {
        $this->query("SELECT id, name, description ".
                     "FROM tutorialcategory ".
                     "WHERE id_Parent = :id");
        $this->bind(":id", $Id);
        $rows = $this->resultSet();
        $this->close();
        return $rows;
    }

    public function GetCategoriesWithoutParent()
    {
        $this->query("SELECT id, name, description ".
                     "FROM tutorialcategory ".
                     "WHERE id_Parent = 0 ".
                     "ORDER BY sortOrder, id");
        $rows = $this->resultSet();
        $this->close();
        return $rows;
    }
}
?>