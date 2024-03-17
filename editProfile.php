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


// Povezivanje sa bazom podataka
$pdo = new PDO('mysql:host=localhost;dbname=roommates', 'root', '');

if (!isset($_SESSION['userID'])) {
    header("Location: indexLoged.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Preuzimanje podataka iz forme

    $firstName = $_POST['u_fname'];
    $lastName = $_POST['u_lname'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $photo = $_POST['photo'];
    // Dodajte logiku za obradu slike ako je potrebno
    $age = $_POST['age'];
    $bio = $_POST['bio'];
    $budget = $_POST['budget'];

    // Ovde dodajte ID korisnika koji se a탑urira, mo탑da kroz sesiju ili direktno u formi
    $userId = $_SESSION['userID']; // Pretpostavimo da je 1 ID korisnika koji se a탑urira

    // A탑uriranje podataka u bazi
    $sql = "UPDATE user SET u_fname = :firstName, u_lname = :lastName, email = :email, city = :city,photo = :photo, age = :age, bio = :bio, budget = :budget WHERE userID = :userID";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':firstName' => $firstName,
        ':lastName' => $lastName,
        ':email' => $email,
        ':city' => $city,
        ':photo' => $photo,
        ':age' => $age,
        ':bio' => $bio,
        ':budget' => $budget,
        ':userID' => $userId
    ]);

    echo "Profile updated successfully!";
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
    <link rel="stylesheet" href="css/profileStyle.css">
    <link rel="stylesheet" href="css/IndexLog.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/UpIn.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>MoveIn</title>
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
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
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
<div class="container">
    <h1 class="mt-5 mb-5">Edit profile</h1>
    <div class="row">
        <div class="col md-6">
            <img src="<?php echo htmlspecialchars($profilePhoto); ?>" alt="Profile" width='300px' height='300px'/>

        </div>
        <div class="col md-6">
            <form class="col-md-6 col-sm-6 col-xxs-4  mt-4 my-5" name="form" method="POST" action="editProfile.php">
                <div class="mb-3">
                    <label for="fname" class="form-label ">Change first name:</label>
                    <input type="text" class="form-control" id="fname" name="u_fname">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Change last name:</label>
                    <input type="text" class="form-control" id="name" name="u_lname">
                </div>
                <div class="mb-3">
                    <label for="Email" class="form-label">Change Email Address:</label>
                    <input type="email" class="form-control" id="Email" name="email" aria-describedby="emailHelp">

                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">Change city:</label>
                    <input type="text" class="form-control" id="city" name="city">
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">Change photo:</label><br><br>
                    <input type="file" name="photo" id="photo" accept="image/png,image/jpg" multiple>
                </div>
                <div class="mb-3">
                    <label for="age" class="form-label mt-3">Change age:</label>
                    <input type="text" class="form-control" id="age" name="age">
                </div>
                <div class="mb-3">
                    <label for="bio" class="form-label">Change bio:</label>
                    <input type="text" class="form-control" id="bio" name="bio">
                </div>
                <div class="mb-3">
                    <label for="budget" class="form-label">Change budget:</label>
                    <input type="text" class="form-control" id="budget" name="budget">
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">Change gender:</label>
                    <input type="text" class="form-control" id="gender" name="gender">
                </div>

                <div class="mb-3 text-center mt-5">
                    <button type="submit" class="btn btn-primary" style="width: 100px">Apply</button>
                </div>


            </form>
        </div>
    </div>


</div>

<div class="foot container-fluid">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <div class="col-md-4 d-flex align-items-center">
            <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
                <svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"/></svg>
            </a>
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
