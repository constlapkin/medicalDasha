<?php include 'settings_db_rb.php';
include 'header_index.php';

$id = $_GET['id'];

$service = R::findOne('services', 'where id = :id',
    array(
        ':id' => $id
    ));
?>

<div class="about">
    <div class="container information">
        <div class="row centered">
            <br><br>
            <h3><? echo $service['title']; ?></h3>
        </div>
    </div>
</div>
<?
echo('
<div class="container">

    <div class="text-justify">
    <h4>Descriprion</h4>
    <p>'.$service['description'].'</p>
    <h4>Price</h4>
    <p class="price">'.$service['price'].' Р</p>
    </div>
</div>
');




echo('<br>');

include 'footer_index.php';
?>
