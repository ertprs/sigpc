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
	include "../sys/conexaoClass.php";//classes de conexao
	include "../sys/incUpdate.php";//verificador de updates
	include "../config/incPacote.php";//vars do pacote de cliente
	//include "../sys/cabecalho_ajax.php"; //cabeçalho ajax para correção de acentos e cache
	//INCLUDES DE CONTROLE ---<<<
	
	//FUNCOES INICIAIS --->>>
	//conexao DB
	$classe_db = new classe_DB;//inicia a classe de conexao
	$classe_db->AbreConexaoPai();//Abrimos a conexão Pai
	$SISTEMA_CONF = unserialize(VAR_SYS_CONF);//resgata variaveis de configuracao vindas da conexao pai
	//FUNCOES INICIAIS ---<<<

	//###################### verificação de permissões #################### ----------------------- >>>
	//Função de controle de permissoes de acesso, verifica no sistema
	$usuario_inc       = $PROF_USER;//ID do usuario analizado
	$file_inc          = $PERMISSAO_PAG; //nome do arquivo, busca o id da permissão pelo nome do arquivo
	include "../inc_protege_admin.php";//include do protege
	//###################### verificação de permissões #################### ----------------------- <<<


}//fim else - if(isset($_GET["ajax"])){//verifia se chamou função AJAX da Pagina


?>
<?php









	$CAL_RETORNO["id"] = '11';
	$CAL_RETORNO["title"] = 'Long Event';
	$CAL_RETORNO["start"] = time();
	$CAL_RETORNO["end"] = time()+3600;
	$DATA_RETORNO[] = $CAL_RETORNO;


	$CAL_RETORNO["id"] = '112';
	$CAL_RETORNO["title"] = 'Não editar 3';
	$CAL_RETORNO["start"] = time()+5600;
	$CAL_RETORNO["end"] = time()+9600;
	$CAL_RETORNO["backgroundColor"] = "#ff0000";
	$DATA_RETORNO[] = $CAL_RETORNO;





echo json_encode($DATA_RETORNO); 

/*
echo '[
  {
    "color": "#FFDB58",
    "start": "2013-11-05 10:00:00",
    "end": "2013-11-05 10:30:00",
    "id": 1,
    "title": "event 1"
  },
  {
    "color": "#6495ED",
    "start": "2013-11-15 10:00:00",
    "end": "2013-11-15 13:30:00",
    "id": 2,
    "title": "event 2"
  }
]';




/*
	$year = date('Y');
	$month = date('m');

	echo json_encode(array(
	
		array(
			'id' => 111,
			'title' => "Event1",
			'start' => "$year-$month-10",
			'url' => "http://yahoo.com/"
		),
		
		array(
			'id' => 222,
			'title' => "Event2",
			'start' => "$year-$month-20",
			'end' => "$year-$month-22",
			'url' => "http://yahoo.com/"
		)
	
	));

*/

?>
<?php





if(isset($_GET["ajax"])){//verifia se chamou função AJAX da Pagina
	//REMOVE CONEXAO
	//fecha todas as conexoes abertas
	$classe_db->FechaConexaoAll($SCRIPTOFF);//fecha conexoes
}
?>