<?php
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
include_once("includes/config.php");
include_once("class/seguridad.php");
$s = new Seguridad();
//$s->permitir(0);
include_once("class/funciones.php");
$f = new Funciones();
$bd = conectar();
$sql = "select id, plan, precio, descripcion from planes where activo = '1' order by precio, plan desc";
$res = $bd->query($sql);
$plan = array();
$planPrecio = array();
$planDescripcion = array();
while($fila = $res->fetch_assoc()) {
	$plan[$fila["id"]] = $fila["plan"];
	$planPrecio[$fila["id"]] = $fila["precio"];
	$planDescripcion[$fila["id"]] = $fila["descripcion"];
}

if (isset($_SESSION) && isset($_SESSION[SesionId])){ //ALAN CHANGE TO PUBLISH WITHOUT LOGGIN
	$sql = "select balance from usuarios where id = ".$_SESSION[SesionId]." and activo = '2'";
}
else{
	
	$sql = "select balance from usuarios where id = -1 and activo = '2'";
}
	$res = $bd->query($sql);
	$fila = $res->fetch_assoc();
	$balance = $fila["balance"];

$data = array();
if(isset($_GET["id"])) {
	$id = $bd->real_escape_string($_GET["id"]);
	$columnas = array("titulo", "categoria", "subcategoria", "localidad", "barrio", "descripcion", "precio", "hora", "plan", "fecha", "cuando", "cuando_dias", "cuando_fecha", "cuando_hora_desde", "cuando_hora_hasta");
	$convertir = array("", "", "", "", "", "", "", "", "", "fecha", "", "check", "fecha", "", "");
	$sql = "select ch.titulo, cat.categoria, sub.subcategoria, sub.hora, loc.localidad, bar.barrio, ch.descripcion, ch.precio, ch.plan, ch.fecha, ch.cuando, ch.cuando_dias, ch.cuando_fecha, ch.cuando_hora_desde, ch.cuando_hora_hasta from changuitas as ch left join categorias as cat on ch.categoria = cat.id left join subcategorias as sub on ch.subcategoria = sub.id left join localidades as loc on ch.localidad = loc.id left join barrios as bar on ch.barrio = bar.id left join planes as pl on ch.plan = pl.id where ch.id = $id and ch.activo = '1' and ch.estado = '0' and ch.vencida = '0'";
	$res = $bd->query($sql);
	if($res->num_rows == 0)
		$s->salir();
	$fila = $res->fetch_assoc();
	foreach($columnas as $k => $v)
		$data[$v] = $f->convertirMuestra($fila[$v], $convertir[$k]);

	$sql = "select palabra from changuitas_palabras where changuita = $id";
	$res = $bd->query($sql);
	$data["palabras"] = array();
	while($fila = $res->fetch_assoc())
		$data["palabras"][] = $fila["palabra"];
	
}
else {
	$id = 0;
	if (isset($_SESSION) && isset($_SESSION[SesionId])){  //ALAN CHANGE TO PUBLISH WITHOUT LOGGIN 
		$sql = "select localidad, barrio from usuarios where id = ".$_SESSION[SesionId];
	}
	else{
		$sql = "select localidad, barrio from usuarios";
	}
	$res = $bd->query($sql);
	$fila = $res->fetch_assoc();
	$data["localidad"] = $fila["localidad"];
	$data["barrio"] = $fila["barrio"];
	$sql = "select id, barrio from barrios where activo = '1' and localidad = ".$fila["localidad"]." order by barrio asc";
	$res = $bd->query($sql);
	$barriosIni = array();
	while($fila = $res->fetch_assoc())
		$barriosIni[$fila["id"]] = $fila["barrio"];
	$sql = "select id, localidad from localidades where activo = '1' order by id asc";
	$res = $bd->query($sql);
	$localidad = array();
	while($fila = $res->fetch_assoc())
		$localidad[$fila["id"]] = $fila["localidad"];
	$sql = "select id, categoria from categorias where activo = '1' order by orden asc, categoria asc";
	$res = $bd->query($sql);
	$categoria = array();
	while($fila = $res->fetch_assoc())
		$categoria[$fila["id"]] = $fila["categoria"];
	// $sql = "select gratis from usuarios where id = ".$_SESSION[SesionId];
	// $res = $bd->query($sql);
	// $fila = $res->fetch_assoc();
	// $gratis = $fila["gratis"];
}
?>
<div class="tabulated-content">
<h2 id="form-changuita-title" class="givemefancy" style="font-size:57px;text-align:center;">Changuita</h2>
<form class="form-horizontal givemefont givemeback" id="editar-changuita">
	<fieldset>
	<input type="hidden" name="id" value="<?php echo $id ?>" />
<?php
$ahora = new DateTime();
$ahora->modify("+1 month");
$unMes = $ahora->format("d/m/Y");

$horas0 = range(8, 23);
$horas1 = range(0, 7);
$horas = array_merge($horas0, $horas1);

if($id == 0)
	include("editar-changuita-form-nueva.php");
else
	include("editar-changuita-form.php");
?>
	</fieldset>
</form>
</div>