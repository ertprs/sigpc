<?php // Breno Cruvinel - breno.cruvinel09@gmail.com
//INCLUDES DE CONTROLE
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

forceHttps();//@@@@@@ FORÇAR O HTTPS +++++

//INICIAR ARQUIVO DE LINGUAGEM --->>>
$class_fLNG->loadFile(__FILE__);//incluir o arquivo de linguagem
//INICIAR ARQUIVO DE LINGUAGEM ---<<<

//INICIAR CLASSES DE CONTROLE --->>>
$cVLogin = new classVLOGIN;//inicia a classe de login
//INICIAR CLASSES DE CONTROLE ---<<<


//fim da sessao
if(isset($_GET['sair'])){
	//INICIAR CLASSES DE CONTROLE --->>>
	//conexao DB
	$classe_db = new classe_DB;//inicia a classe de conexao
	$classe_db->AbreConexaoPai();//Abrimos a conexão Pai
	//INICIAR CLASSES DE CONTROLE ---<<<
	
	
	//destroe todos os cookies ligados ao login
	$cLogin = new classLOGIN;//inicia a classe de login
	$cLogin->deslogar();
	print("<script> parent.location='?".$class_fLNG->txt(__FILE__,__LINE__,'FINALIZADO_COM_SUCESSO')."'; </script>");
	

	//REMOVE CONEXAO
	//fecha todas as conexoes abertas
	$classe_db->FechaConexaoAll($SCRIPTOFF);//fecha conexoes
	exit(0);
}//if((isset sair 
	
	
	


//INCLUDE FAISHER, CONTROLE DE ARQUIVOS
$SYS_VALIDASEMQUADRO = "Jesus te Ama!";
$iniciaConexao = "0";

//verifica se recebeu link de confirmação de email senha +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ >>>
if(isset($_GET["l"])){
	$chaveEmail = getpost_sql(base64_decode($_GET["l"]));
	if($chaveEmail != ""){ $iniciaConexao = "1"; }
}//isset
//verifica se recebeu link de confirmação de email ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ >>>
if(isset($_GET["v"])){
	$chaveEmail = base64_decode($_GET["v"]);
	if($chaveEmail != ""){ $iniciaConexao = "1"; }
}//isset		
if($iniciaConexao == "1"){
	//INICIAR CLASSES DE CONTROLE --->>>
	//conexao DB
	$classe_db = new classe_DB;//inicia a classe de conexao
	$classe_db->AbreConexaoPai();//Abrimos a conexão Pai
	//INICIAR CLASSES DE CONTROLE ---<<<
	classLOGIN::deslogar();//remove algum login existente - - - - - - - 
}//fim
		
	
	
//verifica se existe login
if($cVLogin->loginConfirma()){
	echo "<script>window.location='./';</script>";
	exit(0);
}








?>
<!doctype html>
<!--[if IE 8]> <html lang="<?=$class_fLNG->getLang()?>" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="<?=$class_fLNG->getLang()?>" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="<?=$class_fLNG->getLang()?>">
<!--<![endif]-->
    <head>	
<?php

//include HEAD html
include "index_head.php";//classes de conexao






//mensagem confirmação de email ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ >>>
if(isset($_GET["aguardando_confirmacao_email"])){
	if(isset($_SESSION["MSG_CONFIRMAEMAIL"])){
?>
<script>
	$.doTimeout( 'vTimerCADCONF', 700, function(){
		$('#modal_alerta .conteudo').html('<?=$_SESSION["MSG_CONFIRMAEMAIL"]?>');
		$('#modal_alerta').modal('show');
		return false;//controla o laco
	});//TIMER
</script>
<?php
		unset($_SESSION["MSG_CONFIRMAEMAIL"]);
	}//if(isset($_SESSION["MSG_CONFIRMAEMAIL"])){
}//if(isset($_GET["aguardando_confirmacao_email"])){ +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ <<<






//verifica se recebeu link de confirmação de email ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ >>>
if(isset($_GET["v"])){
	$chaveEmail = base64_decode($_GET["v"]);
	if($chaveEmail != ""){
		$cLogin = new classLOGIN;//inicia a classe de login
		$msg_email = $cLogin->emailConfirma($chaveEmail);//faz verificação de confirmação de email
		if($msg_email != ""){
			$msg = $class_fLNG->txt(__FILE__,__LINE__,'Email: !!email!!<br>Confirmado com sucesso!<br>Solicitação de credenciamento foi registrada, aguarde a decisão da análise!',array("email"=>"<b>".$msg_email."</b>"));
		}else{
			$msg = $class_fLNG->txt(__FILE__,__LINE__,'<b>Código não verificado!</b><br>Tente realizar o login usando seu email de cadastro.');
		}
?>
<script>
	$.doTimeout( 'vTimerCADCONF', 1000, function(){
		$('#modal_alerta .conteudo').html('<?=$msg?>');
		$('#modal_alerta').modal('show');
		return false;//controla o laco
	});//TIMER
</script>
<?php
	}//if($chaveEmail != ""){
}//if(isset($_GET["v"])){ +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ <<<








//verifica se recebeu link de confirmação de email senha +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ >>>
if(isset($_GET["l"])){
	//ini_set('display_errors',1);ini_set('display_startup_erros',1);error_reporting(E_ALL);
	$chaveEmail = getpost_sql(base64_decode($_GET["l"]));
	if($chaveEmail != ""){
		//LIMPA SOLICITAÇÕES ANTIGAS ---
		$time_limpa = time()-10800;
		//exclue o registro
		fSQL::SQL_DELETE_SIMPLES("sys_usuarios_login_lembrar", "time <= '$time_limpa'");
		//LIMPA SOLICITAÇÕES ANTIGAS ---
		$cont_ok = "0";
		$arrCv = explode("_",$chaveEmail);
		$fisico_id_ = $arrCv["1"];
		$resu1 = fSQL::SQL_SELECT_SIMPLES("id,chave,nova_senha", "sys_usuarios_login_lembrar", "usuario_id = '".$fisico_id_."'", "", "1");
		while($linha = fSQL::FETCH_ASSOC($resu1)){
			$id_s = $linha["id"];
			$chave_s = $linha["chave"];
			$nova_senha_s = $linha["nova_senha"];
			if($chaveEmail == $chave_s){	
				$nova_senhaDB = fGERAL::cryptoSenhaDB($nova_senha_s);
				//atualiza dados da tabela no DB
				$campos = "senha_erro,senha,senha_expira,time_s";
				$tabela = "sys_login";
				$valores = array("0",$nova_senhaDB,$time_limpa,time());
				$condicao = "usuarios_id='$fisico_id_'";
				fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);				
				//exclue o registro
				fSQL::SQL_DELETE_SIMPLES("sys_usuarios_login_lembrar", "id = '$id_s'");
				$cont_ok++;
			}//if($chaveEmail == $chave_s){
		}//fim while
		if($cont_ok >= "1"){
			//busca informações pra envio do email com nova senha
			$resu1 = fSQL::SQL_SELECT_SIMPLES("C.nome,L.email", "sys_usuarios C, sys_login L", "C.id = '$fisico_id_' AND C.id = L.usuarios_id", "GROUP BY C.id", "1");
			while($linha = fSQL::FETCH_ASSOC($resu1)){
				$nome_i = $linha["nome"];
				$email_i = $linha["email"];	
				//prepara envio de email
				$html_template = file_get_contents(VAR_DIR_FILES."files/templates/email/email-nova-senha.html");
				//monta mensagem template
				$html_template = str_replace("!url_raiz!",SYS_URLRAIZ,$html_template);
				$html_template = str_replace("!nome_fisico!",$nome_i,$html_template);
				$html_template = str_replace("!nova_senha!",$nova_senha_s,$html_template);		
				$html_template = str_replace("!url_interface!",SYS_URLRAIZ,$html_template);			
				//$email_i = "breno.cruvinel09@gmail.com";
				//#################### INICIO ENVIA EMAIL ##################>>>>>>>>>>>>>>>>
				$opts = array(
					'http'=>array('header'=>"Content-type: application/x-www-form-urlencoded", 'method'=>'POST', 'content'=>http_build_query(array(
						//CONFIGURAÇÕES
						'MAIL_HOST' => SYS_MAIL_HOST,
						'MAIL_TIPO' => SYS_MAIL_TIPO,// SMTP ("","ssl","tls")
						'MAIL_PORTA' => SYS_MAIL_PORTA,//465
						'MAIL_USER' => SYS_MAIL_USER,
						'MAIL_PASS' => SYS_MAIL_PASS,
						'MAIL_NOME' => SYS_MAIL_NOME,
						'MAIL_EMAIL' => SYS_MAIL_EMAIL,
						'MAIL_DEBUG' => "0",//ativar debug -- 1 = Erros e mensagens, 2 = Apenas mensagens, SMTP::DEBUG_SERVER
						//DADOS DO ENVIO
						'SEND_NOME' => primeiro_nome($nome_i),
						'SEND_EMAIL' => $email_i,
						'SEND_ASSUNTO' => $class_fLNG->txt(__FILE__,__LINE__,'!!nome!!, nova senha',array("nome"=>primeiro_nome($nome_i)))." - ".SYS_CLIENTE_NOME_RESUMIDO,
						'SEND_BODY' => $html_template
						))),"ssl"=>array("verify_peer"=>false,"verify_peer_name"=>false)
				); $context = stream_context_create($opts);
				//informações do retorno: 0 - bloqueado acesso, 1 - sucesso, 2 - erros de configuração, 3 - erro de classe
				$contentResp = file_get_contents(SYS_URLRAIZ.'sys/http_send_email.php?JesusTeAma=1', false, $context);
				if($contentResp != "1"){
					$msg = $class_fLNG->txt(__FILE__,__LINE__,'Opss... Ouve um problema interno, não foi possível enviar o email de nova senha, tente nova solicitação novamente mais tarde!');
					//echo 'Mailer Error: ' . $mail->ErrorInfo;
				}else{
					//esconde parcialmente email
					$d = explode("@",$email_i);
					$rest = substr($d["0"], 0, 3);
					$email_n = $rest."*********@".$d["1"];
					$msg = $class_fLNG->txt(__FILE__,__LINE__,'Foi enviado um email com nova senha para: !!email!!, verifique sua caixa de span caso não localize o email!',array("email"=>'<b>'.$email_n.'</b>'));
				}
				//#################### FIM ENVIA EMAIL ##################<<<<<<<<<<<<<<
			}//fim while
		}else{
			$msg = $class_fLNG->txt(__FILE__,__LINE__,'<b>Link expirado!</b><br>Não foi possível reconhecer a solicitação de senha. Tente novamente!');
		}
?>
<script>
	$.doTimeout( 'vTimerLEBCONF', 1000, function(){
		$('#modal_alerta .conteudo').html('<?=$msg?>');
		$('#modal_alerta').modal('show');
		return false;//controla o laco
	});//TIMER
</script>
<?php
	}//if($chaveEmail != ""){
}//if(isset($_GET["l"])){ +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ <<<


if($iniciaConexao == "1"){
	//REMOVE CONEXAO
	//fecha todas as conexoes abertas
	$classe_db->FechaConexaoAll($SCRIPTOFF);//fecha conexoes
}//fim


?>
<script>
function calcularIdade(aniversario) {
    var nascimento = aniversario.split("/");
    var dataNascimento = new Date(parseInt(nascimento[2], 10),
    parseInt(nascimento[1], 10) - 1,
    parseInt(nascimento[0], 10));
    var diferenca = Date.now() -  dataNascimento.getTime();
    var idade = new Date(diferenca);
    return Math.abs(idade.getUTCFullYear() - 1970);
}

function btCad1(){
	var valida = 1;
	if(($('#cnome').val().length <= 3) && (valida == 1)){ valida = 0; alert('<?=$class_fLNG->txt(__FILE__,__LINE__,'Precisamos de seu nome completo!')?>'); $('#tb-cad1').click(); $('#cnome').focus(); }
	if(($('#cdatan').val().length <= 3) && (valida == 1)){ valida = 0; alert('<?=$class_fLNG->txt(__FILE__,__LINE__,'Esqueceu sua data de nascimento!')?>'); $('#tb-cad1').click(); $('#cdatan').focus(); }else{
		var vidade = Number(calcularIdade($('#cdatan').val()));
		if((vidade <= 17) && (valida == 1)){ valida = 0; alert('<?=$class_fLNG->txt(__FILE__,__LINE__,'Desculpe mas na data de nascimento informada você é menor de 18 anos!')?>'); $('#tb-cad1').click(); $('#cdatan').focus(); }
	}
	if(($('#cdoc_numero').val().length <= 3) && (valida == 1)){ valida = 0; alert('<?=$class_fLNG->txt(__FILE__,__LINE__,'Esqueceu de informar o nº do seu documento!')?>'); $('#tb-cad1').click(); $('#cdoc_numero').focus(); }
	if(($('#cmae').val().length <= 3) && (valida == 1)){ valida = 0; alert('<?=$class_fLNG->txt(__FILE__,__LINE__,'Precisamos do nome de sua mãe completo!')?>'); $('#tb-cad1').click(); $('#cmae').focus(); }
	if(($('#ccelular').val().length <= 3) && (valida == 1)){ valida = 0; alert('<?=$class_fLNG->txt(__FILE__,__LINE__,'Seu número de celular.')?>'); $('#tb-cad1').click(); $('#ccelular').focus(); }
	if(valida == 1){ $('#tb-cad2').click(); }
	return false;
}//btCad1

function btCad2(){
	var valida = 1;
	if(($('#cont_upload1').val() <= 0) && (valida == 1)){ valida = 0; alert('<?=$class_fLNG->txt(__FILE__,__LINE__,'Precisamos do seu RCCM com sua atividade.')?>'); $('#tb-cad2').click(); }
	if(($('#cont_upload2').val() <= 0) && (valida == 1)){ valida = 0; alert('<?=$class_fLNG->txt(__FILE__,__LINE__,'Precisamos do seu documento pessoal!')?>'); $('#tb-cad2').click(); }
	if(valida == 1){ $('#tb-cad3').click(); $('#uf').select2("open"); }
	return false;
}//btCad1

function btCad3(){
	var valida = 1;
	if(($('#cpais').val() == "") && (valida == 1)){ valida = 0; alert('<?=$class_fLNG->txt(__FILE__,__LINE__,'Informe o pais!')?>'); $('#tb-cad3').click(); $('#cpais').select2("open"); }
	if(($('#cuf').val() == "") && (valida == 1)){ valida = 0; alert('<?=$class_fLNG->txt(__FILE__,__LINE__,'Informe o Estado!')?>'); $('#tb-cad3').click(); $('#cuf').select2("open"); }
	if(($('#ccidade_id').val() == "") && (valida == 1)){ valida = 0; alert('<?=$class_fLNG->txt(__FILE__,__LINE__,'Informe sua Cidade!')?>'); $('#tb-cad3').click(); $('#ccidade_id').select2("open"); }
	if(($('#cbairro').val() == "") && (valida == 1)){ valida = 0; alert('<?=$class_fLNG->txt(__FILE__,__LINE__,'Informe seu bairro/setor!')?>'); $('#tb-cad3').click(); $('#cbairro').select2("open"); }
	if(($('#creferencia').val() == "") && (valida == 1)){ valida = 0; alert('<?=$class_fLNG->txt(__FILE__,__LINE__,'Informe a referência do seu endereço!')?>'); $('#tb-cad3').click(); $('#creferencia').select2("open"); }
	if(valida == 1){ $('#tb-cad4').click(); sysCaptcha3(); }
	return false;
}//btCad3

function btCad4(){
	var valida = 1;
	if(($('#cnome').val().length <= 3) && (valida == 1)){ valida = 0; alert('<?=$class_fLNG->txt(__FILE__,__LINE__,'Precisamos de seu nome completo!')?>'); $('#tb-cad1').click(); $('#cnome').focus(); }
	if(($('#cdatan').val().length <= 3) && (valida == 1)){ valida = 0; alert('<?=$class_fLNG->txt(__FILE__,__LINE__,'Esqueceu sua data de nascimento!')?>'); $('#tb-cad1').click(); $('#cdatan').focus(); }else{
		var vidade = Number(calcularIdade($('#cdatan').val()));
		if((vidade <= 17) && (valida == 1)){ valida = 0; alert('<?=$class_fLNG->txt(__FILE__,__LINE__,'Desculpe mas na data de nascimento informada você é menor de 18 anos de idade!')?>'); $('#tb-cad1').click(); $('#cdatan').focus(); }
	}
	if(($('#cdoc_numero').val().length <= 3) && (valida == 1)){ valida = 0; alert('<?=$class_fLNG->txt(__FILE__,__LINE__,'Esqueceu de informar o nº do seu documento!')?>'); $('#tb-cad1').click(); $('#cdoc_numero').focus(); }
	if(($('#cmae').val().length <= 3) && (valida == 1)){ valida = 0; alert('<?=$class_fLNG->txt(__FILE__,__LINE__,'Precisamos do nome de sua mãe completo!')?>'); $('#tb-cad1').click(); $('#cmae').focus(); }
	if(($('#ccelular').val().length <= 3) && (valida == 1)){ valida = 0; alert('<?=$class_fLNG->txt(__FILE__,__LINE__,'Seu número de celular.')?>'); $('#tb-cad1').click(); $('#ccelular').focus(); }
	if(($('#cont_upload1').val() <= 0) && (valida == 1)){ valida = 0; alert('<?=$class_fLNG->txt(__FILE__,__LINE__,'Precisamos do seu RCCM com sua atividade.')?>'); $('#tb-cad2').click(); }
	if(($('#cont_upload2').val() <= 0) && (valida == 1)){ valida = 0; alert('<?=$class_fLNG->txt(__FILE__,__LINE__,'Precisamos do seu documento pessoal!')?>'); $('#tb-cad2').click(); }
	
	if(($('#cpais').val() == "") && (valida == 1)){ valida = 0; alert('<?=$class_fLNG->txt(__FILE__,__LINE__,'Informe o pais!')?>'); $('#tb-cad2').click(); $('#cuf').select2("open"); }	
	if(($('#cuf').val() == "") && (valida == 1)){ valida = 0; alert('<?=$class_fLNG->txt(__FILE__,__LINE__,'Informe o UF!')?>'); $('#tb-cad2').click(); $('#cuf').select2("open"); }
	if(($('#ccidade_id').val() == "") && (valida == 1)){ valida = 0; alert('<?=$class_fLNG->txt(__FILE__,__LINE__,'Informe sua Cidade!')?>'); $('#tb-cad2').click(); $('#ccidade_id').select2("open"); }
	if(($('#cbairro').val() == "") && (valida == 1)){ valida = 0; alert('<?=$class_fLNG->txt(__FILE__,__LINE__,'Informe seu bairro/setor!')?>'); $('#tb-cad2').click(); $('#cbairro').select2("open"); }
	if(($('#creferencia').val() == "") && (valida == 1)){ valida = 0; alert('<?=$class_fLNG->txt(__FILE__,__LINE__,'Informe a referência do seu endereço!')?>'); $('#tb-cad3').click(); $('#creferencia').select2("open"); }
	

	if(($('#cemail').val().length <= 3) && (valida == 1)){ valida = 0; alert('<?=$class_fLNG->txt(__FILE__,__LINE__,'Precisamos de seu email para acesso/login!')?>'); $('#tb-cad4').click(); $('#cemail').focus(); }
	if(($('#cemail').val() != $('#cemail2').val()) && (valida == 1)){ valida = 0; alert('<?=$class_fLNG->txt(__FILE__,__LINE__,'Opa... sei que é chato! \nMas, precisamos que digite seu email duas vezes, pra confirmar que não errou...')?> \n:)'); $('#tb-cad4').click(); $('#cemail').focus(); }
	if(($('#csenha1').val().length < 6) && (valida == 1)){ valida = 0; alert('<?=$class_fLNG->txt(__FILE__,__LINE__,'Informe uma senha com no mínimo 6 caracteres!\nIMPORTANTE MANTER UMA SENHA SEGURA')?>'); $('#tb-cad4').click(); $('#csenha1').focus(); }
	if(($('#csenha1').val() != $('#csenha2').val()) && (valida == 1)){ valida = 0; alert('<?=$class_fLNG->txt(__FILE__,__LINE__,'Senhas não conferem!\nDigite e informe sua senha corretamente!')?>'); $('#tb-cad4').click(); $('#csenha1, #csenha2').val(''); $('#csenha1').focus(); }
	if(valida == 1){ return true; }else{ return false; }
}//btCad4



function tabLogin(){ $('.div_tab_hide').hide();$('#div_login').fadeIn(); sysCaptcha1(); }
function tabCadastro(){ $('.div_tab_hide').hide();$('#div_cadastro').fadeIn(); sysCaptcha3(); }
function tabLembrar(){ $('.div_tab_hide').hide();$('#div_lembrar').fadeIn(); sysCaptcha2(); }
function alertMensage(msg){
	$('#modal_alerta .conteudo').html(msg);
	$('#modal_alerta').modal('show');	
}


function locationSuccess(position) {
	$('#ajustaMsgLocal').hide();
	latitude = position.coords.latitude;
	longitude = position.coords.longitude;
	$('#geoData').html(latitude+','+longitude);
	setCookieF('SYS_GEO_DATA', latitude+','+longitude);
 }
function locationFail(erro) {
    $('#ajustaMsgLocal').hide();
}
<?php
//verifica se recebeu atalho GET
$atalho_js = "";
if(isset($_GET["lembrar"])){
	$atalho_js .= "tabLembrar();
	$('#modal_alerta .conteudo').html('<div style=\"font-size:70px; padding:40px; text-align:center;\">:)</div>".$class_fLNG->txt(__FILE__,__LINE__,'<b>Olha só, um detalhe importante!</b><br>Utilize os recursos para recuperar os seus acessos...<br><b>...logo após recuperar a senha, retorne ao sistema integrado para varificar seu acesso!</b>')."');
	$('#modal_alerta').modal('show');";
}//if(isset($_GET["lembrar"])){
if(isset($_GET["cadastro"])){
	$atalho_js .= "tabCadastro();
	$('#modal_alerta .conteudo').html('<div style=\"font-size:70px; padding:40px; text-align:center;\">:)</div>".$class_fLNG->txt(__FILE__,__LINE__,'<b>Olha só, um detalhe importante!</b><br>Utilize o formulário de cadastro e preencha seus dados PESSOAIS...<br><b>...logo após o cadastro, retorne ao sistema integrado para verificar seu acesso!</b>')."');
	$('#modal_alerta').modal('show');";
}//if(isset($_GET["cadastro"])){
if($atalho_js != ""){
?>
$.doTimeout('vTimerAtalho', 500, function(){ <?=$atalho_js?> });//TIMER
<?php }?>
</script>
</head>

<body class='login'>


	<div class="btn-group" style="position:absolute; top:5px; left:5px; z-index:99999;">
		<button class="btn blue-hoki btn-outline sbold uppercase dropdown-toggle" style="padding:5px;" data-toggle="dropdown">
			<i class="fa fa-language"></i> <?=$class_fLNG->getInfo("sigla")?> <i class="fa fa-angle-down"></i>
		</button>
		<ul class="dropdown-menu" role="menu">
<?php
//verifica lista de linguagens disponíveis
$array = $class_fLNG->getLangs(); //lista o array
foreach ($array as $pos => $valor){
?>
			<li role="presentation" class="divider"> </li>
			<li role="presentation">
				<a role="menuitem" tabindex="-1" href="?aLang=<?=$valor["lang"]?>"> <?=$valor["nome"]?>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="badge badge-primary"> <?=$valor["bt"]?> </span>
				</a>
			</li>
<?php
}//fim foreach
?>
		</ul>
	</div>

<img src="img/bandeira-1.png" style="max-width:251px; position:absolute; top:0; left:30px;">
<img src="img/bandeira-2.png" style="max-width:311px; position:absolute; bottom:10px; left:20px;">
<input id="geoData" name="geoData" type="hidden" value="">
	<div class="wrapper div_tab_hide" id="div_login">
		<h1 style=" text-align:center;"><a href="../" style=" text-align:center;"><img src="img/logo-big.png" alt="" class='retina-ready' style="margin-right:0;" width="180" height="180"></a></h1>
		<div class="login-body">
			<h2><?=maiusculo(SYS_CLIENTE_NOME_RESUMIDO)?></h2>
			<form action="?" method='post' class='form-validate' name="IDFormLogin" id="IDFormLogin" onSubmit="sendFormLogin(); return false;">
            <input name="acao" id="acao" type="hidden" value="login">
				<div class="control-group">
					<div class="email controls">
						<input type="text" id='uemail' name='uemail' autocomplete="off" placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Email de acesso')?>" class='input-block-level' data-rule-required="true" data-rule-email="true">
					</div>
				</div>
				<div class="control-group" id="div_senha">
					<div class="pw controls">
						<input type="password" id="upw" name="upw" autocomplete="off" placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Senha de acesso')?>" class='input-block-level' data-rule-required="true">
					</div>
				</div>
<script>
function sysCaptcha1(v_get){
	$(".sysCaptcha_limpar").empty();
	faisher_ajax('div_sysCaptcha1', '0', 'ajax/sysCaptcha_ajax.php', 'load=sysCaptcha1_load&'+v_get, 'get', 'ADD');
}
$.doTimeout('vTimerCaptcha', 300, function(){ sysCaptcha1(''); $.doTimeout('vTimerCaptchaF'); });
$.doTimeout('vTimerCaptchaF', 3000, function(){ sysCaptcha1(''); });
</script>
				<div style="padding:0; margin:0;" class="sysCaptcha_limpar" id="div_sysCaptcha1"></div>
                <div style="position:absolute; width:100%; margin:20px  0 0 10px; text-align:left;" id="sysCaptcha1_load"><img src="img/ajax-p-loader.gif" width="30"> <?=$class_fLNG->txt(__FILE__,__LINE__,'verificando span')?></div>
				<div class="submit">
                    <div class="remember" id="div_mconectado"><a href="#" onClick="tabLembrar();"><i class="icon-question-sign"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Esqueceu sua senha?')?></a><br><a href="#" onClick="tabCadastro();"><i class="icon-plus-sign"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Credenciamento de Auto Escolas e Médicos!')?></a></div>
					<input type="submit" value="<?=$class_fLNG->txt(__FILE__,__LINE__,'Entrar')?>" class='btn btn-green btn-large' id="bt_enviar" onClick="sendFormLogin();">
				</div>
			</form>
            

<?php
//VALIDA FORM AJAX
$AJAX_COD_INC = "
	if($('#IDFormLogin').validate().form() == false){ valedaform = \"0\"; }
	if(valedaform == \"1\"){
		loaderFoco('div_login','div_login_load',' ".$class_fLNG->txt(__FILE__,__LINE__,'já estamos verificando o login, aguarde...')."');
		$('#div_login_load').fadeIn();	
	}";

//include de script jQuery de envio de forms
//VARIAVEIS DE CONTROLE GERAL DO INCLUDE
$AJAX_METODO_INC = "post";//metodo de envio get, post
$AJAX_GET_INC = "ajax=verificarlogin";//vars GET de envio URL
$AJAX_FORM_INC = "IDFormLogin";//id do formulario de trabalho
$AJAX_DADOS_INC = "";//nome dos campos de retorno, {'campo='+$('#campo').val()+'&campo2='+$('#campo2').val()} (opcional)
$AJAX_IDFUNCAO_INC = "sendFormLogin";//nome da funcao de retorno [nome funcao]();
$AJAX_URL_INC = "ajax/login_ajax.php"; //url de envio
$AJAX_LOAD_INC = "ADD"; //define se esconde o conteudo com load - ADD
$AJAX_CARREGANDO_INC = "0"; //div de carregando
$AJAX_PAG_DIV_INC = "div_oculta"; //div de dados
include "sys/inc_sendForms.php";
?>

            
			<div style="clear:both; height:10px;"></div>
		</div>
	</div>
    
    

	<div class="wrapper div_tab_hide" style="display:none;" id="div_lembrar">
		<h1 ><a href="../"><img src="img/logo-big.png" alt="" class='retina-ready' width="180" height="180"></a></h1>
		<div class="login-body">
			<h2 style="font-weight:bold; line-height:normal;" class="visible-phone"><?=$class_fLNG->txt(__FILE__,__LINE__,'RECUPERAR!!espaco!!SEU ACESSO',array("espaco"=>"<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"))?></h2>
			<h2 style="font-weight:bold; line-height:normal;" class="hidden-phone"><?=$class_fLNG->txt(__FILE__,__LINE__,'RECUPERAR SEU ACESSO')?></h2>
			<form action="?" method='post' class='form-validate' name="IDFormLembrar" id="IDFormLembrar" onSubmit="sendFormLembrar(); return false;">
            <input name="acao" id="acao" type="hidden" value="lembrar">
                <div class="control-group">
                    <?=$class_fLNG->txt(__FILE__,__LINE__,'Tipo Documento')?>
                    <div class="controls">
                        <div style="float:left; width:50%;">
                            <div class="check-line">
                                <input name="doc_nome" type="radio" class='login-icheck' id="doc_nome1" value="<?=$class_fLNG->txt(__FILE__,__LINE__,'IDENTIDADE')?>" data-skin="square" data-color="blue" checked="checked"> <label class='inline' for="doc_nome1"><?=$class_fLNG->txt(__FILE__,__LINE__,'Identidade')?></label>
                            </div>
                        </div>
                        <div style="float:left; width:50%;">
                            <div class="check-line">
                                <input name="doc_nome" type="radio" class='login-icheck' id="doc_nome2" value="<?=$class_fLNG->txt(__FILE__,__LINE__,'PASSAPORTE')?>" data-skin="square" data-color="blue"> <label class='inline' for="doc_nome2"><?=$class_fLNG->txt(__FILE__,__LINE__,'Passaporte')?></label>
                            </div>
                        </div>
                        <div style="clear:both; height:5px;"></div>
                    </div>
                </div>             
				<div class="control-group">
					<div class="email controls"><?=$class_fLNG->txt(__FILE__,__LINE__,'Informe seu de nº documento')?>
						<input type="text" id='lcpf' name='lcpf' autocomplete="off" placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Documento de cadastro')?>" class='input-block-level' onkeyup="this.value=this.value.replace(/[^\d]/,'')" data-rule-required="true">
					</div>
				</div>
				<div class="control-group" id="div_senha">
					<div class="pw controls"><?=$class_fLNG->txt(__FILE__,__LINE__,'Sua data de nascimento')?>
						<input type="text" id="ldatan" name="ldatan" autocomplete="off" placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Data de nascimento')?>" class='input-block-level mask_date' data-rule-required="true">
					</div>
				</div>
                
<script>
function sysCaptcha2(){
	$(".sysCaptcha_limpar").empty();
	loaderFoco('div_sysCaptcha2','sysCaptcha2_load',' verificação de span...'); $("#sysCaptcha2_load").fadeIn();
	faisher_ajax('sysCaptcha2', '0', 'ajax/sysCaptcha_ajax.php', 'load=sysCaptcha2_load&semrobo=1', 'get', 'ADD');
}
</script>
				<div style="padding-top:0; margin-top:0; min-height:80px;" id="div_sysCaptcha2">
                  <div style="position:absolute; width:100%; margin-left:-30px; text-align:center; min-height:75px;" class="sysCaptcha_limpar" id="sysCaptcha2"><?=$class_fLNG->txt(__FILE__,__LINE__,'verificação de span')?></div>
                </div>
				<div class="submit">
					<div class="remember" id="div_mconectado"><a href="#" onClick="tabLogin();"><i class="icon-circle-arrow-left"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Voltar ao Login!')?></a></div>
					<input type="submit" value="<?=$class_fLNG->txt(__FILE__,__LINE__,'Enviar')?>" class='btn btn-primary' id="bt_lembrar" onClick="sendFormLembrar();">
				</div>
			</form>
            

<?php
//VALIDA FORM AJAX
$AJAX_COD_INC = "
	if($('#IDFormLembrar').validate().form() == false){ valedaform = \"0\"; }
	if(valedaform == \"1\"){
		loaderFoco('div_lembrar','div_lembrar_load',' ".$class_fLNG->txt(__FILE__,__LINE__,'já estamos verificando seus dados, aguarde...')."');
		$('#div_lembrar_load').fadeIn();	
	}";

//include de script jQuery de envio de forms
//VARIAVEIS DE CONTROLE GERAL DO INCLUDE
$AJAX_METODO_INC = "post";//metodo de envio get, post
$AJAX_GET_INC = "ajax=lembrarsenha";//vars GET de envio URL
$AJAX_FORM_INC = "IDFormLembrar";//id do formulario de trabalho
$AJAX_DADOS_INC = "";//nome dos campos de retorno, {'campo='+$('#campo').val()+'&campo2='+$('#campo2').val()} (opcional)
$AJAX_IDFUNCAO_INC = "sendFormLembrar";//nome da funcao de retorno [nome funcao]();
$AJAX_URL_INC = "ajax/login_ajax.php"; //url de envio
$AJAX_LOAD_INC = "ADD"; //define se esconde o conteudo com load - ADD
$AJAX_CARREGANDO_INC = "0"; //div de carregando
$AJAX_PAG_DIV_INC = "div_oculta"; //div de dados
include "sys/inc_sendForms.php";
?>

			<div style="clear:both; height:20px;"></div>
		</div>
	</div>
    
    
    
    
<?php

/////////// INCLUDE JS EXCLUSIVO --------------------- 
$INC_JS = ",icheck,";//informar funcao a usar entre VIRGULAS > ,funcao
$INC_JSCSS = "login";
include "ajax/inc/inc_js-exclusivo.php";


	unset($_SESSION["LOGIN_ACAO_FORM_ARRAY"]);//destroe array de temp
	//alimenda array de sessão
	$_SESSION["LOGIN_ACAO_FORM_ARRAY"]["id"] = substr(time(),0,9).rand(0,9);

$array_temp = time().rand(9,99999).$_SESSION["LOGIN_ACAO_FORM_ARRAY"]["id"];

//ini_set('display_errors',1);ini_set('display_startup_erros',1);error_reporting(E_ALL);


?>    
	<div class="wrapper-cadastro div_tab_hide" style="display:none;" id="div_cadastro">
		<h1 ><a href="../"><img src="img/logo-big.png" alt="" class='retina-ready' width="180" height="180"></a></h1>
		<div class="login-body">
			<h2 style="font-weight:bold;"><?=$class_fLNG->txt(__FILE__,__LINE__,'CREDENCIAMENTO')?> <?=SYS_CLIENTE_NOME_RESUMIDO?></h2>
            
            
			<form action="?" method='post' class='form-validate' name="IDFormCadastro" id="IDFormCadastro" onSubmit="envCadConfirma(); return false;">
            <input name="acao" id="acao" type="hidden" value="cadastro">
            <input name="array_temp" id="array_temp" type="hidden" value="<?=$array_temp?>">
            
            
                <div class="alert alert-info" style="margin-top:20px; text-align:justify;" id="div_cadastro_ajuda">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<?=$class_fLNG->txt(__FILE__,__LINE__,'<strong>Importante!</strong> Informe os dados solicitados para ativação de seu acesso.')?>
                </div>
            

			<ul class="tabs tabs-inline tabs-top" style="border-top:#DDD 1px solid;">
				<li class="active">
					<a href="#etp-cad1" onClick="$('#div_cadastro_ajuda').fadeIn();" id="tb-cad1" data-toggle="tab"><i class="icon-user"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Dados')?></a>
				</li>
				<li >
					<a href="#etp-cad2" onClick="$('#div_cadastro_ajuda').fadeIn();loadfUpl1<?=$INC_FAISHER["div"]?>();loadfUpl2<?=$INC_FAISHER["div"]?>();" id="tb-cad2" data-toggle="tab"><i class="icon-briefcase"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Tipo')?></a>
				</li>                
				<li>
					<a href="#etp-cad3" onClick="$('#div_cadastro_ajuda').hide();" id="tb-cad3" data-toggle="tab"><i class="icon-map-marker"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'End.')?></a>
				</li>
				<li>
					<a href="#etp-cad4" onClick="$('#div_cadastro_ajuda').hide();" id="tb-cad4" data-toggle="tab"><i class="icon-lock"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Acesso')?></a>
				</li>
			</ul>
            <div style="clear:both; height:20px;"></div>
			<div class="tab-content tab-content-inline tab-content-bottom">
				<div class="tab-pane active" id="etp-cad1">
											
                    <div class="control-group">
                        <div class="controls"><?=$class_fLNG->txt(__FILE__,__LINE__,'Seu nome completo')?>
                            <input type="text" id='cnome' name='cnome' placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Seu nome completo')?>" class='input-block-level' data-rule-required="true">
                        </div>
                    </div>
					<div class="control-group">
						<?=$class_fLNG->txt(__FILE__,__LINE__,'Gênero')?>
						<div class="controls">
							<div style="float:left; width:50%;">
								<div class="check-line">
									<input name="csexo" type="radio" class='login-icheck' id="csexo1" value="1" data-skin="square" data-color="blue" checked="checked"> <label class='inline' for="csexo1"><?=$class_fLNG->txt(__FILE__,__LINE__,'Masculino')?></label>
								</div>
							</div>
							<div style="float:left; width:50%;">
								<div class="check-line">
									<input name="csexo" type="radio" class='login-icheck' id="csexo2" value="2" data-skin="square" data-color="red"> <label class='inline' for="csexo2"><?=$class_fLNG->txt(__FILE__,__LINE__,'Feminino')?></label>
								</div>
							</div>
            				<div style="clear:both; height:5px;"></div>
						</div>
					</div>				
                    <div class="control-group">
                        <div class="controls"><div style="clear:both;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Sua data de nascimento')?></div>
							<div class="input-append">
								<input type="text" name="cdatan" id="cdatan" value="" class='input-small mask_date' data-rule-required="true">
								<span class="add-on icon-calendar"></span>
							</div>
                        </div>
                    </div>				
					<div class="control-group">
						<?=$class_fLNG->txt(__FILE__,__LINE__,'Tipo Documento')?>
						<div class="controls">
							<div style="float:left; width:50%;">
								<div class="check-line">
									<input name="cdoc_nome" type="radio" class='login-icheck' id="doc_nome1" value="IDENTIDADE" data-skin="square" data-color="blue" checked="checked"> <label class='inline' for="doc_nome1"><?=$class_fLNG->txt(__FILE__,__LINE__,'Identidade')?></label>
								</div>
							</div>
							<div style="float:left; width:50%;">
								<div class="check-line">
									<input name="cdoc_nome" type="radio" class='login-icheck' id="doc_nome2" value="PASSAPORTE" data-skin="square" data-color="blue"> <label class='inline' for="doc_nome2"><?=$class_fLNG->txt(__FILE__,__LINE__,'Passaporte')?></label>
								</div>
							</div>
            				<div style="clear:both; height:5px;"></div>
						</div>
					</div>                    
                    <div class="control-group">
                        <div class="controls"><?=$class_fLNG->txt(__FILE__,__LINE__,'Número do Documento')?>
                            <input type="text" id='cdoc_numero' name='cdoc_numero' placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Nº documento')?>" class='input-block-level' onkeyup="this.value=this.value.replace(/[^\d]/,'')" data-rule-required="true">
                        </div>
                    </div>					
                    <div class="control-group">
                        <div class="controls"><?=$class_fLNG->txt(__FILE__,__LINE__,'Nome completo de sua mãe')?>
                            <input type="text" id='cmae' name='cmae' placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Nome de sua mãe')?>" class='input-block-level' data-rule-required="true">
                        </div>
                    </div>		
                    <div class="control-group">
                        <div class="controls"><?=$class_fLNG->txt(__FILE__,__LINE__,'Seu Telefone')?>
                            <input type="text" id='ccelular' name='ccelular' placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Seu número celular')?>" class='input-block-level mask_phone' data-rule-required="true">
                        </div>
                    </div>			
                    
                    
                    <div class="submit">
                        <div class="remember" id="div_mconectado"><a href="#" onClick="tabLogin();"><i class="icon-user"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Já possui acesso?')?></a></div>
                        <button class="btn btn-primary btn-large" style="float:right;" onClick="btCad1();return false;" id="bt_cad1"><?=$class_fLNG->txt(__FILE__,__LINE__,'Próximo')?> <i class="icon-chevron-right"></i></button> 
                    </div>
            		<div style="clear:both; height:5px;"></div>
                    
				</div>
                
				<div class="tab-pane" id="etp-cad2">											
					<div class="control-group">
						<?=$class_fLNG->txt(__FILE__,__LINE__,'Tipo Acesso')?>
						<div class="controls">
							<div style="float:left; width:50%;">
								<div class="check-line">
									<input name="ccargo" type="radio" class='login-icheck' id="ccargo1" value="AUTO-ÉCOLE" data-skin="square" data-color="blue" checked="checked"> <label class='inline' for="ccargo1">AUTO-ÉCOLE</label>
								</div>
							</div>
							<div style="float:left; width:50%;">
								<div class="check-line">
									<input name="ccargo" type="radio" class='login-icheck' id="ccargo2" value="CLINIQUE MÉDICALE" data-skin="square" data-color="blue"> <label class='inline' for="ccargo2">CLINIQUE MÉDICALE</label>
								</div>
							</div>
							<div style="clear:both; height:5px;"></div>
						</div>
					</div>
<script>
$(document).ready(function(e) {
    $("#IDFormCadastro input[name='ccargo']").on("change", function(){
		$("#IDFormCadastro #tipo_acesso").html($(this).val());
	});
});
</script>                    	   
					<div class="control-group">                    
                        <div class="row-fluid">
                            <div style="background:#CCC; color:#FFF; padding:10px 2px 2px 2px;"> <i class="icon-upload-alt"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Envie aqui seu RCCM referente a sua atividade:')?> <b><span id="tipo_acesso">AUTO-ÉCOLE</span></b> </div>
                            <div>
<?php                               //montar IFRAME
                                    $idTemp = $array_temp;//id do retorno
                                    $idIframe = "pdfDOC".$array_temp;//id do iframe
                                    $arqTipo = "pdf";//tipos de arquivos
                                    $n_arqQtd = "1";//quantidade de arquivos maximo
                                    $desc = "0";//ativar descicao, 1 ligado, 0 desligado
                                    $funcao = "contfUpl1".$INC_FAISHER["div"];//executar funcao
                                    ?>
                                  <iframe name="<?=$idIframe?>" style="border:0; overflow:hidden;" src="geral/upload_iframe.php?idTemp=<?=$idTemp?>&idIframe=<?=$idIframe?>&arq=<?=$arqTipo?>&n_arq=<?=$n_arqQtd?>&desc=<?=$desc?>&funcao=<?=$funcao?>&X" frameborder="0"  scrolling="no"  id="<?=$idIframe?>" width="100%" height="100%"> </iframe>
<input id="cont_upload1" name="cont_upload1" type="hidden" value="0" />
<script>
function loadfUpl1<?=$INC_FAISHER["div"]?>(){
	if($('#IDFormCadastro #<?=$idIframe?>').attr('src') == "geral/upload_iframe.php?idTemp=<?=$idTemp?>&idIframe=<?=$idIframe?>&arq=<?=$arqTipo?>&n_arq=<?=$n_arqQtd?>&desc=<?=$desc?>&funcao=<?=$funcao?>&X"){
		$('#IDFormCadastro #<?=$idIframe?>').attr('src','geral/upload_iframe.php?idTemp=<?=$idTemp?>&idIframe=<?=$idIframe?>&arq=<?=$arqTipo?>&n_arq=<?=$n_arqQtd?>&desc=<?=$desc?>&funcao=<?=$funcao?>&X');
	}
}//loadfUpl1
function contfUpl1<?=$INC_FAISHER["div"]?>(cont){
	$('#IDFormCadastro #cont_upload1').val(cont);
}//contfUpl1
$(document).ready(function(e) {
    loadfUpl1<?=$INC_FAISHER["div"]?>();
});
</script>
						
                            </div>
                        </div>  
                    </div>
                    
                    
					<div class="control-group">                    
                        <div class="row-fluid">
                            <div style="background:#CCC; color:#FFF; padding:10px 2px 2px 2px;"> <i class="icon-upload-alt"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Envie aqui seu DOCUMENTO PESSOAL')?></div>
                            <div>
<?php                               //montar IFRAME
                                    $idTemp = $array_temp;//id do retorno
                                    $idIframe = "pdfDOC2".$array_temp;//id do iframe
                                    $arqTipo = "pdf";//tipos de arquivos
                                    $n_arqQtd = "1";//quantidade de arquivos maximo
                                    $desc = "0";//ativar descicao, 1 ligado, 0 desligado
                                    $funcao = "contfUpl2".$INC_FAISHER["div"];//executar funcao
                                    ?>
                                  <iframe name="<?=$idIframe?>" style="border:0; overflow:hidden;" src="geral/upload_iframe.php?idTemp=<?=$idTemp?>&idIframe=<?=$idIframe?>&arq=<?=$arqTipo?>&n_arq=<?=$n_arqQtd?>&desc=<?=$desc?>&funcao=<?=$funcao?>&X" frameborder="0"  scrolling="no"  id="<?=$idIframe?>" width="100%" height="100%"> </iframe>
<input id="cont_upload2" name="cont_upload2" type="hidden" value="0" />
<script>
function loadfUpl2<?=$INC_FAISHER["div"]?>(){
	if($('#IDFormCadastro #<?=$idIframe?>').attr('src') == "geral/upload_iframe.php?idTemp=<?=$idTemp?>&idIframe=<?=$idIframe?>&arq=<?=$arqTipo?>&n_arq=<?=$n_arqQtd?>&desc=<?=$desc?>&funcao=<?=$funcao?>&X"){
		$('#IDFormCadastro #<?=$idIframe?>').attr('src','geral/upload_iframe.php?idTemp=<?=$idTemp?>&idIframe=<?=$idIframe?>&arq=<?=$arqTipo?>&n_arq=<?=$n_arqQtd?>&desc=<?=$desc?>&funcao=<?=$funcao?>&X');
	}
}//loadfUpl2
function contfUpl2<?=$INC_FAISHER["div"]?>(cont){
	$('#IDFormCadastro #cont_upload2').val(cont);
}//contfUpl2
$(document).ready(function(e) {
    loadfUpl2<?=$INC_FAISHER["div"]?>();
});
</script>
						
                            </div>
                        </div>  
                    </div>    
                    
                    
                    
                                    
                    
                    <div>
                        <button class="btn btn-large" style="float:left;" onClick="$('#tb-cad1').click();return false;"><i class="icon-chevron-left"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Anterior')?></button>
                        <button class="btn btn-primary btn-large" style="float:right;" onClick="btCad2();return false;" id="bt_cad2"><?=$class_fLNG->txt(__FILE__,__LINE__,'Próximo')?> <i class="icon-chevron-right"></i></button>             
                    </div>
                    
                    <div style="clear:both; height:5px;"></div>                    
                </div>                
                
				<div class="tab-pane" id="etp-cad3">											
                    <div class="control-group">
                        <div class="controls"><?=$class_fLNG->txt(__FILE__,__LINE__,'Seu País')?>
							<input type='hidden' value="Guinée" name='cpais' id='cpais'/>
							<p><b>Guinée</b></p>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls"><?=$class_fLNG->txt(__FILE__,__LINE__,'Sua Subdivisão/Estado')?>
<input type='hidden' value="" name='cuf' id='cuf' style="width:98%;"/>
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#IDFormCadastro #cuf').select2({
		/*maximumSelectionSize: 1,multiple: true,//*/
		placeholder: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Sel. subdivisão >> (comece a digitar para buscar)')?>',
		ajax: {
			url: "geral/combo_publico_ajax.php?ajax=uf&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 50, // page size
					pais: $('#IDFormCadastro #cpais').val()
				};
			},
			results: function (data, page) {
				return { results: data.results };
			}
		},
		formatResult: formatSelect2HTML,
		formatSelection: formatSelect2HTML,
		escapeMarkup: function(m) { return m; }
	});
	$("#IDFormCadastro #cuf").on("change", function(e){ $('#IDFormCadastro #ccidade_id').select2("data", ''); });
});
</script>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls"><?=$class_fLNG->txt(__FILE__,__LINE__,'Sua cidade')?>
<input type='hidden' value="" name='ccidade_id' id='ccidade_id' style="width:98%;"/>
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#IDFormCadastro #ccidade_id').select2({
		/*maximumSelectionSize: 1,multiple: true,//*/
		placeholder: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Sel. cidade >> (comece a digitar para buscar)')?>',
		ajax: {
			url: "geral/combo_publico_ajax.php?ajax=cidade&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 50, // page size
					uf: $("#IDFormCadastro #cuf").val()
				};
			},
			results: function (data, page) {
				return { results: data.results };
			}
		},
		formatResult: formatSelect2HTML,
		formatSelection: formatSelect2HTML,
		escapeMarkup: function(m) { return m; }
	});
});
</script>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls"><?=$class_fLNG->txt(__FILE__,__LINE__,'Seu setor')?>
<input type='hidden' value="" name='cbairro' id='cbairro' style="width:98%;"/>
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#IDFormCadastro #cbairro').select2({
		/*maximumSelectionSize: 1,multiple: true,//*/
		placeholder: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Sel. setor >> (comece a digitar para buscar/adicionar)')?>',
		ajax: {
			url: "geral/combo_publico_ajax.php?ajax=comboBairros&add&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 50, // page size
					cidade: $("#IDFormCadastro #ccidade_id").val()
				};
			},
			results: function (data, page) {
				return { results: data.results };
			}
		},
		formatResult: formatSelect2HTML,
		formatSelection: formatSelect2HTML,
		escapeMarkup: function(m) { return m; }
	});
});
</script>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls"><?=$class_fLNG->txt(__FILE__,__LINE__,'Seu logradouro/rua')?>
<input type='hidden' value="" name='clogradouro' id='clogradouro' style="width:98%;"/>
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#IDFormCadastro #clogradouro').select2({
		/*maximumSelectionSize: 1,multiple: true,//*/
		placeholder: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Sel. logradouro >> (comece a digitar para buscar/adicionar)')?>',
		ajax: {
			url: "geral/combo_publico_ajax.php?ajax=comboLogradouro&add&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 50, // page size
					cidade: $("#IDFormCadastro #ccidade_id").val()
				};
			},
			results: function (data, page) {
				return { results: data.results };
			}
		},
		formatResult: formatSelect2HTML,
		formatSelection: formatSelect2HTML,
		escapeMarkup: function(m) { return m; }
	});


//controle de campo email 
	$('#cemail2').bind('cut copy paste', function(event) {
		event.preventDefault();
	});
});
</script>
                        </div>
                    </div>			
                    <div class="control-group">
                        <div class="controls"><div style="clear:both;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Referência')?></div>
							<input type="text" name="creferencia" id="creferencia" value="" placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Referência')?>" class="input-block-level">
                        </div>
                    </div>		
                    <div class="control-group">
                        <div class="controls"><?=$class_fLNG->txt(__FILE__,__LINE__,'Código de Energia')?>
                            <input type="text" id='ccodigo_energia' name='ccodigo_energia' placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Seu código de energia')?>" class='input-block-level'>
                        </div>
                    </div>
                    
                    
                    <div>
                    	<button class="btn btn-large" style="float:left;" onClick="$('#tb-cad2').click();return false;"><i class="icon-chevron-left"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Anterior')?></button>
                    	<button class="btn btn-primary btn-large" style="float:right;" onClick="btCad3();return false;" id="bt_cad3"><?=$class_fLNG->txt(__FILE__,__LINE__,'Próximo')?> <i class="icon-chevron-right"></i></button>             
                    </div>
            		<div style="clear:both; height:5px;"></div>
                    
				</div>
                
				<div class="tab-pane" id="etp-cad4">											
                    <div class="control-group">
                        <div class="email controls"><?=$class_fLNG->txt(__FILE__,__LINE__,'Seu email (usaremos para seu acesso)')?>
                            <input type="text" id='cemail' name='cemail' placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Seu email de acesso')?>" class='input-block-level' data-rule-required="true" data-rule-email="true">
            
                <div class="alert alert-info" style="margin-top:10px; text-align:justify;" id="div_cadastro_ajuda">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<?=$class_fLNG->txt(__FILE__,__LINE__,'<strong>Importante!</strong> Utilize aqui seu email de acesso. <strong>*Importante usar um email que você tenha acesso e não esqueça a senha... :)</strong>')?>
                </div>
                        </div>
                    </div>		
                    <div class="control-group">
                        <div class="email controls"><?=$class_fLNG->txt(__FILE__,__LINE__,'Digite novamente pra confirmarmos que está certo')?> :)
                            <input type="text" id='cemail2' name='cemail2' placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Seu email de acesso')?>" class='input-block-level' data-rule-required="true" data-rule-email="true">
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="pw controls"><?=$class_fLNG->txt(__FILE__,__LINE__,'Sua senha de acesso (mínimo 6 caracters)')?>
                            <input type="password" id="csenha1" name="csenha1" autocomplete="off" placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Senha de acesso')?>" class='input-block-level' data-rule-required="true">
                            <div id="csenha1_forca"><span class="badge"><?=$class_fLNG->txt(__FILE__,__LINE__,'informe uma senha difícil')?></span></div>
                        </div>
                    </div>
<input id="csenha1_forca_val" name="csenha1_forca_val" type="hidden" value="0" />
<style> #csenha1_forca span{ width:95%; text-align:center; padding:5px; } </style>
<script type='text/javascript'>//<![CDATA[
$(window).load(function(){
$('#csenha1').keyup(function(e) {
     var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
     var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|(?=.*[&._-`´^~,:;#@!])|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
     var enoughRegex = new RegExp("(?=.{6,}).*", "g");
     if ($(this).val().length == 0) {
             $('#csenha1_forca_val').val('0');
             $('#csenha1_forca').html('<span class="badge"><?=$class_fLNG->txt(__FILE__,__LINE__,'informe uma senha difícil')?></span>');
	 }else if(false == enoughRegex.test($(this).val())){
             $('#csenha1_forca_val').val('0');
             $('#csenha1_forca').html('<span class="badge badge-inverse"><?=$class_fLNG->txt(__FILE__,__LINE__,'Precisamos de uma senha maior!')?></span>');
     }else if(strongRegex.test($(this).val())){
             $('#csenha1_forca_val').val('1');
             $('#csenha1_forca').html('<span class="badge badge-success"><i class="icon-trophy"></i><br><?=$class_fLNG->txt(__FILE__,__LINE__,'Jóia! Muito boa a sua senha')?> :)</span>');
     }else if(mediumRegex.test($(this).val())){
             $('#csenha1_forca_val').val('1');
             $('#csenha1_forca').html('<span class="badge badge-info"><?=$class_fLNG->txt(__FILE__,__LINE__,'Melhorou, senha já é aceita!<br>Mas, pode melhorar mais se quiser')?> :)</span>');
     }else{
             $('#csenha1_forca_val').val('0');
             $('#csenha1_forca').html('<span class="badge badge-important"><?=$class_fLNG->txt(__FILE__,__LINE__,'SENHA MUITO SIMPLES<br>Precisamos de uma senha mais forte!<br><br>!!icon!! Utilize letras e números ou símbolos,<br>uma boa senha protege seu nome digital',array("icon"=>'<i class="icon-question-sign"></i>'))?> :)</span>');
     }
     return true;
});
});//]]> 
</script>
                    <div class="control-group">
                        <div class="pw controls"><?=$class_fLNG->txt(__FILE__,__LINE__,'Confirme a senha')?>
                            <input type="password" id="csenha2" name="csenha2" autocomplete="off" placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Confirmar senha')?>" class='input-block-level' data-rule-required="true">
                        </div>
                    </div>
                    
<script>
function sysCaptcha3(){
	$(".sysCaptcha_limpar").empty();
	loaderFoco('div_sysCaptcha3','sysCaptcha3_load',' verificação de span...'); $("#sysCaptcha3_load").fadeIn();
	faisher_ajax('sysCaptcha3', '0', 'ajax/sysCaptcha_ajax.php', 'load=sysCaptcha3_load&semrobo=0', 'get', 'ADD');
}
</script>
				<div style="padding-top:0; margin-top:0; min-height:80px;" id="div_sysCaptcha3">
                  <div style="position:absolute; width:100%; margin-left:-30px; text-align:center; min-height:75px;" class="sysCaptcha_limpar" id="sysCaptcha3"><?=$class_fLNG->txt(__FILE__,__LINE__,'verificação de span')?></div>
                </div>
                    
                    <div style="padding:30px 10px 20px 10px; color:#333; font-size:10px; text-align:justify; line-height:normal;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Ao clicar no botão FINALIZAR, você declara, para os devidos fins e efeitos legais, serem pessoais e verdadeiras as informações inseridas no cadastro, sobre as quais assume todas as responsabilidades.')?></div>
                
                    <div>
                    	<button class="btn btn-large" style="float:left;" onClick="$('#tb-cad3').click();return false;"><i class="icon-chevron-left"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Anterior')?></button>
                    	<button class="btn btn-primary btn-large" style="float:right;" onClick="envCadConfirma();return false;" id="bt_cad4"><?=$class_fLNG->txt(__FILE__,__LINE__,'Finalizar')?> <i class="icon-chevron-right"></i></button>             
                    </div>
            		<div style="clear:both; height:5px;"></div>
                    
				</div>
			</div>
            
            
			</form>
            

<?php
//VALIDA FORM AJAX
$AJAX_COD_INC = "
	if($('#IDFormLogin').validate().form() == false){ valedaform = \"0\"; }
	if(btCad4() == false){ valedaform = \"0\"; }
	if((valedaform == \"1\") && ($('#csenha1_forca_val').val() != \"1\")){
		valedaform = \"0\";
		$('#modal_alerta .conteudo').html('".$class_fLNG->txt(__FILE__,__LINE__,'<b>Precisamos que verifique a senha informada!</b><br>Informe uma senha mais forte, com letras e números ou símbolos')." :)');
		$('#modal_alerta').modal('show');
	}
	
	if(valedaform == \"1\"){
		$('#modal_cadastro').modal('hide');
		loaderFoco('div_cadastro','div_cadastro_load',' ".$class_fLNG->txt(__FILE__,__LINE__,'já estamos verificando o cadastro, aguarde...')."');
		$('#div_cadastro_load').fadeIn();	
	}";

//include de script jQuery de envio de forms
//VARIAVEIS DE CONTROLE GERAL DO INCLUDE
$AJAX_METODO_INC = "post";//metodo de envio get, post
$AJAX_GET_INC = "ajax=verificarcadastro";//vars GET de envio URL
$AJAX_FORM_INC = "IDFormCadastro";//id do formulario de trabalho
$AJAX_DADOS_INC = "";//nome dos campos de retorno, {'campo='+$('#campo').val()+'&campo2='+$('#campo2').val()} (opcional)
$AJAX_IDFUNCAO_INC = "sendFormCadastro";//nome da funcao de retorno [nome funcao]();
$AJAX_URL_INC = "ajax/login_ajax.php"; //url de envio
$AJAX_LOAD_INC = "ADD"; //define se esconde o conteudo com load - ADD
$AJAX_CARREGANDO_INC = "0"; //div de carregando
$AJAX_PAG_DIV_INC = "div_oculta"; //div de dados
include "sys/inc_sendForms.php";
?>

			<div style="clear:both; height:20px;"></div>
		</div>
	</div>    
<script>
function envCadConfirma(){
	if(btCad4() != false){
		$('#modal_cadastro .cadMd-email').html($('#IDFormCadastro #cemail').val());
		$('#modal_cadastro .cadMd-doc_nome').html($('#IDFormCadastro #cdoc_nome').val());
		$('#modal_cadastro .cadMd-doc_numero').html($('#IDFormCadastro #cdoc_numero').val());		
		$('#modal_cadastro .cadMd-datan').html($('#IDFormCadastro #cdatan').val()+', '+calcularIdade($('#IDFormCadastro #cdatan').val())+' anos');
		$('#modal_cadastro').modal('show');
	}
}
</script>
		<div id="modal_cadastro" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3><?=$class_fLNG->txt(__FILE__,__LINE__,'CONFIRME SE ESTÁ CERTO')?></h3>
			</div>
			<div class="modal-body">
                <div class="cadMd-titu"><?=$class_fLNG->txt(__FILE__,__LINE__,'Email informado, <b>está certo?</b>')?></div><div class="cadMd-email"></div>                
                <div class="cadMd-titu"><?=$class_fLNG->txt(__FILE__,__LINE__,'Documento informado, este mesmo?')?></div><div class="cadMd-doc_nome"></div> <div class="cadMd-doc_numero"></div>       
                <div class="cadMd-titu"><?=$class_fLNG->txt(__FILE__,__LINE__,'Data de Nascimento informada, está correta?')?></div><div class="cadMd-datan"></div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-success btn-large" onClick="sendFormCadastro();"><?=$class_fLNG->txt(__FILE__,__LINE__,'CONFIRMAR DADOS')?></button> <button class="btn btn-large" data-dismiss="modal"><?=$class_fLNG->txt(__FILE__,__LINE__,'Voltar Ajustar')?></button>
			</div>
		</div>    
    

    
    
	<div id="modal_alerta" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel"><?=$class_fLNG->txt(__FILE__,__LINE__,'ALERTA')?></h3>
		</div>
		<div class="modal-body">
			<p class="conteudo"></p>
		</div>
		<div class="modal-footer">
			<button class="btn btn-primary" data-dismiss="modal"><?=$class_fLNG->txt(__FILE__,__LINE__,'Ok')?></button>
		</div>
	</div>
        
<div style="width:1px; height:1px; position:absolute;" id="div_auxiliar"></div>
<div style="height:1px; display:none;" id="div_oculta"></div>
</body>

</html>
