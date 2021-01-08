<?php //Breno Cruvinel - breno.cruvinel09@gmail.com
$ajax = "OFF"; //zera a variavel AJAX e nao executa as funcoes ajax
//ini_set('display_errors',1);ini_set('display_startup_erros',1);error_reporting(E_ALL);
//vars para paginacao em AJAX -------------------------------------|| AJAX --- <<<
if(isset($_GET["ajax"])){//verifia se chamou função AJAX da Pagina
	$ajax = $_GET["ajax"];

	//INCLUDES DE CONTROLE --->>>
	include "../config/globalSession.php";//inicia sessao php
	include "../config/globalVars.php";//vars padrao
	include "../sys/langAction.php";//inicia arquivo de linguage		
	include "../sys/globalFunctions.php";//funcoes padrao
	include "../sys/globalClass.php";//classes padrao
	include "../sys/classConexao.php";//classes de conexao
	include "../sys/incUpdate.php";//verificador de updates
	include "../config/incPacote.php";//vars do pacote de cliente
	include "../sys/classValidaAcesso.php";//classes de validação de acesso
	//INCLUDES DE CONTROLE ---<<<
	
//INICIAR ARQUIVO DE LINGUAGEM --->>>
$class_fLNG->loadFile(__FILE__);//incluir o arquivo de linguagem
//INICIAR ARQUIVO DE LINGUAGEM ---<<<	
	
	#Evitando cache de arquivo   
	header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');   
	header('Last-Modified: '. gmdate('D, d M Y H:i:s') .' GMT');   
	header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0',false);   
	header('Pragma: no-cache');   
	header("Cache: no-cache");     
	header('Expires: 0'); 
	
	//FUNCOES INICIAIS --->>>
	//conexao DB
	$classe_db = new classe_DB;//inicia a classe de conexao
	$classe_db->AbreConexaoPai();//Abrimos a conexão Pai
	//FUNCOES INICIAIS ---<<<


	//CLASSES PROTEGE PAGINA/LOGIN --->>>
	//protege a pagina
	$cVLogin = new classVLOGIN;//inicia a classe de login
	$cVLogin->loginCookie("OFF");//verifica o login e cria array de login
	$RETORNO_SESSION = $cVLogin->loginSession("","OFF");//faz a atualização de session do login atual
	//CLASSES PROTEGE PAGINA/LOGIN ---<<<


}//fim else - if(isset($_GET["ajax"])){//verifia se chamou função AJAX da Pagina




















//AJAX QUE EXIBE ITEM TIME ------------------------------------------------------------------>>>
if($ajax == "time"){
	if(!isset($_GET["hide"])){ echo  nome_diasemana(date('w')).", ".date('H:i'); }
	
	
	//verifica Update
	if(isset($fUPDATE["0"])){		
		if(strlen($fUPDATE["0"]) == "3"){ $fUPDATE["0"] = "0".$fUPDATE["0"]; }
		$timeUp = time_data_hora(date('d/m/Y')." ".substr($fUPDATE["0"],-4,2).":".substr($fUPDATE["0"],-2));
		$updateMin = (int)(($timeUp-time())/60);
		if(($updateMin >= "1") and ($updateMin <= "5")){
			$alertaUpdate = "1";
			if($updateMin == "1"){
				$updateMin = "menos de 1min";
			}else{
				$updateMin = $updateMin."min";
			}
		}//if($updateMin >= "1"){
	}//if(isset($fUPDATE["0"])){
		
		

	
	$credenciamento_cont = "0";	if($cVLogin->loginAcesso("7_axl_usuario_verificacao")){ $credenciamento_cont = fSQL::SQL_CONTAGEM("sys_login","status = '3'"); }
	$motivo_cont = "0";	if($cVLogin->loginAcesso("7_axl_gestaooperacao")){ $motivo_cont = fSQL::SQL_CONTAGEM("axl_processo","motivo_id >= '1'"); }
?>
<script>
$.doTimeout('vTimerTM', 200, function(){
	$('#timeActive').val('<?=time()?>');
<?php if($RETORNO_SESSION == "0"){?> if(!$('#divLoginBloq').is(':visible')){ bloqSession(); }<?php }?>
<?php if($alertaUpdate == "1"){?>$("#divUpdateAlert").html('<div style="width:300px; height:90px; padding:5px; background:#FFF; color:#000;"><div style="font-size:18px; color:#069;">Olá <?=sentenca(primeiro_nome($cVLogin->getVarLogin("SYS_USER_NOME")))?>,</div><div style="font-size:13px;">O AXL precisa realizar uma atualização!</div><div style="font-size:16px; text-align:center;">Atualização em <b><?=$updateMin?></b></div><div style="font-size:13px; text-align:center;">"FINALIZE O QUE ESTÁ FAZENDO E AGUARDE"</div><div style="font-size:11px; text-align:right; margin-top:-5px;">*Pode manter a janela aberta até finalizar :)</div></div>'); alertUpdate();<?php }?>

<?php if($credenciamento_cont >= "1"){?> $("#bt_credenciamento_cont").html('<?=$credenciamento_cont?>'); $("#bt_credenciamento_cont").fadeIn(); <?php }else{?> $("#bt_credenciamento_cont").fadeOut(); <?php }?>

<?php if($motivo_cont >= "1"){?> $("#bt_motivo_cont").html('<?=$motivo_cont?>'); $("#bt_motivo_cont").fadeIn(); <?php }else{?> $("#bt_motivo_cont").fadeOut(); <?php }?>



});//TIMER
</script>
<?php

}//fim ajax lista ------------------------------------------------------------------------------------------ <<<













































?>
<?php





if(isset($_GET["ajax"])){//verifia se chamou função AJAX da Pagina
	//REMOVE CONEXAO
	//fecha todas as conexoes abertas
	$classe_db->FechaConexaoAll($SCRIPTOFF);//fecha conexoes
}
?>