<?php include '../settings_db_rb.php';
if(!isset($_SESSION['logged_user']) or $_SESSION['logged_user']['category_users_id'] <= 2){
    header('Location: /');
}

$data = $_POST;

if (isset($data['submit_create_analysis'])) {
    $errors = array();
    if (trim($data['title']) == '') {
        $errors[] = 'Enter title';
    }
    if (trim($data['description']) == '') {
        $errors[] = 'Enter Description';
    }
    if (trim($data['category_analysis_id']) == '') {
        $errors[] = 'Enter Category';
    }
    if (trim($data['price']) == '') {
        $errors[] = 'Enter Price';
    }
    if (trim($data['preparation']) == '') {
        $errors[] = 'Enter Preparation';
    }
    if (trim($data['readings']) == '') {
        $errors[] = 'Enter Readings';
    }
    if (trim($data['time']) == '') {
        $errors[] = 'Enter Time';
    }
    if (empty($errors)) {
        $analysis = R::dispense('analysis');
        $analysis->title = $data['title'];
        $analysis->description = $data['description'];
        $analysis->price = $data['price'];
        $analysis->category_analysis_id = $data['category_analysis_id'];
        $analysis->preparation = $data['preparation'];
        $analysis->readings = $data['readings'];
        $analysis->time = $data['time'];
        R::store($analysis);
        header('Location: admin_analysis.php');

    } else {
        include 'header_admin.php';
        echo '<div style="color:red;">' . array_shift($errors) . '</div><hr>';
    }
}
$type = R::find('dictanalysis');
include 'header_admin.php';
?>
    <div class="container">
        <div class="row">
            <div class="col-md-4"><p class="back"><a href="admin_analysis.php"><i data-feather="chevron-left"></i>Back</a></p></div>
            <div class="col-md-4"><h3 class="text-center">Add Analysis</h3></div>
        </div>
        <br>
        <form action="add_analysis.php" method="post"><br>
            <label>Title: </label><br><input type="text" name="title"><br><br>
            <label>Description: </label><textarea id="editor_description" name="description"></textarea><br>
            <label>Preparation: </label><textarea id="editor_preparation" name="preparation"></textarea><br>
            <label>Readings: </label><textarea id="editor_readings" name="readings"></textarea><br>
            <label>Price: </label><br><input type="number" name="price"><br>
            <label>Time: </label><br><input type="number" name="time"><br>
            <label>Category: </label><br><select name="category_analysis_id" class="select-admin">
                <?php foreach ($type as $type_row) : ?>
                    <option value="<? echo($type_row['id']); ?>"><? echo($type_row['type']); ?></option>
                <?php endforeach; ?>
            </select>
            <br>
            <input class="send-admin" type="submit" value="Create" name="submit_create_analysis"><br>
            <script type="application/javascript">
                CKEDITOR.replace('editor_description');
                CKEDITOR.replace('editor_preparation');
                CKEDITOR.replace('editor_readings');
            </script>
        </form>
    </div>
<?php include 'footer_admin.php'; ?>