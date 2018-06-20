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
    <br>
    <div class="row">
        <div class="col-md-4"><p class="back"><a href="admin.php"><i data-feather="chevron-left"></i>Back</a></p></div>
        <div class="col-md-4"><h3 class="text-center"><i data-feather="edit"></i> Dictionary of Services</h3></div>
        <div class="col-md-4"><a href="add_service.php"><p class="add"><i data-feather="plus"></i>Add</p></a></div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-1">ID</div>
        <div class="col-md-11">Type</div>
    </div>
    <hr>
    <?php
        foreach ($dicts as $dict_row){
            echo ('
                <div class="row">
                    <div class="col-md-1">'.$dict_row['id'].'</div>
                    <div class="col-md-11"><a href="edit_services.php?id='.$dict_row["id"].'">'.$dict_row['type'].'</a></div>
                </div>
                <hr>
            ');
        }
    ?>
</div>
<?php include 'footer_admin.php'; ?>