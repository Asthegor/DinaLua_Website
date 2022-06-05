<?php
include_once(__DIR__.'/header.php');
?>
  <main role="main" class="container">
    <?php 
    Messages::display();
    ?>
    <?php
    require($view);
    ?>
  </main>
<?php
include_once(__DIR__.'/footer.php');
?>