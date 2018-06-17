<?php include 'settings_db_rb.php';
include 'templates/header_index.php';

$id = $_GET['id'];

$post = R::findOne('posts', 'WHERE status = 1 AND id = :id',
    array(
        ':id' => $id
    ));
if ($post){
    echo($post['title'].'<br>');
    echo($post['text']);
}
else {
    header('Location: /');
}

