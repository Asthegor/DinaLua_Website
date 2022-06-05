<?php
// Affichage de l'annonce principale
if (isset($viewModelAnnounce['content']))
{
    ?>
    <?= urldecode($viewModelAnnounce['content']); ?>
    <a class="btn btn-warning" href="download.php?file=DinaGELastVersion">Téléchargez Dina GE</a>
    <hr>
    <?php
}

// Affichage des 5 premières nouvelles
foreach ($viewModelNews as $news)
{
    ?>
    <h4><?= $news["date_news"] ?></h4>
    <h2><?= urldecode($news["title"]) ?></h2>
    <p><?= urldecode($news["content"]) ?></p>
    <?php
    if ((isset($news["new_version"]) && $news["new_version"]) || 
        (isset($news["new_example"]) && $news["new_example"]) ||
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
        <p>Vous pouvez consulter les nouveaux tutoriels ici : <a href="<?= ROOT_URL ?>tutorials/">Tutorials</a></p>
        <?php
    }
    ?>
    <hr>
    <?php
}
?>