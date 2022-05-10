<?php
session_start();
require 'Functions/bdd.php';
require 'Functions/functions.php';
$template = 'forum';
$title = 'FORUM';
if (isset($_POST['pseudo'])) {
    $_SESSION['pseudo'] = $_POST['pseudo'];
}
if (isset($_SESSION['pseudo'], $_POST['comment'])) {
    $req = $pdo->prepare("insert into comments(pseudo,comment) values (:pseudo,:comment)");
    $req->bindValue(':pseudo', $_SESSION['pseudo']);
    $req->bindValue(':comment', $_POST['comment']);
    $req->execute();
}
if (isset($_SESSION['email'])) {
    $req = $pdo->prepare("SELECT * FROM comments ORDER BY comment_set");
    $req->execute();
    $comments = $req->fetchAll(PDO::FETCH_ASSOC);
    include 'index.phtml';
} else {
    header("Location: accueil.php");
}
