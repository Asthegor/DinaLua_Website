<h1>Nouvelles</h1>
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
        <label>Date</label>
        <input type="date" name="date_news" value="<?= isset($viewModel['date_news']) ? $viewModel['date_news'] : ''; ?>" required />
    </div>
    <div class="form-group">
        <label>Titre</label>
        <input type="text" name="title" value="<?= isset($viewModel['title']) ? urldecode($viewModel['title']) : ''; ?>" required />
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
    <div class="form-group">
        <label>Nouvelle version</label>
        <input type='hidden' name="new_version" value="0" />
        <input type="checkbox" name="new_version" value="1" <?= (isset($viewModel['new_version']) && $viewModel['new_version']) ? 'checked' : ''; ?> />
    </div>
    <div class="form-group">
        <label>Avec exemple</label>
        <input type='hidden' name="new_example" value="0" />
        <input type="checkbox" name="new_example" value="1" <?= (isset($viewModel['new_example']) && $viewModel['new_example']) ? 'checked' : ''; ?> />
    </div>
    <div class="form-group">
        <label>Nouveau tutoriel</label>
        <input type='hidden' name="new_tutorial" value="0" />
        <input type="checkbox" name="new_tutorial" value="1" <?= (isset($viewModel['new_tutorial']) && $viewModel['new_tutorial']) ? 'checked' : ''; ?> />
    </div>
    <div class="form-group">
        <label>Visible</label>
        <input type='hidden' name="visible" value="0" />
        <input type="checkbox" name="visible" value="1" <?= (isset($viewModel['visible']) && $viewModel['visible']) ? 'checked' : ''; ?> />
    </div>
    <input class="btn btn-primary" name="submit" type="submit" value="Submit" />
    <a class="btn btn-warning" href="<?= ROOT_MNGT; ?>home">Cancel</a>
    <?php if (isset($viewModel['id']))
    {
        ?>
        <a class="btn btn-danger" href="<?= ROOT_MNGT.'news/delete/'.$viewModel['id']; ?>">Delete</a><br>
        <?php
    }
    ?>
</form>
