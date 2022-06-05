<h1>Nouvel outil</h1>
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
    <div>
        <input type="file" name="file" id="file">
    </div>
    <br>
    <input class="btn btn-primary" name="submit" type="submit" value="Submit" />
    <a class="btn btn-warning" href="<?= ROOT_MNGT; ?>tools">Cancel</a>
</form>
