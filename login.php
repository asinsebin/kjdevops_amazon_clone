<?php
$servername = "db"; // This is the service name in docker-compose.yml
$username = "root";
$password = ""; // No password set
$dbname = "devops_login";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if 'email' and 'password' are set in the $_POST array
    if (isset($_POST['email']) && isset($_POST['plain_password'])) {
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Escape user inputs for security
        $email = $conn->real_escape_string($_POST['email']);
        $plain_password = $conn->real_escape_string($_POST['plain_password']);

        // Use prepared statement to prevent SQL injection
        $sql = "SELECT * FROM devops_login WHERE email=? AND plain_password=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $plain_password); // "ss" indicates two string parameters

        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Check if user was found
        if ($result->num_rows > 0) {
            // Start session
            session_start();
            // Set session variables
            $_SESSION['email'] = $email;
            // Redirect to index.html
            header("Location: index.html?loginSuccess=true");
            exit();
        } else {
            // No user found, handle accordingly (redirect to login page or show error message)
            echo "Invalid email or password.";
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    } else {
        // Email and password not set in the $_POST array
        echo "Email and password are required.";
    }
}
?>
