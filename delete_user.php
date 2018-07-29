<?php
include 'include.php';

$query=("DELETE FROM user where id = '".$_POST['id']."'");


if(mysqli_query($conn,$query)){
    echo '<p class = "bg-primary text-white">User has been deleted!</p>';
}else{
    echo '<p class = "bg-danger text-white">Deletion failed!</p>';
}
