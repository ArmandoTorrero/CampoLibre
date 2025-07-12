<?php  
    ob_start(); 
?>
    <head>
        <link rel="stylesheet" href="./assets/css/perfil.css">
    </head>

    <main class="izquierda-derecha">

        
        <section class="izquierda">
            <h1 class="title" >Mi perfil</h1>

            <article class="perfil column-center">

                <div class="user-icon">
                    <i class="fa-solid fa-circle-user"></i>
                </div>

                <div class="user-info column-center">
                    <h1></h1>
                    <p></p>
                </div>

            </article>

            <article class="additional-info">

                <i class="fa-solid fa-check"></i>
                <span></span>

            </article>

            <article class="cerrar-sesion">
                <form action="#" method="post">
                    <button>Cerrar sesión</button>
                </form>
            </article>

        </section>

            
        <section class="derecha">

            <article class="sections">
                <button class="reservas">Mis reservas</button>
                <button class="ajustes">Ajustes de cuenta</button>
            </article>

            <article class="content"></article>

        </section>
    </main>

    <script type="module" src="./assets/js/views/perfil.js"></script>
<?php 
    $content = ob_get_clean(); 
    require __DIR__ . '/../layouts/main.php';
?>