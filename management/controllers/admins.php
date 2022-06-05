<?php

class Admins extends Controller
{
    public function login()
    {
        if (isset($_SESSION['is_logged_in']))
        {
            header('Location: '.ROOT_MNGT.'home');
        }
        $viewmodel = new AdminsModel();
        $this->returnView($viewmodel->Login(), false);
    }

    public function logout($redirect=true)
    {
        unset($_SESSION['is_logged_in']);
        unset($_SESSION['user_data']);
        session_destroy();
        // Redirect
        if ($redirect)
        {
            header('Location: '.ROOT_URL);
        }
    }
}

?>