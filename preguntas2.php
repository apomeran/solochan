<?php
session_start();
?>
<div class="row givemefont">
	<div class="span9">
		<h3 class="givemefont">Mis preguntas</h3>
		<div id="preguntas2-tabla"></div>
		<div class="resultados-cargando hide"><img src="img/cargando2.gif" alt="cargando" /></div>
	</div>
</div>
<script>
$(document).ready(function() {
	preguntas2();
});
</script>