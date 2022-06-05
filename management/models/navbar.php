<?php

class NavBarModel extends Model
{
    private $header = 'navbar';

    public function Index()
    {
        $this->query('SELECT id, title, destination, visible, bPage, sortOrder, bRight '.
                     'FROM navbar '.
                     'ORDER BY visible DESC, sortOrder, id');
        $rows = $this->resultSet();
        $this->close();
        return $rows;
    }

    public function Add()
    {
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if ($post['submit'])
        {
            if ($post['title'] == '' || $post['destination'] == '')
            {
                Messages::setMsg('Please fill in all mandatory fields', 'error');
            }
            else
            {
                // Insert into MySQL
                $this->startTransaction();
                //Insertion des données générales
                $this->query('INSERT INTO navbar (title, destination, visible, bPage, sortOrder, bRight) ' .
                             'VALUES (:title, :destination, :visible, :bPage, :sortOrder, :bRight)');
                $this->bind(':title', $post['title']);
                $this->bind(':destination', $post['destination']);
                $this->bind(':visible', (isset($post['visible']) ? $post['visible'] : 0), PDO::PARAM_INT);
                $this->bind(':bPage', (isset($post['bPage']) ? $post['bPage'] : 0), PDO::PARAM_INT);
                $this->bind(':sortOrder', (isset($post['sortOrder']) ? $post['sortOrder'] : 0), PDO::PARAM_INT);
                $this->bind(':bRight', (isset($post['bRight']) ? $post['bRight'] : 0), PDO::PARAM_INT);
                $this->execute();
                $id = $this->lastIndexId();
                //Verify
                if($id)
                {
                    $this->commit();
                    $this->close();
                    $this->returnToPage($this->header);
                }
                $this->rollback();
                $this->close();
                Messages::setMsg('Error(s) during insert [$id='.$id.', $respfr='.$respfr.', $respen='.$respen.']', 'error');
            }
        }
        return;
    }

    public function Update()
    {
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($post['submit']))
        {
            // Contrôle des données
            if ($post['title'] == '' || $post['destination'] == '')
            {
                Messages::setMsg('Please fill in all mandatory fields', 'error');
            }
            else
            {
                //Mise à jour de la base
                $this->startTransaction();
                //Insertion de l'image
                // Mise à jour de la table 
                $this->query('UPDATE navbar '.
                             'SET title=:title, destination=:destination, bPage=:bPage, '.
                                 'visible=:visible, sortOrder=:sortOrder, '.
                                 'bRight=:bRight '.
                             'WHERE id=:id');
                $this->bind(':title', $post['title']);
                $this->bind(':destination', $post['destination']);
                $this->bind(':bPage', $post['bPage']);
                $this->bind(':visible', $post['visible'], PDO::PARAM_INT);
                $this->bind(':sortOrder', $post['sortorder'], PDO::PARAM_INT);
                $this->bind(':bRight', $post['bRight'], PDO::PARAM_INT);
                $this->bind(':id', $post['id'], PDO::PARAM_INT);
                $res = $this->execute();

                if($res)
                {
                    $this->commit();
                    $this->close();
                    $this->returnToPage($this->header);
                }
                else
                {
                    $this->rollBack();
                    $this->close();
                    Messages::setMsg('Error(s) during update', 'error');
                    return;
                }
            }
        }
        $get = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
        $this->query('SELECT id, title, destination, bPage, visible, sortOrder, bRight '. 
                     'FROM navbar '.
                     'WHERE id = :id');
        $this->bind(':id', $get['id'], PDO::PARAM_INT);
        $rows = $this->single();
        $this->close();
        if (!$rows)
        {
            Messages::setMsg('Record "'.$get['id'].'" not found', 'error');
            $this->returnToPage($this->header);
        }
        return $rows;
    }

    public function Delete()
    {
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($post['todelete']))
        {
            //Mise à jour de la base
            $this->startTransaction();
            $this->query('DELETE FROM navbar WHERE id = :id');
            $this->bind(':id', $post['id'], PDO::PARAM_INT);
            $res = $this->execute();

            if($res)
                $this->commit();
            else
                $this->rollBack();

            $this->close();
            $this->returnToPage($this->header);
        }
        $get = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
        $this->query('SELECT id, title '.
                     'FROM navbar '.
                     'WHERE id = :id');
        $this->bind(':id', $get['id'], PDO::PARAM_INT);
        $rows = $this->single();
        $this->close();
        if (!$rows)
        {
            Messages::setMsg('Record "'.$get['id'].'" not found', 'error');
            $this->returnToPage($this->header);
        }
        return $rows;
    }
}
?>