<?php include '../settings_db_rb.php';
if(!isset($_SESSION['logged_user']) or $_SESSION['logged_user']['category_users_id'] <= 3){
    header('Location: /');
}

$id = $_GET['id'];
if(!$id){
    header('Location: admin_dict_services.php');
}
$dict = R::findOne('dictservices', 'WHERE id = :id',
    array(
        ':id' => $id
    ));

$data = $_POST;

if (isset($data['submit_edit'])) {
    $errors = array();
    if (trim($data['type']) == '') {
        $errors[] = 'Enter type';
    }
    if (empty($errors)) {
        $dict = R::load('dictservices', $data['id']);
        $dict->type = $data['type'];
        R::store($dict);
        header('Location: admin_dict_services.php');
    } else {
        echo '<div style="color:red;">'.array_shift($errors).'</div><hr>';
    }
}
elseif (isset($data['submit_delete']))
{
    $dict = R::load('dictservices', $data['id']);
    R::trash($dict);

    header('Location: admin_dict_services.php');
}

include 'header_admin.php';
if ($id and isset($_SESSION['logged_user'])):
    ?>
    <div class="container">
        <p class="back"><a href="admin_dict_services.php"><i data-feather="chevron-left"></i>Back</a></p>
        <br>
        <form action="edit_dict_service.php" method="post">
            <input type="hidden" name="id" value="<? echo ($dict['id']) ?>"><br>
            <label>Title: </label><br><input type="text" name="type" value="<? echo ($dict['type'])?>"><br>
                <input class="send-admin" type="submit" value="Edit service" name="submit_edit">
                <input class="send-admin" type="submit" value="Delete service" name="submit_delete">
        </form>
    </div>
<?php
endif;
?>
<?php include 'footer_admin.php'; ?>