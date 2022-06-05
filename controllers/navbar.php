<?php

class NavBar extends Controller
{
    protected function index()
    {
        $viewModel = new NavBarModel();
        $this->returnView($viewModel->index());
    }
}

?>