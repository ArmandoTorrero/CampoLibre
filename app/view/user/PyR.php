<?php  
    ob_start(); 
?>
    <head>
        <link rel="stylesheet" href="./assets/css/PyR.css">
    </head>
    <main>
        
        <div class="accordion" id="accordionExample">

            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    1. ¿Cómo puedo reservar una pista deportiva?
                </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        Puedes reservar pistas directamente desde nuestra plataforma online. Solo necesitas registrarte, seleccionar la instalación deportiva, elegir fecha y hora disponible, y completar el pago.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    2. ¿Cuál es el horario de apertura de las instalaciones?
                </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        Nuestras instalaciones están abiertas de lunes a sabado de 16:00 a 22:00 horas. Los horarios pueden variar en días festivos, por lo que te recomendamos consultar previamente las fechas.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    3. ¿Qué métodos de pago aceptan?
                </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        Aceptamos tarjetas de crédito/débito (Visa, MasterCard), transferencias bancarias, Bizum y PayPal.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    4. ¿Puedo cancelar una reserva?
                </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                    Sí, puedes cancelar tu reserva con al menos 24 horas de antelación a través de tu perfil en la seccion de 'reservas'. 
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    5. ¿Qué debo hacer si llego tarde a mi reserva?
                </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        Si llegas con más de 15 minutos de retraso, tu reserva podría ser cancelada sin reembolso. En caso de retraso, por favor contáctanos inmediatamente al número de soporte para que podamos ayudarte.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                    6. ¿Ofrecen alquiler de equipamiento deportivo?
                </button>
                </h2>
                <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        Sí, en nuestras instalaciones puedes alquilar todo el equipamiento necesario (raquetas, pelotas, redes, etc.) por un costo adicional. Puedes reservarlo al mismo tiempo que haces tu reserva de pista.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                    7. ¿Cuanto tiempo hay para realizar la actividad deportiva?
                </button>
                </h2>
                <div id="collapseSeven" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        El tiempo justo es de 1 hora, una vez finalizado ese tiempo, en caso de que la siguiente hora este libre los jugadores podran hablar con el delegado de la pista para poder alargar el tiempo de juego, pagando la cuota correspondiente, pero si no hay disponibilidad no se podra alargar el tiempo.
                    </div>
                </div>
            </div>
            
        </div>

    </main>
<?php 
    $content = ob_get_clean(); 
    require __DIR__ . '/../layouts/main.php';
?>