<h1>Outils</h1>
<br>
<?php
$index = 0;
foreach ($viewModel as $item)
{
    if($index > 0)
    {
        ?>
        <hr>
        <?php
    }
    ?>
    <h2><?= urldecode($item['title']); ?></h2>
    <p><em><small>Date de parution : <?= $item['date']; ?></small></em></p>
    <p><?= urldecode($item['description']); ?></p>
    <br>
    <p><a href="<?= ROOT_URL.'download.php?tools='.$item['file']; ?>"><span style="color: white;">Télécharger</span> <?= $item['file']; ?></a></p>
    <?php
    if (isset($item['id_Tutorial']))
    {
        ?>
        <hr style="text-align:left; width:50%; border-style: dashed; margin-left:0px;">
        <p>Lien du tutoriel : <a href="<?= ROOT_URL.'tutorial/'.$item['id_Tutorial'] ?>"><?= urldecode($item['tutorial']) ?></a></p>
        <?php
    }
    ?>
    <?php
    $index += 1;
}
?>