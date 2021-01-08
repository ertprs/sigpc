<?php // Breno Cruvinel - breno.cruvinel09@gmail.com

/* Exemplos de  aplicar o envio de emails  
//define vars para o sendmail
$SEND_TIPO_INC = "smtp1"; //tipo do envio
$SEND_TO_INC = ""; //email Para:
$SEND_ASSUNTO_INC = ""; //email Assunto:
$SEND_CORPO_INC = ""; //email Corpo/Mensagem:
include "inc_sendmail.php"; //include que monta o envio

	//enviar gmail
	//busca template e monta mensagem
	$msg = "ALTENTICADO - Teste de sistema!";
	//define vars para o sendmail
	$SEND_TIPO_INC = "smtp2"; //tipo do envio
	$SEND_TO_INC = "breno.cruvinel09@gmail.com"; //email Para:
	$SEND_ASSUNTO_INC = "AUT - TESTE SISTEMA - ".date('d/m/Y H:i'); //email Assunto:
	$SEND_CORPO_INC = $msg; //email Corpo/Mensagem:
	$SEND_HOST_INC = "smtp.gmail.com"; //verifica host/smtp, se nao tiver coloca  padrao
	$SEND_USER_INC = "breno.cruvinel09@gmail.com"; //verifica user smtp, se nao tiver coloca  padrao
	$SEND_PASS_INC = "SENHA EMAIL"; //verifica senha, se nao tiver coloca  padrao
	$SEND_DEBUG_INC = true; //autenticação SMTP, se nao tiver coloca  padrao
	$SEND_FROMNOME_INC = "Nome resposta"; //verifica nome de resposta
	include "inc_sendmail.php"; //include que monta o envio
*/


//faz verificacoes
if(!isset($SEND_TIPO_INC)){ $SEND_TIPO_INC = "smtpSistema"; } //verifica tipo, se nao tiver coloca  padrao
if(!isset($SEND_CLASSE_INC)){ $SEND_CLASSE_INC = "sys/sendMail/"; } //verifica caminho da classe, se nao tiver coloca  padrao
if(!isset($SEND_HOST_INC)){ $SEND_HOST_INC = $GLOBAL_VARS_SMTP_HOST; } //verifica host/smtp, se nao tiver coloca  padrao
if(!isset($SEND_USER_INC)){ $SEND_USER_INC = $GLOBAL_VARS_SMTP_USER; } //verifica user smtp, se nao tiver coloca  padrao
if(!isset($SEND_PASS_INC)){ $SEND_PASS_INC = $GLOBAL_VARS_SMTP_SENHA; } //verifica senha, se nao tiver coloca  padrao
if(!isset($SEND_DEBUG_INC)){ $SEND_DEBUG_INC = $GLOBAL_VARS_SMTP_HOST_DEBUG; } //autenticação SMTP, se nao tiver coloca  padrao
if(!isset($SEND_PORTA_INC)){ $SEND_PORTA_INC = "465"; } //porta SMTP, se nao tiver coloca  padrao
if(!isset($SEND_TIPOAUTENTICACAO_INC)){ $SEND_TIPOAUTENTICACAO_INC = "tls"; } //tipo de autenticação SMTP ("","ssl","tls"), se nao tiver coloca  padrao
if(!isset($SEND_FROMNOME_INC)){ $SEND_FROMNOME_INC = $GLOBAL_VARS_SMTP_FROMNOME; } //verifica nome de origem, se nao tiver coloca  padrao
if(!isset($SEND_TO_INC)){ $SEND_TO_INC = ""; } //verifica email de envio, se nao tiver coloca  padrao
if(!isset($SEND_ASSUNTO_INC)){ $SEND_ASSUNTO_INC = ""; } //verifica assunto do email, se nao tiver coloca  padrao
if(!isset($SEND_CORPO_INC)){ $SEND_CORPO_INC = ""; } //verifica CORPO do email, se nao tiver coloca  padrao
if(!isset($SEND_RODAPE_INC)){ $SEND_RODAPE_INC = ""; } //verifica RODAPE do email, se nao tiver coloca  padrao

//verifica vars
if($SEND_ASSUNTO_INC == ""){ $SEND_ASSUNTO_INC = "[Sem Assunto]"; }
if($SEND_RODAPE_INC == ""){ 
	$SEND_RODAPE_INC = "<div style='margin:20px; margin-top:50px; font-family:Tahoma, Geneva, sans-serif; font-size:10px; text-align:center; border:#CCC 1px dotted; padding:10px;' align='center'><b>ATENÇÂO:</b> Não responda este email, este email foi enviado automaticamente por nosso sistema. Verifique as informações do email.</div>";
}




?>
<?php







	//dados do SMTP
	$SEND_FROMNOME_INC = "Grupo radarClinico.com"; //verifica nome de origem
	$SEND_USER_INC = "naoresponda@conectnegocios.com.br"; //verifica user smtp, se nao tiver coloca  padrao
	$SEND_PASS_INC = "nao321321321";
	//$SEND_HOST_INC = "smtp.gmail.com";
	$SEND_HOST_INC = "mail.conectnegocios.com.br"; //host/smtp padrao, mensagens do sistema
	$SEND_PORTA_INC = "465"; //porta SMTP, se nao tiver coloca  padrao 587
	$SEND_TIPOAUTENTICACAO_INC = "tls"; //tipo de autenticação SMTP ("","ssl","tls"), se nao tiver coloca  padrao








if($SEND_TIPO_INC == "smtpSistema"){

	//se o email de envio não estiver vazio ou for válido
	if(verifica_email($SEND_TO_INC) == "1"){
		//#################### FIM ENVIA EMAIL ##################>>>>>>>>>>>>>>>>>
		/* Purpose:	   - send mail relay (using Gmail MTA) with authentication via SSL conection (TLS encryption)	*/
		// manage errors
		//error_reporting(E_ALL); // php errors
		define('DISPLAY_XPM4_ERRORS', true); // display XPM4 errors
		
		// path to 'SMTP.php' file from XPM4 package
		require_once $SEND_CLASSE_INC.'SMTP.php';
		$f = $SEND_USER_INC; // from (Gmail mail address)
		$p = $SEND_PASS_INC; // Gmail password
		$t = $SEND_TO_INC; // to mail address

		// standard mail message RFC2822
		$m = $SEND_CORPO_INC;
		// standard mail message RFC2822
		$m = 'From: '.$SEND_FROMNOME_INC.' <'.$f.">\r\n".
			 'To: '.$t."\r\n".
			 'Subject: '.$SEND_ASSUNTO_INC."\r\n".
			 'Content-type: text/html; charset=utf-8'."\r\n\r\n".
			 $SEND_CORPO_INC.$SEND_RODAPE_INC;
		// connect to MTA server (relay) 'smtp.gmail.com' via SSL (TLS encryption) with authentication using port '465' and timeout '10' secounds
		// make sure you have OpenSSL module (extension) enable on your php configuration
		$c = SMTP::connect($SEND_HOST_INC,(int)$SEND_PORTA_INC,$f,$p,$SEND_TIPOAUTENTICACAO_INC,10) or die(print_r($_RESULT));
		
		// send mail relay
		$s = SMTP::send($c, array($t), $m, $f);
		
		// print result
		if ($s){ //echo 'Sent !';
		}else{ print_r($_RESULT); }
		
		// disconnect
		SMTP::disconnect($c);
		//#################### FIM ENVIA EMAIL ##################<<<<<<<<<<<<<<
	
	}//fim if(verifica_email($SEND_TO_INC) == "1"){

}//fim if smtpDinamico



?>
<?php






//destroe vars
unset($SEND_TIPO_INC, $SEND_FROM_INC, $SEND_TO_INC, $SEND_HOST_INC, $SEND_DEBUG_INC, $SEND_USER_INC, $SEND_PASS_INC, $SEND_CLASSE_INC);
?>