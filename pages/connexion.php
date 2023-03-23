<?php
    include('../inc/layout.php');
    
#un commentaire
    


    

    
    if (isset($_POST['login'])) {
        if (isset($_POST['mail']) && isset($_POST['pass']) && !empty($_POST['mail']) && !empty($_POST['pass'])) {
            if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
              $mail = htmlspecialchars($_POST['mail']);
              $reqUser = $db->prepare("SELECT * FROM users WHERE mail = :mail");
              $reqUser->execute([
                  "mail" => $mail
              ]);
              $user = $reqUser->fetch();
              if ($user['valide'] == 1) {
                if ($user) {
                  $password = htmlspecialchars($_POST['pass']);
                  if (password_verify($password, $user['mdp'])) {
                    $derniere_connexion = date("Y/n/d");
                    $reqUser = $db->prepare("UPDATE users SET derniere_connexion = :derniere_connexion WHERE mail = :mail");
                    $reqUser->execute([
                      "mail" => $mail,
                      "derniere_connexion" => $derniere_connexion,
                    ]);
                    $_SESSION['user']['idu'] = $user['id_user'];
                    header('location: ../index.php');
                  } else { ?>
                    <div class="alert alert-danger d-flex align-items-center alert-dismissible" role="alert">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                      </svg>
                      <div>
                      Email et/ou mot de passe incorrect(s) veuillez rééssayer ou <a href="register.php">créer un compte</a>
                      </div>
                    </div> <?php
                  }
                } else { ?>
                  <div class="alert alert-danger d-flex align-items-center alert-dismissible" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                      <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg>
                    <div>
                    L'email et/ou le mot de passe sont incorrects veuillez rééssayer ou <a href="register.php">créer un compte</a>
                    </div>
                  </div> <?php
                }
              }
            }
        } else { ?>
          <div class="alert alert-danger d-flex align-items-center alert-dismissible" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
              <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
            <div>
              Un ou plusieurs champs son vide.
            </div>
          </div> <?php
        }
    }

    if (isset($_POST['forget_pass'])) {
      header('location: ../pages/forget_pw.php');
    }
?>

<title>Simpleduc | Connexion</title>





<section>
  <div class="login-box">


        <form method="POST">
        <h1>Login</h1>
            <div class="input-box">

              <span class="icon">
                <ion-icon name="mail"></ion-icon>
              </span>
        
                <input type="email" class="" id="mail" name="mail" placeholder="Email" required>


            </div>
          
            <div class="input-box">
              <span class="icon">
                <ion-icon name="lock-closed"></ion-icon>
              </span>

        
                <input type="password" class="" id="pass" name="pass" placeholder="Password" required>

            </div>

            <div class="forgot"><a type="submit" class="" name="forget_pass">Mot de passe oublié</a></div>
            <button type="submit" class="" name="login">Se Connecter</button>


            
        </form>
  </div>

</section>


<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>