<?php //Breno Cruvinel - breno.cruvinel09@gmail.com
$ajax = "OFF"; //zera a variavel AJAX e nao executa as funcoes ajax
//vars para paginacao em AJAX -------------------------------------|| AJAX --- >>>
$AJAX_PAG = "lerLog_ajax.php";//pagina que vai ser carregada

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
	include "../sys/cabecalho_ajax.php"; //cabeçalho ajax para correção de acentos e cache
	//INCLUDES DE CONTROLE ---<<<

	//INICIAR ARQUIVO DE LINGUAGEM --->>>
	$class_fLNG->loadFile(__FILE__);//incluir o arquivo de linguagem
	//INICIAR ARQUIVO DE LINGUAGEM ---<<<
	
	//FUNCOES INICIAIS --->>>
	//conexao DB
	$classe_db = new classe_DB;//inicia a classe de conexao
	$classe_db->AbreConexaoPai();//Abrimos a conexão Pai
	//FUNCOES INICIAIS ---<<<


	//CLASSES PROTEGE PAGINA/LOGIN --->>>
	//protege a pagina
	$cVLogin = new classVLOGIN;//inicia a classe de login
	$cVLogin->loginCookie();//verifica o login e cria array de login
	$cVLogin->loginSession("log");//faz a atualização de session do login atual
	//CLASSES PROTEGE PAGINA/LOGIN ---<<<


}//fim else - if(isset($_GET["ajax"])){//verifia se chamou função AJAX da Pagina


?>
<?php





//AJAX QUE EXIBE ITEM DE TITULO ------------------------------------------------------------------>>>
if($ajax == "ler"){	
	if(isset($_GET["div"])){ $div = $_GET["div"]; }else{ $div = ""; }
	if(isset($_GET["tb"])){ $tabela = $_GET["tb"]; }else{ $tabela = ""; }
	if(isset($_GET["id"])){ $id = $_GET["id"]; }else{ $id = ""; }
	if(($tabela == "") or ($id == "")){ echo "Vazio!"; exit(0); }
	$file_log = VAR_DIR_FILES."files/logs/".$tabela."/".$id."/"; //caminho/nome da pasta

	if(file_exists($file_log)){
		$cont_list = "0";
		
?>
	<table class="table table-hover table-nomargin table-bordered">
		<thead>
			<tr>
				<th>Data</th>
				<th>Hora</th>
				<th>Usuário</th>
				<th>Dados/Tabelas</th>
			</tr>
		</thead>
	<tbody>     
<?php
//abre pasta de tabela e lista arquivos
	$filesArray = fGERAL::listaArquivos($file_log);
	if(ceil(count($filesArray)) >= "1"){
		foreach($filesArray as $pos => $arquivo){
			if($arquivo != ""){
				$aLog = fGERAL::lerLog($file_log.$arquivo);//ler log de auditoria
				$aLog = json_decode($aLog, true);
				$cont_list++;
				if(($aLog["sys"] == "0") or ($aLog["sys"] == "")){ $sys_leg = "SYS: Núcleo AXL"; }else{  $sys_leg = "SYS: Externo-> ".$aLog["sys"]; }
?>
			<tr>
				<td><?=date('d/m/Y',$aLog["time"])?></td>
				<td><?=date('H:i:s',$aLog["time"])?></td>
				<td><?=$sys_leg?><br><?=$aLog["user"]?></td>
				<td>

<div class="accordion" id="accordion<?=$aLog["time"]?>">
<?php
$cont_acord = "0";
//LISTA ARRAY DE DADOS DA TABELA
//monta array de dados
$array = array_reverse($aLog["tabela"]);
$cont_ARRAY = ceil(count($array));
if(($cont_ARRAY >= "1") and ($array != "")){
	foreach($array as $posi => $valor){
		if($valor != ""){
			$dados = ""; $pos = "0";
			$array2 = explode(",",maiusculo($valor["campos"]));
			$cont_ARRAY2 = ceil(count($array2));
			if(($cont_ARRAY2 >= "1") and ($array2 != "")){
				foreach($array2 as $pos2 => $valor2){
					if($valor2 != ""){
						$linha = "";//zera linha
						if($valor2 == "DATA"){ $linha = "- ".$valor2.": ".data_mysql($valor["valores"]["$pos"]); }
						if($valor2 == "DATAN"){ $linha = "- ".$valor2.": ".data_mysql($valor["valores"]["$pos"]); }
						if($valor2 == "SEXO"){ $linha = "- ".$valor2.": ".legSexo($valor["valores"]["$pos"]); }
						if(preg_match("/TIME/", $valor2)){ $linha = "- ".$valor2.": ".date("d/m/Y H:i",$valor["valores"]["$pos"]); }
						if($valor2 == "USER"){ $linha = "- CADASTRADO POR: ".$valor["valores"]["$pos"]; }
						if($valor2 == "USER_A"){ $linha = "- ALTERADO POR: ".$valor["valores"]["$pos"]; }
						if($valor2 == "SYNC"){ $linha = "- DATA MODIFICAÇÃO: ".date("d/m/Y H:i",$valor["valores"]["$pos"]); }
						if($valor2 == "SENHA"){ $linha = "- ".$valor2.": [segredo]"; }
						
						//adiciona dados
						if($dados != ""){ $dados .= "<br>"; } 
						if($linha != ""){ $dados .= $linha; }else{ $dados .= "- ".$valor2.": ".$valor["valores"]["$pos"]; }
						$pos++;
					}//if($valor2 != ""){
				}//fim foreach
			}//fim if($cont_ARRAY2 >= "1"){
			$cont_acord++;
?>
						<div class="accordion-group">
							<div class="accordion-heading"><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion<?=$aLog["time"]?>" href="#collapseOne<?=$aLog["time"]?><?=$cont_acord?>"><?=fTBL::nomeTabela($valor["tabela"])?></a></div>
							<div id="collapseOne<?=$aLog["time"]?><?=$cont_acord?>" class="accordion-body collapse">
								<div class="accordion-inner"><?=$dados?></div>
							</div>
						</div>
<?php
		}//if($valor != ""){
	}//fim foreach
}//fim if($cont_ARRAY >= "1"){ 



				?>
</div>
                    </td>
			</tr>
<?php 

			}//if
		}//fim foreach
	}//fim if($filesArray >= "1"){


?>
		</tbody>
	</table>
 
<?php
}else{ echo "Sem registros encontrados!"; }//if(file_exists($file_log)){


if($div != ""){
?>
<script>
//TIMER
$.doTimeout('vTimerGLog', 500, function(){ $('.<?=$div?>_oculta').hide(); $('.<?=$div?>_exibe').fadeIn(); });//TIMER
</script>
<?php
}//if($div != ""){

}//fim ajax lista ------------------------------------------------------------------------------------------ <<<
?>
<?php






//REMOVE CONEXAO
//fecha todas as conexoes abertas
$classe_db->FechaConexaoAll($SCRIPTOFF);//fecha conexoes
?>