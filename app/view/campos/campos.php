<?php  
    ob_start(); 
?>
    <head>
        <link rel="stylesheet" href="./assets/css/campos.css">
    </head>

    <section class="main">
        <h1>Campos deportivos</h1>

        <section class="filtros">

            <input type="text" name="bucador" id="buscador" placeholder="Buscar por nombre">
            <select name="categoria" id="categoria">
                <option value="0" selected>Todos</option>
            </select>

        </section>
        
        <section class="campos column-center"></section>
    </section>

    <script type="module" src="./assets/js/views/campos.js"></script>
<?php 
    $content = ob_get_clean(); 
    require __DIR__ . '/../layouts/main.php';
?>