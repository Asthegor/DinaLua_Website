<?php

class NewsModel extends Model
{
    public function Index()
    {
        $this->query("SELECT id, date_news, title, content, ".
                     "new_version, new_example, new_tutorial, visible ".
                     "FROM news ".
                     "ORDER BY id DESC");
        $rows = $this->resultSet();
        $this->close();
        return $rows;
    }

    public function Add()
    {
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_ENCODED);
        if ($post['submit'])
        {
            if ($post['title'] == '' || $post['content'] == '' || $post['date_news'] == '')
            {
                Messages::setMsg('Please fill in all mandatory fields', 'error');
            }
            else
            {
                // Insert into MySQL
                date_default_timezone_set('Europe/Paris');
                $this->startTransaction();
                // Insertion du nom français
                $this->query("INSERT INTO news (date_news, title, content, new_version, new_example, visible)
                            VALUES (:date_news, :title, :content, :new_version, :new_example, :visible)");
                $this->bind(':date_news', $post['date_news']);
                $this->bind(':title', $post['title']);
                $this->bind(':content', $post['content']);
                $this->bind(':new_version', isset($post['new_version']) ? $post['new_version'] : 0, PDO::PARAM_INT);
                $this->bind(':new_example', isset($post['new_example']) ? $post['new_example'] : 0, PDO::PARAM_INT);
                $this->bind(':visible', isset($post['visible']) ? $post['visible'] : 0, PDO::PARAM_INT);
                $resp = $this->execute();
                //Verify
                if($resp)
                {
                    $this->commit();
                    $this->close();
                    $this->returnToPage($this->returnPage);
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
            if ($post['title'] == '' || $post['content'] == '' || $post['date_news'] == '')
            {
                Messages::setMsg('Please fill in all mandatory fields', 'error');
            }
            else
            {
                // Insert into MySQL
                date_default_timezone_set('Europe/Paris');
                $this->startTransaction();
                //Insertion des données générales
                $this->query("UPDATE news
                              SET date_news = :date_news, title = :title, content = :content, 
                                  new_version = :new_version, new_example = :new_example, visible = :visible 
                            WHERE id = :id");
                $this->bind(':date_news', $post['date_news']);
                $this->bind(':title', $post['title']);
                $this->bind(':content', $post['content']);
                $this->bind(':new_version', isset($post['new_version']) ? $post['new_version'] : 0);
                $this->bind(':new_example', isset($post['new_example']) ? $post['new_example'] : 0);
                $this->bind(':visible', isset($post['visible']) ? $post['visible'] : 0);
                $this->bind(':id', $post['id']);
                $resp = $this->execute();
                //Verify
                if($resp)
                {
                    $this->commit();
                    $this->close();
                    $this->returnToPage($this->returnPage);
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
        $this->query("SELECT id, title, content, date_news, new_version, new_example, visible
                      FROM news WHERE id = :id
                      ORDER BY id DESC");
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
            $this->query('DELETE FROM news WHERE id = :id');
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
        $this->query("SELECT id, title, date_news
                      FROM news WHERE id = :id
                      ORDER BY id DESC");
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
}
?>