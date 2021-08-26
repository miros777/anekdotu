<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 25.08.2021
 * Time: 18:21
 */

echo "ff";
$mess = [];
if (isset($_POST) and !empty($_POST)) {

    $title = mysqli_real_escape_string($link, $_POST['title']);
    $text = mysqli_real_escape_string($link, $_POST['text']);
    $cat_id = $_POST['cat_id'];

//    validation cat
    if (!preg_match("#[А-Яа-яЁё]#u", $title)) {
        var_dump(preg_match("#[А-Яа-яЁё]#u", $title));
        $mess['err_title'] = "Не корректный title.";
    } elseif (!preg_match("#[А-Яа-яЁё]#u", $text)) {
        $mess['err_text'] = "Не может быть пустое текстовое поле.";
    } else {
        $db->query("INSERT INTO posts (title, text, cat_id, post_status) VALUE ('$title', '$text', '$cat_id', 0)");
        $_SESSION['mess'] = [
            "text" => "Ваш Анекдот на модерации!"
        ];
        header('Location: index.php?complete');
    }

    if (!empty($mess)) {
        foreach ($mess as $one_mes) {
            echo "<p style='color:red'>$one_mes<p>";
        }
    }
}
?>

<form action="" method="post" class="form__addpost">
    <input type="text" name="title" value="<?= $title ?? null; ?>" placeholder="Заголовок">

    <?php
//    var_dump($category);
//    $category = $db->query("SELECT * FROM category")->fetchAll();
    ?>
    <select name="cat_id">
        <?php
        foreach ($category as $one) {
            echo "<option value=\"{$one['id']}\">{$one['name']}</option>";
        }
        ?>
    </select>
    <textarea name="text" cols="30" rows="10" placeholder="Введите текст анекдота"><?= $text ?? null; ?></textarea>
    <input type="submit" value="Отправить">
</form>