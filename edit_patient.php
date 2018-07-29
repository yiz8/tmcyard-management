<?php
include 'include.php';
$id = $_POST['id'];
$text = $_POST['text'];
$column_name= $_POST['column_name'];


$query =$conn->prepare("UPDATE patient_info SET ".$column_name."=? WHERE patient_id= ?");
$query->bind_param("ss",$text,$id);
$result =$query->execute();

if($result){
    echo '<p class = "bg-primary text-white">patient info has been updated!</p>';
}else{
    echo '<p class = "bg-danger text-white">update failed!</p>';

}
