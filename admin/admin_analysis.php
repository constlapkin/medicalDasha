<?php include '../settings_db_rb.php';
if(!isset($_SESSION['logged_user']) or $_SESSION['logged_user']['category_users_id'] <= 2){
    header('Location: /');
}
include 'header_admin.php';
$curPage = $_GET['page'];
$limit = 5;
if (!isset($curPage)) {$curPage = 1;}
$a_direct = 'admin_analysis.php?page=';
$a_direct_1 = 'admin_analysis.php?page=1';
$count = R::getCell("Select Count(*) from analysis;");
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
    $analysis = R::find('analysis', ' LIMIT :start, :limit ',
        array(
            ':start' => $start,
            ':limit' => $limit
        ));
$type = R::find('dictanalysis');
    ?>
<div class="container">
    <br>
    <div class="row">
        <div class="col-md-4"><p class="back"><a href="admin.php"><i data-feather="chevron-left"></i>Back</a></p></div>
        <div class="col-md-4"><h3 class="text-center"><i data-feather="edit"></i> Analysis</h3></div>
        <div class="col-md-4"><a href="add_analysis.php"><p class="add"><i data-feather="plus"></i>Add</p></a></div>
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