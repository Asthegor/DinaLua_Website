<?php

class ExamplesModel extends Model
{
    private $returnPage = "examples";
    private $targetDir = "files/examples/";

    public function Index()
    {
        $this->query("SELECT e.id, e.title, e.description, e.visible, e.file, ".
                     "CASE WHEN ec.name IS NULL THEN '' ELSE ec.name END Category ".
                     "FROM example AS e ".
                     "LEFT JOIN examplecategory AS ec ON e.id_Category = ec.id ".
                     "ORDER BY e.visible DESC, ec.name");
        $rows = $this->resultSet();
        $this->close();
        return $rows;
    }

    public function Add()
    {
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_ENCODED);
        if (isset($post['submit']))
        {
            if ($post['title'] == '')
            {
                Messages::setMsg('Please fill in all mandatory fields', 'error');
            }
            else
            {
                if (isset($_FILES["file"]))
                {
                    $file = basename($_FILES["file"]["name"]);
                    $target_file = ROOT_DIR. $this->targetDir . $file;
                    $fileExtension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    if($fileExtension != "" && $fileExtension !== "zip")
                    {
                        Messages::setMsg("Error : file '".$file."' must have the extension 'zip'.", 'error');
                        return;
                    }
                }
                else
                    $file = "";

                // Insert into MySQL
                $this->startTransaction();
                $this->query("INSERT INTO example (id_Category, title, description, visible, file) ".
                             "VALUES (:id_Category, :title, :description, :visible, :file)");
                $this->bind(':id_Category', $post['id_Category']);
                $this->bind(':title', $post['title']);
                $this->bind(':description', $post['content']);
                $this->bind(':visible', isset($post['visible']) ? $post['visible'] : 0, PDO::PARAM_INT);
                $this->bind(':file', $file);
                $resp = $this->execute();
                //Uplod file
                if ($file != "")
                    $upload = move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
                else
                    $upload = true;
                    
                if ($upload && $resp)
                {
                    Messages::setMsg("Fichier '".$file."' envoyé.", 'success');
                    $this->commit();
                    $this->close();
                    $this->returnToPage($this->returnPage);
                    return;
                }
                else
                {
                    $this->rollback();
                    $this->close();
                    Messages::setMsg('Error(s) during update : [resp='.$resp.', upload='.$upload.']', 'error');
                }
            }
        }
        return;
    }

    public function Update()
    {
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_ENCODED);
        if (isset($post['submit']))
        {
            if ($post['title'] == '')
            {
                Messages::setMsg('Please fill in all mandatory fields', 'error');
            }
            else
            {
                if (isset($_FILES["file"]))
                {
                    $file = basename($_FILES["file"]["name"]);
                    $target_file = ROOT_DIR . $this->targetDir . $file;
                    $fileExtension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    if($file !='' && $fileExtension !== "zip")
                    {
                        Messages::setMsg("Error : file '".$file."' must have the extension 'zip'.", 'error');
                        return;
                    }
                }
                else
                    $file = $post['filename'];
                    
                // Insert into MySQL
                $this->startTransaction();
                //Insertion des données générales
                $query = "UPDATE example ".
                             "SET title = :title, description = :description, ".
                             "id_Category = :id_Category, visible = :visible ";
                if ($file != "")
                    $query .= ", file = :file ";
                $query .= "WHERE id = :id";
                $this->query($query);
                $this->bind(':title', $post['title']);
                $this->bind(':description', $post['content']);
                if ($file != "")
                    $this->bind(':file', $file);
                $this->bind(':id_Category', $post['id_Category']);
                $this->bind(':visible', isset($post['visible']) ? $post['visible'] : 0);
                $this->bind(':id', $post['id']);
                $resp = $this->execute();
                //Verify
                
                if ($file !='')
                    $upload = move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
                else
                    $upload = true;
                
                if ($upload && $resp)
                {
                    // deplacement du fichier
                    Messages::setMsg("Fichier '".$file."' envoyé.", 'success');
                    $this->commit();
                    $this->close();
                    $this->returnToPage($this->returnPage);
                    return;
                }
                else
                {
                    $this->rollback();
                    $this->close();
                    Messages::setMsg('Error(s) during update : [resp='.$resp.', upload='.$upload.']', 'error');
                }
            }
        }
        $get = filter_input_array(INPUT_GET, FILTER_SANITIZE_ENCODED);
        $this->query("SELECT id, id_Category, title, description, file, visible ".
                     "FROM example ".
                     "WHERE id = :id");
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
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_ENCODED);
        if (isset($post['todelete']))
        {
            $this->query('DELETE FROM example WHERE id = :id');
            $this->bind(':id', $post['id']);
            $res = $this->execute();
            if (!$res)
            {
                Messages::setMsg('Record used by another record.', 'error');
            }
            $this->close();
            $this->returnToPage($this->returnPage);
        }
        $get = filter_input_array(INPUT_GET, FILTER_SANITIZE_ENCODED);
        $this->query("SELECT id, title, file ".
                     "FROM example WHERE id = :id ".
                     "ORDER BY visible, id");
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
        $query = "SELECT id, title ".
                 "FROM example ".
                 "WHERE visible = 1 ";
        if($currentId <> '')
            $query .= " AND id <> :id ";
        if(isset($currentCateg) && $currentCateg <> '')
            $query .= " AND id_Category = :id_Category ";

        $this->query($query);

        if($currentId <> '')
            $this->bind(':id', $currentId);
        if(isset($currentCateg) && $currentCateg <> '')
            $this->bind(':id_Category', $currentCateg);

        $rows = $this->resultSet();
        $this->close();
        return $rows;
    }

    public function NbDownloads($FileName)
    {
        $File = basename($FileName);
        if(!file_exists(ROOT_DIR. $this->targetDir.$File.'_counter.txt'))
        {
            $fp = fopen(ROOT_DIR. $this->targetDir.$File.'_counter.txt', "w+");
            fclose($fp);
        }
        $countFile = fopen(ROOT_DIR. $this->targetDir . $File."_counter.txt", "r");
        $nbdownloads = fgets($countFile);
        fclose($countFile);
        return $nbdownloads;
    }
    
}
?>