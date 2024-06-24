<?php
include '../includes/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
include '../includes/header.php'; 

function page_specific_css() {
    echo '<link rel="stylesheet" href="/assets/css/fleet.css">';
}


$validTypes = ['hatch', 'sedan', 'premium'];
$type = $_GET['type'] ?? '';
if (!in_array($type, $validTypes)) {
    $type = ''; 
}


$sql = 'SELECT * FROM cars';
if ($type) {
    $sql .= ' WHERE type = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$type]);
} else {
    $stmt = $pdo->query($sql);
}


if ($stmt === false) {
    var_dump($pdo->errorInfo());
    exit; 
}

$cars = $stmt->fetchAll();
?>

<div class="container">
    <h2>NOSSA FROTA</h2>
    <div class="form-group">
        <form method="get" action="">
            <label>Tipo: 
                <select name="type">
                    <option value="">Todos</option>
                    <option value="hatch" <?= $type === 'hatch' ? 'selected' : '' ?>>Hatch</option>
                    <option value="sedan" <?= $type === 'sedan' ? 'selected' : '' ?>>Sedan</option>
                    <option value="premium" <?= $type === 'premium' ? 'selected' : '' ?>>Premium</option><br>
                </select>
            </label>
            <label>Local de retirada: <br><input type="text" name="pickup_location" required></label>
            <label>Data: <br><input type="datetime-local" name="pickup_date" required></label>
            <label>Local de devolução:<br><input type="text" name="return_location" required></label>
            <label>Data:<br><input type="datetime-local" name="return_date" required></label>
            <button type="submit">Buscar</button>
        </form>
    </div> 
    <div class="card-section"> 
         <?php foreach ($cars as $car): ?>
            <div class="card">
                <h3><?= $car['brand'] ?> <?= $car['model'] ?></h3>
                <div class="card-img">
                    <img class="main-img" src="/assets/images/<?= $car['image'] ?>" alt="<?= $car['model'] ?>">
                </div>    
                <div class="card-icons">
                    <div class="icons">
                        <img src="/assets/images/user-solid.svg" alt="passageiros">
                        <p><?= $car['passengers'] ?></p>
                        <img src="/assets/images/suitcase-solid.svg" alt="malas">
                        <p><?= $car['luggage'] ?></p>
                        <img src="/assets/images/plug-solid.svg" alt="autonomia">
                        <p><?= $car['autonomy'] ?></p>
                    </div>    
                </div>  
                <div class="preco">
                    <p>R$<?= $car['price_per_day'] ?></p>
                </div>
                <div class="reserve">
                    <a href="reservation.php?brand=<?= urlencode($car['brand']) ?>&model=<?= urlencode($car['model']) ?>&pickup_location=<?= urlencode($_GET['pickup_location']) ?>&pickup_date=<?= urlencode($_GET['pickup_date']) ?>&return_location=<?= urlencode($_GET['return_location']) ?>&return_date=<?= urlencode($_GET['return_date']) ?>">Reserve</a>
                </div>
            </div>     
        <?php endforeach; ?>  
    </div>    
</div>     

<?php include '../includes/footer.php'; ?>
