<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<style>
    table {
        border-collapse: collapse;
    }

    table td {
        border: 1px solid green;
        padding: 10px;
    }
</style>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');

//    BD connect
$host = 'localhost';
$user = 'root';
$password = '';
$bdName = 'anekdotu';

$link = mysqli_connect($host, $user, $password, $bdName);
mysqli_query($link, "SET NAMES 'utf8'");

if(!session_start()){
    session_start();
}

if (isset($_SESSION['mess'])) {
    echo "<p style='color: red'>{$_SESSION['mess']['text']}</p>";
    $_SESSION['mess']['text'] = '';
}

if (isset($_GET['del']) and isset($_GET['id'])) {
    $query = "DELETE FROM posts WHERE id={$_GET['id']}";
    $res = mysqli_query($link, $query) or die(mysqli_error($link));
    $_SESSION['mess'] = [
        "text" => "Анекдот c id {$_GET['id']} удален!"
    ];
    header('Location: login.php');
}

if (isset($_GET['public']) and isset($_GET['id'])) {
    $query = "UPDATE posts SET post_status={$_GET['public']} WHERE id={$_GET['id']}";
    $res = mysqli_query($link, $query) or die(mysqli_error($link));
    if($_GET['public'] == 0){
        $_SESSION['mess'] = [
            "text" => "Анекдот c id {$_GET['id']} деактивирован!"
        ];
        header('Location: login.php');
    }else {
        $_SESSION['mess'] = [
            "text" => "Анекдот c id {$_GET['id']} размещен!"
        ];
        header('Location: login.php');
    }


}




$query = "SELECT posts.id, posts.title, posts.text, posts.post_status, posts.cat_id FROM posts LEFT JOIN category ON cat_id=category.id";
$res = mysqli_query($link, $query) or die(mysqli_error($link));
$category = mysqli_fetch_all($res, MYSQLI_ASSOC);
//var_dump($category);
?>
<table>
    <tr>
        <th>Заголовок</th>
        <th>Анекдот</th>
        <th>Статус</th>
        <th>Одобрить</th>
        <th>Удалить</th>
    </tr>

    <?php
    foreach ($category as $one) {
        $textarea = mb_strimwidth($one['text'], 0, 60, "...");
        echo "<tr>";
        echo "<td>{$one['title']}</td>";
        echo "<td>$textarea</td>";

        if ($one['post_status'] == 1) {
            echo "<td style='color: green'>Размещено !</td>";
        } else {
            echo "<td style='color: grey'>Не Размещено !</td>";
        }

        if ($one['post_status'] == 0) {
            echo "<td><a href='?public=1&id={$one['id']}'>Разместить</a></td>";
        }else{
            echo "<td><a href='?public=0&id={$one['id']}'>Деактивировать</a></td>";
        }

        echo "<td><a href='?del&id={$one['id']}'>Удалить</a></td>";
        echo "</tr>";
    }
    ?>
</table>


</body>
</html>


<?php


//размещение поста
//echo session_save_path();

