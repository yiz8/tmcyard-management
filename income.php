<?php
session_start();
include 'include.php';

if (isset($_SESSION['logged_in'])){
if ($_SESSION['userType'] == '1'){
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Manage Income</title>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    <!-- google charts api-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css"
          integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">


    <link rel="stylesheet" href="stylesheets.css">


</head>


<body>
<div class="container">
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
                <li class="nav-item ">
                    <a class="nav-link" href="patient.php">Manage Patients</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link active" href="income.php">Manage Income</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="users.php">Manage Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="statistics.php">Statistics</a>
                </li>

            </ul>

            <div class="nav navbar-nav navbar-right">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-md"></i>User Menu
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="patient.php">Manage Patient</a>
                        <a class="dropdown-item" href="income.php">Manage Incomes</a>
                        <a class="dropdown-item" href="users.php">Manage Users</a>
                        <a class="dropdown-item" href="statistics.php">Statistics</a>
                        <a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i>Sign Out</a>
                    </div>
                </div>
            </div>

        </div>
    </nav>


    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" href="#daily_income" role="tab" data-toggle="tab">Daily Income</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#income" role="tab" data-toggle="tab">Manage Income</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#expense" role="tab" data-toggle="tab">Manage Expense</a>
        </li>

    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active in" id="daily_income">

            <?php


            $query = "SELECT * FROM income where date = '$date'";
            $query_total = "select SUM(retail) as retail,
                                    SUM(Herbal) AS Herbal,
                                    SUM(Massage) as Massage,
                                    SUM(Acupuncture) as Acupuncture,
                                    Sum(other) as other,
                                    (sum(retail)+sum(Herbal)+sum(Massage)+sum(Acupuncture)+sum(other)) as total
                                    from income
                        where date = '$date'";
            $resultSet = $conn->query($query);
            $summation = $conn->query($query_total);

            if ($resultSet->num_rows != 0){
            ?>
            <table class="table table-hover table-border">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Retail (£)</th>
                    <th>Herbal (£)</th>
                    <th>Massage (£)</th>
                    <th>Acupuncture (£)</th>
                    <th>Other (£)</th>
                    <th>Description</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>

                <?php
                while ($row = $resultSet->fetch_assoc()) {
                    $id = $row['id'];
                    $retail = $row['retail'];
                    $Herbal = $row['Herbal'];
                    $Massage = $row['Massage'];
                    $Acupuncture = $row['Acupuncture'];
                    $other = $row['other'];
                    $description = $row['description'];
                    $date = $row['date'];

                    echo '<tr>';
                    echo '<td>' . $id . '</td>';
                    echo '<td>' . $retail . '</td>';
                    echo '<td>' . $Herbal . '</td>';
                    echo '<td>' . $Massage . '</td>';
                    echo '<td>' . $Acupuncture . '</td>';
                    echo '<td>' . $other . '</td>';
                    echo '<td>' . $description . '</td>';
                    echo '<td>' . $date . '</td>';
                    echo '</tr>';

                }

                echo '</tbody>';
                echo '<tfoot>';
                echo ' <tr>';
                if ($summation->num_rows > 0) {
                    while ($row = $summation->fetch_assoc()) {
                        $retail_sum = $row['retail'];
                        $Herbal_sum = $row['Herbal'];
                        $Massage_sum = $row['Massage'];
                        $Acupuncture_sum = $row['Acupuncture'];
                        $other_sum = $row['other'];
                        echo "<td>Total</td>";
                        echo "<td>£" . $row['retail'] . "</td>";
                        echo "<td>£" . $row['Herbal'] . "</td>";
                        echo "<td>£" . $row['Massage'] . "</td>";
                        echo "<td>£" . $row['Acupuncture'] . "</td>";
                        echo "<td>£" . $row['other'] . "</td>";
                        echo "<td>Daily Total: £" . $row['total'] . "</td>";
                        echo '</tr>';
                        echo '</tfoot>';
                        echo '</table>';
                        ?>

                        <script type="text/javascript">

                            // Load the Visualization API and the corechart package.
                            google.charts.load('current', {'packages': ['corechart']});

                            // Set a callback to run when the Google Visualization API is loaded.
                            google.charts.setOnLoadCallback(drawChart);

                            // Callback that creates and populates a data table,
                            // instantiates the pie chart, passes in the data and
                            // draws it.
                            function drawChart() {

                                // Create the data table.
                                var data = new google.visualization.DataTable();
                                data.addColumn('string', 'Categories');
                                data.addColumn('number', 'Incomes');
                                data.addRows([
                                    ['Retail', <?php echo "$retail_sum"; ?>],
                                    ['Herbal', <?php echo "$Herbal_sum"; ?>],
                                    ['Massage', <?php echo "$Massage_sum"; ?>],
                                    ['Acupuncture', <?php echo "$Acupuncture_sum"; ?>],
                                    ['Other', <?php echo "$other_sum"; ?>]
                                ]);

                                // Set chart options
                                var options = {
                                    'title': 'Daily Income Distribution',
                                    'width': 600,
                                    'height': 500
                                };

                                // Instantiate and draw our chart, passing in some options.
                                var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                                chart.draw(data, options);
                            }
                        </script>
                        <?php
                    }
                }


                echo '<div id = "chart_div"></div>';
                } else {
                    echo "There's no income for today yet";
                }


                ?>


        </div>

        <div class="tab-pane fade " id="income">
            <form role="form" action="add_income.php" method="post">
                <div class="row">
                    <div class="col-sm">
                        <label for="retail">Retail: </label>
                        <input type="number" step = "0.01" min = "0"  id="retail" name="retail" class="form-control" value="0">
                    </div>

                    <div class="col-sm">
                        <label for="herbal">Herbal: </label>
                        <input type="number" step = "0.01" min = "0" id="herbal" name="herbal" class="form-control" value="0">
                    </div>

                    <div class="col-sm">
                        <label for="massage">Massage:</label>
                        <input type="number" step = "0.01" min = "0" id="massage" name="massage" class="form-control" value="0">
                    </div>

                    <div class="col-sm-offset-1">
                        <label for="acupuncture">Acupuncture: </label>
                        <input type="number" step = "0.01" min = "0" id="acupuncture" name="acupuncture" class="form-control" value="0">
                    </div>

                </div><!-- eof row -->

                <div class="row">
                    <div class="col-sm-3">
                        <label for="other">Other: </label>
                        <input type="number" step = "0.01" min = "0"  id="other" name="other" class="form-control" value="0">
                    </div>

                    <div class="col-sm">
                        <label for="description">Description: </label>
                        <input type="text" id="description" name="description" class="form-control"
                               placeholder="enter a description">
                    </div>
                </div><!-- eof row-->
                <div class="row">
                    <div class="col-sm-2">
                        <label for="date">Date: </label>
                        <input type="date" id="date" name="date" class="form-control" value="<?php echo $date; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <button type="submit" class="btn btn-primary" value="Submit" name="add_income">Submit</button>
                    </div>
                </div>
            </form>
        </div>


        <div role="tabpanel" class="tab-pane fade" id="expense">

            <form role="form" action="add_expense.php" method="post">
                <div class="row">
                    <div class="col-sm">
                        <label for="cash">Cash</label>
                        <input type="number" step = "0.01" min = "0"  id="cash" name="cash" class="form-control" value="0">
                    </div>
                    <div class="col-sm">
                        <label for="card">Card</label>
                        <input type="number" step = "0.01" min = "0" id="card" name="card" class="form-control" value="0">
                    </div>
                    <div class="col-sm">
                        <label for="other">Other</label>
                        <input type="number" step = "0.01" min = "0" id="other" name="other" class="form-control" value="0">
                    </div>
                </div> <!--eof row-->

                <div class="row">
                    <div class="col-sm">
                        <label for="description">Description</label>
                        <input type="text" name="description" class="form-control" placeholder="describe the expense..">
                    </div>
                </div> <!--eof row-->
                <div class="row">
                    <div class="col-sm-2">
                        <label for="date">Date</label>
                        <input type="date" id="date" name="date" class="form-control" value="<?php echo $date; ?>">
                    </div>

                    <div class="col-sm-2">
                        <label for="add_expense">&nbsp;</label>
                        <button type="submit" class="form-control btn btn-primary" value="Submit" name="add_expense">
                            Submit
                        </button>
                    </div>
                </div>
                <div class="row">

                </div>
            </form>

        </div>


    </div>

    <?php
    } else if ($_SESSION['userType'] == '2'){
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8"/>
        <title>Manage Income</title>
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
              integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
              crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
                integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
                crossorigin="anonymous"></script>
        <!-- google charts api-->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css"
              integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg"
              crossorigin="anonymous">


        <link rel="stylesheet" href="stylesheets.css">


    </head>


    <body>
    <div class="container">
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
                    <li class="nav-item ">
                        <a class="nav-link" href="patient.php">Manage Patients</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link active" href="income.php">Manage Income</a>
                    </li>
                </ul>

                <div class="nav navbar-nav navbar-right">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-md"></i>User Menu
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="patient.php">Manage Patient</a>
                            <a class="dropdown-item" href="income.php">Manage Incomes</a>
                            <a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i>Sign Out</a>
                        </div>
                    </div>
                </div>

            </div>
        </nav>


        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" href="#daily_income" role="tab" data-toggle="tab">Daily Income</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#income" role="tab" data-toggle="tab">Manage Income</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#expense" role="tab" data-toggle="tab">Manage Expense</a>
            </li>

        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active in" id="daily_income">

                <?php


                $query = "SELECT * FROM income where date = '$date'";
                $query_total = "select SUM(retail) as retail,
                                    SUM(Herbal) AS Herbal,
                                    SUM(Massage) as Massage,
                                    SUM(Acupuncture) as Acupuncture,
                                    Sum(other) as other,
                                    (sum(retail)+sum(Herbal)+sum(Massage)+sum(Acupuncture)+sum(other)) as total
                                    from income
                        where date = '$date'";
                $resultSet = $conn->query($query);
                $summation = $conn->query($query_total);

                if ($resultSet->num_rows != 0){
                ?>
                <table class="table table-hover table-border">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Retail (£)</th>
                        <th>Herbal (£)</th>
                        <th>Massage (£)</th>
                        <th>Acupuncture (£)</th>
                        <th>Other (£)</th>
                        <th>Description</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    while ($row = $resultSet->fetch_assoc()) {
                        $id = $row['id'];
                        $retail = $row['retail'];
                        $Herbal = $row['Herbal'];
                        $Massage = $row['Massage'];
                        $Acupuncture = $row['Acupuncture'];
                        $other = $row['other'];
                        $description = $row['description'];
                        $date = $row['date'];

                        echo '<tr>';
                        echo '<td>' . $id . '</td>';
                        echo '<td>' . $retail . '</td>';
                        echo '<td>' . $Herbal . '</td>';
                        echo '<td>' . $Massage . '</td>';
                        echo '<td>' . $Acupuncture . '</td>';
                        echo '<td>' . $other . '</td>';
                        echo '<td>' . $description . '</td>';
                        echo '<td>' . $date . '</td>';
                        echo '</tr>';

                    }

                    echo '</tbody>';
                    echo '<tfoot>';
                    echo ' <tr>';
                    if ($summation->num_rows > 0) {
                        while ($row = $summation->fetch_assoc()) {
                            $retail_sum = $row['retail'];
                            $Herbal_sum = $row['Herbal'];
                            $Massage_sum = $row['Massage'];
                            $Acupuncture_sum = $row['Acupuncture'];
                            $other_sum = $row['other'];
                            echo "<td>Total</td>";
                            echo "<td>£" . $row['retail'] . "</td>";
                            echo "<td>£" . $row['Herbal'] . "</td>";
                            echo "<td>£" . $row['Massage'] . "</td>";
                            echo "<td>£" . $row['Acupuncture'] . "</td>";
                            echo "<td>£" . $row['other'] . "</td>";
                            echo "<td>Daily Total: £" . $row['total'] . "</td>";
                            echo '</tr>';
                            echo '</tfoot>';
                            echo '</table>';
                            ?>

                            <script type="text/javascript">

                                // Load the Visualization API and the corechart package.
                                google.charts.load('current', {'packages': ['corechart']});

                                // Set a callback to run when the Google Visualization API is loaded.
                                google.charts.setOnLoadCallback(drawChart);

                                // Callback that creates and populates a data table,
                                // instantiates the pie chart, passes in the data and
                                // draws it.
                                function drawChart() {

                                    // Create the data table.
                                    var data = new google.visualization.DataTable();
                                    data.addColumn('string', 'Categories');
                                    data.addColumn('number', 'Incomes');
                                    data.addRows([
                                        ['Retail', <?php echo "$retail_sum"; ?>],
                                        ['Herbal', <?php echo "$Herbal_sum"; ?>],
                                        ['Massage', <?php echo "$Massage_sum"; ?>],
                                        ['Acupuncture', <?php echo "$Acupuncture_sum"; ?>],
                                        ['Other', <?php echo "$other_sum"; ?>]
                                    ]);

                                    // Set chart options
                                    var options = {
                                        'title': 'Daily Income Distribution',
                                        'width': 600,
                                        'height': 500
                                    };

                                    // Instantiate and draw our chart, passing in some options.
                                    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                                    chart.draw(data, options);
                                }
                            </script>
                            <?php
                        }
                    }


                    echo '<div id = "chart_div"></div>';
                    } else {
                        echo "There's no income for today yet";
                    }


                    ?>


            </div>

            <div class="tab-pane fade " id="income">
                <form role="form" action="add_income.php" method="post">
                    <div class="row">
                        <div class="col-sm">
                            <label for="retail">Retail: </label>
                            <input type="number" step = "0.01" min = "0" id="retail" name="retail" class="form-control" value="0">
                        </div>

                        <div class="col-sm">
                            <label for="herbal">Herbal: </label>
                            <input type="number" step = "0.01" min = "0" id="herbal" name="herbal" class="form-control" value="0">
                        </div>

                        <div class="col-sm">
                            <label for="massage">Massage:</label>
                            <input type="number" step = "0.01" min = "0" id="massage" name="massage" class="form-control" value="0">
                        </div>

                        <div class="col-sm-offset-1">
                            <label for="acupuncture">Acupuncture: </label>
                            <input type="number" step = "0.01" min = "0" id="acupuncture" name="acupuncture" class="form-control" value="0">
                        </div>

                    </div><!-- eof row -->

                    <div class="row">
                        <div class="col-sm-3">
                            <label for="other">Other: </label>
                            <input type="number" step = "0.01" min = "0" id="other" name="other" class="form-control" value="0">
                        </div>

                        <div class="col-sm">
                            <label for="description">Description: </label>
                            <input type="text" id="description" name="description" class="form-control"
                                   placeholder="enter a description">
                        </div>
                    </div><!-- eof row-->
                    <div class="row">
                        <div class="col-sm-2">
                            <label for="date">Date: </label>
                            <input type="date" id="date" name="date" class="form-control" value="<?php echo $date; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <button type="submit" class="btn btn-primary" value="Submit" name="add_income">Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>


            <div role="tabpanel" class="tab-pane fade" id="expense">

                <form role="form" action="add_expense.php" method="post">
                    <div class="row">
                        <div class="col-sm">
                            <label for="cash">Cash</label>
                            <input type="number" step = "0.01" min = "0"  id="cash" name="cash" class="form-control" value="0">
                        </div>
                        <div class="col-sm">
                            <label for="card">Card</label>
                            <input type="number" step = "0.01" min = "0"  id="card" name="card" class="form-control" value="0">
                        </div>
                        <div class="col-sm">
                            <label for="other">Other</label>
                            <input type="number" step = "0.01" min = "0" id="other" name="other" class="form-control" value="0">
                        </div>
                    </div> <!--eof row-->

                    <div class="row">
                        <div class="col-sm">
                            <label for="description">Description</label>
                            <input type="text" name="description" class="form-control"
                                   placeholder="describe the expense..">
                        </div>
                    </div> <!--eof row-->
                    <div class="row">
                        <div class="col-sm-2">
                            <label for="date">Date</label>
                            <input type="date" id="date" name="date" class="form-control" value="<?php echo $date; ?>">
                        </div>

                        <div class="col-sm-2">
                            <label for="add_expense">&nbsp;</label>
                            <button type="submit" class="form-control btn btn-primary" value="Submit"
                                    name="add_expense">Submit
                            </button>
                        </div>
                    </div>
                    <div class="row">

                    </div>
                </form>

            </div>


        </div>
        <?php
        }
        else {
            echo "You need to log in to view this page!";
            header("refresh:3; url=index.php");
        }
        }
    ?>

