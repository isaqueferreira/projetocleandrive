<?php
session_start();


function page_specific_css() {
    echo '<link rel="stylesheet" href="/assets/css/questions.css">';
}

include '../includes/header.php';

?>

<main>
        <!--seção faq-->
        <section class="faq">
            <h1>F.A.Q.</h1>
            <article class="faq-item">
                <h3 class="faq-question">1.Quais são as vantagens de alugar um carro elétrico em comparação com um
                    veículo a combustão?</h3>
                <div class="faq-answer"><i>As vantagens de alugar um carro elétrico incluem menor impacto ambiental devido
                        à emissão zero de
                        poluentes durante a condução, custos operacionais mais baixos devido ao menor custo de
                        eletricidade em
                        comparação com combustíveis fósseis, além de uma experiência de condução mais silenciosa e
                        suave.</i></div>
            </article>
            <article class="faq-item">
                <h3 class="faq-question">2.Como funciona o processo de recarga do carro elétrico durante o período de
                    locação?</h3>
                <div class="faq-answer"><i>Durante o período de locação, você pode recarregar o carro elétrico em estações
                        de recarga designadas.
                        Algumas locadoras podem fornecer cartões de recarga ou aplicativos para facilitar o processo de
                        pagamento e localização das estações de recarga próximas.</i></div>
            </article>
            <article class="faq-item">
                <h3 class="faq-question">3.Os carros elétricos têm autonomia suficiente para viagens longas?</h3>
                <div class="faq-answer"><i>A autonomia dos carros elétricos varia de acordo com o modelo e as condições de
                        condução, mas muitos
                        modelos modernos oferecem autonomia suficiente para viagens longas. Antes de planejar uma viagem
                        longa,
                        é recomendável verificar a autonomia do veículo e planejar paradas para recarga, se
                        necessário.</i>
                </div>
            </article>
            <article class="faq-item">
                <h3 class="faq-question">4.Quais são as opções de pagamento disponíveis para alugar um carro elétrico?
                </h3>
                <div class="faq-answer"><i>As opções de pagamento geralmente incluem cartão de crédito/débito, pagamento
                        online ou pagamento no
                        momento da retirada do veículo. Algumas locadoras também podem oferecer descontos ou pacotes
                        especiais
                        para locações de longo prazo.</i></div>
            </article>
            <article class="faq-item">
                <h3 class="faq-question">5.Existe alguma restrição de idade para alugar um carro elétrico?</h3>
                <div class="faq-answer"><i>As restrições de idade podem variar de acordo com a política da locadora, mas
                        geralmente é necessário
                        ter
                        21 anos ou mais para alugar um carro elétrico. Algumas locadoras podem impor restrições
                        adicionais
                        para
                        condutores mais jovens, como taxas adicionais de seguro.</i></div>
            </article>
            <article class="faq-item">
                <h3 class="faq-question">6.É necessário possuir carteira de motorista para alugar um carro elétrico?
                </h3>
                <div class="faq-answer"><i>Sim, é necessário possuir uma carteira de motorista válida e em dia para alugar
                        um carro elétrico,
                        assim como para alugar qualquer outro veículo.</i></div>
            </article>
            <article class="faq-item">
                <h3 class="faq-question">7.Os carros elétricos estão sujeitos a taxas de congestionamento ou restrições
                    de circulação em áreas
                    urbanas?</h3>
                <div class="faq-answer"><i>As políticas de taxas de congestionamento e restrições de circulação podem
                        variar de acordo com a
                        cidade ou região. Recomendamos verificar as regulamentações locais antes de conduzir o carro
                        elétrico em áreas urbanas.</i></div>
            </article>
            <article class="faq-item">
                <h3 class="faq-question">8.Quais são as medidas de segurança em vigor para proteger tanto o veículo
                    quanto o condutor durante a
                    locação?</h3>
                <p class="faq-answer"><i>As locadoras geralmente oferecem seguro de responsabilidade civil e seguro
                        contra danos ao veículo
                        como parte do pacote de locação. Além disso, é importante seguir todas as leis de trânsito e
                        práticas seguras de condução durante o período de locação.
                    </i></p>
            </article>
            <article class="faq-item">
                <h3 class="faq-question">9.O que devo fazer em caso de emergência, como falha na bateria ou acidente?
                </h3>
                <p class="faq-answer"><i>Em caso de emergência, como falha na bateria ou acidente, entre em contato
                        imediatamente com a
                        locadora para receber assistência. Fornecemos orientações sobre como proceder e
                        organizar
                        serviços de reboque, se necessário.</i></p>
            </article>
            <article class="faq-item">
                <h3 class="faq-question">10.Há alguma taxa adicional para recarregar o veículo antes de devolvê-lo?</h3>
                <p class="faq-answer"><i>Cobramos uma taxa adicional se o veículo for devolvido
                        com a bateria
                        descarregada ou abaixo de um determinado nível de carga. Recomendamos devolver o veículo com a
                        carga
                        mínima especificada nas instruções da locadora para evitar taxas adicionais.</i></p>
            </article>
        </section>

    </main>
    <?php include '../includes/footer.php'; ?>

    <script>
        document.querySelectorAll('.faq-question').forEach(function (question) {
    question.addEventListener('click', function () {
        
        var answer = question.nextElementSibling;
        
        if (answer.style.display === 'block') {
            answer.style.display = 'none';
        } else {
            answer.style.display = 'block';
        }
    });
});
</script>
