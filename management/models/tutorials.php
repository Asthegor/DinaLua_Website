<?php

class TutorialsModel extends Model
{
    private $returnPage = "tutorials";
    public function Index()
    {
        $this->query("SELECT t.id, t.title, t.short_desc, t.content,
                      CASE WHEN tc.name IS NULL THEN '' ELSE tc.name END Category, 
                      t.id_Previous, t.id_Next, t.visible 
                      FROM tutorial AS t 
                      LEFT JOIN tutorialcategory AS tc ON t.id_Category = tc.id 
                      ORDER BY t.visible, t.id");
        $rows = $this->resultSet();
        $this->close();
        return $rows;
    }

    public function Add()
    {
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_ENCODED);
        if ($post['submit'])
        {
            if ($post['title'] == '' || $post['content'] == '')
            {
                Messages::setMsg('Please fill in all mandatory fields', 'error');
            }
            else
            {
                // Insert into MySQL
                $this->startTransaction();
                // Insertion du nom français
                $this->query("INSERT INTO tutorial (id_Category, title, short_desc, content, id_Previous, id_Next, visible) 
                              VALUES (:id_Category, :title, :short_desc, :content, :id_Previous, :id_Next, :visible)");
                $this->bind(':id_Category', $post['id_Category']);
                $this->bind(':title', $post['title']);
                $this->bind(':short_desc', $post['short_desc']);
                $this->bind(':content', $post['content']);
                $this->bind(':id_Previous', isset($post['id_Previous']) ? $post['id_Previous'] : NULL);
                $this->bind(':id_Next', isset($post['id_Next']) ? $post['id_Next'] : NULL);
                $this->bind(':visible', isset($post['visible']) ? $post['visible'] : 0, PDO::PARAM_INT);
                $resp = $this->execute();
                //Verify
                if($resp)
                {
                    $this->commit();
                    $this->close();
                    $this->returnToPage($this->returnPage);
                    return;
                }
                $this->rollback();
                $this->close();
                Messages::setMsg('Error(s) during insert : [resp='.$resp.']', 'error');
            }
        }
        return;
    }

    public function Update()
    {
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_ENCODED);
        if ($post['submit'])
        {
            if ($post['title'] == '' || $post['content'] == '')
            {
                Messages::setMsg('Please fill in all mandatory fields', 'error');
            }
            else
            {
                // Insert into MySQL
                $this->startTransaction();
                //Insertion des données générales
                $this->query("UPDATE tutorial 
                              SET title = :title, short_desc = :short_desc, content = :content, 
                                  id_Previous = :id_Previous, id_Next = :id_Next,  
                                  id_Category = :id_Category, visible = :visible  
                              WHERE id = :id");
                $this->bind(':title', $post['title']);
                $this->bind(':short_desc', $post['short_desc']);
                $this->bind(':content', $post['content']);
                $this->bind(':id_Previous', isset($post['id_Previous']) ? $post['id_Previous'] : null);
                $this->bind(':id_Next', isset($post['id_Next']) ? $post['id_Next'] : null);
                $this->bind(':id_Category', $post['id_Category']);
                $this->bind(':visible', isset($post['visible']) ? $post['visible'] : 0);
                $this->bind(':id', $post['id']);
                $resp = $this->execute();
                //Verify
                if($resp)
                {
                    $this->commit();
                    $this->close();
                    $this->returnToPage($this->returnPage);
                    return;
                }
                else
                {
                    $this->rollback();
                    $this->close();
                    Messages::setMsg('Error(s) during update : [resp='.$resp.']', 'error');
                }
            }
        }
        $get = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
        $this->query("SELECT id, id_Category, title, short_desc, content, 
                             id_Previous, id_Next, visible 
                      FROM tutorial WHERE id = :id");
        $this->bind(':id', $get['id']);
        $rows = $this->single();
        $this->close();
        if (!$rows)
        {
            Messages::setMsg('Record "'.$get['id'].'" not found', 'error');
            $this->returnToPage($this->returnPage);
        }
        return $rows;
    }

    public function Delete()
    {
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($post['todelete']))
        {
            $this->query('DELETE FROM tutorial WHERE id = :id');
            $this->bind(':id', $post['id']);
            $res = $this->execute();
            if (!$res)
            {
                Messages::setMsg('Record used by another record.', 'error');
            }
            $this->close();
            $this->returnToPage($this->returnPage);
        }
        $get = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
        $this->query("SELECT id, title 
                      FROM tutorial WHERE id = :id 
                      ORDER BY visible, id");
        $this->bind(':id', $get['id']);
        $rows = $this->single();
        $this->close();
        if (!$rows)
        {
            Messages::setMsg('Record "'.$get['id'].'" not found', 'error');
            $this->returnToPage($this->returnPage);
        }
        return $rows;
    }
    
    public function getlist($currentId, $currentCateg)
    {
        $query = "SELECT id, title
                  FROM tutorial 
                  WHERE visible = 1 ";
        if($currentId <> '')
            $query .= " AND id <> :id ";
        if(isset($currentCateg) && $currentCateg <> '')
            $query .= " AND id_Category = :id_Category ";
var_dump($query);            
        $this->query($query);

        if($currentId <> '')
            $this->bind(':id', $currentId);
        if(isset($currentCateg) && $currentCateg <> '')
            $this->bind(':id_Category', $currentCateg);

        $rows = $this->resultSet();
        $this->close();
        return $rows;
    }
}
?>