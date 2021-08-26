<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 25.08.2021
 * Time: 18:32
 */
include_once  "BD.php";
$db = new BD();
$category = $db->query("SELECT * FROM category")->fetchAll();