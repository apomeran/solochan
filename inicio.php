<?php
include_once("includes/config.php");
if (isset($_SESSION[SesionTmp])) {
    if (strpos($_SESSION[SesionTmp], "ex") !== false)
        $externo = 1;
    // activacion de cuenta
    else if ($_SESSION[SesionTmp] > 0) {
        include("cuenta-no-activa.php");
        exit;
    }
    // recuperacion de clave
    else {
        include("contrasena-nueva.php");
        exit;
    }
}
$bd = conectar();
$sql = "select id, categoria from categorias where activo = '1' order by orden asc, categoria asc";
$res = $bd->query($sql);
$categoria = array();
while ($fila = $res->fetch_assoc())
    $categoria[$fila["id"]] = $fila["categoria"];
$sql = "select id, subcategoria from subcategorias where activo = '1' order by orden asc, subcategoria asc";
$res = $bd->query($sql);
$subcatTodas = array();
while ($fila = $res->fetch_assoc())
    $subcatTodas[$fila["id"] + 100] = $fila["subcategoria"];
$sql = "select id, localidad from localidades where activo = '1' order by id asc";
$res = $bd->query($sql);
$localidad = array();
while ($fila = $res->fetch_assoc())
    $localidad[$fila["id"]] = $fila["localidad"];
// $gratis = "<em>&iexcl;Pod&eacute;s publicar ".ChGratis." veces GRATIS!</em>";
// if(isset($_SESSION[SesionId])) {
// 	$sql = "select gratis from usuarios where activo = '2' and id = ".$_SESSION[SesionId];
// 	$res = $bd->query($sql);
// 	if($res->num_rows > 0) {
// 		$fila = $res->fetch_assoc();
// 		$quedan = ChGratis - $fila["gratis"];
// 		if($quedan > 1)
// 			$gratis = "<em>&iexcl;Pod&eacute;s publicar $quedan veces GRATIS!</em>";
// 		else if($quedan == 1)
// 			$gratis = "<em>&iexcl;Pod&eacute;s publicar 1 vez m&aacute;s GRATIS!</em>";
// 		else
//			$gratis = "&nbsp;";
// 	}
// }
?>
<div class="tabulated-content">
    <div class="home-caption">
        <span class="highlight">Conectate</span> con alguien que te pueda <span class="highlight">ayudar</span> en tus tareas m&aacute;s simples o complicadas <span class="highlight">GRATIS!</span>.. 
    </div>
    <div style="margin-top: 2%; left: 0%; ">
        <button class="btn btn-info btn-large btn-publicar givemefont" >Public&aacute; una changuita</button>
    </div>
</div>
<div class="tabulated-content" style="margin-top: 6%;">
    <div class="como-funciona-caption">&iquest;C&oacute;mo funciona?</div>
    <div>
		<div class="arrow-container">
		<img src="img/comofunc/img5.png">
        </img>
		</div>
        <div class="como-funciona-container">
		
            <img src="img/comofunc/img3.png">
            </img>

        </div>
        <div class="destacadas-container" style=" margin-top: 3%; ">
            <div id="destacadas-inicio" style="display:inline-block; height: 100%; margin-top:-8.5%">
            </div>
        </div>
    </div>
</div>
<div class="tabulated-content" style="float:left;">
	  <div class="busqueda-container"> 
	  <a href="#/changuitas" rel="address:/changuitas" address="true"><button class="btn btn-link givemefont" style="font-size:28px;" id="btn-ver-todas">VER TODAS LAS CHANGUITAS</button></a>
	</div>
</div>
<script>
    $(document).ready(function() {
        $('#destacadas-inicio').load('ax/destacadas.php', {p: 3});
        $('.auto-palabras').typeahead({
            source: ['<?php echo implode("', '", array_unique($categoria + $subcatTodas)) ?>'],
            items: 20
        });
		
    });

</script>