<?php
session_start();
$template = 'article';
$title = "ADMIN";
require 'Functions/functions.php';
require 'Functions/bdd.php';
if (isset($_SESSION['email']) && $_SESSION['email'] === 'admin@gmail.com') {
} else {
    header("Location: accueil.php");
}

//RAMENER LES INFO D'UNE COLONNE
$verif_projet = $pdo->prepare("SELECT * FROM projet order by num_projet DESC");
$verif_projet->execute();

$numero_projet = $pdo->prepare("SELECT * FROM projet WHERE num_projet=:num_projet");
$compter = $numero_projet->rowCount();


if (isset($_GET['supp_projet'])) {
    /* suppresion du projet dans la table "projet" */
    $req = $pdo->prepare("DELETE FROM projet WHERE num_projet =:num_projet ");
    $req->bindValue(':num_projet', $_GET['supp_projet']);
    $req->execute();

    echo "Le projet numéro " . $_GET["supp_projet"] . " a éte supprimer.";
}


include 'adminer.phtml';
