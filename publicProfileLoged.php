<?php
session_start(); // Start or resume the session at the beginning of the script

// Assuming $_SESSION['userID'] is set during login
if (isset($_SESSION['userID'])) {
    $pdo = new PDO('mysql:host=localhost;dbname=roommates', 'root', '');
    $query = $pdo->prepare("SELECT photo FROM user WHERE userID = :userID");
    $query->bindParam(':userID', $_SESSION['userID']);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);

    $defaultPhoto = 'imgs/person.jpg'; // Path to your default photo
    $profilePhoto = ($user && $user['photo']) ? $user['photo'] : $defaultPhoto;
    $isLoggedIn = true;

    $userLocation = 'Subotica'; // You can replace this with the actual user location

    // Fetch users based on the location
    $queryLocation = $pdo->prepare("SELECT * FROM user WHERE city = :city");
    $queryLocation->bindParam(':city', $userLocation);
    $queryLocation->execute();
    $users = $queryLocation->fetchAll(PDO::FETCH_ASSOC);
} else {
    $isLoggedIn = false;
    $profilePhoto = 'imgs/person.jpg'; // Path to default photo for logged out users
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
    <link rel="icon" type="image/x-icon" href="#">
    <link rel="stylesheet" href="css/UpIn.css">
    <link rel="stylesheet" href="css/grad.css">
    <link rel="stylesheet" href="css/IndexLog.css">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <title>Rooms N' Mates</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>

<body>

    <!-- navbar -->

    <nav class="navbar navbar-expand-md mb-100">
        <div class="container-fluid">
            <img class="logo" src="logo.png" style="width: 60px;" alt="logo">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar" aria-controls="collapsibleNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav mx-auto mb-2 mb-ls-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Cities
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="noviSad.php">Novi Sad</a></li>
                            <li><a class="dropdown-item" href="subotica.php">Subotica</a></li>
                            <li><a class="dropdown-item" href="beograd.php">Belgrade</a></li>
                            <li><a class="dropdown-item" href="nis.php">Nis</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                </ul>
                <?php if ($isLoggedIn) : ?>
                    <div class="dropdown">
                        <a class="btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?php echo htmlspecialchars($profilePhoto); ?>" alt="Profile" class="imageProfile" />
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="youProfile.php">Your Profile</a></li>
                            <li><a class="dropdown-item" href="editProfile.php">Edit Profile</a></li>
                            <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
                        </ul>
                    </div>
                <?php else : ?>
                    <form action="login.php" class="d-flex">
                        <button class="btn btn-outline-primary" type="submit">Log In</button>
                    </form>
                <?php endif; ?>
    </nav>
    <br>
    <div class="profile">
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-lg-4">
                <!-- Profile picture -->
                <?php
                if (isset($_GET['userID'])) {
                    $userID = $_GET['userID'];
                    $pdo = new PDO('mysql:host=localhost;dbname=roommates', 'root', '');
                    $query = $pdo->prepare("SELECT * FROM user WHERE userID = :userID");
                    $query->bindParam(':userID', $userID);
                    $query->execute();
                    $user = $query->fetch(PDO::FETCH_ASSOC);

                    if ($user && $user['photo']) {
                        echo "<img src='{$user['photo']}' class='img-fluid' alt='Profile Picture'>";
                    } else {
                        echo "<img src='imgs/default.jpg' class='img-fluid' alt='Default Profile Picture'>";
                    }
                } else {
                    echo "<img src='imgs/default.jpg' class='img-fluid' alt='Default Profile Picture'>";
                }
                ?>
            </div>
            <div class="col-lg-8">
                <!-- Profile details -->
                <?php
                if (isset($_GET['userID'])) {
                    if ($user) {
                        echo "<h1>{$user['u_fname']} {$user['u_lname']}</h1>";
                        echo "<p>Email: {$user['email']}</p>";
                        echo "<p>Phone: {$user['brTel']}</p>";
                        echo "<p>City: {$user['city']}</p>";
                        echo "<p>Age: {$user['age']}</p>";
                        echo "<p>Bio: {$user['bio']}</p>";
                        echo "<p class='pC'>{$user['up']}<i class='bi bi-hand-thumbs-up'></i></p>";
                        echo "<p class='pC2'>{$user['down']}<i class='bi bi-hand-thumbs-down'></i></p>";
                        echo "<br><br>";
                        echo "<form action='message.php' method='get' class='card-footer'>";
                        echo "<button type='submit' name='submit' value='{$user['email']}' class='btn btn-primary'>Send Message</button>";
                        echo "</form>";
                        // Add more profile details as needed
                    } else {
                        echo "User not found.";
                    }
                } else {
                    echo "User ID not provided.";
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>