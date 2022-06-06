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

    public function IsLoggedIn()
    {
        if (isset($_SESSION['Dina_data']) && isset($_SESSION['Dina_data']['uniqueid']))
        {
            if ($_SESSION['Dina_data']['confirmed'] == "1")
                return true;
        }
        return false;
    }
    
}
?>