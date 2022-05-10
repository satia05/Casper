<?php
session_start();
$template = 'article';
$title = "ADMIN";
require 'Functions/functions.php';
require 'Functions/bdd.php';

if (isset($_POST, $_POST['code'])) {
    $requete = $pdo->prepare("update articles set stock=:stock, nom=:nom, prix=:prix, description=:desc, img=:img where code=:code;");
    $requete->bindValue(':code', htmlspecialchars($_POST['code']));
    $requete->bindValue(':stock', htmlspecialchars($_POST['stock']));
    $requete->bindValue(':nom', htmlspecialchars($_POST['nom']));
    $requete->bindValue(':prix', htmlspecialchars($_POST['prix']));
    $requete->bindValue(':desc', htmlspecialchars($_POST['description']));
    $requete->bindValue(':img', htmlspecialchars($_POST['liens']));
    $requete->execute();
    $modify = true;
}
$verif_projet = $pdo->prepare("SELECT * FROM projet order by num_projet DESC");
$verif_projet->execute();

$numero_projet = $pdo->prepare("SELECT * FROM projet WHERE num_projet=:num_projet");
$compter = $numero_projet->rowCount();

if (isset($_POST['num_projet'])) {
    // si num projet n'est pas vide, fait une table array projet
    $insert = $requete->execute(array(
        'num_projet' => $_POST['num_projet'],
        'nom' => $_POST['nom'],
        'lien' => htmlspecialchars($_POST['lien']),
        'description' => $_POST['description']

    ));
}
include 'adminer.phtml';
