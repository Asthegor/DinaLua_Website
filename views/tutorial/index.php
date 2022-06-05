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
    header('Location: '.ROOT_URL.'tutorials');
?>
<div class="tutorial">
    <h1><?= urldecode($viewModel['title']); ?></h1>
    <div style="display: flex; justify-content: space-between;">
        <?php
        if (isset($viewModel['id_Previous']) && $viewModel['id_Previous'] > 0)
        {
            ?>
            <p style="width:32%; text-align:left;">
                <a href="<?= ROOT_URL.'tutorial/'.$viewModel['id_Previous'] ?>">
                    < < <?= urldecode($viewModel['previous_title']) ?>
                </a>
            </p>
            <?php
        }
        else
        {
            ?>
            <p style="width:32%;">
                &nbsp;
            </p>
            <?php
        }
        ?>
        <p style="width:32%; text-align:center;">
            <a href="<?= ROOT_URL.'tutorials/' ?>">Tutoriels</a>
        </p>
        <?php
        if (isset($viewModel['id_Next']) && $viewModel['id_Next'] > 0)
        {
            ?>
            <p style="width:32%; text-align:right;">
                <a href="<?= ROOT_URL.'tutorial/'.$viewModel['id_Next'] ?>">
                    <?= urldecode($viewModel['next_title']) ?> > >
                </a>
            </p>
            <?php
        }
        else
        {
            ?>
            <p style="width:32%;">
                &nbsp;
            </p>
            <?php
        }
        ?>
    </div>
    <hr>
    <p><?= urldecode($viewModel['content']); ?></p>
    <hr>
    <br>
    <div>
        <?php
        if (isset($viewModel['id_Previous']) && $viewModel['id_Previous'] > 0)
        {
            ?>
            <p><a style="float: left;" href="<?= ROOT_URL.'tutorial/'.$viewModel['id_Previous'] ?>">< < <?= urldecode($viewModel['previous_title']) ?></a></p>
            <?php
        }
        ?>
        <?php
        if (isset($viewModel['id_Next']) && $viewModel['id_Next'] > 0)
        {
            ?>
            <p><a style="float: right;" href="<?= ROOT_URL.'tutorial/'.$viewModel['id_Next'] ?>"><?= urldecode($viewModel['next_title']) ?> > ></a></p>
            <?php
        }
        ?>
    </div>
</div>
