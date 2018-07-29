<?php
session_start();


if (isset($_SESSION['logged_in'])){
if($_SESSION['userType']=='1'){
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8"/>
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

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">


        <link rel="stylesheet" href="stylesheets.css">


        <title>Manage Patients</title>
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
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="patient.php">Manage Patients</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="income.php">Manage Income</a>
                    </li>
                    <li class = "nav-item">
                        <a class = "nav-link" href="users.php">Manage Users</a>
                    </li>
                    <li class="nav-item active">
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
        <div id ="tab_nav">
            <ul class = "nav nav-tabs" role ="tablist">
                <li class = "nav-item">
                    <a class = "nav-link active" href = "#total_distribution" role="tab" data-toggle="tab">Total Income Distribution</a>
                </li>
                <li class = "nav-item">
                    <a class = "nav-link" href = "#daily_distribution" role="tab" data-toggle="tab">Daily Income Distribution</a>
                </li>

                <li class = "nav-item">
                    <a class = "nav-link" href = "#total_expense_distribution" role = "tab" data-toggle="tab">Total Expense Distribution</a>
                </li>

            </ul>
        </div><!--end of tablist-->
    <div class = "tab-content">
        <div role = "tabpanel" class = "tab-pane active in" id = "total_distribution">
            <p>Select date ranges to generate the detailed table and chart:</p>

            <form id="date_select">
                <div class = "form-group">
                    <label for ="total_start_date">Start Date</label>
                    <input type = "date" id = "total_start_date" name = "total_start_date">
                    <label for = "total_end_date">End Date</label>
                    <input type = "date" id = "total_end_date" name = "total_end_date">
               <button type = "button" class = "btn btn-primary" id = "total_get_piecharts" name = "submit">Submit</button>
                </div>

            </form>
            <div class = "jumbotron">

            <script>
                $(document).ready(function(){
                    $("#total_get_piecharts").on("click",function(){
                        var start_date = $.trim($('#total_start_date').val());
                        var end_date  = $.trim($('#total_end_date').val());
                        $.ajax({
                            url: "get_pie_charts.php",
                            data:{start:start_date,end:end_date},
                            type:"POST",
                            dataType:"html",
                            success:function(data){
                                $("#total_display_data").html(data);
                            }
                        });
                    });

                    $(document).on('click','.total_income_page',function() {
                        var page_no = $(this).attr("id");
                        var start_date = $.trim($('#total_start_date').val());
                        var end_date = $.trim($('#total_end_date').val());
                        $.ajax({
                            url: "get_pie_charts.php",
                            data: {start: start_date, end: end_date, page_no: page_no},
                            type: "POST",
                            dataType: "html",
                            success: function (data) {
                                $("#total_display_data").html(data);
                            }
                        })
                    })





                });


            </script>

            <div id="total_display_data"></div><!--data table display-->
            <div id = "total_display_chart"></div><!--chart display-->

        </div>
        </div>


        <div class = "tab-pane fade" id = "daily_distribution">
            <div role = "tabpanel" class = "tab-pane active in" id = "daily_distribution">
                <p>Select date ranges to generate the detailed table and chart:</p>

                <form id="date_select">
                    <div class = "form-group">
                        <label for ="daily_start_date">Start Date</label>
                        <input type = "date" id = "daily_start_date" name = "start_date">
                        <label for = "daily_end_date">End Date</label>
                        <input type = "date" id = "daily_end_date" name = "end_date">
                        <button type = "button" class = "btn btn-primary" id = "daily_get_linecharts" name = "submit">Submit</button>
                    </div>

                </form>

                <div class = "jumbotron">
                    <script>
                        $(document).ready(function(){

                            $("#daily_get_linecharts").on("click",function(){
                                var start_date = $.trim($('#daily_start_date').val());
                                var end_date  = $.trim($('#daily_end_date').val());
                                $.ajax({
                                    url: "get_line_charts.php",
                                    data:{start:start_date,end:end_date},
                                    type:"POST",
                                    dataType:"html",
                                    success:function(data){
                                        $("#daily_display_data").html(data);
                                    }
                                });
                            });


                            $(document).on('click','.daily_income_page',function() {
                                var page_no = $(this).attr("id");
                                var start_date = $.trim($('#daily_start_date').val());
                                var end_date = $.trim($('#daily_end_date').val());
                                $.ajax({
                                    url: "get_line_charts.php",
                                    data: {start: start_date, end: end_date, page_no: page_no},
                                    type: "POST",
                                    dataType: "html",
                                    success: function (data) {
                                        $("#daily_display_data").html(data);
                                    }
                                })
                            })


                        });
                    </script>

                    <div id = "daily_display_data" class = "mx-auto"></div>
                    <div id = "daily_display_chart"></div>
             </div>
            </div>
        </div><!--end of tab-->


        <div class = "tab-pane fade" id = "total_expense_distribution">
            <p>Select date ranges to generate the detailed table and chart:</p>

            <form id="date_select">
                <div class = "form-group">
                    <label for ="expense_start_date">Start Date</label>
                    <input type = "date" id = "expense_start_date" name = "start_date">
                    <label for = "expense_end_date">End Date</label>
                    <input type = "date" id = "expense_end_date" name = "end_date">
                    <button type = "button" class = "btn btn-primary" id = "total_get_columncharts" name = "submit">Submit</button>
                </div>
            </form>

            <div class = "jumbotron">
                <script>
                    $(document).ready(function(){
                        $("#total_get_columncharts").on("click",function(){
                            var start_date = $.trim($('#expense_start_date').val());
                            var end_date  = $.trim($('#expense_end_date').val());
                            $.ajax({
                                url: "get_column_charts.php",
                                data:{start:start_date,end:end_date},
                                type:"POST",
                                dataType:"html",
                                success:function(data){
                                    $("#expense_display_data").html(data);
                                }
                            });
                        });


                        $(document).on('click','.total_expense_page',function() {
                            var page_no = $(this).attr("id");
                            var start_date = $.trim($('#expense_start_date').val());
                            var end_date = $.trim($('#expense_end_date').val());
                            $.ajax({
                                url: "get_column_charts.php",
                                data: {start: start_date, end: end_date, page_no: page_no},
                                type: "POST",
                                dataType: "html",
                                success: function (data) {
                                    $("#expense_display_data").html(data);
                                }
                            })
                        })
                    });








                </script>
                <div id = "expense_display_data"></div>
                <div id = "expense_display_chart"></div>

            </div>
        </div>


        </div><!--end of tab-->



        </div> <!--end of tab content-->
    </div><!--end of container-->

    </body>
    </html>

    <?php
} else if($_SESSION['userType']=='2'){
    echo "You do not have permission to view this page!";
    header("refresh:3; url=index.php");
} else{
    echo "You need to log in before using this page!";
    header("refresh:3; url=index.php");
}
}
?>
