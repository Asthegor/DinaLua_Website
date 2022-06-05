<?php

class DownloadsModel extends Model
{
    public function index()
    {
        $arrFiles = array_reverse(glob("files/engine/*.zip"));
        array_shift($arrFiles);
        return $arrFiles;
    }

    public function GetLastVersion()
    {
        $arrFiles = array_reverse(glob("files/engine/*.zip"));
        $last = array_shift($arrFiles);
        return basename($last);
    }
}
?>