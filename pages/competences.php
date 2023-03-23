<?php
include('../config/dbconnexion.php');
include('../inc/layout.php');

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Simpleduc | Compétences</title>
    
  </head>
<body>
<div class="col-md-4 container-fluid">
  <h1>Selectionnez vos Compétences</h1>
  <?php
        $req=$db->prepare("SELECT nom_comp, id_comp FROM competence");
        $req->execute();
        $competences=$req->fetchall();
        
        foreach($competences as $competence){
          ?>
          <div>
          <input type="checkbox" value="<?=$competence['id_comp']?>"><?=$competence['nom_comp']?>
          </div>
          <br/>

        <?php }?>

        <?php
        foreach ($_POST['cat'] as $idcat){
          $req = $db->prepare("INSERT INTO avoir(id_user, id_comp) VALUE (:id_user, :id_comp)");
          $req->execute([
            "id_user" => $id_user,
            "id_comp" => $id_comp
          ]);

        }

      ?>

  <a class="btn btn-primary" href="../index.php" role="button">Valider</a>
</div>
</body>
