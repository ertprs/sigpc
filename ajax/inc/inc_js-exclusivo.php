<?php //Breno Cruvinel - breno.cruvinel09@gmail.com
//valida pagina se aberto separadamente
include "valida_pagina_sem_quadro.php";



/*

<?php

/////////// INCLUDE JS EXCLUSIVO --------------------- <?=$INC_FAISHER["div"]?>-icheck
$INC_JS = ",icheck,";//informar funcao a usar entre VIRGULAS > ,funcao
$INC_JSCSS = $INC_FAISHER["div"];
include "inc/inc_js-exclusivo.php";



?>
*/



//pega os dados
if(!isset($INC_JSID)){ $INC_JSID = rand().time(); } //id de controle
if(!isset($INC_JS)){ $INC_JS = ""; } //busca os tipos de funcoes
if(!isset($INC_JSCSS)){ $INC_JSCSS = "dinamic"; } //pre da funcao css




?>
<script>
//TIMER
$.doTimeout('vTimerJS<?=$INC_JSID?>', 0, function(){
<?php
///////////////////////////////////////////////////////////// TIMER INI #########################################################






$var = ",icheck,";
if(preg_match("/$var/", $INC_JS)){
?>
	if($(".<?=$INC_JSCSS?>-icheck").length > 0){
		$(".<?=$INC_JSCSS?>-icheck").each(function(){
			var $el = $(this);
			var skin = ($el.attr('data-skin') !== undefined) ? "_"+$el.attr('data-skin') : "",
			color = ($el.attr('data-color') !== undefined) ? "-"+$el.attr('data-color') : "";
			var opt = {
				checkboxClass: 'icheckbox' + skin + color,
				radioClass: 'iradio' + skin + color,
				increaseArea: "10%"
			}
			$el.iCheck(opt);
		});
	}	
<?php
}//if (preg_match("/$var/", $INC_JS)){

















///////////////////////////////////////////////////////////// TIMER INI #########################################################
?>
});//TIMER
<?php



























?>
</script>
<?php


unset($INC_JS,$INC_JSID);