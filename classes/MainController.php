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
            $this->action = 'Index';
        else
            $this->action = $this->request['action'];
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