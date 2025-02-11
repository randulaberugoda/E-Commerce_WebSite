<?php

include 'db_config.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $category = $_POST['category'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $contactName = $_POST['contactName'];
    $contactNumber = $_POST['contactNumber'];
    $condition = $_POST['condition'];
    $email = $_POST['email'];
    
    
    $photos = '';
    if (!empty($_FILES['photos']['name'][0])) {
        $fileNames = is_array($_FILES['photos']['name']) ? $_FILES['photos']['name'] : [];
        $fileTmpNames = $_FILES['photos']['tmp_name'];
        $fileExtensions = array('jpg', 'jpeg', 'png', 'gif');
    
        $uploadDirectory = 'uploads/';
    
        $photoPaths = array();
        foreach ($fileNames as $key => $fileName) {
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            if (in_array($fileExtension, $fileExtensions)) {
                $newFileName = uniqid() . '.' . $fileExtension;
                $uploadPath = $uploadDirectory . $newFileName;
                if (move_uploaded_file($fileTmpNames[$key], $uploadPath)) {
                    $photoPaths[] = $newFileName;
                }
            }
        }
        $photos = implode(',', $photoPaths);
    }
    
    $stmt = $conn->prepare("INSERT INTO postad (category,item_condition, title, description, price, photos, contact_name, contact_number,email, created_at) VALUES (?,?, ?, ?, ?, ?, ?, ?,?, NOW())");
    $stmt->bind_param("sssssssss", $category,$condition, $title, $description, $price, $photos, $contactName, $contactNumber,$email);

    
    if ($stmt->execute()) {
        echo "Advertisement posted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    
    $stmt->close();
    $conn->close();

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Advertisement</title>
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
            max-width: 600px;
            width: 100%;
            margin: 2rem auto;
        }

        h2 {
            text-align: center;
            margin-bottom: 1rem;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        input[type="file"],
        select,
        textarea {
            margin-bottom: 15px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        textarea {
            resize: vertical;
        }

        input[type="radio"] {
            margin-right: 10px;
        }

        .radio-group {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #388e3c;
        }

        footer {
            background-color: #135C51;
            padding: 10px 0;
            text-align: center;
            margin-top: auto;
            color: #eeebeb;
        }

        /* Responsive Design */
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
        <h2>Post Advertisement</h2>
        <form action="postAd.php" method="POST" enctype="multipart/form-data">
            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <option value="Electronics">Electronics</option>
                <option value="Vehicles">Vehicles</option>
                <option value="Property">Property</option>
                <option value="Fashion">Fashion</option>
                <option value="Home & Living">Home & Living</option>
                <option value="Books">Books</option>
            </select>

            <label for="title">Title:</label>
            <input type="text" id="title" name="title" placeholder="Ad Title" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="5" placeholder="Ad Description" required></textarea>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" placeholder="Price" required>

            <label for="photos">Photos:</label>
            <input type="file" id="photos" name="photos[]" accept="image/*" multiple>


            <label for="contactName">Contact Name:</label>
            <input type="text" id="contactName" name="contactName" placeholder="Your Name" required>

            <label for="contactNumber">Contact Number:</label>
            <input type="text" id="contactNumber" name="contactNumber" placeholder="Your Phone Number" required>

            <label for="email">Email:</label>
            <input type="text" id="email" name="email" placeholder="email" required>

            <div class="radio-group">
                <label>Condition:</label>
                <input type="radio" id="new" name="condition" value="New" >
                <label for="new">Brand New</label>
                <input type="radio" id="used" name="condition" value="Used">
                <label for="used">Used</label>
            </div>

            <button type="submit">Submit</button>
        </form>
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
