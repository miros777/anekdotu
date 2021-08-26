<!doctype html>
<html lang="en">
<?php include_once "elems/head.php" ?>
<body>
<header>
    <?php include_once "elems/top-menu.php" ?>
</header>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
session_start();

include_once ("m/function.php");

if (isset($_SESSION['mess'])){
    echo "<p class='error-mess'>{$_SESSION['mess']['text']}</p>";
    $_SESSION['mess']['text'] = '';
}


if(isset($_GET['c'])){
    $controller = $_GET['c'] ?? 'home';
    include "c/$controller" . '.php';
}

?>

<!--all posts-->
<?php

if (isset($_GET['page'])) {
    $count_post = 3;
    $page_num = $_GET['page'];
    $max = $page_num * $count_post;
    $min = $max - $count_post;
}

echo "<h2>Категории</h2>";
$category = $db->query("SELECT * FROM category")->fetchAll();

echo "<ul>";
foreach ($category as $cat) {

    $result = $db->query("SELECT COUNT(cat_id) AS count_posts from posts WHERE cat_id={$cat['id']} AND post_status=1")->fetchAll();
    $count_posts_cat = $result[0]['count_posts'];
    $active = "";
    if (isset($_GET['cat_id'])) {
        if ($_GET['cat_id'] == $cat['id']) {
            $active = " class='active'";
        }
    }
    echo "<li><a href=\"?cat_id={$cat['id']}&page=1\"$active>{$cat['name']} ($count_posts_cat)</a></li>";
}
echo "</ul>";

if (isset($_GET['cat_id'])) {
    $category = $db->query("SELECT title,text,cat_id,category.name FROM posts LEFT JOIN category ON  posts.cat_id = category.id WHERE cat_id={$_GET['cat_id']} AND post_status=1 LIMIT $min,$count_post")->fetchAll();
    echo "<div class='wrapper-container'>";
    foreach ($category as $cat) {
        echo "<div class='block'>";
        echo "<div class='block__title'>{$cat['title']}</div>";
        echo "<div class='block__cat-name'>{$cat['name']}</div>";
        echo "<p'>{$cat['text']}</p>";
        echo "</div>";
    }
    echo "</div>";
    //пагинация
    $result = $db->query("SELECT COUNT(cat_id) AS count_posts from posts WHERE cat_id={$_GET['cat_id']} AND post_status=1")->fetchAll();
    $all_pages = ceil($result[0]['count_posts'] / $count_post);
    if ($all_pages > 0) {
        echo "<ul>";
        for ($i = 1; $i <= $all_pages; $i++) { ?>

            <li>
                <a href="<?php echo "?cat_id={$_GET['cat_id']}&page=$i"; ?>"<?php if ($i == $_GET['page']) {
                    echo "class='active'";
                } ?>><?php echo $i; ?>
                </a>
            </li>

        <?php }
        echo "</ul>";
    } else {
        echo "<p>Нет постов в этой категории!</p>";
    }
}

//get count=all Все посты
if (isset($_GET['page']) and isset($_GET['count']) and $_GET['count'] == 'all') {
    $category = $db->query("SELECT title,text,cat_id,category.name FROM posts LEFT JOIN category ON  posts.cat_id = category.id WHERE post_status=1 LIMIT $min,$count_post")->fetchAll();
    echo "<div class='wrapper-container'>";
    foreach ($category as $cat) {
        echo "<div class='block'>";
        echo "<div class='block__title'>{$cat['title']}</div>";
        echo "<div class='block__cat-name'>{$cat['name']}</div>";
        echo "<p'>{$cat['text']}</p>";
        echo "</div>";
    }
    echo "</div>";

    //пагинация
    $result = $db->query("SELECT COUNT(cat_id) AS count_posts from posts WHERE post_status=1")->fetchAll();
    $all_pages = ceil($result[0]['count_posts'] / $count_post);
    if ($all_pages > 0) {
        echo "<ul>";
        for ($i = 1; $i <= $all_pages; $i++) { ?>

            <li>
                <a href="<?php echo "?count=all&page=$i"; ?>"<?php if ($i == $_GET['page']) {
                    echo "class='active'";
                } ?>><?php echo $i; ?>
                </a>
            </li>

        <?php }
        echo "</ul>";
    }
}

?>
</body>
</html>
