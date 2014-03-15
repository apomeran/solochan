<?php
include_once("includes/config.php");
?>
<div class="wrapper_shadow givemeback" style="margin-left:15px;">
    <br>
		<div class="login " >
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
	<div class="login center">
		<a class="btn btn-success btn-info givemefont" rel="address:/usuario-nuevo" href="#/editar-usuario">Registrate GRATIS</a>
	</div>
	<div class="login">
		<div id="fb-root"></div>
		<div class="login-fb"><button class="btn btn-link" id="login-fb-btn"><img src="img/login-fb.jpg" alt="Iniciar sesi&oacute;n con Facebook"/></button></div>
	</div>
	<div class="login">
		<div class="login-li"><button class="btn btn-link" id="login-li-btn"><img src="img/login-li.jpg" alt="Iniciar sesi&oacute;n con LinkedIn"/></button></div>
	</div>
	<br>
</div>
<!-- <div class="columna-imagen">
	<img src="img/columna.png" alt="" />
</div> -->