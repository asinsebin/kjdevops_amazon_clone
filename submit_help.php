<?php
$servername = "db"; // This is the service name in docker-compose.yml
$username = "root";
$password = ""; // No password set
$dbname = "devops_login";// Change to your database name
        

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$contact = $_POST['contact'];
$email = $_POST['email'];
$reason = $_POST['reason'];

$sql = "INSERT INTO help_requests (name, contact, email, reason) VALUES ('$name', '$contact', '$email', '$reason')";

if ($conn->query($sql) === TRUE) {
    $conn->close();
    header('Location: index.html');
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    $conn->close();
}
?>