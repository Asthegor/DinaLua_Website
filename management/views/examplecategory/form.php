<h1>Catégorie d'exemples</h1>
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
        <input type="text" name="sortOrder" value="<?= $viewModel['sortOrder']; ?>" required />
    </div>
    <input class="btn btn-primary" name="submit" type="submit" value="Submit" />
    <a class="btn btn-warning" href="<?= ROOT_MNGT; ?>examples">Cancel</a>
    <?php if (isset($viewModel['id']))
    {
        ?>
        <a class="btn btn-danger" href="<?= ROOT_MNGT.'examplecategory/delete/'.$viewModel['id']; ?>">Delete</a><br>
        <?php
    }
    ?>
</form>
