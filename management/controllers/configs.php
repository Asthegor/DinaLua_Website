<?php

class Configs extends Controller
{
    protected function index()
    {
        $this->checkLogin();
        $viewModelConfigs = new ConfigsModel();
        $this->returnView(array("viewModelConfigs"=>$viewModelConfigs));
    }

    protected function add()
    {
        $this->checkLogin();
        $viewModelConfigs = new ConfigsModel();
        $this->returnView($viewModelConfigs->Add());
    }

    protected function update()
    {
        $this->checkLogin();
        $this->checkId();
        $viewModelConfigs = new ConfigsModel();
        $this->returnView($viewModelConfigs->Update());
    }

    protected function delete()
    {
        $this->checkLogin();
        $this->checkId();
        $viewModelConfigs = new ConfigsModel();
        $this->returnView($viewModelConfigs->Delete());
    }
}

?>