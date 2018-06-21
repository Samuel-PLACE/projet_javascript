<?php
session_start();
include "model_pdo.php";

$mp = new model_pdo();
$retour = new stdClass();

$result = $mp->getuserwithmail($_POST['email']);
if ($result != null)
{
    foreach ($result as $row)
    {
        $val = 6;
        if(isset($_POST['password']) && $_POST['password']==$row['mdp'])
        {
            $retour->success = true;
            $retour->message = "Bienvenue," . $row['prenom'] . $row['nom'];
            $_SESSION['user_id'] = $row['id'];
        }
    }
    if(empty($_SESSION) || !isset($_SESSION['user_id']))
    {
        $retour->success = false;
        $retour->message = "Veuillez rentrer un mot de passe valide";
        $_SESSION['user_id'] = 1;
    }
}
else
{
    $retour->success = false;
    $retour->message = "Mail inexistant, veuillez vous inscrire";
}


header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');
echo json_encode($retour);
