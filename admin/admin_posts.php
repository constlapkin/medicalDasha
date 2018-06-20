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
    <br>
    <div class="row">
        <div class="col-md-4"><p class="back"><a href="admin.php"><i data-feather="chevron-left"></i>Back</a></p></div>
        <div class="col-md-4"><h3 class="text-center"><i data-feather="edit"></i> News</h3></div>
        <div class="col-md-4"><a href="add_post.php"><p class="add"><i data-feather="plus"></i>Add</p></a></div>
    </div>
    <hr>
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
        <div class="col-md-2"><a href="edit_post.php?id='.$post_row["id"].'">'.$post_row['title'].'</a></div>
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
<?php include 'footer_admin.php'; ?>