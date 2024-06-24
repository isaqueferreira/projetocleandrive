<?php
session_start();

function page_specific_css() {
    echo '<link rel="stylesheet" href="/assets/css/index.css">';
}

include 'includes/header.php';
?>
<html>
    <h2 class="titulo">SEU PRIMEIRO CARRO ELÉTRICO</h2>
    <div class="slider">
        <div class="slides">
            <input type="radio" name="radio-btn" id="radio1">
            <input type="radio" name="radio-btn" id="radio2">
            <input type="radio" name="radio-btn" id="radio3">
            <input type="radio" name="radio-btn" id="radio4">

            <div class="slide first">
                <img src="/assets/images/slide01.jpg" alt="Imagem 1" />
            </div>
            <div class="slide">
                <img src="/assets/images/slide02.jpg" alt="Imagem 2" />
            </div>
            <div class="slide">
                <img src="/assets/images/slide03.jpg" alt="Imagem 3" />
            </div>
            <div class="slide">
                <img src="/assets/images/slide04.jpg" alt="Imagem 4" />
            </div>
            
            <div class="navigation-auto">
                <div class="auto-btn1"></div>
                <div class="auto-btn2"></div>
                <div class="auto-btn3"></div>
                <div class="auto-btn4"></div>
            </div>
          
        </div>
        <div class="manual-navigation">
          <label for="radio1" class="manual-btn"></label>
          <label for="radio2" class="manual-btn"></label> 
          <label for="radio3" class="manual-btn"></label> 
          <label for="radio4" class="manual-btn"></label>   
        </div>

    </div>

    <div class="card-container">
        <div class="card">
        <img src="/assets/images/carro02.jpg">
        <div>
            <h1>Carro Elétrico</h1>
            <h2>0km</h2>
            <a href="..\pages\login.php"><button>Alugar</button></a>
        </div>
        </div>

        <div class="card">
        <img src="/assets/images/carro01.jpg">
        <div>
            <h1>Carro Elétrico</h1>
            <h2>0km</h2>
            <a href="..\pages\login.php"><button>Alugar</button></a>
        </div>
        </div>

        <div class="card">
        <img src="/assets/images/carro03.jpg">
        <div>
            <h1>Carro Elétrico</h1>
            <h2>0km</h2>
            <a href="..\pages\login.php"><button>Alugar</button></a>
        </div>
        </div>
    </div>

</body>
</html>
<?php include 'includes/footer.php'; ?>
