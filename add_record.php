<?php
include 'include.php';

if(isset($_POST['add_record'])){

    $patient_id = $_GET['id'];
    $record_content = $_POST['record_content'];
    $record_date = $_POST['date'];


    /*
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
            echo "Connected successfully";
        */
    $query = $conn->prepare("INSERT INTO patient_record(record_content, patient_id, record_date) VALUES (?,?,?)");
    $query->bind_param("sss",$record_content,$patient_id,$record_date);
    $result=$query->execute();

    if($result){
        echo 'Record added successfully, returning to previous page in 3 seconds...';
        header("refresh:3; url=more_details.php?id=$patient_id");
    }else{
        echo "Error: ".$conn->error;
    }


}

?>