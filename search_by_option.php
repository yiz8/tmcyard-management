<!DOCTYPE html>
<html>
<head>
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

<div class="container container-fluid">
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

    <div id="search_result">

        <?php
        include 'include.php';

        if (isset($_POST['search_option'])) {

            $searchbox = mysqli_real_escape_string($conn,$_POST['searchbox']);
            $selection = mysqli_real_escape_string($conn,$_POST['search_option']);

            if ($selection === 'name') {
                $query = "SELECT * FROM patient_info where firstname like '%$searchbox%' or surname like '%$searchbox%'";
            } else if ($selection === 'email') {
                $query = "SELECT * FROM patient_info where email like '%$searchbox%'";
            } else if ($selection === 'phone') {
                $query = "SELECT * FROM patient_info where telephone like '%$searchbox%'";
            } else if ($selection === 'postcode') {
                $query = "SELECT * FROM patient_info where postcode like '%$searchbox%'";
            } else if ($selection === 'gender') {
                $query = "SELECT * FROM patient_info where gender like '%$searchbox%'";
            }


            $resultSet = $conn->query($query);


            echo "<table class = 'table table-condensed table-striped table-hover table-bordered '>
			<thead>
			<tr>
				<th>Patient ID</th>
				<th>Firstname</th>
				<th>Lastname</th>
				<th>Gender</th>
				<th>Date of Birth</th>				
				<th>More Details</th>
				<th>Delete Patient</th>
				</tr>
				</thead>";

            if ($resultSet->num_rows != 0) {
                while ($row = $resultSet->fetch_assoc()) {



                    echo "<tbody>";
                    echo "<tr>";
                    echo "<td>" . $row['patient_id'] . "</td>";
                    echo "<td>" . $row['firstname'] . "</td>";
                    echo "<td>" . $row['surname'] . "</td>";
                    echo "<td>" . $row['gender'] . "</td>";
                    echo "<td>" . $row['dob'] . "</td>";

                    echo '<td>';
                    echo '<a class = "btn btn-info" href="more_details.php?id=' . $row['patient_id'] . '">More Details</a>';

                    echo "</td>";
                    echo '<td>';
                    echo '<a class = "btn btn-danger" href="delete_patient.php?id=' . $row['patient_id'] . '">Delete</a>';
                    echo "</td>";
                    echo '</tr>';
                    echo '</tbody>';


                }
            } else {
                echo 'No results found';
            }
            echo '</table>';

            $conn->close();
        }


        ?>
    </div>
</div>
</body>

</html>