<h2>Категории</h2>

<?php
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
    echo "<li><a href=\"?cat_id={$cat['id']}&page=1&view={$_GET['view']}&c=$controller\"$active>{$cat['name']} ($count_posts_cat)</a></li>";
}
echo "</ul>";
?>

<?= $content; ?>