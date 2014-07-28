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
        <span class="highlight">Conectate</span> con alguien que te pueda <span class="highlight">ayudar</span> en las tareas m&aacute;s simples o en las m&aacute;s complicadas..
    </div>
    <div style="margin-top: 2%; left: 0%; ">
        <button class="btn btn-info btn-large btn-publicar givemefont" >Public&aacute; una changuita</button>
    </div>
</div>
<div class="tabulated-content">
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
        <div class="destacadas-container">
            <div id="destacadas-inicio" style="display:inline-block; height: 100%; margin-top:-8.5%">
            </div>
        </div>
    </div>
</div>
<div class="tabulated-content" style="float:left;">
	  <div class="busqueda-container"> 
	  <button class="btn btn-info btn-large btn-search-changuita givemefont" id="search-changuita-button">Buscar una changuita</button>
		<div id="search-changuita-container" style="display:none">
			<form name="buscar" id="ini-buscar">
				<input type="hidden" name="categoria" value="0">
				<input type="hidden" name="subcategoria" value="0">
				<input type="hidden" name="localidad" value="0">
				<input type="hidden" name="barrio" value="0">

				<div class="btn-group">
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#" id="btn-drop-categoria">
						<p><span class="txt ">Eleg&iacute; una Categor&iacute;a</span></p>
					</a>
					<div class="dropdown-menu">
						<div id="drop-categoria">
							<?php
							foreach ($categoria as $k => $v) {
								?>
								<a data-cat-id="<?php echo $k ?>" href="#"><?php echo $v ?></a>
								<?php
							}
							?>
							<a href="#" class="sugerir" data-cat-id="-1"><em>&iquest;No encontr&aacute;s lo que busc&aacute;s?</em></a>
						</div>
					</div>
				</div>
				<div id="ini-div-sugerir" class="hide">
					<input type="text" name="sugerir" id="ini-sugerir" value="" placeholder="Sugerinos la categor&iacute;a que falta" maxlength="100" />
					<button class="btn btn-primary" id="btn-sugerir">Sugerir</button>
					<div class="clearfix"></div>
				</div>
				<div class="btn-group">
					<a class="btn dropdown-toggle disabled" data-toggle="dropdown" href="#" id="btn-drop-subcategoria" disabled>
						<p><span class="txt">Eleg&iacute; una Subcategor&iacute;a</span></p>
					</a>
					<div class="dropdown-menu">
						<div id="drop-subcategoria">
						</div>
					</div>
				</div>
				<div class="btn-group">
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#" id="btn-drop-localidad">
						<p class="txt">Eleg&iacute; una Zona</p>
					</a>
					<div class="dropdown-menu">
						<div id="drop-localidad">
							<?php
							foreach ($localidad as $k => $v) {
								?>
								<a data-loc-id="<?php echo $k ?>" href="#"><?php echo $v ?></a>
								<?php
							}
							?>
						</div>
					</div>
				</div>
				<div class="btn-group">
					<a class="btn dropdown-toggle disabled" disabled="disabled" data-toggle="dropdown" href="#" id="btn-drop-barrio">
						<p class="txt">Eleg&iacute; localidades o barrios</p>
					</a>
					<div class="dropdown-menu">
						<div id="drop-barrio">
						</div>
					</div>
				</div>
				<div style="visibility:hidden;">
					<label for="ini-palabras">Palabras clave <a class="ayuda" title="Pod&eacute;s escribir algunas palabras para afinar la b&uacute;squeda."><i class="icon-question-sign"></i></a></label>
					<input type="text" name="palabras" id="ini-palabras" value="" placeholder="Opcional" class="auto-palabras" />
				</div>
				<button class="btn btn-large givemefont" style="margin-top:-7px !important;" id="btn-buscar">Buscar una changuita</button>
			</form>
		</div>
		<button class="btn btn-link givemefont" style="font-size:22px;" id="btn-ver-todas">Ver todas las changuitas</button>
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