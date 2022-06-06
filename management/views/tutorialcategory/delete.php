<?php Messages::display(); ?>
<?php
$returnPage = 'tutorials';
if (!($viewModel && isset($viewModel['name'])))
{
    header('Location: '.ROOT_MNGT.$returnPage);
    return;
}
$title = 'Tutoriels';
$recordTitle = urldecode($viewModel['name']);

require('views/deleteform.php');
?>