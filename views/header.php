<?php
if ($_SERVER["REQUEST_URI"] == __FILE__)
  header('Location: '.ROOT_URL);
?>
<!DOCTYPE html>

<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="author" content="LACOMBE Dominique">
  <meta name="description" content="LACOMBE Dominique's <?= ENGINE_FULLNAME ?>">
  <meta name="keywords" content="Lua,Love2D,Games,jeux,programming,gameengine">
  <title><?= ENGINE_SHORTNAME ?></title>
  <link rel="shortcut icon" href="<?= ROOT_URL; ?>assets/images/favicon.png" type="image/x-icon"/>
  
  <link rel="stylesheet" href="<?= ROOT_URL; ?>assets/js/styles/railscasts.css">
  <script src="<?= ROOT_URL; ?>assets/js/highlight.pack.js"></script>
  <script>hljs.initHighlightingOnLoad();</script>

  <link rel="stylesheet" href="<?= ROOT_URL; ?>assets/css/bootstrap.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Comfortaa|Courgette">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "3w33yvc78h");
</script>

  <link rel="stylesheet" href="<?= ROOT_URL; ?>assets/css/styles.css" />
</head>

<body>
  <div id="google_translate_element"></div>
  <script type="text/javascript">
    function googleTranslateElementInit() {
      new google.translate.TranslateElement({pageLanguage: 'fr', layout: google.translate.TranslateElement.FloatPosition.TOP_RIGHT}, 'google_translate_element');
    }
  </script>
  <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

  <header style="width:100%">
    <img src="<?= ROOT_URL; ?>assets/images/DinaGE.png" alt="Dina Game Engine"/>
  </header>