<?php

include '../includes/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

function page_specific_css() {
    echo '<link rel="stylesheet" href="/assets/css/my_reservations.css">';
}

$sql = 'SELECT r.id, c.brand, c.model, r.pickup_location, r.pickup_date, r.return_location, r.return_date, r.total_price 
        FROM reservations r 
        JOIN cars c ON r.car_id = c.id 
        WHERE r.user_id = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['user_id']]);
$reservations = $stmt->fetchAll();
?>
<?php include '../includes/header.php'; ?>
     <h2>MINHAS RESERVAS</h2>
     <div class="container">  
         <div class="card-section">
            <?php if ($reservations): ?>
                <?php foreach ($reservations as $reservation): ?>
                <div class="card">
                    <h3><?= htmlspecialchars($reservation['brand']) ?> <?= htmlspecialchars($reservation['model']) ?></h3>
                    <p>Local de retirada: <?= htmlspecialchars($reservation['pickup_location']) ?></p>
                    <p>Data e hora de retirada: <?= htmlspecialchars($reservation['pickup_date']) ?></p>
                    <p>Local de devolução: <?= htmlspecialchars($reservation['return_location']) ?></p>
                    <p>Data e hora de devolução: <?= htmlspecialchars($reservation['return_date']) ?></p>
                    <p>Preço total: R$<?= htmlspecialchars($reservation['total_price']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>    
        <?php else: ?>
            <p>Nenhuma reserva encontrada.</p>
        <?php endif; ?>
    </div>
<?php include '../includes/footer.php'; ?>
