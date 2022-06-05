<?php

class Home extends Controller
{
    protected function index()
    {
        $this->checkLogin();
        $viewmodel = new HomeModel();
        $this->returnView($viewmodel->Index());
    }
}

?>