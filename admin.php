<?php include 'settings_db_rb.php';
/*
 * Выдает список статей, по нажатию на которую перенаправляет на edit.php
 * Кнопка создать статью, выдает форму для создания статьи
 * В случае, если не авторизован, сообщается об этом и ничего не выводит
 */
include 'templates/header_base.php';
$data = $_POST;

if (isset($data['submit_create_post'])) {
    $errors = array();
    if (trim($data['title']) == '') {
        $errors[] = 'Enter title';
    }
    if (trim($data['description']) == '') {
        $errors[] = 'Enter Description';
    }
    if (trim($data['text']) == '') {
        $errors[] = 'Enter text';
    }
    if (empty($errors)) {
        $post = R::dispense('posts');
        $post->title = $data['title'];
        $post->description = $data['description'];
        $post->text = $data['text'];
        $post->user_id = $_SESSION['logged_user']->id;
        $post->category_posts_id = 1;
        $post->create_date = date("Y-m-d");
        $post->status = 0;
        $post->change_date = Null;
        $post->publish_date = Null;
        R::store($post);
        echo '<div style="color:green;">Success!</div><hr>';
    } else {
        echo '<div style="color:red;">' . array_shift($errors) . '</div><hr>';
    }
}

if (isset($_SESSION['logged_user'])) :
?>
<?php
else:
    ?>
<p>Auth!</p>

<?php
endif;

if(isset($_SESSION['logged_user']) and isset($data['submit_create'])) :
    ?>
<div class="container">
    <form action="admin.php" method="post"><br>
        <label>Title: </label><br><input type="text" name="title"><br><br>
        <label>Description: </label><textarea id="editor_description" name="description"></textarea><br>
        <label>Text: </label><textarea id="editor_text" name="text"></textarea><br>
        <div class="buttonedorde"><input type="submit" value="Create" name="submit_create_post"></div><br>
        <script type="application/javascript">
            CKEDITOR.replace('editor_description');
            CKEDITOR.replace('editor_text');
        </script>
    </form>
</div>
<?php
endif;

if (isset($_SESSION['logged_user'])) {
    $limit = 5;
    $posts = R::find('posts', ' LIMIT :limit ',
        array(
            ':limit' => $limit
        ));

    foreach ($posts as $post_row){
        echo ('<div class="container"><h1><a href="edit.php?id='.$post_row["id"].'">'.$post_row['title'].'</a></h1>');
        echo ('<p>'.$post_row['description'].'</p></div>');
    }
}


?>
