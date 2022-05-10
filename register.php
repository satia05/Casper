<?php
require 'Functions/bdd.php';
require 'Functions/functions.php';
session_start();

$template = "login_register";
$title = "REGISTER";
$register = true;

if (isset($_POST['mail'], $_POST['mdp'])) {
    try {
        $requete = $pdo->prepare("insert into customer(email,password) value (:email,:pwd);");
        $requete->bindValue(':email', htmlspecialchars($_POST['mail']));
        $requete->bindValue(':pwd', hashPassword(htmlspecialchars($_POST['mdp'])));
        $requete->execute();
        $signUp = true;
    } catch (Exception $e) {
        $error = true;
    }
}
include 'index.phtml';
