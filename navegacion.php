<?php if (SesionService::obtenerIdUsuarioLogueado() !== NULL) { ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="<?php echo BASE_URL ?>">Cotizaciones</a>
        <button class="navbar-toggler" type="button" id="botonMenu" aria-label="Mostrar / ocultar menú">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav">
                <li class="nav-item <?php echo (isset($_GET["p"]) && $_GET["p"] === "clientes") ? 'active' : '' ?>">
                    <a class="nav-link" href="<?php echo BASE_URL ?>/?p=clientes">Clientes</a>
                </li>
                <li class="nav-item <?php echo (isset($_GET["p"]) && $_GET["p"] === "cotizaciones") ? 'active' : '' ?>">
                    <a class="nav-link" href="<?php echo BASE_URL ?>/?p=cotizaciones">Cotizaciones</a>
                </li>
                <li class="nav-item <?php echo (isset($_GET["p"]) && $_GET["p"] === "editar_mensajes") ? 'active' : '' ?>">
                    <a class="nav-link" href="<?php echo BASE_URL ?>/?p=editar_mensajes">Mensajes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL ?>/?p=logout">Salir</a>
                </li>
            </ul>
        </div>
    </nav>
<?php } ?>
<div class="container">