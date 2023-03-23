<?php

    include('../inc/layout.php');
    

    $mode = '';
    $id_user = $_SESSION['user']['idu'];

    if (isset($_POST['modifie_profil'])) {
        $mode = "edit";
    }

    if (isset($_POST['register_profil'])) {
        $mode = "edit";
        if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail']) && isset($_POST['tel']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['mail']) && !empty($_POST['tel'])) {
            $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $mail = htmlspecialchars($_POST['mail']);
            $tel = htmlspecialchars($_POST['tel']);

            $req = $db->prepare("UPDATE users SET nom = :nom, prenom = :prenom, mail = :mail, tel = :tel, WHERE id_user = :id_user");
            $req_execute = $req->execute([
                "nom" => $nom,
                "prenom" => $prenom,
                "mail" => $mail,
                "tel" => $tel,
                "id_user" => $id_user,
            ]);

            header("location: profil.php");

        } elseif (isset($_POST['dropout'])) {
            header("location: profil.php");

        } else { ?>
            <div class="alert alert-danger d-flex align-items-center alert-dismissible" role="alert">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
              </svg>
              <div>
                Au moins un des champs est vide.
              </div>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div> <?php 
        }
    }

    if (isset($_POST['delete_profil'])) { ?>
        <div class="alert alert-danger" role="alert">
            <form method="post">
                <h4 class="alert-heading">Suppresion</h4>
                <p>Vous etes sur le point de supprimer votre compte, cette operation est definitive. Confirmer vous la supprimer?</p>
                <hr>
                <button type="submit" class="btn btn-primary" name="confirm_delete_profil">Confirmer</button>
                <button type="submit"class="btn btn-primary" name="dropout">Annuler</button>
            </form>
        </div> <?php  
    }

    
    if (isset($_POST['confirm_delete_profil'])) {
        $reqDeleteprofil = $db->prepare("DELETE FROM users WHERE id_user = :id_user");
        $reqDeleteprofil->execute([
            "id_user" => $id_user,
        ]);

        session_destroy();
        header("location: ../index.php");

    } elseif (isset($_POST['dropout'])) {
        header("location: profil.php");
    }

    $reqUser = $db->prepare("SELECT * FROM users WHERE id_user = :id_user");
    $reqUser->execute([
        "id_user" => $id_user
    ]);

    $theUser = $reqUser->fetch();
?>

<div class="col-md-4 container-fluid">
    <h2>Vos données personnel</h2>
    <hr>
    <form method="post">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <?php if ($mode === "edit") { ?>
                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $theUser['nom'] ?>">
            <?php } else { ?>
                <input type="text" class="form-control" id="nom" value="<?php  echo $theUser['nom'] ?>" disabled readonly>
            <?php } ?>
        </div>
        <div class="mb-3">
            <label for="prenom" class="form-label">Prenom</label>
            <?php if ($mode === "edit") { ?>
                <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $theUser['prenom'] ?>">
            <?php } else { ?>
                <input type="text" class="form-control" id="prenom" value="<?php echo $theUser['prenom'] ?>" disabled readonly>
            <?php } ?>        
        </div>
        <div class="mb-3">
            <label for="tel" class="form-label">Numero de telephone</label>
            <?php if ($mode === "edit") { ?>
                <input type="number" class="form-control" id="tel" name="tel" value="<?php echo $theUser['tel'] ?>">
            <?php } else { ?>
                <input type="number" class="form-control" id="tel" value="<?php echo $theUser['tel'] ?>" disabled readonly>
            <?php } ?>        
        </div>
        <div class="mb-3">
            <label for="mail" class="form-label">Adresse mail</label>
            <?php if ($mode === "edit") { ?>
                <input type="email" class="form-control" id="mail" name="mail" value="<?php echo $theUser['mail'] ?>">
            <?php } else { ?>
                <input type="email" class="form-control" id="mail" value="<?php echo $theUser['mail'] ?>" disabled readonly>
            <?php } ?>        
        </div>
        <?php if ($mode === "edit") { ?>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary" name="register_profil">Enregistrer</button>
                <button type="submit" class="btn btn-primary" name="stop_profil">Annuler</button>
            </div>
        <?php } else { ?>
            <button type="submit" class="btn btn-primary mb-3" name="modifie_profil">Modifier</button>
            <a class="btn btn-primary mb-3" href="../pages/password.php?modify=<?= $id_user ?>">Modifier le mot de passe</a>
            <?php if ($theUser['id_role'] != 2) { ?>
                <button type="submit" class="btn btn-danger mb-3" name="delete_profil">Supprimer le profil</button>
            <?php }
        } ?>
    </form>
</div>