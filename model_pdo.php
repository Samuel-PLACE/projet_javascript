<?php

class model_pdo
{
    private $pdo;

    public function __construct()
    {
        $dns = 'mysql:host=mysql-samuelp.alwaysdata.net;dbname=samuelp_bd';

        $username = 'samuelp';
        $pwd = 'Yotti1998';

        $this->pdo = new PDO($dns, $username, $pwd);
    }

    public function setuser($mail, $nom, $prenom, $mdp, $age)
    {
        $prepare = $this->pdo->prepare('INSERT INTO user(mail, nom, prenom, mdp, age) VALUES (:mail, :nom, :prenom, :mdp, :age)');
        $prepare->bindParam(':mail', $mail);
        $prepare->bindParam(':nom', $nom);
        $prepare->bindParam(':prenom', $prenom);
        $prepare->bindParam(':mdp', $mdp);
        $prepare->bindParam(':age', $age);
        return $prepare->execute();
    }

    public function getuserwithmail($mail)
    {
        $prepare = $this->pdo->prepare('SELECT * FROM user WHERE mail=:mail');
        $prepare->bindParam(':mail', $mail);
        $execute = $prepare->execute();
        if($execute == FALSE)
            return null;
        return $prepare->fetchAll();
    }

    public function list_cocktails()
    {
        $prepare = $this->pdo->prepare('SELECT * FROM cocktail');
        $execute = $prepare->execute();
        if ($execute == FALSE)
            return null;
        return $prepare->fetchAll();
    }

    public function get_ingredient($nomcocktail)
    {
        $prepare = $this->pdo->prepare('SELECT ingredient.nom, unite.nom, quantité FROM melange, cocktail, unite, ingredient WHERE cocktail.nom = :nom 
                                                                                                                    AND cocktail = cocktail.id 
                                                                                                                    AND unite = unite.id
                                                                                                                    AND ingredient = ingredient.id');
        $prepare->bindParam(':nom', $nomcocktail);
        $execute = $prepare->execute();
        if($execute == FALSE)
            return null;
        return $prepare->fetchAll();
    }

    public function set_ingredient($nomingedient)
    {
        $prepare = $this->pdo->prepare('INSERT INTO ingredient (nom) VALUES (:nom)');
        $prepare->bindParam(':nom', $nomingedient);
        return $prepare->execute();
    }

    public function set_unite($nomunite)
    {
        $prepare = $this->pdo->prepare('INSERT INTO unite (nom) VALUES (:nom)');
        $prepare->bindParam(':nom', $nomunite);
        return $prepare->execute();
    }

    public function get_all_ingredient ()
    {
        $prepare = $this->pdo->prepare('SELECT nom FROM ingredient');
        $execute = $prepare->execute();
        if ($execute == FALSE)
            return null;
        return $prepare->fetchAll();
    }

    public function get_all_unite()
    {
        $prepare = $this->pdo->prepare('SELECT nom FROM unite');
        $execute = $prepare->execute();
        if ($execute == FALSE)
            return null;
        return $prepare->fetchAll();
    }

    public function set_cocktail($nomcocktail)
    {
        $prepare = $this->pdo->prepare('INSERT INTO cocktail (nom) VALUES (:nom)');
        $prepare->bindParam(':nom', $nomcocktail);
        return $prepare->execute();
    }

    public function get_cocktail_id($nomcocktail)
    {
        $prepare = $this->pdo->prepare('SELECT id FROM cocktail WHERE nom = :nom');
        $prepare->bindParam(':nom', $nomcocktail);
        $execute = $prepare->execute();
        if ($execute == FALSE)
            return null;
        return $prepare->fetchAll();
    }

    public function get_ingredient_id($nomingredient)
    {
        $prepare = $this->pdo->prepare('SELECT id FROM ingredient WHERE nom = :nom');
        $prepare->bindParam(':nom', $nomingredient);
        $execute = $prepare->execute();
        if ($execute == FALSE)
            return null;
        return $prepare->fetchAll();
    }

    public function get_unite_id($nomunite)
    {
        $prepare = $this->pdo->prepare('SELECT id FROM unite WHERE nom = :nom');
        $prepare->bindParam(':nom', $nomunite);
        $execute = $prepare->execute();
        if ($execute == FALSE)
            return null;
        return $prepare->fetchAll();
    }

    public function set_melange($idcocktail, $idingredient, $idunite, $quantite)
    {
        $prepare = $this->pdo->prepare('INSERT INTO melange(cocktail, ingredient, unite, quantité) VALUES (:cocktail, :ingredient, :unite, :quantite)');
        $prepare->bindParam(':cocktail', $idcocktail);
        $prepare->bindParam(':ingredient', $idingredient);
        $prepare->bindParam(':unite', $idunite);
        $prepare->bindParam(':quantite', $quantite);
        return $prepare->execute();
    }

    public function delete_cocktail($nomcocktail)
    {
        $prepare = $this->pdo->prepare('DELETE FROM cocktail WHERE nom = :nom');
        $prepare->bindParam(':nom', $nomcocktail);
        return $prepare->execute();
    }
}
