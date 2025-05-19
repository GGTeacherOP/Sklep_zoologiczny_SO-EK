<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "zoopet";

$conn = mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) {
    die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
}

$error = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $role = $_POST["role"];

    if($role === "customer"){
        $query = "SELECT * FROM customers WHERE email = ?";
    }else if($role === "employee"){
        $query = "SELECT * FROM employees WHERE email = ?";
    }

    if(empty($error)) {
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result) === 1){
            $user = mysqli_fetch_assoc($result);

            if($password === $user["password_hash"]) {
                $_SESSION["user_id"] = $user["id"];
                $_SESSION["role"] = $role;
                $_SESSION["user_name"] = $user["name"];

                header("Location: home.php");
                exit();
            }else{
                $error = "Nieprawidłowe hasło.";
            }
        }else{
            $error = "Użytkownik nie istnieje.";
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <link rel="stylesheet" href="profile.css">
</head>
<body>
    <main>
        <section class="login-container">
            <h2>Logowanie</h2>

            <?php if (!empty($error)): ?>
                <span class="error-msg"><?= htmlspecialchars($error) ?></span>
            <?php endif; ?>

            <form action="" method="post">
                <label for="username">Email</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Hasło</label>
                <input type="password" id="password" name="password" required>

                <label for="role">Zaloguj się jako</label>
                <select id="role" name="role" required>
                    <option value="customer">Klient</option>
                    <option value="employee">Pracownik</option>
                </select>

                <button type="submit">Zaloguj się</button>
            </form>
        </section>
    </main>
</body>
</html>
