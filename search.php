<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="stylesheets.css">


<style>
	table, td, tr{
		border:1px solid #ddd;
		text-align: left;
	}

	table{
		border-collapse:collapse;
		width:100%;
	}

	th, td{
		padding: 15px;
	}

	</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	</head>

<body>








<?php

include 'include.php';

$resultSet = $conn -> query("select * from patient_info");


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

$query = "select * from patient_info";


echo "<table class = 'table table-striped'>
			<thead>
			<tr>
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
				</thead>";

if($resultSet ->num_rows != 0){
	while($row = $resultSet->fetch_assoc()){
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
		echo "<td>".$row['firstname']."</td>";
		echo "<td>".$row['surname']."</td>";
		echo "<td>".$row['gender']."</td>";
		echo "<td>".$row['dob']."</td>";
		echo "<td>".$row['postcode']."</td>";
		echo "<td>".$row['telephone']."</td>";
		echo "<td>".$row['email']."</td>";
		echo "<td>".$row['marital']."</td>";
		echo "<td>".$row['occupation']."</td>";
		echo "<td>".$row['HIV']."</td>";
		echo "<td>".$row['past_history']."</td>";
		echo "<td>".$row['current_issue']."</td>";
		echo "<td>".$row['allergies']."</td>";
		echo "<td>".$row['current_medication']."</td>";

		echo "</tr>";
		echo "</tbody>";
	
		
}
}else{
	echo "No results found";
}
echo "</table>";

$conn->close();






?>

</body>

</html>