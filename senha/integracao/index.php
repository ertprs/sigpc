<?php 
//ini_set('display_errors',1);ini_set('display_startup_erros',1);error_reporting(E_ALL);
//INCLUDES DE CONTROLE --->>>
include "globalVars.php";//vars padrao
include "globalFunctions.php";//funcoes padrao
include "globalClass.php";//classes padrao
include "classConexao.php";//classes de conexao
//INCLUDES DE CONTROLE ---<<<


//INICIAR CLASSES DE CONTROLE --->>>
//conexao DB
$classe_db = new classe_DB;//inicia a classe de conexao
$classe_db->AbreConexaoPai();//Abrimos a conexão Pai
//INICIAR CLASSES DE CONTROLE ---<<<






//FUNÇÃO QUE MONTA RETORNO DOS DADOS
function fWS_retDados($DADOS,$CONT_GET,$CONT_SEND){
	//monta array monta json encode
	$ret = json_encode($DADOS);

	//libera acesso de outra URL
	header('Access-Control-Allow-Origin: *');
	echo $ret;	
}//fWS_retDados
//funções do fWS.........................................................................................................................
















//retorna fila e atendimentos em aberto
if(isset($_GET["getStatus"])){
	$usuario_id = $_GET["usuario_id"];
	$unidade_id = $_GET["unidade_id"];
	$servicos = $_GET["servicos"];
	$res = array();

	$array = explode(",",$servicos);	
	
	//verificar se tem fila
	foreach($array as $id_serv){
		$qtd = fSQL::SQL_CONTAGEM("atendimentos","id_uni = '$unidade_id' AND id_serv = '$id_serv' AND id_stat = '1'");
		$res["fila_".$id_serv] = $qtd;
	}//foreach($array as $id_serv){
		
	//ver se tem atendimento em aberto
	//status 2 -> Chamado pela mesa
	//status 3 -> Atendimento Iniciado
	$condicao = "(id_serv = '".str_replace(",","' OR id_serv = '",$servicos)."') AND id_uni = '$unidade_id' AND id_usu = '$usuario_id' AND id_stat IN ('2','3')";
	//echo $condicao;
	$linha = fSQL::SQL_SELECT_ONE("id_atend,id_serv,num_senha,nm_cli,id_stat,id_pri","atendimentos",$condicao);
	//print_r($linha);
	if($linha["id_atend"] >= "1"){
		//buscar sigla
		
		//echo "<br>id_uni = '$unidade_id' AND id_serv = '".$linha["id_serv"]."'";
		$linha2 = fSQL::SQL_SELECT_ONE("sigla_serv","uni_serv","id_uni = '$unidade_id' AND id_serv = '".$linha["id_serv"]."'");
		$sigla = $linha2["sigla_serv"];			
		
		$res["aberto"] = "1";
		$res["aberto_servico_id"] = $linha["id_serv"];
		$res["aberto_nome"] = $linha["nm_cli"];		
		$res["aberto_prioridade"] = $linha["id_pri"];				
		$res["aberto_senha"] = $sigla.completa_zero($linha["num_senha"],"4");
		$res["aberto_status"] = $linha["id_stat"];
	}//if($linha["id"] >= "1"){

	
	header('Access-Control-Allow-Origin: *');
	echo json_encode($res);		
}//if(isset($_GET["status"])){
	
	
	
	
	
	
	
//alterar status da senha
if(isset($_GET["acao"])){
	$usuario_id = $_GET["usuario_id"];
	$unidade_id = $_GET["unidade_id"];
	$servico_id = $_GET["servico_id"];	
	$senha = $_GET["senha"];	
	$status = $_GET["status"];		
	$redirecionar_servico_id = $_GET["redirecionar_servico_id"];		

	$senha = (int)substr($senha,1,4);
	
	$condicao = "id_usu = '$usuario_id' AND id_uni = '$unidade_id' AND id_serv = '$servico_id' AND num_senha = '$senha' AND id_stat IN ('2','3','5')";
	$linha = fSQL::SQL_SELECT_ONE("id_atend,id_pri,nm_cli","atendimentos",$condicao);
	

	fSQL::SQL_UPDATE_SIMPLES("id_stat","atendimentos",array($status),"id_atend = '".$linha["id_atend"]."'");

	if($redirecionar_servico_id >= "1"){
		$campos = "id_uni,id_usu,id_serv,id_pri,id_stat,num_senha,nm_cli,num_guiche,dt_cheg";
		$valores = array($unidade_id,$usuario_id,$redirecionar_servico_id,$linha["id_pri"],"1",$senha,$linha["nm_cli"],"0",date("Y-m-d H:i:s",time()));
		fSQL::SQL_INSERT_SIMPLES($campos,"atendimentos",$valores);
	}//if($redirecionar_servico_id >= "1"){
}//if(isset($_GET["acao"])){
	
	








//alterar status da senha
if(isset($_GET["encerrar"])){
	$usuario_id = $_GET["usuario_id"];
	$unidade_id = $_GET["unidade_id"];
	$servico_id = $_GET["servico_id"];	
	$senha = $_GET["senha"];	
	$redirecionar_servico_id = $_GET["redirecionar_servico_id"];

	$senha = (int)substr($senha,1,4);
	
	$condicao = "id_usu = '$usuario_id' AND id_uni = '$unidade_id' AND id_serv = '$servico_id' AND num_senha = '$senha' AND id_stat = '3'";
	//echo $condicao;
	$linha = fSQL::SQL_SELECT_ONE("id_atend,id_pri,nm_cli","atendimentos",$condicao);
	$id_atend = $linha["id_atend"];
	
	fSQL::SQL_UPDATE_SIMPLES("id_stat,dt_fim","atendimentos",array("8",date("Y-m-d H:i:s",time())),"id_atend = '$id_atend'");

	$campos = "id_atend,id_serv,valor_peso";
	$valores = array($id_atend,$servico_id,"1");
	fSQL::SQL_INSERT_SIMPLES($campos,"atend_codif",$valores);
	
	if($redirecionar_servico_id >= "1"){
		$campos = "id_uni,id_usu,id_serv,id_pri,id_stat,num_senha,nm_cli,num_guiche,dt_cheg";
		$valores = array($unidade_id,$usuario_id,$redirecionar_servico_id,$linha["id_pri"],"1",$senha,$linha["nm_cli"],"0",date("Y-m-d H:i:s",time()));
		fSQL::SQL_INSERT_SIMPLES($campos,"atendimentos",$valores);
	}//if($redirecionar_servico_id >= "1"){	
}//if(isset($_GET["acao"])){
	
	
	
	
	
	
	
//alterar status da senha
if(isset($_GET["iniciar"])){
	$usuario_id = $_GET["usuario_id"];
	$unidade_id = $_GET["unidade_id"];
	$servico_id = $_GET["servico_id"];	
	$senha = $_GET["senha"];	

	$senha = (int)substr($senha,1,4);
	
	$condicao = "id_usu = '$usuario_id' AND id_uni = '$unidade_id' AND id_serv = '$servico_id' AND num_senha = '$senha' AND id_stat = '2'";
	
	fSQL::SQL_UPDATE_SIMPLES("id_stat,dt_ini","atendimentos",array("3",date("Y-m-d H:i:s",time())),$condicao);
}//if(isset($_GET["iniciar"])){	







//chamar proxima senha	
if(isset($_GET["proximo"])){
	$usuario_id = $_GET["usuario_id"];
	$unidade_id = $_GET["unidade_id"];
	$servicos = $_GET["servicos"];
	$num_guiche = $_GET["num_guiche"];
	$res = array();

	$condicao = "(id_serv = '".str_replace(",","' OR id_serv = '",$servicos)."')";
	$condicao .= " AND id_uni = '$unidade_id' AND id_stat = '1'";
	//echo $condicao;
	//procurar atendimentos aguardando serem chamados - prioritários primeiro	
	$linha = fSQL::SQL_SELECT_ONE("id_atend,num_senha,id_serv,nm_cli,id_pri","atendimentos",$condicao." ORDER BY id_pri DESC, dt_cheg ASC");
	//print_r($linha);
	if($linha["id_atend"] >= "1"){
		$id_atend = $linha["id_atend"];
		$senha = $linha["num_senha"];
		$nm_cli = $linha["nm_cli"];			
		$id_pri = $linha["id_pri"];			
		$id_serv = $linha["id_serv"];						
		//buscar sigla
		$linha = fSQL::SQL_SELECT_ONE("sigla_serv,nm_serv","uni_serv","id_uni = '$unidade_id' AND id_serv = '$id_serv'");
		$sigla = $linha["sigla_serv"];			
		$nm_serv = $linha["nm_serv"];
		
		if($id_pri != "1"){ $sigla = "P"; }
		
		$res["senha"] = $sigla.completa_zero($senha,"4");
		$res["nome"] = $nm_cli;		
		$res["prioridade"] = $id_pri;					
		$res["servico"] = $id_serv;								
		//inserir no painel de senha
		$valores = array($unidade_id,$id_serv,$senha,$sigla,$nm_serv,"Guichê",$num_guiche);
		fSQL::SQL_INSERT_SIMPLES("id_uni,id_serv,num_senha,sig_senha,msg_senha,nm_local,num_guiche","painel_senha",$valores);
		//alterar status do atendimento para chamado
		fSQL::SQL_UPDATE_SIMPLES("id_usu,id_stat,num_guiche,dt_cha","atendimentos",array($usuario_id,"2",$num_guiche,date("Y-m-d H:i:s",time())),"id_atend = '$id_atend'");
	}//if($linha["id"] >= "1"){

		
	header('Access-Control-Allow-Origin: *');
	echo json_encode($res);			
}//if(isset($_GET["proximo"])){







if(isset($_GET["chamarNovamente"])){
	$unidade_id = $_GET["unidade_id"];
	$servico_id = $_GET["servico_id"];
	$num_guiche = $_GET["num_guiche"];	
	$senha = $_GET["senha"];
	
	$sigla = substr($senha,0,1);
	$senha = (int)substr($senha,1,4);

	//buscar sigla
	$linha = fSQL::SQL_SELECT_ONE("nm_serv","uni_serv","id_uni = '$unidade_id' AND id_serv = '$servico_id'");
	$nm_serv = $linha["nm_serv"];
	
	//inserir no painel de senha
	$valores = array($unidade_id,$servico_id,$senha,$sigla,$nm_serv,"Guichê",$num_guiche);
	fSQL::SQL_INSERT_SIMPLES("id_uni,id_serv,num_senha,sig_senha,msg_senha,nm_local,num_guiche","painel_senha",$valores);
}//if(isset($_GET["chamarNovamente"])){
	
	
	
	
	
	
	
	
	
	
	
	
	
if(isset($_GET["listaNaoCompareceu"])){
	$unidade_id = $_GET["unidade_id"];

	//buscar sigla
	$res = array();
	$resu = fSQL::SQL_SELECT_SIMPLES("id_serv,id_pri,num_senha,nm_cli,dt_cheg,dt_cha","atendimentos","id_uni = '$unidade_id' AND id_stat = '5'");
	while($linha = fSQL::FETCH_ASSOC($resu)){
		
		//buscar sigla
		$linha2 = fSQL::SQL_SELECT_ONE("sigla_serv","uni_serv","id_uni = '$unidade_id' AND id_serv = '".$linha["id_serv"]."'");
		$sigla = $linha2["sigla_serv"];			
		
		unset($row); $row["servico_id"] = $linha["id_serv"];
		$row["num_senha"] = $sigla.completa_zero($linha["num_senha"],"4");
		$row["prioridade"] = $linha["id_pri"];
		$row["nome"] = $linha["nm_cli"];
		$row["dt_cheg"] = $linha["dt_cheg"];
		$row["dt_cha"] = $linha["dt_cha"];
		$res[] = $row;
	}//fim while
	
	header('Access-Control-Allow-Origin: *');
	echo json_encode($res);	
}//if(isset($_GET["chamarNovamente"])){	













if(isset($_GET["reiniciarSenhas"])){
	//buscar sigla
	$cont = "0";
	$resu = fSQL::SQL_SELECT_SIMPLES("id_atend,id_uni,id_usu,id_serv,id_pri,id_stat,num_senha,nm_cli,num_guiche,dt_cheg,dt_cha,dt_ini,dt_fim,ident_cli","atendimentos","id_atend >= '1'");
	while($linha = fSQL::FETCH_ASSOC($resu)){ $cont++;
		$id_usu = ($linha["id_usu"] == "" ? NULL : $linha["id_usu"]);
		$dt_cha = ($linha["dt_cha"] == "" ? NULL : $linha["dt_cha"]);
		$dt_ini = ($linha["dt_ini"] == "" ? NULL : $linha["dt_ini"]);		
		$dt_fim = ($linha["dt_fim"] == "" ? NULL : $linha["dt_fim"]);				
		
		$campos = "id_atend,id_uni,id_usu,id_serv,id_pri,id_stat,num_senha,nm_cli,num_guiche,dt_cheg,dt_cha,dt_ini,dt_fim,ident_cli";	
		$valores = array($linha["id_atend"],$linha["id_uni"],$id_usu,$linha["id_serv"],$linha["id_pri"],$linha["id_stat"],$linha["num_senha"],$linha["nm_cli"],$linha["num_guiche"],$linha["dt_cheg"],$dt_cha,$dt_ini,$dt_fim,$linha["ident_cli"]);
		fSQL::SQL_INSERT_SIMPLES($campos,"historico_atendimentos",$valores);
		
		$campos = "id_atend,id_serv,valor_peso";
		$valores = array($linha["id_atend"],$linha["id_serv"],"1");
		fSQL::SQL_INSERT_SIMPLES($campos,"historico_atend_codif",$valores);
		
		
		fSQL::SQL_DELETE_SIMPLES("atend_codif","id_atend = '".$linha["id_atend"]."' AND id_serv = '".$linha["id_serv"]."'");
		fSQL::SQL_DELETE_SIMPLES("atendimentos","id_atend = '".$linha["id_atend"]."'");
	}//fim while

	fSQL::SQL_DELETE_SIMPLES("painel_senha","contador >= '1'");

	header('Access-Control-Allow-Origin: *');
	echo $cont;		
}//if(isset($_GET["chamarNovamente"])){	























if(isset($_GET["novaSenha"])){
	$unidade_id = $_GET["unidade_id"];
	$servico_id = $_GET["servico_id"];
	$prioridade_id = $_GET["prioridade_id"];
	$nome = $_GET["nome"];
	if(isset($_GET["senha_antiga"])){ $senha_antiga = $_GET["senha_antiga"]; }else{ $senha_antiga = ''; }
	if($unidade_id >= "1" and $servico_id >= "1" and $prioridade_id >= "1"){
		$senha = fSQL::SQL_SELECT_INSERT("atendimentos","num_senha");
		
		$campos = "id_uni,id_serv,id_pri,id_stat,num_senha,nm_cli,num_guiche,dt_cheg,ident_cli";
		$valores = array($unidade_id,$servico_id,$prioridade_id,"1",$senha,$nome,"0",date("Y-m-d H:i:s",time()),"");
		fSQL::SQL_INSERT_SIMPLES($campos,"atendimentos",$valores);
		
		//buscar sigla
		$linha = fSQL::SQL_SELECT_ONE("sigla_serv","uni_serv","id_uni = '$unidade_id' AND id_serv = '$servico_id'");
		$sigla = $linha["sigla_serv"];

		if($senha_antiga != ""){
			$senha_antiga = (int)substr($senha_antiga,1,4);
			fSQL::SQL_UPDATE_SIMPLES("id_stat","atendimentos",array("7"),"id_uni = '".$unidade_id."' AND id_serv = '".$servico_id."' AND num_senha = '".$senha_antiga."'");
		}
		
		$res["senha"] = $sigla.completa_zero($senha,"4");
		fWS_retDados($res);
	}//if($unidade_id >= "1" and $servico_id >= "1" and $prioridade_id >= "1"){
}//if(isset($_GET["novaSenha"])){



























//REMOVE CONEXAO
//fecha todas as conexoes abertas
$classe_db->FechaConexaoAll($SCRIPTOFF);//fecha conexoes	

?>