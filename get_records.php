<?php
include 'include.php';
$id = mysqli_real_escape_string($conn,$_POST['id']);

$recordResult = $conn->query("select * from patient_record where patient_id = $id order by record_date DESC");


echo "<table class = 'table table-striped table-bordered table-hover'>
			<thead>
			<tr>
				<th>Record ID</th>
				<th>Record Content</th>
				<th>Record Date</th>
				<th>Delete</th>
				
				</tr>
				</thead>
				";

if($recordResult ->num_rows != 0){
    while($row = $recordResult->fetch_assoc()){
        echo "<tbody>";
        echo "<tr>";
        echo "<td>".$row['record_id']."</td>";
        echo "<td class='record_content' data-id1='".$row['record_id']."' contenteditable='true'>".$row['record_content']."</td>";
        echo "<td>".$row['record_date']."</td>";
        echo "<td>";
        echo '<a class = "btn btn-danger" href="delete_record.php?id='.$row['record_id'].'&p_id='.$id.'" >Delete</a>';
        echo "</td>";
        echo "</tr>";

        /*
        echo "<tr class = 'collapse out' id = 'record_update'><td>
                        <div>sample text ";
        echo $row['record_id'];
        echo "</div></td></tr>";
        */
        echo "</tbody>";
    }
}else{
    echo "No record found";
}
?>
</table>