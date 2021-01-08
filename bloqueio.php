<?php // Breno Cruvinel - breno.cruvinel09@gmail.com
//INCLUDES DE CONTROLE --->>>
include "config/globalSession.php";//inicia sessao php
include "config/globalVars.php";//vars padrao
include "sys/langAction.php";//inicia arquivo de linguage

include "sys/globalFunctions.php";//funcoes padrao

include "sys/globalClass.php";//classes padrao
include "sys/classConexao.php";//classes de conexao
include "sys/incUpdate.php";//verificador de updates
include "config/incPacote.php";//vars do pacote de cliente
include "sys/classValidaAcesso.php";//classes de validação de acesso
//include "sys/cabecalho_ajax.php";//classes de conexao
//INCLUDES DE CONTROLE ---<<<

//INICIAR ARQUIVO DE LINGUAGEM --->>>
$class_fLNG->loadFile(__FILE__);//incluir o arquivo de linguagem
//INICIAR ARQUIVO DE LINGUAGEM ---<<<


	
//INICIAR CLASSES DE CONTROLE --->>>
//conexao DB
$classe_db = new classe_DB;//inicia a classe de conexao
$classe_db->AbreConexaoPai();//Abrimos a conexão Pai
$cMSG = new classMSG();//inicia a classe de mensagens
//INICIAR CLASSES DE CONTROLE ---<<<


//CLASSES PROTEGE PAGINA/LOGIN --->>>
//protege a pagina
$cVLogin = new classVLOGIN;//inicia a classe de login
$cVLogin->loginCookie("OFF");//verifica o login e cria array de login
$cVLogin->loginSession("bloqueio","OFF");//faz a atualização de session do login atual
$cVLogin->loginVerificaSenhaExpirou();//verifica se a senha de login expirou, redireciona para página de alteração
//CLASSES PROTEGE PAGINA/LOGIN ---<<<


//INCLUDE FAISHER, CONTROLE DE ARQUIVOS
$SYS_VALIDASEMQUADRO = "Jesus te Ama!";





//receber GEOLOCALIZAÇÃO
if(isset($_POST["verGeo"])){
	$contRet = $cVLogin->selecionarGeo();//verifica se atualiza geo
}//if(isset($_POST["verGeo"])){




//receber TOKEN SMS
if(isset($_POST["token"])){
	$confiavel = getpost_sql($_POST["confiavel"]);
	$token = getpost_sql($_POST["token"]);
	if($_SESSION["tokenSeg"] == date('dmY-').$cVLogin->getVarLogin("SYS_USER_ID")){
		$contRet = $cVLogin->selecionaTokenAcesso($token,$confiavel);//verifica token SMS
		if($contRet >= "1"){
			echo "<script>window.location='./';</script>";
			exit(0);
		}else{//if($contRet >= "1"){
?>
<script type="text/javascript">
$.doTimeout('vTimerMsgTk', 0, function(){
	exibNotificacao("TOKEN INCORRETO!","Token TORPEDO/SMS de Acesso informado está incorreto, informe novamente!",15000);
	$("#msg_verifica").html('Token TORPEDO/SMS de Acesso informado está incorreto, informe corretamente!');
});//TIMER
</script>
<?php
		}//else{//if($contRet >= "1"){
	}else{ echo "<script>window.location='?';</script>"; exit(0); }
	exit(0);
}//if(isset($_POST["token"])){












//busca informações da tela de bloqueio
$arrExpediente = $cVLogin->loginExpediente();//retorna array de informações
//print_r($arrExpediente);
//se está ativo redireciona
if($arrExpediente["status"] == "ativo"){
	echo "<script>window.location='./';</script>";	
	exit(0);	
}







//atualiza página GEOLOCALIZAÇÃO
if(isset($_POST["verGeo"])){
	//caso só a geo localização não for suficiente para liberação, faz um leoad da página
	if($arrExpediente["status"] != "ativo"){
		echo "<script>window.location='?';</script>";
		exit(0);	
	}
}//if(isset($_POST["verGeo"])){







if(($arrExpediente["tela"] == "token") and (isset($_POST["reenviatoken"]))){
	//envia SMS e pega numero de celular do cadastro
	$celRet = $cVLogin->enviarTokenAcesso();
}//if($arrExpediente["tela"] == "token"){








//destroe variavel tokenSeg
unset($_SESSION["tokenSeg"]);



?>
<!doctype html>
<html><head>
<?php

//include HEAD html
include "index_head.php";//classes de conexao

?>

<script>
$(document).ready(function() {
	loaderFoco('content','div_principalContent_loadD','<?=$class_fLNG->txt(__FILE__,__LINE__,'XXXX')?>Verificando...');
	if(getCookieF('SYS_LOGIN_BLOQ') != "0"){ setCookieF('SYS_LOGIN_BLOQ', '<?=time()+300?>'); }
});
</script>
</head>

<body class="<?php if((fGERAL::getKookies("CONF_BODY_COLOR")) and (fGERAL::getKookies("CONF_BODY_COLOR") != "")){ echo fGERAL::getKookies("CONF_BODY_COLOR"); }else{ echo 'theme-satgreen';}?>">
	<div id="navigation">
		<div class="container-fluid">
			<a href="pacote.php" id="brand"><!-- LOGO --></a>
			<ul class='main-nav' id="menu_principalTop">
				<li class='active' id="li_topInicio">
					<a href="?">
						<span>Bloqueio de Acesso</span>
					</a>
				</li>
				<li>
					<a href="#" onClick="alert('Verifique as informações abaixo para liberar seu acesso!');">
						<span>SESSÃO FINALIZA EM > <span style="font-weight:bold;" id="tMin">04</span> min e  <span style="font-weight:bold;" id="tSeg">59</span> seg</span>
					</a>
				</li>



			</ul>
			<div class="user">
				<ul class="icon-nav">
					<li class='dropdown colo'>
						<a href="#" class='dropdown-toggle' data-toggle="dropdown"><i class="icon-tint"></i></a>
						<ul class="dropdown-menu pull-right theme-colors">
							<li class="subtitle">
								Cor das janelas
							</li>
							<li>
								<span class='red'></span>
								<span class='orange'></span>
								<span class='green'></span>
								<span class="brown"></span>
								<span class="blue"></span>
								<span class='lime'></span>
								<span class="teal"></span>
								<span class="purple"></span>
								<span class="pink"></span>
								<span class="magenta"></span>
								<span class="grey"></span>
								<span class="darkblue"></span>
								<span class="lightred"></span>
								<span class="lightgrey"></span>
								<span class="satblue"></span>
								<span class="satgreen"></span>
							</li>
						</ul>
					</li>
				</ul>
				<div class="dropdown">
					<a href="#" class='dropdown-toggle' data-toggle="dropdown"><?=sentenca(primeiro_nome($cVLogin->getVarLogin("SYS_USER_NOME")))?> <img src="img.php?<?=$cVLogin->imgUser($cVLogin->getVarLogin("SYS_USER_ID"), "27", "27")?>" class="sys_imgPerfil" alt=""></a>
					<ul class="dropdown-menu pull-right">
						<li>
							<a href="login.php?<?=$class_fLNG->txt(__FILE__,__LINE__,'sair')?>=1">Sair do Sistema</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid" id="content">
		
		<div id="main">
        
        
<?php















//----------------------------------------------------------------------- TELA DE HORAS -------------------------------------------------------------->>>>
if($arrExpediente["tela"] == "hora"){
?>
<script type="text/javascript">
$.doTimeout('vTimerMsg', 3000, function(){
	exibNotificacao("ACESSO FORA DO EXPEDIENTE!","<?=$arrExpediente["msg"]?>",15000);
});//TIMER
</script>
			<div class="container-fluid">            
				<div class="page-header">
					<div class="pull-left">
						<h1 id="titulo_principal"><i class="icon-angle-right"></i> O seu acesso ao perfil está bloqueado por horários:</h1>
					</div>					
				</div>
				<div class="page-header" id="divPacote"> </div>
                
				<div class="row-fluid" style="min-height:400px;" id="div_principalContent">
					<!-- conteudo principal -->
			       <div class="principalContent" id="content_In-home">
                 
				<div class="row-fluid">
					<div class="span9">
								<ul class="stats" style="width:95%;">
									<li class='orange' style="width:95%;">
										<i class="icon-time"></i>
										<div class="details">
											<span class="big" style="font-weight:bold;"><?=$arrExpediente["msg"]?></span>
											<span>Contate o administrador de seu departamento para gestão de acessos!</span>
										</div>
									</li>
								</ul>
					</div>
				</div>
                <div style="height:50px;"></div>
              
                   
                   </div>

				</div>
			</div><!-- End: .container-fluid -->
<?php

}//fim if TELA
//----------------------------------------------------------------------- TELA DE HORAS --------------------------------------------------------------<<<<













?>
<?php














//----------------------------------------------------------------------- TELA DE IP -------------------------------------------------------------->>>>
if($arrExpediente["tela"] == "ip"){
?>
<script type="text/javascript">
$.doTimeout('vTimerMsg', 3000, function(){
	exibNotificacao("ACESSO FORA DA REDE!","<?=$arrExpediente["msg"]?>",15000);
});//TIMER
</script>
			<div class="container-fluid">            
				<div class="page-header">
					<div class="pull-left">
						<h1 id="titulo_principal"><i class="icon-angle-right"></i> O seu acesso ao perfil é fixo a uma rede:</h1>
					</div>					
				</div>
				<div class="page-header" id="divPacote"> </div>
                
				<div class="row-fluid" style="min-height:400px;" id="div_principalContent">
					<!-- conteudo principal -->
			       <div class="principalContent" id="content_In-home">
                 
				<div class="row-fluid">
					<div class="span9">
								<ul class="stats" style="width:95%;">
									<li class='orange' style="width:95%;">
										<i class="icon-wrench"></i>
										<div class="details">
											<span class="big" style="font-weight:bold;"><?=$arrExpediente["msg"]?></span>
											<span>Contate o administrador de seu departamento para gestão de acessos!</span>
										</div>
									</li>
								</ul>
					</div>
				</div>
                <div style="height:50px;"></div>
              
                   
                   </div>

				</div>
			</div><!-- End: .container-fluid -->
<?php

}//fim if TELA
//----------------------------------------------------------------------- TELA DE IP --------------------------------------------------------------<<<<















?>
<?php














//----------------------------------------------------------------------- TELA DE GEOLOCALIZAÇÃO -------------------------------------------------------------->>>>
if($arrExpediente["tela"] == "geo"){
?>
<script type="text/javascript">
$.doTimeout('vTimerMsg', 3000, function(){
	exibNotificacao("ACESSO SEM LOCALIZAÇÃO!","<?=$arrExpediente["msg"]?>",15000);
});//TIMER


//geo
function pegaLocal() {
	setCookieF('SYS_GEO_DATA', '');
	$('.esconde_tudo').hide();
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(locationSuccess, locationFail);
		$('#ajustaMsgLocal').show("slow");
    }else{ $('#ePOSITION_UNAVAILABLE').fadeIn(); }
}
function locationSuccess(position) {
	$('.esconde_tudo').hide();
	latitude = position.coords.latitude;
	longitude = position.coords.longitude;
	$('#geoData').html(latitude+','+longitude);
	setCookieF('SYS_GEO_DATA', latitude+','+longitude);
	faisher_ajax('div_oculta', '0', 'bloqueio.php', 'verGeo=on','post');
 }
function locationFail(erro) {
	$('.esconde_tudo').hide();
    switch(erro.code) 
    {
      case erro.PERMISSION_DENIED:
        $('#ePERMISSION_DENIED').fadeIn();
      break;
      case erro.POSITION_UNAVAILABLE:
        $('#ePOSITION_UNAVAILABLE').fadeIn();
      break;
      case erro.TIMEOUT:
        $('#ePOSITION_UNAVAILABLE').fadeIn();
      break;
      case erro.UNKNOWN_ERROR:
        $('#ePOSITION_UNAVAILABLE').fadeIn();
      break;
    }
}
$.doTimeout('vTimerGeo', 500, function(){ pegaLocal(); });//TIMER
</script>
			<div class="container-fluid">            
				<div class="page-header">
					<div class="pull-left">
						<h1 id="titulo_principal"><i class="icon-angle-right"></i> O seu acesso ao perfil é obrigatório compartilhar sua localização:</h1>
					</div>					
				</div>
				<div class="page-header" id="divPacote"> </div>
                
				<div class="row-fluid" style="min-height:400px;" id="div_principalContent">
					<!-- conteudo principal -->
			       <div class="principalContent" id="content_In-home">

				<div class="row-fluid">
					<div class="span9">
<div id="ajustaMsgLocal" class="esconde_tudo" style="width:95%; background:#368ee0; text-align:center; color:#FFF; font-size:18px; display:none; cursor:pointer;" onClick="pegaLocal();">
	<div style="padding:20px;">
	<i class="icon-hand-up" style="font-size:50px;"></i> <b>OLÁ!</b> IMPORTANTE: PARA QUE TENHA ACESSO AO SISTEMA<br>VOCÊ DEVE <b>PERMITIR</b> SEU NAVEGADOR COMPARTILHAR LOCALIZAÇÃO.
    <div style="font-size:12px;">*CLIQUE EM PERMITIR ACIMA, CASO A MENSAGEM NÃO APARECA, ATUALIZE SUA PÁGINA NOVAMENTE (F5)! SE BLOQUEOU A LOCALIZAÇÃO, DEVE ACESSAR AS CONFIGURAÇÕES DO NAVEGADOR.</div>
    </div>
</div>
					</div>
				</div>
                <div style="height:50px; clear:both;"></div>
    
				<div class="row-fluid">
					<div class="span9">
								<ul class="stats" style="width:95%;">
									<li class='orange' style="width:95%;">
										<i class="icon-map-marker"></i>
										<div class="details">
											<span class="big" style="font-weight:bold;"><?=$arrExpediente["msg"]?><br>*ISSO É NECESSÁRIO PARA LIBERAÇÃO DE SEU ACESSO!</span>
											<span><b>Veja abaixo como pode liberar o acesso</b> ou Contate o administrador de seu departamento para gestão de acessos!</span>
										</div>
									</li>
								</ul>
					</div>
				</div>
                <div style="height:50px; clear:both;"></div>
                 
				<div class="row-fluid esconde_tudo" style="display:none;" id="ePERMISSION_DENIED">
					<div class="span9">
								<ul class="stats" style="width:95%;">
									<li class='lightred' style="width:95%;">
										<i class="icon-warning-sign"></i>
										<div class="details">
											<span class="big" style="font-weight:bold;">VOCÊ NEGOU SEU NAVEGADOR COMPARTILHAR SUA LOCALIZAÇÃO!<br>
                                            Deverá acessar as configurações de seu navegador e remover está página do bloqueio, logo após atualizar a página (F5) para verificação.
                                            <br>*Caso não saiba como fazer para desbloquear, <a href="https://www.google.com.br/search?q=como+compartilhar+minha+localizacao+<?=ver_navegador("",1)?>&oq=como+compartilhar+minha+localizacao+<?=ver_navegador("",1)?>" target="_blank" class="btn">CLIQUE AQUI</a> e faça uma pesquisa na internet sobre o assunto.</span>
											<span>Ao acessar o sistema foi bloqueado a solicitação de localização, deve permitir para liberarmos seu acesso!</span>
										</div>
									</li>
								</ul>
					</div>
                <div style="height:50px; clear:both;"></div>
				</div>
                 
				<div class="row-fluid esconde_tudo" style="display:none;" id="ePOSITION_UNAVAILABLE">
					<div class="span9">
								<ul class="stats" style="width:95%;">
									<li class='lightred' style="width:95%;">
										<i class="icon-warning-sign"></i>
										<div class="details">
											<span class="big" style="font-weight:bold;">SUA LOCALIZAÇÃO NÃO ESTÁ DISPONÍVEL!<br>
                                            Sua localização não está disponível, verifique suas configurações de privacidade.
                                            <br>*Caso seu navegador não permita o recurso, <a href="https://www.google.com.br/search?q=navegador+compartilhar+minha+localizacao&oq=navegador+compartilhar+minha+localizacao" target="_blank" class="btn">CLIQUE AQUI</a> e faça uma pesquisa na internet sobre o assunto.</span>
											<span>Seus sistema atual não está disponibilizando sua localização utilizando HTML5!</span>
										</div>
									</li>
								</ul>
					</div>
                <div style="height:50px; clear:both;"></div>
				</div>
                 
              
                   
                   </div>

				</div>
			</div><!-- End: .container-fluid -->
<?php

}//fim if TELA
//----------------------------------------------------------------------- TELA DE GEOLOCALIZAÇÃO --------------------------------------------------------------<<<<















?>
<?php














//----------------------------------------------------------------------- TELA DE TOKEN SMS -------------------------------------------------------------->>>>
if($arrExpediente["tela"] == "token"){
	//envia SMS e pega numero de celular do cadastro
	$celRet = $cVLogin->enviarTokenAcesso();
	$_SESSION["tokenSeg"] = date('dmY-').$cVLogin->getVarLogin("SYS_USER_ID");
    //id temp para registro de array
    $array_temp = time().rand(9,99999).$cVLogin->getVarLogin("SYS_USER_ID");
	$formChave = "formVisualizaPincipal".$array_temp;
	
	
	//esconde numero de celular
	$rest = substr($celRet, 0, 12);
	$celular_leg = str_replace($rest, "(**) ****-**", $celRet);
?>
<script type="text/javascript">
$.doTimeout('vTimerMsg', 3000, function(){
	exibNotificacao("TOKEN TORPEDO/SMS DE ACESSO!","Foi enviado um Token TORPEDO/SMS para seu celular, verifique e informe abaixo.",15000);
});//TIMER
</script>
			<div class="container-fluid">            
				<div class="page-header">
					<div class="pull-left">
						<h1 id="titulo_principal"><i class="icon-angle-right"></i> O computador atual não foi definido como confiável:</h1>
					</div>					
				</div>
				<div class="page-header" id="divPacote"> </div>
                
				<div class="row-fluid" style="min-height:400px;" id="div_principalContent">
					<!-- conteudo principal -->
			       <div class="principalContent" id="content_In-home">
                 
				<div class="row-fluid">
					<div class="span9">
								<ul class="stats" style="width:95%;">
									<li class='orange' style="width:95%;">
										<i class="icon-mobile-phone"></i>
										<div class="details">
											<span class="big">
											<b>TOKEN TORPEDO/SMS DE ACESSO ATIVO EM SEU EXPEDIENTE!</b><br>
											<?=$arrExpediente["msg"]?><br>
                                            Verifique o envio do Tokem TORPEDO/SMS para liberar o acesso.</span>
											<span>Está ativo a utilização de Token TORPEDO/SMS de acesso!</span>
										</div>
									</li>
								</ul>
					</div>
				</div>
                <div style="height:20px; clear:both;"></div>
                 
                 
                 
                 

				<div class="row-fluid">
					<div class="span9">

						<div class="box box-color box-bordered" style="width:95%;">
							<div class="box-title">
								<h3>
									<i class="icon-exclamation-sign"></i>
									ENVIO DE TOKEN TORPEDO/SMS DE ACESSO
								</h3>
							</div>
							<div class="box-content nopadding">

                <div style="height:20px; clear:both;"></div>
                            
<form id="<?=$formChave?>" name="<?=$formChave?>" action="#" method="POST" class='form-horizontal form-column form-bordered form-validate' enctype='multipart/form-data' onsubmit="return false;">
	<div style="padding:0; text-align:center; min-height:155px;">
    	<img src="img/fig_sms.png" width="245" height="154" alt="TORPEDO/SMS" id="fig_sms"/>
        <button type="button" class="btn btn-primary btn-large" onclick="reenviaToken();return false;" style="font-size:46px; padding:40px; display:none;" id="bt_reenviasms"><i class="icon-external-link" style="font-size:36px;"></i> REENVIAR</button>
    </div>
    <div style="text-align:center; padding:2px;">
    	Uma mensagem de texto com seu token de acesso acabou de ser enviada para <?=$celular_leg?>
     </div>
    <div style="padding:2px; max-width:500px; margin: 0 auto;">
    	<div class="span3" style="border:0;">
        	<div style="font-size:60px; padding:30px 20px 0px 0px; text-align:right;" id="div_time"><i class="icon-time" style="font-size:36px;"></i></div>
        </div>
    	<div class="span9" style="border:0;">
    		<h6>ENVIANDO TORPEDO/SMS AGORA, VERIFIQUE O CELULAR</h6>
        	<div class="progress progress-striped" style="border:#D0D0D0 1px solid; width:300px;"><div class="bar" style="width:2px;" id="div_bar"></div></div>
        </div>
     </div>
  <div style="font-size:20px; text-align:center; padding:2px; font-weight:bold; clear:both;" id="div_leg">Mantenha o celular em mãos e informe o token TORPEDO/SMS recebido!</div>
    <div style="text-align:center; padding:2px;">
    	Ao receber a mensagem informe abaixo e clique em Confirmar Token Recebido.
     </div>
    
    <style>
	.css_confiavel{ padding:10px; margin:auto; max-width:480px; background:#F5F5F5; }
	.css_confiavel:hover{ padding:10px; margin:auto; max-width:480px; background:#ECECEC; }
	</style>
    <div class="css_confiavel">
        <div style="margin:auto; max-width:330px; text-align:center;">
            <div class="check-line"><input name="pcSeguro" type="checkbox" class='icheck' id="pcSeguro" value="1" data-skin="square" data-color="blue"> <label class='inline' for="pcSeguro">DEFINIR ESSE COMPUTADOR COMO <B>SEGURO</B><br>(não solicita token sms nesse computador)</label></div>
        </div>
    </div>
    
    <div style="padding:10px 10px 50px 10px; text-align:center;">
        
        
            <img src="img/ajax-qloader-preto-p.gif" rel="tooltip" data-original-title="Aguarde, carregando dados..." width="18" height="18" style="display:none;" id="div_tokem_load" />
			  <div class="input-prepend"><span class="add-on glyphicon-iphone"></span>
				<input name="tokenSms" type="text" class="input-large" id="tokenSms" placeholder="Informe Token Nº de 6 dígitos" value="">
			  </div>
                 <button type="button" class="btn btn-primary btn-medium" onclick="confirmaTokenSMS();return false;"><i class="icon-check"></i> CONFIRMAR TOKEN RECEBIDO</button>  
    <div style="text-align:center; padding:2px; clear:both; color:#FF0004;" id="msg_verifica"></div>        
    </div>
</form>

<script type="text/javascript">
$(document).ready(function(){
		$(".icheck").each(function(){
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
});

function confirmaTokenSMS(){
	if($('#<?=$formChave?> #tokenSms').val().length != "6"){
		alert('Informe o TOKEN TORPEDO/SMS corretamente!');
		exibNotificacao("TOKEN IMCOMPLETO","Digite o TOKEN TORPEDO/SMS recebido em seu celular!.",3000);
		$('#<?=$formChave?> #tokenSms').focus();		
	}else{
		faisher_ajax('div_auxiliar', 'div_tokem_load', 'bloqueio.php', 'token='+$("#<?=$formChave?> #tokenSms").val()+'&confiavel='+valHtml('pcSeguro','#<?=$formChave?>'), 'post');
	}
}//confirmaChave

function startSsegToken<?=$formChave?>(v_tm){
	var sseg_tokenTempo = Number(v_tm);
	if((sseg_tokenTempo - 1) >= 0){
		var min = parseInt(sseg_tokenTempo/60);
		var seg = sseg_tokenTempo%60;
		//if(min < 10){ min = "0"+min; min = min.substr(0, 2); }
		if(seg <=9){ seg = "0"+seg; }
		$("#<?=$formChave?> #div_time").html(seg);
		sseg_tokenTempo--;
		perc = 300-(seg*5);
		$("#<?=$formChave?> #div_bar").width(perc);
		$.doTimeout('vTimerTm', 1000, function(){ startSsegToken<?=$formChave?>(sseg_tokenTempo); });//TIMER
	}else{
		$("#<?=$formChave?> #fig_sms").hide();
		$("#<?=$formChave?> #bt_reenviasms").fadeIn();
		$("#<?=$formChave?> #div_leg").html('Caso não tenha recebido o TORPEDO/SMS, utilize REENVIAR para nova tentativa!');
		$("#<?=$formChave?> #div_time").html('<i class="icon-time" style="font-size:36px;"></i>');
		$("#<?=$formChave?> #div_bar").width(300);
	}
}
$.doTimeout('vTimerTm', 0, function(){
	startSsegToken<?=$formChave?>(59);
});//TIMER

function reenviaToken(){
	$("#<?=$formChave?> #bt_reenviasms").hide();
	$("#<?=$formChave?> #fig_sms").fadeIn();
	$("#<?=$formChave?> #div_leg").html('Foi reenviado, mantenha o celular em mãos e informe o token TORPEDO/SMS recebido!');
	faisher_ajax('div_oculta', '0', 'bloqueio.php', 'reenviatoken=on', 'post');
	startSsegToken<?=$formChave?>(59);
}

//JQUERY executa com ENTER
	/* ao pressionar uma tecla em um campo*/
	$("#<?=$formChave?> #tokenSms").keypress(function(e){
		var tecla = (e.keyCode?e.keyCode:e.which);
		/* verifica se a tecla pressionada foi o ENTER */
		if(tecla == 13){//codigo a executar	
			confirmaTokenSMS();
			return false;/* impede o sumbit caso esteja dentro de um form */
		}
	})
//FIM JQUERY executa com ENTER
</script>

							</div>
						</div>
                        
					</div>
				</div><!-- end .row-fluid -->
                 
                 
                 
                 
                 
                <div style="height:50px; clear:both;"></div>
              
                   
                   </div>

				</div>
			</div><!-- End: .container-fluid -->
<?php

}//fim if TELA
//----------------------------------------------------------------------- TELA DE TOKEN SMS --------------------------------------------------------------<<<<















?>
<script>
<!-- begin
var sHors = "00";  var sMins = "04"; var sSecs = 60;
function getSecs(){
	sSecs--;
	if(sSecs<0){sSecs=59;sMins--;if(sMins<=9)sMins="0"+sMins;}
	if(sMins=="0-1"){sMins=5;sHors--;if(sHors<=9)sHors="0"+sHors;}
	if(sSecs<=9)sSecs="0"+sSecs;
		if(sHors=="0-1"){sHors="00";sMins="00";sSecs="00";
			$("#tMin").html(sMins); $("#tSeg").html(sSecs); window.location='login.php?sair=1';
			clock1.innerHTML=sHors+"<font color=#000000>:</font>"+sMins+"<font color=#000000>:</font>"+sSecs;
		}else{
			$("#tMin").html(sMins); $("#tSeg").html(sSecs); setTimeout('getSecs()',1000);
			clock1.innerHTML=sHors+"<font color=#000000>:</font>"+sMins+"<font color=#000000>:</font>"+sSecs;
		}
}//getSecs
setTimeout('getSecs()',1000);
//-->
</script>
            
            
		</div></div>
<div id="div_principalContent_load" style="line-height:250px; width:400px; height:250px; margin:-125px 0 0 -200px; position:fixed; top:50%; left:50%; z-index:9999; background:url(img/shadows/b30.png) repeat; text-align:center; color:#FFF; border:#000 2px solid; display:none;"><img src="img/ajax-loader.gif">&nbsp;&nbsp;<span id="div_principalContent_loadmsg">Filtrando dados...</span></div>



 

       
<div style="width:1px; height:1px; position:absolute;" id="div_auxiliar"></div>
<div style="width:1px; height:1px; display:none;" id="div_oculta"></div>
<input id="abaActive" name="abaActive" type="hidden" value="In-home">
	</body>
	</html>
<?php






//REMOVE CONEXAO
//fecha todas as conexoes abertas
$classe_db->FechaConexaoAll($SCRIPTOFF);//fecha conexoes
?>