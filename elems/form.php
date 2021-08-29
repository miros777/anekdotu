<h2>У вас есть возможность добавить авторский анетдот</h2>
<form action='' method='post' class='form__addpost' <?= $style ?>>

    <div class="form-group">
        <lable>Заголовок</lable>
        <input type='text' name='title' value='<?= $title ?? null; ?>' placeholder='Заголовок'>
    </div>

    <div class="form-group">
        <lable>Тема анекдота</lable>
        <select name='cat_id'>";
            <?php
            foreach ($category as $one) {
                echo "<option value={$one['id']}>{$one['name']}</option>";
            };
            ?>
        </select>
    </div>

    <div class="form-group">
        <lable>Текст анекдота</lable>
        <textarea name='text' cols='30' rows='10' placeholder='Введите текст анекдота'><?= $text ?? null; ?></textarea>
    </div>

    <input type='submit' value='Отправить'>
</form>
