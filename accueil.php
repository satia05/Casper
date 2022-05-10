<?php
session_start();
$template = "accueil";
$title = "ACCUEIL";
require 'Functions/bdd.php';
require 'Functions/functions.php';
include 'index.phtml';
