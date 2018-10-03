<?php
session_start();
include "model_pdo.php";

$mp = new model_pdo();
$retour = new stdClass();
$id_ingredient = 0;
$id_unite = 0;
$id_cocktail = 0;

if(!empty($_POST['nom_cocktail']) && !empty($_POST['ingredient'])) {
    $set_cocktail = $mp->set_cocktail($_POST['nom_cocktail']);
    if ($set_cocktail != FALSE) {
        foreach ($mp->get_cocktail_id($_POST['nom_cocktail']) as $row4)
            $id_cocktail = $row4;
        if ($id_cocktail != null) {
            $list_ingredient = $_POST['ingredient'];
            foreach ($list_ingredient as $row) {
                foreach ($mp->get_ingredient_id($row) as $row1)
                    $id_ingredient = $row1;
                foreach ($mp->get_unite_id($_POST['unite_' . $row]) as $row2)
                    $id_unite = $row2;
                $quantite = (int)$_POST['nombre' . $row];
                if ($quantite > 0)
                {
                    $setmelange = $mp->set_melange($id_cocktail[0], $id_ingredient[0], $id_unite[0], $quantite);
                    if ($setmelange == FALSE) {
                        $retour->success = false;
                        $retour->message = "Erreur d'ajout, veuillez saisir correctement les champs d'ajout";
                        $mp->delete_cocktail($_POST['nom_cocktail']);
                        break;
                    } else {
                        $retour->success = true;
                        $retour->message = "Cocktail ajouté";
                    }
                }
                else
                {
                    $retour->success = false;
                    $retour->message = "Erreur d'ajout, veuillez entrer une quantité valide" . " $quantite";
                    $mp->delete_cocktail($_POST['nom_cocktail']);
                    break;
                }
            }
        } else {
            $retour->success = false;
            $retour->message = "Erreur de récupération d'id, veuillez saisir un nom de cocktail valide";
            $mp->delete_cocktail($_POST['nom_cocktail']);
        }
    } else {
        $retour->success = false;
        $retour->message = "Erreur de création de cocktail, veuillez saisir un nom de cocktail valide";
    }
}
else
{
    $retour->success = false;
    $retour->message = "Erreur d'ajout, veuillez saisir correctement tous les champs";
    $mp->delete_cocktail($_POST['nom_cocktail']);
}

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');
echo json_encode($retour);