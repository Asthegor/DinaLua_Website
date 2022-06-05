<?php

class TutorialCategory extends Controller
{
    protected function index()
    {
        $this->checkLogin();
        $viewModel = new TutorialCategoryModel();
        $this->returnView(array("viewModelCategs"=>$viewModel->Index()));
    }

    protected function add()
    {
        $this->checkLogin();
        $viewmodel = new TutorialCategoryModel();
        $this->returnView($viewmodel->Add());
    }

    protected function update()
    {
        $this->checkLogin();
        $this->checkId();
        $viewmodel = new TutorialCategoryModel();
        $this->returnView($viewmodel->Update());
    }

    protected function delete()
    {
        $this->checkLogin();
        $this->checkId();
        $viewmodel = new TutorialCategoryModel();
        $this->returnView($viewmodel->Delete());
    }
}

?>