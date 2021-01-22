<?php // Breno Cruvinel - breno.cruvinel09@gmail.com
//ini_set('display_errors',1);ini_set('display_startup_erros',1);error_reporting(E_ALL);

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//ini_set('display_errors',1); ini_set('display_startup_erros',1); error_reporting(E_ALL);

//echo "1 - ".$_SERVER["SERVER_ADDR"]; echo ", 2 - ".$_SERVER["REMOTE_ADDR"]; echo ", 3 - ".$_SERVER["SERVER_PORT"]."<br>";
//echo "_SERVER<pre>"; print_r($_SERVER); echo "</pre>"; exit(0);

//BLOQUEIA O ACESSO FORA DO LOCAL NO SERVIDOR LOCAL
//if(($_SERVER["SERVER_ADDR"] != $_SERVER["REMOTE_ADDR"]) or ($_SERVER["SERVER_PORT"] != "443")){ echo "0"; exit(0); }


/* COMO IMPLEMENTAR::
$opts = array(
	'http'=>array('header'=>"Content-type: application/x-www-form-urlencoded", 'method'=>'POST', 'content'=>http_build_query(array(
		//CONFIGURAÇÕES
		'MAIL_HOST' => "mail.teste.com",
		'MAIL_TIPO' => "tls",// SMTP ("","ssl","tls")
		'MAIL_PORTA' => "587",//465
		'MAIL_USER' => "tste@teste.com",
		'MAIL_PASS' => "XXXXXXX",
		'MAIL_NOME' => "teste",
		'MAIL_EMAIL' => "teste@teste.com",
		'MAIL_DEBUG' => "0",//ativar debug -- 1 = Erros e mensagens, 2 = Apenas mensagens, SMTP::DEBUG_SERVER
		//DADOS DO ENVIO
		'SEND_NOME' => "Breno Cruvinel",
		'SEND_EMAIL' => "breno.cruvinel09@gmail.com",
		'SEND_ASSUNTO' => "teste, Teste Debug",
		'SEND_BODY' => "Mensagem Teste!! <br><br>".date('d/m/Y H:i')."h"
		))),"ssl"=>array("verify_peer"=>false,"verify_peer_name"=>false)
); $context = stream_context_create($opts);
//informações do retorno: 0 - bloqueado acesso, 1 - sucesso, 2 - erros de configuração, 3 - erro de classe
$contentResp = file_get_contents(SYS_URLRAIZ.'sys/http_send_email.php?JesusTeAma=1', false, $context);
echo "<br>DEBUG<pre>"; print_r($contentResp); echo "</pre>";
*/


//função para limpeza de html e criação de texto plano para envios de email
function limpaHtmlSendMail_($text) {
	$text = strip_tags($text,"<style>");
	$substring = substr($text,strpos($text,"<style"),strpos($text,"</style>")+2);
	//echo "<br><br><br>".$substring."<br><br><br>";
	$text = str_replace($substring,"",$text);
	//$text = str_replace(array("\t","\r","\n"),"",$text);
	$text = str_replace("tyle>","",$text);
	$text = trim($text);	
	return $text;
}//limpaHtmlSendMail_


if(isset($_GET["JesusTeAma"])){
	//configurações
	$MAIL_HOST = $_POST["MAIL_HOST"];
	$MAIL_TIPO = $_POST["MAIL_TIPO"];
	$MAIL_PORTA = $_POST["MAIL_PORTA"];
	$MAIL_USER = $_POST["MAIL_USER"];
	$MAIL_PASS = $_POST["MAIL_PASS"];
	$MAIL_NOME = $_POST["MAIL_NOME"];
	$MAIL_EMAIL = $_POST["MAIL_EMAIL"];
	$MAIL_DEBUG = $_POST["MAIL_DEBUG"];
	//dados do envio
	$SEND_NOME = $_POST["SEND_NOME"];
	$SEND_EMAIL = $_POST["SEND_EMAIL"];	
	$SEND_ASSUNTO = $_POST["SEND_ASSUNTO"];
	$SEND_BODY = $_POST["SEND_BODY"];
	//echo "_SERVER<pre>"; print_r($_SERVER); echo "</pre>"; exit(0);


	//enviar email de confirmação
	//require(VAR_DIR_RAIZ."sys/phpmailer/autoload.php"); //Certifique-se de que o caminho está certo.
	require("phpmailer/autoload.php"); //Certifique-se de que o caminho está certo.
	
	//#################### INICIO ENVIA EMAIL ##################>>>>>>>>>>>>>>>>
	// Instantiation and passing `true` enables exceptions
	$mail = new PHPMailer(true);
	try {
		//Server settings
		if($MAIL_DEBUG != "0"){
			if($MAIL_DEBUG == "SMTP::DEBUG_SERVER"){
				$mail->SMTPDebug = SMTP::DEBUG_SERVER;                    // Enable verbose debug output
			}else{//if($MAIL_DEBUG == "SMTP::DEBUG_SERVER"){
				$mail->SMTPDebug = $MAIL_DEBUG;                              		// Enable verbose debug output -- 1 = Erros e mensagens, 2 = Apenas mensagens
			}//else{//if($MAIL_DEBUG == "SMTP::DEBUG_SERVER"){
		}//if($MAIL_DEBUG != "0"){
		$mail->CharSet = 'UTF-8';
		$mail->isSMTP();                                            // Send using SMTP
		$mail->Host       = $MAIL_HOST;         		            // Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
		//$mail->SMTPAutoTLS  = true;                               // Enable SMTP authentication
		$mail->SMTPSecure = $MAIL_TIPO;
		$mail->Username   = $MAIL_USER;                     	    // SMTP username
		$mail->Password   = $MAIL_PASS;                             // SMTP password
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
		$mail->Port       = $MAIL_PORTA;      		                // TCP port to connect to
		//Recipients
		$mail->setFrom($MAIL_EMAIL, $MAIL_NOME);
		$mail->addAddress($SEND_EMAIL, $SEND_NOME);  				// Add a recipient
		// Attachments
		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	   // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		// Content
		$mail->isHTML(true); 
		$mail->Subject = $SEND_ASSUNTO;
		$mail->Body    = $SEND_BODY;//texto html
		$mail->AltBody    = limpaHtmlSendMail_($SEND_BODY);//texto plano
		if(!$mail->send()){
			if($MAIL_DEBUG != "0"){
				echo 'Opss... Ouve um problema interno, não foi possível enviar o email de confirmação, tente novamente mais tarde!';
				//echo '<br>Mailer Error: asd' . $mail->ErrorInfo;
			}else{ echo "2"; }
			
		}else{//if(!$mail->send()){
			if($MAIL_DEBUG != "0"){
				echo 'Foi enviado um email de confirmação para: '.$MAIL_EMAIL.', verifique sua caixa de span caso não localize o email!';
			}else{ echo "1"; }
			
		}//else{//if(!$mail->send()){
	} catch (Exception $e) {
		//if($MAIL_DEBUG != "0"){
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		//}else{ echo "3"; }
	}
	//#################### FIM ENVIA EMAIL ##################<<<<<<<<<<<<<<




}///if(isset($_GET["JesusTeAma"])){


