<?php include 'settings_db_rb.php';
include 'header_index.php';

$id = $_GET['id'];

$post = R::findOne('posts', 'WHERE status = 1 AND id = :id',
    array(
        ':id' => $id
    ));
if ($post):
    ?>
<div class="container">
    <h4><? echo ($post['title']) ?></h4>
    <div class="text-justify">
    <p><? echo ($post['text']) ?></p>
    </div>
</div>
<?php
else :
    header('Location: /');
endif;

include 'footer_index.php';