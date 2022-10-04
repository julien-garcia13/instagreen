<?php
session_start();
// Section pour les erreurs (logs)
error_reporting(-1); // Montre tous les erreurs
ini_set("display_errors", "1");
ini_set("log_errors", 1);
ini_set("error_log", "php-error.log"); // Fichier du log
// Fin de section
if(!isset($_SESSION['id']))
{
  header('Location:../../index.php');
  die(); // Inaccesibilité en cas de session absente ou fausse. Redirection vers la page de connexion. ❌
}
require_once('../config.php'); // On appelle la base de données.
include('../class/class-panier.php');
$db = new bdd(); // On appelle la class bdd.
$panier = new panier($db);
$produits = $db->query('SELECT * FROM `produit` ORDER BY id DESC');
// Pour Stripe
require_once('../../vendor/autoload.php');
$prix = $panier->prixTotal();
if($prix <=0)
{
  header("../erreur-paiement.php");
}
// Instance Stripe
\Stripe\Stripe::setApiKey('//Clé secrète'); // Clé secrète
$intention = \Stripe\PaymentIntent::create(['amount' => $prix*100, 'currency' => 'eur']);
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image" href="../../images/favicon.ico">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Shippori+Antique+B1&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../../css/boutique.css"/>
    <link rel="stylesheet" type="text/css" href="../../css/responsive.css"/>
    <link rel="stylesheet" type="text/css" href="../../css/style.css"/>
    <title>Procéder au paiement de vos articles</title>
  </head>
  <body>
    <main>
      <div class="logo-zone">
        <img class="logo-co" src="../../images/logo.png"/></a>
      </div>
      <div class="paiement-titre-zone">
        <p1 class="paiement-titre">Procéder au paiement de vos articles</p1>
      </div>
      <div class="margin-vide"></div>
      <section class="cart">
      <!-- Paiement -->
      <div class="col-lg-5">
        <div class="card bg-primary text-white rounded-3">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h5 class="mb-0">Détails de la carte</h5>
            </div>
              <div class="form-outline form-white mb-4">
                <form action="traitement/paiement.php" method="POST">
                <div id="errors"></div> <!-- Contient les erreurs lors du paiement -->
                  <input type="text" id="cardholder-name" class="form-control form-control-lg" placeholder="Elon Musk" required/>
                  <label class="form-label" for="cardholder-name">Titulaire de la carte</label>
                  <h6 class="mb-0">NOTE : Pour passez le paiement, mettez 4242 4242 4242 4242 pour la CB, le reste c'est à vous de choisir.</h6>
                </div>
                <div id="card-elements"></div> <!-- Formulaire des infos de la carte -->
                <div id="card-errors" role="alert"></div> <!-- Erreurs liés à la carte -->
                  <hr class="my-4">
                  <div class="d-flex justify-content-between mb-4">
                    <p class="mb-2">Total</p>
                    <p class="mb-2"><?= number_format($panier->prixTotal(),2,',',' '); ?> €</p>
                  </div>
                    <div class="d-flex justify-content-between">
                      <button class="btn btn-info btn-block btn-lg" id="card-button" type="button" data-secret="<?= $intention['client_secret'] ?>">Payez</button>
                    </div>
                  </button>
                </form>
            </div>
          </div>
        </div>
        <div class="col-lg-5">
        <div class="card bg-primary text-white rounded-3">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h5 class="mb-0">Récapitulatif de la commande</h5>
            </div>
            <?php
            $idProduits = array_keys($_SESSION['panier']);
            // Pour accéder au panier vide sans erreur.
            if(empty($idProduits))
            {
              $produits = array();
            }
            else // Sinon ça fonctionne normalement
            {
              $produits = $db->query('SELECT * FROM `produit` WHERE id IN ('.implode(',',$idProduits).')');
            }
            foreach($produits as $produit): // Une boucle est crée pour afficher le nom, image, description et prix des produits via la base de données (mais surtout choisi dans le panier)
            ?>
            <div class="form-outline form-white mb-4">
              <form action="traitement/tcommande.php" method="POST">
                <div class="d-flex flex-row align-items-center">
                  <!-- Image du produit -->
                  <div>
                    <img src="../../<?= $produit->img ?>" class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;"/>
                  </div>
                  <div class="ms-3">
                    <!-- Nom du produit -->
                    <h5><?= $produit->nom ?></h5>
                    <!-- Description -->
                    <p class="small mb-0"><?= substr($produit->description, 0, 40); ?>...</p>
                    <?php endforeach; ?> <!-- Fin de la boucle -->
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
      <!-- Script JavaScript et Stripe -->
      <script src="https://js.stripe.com/v3/"></script>
      <script src="../../js/boutique.js"></script>
  </body>
</html>
