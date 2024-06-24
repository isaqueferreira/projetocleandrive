<?php
session_start();
include 'db.php';

$user = null;
if (isset($_SESSION['user_id'])) {
    $sql = 'SELECT username FROM users WHERE id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Clean Drive </title>
    <meta name="keywords" content="aluguel, carros, carros elétricos">
    <meta name="description" content="CleanDrive - Site">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="/assets/images/shortcuticon.png">
    <link rel="stylesheet" href="../assets/css/style.css">
    <?php
        if (function_exists('page_specific_css')) {
        page_specific_css();
        }
    ?>
</head>
<body>
    <header>
        <div class="cabecalho">
            <a href="../index.php"><img class="logo" src="/assets/images/logo.png" alt="logoCleanDrive"></a>
            <nav class="navbar">
                <ul class="navlist">
                    <li class="navitens"><a href="../pages/fleet.php">FROTA</a></li>
                    <li class="navitens"><a href="../pages/contact.php">CONTATO</a></li>
                    <li class="navitens"><a href="../pages/questions.php">AJUDA</a></li>
                    <li class="navitens"><a href="#">|</a></li>
                    <?php if ($user): ?>
                        <li class="navitens"><a href="../pages/my_reservations.php">MINHAS RESERVAS</a></li>
                        <li class="navitens"><a href="../pages/logout.php">OLÁ, <?= strtoupper (htmlspecialchars($user['username'])) ?> !</a></li>
                    <?php else: ?>
                        <li class="navitens"><a href="../pages/register.php">CADASTRE-SE</a></li>
                        <li class="navitens"><a href="../pages/login.php">LOGIN</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>
    <div class="container">
  