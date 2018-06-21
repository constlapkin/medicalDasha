<?php include 'settings_db_rb.php';
include 'header_index.php';


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



$posts = R::find('posts', ' LIMIT :start, :limit ',
    array(
        ':start' => $start,
        ':limit' => $limit
    ));
/*
if (isset($_SESSION['logged_user'])) :
?>
<a href="signout.php">Выйти</a>
<br>
<?php
else :
?>
<a href="signup.php">Зарегистрироваться</a>
<br>
<a href="signin.php">Войти</a>
<br>
<?php
endif;
?>
*/
/*
if (isset($_SESSION['logged_user'])) {
  echo 'Привет, '.$_SESSION['logged_user']->first_name.'!';
}
*/

foreach ($posts as $post_row){
echo ('<h4><a href="post.php?id='.$post_row["id"].'">'.$post_row['title'].'</a></h4>');
echo ('<div class="text-justify"><p>'.$post_row['description'].'</p></div>');
}


 if ($pages != 1): ?>
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
<? include 'footer_index.php';
?>

