<?php include '../settings_db_rb.php';
if(!isset($_SESSION['logged_user']) or $_SESSION['logged_user']['category_users_id'] <= 2){
    header('Location: /');
}

$id = $_GET['id'];
if(!$id){
    header('Location: admin_services.php');
}
    $service = R::findOne('services', 'WHERE id = :id',
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
        if (empty($errors)) {
            $service = R::load('services', $data['id']);
            $service->title = $data['title'];
            $service->description = $data['description'];
            if($data['price']){
                $service->price = $data['price'];
            }
            $service->category_services_id = $data['category_services_id'];
            R::store($service);

            header('Location: admin_services.php');
        } else {
            echo '<div style="color:red;">'.array_shift($errors).'</div><hr>';
        }
    }
    elseif (isset($data['submit_delete']))
    {
        $service = R::load('services', $data['id']);
        R::trash($service);
        header('Location: admin_services.php');
    }
$dict = R::find('dictservices');
include 'header_admin.php';
if ($id and isset($_SESSION['logged_user'])):
    ?>
    <div class="container">
        <p class="back"><a href="admin_services.php"><i data-feather="chevron-left"></i>Back</a></p>
        <br>
        <form action="edit_service.php" method="post">
            <input type="hidden" name="id" value="<? echo ($service['id']) ?>"><br>
            <label>Title: </label><br><input type="text" name="title" value="<? echo ($service['title'])?>"><br>
            <label>Description: </label><textarea name="description" id="editor_description"><? echo ($service['description'])?></textarea><br>
            <label>Price: </label><br><input type="number" name="price" value="<? echo ($service['price'])?>"><br>

            <label>Category: </label><br>
            <select class="select-admin" name="category_services_id">
                <?php foreach ($dict as $dict_row) : ?>
                <option value="<? echo($dict_row['id']) ?>"><? echo($dict_row['type']) ?></option>
                <?php endforeach; ?>
            </select><br>
                <input class="send-admin" type="submit" value="Edit service" name="submit_edit">
                <input class="send-admin" type="submit" value="Delete service" name="submit_delete">
            <script type="application/javascript">
                CKEDITOR.replace('editor_description');
            </script>
        </form>
    </div>
<?php
endif;
?>
<?php include 'footer_admin.php'; ?>