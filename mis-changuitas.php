<?php
session_start();
$js = "";
if(isset($_SESSION["mis-changuitas-filtros"])) {
	$js .= "$('#mis-changuitas-filtros .btn').removeClass('active');";
	$js .= "$('#mis-changuitas-filtros .btn[value=".$_SESSION["mis-changuitas-filtros"]."]').addClass('active');";
}
?>
<div class="tabulated-content">
	<div class="givemefont">
		<div class="" style="width:100%">
			<h2 class="givemefont">Mis changuitas</h2>
			<div id="mis-changuitas-filtros" class="btn-group vista-filtros" data-toggle="buttons-radio">
				<button class="btn btn-info active givemefont" name="tipo" value="1">Changuitas pendientes</button>
				<button class="btn btn-info givemefont" name="tipo" value="2">Changuitas en curso</button>
				<button class="btn btn-info givemefont" name="tipo" value="3">Changuitas realizadas</button>
				<button class="btn btn-info givemefont" name="tipo" value="0">Todas</button>
			</div>
			<div id="mis-changuitas-tabla"></div>
			<div class="resultados-cargando hide"><img src="img/cargando2.gif" alt="cargando" /></div>
		</div>
	</div>
</div>
<script>
$(document).ready(function() {
	<?php echo $js ?>
	misChanguitas();
});
</script>