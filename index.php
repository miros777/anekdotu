<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
session_start();

include_once "m/BD.php";
include_once("m/function.php");

$db = new BD();

if (isset($_SESSION['mess'])) {
    echo "<p class='error-mess'>{$_SESSION['mess']['text']}</p>";
    $_SESSION['mess']['text'] = '';
}

$controller = $_GET['c'] ?? 'home';
include_once("c/$controller.php");


$topMenu = getElem('top-menu', $vars = []);
$footer = getElem('footer', $vars = []);

echo getTemp('root', $vars = [
    'topMenu' => $topMenu,
    'content' => $mainContent ?? null,
    'footer' => $footer ?? null,
    'title' => $titlePage ?? null
]);

//file_put_contents('test', getTemp('root', $vars = [
//    'topMenu' => $topMenu,
//    'content' => $mainContent ?? null,
//    'footer' => $footer ?? null,
//    'title' => $title2 ?? null
//]));


