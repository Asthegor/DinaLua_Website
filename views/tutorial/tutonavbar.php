<div style="display: flex; justify-content: space-between;">
    <p style="width:40%; text-align:left;">
    <?php
    if (isset($viewModel['id_Previous']) && $viewModel['id_Previous'] > 0)
    {
        ?>
        <a href="<?= ROOT_URL.'tutorial/'.$viewModel['id_Previous'] ?>">
            < < <?= urldecode($viewModel['previous_title']) ?>
        </a>
        <?php
    }
    else
    {
        ?>
        &nbsp;
        <?php
    }
    ?>
    </p>
    <p style="width:10%; text-align:center;">
        <a href="<?= ROOT_URL.'tutorials/' ?>">Tutoriels</a>
    </p>
    <p style="width:40%; text-align:right;">
    <?php
    if (isset($viewModel['id_Next']) && $viewModel['id_Next'] > 0)
    {
        ?>
        <a href="<?= ROOT_URL.'tutorial/'.$viewModel['id_Next'] ?>">
            <?= urldecode($viewModel['next_title']) ?> > >
        </a>
        <?php
    }
    else
    {
        ?>
        &nbsp;
        <?php
    }
    ?>
    </p>
</div>
