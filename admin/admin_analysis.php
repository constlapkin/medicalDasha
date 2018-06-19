<?php include '../settings_db_rb.php';
if(!isset($_SESSION['logged_user']) or $_SESSION['logged_user']['category_users_id'] <= 2){
    header('Location: /');
}
include 'header_admin.php';

$limit = 5;
$analysis = R::find('analysis', ' LIMIT :limit ',
    array(
        ':limit' => $limit
    ));
$type = R::find('dict_analysis');
?>
<div class="container">
    <p><a href="admin.php"><- Back</a></p>
    <br>
    <div class="row">
        <div class="col-md-6"><h3>Analysis</h3></div>
        <div class="col-md-6"><div class="row text-right"><a href="add_analysis.php">Add</a></div></div>
    </div>
    <hr>
    <br>
    <div class="row">
        <div class="col-md-1">ID</div>
        <div class="col-md-2">Title</div>
        <div class="col-md-2">Description</div>
        <div class="col-md-2">Preparation</div>
        <div class="col-md-2">Readings</div>
        <div class="col-md-1">Time</div>
        <div class="col-md-1">Price</div>
        <div class="col-md-1">Category</div>
    </div>
    <hr>
    <?php
    foreach ($analysis as $analysis_row){
        foreach ($type as $type_row) {
            if ($analysis_row['category_analysis_id'] == $type_row['id']) {
                $analysis_row['category_analysis_id'] = $type_row['type'];
                break;
            }
        }

        $analysis_row['title'] = mb_strimwidth($analysis_row['title'], 0, 100, "...");
        $analysis_row['description'] = mb_strimwidth($analysis_row['description'], 0, 100, "...");
        $analysis_row['preparation'] = mb_strimwidth($analysis_row['preparation'], 0, 100, "...");
        $analysis_row['readings'] = mb_strimwidth($analysis_row['readings'], 0, 100, "...");
        $analysis_row['category_analysis_id'] = mb_strimwidth($analysis_row['category_analysis_id'], 0, 100, "...");
        echo ('

    <div class="row">
        <div class="col-md-1">'.$analysis_row['id'].'</div>
        <div class="col-md-2"><a href="edit_analysis.php?id='.$analysis_row["id"].'">'.$analysis_row['title'].'</a></div>
        <div class="col-md-2"><a href="edit_analysis.php?id='.$analysis_row["id"].'">'.$analysis_row['description'].'</a></div>
        <div class="col-md-2">'.$analysis_row['preparation'].'</div>
        <div class="col-md-2">'.$analysis_row['readings'].'</div>
        <div class="col-md-1">'.$analysis_row['time'].'</div>
        <div class="col-md-1">'.$analysis_row['price'].'</div>
        <div class="col-md-1">'.$analysis_row['category_analysis_id'].'</div>
    </div>
    <hr>

');
    }

    ?>
</div>