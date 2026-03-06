<?php
session_start();

$pdo = new PDO(
    "mysql:host=localhost;dbname=annuaire;charset=utf8",
    "root",
    ""
);
