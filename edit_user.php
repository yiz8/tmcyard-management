<?php
include 'include.php';
$id = $_POST['id'];
$text = $_POST['text'];
$column_name= $_POST['column_name'];

$query =$conn->prepare("UPDATE user SET ".$column_name." = ? WHERE ID= ?");
$query->bind_param("ss",$text,$id);
$result = $query->execute();

if($result){
    echo '<p class = "bg-primary text-white notification">User has been updated! <button type="button" class="close"><span aria-hidden="true">&times;</span></button></p>';
}else{
    echo '<p class = "bg-danger text-white notification">update failed!<button type="button" class="close"><span aria-hidden="true">&times;</span></button></p>';
}
