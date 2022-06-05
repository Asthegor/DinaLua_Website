<?php

class ToolsModel extends Model
{
    public function index()
    {
        return array_reverse(glob("files/tools/*.zip"));
    }

}
?>