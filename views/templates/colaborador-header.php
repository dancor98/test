<div class="menu menu__admin">
    <nav class="navbar navbar-admin navbar-expand-lg ">
        <div class="container-fluid">
            <a class="navbar-brand" href="/colaborador/dashboard">
                <img class="navbar-inicio-logo" src="/build/img/logo.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa-solid fa-bars icono-menu"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link nav-link-menu" href="/colaborador/dashboard">INICIO</a>
                    <a class="nav-link nav-link-menu" href="/colaborador/incapacidades">INCAPACIDADES</a>
                    <a class="nav-link nav-link-menu" href="/colaborador/vacaciones">VACACIONES</a>
                    <a class="nav-link nav-link-menu" href="/colaborador/boletapago">BOLETAS DE PAGO</a>
                    <form method="POST" action="/logout">
                        <input type="submit" value="LOGOUT" class="boton-logout">
                    </form>
                </div>
            </div>
        </div>
    </nav>
</div>