<?php
session_start();


function page_specific_css() {
    echo '<link rel="stylesheet" href="/assets/css/contact.css">';
}

include '../includes/header.php';

?>

<main class="container">
        <div class="formulario">  
            <h1>CONTATO</h1>
            <form id="formulario" class="form-contact" action="process_form.php" method="post" onsubmit="return validarFormulario()">
                <label>Nome:<input type="name" id="nome" name="nome" placeholder="Nome" required/></label>
                <label>E-mail<input type="email" id="email" name="email" placeholder="E-mail" required /></label>
                <label>Deixe sua Mensagem <textarea name="mensagem" id="mensagem" cols="35" rows="14" placeholder="Escreva sua mensagem aqui" required></textarea></label>
                <button type="submit">ENVIAR</button><br>
             <!--<h2>TELEFONES:</h2>
           <div class="number">
                <ul>
                    <li><h3><span>(31)98765-1234</span></h3></li>
                    <li><h3><span>(11)99765-4321</span></h3></li>
                </ul>
             </div>
-->
          </form>
        </div>
</main>

<?php include '../includes/footer.php'; ?>