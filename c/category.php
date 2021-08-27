<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 26.08.2021
 * Time: 12:38
 */

//  menu category
$allCategory = $db->query("SELECT * FROM category")->fetchAll();

foreach ($allCategory as $cat) {

    $result = $db->query("SELECT COUNT(cat_id) AS count_posts from posts WHERE cat_id={$cat['id']} AND post_status=1")->fetchAll();
    $count_posts_cat  = $result[0]['count_posts'];
    $active = "";
    if (isset($_GET['cat_id'])) {
        if ($_GET['cat_id'] == $cat['id']) {
            $active = " class='active'";
        }
    }
    $menuCategoryLink[] = "<a href=\"?cat_id={$cat['id']}&page=1&view=category&c=$controller\"$active>{$cat['name']} ($count_posts_cat)</a>";
}

//all posts

if (isset($_GET['page'])) {
    $count_post = 3;
    $page_num = $_GET['page'];
    $max = $page_num * $count_post;
    $min = $max - $count_post;
}

if (isset($_GET['cat_id'])) {
    $category = $db->query("SELECT title,text,cat_id,category.name FROM posts LEFT JOIN category ON  posts.cat_id = category.id WHERE cat_id={$_GET['cat_id']} AND post_status=1 LIMIT $min,$count_post")->fetchAll();

    //пагинация
    $result = $db->query("SELECT COUNT(cat_id) AS count_posts from posts WHERE cat_id={$_GET['cat_id']} AND post_status=1")->fetchAll();
    $all_pages = ceil($result[0]['count_posts'] / $count_post);
}

if(isset($_GET['view']) and $_GET['view'] == "all-posts"){
    $category = $db->query("SELECT title,text,cat_id,category.name FROM posts LEFT JOIN category ON  posts.cat_id = category.id WHERE post_status=1 LIMIT $min,$count_post")->fetchAll();

    //пагинация
    $result = $db->query("SELECT COUNT(cat_id) AS count_posts from posts WHERE post_status=1")->fetchAll();
    $all_pages = ceil($result[0]['count_posts'] / $count_post);
}

switch($_GET['view'] ?? null){
    case('category'):
        $temp = 'category';
        $titlePage = 'Cat page';
        break;
    case('all-posts'):
        $temp = 'all-posts';
        $titlePage = 'All posts';
        break;
    default:
        $temp = 'home';
};

$mainContent = getTemp($temp, $vars = [
    'getCategory' => $category, // Категория по cat_id из $_GET параметра
    'pagination' => $all_pages, // Пагинация по cat_id из $_GET параметра
    'menuCategory' => $menuCategoryLink // Пагинация по cat_id из $_GET параметра
]);
