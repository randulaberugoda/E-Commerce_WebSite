<?php
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EzyMart</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
    

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
        </header>
  
        <div class="containerSwiper ">
            <div class="swiper">
                <div class="swiper-wrapper">
                   <div class="swiper-slide"><img src="images/slshow1.png" alt=""></div>
                   <div class="swiper-slide"><img src="images/slshow2.jpg" alt=""></div>
                </div>
             </div>
        </div>


                <div class="container">
                    <div class="search-bar">
                        <input type="text" placeholder="Search...">
                        <button>Search</button>
                    </div>

                    <div class="grid-container">
                        <div class="grid-item">
                            <a href="electronic.php" class="button">
                            <img src="images/Electronics.png" alt="Electronics">
                            <span>Electronics</span>
                          </a>
                        </div>
                        <div class="grid-item">
                            <a href="vehicles.php" class="button">
                            <img src="images/car.png" alt="Vehicles">
                            <span>Vehicles</span>
                          </a>
                        </div>
                        <div class="grid-item">
                            <a href="property.php" class="button">
                            <img src="images/property.png" alt="property">
                            <span>Property</span>
                          </a>
                        </div>
                        <div class="grid-item">
                            <a href="fashion.php" class="button">
                            <img src="images/Fashion.png" alt="Fashion">
                            <span>Fashion</span>
                          </a>
                        </div>

                        <div class="grid-item">
                          <a href="homeAndLiving.php" class="button">
                            <img src="images/Home & Living.png" alt="Home&Living">
                            <span>Home & Living</span>
                          </a>
                        </div>

                        <div class="grid-item">
                            <a href="book.php" class="button">
                              <img src="images/book.png" alt="book">
                              <span>Book</span>
                            </a>
                          </div>                        
                        <div class="grid-item">
                            <a href="display_ads.php" class="button">
                              <img src="https://via.placeholder.com/50" alt="Icon 7">
                              <span>N/A</span>
                            </a>
                          </div>       
                        
                      </div>
                      <a href="login.php" class="btnPostAd">Post Your Ad Free</a>

                      <div class="main-container">
                        <main>
                    <section class="listings">
                        <div class="card">
                            <img src="l1.jpeg" alt="Land 1">
                            <h3>Mountain View Land</h3>
                            <p>Location: Highlands</p>
                            <p>Price: $250,000</p>
                            <button class="cta">Learn More</button>
                        </div>
                   
                        <div class="card">
                            <img src="l1.jpeg" alt="Land 1">
                            <h3>Mountain View Land</h3>
                            <p>Location: jiHiglands</p>
                            <p>Price: $50,000</p>
                            <button class="cta">Learn More</button>
                        </div>
                        <div class="card">
                            <img src="l1.jpeg" alt="Land 1">
                            <h3>Mountain View Land</h3>
                            <p>Location:land Highs</p>
                            <p>Price: $750,000</p>
                            <button class="cta">Learn More</button>
                        </div>
                    </section>
                </div>
            </main>
        </div>

 

        <footer>

<table class="table">
  <tr>
    <th>Help & Support</th>
    <th>About</th>
    <th>Blog & Guides</th>
  </tr>
  <tr>
    <td><a href="contact.php" class="btn">FAQ</a></td>
    <td><a href="about.php" class="btn">About Us</a></td>
    <td><a href="login.php" class="btn">Official Blog</a></td>
  </tr>
  <tr>
    <td><a href="login.php" class="btn">Contact Us</a></td>
    <td><a href="about.php" class="btn">Terms and Conditions</a></td>
  </tr>
  <tr>
	<td></td> 
    <td><a href="about.php" class="btn">Privacy policy</a></td>   
  </tr>

</table>

            <p>&copy; 2025 Design by Randula Berugoda</p>
        </footer>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script> 
    <script>
        function updateMaxPrice(value) {
          document.getElementById('displayMaxPrice').textContent = '$' + value;
        }

        document.addEventListener("DOMContentLoaded", function() {
            const swiper = new Swiper('.swiper', {
                autoplay: {
                    delay: 1000,
                    disableOnInteraction: false,
                },
                loop: true,
            });
        });
    </script>
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
