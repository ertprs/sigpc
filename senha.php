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
//INICIAR CLASSES DE CONTROLE ---<<<


//CLASSES PROTEGE PAGINA/LOGIN --->>>
//protege a pagina
$cVLogin = new classVLOGIN;//inicia a classe de login
$cVLogin->loginCookie("OFF");//verifica o login e cria array de login
$cVLogin->loginSession("senh","OFF");//faz a atualização de session do login atual
//CLASSES PROTEGE PAGINA/LOGIN ---<<<


//CLASSES PAGINA/LOGIN --->>>
if($cVLogin->loginVerificaSenhaExpirou("OFF")){ classLOGIN::deslogar(); print("<script> parent.location='pacote.php'; </script>"); exit(0); }//verifica se a senha de login expirou, redireciona para página de alteração




//INCLUDE FAISHER, CONTROLE DE ARQUIVOS
$SYS_VALIDASEMQUADRO = "Jesus te Ama!";






















?>
<!doctype html>
<html><head>
<?php

//include HEAD html
include "index_head.php";//classes de conexao



?>

<script>			
$(document).ready(function() {
	if(getCookieF('SYS_LOGIN_BLOQ') != "0"){ setCookieF('SYS_LOGIN_BLOQ', '<?=time()+600?>'); }
});
</script>
</head>

<body class="<?php if((fGERAL::getKookies("CONF_BODY_COLOR")) and (fGERAL::getKookies("CONF_BODY_COLOR") != "")){ echo fGERAL::getKookies("CONF_BODY_COLOR"); }else{ echo 'theme-satgreen';}?>">
	<div id="navigation">
		<div class="container-fluid">
			<a href="./" id="brand"><!-- LOGO --></a>
			<div class="user">
				<div class="dropdown">
					<a href="#" class='dropdown-toggle' data-toggle="dropdown"><?=sentenca(primeiro_nome($cVLogin->getVarLogin("SYS_USER_NOME")))?> <img src="img.php?<?=$cVLogin->imgUser($cVLogin->getVarLogin("SYS_USER_ID"), "27", "27")?>" class="sys_imgPerfil" alt=""></a>
					<ul class="dropdown-menu pull-right">
						<li>
							<a href="login.php?<?=$class_fLNG->txt(__FILE__,__LINE__,'sair')?>=1"><?=$class_fLNG->txt(__FILE__,__LINE__,'Sair do Sistema')?></a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="login" id="content">
	
    
    
    
    
    
    
    
	<div class="wrapper" id="div_login">
		<div class="login-body">
			<div class="forget">
			<h2><?=$class_fLNG->txt(__FILE__,__LINE__,'ALTERAR SENHA EXPIRADA')?></h2>
			<form action="?" method='post' class='form-validate' name="IDFormSenha" id="IDFormSenha" onSubmit="sendFormSenhaExpirada(); return false;">
            <input name="acao" id="acao" type="hidden" value="login">
				<div class="control-group">
					<div class="email controls">
						<input type="password" id="nupw" name="nupw" placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Nova senha de acesso')?>" class='input-block-level' data-rule-required="true">
                        <div id="nupw_forca"><span class="badge"><?=$class_fLNG->txt(__FILE__,__LINE__,'informe uma senha difícil')?></span></div>
					</div>
				</div>
<input id="nupw_forca_val" name="nupw_forca_val" type="hidden" value="0" />
<style> #nupw_forca span{ width:95%; text-align:center; padding:5px; } </style>
<script type='text/javascript'>//<![CDATA[
$(document).ready(function(){
	$('#nupw').keyup(function(e) {
		 var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
		 var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|(?=.*[&._-`´^~,:;#@!])|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
		 var enoughRegex = new RegExp("(?=.{6,}).*", "g");
		 if ($(this).val().length == 0) {
				 $('#nupw_forca_val').val('0');
				 $('#nupw_forca').html('<span class="badge"><?=$class_fLNG->txt(__FILE__,__LINE__,'informe uma senha difícil')?></span>');
		 }else if(false == enoughRegex.test($(this).val())){
				 $('#nupw_forca_val').val('0');
				 $('#nupw_forca').html('<span class="badge badge-inverse"><?=$class_fLNG->txt(__FILE__,__LINE__,'Precisamos de uma senha maior!')?></span>');
		 }else if(strongRegex.test($(this).val())){
				 $('#nupw_forca_val').val('1');
				 $('#nupw_forca').html('<span class="badge badge-success"><i class="icon-trophy"></i><br><?=$class_fLNG->txt(__FILE__,__LINE__,'Jóia! Muito boa a sua senha')?> :)</span>');
		 }else if(mediumRegex.test($(this).val())){
				 $('#nupw_forca_val').val('1');
				 $('#nupw_forca').html('<span class="badge badge-info"><?=$class_fLNG->txt(__FILE__,__LINE__,'Melhorou, senha já é aceita!')?> :)</span>');
		 }else{
				 $('#nupw_forca_val').val('0');
				 $('#nupw_forca').html('<span class="badge badge-important"><?=$class_fLNG->txt(__FILE__,__LINE__,'SENHA MUITO SIMPLES<br>Precisamos de uma senha mais forte!')?><br><br><i class="icon-question-sign"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Utilize letras e números ou símbolos')?> :)</span>');
		 }
		 return true;
	});
});//]]> 
</script>
				<div class="control-group" id="div_senha">
					<div class="pw controls">
						<input type="password" id="nupw2" name="nupw2" placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Confirme nova senha')?>" class='input-block-level' data-rule-required="true">
					</div>
				</div>
				<div class="submit">
					<div class="remember" id="div_mconectado"></div>
					<input type="submit" value="<?=$class_fLNG->txt(__FILE__,__LINE__,'Salvar e alterar senha')?>" class='btn btn-primary' id="bt_enviar" onClick="sendFormSenhaExpirada();">
				</div>
			</form>

<?php

//VALIDA FORM AJAX
$AJAX_COD_INC = "
	if($('#IDFormSenha').validate().form() == false){ valedaform = \"0\"; }
	if(($('#IDFormSenha #nupw').val() != $('#IDFormSenha #nupw2').val()) && (valedaform == \"1\")){
		$('#modal_alerta .conteudo').html('".$class_fLNG->txt(__FILE__,__LINE__,'As duas senhas são diferentes, informe novamente!')."');
		$('#modal_alerta').modal('show');
		$('#IDFormSenha #nupw').val(''); $('#IDFormSenha #nupw2').val('');
		valedaform = \"0\";
	}
	if((valedaform == \"1\") && ($('#nupw_forca_val').val() != \"1\")){
		valedaform = \"0\";
		$('#modal_alerta .conteudo').html('".$class_fLNG->txt(__FILE__,__LINE__,'<b>Precisamos que verifique a senha informada!</b><br>Informe uma senha mais forte, com letras e números ou símbolos')." :)');
		$('#modal_alerta').modal('show');
	}

	if(valedaform == \"1\"){
		loaderFoco('content','content_load',' ".$class_fLNG->txt(__FILE__,__LINE__,'já estamos verificando a senha, aguarde...')."');
		$('#content_load').fadeIn();	
	}";

//include de script jQuery de envio de forms
//VARIAVEIS DE CONTROLE GERAL DO INCLUDE
$AJAX_METODO_INC = "post";//metodo de envio get, post
$AJAX_GET_INC = "ajax=alterarsenhaexpirada";//vars GET de envio URL
$AJAX_FORM_INC = "IDFormSenha";//id do formulario de trabalho
$AJAX_DADOS_INC = "";//nome dos campos de retorno, {'campo='+$('#campo').val()+'&campo2='+$('#campo2').val()} (opcional)
$AJAX_IDFUNCAO_INC = "sendFormSenhaExpirada";//nome da funcao de retorno [nome funcao]();
$AJAX_URL_INC = "ajax/login_ajax.php"; //url de envio
$AJAX_LOAD_INC = "ADD"; //define se esconde o conteudo com load - ADD
$AJAX_CARREGANDO_INC = "0"; //div de carregando
$AJAX_PAG_DIV_INC = "div_oculta"; //div de dados
include "sys/inc_sendForms.php";
?>

			<h6 style="padding:5px 5px 15px 5px; text-align:center;"><?=$class_fLNG->txt(__FILE__,__LINE__,'SUA SENHA EXPIROU!<br>Informe uma nova senha para continuar utilizando o sistema')?></h6>
		</div>
	</div>
    </div>
    
    
    
    
    
    
    
    
    
    
    	
	</div>




		<div id="modal_alerta" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 id="modal_alertaLabel"><?=$class_fLNG->txt(__FILE__,__LINE__,'ALERTA')?></h3>
			</div>
			<div class="modal-body">
				<p class="conteudo"></p>
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary" data-dismiss="modal"><?=$class_fLNG->txt(__FILE__,__LINE__,'Ok')?></button>
			</div>
		</div>
 
<div style="width:1px; height:1px; position:absolute;" id="div_auxiliar"></div>
<div style="width:1px; height:1px; display:none;" id="div_oculta"></div>

       
	</body>
	</html>
<?php






//REMOVE CONEXAO
//fecha todas as conexoes abertas
$classe_db->FechaConexaoAll($SCRIPTOFF);//fecha conexoes
?>