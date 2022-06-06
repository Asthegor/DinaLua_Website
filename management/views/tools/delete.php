<?php Messages::display(); ?>
<?php
$returnPage = 'examples';
if (!($viewModel && isset($viewModel['title'])))
{
    header('Location: '.ROOT_MNGT.$returnPage);
    return;
}
$title = 'Exemples';
$recordTitle = urldecode($viewModel['title']);

require('views/deleteform.php');
?>