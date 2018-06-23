<?php include 'settings_db_rb.php';
include 'header_index.php';

$id = $_GET['id'];

$services = R::find('services', 'where category_services_id = :dict_id',
    array(
        ':dict_id' => $id
    ));

?>

<div class="about">
    <div class="container information">
        <div class="row centered">
            <br><br>
            <h3>Choose service:</h3>
        </div>
    </div>
</div>
<?
echo('<div class="container">');
echo('<div class="text-justify">');
echo ('<br><br><h3>Choose type service: </h3>');
foreach ($services as $service_row) {
    echo('
    <div class="dict"><i data-feather="arrow-down-right"></i><a href="service.php?id='.$service_row['id'].'">'.$service_row['title'].'</a></div>
    ');
}
echo('</div>');
echo('</div>');

echo('<br>');

include 'footer_index.php';
?>
