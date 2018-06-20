<?php include '../settings_db_rb.php';
if(!isset($_SESSION['logged_user']) or $_SESSION['logged_user']['category_users_id'] <= 2){
    header('Location: /');
}

$data = $_POST;

if (isset($data['submit_create_service'])) {
    $errors = array();
    if (trim($data['title']) == '') {
        $errors[] = 'Enter title';
    }
    if (trim($data['description']) == '') {
        $errors[] = 'Enter Description';
    }
    if (trim($data['category_services_id']) == '') {
        $errors[] = 'Enter Category';
    }
    if (empty($errors)) {
        $service = R::dispense('services');
        $service->title = $data['title'];
        $service->description = $data['description'];
        if(isset($data['price'])) {
            $service->price = $data['price'];
        }
        $service->category_services_id = $data['category_services_id'];
        R::store($service);
        header('Location: admin_services.php');

    } else {
        include 'header_admin.php';
        echo '<div style="color:red;">' . array_shift($errors) . '</div><hr>';
    }
}
$type = R::find('dictservices');
include 'header_admin.php';
?>
    <div class="container">
        <div class="row">
            <div class="col-md-4"><p class="back"><a href="admin_services.php"><i data-feather="chevron-left"></i>Back</a></p></div>
            <div class="col-md-4"><h3 class="text-center">Add Service</h3></div>
        </div>
        <br>
        <form action="add_service.php" method="post"><br>
            <label>Title: </label><br><input type="text" name="title"><br><br>
            <label>Description: </label><textarea id="editor_description" name="description"></textarea><br>
            <label>Price: </label><br><input type="number" name="price"><br>
            <label>Category: </label><br><select name="category_services_id" class="select-admin">
            <?php foreach ($type as $type_row) : ?>
                <option value="<? echo($type_row['id']); ?>"><? echo($type_row['type']); ?></option>
            <?php endforeach; ?>
            </select>
            <br>
            <input class="send-admin" type="submit" value="Create" name="submit_create_service"><br>
            <script type="application/javascript">
                CKEDITOR.replace('editor_description');
            </script>
        </form>
    </div>
<?php include 'footer_admin.php'; ?>