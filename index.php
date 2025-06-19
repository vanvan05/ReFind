<?php

$controller = $_GET['c'] ?? 'Home';
$method     = $_GET['m'] ?? 'index';

// Cek apakah file controller ada
$controllerFile = 'controller/' . $controller . '.class.php';
if (!file_exists($controllerFile)) {
    echo "Controller '$controller' tidak ditemukan.";
    exit;
}

require_once "controller/Controller.class.php";
require_once "controller/$controller.class.php";


// Buat instance controller
$c = new $controller;

// Cek apakah method ada di controller
if (!method_exists($c, $method)) {
    echo "Method '$method' tidak ditemukan di controller '$controller'.";
    exit;
}

//run!
$c->$method();