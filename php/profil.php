<!-- Page par Jul -->
<?php
session_start();
if(!isset($_SESSION['id']))
{
    header('Location: ../index.php');
    die(); // Inaccesibilité en cas de session absente ou fausse. Redirection vers index.
}
require_once('config.php'); // On appelle la base de données.
$db = new bdd(); // On appelle la class bdd.
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image" href="../images/favicon.ico">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC&family=Dosis:wght@200&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/boutique.css"/>
    <link rel="stylesheet" type="text/css" href="../css/style.css"/>
    <title>Votre espace client - Instagreen Shop</title>
</head>
<body>
    <!-- Des headers en dépend du type d'appareil -->
    <header class="header-pc">
        <?php
        include ("header-index2.php");
        ?>
    </header>
    <header class="header-mobile">
        <?php
        include ("header-index-mobile2.php");
        ?>
    </header>
    <main>
        <div class="espace-client-titre-zone">
            <p1 class="connexion-titre">Votre espace client</p1>
        </div>
        <div class="flex">
                <div class="module-co-zone">
                    <div class="formulaire">
                        <form method="POST" action="traitement/tmodifier-profil.php">
                            <label>
                                <input type="text" name="nom" placeholder="Nom ..." maxlength="255" required><br /></input>
                            </label>
                            <label>
                                <input type="text" name="prenom" placeholder="Prénom ..." maxlength="255" required><br /></input>
                            </label>
                            <label>
                                <input type="text" name="email" placeholder="Mail ..." maxlength="255" required><br /></input>
                            </label>
                            <label>
                                <input type="text" name="adresse" placeholder="Adresse ..." maxlength="255" required><br /></input>
                            </label>
                            <label>
                                <input type="password" name="password" placeholder="Mot de passe ..." required><br /></input>
                            </label>
                            <div class="flex-button">
                                <input class="connexion" type="submit" value="Modifier" name="submit"></input>
                            </div><br />
                        </form>
                    </div>
                </div>
            </div>