<?php
// Establish database connection
$servername = "db"; // This is the service name in docker-compose.yml
$username = "root";
$password = ""; // No password set
$dbname = "devops_login";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$flat = $_POST['flat'];
$landmark = $_POST['landmarkno'];
$pincode = $_POST['Pincodeno'];
$locality = $_POST['localityno'];
$city = $_POST['cityno'];
$state = $_POST['stateno'];
$custname = $_POST['custname'];
$custmobile = $_POST['custmobile'];
$selected = $_POST['Home'];

// Insert data into database
$sql = "INSERT INTO addresses (flat, landmark, pincode, locality, city, state, custname, custmobile, selected) 
        VALUES ('$flat', '$landmark', '$pincode', '$locality', '$city', '$state', '$custname', '$custmobile', '$selected')";

if ($conn->query($sql) === TRUE) {
    $response = array("success" => true);
} else {
    $response = array("success" => false, "error" => $conn->error);
}

echo json_encode($response);

$conn->close();
?>