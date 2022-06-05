<h1>Tutoriel</h1>
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
        <label>Titre</label>
        <input type="text" name="title" value="<?= isset($viewModel['title']) ? urldecode($viewModel['title']) : ''; ?>" required />
    </div>
    <div class="form-group">
        <label>Résumé</label>
        <input type="text" name="short_desc" value="<?= isset($viewModel['short_desc']) ? urldecode($viewModel['short_desc']) : ''; ?>" required />
    </div>
    <div class="form-group">
        <label>Catégorie</label>
        <select name="id_Category">
            <option value=""></option>
            <?php
            $fm = new TutorialCategoryModel();
            $fmlist = $fm->index();
            foreach ($fmlist as $item)
            {
                ?>
                <option value="<?= $item['id']; ?>" <?= $viewModel['id_Category'] == $item['id'] ? 'selected' : ''; ?>><?= urldecode($item['name']); ?></option>
                <?php
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label>Contenu</label>
        <textarea rows="6" cols="150" name="content" class="content-area" required><?= isset($viewModel['content']) ? urldecode($viewModel['content']) : ''; ?></textarea>
        <script>
            CKEDITOR.replace( 'content',
                              {
                                  width: '100%',
                                  height: 500,
                                  resize_dir: 'both',
                                  resize_minHeight: 300
                              });
        </script>
    </div>
    <div class="form-group">
        <label>Tutoriel précédent</label>
        <select name="id_Previous">
            <option value=""></option>
            <?php
            $fm = new TutorialsModel();
            $fmlist = $fm->getList($viewModel['id'], $viewModel['id_Category']);
            foreach ($fmlist as $item)
            {
                ?>
                <option value="<?= $item['id']; ?>" <?= $viewModel['id_Previous'] == $item['id'] ? 'selected' : ''; ?>><?= urldecode($item['title']); ?></option>
                <?php
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label>Tutoriel suivant</label>
        <select name="id_Next">
            <option value=""></option>
            <?php
            $fm = new TutorialsModel();
            $fmlist = $fm->getList($viewModel['id'], $viewModel['id_Category']);
            foreach ($fmlist as $item)
            {
                ?>
                <option value="<?= $item['id']; ?>" <?= $viewModel['id_Next'] == $item['id'] ? 'selected' : ''; ?>><?= urldecode($item['title']); ?></option>
                <?php
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label>Visible</label>
        <input type='hidden' name="visible" value="0" />
        <input type="checkbox" name="visible" value="1" <?= (isset($viewModel['visible']) && $viewModel['visible']) ? 'checked' : ''; ?> />
    </div>
    <input class="btn btn-primary" name="submit" type="submit" value="Submit" />
    <a class="btn btn-warning" href="<?= ROOT_MNGT; ?>tutorials">Cancel</a>
    <?php if (isset($viewModel['id']))
    {
        ?>
        <a class="btn btn-danger" href="<?= ROOT_MNGT.'tutorials/delete/'.$viewModel['id']; ?>">Delete</a><br>
        <?php
    }
    ?>
</form>
