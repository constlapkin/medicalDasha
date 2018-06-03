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
<a href="#" class="topbutton"><i class="fa fa-chevron-up"></i></a>
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">

        <div class="navbar-header">
            <a class="navbar-brand" href="#"><i class="fa fa-heartbeat" aria-hidden="true"></i>Clinic</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-inverse navbar-nav navbar-right">

                <li class="active"><a href="#">Home</a></li>
                <li><a href="templates/about.html">About us</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Analysis</a></li>
                <li><a href="#">Contacts</a></li>
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
<div id="headerwrap">

    <div class="row centered">
        <div class="col-lg-8 col-lg-offset-2">
            <h1>Providing outstanding healthcare to everyone</h1>
            <h3>We have a national reputation for world-class care and innovative medical treatments</h3>
        </div>
    </div>
</div>
</div>
<div class="container information">
    <div class="row centered">
        <br><br>
        <div class="care">
            <h4>Exceptional standard of care</h4>
            <p>We pride ourselves on our exceptional standards of patient care.<br>
                Our clinicians and staff are highly recognised for their skills and their<br>
                dedication to delivering best-in-class treatment and care.</p>
        </div>
        <div class="centred">
            <div class="col-lg-4">
                <i class="fa fa-check-circle-o fa-2x"></i>
                <h4>Experienced</h4>
                <p>Over thirrty years of service</p>
            </div>
            <div class="col-lg-4">
                <i class="fa fa-heart-o fa-2x"></i>
                <h4>Motory</h4>
                <p>A young, energetic team</p>
            </div>
            <div class="col-lg-4">
                <i class="fa fa-user-md fa-2x"></i>
                <h4>Professional</h4>
                <p>Working to get results</p>
            </div>
        </div>
    </div>
    <br><br>
</div>
<div id="dg">

    <div class="row centered">
        <h4>Popular Departments</h4>
        <br>
        <div class="col-xs-4">
            <div class="tilta">
                <a href="#"><img src="img/c1.jpg" alt=""> Cardiac Clinic</a>
                <p>Cardiology is a branch of medicine dealing with disorders of the heart as well as parts of the circulatory system.</p>
            </div>
        </div>
        <div class="col-xs-4">
            <div class="tilta">
                <a href="#"><img src="img/d222.jpg" alt=""> Dental Clinic</a>
                <p>This is the study, diagnosis, prevention, as well as treatment of diseases, disorders and conditions of the oral cavity.</p>
            </div>
        </div>
        <div class="col-xs-4">
            <div class="tilta">
                <a href="#"><img src="img/3o22.jpg" alt=""> Ophthalmology Clinic</a>
                <p>Ophthalmology is the branch of medicine that deals with the anatomy, physiology and diseases of the eye.</p>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div id="inf">
