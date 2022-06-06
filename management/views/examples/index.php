<h1>Exemples</h1>
<h5><a href="<?= ROOT_MNGT.'examples/add'; ?>">Nouvel exemple</a></h5>
<div>
    <table style="width:100%; text-align:left;">
        <tr>
            <th style="width:5%;">Id</th>
            <th style="width:30%;">Titre</th>
            <th style="width:20%;">Catégorie</th>
            <th style="width:30%;">Fichier</th>
            <th style="width:10%;">Nb Downloads</th>
            <th style="width:5%;">Visible</th>
        </tr>
    </table>
    <?php
    $em = new ExamplesModel();
    foreach ($viewModelExamples as $item)
    {
    ?>
        <a href="<?= ROOT_MNGT.'examples/update/'.$item['id']; ?>">
            <table style="width:100%;">
                <tr>
                    <td style="width:5%;"><?= $item['id']; ?></td>
                    <td style="width:30%;"><?= urldecode($item['title']); ?></td>
                    <td style="width:20%;"><?= urldecode($item['Category']); ?></td>
                    <td style="width:30%;"><?= urldecode($item['file']); ?></td>
                    <td style="width:10%;"><?= $em->NbDownloads($item['file']); ?></td>
                    <td style="width:5%;"><?= $item['visible'] ? 'Oui' : 'Non'; ?></td>
                </tr>
            </table>
        </a>
    <?php
    }
    ?>
</div>
<br>
<hr>
<br>
<?php
include(__DIR__."/../examplecategory/index.php");
?>