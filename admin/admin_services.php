<?php include '../settings_db_rb.php';
if(!isset($_SESSION['logged_user']) or $_SESSION['logged_user']['category_users_id'] <= 2){
    header('Location: /');
}
include 'header_admin.php';

$limit = 5;
$services = R::find('services', ' LIMIT :limit ',
    array(
        ':limit' => $limit
    ));
$type = R::find('dict_services');
?>
<div class="container">
    <p><a href="admin.php"><- Back</a></p>
    <br>
    <div class="row">
        <div class="col-md-6"><h3>Services</h3></div>
        <div class="col-md-6"><div class="row text-right"><a href="add_service.php">Add</a></div></div>
    </div>
    <hr>
    <br>
    <div class="row">
        <div class="col-md-1">ID</div>
        <div class="col-md-3">Title</div>
        <div class="col-md-4">Description</div>
        <div class="col-md-2">Category</div>
        <div class="col-md-2">Price</div>
    </div>
    <hr>
    <?php
    foreach ($services as $service_row){
        foreach ($type as $type_row) {
            if ($service_row['category_services_id'] == $type_row['id']) {
                $service_row['category_services_id'] = $type_row['type'];
                break;
            }
        }
        $service_row['description'] = mb_strimwidth($service_row['description'], 0, 250, "...");
        echo ('

    <div class="row">
        <div class="col-md-1">'.$service_row['id'].'</div>
        <div class="col-md-3"><a href="edit.php?id='.$service_row["id"].'">'.$service_row['title'].'</a></div>
        <div class="col-md-4"><a href="edit.php?id='.$service_row["id"].'">'.$service_row['description'].'</a></div>
        <div class="col-md-2">'.$service_row['category_services_id'].'</div>
        <div class="col-md-2">'.$service_row['price'].'</div>
    </div>
    <hr>

');
    }

    ?>
</div>