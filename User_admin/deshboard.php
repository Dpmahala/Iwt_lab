<?php
session_start();

if (isset($_SESSION['user_type'])) {
    $user_type = $_SESSION['user_type'];

    // Database connection code (replace with your actual database credentials)
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpassword = "";
    $dbname = "user_admin";

    $conn = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Use prepared statements to prevent SQL injection

    if ($_SESSION["user_type"] == 'admin') {
        $sql = "SELECT * FROM reg WHERE user_type = 'employee'";
    } else {
        $sql = "SELECT * FROM reg WHERE user_type = 'admin'";
    }
    $title = "Details:";

    $result = mysqli_query($conn, $sql);

    // Bind the parameter
    // mysqli_stmt_bind_param($stmt, "s", $user_type);

    // Execute the query
    // mysqli_stmt_execute($stmt);

    // Get the result set
    // $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        echo "<h1>$title</h1>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "Name: " . $row["name"] . "<br>";
            echo "Email: " . $row["email"] . "<br>";
            echo "User Type: " . $row["user_type"] . "<br>";

            // You can display other user details here as well
            echo "<hr>";
        }
    } else {
        echo "No data found for your role.";
    }

    // Close the prepared statement
    //  mysqli_stmt_close($stmt);

    // Close the database connection
    mysqli_close($conn);
} else {
    echo "You are not logged in. Please log in to view your details.";
}
?>
