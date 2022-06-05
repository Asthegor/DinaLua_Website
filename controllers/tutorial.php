<?php

class Tutorial extends Controller
{
    protected function index()
    {
        $viewModel = new TutorialModel();
        $this->returnView($viewModel->index());
    }

}

?>