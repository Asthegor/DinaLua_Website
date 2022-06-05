<?php

class Tutorials extends Controller
{
    protected function index()
    {
        $viewModel = new TutorialsModel();
        $this->returnView($viewModel->index());
    }

    protected function Display()
    {
        $viewModel = new TutorialsModel();
        $this->returnView($viewModel->Display());
    }
}

?>