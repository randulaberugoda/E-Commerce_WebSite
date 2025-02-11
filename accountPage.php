<?php
session_start();
include 'db_config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];  

$stmt = $conn->prepare("SELECT email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($user_email);
$stmt->fetch();
$stmt->close();

if (!$user_email) {
    die("User email not found.");
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_ad_id'])) {
    $ad_id = $_POST['delete_ad_id'];
    $stmt = $conn->prepare("DELETE FROM postad WHERE id = ? AND email = ?");
    $stmt->bind_param("is", $ad_id, $user_email);
    if ($stmt->execute()) {
        echo "<script>alert('Advertisement deleted successfully!'); window.location.href='your_ads.php';</script>";
    } else {
        echo "<script>alert('Failed to delete advertisement.');</script>";
    }
    $stmt->close();
}

// show adss
$stmt = $conn->prepare("SELECT * FROM postad WHERE email = ? ORDER BY created_at DESC");
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();


$stmt = $conn->prepare("SELECT username FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($contact_name);
$stmt->fetch();
$stmt->close();


$first_name = explode(' ', trim($contact_name))[0];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Advertisements</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <div class="nav-links">
        <a href="logout.php">Logout</a>
        <a href="home.php">Home</a>
    </div>
    <h1>Welcome <?php echo htmlspecialchars($first_name); ?></h1>
</header>

<br><br><a href="postAd.php" class="btnPostAd">Post Your Ad Free</a>

<section class="listings">
    <?php
    if ($result->num_rows > 0) {
        while ($ad = $result->fetch_assoc()) {
            $photos = explode(',', $ad['photos']);
            $firstPhoto = !empty($photos[0]) ? $photos[0] : 'default.jpg'; 

            echo '<div class="card">';
            echo '<img src="uploads/' . $firstPhoto . '" alt="' . htmlspecialchars($ad['title']) . '">';
            echo '<h3>' . htmlspecialchars($ad['title']) . '</h3>';
            echo '<p>' . htmlspecialchars($ad['description']) . '</p>';
            echo '<p>Price: $' . htmlspecialchars($ad['price']) . '</p>';
            echo '<p>Condition: ' . htmlspecialchars($ad['item_condition']) . '</p>';
            echo '<div class="card-buttons">';
            echo '<a href="edit_ad.php?id=' . $ad['id'] . '" class="edit-btn">Edit</a>';
            echo '<form method="POST" style="display:inline;">
                    <input type="hidden" name="delete_ad_id" value="' . $ad['id'] . '">
                    <button type="submit" class="delete-btn" onclick="return confirm(\'Are you sure you want to delete this ad?\');">Delete</button>
                  </form>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "<p>No advertisements found.</p>";
    }
    $conn->close();
    ?>
</section>

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
    
header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color:#135C51 
    padding: 15px;
    color: white;
    font-size: 18px;
}

header h1 {
    margin: 0 auto;
    font-size: 24px;
    font-weight: bold;
    text-align: center;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
}

header .nav-links {
    display: flex;
    gap: 15px;
}

header .nav-links a {
    text-decoration: none;
    padding: 8px 15px;
    background-color: #135C51;
    color: white;
    font-size: 16px;
    font-weight: bold;
    border-radius: 5px;
    transition: 0.3s;
}



.nav-links {
    position: absolute;
    right: 20px;
}

.listings {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
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
    height: 200px;
    object-fit: cover;
    border-radius: 5px;
}

.card h3 {
    margin: 10px 0;
}

.card p {
    color: #777;
}


.card-buttons {
    display: flex;
    justify-content: space-around;
    margin-top: 10px;
}

.card-buttons a {
    text-decoration: none;
    padding: 8px 12px;
    border-radius: 5px;
    color: white;
    font-size: 14px;
    transition: 0.3s;
}

.edit-btn {
    background-color: #fbbc05;
}

.delete-btn {
    background-color: #d9534f;
}

.edit-btn:hover {
    background-color: #e5a300;
}

.delete-btn:hover {
    background-color: #c9302c;
}


.table {
    width: 100%;
}
.table td, .table th {
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
