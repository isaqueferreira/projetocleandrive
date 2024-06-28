<?php
$host = 'eletricrental.mysql.database.azure.com';
$db = 'car-rental';
$user = 'eletricrental';
$pass = '@ISAQUELUIZADOUGLAScleandrive';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
