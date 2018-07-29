<?php
session_start();
if (isset($_SESSION['logged_in'])) {
    if($_SESSION['userType']=='1'){


    ?>
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

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css"
              integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg"
              crossorigin="anonymous">


        <link rel="stylesheet" href="stylesheets.css">
        <script src='/js/tinymce/tinymce.min.js'></script>

        <script type="text/javascript">
            tinymce.init({
                selector: '#editor',  // change this value according to your HTML
                plugins: "code image",
                //toolbar: 'undo redo | image code',
                image_caption: true,


            });
        </script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
              integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
              crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
                integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
                crossorigin="anonymous"></script>
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

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
                    <li class="nav-item active">
                        <a class="nav-link" href="patient.php">Manage Patients</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="income.php">Manage Income</a>
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
        <div id="patient_update" ></div>
        <script>
            $(document).ready(function(){
                function edit_patient(p_id,p_text,p_column_name){

                    $.ajax({
                        url:'edit_patient.php',
                        method:'post',
                        data:{id: p_id,text: p_text, column_name: p_column_name },
                        dataType:'text',
                        success:function(p_data){
                            $('#patient_update').html(p_data)
                        }
                    })
                }

                $(document).on('blur', '.firstname', function () {
                    var p_id = $(this).data('p_id');
                    console.log(p_id);
                    var firstname = $(this).text();
                    console.log(firstname);
                    edit_patient(p_id, firstname, 'firstname');
                })

                $(document).on('blur', '.surname', function () {
                    var p_id = $(this).data('p_id');
                    var surname = $(this).text();
                    edit_patient(p_id, surname, 'surname');

                })

                $(document).on('blur', '.gender', function () {
                    var p_id = $(this).data('p_id');
                    var gender = $(this).text();
                    edit_patient(p_id, gender, 'gender');
                })

                $(document).on('blur', '.dob', function () {
                    var p_id = $(this).data('p_id');
                    var dob = $(this).text();
                    edit_patient(p_id, dob, 'dob');
                })

                $(document).on('blur', '.postcode', function () {
                    var p_id = $(this).data('p_id');
                    var postcode = $(this).text();
                    edit_patient(p_id, postcode, 'postcode');
                })

                $(document).on('blur', '.telephone', function () {
                    var p_id = $(this).data('p_id');
                    var telephone = $(this).text();
                    edit_patient(p_id, telephone, 'telephone');
                })

                $(document).on('blur', '.email', function () {
                    var p_id = $(this).data('p_id');
                    var email = $(this).text();
                    edit_patient(p_id, email, 'email');
                })

                $(document).on('blur', '.marital', function () {
                    var p_id = $(this).data('p_id');
                    var marital = $(this).text();
                    edit_patient(p_id, marital, 'marital');
                })

                $(document).on('blur', '.occupation', function () {
                    var p_id = $(this).data('p_id');
                    var occupation = $(this).text();
                    edit_patient(p_id, occupation, 'occupation');
                })

                $(document).on('blur', '.HIV', function () {
                    var p_id = $(this).data('p_id');
                    var HIV = $(this).text();
                    edit_patient(p_id, HIV, 'HIV');
                })

                $(document).on('blur', '.past_history', function () {
                    var p_id = $(this).data('p_id');
                    var past_history = $(this).text();
                    edit_patient(p_id, past_history, 'past_history');
                })

                $(document).on('blur', '.current_issue', function () {
                    var p_id = $(this).data('p_id');
                    var current_issue = $(this).text();
                    edit_patient(p_id, current_issue, 'current_issue');
                })

                $(document).on('blur', '.allergies', function () {
                    var p_id = $(this).data('p_id');
                    var allergies = $(this).text();
                    edit_patient(p_id, allergies, 'allergies');
                })

                $(document).on('blur', '.current_medication', function () {
                    var p_id = $(this).data('p_id');
                    var current_medication = $(this).text();
                    edit_patient(p_id, current_medication, 'current_medication');
                })

            })

        </script>

        <?php

        include 'include.php';

        /*patient ID*/
        $ID = mysqli_real_escape_string($conn,$_GET['id']);
        $resultSet = $conn->query("select * from patient_info where patient_id = $ID");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            echo "<p class = 'text-primary'>Displaying Patient Information</p>";
        }


        $query = "select * from patient_info where patient_id = $ID";
        $result = $conn->query($query);

        ?>

        <table class='table table-hover table-striped table-bordered'>
            <thead>
            <tr>
                <th>ID</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Gender</th>
                <th>Date of Birth</th>
                <th>Postcode</th>
                <th>Telephone</th>
                <th>Email</th>
                <th>Marital Status</th>
                <th>Occupation</th>
                <th>HIV Postive?</th>
                <th>Past History</th>
                <th>Current Issue</th>
                <th>Allergies</th>
                <th>Current Medication</th>

            </tr>
            </thead>
            <?php
            if ($resultSet->num_rows != 0) {
                while ($row = $resultSet->fetch_assoc()) {
                    $id = $row['patient_id'];
                    $fname = $row['firstname'];
                    $sname = $row['surname'];
                    $gender = $row['gender'];
                    $postcode = $row['postcode'];
                    $telephone = $row['telephone'];
                    $email = $row['email'];
                    $marital = $row ['marital'];
                    $occupation = $row['occupation'];
                    $HIV = $row['HIV'];
                    $past_history = $row['past_history'];
                    $current_issue = $row['current_issue'];
                    $allergies = $row['allergies'];
                    $medication = $row['current_medication'];
                    $dob = $row['dob'];


                    echo "<tbody>";
                    echo "<tr>";
                    echo "<td  id ='p_id' >" . $id . "</td>";
                    echo "<td class = 'firstname' data-p_id='".$id."' contenteditable = 'true'>" . $row['firstname'] . "</td>";
                    echo "<td class = 'surname' data-p_id='".$id."' contenteditable = 'true'>" . $row['surname'] . "</td>";
                    echo "<td class = 'gender' data-p_id='".$id."' contenteditable = 'true'>" . $row['gender'] . "</td>";
                    echo "<td class = 'dob' data-p_id='".$id."' contenteditable = 'true'>" . $row['dob'] . "</td>";
                    echo "<td class = 'postcode' data-p_id='".$id."' contenteditable = 'true'>" . $row['postcode'] . "</td>";
                    echo "<td class = 'telephone' data-p_id='".$id."' contenteditable = 'true'>" . $row['telephone'] . "</td>";
                    echo "<td class = 'email' data-p_id='".$id."' contenteditable = 'true'>" . $row['email'] . "</td>";
                    echo "<td class = 'marital' data-p_id='".$id."' contenteditable = 'true'>" . $row['marital'] . "</td>";
                    echo "<td class = 'occupation' data-p_id='".$id."' contenteditable = 'true'>" . $row['occupation'] . "</td>";
                    echo "<td class = 'HIV' data-p_id='".$id."' contenteditable = 'true'>" . $row['HIV'] . "</td>";
                    echo "<td class = 'past_history' data-p_id='".$id."' contenteditable = 'true'>" . $row['past_history'] . "</td>";
                    echo "<td class = 'current_issue' data-p_id='".$id."' contenteditable = 'true'>" . $row['current_issue'] . "</td>";
                    echo "<td class = 'allergies' data-p_id='".$id."' contenteditable = 'true'>" . $row['allergies'] . "</td>";
                    echo "<td class = 'current_medication' data-p_id='".$id."' contenteditable = 'true'>" . $row['current_medication'] . "</td>";


                    echo "</tr>";
                    echo "</tbody>";


                }
            } else {
                echo "No results found";
            }
            ?>
        </table>

        <script>
//            $(document).ready(function (id,text,column_name) {
                $(document).ready(function (){
                function fetch_records() {
                    var p_id = document.getElementById("p_id").textContent;
                    $.ajax({
                        url: "get_records.php",
                        method: 'post',
                        data: {id: p_id},
                        dataType: 'html',
                        success: function (data) {
                            $('#record_table').html(data)
                        }

                    })
                }

                fetch_records();

                function edit_record(id, text, column_name) {
                    $.ajax({
                        url: "edit_records.php",
                        method: 'post',
                        data: {id: id, text: text, column_name: column_name},
                        dataType: 'text',
                        success: function (data) {
                            $('#update_result').html(data)
                        }

                    })
                }


//            TODO: needs bug fix
//            function add_record(p_id,record_content,record_date){
//                $.ajax({
//                    url:"add_record.php",
//                    method:'post',
//                    data:{p_id:p_id,record_content:record_content,record_date:record_date},
//                    dataType:'text',
//                    success:function(data){
//                        $('#update_result').html(data)
//                    }
//
//                })
//            }
//            $(document).on('click','.btn_add',function(){
//                var p_id=document.getElementById("p_id").textContent;
//                var record_date= document.getElementById("date").textContent;
//                var record_content= tinyMCE.active.getContent();
//                add_record(p_id,record_content,record_date)
//            })

//            $(document).on('click','btn_add',function(){
//                var p_id = document.getElementById("p_id").textContent;
//                var date=$('#date').text();
//                var record_content = $('.record_content').text();
//                //console.log(p_id);
//                console.log(date);
//                console.log(record_content);
//                $.ajax({
//                    url:"add_record.php",
//                    method:"post",
//                    data:{p_id:p_id,date:date,record_content:record_content},
//                    dataType:"text",
//                    success:function(data){
//                        $('#update_result').html(data);
//                        fetch_records();
//                    }
//                })
//
//
//            })

                // Edit table data
                $(document).on('blur', '.record_content', function () {
                    var r_id = $(this).data('id1');
                    var record_content = $(this).text();
                    edit_record(r_id, record_content, 'record_content');
                    fetch_records();
                })




            })
        </script>
        <p id="update_result"></p>
        <div id="record_table"></div>
        <div id="addRecord">
            <form action=" <?php echo "add_record.php?id= $ID"; ?>" id="record_form" name="addRecord" method="post">
                <p class="text-primary">Add a new record:</p>
                <label for="date">Date</label>
                <input type="date" id="date" name="date" value="<?php echo $date; ?>">
                <button type="submit" class="btn btn-primary btn_add" name="add_record">Submit</button>
                <textarea id="editor" form="record_form" name="record_content" class="record_content">

    </textarea>
            </form>


        </div><!--End of add reocrd text area -->


    </div><!--End of container-->


    </body>


    </div>

    </div>
    </body>

    </html>
    <?php
    $conn->close();
} else if($_SESSION['userType']=='2'){
        ?>
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

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css"
              integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg"
              crossorigin="anonymous">


        <link rel="stylesheet" href="stylesheets.css">
        <script src='/js/tinymce/tinymce.min.js'></script>

        <script type="text/javascript">
            tinymce.init({
                selector: '#editor',  // change this value according to your HTML
                plugins: "code image",
                //toolbar: 'undo redo | image code',
                image_caption: true,


            });
        </script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
              integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
              crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
                integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
                crossorigin="anonymous"></script>
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

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
                    <li class="nav-item active">
                        <a class="nav-link" href="patient.php">Manage Patients</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="income.php">Manage Income</a>
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


        <?php

        include 'include.php';

        /*patient ID*/
        $ID = mysqli_real_escape_string($conn,$_GET['id']);
        $resultSet = $conn->query("select * from patient_info where patient_id = $ID ");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            echo "<p class = 'text-primary'>Displaying Patient Information</p>";
        }


        $query = "select * from patient_info where patient_id = $ID";
        $result = $conn->query($query);

        ?>

        <table class='table table-hover table-striped table-bordered'>
            <thead>
            <tr>
                <th>ID</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Gender</th>
                <th>Date of Birth</th>
                <th>Postcode</th>
                <th>Telephone</th>
                <th>Email</th>
                <th>Marital Status</th>
                <th>Occupation</th>
                <th>HIV Postive?</th>
                <th>Past History</th>
                <th>Current Issue</th>
                <th>Allergies</th>
                <th>Current Medication</th>
            </tr>
            </thead>
            <?php
            if ($resultSet->num_rows != 0) {
                while ($row = $resultSet->fetch_assoc()) {
                    $id = $row['patient_id'];
                    $fname = $row['firstname'];
                    $sname = $row['surname'];
                    $age = $row['age'];
                    $gender = $row['gender'];
                    $postcode = $row['postcode'];
                    $telephone = $row['telephone'];
                    $email = $row['email'];
                    $marital = $row ['marital'];
                    $occupation = $row['occupation'];
                    $HIV = $row['HIV'];
                    $past_history = $row['past_history'];
                    $current_issue = $row['current_issue'];
                    $allergies = $row['allergies'];
                    $medication = $row['current_medication'];
                    $dob = $row['dob'];


                    echo "<tbody>";
                    echo "<tr>";
                    echo "<td  id ='p_id' >" . $id . "</td>";
                    echo "<td>" . $row['firstname'] . "</td>";
                    echo "<td>" . $row['surname'] . "</td>";
                    echo "<td>" . $row['gender'] . "</td>";
                    echo "<td>" . $row['dob'] . "</td>";
                    echo "<td>" . $row['postcode'] . "</td>";
                    echo "<td>" . $row['telephone'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['marital'] . "</td>";
                    echo "<td>" . $row['occupation'] . "</td>";
                    echo "<td>" . $row['HIV'] . "</td>";
                    echo "<td>" . $row['past_history'] . "</td>";
                    echo "<td>" . $row['current_issue'] . "</td>";
                    echo "<td>" . $row['allergies'] . "</td>";
                    echo "<td>" . $row['current_medication'] . "</td>";

                    echo "</tr>";
                    echo "</tbody>";


                }
            } else {
                echo "No results found";
            }
            ?>
        </table>

        <script>
            $(document).ready(function () {
                function fetch_records() {
                    var p_id = document.getElementById("p_id").textContent;
                    $.ajax({
                        url: "get_records.php",
                        method: 'post',
                        data: {id: p_id},
                        dataType: 'html',
                        success: function (data) {
                            $('#record_table').html(data)
                        }

                    })
                }

                fetch_records();

                function edit_record(id, text, column_name) {
                    $.ajax({
                        url: "edit_records.php",
                        method: 'post',
                        data: {id: id, text: text, column_name: column_name},
                        dataType: 'text',
                        success: function (data) {
                            $('#update_result').html(data)
                        }

                    })
                }


                //TODO: needs bug fix on button click
//            function add_record(p_id,record_content,record_date){
//                $.ajax({
//                    url:"add_record.php",
//                    method:'post',
//                    data:{p_id:p_id,record_content:record_content,record_date:record_date},
//                    dataType:'text',
//                    success:function(data){
//                        $('#update_result').html(data)
//                    }
//
//                })
//            }
//            $(document).on('click','.btn_add',function(){
//                var p_id=document.getElementById("p_id").textContent;
//                var record_date= document.getElementById("date").textContent;
//                var record_content= tinyMCE.active.getContent();
//                add_record(p_id,record_content,record_date)
//            })

                // Edit table data
                $(document).on('blur', '.record_content', function () {
                    var r_id = $(this).data('id1');
                    var record_content = $(this).text();
                    edit_record(r_id, record_content, 'record_content');
                    fetch_records();
                })

//            $(document).on('click','btn_add',function(){
//                var p_id = document.getElementById("p_id").textContent;
//                var date=$('#date').text();
//                var record_content = $('.record_content').text();
//                //console.log(p_id);
//                console.log(date);
//                console.log(record_content);
//                $.ajax({
//                    url:"add_record.php",
//                    method:"post",
//                    data:{p_id:p_id,date:date,record_content:record_content},
//                    dataType:"text",
//                    success:function(data){
//                        $('#update_result').html(data);
//                        fetch_records();
//                    }
//                })
//
//
//            })


            })
        </script>
        <p id="update_result"></p>
        <div id="record_table"></div>
        <div id="addRecord">
            <form action=" <?php echo "add_record.php?id= $ID"; ?>" id="record_form" name="addRecord" method="post">
                <p class="text-primary">Add a new record:</p>
                <label for="date">Date</label>
                <input type="date" id="date" name="date" value="<?php echo $date; ?>">
                <button type="submit" class="btn btn-primary btn_add" name="add_record">Submit</button>
                <textarea id="editor" form="record_form" name="record_content" class="record_content">

    </textarea>
            </form>


        </div><!--End of add reocrd text area -->


        </div><!--End of container-->


        </body>


        </div>

        </div>
        </body>

        </html>
        <?php
    $conn->close();
} else{
        echo "You need to log in before using this page!";
        header("refresh:3; url=index.php");
    }
}
?>

