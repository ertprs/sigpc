<?php //Breno Cruvinel - breno.cruvinel09@gmail.com
//INCLUDES DE CONTROLE --->>>
include "../config/globalSession.php";//inicia sessao php
include "../config/globalVars.php";//vars padrao
include "../sys/langAction.php";//vars padrao
//INCLUDES DE CONTROLE ---<<<

//INICIAR ARQUIVO DE LINGUAGEM --->>>
$class_fLNG->loadFile(__FILE__);//incluir o arquivo de linguagem
//INICIAR ARQUIVO DE LINGUAGEM ---<<<

//var sessão valida servidor
$_SESSION["RE_".str_replace('.','',$_SERVER["SERVER_NAME"])] = date('dmY');

//verifica aviso de robô
if(isset($_GET["semrobo"])){ $semrobo = "0"; }else{ $semrobo = "1"; }
if($semrobo == "1"){
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#<?=$_GET["load"]?>").fadeOut();
});
</script>
<div style="font-size:9px; text-align:right;"><?=$class_fLNG->txt(__FILE__,__LINE__,'JÁ IDENTIFICAMOS QUE NÃO É UM ROBÔ')?> :)</div>
<?php
}else{//if($semrobo == "1"){



//prepara informações do captcha numerico
$n_captcha_leg = "LOG";
$n_captcha_url = "sys/seg/imgSeguraFIG.php?width=169&height=50&characters=5&id_leg=".$n_captcha_leg."&".time();
unset($_SESSION["codigo_SEG_".$server_leg], $_SESSION["time_SEG_".$server_leg]);
?>
<script type="text/javascript">
function displayReCaptcha<?=$n_captcha_leg?>(){
	$("#captcha_t<?=$n_captcha_leg?>").val('recaptcha');
	$("#displayCaptcha<?=$n_captcha_leg?>").hide();
	$("#displayReCaptcha<?=$n_captcha_leg?>").fadeIn();
	$("#<?=$_GET["load"]?>").fadeOut();
}
function displayCaptcha<?=$n_captcha_leg?>(){
	$("#captcha_t<?=$n_captcha_leg?>").val('captcha');
	$("#displayReCaptcha<?=$n_captcha_leg?>").hide();
	$("#displayCaptcha<?=$n_captcha_leg?> #segFig").val('');
	$("#displayCaptcha<?=$n_captcha_leg?>-img").prop('src','<?=$n_captcha_url?>');
	$("#displayCaptcha<?=$n_captcha_leg?>").fadeIn();
	$("#<?=$_GET["load"]?>").fadeOut();
}
$(document).ready(function(){
	$("#<?=$_GET["load"]?>").fadeOut();
});
</script>
<table border="0" align="center" cellpadding="0" cellspacing="0"><tr><td>
<div style=" width:100%; display:none;" id="displayReCaptcha<?=$n_captcha_leg?>">
<?php if(SYS_CONFIG_RECAPTCHA != ""){?>
<div id="displayReCaptcha<?=$n_captcha_leg?>">
  <div class="g-recaptcha" data-sitekey="<?=SYS_CONFIG_RECAPTCHA_SITEKEY?>" id="reCaptcha-sys"></div>
<script src="https://www.google.com/recaptcha/api.js?hl=pt-BR"></script>
<script type="text/javascript">
function verifReCaptcha(v_cont){ v_cont++;
	if($("#reCaptcha-sys").html().length > 100){
		$.doTimeout('vTimerCaptchaSYS');
		$("#<?=$_GET["load"]?>").fadeOut(1000);
	}else{
		$.doTimeout('vTimerCaptchaSYS', 500, function(){ verifReCaptcha(v_cont); });
	}
	if(v_cont >= 10){
		$.doTimeout('vTimerCaptchaSYS');
		displayCaptcha<?=$n_captcha_leg?>();		
	}
}
$.doTimeout('vTimerCaptchaSYS', 500, function(){ verifReCaptcha(0); });
</script>
    <div style="padding:1px; margin-top:3px; font-size:9px; background:#EEE; color:#666; width:70%; cursor:pointer;" onclick="displayCaptcha<?=$n_captcha_leg?>();"><i class="icon-random"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'ALTERA - VERIFICAR ROBÔ COM NÚMERO')?></div>
</div>
<?php }else{?>
<script type="text/javascript">
$.doTimeout('vTimerCaptchaSYS', 500, function(){ displayCaptcha<?=$n_captcha_leg?>(); });
</script>
<?php }//else{?>
</div>
<input name="captcha_t" id="captcha_t<?=$n_captcha_leg?>" type="hidden" value="captcha" />
<div style=" width:100%;" id="displayCaptcha<?=$n_captcha_leg?>">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="55%"><img src="<?=$n_captcha_url?>" style="border:#CCC 1px solid; width:100%; height:48px; cursor:pointer; margin:0;" id="displayCaptcha<?=$n_captcha_leg?>-img" onClick="displayCaptcha<?=$n_captcha_leg?>();" rel="tooltip" data-placement="top" data-original-title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Clique para gerar nova imagem')?>" /></td>
        <td width="45%"><input type="text" id='segFig' name='segFig' placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Imagem de segurança')?>" autocomplete="off" style="width:90%; height:40px; margin:0;" data-rule-required="true" data-rule-minlength="2"></td>
      </tr>
    </table>	
    <div style="padding:5px 5px 3px 5px; font-size:9px; text-align:center;"><?=$class_fLNG->txt(__FILE__,__LINE__,'INFORME A IMAGEM DE SEGURANÇA, PROVE QUE NÃO É UM ROBÔ!')?></div>
    <?php if(SYS_CONFIG_RECAPTCHA != ""){?><div style="padding:1px; margin-bottom:5px; font-size:9px; background:#EEE; color:#666; width:70%; cursor:pointer;" onclick="displayReCaptcha<?=$n_captcha_leg?>();"><i class="icon-random"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'ALTERA - VERIFICAR ROBÔ COM IMAGEM')?></div><?php }?>
</div>
</td></tr></table>
<?php


}//else{//if($semrobo == "1"){
	