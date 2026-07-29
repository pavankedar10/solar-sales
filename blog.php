<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solar Sales Blog</title>
    <link rel="stylesheet" href="blog.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script defer src="script.js"></script>
</head>
<?php
require('cheader.php')
?>
<div class="container">
    <!-- <nav>
        <div class="logo"> -->
            <!-- <img src="logo.png.png" alt="error showing image"> -->
            <!-- <h1>Solarwala </h1>

        </div> -->
        <!-- <button>click here</button> -->
        <!-- <ul>
            <li>
                <a href="web.php" id="home">Home</a>
                <a href=" product.php" id="shop">Shops</a>
                <a href="blog.php" id="blog">Blog</a>
                <a class="about.php" onclick="abouts()">About</a>
                <a id="contact" onclick="contacts()">Contact</a>
                <a href="product.php"><i class="fa-sharp fa-solid fa-cart-shopping"></i></a> -->
                <!-- <i class="fa-sharp fa-solid fa-cart-shopping"></i> -->
<!-- 
            </li>
        </ul>
    </nav> -->

    <main>
        <section class="hero">
            <h1>Welcome to Our Blog</h1>
            <p>Your go-to resource for solar energy tips, trends, and news.</p>
        </section>

        <section class="blog-list">
            <article class="blog-post">
                <img src="solar tips.jpg" alt="Solar Tips">
                <h2><a href="https://www.youtube.com/watch?v=RS6-yyJ_Bmc" target="_blank">Top 10 Tips for Maximizing
                        Your Solar Panel
                        Efficiency</a></h2>
                <p>Find simple ways to ensure your solar panels generate the most energy as much as possible</p>
                <a href="https://www.youtube.com/watch?v=RS6-yyJ_Bmc" target="_blank"> <button class="read-more">Learn
                        More</button></a>
            </article>

            <article class="blog-post">
                <img src="solar trends.jpg" alt="Solar News">
                <h2><a href="https://www.youtube.com/watch?v=trbNhUhgqvAl" target="_blank">Latest Solar Industry Trends
                        in 2025</a></h2>
                <p>Learn innovations and changes shaping the future of solar energy.</p>
                <a href="https://www.youtube.com/watch?v=trbNhUhgqvAl" target="_blank"> <button class="read-more">Learn
                        More</button></a>
                <!-- <a href="https://www.youtube.com/watch?v=trbNhUhgqvAl">Learn More</a> -->
            </article>

            <article class="blog-post">
                <img src="solar installation.jpeg" alt="Solar Installation">
                <h2><a href="https://www.youtube.com/watch?v=khYZTmm7S5I" target="_blank">Solar Panel Installation: What
                        You Need to
                        Know</a></h2>
                <p>A guide for homeowners considering installing solar panels themselves.</p>
                <a href="https://www.youtube.com/watch?v=khYZTmm7S5I" target="_blank"> <button class="read-more">Learn
                        More</button></a>
                <!-- <a href="https://www.youtube.com/watch?v=trbNhUhgqvAl">Learn More</a> -->
            </article>
        </section>


        <footer>
            <div class="footer-content">
                <p>&copy; 2025 SolarPowerPro. All Rights Reserved.</p>
                <ul class="social-links">
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Twitter</a></li>
                    <li><a href="#">LinkedIn</a></li>
                    <li><a href="#">Instagram</a></li>
                </ul>
            </div>
        </footer>

        <script>
            // Add interactivity for the mobile menu toggle
            const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
            const navLinks = document.querySelector('.nav-links');

            mobileMenuToggle.addEventListener('click', () => {
                navLinks.classList.toggle('active');
            });

            // Search functionality
            const searchBar = document.getElementById('search-bar');
            searchBar.addEventListener('input', () => {
                const query = searchBar.value.toLowerCase();
                const blogPosts = document.querySelectorAll('.blog-post');

                blogPosts.forEach(post => {
                    const title = post.querySelector('h2').textContent.toLowerCase();
                    const description = post.querySelector('p').textContent.toLowerCase();

                    if (title.includes(query) || description.includes(query)) {
                        post.style.display = '';
                    } else {
                        post.style.display = 'none';
                    }
                });
            });
        </script>
        </body>

</html>