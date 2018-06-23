<?php include 'settings_db_rb.php';

if(!isset($_SESSION['logged_user'])){
    header('Location: /');
}


$data = $_POST;

if (isset($data['submit_create_order'])) {
    $errors = array();
    if (trim($data['text']) == '') {
        $errors[] = 'Enter text';
    }
    if (trim($data['date']) == '') {
        $errors[] = 'Enter date';
    }

    if (empty($errors)) {
        $order = R::dispense('orders');
        $order->text = $data['text'];
        $order->date = $data['date'];
        $order->price = $_SESSION['logged_user']['id'];
        R::store($order);
        echo '<br><br><div style="color:green; text-align: center;"> Successful </div><hr>';
    } else {
        include 'header_index.php';
        echo '<div style="color:red;">' . array_shift($errors) . '</div><hr>';
    }
}

include 'header_index.php';
?>

    <div class="about">
        <div class="container information">
            <div class="row centered">
                <br><br>
                <h3>New Order</h3>
            </div>
        </div>
    </div>

<div class="container">

    <br>
    <form action="order.php" method="post"><br>
        <label>Text: </label><textarea class="order" name="text"></textarea><br>
        <label>Date: </label><br><input type="date" name="date"><br>
        <br>
        <input class="send-admin" type="submit" value="Create" name="submit_create_order"><br>
    </form>
</div>

<br> <br>
<? include 'footer_index.php'; ?>