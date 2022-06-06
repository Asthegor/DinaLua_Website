<?php
$idValid = true;
if (!isset($_GET['id']))
    $idValid = false;
elseif (!is_numeric($_GET['id']))
    $idValid = false;
else
{
    $tm = new TutorialModel();
    $idValid = $tm->IsIdValid($_GET['id']);
}
if (!$idValid)
{
    header('Location: '.ROOT_URL.'tutorials');
    return;
}
?>
<div class="tutorial">
    <?php
    //var_dump($viewModel);
    ?>
    <h1><?= urldecode($viewModel['title']); ?></h1>
    <?php
    include(__DIR__.'/tutonavbar.php');
    ?>
    <hr>
    <p><?= urldecode($viewModel['content']); ?></p>
    <hr>
    <br>
    <?php
    include(__DIR__.'/tutonavbar.php');
    ?>
</div>
