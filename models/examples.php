<?php

class ExamplesModel extends Model
{
    public function index()
    {
        $this->query("SELECT e.id, e.title, e.description, e.file,
                             ec.name category, ec.description categ_desc
                      FROM example AS e
                      LEFt JOIN examplecategory AS ec ON e.id_Category = ec.id
                      WHERE e.visible = 1
                      ORDER BY ec.sortOrder, ec.name, e.title");
        $rows = $this->resultSet();
        $this->close();
        return $rows;
    }

}

?>