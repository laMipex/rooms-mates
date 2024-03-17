<?php
session_start(); // Start the session
include_once 'db.php'; // Include your database configuration file

$defaultPhoto = 'imgs/person.jpg'; // Path to your default photo

// Check if the user is logged in
if (isset($_SESSION['userID'])) {
    // User is logged in
    $pdo = new PDO('mysql:host=localhost;dbname=roommates', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = $pdo->prepare("SELECT * FROM user WHERE userID = :userID");
    $query->bindParam(':userID', $_SESSION['userID']);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);

    // Check if a user photo exists and is not empty
    $profilePhoto = ($user && !empty($user['photo'])) ? $user['photo'] : $defaultPhoto;
} else {
    // User is not logged in
    $profilePhoto = $defaultPhoto;
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Are you looking for a roommate? You are on the right place!">
    <meta name="keyword" content="roommates, flats, homes">
    <meta name="robots" content="index, follow">
    <link rel="icon" type="image/x-icon" href="logo.png">
    <link rel="stylesheet" href="css/profileStyle.css">
    <link rel="stylesheet" href="css/IndexLog.css">
    <link rel="stylesheet" href="css/UpIn.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Rooms N' Mates</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
</head>
<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="150">
<nav class="navbar navbar-expand-md">
    <div class="container-fluid">
        <img class="logo" src="logo.png" style="width: 60px;" alt="logo">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar"
                aria-controls="collapsibleNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav mx-auto mb-2 mb-ls-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="indexLoged.php">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Cities
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Novi Sad</a></li>
                        <li><a class="dropdown-item" href="#">Subotica</a></li>
                        <li><a class="dropdown-item" href="#">Belgrade</a></li>
                        <li><a class="dropdown-item" href="#">Nis</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
            </ul>
            <div class="dropdown">
                <a class="btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo htmlspecialchars($profilePhoto); ?>" alt="Profile" class="imageProfile"/>
                </a>


                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="youProfile.php">Your Profile</a></li>
                    <li><a class="dropdown-item" href="editProfile.php">Edit Profile</a></li>
                    <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="profile-header text-center">Your profile</h1>

            <?php
            include_once 'db.php';


            $connection = new mysqli(HOST,USER,PASS,DATABASE);
            if($connection -> connect_errno) {
                echo $connection -> $connect__error;
            }


            if (!isset($_SESSION['userID'])) {
                header("Location: indexLoged.php");
                exit();
            }

            $userId = $_SESSION['userID'];
            
            $query = "SELECT * FROM user WHERE userID = $userId";
            if($result = $connection -> query($query)) {
                while ($row = $result->fetch_assoc()) {
                    // Set the path to the default image if the photo is not available
                    $profilePhoto = !empty($row['photo']) ? $row['photo'] : $defaultPhoto;
                    
                    
                    echo "
                    <div class='row'>
                    <div class='col-lg-6'>
                        <img class='person-photo img-fluid' src=\"$profilePhoto\" width='100px' height='200px' alt=\"profile-photo\"> <br>
                    </div>
                    <div class='col-lg-6'>
                        <div class='profile-info'>
                            <p>First name: {$row['u_fname']}</p>
                            <p>Last name: {$row['u_lname']}</p>        
                            <p>Email: {$row['email']}</p>   
                            <p>City: {$row['city']}</p>  
                            <p>Age: {$row['age']}</p>    
                            <p>Biografija: {$row['bio']}</p>  
                            <p>Budget: {$row['budget']} $</p>
                            <p>JMBG: {$row['jmbg']}</p>            
                        </div>
                        </div>
                    </div>
                    </div>
                    ";
                }
                }
            ?>
        </div>
    </div>
</div>

</body>
</html>
