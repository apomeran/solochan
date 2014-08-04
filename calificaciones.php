<?php
session_start();
$js = "";
if(isset($_SESSION["calificaciones-filtros"])) {
	$js .= "$('#calificaciones-filtros .btn').removeClass('active');";
	$js .= "$('#calificaciones-filtros .btn[value=".$_SESSION["calificaciones-filtros"]."]').addClass('active');";
}
?>
<div class="givemefont tabulated-content">
	<div class="givemefont" style="width: 100%">
		<h2 class="givemefont">Mis calificaciones</h2>
		<div id="calificaciones-filtros" class="btn-group vista-filtros " data-toggle="buttons-radio">
			<button class="btn btn-info active givemefont" name="tipo" value="1">Calificaciones pendientes</button>
			<button class="btn btn-info givemefont" name="tipo" value="2">Calificaciones recibidas</button>
			<button class="btn btn-info givemefont" name="tipo" value="3">Calificaciones realizadas</button>
			<button class="btn btn-info givemefont" name="tipo" value="0">TODAS</button>
		</div>
		<div id="calificaciones-tabla"></div>
		<div class="resultados-cargando hide"><img src="img/cargando2.gif" alt="cargando" /></div>
	</div>
</div>
<script>
$(document).ready(function() {
	<?php echo $js ?>
	calificaciones();
});
</script>