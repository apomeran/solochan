<?php
include_once("../../includes/config.php");
$bd = conectar();
$data["html"] = "<option value='-1'>Todos</option>";
if(!isset($_POST["id"]))
    exit;
$id = $bd->real_escape_string($_POST["id"]);
$sql = "select id, barrio from barrios where localidad = $id and activo = '1'";
$res = $bd->query($sql);
while($fila = $res->fetch_assoc())
    $data["html"] .= "<option value='".$fila["id"]."'>".$fila["barrio"]."</option>";
echo json_encode($data);
?>