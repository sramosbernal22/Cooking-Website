<?php   
    //MySQLi or PDO connect to database
    $conn = mysqli_connect("","", "","");

    //Check connection
    if(!$conn){
        echo "Connection error: " . mysqli_connect_error();
    }


?>