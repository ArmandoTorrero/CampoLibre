<?php  
    ob_start(); 
?>
    <head>
        <link rel="stylesheet" href="./assets/css/reservarCampo.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    </head>

    <section class="imgs-fechas">

        <section class="imgs bg-img"></section>

        <section class="info-fechas">

            <article class="titulo-precio">

                <h1 class="titulo"></h1>
                <p class="precio"></p>

            </article>

            <article class="categoria">
                <p></p>
            </article>

            <article class="fecha">
                <h1>Selecciona una fecha</h1>
                <input type="text" name="fecha" id="fecha" placeholder="Selecciona una fecha">
            </article>

            <article class="horarios">

                <button class="horario" value="16:00">16:00 - 17:00</button>
                <button class="horario" value="17:00">17:00 - 18:00</button>
                <button class="horario" value="18:00">18:00 - 19:00</button>
                <button class="horario" value="19:00">19:00 - 20:00</button>
                <button class="horario" value="20:00">20:00 - 21:00</button>
                <button class="horario" value="21:00">21:00 - 22:00</button>

            </article>

            <article class="reservar">
                <button>Reservar ahora</button>
            </article>

            <article class="info-reserva">
                <p>No se te cobrará hasta completar la reserva</p>
            </article>
        </section>


    </section>

    <script type="module" src="./assets/js/views/reservarCampo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<?php 
    $content = ob_get_clean(); 
    require __DIR__ . '/../layouts/main.php';
?>