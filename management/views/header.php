<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="author" content="LACOMBE Dominique">
  <meta name="description" content="DinaGE - Management">
  <meta name="keywords" content="">
  <title>DinaGE - Management</title>
  <link rel="shortcut icon" href="<?= ROOT_URL; ?>assets/images/favicon.png" type="image/x-icon"/>
  
  <link rel="stylesheet" href="<?= ROOT_URL; ?>assets/css/bootstrap.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Comfortaa|Courgette">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="<?= ROOT_URL; ?>assets/css/styles.css" />
  <link rel="stylesheet" href="<?= ROOT_URL; ?>assets/css/management.css" />

  <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
  <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
  <header style="width:100%">
    <img src="<?= ROOT_URL; ?>assets/images/DinaGE.png"/>
  </header>
  <?php
  $fileName = basename($_SERVER['REQUEST_URI']);
  if (isset($_SESSION['is_logged_in'])) : ?>
    <ul class="nav-bar">
      <li class="nav-item"><a <?= ($fileName == '' || $fileName == 'home') ? ' class="active" ' : '' ?> href="<?= ROOT_MNGT; ?>">Home</a></li>
      <li class="nav-item"><a <?= $fileName == 'navbar' ? ' class="active" ' : '' ?> href="<?= ROOT_MNGT; ?>navbar">Barre de navigation</a></li>
      <li class="nav-item"><a <?= $fileName == 'configs' ? ' class="active" ' : '' ?> href="<?= ROOT_MNGT; ?>configs">Configurations</a></li>
      <li class="nav-item"><a <?= $fileName == 'news' ? ' class="active" ' : '' ?> href="<?= ROOT_MNGT; ?>news">Nouvelles</a></li>
      <li class="nav-item"><a <?= $fileName == 'downloads' ? ' class="active" ' : '' ?> href="<?= ROOT_MNGT; ?>downloads">Téléchargements</a></li>
      <li class="nav-item"><a <?= $fileName == 'tutorials' ? ' class="active" ' : '' ?> href="<?= ROOT_MNGT; ?>tutorials">Tutoriels</a></li>
      <li class="nav-item"><a <?= $fileName == 'examples' ? ' class="active" ' : '' ?> href="<?= ROOT_MNGT; ?>examples">Exemples</a></li>
      <li class="nav-item"><a <?= $fileName == 'tools' ? ' class="active" ' : '' ?> href="<?= ROOT_MNGT; ?>tools">Outils</a></li>
      <li class="nav-item"><a id="nav-item-site" href="<?= ROOT_URL; ?>" target="_blank">Voir sur le site</a></li>
      <li id="nav-item-last-child" class="nav-item"><a href="<?= ROOT_MNGT; ?>users/logout">Logout</a></li>
    </ul>
    <br>
  <?php endif; ?>
