<script>
$("#form-changuita-title").text("Nueva Changuita");
 function fade_in_cat_subcat(){
		 $("#changuita-categoria").val(0);
		 $('#changuita-subcategoria').prop('disabled', true);
		 $('#mySelect').empty().append('<option value="0">--- elegir ---</option>');
		 $("#changuita-subcategoria").val(0);
		 $("#cat-question").fadeOut("slow", function() {
		  
		 $( "#category-subcategory-container" ).fadeIn( "slow", function() {
				
		  });
		 }); 
 }
 
</script>


<script type="text/javascript">
$(function() {

	$("#subcat_cat_search").autocomplete({
			source: "search-categorias.php",
			open: function(event, ui) {
				$(this).autocomplete("widget").css({
					"width": 450
				});
				$(this).autocomplete("widget").css({
					"font-family": 'Amaranth'
				});
				$(this).autocomplete("widget").css({
					"font-size": "1.1em"
				});
			},
			minLength: 2,
			select: function(event, ui) {
				var compound = ui.item.value;
				var subcat_id =
				compound.substr(0, compound.indexOf('-')); 
				var cat_id = compound.substr(compound.indexOf('-') + 1); 
				$("#changuita-categoria").val(cat_id);
				$('#changuita-subcategoria').prop('disabled', false);
				$("#changuita-subcategoria").append('<option value='+subcat_id+'>'+ui.item.label+'</option>');
				$("#changuita-subcategoria").val(subcat_id);
				$("#subcat_cat_search").val(ui.item.label);
				return false;
			},
			change: function(event, ui) {
				if (ui.item == null) {
					$("#subcat_cat_search").css('border-color', 'red');
				} else {
					$("#subcat_cat_search").css('border-color', '');
					//$("#the-question").append('<i class="icon-question-sign"></i>'); ADD TICKS! 

				}
			}
		});
	
});
</script>

<div class="control-group fadein-2" id="cat-question" style="margin-bottom:50px; margin-top:30px;">
	<div class="" >
		<label class=""  style="text-align:center; font-size:45px;">&iquest;Qu&eacute; necesit&aacute;s hoy?</label>
	</div>
	<div class="" style="" id="the-question">
		<input id="subcat_cat_search" type="text" style="margin-left: 25%; width: 50% !important; margin-top:25px; text-align:center; font-weight: bold;  height:18%;" name="changuita" value="" placeholder="Escribilo ac&aacute;"/>
		<br>
		<div style="text-align:center">Si no lo encontr&aacutes,<a title="Ver categorias y subcategorias"  style="font-size: 1.1em" onclick="fade_in_cat_subcat()">
			   buscalo en nuestras opciones
		</a>
		</div>
	</div>
</div>

<div id="category-subcategory-container" style="display:none;">
	<div class="control-group">
		<label class="control-label">Categor&iacute;a</label>
		<div class="controls">
			<select name="categoria" id="changuita-categoria">
				<option value="0">--- elegir ---</option>
	<?php
	foreach($categoria as $k => $v) {
	?>
				<option value="<?php echo $k ?>"><?php echo $v ?></option>
	<?php
	}
	?>
				<option value="-1">&iquest;No encontr&aacute;s lo que busc&aacute;s?</option>
			</select>
			<a class="ayuda" title="Este campo es obligatorio."><i class="icon-question-sign"></i></a><span class="help-block"></span>
			<div id="ini-div-sugerir" class="hide">
				<input type="text" name="sugerir" id="ini-sugerir" value="" placeholder="Sugerinos la categor&iacute;a que falta" maxlength="100" />
				<button class="btn btn-primary" id="btn-sugerir">Sugerir</button>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">Subcategor&iacute;a</label>
		<div class="controls">
			<select name="subcategoria" id="changuita-subcategoria">
				<option value="0">--- elegir ---</option>
			</select>
			<a class="ayuda" title="Este campo es obligatorio. Primero ten&eacute;s que elegir una opci&oacute;n en el campo anterior."><i class="icon-question-sign"></i></a><span class="help-block"></span>
		</div>
	</div>
</div>
<p class="move-me-left ch-form-subtitle"><b>Informaci&oacute;n  </b><p>

<div class="control-group">
	<label class="control-label" for="titulo">T&iacute;tulo para la changuita</label>
	<div class="controls">
		<input type="text" id="titulo" placeholder="Ej: Profesor de historia" name="titulo" value="" maxlength="40" />
			<a class="ayuda" title="Este campo es obligatorio. Ingres&aacute; un texto breve (menos de 40 caracteres) que identifique r&aacute;pidamente tu changuita (m&aacute;s abajo te vamos a pedir una descripci&oacute;n m&aacute;s detallada). Por ej.: Profesor de historia."><i class="icon-question-sign"></i></a><span class="help-block"></span>
	</div>
</div>
<br>
<div class="control-group">
	<label class="control-label" for="descripcion">Descripci&oacute;n de la changuita</label>
	<div class="controls">
		<textarea id="descripcion" name="descripcion" maxlength="1000"></textarea><br/>
		<a class="ayuda" title="Este campo es obligatorio. M&aacute;ximo 1000 caracteres."><i class="icon-question-sign"></i></a><span class="help-block"></span>
	</div>
</div>
<br>
<p class="move-me-left ch-form-subtitle"><b>Ubicaci&oacute;n  </b><p>
<div class="control-group">
	<label class="control-label">Provincia/Zona </label>
	<div class="controls">
		<select style="width:50%;"name="localidad" id="changuita-localidad">
			<option value="0">--- elegir ---</option>
			<option value="-1">Se puede realizar desde cualquier lugar</option>
<?php
foreach($localidad as $k => $v) {
	$sel = "";
	if($k == $data["localidad"])
		$sel = "selected";
?>
			<option value="<?php echo $k ?>" <?php echo $sel ?>><?php echo $v ?></option>
<?php
}
?>
		</select>
		<a class="ayuda" title="Este campo es obligatorio."><i class="icon-question-sign"></i></a><span class="help-block"></span>
	</div>
</div>
<?php
$dis = "class='disabled' disabled='disabled'";
if(count($barriosIni) > 0)
	$dis = "";
?>
<div class="control-group">
	<label class="control-label">Localidad / Barrio</label>
	<div class="controls">
		<select name="barrio" id="changuita-barrio" <?php echo $dis ?>>
				<option value="0">--- elegir ---</option>
<?php
if(count($barriosIni) > 0) {
	foreach($barriosIni as $k => $v) {
		$sel = "";
		if($k == $data["barrio"])
			$sel = "selected";
?>
			<option value="<?php echo $k ?>" <?php echo $sel ?>><?php echo $v ?></option>
<?php
	}
}
?>
		</select>
		<a class="ayuda" title="Este campo es obligatorio. Primero ten&eacute;s que elegir una opci&oacute;n en el campo anterior."><i class="icon-question-sign"></i></a><span class="help-block"></span>
	</div>
</div>

<div class="control-group" style="display:none;">
	<label class="control-label" for="palabras">Palabras clave</label>
	<div class="controls">
		<input type="text" id="palabras" name="palabras" value="" class="span4" />
			<a class="ayuda" title="Ingres&aacute; algunas palabras (separadas por comas) para ayudar a los dem&aacute;s a encontrar tu changuita."><i class="icon-question-sign"></i></a><span class="help-block"></span>
	</div>
</div>
<p class="move-me-left ch-form-subtitle"><b>D&iacute;as y Horarios </b><p>
<div class="control-group">
	<label class="control-label" for="cuando">&iquest;Cu&aacute;ndo hay que hacer la changuita?</label>
	<div class="controls">
		<label><input type="radio" id="cuando1" name="cuando" value="1" checked="checked" /> En cualquier momento, a combinar</label>
		<label><input type="radio" id="cuando2" name="cuando" value="2" /> Solo los d&iacute;as de la semana que elija</label>
			<div class="controls hide">
				<p class="cuando-dias"><button class="btn-link btn-cuando-lav">Lunes a viernes</button></p>
<?php
foreach($dias as $k => $v) {
?>
				<label><input type="checkbox" id="cuando_dias<?php echo $k ?>" name="cuando_dias[]" value="<?php echo $k ?>" /> <?php echo $v ?></label>
<?php
}
?>
				<div class="clearfix"></div>
				<span class="help-block"></span>
			</div>
		<label><input type="radio" id="cuando3" name="cuando" value="3" /> Un d&iacute;a espec&iacute;fico</label>
			<div class="controls hide">
				<input type="text" id="cuando_fecha" name="cuando_fecha" value="" maxlength="10" class="datepicker" />
				<a class="ayuda" title="Este campo es obligatorio. Debe ser una fecha en formato dd/mm/aaaa. No puede ser porsterior a un mes a partir de hoy."><i class="icon-question-sign"></i></a><span class="help-block"></span>
			</div>
	</div>
</div>
<div class="control-group">
	<label class="control-label">&iquest;En qu&eacute; horario?</label>
	<div class="controls">
		Entre las <select name="desde_hora" class="span1">
			<option value="-1"></option>
<?php
foreach($horas as $v) {
	if($v < 10)
		$v = "0".$v;
?>
			<option value="<?php echo $v ?>"><?php echo $v ?></option>
<?php
}
?>
		</select> : <select name="desde_minuto" class="span1">
<?php
for($i=0;$i<6;$i++) {
	$min = $i*10;
	if($min < 10)
		$min = "0".$min;
?>
			<option value="<?php echo $min ?>"><?php echo $min ?></option>
<?php
}
?>
		</select> hs
		y las <select name="hasta_hora" class="span1">
			<option value="-1"></option>
<?php
foreach($horas as $v) {
	if($v < 10)
		$v = "0".$v;
?>
			<option value="<?php echo $v ?>"><?php echo $v ?></option>
<?php
}
?>
		</select> : <select name="hasta_minuto" class="span1">
<?php
for($i=0;$i<6;$i++) {
	$min = $i*10;
	if($min < 10)
		$min = "0".$min;
?>
			<option value="<?php echo $min ?>"><?php echo $min ?></option>
<?php
}
?>
		</select> hs
		<span class="help-block"></span>
	</div>
</div>
<p class="move-me-left ch-form-subtitle"><b>Precio </b><p>
<div class="control-group">
	<label class="control-label" for="precio">&iquest;Cu&aacute;nto quer&eacute;s pagar por la changuita?<br /><small>En pesos argentinos</small></label>
	<div class="controls">
		<div class="input-prepend">
			<span class="add-on">$</span><input type="text" class="input-mini" id="precio" name="precio" value="" maxlength="5" />
		</div>
		<a class="ayuda" title="Este campo es obligatorio. Ingres&aacute; un n&uacute;mero entero, sin centavos. No uses punto, coma ni el signo de pesos. Por ej.: 1234."><i class="icon-question-sign"></i></a><p id="precio-sugerido"></p><span class="help-block"></span>
	</div>
</div>
<p class="move-me-left ch-form-subtitle"><b>Servicio </b><p>

<div class="control-group">
	<label class="control-label control-label-sin-margen"><small>Eleg&iacute; qu&eacute; servicio de SoloChanguitas quer&eacute;s contratar</small></label>
	<div class="controls">
<?php
if($balance > 0) {
?>
		<div class="alert alert-success alert-balance">Record&aacute; que ten&eacute;s $<?php echo $balance ?> de cr&eacute;dito para usar en cualquiera de los planes.</div>
<?php
}
foreach($plan as $k => $v) {
	$bonificado = "";
	$sel = "";
	if($k == 1) {
		$sel = "checked = 'checked'";
		// if($gratis < ChGratis) {
		// 	if(ChGratis - $gratis == 1)
		// 		$bTxt = " <strong>1</strong> publicaci&oacute;n bonificada";
		// 	else
		// 		$bTxt = "n <strong>".(ChGratis - $gratis)."</strong> publicaciones bonificadas";
		// 	$bonificado = " &iexcl;Pod&eacute;s contratar ".ChGratis." veces el servicio b&aacute;sico de SoloChanguitas en forma gratuita! Te queda".$bTxt.".<br/><label><input type='checkbox' name='plan' id='plan4' value='4' /> Usar bonificaci&oacute;n y publicar GRATIS</label>";
		// }
		// else
		// 	$bonificado = " Ya usaste tus ".ChGratis." publicaciones gratuitas.";
	}
?>
		<label class="plan<?php echo $k ?>">
			<input type="radio" id="plan<?php echo $k ?>" name="plan" value="<?php echo $k ?>" <?php echo $sel ?> />
			<div class="plan-nombre"><?php echo $v . " ";  ?> <?php for ($i = 1; $i <= $k; $i++){echo '<span class="icon-star"/>';}?></div>
			<div class="plan-descripcion"><?php echo $planDescripcion[$k] ?></div>
			<div <?php if($k == 1) echo 'class="plan-precio-destacado"'; else echo 'class="plan-precio"';?>> <?php if($planPrecio[$k] == 0) echo "GRATIS"; else echo "$" . $planPrecio[$k] . ",00"; ?></div>
		</label>
<?php
}
?>
		<span class="help-block"></span>
		<div class="center"><img src="http://imgmp.mlstatic.com/org-img/banners/ar/medios/785X40.jpg" title="MercadoPago - Medios de pago" alt="MercadoPago - Medios de pago" class="imgMP" /></div>
	</div>
</div>
<p class="vence-default">Todas las changuitas se mantienen publicadas por un mes como m&aacute;ximo. Por lo tanto, si no eleg&iacute;s un postulante antes, vencer&aacute; el <?php echo $unMes ?>.</p>
<p class="vence-fecha hide">Esta changuita se mantendr&aacute; publicada hasta el d&iacute;a que definiste como el que hay que hacer la changuita. <span id="vence"></span></p>
<p><strong>Garant&iacute;a de satisfacci&oacute;n</strong>: si elegiste un plan pago y la changuita no se realiza o si vence y no ten&eacute;s ning&uacute;n postulante, el dinero que pagaste al momento de publicar se te devolver&aacute; en forma de cr&eacute;dito para que uses dentro del sitio.</p>
<p style="display:none"><strong>Importante</strong>: si elegiste un plan pago, al hacer click en el bot&oacute;n <em>Publicar la changuita</em> te vamos a mostrar las opciones de pago. Si no complet&aacute;s el proceso de pago, la changuita se publicar&aacute; igual y el monto a pagar se te computar&aacute; como deuda.</p>
<div class="form-actions">
	<button class="btn btn-info btn-large" id="boton-submit-nueva">Publicar la changuita</button>
	<span class="help-inline text-error" id="validar"></span>
</div>
