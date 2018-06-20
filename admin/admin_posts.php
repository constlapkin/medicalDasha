<?php include '../settings_db_rb.php';
if(!isset($_SESSION['logged_user']) or $_SESSION['logged_user']['category_users_id'] == 1){
    header('Location: /');
}
include 'header_admin.php';
$curPage = $_GET['page'];
$limit = 5;
if (!isset($curPage)) {$curPage = 1;}
$a_direct = 'admin_posts.php?page=';
$a_direct_1 = 'admin_posts.php?page=1';
$count = R::getCell("Select Count(*) from posts;");
if($count % $limit > 0){
    $pages = ceil($count / $limit);
}
else {
    $pages = $count / $limit;
}

if ($curPage > $pages){$curPage = $pages;}
if ($curPage < 1){$curPage = 1;}


if($curPage > 1){
    $start = ($curPage - 1) * $limit;
}
else {
    $start = 0;
}



if (isset($_SESSION['logged_user'])) {

    $posts = R::find('posts', ' LIMIT :start, :limit ',
        array(
            ':start' => $start,
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
<?php if ($pages != 1): ?>
    <? if ($curPage > 1): ?>
        <a href="<? echo $a_direct; $nextPage = $curPage - 1; echo ($nextPage)?>"> < </a>
    <? endif; ?>
        <a href="<? echo $a_direct_1; ?>"> <? if ($curPage == 1) : ?><b> 1 </b> <? else : ?> 1 <? endif; ?></a>
    <?php

        if (($curPage - 2 > 1) and ($curPage + 2 < $pages)) {
            print (' .. <a href="'.$a_direct.($curPage-1).'">' . ($curPage - 1) . '</a> <a href="'.$a_direct.$curPage.'"><b>' . $curPage . '</b></a> <a href="'.$a_direct.($curPage + 1).'">' . ($curPage + 1) . '</a> .. ');
        }
        elseif (($curPage - 2 > 1) and ($curPage + 1 < $pages)) {
            print (' .. <a href="'.$a_direct.($curPage-1).'">' . ($curPage - 1) . '</a> <a href="'.$a_direct.$curPage.'"><b>' . $curPage . '</b></a> <a href="'.$a_direct.($curPage + 1).'">'.($curPage + 1).'</a> ');
        }
        elseif (($curPage - 2 > 1)  and ($curPage != $pages)) {
            print (' .. <a href="'.$a_direct.($curPage-1).'">' . ($curPage - 1) . '</a> <a href="'.$a_direct.$curPage.'"><b>' . $curPage . '</b></a> ');
        }
        elseif (($curPage - 2 > 1) and ($curPage == $pages)){
            print (' .. <a href="'.$a_direct.($curPage-1).'">' . ($curPage - 1) . '</a> ');
        }
        elseif (($curPage - 1 > 1) and ($curPage + 2 < $pages)) {
            print (' <a href="'.$a_direct.($curPage-1).'">' . ($curPage - 1) . '</a> <a href="'.$a_direct.$curPage.'"><b>' . $curPage . '</b></a> <a href="'.$a_direct.($curPage + 1).'">' . ($curPage + 1) . '</a> .. ');
        }
        elseif (($curPage + 2 < $pages) and ($curPage != 1)) {
            print (' <a href="'.$a_direct.$curPage.'"><b>' . $curPage . '</b></a> <a href="'.$a_direct.($curPage + 1).'">' . ($curPage + 1) . '</a> .. ');
        }
        elseif (($curPage + 2 < $pages) and ($curPage == 1)) {
            print (' <a href="'.$a_direct.($curPage + 1).'">' . ($curPage + 1) . '</a> .. ');
        }

    ?>


    <a href="<? echo $a_direct; echo ($pages) ?>"> <? if ($curPage == $pages) : ?><b><? echo ($pages) ?></b> <? else : ?> <? echo ($pages) ?> <? endif; ?></a>

    <? if ($curPage < $pages) : ?>
        <a href="<? echo $a_direct; $nextPage = $curPage + 1; echo ($nextPage)?>"> > </a>
    <? endif; ?>
<? endif; ?>
</div>

<?php include 'footer_admin.php'; ?>