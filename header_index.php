<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
   <!-- <link rel="stylesheet" href="templates/css/bootstrap.css">-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="templates/css/font-awesome.min.css">
    <link rel="stylesheet" href="templates/css/main.css">
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body>
<a href="/" class="topbutton"><i class="fa fa-chevron-up"></i></a>


<nav class="navbar navbar-fixed-top navbar-expand-lg navbar-dark fixed-top bg-dark " id="bg-dark-nav">
    <div class="container">
    <a class="navbar-brand" href="/"><i class="fa fa-heartbeat" aria-hidden="true"></i>Clinic</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse floatRightd" id="navbarNavAltMarkup">
        <div class="navbar-nav ">
            <a class="nav-item nav-link active" href="/">Home </a>
            <a class="nav-item nav-link" href="about.php">About us</a>
            <a class="nav-item nav-link" href="dict_services.php">Services</a>
            <a class="nav-item nav-link" href="dict_analysis.php">Analysis</a>
            <?php
                if (isset($_SESSION['logged_user'])) :
                    if($_SESSION['logged_user']['category_users_id'] != 1) :
            ?>
                    <a class="nav-item nav-link" href="admin/admin.php">Admin Panel</a>
            <?php endif; ?>
                    <a class="nav-item nav-link" href="order.php">Order</a>
                    <a class="nav-item nav-link" href="signout.php">Sign Out</a>
                <?php
                else :
                ?>
                <a class="nav-item nav-link" href="signup.php">Sign Up</a>
                <a class="nav-item nav-link" href="signin.php">Sign In</a>
            <?php
            endif; ?>
        </div>
    </div>
    </div>
</nav>
    <!--<li><form name="search" action="#" method="get" class="form-inline form-search pull-right">
                    <div class="input-group">
                        <label class="sr-only" for="searchInput">Search</label>
                        <input type="text" class="form-control" placeholder="Search for...">
                        <div class="input-group-btn">
                            <button class="btn btn-secondary" type="button">Go</button>
                        </div>
                    </div>
                </form></li>-->

