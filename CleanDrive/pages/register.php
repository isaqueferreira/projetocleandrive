<?php
session_start();

include '../includes/db.php';

function page_specific_css() {
    echo '<link rel="stylesheet" href="/assets/css/register.css">';
}

include 'includes/header.php';
?>
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $cpf_cnpj = $_POST['cpf_cnpj'];
    $telefone = $_POST['telefone'];

   
    if (isset($_POST['ageCheck']) && $_POST['ageCheck'] === 'on') {
        $ageCheck = 1; 
    } else {
        
        echo "Você deve confirmar que é maior de 18 anos para se cadastrar.";
        exit; 
    }

  
    $sql = 'INSERT INTO users (username, email, password, cpf_cnpj, telefone, maior_de_18) VALUES (?, ?, ?, ?, ?, ?)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username, $email, $password, $cpf_cnpj, $telefone, $ageCheck]);

  
    header('Location: login.php');
    exit;
}
?>

<?php include '../includes/header.php'; ?>
    
<div class="container">
    <div class="formulario">
        <h2>Cadastro</h2>
        <form method="post">
            <label>Nome de Usuário: <input type="text" name="username" placeholder="Digite seu nome de usuário" required></label>
            <label>Email: <input type="email" name="email" placeholder="Digite seu e-mail" required></label>
            <label>Senha: <input type="password" name="password" placeholder="Digite sua senha" required></label>
            <label for="cpf_cnpj">Cpf / Cnpj: <input type="text" id="cpf_cnpj" name="cpf_cnpj" maxlength="18" placeholder="Digite seu CPF ou CNPJ" oninput="formatCPF_CNPJ(this)" required></label>
            <label for="telefone">Número de telefone: <input type="tel" id="telefone "name="telefone" placeholder="Digite seu número de telefone" oninput="formatPhone(this)" required></label>
            <label for="ageCheck"><input type="checkbox" id="ageCheck" name="ageCheck" required> Eu sou maior de 18 anos.</label>
            <button class="botao-cadastro" type="submit">Cadastrar</button>
        </form>
    </div>    
</div>   
<?php include '../includes/footer.php'; ?>
<script>
    function formatCPF_CNPJ(field) {
    let value = field.value.replace(/\D/g, ''); 

    if (value.length <= 11) {
       
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
    } else {
      
        value = value.replace(/^(\d{2})(\d)/, '$1.$2');
        value = value.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
        value = value.replace(/\.(\d{3})(\d)/, '.$1/$2');
        value = value.replace(/(\d{4})(\d)/, '$1-$2');
    }

    field.value = value;
}

function formatPhone(field) {
    let value = field.value.replace(/\D/g, ''); 

  
    if (value.length > 10) {
        value = value.replace(/^(\d{2})(\d{5})(\d{4}).*/, '($1)$2-$3');
    } else if (value.length > 5) {
        value = value.replace(/^(\d{2})(\d{4})(\d{0,4}).*/, '($1)$2-$3');
    } else if (value.length > 2) {
        value = value.replace(/^(\d{2})(\d{0,5})/, '($1)$2');
    } else if (value.length > 0) {
        value = value.replace(/^(\d*)/, '($1');
    }

    field.value = value;
}

</script>
