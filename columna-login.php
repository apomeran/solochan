<?php
include_once("includes/config.php");
?>

<div class="givemeback givemefont" style="margin-left:15px;">
    <br>

    <div class="login">
        <h4 class="form-signin-heading"> Inici&aacute; sesi&oacute;n </h4>
        <small class="text-muted">Conectate con tu red social favorita</small>
        <div id="fb-root"></div>
        <div class="login-fb"><button class="btn btn-link" id="login-fb-btn"><img src="img/login-fb.jpg" alt="Iniciar sesi&oacute;n con Facebook"/></button></div>
        <div class="login">
            <div class="login-li"><button class="btn btn-link" id="login-li-btn"><img src="img/login-li.jpg" alt="Iniciar sesi&oacute;n con LinkedIn"/></button></div>
        </div>

    </div>

    <div class="login">
        <small class="text-muted">O inici&aacute; sesi&oacute;n con tu usuario</small>

        <form id="form-login" >

            <input name="usuario" class="givemefont" type="text" placeholder="E-mail" id="login-usuario" />
            <input name="clave" class="givemefont" type="password" placeholder="Contrase&ntilde;a" id="login-clave" />
            <input type="submit" class="btn btn-info givemefont" value="Iniciar sesi&oacute;n" />
            <button class="btn btn-link givemefont" id="olvido">Olvid&eacute; la contrase&ntilde;a</button>
        </form>
        <form id="form-olvido" class="hide">
            <input name="usuario" type="text" class="givemefont" placeholder="E-mail" id="olvido-usuario" />
            <input type="submit" class="btn btn-info givemefont" value="Recuperar contrase&ntilde;a" />
            <button class="btn btn-link givemefont" id="iniciar">Iniciar sesi&oacute;n</button>
        </form>
        <div id="form-login-mensaje" class="alert alert-error hide"></div>
    </div>

    <div class="login center">
        <small class="text-muted">No ten&eacute;s una cuenta o red social?</small>
        <a class="btn btn-success btn-info givemefont" rel="address:/usuario-nuevo" href="#/editar-usuario">Registrate GRATIS</a>
    </div>

</div>
<!-- <div class="columna-imagen">
        <img src="img/columna.png" alt="" />
</div> -->