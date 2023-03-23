<?php
    require('../inc/layout.php');
;
    require_once '../lib/vendor/autoload.php';
    require_once '../class/class_mail.php';

    //use PHPMailer\PHPMailer\PHPMailer;

    $real = true;
    $mode = "";
    $code = NULL;
    if (isset($_GET['verify'])) {
        $code = $_GET['verify'];
    }

    if (isset($_POST['send'])) {
        $mail = htmlspecialchars($_POST['mail']);
        $reqUser = $db->prepare("SELECT nom FROM users WHERE mail = :mail");
        $reqUser->execute([
            "mail" => $mail,
        ]);
        $theUser = $reqUser->fetch();
        if ($theUser) {
            if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
                $code = uniqid(rand());
                //$email = new Mail();
                $reqUser = $db->prepare("UPDATE users SET codeVA = :code WHERE mail = :mail");
                $reqUser->execute([
                  "mail" => $mail,
                  "code" => $code,
                ]);
                $url=$config['nuage'];
                $message = "<!DOCTYPE html>
                <html lang=\"fr\">
                    <head>
                        <meta charset=\"utf-8\">
                        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
                    </head>
                    <body>
                        <h1>Reinitialisation de votre mot de passe</h1>
                        <p>Une demande de reinitialisation de votre mot de passe a etait faite si vous n'y etes pas a l'origine, merci d'ignorer ce mail. Si vous etes a l'origine de ce mail veuillez cliquer sur le lien ci-dessous.</p>
                        <H3 style=\"text-align: center;\"><a href=\"https://$url/simpleduc/pages/forget_pw.php?verify=$code\">cliquer pour reinitialiser votre mot de passe</a></H3>
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
                //$email->envoyerMailer($mail, 'reinitalisation mot de passe', $message, ""); ?>
                <?php header('location: ../index.php');
            } else {
                $real = false;
            }
        } else {
            $real = false;
        }
    }

    if ($real == false) { ?>
        <div class="alert alert-danger d-flex align-items-center alert-dismissible" role="alert">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </svg>
            <div>
                Utilisateur introuvable!
            </div>
        </div> <?php
    }

    if ($code != 0) {
        $mode = "mdp";
        $reqUser = $db->prepare("SELECT id_user FROM users WHERE codeVA = :code");
        $reqUser->execute([
            "code" => $code,
        ]);
        $mode = "mdp";
        $result = $reqUser->fetch();
        $id_user = $result['id_user'];
    }

    if (isset($_POST['register'])) {
        $pass = htmlspecialchars($_POST['pass']);
        $confirm_pass = htmlspecialchars($_POST['confirm_pass']);
        if ($pass == $confirm_pass) {
            $reqUser = $db->prepare("UPDATE users SET mdp = :mdp, codeVA = 0 WHERE id_user = :id_user");
            $reqUser->execute([
                "mdp" => password_hash($confirm_pass, PASSWORD_DEFAULT),
                "id_user" => $id_user,
            ]);
            header('location: ../pages/connexion.php');
        }
    }
?>

<?php if ($mode != "mdp") { ?>
    <div class="title_website">
        <div class="container">
            <h1>Mot de passe oublié</h1>
            <p>Renseignez votre adresse mail pour recevoir un mail de reinnitialisation de mot de passe.</p>
            <hr>
        </div>
    </div>
    <div class="container">
        <form method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="mail" name="mail">
            </div>
            <button type="submit" class="btn btn-primary mb-5" name="send">Envoyer</button>
        </form>
    </div>
<?php }

if ($mode == "mdp") { ?>
    <div class="col-md-6 container">
        <h1>Modifier votre mot de passe</h1>
        <hr>
        <form method="post">
            <div class="mb-3">
                <label for="pass" class="form-label">Nouveau mot de passe</label>
                <input type="password" class="form-control" id="pass" name="pass">
            </div>
            <div class="mb-3">
                <label for="confirm-pass" class="form-label">Confirmez le mot de passe</label>
                <input type="password" class="form-control" id="confirm_pass" name="confirm_pass">
            </div>
            <button type="submit" class="btn btn-primary" name="register">Enregistrer</button>
        </form>
    </div>
<?php } ?>