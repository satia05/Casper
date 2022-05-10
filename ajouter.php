<?php
session_start();
$template = 'article';
$title = "ADMIN";
require 'Functions/functions.php';
require 'Functions/bdd.php';

if(isset($_POST, $_POST['code'])){
    $requete = $pdo->prepare("insert into articles(code,stock,nom,prix,description,img) value (:code,:stock,:nom,:prix,:desc,:img);");
    $requete->bindValue(':code', htmlspecialchars($_POST['code']));
    $requete->bindValue(':stock', htmlspecialchars($_POST['stock']));
    $requete->bindValue(':nom', htmlspecialchars($_POST['nom']));
    $requete->bindValue(':prix', htmlspecialchars($_POST['prix']));
    $requete->bindValue(':desc', htmlspecialchars($_POST['description']));
    $requete->bindValue(':img', htmlspecialchars($_POST['liens']));
    $requete->execute();
    $ajout = true;
}

include 'adminer.phtml';