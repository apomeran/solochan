<?php
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
include_once("../includes/config.php");
$bd = conectar();
$data["estado"] = "";
$userid = $_POST["res"]["values"][0]["id"];
$nombre = $_POST["res"]["values"][0]["firstName"];
$apellido = $_POST["res"]["values"][0]["lastName"];
$mail = $_POST["res"]["values"][0]["emailAddress"];
$id_to_insert = 0; // TO PUBLISH CHANGUITA WITHOUT LOGGIN'
// si existe en la bbdd: logueo
$sql = "select id, activo from usuarios where li_id = '$userid'";
$res = $bd->query($sql);
if($res->num_rows == 1) {
	$fila = $res->fetch_assoc();
	if($fila["activo"] == "2") {
		$_SESSION[SesionId] = $fila["id"];
		$_SESSION[SesionNivel] = 0;
		$_SESSION[SesionExterno] = 1;
		$id_to_insert = $fila["id"];
		$data["estado"] = "ok";
	}
	else if($fila["activo"] == "1") {
		$_SESSION[SesionTmp] = "ex".$fila["id"];
		$data["estado"] = "activar";
		$id_to_insert = $fila["id"];
		$data["id"] = $fila["id"];
	}
	else{
		$data["estado"] = "error";
		}
	if ($data["estado"] != "error") {
	 		if (isset($_SESSION['PublishedCHwithoutReg']) && $_SESSION['PublishedCHwithoutReg'] == 1){
		    $_SESSION['PublishedCHwithoutReg'] = 0;
			$sql_set_user = "UPDATE changuitas SET activo = '1', usuario = " . $fila['id'] . " WHERE activo = '0' AND usuario = 0";
			$bd->query($sql_set_user);
			$sql_get_changuita_last_id = "SELECT MAX(id) as chang_id FROM changuitas WHERE activo = '1' AND usuario = " . $fila['id'];
			$chang_res = $bd->query($sql_get_changuita_last_id);
			$chang_row = $chang_res->fetch_assoc();
			$chang_id = $chang_row['chang_id'];
			$data["estado"] .= "$chang_id";
		}
	}
}
else {
	$sql = "select id, dni, activo from usuarios where mail = '$mail' and activo != '0'";
	$res = $bd->query($sql);
	if($res->num_rows == 1) {
		// mail ya registrado (por login comun o fb)
		$fila = $res->fetch_assoc();
		$nid = $fila["id"];
		$id_to_insert = $fila["id"];
		$sql = "update usuarios set li_id = '$userid' where id = $nid";
		$res = $bd->query($sql);
		if($fila["dni"] != "" && $fila["activo"] == "1") {
        	$sql = "update usuarios set activo = '2' where id = $nid";
        	$res = $bd->query($sql);
        	// login
	        $_SESSION[SesionId] = $nid;
			$_SESSION[SesionNivel] = 0;
			$_SESSION[SesionExterno] = 1;
			$data["estado"] = "ok";
        	if(isset($_SESSION[SesionTmp]))
				unset($_SESSION[SesionTmp]);
        }
        else if($fila["dni"] == "") {
        	$_SESSION[SesionTmp] = "ex".$nid;
			$data["estado"] = "activar";
			$data["id"] = $nid;
        }
	}
	else {
		$sql = "insert into usuarios (nombre, apellido, mail, li_id, fecha, aviso, aviso_np, aviso_rech, aviso_ca, aviso_cal, aviso_pr, aviso_res, aviso_pv, aviso_ve, aviso_inv, aviso_bal, activo) values ('$nombre', '$apellido', '$mail', '$userid', '".date("Y-m-d H:i:s")."', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1')";
		if($res = $bd->query($sql)) {
			$nid = $bd->insert_id;
			// calificacion y confianza
			$sql = "insert into calificacion (usuario, calificacion, n) values ($nid, 0, 0)";
			$bd->query($sql);
			$sql = "insert into confianza (usuario, confianza) values ($nid, 0)";
			$bd->query($sql);
			//
			$_SESSION[SesionTmp] = "ex".$nid;
			$data["estado"] = "activar";
			$data["id"] = $nid;
			$id_to_insert = $nid;
		}
		else
			$data["estado"] = "error";
	}
}

if (isset($_SESSION['PublishedCHwithoutReg']) && $_SESSION['PublishedCHwithoutReg'] == 1){
 	   $_SESSION['nid'] = $id_to_insert;
	   $_SESSION['PublishedCHwithoutReg'] = 0;
}

echo json_encode($data);
?>