<?php
session_start(); // Start a PHP session

// Check if the user is logged in and their role is set in the session
if (isset($_SESSION['user_type'])) {
    $user_role = $_SESSION['user_type'];

    // Database connection code (replace with your actual database credentials)
    $db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "user_admin";

    $conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Query the database to retrieve user details based on their role
    if ($user_type == 'employee') {
        $sql = "SELECT * FROM reg WHERE user_type = 'employee'";
        $title = " Details:";
    } elseif ($user_type == 'admin') {
        $sql = "SELECT * FROM reg WHERE user_type = 'admin'";
        $title = " Details:";
    } else {
        $sql = ""; // Invalid role, so no data will be fetched
        $title = "Invalid Role:";
    }

    if (!empty($sql)) {
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo "<h1>$title</h1>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "Name: " . $row["name"] . "<br>";
                echo "Email: " . $row["email"] . "<br>";
                // You can display other user details here as well
                echo "<hr>";
            }
        } else {
            echo "No data found for your role.";
        }
    } else {
        echo "Invalid role.";
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    echo "You are not logged in. Please log in to view your details.";
}
?>
}

$conn->close();
?>