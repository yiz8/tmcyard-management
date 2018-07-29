<?php
include 'include.php';
session_start();


if (isset($_SESSION['logged_in'])) {
    if ($_SESSION['userType'] == '1') {

        ?>

        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8"/>
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

            <script src="clock.js"></script>

            <title>Manage Patients</title>
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
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="patient.php">Manage Patients</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="income.php">Manage Income</a>
                        </li>
                        <li class="nav-item active">
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
                                <a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i>Sign
                                    Out</a>
                            </div>
                        </div>
                    </div>

                </div>
            </nav>

            <div class="row">
                <div id="update_result" class="col-sm-3"></div>
            </div>
            <div id="table_data"></div>


            <script>
                $(document).ready(function () {

                    function fetch_users() {
                        $.ajax({
                            url: "get_users.php",
                            //method:"POST",
                            dataType: "html",
                            success: function (data) {
                                $('#table_data').html(data);
                            }
                        });
                    }

                    fetch_users();

                    function edit_data(id, text, column_name) {
                        $.ajax({
                            url: "edit_user.php",
                            method: 'post',
                            data: {id: id, text: text, column_name: column_name},
                            dataType: "text",
                            success: function (data) {
                                $('#update_result').html(data)
                            }
                        })
                    }

                    $(document).on('blur', '.username', function () {
                        var id = $(this).data('id1');
                        var username = $(this).text();
                        edit_data(id, username, "username");
                    });

                    $(document).on('blur', '.first_name', function () {
                        var id = $(this).data('id2');
                        var first_name = $(this).text();
                        edit_data(id, first_name, "first_name");
                    });

                    $(document).on('blur', '.last_name', function () {
                        var id = $(this).data('id3');
                        var last_name = $(this).text();
                        edit_data(id, last_name, "last_name");
                    });

                    $(document).on('blur', '.userType', function () {
                        var id = $(this).data('id4');
                        var userType = $('#user_type option:selected').val();
                        edit_data(id, userType, "userType");
                    });

                    $(document).on('click', '.btn_delete', function () {
                        var id = $(this).data('id5');
                        if (confirm("Are you sure you want to delete this user?")) {
                            $.ajax({
                                url: "delete_user.php",
                                method: "post",
                                data: {id: id},
                                dataType: "text",
                                success: function (data) {
                                    $('#update_result').html(data);
                                    fetch_users();
                                }
                            })
                        }
                    })
                });

                $(document).on('click', '.close', function () {
                    $(".notification").remove();
                })


            </script>
            <button class="btn btn-success" type="button" data-toggle="modal" data-target="#register"><i
                        class="fas fa-user-plus"></i>Add User
            </button>

            <div class="modal fade" id="register">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add New User</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                            <form action="registration.php" method="post">
                                <div class="row align-items-center justify-content-center">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="register_username">Your Email</label>
                                            <input type="email" class="form-control" name="username" id="username"
                                                   placeholder="Email Address" pattern = "^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$" title ="Please enter a valid email address. e.g: john@smith.com" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row align-items-center justify-content-center">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="first_name">First Name</label>
                                            <input type="text" class="form-control" name="first_name" id="first_name"
                                                   placeholder="First Name" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row align-items-center justify-content-center">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="last_name">Last Name</label>
                                            <input type="text" class="form-control" name="last_name" id="last_name"
                                                   placeholder="Last Name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center justify-content-center">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="register_password">Your Password</label>
                                            <input type="password" class="form-control" name="password"
                                                   id="register_password"
                                                   placeholder="Password" pattern ="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$"
                                                   title="passwords must be at least 8 characters long, and contains at least 1 numeric value and 1 alphabet value"
                                                   required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center justify-content-center">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="confirm_password">Confirm Password</label>
                                            <input type="password" class="form-control" name="confirm_password"
                                                   id="confirm_password" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" placeholder="Input Password Again" required>
                                            <span id="matching"></span>
                                        </div>

                                    </div>
                                </div>

                                <div class="row align-items-center justify-content-center">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="user_type">Select User Group</label>
                                            <select name="user_type">
                                                <option value="2">User</option>
                                                <option value="1">Administrator</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row align-items-center justify-content-center">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <button type="submit" id="submit" name="add_user" class="btn btn-success" >Register
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <script>
             $('#register_password,#confirm_password').on('keyup',function(){
                 if($('#register_password').val()==$('#confirm_password').val()){
                     $('#matching').attr('class','text-success');
                     $('#matching').html('Passwords Match');
                     document.getElementById('submit').disabled=false;

                 }else{
                     $('#matching').attr('class','text-danger');
                     $('#matching').html('Passwords Do Not Match');
                     document.getElementById('submit').disabled=true;

                 }

             })

            </script>

        </div>
        </body>
        </html>

        <?php
    } else if (isset($_SESSION['logged_in'])) {
        if ($_SESSION['userType'] == '2') {
            echo "You do not have permission to view this page!";
            header("refresh:3; url=index.php");
        }
    } else {
        echo "You need to log in before using this page!";
        header("refresh:3; url=index.php");
    }
}
?>

