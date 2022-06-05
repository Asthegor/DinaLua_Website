<?php

class ConfigsModel extends Model
{
    private $header = 'configs';

    public function Index()
    {
        $this->query('SELECT id, data '.
                     'FROM configs '.
                     'ORDER BY id');
        $rows = $this->resultSet();
        $this->close();
        return $rows;
    }

    public function Add()
    {
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_ENCODED);
        if ($post['submit'])
        {
            if ($post['data'] == '' || $post['content'] == '')
            {
                Messages::setMsg('Please fill in all mandatory fields', 'error');
            }
            else
            {
                // Insert into MySQL
                $this->startTransaction();
                //Insertion des données générales
                $this->query('INSERT INTO configs (data, content ' .
                             'VALUES (:data, :content)');
                $this->bind(':data', $post['data']);
                $this->bind(':content', $post['content']);
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
                Messages::setMsg('Error(s) during insert [$id='.$id.']', 'error');
            }
        }
        return;
    }

    public function Update()
    {
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_ENCODED);
        if (isset($post['submit']))
        {
            // Contrôle des données
            if ($post['data'] == '' || $post['content'] == '')
            {
                Messages::setMsg('Please fill in all mandatory fields', 'error');
            }
            else
            {
                //Mise à jour de la base
                $this->startTransaction();
                //Insertion de l'image
                // Mise à jour de la table 
                $this->query('UPDATE configs '.
                             'SET data=:data, content=:content '.
                             'WHERE id=:id');
                $this->bind(':data', $post['data']);
                $this->bind(':content', $post['content']);
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
        $get = filter_input_array(INPUT_GET, FILTER_SANITIZE_ENCODED);
        $this->query('SELECT id, data, content '.
                     'FROM configs '.
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
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_ENCODED);
        if (isset($post['todelete']))
        {
            //Mise à jour de la base
            $this->startTransaction();
            $this->query('DELETE FROM configs WHERE id = :id');
            $this->bind(':id', $post['id'], PDO::PARAM_INT);
            $res = $this->execute();

            if($res)
                $this->commit();
            else
                $this->rollBack();

            $this->close();
            $this->returnToPage($this->header);
        }
        $get = filter_input_array(INPUT_GET, FILTER_SANITIZE_ENCODED);
        $this->query('SELECT id, data '.
                     'FROM configs '.
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