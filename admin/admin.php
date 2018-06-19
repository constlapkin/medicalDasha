<?php include '../settings_db_rb.php';
/*
 * Выдает список статей, по нажатию на которую перенаправляет на edit.php
 * Кнопка создать статью, выдает форму для создания статьи
 * В случае, если не авторизован, сообщается об этом и ничего не выводит
 */
if(!isset($_SESSION['logged_user']) or $_SESSION['logged_user']['category_users_id'] == 1){
    header('Location: /');
}
include 'header_admin.php';

?>
<br>
<div class="container">
    <?php
    if($_SESSION['logged_user']['category_users_id'] >= 3) :
    ?>
    <div class="row">
        <div class="col-md-12">Choose what you want change</div>
    </div>
    <?php
    endif;
    ?>
    <div class="row text-center">
        <?php
        if($_SESSION['logged_user']['category_users_id'] == 2) :
        ?>
        <div class="col-md-6"><a href="add_post.php"><h4>Add News</h4></a></div>
        <div class="col-md-6"><a href="edit_post.php"><h4>Edit News</h4></a></div>
        <?php
        elseif ($_SESSION['logged_user']['category_users_id'] >= 3) :
        ?>
        <div class="col-md-3"><a href="admin_posts.php"><h4>News</h4></a></div>
        <div class="col-md-3"><a href="admin_services.php"><h4>Services</h4></a></div>
        <div class="col-md-3"><a href="admin_analysis.php"><h4>Analysis</h4></a></div>
        <div class="col-md-3"><a href="admin_persons.php"><h4>Persons</h4></a></div>
        <?php
        endif;
        ?>
    </div>
    <?php
    if ($_SESSION['logged_user']['category_users_id'] >= 4):
    ?>
    <div class="row text-center">

        <div class="col-md-6"><a href="admin_dict_services.php"><h5>Dict of Services</h5></a></div>
        <div class="col-md-6"><a href="admin_dict_analysis.php"><h5>Dict of Analysis</h5></a></div>
    </div>
    <?php
    endif;
    ?>
</div>
