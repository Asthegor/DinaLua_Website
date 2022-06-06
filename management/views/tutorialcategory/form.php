<h1>Catégorie de tutoriels</h1>
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
        <label>Nom</label>
        <input type="text" name="name" value="<?= isset($viewModel['name']) ? urldecode($viewModel['name']) : ''; ?>" required />
    </div>
    <div class="form-group">
        <label>Description</label>
        <textarea rows="6" cols="150" name="content" class="content-area" required><?= isset($viewModel['description']) ? urldecode($viewModel['description']) : ''; ?></textarea>
        <script>
            CKEDITOR.replace( 'content',
                              {
                                  width: '100%',
                                  height: 200,
                                  resize_dir: 'both',
                                  resize_minHeight: 100
                              });
        </script>
    </div>
    <div class="form-group">
        <label>Ordre de tri</label>
        <input type="text" name="sortOrder" value="<?= isset($viewModel['sortOrder']) ? $viewModel['sortOrder'] : ''; ?>" required />
    </div>
    <div class="form-group">
        <label>Catégorie parent</label>
        <select name="id_Parent">
            <option value="0"></option>
            <?php
            $fm = new TutorialCategoryModel();
            $fmlist = $fm->getlist(isset($viewModel['id']) ? $viewModel['id'] : 0);
            foreach ($fmlist as $item)
            {
                ?>
                <option value="<?= $item['id']; ?>" <?= isset($viewModel['id_Parent']) ? ($viewModel['id_Parent'] == $item['id'] ? 'selected' : '') : ''; ?>><?= urldecode($item['name']); ?></option>
                <?php
            }
            ?>
        </select>
    </div>
    <input class="btn btn-primary" name="submit" type="submit" value="Submit" />
    <a class="btn btn-warning" href="<?= ROOT_MNGT; ?>tutorials">Cancel</a>
    <?php if (isset($viewModel['id']))
    {
        ?>
        <a class="btn btn-danger" href="<?= ROOT_MNGT.'tutorialcategory/delete/'.$viewModel['id']; ?>">Delete</a><br>
        <?php
    }
    ?>
</form>
