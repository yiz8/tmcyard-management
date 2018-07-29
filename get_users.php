<?php
include 'include.php';

$query = "SELECT * from user order by first_name ASC";
$result = $conn->query($query);

if(!$result || $result->num_rows <=0){
    echo "something went wrong while pulling data";
    return false;
}else if($result->num_rows >0){
    echo '<table class = "table table-hover table-border">
        <thead>
        <tr>
        <th>ID</th>
        <th>username</th>
        <th>first name</th>
        <th>last name</th>
        <th>user type</th>
        </tr>
        </thead>
        <tbody>';
    while($row = $result->fetch_assoc()){
        $id = $row['ID'];
        $username = $row['username'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $userType = $row['userType'];
        echo "<tr><td>".$id."</td>";
        echo "<td class = 'username' data-id1 ='".$id."' contenteditable='true'>".$username."</td>";
        echo "<td class = 'first_name' data-id2 ='".$id."' contenteditable='true'>".$first_name."</td>";
        echo "<td class = 'last_name' data-id3 ='".$id."' contenteditable='true'>".$last_name."</td>";
        echo "<td class = 'userType' data-id4 ='".$id."'>";
            if ($userType =="1"){
                echo '<select id="user_type">
                        <option selected = "selected" value ="1">Admin</option>
                        <option value = "2">User</option>
                         </select>';
            }else if($userType=="2"){
                echo '<select>
                        <option  value ="1">Admin</option>
                        <option selected = "selected" value = "2">User</option>
                         </select>';
            };
            echo"</td>";
        echo "<td><button class = 'btn btn-danger btn_delete' data-id5='".$id."'>Delete</button></td>";
    }
    echo '</tbody></table>';
}
