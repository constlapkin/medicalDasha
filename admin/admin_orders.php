<?php include '../settings_db_rb.php';
if(!isset($_SESSION['logged_user']) or $_SESSION['logged_user']['category_users_id'] <= 2){
    header('Location: /');
}
include 'header_admin.php';
$curPage = $_GET['page'];
$limit = 5;
if (!isset($curPage)) {$curPage = 1;}
$a_direct = 'admin_orders.php?page=';
$a_direct_1 = 'admin_orders.php?page=1';
$count = R::getCell("Select Count(*) from orders;");
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


$orders = R::find('orders', ' LIMIT :start, :limit ',
    array(
        ':start' => $start,
        ':limit' => $limit
    ));

?>
    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-4"><p class="back"><a href="admin.php"><i data-feather="chevron-left"></i>Back</a></p></div>
            <div class="col-md-4"><h3 class="text-center"><i data-feather="edit"></i> Orders</h3></div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-1">ID</div>
            <div class="col-md-3">Last and First Name</div>
            <div class="col-md-3">Text</div>
            <div class="col-md-2">Phone</div>
            <div class="col-md-2">Date</div>
            <div class="col-md-1">Status</div>
        </div>
        <hr>
        <?php
        foreach ($orders as $order_row){
            if($order_row['status']) {
                $order_row['status'] = "&radic;";
            }
            else {
                $order_row['status'] = "&times;";
            }
            $user = R::find('users', 'where id = ?', array($order_row['user_id']));

            echo ('

    <div class="row">
        <div class="col-md-1">'.$order_row['id'].'</div>
        <div class="col-md-3"><a href="edit_order.php?id='.$order_row["id"].'">'.$user[3]['last_name'].' '.$user[3]['first_name'].'</a></div>
        <div class="col-md-3"><a href="edit_order.php?id='.$order_row["id"].'">'.$order_row['text'].'</a></div>
        <div class="col-md-2">'.$user[3]['phone'].'</div>
        <div class="col-md-2">'.$order_row['date'].'</div>
        <div class="col-md-1">'.$order_row['status'].'</div>
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