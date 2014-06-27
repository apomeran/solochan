<?php
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
include_once("includes/config.php");
include_once("class/seguridad.php");
$s = new Seguridad();
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


<style>.navbar-login
    {
        width: 305px;
        padding: 10px;
        padding-bottom: 0px;
    }

    .navbar-login-session
    {
        padding: 10px;
        padding-bottom: 0px;
        padding-top: 0px;
    }

    .icon-size
    {
        font-size: 87px;
    }
</style>
<div class="">
    <a class="menucontainer dropdown-toggle" data-toggle="dropdown" id="user-button " style="border-right: 0px !important">
        <img width="30" src="img/icons/user.png"/>
        &iexcl;<?php echo $bienvenido ?>, <strong><?php echo $fila["nombre"] ?></strong>!
    </a>
    <ul class="dropdown-menu">
        <li>
            <div class="navbar-login">
                <div class="row">
                    <div class="col-lg-4">
                        <p class="text-center">
                            <span class="glyphicon glyphicon-user icon-size"></span>
                        </p>
                    </div>
                    <div class="col-lg-8">
                        <p class="text-left"><strong>Nombre Apellido</strong></p>
                        <p class="text-left small">correoElectronico@email.com</p>
                        <p class="text-left">
                            <a href="#" class="btn btn-primary btn-block btn-sm">Actualizar Datos</a>
                        </p>
                    </div>
                </div>
            </div>
        </li>
        <li class="divider"></li>
        <li>
            <div class="navbar-login navbar-login-session">
                <div class="row">
                    <div class="col-lg-12">
                        <p>
                            <a href="#" class="btn btn-danger btn-block">Cerrar Sesion</a>
                        </p>
                    </div>
                </div>
            </div>
        </li>
    </ul>


</a>
</div>