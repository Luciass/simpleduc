<?php
    require '../inc/layout.php';

    require_once '../lib/vendor/autoload.php';


   
    if (isset($_POST['add_contrat'])) { 
        var_dump($_POST);
        if (isset($_POST['date_debut_contrat']) && isset($_POST['date_fin_contrat']) && isset($_POST['date_sign']) && isset($_POST['cout_global']) && isset($_POST['id_entreprise']) && !empty($_POST['date_debut_contrat']) && !empty($_POST['date_fin_contrat']) && !empty($_POST['date_sign']) && !empty($_POST['cout_global']) && !empty($_POST['date_fin_contrat']) && !empty($_POST['id_entreprise'])) {

                    $date_debut_contrat = htmlspecialchars($_POST['date_debut_contrat']);
                    $date_fin_contrat =  htmlspecialchars($_POST['date_fin_contrat']);
                    $date_sign =  htmlspecialchars($_POST['date_sign']);
                    $cout_global =  htmlspecialchars($_POST['cout_global']);
                    $id_entreprise =  htmlspecialchars($_POST['id_entreprise']);
                    $cahier_charge = htmlspecialchars($_POST['cahier_charge']);
                    $reqcontrat = $db->prepare("INSERT INTO contrat (date_debut_contrat, date_fin_contrat, date_sign, cout_global,id_entreprise, cahier_charge ) VALUE (:date_debut_contrat, :date_fin_contrat, :date_sign, :cout_global, :id_entreprise, :cahier_charge)");
                        var_dump($_POST);
                        $reqcontrat->execute([
                            "date_debut_contrat"=>$date_debut_contrat,
                            "date_fin_contrat"=>$date_fin_contrat,
                            "date_sign"=>$date_sign,
                            "cout_global"=>$cout_global,
                            "id_entreprise"=>$id_entreprise,
                            "cahier_charge"=>$cahier_charge
                        ]);


         } else {
             print("ca passe pas 1");
         }
       
     }
?>
<style>.progress-bar {
  width: 100%;
  height: 20px;
  background-color: #f2f2f2;
  border-radius: 10px;
  margin-top: 20px;
}

.progress {
  height: 100%;
  background-color: #4CAF50;
  border-radius: 10px;
  width: 0%;
  transition: width 0.3s ease-in-out;
}

</style>
<title>SimplEduc | Enregistrement d'un Contrat</title>

<div class="title_website">
    <div class="container">
        <h1>Ajouter un Contrat</h1>
    </div>
</div>
<div class="progress-bar">
  <div class="progress"></div>
</div>
<div class="container">
    <form method="POST" id="task-form">
        <div class="mb-3">
            <label for="date_debut_contrat" class="form-label">Date de debut du contrat</label>
            <input type="date" class="form-control" id="date_debut_contrat" name="date_debut_contrat">
        </div>
        <div class="mb-3">
            <label for="date_fin_contrat" class="form-label">Date de fin du contrat</label>
            <input type="date" class="form-control" id="date_fin_contrat" name="date_fin_contrat">
        </div>
        <div class="mb-3">
            <label for="date_sign" class="form-label">Date de signature du contrat</label>
            <input type="date" class="form-control" id="date_sign" name="date_sign">
        </div>
        <div class="mb-3">
            <label for="cout_global" class="form-label">cout global</label>
            <input type="text" class="form-control" id="cout_global" name="cout_global">
        </div>
        <div class="mb-3">
            <select name = "id_entreprise" id="id_entreprise" class="form-control" >
            <option selected>Nom entreprise</option>
            <?php
            $req =$db->prepare("SELECT * from entreprise");
            $req->execute();
            $entreprises = $req->fetchall();
            
            foreach($entreprises as $entreprise){
                ?>
                <option value ="<?= $entreprise['id_entreprise']?>"><?= $entreprise['nom_entreprise']?></option>
               
           <?php }?>
           </select>
        </div>
        <div class="mb-3">
            <label for="cahier_charge" class="form-label">Cahier des chages </label>
            <textarea class="form-control" id="cahier_charge" name="cahier_charge" cols="30" rows="10"></textarea >
        </div>
        <button type="submit" class="btn btn-primary mb-5" name="add_contrat">ajouter</button>
    </form>
</div>

<script src="./main.js"></script>