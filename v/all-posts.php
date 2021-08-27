<h2>Категории</h2>
<?

//menu category
echo "<ul>";
foreach ($menuCategory as $link) {
    echo "<li>$link</li>";
}
echo "</ul>";

echo "<div class='wrapper-container'>";
foreach ($getCategory as $cat) {
    echo "<div class='block'>";
    echo "<div class='block__title'>{$cat['title']}</div>";
    echo "<div class='block__cat-name'>{$cat['name']}</div>";
    echo "<p'>{$cat['text']}</p>";
    echo "</div>";
}
echo "</div>";

//пагинация
if ($pagination > 0) {
    echo "<ul>";
    for ($i = 1; $i <= $pagination; $i++) { ?>

        <li>
            <a href="<?php echo "?page=$i&view=all-posts&c=category"; ?>"<?php if ($i == $_GET['page']) {
                echo "class='active'";
            } ?>><?php echo $i; ?>
            </a>
        </li>

    <?php }
    echo "</ul>";
} else {
    echo "<p>Нет постов в этой категории!</p>";
}
