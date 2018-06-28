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
    if($_SESSION['logged_user']['category_users_id'] >= 3 and $_SESSION['logged_user']['category_users_id'] < 5) :
    ?>
</div>
        <div class="about" style="margin-top: -32px">
            <div class="container information">
                <div class="row centered">
                    <br><br>
                    <h3> What you want to change or create?</h3>
                </div>
            </div>
        </div>
<br>
<div class="container">
    <?php
    endif;
    ?>
    <div class="row text-center">
        <? if($_SESSION['logged_user']['category_users_id'] == 2) :        ?>
        <div class="col-md-3"><a href="add_post.php"><h4>Add News</h4></a></div>
        <div class="col-md-3"><a href="edit_post.php"><h4>Edit News</h4></a></div>
        <?php
        elseif ($_SESSION['logged_user']['category_users_id'] >= 3 and $_SESSION['logged_user']['category_users_id'] < 5) :
        ?>
        <div class="col-md-3"><a href="admin_posts.php"><h4>News</h4></a></div>
        <div class="col-md-3"><a href="admin_services.php"><h4>Services</h4></a></div>
        <div class="col-md-3"><a href="admin_analysis.php"><h4>Analysis</h4></a></div>
        <div class="col-md-3"><a href="admin_persons.php"><h4>Persons</h4></a></div>
        <div class="col-md-3"><a href="admin_orders.php"><h4>Orders</h4></a></div>
        <?php
        elseif ($_SESSION['logged_user']['category_users_id'] == 5):
        ?>
            <div class="col-md-3"><a href="admin_orders.php"<h4>Orders</h4></a></div>
        <? endif;
    if ($_SESSION['logged_user']['category_users_id'] == 4):    ?>
        <div class="col-md-3"><a href="admin_dict_services.php"><h4>Dict of Services</h4></a></div>
        <div class="col-md-3"><a href="admin_dict_analysis.php"><h4>Dict of Analysis</h4></a></div>
    <?php
    endif;
    ?>
    </div>
</div>
