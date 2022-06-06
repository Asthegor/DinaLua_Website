<?php

class Users extends Controller
{
    protected function login()
    {
        $viewModel = new UsersModel();
        $this->returnView($viewModel->login());
    }

    protected function signup()
    {
        $viewModel = new UsersModel();
        $this->returnView($viewModel->signup());
    }
    
    protected function confirmed()
    {
        $viewModel = new UsersModel();
        if (!$this->IsLoggedIn())
            $this->returnView($viewModel->confirmed());
        else
            header('Location: '.ROOT_URL);
    }

    protected function resend()
    {
        $viewModel = new UsersModel();
        if (!$this->IsLoggedIn())
            $this->returnView($viewModel->resend());
        else
            header('Location: '.ROOT_URL);
    }
    
    public function logout($redirect=true)
    {
        unset($_SESSION['Dina_data']);
        session_destroy();
        // Redirect
        if ($redirect)
        {
            header('Location: '.ROOT_URL);
        }
    }
}

?>