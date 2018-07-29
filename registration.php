<?php
include 'include.php';

if(isset($_POST['add_user'])){

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $token = hash('ripemd128',"$salt1$password$salt2");
    $user_type = $_POST['user_type'];
    $check_duplicate = $conn->prepare("select * from user where username=?");
    $check_duplicate->bind_param('s',$username);
    $check_duplicate->execute();
    $resultSet=$check_duplicate->get_result();
    $check_duplicate_result=$resultSet->fetch_all();

    if(!$check_duplicate_result !==false){
        $query =$conn->prepare("INSERT INTO user(username, first_name,last_name,password,userType) VALUES (?,?,?,?,?)") ;
        $query->bind_param('sssss',$username,$first_name,$last_name,$token,$user_type);
        $result=$query-> execute();

        if(!$result){
            echo "error:".$conn->error;
        }else{
            echo '<p class = "bg-info">User added, returning to previous page in 3 seconds...</p>';
            header("refresh:3; url=users.php");
        }
    }else{
        echo "user already exists in the database, please check your input!";
        header("refresh:3; url=users.php");
    }



    $conn->close();



}
