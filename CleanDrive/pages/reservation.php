<?php
include '../includes/db.php';
session_start();

function page_specific_css() {
    echo '<link rel="stylesheet" href="/assets/css/reservation.css">';
}

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$brand = $_GET['brand'] ?? '';
$model = $_GET['model'] ?? '';
$pickup_location = $_GET['pickup_location'] ?? '';
$pickup_date = $_GET['pickup_date'] ?? '';
$return_location = $_GET['return_location'] ?? '';
$return_date = $_GET['return_date'] ?? '';


function formatDateTime($datetime) {
    return date('d/m/Y H:i', strtotime($datetime));
}


$start = new DateTime($pickup_date);
$end = new DateTime($return_date);
$interval = $start->diff($end);
$days = $interval->days;

$sql = 'SELECT * FROM cars WHERE brand = ? AND model = ?'; 
$stmt = $pdo->prepare($sql);
$stmt->execute([$brand, $model]);
$car = $stmt->fetch();

$base_price = $car['price_per_day'];


$total_price = $base_price * $days;


$car_id = $car['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $options = $_POST['options'] ?? [];

 
    $hasInsurance = false;
    foreach ($options as $option) {
        if (in_array($option, ['150', '200'])) {
            $hasInsurance = true;
            break;
        }
    }

    if (!$hasInsurance) {
        echo '<script>alert("Você deve selecionar pelo menos uma opção de seguro.");</script>';
    } else {
        
        foreach ($options as $option) {
            $total_price += (float)$option; 
        }

        
        $user_id = $_SESSION['user_id'];
        $sql = 'INSERT INTO reservations (user_id, car_id, pickup_location, pickup_date, return_location, return_date, total_price) 
                VALUES (?, ?, ?, ?, ?, ?, ?)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user_id, $car_id, $pickup_location, $pickup_date, $return_location, $return_date, $total_price]);

      
        header('Location: confirm.php');
        exit;
    }
}
?>
<?php include '../includes/header.php'; ?>
    <h2>RESERVA</h2>
        <div class="container">
            <div class="details">
            <form class="formulario" method="post">
                <h2>Detalhes da Reserva</h2>
                <div class="information">
                    <h3>Informações do carro</h3>
                    <p>Marca: <?= htmlspecialchars($brand) ?></p>
                    <p>Modelo: <?= htmlspecialchars($model) ?></p>
                    <h3>Informações de Retirada</h3>
                    <p>Local de retirada: <?= htmlspecialchars($pickup_location) ?></p>
                    <p>Data de retirada: <?= htmlspecialchars(formatDateTime($pickup_date)) ?></p>
                    <h3>Informações de devolução</h3>
                    <p>Local de Devolução: <?= htmlspecialchars($return_location) ?></p>
                    <p>Data de devolução: <?= htmlspecialchars(formatDateTime($return_date)) ?></p>
                </div>

                <p>Quantidade de dias: <?= $days ?></p> 

                <h4>Escolha os Opcionais:</h4>
                <label><input type="checkbox" name="options[]" value="150" class="insurance-option" onclick="updateTotalPrice()"> Seguro Furto e Roubo (R$150)</label><br>
                <label><input type="checkbox" name="options[]" value="200" class="insurance-option" onclick="updateTotalPrice()"> Seguro Colisão e Danos a terceiros (R$200)</label><br>
                <label><input type="checkbox" name="options[]" value="80" onclick="updateTotalPrice()"> Cadeira de bebê (R$80)</label><br>
                <label><input type="checkbox" name="options[]" value="50" onclick="updateTotalPrice()"> Lavagem inclusa (R$50)</label><br>
                <p class="preco">Preço Total: R$<span id="totalPrice"><?= $total_price ?></span></p>
                <p id="insuranceWarning" style="color: red; display: none;">Você deve selecionar pelo menos uma opção de seguro.</p>
                <input type="hidden" id="totalPriceInput" name="total_price" value="<?= $total_price ?>">
                <input type="hidden" id="basePrice" value="<?= $base_price ?>">
                <input type="hidden" id="days" value="<?= $days ?>">
                <button class="botao-reservation" type="submit" name="confirm_reservation" id="confirmButton" disabled>Confirmar Reserva</button>
            </form>
            </div>
        </div>
    <script>
        function updateTotalPrice() {
            const basePrice = parseFloat(document.getElementById('basePrice').value);
            const days = parseInt(document.getElementById('days').value);
            let totalPrice = basePrice * days;

            let hasInsurance = false;
            document.querySelectorAll('input[name="options[]"]:checked').forEach(function (checkbox) {
                totalPrice += parseFloat(checkbox.value);
                if (checkbox.classList.contains('insurance-option')) {
                    hasInsurance = true;
                }
            });

            document.getElementById('totalPrice').innerText = totalPrice.toFixed(2);
            document.getElementById('totalPriceInput').value = totalPrice.toFixed(2);

            const confirmButton = document.getElementById('confirmButton');
            const insuranceWarning = document.getElementById('insuranceWarning');

            if (hasInsurance) {
                confirmButton.disabled = false;
                insuranceWarning.style.display = 'none';
            } else {
                confirmButton.disabled = true;
                insuranceWarning.style.display = 'block';
            }
        }

        
        document.addEventListener('DOMContentLoaded', function () {
            updateTotalPrice();
        });
    </script>
<?php include '../includes/footer.php'; ?>
