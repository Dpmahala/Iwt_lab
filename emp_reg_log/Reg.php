<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "empdetails";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstName'];
    $lastname = $_POST['lastName'];
    $Emp_type = $_POST['Emp_type'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO `emp_reg_log` (`firstName`,`lastName`,`Emp_type`,`gender`,`email`,`password`) VALUES('$firstName','$lastName','$Emp_type','$gender','$email','$password')";
        
    if ($conn->query($sql) === TRUE) {
        echo "Record added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
