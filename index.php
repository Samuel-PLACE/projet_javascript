<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Titre de la page</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="js/vendor/jquery-3.2.1.min.js"></script>
    <script src="js/script.js"></script>
</head>
<body>
<!-- Lorsqu'une personne n'est pas connecté -->
<button id="inscription-button" style="display:none">S'inscrire</button>
<button id="connexion-button" style="display:none">Se connecter</button>
<form id="inscription-form" action="inscription.php" method="post" style="display:none">
    <label for="nom_inscription">Nom</label>
    <input id="nom_inscription" name="nom" type="text"/>
    <br/>
    <label for="prenom_inscription">Prenom</label>
    <input id="prenom_inscription" name="prenom" type="text">
    <br/>
    <label for="age_inscription">Age</label>
    <input id="age_inscription" name="age" type="number"/>
    <br/>
    <label for="email_inscription">E-mail</label>
    <input id="email_inscription" name="email" type="email"/>
    <br/>
    <label for="password_inscription">Mot de Passe</label>
    <input id="password_inscription" name="password" type="password"/>
    <br/>
    <button id="inscription_submit" type="submit">Envoyer</button>
</form>
<form id="connexion-form" action="connexion.php" method="post" style="display:none">
    <label for="email_connexion">E-mail</label>
    <input id="email_connexion" name="email" type="email"/>
    <br/>
    <label for="password_connexion">Mot de Passe</label>
    <input id="password_connexion" name="password" type="password"/>
    <br/>
    <button id="connexion_submit" type="submit">Envoyer</button>
</form>

<!-- Lorsqu'une personne est connecté -->
<form id="liste_cocktail-form" action="list_cocktail.php" method="post" style="display: none">
    <button type="submit">Afficher la liste des cocktails</button>
</form>
<form id="deconnexion-form" action="deconnexion.php" method="post" style="display:none">
    <button type="submit">Se déconnecter</button>
</form>
<form id="ingredient_cocktail-form" action="list_ingredient.php" method="post" style="display: none">

</form>

</body>
</html>