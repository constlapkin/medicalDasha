<?php include 'settings_db_rb.php';
include 'header_index.php';

$id = $_GET['id'];

$post = R::findOne('posts', 'WHERE status = 1 AND id = :id',
    array(
        ':id' => $id
    ));

    ?>


<div class="about">
    <div class="container information">
        <div class="row centered">
            <br><br>
            <h3><?  echo ($post['title']) ?></h3>
        </div>
    </div>
</div>

<div class="container">

    <div class="text-justify">
    <p><? echo ($post['text']) ?></p>
    </div>

    <div class="col-md-4"><p class="back"><a href="../#news"><i data-feather="chevron-left"></i>Back</a></p></div>
</div>
<br><br>
<?php

include 'footer_index.php';