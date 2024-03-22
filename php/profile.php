<?php
// Establish MongoDB connection
$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Establish MongoDB connection
    $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

    // Get username from GET data
    $username = $_GET['username'];

    // Create filter to find document by username
    $filter = ['username' => $username];
    $options = [];

    // Create MongoDB query
    $query = new MongoDB\Driver\Query($filter, $options);

    // Execute MongoDB query
    $result = $manager->executeQuery('guvi.users', $query);

    // Convert MongoDB document to associative array
    $profile = $result->toArray()[0];

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($profile);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    // Extract profile details from POST data
    $age = $_POST['age'];
    $dob = $_POST['dob'];
    $contact = $_POST['contact'];
    $username = $_POST['username'];

    // Create filter to find document by username
    $filter = ['username' => $username];

    // Create update query
    $update = ['$set' => ['age' => $age, 'dob' => $dob, 'contact' => $contact]];

    // Prepare MongoDB update operation
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->update($filter, $update);

    // Execute MongoDB update operation
    $result = $manager->executeBulkWrite('guvi.users', $bulk);

    // Check if document was updated successfully
    if ($result->getModifiedCount() > 0) {
        echo "success";
    } else {
        echo "failure";
    }
}
?>
