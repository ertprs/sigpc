<?php // Breno Cruvinel - breno.cruvinel09@gmail.com

/*
<?php
//include de js dinamicos
$INC_JSTIPOS = ""; //busca os tipos de funcoes
$INC_JSCSS = "dinamic"; //pre da funcao css
include "../inc_jsDinamico.php";//inc dinamico
//$INC_JSCSS-pkdata
?>
*/


//pega os dados
if(!isset($INC_JSFORMID)){ $INC_JSFORMID = rand().time(); } //id de controle
if(!isset($INC_JSTIPOS)){ $INC_JSTIPOS = ""; } //busca os tipos de funcoes
if(!isset($INC_JSCSS)){ $INC_JSCSS = "dinamic"; } //pre da funcao css



        
?><script><?php




$var = ",pkcolor,";
if(preg_match("/$var/", $INC_JSTIPOS)){
?>
$(function(){
    $('.<?=$INC_JSCSS?>-pkcolor').colorpicker();
});
<?php
}//if (preg_match("/$var/", $INC_JSTIPOS)){














$var = ",pk,";
if(preg_match("/$var/", $INC_JSTIPOS)){
?>
$(function(){
    $('.<?=$INC_JSCSS?>-pkdata').click(function(){
		OBJETO_ID = $(this).next();
		OBJETO_ID.mobiscroll().date({
			theme: 'default',
			lang: 'pt-BR',
			display: 'bubble',
			mode: 'mixed',
			onClose: function(){ $.doTimeout( 'vTimerDiNMC', 100, function(){ OBJETO_ID.mobiscroll('destroy'); }); }
		}); 
        OBJETO_ID.mobiscroll('enable');
        OBJETO_ID.mobiscroll('show'); 
        return false;
    });
    $('.<?=$INC_JSCSS?>-pkhora').click(function(){
		OBJETO_ID = $(this).next();
		OBJETO_ID.mobiscroll().time({
			theme: 'default',
			lang: 'pt-BR',
			display: 'bubble',
			mode: 'mixed',
			onClose: function(){ $.doTimeout( 'vTimerDiNMC', 100, function(){ OBJETO_ID.mobiscroll('destroy'); }); }
		}); 
        OBJETO_ID.mobiscroll('enable');
        OBJETO_ID.mobiscroll('show'); 
        return false;
    });

});
<?php
}//if (preg_match("/$var/", $INC_JSTIPOS)){























$var = ",valor,";
if(preg_match("/$var/", $INC_JSTIPOS)){
?>
$(document).ready(function(){
//mascara de moedas
	$(".<?=$INC_JSCSS?>-valor").priceFormat({
	prefix: 'R$ ',
	centsSeparator: ',',
	thousandsSeparator: '.',
	clearPrefix: true
	});
	
//mascara de porcentagem
	$(".<?=$INC_JSCSS?>-porcent").priceFormat({
	prefix: '% ',
	centsSeparator: ',',
	thousandsSeparator: '',
	clearPrefix: true,
	limit: 5,
    centsLimit: 2
	});
	
//mascara de decimal em campos
	$(".<?=$INC_JSCSS?>-m4").priceFormat({
	prefix: 'M² ',
	centsSeparator: ',',
	thousandsSeparator: '',
	clearPrefix: true,
	limit: 6,
    centsLimit: 2
	});
});
<?php
}//if (preg_match("/$var/", $INC_JSTIPOS)){

























$var = ",numero,";
if(preg_match("/$var/", $INC_JSTIPOS)){
?>
function verificaNumero<?=$INC_JSCSS?>(e) {
	if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
		return false;
	}
}
$(document).ready(function() {
	$(".<?=$INC_JSCSS?>-numero").keypress(verificaNumero<?=$INC_JSCSS?>);
});
<?php
}//if (preg_match("/$var/", $INC_JSTIPOS)){














$var = ",alfanumeric,";
if(preg_match("/$var/", $INC_JSTIPOS)){
?>
	$('.<?=$INC_JSCSS?>-alfanumeric').keyup(function() {
		var $th = $(this);
		$th.val( $th.val().replace(/[^a-zA-Z0-9_-]/g, function(str) { alert('Não é permitido utilizar caracteres especiais como " ' + str + ' ".\n\nSomente letras e números.'); return ''; } ) );
	});
<?php
}//if (preg_match("/$var/", $INC_JSTIPOS)){











$var = ",select,";
if(preg_match("/$var/", $INC_JSTIPOS)){
?>
	$('.<?=$INC_JSCSS?>-select').select2();
<?php
}//if (preg_match("/$var/", $INC_JSTIPOS)){















?></script><?php



unset($INC_JSTIPOS,$INC_JSFORMID);
?>