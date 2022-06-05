<?php

class Examples extends Controller
{
    protected function index()
    {
        $this->checkLogin();
        $viewmodel = new ExamplesModel();
        $examples = $viewmodel->Index();
        $viewcategmodel = new ExampleCategoryModel();
        $categs = $viewcategmodel->Index();
        $this->returnView(array("viewModelExamples"=>$examples,"viewModelCategs"=>$categs));
    }

    protected function add()
    {
        $this->checkLogin();
        $viewmodel = new ExamplesModel();
        $this->returnView($viewmodel->Add());
    }

    protected function update()
    {
        $this->checkLogin();
        $this->checkId();
        $viewmodel = new ExamplesModel();
        $this->returnView($viewmodel->Update());
    }

    protected function delete()
    {
        $this->checkLogin();
        $this->checkId();
        $viewmodel = new ExamplesModel();
        $this->returnView($viewmodel->Delete());
    }
}

?>