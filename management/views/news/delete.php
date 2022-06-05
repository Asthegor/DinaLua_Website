<?php Messages::display(); ?>
<?php
$title = 'Nouvelles';
$recordTitle = $viewModel['title'].' ('.$viewModel['date_news'].')';
$returnPage = 'news';

require('views/deleteform.php');
?>