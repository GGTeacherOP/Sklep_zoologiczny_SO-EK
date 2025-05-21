<?php
session_start();

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'zoopet';

$conn = mysqli_connect($host, $user, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$animal_type_id = $_GET['animal_type'];
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Przeglądaj produkty</title>
    <link rel="stylesheet" href="products.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@simondmc/popup-js@1.4.3/popup.min.js"></script>
</head>
<body>
    <header class="header">
        <div class="header-container">
            <div class="logo">
                <img src="https://cdn-icons-png.flaticon.com/128/616/616408.png" alt="ZOOPET Logo">
                <span>ZOOPET</span>
            </div>
            <div class="search-bar">
                <input type="text" placeholder="Szukaj produktów..." >
                <button><i class="fas fa-search"></i></button>
            </div>
            <nav class="nav">
                <a href="#" class="nav-el"><i class="fas fa-map-marker-alt"></i> Sklepy</a>
                <a href="#" class="nav-el"><i class="fas fa-shopping-cart"></i> Koszyk</a>
                <?php if(isset($_SESSION["user_id"])): ?>
                    <?php if($_SESSION["role"] === "employee"): ?>
                        <a href="employee_panel.php" class="nav-el"><i class="fas fa-briefcase"></i> Panel pracownika</a>
                    <?php endif; ?>
                    <span class="nav-el logout-btn" title="Wyloguj"><i class="fas fa-user"></i> Witaj, <?= htmlspecialchars($_SESSION["user_name"]) ?>!</span>
                <?php else: ?>
                    <a href="profile.php" class="nav-el"><i class="fas fa-user"></i> Moje konto</a>
                <?php endif; ?>
            </nav>
            <div class="bars">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </header>
    <h1>Produkty w sklepie zoologicznym</h1>
    <div class="product-container">
        <?php
        $sql = "SELECT * FROM products WHERE animal_type_id = $animal_type_id";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="product-card">';
                echo '<div class="brand-badge">Tylko u nas</div>';
                echo '<img src="' . htmlspecialchars($row["image_url"]) . '" alt="' . htmlspecialchars($row["product_name"]) . '">';
                echo '<div class="product-name">' . htmlspecialchars($row["product_name"]) . '</div>';
                echo '<div class="product-price">' . htmlspecialchars($row["price"]) . ' zł</div>';
                echo '<div class="per-kg">(' . number_format($row["price"], 2) . ' zł/kg)</div>';
                echo '<br><button class="cart-button">🛒</button>';
                echo '</div>';
            }
        } else {
            echo "<p>No products found.</p>";
        }
        mysqli_close($conn);
        ?>
    </div>
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-info">
                <h2>🐾 Zoopet - Wszystko dla Twoich pupili!</h2>
                <p><strong>Adres:</strong> ul. Zwierzakowa 12, 00-123 Warszawa</p>
                <p><strong>Telefon:</strong> <a href="tel:+48123456789">+48 123 456 789</a></p>
                <p><strong>E-mail:</strong> <a href="mailto:zoopet@example.com">zoopet@example.com</a></p>
                <p><strong>Strona:</strong> <a href="home.html">www.zoopet.pl</a></p>
            </div>

            <div class="footer-social">
                <h3>Znajdź nas:</h3>
                <a href="https://www.facebook.com/" target="_blank">Facebook</a>
                <a href="https://www.instagram.com" target="_blank">Instagram</a>
                <a href="https://www.tiktok.com" target="_blank">TikTok</a>
            </div>

            <div class="footer-bonus">
                <p>💚 Darmowa dostawa od 199 zł</p>
                <p>🚚 Szybka wysyłka w 24h</p>
                <p>🐶 Z miłości do zwierząt – od 2010 roku</p>
            </div>
        </div>
    </footer>
</body>
</html>