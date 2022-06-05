<?php 
session_start();
require( __DIR__ . '/autoload.php');
require( __DIR__ . '/config.php');

//has a file name been passed?
if(!empty($_GET['file'])){
    //where the files are
    $downloads_folder = './files/engine/';

    //protect from people getting other files
    $file = $_GET['file'];
    if ($file === 'DinaGELastVersion')
    {
        $dlm = new DownLoadsModel();
        $file = $dlm->GetLastVersion();
    }
    $filename=basename($file);


    //does the file exist?
    if(file_exists($downloads_folder.$filename))
    {
        //update counter - add if dont exist
        if(file_exists($downloads_folder.$filename.'_counter.txt'))
        {
            $fp = fopen($downloads_folder.$filename.'_counter.txt', "r");
            $count = fread($fp, 1024);
            fclose($fp);
            $fp = fopen($downloads_folder.$filename.'_counter.txt', "w");
            fwrite($fp, $count + 1);
            fclose($fp);
        }
        else
        {
            $fp = fopen($downloads_folder.$filename.'_counter.txt', "w+");
            fwrite($fp, 1);
            fclose($fp);
        }
        // add ip address
        $fp = fopen($downloads_folder.$filename.'_ips.txt', "ab");
        fwrite($fp, $_SERVER['REMOTE_ADDR'] . "\n");
        fclose($fp);

        header('Content-Description: File Transfer');
        header('Content-type: application/zip');
        header("Content-Type: application/force-download");// some browsers need this
        header("Content-Disposition: attachment; filename=\"$file\"");
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($downloads_folder.$file));

       //set force download headers
        $fh = fopen($downloads_folder.$file, "rb");
        while (!feof($fh))
        {
            echo fgets($fh);
            flush();
        }
        fclose($fh);
        exit;
    }
    else
    {
        Messages::setMsg("Fichier ".$filename." non trouvé !", 'error');
        exit(header("Location: ./downloads"));
    }

}
elseif(!empty($_GET['example']))
{
    //where the files are
    $downloads_folder = './files/examples/';

    //protect from people getting other files
    $file = $_GET['example'];
    $filename=basename($file);

    //does the file exist?
    if(file_exists($downloads_folder.$filename))
    {
        //update counter - add if dont exist
        if(file_exists($downloads_folder.$filename.'_counter.txt'))
        {
            $fp = fopen($downloads_folder.$filename.'_counter.txt', "r");
            $count = fread($fp, 1024);
            fclose($fp);
            $fp = fopen($downloads_folder.$filename.'_counter.txt', "w");
            fwrite($fp, $count + 1);
            fclose($fp);
        }
        else
        {
            $fp = fopen($downloads_folder.$filename.'_counter.txt', "w+");
            fwrite($fp, 1);
            fclose($fp);
        }
        // add ip address
        $fp = fopen($downloads_folder.$filename.'_ips.txt', "ab");
        fwrite($fp, $_SERVER['REMOTE_ADDR'] . "\n");
        fclose($fp);

        header('Content-Description: File Transfer');
        header('Content-type: application/zip');
        header("Content-Type: application/force-download");// some browsers need this
        header("Content-Disposition: attachment; filename=\"$file\"");
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($downloads_folder.$file));

       //set force download headers
        $fh = fopen($downloads_folder.$file, "rb");
        while (!feof($fh))
        {
            echo fgets($fh);
            flush();
        }
        fclose($fh);
        exit;
    }
    else
    {
        Messages::setMsg("Fichier non trouvé !", 'error');
        exit(header("Location: ./examples"));
    }
}
elseif(!empty($_GET['tools']))
{
    //where the files are
    $downloads_folder = './files/tools/';

    //protect from people getting other files
    $file = $_GET['tools'];
    $filename=basename($file);

    //does the file exist?
    if(file_exists($downloads_folder.$filename))
    {
        //update counter - add if dont exist
        if(file_exists($downloads_folder.$filename.'_counter.txt'))
        {
            $fp = fopen($downloads_folder.$filename.'_counter.txt', "r");
            $count = fread($fp, 1024);
            fclose($fp);
            $fp = fopen($downloads_folder.$filename.'_counter.txt', "w");
            fwrite($fp, $count + 1);
            fclose($fp);
        }
        else
        {
            $fp = fopen($downloads_folder.$filename.'_counter.txt', "w+");
            fwrite($fp, 1);
            fclose($fp);
        }
        // add ip address
        $fp = fopen($downloads_folder.$filename.'_ips.txt', "ab");
        fwrite($fp, $_SERVER['REMOTE_ADDR'] . "\n");
        fclose($fp);

        header('Content-Description: File Transfer');
        header('Content-type: application/zip');
        header("Content-Type: application/force-download");// some browsers need this
        header("Content-Disposition: attachment; filename=\"$file\"");
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($downloads_folder.$file));

       //set force download headers
        $fh = fopen($downloads_folder.$file, "rb");
        while (!feof($fh))
        {
            echo fgets($fh);
            flush();
        }
        fclose($fh);
        exit;
    }
    else
    {
        Messages::setMsg("Fichier non trouvé !", 'error');
        exit(header("Location: ./tools"));
    }
}
else
{
    exit(header("Location: ./index.php"));
}
?>