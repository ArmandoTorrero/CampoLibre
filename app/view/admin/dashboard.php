
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="./assets/css/admin.css">
        <link rel="stylesheet" href="./assets/css/main.css">
        
    </head>

    <body>
        <main>
            <section class="buttons">

                <article class="dashboard">
                    <button class="selected"><i class="fa-solid fa-asterisk"></i>Dashboard</button>
                </article>
                
                <article class="campos">
                    <button><i class="fa-solid fa-futbol"></i>Campos</button>
                </article>

                <article class="reservas">
                    <button><i class="fa-solid fa-calendar"></i>Reservas</button>
                </article>

                <article class="usuarios">
                    <button><i class="fa-solid fa-user"></i>Usuarios</button>
                </article>

                <article class="cerrar-sesion">
                    <form action="#" method="post">
                        <button>Cerrar sesión</button>
                    </form>
                </article>

            </section>

            <section class="content">

               <h1 class="titulo"></h1>

               <article class="table"></article>

               <dialog class="dialog-campo">
                    <h1>Detalles del campo</h1>

                    <form action="#" method="post" class="form-edit-campo">

                        <input type="hidden" name="id_campo" id="id_campo">

                        <section class="label-input">
                            <label for="nombre_campo">Nombre del campo</label>
                            <input type="text" name="nombre_campo" id="nombre_campo" placeholder="Nombre campo">
                            <span class="noVisible">Solo letras</span>
                        </section>

                        <section class="label-input">
                            <label for="modalidad">Modalidad</label>
                            <select name="modalidad" id="modalidad"></select>
                        </section>

                        <section class="label-input">
                            <label for="disponibilidad">Disponiblidad</label>
                            <select name="disponibilidad" id="disponibilidad">
                                <option value="1">Disponible</option>
                                <option value="0">No disponible</option>
                            </select>
                        </section>

                        <section class="buttons">
                            <button type="button" class="cancelar-btn">Cancelar</button>
                            <button type="submit" disabled class="disabled enviar">Editar</button>
                        </section>

                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['editCampo_csrf_token'] ?>">

                    </form>
               </dialog>

            </section>
        </main>
    </body>

    <script type="module" src="./assets/js/views/admin.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/bee72e8c16.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>