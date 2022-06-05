<?php

class Home extends Controller
{
    protected function index()
    {
        $viewModel = new HomeModel();
        $viewModelNews = $viewModel->index();
        $viewModelAnnounce = $viewModel->GetAnnounce();
        $this->returnView(array("viewModelAnnounce" => $viewModelAnnounce, "viewModelNews" => $viewModelNews));
    }
}

?>