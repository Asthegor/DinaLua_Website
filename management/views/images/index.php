<h1>Images</h1>
<h5><a href="<?= ROOT_MNGT.'images/add'; ?>">Nouvelle image</a></h5>
<br>
<?php
$directory = "";
$subdirectory = "";
foreach ($viewModel as $file)
{
    
    if ($directory <> $file->directory)
    {
        if (!empty($directory))
        {
            ?>
            <hr>
            <?php
        }
        ?>
        <h3><?= ucfirst($file->directory); ?></h3>
        <?php
    }
    $pos = strpos($file->name, '/');
    if($pos !== false)
    {
        $isSubDir = true;
        $subdir = substr($file->name, 0, $pos);
        if($subdir <> $subdirectory)
        {
            if(!empty($subdirectory))
            {
                ?>
                </div>
                <?php
            }
            ?>
            <div style="margin-left:5%">
            <h4><?= ucfirst($subdir); ?></h4>
            <?php
        }
        $subdirectory = $subdir;
    }
    else
    {
        if(!empty($subdirectory))
        {
            //<hr width="25%" align="left">
            ?>
            <br>
            </div>
            <?php
        }
        $subdirectory = "";
    }
    ?>
    <a href="<?= ROOT_URL.'assets/images/'.$file->directory.'/'.$file->name; ?>" target="_blank"><?= $file->name; ?></a>
    <br>
    <?php
    $directory = $file->directory;
}
?>