<?php
session_start();
include "model_pdo.php";

$mp = new model_pdo();
$retour = new stdClass();
$list = array();

$result = $mp->list_cocktails();
if($result != null)
{
    foreach ($result as $row)
    {
        $list[] = $row['nom'];
    }
    $retour->success = true;
    $retour->message = $list;
}
else
{
    $retour->success = false;
    $retour->message = "Liste vide : veuillez en ajouter avant de demander la liste";
}

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');
echo json_encode($retour);
