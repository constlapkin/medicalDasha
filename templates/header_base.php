<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical</title>
    <link rel="stylesheet" href="templates/css/bootstrap.css">
    <link rel="stylesheet" href="templates/css/font-awesome.min.css">
    <link rel="stylesheet" href="templates/css/main.css">
    <script src="/ckeditor/ckeditor.js"></script>

</head>
<body>
<a href="#" class="topbutton"><i class="fa fa-chevron-up"></i></a>
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">

        <div class="navbar-header">
            <a class="navbar-brand" href="#"><i class="fa fa-heartbeat" aria-hidden="true"></i>Clinic</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-inverse navbar-nav navbar-right">

                <li class="active"><a href="../ ">Home</a></li>
                <li><form action="../admin.php" method="post"><input type="submit" name="submit_create" value="Create Post"></form></li>
                <li><a href="#">\</a></li>
                <li><a href="#">\</a></li>
                <li><a href="#">\</a></li>
                <?php
                if (isset($_SESSION['logged_user'])) :
                    ?>
                    <li><a href="admin.php">Admin Panel</a></li>
                    <li><a href="signout.php">Sign Out</a></li>

                <?php
                else :
                    ?>
                    <li><a href="signup.php">Sign Up</a></li>

                    <li><a href="signin.php">Sign In</a></li>

                <?php
                endif;
                ?>
            </ul>
        </div>

    </div>
</div>

