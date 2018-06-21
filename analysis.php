<?php include 'settings_db_rb.php';
include 'header_index.php';

$id = $_GET['id'];

$analysis = R::findOne('analysis', 'where id = :id',
    array(
        ':id' => $id
    ));

echo('
    <h3>'.$analysis['title'].'</h3>
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




echo('<br>');

include 'footer_index.php';
?>
