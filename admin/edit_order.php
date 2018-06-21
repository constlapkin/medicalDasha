<?php include '../settings_db_rb.php';
if(!isset($_SESSION['logged_user']) or $_SESSION['logged_user']['category_users_id'] <= 2){
    header('Location: /');
}

$id = $_GET['id'];
if(!$id){
    header('Location: admin_orders.php');
}

if (isset($_SESSION['logged_user'])) {


    $order = R::findOne('orders', 'WHERE id = :id',
        array(
            ':id' => $id
        ));

    $data = $_POST;

    if (isset($data['submit_edit'])) {
        $errors = array();
        if (trim($data['date']) == '') {
            $errors[] = 'Enter date';
        }
        if (empty($errors)) {
            $order = R::load('orders', $data['id']);
            $order->date = $data['date'];
            $order->status = $data['status'];
            R::store($order);

            header('Location: admin_orders.php');
        } else {
            echo '<div style="color:red;">'.array_shift($errors).'</div><hr>';
        }
    }
    elseif (isset($data['submit_delete']))
    {
        $order = R::load('orders', $data['id']);
        R::trash($order);
        header('Location: admin_orders.php');
    }
}
include 'header_admin.php';
if ($id and isset($_SESSION['logged_user'])):
    ?>
    <div class="container">
        <p class="back"><a href="admin_orders.php"><i data-feather="chevron-left"></i>Back</a></p>
        <br>
        <form action="edit_order.php" method="post">
            <input type="hidden" name="id" value="<? echo ($order['id']) ?>"><br>
            <label>Date: </label><br><input type="date" name="date" value="<? echo ($order['date'])?>"><br>
            <label>Status: </label><br>
            <select class="select-admin" name="status">
                <option value="1">Complete</option>
                <option value="0">New</option>
            </select><br>
            <input class="send-admin" type="submit" value="Edit post" name="submit_edit">
            <input class="send-admin" type="submit" value="Delete post" name="submit_delete">
        </form>
    </div>
<?php
endif;
?>
<?php include 'footer_admin.php'; ?>