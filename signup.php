
<?php

$conn = new mysqli("localhost", "root", "", "codex",3307);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $contact_number = $_POST['contact_number'];

    if ($password === $password2) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        
        $sql = "INSERT INTO users (username, email, password,contact_number) VALUES ('$username', '$email', '$hashed_password','$contact_number')";

        if ($conn->query($sql) === TRUE) {
            echo "Signup successful!";
            header("Location: login.php"); 
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Passwords do not match.";
    }
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <link rel="stylesheet" href="styles.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            margin: 0;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            display: flex;
            flex-direction: column;
        }

        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: #135C51;
            color: #f5f5f5;
            padding: 20px 0;
        }

        nav ul {
            list-style: none;
            padding: 0;
            text-align: center;
        }

        nav ul li {
            display: inline;
            margin: 0 15px;
        }

        nav ul li a {
            color: #f5f5f5;
            text-decoration: none;
            font-weight: bold;
        }

        .container {
            background-color: #eeebeb;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 1px rgba(0, 0, 0, 0.1);
            text-align: center;
            color: black;
            max-width: 400px;
            width: 100%;
            margin: 2rem auto; 
        }

        h2 {
            margin-top: 0;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input[type="textSignup"],
        input[type="emailSignup"],
        input[type="passwordSignup"],
        input[type="password2Signup"],
        input[type="contact_number"],
        button {
            margin: 10px 0;
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
        }

        button {
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background-color: #388e3c;
        }

        .google-btn {
            margin-top: 20px;
        }

        footer {
            background-color: #135C51;
            padding: 10px 0;
            text-align: center;
            margin-top: auto;
            color: #eeebeb;
        }

        
        @media screen and (max-width: 600px) {
            .container {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                     <li><a href="home.php">Home</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="signup.php">Signup</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <h2>Sign Up</h2>
        <form action="#" method="POST">
            <input type="textSignup" name="username" placeholder="Username" required>
            <input type="emailSignup" name="email" placeholder="Email" required>
            <input type="passwordSignup" name="password" placeholder="Password" required>
            <input type="password2Signup" name="password2" placeholder="Confirm Password" required>
            <input type="contact_number" name="contact_number" placeholder="Contact Number" required>
            <button type="submit">Sign Up</button>
            <p>Already have an account? <a href="login.php">Login</a></p>
        </form>
        <div class="google-btn" id="googleSignIn"></div>
    </div>

    <footer>

<table class="table">
  <tr>
    <th>Help & Support</th>
    <th>About</th>
    <th>Blog & Guides</th>
  </tr>
  <tr>
    <td><a href="login.php" class="btn">FAQ</a></td>
    <td><a href="login.php" class="btn">About Us</a></td>
    <td><a href="login.php" class="btn">Official Blog</a></td>
  </tr>
  <tr>
    <td><a href="login.php" class="btn">Contact Us</a></td>
    <td><a href="login.php" class="btn">Terms and Conditions</a></td>
  </tr>
  <tr>
	<td></td> 
    <td><a href="login.php" class="btn">Privacy policy</a></td>   
  </tr>

</table>

            <p>&copy; 2025 Design by Randula Berugoda</p>
        </footer>  
        <style>
        .table {
    width: 100%;
}
.table td, 
.table th {
    text-align: left;
    padding: 8px;
}
.table a {
    color: white; 
    text-decoration: none; 
    font-weight: normal; 
    font-size: inherit; 
}
.table a:hover {
    color: black; 
}
</style>

    
    <script>
        function onSuccess(googleUser) {
            var profile = googleUser.getBasicProfile();
            console.log('Logged in as: ' + profile.getName());
           
        }
        function onFailure(error) {
            console.log(error);
        }
        function renderButton() {
            gapi.signin2.render('googleSignIn', {
                'scope': 'profile email',
                'width': 200,
                'height': 40,
                'longtitle': true,
                'theme': 'light',
                'onsuccess': onSuccess,
                'onfailure': onFailure
            });
        }
        
        window.onload = function() {
            renderButton();
        };
    </script>
</body>
</html>
