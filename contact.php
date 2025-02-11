<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; padding: 20px; }
        h2 { color:  #135C51; }
        .contact-form { max-width: 400px; margin-top: 20px; }
        .form-group { margin-bottom: 15px; }
        label { font-weight: bold; }
        input, textarea { width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px; }
        button { background-color: #135C51; color: white; padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background-color: #135C51; }

        .containerContact{
            padding: 20px;
    margin: 20px;
    border-radius: 8px;
    box-shadow: 0 0 1px rgba(0, 0, 0, 0.1);
    background-color: #f5f5f5;
        }

      
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
        footer {
            background-color: #135C51;
            padding: 10px 0;
            text-align: center;
            margin-top: auto;
            color: #eeebeb;
        }

        .containerAbout h2 {
    color: #135C51;
    font-size: 24px;
    margin-bottom: 10px;
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
        
<container class="containerContact">
    <h2>Contact Us</h2>
    <p>If you have any questions, feel free to reach out to us. We are here to help!</p>
    
    <div class="contact-form">
        <form action="send_message.php" method="POST">
            <div class="form-group">
                <label for="name">Your Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Your Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="message">Your Message:</label>
                <textarea id="message" name="message" rows="4" required></textarea>
            </div>

            <button type="submit">Send Message</button>
        </form>
    </div>
    
    <h3>Our Contact Details</h3>
    <p><strong>Email:</strong> randulaxp@gmail.com</p>
    <p><strong>Phone:</strong> 0776957421</p>
    <p><strong>Address:</strong> Sri Lanka</p>
</container>

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
</body>
</html>
