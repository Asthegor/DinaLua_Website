<h1>Outil</h1>
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
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
        <label>Description</label>
        <textarea rows="6" cols="150" name="content" class="content-area" required><?= isset($viewModel['description']) ? urldecode($viewModel['description']) : ''; ?></textarea>
        <script>
            CKEDITOR.replace( 'content',
                              {
                                  width: '100%',
                                  height: 200,
                                  resize_dir: 'both',
                                  resize_minHeight: 200
                              });
        </script>
    </div>
    <div class="form-group">
        <label>Tutoriel associé</label>
        <select name="id_Tutorial">
            <option value=""></option>
            <?php
            $fm = new TutorialsModel();
            $fmlist = $fm->index();
            foreach ($fmlist as $item)
            {
                ?>
                <option value="<?= $item['id']; ?>" <?= isset($viewModel['id_Tutorial']) && $viewModel['id_Tutorial'] == $item['id'] ? 'selected' : ''; ?>><?= urldecode($item['title']); ?></option>
                <?php
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label>Ordre de tri</label>
        <input type="text" name="sortOrder" value="<?= isset($viewModel['sortOrder']) ? $viewModel['sortOrder'] : ''; ?>" required />
    </div>
    <div class="form-group">
        <label>Fichier</label>
        <div>
            <?php
            if (isset($viewModel['file']))
            {
                ?>
                <input type='hidden' name="filename" value="<?= urldecode($viewModel['file']); ?>" />
                <p width="84%">Fichier actuel : <?= urldecode($viewModel['file']); ?></p>
                <?php
            }
            ?>
            <input type="file" name="file" id="file">
        </div>
    </div>
    <div class="form-group">
        <label>Visible</label>
        <input type='hidden' name="visible" value="0" />
        <input type="checkbox" name="visible" value="1" <?= (isset($viewModel['visible']) && $viewModel['visible']) ? 'checked' : ''; ?> />
    </div>
    <input class="btn btn-primary" name="submit" type="submit" value="Submit" />
    <a class="btn btn-warning" href="<?= ROOT_MNGT; ?>tools">Cancel</a>
    <?php if (isset($viewModel['id']))
    {
        ?>
        <a class="btn btn-danger" href="<?= ROOT_MNGT.'tools/delete/'.$viewModel['id']; ?>">Delete</a><br>
        <?php
    }
    ?>
</form>
