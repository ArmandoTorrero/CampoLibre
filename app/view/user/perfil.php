<?php  
    ob_start(); 
?>
    <head>
        <link rel="stylesheet" href="./assets/css/perfil.css">
    </head>

    bienvenido a tu perfil

    <script type="module" src="./assets/js/views/perfil.js"></script>
<?php 
    $content = ob_get_clean(); 
    require __DIR__ . '/../layouts/main.php';
?>