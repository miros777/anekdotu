<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 25.08.2021
 * Time: 18:32
 */
include_once  "../m/BD.php";
$db = new BD();
//var_dump($db);
$category = $db->query("SELECT * FROM category")->fetchAll();
//return $category;
//$db->query("SELECT * FROM category")->fetchAll();