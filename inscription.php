<?php
session_start();
include "model_pdo.php";

$mp = new model_pdo();
$retour = new stdClass();
if (empty($_POST['email']) || empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['password']) || empty($_POST['age'])) {
    $retour->success = false;
    $retour->message = "Erreur d'inscription, veuillez remplir correctement tous les champs ou rééssayer plus tard";
}
else {
    $result = $mp->setuser($_POST['email'], $_POST['nom'], $_POST['prenom'], $_POST['password'], $_POST['age']);

    if (!$result) {
        $retour->success = false;
        $retour->message = "Erreur d'inscription, veuillez remplir correctement tous les champs ou rééssayer plus tard";
    } else {
        $retour->success = true;
        $retour->message = "Inscription réussi";
    }
}
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');
echo json_encode($retour);