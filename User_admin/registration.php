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
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type'];

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO `reg` (`name`,`email`,`password`,`user_type`) VALUES('$name','$email','$password','$user_type')";
        
    if ($conn->query($sql) === TRUE) {
        echo "Record added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Registration Page</title>
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
            background-color: #633737;
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
        <h1>Registration Page</h1>
        <form action="registration.php" method="POST">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
             <label for="user_type">User Type:</label>
            <select id="user_type" name="user_type">
                 <option value="admin">Admin</option>
                 <option value="employee">Employee</option>
            </select>
            </div>


            <button class="submit-button" type="submit">Register</button>
        </form>
    </div>
</body>
<script src="script.js"></script>

</html>