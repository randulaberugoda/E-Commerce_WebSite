<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Land for Sale</title>

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
            display: flex;
            flex-direction: column;
            align-items: center; 
            margin: 0;
        }

        .search-bar {
            display: flex;
            width: 70%;
            max-width: 600px;
            border: 1px solid #000000;
            border-radius: 5px;
            overflow: hidden;
            align-items: center;
            margin: 2rem 0 1rem; 
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

        .main-content {
            display: flex;
            flex: 1;
            padding: 20px;
            gap: 20px;
        }

        .sidebar {
            width: 25%;
            background-color: #eeebeb;
            padding: 20px;
            box-sizing: border-box;
        }

        .sidebar h2, .sidebar h3 {
            margin-top: 0;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin-bottom: 10px;
        }

        .price-range {
            margin-bottom: 15px;
        }

        .price-range input[type="range"] {
            width: 100%;
            -webkit-appearance: none;
            appearance: none;
            height: 5px;
            background: #d3d3d3;
            outline: none;
            border-radius: 5px;
        }

        .price-range input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 15px;
            height: 15px;
            background: #4caf50;
            border-radius: 50%;
            cursor: pointer;
        }

        .price-range input[type="range"]::-moz-range-thumb {
            width: 15px;
            height: 15px;
            background: #4caf50;
            border-radius: 50%;
            cursor: pointer;
        }

        .sidebar button {
            display: block;
            width: 100%;
            padding: 10px 0;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .sidebar button:hover {
            background-color: #45a049;
        }

        .max-price-display {
            margin-top: 5px;
        }

        
        .listings {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            width: 75%;
        }

        .card {
            background-color: #eeebeb;
            padding: 20px;
            border-radius: 8px;
            width: 30%;
            box-shadow: 0 1px 1px rgba(0,0,0,0.2);
            text-align: center;
        }

        .card img {
            max-width: 100%;
            border-radius: 5px;
        }

        .card h3 {
            margin: 10px 0;
        }

        .card p {
            color: #777;
        }

        .card button {
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }

        .card button:hover {
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
    <div class="wrapper">
        <header>
            <nav>
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="signup.php">Signup</a></li>
                </ul>
            </nav>
            <div class="container">
                <div class="search-bar">
                    <input type="text" placeholder="Search...">
                    <button>Search</button>
                </div>
            </div>
        </header>

        <div class="main-content">
            <aside class="sidebar">
                <h2>Filter By</h2>
                <form id="filterForm">
                    <ul>
                        <li><label for="district">District</label><br><input type="text" id="district" name="district" placeholder="District"></li>
                    </ul>
                    <h3>Price Range</h3>
                    <div class="price-range">
                        <input type="range" id="price" name="price" value="0" min="0" max="1000" oninput="updateMaxPrice(this.value)">
                        <span>Price: <span id="minPrice">$0</span> - <span id="maxPrice">$1000</span></span>
                    </div>
                    <span class="max-price-display">Price: <span id="displayMaxPrice">$0</span></span>
                    <button type="button" onclick="filterItems()">Filter</button>
                </form>
            </aside>

            <?php
include 'db_config.php';


$query = "SELECT * FROM postad WHERE category = 'Books'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo '<section class="listings">';
    
    while ($row = $result->fetch_assoc()) {
        $photos = explode(',', $row['photos']);
        $firstPhoto = isset($photos[0]) ? $photos[0] : 'default.jpg'; 
        
        echo '<div class="card">';
        echo '<img src="uploads/' . $firstPhoto . '" alt="' . htmlspecialchars($row['title']) . '">';
        echo '<h3>' . htmlspecialchars($row['title']) . '</h3>';
        echo '<p>Description: ' . htmlspecialchars($row['description']) . '</p>';
        echo '<p>Price: $' . htmlspecialchars($row['price']) . '</p>';
        echo '<p>Condition: ' . htmlspecialchars($row['item_condition']) . '</p>';
        echo '<button class="cta">Learn More</button>';
        echo '</div>';
    }
    
    echo '</section>';
} else {
    echo '<p>No Items found</p>';
}

$conn->close();
?>
</div>

        <footer>
            <p>&copy; 2024 Design by CodeX || Randula Berugoda</p>
        </footer>
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
</body>
</html>
