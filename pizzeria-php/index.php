<?php
session_start();
require 'config/database.php'; // Hubungkan ke database

// Ambil data produk dari database
$result = $conn->query("SELECT * FROM products");
$products = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

// Inisialisasi keranjang jika belum ada
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
?>

<?php include 'src/templates/header.php'; ?>

<section class="home" id="home">
    <div class="home-text">
        <h1><span>Welcome</span> <br> to The Langit Pizza</h1>
        <p>Fresh, cheesy, and guaranteed to make you happy! Every bite is a perfect blend of rich flavors and premium ingredients. Whether you love classic flavors or something bold, we’ve got the perfect pizza for you. So, why wait? Choose your favorite now and enjoy every bite!</p>
        <a href="#menu" class="btn">Choose a Pizza</a>
    </div>
    <div class="home-img">
        <img src="public/img/home.png" alt="home">
    </div>
</section>

<section class="container">
    <div class="main-text">
        <h2>Topping</h2>
        <p>Only the Best for You</p>
    </div>

    <div class="container-box">
        <div class="c-mainbox">
            <div class="container-img">
                <img src="public/img/topping/t1.png" alt="Vegetable">
            </div>
            <div class="container-text"><p>Vegetable</p></div>
        </div>
        <div class="c-mainbox">
            <div class="container-img">
                <img src="public/img/topping/t2.png" alt="Seafood">
            </div>
            <div class="container-text"><p>Seafood</p></div>
        </div>
        <div class="c-mainbox">
            <div class="container-img">
                <img src="public/img/topping/t3.png" alt="Meat">
            </div>
            <div class="container-text"><p>Meat</p></div>
        </div>
        <div class="c-mainbox">
            <div class="container-img">
                <img src="public/img/topping/t4.png" alt="Cheese">
            </div>
            <div class="container-text"><p>Cheese</p></div>
        </div>
    </div>
</section>

<section class="about" id="about">
    <div class="about-img">
        <img src="public/img/a.png" alt="">
    </div>
    <div class="about-text">
        <h2>Experience an Unforgettable Taste Sensation!</h2>
        <p>We believe that pizza is not just food, but a work of art that brings happiness in every bite...</p>
        <a href="#menu" class="btn">Choose a Pizza</a>
    </div>
</section>

<section class="menu" id="menu">
    <div class="main-text">
        <h2>Most Popular Pizza</h2>
        <p>We have selected for You<br> the most exquisite tastes around the world</p>
    </div>

    <div class="menu-content">
        <?php foreach ($products as $product): ?>
        <div class="row" data-id="<?php echo $product['id']; ?>" data-name="<?php echo $product['name']; ?>" data-price="<?php echo $product['price']; ?>" data-img="<?php echo $product['img']; ?>" data-desc="<?php echo $product['desc']; ?>">
            <img src="<?php echo $product['img']; ?>" alt="<?php echo $product['name']; ?>">
            <div class="menu-text">
                <div class="menu-left">
                    <h4><?php echo $product['name']; ?></h4>
                </div>
                <div class="menu-right">
                    <h5>$<?php echo number_format($product['price'], 2); ?></h5>
                </div>
            </div>
            <p><?php echo $product['desc']; ?></p>
            <div class="star">
                <a href="#"><i class='bx bxs-star'></i></a>
                <a href="#"><i class='bx bxs-star'></i></a>
                <a href="#"><i class='bx bxs-star'></i></a>
                <a href="#"><i class='bx bxs-star'></i></a>
                <a href="#"><i class='bx bxs-star'></i></a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<section class="contact" id="contact">
    <div class="main-contact">
        <div class="contact-content">
            <h4>Services</h4>
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#menu">Menu</a></li>
            <li><a href="#contact">Contact</a></li>
        </div>

        <div class="contact-content">
            <h4>Delivery</h4>
            <li><a href="#">Uber Eats</a></li>
            <li><a href="#">DoorDash</a></li>
            <li><a href="#">ChowNow</a></li>
            <li><a href="#">Toast TakeOut</a></li>
        </div>

        <div class="contact-content">
            <h4>Contact</h4>
            <li><a href="#">Contact Us</a></li>
            <li><a href="#">Press Center</a></li>
            <li><a href="#">Careers</a></li>
            <li><a href="#">FAQ</a></li>
        </div>

        <div class="contact-content">
            <h4>Follow Us</h4>
            <li><a href="#">TikTok</a></li>
            <li><a href="#">Twitter</a></li>
            <li><a href="#">Facebook</a></li>
            <li><a href="#">Instagramm</a></li>
        </div>
    </div>
</section>

<?php include 'src/templates/sidebar.php'; ?>
