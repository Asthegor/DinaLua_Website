<?php

class Tools extends Controller
{
    protected function index()
    {
        $this->checkLogin();
        $viewmodel = new ToolsModel();
        $this->returnView($viewmodel->Index());
    }

    protected function add()
    {
        $this->checkLogin();
        $viewmodel = new ToolsModel();
        $this->returnView($viewmodel->Add());
    }

}

?>