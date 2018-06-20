<?php include '../settings_db_rb.php';
if(!isset($_SESSION['logged_user']) or $_SESSION['logged_user']['category_users_id'] <= 2){
    header('Location: /');
}

$id = $_GET['id'];
if(!$id){
    header('Location: admin_persons.php');
}
$user = R::findOne('users', 'WHERE id = :id',
    array(
        ':id' => $id
    ));

$data = $_POST;

if (isset($data['submit_edit'])) {
    $errors = array();
    if (trim($data['first_name']) == '') {
        $errors[] = 'Enter First Name';
    }
    if (trim($data['last_name']) == '') {
        $errors[] = 'Enter Last Name';
    }
    if (trim($data['phone']) == '') {
        $errors[] = 'Enter phone';
    }
    if (trim($data['email']) == '') {
        $errors[] = 'Enter email';
    }

    if (empty($errors)) {
        $user = R::load('users', $data['id']);
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->phone = $data['phone'];
        $user->email = $data['email'];
        $user->category_users_id = $data['category_users_id'];
        R::store($user);

        header('Location: admin_persons.php');
    } else {
        echo '<div style="color:red;">'.array_shift($errors).'</div><hr>';
    }
}
elseif (isset($data['submit_delete']))
{
    $user = R::load('users', $data['id']);
    R::trash($user);
    header('Location: admin_persons.php');
}
$dict = R::find('dictusers');
include 'header_admin.php';
if ($id and isset($_SESSION['logged_user'])):
    ?>
    <div class="container">
        <p class="back"><a href="admin_persons.php"><i data-feather="chevron-left"></i>Back</a></p>
        <br>
        <form action="edit_person.php" method="post">
            <input type="hidden" name="id" value="<? echo ($user['id']) ?>"><br>
            <label>First Name: </label><br><input type="text" name="first_name" value="<? echo ($user['first_name'])?>"><br>
            <label>Last Name: </label><br><input type="text" name="last_name" value="<? echo ($user['last_name'])?>"><br>
            <label>Phone: </label><br><input type="text" name="phone" value="<? echo ($user['phone'])?>"><br>
            <label>E-mail: </label><br><input type="text" name="email" value="<? echo ($user['email'])?>"><br>
            <label>Category: </label><br>
            <select class="select-admin" name="category_users_id">
                <?php foreach ($dict as $dict_row) : ?>
                    <option value="<? echo($dict_row['id']) ?>"><? echo($dict_row['type']) ?></option>
                <?php endforeach; ?>
            </select><br>
                <input class="send-admin" type="submit" value="Edit person" name="submit_edit">
                <input class="send-admin" type="submit" value="Delete person" name="submit_delete">
        </form>
    </div>
<?php
endif;
?>
<?php include 'footer_admin.php'; ?>