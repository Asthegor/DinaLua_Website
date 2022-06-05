<h1>Nouvelles</h1>
<h5><a href="<?= ROOT_MNGT.'news/add'; ?>">Nouvelle entrée</a></h5>
<div class="news-index">
    <table style="width:100%; text-align:left;">
        <tr>
            <th style="width:15%;">Date</th>
            <th style="width:30%;">Titre</th>
            <th style="width:10%;">Nouvelle version</th>
            <th style="width:10%;">Avec exemple</th>
            <th style="width:10%;">Nouveau tuto</th>
            <th style="width:5%;">Visible</th>
        </tr>
    </table>
    <?php
    foreach ($viewModel as $item)
    {
    ?>
        <a href="<?= ROOT_MNGT.'news/update/'.$item['id']; ?>">
            <table style="width:100%;">
                <tr>
                    <td style="width:15%;"><?= $item['date_news']; ?></td>
                    <td style="width:30%;"><?= urldecode($item['title']); ?></td>
                    <td style="width:10%;"><?= $item['new_version'] ? 'Oui' : 'Non'; ?></td>
                    <td style="width:10%;"><?= $item['new_example'] ? 'Oui' : 'Non'; ?></td>
                    <td style="width:10%;"><?= $item['new_tutorial'] ? 'Oui' : 'Non'; ?></td>
                    <td style="width:5%;"><?= $item['visible'] ? 'Oui' : 'Non'; ?></td>
                </tr>
            </table>
        </a>
    <?php
    }
    ?>
</div>