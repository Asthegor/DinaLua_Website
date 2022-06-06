<h1>Exemples</h1>
<br>
<?php
$index = 0;
$curCateg = '';
foreach ($viewModel as $item)
{
    if ($curCateg != $item['category'])
    {
        if($curCateg != '')
        {
            ?>
            <hr>
            <?php
        }
        $cat = urldecode($item['category']);
        $tag = str_replace(' ', '', $cat);
        ?>
        <h2 id ="<?= $tag; ?>"><?= $cat; ?></h2>
        <?= urldecode($item['categ_desc']); ?>
        <hr style="text-align:left; width:50%; border-style: dashed; margin-left:0px;">
        <?php
        $index = 1;
        $curCateg = $item['category'];
    }
    else
    {
            $index += 1;
    }
    ?>
    <h3><?= urldecode($item['title']); ?></h3>
    <p><?= urldecode($item['description']); ?></p>
    <a href="<?= ROOT_URL.'download.php?example='.$item['file']; ?>"><span style="color: white;">Télécharger</span> <?= $item['file']; ?></a>
    <p>&nbsp;</p>
    <?php
}
?>