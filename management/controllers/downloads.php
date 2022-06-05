<?php

class Downloads extends Controller
{
    protected function index()
    {
        $this->checkLogin();
        $viewmodel = new DownloadsModel();
        $this->returnView($viewmodel->Index());
    }

    protected function add()
    {
        $this->checkLogin();
        $viewmodel = new DownloadsModel();
        $this->returnView($viewmodel->Add());
    }

}

?>