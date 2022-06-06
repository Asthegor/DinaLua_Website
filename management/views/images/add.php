<h1>Nouvelle image</h1>
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
    <div class="form-group">
        <div>
            <label>Répertoire</label>
            <select id="directory" name="directory" onchange="showTutorialSubDirectory()">
                <option value=""></option>
                <?php
                $img = new ImagesModel();
                $imgdir = $img->GetImageDirectories();
                foreach ($imgdir as $dir)
                {
                    ?>
                    <option value="<?= basename($dir); ?>"><?= basename($dir); ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div id="tutosubdir" style="display:none">
            <label>Sous-répertoire</label>
            <input list="subdirectories" name="subdirectory">
            <datalist id="subdirectories">
                <?php
                $imgsubdir = $img->GetTutorialSubDirectories();
                foreach ($imgsubdir as $dir)
                {
                    ?>
                    <option value="<?= basename($dir); ?>"><?= basename($dir); ?></option>
                    <?php
                }
                ?>
            </datalist>
        </div>
    </div>
    <div>
        <input type="file" name="upfile" id="upfile">
    </div>
    <br>
    <br>
    <input class="btn btn-primary" name="submit" type="submit" value="Submit" />
    <a class="btn btn-warning" href="<?= ROOT_MNGT; ?>images">Cancel</a>
</form>
<script>
function showTutorialSubDirectory()
{
    var directory = document.getElementById("directory").value;
    var tutosubdir = document.getElementById("tutosubdir");
    if (directory == "tutorials")
        tutosubdir.style.display = "block";
    else
        tutosubdir.style.display = "none";
}
</script>