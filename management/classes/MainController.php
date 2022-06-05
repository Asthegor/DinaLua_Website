<?php

class MainController
{
    private $controller;
    private $action;
    private $request;

    public function __construct($request)
    {
        $this->request = $request;
        if ($this->request['controller'] == "")
        {
            $this->controller = 'admins';
        }
        else
        {
            $this->controller = $this->request['controller'];
        }
        if ($this->request['action'] == "")
        {
            // Valeur par défaut
            $this->action = 'index';
            if ($this->request['controller'] == "")
            {
                $this->action = 'login';
            }
        }
        else
        {
            $this->action = $this->request['action'];
        }
    }
    public function createController()
    {
        // Check Class
        if(class_exists($this->controller))
        {
            $parents = class_parents($this->controller);
            //Check Extend
            if(in_array("Controller", $parents))
            {
                if(method_exists($this->controller, $this->action))
                {
                    return new $this->controller($this->action, $this->request);
                }
                else
                {
                    // Method does not exist
                    echo "<h1>Method '".$this->action."' does not exist</h1>";
                    return;
                }
            }
            else
            {
                // Base controller does not exist
                echo "<h1>Base controller not found</h1>";
                return;
            }
        }
        else
        {
            if (!isset($_SESSION['is_logged_in']))
            {
                header('Location: '.ROOT_MNGT);
                return;
            }
            // Method does not exist
            echo "<h1>Controller Class '".$this->controller."' does not exist</h1>";
            return;
        }
    }
}
?>