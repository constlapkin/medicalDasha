<?php include 'settings_db_rb.php';
include 'header_index.php';

$id = $_GET['id'];

$services = R::find('services', 'where category_services_id = :dict_id',
    array(
        ':dict_id' => $id
    ));
echo ('<br><br><h3>Choose type service: </h3>');
foreach ($services as $service_row) {
    echo('
    <a href="service.php?id='.$service_row['id'].'">'.$service_row['title'].'</a>
    ');
}



echo('<br>');

include 'footer_index.php';
?>
