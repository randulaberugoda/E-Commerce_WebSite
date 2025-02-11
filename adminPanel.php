<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "codex";
$port = 3307;

$conn = new mysqli($servername, $username, $password, $database, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// total ads
$totalAdsQuery = "SELECT COUNT(*) AS total FROM postad";
$totalAdsResult = $conn->query($totalAdsQuery);
$totalAds = $totalAdsResult->fetch_assoc()['total'];

//  search by tp
$ads = [];
if (isset($_POST['search']) && !empty($_POST['contact_number'])) {
    $contact_number = $_POST['contact_number'];
    $searchQuery = "SELECT * FROM postad WHERE contact_number = ?";
    $stmt = $conn->prepare($searchQuery);
    $stmt->bind_param("s", $contact_number);
    $stmt->execute();
    $ads = $stmt->get_result();
}

// search by emails
$users = [];
if (isset($_POST['search']) && !empty($_POST['email'])) {
    $email = $_POST['email'];
    $searchQuery = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($searchQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $cus = $stmt->get_result();
}


// customers count
$totalCusQuery = "SELECT COUNT(*) AS total FROM users";
$totalCusResult = $conn->query($totalCusQuery);
$totalCus = $totalCusResult->fetch_assoc()['total'];

//ad deletion
if (isset($_POST['delete']) && !empty($_POST['ad_id'])) {
    $ad_id = $_POST['ad_id'];
    $deleteQuery = "DELETE FROM postad WHERE id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $ad_id);
    $stmt->execute();
    echo "<p>Ad with ID $ad_id deleted successfully.</p>";
}

//  custoner deletion
if (isset($_POST['delete_cu']) && !empty($_POST['cu_id'])) {
    $cu_id = $_POST['cu_id'];
    $deleteQuery = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $cu_id);
    $stmt->execute();
    echo "<p>Customer with ID $cu_id deleted successfully.</p>";
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        header {
            background-color: #135C51;
            color: white;
            padding: 1rem;
        }
        header nav ul {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: space-around;
        }
        header nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 1.2rem;
        }
        header nav ul li a:hover {
            text-decoration: underline;
        }
        .wrapper {
            max-width: 1100px;
            margin: auto;
            padding: 1rem;
        }
        h1 {
            color:white;
        }
        h2 {
            text-align: center;
            color: #135C51;
        }
        form {
            margin: 20px auto;
            max-width: 600px;
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: white;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }

        #search {
            background-color: #135C51;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        #delete{
            background-color: #B22222;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            width: 55px;
            border-radius: 10px;   
        }

        #edit{
            background-color: #FFC300;
            color: black;
            border: none;
            padding: 5px 15px;
            cursor: pointer;
            width: 65x;
            border-radius: 10px;   
        }

        footer {
            background-color: #135C51;
            color: white;
            text-align: center;
            padding: 1rem;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <nav>        
            <ul>
                <li><h1>Admin Panel</h1></li>
                <li><a href="home.php">Home</a></li>
               
            </ul>
        </nav>
    </header>
<br><br>
    <div class="wrapper">
        <h2>Total Advertisements: <?php echo $totalAds; ?></h2><br><hr><br>

        <form method="POST">
            <label for="contact_number">Search Ad by Phone Number:</label>
            <input type="text" id="contact_number" name="contact_number" required>
            <button id="search" type="submit" name="search">Search</button>

        </form>

        <?php if (!empty($ads) && $ads->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Phone Number</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($ad = $ads->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $ad['id']; ?></td>
                            <td><?php echo $ad['title']; ?></td>
                            <td><?php echo $ad['description']; ?></td>
                            <td><?php echo $ad['price']; ?></td>
                            <td><?php echo $ad['contact_number']; ?></td>
                            <td><?php echo $ad['category']; ?></td>
                            <td>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="ad_id" value="<?php echo $ad['id']; ?>">
                                    <button id="delete" type="submit" name="delete">Delete</button>
                                    <button id="edit" type="submit">Edit</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table><br><hr><br>
        <?php elseif (isset($_POST['search'])): ?>
            <p>No advertisements found for the provided phone number.</p>
        <?php endif; ?>


        </h2><br><hr><br>
    
        <h2>Total Customers: <?php echo $totalCus -1; ?>
    </h2><br><hr><br>

<form method="POST">
    <label for="contact_number">Search customer by email:</label>
    <input type="text" id="email" name="email" required>
    <button id="search" type="submit" name="search">Search</button>

</form>
<?php if (!empty($cus) && $cus->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Password</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($cu = $cus->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $cu['id']; ?></td>
                            <td><?php echo $cu['username']; ?></td>
                            <td><?php echo $cu['email']; ?></td>
                            <td><?php echo $cu['password']; ?></td>
                            <td>
                            <form method="POST" style="display:inline;">
    <input type="hidden" name="cu_id" value="<?php echo $cu['id']; ?>">
    <button id="delete" type="submit" name="delete_cu" onclick="return confirm('Are you sure you want to delete this customer?')">Delete</button>
</form>

                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table><br><hr><br>
        <?php elseif (isset($_POST['search'])): ?>
            <p>No customers found for the provided email.</p>
        <?php endif; ?>
    </div>

    <footer>
        <p>&copy; 2024 Design by CodeX || Randula Berugoda</p>
    </footer>
</body>
</html>
