<?php include 'settings_db_rb.php';

/*
 * Страница регистрации - с проверкой на ввод данных и
 * существование уже этих данных в базе
 */
if(isset($_SESSION['logged_user'])){
    header('Location: /');
}
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
include 'header_index.php';
?>
    <script type="text/javascript">
        function checkPassword(form) {
            var password = form.password.value; // Получаем пароль из формы
            var s_letters = "qwertyuiopasdfghjklzxcvbnm"; // Буквы в нижнем регистре
            var b_letters = "QWERTYUIOPLKJHGFDSAZXCVBNM"; // Буквы в верхнем регистре
            var digits = "0123456789"; // Цифры
            var specials = "!@#$%^&*()_-+=\|/.,:;[]{}"; // Спецсимволы
            var is_s = false; // Есть ли в пароле буквы в нижнем регистре
            var is_b = false; // Есть ли в пароле буквы в верхнем регистре
            var is_d = false; // Есть ли в пароле цифры
            var is_sp = false; // Есть ли в пароле спецсимволы
            for (var i = 0; i < password.length; i++) {
                /* Проверяем каждый символ пароля на принадлежность к тому или иному типу */
                if (!is_s && s_letters.indexOf(password[i]) != -1) is_s = true;
                else if (!is_b && b_letters.indexOf(password[i]) != -1) is_b = true;
                else if (!is_d && digits.indexOf(password[i]) != -1) is_d = true;
                else if (!is_sp && specials.indexOf(password[i]) != -1) is_sp = true;
            }
            var rating = 0;
            var text = "";
            if (is_s) rating++; // Если в пароле есть символы в нижнем регистре, то увеличиваем рейтинг сложности
            if (is_b) rating++; // Если в пароле есть символы в верхнем регистре, то увеличиваем рейтинг сложности
            if (is_d) rating++; // Если в пароле есть цифры, то увеличиваем рейтинг сложности
            if (is_sp) rating++; // Если в пароле есть спецсимволы, то увеличиваем рейтинг сложности
            /* Далее идёт анализ длины пароля и полученного рейтинга, и на основании этого готовится текстовое описание сложности пароля */
            if (password.length < 6 && rating < 3){ text = "Слишком простой пароль";  alert(text); return false;}
            else if (password.length >= 6 && rating == 1) { text = "Слишком простой пароль";  alert(text); return false;}

            // Выводим итоговую сложность пароля
             // Форму не отправляем
        }
    </script>
<div class="about">
    <div class="container information">
        <div class="row centered">
            <br><br>
            <h3>Sign up!</h3>
        </div>
    </div>
</div>

<div class="container">


    <p class="reg">Registration is needed to order some of our services and analyzes. Also, registration can allow you to speed up
        the work of feedback in case you have any questions.</p>

<form action="signup.php" method="post" onsubmit="return checkPassword(this);">
    <label>First Name </label><br/><input type="text" value="<?php echo @$data['first_name'] ?>" name="first_name"><br/>
    <label>Last Name </label><br/><input type="text" value="<?php echo @$data['last_name'] ?>" name="last_name"><br/>
    <label>Phone number </label><br/><input type="number" value="<?php echo @$data['phone'] ?>" name="phone"><br/>
    <label>E-mail </label><br/><input type="email" value="<?php echo @$data['email'] ?>" name="email"><br/>
    <label>Password </label><br/><input type="password" value="<?php echo @$data['password'] ?>" name="password"><br/>
    <label>Password again </label><br/><input type="password" value="<?php echo @$data['password_check'] ?>" name="password_check"><br/>
    <br> <input type="submit" value="Sign up" name="submit_reg">
</form>
</div>
<br><br>
<?php include 'footer_index.php'; ?>