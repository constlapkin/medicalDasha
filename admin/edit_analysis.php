<?php include '../settings_db_rb.php';
if(!isset($_SESSION['logged_user']) or $_SESSION['logged_user']['category_users_id'] <= 2){
    header('Location: /');
}

$id = $_GET['id'];
if(!$id){
    header('Location: admin_analysis.php');
}
$analysis = R::findOne('analysis', 'WHERE id = :id',
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
    if (trim($data['price']) == '') {
        $errors[] = 'Enter price';
    }
    if (trim($data['preparation']) == '') {
        $errors[] = 'Enter preparation';
    }
    if (trim($data['readings']) == '') {
        $errors[] = 'Enter readings';
    }
    if (trim($data['time']) == '') {
        $errors[] = 'Enter time';
    }
    if (empty($errors)) {
        $analysis = R::load('analysis', $data['id']);
        $analysis->title = $data['title'];
        $analysis->description = $data['description'];
        $analysis->price = $data['price'];
        $analysis->preparation = $data['preparation'];
        $analysis->readings = $data['readings'];
        $analysis->time = $data['time'];
        $analysis->category_analysis_id = $data['category_analysis_id'];
        R::store($analysis);

        header('Location: admin_analysis.php');
    } else {
        echo '<div style="color:red;">'.array_shift($errors).'</div><hr>';
    }
}
elseif (isset($data['submit_delete']))
{
    $analysis = R::load('analysis', $data['id']);
    R::trash($analysis);
    header('Location: admin_analysis.php');
}
$dict = R::find('dictanalysis');
include 'header_admin.php';
if ($id and isset($_SESSION['logged_user'])):
    ?>
    <div class="container">
        <p class="back"><a href="admin_analysis.php"><i data-feather="chevron-left"></i>Back</a></p>
        <br>
        <form action="edit_analysis.php" method="post">
            <input type="hidden" name="id" value="<? echo ($analysis['id']) ?>"><br>
            <label>Title: </label><br><input type="text" name="title" value="<? echo ($analysis['title'])?>"><br>
            <label>Description: </label><textarea name="description" id="editor_description"><? echo ($analysis['description'])?></textarea><br>
            <label>Preparation: </label><textarea name="preparation" id="editor_preparation"><? echo ($analysis['preparation'])?></textarea><br>
            <label>Readings: </label><textarea name="readings" id="editor_readings"><? echo ($analysis['readings'])?></textarea><br>
            <label>Price: </label><br><input type="number" name="price" value="<? echo ($analysis['price'])?>"><br>
            <label>Time: </label><br><input type="number" name="time" value="<? echo ($analysis['time'])?>"><br>
            <label>Category: </label><br>
            <select class="select-admin" name="category_analysis_id">
                <?php foreach ($dict as $dict_row) : ?>
                    <option value="<? echo($dict_row['id']) ?>"><? echo($dict_row['type']) ?></option>
                <?php endforeach; ?>
            </select><br>
                <input class="send-admin" type="submit" value="Edit analysis" name="submit_edit">
                <input class="send-admin" type="submit" value="Delete analysis" name="submit_delete">
            <script type="application/javascript">
                CKEDITOR.replace('editor_description');
                CKEDITOR.replace('editor_preparation');
                CKEDITOR.replace('editor_readings');
            </script>
        </form>
    </div>
<?php
endif;
?>
<?php include 'footer_admin.php'; ?>