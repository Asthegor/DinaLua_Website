<?php
if ($_SERVER["REQUEST_URI"] == __FILE__)
  header('Location: '.ROOT_URL);
?>
  </div>
  <footer>
    <h5 id="copyright">Copyright &copy; 
    <?php 
    $curYear = date('Y');
    echo COPY_YEAR . ((COPY_YEAR != $curYear) ? '-' . $curYear : ''); ?> -- LACOMBE Dominique</h5>
    <br>
  </footer>
</body>
</html>
