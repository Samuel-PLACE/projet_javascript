<?php
session_start();
include "model_pdo.php";

$mp = new model_pdo();
$retour = new stdClass();
$list = "";

$result = $mp->get_ingredient($_POST['ingredient_cocktail-button']);
if($result != null)
{
    $retour->success = true;
    $retour->message = $result;
}
else
{
    $retour->success = false;
    $retour->message = "fail";
}

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');
echo json_encode($retour);