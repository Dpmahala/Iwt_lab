<?php
// Check if the form is submitted
if(isset($_POST['submit'])){
    // Database connection
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $hire_date = $_POST['hire_date'];
    $conn = mysqli_connect('localhost', 'root', '', 'empdetails');

    if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve data from the form
    

    // Insert data into the database
    $sql = "INSERT INTO employees (`first_name`, `last_name`, `email`, `department`, `hire_date`)
            VALUES ('$first_name', '$last_name', '$email', '$department', '$hire_date')";

    if(mysqli_query($conn, $sql)){
        echo "Employee registered successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

