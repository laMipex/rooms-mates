<?php
session_start(); // Start or resume the session at the beginning of the script

// Assuming $_SESSION['userID'] is set during login and your user table has a 'photo' column
if (isset($_SESSION['userID'])) {
    // User is logged in
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
    $profilePhoto = 'imgs/person.jpg'; // Set default photo for logged out users if needed
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
    <link rel="stylesheet" href="css/IndexLog.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/UpIn.css">
    <link href="css/UpIn.css" rel="stylesheet">
    <title>Rooms N' Mates</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-md">
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
                <form action="login.php" class="d-flex">
                    <button class="btn btn-outline-primary" type="submit">Log In</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</nav>
<div class="container">
    <h1 class="mt-5 mb-2 text-center">Contact</h1>
    <p class="mb-5 text-center">For any questions, uncertainties, complains or comments please contact us.</p>
    <form class="col-md-6 col-sm-6 col-xxs-4 mx-auto mt-4 my-5" action="https://formsubmit.co/1d62177eafa5f150f3328d2cc00018a3" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="mb-3">
            <label for="Email" class="form-label">Email Address:</label>
            <input type="email" class="form-control" id="Email" name="email" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text text-primary" style="font-size: 10pt">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="subject" class="form-label">Subject:</label>
            <input type="text" class="form-control" id="subject" name="subject">
        </div>
        <div class="mb-3">
            <label for="question" class=" col-form-label text-center">Message:</label>
            <textarea class="form-control" id="question" rows="7" name="message"></textarea>

        </div>
        <div class="mb-3 text-center mt-5">
        <button type="submit" class="btn btn-primary" style="width: 100px">Send</button>
        </div>

    </form>
</div>

</body>
</html>