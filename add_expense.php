
    <?php
    include 'include.php';

    if(isset($_POST['add_expense'])){


        $cash = $_POST['cash'];
        $card = $_POST['card'];
        $other = $_POST['other'];
        $description=$_POST['description'];
        $date = $_POST['date'];

        $query = $conn->prepare("INSERT INTO expense(cash, card, other,description, date) 
                  VALUES (?,?,?,?,?)");
        $query->bind_param("sssss",$card,$card,$other,$description,$date);
        $result=$query->execute();

        //if query execute was success
        if($result){
            echo '<p class = "bg-info">expense added, returning to previous page in 3 seconds...</p>';
            header("refresh:3; url=income.php");
        }else{
            echo "Error: ".$query."<br>".$conn->error;
        }


        mysqli_close($conn);
    }

    ?>
