<?php
include 'include.php';
    $user_name = mysqli_real_escape_string($conn,$_POST['user_name']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    $token = hash('ripemd128',"$salt1$password$salt2");


    $query =$conn-> prepare("SELECT * from user where username = ? and password = ? limit 1");
    $query->bind_param("ss",$user_name,$token);
    $query->execute();
    $result = $query->get_result();

    if($result->num_rows===0){

        echo "Your username/password is not correct, please try again!";
        $_SESSION['logged_in'] = false;

        header("refresh:3; url=index.php");
        return false;
    }else if($result->num_rows===1){
        session_start();
       $fetch = $result->fetch_assoc();
       $name = $fetch['first_name'];
       $userType = $fetch['userType'];
       $_SESSION['user_name'] = $user_name;
        $_SESSION['name'] =$name;
        $_SESSION['userType'] =$userType;
        echo "Hi ".$name." , you are logged in!";

        $_SESSION['logged_in'] = true;
        header("refresh:3; url=index.php");

        return true;
    }




