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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['CONTENT_TYPE'] === 'application/json') {
	// Get the JSON request body"
	$jsonBody = file_get_contents('php://input');
	
	// Decode the JSON data"
	$requestData = json_decode($jsonBody, true);
	
	// Check if JSON decoding was successful"
	if ($requestData === null && json_last_error() !== JSON_ERROR_NONE) {
		// Handle JSON decoding error"
		http_response_code(400); // Set a 400 Bad Request response code
		
		// Prepare the JSON error response
		$response = [
			'error' => 'Invalid JSON format'
		];
		
		// Set the JSON response headers and echo the response
		jsonResponse($response);
		exit; // Terminate the script execution
	}
	
	// Prepare the SQL query
	$query = "SELECT * FROM test.users WHERE user_id = ?";
	
	// Prepare a statement
	$stmt = $mysqli->prepare($query);
	
	// Bind the ID parameter to the statement
	$stmt->bind_param("i", $requestData["user_id"]);
	
	// Execute the statement
	$stmt->execute();
	
	// Get the result set
	$result = $stmt->get_result();
	
	// Check if a row was found
	if ($result->num_rows > 0) {
		// Fetch the row as an associative array
		$row = $result->fetch_assoc();
		
		// Do something with the retrieved data
		$userId = $row['user_id'];
		$userName = $row['username'];
		$userEmail = $row['email'];
		
		// Prepare the response data
		$response = ['user_id' => $userId,'username' => $userName,'email' => $userEmail];
		
		// Return the response as JSON
		jsonResponse($response);
	} else {
		// No matching row found
		$response = ['error' => 'User not found'];
		
		// Return the error response as JSON
		jsonResponse($response);
	}
	
	// Close the statement
	$stmt->close();
	
	// Close the database connection
	//$mysqli->close();
} else {
	// Handle non-JSON requests
	http_response_code(400); // Set a 400 Bad Request response code
	// Prepare a generic error response
	$response = [
		'error' => 'Invalid request'
	];
	
	// Set the JSON response headers and echo the response
	jsonResponse($response);
	exit; // Terminate the script execution
}
?>