<?php

class Home extends Controller
{
    protected function index()
    {
        $viewModel = new HomeModel();
        $viewModelNews = $viewModel->index();
        $viewModelAnnounce = $viewModel->GetAnnounce();
        $nbNews = $viewModel->NbNews();
        $this->returnView(array("viewModelAnnounce" => $viewModelAnnounce, "viewModelNews" => $viewModelNews, "NbNews" => $nbNews));
    }
}

?>