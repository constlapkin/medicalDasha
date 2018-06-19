<?php include '../settings_db_rb.php';
if(!isset($_SESSION['logged_user']) or $_SESSION['logged_user']['category_users_id'] == 1){
    header('Location: /');
}
include 'header_admin.php';


if (isset($_SESSION['logged_user'])) {
    $limit = 5;
    $posts = R::find('posts', ' LIMIT :limit ',
        array(
            ':limit' => $limit
        ));
?>
<div class="container">
    <p><a href="admin.php"><- Back</a></p>
    <br>
    <div class="row">
        <div class="col-md-6"><h3>News</h3></div>
        <div class="col-md-6"><div class="row text-right"><a href="add_post.php">Add</a></div></div>
    </div>
    <hr>
    <br>
    <div class="row">
        <div class="col-md-1">ID|Status</div>
        <div class="col-md-2">Title</div>
        <div class="col-md-5">Description</div>
        <div class="col-md-2">Date of create</div>
        <div class="col-md-2">Date of Publish</div>

    </div>
    <hr>
    <?php
    foreach ($posts as $post_row){
        if($post_row['status']) {
            $post_row['status'] = "&radic;";
        }
        else {
            $post_row['status'] = "&times;";
        }
        if(!$post_row['publish_date']){
            $post_row['publish_date'] = "&mdash;";
        }
        $post_row['description'] = mb_strimwidth($post_row['description'], 0, 100, "...");
        echo ('

    <div class="row">
        <div class="col-md-1">'.$post_row['id'].'|'.$post_row['status'].'</div>
        <div class="col-md-2"><a href="edit.php?id='.$post_row["id"].'">'.$post_row['title'].'</a></div>
        <div class="col-md-5">'.$post_row['description'].'</div>
        <div class="col-md-2">'.$post_row['create_date'].'</div>
        <div class="col-md-2">'.$post_row['publish_date'].'</div>
    </div>
    <hr>

');
    }
}

?>
</div>
