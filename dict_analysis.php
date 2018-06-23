<?php include 'settings_db_rb.php';
include 'header_index.php';

$dicts = R::findAll('dictanalysis');
?>

<div class="about">
    <div class="container information">
        <div class="row centered">
            <br><br>
            <h3>Choose type analysis:</h3>
        </div>
    </div>
</div>
<?
echo('<div class="container">');

echo('<div class="text-justify">');
foreach ($dicts as $dict_row) {
    echo('
    <div class="dict"><i data-feather="arrow-down-right"></i><a href="analyses.php?id='.$dict_row['id'].'">'.$dict_row['type'].'</a></div>
    ');
}
echo('<br>');
echo('</div>');
echo('</div>');
include 'footer_index.php';
?>
