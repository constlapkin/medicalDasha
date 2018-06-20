<?php include '../settings_db_rb.php';
if(!isset($_SESSION['logged_user']) or $_SESSION['logged_user']['category_users_id'] <= 3){
    header('Location: /');
}

$data = $_POST;

if (isset($data['submit_create_dict_analysis'])) {
    $errors = array();
    if (trim($data['type']) == '') {
        $errors[] = 'Enter Type';
    }
    if (empty($errors)) {
        $dict = R::dispense('dictanalysis');
        $dict->type = $data['type'];
        R::store($dict);
        header('Location: admin_dict_analysis.php');

    } else {
        include 'header_admin.php';
        echo '<div style="color:red;">' . array_shift($errors) . '</div><hr>';
    }
}
include 'header_admin.php';
?>
    <div class="container">
        <div class="row">
            <div class="col-md-4"><p class="back"><a href="admin_analysis.php"><i data-feather="chevron-left"></i>Back</a></p></div>
            <div class="col-md-4"><h3 class="text-center">Add Analysis in Dictionary</h3></div>
        </div>
        <br>
        <form action="add_dict_analysis.php" method="post"><br>
            <label>Title: </label><br><input type="text" name="type"><br><br>
            <br>
            <input class="send-admin" type="submit" value="Create" name="submit_create_dict_analysis"><br>
        </form>
    </div>
<?php include 'footer_admin.php'; ?>