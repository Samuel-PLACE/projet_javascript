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
}
