<?php

$servername = "localhost";
$username = "root";
$password = ""; 
$database = "codex"; 
$port = 3307;

$conn = new mysqli($servername, $username, $password, $database,$port);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT id, category, title, description, price, photos, contact_name FROM postad ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posted Ads</title>
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
    text-align: center;
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
    display: flex;
    flex-direction: column;
    align-items: center;
}

.search-bar {
    display: flex;
    width: 70%;
    max-width: 600px;
    border: 1px solid #000000;
    border-radius: 5px;
    overflow: hidden;
    align-items: center;
    justify-content: center;
    margin: 2rem auto;
}

.search-bar input {
    flex: 1;
    padding: 10px;
    border: none;
    outline: none;
}

.search-bar button {
    background-color: #50C878; 
    color: #faf5e4;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
}

@media (max-width: 600px) {
    .search-bar {
        width: 90%;
    }
}

.ads-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center; 
    width: 75%;
    margin: 0 auto;
}

.ad-card {
    background-color: #eeebeb;
    padding: 20px;
    border-radius: 8px;
    width: 30%;
    box-shadow: 0 1px 1px rgba(0,0,0,0.2);
    text-align: center;
}

.ad-card img.ad-image {
    max-width: 100%;
    height: 200px; 
    object-fit: cover;
    border-radius: 5px;
}

.ad-card h2 {
    margin: 10px 0;
    font-size: 1.2em;
}

.ad-card p {
    color: #777;
    margin: 5px 0;
    text-align: left; }

.ad-card p strong {
    color: #333;
}

.ad-card button {
    background-color: #4caf50;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
}

.ad-card button:hover {
    background-color: #45a049;
}

footer {
    background-color: #135C51;
    padding: 10px 0;
    text-align: center;
    margin-top: auto;
    color: #eeebeb;
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
        <div class="search-bar">
                    <input type="text" placeholder="Search...">
                    <button>Search</button>
                </div>
            </div>
    </header>

    
    <main>
      
    <div class="ads-container">
    <?php
    if ($result->num_rows > 0) {
        
        while ($row = $result->fetch_assoc()) {
            ?>
            <div class="ad-card">
                <img src="uploads/<?php echo htmlspecialchars($row['photos']); ?>" alt="Ad Image" class="ad-image">
                <h2><?php echo htmlspecialchars($row['title']); ?></h2>
                <p><strong>Category:</strong> <?php echo htmlspecialchars($row['category']); ?></p>
                <p><strong>Description:</strong> <?php echo htmlspecialchars($row['description']); ?></p>
                <p><strong>Price:</strong> $<?php echo htmlspecialchars($row['price']); ?></p>
                <p><strong>Contact:</strong> <?php echo htmlspecialchars($row['contact_name']); ?></p>
                <button>Contact Seller</button>
            </div>
            <?php
        }
    } else {
        echo "<p>No ads found.</p>";
    }
    $conn->close();
    ?>
</div>

    </main>

    
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
