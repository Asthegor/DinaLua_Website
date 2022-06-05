<?php
function LoadManagementClasses($class)
{
    $fullname = __DIR__ .'/classes/' . $class . '.php';
    if (!file_exists($fullname))
    {
        return false;
    }
    require_once $fullname;
    return true;
}
function LoadManagementControllers($class)
{
    $fullname = __DIR__ .'/controllers/' . strtolower($class) . '.php';
    if (!file_exists($fullname))
    {
        return false;
    }
    require_once $fullname;
    return true;
}
function LoadManagementModels($class)
{
    $fullname = __DIR__ .'/models/' . strtolower(str_replace("Model", "", $class)) . '.php';
    if (!file_exists($fullname))
    {
        return false;
    }
    require_once $fullname;
    return true;
}
spl_autoload_register('LoadManagementClasses');
spl_autoload_register('LoadManagementControllers');
spl_autoload_register('LoadManagementModels');

?>