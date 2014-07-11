<?php
include_once("includes/config.php");
?>

<div id="login-container" class="givemeback givemefont">

    <div class="login ">
        <div style="font-size: 20px;">Conectate con tu red social favorita</div>
        <div id="fb-root">
        </div>
        <div>
            <div class="login-social bw"><button class="btn btn-link" id="login-fb-btn"><img width="70%" src="img/social/fb2.png" alt="Iniciar sesi&oacute;n con Facebook"/></button></div>
            <div class="login-social bw"><button class="btn btn-link" id="login-li-btn"><img width="70%" src="img/social/li2.png" alt="Iniciar sesi&oacute;n con LinkedIn"/></button></div>
        </div>
    </div>
    <hr>
    <div class="login login-not-social">
        <div style="font-size: 17px; margin-bottom:5px">O inici&aacute; sesi&oacute;n con tu usuario</div>
        <form id="form-login">

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
    <hr>
    <div class="login center">
        <div>	
            <div style="font-size: 12px;">
                &iquest;No ten&eacute;s una cuenta? 
            </div>
            <a class="btn btn-link givemefont" rel="address:/usuario-nuevo" href="#/editar-usuario" data-dismiss="modal"><b>Registrate GRATIS</b></a>
        </div>	
    </div>

</div>

<!-- <div class="columna-imagen">
        <img src="img/columna.png" alt="" />
</div> -->