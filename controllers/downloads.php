<?php

class Downloads extends Controller
{
    protected function index()
    {
        $viewModel = new DownloadsModel();
        $viewModelFiles = $viewModel->index();
        $viewModelLastVersion = $viewModel->GetLastVersion();
        $this->returnView(array("viewModelFiles" => $viewModelFiles, "viewModelLastVersion" => $viewModelLastVersion));
    }
}

?>