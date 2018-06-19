<?php include '../settings_db_rb.php';
if(!isset($_SESSION['logged_user']) or $_SESSION['logged_user']['category_users_id'] <= 3){
    header('Location: /');
}
include 'header_admin.php';

$limit = 5;
$dicts = R::find('dict_services', ' LIMIT :limit ',
    array(
        ':limit' => $limit
    ));
?>
<div class="container">
    <p><a href="admin.php"><- Back</a></p>
    <br>
    <div class="row">
        <div class="col-md-6"><h3>Dictionary of Services</h3></div>
        <div class="col-md-6"><div class="row text-right"><a href="add_service.php">Add</a></div></div>
    </div>
    <hr>
    <br>
    <div class="row">
        <div class="col-md-1">ID</div>
        <div class="col-md-2">Type</div>

    </div>
    <hr>
    <?php
        foreach ($dicts as $dict_row){
            echo ('
                <div class="row">
                    <div class="col-md-1">'.$dict_row['id'].'</div>
                    <div class="col-md-2"><a href="edit_services.php?id='.$dict_row["id"].'">'.$dict_row['type'].'</a></div>
                </div>
                <hr>
            ');
        }
    ?>
</div>