<?php

class TutorialCategoryModel extends Model
{
    private $returnPage = "tutorials";
    public function Index()
    {
        $this->query("SELECT id, name, description, sortOrder
                      FROM tutorialcategory
                      ORDER BY sortOrder");
        $rows = $this->resultSet();
        $this->close();
        return $rows;
    }

    public function Add()
    {
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_ENCODED);
        if ($post['submit'])
        {
            if ($post['name'] == '')
            {
                Messages::setMsg('Please fill in all mandatory fields', 'error');
            }
            else
            {
                // Insert into MySQL
                $this->startTransaction();
                // Insertion du nom français
                $this->query("INSERT INTO tutorialcategory (name, description, sortOrder)
                              VALUES (:name, :description, :sortOrder)");
                $this->bind(':name', $post['name']);
                $this->bind(':description', $post['content']);
                $this->bind(':sortOrder', $post['sortOrder']);
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
            if ($post['name'] == '')
            {
                Messages::setMsg('Please fill in all mandatory fields', 'error');
            }
            else
            {
                // Insert into MySQL
                $this->startTransaction();
                //Insertion des données générales
                $this->query("UPDATE tutorialcategory
                              SET name = :name, description = :description, 
                              sortOrder = :sortOrder
                              WHERE id = :id");
                $this->bind(':name', $post['name']);
                $this->bind(':description', $post['content']);
                $this->bind(':sortOrder', $post['sortOrder']);
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
        $this->query("SELECT id, name, description, sortOrder 
                      FROM tutorialcategory WHERE id = :id");
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
            $this->query('DELETE FROM tutorialcategory WHERE id = :id');
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
        $this->query("SELECT id, name
                      FROM tutorialcategory 
                      WHERE id = :id");
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
    
    public function getlist($currentId)
    {
        $query = "SELECT id, name, description, sortOrder 
                  FROM tutorialcategory 
                  ORDER BY sortOrder, name";
        if($currentId <> '')
            $query .= " AND id <> :id";
        var_dump($query);
        $this->query($query);
        if($currentId <> '')
            $this->bind(':id', $currentId);
        $rows = $this->resultSet();
        $this->close();
        return $rows;
    }
}
?>