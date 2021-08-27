<form action='' method='post' class='form__addpost' <?=$style?>>
    <input type='text' name='title' value='<?= $title ?? null; ?>' placeholder='Заголовок'>

    <select name='cat_id'>";
<?php
    foreach ($category as $one) {
        echo "<option value={$one['id']}>{$one['name']}</option>";
    };
?>
</select>

    <textarea name='text' cols='30' rows='10' placeholder='Введите текст анекдота'><?= $text ?? null; ?></textarea>
    <input type='submit' value='Отправить'>
</form>
