<?php

class Tools extends Controller
{
    protected function index()
    {
        $viewModel = new ToolsModel();
        $this->returnView($viewModel->index());
    }
}

?>