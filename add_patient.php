<?php
	include 'include.php';

	if(isset($_POST['add_data'])){	

		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$gender = $_POST['gender_select'];
		$dob = $_POST['dob'];
		$postcode = $_POST['postcode'];
		$telephone = $_POST['telephone'];
		$email = $_POST['email'];
		$marital = $_POST['marital'];
		$occupation = $_POST['occupation'];
		$HIV = $_POST['HIV'];
		$past_history = $_POST['illness'];
		$current_issue = $_POST['issue'];
		$allergies = $_POST['allergies'];
		$medication = $_POST['medication'];	


		// Check connection
/*	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
		} 
		echo "Connected successfully";
		*/
		
		$query = $conn->prepare("INSERT INTO patient_info(firstname, surname, gender, postcode, telephone, email, marital, occupation, HIV, past_history, current_issue, allergies, current_medication, dob)
 				VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

        $query->bind_param("ssssssssssssss",$fname,$lname,$gender, $postcode, $telephone, $email, $marital, $occupation, $HIV, $past_history, $current_issue,$allergies, $medication, $dob);
		$result =$query->execute();
        if($result){
			echo '<p class = "bg-info">patient added, returning to previous page in 3 seconds...</p>';
			header("refresh:3; url=index.php");
		}else{
			echo "Error: ".$query."<br>".$conn->error;
		}

		
		mysqli_close($conn);
	}

?>
