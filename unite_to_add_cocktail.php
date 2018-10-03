<?php
session_start();
include "model_pdo.php";

$mp = new model_pdo();
$retour = new stdClass();
$list = array();

$result = $mp->get_all_unite();

if($result != null)
{
    foreach ($result as $row)
    {
        $list[] = $row['nom'];
    }
    $retour->message = $list;
    $retour->success = true;
}
else
{
    $retour->message = "Il n'existe pas d'unité dans la base";
    $retour->success = false;
}

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');
echo json_encode($retour);
