<h1>Configurations</h1>
<h5><a href="<?= ROOT_MNGT.'configs/add'; ?>">Nouvelle donnée</a></h5>
<div class="navbar-index">
    <table style="width:100%; text-align:left;">
        <tr>
            <th style="width:5%;">Id</th>
            <th style="width:30%;">Donnée</th>
        </tr>
    </table>
    <?php
    foreach ($viewModel as $item)
    {
    ?>
        <a href="<?= ROOT_MNGT.'configs/update/'.$item['id']; ?>">
            <table style="width:100%;">
                <tr>
                    <td style="width:5%;"><?= $item['id']; ?></td>
                    <td style="width:30%;"><?= $item['data']; ?></td>
                </tr>
            </table>
        </a>
    <?php
    }
    ?>
</div>