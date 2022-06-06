<?php
class File {
    public $name;
    public $directory;
}

class ImagesModel extends Model
{
    private $returnPage = "images";
    private $imagesDir = "assets/images/";

    private function GetImageFromDirectory($directory, $isSubDir)
    {
        $arrFiles = array();
        
        $arrPngFiles = glob($directory . "/*.{jpg,png,bmp,gif}", GLOB_BRACE);
        foreach ($arrPngFiles as $PngFile)
        {
            $PngFileName = basename($PngFile);
            if ($isSubDir)
                $PngFileName = basename($directory).'/'.$PngFileName;

            $file = new File();
            $file->name = $PngFileName;
            $file->directory = basename($directory);
            if ($isSubDir)
                $file->directory = basename(dirname($directory,1));
            array_push($arrFiles, $file);
        }
        return $arrFiles;
    }
    
    public function Index()
    {
        $arrFiles = array();
        $imgdir = $this->GetImageDirectories();
        foreach ($imgdir as $dir)
        {
            $imgsubdir = glob($dir."/*", GLOB_ONLYDIR);
            foreach ($imgsubdir as $subdir)
            {
                $arrSubDir = $this->GetImageFromDirectory($subdir.'/', true);
                $arrFiles = array_merge($arrFiles, $arrSubDir);
            }
            $arrDir = $this->GetImageFromDirectory($dir.'/', false);
            $arrFiles = array_merge($arrFiles, $arrDir);
        }
        
        return $arrFiles;
    }

    public function Add()
    {
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_ENCODED);
        if (isset($post['submit']))
        {
            try
            {
                // Undefined | Multiple Files | $_FILES Corruption Attack
                // If this request falls under any of them, treat it invalid.
                if (!isset($_FILES['upfile']['error']) ||
                    is_array($_FILES['upfile']['error']))
                {
                    throw new RuntimeException('Invalid parameters.');
                }
                
                // Check $_FILES['upfile']['error'] value.
                switch ($_FILES['upfile']['error'])
                {
                    case UPLOAD_ERR_OK:
                        break;
                    case UPLOAD_ERR_NO_FILE:
                        throw new RuntimeException('No file sent.');
                    case UPLOAD_ERR_INI_SIZE:
                    case UPLOAD_ERR_FORM_SIZE:
                        throw new RuntimeException('Exceeded filesize limit.');
                    default:
                        throw new RuntimeException('Unknown errors.');
                }
                
                // You should also check filesize here.
                /*if ($_FILES['upfile']['size'] > 1000000) {
                    throw new RuntimeException('Exceeded filesize limit.');
                }*/
                
                // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
                // Check MIME Type by yourself.
                $finfo = new finfo(FILEINFO_MIME_TYPE);
                if (false === $ext = array_search($finfo->file($_FILES['upfile']['tmp_name']),
                                                  array('jpg' => 'image/jpeg',
                                                        'png' => 'image/png',
                                                        'gif' => 'image/gif',),
                                                  true))
                {
                    throw new RuntimeException('Invalid file format.');
                }
                
                // You should name it uniquely.
                // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
                // On this example, obtain safe unique name from its binary data.
                $file = basename($_FILES['upfile']['name']);
                $path = ROOT_DIR.$this->imagesDir;
                $path .= isset($post['directory']) && !empty($post['directory']) ? $post['directory'].'/' : '';
                $path .= isset($post['subdirectory']) && !empty($post['subdirectory']) ? $post['subdirectory'].'/' : '';
                $path .= $file;
                var_dump($path);
                if (!move_uploaded_file($_FILES['upfile']['tmp_name'], $path))
                {
                    throw new RuntimeException('Failed to move uploaded file.');
                }
                
                Messages::setMsg("Chargement du fichier '".$file."' réussi.", 'success');
                $this->returnToPage($this->returnPage);
            }
            catch (RuntimeException $e)
            {
                    Messages::setMsg($e->getMessage(), 'error');
            }
        }
        return;
    }
    
    public function GetImageDirectories()
    {
        return glob(ROOT_DIR. $this->imagesDir . "*", GLOB_ONLYDIR);
    }
    public function GetTutorialSubDirectories()
    {
        return glob(ROOT_DIR. $this->imagesDir . "tutorials/*", GLOB_ONLYDIR);
    }
}
?>