<?php

class Messages
{
    public static function setMsg($text, $type)
    {
        if ($type == 'error')
        {
            $_SESSION['errorMsg'] = $text;
        }
        else
        {
            $_SESSION['successMsg'] = $text;
        }
    }

    public static function display()
    {
        if (isset($_SESSION['errorMsg']) && !empty($_SESSION['errorMsg']))
        {
            echo '<div class="alert alert-danger">'.$_SESSION['errorMsg'].'</div>';
            unset($_SESSION['errorMsg']);
        }
        if (isset($_SESSION['successMsg']) && !empty($_SESSION['successMsg']))
        {
            echo '<div class="alert alert-success">'.$_SESSION['successMsg'].'</div>';
            unset($_SESSION['successMsg']);
        }

        if (isset($_SESSION['errorMsg']))
            $_SESSION['errorMsg'] = "";
        if (isset($_SESSION['successMsg']))
            $_SESSION['successMsg'] = "";

    }
    
    public static function hasMsg()
    {
        return isset($_SESSION['errorMsg']);
    }
}
?>