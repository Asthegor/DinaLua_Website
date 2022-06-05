<?php

class Examples extends Controller
{
    protected function index()
    {
        $viewModel = new ExamplesModel();
        $this->returnView($viewModel->index());
    }
}

?>