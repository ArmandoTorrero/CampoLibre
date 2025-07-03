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

            <article class="reservar button-reservation-disabled">
                <button disabled>Reservar ahora</button>
            </article>

            <article class="info-reserva">
                <p>No se te cobrará hasta completar la reserva</p>
            </article>
        </section>
        
        
    </section>
    
    <dialog>
        <h1>Detalles de la reserva</h1>
        <section class="info-reserva">

            <article class="nombre-campo">
                <span>Campo :</span>
                <span></span>
            </article>

            <article class="info-fecha">
                <span>Fecha: </span>
                <span></span>
            </article>

            <article class="info-hora">
                <span>Hora: </span>
                <span></span>
            </article>

        </section>
        <form action="#" method="dialog" >
            
            <section class="label-input">
                <label for="titular">Titular de la tarjeta</label>
                <input type="text" name="titular" id="titular" placeholder="Nombre">
                <span class="noVisible">Solo letras</span>
            </section>

            <section class="label-input">
                <label for="num-tarjeta">Número de la tarjeta</label>
                <input type="text" name="num-tarjeta" id="num-tarjeta" placeholder="1234567890123456">
                <span class="noVisible">Solo numeros</span>
            </section>

            <section class="expiracion-CVC">

                <section class="label-input">
                    <label for="expiracion">Fecha de expiración</label>
                    <input type="text" name="expiracion" id="expiracion" placeholder="MM/AA">
                    <span class="noVisible">La fecha no es correcta</span>
                </section>

                <section class="label-input">
                    <label for="cvc">CVC</label>
                    <input type="number" name="cvc" id="cvc" placeholder="123">
                    <span class="noVisible">Solo 3 numeros</span>
                </section>

            </section>

            <section class="buttons">
                <button type="button" class="cancelar-btn" >Cancelar</button>
                <button type="submit" disabled class="disabled confirm-pay">Confirmar pago</button>
            </section>
        </form>
    </dialog>

    <script type="module" src="./assets/js/views/reservarCampo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>

<?php 
    $content = ob_get_clean(); 
    require __DIR__ . '/../layouts/main.php';
?>