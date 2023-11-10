<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "user_admin";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch user data from the database based on the provided email
    $sql = "SELECT * FROM reg WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Verify the password
        if ($row['password'] == $password) {
            // Password is correct, user is authenticated
            // Redirect to the home page or any other page after successful login
            session_start();
            $_SESSION['id'] = $row['id'];
            $_SESSION["user_type"] = $row["user_type"];
            header("Location: deshboard.php");
            exit();
        } else {
            // Incorrect password
            $error_message = "Incorrect password!";

        }
    } else {
        // User not found
        $error_message = "User not found!";
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html>

<head>
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <header>
        <!DOCTYPE html>
        <html>

        <head>
            <link rel="stylesheet" type="text/css" href="style.css">
            <style>
                .container {
                    text-align: start;
                    margin-top: 50px;
                    width: 300px;
                    margin: 0 auto;
                }

                .form-group {
                    margin-bottom: 20px;
                }

                .form-group label {
                    display: block;
                }

                .form-group input {
                    width: 100%;
                    padding: 10px;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                }

                .form-group select {
                    width: 100%;
                    padding: 10px;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                }

                .submit-button {
                    background-color: #0f6e3e;
                    color: #fff;
                    padding: 10px 20px;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                }
            </style>
        </head>

        <body>
            <header>
                <nav>
                    <ul>
                        <li><a href="#" id="index.php">Home</a></li>
                        <li><a href="#" id="registration.php">Registration</a></li>
                        <li><a href="#" id="login.php">Login</a></li>
                    </ul>
                </nav>
            </header>

            <div class="container">
                <h1>Login Page</h1>
                <form action="login.php" method="POST">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <button class="submit-button" type="submit">Login</button>
                </form>
                <?php
                if (isset($error_message)) {
                    echo "<p class='error-message'>$error_message</p>";
                }
                ?>
            </div>
        </body>
        <script src="script.js"></script>

        </html>

    </header>

</body>
<script src="script.js"></script>

</html>
