<?php include 'settings_db_rb.php';

/*
 * Страница регистрации - с проверкой на ввод данных и
 * существование уже этих данных в базе
 */

$data = $_POST;
if(isset($data['submit_reg'])){
    $errors = Array();
    if (trim($data['first_name']) == ''){
        $errors[] = 'Enter first name!';
    }
    if (trim($data['last_name']) == ''){
        $errors[] = 'Enter last name!';
    }
    if (trim($data['phone']) == ''){
        $errors[] = 'Enter phone!';
    }
    if (trim($data['email']) == ''){
        $errors[] = 'Enter email!';
    }
    if (R::count('users', "phone = ?", array($data['phone'])) > 0){
        $errors[] = 'Account with this number already exists!';
    }
    if (R::count('users', "email = ?", array($data['email'])) > 0){
        $errors[] = 'Account with this mail already exists!';
    }
    if (($data['password']) == ''){
        $errors[] = 'Enter password!';
    }
    if ($data['password_check'] != $data['password']){
        $errors[] = 'Passwords do not match!';
    }

    if(empty($errors)){
        $user = R::dispense('users');
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->phone = $data['phone'];
        $user->email = $data['email'];
        $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
        $user->join_date = date("Y-m-d");
        $user->category_users_id = 1;
        R::store($user);
        $user_session = R::findOne('users', 'email = ?', array($data['email']));
        if ($user_session) {
            $_SESSION['logged_user'] = $user;
        }
        else {
            $errors[] = "Error with auth or save reg user.";
        }
        header("Location: /");
    }
    else {
        echo '<div style="color:red;">' .array_shift($errors).'</div><hr>';
    }
}
include 'templates/header_index.php';
?>
<div class="container">
    <h1>Registration</h1>

    <p class="reg">Registration is needed to order some of our services and analyzes. Also, registration can allow you to speed up
        the work of feedback in case you have any questions.</p>

<form action="signup.php" method="post">
    <label>First Name </label><br/><input type="text" value="<?php echo @$data['first_name'] ?>" name="first_name"><br/>
    <label>Last Name </label><br/><input type="text" value="<?php echo @$data['last_name'] ?>" name="last_name"><br/>
    <label>Phone number </label><br/><input type="number" value="<?php echo @$data['phone'] ?>" name="phone"><br/>
    <label>E-mail </label><br/><input type="email" value="<?php echo @$data['email'] ?>" name="email"><br/>
    <label>Password </label><br/><input type="password" value="<?php echo @$data['password'] ?>" name="password"><br/>
    <label>Password again </label><br/><input type="password" value="<?php echo @$data['password_check'] ?>" name="password_check"><br/>
    <div class="buttonedorde"><input type="submit" value="Sign up" name="submit_reg"></div>
</form>
</div>