<?php
session_start();
include "model_pdo.php";

$mp = new model_pdo();
$retour = new stdClass();
$list = "";

$result = $mp->get_ingredient($_GET['ingredient_cocktail']);
if($result != null)
{
    foreach ($result as $row)
    {
        $list .= $row[2] . " " . $row[1] . " de " . $row[0] . ", ";
    }
    $retour->success = true;
    $retour->message = $list;
}
else
{
    $retour->success = false;
    $retour->message = "Erreur de traitement" ;
}

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');
echo json_encode($retour);