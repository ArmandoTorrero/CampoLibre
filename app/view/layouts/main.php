<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

        <!--LINK CSS -->
        <link rel="stylesheet" href="./assets/css/main.css">
        <title>CampoLibre</title>
        
    </head>
    <body>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="/CampoLibre/public/">SportReserve</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/CampoLibre/public/campos">Campos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Preguntas frecuentes</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Acciones
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/CampoLibre/public/login">Iniciar sesión</a></li>
                                <li><a class="dropdown-item" href="/CampoLibre/public/registro">Registrate</a></li>
                                
                            </ul>
                        </li>
                    </ul>
                
                </div>
            </div>
        </nav>
        <main>
            <?php echo $content ?>

        </main>
        <footer>
            <section class="links">

                <section class="section-1">
                    <h1>CampoLibre</h1>
                    <p>Reserva campos deportivos de forma fácil y rapida. Encuentra tu deporte favorito en un solo lugar </p>
                </section>
                <section class="section-2">
                    <h1>Enlaces útiles</h1>
                    <ul>
                        <li><a href="#" target="_self">Inicio</a></li>
                        <li><a href="#" target="_self">Campos</a></li>
                        <li><a href="#" target="_self">Preguntas frecuentes</a></li>
                        <li><a href="#" target="_self">Términos y condiciones</a></li>
                    </ul>
                </section>
                <section class="section-3">
                    <h1>Contacto</h1>
                    <ul>
                        <li>Calle principal 123</li>
                        <li>51002 Ceuta</li>
                        <li>campoLibre@gmail.com</li>
                        <li>+34 600 000 000</li>
                    </ul>
                </section>

            </section>

            <hr>

            <section class="derechos-RRSS">
                
                <article class="derechos">
                    <p>&copy 2025 CampoLibre. Todos los derechos reservados.</p>
                </article>

                <article class="RRSS">
                    <a href=""><i class="fa-brands fa-facebook"></i></a>
                    <a href=""><i class="fa-brands fa-instagram"></i></a>
                    <a href=""><i class="fa-brands fa-twitter"></i></a>
                </article>

            </section>

        </footer>
    </body>
    <script type="module" src="./assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/bee72e8c16.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    
</html>