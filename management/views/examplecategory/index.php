<h1>Categories de exemples</h1>
<h5><a href="<?= ROOT_MNGT.'examplecategory/add'; ?>">Nouvelle categorie</a></h5>
<div>
    <table style="width:100%; text-align:left;">
        <tr>
            <th style="width:5%;">Id</th>
            <th style="width:50%;">Titre</th>
            <th style="width:5%;">Ordre de tri</th>
        </tr>
    </table>
    <?php
    foreach ($viewModelCategs as $item)
    {
    ?>
        <a href="<?= ROOT_MNGT.'examplecategory/update/'.$item['id']; ?>">
            <table style="width:100%;">
                <tr>
                    <td style="width:5%;"><?= $item['id']; ?></td>
                    <td style="width:50%;"><?= urldecode($item['name']); ?></td>
                    <td style="width:5%;"><?= $item['sortOrder']; ?></td>
                </tr>
            </table>
        </a>
    <?php
    }
    ?>
</div>