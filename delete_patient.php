<DOCTYPE HTML>
<html>
<head>

</head>

<body>

<?php
include 'include.php';


$ID = mysqli_real_escape_string($conn,$_GET['id']);
if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
		} 
			echo "Connected successfully </br>";		
		
		$query = "DELETE FROM `patient_info` WHERE patient_id = $ID";

		if($conn->query($query) === TRUE){
			echo 'Patient Deleted';
			echo "Returning to previous page in 3 seconds...";
			header("refresh:3; url=patient.php");

		}else{
			echo "Error: ".$query."<br>".$conn->error;
		}

		mysqli_close($conn);

?>

</body>

</html>