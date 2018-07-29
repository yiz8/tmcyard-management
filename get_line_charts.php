<?php

include 'include.php';


if (isset($_POST['start']) && isset($_POST['end'])) {
    $start_date = mysqli_real_escape_string($conn,$_POST['start']);
    $end_date = mysqli_real_escape_string($conn,$_POST['end']);
    if(isset($_POST['page_no'])){
        $page_no = $_POST['page_no'];
    }else{
        $page_no=1;
    }
    $limit = 5;
    $offset = ($page_no-1)*$limit;

$query = "select date, sum(retail) +sum(herbal) +sum(massage) as total from income where date between '$start_date' and '$end_date' group by date order by date DESC";
$pagination_query = "select date, sum(retail) +sum(herbal) +sum(massage) as total from income where date between '$start_date' and '$end_date' group by date order by date DESC limit $offset, $limit";
$result = $conn->query($pagination_query);
$jsonTable = $conn->query($query);

    if ($result->num_rows != 0) {
        echo "<table class = 'table table-hover table-border'>";
        echo "<thead>";
        echo "<tr>";
        echo " <th>date</th>
               <th>total (£)</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            $date = $row['date'];
            $total = $row['total'];

            echo '<tr>';
            echo '<td>' . $date . '</td>';
            echo '<td>' . $total . '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    }
$pagination_no = $conn->query($query);
$total_results = mysqli_num_rows($pagination_no);
$total_pages = ceil($total_results/$limit);


echo "<nav aria-label='Page navigation' class='mx-auto'>
        <ul class='pagination'>";
for($i = 1; $i<=$total_pages; $i++){
    echo " <li class=\"page-item\"><a class='page-link daily_income_page'  id = '".$i."' href=\"#\">".$i."</a></li>";
}
echo"</ul></nav>";


    $table = array();
    $table['cols']=array(
        array('label'=>'date','type'=>'datetime'),
        array('label'=>'total','type'=>'number')
    );
    $rows = array();
    while($r=mysqli_fetch_assoc($jsonTable)){
        $date = explode("-",$r["date"]);
        $date[1] = $date[1]-1;
        $temp = array();
        $temp[] = array('v'=>'Date('.$date[0].','.$date[1].','.$date[2].')');
        $temp[]=array('v'=>$r['total']);
        $rows[]=array('c'=>$temp);
    }
    $table['rows'] = $rows;
    $jsonData = json_encode($table);
    $script = <<<EOT

                                    <script type="text/javascript">

                                        // Load the Visualization API and the corechart package.
                                        google.charts.load('current', {'packages':['corechart']});

                                        // Set a callback to run when the Google Visualization API is loaded.
                                        google.charts.setOnLoadCallback(drawChart);

                                        // Callback that creates and populates a data table,
                                        // instantiates the pie chart, passes in the data and
                                        // draws it.
                                        function drawChart() {

                                            // Create the data table.
                                            var data = new google.visualization.DataTable('$jsonData');

                                            // Set chart options
                                            var options = {'title':'Total Daily Income(£) By Date',
                                                'width':935,
                                                'height':500};

                                            // Instantiate and draw our chart, passing in some options.
                                            var chart = new google.visualization.LineChart(document.getElementById('daily_display_chart'));
                                            chart.draw(data, options);
                                        }
                                    </script>
EOT;
            echo $script;





}
?>