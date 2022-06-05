<?php

abstract class Controller
{
    protected $request;
    protected $action;

    public function __construct($action, $request)
    {
        $this->action = $action;
        $this->request = $request;
    }

    public function executeAction()
    {
        return $this->{$this->action}();
    }

    protected function returnView($viewModel)
    {
        if (is_array($viewModel))
            extract($viewModel);
        $view = 'views/'.strtolower(get_class($this)).'/'.$this->action.'.php';
        require('views/main.php');
    }

    protected function checkLogin()
    {
        if (!isset($_SESSION['is_logged_in']))
        {
            $usr = new Users('','');
            $usr->logout(false);
            header('Location: '.ROOT_MNGT);
        }
    }

    protected function checkId()
    {
        $get = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
        if ($get['id'] == '')
        {
            header('Location: '.ROOT_MNGT.strtolower(get_class($this)));
        }
    }
}
?>