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


    $query = "select * from income where date BETWEEN '$start_date' AND '$end_date'";
    $query_total = "select SUM(retail) as retail,
                                    SUM(Herbal) AS Herbal,
                                    SUM(Massage) as Massage,
                                    SUM(Acupuncture) as Acupuncture,
                                    Sum(other) as other,
                                    (sum(retail)+sum(Herbal)+sum(Massage)+sum(Acupuncture)+sum(other)) as total
                                    from income
                        where date BETWEEN '$start_date' AND '$end_date'";
    $summation = $conn->query($query_total);

    $pagination_query="select * from income where date between '$start_date' and '$end_date' limit $offset, $limit";
    $result = $conn->query($pagination_query);

    if ($result->num_rows != 0) {
        echo "<table class = 'table table-hover table-border'>";
        echo "<thead>";
        echo "<tr>";
        echo " <th>ID</th>
                        <th>Retail (£)</th>
                        <th>Herbal (£)</th>
                        <th>Massage (£)</th>
                        <th>Acupuncture (£)</th>
                        <th>Other (£)</th>
                        <th>Description</th>
                        <th>Date</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
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
                echo "<td>Total: £" . $row['total'] . "</td>";
                echo '</tr>';
                echo '</tfoot>';
                echo '</table>';
            }

          $pagination_no = $conn->query($query);
          $total_results = mysqli_num_rows($pagination_no);
          $total_pages = ceil($total_results/$limit);
            echo "<nav aria-label='Page navigation' class='mx-auto'>
                    <ul class='pagination'>";
            for($i = 1; $i<=$total_pages; $i++){
                echo " <li class=\"page-item\"><a class='page-link total_income_page'  id = '".$i."' href=\"#\">".$i."</a></li>";
            }
            echo"</ul></nav>";


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
                                            var data = new google.visualization.DataTable();
                                            data.addColumn('string', 'Categories');
                                            data.addColumn('number', 'Incomes');
                                            data.addRows([
                                                ['Retail', $retail_sum ],
                                                ['Herbal', $Herbal_sum ],
                                                ['Massage', $Massage_sum],
                                                ['Acupuncture',$Acupuncture_sum],
                                                ['Other', $other_sum]
                                            ]);

                                            // Set chart options
                                            var options = {'title':'Income Distribution',
                                                'width':935,
                                                'height':500};

                                            // Instantiate and draw our chart, passing in some options.
                                            var chart = new google.visualization.PieChart(document.getElementById('total_display_chart'));
                                            chart.draw(data, options);
                                        }
                                    </script>
EOT;
echo $script;

        }

        }

}
?>