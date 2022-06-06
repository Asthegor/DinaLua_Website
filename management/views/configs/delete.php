<?php
$returnPage = 'configs';
if (!($viewModel && isset($viewModel['title']) ))
{
    header('Location: '.ROOT_MNGT.$returnPage);
    return;
}
$title = 'Barre de navigation';
$recordTitle = urldecode($viewModel['title']);

require('views/deleteform.php');
?>