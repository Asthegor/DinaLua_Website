<?php
if ($_SERVER["REQUEST_URI"] == __FILE__)
  header('Location: '.ROOT_URL);

class MainController
{
    private $controller;
    private $action;
    private $request;

    public function __construct($request)
    {
        $this->request = $request;
        if (!isset($this->request['controller']) || $this->request['controller'] == "")
            $this->controller = 'home';
        else
            $this->controller = $this->request['controller'];

        if (!isset($this->request['action']) || $this->request['action'] == "")
            $this->action = 'index';
        else
            $this->action = $this->request['action'];
        /*
        $req = "";
        foreach ($this->request as $key => $value)
        {
            $req = $key . "= ". $value. ", " ;
        }
        $uri = $_SERVER['REQUEST_URI'];
        error_log("Request_URI= $uri, Request= $req, Controller= $this->controller, Action= $this->action");
        */
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
            }
        }
        header('Location: '.ROOT_URL);
    }
}
?>