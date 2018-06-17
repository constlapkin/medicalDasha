<?php require 'settings_db_rb.php';

$data = $_POST;
if(isset($data['submit_login'])){
    $errors = array();
    $user = R::findOne('users', 'email = ?', array($data['email']));
    if ($user){
        if(password_verify($data['password'], $user->password)) {
            $_SESSION['logged_user'] = $user;
            header("Location: /");
        }
        else {
            $errors[] = "Wrong email or password";
        }
    }
    else {
        $errors[] = "This email does not exist";
    }
    if($errors){
        echo '<div style="color:red;">' .array_shift($errors).'</div><hr>';
    }
}
include 'templates/header_index.php';
?>

<div class="container">
    <h1>Welcome!</h1> <br>
<form action="signin.php" method="post">
    <label>E-mail</label><br><input type="email" name="email" value="<?php echo @$data['email'] ?>"><br>
    <label>Password </label><br><input type="password" name="password" value="<?php echo @$data['password'] ?>"><br>
    <div class="buttonedorde"><input type="submit" value="Войти" name="submit_login"></div>
</form>
</div>