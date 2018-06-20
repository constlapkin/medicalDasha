<?php include '../settings_db_rb.php';
if(!isset($_SESSION['logged_user']) or $_SESSION['logged_user']['category_users_id'] <= 2){
    header('Location: /');
}
include 'header_admin.php';

$limit = 5;
$users = R::find('users', ' LIMIT :limit ',
    array(
        ':limit' => $limit
    ));
$type = R::find('dict_users');
?>
<div class="container">
    <br>
    <div class="row">
        <div class="col-md-4"><p class="back"><a href="admin.php"><i data-feather="chevron-left"></i>Back</a></p></div>
        <div class="col-md-4"><h3 class="text-center"><i data-feather="edit"></i> Persons</h3></div>
        <div class="col-md-4"><a href="add_person.php"><p class="add"><i data-feather="plus"></i>Add</p></a></div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-1">ID</div>
        <div class="col-md-2">First Name</div>
        <div class="col-md-1">Last Name</div>
        <div class="col-md-2">Phone</div>
        <div class="col-md-2">E-mail</div>
        <div class="col-md-2">Join Date</div>
        <div class="col-md-2">Category</div>
    </div>
    <hr>
    <?php
    foreach ($users as $user_row){
        foreach ($type as $type_row) {
            if ($user_row['category_users_id'] == $type_row['id']) {
                $user_row['category_users_id'] = $type_row['type'];
                break;
            }
        }
        echo ('

    <div class="row">
        <div class="col-md-1">'.$user_row['id'].'</div>
        <div class="col-md-2"><a href="edit_person.php?id='.$user_row["id"].'">'.$user_row['first_name'].'</a></div>
        <div class="col-md-1"><a href="edit_person.php?id='.$user_row["id"].'">'.$user_row['last_name'].'</a></div>
        <div class="col-md-2">'.$user_row['phone'].'</div>
        <div class="col-md-2">'.$user_row['email'].'</div>
        <div class="col-md-2">'.$user_row['join_date'].'</div>
        <div class="col-md-2">'.$user_row['category_users_id'].'</div>
    </div>
    <hr>

');
    }

    ?>
</div>
<?php include 'footer_admin.php'; ?>