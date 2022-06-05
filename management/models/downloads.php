<?php
class File {
    public $name;
    public $nbdownloads;
}

class DownloadsModel extends Model
{
    private $returnPage = "downloads";
    private $targetDir = "files/engine/";
    public function Index()
    {
        $arrFiles = array();
        $arrZipFiles = array_reverse(glob(ROOT_DIR. $this->targetDir . "*.zip"));
        foreach ($arrZipFiles as $Zipfile)
        {
            $ZipFileName = basename($Zipfile);
            $countFile = fopen(ROOT_DIR. $this->targetDir . $ZipFileName."_counter.txt", "r");
            $nbdownloads = fgets($countFile);
            fclose($countFile);

            $file = new File();
            $file->name = $ZipFileName;
            $file->nbdownloads = $nbdownloads;
            array_push($arrFiles, $file);
        }
        return $arrFiles;
    }

    public function Add()
    {
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_ENCODED);
        if ($post['submit'])
        {
            $file = basename($_FILES["file"]["name"]);
            $target_file = ROOT_DIR . $this->targetDir . $file;
            $fileExtension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            if($fileExtension !== "zip")
            {
                Messages::setMsg("Error : file '".$file."' must have the extension 'zip'.", 'error');
                return;
            }

            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file))
            {
                Messages::setMsg("Chargement du fichier '".$file."' réussi.", 'success');
                $this->returnToPage($this->returnPage);
                return;
            }
            Messages::setMsg("Problème lors du chargement du fichier '".$file."'.", 'error');
        }
        return;
    }

}
?>