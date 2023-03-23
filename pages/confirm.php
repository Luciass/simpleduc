<?php
    require('../config/dbconnexion.php');

    $codeVA = $_GET['verify'];
    $dateVA = date("Y/n/d");
    var_dump($codeVA);
    $reqUser = $db->prepare("UPDATE users SET dateVA = :dateVA, valide = 1, codeVA = 0 WHERE codeVA = :codeVA");
    $reqUser->execute([
        "dateVA" => $dateVA,
        "codeVA" => $codeVA
    ]);
    header('location: ../index.php');
