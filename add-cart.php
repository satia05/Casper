<?php
$template = "shop";
$title = "SHOP";
session_start();
array_push($_SESSION['cart'], $_GET['article']);
