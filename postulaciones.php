<?php
session_start();
$js = "";
if(isset($_SESSION["postulaciones-filtros"])) {
	$js .= "$('#postulaciones-filtros .btn').removeClass('active');";
	$js .= "$('#postulaciones-filtros .btn[value=".$_SESSION["postulaciones-filtros"]."]').addClass('active');";
}
?>
<div class="tabulated-content ">
	<div class=" givemefont">
		<div class="" style="width:100%">
			<h2 class="givemefont">Postulaciones y changuitas</h2>
			<div id="postulaciones-filtros" class="btn-group vista-filtros " data-toggle="buttons-radio">
				<button class="btn btn-info active givemefont" name="tipo" value="1">Postulaciones pendientes</button>
				<button class="btn btn-info givemefont" name="tipo" value="4">Postulaciones rechazadas</button>
				<button class="btn btn-info givemefont" name="tipo" value="2">Changuitas en curso</button>
				<button class="btn btn-info givemefont" name="tipo" value="3">Changuitas realizadas</button>
				<button class="btn btn-info givemefont" name="tipo" value="0">Todas</button>
			</div>
			<div id="postulaciones-tabla"></div>
			<div class="resultados-cargando hide"><img src="img/cargando2.gif" alt="cargando" /></div>
		</div>
	</div>
</div>
<script>
$(document).ready(function() {
	<?php echo $js ?>
	postulaciones();
});
</script>