<?php
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
include_once("includes/config.php");
$bd = conectar();
?>
<div class="givemefont tabulated-content">
	<h2 class="givemefont">Contactos en la red</h2>
	<div class="" id="invitar-container">
		<div class="span5">
			<h3 class="givemefont">Tus contactos</h3>
	<?php
	$sql = "select u.nombre, u.apellido from invitados as inv left join usuarios as u on inv.mail = u.mail where inv.usuario = ".$_SESSION[SesionId]." and inv.ok = '1' and u.activo = '2'";
	$res = $bd->query($sql);
	if($res->num_rows > 0) {
		while($fila = $res->fetch_assoc()) {
	?>
		<p><?php echo $fila["nombre"]." ".$fila["apellido"] ?></p>
	<?php
		}
	}
	else {
	?>
		<p>Todav&iacute;a no ten&eacute;s</p>
	<?php
	}
	?>
		</div>
		<div class="span9 a-box-shadow-container" style="margin-bottom:10%;">
			<h4>Generar contactos</h4>
			<p>Import&aacute; tus contactos desde:</p>
			<ul class="ul-invitar">
			   <li><button class="btn-link btn-invitar-fbx"><img src="img/social/fb.png" alt="Gmail"/> Facebook</button></li>
				<li><button class="btn-link btn-invitar-lix"><img src="img/social/li.png" alt="Gmail"/> LinkedIn</button></li>
				<li><button class="btn-link btn-invitar-gm"><img src="img/invitar/gmail.gif" alt="Gmail"/> Gmail</button></li>
				 <li><button class="btn-link btn-invitar-hmx">desde Hotmail</button></li> 
				 <li><button class="btn-link btn-invitar-yhx">desde Yahoo</button></li> 
			</ul>
			<p>O si no, <button class="btn-link btn-invitar-manual">escrib&iacute; las direcciones manualmente</button></p>
			<!-- <p><button class="btn-link btn-invitar-manual">Escrib&iacute; las direcciones manualmente</button></p> -->
			<div id="invitar-res" class="hide">
				<form id="form-invitar"></form>
				<div><input type="submit" class="btn btn-success btn-invitar-submit" value="Invitar" /></div>
			</div>
			<div></div>
			<div id="form-invitar-mensaje" class="alert alert-error hide"></div>
		</div>
	</div>
</div>