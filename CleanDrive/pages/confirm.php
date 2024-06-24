<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

function page_specific_css() {
    echo '<link rel="stylesheet" href="../assets/css/confirm.css">';
}

?>
<?php include '../includes/header.php'; ?>
 <div class="container"> 
    <h2>RESERVA CONFIRMADA</h2>
    <p>Sua reserva foi feita com sucesso !</p>
</div>    
<?php include '../includes/footer.php'; ?>
