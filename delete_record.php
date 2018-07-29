<?php
include 'include.php';


$ID = mysqli_real_escape_string($conn,$_GET['id']);
$p_id=mysqli_real_escape_string($conn,$_GET['p_id']);

if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
		}else{
    $query = "DELETE FROM patient_record WHERE record_id = $ID";

    if($conn->query($query) === TRUE){
        echo 'Record deleted, returning to previous page in 3 seconds!';
        header("refresh:3; url=more_details.php?id=$p_id");
    }else{
        echo "Error: ".$query."<br>".$conn->error;
    }
}

		


		mysqli_close($conn);

?>