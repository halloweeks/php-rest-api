<?php
// Check if the script is accessed directly
if (!defined('INDEX_ACCESS')) {
    http_response_code(403); // Set a 403 Forbidden response code

    // Prepare the JSON response
    $response = [
        'error' => 'Forbidden'
    ];

    // Set the JSON response headers and echo the response
    echo json_encode($response);
    exit; // Terminate the script execution
}

try {
    // Establish a database connection using mysqli
    $mysqli = new mysqli('127.0.0.1', 'root', '1234');

    // Set the character set to UTF-8 for proper encoding handling
    $mysqli->set_charset('utf8');
} catch (mysqli_sql_exception $e) {
    // Handle the exception if a database connection error occurs
    // Prepare a JSON response indicating the failure
    $response = [
        'success' => false,
        'message' => $e->getMessage()
    ];

    // Set the Content-Type header to specify JSON response
    header('Content-Type: application/json');

    // Echo the JSON response to the client
    echo json_encode($response);

    // Terminate the script execution
    exit;
}
?>
