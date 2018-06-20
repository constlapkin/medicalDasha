<?php include '../settings_db_rb.php';
if(!isset($_SESSION['logged_user']) or $_SESSION['logged_user']['category_users_id'] <= 3){
    header('Location: /');
}
include 'header_admin.php';

$curPage = $_GET['page'];
$limit = 10;
if (!isset($curPage)) {$curPage = 1;}
$a_direct = 'admin_dict_analysis.php?page=';
$a_direct_1 = 'admin_dict_analysis.php?page=1';
$count = R::getCell("Select Count(*) from dictanalysis;");
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

    $dicts = R::find('dictanalysis', ' LIMIT :start, :limit ',
        array(
            ':start' => $start,
            ':limit' => $limit
        ));
    ?>
<div class="container">
    <br>
    <div class="row">
        <div class="col-md-4"><p class="back"><a href="admin.php"><i data-feather="chevron-left"></i>Back</a></p></div>
        <div class="col-md-4"><h3 class="text-center"><i data-feather="edit"></i> Dictionary of Analyses</h3></div>
        <div class="col-md-4"><a href="add_dict_analysis.php"><p class="add"><i data-feather="plus"></i>Add</p></a></div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-1">ID</div>
        <div class="col-md-11">Type</div>
    </div>
    <hr>
    <?php
    foreach ($dicts as $dict_row){
        echo ('
                <div class="row">
                    <div class="col-md-1">'.$dict_row['id'].'</div>
                    <div class="col-md-11"><a href="edit_dict_analysis.php?id='.$dict_row['id'].'">'.$dict_row['type'].'</a></div>
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