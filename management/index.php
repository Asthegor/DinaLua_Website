<?php
session_start();

header('Content-Type: text/html; charset=utf-8');

require( __DIR__ . '/config.php');
require( __DIR__ . '/autoload.php');

$management = new MainController($_GET);
$controller = $management->createController();
if($controller)
{
    $controller->executeAction();
}
?>