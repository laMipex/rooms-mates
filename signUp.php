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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <title>Sign Up - Rooms N' Mates</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>

</head>

<body>
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
                <form action="logIn.html" class="d-flex">
                    <button class="btn btn-outline-primary" type="submit">Log In</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1 class="text-center my-5">Sign Up</h1>
        <form method="post" action="createNewUser.php" class="col-md-6 col-sm-6 col-xxs-4 mx-auto mt-4">
            <div class="mb-3">
                <label for="firstname" class="form-label">First name</label>
                <input type="text" name="firstname" class="form-control" id="firstname" placeholder="John" required>
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Last name</label>
                <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Dow" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="example@mail.com" required>
            </div>
            <div class="mb-3">
                <label for="jmbg" class="form-label">JMBG</label>
                <input type="text" name="jmbg" class="form-control" id="jmbg" placeholder="0101999729875" required>
            </div>
            <div class="mb-3 group">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" required>
                <input type="checkbox" onclick="myFunction()">Show Password
                <p id="message">Password is <span id="strength"></span></p>
            </div><br>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                <label class="form-check-label" for="exampleCheck1">You are accepting our <a href="termsandcon.html">Terms & Conditions</a></label>
            </div>

            <script>
                var pass = document.getElementById("password");
                var msg = document.getElementById("message");
                var str = document.getElementById("strength");

                pass.addEventListener('input', () => {
                    if (pass.value.length > 0) {
                        msg.style.display = "block";
                    } else {
                        msg.style.display = "none";
                    }
                    if (pass.value.length < 4) {
                        str.innerHTML = "weak";
                        pass.style.borderColor = "#ff5925";
                        msg.style.color = "#ff5925";
                    } else if (pass.value.length >= 4 && pass.value.length < 8) {
                        str.innerHTML = "medium";
                        pass.style.borderColor = "orange";
                        msg.style.color = "orange";
                    } else if (pass.value.length >= 8) {
                        str.innerHTML = "strong";
                        pass.style.borderColor = "#26d730";
                        msg.style.color = "#26d730";
                    }
                });
            </script>
        <form action="login.php">
            <button type="submit" name="submit" class="btn btn-primary">Sign Up</button>
        </form>
    </div>

</body>

</html>