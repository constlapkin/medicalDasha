<?php include 'settings_db_rb.php';
include 'header_index.php';

$dicts = R::findAll('dictanalysis');
echo ('<br><br><h3>Choose type of analysis: </h3>');
foreach ($dicts as $dict_row) {
    echo('
    <a href="analyses.php?id='.$dict_row['id'].'">'.$dict_row['type'].'</a><br>
    ');
}
echo('<br>');

include 'footer_index.php';
?>
