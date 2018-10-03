<?php
session_start();
include "model_pdo.php";

$mp = new model_pdo();
$retour = new stdClass();

if (!empty($_POST['unite']))
{
    $result = $mp->set_unite($_POST['unite']);

    if ($result != null) {
        $retour->success = true;
        $retour->message = "unité ajoutée";
    }
    else {
        $retour->success = false;
        $retour->message = "Erreur de traitement, veuillez saisir une nouvelle unité";
    }
}
else
{
    $retour->success = false;
    $retour->message = "Champ vide, veuillez saisir une nouvelle unité";
}
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');
echo json_encode($retour);