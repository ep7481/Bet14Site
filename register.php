<?php
// Establish database connection (replace with your own database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Registration process
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Perform any necessary validation on the input data

    // Check if the username is already taken
    $checkQuery = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        echo "Username already exists. Please choose a different username.";
    } else {
        // Insert the new user into the database
        $passwordHash = password_hash($password, PASSWORD_DEFAULT); // Hash the password

        $insertQuery = "INSERT INTO users (username, password) VALUES ('$username', '$passwordHash')";
        if ($conn->query($insertQuery) === true) {
            header("Location: login.php"); // Redirect to the login page
            exit;
        } else {
            echo "Error: " . $insertQuery . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
</head>
<body>
    <h2>Registration</h2>
    <form method="POST" action="">
        <label>Username:</label>
        <input type="text" name="username" required><br><br>
        <label>Password:</label>
        <input type="password" name="password" required><br><br>
        <input type="submit" name="register" value="Register">
    </form>
</body>
</html>