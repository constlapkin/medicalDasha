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
?>
</div></div>
<div id="headerwrap">



            <h1>Providing outstanding healthcare to everyone</h1>
            <h3>We have a national reputation for world-class care and innovative medical treatments</h3>
        </div>
    </div>
</div>
</div>

<div class="container">
    <div id="inf">
        <h4>Our Mission</h4>
        <p>Our goal is to provide the highest quality acute healthcare to the<br>
            patients we are privileged to serve. We are proud to offer some of the<br>
            most technologically advanced treatment options.<br></p>


        <p><img src="templates/img/rightimg.JPG" alt="" class="rightimg"></p>

        <p class="txtalignment"> <span class="selectcolor">
           Healthcare provision to get your<br>
          Superman flying again.</span><br>
            We provide a wide range of medical and surgical
            procedures at our state of the art healthcare facilities
            all over the country, easily accessible to all. </p>
    </div>
</div>
<div class="container">
    <div id="help people">

        <p><img src="templates/img/help1.JPG" alt="" class="leftimg"></p>

        <p class="txtali"> <span class="selectcolor">
       We explore new and better ways to <br>
      help people live healthier lives.</span><br>
            We’ve been doing what we do for over 50 years – and we’ll continue to build on our success through the dedication of our outstanding people. </p>
    </div>
</div>


<div class="container">
<?
echo(' <a name="news"></a><div class="text-center"><h2>News</h2></div>');
foreach ($posts as $post_row){
echo ('<div class="text-center"><h4><a href="post.php?id='.$post_row["id"].'">'.$post_row['title'].'</a></h4></div>');
echo ('<div class="text-justify"><p>'.$post_row['description'].'</p></div>');
}


echo('<div class="text-center">');

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
</div>
<? endif; ?>
</div>
<div class="container information">
    <div class="row centered">
        <br><br>
        <div class="care">
            <h4>Exceptional standard of care</h4>
            <p>We pride ourselves on our exceptional standards of patient care.<br>
                Our clinicians and staff are highly recognised for their skills and their<br>
                dedication to delivering best-in-class treatment and care.</p>
        </div>
        <div class="centred">
            <div class="col-lg-4">
                <i class="fa fa-check-circle-o fa-2x"></i>
                <h4>Experienced</h4>
                <p>Over thirrty years of service</p>
            </div>
            <div class="col-lg-4">
                <i class="fa fa-heart-o fa-2x"></i>
                <h4>Motory</h4>
                <p>A young, energetic team</p>
            </div>
            <div class="col-lg-4">
                <i class="fa fa-user-md fa-2x"></i>
                <h4>Professional</h4>
                <p>Working to get results</p>
            </div>
        </div>
    </div>
    <br><br>
</div>


<div id="backgroundicon">
    <div class="icon">
        <p><strong> Experience world-class care</strong><br>
            We are committed to the provision of high quality, patient<br>
            centred care, delivered by experienced healthcare providers.</p>

        <a href="#" class="knopka">Our departments</a>
    </div>
</div>
<? include 'footer_index.php';
?>

