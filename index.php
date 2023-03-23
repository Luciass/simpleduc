<?php
    require('./config/dbconnexion.php');
    include('./inc/layout.php');
    require_once('./lib/vendor/autoload.php');
    require_once('./class/class_mail.php');

    //use PHPMailer\PHPMailer\PHPMailer;

    if (isset($_POST['send'])) {
        $objet = htmlspecialchars($_POST['objet']);
        $nom = htmlspecialchars($_POST['nom']);
        $content = htmlspecialchars($_POST['message']);
        $mail = htmlspecialchars($_POST['email']);
        //$email = new Mail();
        //$email->envoyerMailer('thomas.delos@epsi.fr', $objet.' '.$nom, $content.'</br>'.$mail, "");
    }

    //$email = new Mail();
    //$email->envoyerMailer('noha.flahaut@epsi.fr', 'cctwoi', 'cctwoi', '');
?>



<div class = "background">
<img src="img/pexels-pixabay-270366.jpg" alt ="Responsive image" class="gif opacity-25 ">
</div>
<h1 class="h1_right text-center">Bienvenue sur Simple Educ</h1>
<h2 class="h2_right">Notre entreprise</h2>

<p class="p_right">
Simpléduc est une ESN créée en 2013. Son activité principale est la création de logiciels innovants
dans le secteur de l’éducation. Située dans la ville d’Arras (62000), elle regroupe des développeurs
spécialisés dans les nouvelles technologies, notamment dans la création de sites internet et de
solutions mobiles. Elle dispose également de techniciens réseau qui travaillent sur la mise en place
de l’infrastructure de l’entreprise.</br>
Avec l’engouement des MOOCS et le développement d’outils numériques comme les smartphones
et les tablettes, Simpléduc se concentre sur le développement d’applications sur mesure pour ses
clients. Pour améliorer son efficacité et honorer ses contrats, l’entreprise développe également une
solution de gestion de projets en interne.
</p>
<div>
<center><h2 class="h2_service">Nos services<h2></center>
<p class="p_service">L’entreprise Simpléduc mobilise des développeurs afin de réaliser un outil de gestion de projets.
Celui-ci a pour objectif de suivre en temps réel les projets d’entreprise ainsi que les équipes qui les
réalisent. Un des critères principaux est la réalisation d’un outil simple, accessible via des
WebServices permettant la consultation des données sur Mobile (Android).<p>
</div>


    
    <div class ="Contact_box">
    <center><h2 class="h2_service">Contactez-nous</h2>
    <p class ="p_contact">Un problème, une question, envie de nous envoyer un message d’amour ? N’hésitez pas à utiliser ce formulaire pour prendre contact avec nous !</p> </center>
    <form action="#" method="post">
    <div class="Contact">
    <label for="nom">Votre nom</label>
    <input type="text" id="nom" name="nom" placeholder="Martin" required>
    </div>
    <div class="Contact">
    <label for="email">Votre e-mail</label>
    <input type="email" id="email" name="email" placeholder="monadresse@mail.com" required>
    </div>
    <div class="Contact">
    <label for="objet">Objet</label>
    <input type="text" id="objet" name="objet" placeholder="Objet" required>
    </div>
    <div class="Contact">
    <label for="message">Votre message</label>
    <textarea id="message" name="message" placeholder="Bonjour, je vous contacte car...." required></textarea>
    </div>
    <div class ="Contact">
    <center><button type="submit" name="send">Envoyer mon message</button></center>
    </div>
    </form>
</div>
