<?php
// Récupération de la dernière version du moteur
$lastversion = "";
foreach (array_reverse(glob("files/*.zip")) as $file)
{
    $lastversion = substr($file, strrpos($file, "/")+1);
    break;
}
?>
<?php
$fileName = basename($_SERVER['REQUEST_URI']);
?>
<ul class="nav-bar">
    <?php
    $navbar = new NavBarModel();
    $items = $navbar->getVisibleItems();
    $count = count($items);
    foreach ($items as $item)
    {
        ?>
        <li class="nav-item" 
        <?= $item['bRight'] ? 'style="float:right"' : ''?>>
            <a <?=  (($fileName == "" && strtolower($item['destination']) == 'home') || 
                     $fileName == $item['destination'] ||
                     $item['destination'] === "download.php?file=DinaGELastVersion")
                    ? ' class="active" '
                    : ''; ?>
                href="<?= ($item['bPage'] == 1 ? ROOT_URL : '').$item['destination']; ?>"
                <?= $item['bPage'] != 1 ? 'target="_blanck"' : ''; ?>
                ><?= $item['title']; ?>
            </a>
        </li>
        <?php
    }
    ?>
</ul>
