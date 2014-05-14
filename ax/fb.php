<?php

header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
include_once("../includes/config.php");
$bd = conectar();
$userid = $bd->real_escape_string($_POST["id"]);
$sql = "select id, activo from usuarios where fb_id = $userid";
$res = $bd->query($sql);
$id_to_insert = 0; // TO PUBLISH CHANGUITA WITHOUT LOGGIN'
if ($res->num_rows == 1) {
    $fila = $res->fetch_assoc();
    // si existe en la bbdd y activo: logueo
    if ($fila["activo"] == "2") {
        $_SESSION[SesionId] = $fila["id"];
        $_SESSION[SesionNivel] = 0;
        $_SESSION[SesionExterno] = 1;
        $data["estado"] = "ok";
        $id_to_insert = $fila["id"];
    }
    // no activo
    else if ($fila["activo"] == "1") {
        $_SESSION[SesionTmp] = "ex" . $fila["id"];
        $data["estado"] = "activar";
        $data["id"] = $fila["id"];
        $id_to_insert = $fila["id"];
    } else {
        $data["estado"] = "error";
    }
    if ($data["estado"] != "error") {
        if (isset($_SESSION['PublishedCHwithoutReg']) && $_SESSION['PublishedCHwithoutReg'] == 1) {
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
} else {
    include_once("../includes/facebook-configured.php");
    $user = $facebook->getUser();

    if ($user) {
        try {
            $user_profile = $facebook->api('/me', 'GET');
            $fql = "SELECT first_name, last_name, email from user where uid = $user";
            $ret_obj = $facebook->api(array('method' => 'fql.query', 'query' => $fql));
            if ($ret_obj[0]['email'] == "") {
                $data["estado"] = "mail";
                echo json_encode($data);
                exit;
            }

            //	$response = $facebook->api("/me/friends");
            //	$response = $facebook->api("/me/inbox");
            //	var_dump($response);die;

            $sql = "select id, dni, activo from usuarios where mail = '" . $ret_obj[0]['email'] . "' and activo != '0'";
            $res = $bd->query($sql);
            if ($res->num_rows == 1) {
                // mail ya registrado (por login comun o linkedIn)
                $fila = $res->fetch_assoc();
                $nid = $fila["id"];
                $id_to_insert = $nid;

                $sql = "update usuarios set fb_id = $user where id = $nid";
                $res = $bd->query($sql);
                if ($fila["dni"] != "" && $fila["activo"] == "1") {
                    $sql = "update usuarios set activo = '2' where id = $nid";
                    $res = $bd->query($sql);
                    // login
                    $_SESSION[SesionId] = $nid;
                    $_SESSION[SesionNivel] = 0;
                    $_SESSION[SesionExterno] = 1;
                    $data["estado"] = "ok";
                    if (isset($_SESSION[SesionTmp])) {
                        unset($_SESSION[SesionTmp]);
                    }
                } else if ($fila["dni"] == "") {
                    $_SESSION[SesionTmp] = "ex" . $nid;
                    $data["estado"] = "activar";
                    $data["id"] = $nid;
                }
            } else {
                $sql = "insert into usuarios (nombre, apellido, mail, fb_id, fecha, aviso, aviso_np, aviso_rech, aviso_ca, aviso_cal, aviso_pr, aviso_res, aviso_pv, aviso_ve, aviso_inv, aviso_bal, activo) values ('" . $ret_obj[0]['first_name'] . "', '" . $ret_obj[0]['last_name'] . "', '" . $ret_obj[0]['email'] . "', $user, '" . date("Y-m-d H:i:s") . "', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1')";
                if ($res = $bd->query($sql)) {
                    $nid = $bd->insert_id;
                    // calificacion y confianza
                    $sql = "insert into calificacion (usuario, calificacion, n) values ($nid, 0, 0)";
                    $bd->query($sql);
                    $sql = "insert into confianza (usuario, confianza) values ($nid, 0)";
                    $bd->query($sql);
                    //
                    $_SESSION[SesionTmp] = "ex" . $nid;
                    $data["estado"] = "activar";
                    $data["id"] = $nid;
                    $id_to_insert = $nid;
                } else {
                    $data["estado"] = "error";
                }
            }
        } catch (FacebookApiException $e) {
            $data["result"] = $e->getResult();
            $data["type"] = $e->getType();
            $data["estado"] = "error catched";
        }
    } else {
        $data["estado"] = "error";
    }
}

if (isset($_SESSION['PublishedCHwithoutReg']) && $_SESSION['PublishedCHwithoutReg'] == 1) {
    $_SESSION['nid'] = $id_to_insert;
    $_SESSION['PublishedCHwithoutReg'] = 0;
}

echo json_encode($data);
