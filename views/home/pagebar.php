<div>
<?php
$currentid = 0;
$indval = 1;
$index = isset($get['id']) ? intval($get['id']) : 0;
if ($index % 5 == 0)
    $currentid = $index;

for ($index = 0; $index < $NbNews; $index += 5)
{
    if ($currentid != $index)
    {
        ?>
        <a class="btn btn-warning" href="<?= ROOT_URL. ($index == 0 ? '' : 'home/'.$index); ?>"><?= $indval; ?></a>
        <?php
    }
    else
    {
        ?>
        <p class="btn btn-primary nocursor"><?= $indval; ?></p>
        <?php
    }
    $indval++;
}
?>
</div>
