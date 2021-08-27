<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 26.08.2021
 * Time: 12:38
 */

//all posts
switch($_GET['view'] ?? null){
    case('category'):
        $temp = 'category';
        break;
    default:
        $temp = 'home';
};

if (isset($_GET['page'])) {
    $count_post = 3;
    $page_num = $_GET['page'];
    $max = $page_num * $count_post;
    $min = $max - $count_post;
}

$category = $db->query("SELECT * FROM category")->fetchAll();
$mainContent = getTemp($temp, $vars = [
    'content' => $db->query("SELECT * FROM category")->fetchAll()
//    'category' => $category ?? null
]);

$title = 'Cat page';


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
};



?>
