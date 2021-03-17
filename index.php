<?php include("Web/conect.php"); 
 if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";

?>
