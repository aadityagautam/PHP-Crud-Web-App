<!DOCTYPE html>
<html lang="en">
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mydb";

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }
            
            $empId = $_POST["empId"];
            $fname = $_POST["fname"];
            $lname = $_POST["lname"];

            $sql = "SELECT * FROM mydb.employee WHERE id = $empId";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                echo '<script> alert("Sorry, employee id exist already..."); </script>';
            }else{
                $sql = "INSERT INTO mydb.employee (fname, lname, id)
                VALUES ('$fname', '$lname', $empId)";

                if ($conn->query($sql) === TRUE) {
                // echo "<script> alert('New record created successfully'); </script>";
                } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }

            $conn->close();
        }
    ?>
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Document</title>
    </head>
    <style>
        body{
            color: white;
            background: #1d2630;
        }
        .text-center{
            text-align: center;
        }
        .display{
            margin-bottom: 10px;
        }
        .main-row{
            justify-content: center;
        
        }
        
        
        .col{
            margin-bottom: 15px;
        }
        .tabel{
            width: 100%;
            background: rgba(19, 19, 24, 0.897);
            
        }
        #employee-list{
            text-align:center;
            background: rgb(34, 31, 31);
        }
        thead th{
            text-align:center;
            background: rgb(34, 31, 31); 
            padding-bottom: 10px !important ;
        }
        
        
    </style>
    <body>
        <div class="container">
            <div class="text-center">
                <h1 class="display"><strong>Crud Application</strong></h1>
            </div>
            <div class="main-row">
                <form action="index.php" method="POST" id="employee-form" class="row justify-content-center mb-4" autocomplete="of">
                    <div class="col-10 col-md-8 mb-3">
                        <label for="firstname">First Name</label>
                        <input class="form-control" name="fname" type="text" placeholder="Enter Your First Name" value='<?php if(isset($_GET["fname"])) echo $_GET["fname"]; ?>'><!---Edit Button Code----->
                    </div>
                    <div class="col-10 col-md-8 mb-3">
                        <label for="latstname">Last Name</label>
                        <input class="form-control" name="lname" type="text" placeholder="Enter Your Last Name" value='<?php if(isset($_GET["lname"])) echo $_GET["lname"]; ?>'>
                    </div>
                    <div class="col-10 col-md-8 mb-3">
                        <label for="emplyeeid">Employee Id</label>
                        <input class="form-control" name="empId" type="text" placeholder="Enter Your ID Number" value='<?php if(isset($_GET["empId"])) echo $_GET["empId"]; ?>'>
                    </div>
                    <div class="col-10 col-md-8 mb-3">
                        <input class="btn btn-success ad-btn" type="submit" value="submit">
                    </div>
                </form>
                <div class="col-12 col-md-12 mt-5 mb-3">
                    <table class="tabel tabel-striped">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Emplyee ID</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="employee-list">
                            <?php
                                // Create connection
                                $conn = new mysqli($servername, $username, $password, $dbname);
                                // Check connection
                                if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                                }

                                $sql = "SELECT id, fname, lname FROM mydb.employee";
                                $result = $conn->query($sql);
                                $count=0;
                                if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo '
                                        <tr>
                                            <td>'. $row["fname"].'</td>
                                            <td>'. $row["lname"].'</td>
                                            <td>'. $row["id"].'</td>
                                            <td>
                                                <a href="http://localhost/application/index.php?empId='. $row["id"].'&fname='. $row["fname"].'&lname='. $row["lname"].'" class="btn btn-warning btn-sm edit">Edit</a>
                                                <a href="http://localhost/application/delete.php?empId='. $row["id"].'" class="btn btn-danger btn-sm delete">Delete</a>
                                            </td>
                                        </tr>
                                        
                                    ';
                                    $count++;
                                }
                                } else {
                                    echo "0 results";
                                }
                                $conn->close();
                            ?>
                        </tbody>
                        
                    </table>
                    <?php echo "Result: ".$count;  ?>
                </div>
            </div> 
        </div>
        <script src="script.js"></script>
    </body>
</html>



