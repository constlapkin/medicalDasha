<?php include 'settings_db_rb.php';
include 'header_index.php';

$id = $_GET['id'];

$service = R::findOne('services', 'where id = :id',
    array(
        ':id' => $id
    ));

echo('
    <h3>'.$service['title'].'</h3>
    <h4>Descriprion</h4>
    <p>'.$service['description'].'</p>
    <h4>Price</h4>
    <p class="price">'.$service['price'].' Р</p>

');




echo('<br>');

include 'footer_index.php';
?>
