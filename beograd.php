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
    <link rel="icon" type="image/x-icon" href="logo.png">
    <link rel="stylesheet" href="css/UpIn.css">
    <link rel="stylesheet" href="css/grad.css">
    <link rel="stylesheet" href="css/IndexLog.css">
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
    <div class="container">
        <h1 class="text-center mText">Belgrade</h1>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            <?php
            require_once "db.php";
            $connection = new mysqli(HOST, USER, PASS, DATABASE);
            if ($connection->connect_errno) {
                echo $connection->connect_error;
                exit(); // Stop script if connection fails
            }

            $query = "SELECT * FROM user WHERE city = 'Belgrade'";
            if ($result = $connection->query($query)) {
                while ($row = $result->fetch_assoc()) {
                    echo "
        <div class='col'>
            <div class='card h-100'>
                <img class='card-img-top img-fluid' src='{$row['photo']}' style='height: 350px' alt='person-img'>
                <div class='card-body'>
                    <h5 class='card-title'>{$row['u_fname']} {$row['u_lname']}</h5>
                    <p class='card-text'>{$row['city']}</p>
                    <p class='card-text'>{$row['age']}</p>
                    <p class='card-text'>{$row['bio']}</p>
                </div>";

                    // Check if $isLoggedIn is defined and true
                    if (isset($isLoggedIn) && $isLoggedIn) {
                        echo "<form action='publicProfileLoged.php' method='get' class='card-footer'>";
                    } else {
                        echo "<form action='publicProfile.php' method='get' class='card-footer'>";
                    }
                    echo "
                <input type='hidden' name='userID' value='{$row['userID']}' />
                <button type='submit' class='btn btn-primary'>Profile</button>
            </form>
        </div>
    </div>";
                }
                $result->close();
            } else {
                echo "Error executing query: " . $connection->error;
            }

            $connection->close();
            ?>
        </div>
    </div>

</body>

</html>