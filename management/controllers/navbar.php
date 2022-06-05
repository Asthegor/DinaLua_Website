<?php

class NavBar extends Controller
{
    protected function index()
    {
        $this->checkLogin();
        $viewmodel = new NavBarModel();
        $this->returnView($viewmodel->Index());
    }

    protected function add()
    {
        $this->checkLogin();
        $viewmodel = new NavBarModel();
        $this->returnView($viewmodel->Add());
    }

    protected function update()
    {
        $this->checkLogin();
        $this->checkId();
        $viewmodel = new NavBarModel();
        $this->returnView($viewmodel->Update());
    }

    protected function delete()
    {
        $this->checkLogin();
        $this->checkId();
        $viewmodel = new NavBarModel();
        $this->returnView($viewmodel->Delete());
    }
}

?>