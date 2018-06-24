<?php
session_start();
include "model_pdo.php";

$mp = new model_pdo();
$retour = new stdClass();

if (!empty($_POST['ingredient'])) {
    $result = $mp->set_ingredient($_POST['ingredient']);

    if ($result != null) {
        $retour->success = true;
        $retour->message = "Ingrédient ajouté";
    } else {
        $retour->success = false;
        $retour->message = "Erreur de traitement, veuillez saisir un nouveau ingrédient";
    }
}
else
{
    $retour->success = false;
    $retour->message = "Erreur de traitement, veuillez saisir un nouveau ingrédient";
}
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');
echo json_encode($retour);