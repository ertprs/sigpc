<?php





if(isset($_GET["atualizar"])){
	$unidade_id = $_GET["unidade_id"];
	
//INCLUDES DE CONTROLE --->>>
include "../integracao/globalVars.php";//vars padrao
include "../integracao/globalFunctions.php";//funcoes padrao
include "../integracao/globalClass.php";//classes padrao
include "../integracao/classConexao.php";//classes de conexao
//INCLUDES DE CONTROLE ---<<<	
	
	
//INICIAR CLASSES DE CONTROLE --->>>
//conexao DB
$classe_db = new classe_DB;//inicia a classe de conexao
$classe_db->AbreConexaoPai();//Abrimos a conexão Pai
//INICIAR CLASSES DE CONTROLE ---<<<	


//ini_set('display_errors',1);ini_set('display_startup_erros',1);error_reporting(E_ALL);
$senha_atual = "0"; if(isset($_GET["senha_atual"])){ $senha_atual = soNumero($_GET["senha_atual"]); }
$arr["senha"] = "0"; $arr["guiche"] = "0"; $contador = "0";

$linha = fSQL::SQL_SELECT_ONE("contador,num_senha,num_guiche,sig_senha","painel_senha","time = '0' AND id_uni = '$unidade_id' ORDER BY contador ASC");
if($linha["contador"] >= "1"){
	$contador = $linha["contador"];
	$arr["senha"] = $linha["sig_senha"].completa_zero($linha["num_senha"],"4");
	$arr["guiche"] = $linha["num_guiche"];
	fSQL::SQL_UPDATE_SIMPLES("time","painel_senha",array(time()),"contador = '".$linha["contador"]."'");
}//if($linha["contador"] >= "1"){

$cont = "0";
$resu = fSQL::SQL_SELECT_SIMPLES("num_senha,num_guiche,sig_senha,time","painel_senha","time >= '1' AND id_uni = '$unidade_id' AND contador != '".$contador."' AND num_senha != '".$senha_atual."' GROUP BY num_senha","ORDER BY time DESC","10");	
while($linha = fSQL::FETCH_ASSOC($resu)){ $cont++;
	$arr[$cont]["senha"] = $linha["sig_senha"].completa_zero($linha["num_senha"],"4");
	$arr[$cont]["guiche"] = $linha["num_guiche"];	
	$arr[$cont]["time"] = date("H:i",$linha["time"]);
}//fim while
	
echo json_encode($arr);
	
	
	
	
	
	
	
	
	
//REMOVE CONEXAO
//fecha todas as conexoes abertas
$classe_db->FechaConexaoAll($SCRIPTOFF);//fecha conexoes		




}//if(isset($_GET["atualizar"])){

?>