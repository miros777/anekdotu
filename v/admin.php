<table>
    <tr>
        <th>Заголовок</th>
        <th>Анекдот</th>
        <th>Категория</th>
        <th>Статус</th>
        <th>Одобрить</th>
        <th>Удалить</th>
    </tr>

    <?php
    foreach ($contentTable as $one) {
        $textarea = mb_strimwidth($one['text'], 0, 60, "...");
        echo "<tr>";
        echo "<td>{$one['title']}</td>";
        echo "<td>$textarea</td>";
        echo "<td>{$one['name']}</td>";

        if ($one['post_status'] == 1) {
            echo "<td style='color: green'>Размещено !</td>";
        } else {
            echo "<td style='color: grey'>Не Размещено !</td>";
        }

        if ($one['post_status'] == 0) {
            echo "<td><a href='?view=admin&c=admin&public=1&id={$one['id']}'>Разместить</a></td>";
        } else {
            echo "<td><a href='?view=admin&c=admin&public=0&id={$one['id']}'>Деактивировать</a></td>";
        }

        echo "<td><a href='?view=admin&c=admin&del&id={$one['id']}'>Удалить</a></td>";
        echo "</tr>";
    }
    ?>
</table>

