<?php
session_start();


if (isset($_SESSION['logged_in'])){
if($_SESSION['userType']=='1'){
//    echo $_SESSION['userType'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">


    <link rel="stylesheet" href="stylesheets.css">

    <script src="clock.js"></script>

    <title>Homepage</title>
</head>

<body onload="startTime()">


<div class="container container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-nav"
                aria-controls="navbar-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-nav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="patient.php">Manage Patients</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="income.php">Manage Income</a>
                </li>
                <li class = "nav-item">
                    <a class = "nav-link" href="users.php"> Manage Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="statistics.php">Statistics</a>
                </li>

            </ul>

            <div class = "nav navbar-nav navbar-right">
                <div class = "dropdown">
                    <button class = "btn btn-secondary dropdown-toggle" type = "button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       <i class = "fas fa-user-md"></i>User Menu
                    </button>
                    <div class = "dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="patient.php">Manage Patient</a>
                        <a class = "dropdown-item" href="income.php">Manage Incomes</a>
                        <a class = "dropdown-item" href="users.php">Manage Users</a>
                        <a class = "dropdown-item" href="statistics.php">Statistics</a>
                        <a class = "dropdown-item" href="logout.php"><i class = "fas fa-sign-out-alt"></i>Sign Out</a>
                    </div>
                </div>
            </div>

        </div>
    </nav>

    <div class = "jumbotron">

        <div id = "clock"></div>
        <h1 id = "greeting" class = "display-5"></h1>
        <script src="time_detect.js"></script>
        <!-- greeting script based on hours-->

        <h1 class="display-4"><?php echo $_SESSION['name'];?></h1>

        <p>Choose one of the following options: </p>
        <div class = "list-group">
            <ul>
                <li class = "list-group-item"><a href = "patient.php" class = "fas fa-male"> Manage Patient</a></li>
                <li class = "list-group-item"><a href = "income.php" class = "fas fa-pound-sign"> Manage Incomes</a></li>
                <li class = "list-group-item"><a href = "users.php" class = "fas fa-users"> Manage Users</a></li>
                <li class = "list-group-item"><a href = "statistics.php" class = "fas fa-chart-line"> Statistics </a></li>
                <li class = "list-group-item"><a  href = "logout.php" class = "fas fa-sign-out-alt" >Logout</a></li>

            </ul>
        </div>



    </div>
    <?php //Normal User Page
    }else if($_SESSION['userType']=='2'){
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8"/>
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
              integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
                integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
                crossorigin="anonymous"></script>

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">


        <link rel="stylesheet" href="stylesheets.css">

        <script src="clock.js"></script>

        <title>Homepage</title>
    </head>

    <body onload="startTime()">


    <div class="container container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="index.php">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-nav"
                    aria-controls="navbar-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar-nav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="patient.php">Manage Patients</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="income.php">Manage Income</a>
                    </li>

                </ul>

                <div class = "nav navbar-nav navbar-right">
                    <div class = "dropdown">
                        <button class = "btn btn-secondary dropdown-toggle" type = "button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class = "fas fa-user-md"></i>User Menu
                        </button>
                        <div class = "dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="patient.php">Manage Patient</a>
                            <a class = "dropdown-item" href="income.php">Manage Incomes</a>
                            <a class = "dropdown-item" href="logout.php"><i class = "fas fa-sign-out-alt"></i>Sign Out</a>
                        </div>
                    </div>
                </div>

            </div>
        </nav>

        <div class = "jumbotron">

            <div id = "clock"></div>
            <h1 id = "greeting" class = "display-5"></h1>
            <script src="time_detect.js"></script>
            <!-- greeting script based on hours-->

            <h1 class="display-4"><?php echo $_SESSION['name'];?></h1>

            <p>Choose one of the following options: </p>
            <div class = "list-group">
                <ul>
                    <li class = "list-group-item"><a href = "patient.php" class = "fas fa-male"> Manage Patient</a></li>
                    <li class = "list-group-item"><a href = "income.php" class = "fas fa-pound-sign"> Manage Incomes</a></li>
                    <li class = "list-group-item"><a  href = "logout.php" class = "fas fa-sign-out-alt" >Logout</a></li>

                </ul>
            </div>



        </div>
<?php    }} else {
//        ?><!-- //Not Singed In-->
        <!DOCTYPE html>
        <html>
        <head>
            <!-- jQuery library -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <!-- Latest compiled and minified CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
                  integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
                  crossorigin="anonymous">
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
                    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
                    crossorigin="anonymous"></script>

        </head>
        <body>

        <div class="container" id="container">


            <form action="login.php" method="post">
                <div class="row align-items-center justify-content-center">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="inputEmail">Email</label>
                            <input type="email" class="form-control" name='user_name' id="inputEmail"
                                   aria-describedby="emailHelp" pattern ="^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$" title="please enter a valid email addresss: e.g john@smith.com" placeholder="Enter email" required>
                        </div> <!-- eof email input box -->
                    </div> <!-- eof col-sm-3 -->
                </div> <!-- eof row -->

                <div class="row align-items-center justify-content-center">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="inputPassword">Password</label>
                            <input autocomplete="off" type="password" class="form-control" name="password"
                                   id="inputPassword" placeholder="Password" required>
                        </div> <!-- eof password input box-->
                    </div> <!-- eof col-sm-3 -->
                </div> <!-- eof row -->

                <div class="row align-items-center justify-content-center">
                    <button type="submit" class="btn btn-primary" name="login">Login</button>
                </div>
            </form>

        </div> <!-- end of container -->

        </body>
        </html>
        <?php
    }
    ?>






















