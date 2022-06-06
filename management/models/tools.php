<?php
class File {
    public $name;
    public $nbdownloads;
}

class ToolsModel extends Model
{
    private $returnPage = "tools";
    private $targetDir = "files/tools/";

    public function Index()
    {
        $this->query("SELECT id, title, description, visible, file, date, sortOrder ".
                     "FROM tools ".
                     "ORDER BY visible DESC, date DESC");
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
                $this->query("INSERT INTO tools (title, description, date, id_Tutorial, file, sortOrder, visible) ".
                             "VALUES (:title, :description, :date, :id_Tutorial, :file, :sortOrder, :visible)");
                $this->bind(':title', $post['title']);
                $this->bind(':description', $post['content']);
                $this->bind(':id_Tutorial', $post['id_Tutorial']);
                $this->bind(':date', date("Y/m/d"));
                $this->bind(':file', $file);
                $this->bind(':sortOrder', $post['sortOrder']);
                $this->bind(':visible', isset($post['visible']) ? $post['visible'] : 0, PDO::PARAM_INT);
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
                $query = "UPDATE tools ".
                             "SET title = :title, description = :description, ".
                             "id_Tutorial = :id_Tutorial, visible = :visible, ".
                             "sortOrder = :sortOrder, date = :date ";
                if ($file != "")
                    $query .= ", file = :file ";
                $query .= "WHERE id = :id";
                $this->query($query);
                $this->bind(':title', $post['title']);
                $this->bind(':description', $post['content']);
                $this->bind(':id_Tutorial', $post['id_Tutorial']);
                $this->bind(':visible', isset($post['visible']) ? $post['visible'] : 0);
                $this->bind(':date', date("Y/m/d"));
                $this->bind(':sortOrder', $post['sortOrder']);
                if ($file != "")
                    $this->bind(':file', $file);
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
        $get = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
        $this->query("SELECT id, id_Tutorial, title, description, ".
                            "sortOrder, file, visible ".
                     "FROM tools ".
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