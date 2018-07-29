<?php
/**
 * Created by PhpStorm.
 * User: zys27
 * Date: 2018/3/11
 * Time: 22:03
 */
include 'include.php';



$first_name = "yinsheng";
$last_name = "zhou";
$username = "dongsmbm@gmail.com";
$password = "831147zys";
$token = hash('ripemd128',"$salt1$password$salt2");
$user_type = "1";

$query = "INSERT INTO user(username, first_name,last_name,password,userType) VALUES ('$username','$first_name', '$last_name', '$token', '$user_type')";
if($conn->query($query) === TRUE){
    echo '<p class = "bg-info">User added, returning to previous page in 3 seconds...</p>';
    header("refresh:3; url=index.php");
}else{
    echo "Error: ".$query."<br>".$conn->error;
}


mysqli_close($conn);