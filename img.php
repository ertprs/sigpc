<?php // Breno Cruvinel - breno.cruvinel09@gmail.com
//INCLUDES DE CONTROLE --->>>
include "config/globalSession.php";//inicia sessao php
include "config/globalVars.php";//vars padrao
include "sys/langAction.php";//vars padrao
include "sys/globalFunctions.php";//funcoes padrao
include "sys/globalClass.php";//classes padrao
include "sys/classConexao.php";//classes de conexao
include "sys/classValidaAcesso.php";//classes de validação de acesso
//include "sys/cabecalho_ajax.php";//classes de conexao
//INCLUDES DE CONTROLE ---<<<


//INICIAR ARQUIVO DE LINGUAGEM --->>>
$class_fLNG->loadFile(__FILE__);//incluir o arquivo de linguagem
//INICIAR ARQUIVO DE LINGUAGEM ---<<<
	
//FUNCOES INICIAIS --->>>
//conexao DB
$classe_db = new classe_DB;//inicia a classe de conexao
$classe_db->AbreConexaoPai();//Abrimos a conexão Pai
//FUNCOES INICIAIS ---<<<
//FUNCOES INICIAIS ---<<<
	
	
	
	
	


//verifica se o acesso é do propio servidor - se nao for, ativa acesso com login
if(($_SERVER["SERVER_ADDR"] == $_SERVER["REMOTE_ADDR"]) and (isset($_GET["get"]))){
	$semLogin = "1";
}else{//if((SYS_IPPUBLICO != $_SERVER["REMOTE_ADDR"]) or (!isset($_GET["get"]))){
	$semLogin = "0";
	//CLASSES PROTEGE PAGINA/LOGIN --->>>
	//protege a pagina
	$cVLogin = new classVLOGIN;//inicia a classe de login
	$cVLogin->loginCookie("OFF");//verifica o login e cria array de login
	//CLASSES PROTEGE PAGINA/LOGIN ---<<<
}//else{//if((SYS_IPPUBLICO != $_SERVER["REMOTE_ADDR"]) or (!isset($_GET["get"]))){
	
	



//faz impressão de código QR
if(isset($_GET['qr'])){
	//if(isset($_GET["get"])){ file_put_contents("img-".time().".txt","O: ".$_SERVER["SERVER_ADDR"]."-".$_SERVER["REMOTE_ADDR"]."-".$_GET["get"]); }
	$qr = $_GET['qr'];
	$fisico_id = $_GET['fisico_id'];
	if($fisico_id >= "1"){	
		$QR_txt = "[CODIGO DE CAPTURA]".fGERAL::gerarChave(8,"nivel2")."-".$fisico_id."-".$qr."-".fGERAL::gerarChave(16,"nivel2");
		//QR CODE ...........................................................................................................
		//$caminho_qr = $pasta_caminho."/qr.png";
		//GERAR IMAGEM DO CÓDIGO QR +++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		include('sys/phpqrcode/qrlib.php');//caminho da biblioteca
		QRcode::png($QR_txt, NULL, "H", "10", 1);//TEXTO,ARQUIVO,QUALIDADE,TAMANHO
		//GERAR IMAGEM DO CÓDIGO QR +++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	}//if($fisico_id >= "1"){
	//fecha todas as conexoes abertas
	$classe_db->FechaConexaoAll($SCRIPTOFF);//fecha conexoes
	exit(0);
}//if(isset($_GET['qr'])){
	





	
	


	
	

ini_set('memory_limit', '512M');
$ativa_protege = "1";//ativa proteção na página
$ativa_bloqueia = "0"; //desativa bloqueio de imagem

//verifica se é PDF
//url imagem
if(isset($_GET['p'])){
	$n_pdf = $_GET['pdf']; //deve enviar assim : cripto_faisher("../file.pdf", "enc");
	$n_pdf = fGERAL::cptoFaisher($n_pdf, "des");//descodifica

	$valida = "1";
	$array_validar = $_GET['p']; //deve enviar assim : cripto_faisher($SYS_ID."[,]".time().rand(), "enc");
	$array_validar = fGERAL::cptoFaisher($array_validar, "des");//descodifica
	$d = explode("[,]", $array_validar);
	if($d["0"] != $cVLogin->getVarLogin("SYS_USER_ID")){ $valida = "0"; echo "SEU USUÁRIO NÃO TEM ACESSO AO PDF"; }
	if($d["1"] >= "1"){ }else{ $valida = "0"; echo "SEM ACESSO AO PDF"; }
	if(fGERAL::mostraExtensao($n_pdf) != "pdf"){ $valida = "0"; };
	if(($valida == "1") and (file_exists($n_pdf))){
		//exibir no navegador
		header("Content-Type: application/pdf");
		echo file_get_contents($n_pdf);
	}//if(($valida == "1") and (file_exists($n_pdf))){
			
	//fecha todas as conexoes abertas
	$classe_db->FechaConexaoAll($SCRIPTOFF);//fecha conexoes
	exit(0);
}//if(isset($_GET['p'])){





//url imagem
if(isset($_GET['i'])){
	$n_imagem = $_GET['imagem']; //deve enviar assim : cripto_faisher("../foto.jpg", "enc");
	if($n_imagem == ""){ $n_imagem = $_GET['f']; }
	$n_imagem = fGERAL::cptoFaisher($n_imagem, "des");//descodifica
	
	$array_validar = $_GET['i']; //deve enviar assim : cripto_faisher($SYS_ID."[,]".time().rand(), "enc");
	$array_validar = fGERAL::cptoFaisher($array_validar, "des");//descodifica
	$d = explode("[,]", $array_validar);
	if($d["0"] != $cVLogin->getVarLogin("SYS_USER_ID")){ $ativa_bloqueia .= "-user"; }
	if($d["1"] >= "1"){ }else{ $ativa_bloqueia .= "-cont"; }
}else{ $ativa_bloqueia = "nulo"; }//fim if(isset($_GET['imagem'])){
	//echo "IMG: ".$n_imagem; exit(0);


//dimencoes recebidas
	$wid = $_GET["w"];
	$hei = $_GET["h"];
//solicitação de imagem full - tamanho real
	if(($wid == "full") or ($hei == "full")){
		$tamFULL = getimagesize("$n_imagem");
		$wid = (int)$tamFULL[0];
		$hei = (int)$tamFULL[1];
	}else{
		$wid = (int)$wid;
		$hei = (int)$hei;
	}//fim imagem full*/


//verifica se exsite bloqueio de imagem
if($n_imagem == ""){ $ativa_bloqueia .= "-vazio"; }
if($ativa_bloqueia != "0"){	$n_imagem = "img/imagem_bloq.png"; }
if(!file_exists($n_imagem)){	 $n_imagem = "img/imagem_bloq.png"; }



//perara vars para imagem##################### ----
//tipo imagem
	if(exif_imagetype($n_imagem) == IMAGETYPE_GIF){ $extensao = "gif"; }
	if(exif_imagetype($n_imagem) == IMAGETYPE_JPEG){ $extensao = "jpg"; }
	if(exif_imagetype($n_imagem) == IMAGETYPE_PNG){ $extensao = "png"; }
//echo $n_imagem."-".$extensao; exit(0);

//verifica extensao
	if(($extensao == "jpg") or ($extensao == "jpeg")){
		header("Content-type: image/jpeg");
		$im       = imagecreatefromjpeg($n_imagem); // Cria uma nova imagem a partir de um arquivo ou URL
	}//fim if(($extensao == "jpg") or ($extensao == "jpeg")){
	if($extensao == "png"){
		header("Content-type: image/png");
		$im       = imagecreatefrompng($n_imagem); // Cria uma nova imagem a partir de um arquivo ou URL
	}//fim f($extensao == "png"){
	if($extensao == "gif"){
		header("Content-type: image/gif");
		$im       = imagecreatefromgif($n_imagem); // Cria uma nova imagem a partir de um arquivo ou URL
	}//fim f($extensao == "gif"){





//prepara a imagem++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++|||
	$w = imagesx($im);
	$h = imagesy($im);
	
	$w1 = $w / $wid;
	if ($hei == 0){
	  	$h1 = $w1;
		$hei = $h / $w1;
	}else{
	    $h1 = $h / $hei;
    }

	$min = min($w1,$h1);  
	   
      $xt = $min * $wid;
	  $x1 = ($w - $xt) / 2;
	  $x2 = $w - $x1;	  

      $yt = $min * $hei;
	  $y1 = ($h - $yt) / 2;
	  $y2 = $h - $y1;	  
	  
	$x1 = (int) $x1;
	$x2 = (int) $x2;
	$y1 = (int) $y1;
	$y2 = (int) $y2;				
	
    $img = NULL;	
    $img = imagecreatetruecolor($wid, $hei); 
    //$background = imagecolorallocate($img, 50, 50, 50);
    imagecolorallocate($img,255,255,255); 
    $c  = imagecolorallocate($img,255,255,255); 
    $c1 = imagecolorallocate($img,0,0,0);      
	for ($i=0;$i<=$hei;$i++){
	  imageline($img,0,$i,$wid,$i,$c);
	}      
	imagecopyresampled($img,$im,0,0,$x1,$y1,$wid,$hei,$x2-$x1,$y2-$y1);	

//verifica extensao
	if(($extensao == "jpg") or ($extensao == "jpeg")){
		imagejpeg($img);
	}//fim if(($extensao == "jpg") or ($extensao == "jpeg")){
	if($extensao == "png"){
		imagepng($img);
	}//fim f($extensao == "png"){
	if($extensao == "gif"){
		imagegif($img);
	}//fim f($extensao == "gif"){




//fecha todas as conexoes abertas
$classe_db->FechaConexaoAll($SCRIPTOFF);//fecha conexoes