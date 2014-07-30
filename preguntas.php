<?php
session_start();
$js = "";
if(isset($_SESSION["preguntas-filtros"])) {
	$js .= "$('#preguntas-filtros .btn').removeClass('active');";
	$js .= "$('#preguntas-filtros .btn[value=".$_SESSION["preguntas-filtros"]."]').addClass('active');";
}
?>
<div class="tabulated-content">
	<div class=" givemefont">
		<div class="" style="width:100%">
			<h2>Preguntas</h2>
			<div id="preguntas-filtros" class="btn-group vista-filtros " data-toggle="buttons-radio">
				<button class="btn btn-info active givemefont" name="tipo" value="1">Pendientes</button>
				<button class="btn btn-info givemefont" name="tipo" value="2">Respondidas</button>
				<button class="btn btn-info givemefont" name="tipo" value="0">Todas</button>
			</div>
			<div id="preguntas-tabla"></div>
			<div class="resultados-cargando hide"><img src="img/cargando2.gif" alt="cargando" /></div>
		</div>
	</div>
</div>
<script>
$(document).ready(function() {
	<?php echo $js ?>
	preguntas();
});
</script>