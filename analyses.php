<?php include 'settings_db_rb.php';
include 'header_index.php';

$id = $_GET['id'];

$analyses = R::find('analysis', 'where category_analysis_id = :dict_id',
    array(
        ':dict_id' => $id
    ));

?>

<div class="about">
    <div class="container information">
        <div class="row centered">
            <br><br>
            <h1>Choose analyses:</h1>
        </div>
    </div>
</div>
<?
echo('<div class="container">');
    echo('<div class="text-justify">');


foreach ($analyses as $analysis_row) {
    echo('
    <div class="dict"><i data-feather="arrow-down-right"></i><a href="analysis.php?id='.$analysis_row['id'].'">'.$analysis_row['title'].'</a></div>
    ');
}

echo('</div>');
echo('</div>');
echo('<br>');

include 'footer_index.php';
?>
