<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydb";

    if($_SERVER["REQUEST_METHOD"] == "GET"){
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
        
        $empId = $_GET["empId"];

        $sql = "delete from mydb.employee where id = $empId";
        if ($conn->query($sql) === TRUE) {
            // echo '<script> alert("Record deleted successfully"); </script>';
            header("Location: http://localhost/application/index.php");
            exit();
        } else {
            echo "Error deleting record: " . $conn->error;
            header("Location: http://localhost/application/index.php");
            exit();
        }

        $conn->close();
    }
?>
