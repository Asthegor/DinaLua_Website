<h1>Statistiques du site</h1>
<br>
<table style="width: 100%;">
    <tr>
        <th style="width: 30%;"></th>
        <th style="width: 15%;text-align: center;">Nbre Enreg.</th>
        <th style="width: 15%;text-align: center;">Affichés</th>
        <th style="width: 15%;text-align: center;">Masqués</th>
    </tr>
</table>
<?php
foreach ($viewModel as $datas)
{
    ?>
    <a href="<?= ROOT_MNGT.$datas['dest']; ?>">
        <table style="width:100%;">
            <tr>
                <td style="width: 30%;"><?= $datas['title']; ?></td>
                <?php
                foreach ($datas['datas'] as $number)
                {
                    ?>
                    <td style="width: 15%; text-align: center;"><?= $number; ?></td>
                    <?php
                }
                ?>
            </tr>
        </table>
    </a>
    <?php
}
?>
