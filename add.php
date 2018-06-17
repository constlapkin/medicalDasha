<?php include 'settings_db_rb.php';
if(!isset($_SESSION['logged_user']) or $_SESSION['logged_user']['category_users_id'] == 1){
    header('Location: /');
}

include 'templates/header_admin.php';
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
        header("Location: /admin.php");

    } else {
        echo '<div style="color:red;">' . array_shift($errors) . '</div><hr>';
    }
}
?>
<div class="container">
    <p><a href="admin_posts.php"><- Back</a></p>
    <br>
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
