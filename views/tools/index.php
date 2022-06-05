<style>
#tools {
  width:75%;
  border-collapse: collapse;
}
#tools th {
  font-family: 'Comfortaa', cursive;
}
#tools td {
  border: 0px solid black;
  border-right: 1px solid grey;
}
</style>
<?php 
class File {
    public $LastVersion;
    public $Count;
}

$arrFiles = array();
$currName = "";
foreach (array_reverse(glob(ROOT_DIR."files/tools/*.zip")) as $file)
{
    $file = basename($file);
    $name = substr($file, 0, strrpos($file, "_"));
    
    if ($name != $currName)
    {
        if (!isset($arrFiles[$name]))
        {
            $arrFiles[$name] = new File();
            $arrFiles[$name]->LastVersion = $file;
        }
        $arrFiles[$name]->Count += 1;
    }
    else
        $arrFiles[$name]->Count += 1;
    $currName = $name;
}
?>

<h2>Liste des outils disponibles en téléchargement</h2>
<br>
<p>Vous pouvez également participer à améliorer les outils proposés sur mon GitHub : <a href="https://github.com/Asthegor" target="_blank">https://github.com/Asthegor</a></p>
<br>
<table id="tools" border="2">
  <?php
  $currName = "";
  $nbFiles = 1;
  foreach (array_reverse(glob("files/tools/*.zip")) as $file)
  {
    //$file = substr($file, strpos($file, "/")+1);
    $file = basename($file);
    $name = substr($file, 0, strrpos($file, "_"));
    if ($name !== $currName)
    {

    ?>
        <tr>
            <th rowspan="<?= $arrFiles[$name]->Count == 1 ? 1 : $arrFiles[$name]->Count + 1; ?>" style="font-size: x-large;">
                <strong><?= $name; ?></strong>
            </th>
            <th style="text-align: center; font-size: larger; height: 50px;">
                <strong>Dernière version :</strong>
                <a href="<?= ROOT_URL; ?>download.php?tools=<?= $file; ?>"><?= $file; ?></a>
            </th>
        </tr>
        <?php
    }
    else
    {
        if ($arrFiles[$name]->Count > 1)
        {
        ?>
        <tr>
            <td align="center">Anciennes versions :</td>
        </tr>
        <?php
        }
        ?>
        <tr>
            <td align="center">
                <a href="./download.php?tools=<?= $file; ?>"><?= $file; ?></a>
                <br>
                <br>
            </td>
        </tr>
        <?php
        $nbFiles++;
    }
    $currName = $name;
  }
  ?>
</table>
