<?php  
    ob_start(); 
?>
    <head>
        <link rel="stylesheet" href="./assets/css/landing.css">
    </head>

    <section class="hero">
        <h1>Reserva tu campo <br> <strong>deportivo</strong></h1>
        <p>Encuentra y reserva los mejores campos deportivos de forma fácil y rápida </p>
        <a href="#" target="_self">Ver campos disponibles</a>
    </section>

    <section class="caracteristicas column-center">

        <article class="titulo-parrafo column-center">
            <h1>¿Por qué elegirnos?</h1>
            <p>SportReserve te ofrece la forma más sencilla de reservar campos deportivos</p>
        </article>

        <section class="cards-container column-center">

            <article class="card column-center">
                <div class="icon column-center">
                    <i class="fa-solid fa-clock"></i>
                </div>
                <h1>Rápido y sencillo</h1>
                <p>Reserva tu campo en menos de 2 minutos. Sin complicaciones y sin esperas</p>
            </article>

            <article class="card column-center">
                <div class="icon column-center">
                    <i class="fa-brands fa-paypal"></i>
                </div>
                <h1>Pago seguro</h1>
                <p>Utilizamos los métodos de pago más seguros del mercado para proteger tu información.</p>
            </article>

            <article class="card column-center">
                <div class="icon column-center">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <h1>Garantía de calidad</h1>
                <p>Todos nuestros campos son revisados periódicamente para garantizar su calidad.</p>
            </article>

        </section>

    </section>

    <section class="campos-populares column-center">

        <article class="titulo-parrafo">
            <h1>Campos populares</h1>
            <p>Descubre los campos más reservados por nuestra comunidad</p>
        </article>

        <article class="campos column-center"></article>
        <a class="ver_campos" href="" target="_self">Ver todos los campos</a>
    </section>

    <section class="pree-footer column-center">
        <h1>¡Comienza a disfrutar del deporte hoy mismo!</h1>
        <p>Reserva tu primera instalación deportiva en minutos y descubre lo fácil que es con SportReserve</p>
        <article class="buttons">
            <a href="" target="_self">Iniciar sesión</a>
            <a href="" target="_self">Campos disponibles</a>
        </article>
    </section>

    <script type="module" src="./assets/js/views/landing.js"></script>
<?php 
    $content = ob_get_clean(); 
    require __DIR__ . '/../layouts/main.php';
?>