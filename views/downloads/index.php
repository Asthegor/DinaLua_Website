<?php
if (!is_array($viewModelLastVersion))
{
    ?>
    <br>
    <h2>Liste des versions disponibles en téléchargement</h2>
    <br>
    Merci de noter le site dans vos crédits si vous utilisez DinaGE dans votre projet.<br>
    <br>
    <h3>Dernière version : <a href="<?= ROOT_URL; ?>download.php?file=<?= $viewModelLastVersion; ?>"><?= $viewModelLastVersion; ?></a></h3>
    <br>
    <?php
    if (!empty($viewModelFiles))
    {
        ?>
        <table style="width:75%; border: none;">
            <tr>
                <th><strong>Anciennes versions</strong></th>
            </tr>
            <?php
            foreach ($viewModelFiles as $file)
            {
                $file = basename($file);
                if ($file != $lastversion)
                {
                    ?>
                    <tr>
                        <td><a href="<?= ROOT_URL; ?>download.php?file=<?= $file; ?>"><?= $file; ?></a></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
        <?php
    }
}
?>
