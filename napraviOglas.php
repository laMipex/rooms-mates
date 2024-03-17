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
    $town = $_POST['town'];
    $address = $_POST['street'];
    $app_number = $_POST['app_number'];
    $description = $_POST['description'];
    $number_room = $_POST['number_room'];
    $photo = $_POST['photo']; // Assuming you are handling the file upload correctly

    // Use session userID as the foreign key reference
    $userId = $_SESSION['userID'];

    // Inserting data into the apartments table
    $sql = "INSERT INTO apartments (town, address, app_number, description, number_room, photo, userID) VALUES (:town, :address, :app_number, :description, :number_room, :photo, :userID)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':town' => $town,
        ':address' => $address,
        ':app_number' => $app_number,
        ':description' => $description,
        ':number_room' => $number_room,
        ':photo' => $photo,
        ':userID' => $userId
    ]);

    echo "Apartment added successfully!";
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
    <link rel="stylesheet" href="css/IndexLog.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/UpIn.css">
    <link href="css/UpIn.css" rel="stylesheet">
    <title>Title</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-md">
    <div class="container-fluid">
        <img class="logo" src="#" alt="logo">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar" aria-controls="collapsibleNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav mx-auto mb-2 mb-ls-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.html">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Cities
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="noviSad.php">Novi Sad</a></li>
                        <li><a class="dropdown-item" href="#">Subotica</a></li>
                        <li><a class="dropdown-item" href="#">Belgrade</a></li>
                        <li><a class="dropdown-item" href="#">Nis</a></li>
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
                <form action="logIn.html" class="d-flex">
                    <button class="btn btn-outline-primary" type="submit">Log In</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="container">
    <h1 class="text-center my-5">Looking for roommates!</h1>
    <form method="post" class="col-md-6 col-sm-6 col-xxs-4 mx-auto mt-4">

        <div class="mb-3">
            <label for="town" class="form-label">Town:</label>
            <input type="text" name="town" class="form-control" id="town" required>
        </div>
        <div class="mb-3">
            <label for="street" class="form-label">Address:</label>
            <input type="text" name="street" class="form-control" id="street" required>
        </div>
        <div class="mb-3">
            <label for="anumber" class="form-label">Appartment number:</label>
            <input type="text" name="app_number" class="form-control" id="anumber">
        </div>
        <div class="mb-3">
            <label for="room" class="form-label">Number of free rooms:</label>
            <input type="number" name="number_room" class="form-control" id="room">
        </div>
        <div class="mb-3">
            <label for="desc" class="form-label">Description:</label>
            <input type="text" name="description" class="form-control" id="desc">
        </div>
        <div class="mb-3">
            <label for="photo" class="form-label">Upload photo:</label><br><br>
            <input type="file" name="photo" id="photo" accept="image/png,image/jpg" multiple>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
            <label class="form-check-label" for="exampleCheck1">Looking for roommates</label>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Sign Up</button>
    </form>
</div>

</body>
</html>
