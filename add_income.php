<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="stylesheets.css">

</head>
<body>
<div class = "container">

    <?php
    include 'include.php';

    if(isset($_POST['add_income'])){


        $retail = $_POST['retail'];
        $herbal = $_POST['herbal'];
        $massage = $_POST['massage'];
        $acupuncture = $_POST['acupuncture'];
        $other = $_POST['other'];
        $description=$_POST['description'];
        $date = $_POST['date'];

        // Check connection
        /*	if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
                }
                echo "Connected successfully";
                */

        $query = $conn->prepare("INSERT INTO income(retail, Herbal, Massage, Acupuncture, other, description, date) 
                  VALUES (?,?,?,?,?,?,?)");
        //binding parameters to the query for secure execution
        $query->bind_param("sssssss",$retail,$herbal,$massage,$acupuncture,$other,$description,$date);
        $result = $query->execute();

        //if query execute was success
        if($result){
            echo '<p class = "bg-info">income added, returning to previous page in 3 seconds...</p>';
            header("refresh:3; url=income.php");
        }else{
            echo "Error: ".$query."<br>".$conn->error;
        }



   }

    ?>

</div>
</body>
</html>
