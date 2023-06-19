<?php
// Connect to MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$database = "bets_db";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Select the database
$conn->select_db($database);

// Retrieve team names from bets_db table
$sql = "SELECT Teamone, Teamtwo FROM bets";
$result = $conn->query($sql);

// Store team names in an array
$teams = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $teams[] = $row["Teamone"];
        $teams[] = $row["Teamtwo"];
    }
}

// Convert teams array to JSON format
$teamsJson = json_encode($teams);

// Close the database connection
$conn->close();

// Send teams data as JSON response
header("Content-Type: application/json");
echo $teamsJson;
?>