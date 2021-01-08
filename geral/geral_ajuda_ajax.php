<?php //Breno Cruvinel - breno.cruvinel09@gmail.com
$ajax = "OFF"; //zera a variavel AJAX e nao executa as funcoes ajax
//vars para paginacao em AJAX -------------------------------------|| AJAX --- >>>
$IDACESSO_PAG = "";//id pagina que vai ser carregada
$AJAX_PAG = "geral_ajuda_ajax.php";//pagina que vai ser carregada

//vars para paginacao em AJAX -------------------------------------|| AJAX --- <<<
if(isset($_GET["ajax"])){//verifia se chamou função AJAX da Pagina
	$ajax = $_GET["ajax"];

	//INCLUDES DE CONTROLE --->>>
	include "../config/globalSession.php";//inicia sessao php
	include "../config/globalVars.php";//vars padrao
include "../sys/langAction.php";//vars padrao
include "../sys/globalFunctions.php";//funcoes padrao
include "../sys/globalClass.php";//classes padrao
	include "../sys/classConexao.php";//classes de conexao
	include "../sys/incUpdate.php";//verificador de updates
	include "../config/incPacote.php";//vars do pacote de cliente
	include "../sys/classValidaAcesso.php";//classes de validação de acesso
	include "../sys/cabecalho_ajax.php"; //cabeçalho ajax para correção de acentos e cache
	//INCLUDES DE CONTROLE ---<<<
	
	//FUNCOES INICIAIS --->>>
	//conexao DB
	$classe_db = new classe_DB;//inicia a classe de conexao
	$classe_db->AbreConexaoPai();//Abrimos a conexão Pai
	//FUNCOES INICIAIS ---<<<


	//CLASSES PROTEGE PAGINA/LOGIN --->>>
	//protege a pagina
	$cVLogin = new classVLOGIN;//inicia a classe de login
	$cVLogin->loginCookie();//verifica o login e cria array de login
	$cVLogin->loginSession();//faz a atualização de session do login atual
	//CLASSES PROTEGE PAGINA/LOGIN ---<<<


}//fim else - if(isset($_GET["ajax"])){//verifia se chamou função AJAX da Pagina


?>
<?php

















//AJAX QUE EXIBE ITEM DE TITULO ------------------------------------------------------------------>>>
if($ajax == "d_top"){	
	if(isset($_GET["topico"])){ $topico = getpost_sql($_GET["topico"]); }else{ $topico = "nulo"; }
	if($topico == ""){ $topico = "nulo"; }
	$html_ret = '';

	if($topico == "home"){
		$html_ret = '<b>O que é a página hoje?</b><br><br>
		A página tem a função de exibir resumos e atalhos com as permissões do usuário ativo.<br>';
	}

	if($topico == "sys_meusdados"){
		$html_ret = '<b>O que é a página meus dados?</b><br><br>
		Nessa página é possível ajustar seus dados cadastrais, acompanhar sessões de login ativos e alterar sua foto de perfil.<br>';
	}
	
	






	//pega padrao
	if($html_ret == ""){
		$resu1 = fSQL::SQL_SELECT_SIMPLES("legenda,obs", "sys_permissao", "tag = '$topico'", "");
		while($linha1 = fSQL::FETCH_ASSOC($resu1)){
			$legenda_i = maiusculo($linha1["legenda"]);
			$obs_i = $linha1["obs"];
			$html_ret = '<b>'.$legenda_i.'</b><br><br>'.$obs_i.'';
		}//while
	}

	if($html_ret == ""){
		$html_ret = '<b>Erro ao encontrar o tópico ('.$topico.')!</b><br><br>
		Atualize a página e tente novamente.';
	}

	//retorno
	echo $html_ret;

}//fim ajax lista ------------------------------------------------------------------------------------------ <<<
?>
<?php






//REMOVE CONEXAO
//fecha todas as conexoes abertas
$classe_db->FechaConexaoAll($SCRIPTOFF);//fecha conexoes
?>