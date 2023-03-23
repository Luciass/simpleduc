<?php 
  session_start();
  require_once('/var/www/html/simpleduc/config/dbconnexion.php');
  if ($_SESSION) {
    $id_user = $_SESSION['user']['idu'];
    $reqUser = $db->prepare("SELECT id_role FROM users WHERE id_user = :id_user");
    $reqUser->execute([
      "id_user" => $id_user,
    ]);
    $user = $reqUser->fetch();
  }
?>

<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link href="css/StylesIndex.css" rel="stylesheet">
<link rel="stylesheet" href="/simpleduc/css/Connexion.css">
<script src="https://kit.fontawesome.com/222489915d.js" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark container-fluid">
  <a class="navbar-brand" href="#">SimplEduc</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/simpleduc/index.php">Home </a>
      </li>
      <?php if ($_SESSION == NULL) { ?>
      <li class="nav-item">
        <a class="nav-link" href="/simpleduc/pages/register.php">Register</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/simpleduc/pages/connexion.php">Login</a>
      </li>
      <?php } ?>
      <?php if ($_SESSION != NULL) { 
        if (($user['id_role'] == 2) or ($user['id_role'] == 1)) { ?>
        <li class="nav-item">
          <a class="nav-link" href="#">Statistique</a>
        </li>
        <li>
        <a class="nav-link" href="/simpleduc/pages/entreprise.php">entreprise</a>
        </li>
        <li>
        <a class="nav-link" href="/simpleduc/pages/Contrat.php">Contrat</a>
        </li>
        <?php } ?>
        <li class="nav-item">
          <a class="nav-link" href="/simpleduc/pages/job.php">Job</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/simpleduc/pages/profil.php">profil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/simpleduc/pages/destroy.php">destroy</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/simpleduc/pages/entreprise.php">entreprise</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/simpleduc/pages/equipe.php">equipe</a>
        </li>
      <?php } ?>
    </ul>
    
  </div>
</nav>
<!-- Toggler -->