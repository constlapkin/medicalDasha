<?php include '../settings_db_rb.php';
if(!isset($_SESSION['logged_user']) or $_SESSION['logged_user']['category_users_id'] <= 2){
    header('Location: /');
}
include 'header_admin.php';
$curPage = $_GET['page'];
$limit = 5;
if (!isset($curPage)) {$curPage = 1;}
$a_direct = 'admin_persons.php?page=';
$a_direct_1 = 'admin_persons.php?page=1';
$count = R::getCell("Select Count(*) from users;");
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


    $users = R::find('users', ' LIMIT :start, :limit ',
        array(
            ':start' => $start,
            ':limit' => $limit
        ));
$type = R::find('dictusers');
    ?>
<div class="container">
    <br>
    <div class="row">
        <div class="col-md-4"><p class="back"><a href="admin.php"><i data-feather="chevron-left"></i>Back</a></p></div>
        <div class="col-md-4"><h3 class="text-center"><i data-feather="edit"></i> Persons</h3></div>
        <div class="col-md-4"><a href="add_person.php"><p class="add"><i data-feather="plus"></i>Add</p></a></div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-1">ID</div>
        <div class="col-md-2">First Name</div>
        <div class="col-md-1">Last Name</div>
        <div class="col-md-2">Phone</div>
        <div class="col-md-2">E-mail</div>
        <div class="col-md-2">Join Date</div>
        <div class="col-md-2">Category</div>
    </div>
    <hr>
    <?php
    foreach ($users as $user_row){
        foreach ($type as $type_row) {
            if ($user_row['category_users_id'] == $type_row['id']) {
                $user_row['category_users_id'] = $type_row['type'];
                break;
            }
        }
        echo ('

    <div class="row">
        <div class="col-md-1">'.$user_row['id'].'</div>
        <div class="col-md-2"><a href="edit_person.php?id='.$user_row["id"].'">'.$user_row['first_name'].'</a></div>
        <div class="col-md-1"><a href="edit_person.php?id='.$user_row["id"].'">'.$user_row['last_name'].'</a></div>
        <div class="col-md-2">'.$user_row['phone'].'</div>
        <div class="col-md-2">'.$user_row['email'].'</div>
        <div class="col-md-2">'.$user_row['join_date'].'</div>
        <div class="col-md-2">'.$user_row['category_users_id'].'</div>
    </div>
    <hr>

');
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