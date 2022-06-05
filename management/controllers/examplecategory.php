<?php

class ExampleCategory extends Controller
{
    protected function index()
    {
        $this->checkLogin();
        $viewModel = new ExampleCategoryModel();
        $this->returnView(array("viewModelCategs"=>$viewModel->Index()));
    }

    protected function add()
    {
        $this->checkLogin();
        $viewmodel = new ExampleCategoryModel();
        $this->returnView($viewmodel->Add());
    }

    protected function update()
    {
        $this->checkLogin();
        $this->checkId();
        $viewmodel = new ExampleCategoryModel();
        $this->returnView($viewmodel->Update());
    }

    protected function delete()
    {
        $this->checkLogin();
        $this->checkId();
        $viewmodel = new ExampleCategoryModel();
        $this->returnView($viewmodel->Delete());
    }
}

?>