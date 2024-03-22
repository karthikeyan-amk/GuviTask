<?php
$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "guvi";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}   

$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

// Check if request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from POST data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    // Hash the password (for better security)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare an SQL statement to check if username already exists
    $check_username_sql = "SELECT * FROM users WHERE username=:username";
    $stmt = $conn->prepare($check_username_sql);
    $stmt->bindParam(":username", $username);
    $stmt->execute();
    $result = $stmt->fetchAll();

    if (count($result) > 0) {
        // Username already exists, send error message
        echo "Username already exists. Please choose a different username.";
    } else {
        // Username doesn't exist, proceed with registration
        $insert_sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $conn->prepare($insert_sql);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $hashed_password);

        if ($stmt->execute()) {
            // Registration successful, send success message
            echo "success";
        } else {
            // Error occurred during registration, send error message
            echo "Error: " . $insert_sql . "<br>" . $stmt->errorInfo()[2];
        }
    }


    // Insert data into MongoDB
    // Create document to insert into MongoDB
    $document = [
        'username' => $username, // Assuming username is fixed for now
    ];

    // Prepare MongoDB insert operation
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->insert($document);

    // Execute MongoDB insert operation
    $result = $manager->executeBulkWrite('guvi.users', $bulk);

    // Check if document was inserted successfully
    if ($result->getInsertedCount() > 0) {
        echo "success";
    } else {
        echo "failure";
    }

    $conn = null; // Close database connection
}
?>
