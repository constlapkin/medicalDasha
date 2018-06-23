<?php include 'settings_db_rb.php';
include 'header_index.php';

$dicts = R::findAll('dictservices');


?>

<div class="about">
    <div class="container information">
        <div class="row centered">
            <br><br>
            <h3>Choose type service:</h3>
        </div>
    </div>
</div>
<?
echo('<div class="container">');

echo('<div class="text-justify">');
foreach ($dicts as $dict_row) {
    echo('
    <div class="dict"><i data-feather="arrow-down-right"></i><a href="services.php?id='.$dict_row['id'].'">'.$dict_row['type'].'</a></div>
    ');
}
echo('</div>');
echo('<br>');
echo('</div>');
include 'footer_index.php';
?>
