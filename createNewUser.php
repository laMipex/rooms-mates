<?php
require_once "db.php";

$connection = mysqli_connect(HOST, USER, PASS, DATABASE);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Connected successfully";

if (isset($_POST['submit'])) {
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $email = $_POST['email'];
    $jmbg = $_POST['jmbg'];
    $password = $_POST['password'];

    // Escape variables for security to prevent SQL injection
    $firstName = $connection->real_escape_string($firstName);
    $lastName = $connection->real_escape_string($lastName);
    $email = $connection->real_escape_string($email);
    $jmbg = $connection->real_escape_string($jmbg);
    $password = $connection->real_escape_string($password);


    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert query
    $query = "INSERT INTO user (u_fname, u_lname, email, password, JMBG) VALUES ('$firstName', '$lastName', '$email', '$hashedPassword', '$jmbg')";

    // Execute the query
    if ($connection->query($query) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $query . "<br>" . $connection->error;
    }
    header("Location: login.php");
    exit();
}
?>
