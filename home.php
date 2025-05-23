<?php
session_start();

if (isset($_GET["logout"]) && $_GET["logout"] === "true") {
    session_unset();
    session_destroy();
    header("Location: home.php");
    exit();
}

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "zoopet";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
}

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <title>Sklep zoologiczny</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="home.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@simondmc/popup-js@1.4.3/popup.min.js"></script>
    <script src="logout.js"></script>
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
                <a href="tray.php" class="nav-el"><i class="fas fa-shopping-cart"></i> Koszyk</a>
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
    <main>
        <section class="banner">
            <div class="banner-container">
                <img src="assets/dogs.jpg" class="banner-slide active" alt="Puppies">
                <img src="assets/cat.jpg" class="banner-slide" alt="Kitten">
                <img src="assets/bird.jpg" class="banner-slide" alt="Bird">
                <div class="banner-text"></div>
            </div>
        </section>

        <section class="category-wrapper">
            <h2 class="category-title">Dla kogo dokonujesz zakupu?</h2>

            <div class="scroll-container">
                <div class="categories scrollable">
                    <?php
                        $sql = "SELECT * FROM animal_types";
                        $result = mysqli_query($conn, $sql);

                        while($row = mysqli_fetch_assoc($result)){
                            echo "<a href=\"products.php?animal_type={$row['id']}\">";
                            echo "<div class=\"category\">";
                            echo "<img src=\"{$row['image_url']}\" alt=\"{$row['name']}\">";
                            echo "<span>{$row['name']}</span>";
                            echo "</div>";
                            echo "</a>";
                        }
                    ?>
        </section>
    </main>

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