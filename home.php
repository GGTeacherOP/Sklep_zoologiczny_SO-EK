<?php
session_start();
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
            <nav class="nav-icons">
                <a href="#"><i class="fas fa-map-marker-alt"></i> Sklepy</a>
                <a href="#"><i class="fas fa-shopping-cart"></i> Koszyk</a>
                <?php if(isset($_SESSION["user_id"])): ?>
                    <a href="profile.php"><i class="fas fa-user"></i> Witaj, <?= htmlspecialchars($_SESSION["user_name"]) ?>!</a>
                    <?php if($_SESSION["role"] === "employee"): ?>
                        <a href="employee_panel.php"><i class="fas fa-briefcase"></i> Panel pracownika</a>
                    <?php endif; ?>
                <?php else: ?>
                    <a href="profile.php"><i class="fas fa-user"></i> Moje konto</a>
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
                    <div class="category">
                        <img src="https://cdn-icons-png.flaticon.com/128/616/616408.png" alt="Pies" />
                        <span>Pies</span>
                    </div>
                    <div class="category">
                        <img src="https://cdn-icons-png.flaticon.com/128/616/616430.png" alt="Kot" />
                        <span>Kot</span>
                    </div>
                    <div class="category">
                        <img src="https://cdn-icons-png.flaticon.com/128/1998/1998610.png" alt="Małe zwierzęta" />
                        <span>Małe zwierzęta</span>
                    </div>
                    <div class="category">
                        <img src="https://cdn-icons-png.flaticon.com/128/3069/3069172.png" alt="Ptaki" />
                        <span>Ptaki</span>
                    </div>
                    <div class="category">
                        <img src="https://cdn-icons-png.flaticon.com/128/2908/2908377.png" alt="Akwarystyka" />
                        <span>Akwarystyka</span>
                    </div>
                    <div class="category">
                        <img src="https://cdn-icons-png.flaticon.com/128/2204/2204346.png" alt="Terrarystyka" />
                        <span>Terrarystyka</span>
                    </div>
                </div>
            </div>
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