<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 25.08.2021
 * Time: 18:15
 */
//ob_start();
//    include  "../m/function.php";
//    $res = ob_get_clean();
//ob_get_clean();

if(isset($_GET['view'])){
    $temp = $_GET['view'];

    switch($temp){
        case('home'):
            $temp = 'home';
            break;
        case('category'):
            $temp = 'category';
            break;
        default:
            $temp = '';
    }
    ob_start();
        include "../v/$temp.php";
    ob_get_clean();
}

