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
    <link rel="stylesheet" href="css/style.css">
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

    <script>
        const x = document.getElementById("demo");

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {
            x.innerHTML = "Latitude: " + position.coords.latitude +
                "<br>Longitude: " + position.coords.longitude;
        }

        function showError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    x.innerHTML = "User denied the request for Geolocation."
                    break;
                case error.POSITION_UNAVAILABLE:
                    x.innerHTML = "Location information is unavailable."
                    break;
                case error.TIMEOUT:
                    x.innerHTML = "The request to get user location timed out."
                    break;
                case error.UNKNOWN_ERROR:
                    x.innerHTML = "An unknown error occurred."
                    break;
            }
        }
    </script>
    <style>
        body {
            position: relative;
        }
    </style>
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
                <a class="nav-link active" aria-current="page" href="index.html">Home</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                   data-bs-toggle="dropdown" aria-expanded="false">
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
    <?php if ($isLoggedIn): ?>
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
    <?php else: ?>
        <form action="login.html" class="d-flex">
            <button class="btn btn-outline-primary" type="submit">Log In</button>
        </form>
    <?php endif; ?>
</nav>
<div class="parallax" >
    <div class="box">
        <p class="pText">Looking for Roomies?</p>
        <div class="btnF">
            <?php if ($isLoggedIn): ?>
                <a href="napraviOglas.php" class="btn btn-primary btn-lg">List Room</a>
            <?php else: ?>
                <a href="login.html" class="btn btn-primary btn-lg">Find roomies</a>
            <?php endif; ?>
        </div>

    </div>
</div>

<div class="bd">
    <div class="section">
        <div class="txt">
            <h1>About Us</h1>
            <p>
                Welcome to Room and Mates, where we believe that finding the perfect roommate and the ideal living space should be an exciting journey, not a stressful task.
                <br>
                At Room and Mates, we understand the importance of compatibility when it comes to sharing a living space. <br><br> Whether you're a student searching for a cozy dorm room, a young professional seeking a vibrant apartment, or anyone in between, we're here to make the process seamless and enjoyable.
                <br><br>
                Our platform provides a convenient and secure space where individuals can connect with potential roommates and explore a wide range of housing options. With our user-friendly interface and powerful search tools, finding your ideal living situation has never been easier.
            </p>
        </div>
    </div>
</div>

<div class="foot container-fluid">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <div class="col-md-4 d-flex align-items-center">
            <span class="mb-3 mb-md-0 text-muted">&copy; 2024 CtrlAltDefeat</span>
        </div>

        <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
            <li class="ms-3"><a class="text-muted" href="#"><i class="bi bi-instagram"></i></a></li>
            <li class="ms-3"><a class="text-muted" href="#"><i class="bi bi-facebook"></i></a></li>
            <li class="ms-3"><a class="text-muted" href="#"><i class="bi bi-twitter-x"></i></a></li>
        </ul>
    </footer>
</div>
</body>
</html>
