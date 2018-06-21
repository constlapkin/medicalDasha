<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical</title>
    <link rel="stylesheet" href="../templates/css/bootstrap.css">
    <link rel="stylesheet" href="../templates/css/font-awesome.min.css">
    <link rel="stylesheet" href="../templates/css/main.css">
    <link rel="stylesheet" href="../templates/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/i18n/defaults-*.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="/ckeditor/ckeditor.js"></script>
</head>
<body>

<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="/"><i class="fa fa-heartbeat" aria-hidden="true"></i>Clinic</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-inverse navbar-nav navbar-right">
                <li class="active"><a href="admin.php">Admin Panel</a></li>
                <? if ($_SESSION['logged_user']['category_users_id'] == 5) : ?>
                    <li><a href="admin_orders.php">Orders</a></li>
                <? else: ?>
                <li><a href="admin_posts.php">News</a></li>
                <? endif; ?>
                <? if ($_SESSION['logged_user']['category_users_id'] >= 3 and $_SESSION['logged_user']['category_users_id'] < 5) : ?>
                <li><a href="admin_analysis.php">Analysis</a></li>
                <li><a href="admin_services.php">Services</a></li>
                <li><a href="admin_persons.php">Persons</a></li>
                <? endif; ?>
                <li><a href="/">Web-site</a></li>
                <li><a href="../signout.php">Sign Out</a></li>
            </ul>
        </div>
    </div>
</div>
<br>

