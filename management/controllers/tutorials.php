<?php

class Tutorials extends Controller
{
    protected function index()
    {
        $this->checkLogin();
        $viewmodel = new TutorialsModel();
        $tutorials = $viewmodel->Index();
        $viewcategmodel = new TutorialCategoryModel();
        $categs = $viewcategmodel->Index();
        $this->returnView(array("viewModelTutos"=>$tutorials,"viewModelCategs"=>$categs));
    }

    protected function add()
    {
        $this->checkLogin();
        $viewmodel = new TutorialsModel();
        $this->returnView($viewmodel->Add());
    }

    protected function update()
    {
        $this->checkLogin();
        $this->checkId();
        $viewmodel = new TutorialsModel();
        $this->returnView($viewmodel->Update());
    }

    protected function delete()
    {
        $this->checkLogin();
        $this->checkId();
        $viewmodel = new TutorialsModel();
        $this->returnView($viewmodel->Delete());
    }
}

?>