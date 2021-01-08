<?php // Breno Cruvinel - breno.cruvinel09@gmail.com
//ini_set('display_errors',1); ini_set('display_startup_erros',1); error_reporting(E_ALL);// echo json_encode($_POST);
//INCLUDES DE CONTROLE --->>>
include "config/globalSession.php";//inicia sessao php
include "config/globalVars.php";//vars padrao
include "sys/langAction.php";//vars padrao
include "sys/globalFunctions.php";//funcoes padrao
include "sys/globalClass.php";//classes padrao
include "sys/classConexao.php";//classes de conexao
include "sys/incUpdate.php";//verificador de updates
include "config/incPacote.php";//vars do pacote de cliente
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



set_time_limit(0);
//caminhos de pastas de verificação ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
define("PASTA_ORIGEM", getcwd());
$file_base = basename(__FILE__, '.php'); 
//////////////////////////////////////////////////////////////////////// INICIA PROCESSAMENTO ////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////// INICIA PROCESSAMENTO ////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////// INICIA PROCESSAMENTO ////////////////////////////////////////////////////////////////////////////////////////////////

		
		


//retorna array de strings de tradução a partir de uma string (linha do arquivo)
function getLANGStr($str, $array=array()){
	$tam = strlen($str);
	$pos = strpos($str, "__FILE__,__LINE__,");
	$pos2 = strpos($str, "_FILE_M,__LINE__,");//existe locais onde é utilizado $_FILE_M. Exemplo: $class_fLNG->txt($_FILE_M,__LINE__,'Ajustes')	
	$fixo = "__FILE__,__LINE__,";
	//verificar se existe os dois tipos de tag na mesma linha - extrair sempre a que vem primeiro
	if($pos != "" and $pos2 != ""){
		if($pos2 < $pos){ $fixo = "_FILE_M,__LINE__,"; }//verificar qual tag vem primeiro
	}else{//if($pos != "" and $pos2 != ""){ 
		if($pos2 != ""){ $fixo = "_FILE_M,__LINE__,"; }
	}//}else{//if($pos != "" and $pos2 != ""){ 
	$fixo_tam = strlen($fixo);
	if (strpos($str, $fixo) !== false) {
		$pos = strpos($str, $fixo);
		$new_str = substr($str,$pos+$fixo_tam,$tam);//cortar string
		$match = ""; $aspas = "";
		if(substr($new_str,0,1) == "'"){ $aspas = "'"; preg_match("#\'(.*?)\'#", $new_str, $match); }//pegar string entre aspas simples
		if(substr($new_str,0,1) == '"'){ $aspas = '"'; preg_match('#\"(.*?)\"#', $new_str, $match); }//pegar string entre aspas duplas
		if(isset($match[1])){
			if($match[1] != ""){ $array[] = $aspas.$match[1].$aspas; }//string de tradução
		}//if(isset($match[1])){
		//verificar se tem mais lang na mesma linha (restante)
		//caso: "texto ".$class_fLNG->txt(__FILE__,__LINE__,'Nº RD1')." de teste de linhas ".$class_fLNG->txt(__FILE__,__LINE__,'Nº RD1')."!";
		$fixo = "__FILE__,__LINE__,";
		$pos = strpos($new_str, "__FILE__,__LINE__,");
		$pos2 = strpos($new_str, "_FILE_M,__LINE__,");//existe locais onde é utilizado $_FILE_M. Exemplo: $class_fLNG->txt($_FILE_M,__LINE__,'Ajustes')			
		//verificar se existe os dois tipos de tag na mesma linha - extrair sempre a que vem primeiro
		if($pos != "" and $pos2 != ""){
			if($pos2 < $pos){ $fixo = "_FILE_M,__LINE__,"; }//verificar qual tag vem primeiro
		}else{//if($pos != "" and $pos2 != ""){
			if($pos2 != ""){ $fixo = "_FILE_M,__LINE__,"; }
		}//}else{//if($pos != "" and $pos2 != ""){
		$fixo_tam = strlen($fixo);
		if (strpos($new_str, $fixo) !== false) {
			//se tiver +1 de uma tag na mesma string, chamar função novamente para extrair até não restar nenhuma tag
			$array = getLANGStr($new_str, $array);
		}//if (strpos($new_str, $fixo) !== false) {	
	}//if (strpos($str, $fixo) !== false) {
	
	return $array;
}//getLANGStr

//percorre arquivo procurando por tag de tradução e retorna conteúdo do arquivo de tradução
function getLANGFile($arquivo){
	$VAR_TAGS = '<?php //criação de array de linguagem $aLNG[""] = ""; NÃO TRADUZIR O QUE ESTIVER: !!PALAVRA!! /*TAG INÍCIO NÃO MODIFICAR*/'." \n\n";
	$cont = "0";
	$handle = fopen($arquivo, "r");
	if ($handle) {
		while (($line = fgets($handle)) !== false) { //percorrer o arquivo linha por linha
			//verificar se existe tag de tradução
			if (strpos($line, "$class_fLNG->txt(") !== false) {
				preg_match_all('/\((.*)\)/', $line, $matches);//cortar parte da string que contem a tag de tradução
				$matches = getLANGStr($matches[0][0]);//extrair strings de tradução
				foreach($matches as $string){ $cont++;//colocar strings na variavel de retorno
					$VAR_TAGS .= '//*************************************************************************************************************************************************************
$aLNG[
'.$string.'
] = 
'.$string.';'." \n\n";				
	
				}//foreach($matches as $string){
			}//if (strpos($line, "$class_fLNG->txt(") !== false) {
		}//while (($line = fgets($handle)) !== false) {
		fclose($handle);
	} else {//if ($handle) {
		// error opening the file.
	}//} else {//if ($handle) {
	
	if($cont == "0"){ $VAR_TAGS = ""; }
	
	return $VAR_TAGS;
}//getLANGFile

//verifica arquivo.php e cria arquivo de tradução
function verificarLANGFile($caminho_file){
	$VAR_TAGS = ""; $alvo = ""; $file = ""; $arrFile = array();
	if(file_exists($caminho_file)){//verificar se arquivo existe
		$pathinfo = pathinfo($caminho_file);
		$alvo = $pathinfo["dirname"]."/";//pegar pasta do arquivo
		$file = $pathinfo["basename"];//nome do arquivo
		//se for PHP -> extrair strings de tradução
		if($pathinfo["extension"] == "php"){ $VAR_TAGS = getLANGFile($caminho_file); }
	}//if(file_exists($caminho_file)){
	if($VAR_TAGS != ""){
		//verificar e criar pasta de LANG - caso não exista
		$pasta = VAR_DIR_RAIZ."LANG"; if(!is_dir($pasta)){ cria_pasta($pasta); }
		$pasta = $pasta."/pt-br"; if(!is_dir($pasta)){ cria_pasta($pasta); }
		if(!file_exists($pasta."/info.php")){//criar arquivo info - caso não exista
			$help = 'HELP: Atenção, esse arquivo é controlado por quebra de linha, a primeira linha é essa, tem informações de ajuda e intrução de funcionalidades. LINHA 1 - Help de informações, LINHA 2 - Bt/Chamada de tradução da linguagem, LINHA 3 - Sigla da linguagem, LINHA 4 - Nome da linguagem, LINHA 5 - Legenda de informações ao usuário
Traduzir
PT-BR
Português Brasileiro
Traduzir o sistema para esta linguagem.';
			file_put_contents($pasta."/info.php",$help);		
		}//if(!file_exists($pasta."/info.php")){
		$pasta = $pasta."/code"; if(!is_dir($pasta)){ cria_pasta($pasta); }							
		//interface e smart-login possuem uma camada a mais - criar caso não exista
		$pathinfo_raiz = pathinfo(VAR_DIR_RAIZ);
		if($pathinfo_raiz["basename"] == "interface" || $pathinfo_raiz["basename"] == "smart-login"){
			$pasta = $pasta."/".$pathinfo_raiz["basename"]; if(!is_dir($pasta)){ cria_pasta($pasta); }							
		}//if($pathinfo_raiz["basename"] == "interface" || $pathinfo_raiz["basename"] == "smart-login"){
		$aux = str_replace(VAR_DIR_RAIZ,"",$alvo);
		$array = explode("/",$aux);
		foreach($array as $dir){//percorrer e criar pastas do arquivo - caso não exista
			$pasta .= "/".$dir;
			if(!is_dir($pasta)){ cria_pasta($pasta); }
		}//fim foreach
		echo "<br>TRADUZIDO:".$pasta.$file;
		delete($pasta.$file);
		file_put_contents($pasta.$file,$VAR_TAGS);//gravar arquivo de tradução
		chmod($pasta.$file, 0775);
		
		$arrFile[] = $pasta.$file;
	}else{//if($VAR_TAGS != ""){	
		if($file != ""){
			echo "<br>SEM TAG DE TRADUÇÃO:".$pasta.$file;
		}
	}//}else{//if($VAR_TAGS != ""){	
	
	return $arrFile;
}//verificarLANGFile


//percorre pastas a partir do alvo
function procurarLANGFiles($alvo,$arrFiles=array(),$time_m = "") {
	if($handle = opendir($alvo)){
	    while(false !== ($file = readdir($handle))){
	        if($file != "." && $file != ".." && $file != "" && $file != "Thumbs.db"){
				$caminho = $alvo.'/'.$file;
				$caminho_sub = str_replace(PASTA_ORIGEM, "", $caminho);
	        	if(is_dir($caminho) and ($file != "LANG") and ($file != "LANG-OLD") and ($file != "tradutor")){//excluir pasta LANG
					//echo "<br>P($valida)>".$caminho." |- -| ".PASTA_UPDATE.$caminho_sub;
	            	$arrFiles = procurarLANGFiles($caminho,$arrFiles,$time_m);//procurar na pasta - recursivo
	            }else{//arquivo
					if($file != basename(__FILE__)){//não entrar no arquivo atual
						if($time_m == ""){
							$arrFiles[] = verificarLANGFile($alvo."/".$file);//
						}else{//if($time_m == ""){
							
							if(filemtime($alvo."/".$file) > $time_m){ 
								$arrFiles[] = $alvo."/".$file; 
								//echo "<br>FILE:".$alvo."/".$file." HORA:".date("d/m/Y H:i:s",filemtime($alvo."/".$file));
							}
						}//}else{//if($time_m == ""){
					}//if($file != basename(__FILE__)){
	            }// }else{//arquivo
	        }//if($file != "." && $file != ".." && $file != "" && $file != "Thumbs.db"){
	    }//while
	    closedir($handle);
	}//if($handle = opendir($alvo)){
		
	return $arrFiles;
}//procurarLANGFiles






$v_get = "";
$ACAO = ""; if(isset($_GET["acao"])){ $ACAO = $_GET["acao"]; $v_get = "acao=".$ACAO; }
$caminho_file = ""; if(isset($_GET["caminho_file"])){ $caminho_file = $_GET["caminho_file"]; $v_get .= "&caminho_file=".$caminho_file; }


if($ACAO == ""){
?>
	<div style="text-align:center;">
    	<form action="#" method="get">
        	<input type="hidden" value="file" name="acao" id="acao">
            Caminho completo do arquivo: <input type="text" value="" name="caminho_file" id="caminho_file" style="width:400px;"/> 
            <br>Ex.: /var/www/html/projetos/Integrador-Digital/gestor/0/home_ajax.php
            <br><button type="submit" style="font-size:18px; padding:10px; margin:10px;">GERAR TRADUÇÃO DO ARQUIVO</button>
        </form>
<?php if(file_exists(VAR_DIR_RAIZ."ajax/faisher.php")){ ?>
    	<br>
        <form action="#" method="get">
        	<input type="hidden" value="menu" name="acao" id="acao">
        	<button type="submit" style="font-size:18px; padding:10px; margin:10px;">GERAR TRADUÇÃO DO MENU</button>        
        </form>        
<?php }//if(!file_exists(VAR_DIR_RAIZ."ajax/faisher.php")){ ?>        
    	<br>
        <form action="#" method="get">
        	<input type="hidden" value="geral" name="acao" id="acao">
        	<button type="submit" style="font-size:18px; padding:10px; margin:10px;">GERAR TRADUÇÃO GERAL (todas pastas e arquivos)</button>        
        </form>
<?php 
if(file_exists(PASTA_ORIGEM."/".$file_base)){ 
	$time_base = filemtime(PASTA_ORIGEM."/".$file_base);
	$arrFiles = procurarLANGFiles(PASTA_ORIGEM,array(),$time_base);
	$cont = count($arrFiles);
	if($cont >= "1"){
?>
    	<br>
<style>
#file_recentes td, #file_recentes th {
  border: 1px solid #ddd;
  padding: 8px;
}
#file_recentes th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
  text-align: center;
}
</style>          
        <h2>Arquivos alterados recentemente (horário base: <?=date("d/m/Y H:i:s",$time_base)?>)</h2>
        <div style="display:flex; justify-content:center; flex-wrap: wrap; margin:-1rem;">
		<table style="border:1px solid #000000; border-collapse: collapse; margin: 0; justify-items:center;" id="file_recentes">
        	<thead>
            	<tr>
                	<th>FILE</th>
                    <th>Data/Hora Modificação</th>
                </tr>
            </thead>
            <tbody>        
<?php 
foreach($arrFiles as $file){
?>
				<tr>
                	<td><?=$file?></td>
                    <td><?=date("d/m/Y H:i:s",filemtime($file))?></td>
                </tr>
<?php
}//fim foreach
?>
			</tbody>
		</table>
        </div>
        <form action="#" method="get">
        	<input type="hidden" value="recente" name="acao" id="acao">
        	<button type="submit" style="font-size:18px; padding:10px; margin:10px;">GERAR TRADUÇÃO DE ARQUIVOS ALTERADOS RECENTEMENTE (<?=$cont?>)</button>        
        </form>                 
       
        
<?php
	}//if(count($arrFiles) >= "1"){
}//if(!file_exists(VAR_DIR_RAIZ."ajax/faisher.php")){ 
?>                
    </div>
<?php	
	exit(0);
}//if($acao == ""){
	
	
	
	
	
if($v_get != ""){
?>
<div style="text-align:center;">
		<h3>Hora de execução: <?=date("d/m/Y H:i:s", time())?></h3>
        <button type="button" style="font-size:18px; padding:10px; margin:10px;" onclick="window.location='?'">VOLTAR MENU ANTERIOR</button>            	
        <button type="button" style="font-size:18px; padding:10px; margin:10px;" onclick="window.location='?<?=$v_get?>'">EXECUTAR NOVAMENTE</button>        

</div>
<?php
}//if($v_get != ""){
	
	
	
	

if($ACAO == "file"){
	if($caminho_file != ""){ verificarLANGFile($caminho_file); }
}//if($ACAO == "file"){



//gerar tradução de todas as pastas
if($ACAO == "geral"){
	procurarLANGFiles(PASTA_ORIGEM);
}//if($ACAO == "geral"){
	
	
	
//gerar tradução de todas as pastas
if($ACAO == "recente"){
	$time_base = filemtime(PASTA_ORIGEM."/".$file_base);
	$arrFiles = procurarLANGFiles(PASTA_ORIGEM,array(),$time_base);
	foreach($arrFiles as $file){
		if($file != ""){
			verificarLANGFile($file);			
		}//if($file != ""){
	}//fim foreach
	
	//atualizar arquivo base
	delete(PASTA_ORIGEM."/".$file_base);
	file_put_contents(PASTA_ORIGEM."/".$file_base,time());	
}//if($ACAO == "geral"){



//tradução do menu
if($ACAO != "geral" and $ACAO != "menu"){ exit(0); }











$VAR_TAGS = '<?php //criação de array de linguagem $aLNG[""] = ""; NÃO TRADUZIR O QUE ESTIVER: !!PALAVRA!! /*TAG INÍCIO NÃO MODIFICAR*/'." \n\n";



$VAR_TAGS .= '//*************************************************************************************************************************************************************
$aLNG[
\'TELA INICIAL\'
] = 
\'TELA INICIAL\';'." \n\n";


$VAR_TAGS .= '//*************************************************************************************************************************************************************
$aLNG[
\'Home\'
] = 
\'Home\';'." \n\n";

$VAR_TAGS .= '//*************************************************************************************************************************************************************
$aLNG[
\'Sobre\'
] = 
\'Sobre\';'." \n\n";


$VAR_TAGS .= '//*************************************************************************************************************************************************************
$aLNG[
\'Seu Resumo Para Hoje!\'
] = 
\'Seu Resumo Para Hoje!\';'." \n\n";



$VAR_TAGS .= '//*************************************************************************************************************************************************************
$aLNG[
\'Início\'
] = 
\'Início\';'." \n\n";



$VAR_TAGS .= '//*************************************************************************************************************************************************************
$aLNG[
\'Ajustes\'
] = 
\'Ajustes\';'." \n\n";



$VAR_TAGS .= '//*************************************************************************************************************************************************************
$aLNG[
\'Meus Dados\'
] = 
\'Meus Dados\';'." \n\n";



$VAR_TAGS .= '//*************************************************************************************************************************************************************
$aLNG[
\'Sobre\'
] = 
\'Sobre\';'." \n\n";



$VAR_TAGS .= '//*************************************************************************************************************************************************************
$aLNG[
\'Opss... erro de acesso, tente novamente do inicio...\'
] = 
\'Opss... erro de acesso, tente novamente do inicio...\';'." \n\n";



$VAR_TAGS .= '//*************************************************************************************************************************************************************
$aLNG[
\'Ajustes\'
] = 
\'Ajustes\';'." \n\n";



$VAR_TAGS .= '//*************************************************************************************************************************************************************
$aLNG[
\'Ajuste\'
] = 
\'Ajuste\';'." \n\n";



$VAR_TAGS .= '//*************************************************************************************************************************************************************
$aLNG[
\'Meus Dados\'
] = 
\'Meus Dados\';'." \n\n";



$VAR_TAGS .= '//*************************************************************************************************************************************************************
$aLNG[
\'Editar Meus Dados\'
] = 
\'Editar Meus Dados\';'." \n\n";



$VAR_TAGS .= '//*************************************************************************************************************************************************************
$aLNG[
\'Meus Dados\'
] = 
\'Meus Dados\';'." \n\n";



$VAR_TAGS .= '//*************************************************************************************************************************************************************
$aLNG[
\'Alterar Minha Senha\'
] = 
\'Alterar Minha Senha\';'." \n\n";



$VAR_TAGS .= '//*************************************************************************************************************************************************************
$aLNG[
\'Alterar Senha\'
] = 
\'Alterar Senha\';'." \n\n";



$VAR_TAGS .= '//*************************************************************************************************************************************************************
$aLNG[
\'Sobre\'
] = 
\'Sobre\';'." \n\n";



$VAR_TAGS .= '//*************************************************************************************************************************************************************
$aLNG[
\'Sobre\'
] = 
\'Sobre\';'." \n\n";



$VAR_TAGS .= '//*************************************************************************************************************************************************************
$aLNG[
\'Hoje (meus afazeres)\'
] = 
\'Hoje (meus afazeres)\';'." \n\n";



$VAR_TAGS .= '//*************************************************************************************************************************************************************
$aLNG[
\'Home\'
] = 
\'Home\';'." \n\n";






















//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ inicio menu - files ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~|||--->>>
//busca dados do MENU FILES
$resu = fSQL::SQL_SELECT_SIMPLES("titulo", "sys_menu_files", "", "");
while($linha = fSQL::FETCH_ASSOC($resu)){
	$titulo_ = $linha["titulo"];

	$VAR_TAGS .= '//*************************************************************************************************************************************************************
$aLNG[
\''.$titulo_.'\'
] = 
\''.$titulo_.'\';'." \n\n";

}//fim while



//busca dados do MENU GUIA
$resu = fSQL::SQL_SELECT_SIMPLES("id,nome_max,nome_min", "sys_menu_guia", "", "ORDER BY ordem ASC");
while($linha = fSQL::FETCH_ASSOC($resu)){
	$id_G = $linha["id"];
	$nome_max_G = $linha["nome_max"];
	$nome_min_G = $linha["nome_min"];
	$VAR_TAGS .= '//*************************************************************************************************************************************************************
$aLNG[
\''.$nome_max_G.'\'
] = 
\''.$nome_max_G.'\';'." \n\n";

	$VAR_TAGS .= '//*************************************************************************************************************************************************************
$aLNG[
\''.$nome_min_G.'\'
] = 
\''.$nome_min_G.'\';'." \n\n";

	//busca dados do GUIA > MENU
	$resu1 = fSQL::SQL_SELECT_SIMPLES("id,nome_max,nome_min", "sys_menu_guia_menu", "guia_id = '".$id_G."'", "ORDER BY ordem ASC");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$id_M = $linha1["id"];
		$nome_max_M = $linha1["nome_max"];
		$nome_min_M = $linha1["nome_min"];
	$VAR_TAGS .= '//*************************************************************************************************************************************************************
$aLNG[
\''.$nome_max_M.'\'
] = 
\''.$nome_max_M.'\';'." \n\n";

	$VAR_TAGS .= '//*************************************************************************************************************************************************************
$aLNG[
\''.$nome_min_M.'\'
] = 
\''.$nome_min_M.'\';'." \n\n";


		//busca dados do GUIA > MENU > SUBMENU
		$resu2 = fSQL::SQL_SELECT_SIMPLES("id,nome_max,nome_min", "sys_menu_guia_menu_submenu", "guia_menu_id = '".$id_M."'", "ORDER BY ordem ASC");
		while($linha2 = fSQL::FETCH_ASSOC($resu2)){
			$id_SM = $linha2["id"];
			$nome_max_SM = $linha2["nome_max"];
			$nome_min_SM = $linha2["nome_min"];
	$VAR_TAGS .= '//*************************************************************************************************************************************************************
$aLNG[
\''.$nome_max_SM.'\'
] = 
\''.$nome_max_SM.'\';'." \n\n";

	$VAR_TAGS .= '//*************************************************************************************************************************************************************
$aLNG[
\''.$nome_min_SM.'\'
] = 
\''.$nome_min_SM.'\';'." \n\n";
			
			
			//busca dados do GUIA > MENU > SUBMENU > SUBMENU EXTRA
			$resu3 = fSQL::SQL_SELECT_SIMPLES("nome_max,nome_min", "sys_menu_guia_menu_submenu_submenuextra", "guia_menu_submenu_id = '".$id_SM."'", "ORDER BY ordem ASC");
			while($linha3 = fSQL::FETCH_ASSOC($resu3)){
				$nome_max_SMEX = $linha3["nome_max"];
				$nome_min_SMEX = $linha3["nome_min"];
	$VAR_TAGS .= '//*************************************************************************************************************************************************************
$aLNG[
\''.$nome_max_SMEX.'\'
] = 
\''.$nome_max_SMEX.'\';'." \n\n";

	$VAR_TAGS .= '//*************************************************************************************************************************************************************
$aLNG[
\''.$nome_min_SMEX.'\'
] = 
\''.$nome_min_SMEX.'\';'." \n\n";
							
			}//fim while SUBMENU EXTRA
					
		}//fim while SUBMENU
			
	}//fim while MENU
}//fim while GUIA


//inicia gravação do arquivo
$file_lng = VAR_DIR_RAIZ."LANG/pt-br/code/";
$pathinfo = pathinfo(VAR_DIR_RAIZ);
if($pathinfo["basename"] == "interface"){
	$file_lng .= "interface/";
	if(!is_dir($file_lng)){ cria_pasta($file_lng); }
}
$file_lng .= "ajax";
if(file_exists($file_lng)){
	echo "<br>TRADUÇÃO ATUALIZADA COM SUCESSO!!!<br>GRAVADO EM: ".$file_lng."/faisher.php";
	delete($file_lng."/faisher.php");
	file_put_contents($file_lng."/faisher.php",$VAR_TAGS);
	chmod($file_lng."/faisher.php", 0775);
}else{//file_exists
	echo "<br>!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!<br>ERRO AO LOCALIZAR A PASTA: $file_lng";
}//else{//file_exists




if($ACAO == "geral"){
	delete(PASTA_ORIGEM."/".$file_base);
	file_put_contents(PASTA_ORIGEM."/".$file_base,time());
}//if($ACAO == "geral"){

