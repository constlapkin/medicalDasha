<?php include '../settings_db_rb.php';
if(!isset($_SESSION['logged_user']) or $_SESSION['logged_user']['category_users_id'] == 1){
    header('Location: /');
}
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
        $post->status = $data['status'];
        $post->change_date = Null;
        $post->publish_date = Null;
        R::store($post);
        header('Location: admin/admin_posts.php');

    } else {
        include 'header_admin.php';
        echo '<div style="color:red;">' . array_shift($errors) . '</div><hr>';
    }
}

include 'header_admin.php';
?>
<div class="container">
    <p class="back"><a href="admin_posts.php"><i data-feather="chevron-left"></i>Back</a></p>
    <br>
    <form action="add_post.php" method="post"><br>
        <label>Title: </label><br><input type="text" name="title"><br><br>
        <label>Description: </label><textarea id="editor_description" name="description"></textarea><br>
        <label>Text: </label><textarea id="editor_text" name="text"></textarea><br>
        <label>Publish: </label><br><select name="status" class="select-admin">
            <option value="1">Publish</option>
            <option value="0">Notes</option>
        </select>
        <br>
        <input class="send-admin" type="submit" value="Create" name="submit_create_post"><br>
        <script type="application/javascript">
            CKEDITOR.replace('editor_description');
            CKEDITOR.replace('editor_text');
        </script>
    </form>
</div>
<?php include 'footer_admin.php'; ?>