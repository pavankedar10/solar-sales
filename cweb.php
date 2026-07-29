<?php
session_start();

// Redirect if not logged in
if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit;
}

// Include database connection
include 'db_connect.php'; 

$conn = db_connect();

// Fetch the user's full name (assuming you have a `fullname` column)
$user_email = $_SESSION['user_email'];
$stmt = $conn->prepare("SELECT fullname FROM user WHERE email = ?");
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$username = $user['fullname'];

include('functions.php');
// Check if a product is added to the cart
if (isset($_GET['add_to_cart'])) {
    $product_id = $_GET['add_to_cart'];
    add_to_cart($product_id);
    $product_name = get_product_name($product_id);  // Get product name for message
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="cWeb.css">
    <script src="https://kit.fontawesome.com/f30fac2c61.js" crossorigin="anonymous"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Catamaran:wght@200&family=Courgette&family=Edu+TAS+Beginner:wght@700&family=Lato:wght@300;900&family=Mukta:wght@700&family=Mulish:wght@300&family=Open+Sans&family=PT+Sans:ital,wght@1,700&family=Poppins:wght@300&family=Raleway:wght@100&family=Roboto&family=Roboto+Condensed:wght@700&family=Roboto+Slab&display=swap"
        rel="stylesheet">
</head>
<?php
require("Cheader.php")
?>

        <!-- mainpage -->

        <div class="main">
            <div class="mainText">
                <h4>ALL TYPES OF SOLAR PRODUCT MANUFACTURER</h4>
                <h1 class="top">Solarwala Technoficient  </h1>
                <h1> Opc Pvt Ltd</h1>
                <p>India's top most solar sales & maintainance company</p>
            <a href="product.php">    <button>Explore</button></a>
                <a href="gov.php">     <button>Gov Scheme</button>
                </a>
                <br>
                <!-- <div class="a1"> <a  href="user_account.php"><button>user_account</button></a></div>  -->
            </div>
            <img src="sachin.png" alt="">
        </div>

        <!-- cards -->

        <div class="trend">
            <div class="head">
                <h1>Our <span>Solar Product</span></h1>
            </div>
            <div class="card">
                <div class="crd">
                    <img src="https://img.freepik.com/premium-photo/solar-panels-white-background_518421-482.jpg">
                    <div class="crdText">
                        <br>
                        <h2>Solar Panals</h2>
                        <br>
                            <h3> RS 48949/-</h3> 
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star-half-stroke"></i> <br>
                        <a href="?add_to_cart=22" class="add-to-cart"><button>Add to Cart</button></a>     
                        <a href="product.php"><button>VIEW MORE</button></a>
                    </div>
                 </div>

                 <div class="crd">
                    <img src="https://solarpoweredsite.com/wp-content/uploads/sites/2947/2020/10/seccamera-1.jpg" alt="" onclick="show(this)">
                    <div class="crdText">
                        <h2>Solar Camera</h2>
                        <br>
                        <h3> RS 6900/-</h3> 
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star-half-stroke"></i> <br>
                        <a href="?add_to_cart=23" class="add-to-cart"><button>Add to Cart</button></a>    
                        <a href="product.php"><button>VIEW MORE</button></a> 
                    </div>
                 </div>
                    <div class="crd">
                        <img src="https://cdn.shopify.com/s/files/1/1670/6415/products/Solar_Lamp_Post_Light_2_992x.jpg?v=1626276502" alt="" onclick="show(this)">
                        <div class="crdText">
                            <h2>Solar Lamp</h2>
                            <br>
                            <h3> RS 3680/-</h3> 
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star-half-stroke"></i> <br>
                            <a href="?add_to_cart=24" class="add-to-cart"><button>Add to Cart</button></a>
                            <a href="product.php"><button>VIEW MORE</button></a>
                            <!-- <h5> RS 1299</h5> -->
                        </div>
                    </div>
                </div>
            </div>

                <!-- Women Card -->

                <div class="trend" id="trendSec">
                    <div class="head">
                        <h1>OUR TOP<span>  SELLING PRODUCT</span></h1>
                    </div>
                    <div class="card">
                        <div class="crd">
                            <img src="https://png.pngtree.com/png-vector/20240309/ourlarge/pngtree-white-solar-cell-inverter-png-image_11919507.png">
                            <div class="crdText">
                                <h2>Solar Inverters</h2>
                                <br>
                                <h3> RS 29918/-</h3> 
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star-half-stroke"></i> <br>
                            <a href="?add_to_cart=25" class="add-to-cart"><button>Add to Cart</button></a>   
                            <a href="product.php"><button>VIEW MORE</button></a>  
                            </div>
                        </div>

                        <div class="crd">
                            <img src="https://thumbs.dreamstime.com/b/solar-battery-white-background-isolated-d-image-84542986.jpg" alt="" onclick="show(this)">
                            <div class="crdText">
                                <h2>Solar Batteries</h2>
                                <br>
                                <h3> RS 24815/-</h3> 
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star-half-stroke"></i> <br>
                            <a href="?add_to_cart=26" class="add-to-cart"><button>Add to Cart</button></a>   
                            <a href="product.php"><button>VIEW MORE</button></a>                              </div>
                        </div>

                        <div class="crd">
                            <img src="https://www.pngmart.com/files/6/Solar-Water-Heater-Background-PNG.png" alt="" onclick="show(this)">
                            <div class="crdText">
                                <h2>Solar Water Heaters</h2>
                                <br>
                                <h3> RS 5600/-</h3> 
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star-half-stroke"></i> <br>
                            <a href="?add_to_cart=27" class="add-to-cart"><button>Add to Cart</button></a>  
                            <a href="product.php"><button>VIEW MORE</button></a>   
                            </div>
                        </div>
                    </div>
                     <!-- Cart Message (Initially Hidden) -->
            <div id="cart-message" class="cart-message">
                Product added to cart!
            </div>
            <script>
        // Get the cart message container
        var cartMessage = document.getElementById("cart-message");

        // Show the cart message if a product is added to the cart
        <?php if (isset($product_name)): ?>
            cartMessage.style.display = "block";
            cartMessage.innerHTML = "<?php echo $product_name; ?> has been added to the cart!";

            // Hide the cart message after 3 seconds
            setTimeout(function () {
                cartMessage.style.display = "none";
            }, 3000);
  
    </script>
          <?php endif; ?>
                </div>


                <!-- about us -->

                <div class="about">

                <div class="about-container">
            <h1>About Us</h1>
            <p>
                Welcome to <strong>Solar Sales</strong>, your trusted partner in sustainable energy solutions. 
                We are committed to helping homeowners, businesses, and communities transition to clean, renewable energy 
                by providing top-of-the-line solar panels, cutting-edge technologies, and expert guidance.
            </p>
            <p>
                With over a decade of experience in the solar industry, we’ve built a reputation for delivering innovative 
                and customized solar solutions that reduce energy costs, increase energy independence, and contribute to a greener planet.
            </p>
            <div class="about-image">
                <img src="solar-about.jpg" alt="Solar panels installation" />
            </div>
            <h2>Why Choose Us?</h2>
            <ul>
                <li>High-quality solar products backed by industry-leading warranties.</li>
                <li>Expert design and installation tailored to your needs.</li>
                <li>Affordable financing options to fit your budget.</li>
                <li>Commitment to sustainability and a cleaner future.</li>
            </ul>
            <p>
                Join the thousands of satisfied customers who’ve made the switch to solar with us. Together, we can harness 
                the power of the sun to create a brighter tomorrow. Let’s make a difference—one solar panel at a time.
            </p>
    
                    </div>

                    <div class="me">
                        <img src="lap.png" alt="">
                        <div class="aboutText">
                            <!-- <h1>Who we are ?</h1> -->
                            <p></p>
                        </div>
                    </div>
                </div>

                <!-- contact -->

                <div class="contact">

                    <div class="contactus">
                        <h1>#Let's Connect</h1>
                        <p></p>
                    </div>

                    <div class="contactMe">
                        <div class="contactText">
                            <h1>Visit Our Office or Contact <br>
                                Us Today</h1>
                            <p>Address : Plot no
                            12, Near deogiri collage, chh.
                            sambhajinagar</p>
                            <p>Contact : solarwala143@gmail.com</p>
                            <p>Number : 9342345434</p>
                        </div>
                        <img src="map.PNG" alt="">
                    </div>
<!-- 
                    <div class="form">
                        <h1>Connect with Us. Fill Form</h1>
                        <input type="text" placeholder="Enter Name"> <br>
                        <input type="number" placeholder="Enter Contact number"> <br>
                        <input type="email" placeholder="Enter Email"><br>
                        <input type="number" placeholder="Enter Age"> <br>
                        <input type="text" placeholder="Enter Address"> <br>
                        <button>Submit</button>

                    </div> -->
                </div>
                 <!-- cart -->

                 <div class="cart">
                    <img id="newImg" src="" alt="">
                    <div class="cartText">
                        <h1>Solarwala offer: Trending Shop <br>
                            Now</h1>
                            <h2>Special Price</h2>
                            <h2>$11</h2>
                       
                           <div class="btn">
                            <button>Buy Now</button>
                            <button onclick="addCart()">Add to Cart</button>
                           </div>
                           <button  class="back">Back</button>



                    </div>
                    <div class="welcome-message">
        <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
        <a href="logout.php"><button>Logout</button></a>
    </div>  
                 </div>

                <!-- blogs -->
                <div class="trends">
                    <div class="head">
                        <h1>Future of  <span>Solarwala</span></h1>
                    </div>
                    <div class="card">
                        <div class="blog">
                            <img src="./q.jpg" alt="">
                            <div class="blogText">
                                <h2>Our Futurestic solar produc</h2>
                                <p>Optimizing Renewable Energy with Energy Storage</p>
                                 <a href="z.php">Read More</a>
                            </div>
                        </div>

                        <div class="blog">
                            <img src="./p.jpg" alt="">
                            <div class="blogText">
                                <h2>Newly launch product</h2>
                                <p>Bifacial Solar Panel Technology Harness More Sunlight 
                                </p>
                                <a href="z2.php">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Letter -->

                <div class="letter">
                    <div class="letterText">
                        <h1>Sign Up for NewsLetter</h1>
                        <p>Solarwala Technoficient Opc Pvt Ltd</p>
                    </div>
                    <div class="inp">
                        <!-- <input type="text" placeholder="Enter Email"> -->
                        <!-- <button>Sign Up</button> -->
                       
                        <a href="register.php"><button>Sign Up</button></a>
                    </div>
                </div>

                <!-- Footer -->

                

                </div>
            </div>
            <script src="Web.js"></script>
</body>

</html>
<?php
require("fottor.php")

?>