<?php
// check_login.php
global $conn;
require_once 'db_connect.php'; // Load the database connection

session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare the SQL query using PDO
    $query = $conn->prepare("SELECT * FROM user WHERE email = :email");
    $query->bindParam(':email', $email);

    // Execute the prepared statement
    $query->execute();

    if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        // Check if the account is approved
        if ($row['approved']) {
            // Check the hashed password
            if (password_verify($password, $row['password'])) {
                // Set session variables
                $_SESSION['userID'] = $row['userID'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['approved'] = $row['approved']; // Assuming 'approved' is a column in your user table

                // Redirect to the home page after successful login
                header("Location: indexLoged.php");
                exit();
            } else {
                echo "Incorrect password! <br>";
                echo "<a href='login.php'>Go back to Log In</a>";
            }
        } else {
            echo "Account not approved yet. Please wait for an administrator to approve your account. <br>";
            echo "<a href='logIn.php'>Go back to Log In</a>";
        }
    } else {
        echo "No account exists with the entered email!";
    }
}
?>