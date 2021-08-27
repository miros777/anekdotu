<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 25.08.2021
 * Time: 18:15
 */
//$db = new BD();
$category = $db->query("SELECT * FROM category")->fetchAll();

switch($_GET['view'] ?? null){
    case('home'):
        $temp = 'home';
        break;
    case('home-inline'):
        $temp = 'home-inline';
        $style = 'style=\'width: 100%\'';
        break;
    default:
        $temp = 'home';
};

$form = getElem('form', $vars = [
    'title' => $title ?? null,
    'text' => $text ?? null,
    'category' => $category ?? null,
    'style' => $style ?? null
]);

$mainContent = getTemp($temp, $vars = [
    'contentHome' => $form
]);

$titlePage = 'Home page';

$mess = [];
if (isset($_POST) and !empty($_POST)) {
    var_dump($_POST);

    $text = mysqli_real_escape_string($db->connection, $_POST['text']);
    $title = mysqli_real_escape_string($db->connection, $_POST['title']);
    $cat_id = $_POST['cat_id'];

//    validation cat
    if (!preg_match("#[А-Яа-яЁё]#u", $title ?? null)) {
        $mess['err_title'] = "Не корректный title.";
    } elseif (!preg_match("#[А-Яа-яЁё]#u", $text)) {
        $mess['err_text'] = "Не может быть пустое текстовое поле.";
    } else {
        $db->query("INSERT INTO posts (title, text, cat_id, post_status) VALUE ('$title', '$text', '$cat_id', 0)");
        $_SESSION['mess'] = [
            "text" => "Ваш Анекдот на модерации!"
        ];
        header('Location: index.php?complete&view=home&c=home');
    }

    if (!empty($mess)) {
        foreach ($mess as $one_mes) {
            echo "<p style='color:red'>$one_mes<p>";
        }
    }
}else{
    $title = '';
    $text = '';
};