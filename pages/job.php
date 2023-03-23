<?php
include('../config/dbconnexion.php');
include('../inc/layout.php');

if (isset($_POST['submit'])) {
  foreach ($_POST['cat'] as $idcat){
    if (isset($idcat)) {
      $req = $db->prepare("INSERT INTO exercer(id_user, id_metier) VALUE (:id_user, :id_metier)");
      $req->execute([
        "id_user" => $id_user,
        "id_metier" => $id_metier
      ]);
    }
  }
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Simpleduc | Job</title>
  </head>
  <body>
  <div class="col-md-4 container-fluid">
    <h1>Sélectionnez Votre Métier</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <?php
      $req=$db->prepare("SELECT nom_metier, id_metier FROM metier");
      $req->execute();
      $metiers = $req->fetchall();
      
      foreach($metiers as $metier){
        ?>
        <div>
          <div>
            <input type="checkbox" value="<?=$metier['id_metier']?>" name="cat"><span>  <?=$metier['nom_metier']?></span>
          </div>
      <?php }?>


      <button type="submit"> Envoyer </button>
      
    </form>
  </div>
  </body>
</html>