<?php

    require '../inc/layout.php';

    require_once '../lib/vendor/autoload.php';


   
    if (isset($_POST['add_entreprise'])) { 
        if (isset($_POST['nom_entreprise']) && isset($_POST['mail_entreprise']) && isset($_POST['tel_entreprise']) && isset($_POST['cahier_charge']) && isset($_POST['tel_contact']) && isset($_POST['nom_contact']) && !empty($_POST['nom_entreprise']) && !empty($_POST['mail_entreprise']) && !empty($_POST['tel_entreprise']) && !empty($_POST['cahier_charge']) && !empty($_POST['tel_contact']) && !empty($_POST['nom_contact'])) {
            $nom_entreprise = htmlspecialchars($_POST['nom_entreprise']);
            $req = $db->prepare("SELECT mail_entrerpise FROM entreprise where nom_entreprise = :nom_entreprise");
            $req->execute([
                "nom_entreprise" => $nom_entreprise
            ]);
            $result = $req->fetch();
            var_dump($result);
            if ($result == NULL) {
                if (filter_var($_POST['mail_entreprise'], FILTER_VALIDATE_EMAIL)) {
                        $nom_entreprise = htmlspecialchars($_POST['nom_entreprise']);
                        $mail_entreprise = htmlspecialchars($_POST['mail_entreprise']);
                        $tel_entreprise = htmlspecialchars($_POST['tel_entreprise']);
                        $nom_contact = htmlspecialchars($_POST['nom_contact']);
                        $tel_contact = htmlspecialchars($_POST['tel_contact']);
                        $reqentreprise = $db->prepare("INSERT INTO entreprise(nom_entreprise, mail_entrerpise, tel_entreprise, nom_contact, tel_contact) VALUE (:nom_entreprise, :mail_entreprise, :tel_entreprise, :nom_contact, :tel_contact)");
                        var_dump($_POST);
                        $reqentreprise->execute([
                            "nom_entreprise" => $nom_entreprise,
                            "mail_entreprise" => $mail_entreprise,
                            "tel_entreprise" => $tel_entreprise,
                            "nom_contact" => $nom_contact,
                            "tel_contact" => $tel_contact
                        ]);
                       
            }else { ?>
                            <div class="alert alert-danger d-flex align-items-center alert-dismissible" role="alert">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                </svg>
                                <div>
                                    Au moins un des champs est vide ou l'entreprise existe deja
                                </div>
                                </div> <?php
                    }
            }
        }
    }
?>

<title>SimplEduc | Enregistrement d'entreprise</title>

<div class="title_website">
    <div class="container">
        <h1>Ajouter une entreprise</h1>
        <hr>
    </div>
</div>
<div class="container">
    <form method="POST">
        <div class="mb-3">
            <label for="nom_entreprise" class="form-label">Nom de l'entreprise</label>
            <input type="text" class="form-control" id="nom_entreprise" name="nom_entreprise">
        </div>
        <div class="mb-3">
            <label for="mail_entreprise" class="form-label">Adresse mail de l'entreprise</label>
            <input type="email" class="form-control" id="mail_entreprise" name="mail_entreprise">
        </div>
        <div class="mb-3">
            <label for="tel_entreprise" class="form-label">Numero de telephone de l'entreprise</label>
            <input type="number" class="form-control" id="tel_entreprise" name="tel_entreprise">
        </div>
        <div class="mb-3">
            <label for="nom_contact" class="form-label">Nom du contact</label>
            <input type="text" class="form-control" id="nom_contact" name="nom_contact">
        </div>
        <div class="mb-3">
            <label for="tel_contact" class="form-label">Numero de telephone du contact </label>
            <input type="text" class="form-control" id="tel_contact" name="tel_contact">
        </div>

        <button type="submit" class="btn btn-primary mb-5" name="add_entreprise">ajouter</button>
    </form>
</div>

