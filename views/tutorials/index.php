<h1>Tutoriels</h1>
<br>
<?php
$tm = new TutorialsModel();
$indcateg = 1;
foreach ($viewModel as $Categ)
{
    $tmsub = $tm->SubCategByCategId($Categ['id']);

    $tmtutos = $tm->TutorialsByCategory($Categ['id']);

    if (count($tmsub) > 0 or count($tmtutos) > 0)
    {
        if ($indcateg > 1 and $indcateg <= count($viewModel))
        {
            ?>
            <p>&nbsp;</p>
            <hr>
            <?php
        }
        $cat = urldecode($Categ['name']);
        $tag = str_replace(' ', '', $cat);
        ?>
        <h2 id="<?= $tag; ?>"><?= $cat; ?></h2>
        <?= urldecode($Categ['description']); ?>
        <hr style="text-align:left; width:50%; border-style: dashed; margin-left:0px;">
        <?php
        if (count($tmsub) > 0)
        {
            ?>
            <div style="margin-left: 5%">
            <?php
        }
    }
    
    $indsub = 1;
    foreach ($tmsub as $SubCateg)
    {
        $tmsubtutos = $tm->TutorialsByCategory($SubCateg['id']);
        if (count($tmsubtutos) > 0)
        {
            if ($indsub > 1 and $indsub <= count($tmsub))
            {
                ?>
                <hr style="text-align:left; width:50%; border-style: dashed; margin-left:0px;">
                <p>&nbsp;</p>
                <?php
            }
            $subcat = urldecode($SubCateg['name']);
            $tagsub = $tag . '-' . str_replace(' ', '', $subcat);
            ?>
            <h3 id="<?= $tagsub; ?>"><?= $subcat; ?></h3>
            <?= urldecode($SubCateg['description']); ?>
            <hr style="text-align:left; width:25%; border-style: dashed; margin-left:0px;">
            <?php
        }
        $indsubtuto = 1;
        foreach($tmsubtutos as $SubTutorial)
        {
            ?>
            <h4>
                <a href="<?= ROOT_URL.'tutorial/'.$SubTutorial['id']; ?>"><?= $indsubtuto . "- " . urldecode($SubTutorial['title']); ?></a>
            </h4>
            <p><?= urldecode($SubTutorial['short_desc']); ?></p>
            <?php
            $indsubtuto++;
        }
      $indsub++;
    }

    if (count($tmsub) > 0)
    {
        ?>
        </div>
        <?php
    }
    if (count($tmsub) > 0 and count($tmtutos) > 0)
    {
        ?>
        <hr style="text-align:left; width:50%; margin-left:0px;">
        <p>&nbsp;</p>
        <?php
    }
    $indtuto = 1;
    foreach ($tmtutos as $Tutorial)
    {
        ?>
        <h4>
            <a href="<?= ROOT_URL.'tutorial/'.$Tutorial['id']; ?>"><?= $indtuto . "- " . urldecode($Tutorial['title']); ?></a>
        </h4>
        <p><?= urldecode($Tutorial['short_desc']); ?></p>
        <?php
        $indtuto++;
    }
    
    $indcateg++;
}
?>