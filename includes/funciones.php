<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function esUltimo(string $actual, string $proximo): bool{
    if($actual !== $proximo){
        return true;
    }
    return false;
}

// function que revisa que el usuario este autencticado
function isAuth() : void {
    if(!isset($_SESSION['login'])){
        header('Location: http://localhost:3000/public/');
    }
}

function isAdmin() : void {
    if(!isset($_SESSION['admin'])){
        header('Location: http://localhost:3000/public/admin');
    }
}