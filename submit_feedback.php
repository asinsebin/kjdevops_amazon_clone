<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize the feedback text
    $feedback = trim($_POST["feedbackText"]);
    
    // Check if feedback is not empty
    if (!empty($feedback)) {
        // Database connection parameters
        $servername = "db"; // This is the service name in docker-compose.yml
$username = "root";
$password = ""; // No password set
$dbname = "devops_login";// Change to your database name
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        // Prepare SQL statement
        $sql = "INSERT INTO feedback (feedback_text) VALUES (?)";
        
        // Prepare and bind parameters
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $feedback);
        
        // Execute the statement
        if ($stmt->execute()) {
            // Close statement and connection
            $stmt->close();
            $conn->close();
            
            // Send a success response
            http_response_code(200);
            exit;
        } else {
            // Send an error response
            echo "Error: " . $sql . "<br>" . $conn->error;
            http_response_code(500);
        }
    } else {
        // Send a validation error response
        echo "Feedback cannot be empty.";
        http_response_code(400);
    }
} else {
    // Send an invalid request error response
    echo "Invalid request.";
    http_response_code(405);
}
?>
