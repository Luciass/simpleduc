<?php
    include("../config/dbconnexion.php");
    include("../inc/layout.php");

    $idu = $_SESSION['user']['idu'];
    $reqEquipeU = $db->prepare("SELECT id_equipe FROM etre WHERE id_user = :idu");
    $reqEquipeU->execute([
        "idu" => $idu
    ]);
    $equipeU = $reqEquipeU->fetch();

    if (isset($_POST['add'])) {
        $reqAddEquipe = $db->prepare("INSERT INTO equipe (nom_equipe) VALUE (:nom_equipe)");
        $reqAddEquipe->execute([
            "nom_equipe" => $nom_equipe
        ]);
        $reqEq = $db->prepare("SELECT id_equipe FROM equipe WHERE nom_equipe = :nom_equipe");
        $reqEq->execute([
            "nom_equipe" => $_POST['nom']
        ]);
        $reqAddEquipe = $db->prepare("INSERT INTO etre (id_user, id_equipe) VALUE (:id_user, :id_equipe)");
        
    }
?>

<div class="col-md-10 container-fluid">
    <h2>Vos equipes</h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#equipe</th>
                <th scope="col">Nom de l'equipe</th>
                <th scope="col">#Responsable</th>
            </tr>
        </thead>
        <tbody>
            <tr> <?php
                $reqEquipeALL = $db->prepare("SELECT * FROM equipe WHERE id_equipe = :id_equipe");
                $reqEquipeALL->execute([
                    "id_equipe" => $equipeU
                ]);
                $equipesALL = $reqEquipeALL->fetchall();
                foreach($equipesALL as $equipeALL) { ?>
                <td><?= $equipeALL['id_equipe'] ?></td>
                <td><?= $equipeALL['nom_equipe'] ?></td>
                <td><?= $equipeALL['id_responsable'] ?></td>
                <?php } ?>
            </tr>
        </tbody>
    </table>
    <button class="btn btn-secondary" name="add-equipe">Créer une équipe</button>
</div>
<div class="container">
    <form method="POST">
        <div class="mb-3">
            <label for="lastname" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom">
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#Utilisateur</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prenom</th>
                    <th scope="col">Metier</th>
                </tr>
            </thead>
            <tbody> <?php
                    $reqUsers = $db->prepare("SELECT * FROM users");
                    $reqUsers->execute();
                    $users = $reqUsers->fetchall();
                    foreach($users as $user) { ?>
                        <tr>
                            <td><?= $user['id_user'] ?></td>
                            <td><?= $user['nom'] ?></td>
                            <td><?= $user['prenom'] ?></td>
                            <?php
                            $reqmetierE = $db->prepare("SELECT id_metier FROM exercer WHERE id_user = :idu");
                            $reqmetierE->execute([
                                "idu" => $user['id_user']
                            ]);
                            $metiers = $reqmetierE->fetch();
                            if ($metiers != false) {
                                $reqmetier = $db->prepare("SELECT * FROM metier WHERE id_metier = :idm");
                                $reqmetier->execute([
                                    "idm" => $metiers['id_metier']
                                ]);
                                    $metier = $reqmetier->fetch(); 
                            } ?>
                            <td><?= $metier['nom_metier'] ?></td>
                            <td><input type="checkbox" name="<?= $user['id_user'] ?>"></td>
                        </tr>
                    <?php } ?>
            </tbody>
        </table>
        <button type="submit" class="btn btn-secondary mb-5" name="add">Enregistrer</button>
    </form>
</div>