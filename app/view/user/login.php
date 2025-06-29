<?php  
    ob_start(); 
?>
    <head>
        <link rel="stylesheet" href="./assets/css/login.css">
    </head>

    <section class="container">
        <article class="titulo-parrafo column-center">
            <h2>Iniciar sesión</h2>
            <p>Bienvenido de nuevo. Ingresa tus credenciales para acceder a tu cuenta.</p>
        </article>
        <form action="#" method="post">

            <article class="label-input">

                <label for="email">Correo electrónico</label>
                <input type="email" name="email" id="email" placeholder="correo@ejemplo.com" required>
                <span class="noVisible">El formato no es correcto</span>

            </article>

            <article class="label-input">

                <label for="passwd">Contraseña</label>
                <input type="password" name="passwd" id="passwd" placeholder="Contraseña" required>
                <span class="noVisible">El formato no es correcto</span>

            </article>
            <button type="submit" class="enviar disabled">Iniciar sesión</button>

        </form>

        <article class="recordarme">
            <input type="checkbox" name="recordarme" id="recordarme">
            <label for="recordarme">Recordarme</label>
            
        </article>

        <a href="/CampoLibre/public/registro" target="_self" class="registrate">¿No tienes una cuenta? <strong>Crea una aqui</strong></a>
        <article class="buttons">
            <a href="#" target="_self"><i class="fa-brands fa-google"></i> Google</a>
            <a href="#" target="_self"><i class="fa-brands fa-facebook"></i> Facebook</a>
        </article>
    </section>

    <script type="module" src="./assets/js/views/login.js"></script>
<?php 
    $content = ob_get_clean(); 
    require __DIR__ . '/../layouts/main.php';
?>