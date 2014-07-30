<?php
session_start();
?>
<div class="tabulated-content">
	<div class="givemefont">
		<div class="" style="width:100%">
			<h2 class="givemefont">Mis preguntas</h2>
			<div id="preguntas2-tabla"></div>
			<div class="resultados-cargando hide"><img src="img/cargando2.gif" alt="cargando" /></div>
		</div>
	</div>
</div>
<script>
$(document).ready(function() {
	preguntas2();
});
</script>