<?php

    require('../config/dbconnexion.php');
    require '../inc/layout.php';
    require_once '../lib/vendor/autoload.php';


    if (isset($_GET['Delete'])) { ?>
      <div class="alert alert-danger" role="alert">
          <form method="post" action= "/projet-simpleduc/pages/Contrat.php">
              <h4 class="alert-heading">Suppresion</h4>
              <p>Vous etes sur le point de supprimer ce contrat, cette operation est definitive. Confirmer vous la supprimer?</p>
              <hr>
              <input type = "hidden" name = "id_contrat" value = "<?=$_GET['Delete']?>"/>
              <button type="submit" class="btn btn-primary" name="confirm_delete_profil">Confirmer</button>
              <button type="submit"class="btn btn-primary" name="dropout">Annuler</button>
          </form>
      </div> <?php  
  }

  
  if (isset($_POST['confirm_delete_profil'])) {
    
      $id_contrat = $_POST['id_contrat'];
      $reqDeleteprofil = $db->prepare("DELETE FROM contrat WHERE id_contrat = :id_contrat");
      $reqDeleteprofil->execute([
          "id_contrat" => $id_contrat
      ]);
    }

    $req = $db->prepare("SELECT id_contrat, nom_entreprise, cahier_charge, date_debut_contrat, date_fin_contrat, date_sign, cout_global from entreprise, contrat where contrat.id_entreprise = entreprise.id_entreprise");
    $req->execute();
    $Contrats = $req->fetchall();
    
  ?>

<div class = "card-group">
  <div class="card">
  <?php
      foreach($Contrats as $Contrat){
  ?>
  <div class = "col-md-6 mb-3">
  <div class="card text-dark bg-light mb-3 pr-3 " style="max-width: 40rem;">
    <div style="text-align: center" class="card-header"><?= $Contrat['nom_entreprise']?>
    <a data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" href="/projet-simpleduc/pages/ModifyContrat.php?Edit=<?= $Contrat['id_contrat'] ?>"><i tittle ="edit" style = "padding-left: 100px" class="fas fa-edit"></i></a>
    <a data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" href="/projet-simpleduc/pages/Contrat.php?Delete=<?= $Contrat['id_contrat']?>"><i style = "padding-left: 20px" class="fas fa-trash-alt"></i></a>
  </div>
    <div class="card-body">
      <p style="text-align: center; font-weight: bold " class="card-title"><?= date('d/m/Y', strtotime($Contrat['date_debut_contrat']))?> - <?= date('d/m/Y', strtotime($Contrat['date_fin_contrat']))?> </p>
      <p class="card-text"><?= $Contrat['cahier_charge']?></p>

    </div>
      <div class="card-footer"><?= $Contrat['cout_global']?> € </div>
  </div>    
  </div>
  <?php }?>
</div>