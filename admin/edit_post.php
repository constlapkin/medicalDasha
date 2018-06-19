<?php include '../settings_db_rb.php';
if(!isset($_SESSION['logged_user']) or $_SESSION['logged_user']['category_users_id'] == 1){
    header('Location: /');
}
/*
 * Если с admin.php передан id по ссылке, то достается строка с бд с такой id,
 * ее данные добавляются в по умолчанию value в форму, где далее редактируется
 * и сохраняется или удаляется строка из бд по такому id.
 * Иначе если не авторизован -> перенаправляет обратно на admin.php с просьбой
 * авторизации.
 */
$id = $_GET['id'];
if(!$id){
    header('Location: admin_posts.php');
}

if (isset($_SESSION['logged_user'])) {


    $post = R::findOne('posts', 'WHERE id = :id',
        array(
            ':id' => $id
        ));

    $data = $_POST;

    if (isset($data['submit_edit'])) {
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
            $post = R::load('posts', $data['id']);
            $post->title = $data['title'];
            $post->description = $data['description'];
            $post->text = $data['text'];
            $post->status = $data['status'];
            $post->change_date = date("Y-m-d h:m:s");
            $post->create_date = $data['create_date'];
            if($post->status == 1) {
                $post->publish_date = date("Y-m-d h:m:s");;
            }
            else{
                $post->publish_date = Null;
            }
            R::store($post);

            header('Location: admin/admin_posts.php');
        } else {
            echo '<div style="color:red;">'.array_shift($errors).'</div><hr>';
        }
    }
    elseif (isset($data['submit_delete']))
    {
        $post = R::load('posts', $data['id']);
        R::trash($post);
        header('Location: admin/admin_posts.php');
    }
}
include 'header_admin.php';
if ($id and isset($_SESSION['logged_user'])):
    ?>
<div class="container">
    <p><a href="admin_posts.php"><- Back</a></p>
    <br>
    <form action="edit_post.php" method="post">
        <input type="hidden" name="id" value="<? echo ($post['id']) ?>"><br>
        <input type="hidden" name="create_date" value="<? echo ($post['create_date']) ?>"><br>
        <label>Title: </label><br><input type="text" name="title" value="<? echo ($post['title'])?>"><br>
        <label>Description: </label><textarea name="description" id="editor_description"><? echo ($post['description'])?></textarea><br>
        <label>Text: </label><textarea name="text" id="editor_text"><? echo ($post['text'])?></textarea>

        <label>Status: </label>
        <select name="status">
            <option value="1">Publish</option>
            <option value="0">Notes</option>
        </select><br>
        <div class="buttonedorde">
        <input type="submit" value="Edit post" name="submit_edit">
        <input type="submit" value="Delete post" name="submit_delete">
        </div>
        <script type="application/javascript">
            CKEDITOR.replace('editor_description');
            CKEDITOR.replace('editor_text');
        </script>
    </form>
</div>
<?php
endif;
?>
