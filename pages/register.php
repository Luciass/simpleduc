<?php
    require '../inc/layout.php';

    require_once '../lib/vendor/autoload.php';
    require_once '../class/class_mail.php';
    require('../config/dbconnexion.php');

    use PHPMailer\PHPMailer\PHPMailer; 

    if (isset($_POST['register_user'])) {
        if (isset($_POST['lastname']) && isset($_POST['firstname']) && isset($_POST['mail']) && isset($_POST['pass']) && isset($_POST['confirm_pass']) && isset($_POST['phone']) && !empty($_POST['lastname']) && !empty($_POST['firstname']) && !empty($_POST['mail']) && !empty($_POST['pass']) && !empty($_POST['confirm_pass']) && !empty($_POST['phone'])) {
            $req = $db->query("SELECT mail FROM users");
            $result = $req->fetch();
            if ($_POST['mail'] !== $result) {
                if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
                    if ($_POST['pass'] === $_POST['confirm_pass']) {
                        $lastname = htmlspecialchars($_POST['lastname']);
                        $firstname = htmlspecialchars($_POST['firstname']);
                        $mail = htmlspecialchars($_POST['mail']);
                        $phone = htmlspecialchars($_POST['phone']);
                        $password = htmlspecialchars($_POST['confirm_pass']);
                        $code = uniqid(rand());
                        $email = new Mail();
                        $requser = $db->prepare("INSERT INTO users (nom, prenom, mail, tel, mdp, codeVA, valide, id_role) VALUE (:lastname, :firstname, :mail, :tel, :mdp, :codeVA, 0, 2)");
                        $reqexecute = $requser->execute([
                            "lastname" => $lastname,
                            "firstname" => $firstname,
                            "codeVA" => $code,
                            "mail" => $mail,
                            "tel" => $phone,
                            "mdp" => password_hash($password, PASSWORD_DEFAULT),
                        ]);
                        $url=$config['nuage'];
                        $message = "<!DOCTYPE html>
                        <html lang=\"fr\">
                            <head>
                                <meta charset=\"utf-8\">
                                <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
                            </head>
                            <body>
                                <h1>Confirmation de votre mail</h1>
                                <p>Nous sommes heureux de vous compter parmi nos nouveaux membres. Votre incription est bientot terminer il ne vous reste plus qu'a confirmer votre mail.</p>
                                <H3 style=\"text-align: center;\"><a href=\"https://$url/projet-simpleduc/pages/confirm.php?verify=$code\">cliquer pour confirmer</a></H3>
                                <style>
                                    h1 {
                                        text-align: center;
                                        text-decoration-line: underline;
                                    }
                        
                                    a {
                                        border: solid skyblue;
                                        border-radius: 12px;
                                        padding: 5px;
                                        background-color: skyblue;
                                        color: black;
                                    }
                        
                                    p {
                                        text-align: center;
                                        margin-bottom: 20px;
                                        font-size: 15px;
                                    }

                                    body {
                                        background-color: lightgrey;
                                        padding-bottom: 50px;
                                    }
                                </style>
                            </body>
                        </html>";
                        $email->envoyerMailer($mail, 'Confirmation', $message, ""); ?>

                        <div class="alert alert-success d-flex align-items-center alert-dismissible" role="alert">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                            </svg>
                            <div>
                                Votre compte a bien été créé! Vérifiez vos mails, une confirmation vous a été envoyer.
                            </div>
                        </div> <?php
                    } else { ?>
                        <div class="alert alert-danger d-flex align-items-center alert-dismissible" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>
                            <div>
                                Les mots de passe ne sont pas identique
                            </div>
                        </div> <?php
                    }
                } 
            } else { ?>
                <div class="alert alert-danger d-flex align-items-center alert-dismissible" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                      <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg>
                    <div>
                        Vous avez deja un compte <a href="login.php">Vous connecter.</a>
                    </div>
                </div> <?php
            }
        } else { ?>
            <div class="alert alert-danger d-flex align-items-center alert-dismissible" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </svg>
                <div>
                    Au moins un des champs est vide
                </div>
            </div> <?php
        }
    }
?>

<title>SimplEduc | Enregistrement</title>

<div class="title_website">
    <div class="container">
        <h1>S'enregistrer</h1>
        <p>Créez votre compte</p>
        <hr>
    </div>
</div>
<div class="container">
    <form method="POST">
        <div class="mb-3">
            <label for="lastname" class="form-label">Nom</label>
            <input type="text" class="form-control" id="lastname" name="lastname">
        </div>
        <div class="mb-3">
            <label for="firstname" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="firstname" name="firstname">
        </div>
        <div class="mb-3">
            <label for="mail" class="form-label">Adresse mail</label>
            <input type="email" class="form-control" id="mail" name="mail">
        </div>
        <div class="mb-3">
            <label for="tel" class="form-label">Numero de telephone</label>
            <input type="number" class="form-control" id="tel" name="phone">
        </div>
        <div class="mb-3">
            <label for="pass" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="pass" name="pass">
        </div>
        <div class="mb-3">
            <label for="confirm-pass" class="form-label">Confirmez le mot de passe</label>
            <input type="password" class="form-control" id="confirm_pass" name="confirm_pass">
        </div>
        <button type="submit" class="btn btn-primary mb-5" name="register_user">S'enregistrer</button>
    </form>
</div>