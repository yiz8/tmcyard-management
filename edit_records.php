<?php
include 'include.php';
$id = $_POST['id'];
$text = $_POST['text'];
$column_name= $_POST['column_name'];


$query =$conn->prepare("UPDATE patient_record SET ".$column_name." = ? WHERE record_id= ?");
$query->bind_param("ss",$text,$id);
$result = $query->execute();


if(!$result){
    echo '<p class = "bg-danger text-white">update failed!</p>';

}else{
    echo '<p class = "bg-primary text-white">Content has been updated!</p>';
}
