<?php

// MySQL database connection details
$host = '';
$username = '';
$password = '';
$dbName = '';

// Create a MySQL connection
$connection = new mysqli( $host, $username, $password, $dbName );

// Check connection
if ( $connection->connect_error ) {
    die('Connection failed: ' . $connection->connect_error);
} else {
    echo 'Successful';
}

// Get the JSON data sent from the JavaScript code
$data = json_decode(file_get_contents('php://input'), true);

// Prepare and execute the INSERT query
$query = 'INSERT INTO marketplace_data (id, link, title) VALUES (?, ?, ?)';
$statement = $connection->prepare( $query );
$statement->bind_param('sss', $id, $link, $title);

foreach ( $data['itemSales'] as $item ) {
    $id = $item['itemId'];
    $link = $item['itemHref'];
    $title = $item['title'];

    if ( $statement->execute() === false ) {
        echo 'Error storing data: ' . $connection->error;
    } else {
        echo 'Data stored successfully.';
    }
}

$response = [
    'success' => true
];

echo json_encode( $response );

?>
