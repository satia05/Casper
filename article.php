<?php
$template = 'article';
$tilte = 'Gestion des articles';
include 'adminer.phtml';
require 'Functions/bdd.php';
require 'Functions/functions.php';

if (isset($_GET['projet'])) {
    $requete = $pdo->prepare("select * from projet where num_projet=:num_projet");
    $requete->bindValue(':num_projet', htmlspecialchars($_GET['projet']));
    $requete->execute();
    $res = $requete->fetchAll(PDO::FETCH_ASSOC);
    $projetTmp = $res[0];
    $projet = recuperationProjet($projetTmp);
    $template = "projet";
    $tilte = 'PROJET';
} else if (isset($_SESSION["email"], $_GET['delete']) && $_SESSION['email'] === 'amine@gmail.com') {
    $requete = $pdo->prepare("delete from articles where code=:code");
    $requete->bindValue(':code', htmlspecialchars($_GET['delete']));
    $requete->execute();
    $tilte = 'PROJET';
    header("Location: shop.php");
}
