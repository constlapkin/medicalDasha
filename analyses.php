<?php include 'settings_db_rb.php';
include 'header_index.php';

$id = $_GET['id'];

$analyses = R::find('analysis', 'where category_analysis_id = :dict_id',
    array(
        ':dict_id' => $id
    ));
echo ('<br><br><h3>Choose type service: </h3>');
foreach ($analyses as $analysis_row) {
    echo('
    <a href="analysis.php?id='.$analysis_row['id'].'">'.$analysis_row['title'].'</a>
    ');
}



echo('<br>');

include 'footer_index.php';
?>
