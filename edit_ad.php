<?php
session_start();
include 'db_config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if (!isset($_GET['id'])) {
    die("Invalid request.");
}
$ad_id = $_GET['id'];


$stmt = $conn->prepare("SELECT * FROM postad WHERE id = ? AND email = (SELECT email FROM users WHERE id = ?)");
$stmt->bind_param("ii", $ad_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Ad not found or unauthorized access.");
}

$ad = $result->fetch_assoc();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $item_condition = $_POST['item_condition'];

    // Update 
    $stmt = $conn->prepare("UPDATE postad SET title = ?, description = ?, price = ?, item_condition = ? WHERE id = ? AND email = (SELECT email FROM users WHERE id = ?)");
    $stmt->bind_param("ssssii", $title, $description, $price, $item_condition, $ad_id, $user_id);

    if ($stmt->execute()) {
        header("Location: accountPage.php?success=updated");
        exit();
    } else {
        echo "Error updating ad.";
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Advertisement</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
   
    <a href="your_advertisements.php">Back to Ads</a>
</header>
<div class="form-container">
<form action="" method="POST">
    <label>Title:</label>
    <input type="text" name="title" value="<?php echo htmlspecialchars($ad['title']); ?>" required>

    <label>Description:</label>
    <textarea name="description" required><?php echo htmlspecialchars($ad['description']); ?></textarea>

    <label>Price:</label>
    <input type="text" name="price" value="<?php echo htmlspecialchars($ad['price']); ?>" required>

    <label>Condition:</label>
    <select name="item_condition" required>
        <option value="Brand New" <?php if ($ad['item_condition'] == 'Brand New') echo 'selected'; ?>>Brand New</option>
        <option value="Used" <?php if ($ad['item_condition'] == 'Used') echo 'selected'; ?>>Used</option>
    </select>

    <button type="submit">Update Ad</button>
</form>
</div>
<footer>

        <p>&copy; 2025 Design by Randula Berugoda</p>
    </footer>  

    <style>
    .form-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
   
    form {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        width: 400px;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    label {
        font-weight: bold;
    }

    input, textarea, select {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }

    textarea {
        height: 100px;
        resize: vertical;
    }

    
    button {
        background: #135C51;
        color: white;
        border: none;
        padding: 10px;
        font-size: 16px;
        cursor: pointer;
        border-radius: 5px;
    }

    header a {
    display: inline-block;
    background: #135C51; 
    color: white;
    text-decoration: none;
    padding: 10px 15px;
    border-radius: 5px;
    font-size: 16px;
    margin-bottom: 15px;
}



</style>
</body>
</html>
