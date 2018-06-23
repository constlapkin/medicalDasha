<?php require 'settings_db_rb.php';
if(isset($_SESSION['logged_user'])){
    header('Location: /');
}
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
include 'header_index.php';
?>


<div class="about">
    <div class="container information">
        <div class="row centered">
            <br><br>
            <h3>Welcome!</h3><br>
        </div>
    </div>
</div>

<div class="container">
<form action="signin.php" method="post">
    <label>E-mail</label><br><input type="email" name="email" value="<?php echo @$data['email'] ?>"><br>
    <label>Password </label><br><input type="password" name="password" value="<?php echo @$data['password'] ?>"><br>
    <br><input type="submit" value="Войти" name="submit_login">
</form>
</div>
<br><br>
<?php include 'footer_index.php'; ?>

