<?php

class Images extends Controller
{
    protected function index()
    {
        $this->checkLogin();
        $viewmodel = new ImagesModel();
        $this->returnView($viewmodel->Index());
    }

    protected function add()
    {
        $this->checkLogin();
        $viewmodel = new ImagesModel();
        $this->returnView($viewmodel->Add());
    }

}

?>