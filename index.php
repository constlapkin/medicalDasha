<?php include 'settings_db_rb.php';
include 'templates/header.php';
/*
if (isset($_SESSION['logged_user'])) :
?>
<a href="signout.php">Выйти</a>
<br>
<?php
else :
?>
<a href="signup.php">Зарегистрироваться</a>
<br>
<a href="signin.php">Войти</a>
<br>
<?php
endif;
?>
*/
/*
if (isset($_SESSION['logged_user'])) {
  echo 'Привет, '.$_SESSION['logged_user']->first_name.'!';
}
*/
$limit = 5;
$posts = R::find('posts', ' WHERE status = 1 LIMIT :limit ',
    array(
        ':limit' => $limit
    ));

foreach ($posts as $post_row){
echo ('<h4><a href="post.php?id='.$post_row["id"].'">'.$post_row['title'].'</a></h4>');
echo ('<p>'.$post_row['description'].'</p>');
}
include 'templates/footer.php';
?>
