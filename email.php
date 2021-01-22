<?php // Breno Cruvinel - breno.cruvinel09@gmail.com
//ini_set('display_errors',1);ini_set('display_startup_erros',1);error_reporting(E_ALL);aoskdpoaksdpok
//INCLUDES DE CONTROLE --->>>
include "config/globalSession.php";//inicia sessao php
include "config/globalVars.php";//vars padrao
include "sys/langAction.php";//inicia arquivo de linguage
include "sys/globalFunctions.php";//funcoes padrao
include "sys/globalClass.php";//classes padrao
include "sys/classConexao.php";//classes de conexao
include "sys/incUpdate.php";//verificador de updates
include "config/incPacote.php";//vars do pacote de cliente
//include "sys/cabecalho_ajax.php";//classes de conexao
//INCLUDES DE CONTROLE ---<<<

$ajax = isset($_GET["ajax"]) ? $_GET["ajax"] :  '';
echo "<br>ajax:".$ajax;

forceHttps();//@@@@@@ FORÇAR O HTTPS +++++

ini_set('display_errors',1);ini_set('display_startup_erros',1);error_reporting(E_ALL);

if($ajax == "sms"){
	//$celular = "224660203233";//+224 660 20 32 33
	$celular = "224620406749";
	if(isset($_GET["celular"])){$celular = $_GET["celular"]; }
	if(strlen($celular) >= 12){ 
		$celular = substr($celular,3,strlen($celular)-3);
	}
	echo "<br>celular:".$celular;
	$msg = "Votre dossier a ete ouvert au SIGPC sous le numero 25445698451";
	$msg = str_replace(" ","%20",$msg);
	echo "<br>msg:".$msg;
	$result = fSMS_ECASH::send($msg, $celular);
	echo "<br>result:".$result;
}



if($ajax == "enviarEmail"){
	$email = "breno.cruvinel@hotmail.com";

		
	$html_template = file_get_contents(VAR_DIR_FILES."files/templates/email/email-notificacao.html");
	//monta mensagem template
	$html_template = str_replace("!nome_fisico!","teste",$html_template);
	$html_template = str_replace("!url_raiz!",SYS_URLRAIZ,$html_template);		
	$html_template = str_replace("!notificacao!",'notificacao',$html_template);
					
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
			'MAIL_DEBUG' => "1",//ativar debug -- 1 = Erros e mensagens, 2 = Apenas mensagens, SMTP::DEBUG_SERVER
			//DADOS DO ENVIO
			'SEND_NOME' => "Teste",
			'SEND_EMAIL' => $email,
			'SEND_ASSUNTO' => "E-mail teste",
			'SEND_BODY' => $html_template
			))),"ssl"=>array("verify_peer"=>false,"verify_peer_name"=>false)
	); $context = stream_context_create($opts);
	
	echo "\nSERVER_ADDR:".$_SERVER["SERVER_ADDR"];
	echo "\nREMOTE_ADDR:".$_SERVER["REMOTE_ADDR"];	
	//if(($_SERVER["SERVER_ADDR"] != $_SERVER["REMOTE_ADDR"]) or ($_SERVER["SERVER_PORT"] != "443")){ echo "0"; exit(0); }
	
	//informações do retorno: 0 - bloqueado acesso, 1 - sucesso, 2 - erros de configuração, 3 - erro de classe
	echo "<br>url:".SYS_URLRAIZ.'sys/http_send_email.php?JesusTeAma=1';
	$contentResp = file_get_contents(SYS_URLRAIZ.'sys/http_send_email.php?JesusTeAma=1', false, $context);
	echo "<br>contentResp:".$contentResp;
	if($contentResp != "1"){
		echo 'Opss... Ouve um problema ao enviar o e-mail!';
		echo '<br>Mailer Error: ' . $mail->ErrorInfo;
	}else{
		echo 'E-mail enviado!';
	}
}


?>