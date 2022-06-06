<h1>Outils</h1>
<h5><a href="<?= ROOT_MNGT.'tools/add'; ?>">Nouvel outil</a></h5>
<div>
    <table style="width:100%; text-align:left;">
        <tr>
            <th style="width:5%;">Id</th>
            <th style="width:30%;">Titre</th>
            <th style="width:25%;">Fichier</th>
            <th style="width:10%;">Nb Downloads</th>
            <th style="width:5%;">Visible</th>
        </tr>
    </table>
    <?php
    foreach ($viewModel as $item)
    {
        ?>
        <a href="<?= ROOT_MNGT.'tools/update/'.$item['id']; ?>">
            <table style="width:100%;">
                <tr>
                    <td style="width:5%;"><?= $item['id']; ?></td>
                    <td style="width:30%;"><?= urldecode($item['title']); ?></td>
                    <td style="width:25%;"><?= urldecode($item['file']); ?></td>
                    <td style="width:10%;"><?= ""//$file->nbdownloads; ?></td>
                    <td style="width:5%;"><?= $item['visible'] ? 'Oui' : 'Non'; ?></td>
                </tr>
            </table>
        </a>
        <?php
    }
    ?>
</div>