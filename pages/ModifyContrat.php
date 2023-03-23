<?php
    require '../inc/layout.php';

    require_once '../lib/vendor/autoload.php';
    require('../config/dbconnexion.php');

    $id_contrat = $_GET['Edit'];
    $reqcontrat = $db-> prepare("SELECT * From contrat where id_contrat = :id_contrat");
    $reqcontrat->execute([
        "id_contrat" => $id_contrat

    ]);
    $contrat = $reqcontrat->fetch();

   
    if (isset($_POST['Modif_contrat'])) { 
        var_dump($_POST);
        if (isset($_POST['date_debut_contrat']) && isset($_POST['date_fin_contrat']) && isset($_POST['date_sign']) && isset($_POST['cout_global']) && isset($_POST['id_entreprise']) && !empty($_POST['date_debut_contrat']) && !empty($_POST['date_fin_contrat']) && !empty($_POST['date_sign']) && !empty($_POST['cout_global']) && !empty($_POST['date_fin_contrat']) && !empty($_POST['id_entreprise'])) {

                    $date_debut_contrat = htmlspecialchars($_POST['date_debut_contrat']);
                    $date_fin_contrat =  htmlspecialchars($_POST['date_fin_contrat']);
                    $date_sign =  htmlspecialchars($_POST['date_sign']);
                    $cout_global =  htmlspecialchars($_POST['cout_global']);
                    $id_entreprise =  htmlspecialchars($_POST['id_entreprise']);
                    $cahier_charge = htmlspecialchars($_POST['cahier_charge']);

                    $reqcontrat = $db->prepare("UPDATE contrat SET date_debut_contrat = :date_debut_contrat , date_fin_contrat=:date_fin_contrat, date_sign=:date_sign, cout_global=:cout_global,id_entreprise=:id_entreprise, cahier_charge=:cahier_charge where id_contrat = :id_contrat");
                        var_dump($_POST);
                        $reqcontrat->execute([
                            "date_debut_contrat"=>$date_debut_contrat,
                            "date_fin_contrat"=>$date_fin_contrat,
                            "date_sign"=>$date_sign,
                            "cout_global"=>$cout_global,
                            "id_entreprise"=>$id_entreprise,
                            "cahier_charge"=>$cahier_charge,
                            "id_contrat"=>$id_contrat

                        ]);
                        header("location: Contrat.php");


         } else {
             print("ca passe pas 1");
         }
       
     }
?>

<title>SimplEduc | Modifier un Contrat</title>

<div class="title_website">
    <div class="container">
        <h1>Modifier le Contrat</h1>
    </div>
</div>
<div class="container">
    <form method="POST">
        <div class="mb-3">
            <label for="date_debut_contrat" class="form-label">Date de debut du contrat</label>
            <input type="date" class="form-control" id="date_debut_contrat" name="date_debut_contrat" value ="<?= $contrat['date_debut_contrat']?>">
        </div>
        <div class="mb-3">
            <label for="date_fin_contrat" class="form-label">Date de fin du contrat</label>
            <input type="date" class="form-control" id="date_fin_contrat" name="date_fin_contrat" value ="<?= $contrat['date_fin_contrat']?>">
        </div>
        <div class="mb-3">
            <label for="date_sign" class="form-label">Date de signature du contrat</label>
            <input type="date" class="form-control" id="date_sign" name="date_sign" value ="<?= $contrat['date_sign']?>">
        </div>
        <div class="mb-3">
            <label for="cout_global" class="form-label">cout global</label>
            <input type="text" class="form-control" id="cout_global" name="cout_global" value ="<?= $contrat['cout_global']?>">
        </div>
        <div class="mb-3">
            <select name = "id_entreprise" id="id_entreprise" class="form-control" >
            <?php
            $req =$db->prepare("SELECT distinct nom_entreprise, contrat.id_entreprise as contrat, entreprise.id_entreprise as entreprise from entreprise, contrat where contrat.id_entreprise= entreprise.id_entreprise ");
            $req->execute();
            $entreprises = $req->fetchall();
            
            foreach($entreprises as $entreprise){
                ?>
                <option <?php if($entreprise['entreprise'] == $contrat['id_entreprise']){ echo "selected";}?> value ="<?= $entreprise['entreprise']?>"><?= $entreprise['nom_entreprise']?>
            
            </option>
                
               
           <?php }?>
           </select>
        </div>
        <div class="mb-3">
            <label for="cahier_charge" class="form-label">Cahier des chages </label>
            <textarea class="form-control" id="cahier_charge" name="cahier_charge" cols="30" rows="10""><?= $contrat['cahier_charge']?></textarea >
        </div>
        <button type="submit" class="btn btn-primary mb-5" name="Modif_contrat"><a></>Modifier</button>
    </form>
</div>
