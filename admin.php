<?php include 'settings_db_rb.php';
/*
 * Выдает список статей, по нажатию на которую перенаправляет на edit.php
 * Кнопка создать статью, выдает форму для создания статьи
 * В случае, если не авторизован, сообщается об этом и ничего не выводит
 */
if(!isset($_SESSION['logged_user']) or $_SESSION['logged_user']['category_users_id'] == 1){
    header('Location: /');
}
include 'templates/header_admin.php';

?>
<br>
<div class="container">
    <div class="row">
        <div class="col-md-12">Choose what you want change</div>
    </div>
    <div class="row">
        <div class="col-md-3"><a href="admin_posts.php"><h4>News</h4></a></div>
        <div class="col-md-3"><h4>Services</h4></div>
        <div class="col-md-3"><h4>Analysis</h4></div>
        <div class="col-md-3"><h4>Persons</h4></div>
    </div>
    <div class="row">
        <div class="col-md-6 align-center"><h5>Dict of Services</h5></div>
        <div class="col-md-6 align-center"><h5>Dict of Analysis</h5></div>
    </div>
</div>
