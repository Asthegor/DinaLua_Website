<h1>Outils</h1>
<h5><a href="<?= ROOT_MNGT.'tools/add'; ?>">Nouvel outil</a></h5>
<div>
    <table style="width:100%; text-align:left;">
        <tr>
            <th colspan="2">Fichier</th>
        </tr>
        <?php
        foreach ($viewModel as $file)
        {
            ?>
            <tr>
                <td style="width:50%;"><?= $file->name; ?></td>
                <td style="width:10%;"><?= $file->nbdownloads; ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>
