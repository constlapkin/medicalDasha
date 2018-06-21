<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical</title>
    <link rel="stylesheet" href="templates/css/bootstrap.css">
    <link rel="stylesheet" href="templates/css/font-awesome.min.css">
    <link rel="stylesheet" href="templates/css/main.css">
</head>
<body>
<a href="/" class="topbutton"><i class="fa fa-chevron-up"></i></a>
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">

        <div class="navbar-header">
            <a class="navbar-brand" href="/"><i class="fa fa-heartbeat" aria-hidden="true"></i>Clinic</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-inverse navbar-nav navbar-right">

                <li class="active"><a href="/">Home</a></li>
                <li><a href="about.php">About us</a></li>
                <li><a href="dict_services.php">Services</a></li>
                <li><a href="dict_analysis.php">Analysis</a></li>

                <?php
                if (isset($_SESSION['logged_user'])) :
                    if($_SESSION['logged_user']['category_users_id'] != 1) :
                ?>
                    <li><a href="admin/admin.php">Admin Panel</a></li>
                    <?php endif; ?>
                    <li><a href="order.php">Order</a></li>
                    <li><a href="signout.php">Sign Out</a></li>

                <?php
                else :
                ?>

                <li><a href="signup.php">Sign Up</a></li>

                <li><a href="signin.php">Sign In</a></li>

                <?php
                endif;
                ?>

                <!--<li><form name="search" action="#" method="get" class="form-inline form-search pull-right">
                    <div class="input-group">
                        <label class="sr-only" for="searchInput">Search</label>
                        <input type="text" class="form-control" placeholder="Search for...">
                        <div class="input-group-btn">
                            <button class="btn btn-secondary" type="button">Go</button>
                        </div>
                    </div>
                </form></li>-->
            </ul>
        </div>

    </div>
</div>

<div class="container">
    <div id="inf">
