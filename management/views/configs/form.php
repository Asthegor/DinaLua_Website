<h1>Barre de navigation</h1>
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
    <?php if (isset($viewModel['id']))
    {
        ?>
        <div class="form-group">
            <label>ID</label>
            <input type="text" name="id" value="<?= $viewModel['id']; ?>" readonly />
        </div>
        <?php
    }
    ?>
    <div class="form-group">
        <label>Donnée</label>
        <input type="text" name="data" value="<?= isset($viewModel['data']) ? $viewModel['data'] : ''; ?>" required />
    </div>
    <div class="form-group">
        <label>Contenu</label>
        <textarea rows="6" cols="150" name="content"><?= isset($viewModel['content']) ? urldecode($viewModel['content']) : ''; ?></textarea>
        <script>
            CKEDITOR.replace( 'content',
                              {
                                  width: '100%',
                                  height: 300,
                                  resize_dir: 'both',
                                  resize_minHeight: 100
                              });
        </script>
    </div>
    <input class="btn btn-primary" name="submit" type="submit" value="Submit" />
    <a class="btn btn-warning" href="<?= ROOT_MNGT; ?>configs">Cancel</a>
    <?php if (isset($viewModel['id']))
    {
        ?>
        <a class="btn btn-danger" href="<?= ROOT_MNGT.'configs/delete/'.$viewModel['id']; ?>">Delete</a><br>
        <?php
    }
    ?>
</form>
