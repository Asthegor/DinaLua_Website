<?php Messages::display(); ?>
<?php
$returnPage = 'news';
if (!($viewModel && isset($viewModel['title']) && isset($viewModel['date_news'])))
{
    header('Location: '.ROOT_MNGT.$returnPage);
    return;
}
$title = 'Nouvelles';
$recordTitle = urldecode($viewModel['title']).' ('.$viewModel['date_news'].')';

require('views/deleteform.php');
?>