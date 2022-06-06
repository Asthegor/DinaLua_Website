<?php
$get = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
// Affichage de l'annonce principale
if (isset($viewModelAnnounce['content']))
{
    ?>
    <?= urldecode($viewModelAnnounce['content']); ?>
    <a class="btn btn-warning" href="download.php?file=DinaLastVersion" style="background-color:orange;border-color:orange;">Téléchargez Dina</a>
    <hr>
    <?php
}

include(__DIR__."/pagebar.php");
?>

<hr>

<?php

// Affichage des 5 premières nouvelles
foreach ($viewModelNews as $news)
{
    ?>
    <h4><?= $news["date_news"] ?></h4>
    <h1><?= urldecode($news["title"]) ?></h1>
    <p><?= urldecode($news["content"]) ?></p>
    <?php
    if ((isset($news["new_version"]) && $news["new_version"]) || 
        (isset($news["new_example"]) && $news["new_example"]) ||
        (isset($news["new_tool"]) && $news["new_tool"]) ||
        (isset($news["new_tutorial"]) && $news["new_tutorial"])
       )
    {
        ?>
        <hr align="left" width="50%" style="border-style: dashed;">
        <?php
    }
    if (isset($news["new_version"]) && $news["new_version"])
    {
        ?>
        <p>Vous pouvez télécharger la nouvelle version ici : <a href="<?= ROOT_URL ?>downloads/">Téléchargements</a></p>
        <?php
    }
    if (isset($news["new_example"]) && $news["new_example"])
    {
        ?>
        <p>Vous pouvez télécharger les nouveaux exemples ici : <a href="<?= ROOT_URL ?>examples/">Exemples</a></p>
        <?php
    }
    if (isset($news["new_tutorial"]) && $news["new_tutorial"])
    {
        ?>
        <p>Vous pouvez consulter les nouveaux tutoriels ici : <a href="<?= ROOT_URL ?>tutorials/">Tutoriels</a></p>
        <?php
    }
    if (isset($news["new_tool"]) && $news["new_tool"])
    {
        ?>
        <p>Vous pouvez télécharger les nouveaux outils ici : <a href="<?= ROOT_URL ?>tools/">Outils</a></p>
        <?php
    }
    ?>
    <hr>
    <?php
}
$index = 0;

?>
<?php
include(__DIR__."/pagebar.php");
?>


