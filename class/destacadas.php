<?php

class Destacadas {

    protected $bd;

    public function __construct() {
        $this->bd = conectar();
    }

    public function mostrar($plan, $cat = 0) {
        $sql = "select plan from planes where id = $plan";
        $res = $this->bd->query($sql);
        $fila = $res->fetch_assoc();
        $titPlan = $fila["plan"];
        $titCat = "";
        if ($cat > 0) {
            $sql = "select categoria from categorias where id = $cat";
            $res = $this->bd->query($sql);
            $fila = $res->fetch_assoc();
            $titCat = " en <em>" . $fila["categoria"] . "</em>";
        }
        $html = "<h4 class='inicio-destacadas'><span>Changuitas destacadas$titCat</span></h4>";
        $filtroCat = "";
        if ($cat > 0)
            $filtroCat = "and ch.categoria = $cat";
        $sql = "select ch.id, ch.titulo, ch.precio, cat.categoria, subcat.subcategoria from changuitas as ch left join categorias as cat on cat.id = ch.categoria left join subcategorias as subcat on subcat.id = ch.subcategoria where ch.activo = '1' and ch.estado = '0' and ch.vencida = '0' and ch.plan = $plan $filtroCat order by rand()";
        $res = $this->bd->query($sql);
        if ($res->num_rows == 0)
            return;
        $html .= "<div class='destacadas-cont givemefont'><div class='destacadas' id='d$plan-$cat'>";
        while ($fila = $res->fetch_assoc()) {
            if ($cat == 0)
                $categoria = "<h6>" . $fila["categoria"] . " &gt " . $fila["subcategoria"] . "</h6>";
            else
                $categoria = "<h6>" . $fila["subcategoria"] . "</h6>";
            $html .= "<div class='destacada' data-changuita-id='" . $fila["id"] . "'>$categoria<h5 style='margin-left:10px'>" . $fila["titulo"] . " </h5><span class='precio'>$" . $fila["precio"] . "</span><a class='ver-mas givemefont' href='#/changuita|" . $fila["id"] . "' rel='address:/changuita|" . $fila["id"] . "' data-changuita-id='" . $fila["id"] . "' data-changuita-plan='$plan'><img style='width: 35%;margin-top: -6%;' src='./img/icons/task.png'></img> </a></div>";
        }
        $html .= "</div><button class='carousel-prev' id='carousel-prev-$plan-$cat'></button><button class='carousel-next' id='carousel-next-$plan-$cat'></button></div>
<script>

$('#d$plan-$cat').carouFredSel({
	width: '100%',
	height: '100%',
	responsive: true,
	items: {
		visible: 2,
		minimum: 2
	},
	scroll: {
		items: 1,
		pauseOnHover: true
	},
	auto: {
		timeoutDuration: 5000
	},
	prev: {
		button: '#carousel-prev-$plan-$cat',
		key: 'left'
	},
	next: {
		button: '#carousel-next-$plan-$cat',
		key: 'right'
	}
});
var timerDest = setTimeout('updateDestSize()', 500);
function updateDestSize() {
	$('.destacadas').trigger('updateSizes');
	console.log('carouFredSel: updating sizes [la]');
        $('.caroufredsel_wrapper').css('height', '155px');
}

</script>";
		$html .= "<span class='inicio-destacadas'>
		<a class='ayuda' title='Cuando public&aacute;s una changuita, pod&eacute;s contratar el servicio " 
		. strtoupper($titPlan) . " para que aparezca ac&aacute;. 
		Si ya la publicaste, pod&eacute;s editarla y agregarle este servicio.'>
		
		&iquest;C&oacute;mo hago para que mi changuita aparezca ac&aacute;?
		</a></span>";
        return $html;
    }

}

?>