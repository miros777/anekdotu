<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 25.08.2021
 * Time: 18:32
 */
//include_once "BD.php";

function getTemp($filename, $vars = []){
    extract($vars);

    ob_start();
        include ("v/$filename.php");
    return ob_get_clean();
};

function getElem($filename, $vars = []){
    extract($vars);

    ob_start();
        include ("elems/$filename.php");
    return ob_get_clean();
}

function authCheck(){
    if(isset($_SESSION['auth']) and $_SESSION['auth'] == true){
        return $authStatus = true;
    } else{
        return $authStatus = false;
    }
}