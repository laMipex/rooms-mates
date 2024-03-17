<?php
// Konektujte se na bazu
$pdo = new PDO('mysql:host=localhost;dbname=roommates', 'root', '');

// Ako je poslat zahtev za odobravanje
if (isset($_GET['approve'])) {
    $userId = $_GET['approve'];
    $stmt = $pdo->prepare("UPDATE user SET approved = 1 WHERE userID = ?");
    $stmt->execute([$userId]);
    echo "Korisnik sa ID $userId je odobren.";
}

// Izlistaj sve korisnike
$stmt = $pdo->prepare("SELECT * FROM user");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Prikazi korisnike i dugme za odobravanje
foreach ($users as $user) {
    echo "ID: " . $user['userID'] . " - " . $user['u_fname'] . " " . $user['u_lname'];
    if (!$user['approved']) {
        echo " - <a href='?approve=" . $user['userID'] . "'>Odobri</a>";
    }
    echo "<br />";
}
?>