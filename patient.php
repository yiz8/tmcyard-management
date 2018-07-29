<?php
session_start();

if (isset($_SESSION['logged_in'])){
if ($_SESSION['userType'] == '1'){
    ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
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
</head>

<body>
<div class = "container container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-nav"
                aria-controls="navbar-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-nav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="patient.php">Manage Patients</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="income.php">Manage Income</a>
                </li>
                <li class = "nav-item">
                    <a class = "nav-link" href="users.php">Manage Users</a>
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

    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" href="#search" role="tab" data-toggle="tab">Search</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#add_new_patient" role="tab" data-toggle="tab">Add Patient</a>
        </li>

        <!--        <li class="nav-item">-->
        <!--            <a class="nav-link" href="#references" role="tab" data-toggle="tab">references</a>-->
        <!--        </li>-->
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active in" id="search">

            <form role = "form" action = "search_by_option.php" method = "post">

                <div class = "row">
                    <div class = "col-lg-6">
                        <input type = "text" class= "form-control" name = "searchbox"  placeholder="seach...">
                    </div>

                    <div class = "col-lg-2 ">
                        <select name = "search_option" class = "form-control" >
                            <option value = "name">Name</option>
                            <option value = "email">Email</option>
                            <option value = "phone">Phone Number</option>
                            <option value = "postcode">Postcode</option>
                            <option value = "gender">Gender</option>
                        </select>
                    </div>
                    <!-- <div class = "row align-items-center justify-content-center"> -->
                    <div class = "col-lg-1">
                        <input type = "submit" class = "btn btn-primary" value = "Search">
                    </div>

                </div><!-- eof row -->
            </form>

        </div>

        <div role="tabpanel" class="tab-pane fade" id="add_new_patient" >
            <div class = "border">
                <form action = "add_patient.php" name = "add" method = "post" >
                    <!-- First Form Row(start)-->
                        <div class = "row">
                        <div class = "col-sm">
                            <label for ="first_name">First Name:</label>
                            <input type = "text" id = "first_name" class = "form-control" name = "fname" required placeholder = "First Name..">
                        </div>
                        <div class = "col-sm">
                            <label>Last Name:</label>
                            <input type = "text" class = "form-control" id = "lname" name = "lname" required placeholder = "Last Name..">
                        </div>

<!--                        <div class = "col-sm">-->
<!--                            <label for ="age">Age:</label>-->
<!--                            <input type = "number" class = "form-control" min="0" id = "age" name = "age" required placeholder = "Age..">-->
<!--                        </div>-->

                        <div class = "col-sm">
                            <label>Gender:</label>
                            <select name = "gender_select" class = "form-control">
                                <option value = "male">Male</option>
                                <option value = "female">Female</option>
                                <option value = "other">Other</option>
                            </select>
                        </div>
                            <div class = "col-sm">
                                <label>Date of Birth:</label>
                                <input type = "date" class = "form-control" name = "dob">
                            </div>
                    </div>
                    <!-- First Form Row(end)-->





                    <!-- Second Form Row(start)-->
                    <div class = "form-group row justify-content-center">
                        <div class = "col-sm">
                            <label>Postcode:</label>
                            <input type = "text" class = "form-control" name = "postcode" pattern="^[a-zA-Z0-9 ]*$" required placeholder = "postcode..">
                        </div>

                        <div class = "col-sm">
                            <label>
                                Telphone:
                            </label>
                            <input type = "tel" class = "form-control" name = "telephone" pattern="^[+0-9 ]*$" required placeholder = "telephone">
                        </div>

                        <div class = "col-sm">
                            <label>
                                Email:
                            </label>
                            <input type = "email" class = "form-control" name = "email" pattern = "^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$" required placeholder = "Email Address.."
                            title="please enter a valid email addresss: e.g john@smith.com">
                        </div>
                        <div class = "col-sm">
                            <label>Main Problem:</label>
                            <input type = "text" name = "issue" class = "form-control"  required placeholder = "main problems.."> <!-- pattern="^[a-zA-Z0-9 ']*$" -->
                        </div>
                    </div>
                    <!-- Second Form Row(end)-->

                    <!-- Third Form Row(start)-->



                    <!-- Forth Form Row(start)-->
                    <div class = "form-group row justify-content-center">
                        <div class = "col-sm">
                            <label>Previous Ilness:</label>
                            <input type = "text" name = "illness" class = "form-control"   required placeholder = "illness.."> <!-- pattern="^[a-zA-Z0-9 ']*$" -->
                        </div>

                        <div class = "col-sm">
                            <label>Current Medication:</label>
                            <input type = "text" name = "medication" class = "form-control"   required placeholder ="Current Medications.."> <!-- pattern="^[a-zA-Z0-9 ']*$" -->
                        </div>

                        <div class = "col-sm">
                            <label>Allergies:</label>
                            <input type = "text" name = "allergies" class = "form-control"    required placeholder = "allergies.." > <!-- pattern="^[a-zA-Z0-9 ']*$" -->
                        </div>
                        <div class = "col-sm">
                            <label>Marital Status:</label>
                            <select name = "marital" class = "form-control">
                                <option value = "" disabled selected hidden>Marital Status..</option>
                                <option value = "married">Married</option>
                                <option value = "separated">Separated</option>
                                <option value = "partnership">In Partnership</option>
                                <option value = "single">Single</option>
                                <option value = "divorced">Divorced</option>
                                <option value = "widow">Widow/Widower</option>
                            </select>
                        </div>
                    </div>
                    <!-- Forth Form Row(end)-->

                    <div class = "form-group row justify-content-center">

                        <div class = "col-sm">
                            <label>Occupation:</label>
                            <input type = "text" class = "form-control" name = "occupation"    required placeholder = "Occupation.."> <!-- pattern="^[a-zA-Z0-9 ']*$" -->
                        </div>

                        <div class = "col-sm">
                            <label>HIV Positive</label><br>
                            <label class = "raido_inline">
                                <input type = "radio" name = "HIV" class = "form-control" value = "no" checked>No
                            </label>

                            <label class = "radio_inline">
                                <input type = "radio" class = "form-control" name = "HIV" value = "yes"> Yes
                            </label>
                        </div>
                    </div><!-- Third Form Row(end)-->


                    <label>
                        <input type = "submit" class = "btn btn-primary" name = "add_data" value = "Add Patient">
                    </label>

                </form>
            </div>



        </div>



    </div>
</div>
</body>

</html>
    <?php
} else if ($_SESSION['userType'] == '2'){
    ?>
    <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
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
</head>

<body>
<div class = "container container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-nav"
                aria-controls="navbar-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-nav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
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

    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" href="#search" role="tab" data-toggle="tab">Search</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#add_new_patient" role="tab" data-toggle="tab">Add Patient</a>
        </li>

        <!--        <li class="nav-item">-->
        <!--            <a class="nav-link" href="#references" role="tab" data-toggle="tab">references</a>-->
        <!--        </li>-->
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active in" id="search">

            <form role = "form" action = "search_by_option.php" method = "post">

                <div class = "row">
                    <div class = "col-lg-6">
                        <input type = "text" class= "form-control" name = "searchbox"  placeholder="seach...">
                    </div>

                    <div class = "col-lg-2 ">
                        <select name = "search_option" class = "form-control" >
                            <option value = "name">Name</option>
                            <option value = "email">Email</option>
                            <option value = "phone">Phone Number</option>
                            <option value = "postcode">Postcode</option>
                            <option value = "gender">Gender</option>
                        </select>
                    </div>
                    <!-- <div class = "row align-items-center justify-content-center"> -->
                    <div class = "col-lg-1">
                        <input type = "submit" class = "btn btn-primary" value = "Search">
                    </div>

                </div><!-- eof row -->
            </form>

        </div>

        <div role="tabpanel" class="tab-pane fade" id="add_new_patient" >
            <div class = "border">
                <form action = "add_patient.php" name = "add" method = "post" >
                    <!-- First Form Row(start)-->
                    <div class = "row">
                        <div class = "col-lg-6">
                            <input type = "text" class= "form-control" name = "searchbox"  placeholder="seach...">
                        </div>

                        <div class = "col-lg-2 ">
                            <select name = "search_option" class = "form-control" >
                                <option value = "name">Name</option>
                                <option value = "email">Email</option>
                                <option value = "phone">Phone Number</option>
                                <option value = "postcode">Postcode</option>
                                <option value = "gender">Gender</option>
                            </select>
                        </div>
                        <!-- <div class = "row align-items-center justify-content-center"> -->
                        <div class = "col-lg-1">
                            <input type = "submit" class = "btn btn-primary" value = "Search">
                        </div>

                    </div><!-- eof row -->
                </form>

            </div>

            <div role="tabpanel" class="tab-pane fade" id="add_new_patient" >
                <div class = "border">
                    <form action = "add_patient.php" name = "add" method = "post" >
                        <!-- First Form Row(start)-->
                        <div class = "row">
                            <div class = "col-sm">
                                <label for ="first_name">First Name:</label>
                                <input type = "text" id = "first_name" class = "form-control" name = "fname" required placeholder = "First Name..">
                            </div>
                            <div class = "col-sm">
                                <label>Last Name:</label>
                                <input type = "text" class = "form-control" id = "lname" name = "lname" required placeholder = "Last Name..">
                            </div>

                            <!--                        <div class = "col-sm">-->
                            <!--                            <label for ="age">Age:</label>-->
                            <!--                            <input type = "number" class = "form-control" min="0" id = "age" name = "age" required placeholder = "Age..">-->
                            <!--                        </div>-->

                            <div class = "col-sm">
                                <label>Gender:</label>
                                <select name = "gender_select" class = "form-control">
                                    <option value = "male">Male</option>
                                    <option value = "female">Female</option>
                                    <option value = "other">Other</option>
                                </select>
                            </div>
                            <div class = "col-sm">
                                <label>Date of Birth:</label>
                                <input type = "date" class = "form-control" name = "dob">
                            </div>
                        </div>
                        <!-- First Form Row(end)-->





                        <!-- Second Form Row(start)-->
                        <div class = "form-group row justify-content-center">
                            <div class = "col-sm">
                                <label>Postcode:</label>
                                <input type = "text" class = "form-control" name = "postcode" required placeholder = "postcode..">
                            </div>

                            <div class = "col-sm">
                                <label>
                                    Telphone:
                                </label>
                                <input type = "tel" class = "form-control" name = "telephone" required placeholder = "telephone">
                            </div>

                            <div class = "col-sm">
                                <label>
                                    Email:
                                </label>
                                <input type = "email" class = "form-control" name = "email" required placeholder = "Email Address..">
                            </div>
                            <div class = "col-sm">
                                <label>Main Problem:</label>
                                <input type = "text" name = "issue" class = "form-control" required placeholder = "main problems..">
                            </div>
                        </div>
                        <!-- Second Form Row(end)-->

                        <!-- Third Form Row(start)-->



                        <!-- Forth Form Row(start)-->
                        <div class = "form-group row justify-content-center">
                            <div class = "col-sm">
                                <label>Previous Ilness:</label>
                                <input type = "text" name = "illness" class = "form-control" required placeholder = "illness..">
                            </div>

                            <div class = "col-sm">
                                <label>Current Medication:</label>
                                <input type = "text" name = "medication" class = "form-control" required placeholder ="Current Medications..">
                            </div>

                            <div class = "col-sm">
                                <label>Allergies:</label>
                                <input type = "text" name = "allergies" class = "form-control" required placeholder = "allergies.." >
                            </div>
                            <div class = "col-sm">
                                <label>Marital Status:</label>
                                <select name = "marital" class = "form-control">
                                    <option value = "" disabled selected hidden>Marital Status..</option>
                                    <option value = "married">Married</option>
                                    <option value = "separated">Separated</option>
                                    <option value = "partnership">In Partnership</option>
                                    <option value = "single">Single</option>
                                    <option value = "divorced">Divorced</option>
                                    <option value = "widow">Widow/Widower</option>
                                </select>
                            </div>
                        </div>
                        <!-- Forth Form Row(end)-->

                        <div class = "form-group row justify-content-center">

                            <div class = "col-sm">
                                <label>Occupation:</label>
                                <input type = "text" class = "form-control" name = "occupation" required placeholder = "Occupation..">
                            </div>

                            <div class = "col-sm">
                                <label>HIV Positive</label><br>
                                <label class = "raido_inline">
                                    <input type = "radio" name = "HIV" class = "form-control" value = "no" checked>No
                                </label>

                                <label class = "radio_inline">
                                    <input type = "radio" class = "form-control" name = "HIV" value = "yes"> Yes
                                </label>
                            </div>
                        </div><!-- Third Form Row(end)-->


                        <label>
                            <input type = "submit" class = "btn btn-primary" name = "add_data" value = "Add Patient">
                        </label>

                    </form>
                </div>



            </div>



        </div>
    </div>
</body>

</html>
<?php
}else{
    echo "You need to log in to view this page!";
    header("refresh:3; url=index.php");
}

}
?>
