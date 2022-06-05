<h1>Nouveau téléchargement</h1>
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
    <div>
        <input type="file" name="file" id="file">
    </div>
    <input class="btn btn-primary" name="submit" type="submit" value="Submit" />
    <a class="btn btn-warning" href="<?= ROOT_MNGT; ?>downloads">Cancel</a>
</form>
