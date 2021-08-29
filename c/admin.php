<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 25.08.2021
 * Time: 18:15
 */

$db = new m\BD\BD();

//authorization
if(authCheck() == false){
    header('Location: index.php?view=login&c=login');
};

if (isset($_GET['del']) and isset($_GET['id'])) {
    $db->query("DELETE FROM posts WHERE id={$_GET['id']}");
    $_SESSION['mess'] = [
        "text" => "Анекдот c id {$_GET['id']} удален!"
    ];
    header('Location: index.php?view=admin&c=admin');
}

if (isset($_GET['public']) and isset($_GET['id'])) {
    $db->query("UPDATE posts SET post_status={$_GET['public']} WHERE id={$_GET['id']}");
    if($_GET['public'] == 0){
        $_SESSION['mess'] = [
            "text" => "Анекдот c id {$_GET['id']} деактивирован!"
        ];
        header('Location: index.php?view=admin&c=admin');
    }else {
        $_SESSION['mess'] = [
            "text" => "Анекдот c id {$_GET['id']} размещен!"
        ];
        header('Location: index.php?view=admin&c=admin');
    }
}

$category = $db->query("SELECT posts.id, posts.title, posts.text, posts.post_status, posts.cat_id, name FROM posts LEFT JOIN category ON cat_id=category.id")->fetchAll();

$mainContent = getTemp('admin', $vars = [
    'contentTable' => $category
]);

$titlePage = 'Admin panel';