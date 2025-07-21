<?php  
    ob_start(); 
?>
    <head>
        <link rel="stylesheet" href="./assets/css/login.css">
    </head>

    <section class="container">
        
        <article class="titulo-parrafo column-center">
            <h2>Crear cuenta</h2>
            <p>Regístrate para empezar a reservar campos deportivos.</p>
        </article>

        <form action="#" method="post">

            <article class="label-input">

                <label for="nombre">Nombre de usuario</label>
                <input type="text" name="nombre" id="nombre" placeholder="Tu nombre" required>
                <span class="noVisible">El nombre debe contener entre 3 y 15 caracteres</span>

            </article>

            <article class="label-input">

                <label for="email">Correo electrónico</label>
                <input type="email" name="email" id="email" placeholder="correo@ejemplo.com" required>
                <span class="noVisible">El formato no es correcto</span>

            </article>

            <article class="label-input">

                <label for="passwd">Contraseña</label>
                <input type="password" name="passwd" id="passwd" placeholder="Contraseña" required>
                <span class="noVisible">La contraseña debe tener al menos 5 caracteres</span>

                <div class="mostrar-passwd">
                    <input type="checkbox" name="mostrar" id="mostrar">
                    <label for="mostrar">Mostrar contraseña</label>
                </div>

            </article>

            <article class="label-input">

                <label for="tlf">Telefono</label>
                <input type="text" name="tlf" id="tlf" placeholder="Nº telefono" required>
                <span class="noVisible">El teléfono debe tener 9 caracteres</span>
                
            </article>

            <button type="submit" class="enviar disabled">Iniciar sesión</button>

            <article class="recordarme">
                <input type="checkbox" name="terminos-condiciones" id="terminos-condiciones">
                <label for="terminos-condiciones">Acepto los terminos y condiciones</label>
            </article>

            <input type="hidden" name="csrf_token" value="<?= $_SESSION['register_csrf_token'] ?>">

        </form>


        <a href="/CampoLibre/public/login" target="_self" class="registrate">¿Ya tienes una cuenta? <strong>Inicia sesión</strong></a>
        <article class="buttons">
            <a href="#" target="_self"><i class="fa-brands fa-google"></i> Google</a>
            <a href="#" target="_self"><i class="fa-brands fa-facebook"></i> Facebook</a>
        </article>
    </section>

    <script type="module" src="./assets/js/views/registro.js"></script>
<?php 
    $content = ob_get_clean(); 
    require __DIR__ . '/../layouts/main.php';
?>