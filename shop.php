<?php
require 'Functions/bdd.php';
require 'Functions/functions.php';
session_start();
$template = "shop";
$title = "SHOP";
$chart = true;

if (isset($_GET['add'])) {
    $requete = $pdo->prepare("select * from articles where code=:code");
    $requete->bindValue(':code', htmlspecialchars($_GET['article']));
    $requete->execute();
    $res = $requete->fetchAll(PDO::FETCH_ASSOC);
    $articleV1 = $res[0];
    $article = recuperationArticle($articleV1);
    array_push($_SESSION['cart'], $article);
}

$req = $pdo->prepare("select * from articles;");
$req->execute();
$results = $req->fetchAll(PDO::FETCH_ASSOC);
if (isset($_GET['article'])) {
    $requete = $pdo->prepare("select * from articles where code=:code");
    $requete->bindValue(':code', htmlspecialchars($_GET['article']));
    $requete->execute();
    $res = $requete->fetchAll(PDO::FETCH_ASSOC);
    $articleV1 = $res[0];
    $article = recuperationArticle($articleV1);
    $template = "oneShop";
    // array_push($_SESSION['cart'], $_GET['id']);
} else if (isset($_SESSION["email"], $_GET['delete']) && $_SESSION['email'] === 'admin@gmail.com') {
    $requete = $pdo->prepare("delete from articles where code=:code");
    $requete->bindValue(':code', htmlspecialchars($_GET['delete']));
    $requete->execute();
    header("Location: shop.php");
} else if (isset($_SESSION["email"], $_GET['modify']) && $_SESSION['email'] === 'admin@gmail.com') {
    $requete = $pdo->prepare("select * from articles where code=:code");
    $requete->bindValue(':code', htmlspecialchars($_GET['modify']));
    $requete->execute();
    $res = $requete->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION["modify"] = $res[0];
    header("Location: modifier.php");
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
include 'index.phtml';
