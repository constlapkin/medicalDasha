<?php include 'settings_db_rb.php';
include 'header_index.php';

$id = $_GET['id'];

$analysis = R::findOne('analysis', 'where id = :id',
    array(
        ':id' => $id
    ));
?>

<div class="about">
    <div class="container information">
        <div class="row centered">
            <br><br>
            <h3><? echo $analysis['title']; ?></h3>
        </div>
    </div>
</div>
<?
echo('<div class="container">');
echo('<div class="text-justify">');
echo('
    
    <h4>Description</h4>
    <p>'.$analysis['description'].'</p>
     <h4>Preparation</h4>
    <p>'.$analysis['preparation'].'</p>
     <h4>Readings</h4>
    <p>'.$analysis['readings'].'</p>
     <h4>Time</h4>
    <p>It is take about '.$analysis['time'].' days</p>
    ');
if ($analysis['time'] != 0 and isset($analysis['time'])) : ?>
    <h4>Price</h4>
    <p class="price"><? echo ($analysis['price']) ?> Р</p>

<? endif;

echo('</div>');

echo('</div>');
echo('<br>');

include 'footer_index.php';
?>
