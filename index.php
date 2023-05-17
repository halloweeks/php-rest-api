<?php
// Enable CORS headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: OPTIONS, GET, POST, PUT, DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Define constant to indicate script access from index.php
define('INDEX_ACCESS', true);

// Include the database configuration file
require_once 'database.php';

// Get the requested URI
$route = $_SERVER['REQUEST_URI'];

// Define the filename for the REST API.
$filename = [
	"/api/v1/account/info" => "information.php",
];

// Handle case when route doesn't exist
if (!isset($filename[$route]) || !file_exists($filename[$route])) {
	// Handle the case when the route or file does not exist
    http_response_code(404); // Set a 404 response code

    // Prepare the JSON response
    $response = [
        'error' => 'API endpoint not found'
    ];

    // Set the JSON response headers and echo the response
    jsonResponse($response);
    exit; // Terminate the script execution
}

// Include the appropriate API file based on the requested route
require_once $filename[$route];

/**
 * Set the JSON response headers and echo the JSON response.
 *
 * @param array $response
 */
function jsonResponse($response)
{
	header("Content-Type: application/json");
    echo json_encode($response);
}

// Close the database connection
$mysqli->close();
?>
