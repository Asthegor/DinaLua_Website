<h1>Tutoriels</h1>
<h5><a href="<?= ROOT_MNGT.'tutorials/add'; ?>">Nouveau tutoriel</a></h5>
<div>
    <table style="width:100%; text-align:left;">
        <tr>
            <th style="width:3%;">Id</th>
            <th style="width:25%;">Titre</th>
            <th style="width:15%;">Catégorie</th>
            <th style="width:10%;">Tuto préc.</th>
            <th style="width:10%;">Tuto suiv.</th>
            <th style="width:10%;">Visible</th>
        </tr>
    </table>
    <?php
    foreach ($viewModelTutos as $item)
    {
    ?>
        <a href="<?= ROOT_MNGT.'tutorials/update/'.$item['id']; ?>">
            <table style="width:100%;">
                <tr>
                    <td style="width:3%;"><?= $item['id']; ?></td>
                    <td style="width:25%;"><?= urldecode($item['title']); ?></td>
                    <td style="width:15%;"><?= urldecode($item['Category']); ?></td>
                    <td style="width:10%;"><?= $item['id_Previous'] ? $item['id_Previous'] : ''; ?></td>
                    <td style="width:10%;"><?= $item['id_Next'] ? $item['id_Next'] : ''; ?></td>
                    <td style="width:10%;"><?= $item['visible'] ? 'Oui' : 'Non'; ?></td>
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
include(__DIR__."/../tutorialcategory/index.php");
?>
</div>