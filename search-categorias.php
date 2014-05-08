<?php

include_once("includes/config.php");
$bd = conectar();

if (isset($_REQUEST['term'])){
    
	$string = strtolower($_REQUEST['term']);
 //   $sql = "select categoria, id from categorias WHERE activo = '1' AND LOWER(categoria) LIKE '%$string%' order by categoria"; 
 //	$res = $bd->query($sql);
	$sql2 = "select subcategoria, id, categoria from subcategorias WHERE activo = '1' AND LOWER(subcategoria) LIKE '%$string%' order by subcategoria";
	$res2 = $bd->query($sql2);
	$data = array();
	if($res2->num_rows != 0){
	   while($result = $res2->fetch_assoc())
		$data[] = array('label' => $result["subcategoria"] , 'value' => $result["id"] . '-' . $result["categoria"]);
    }
    echo json_encode($data);
	
}
die;  
?>