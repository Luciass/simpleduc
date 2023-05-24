<?php

    include('../inc/layout.php');

    if (isset($_GET['modify'])) {
        $id_user = intval($_GET['modify']);
    }

    $reqUser = $db->prepare("SELECT * FROM users WHERE id_user = :id_user");
    $reqUser->execute([
        "id_user" => $id_user
    ]);

    $theUser = $reqUser->fetch();

    if (isset($_POST['dropout'])) {
        header('location: profil.php');
    }

    if (isset($_POST['register'])) {
        if (isset($_POST['passnow']) && isset($_POST['pass']) && isset($_POST['confirm_pass']) && !empty($_POST['passnow']) && !empty($_POST['pass']) && !empty($_POST['confirm_pass'])) {
            $passNow = htmlspecialchars($_POST['passnow']);
            $pass = htmlspecialchars($_POST['pass']);
            $confirm_pass = htmlspecialchars($_POST['confirm_pass']);
            if (password_verify($passNow, $theUser['mdp'])) {
                if ($pass == $confirm_pass) {
                    $reqPass = $db->prepare("UPDATE users SET mdp = :mdp WHERE id_user = :id_user");
                    $reqPass->execute([
                        "mdp" => password_hash($confirm_pass, PASSWORD_DEFAULT),
                        "id_user" => $id_user
                    ]); ?>
                    <div class="alert alert-success d-flex align-items-center alert-dismissible mb-0" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16"class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/>
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                        </svg>
                        <div>
                            Votre mot de passe a bien etait modifier, <a href="profil.php">retourner à votre profil</a>
                        </div>
                    </div> <?php
                }
            }
        }
    }
?>

<div class="col-md-6 container">
    <h1>Modifier votre mot de passe</h1>
    <hr>
    <form method="post">
        <div class="mb-3">
            <label for="passnow" class="form-label">Mot de passe actuel</label>
            <input type="password" class="form-control" id="passnow" name="passnow">
        </div>
        <div class="mb-3">
            <label for="pass" class="form-label">Nouveau mot de passe</label>
            <input type="password" class="form-control" id="pass" name="pass">
        </div>
        <div class="mb-3">
            <label for="confirm-pass" class="form-label">Confirmez le mot de passe</label>
            <input type="password" class="form-control" id="confirm_pass" name="confirm_pass">
        </div>
        <button type="submit" class="btn btn-primary" name="register">Enregistrer</button>
        <button type="submit" class="btn btn-primary" name="dropout">Annuler</button>
    </form>
</div>