<?php
include '../includes/db.php';
session_start();

function page_specific_css() {
    echo '<link rel="stylesheet" href="../assets/css/login.css">';
}

include '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = 'SELECT * FROM users WHERE email = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: fleet.php');
    } else {
        $error = 'Invalid login credentials';
    }
}
?>
<html>
    <div class="container">
        <?php if (isset($error)): ?>
            <p><?= $error ?></p>
        <?php endif; ?>
        <div class="formulario">
            <h2>Login</h2>
            <form method="post">
                <label>Email: <br><input type="email" name="email" placeholder="Digite seu e-mail" required></label><br>
                <label>Senha: <br><input type="password" name="password" placeholder="Digite sua senha" required></label><br>
                <button class="botao-login"type="submit">Login</button>
                <p>Não tem conta? <a href="..\pages\register.php">Cadastre-se</a></p>
            </form>
        </div>   
    </div>  
</html>     
<?php include '../includes/footer.php'; ?>
