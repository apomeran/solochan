<link rel="stylesheet" href="css/panelstyles.css"/>
<link rel="stylesheet" href="css/styles.css"/>
<script>
 //$("#userPanel").empty();
</script>
<?php

header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 1');
include_once("includes/config.php");
include_once("class/seguridad.php");
$s = new Seguridad();
if(!isset($_SESSION[SesionId]) || $_SESSION[SesionId] == 0) {
	include_once("panel-login.php");
	die;
}
$s->permitir(0);
include_once("class/funciones.php");
$f = new Funciones();
$bd = conectar();
// datos usuario
$sql = "select usu.nombre, usu.sexo, usu.nacimiento, usu.localidad, usu.barrio, usu.celular, usu.educacion, usu.institucion, usu.presentacion, usu.balance, con.confianza, cal.calificacion, cal.n from usuarios as usu left join confianza as con on usu.id = con.usuario left join calificacion as cal on usu.id = cal.usuario where usu.id = " . $_SESSION[SesionId] . " and usu.activo = '2'";
$res = $bd->query($sql);
$fila = $res->fetch_assoc();
$perfil = array("sexo", "nacimiento", "localidad", "localidad", "barrio", "celular", "educacion", "institucion");
$nPerfil = count($perfil) + 3;
$perfilOk = 3;
foreach ($perfil as $v) {
    if (!in_array($fila[$v], $valoresVacios))
        $perfilOk++;
}
$perfilx100 = round($perfilOk / $nPerfil * 100);
$presentacionx100 = 0;
$presentacionLen100 = 200;
if ($fila["presentacion"] != "") {
    $presentacionLen = strlen($fila["presentacion"]);
    if ($presentacionLen >= $presentacionLen100)
        $presentacionx100 = 100;
    else
        $presentacionx100 = round($presentacionLen / $presentacionLen100 * 100);
}
// categorias totales
$sql = "select sc.id from subcategorias as sc left join categorias as c on sc.categoria = c.id where c.activo = '1' and sc.activo = '1'";
$res = $bd->query($sql);
$nCat = $res->num_rows;
// categorias elegidas
$sql = "select uc.id from usuarios_categorias as uc left join subcategorias as s on uc.categoria = s.id where uc.usuario = " . $_SESSION[SesionId] . " and s.activo = '1'";
$res = $bd->query($sql);
$nCatE = $res->num_rows;
$catx100 = $nCatE / $nCat * 100;
// changuitas realizadas
$sql = "select id from changuitas where contratado = " . $_SESSION[SesionId] . " and activo = '1' and (estado = '2' or estado = '3')";
$res = $bd->query($sql);
$nChanguitas = $res->num_rows;
// changuitas publicadas
$sql = "select id from changuitas where usuario = " . $_SESSION[SesionId] . " and activo = '1'";
$res = $bd->query($sql);
$nPublicadas = $res->num_rows;
//
$calificacion = $fila["calificacion"];
$calificacionTxt = "";
if ($fila["n"] == 0) {
    $calificacion = -1;
    $calificacionTxt = "<em>(no tiene)</em>";
}
$confianza = $fila["confianza"];
if ($fila["confianza"] == "")
    $confianza = 0;
// deuda
$bloqueado = 0;
if ($fila["balance"] <= MaxDeuda * -1)
    $bloqueado = 1;
$_SESSION[SesionBloqueado] = $bloqueado;
$bienvenido = "Bienvenido/a";
if ($fila["sexo"] == 1)
    $bienvenido = "Bienvenida";
else if ($fila["sexo"] == 2)
    $bienvenido = "Bienvenido";
?>

<script>
    $(document).ready(function() {
        actualizarNotificaciones();
    });
</script>


<div class="givemefont">
	 <a class="menucontainer"  href="#/changuitas" rel="address:/changuitas">
		<img width="25" src="img/icons/listtask.png"/> Ver todas
	</a>
	<a class="menucontainer"  href="#/changuita-nueva" rel="address:/changuita-nueva">
		<img width="30" src="img/icons/addtask.png"/> Publicar
	</a>
	
    <a class="menucontainer dropdown-toggle" data-toggle="dropdown" id="user-button " style="border-right: 0px !important">
        <img width="30" src="img/icons/user.png"/>
       <strong><?php echo $fila["nombre"] ?></strong>
    </a>
	<a>
		<span id="notificacionN" style="width:35px">
			<span class="notificacion badge">
				<button class="btn-notificaciones">
				</button>
			</span>
		</span>
	</a>
	
    <ul class="dropdown-menu" style="background-color: rgb(211, 216, 255)">
        <li>
            <div class="navbar-login">
                <div class="row">
                   
                    <div class="col-lg-8">
						<?php
						if($_SESSION[SesionNivel] > 0) {
						?>
								<div class="justify-left">
								<strong><i class="icon-briefcase text-left"></i>
									<a style="display: inline-block;padding: 3px 20px;clear: both;font-weight: normal;line-height: 20px;color: #333333;white-space: nowrap;" class="text-left" href="admin">Panel de control</a>
								</strong></div>
								
						<?php
						}
						?>
						<span class="text-left titulo">Mi estado</span>
						<div style="width:100%; display:inline">
							<?php
							if($fila["balance"] < 0) {
							?>
								<?php
								if($bloqueado == 1) {
								?>
										<p class="li-deuda text-left" style="display:inline-block">Alcanzaste el l&iacute;mite permitido de deuda. Por eso, tu usuario est&aacute; bloqueado y no pod&eacute;s publicar nuevas changuitas ni postularte para hacerlas.</p>
								<?php
									}
									?>
									<p class="balance text-left" style="display:inline-block">
										<p class="num num2 num3 num-deuda">
											<div>
												<div style="display:inline-block">Ten&eacute;s deuda de</div>
												<div style="display:inline-block">$<?php echo sprintf("%01.2f", $fila["balance"]*-1) ?></div>
												<div style="display:inline-block"><a href="#/pagar-deuda" rel="address:/pagar-deuda" class="btn-info btn-small btn-columna-pagar">Pagar</a></div>
											</div>
										</p>
									</p>
							<?php
							}
							else if($fila["balance"] > 0) {
							?>
									<p class="balance text-left" style="display:inline-block">Cr&eacute;dito
										<p class="num num2 num3 num-credito">
											$<?php echo sprintf("%01.2f", $fila["balance"]) ?>
										</p>
									</p>
							<?php
							}
							?>
						</div>
						<p><div class="justify-left indicators">- Calificaciones: <?php echo $calificacionTxt ?></div> <br></p>
						<p><div class="justify-left indicators">- Contactos en la red: <?php echo $confianza ?></div><br></p>
						<p><div class="justify-left indicators">- Changuitas: <?php echo $nChanguitas+$nPublicadas ?></div><br></p>
							
						<div class="justify-left"><u>Quiero trabajar</u></div>
						<div class="justify-left">
								<strong><i class="icon-wrench text-left"></i>
									<a style="display: inline-block;padding: 3px 20px;clear: both;font-weight: normal;line-height: 20px;color: #333333;white-space: nowrap;" class="text-left" rel="address:/postulaciones" href="#/postulaciones">Mis postulaciones</a>
								</strong></div>
						<div class="justify-left">
								<strong><i class="icon-comment text-left"></i>
									<a style="display: inline-block;padding: 3px 20px;clear: both;font-weight: normal;line-height: 20px;color: #333333;white-space: nowrap;" class="text-left" rel="address:/preguntas2" href="#/preguntas2">Preguntas</a>
								</strong></div>
						
						<div class="justify-left"><u>Quiero contratar</u></div>
						<div class="justify-left">
								<strong><i class="icon-list text-left"></i>
									<a style="display: inline-block;padding: 3px 20px;clear: both;font-weight: normal;line-height: 20px;color: #333333;white-space: nowrap;" class="text-left" rel="address:/mis-changuitas" href="#/mis-changuitas">Mis changuitas</a>
								</strong></div>
						<div class="justify-left">
								<strong><i class="icon-comment text-left"></i>
									<a style="display: inline-block;padding: 3px 20px;clear: both;font-weight: normal;line-height: 20px;color: #333333;white-space: nowrap;" class="text-left" rel="address:/preguntas" href="#/preguntas">Preguntas</a>
								</strong></div>
						<div class="justify-left"><u>Herramientas</u></div>
						<div class="justify-left">
								<strong><i class="icon-user text-left"></i>
									<a style="display: inline-block;padding: 3px 20px;clear: both;font-weight: normal;line-height: 20px;color: #333333;white-space: nowrap;" class="text-left" href="#/mi-perfil|<?php echo $_SESSION[SesionId] ?>" rel="address:/mi-perfil|<?php echo $_SESSION[SesionId]?>">Mi perfil</a>
								</strong></div>
						<div class="justify-left">
								<strong><i class="icon-thumbs-up text-left"></i>
									<a style="display: inline-block;padding: 3px 20px;clear: both;font-weight: normal;line-height: 20px;color: #333333;white-space: nowrap;" class="text-left" rel="address:/calificaciones" href="#/calificaciones">Mis calificaciones</a>
								</strong></div>
						<div class="justify-left">
								<strong><i class="icon-star text-left"></i>
									<a style="display: inline-block;padding: 3px 20px;clear: both;font-weight: normal;line-height: 20px;color: #333333;white-space: nowrap;" class="text-left" rel="address:/invitar" href="#/invitar">Contactos en la red</a>
								</strong>
						_____________________		
						</div>
								
						<div class="justify-left">
						
						<strong><i class="icon-off text-left"></i>
							<a style="display: inline-block;padding: 3px 20px;clear: both;font-weight: normal;line-height: 20px;color: #333333;white-space: nowrap;" class="text-left" href="logout.php">Cerrar sesi&oacute;n</a>
						</strong></div>
                    </div>
                </div>
            </div>
        </li>

    </ul>



</div>
<script>
$('.dropdown-menu').removeClass('dropdown-menu').addClass('dropdown-menu');
</script>