<?php

function LoadClasses($class)
{
    $fullname = __DIR__.'/classes/' . $class . '.php';
    if (!file_exists($fullname))
    {
        return false;
    }
    require_once $fullname;
    return true;
}
function LoadControllers($class)
{
    $fullname = __DIR__.'/controllers/' . strtolower($class) . '.php';
    if (!file_exists($fullname))
    {
        return false;
    }
    require_once $fullname;
    return true;
}
function LoadModels($class)
{
    $fullname = __DIR__.'/models/' . strtolower(str_replace("Model", "", $class)) . '.php';
    if (!file_exists($fullname))
    {
        return false;
    }
    require_once $fullname;
    return true;
}
spl_autoload_register('LoadClasses');
spl_autoload_register('LoadControllers');
spl_autoload_register('LoadModels');

?>