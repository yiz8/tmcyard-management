<?php

include 'include.php';


if (isset($_POST['start']) && isset($_POST['end'])) {
    $start_date = mysqli_real_escape_string($conn,$_POST['start']);
    $end_date = mysqli_real_escape_string($conn,$_POST['end']);

    //pagination setup
    if(isset($_POST['page_no'])){
        // if page number was posted, assigning the page number as posted
        $page_no = $_POST['page_no'];
    }else{
        //if no page number was posted, set page number to 1
        $page_no=1;
    }
    //number of records to display per page
    $limit = 5;
    $offset = ($page_no-1)*$limit;

    $query = "select date, sum(cash) as cash, sum(card) as card,sum(other) as other, (sum(cash)+sum(card)+sum(other)) as total from expense where date between '$start_date' and '$end_date' group by date ";

    $jsonTable = $conn->query($query);
    $pagination_query="select date, sum(cash) as cash, sum(card) as card,sum(other) as other, (sum(cash)+sum(card)+sum(other)) as total from expense where date between '$start_date' and '$end_date' group by date limit $offset,$limit";
    $result = $conn->query($pagination_query);

    if ($result->num_rows != 0) {
        echo "<table class = 'table table-hover table-border'>";
        echo "<thead>";
        echo "<tr>";
        echo " <th>date</th>
               <th>cash (£)</th>
               <th>card (£)</th>
               <th>other(£)</th>
               <th>total(£)</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            $date = $row['date'];
            $cash = $row['cash'];
            $card = $row['card'];
            $other =$row['other'];
            $total = $row['total'];


            echo '<tr>';
            echo '<td>' . $date . '</td>';
            echo '<td>' . $cash . '</td>';
            echo '<td>' . $card . '</td>';
            echo '<td>' . $other. '</td>';
            echo '<td>' . $total. '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    }

    $pagination_no=$conn->query($query);
    $total_results=mysqli_num_rows($pagination_no);
    $total_pages = ceil($total_results/$limit);

    echo "<nav aria-label='Page navigation' class='mx-auto'>
        <ul class='pagination'>";
    for($i = 1; $i<=$total_pages; $i++){
        echo " <li class=\"page-item\"><a class='page-link total_expense_page'  id = '".$i."' href=\"#\">".$i."</a></li>";
    }
    echo"</ul></nav>";



    $table = array();
    //setting up the array for storing data to be used for google charts
    $table['cols']=array(
        array('label'=>'date','type'=>'datetime'),
        array('label'=>'cash','type'=>'number'),
        array('label'=>'card', 'type'=>'number'),
        array('label'=>'other','type'=>'number')

    );
    $rows = array();
    while($r=mysqli_fetch_assoc($jsonTable)){
        $date = explode("-",$r["date"]);
        $date[1] = $date[1]-1;
        $temp = array();
        $temp[] = array('v'=>'Date('.$date[0].','.$date[1].','.$date[2].')');
        $temp[]=array('v'=>$r['cash']);
        $temp[]=array('v'=>$r['card']);
        $temp[]=array('v'=>$r['other']);
        $rows[]=array('c'=>$temp);
    }
    $table['rows'] = $rows;
    $jsonData = json_encode($table);
    $script = <<<EOT

                                    <script type="text/javascript">

                                        // Load the Visualization API and the corechart package.
                                        google.charts.load('current', {'packages':['bar']});

                                        // Set a callback to run when the Google Visualization API is loaded.
                                        google.charts.setOnLoadCallback(drawChart);

                                        // Callback that creates and populates a data table,
                                        // instantiates the pie chart, passes in the data and
                                        // draws it.
                                        function drawChart() {

                                            // Create the data table.
                                            var data = new google.visualization.DataTable('$jsonData');

                                            // Set chart options
                                            var options = {'title':'Expenses(£) By Date',
                                                'width':935,
                                                'height':600};

                                            // Instantiate and draw our chart, passing in some options.
                                            var chart = new google.charts.Bar(document.getElementById('expense_display_chart'));
                                            chart.draw(data, options);
                                        }
                                    </script>
EOT;
    echo $script;





}
