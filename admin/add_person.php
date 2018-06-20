<?php include '../settings_db_rb.php';
if(!isset($_SESSION['logged_user']) or $_SESSION['logged_user']['category_users_id'] <= 2){
    header('Location: /');
}

$data = $_POST;

if (isset($data['submit_create_person'])) {
    $errors = array();
    if (trim($data['first_name']) == '') {
        $errors[] = 'Enter First Name';
    }
    if (trim($data['last_name']) == '') {
        $errors[] = 'Enter Last Name';
    }
    if (trim($data['phone']) == '') {
        $errors[] = 'Enter Phone';
    }
    if (trim($data['email']) == '') {
        $errors[] = 'Enter E-mail';
    }
    if (trim($data['category_users_id']) == '') {
        $errors[] = 'Enter Category';
    }
    if (R::count('users', "phone = ?", array($data['phone'])) > 0){
        $errors[] = 'Account with this number already exists!';
    }
    if (R::count('users', "email = ?", array($data['email'])) > 0){
        $errors[] = 'Account with this mail already exists!';
    }
    if (($data['password']) == ''){
        $errors[] = 'Enter password';
    }
    if ($data['password_check'] != $data['password']){
        $errors[] = 'Passwords do not match';
    }

    if (empty($errors)) {
        $user = R::dispense('users');
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->phone = $data['phone'];
        $user->email = $data['email'];
        $user->category_users_id = $data['category_users_id'];
        $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
        R::store($user);
        header('Location: admin_persons.php');

    } else {
        include 'header_admin.php';
        echo '<div style="color:red;">' . array_shift($errors) . '</div><hr>';
    }
}
$type = R::find('dictusers');
include 'header_admin.php';
?>
    <div class="container">
        <div class="row">
            <div class="col-md-4"><p class="back"><a href="admin_analysis.php"><i data-feather="chevron-left"></i>Back</a></p></div>
            <div class="col-md-4"><h3 class="text-center">Add User</h3></div>
        </div>
        <br>
        <form action="add_person.php" method="post"><br>
            <label>First name: </label><br><input type="text" name="first_name"><br><br>
            <label>Last name: </label><br><input type="text" name="last_name"><br><br>
            <label>Phone: </label><br><input type="text" name="phone"><br><br>
            <label>E-mail: </label><br><input type="text" name="email"><br><br>
            <label>Password: </label><br><input type="password" name="password"><br><br>
            <label>Password check: </label><br><input type="password" name="password_check"><br><br>
            <label>Category: </label><br><select name="category_users_id" class="select-admin">
                <?php foreach ($type as $type_row) : ?>
                    <option value="<? echo($type_row['id']); ?>"><? echo($type_row['type']); ?></option>
                <?php endforeach; ?>
            </select>
            <br>
            <input class="send-admin" type="submit" value="Create" name="submit_create_person"><br>
        </form>
    </div>
<?php include 'footer_admin.php'; ?>