<?php // Breno Cruvinel - breno.cruvinel09@gmail.com
//ini_set('display_errors',1);ini_set('display_startup_erros',1);error_reporting(E_ALL);
//INCLUDES DE CONTROLE --->>>
include "../config/globalSession.php";//inicia sessao php
include "../config/globalVars.php";//vars padrao
include "../sys/langAction.php";//inicia arquivo de linguag
include "../sys/globalFunctions.php";//funcoes padrao
include "../sys/globalClass.php";//classes padrao
include "../sys/classConexao.php";//classes de conexao
include "../sys/classValidaAcesso.php";//classes de validação de acesso
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
	
	
	
	
//CLASSES PROTEGE PAGINA/LOGIN --->>>
//protege a pagina
$cVLogin = new classVLOGIN;//inicia a classe de login
$cVLogin->loginCookie();//verifica o login e cria array de login
$cVLogin->loginSession("uplo");//faz a atualização de session do login atual
//CLASSES PROTEGE PAGINA/LOGIN ---<<<


//INCLUDE FAISHER, CONTROLE DE ARQUIVOS
$SYS_VALIDASEMQUADRO = "Jesus te Ama!";
	
//ALTERAR PADROES PHP
set_time_limit(0);
	

//caminho do fonte iframe
if(isset($_GET["c"])){ $caminho_script = $_GET["c"]; }else{ $caminho_script = "geral/"; }


//grava descricao recebida
if(isset($_GET["gdesc"])){
	$gdesc = getpost_sql($_GET["gdesc"]);
	$tdesc = getpost_sql($_GET["tdesc"]);
	//atualiza dados da tabela no DB
	$campos = "titulo";
	$tabela = "sys_arquivos_temp";
	$valores = array($tdesc);
	$condicao = "id='$gdesc'";
	fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
	exit(0);
}//fim if(isset($_GET["gravadescricao"])){


//vars
$idTemp = $_GET["idTemp"]; //id da acao de resgate dos dados temp
$idIframe = $_GET["idIframe"]; //id iframe e id temp retorno
$tipo_arq = $_GET["arq"];//tipo de arquivo a enviar
if(isset($_GET["maxSize"])){  $maxSize = $_GET["maxSize"]; }else{ $maxSize = "200mb"; } //tamanho maximo do arquivo, se nao tiver, poe padrao
if(isset($_GET["maxImg"])){  $maxImg = $_GET["maxImg"]; }else{ $maxImg = ""; } //dimensão maxima de imagens, se nao tiver, poe padrao - em pixels da imagem 999x999
if(isset($_GET["desc"])){  $desc = $_GET["desc"]; }else{ $desc = "0"; } //exibe o campo para descricao
if(isset($_GET["n_arq"])){  $n_arquivos = $_GET["n_arq"]; }else{ $n_arquivos = "1"; } //faz a contagem de arquivos enviados
if(isset($_GET["funcao"])){  $funcao = $_GET["funcao"]; }else{ $funcao = ""; } //funcao javascript executa apos listagem retornar CONT
if(isset($_GET["retornoUrl"])){  $retornoUrl = $_GET["retornoUrl"]; }else{ $retornoUrl = ""; } //funcao javascript executa apos listagem retornar URL
if(isset($_GET["tm_w"])){  $tm_w = $_GET["tm_w"]; }else{ $tm_w = ""; }
if(isset($_GET["tm_h"])){  $tm_h = $_GET["tm_h"]; }else{ $tm_h = ""; }
if(isset($_GET["mostra"])){  $disp_mostra = $_GET["mostra"]; }else{ $disp_mostra = "0"; }
if(isset($_GET["ponto_web"])){ $ponto_web = $_GET["ponto_web"]; }else{ $ponto_web = "0"; }
if(isset($_GET["cVerificador"])){ $cVerificador = $_GET["cVerificador"]; }else{ $cVerificador = ""; }













































if(isset($_GET["verificaScanner"])){
	$linha = fSQL::SQL_SELECT_ONE("scanner_status","sys_arquivos_temp","usuarios_id = '".$cVLogin->getVarLogin("SYS_USER_ID")."' AND acao = '$idTemp' AND form = '$idIframe' AND (scanner_status = '2' OR scanner_status = '3')");
	$status = $linha["scanner_status"];
	if($status == "2"){
?>	
<script>	
		$("#div_aguardandoDoc").html('<i class="icon-info-sign"></i> <img src="../img/ajax-qloader-preto-p.gif" width="18" height="18" /> <?=$class_fLNG->txt(__FILE__,__LINE__,'Documento escaneado! Realizando o envio, aguarde!')?><button type="button" class="btn btn-red" onclick="cancelarScanner();return false;"><i class="icon-trash"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Cancelar')?></button>');
</script>
<?php        
	}elseif($status == "3"){
?>
<script>
$(document).ready(function(e) {
	$("#div_aguardandoDoc").hide();
	$.doTimeout('vTimerListaArquivos');
	atualizarLista('<?=$_SESSION["scanner_pc"]?>');
	
});	
</script>		
<?php		
	}//if($status == "2"){
	exit(0);
}//if(isset($_GET["verificaScanner"])){












if(isset($_GET["cancelarScanner"])){
	fSQL::SQL_DELETE_SIMPLES("sys_arquivos_temp","usuarios_id = '".$cVLogin->getVarLogin("SYS_USER_ID")."' AND acao = '$idTemp' AND form = '$idIframe'");
	delete(VAR_DIR_FILEs."files/temp/");
?>
<script>
$(document).ready(function(e) {
	$.doTimeout('vTimerListaArquivos');
	$("#div_aguardandoDoc").hide();
	$('#maxFilesC').hide();
	$('#pickfilesC').fadeIn();
	atualizaAlturaIframe();
});
</script>
<?php	
	exit(0);
}//if(!isset($_GET["cancelarScanner"])){		














//listar arquivos &&&&&&&&&&&&&&&&&&&&&&&&&&&&& >>>>>>>>>>>>>>
if(isset($_GET["listaArquivos"])){
	//echo "time:".date("d/m/Y h:i:s",time());
	if(isset($_GET["insert"])){
		//echo "INSERT";
		$campos = "usuarios_id,acao,form,scanner_pc,scanner_status,time";
		$valores = array($cVLogin->getVarLogin("SYS_USER_ID"),$idTemp,$idIframe,$_SESSION["scanner_pc"],"0",time());
		fSQL::SQL_INSERT_SIMPLES($campos,"sys_arquivos_temp",$valores);
	}//if(!isset($_GET["atualizar"])){
		
		

?>
								<table class="table table-hover table-nomargin table-bordered" id="table_files">
									<thead>
										<tr>
											<th><?php if($disp_mostra == "1"){ echo 'IMG'; }else{ echo 'ICO';}?></th>
											<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Dados/Arquivo')?></th>
											<th style="width:20px;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Remove')?></th>
										</tr>
									</thead>
									<tbody>
<?php
$caminho_file = "";
$cont_f = "0";
//verifica se existem arquivos inutilizados no sistema
$campos = "*";
$tabela = "sys_arquivos_temp";
$where = "usuarios_id = '".$cVLogin->getVarLogin("SYS_USER_ID")."' AND acao = '$idTemp' AND form = '$idIframe' AND arquivo != ''";
//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
$resu1 = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where);
while($linha = fSQL::FETCH_ASSOC($resu1)){
	$id_e = $linha["id"];
	$titulo_e = $linha["titulo"];
	$nome_e = $linha["nome"];
	$arquivo_e = $linha["arquivo"];
	$cont_f++;

    $caminho_file = VAR_DIR_FILES."files/temp/".$arquivo_e;
	if($disp_mostra == "1"){
		$html_ico = '<img src="../img.php?'.$cVLogin->imgFile($caminho_file, "full").'" style="padding:1px; border:#FFF 1px solid;" />';
	}else{
		$html_ico = $cVLogin->icoFile($caminho_file,"../");
	}
?>
										<tr id="tr_<?=$id_e?>">
											<td><?=$html_ico?></td>
											<td><?php if($desc == "1"){?>
											<div class="controls">
												<div class="input-prepend">
													<span class="add-on"><i class="icon-edit"></i></span>
													<input type="text" placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Definir legenda...')?>" id="legFile<?=$id_e?>" name="legFile<?=$id_e?>" alt="<?=$id_e?>" value="<?=$titulo_e?>" class='input-xlarge salvaLegenda'>
												</div>
											</div><?php }?>
                                            <b><?=$nome_e?></b><br><?=fGERAL::tmFile($caminho_file)?></td>
											<td style="text-align:center;">
												<a href="#" onClick="faisher_ajax('divoculta', '0', 'scanner_iframe.php', 'idTemp=<?=$idTemp?>&idIframe=<?=$idIframe?>&arq=<?=$tipo_arq?>&n_arq=<?=$n_arquivos?>&maxSize=<?=$maxSize?>&maxImg=<?=$maxImg?>&desc=<?=$desc?>&funcao=<?=$funcao?>&retornoUrl=<?=$retornoUrl?>&tm_w=<?=$tm_w?>&tm_h=<?=$tm_h?>&mostra=<?=$disp_mostra?>&removeA=<?=$id_e?>&ponto_web=<?=$ponto_web?>&cVerificador=<?=$cVerificador?>');return false;" class="btn" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Remover')?>"><i class="icon-remove"></i></a><br><a href="../export.php?a=viewTempPdf&temp=<?=$arquivo_e?>" class="btn" target="_blank" style="margin-top:5px;"><i class="icon-search"></i></a>
                                          </td>
										</tr>
<?php 
}//fim do while 
if($cont_f == "0" and !isset($_GET["abrir"])){ echo '<div style="padding:20px 0 0 10px; clear:both; display:none;" id="div_aguardandoDoc"><i class="icon-info-sign"></i> <img src="../img/ajax-qloader-preto-p.gif" width="18" height="18" /> '.$class_fLNG->txt(__FILE__,__LINE__,'Aguardando escaneamento do documento...').' <button type="button" class="btn btn-red" onclick="cancelarScanner();return false;"><i class="icon-trash"></i> '.$class_fLNG->txt(__FILE__,__LINE__,'Cancelar').'</button></div>'; }
?>
									</tbody>
								</table>
<script type="text/javascript">
$(document).ready(function(){
	
<?php 	if($funcao != ""){ ?>
		// Definindo página pai
		var pai = window.parent.<?=$funcao?>('<?=$cont_f?>');
<?php 	}//if($funcao != ""){ ?>
<?php 	if(($retornoUrl != "") and ($caminho_file != "") and ($cont_f >= "1")){ ?>
		// Definindo página pai
		var pai = window.parent.<?=$retornoUrl?>('<?=$caminho_file?>');
<?php 	}//if($retornoUrl != ""){ ?>

	<?php if($cont_f == "0"){ ?>
		$("#table_files").hide();
		$("#div_aguardandoDoc").fadeIn();
		//$('#maxFilesC').fadeIn();		
	<?php }else{//if($cont_f == "0"){ ?>
		$('#maxFilesC').fadeIn();
		$('#pickfilesC').hide();
		$("#table_files").fadeIn();
	<?php }//else{//if($cont_f == "0"){ ?>	
	
	<?php if(isset($_SESSION["F_ERRO"])){ ?>
		alert('<?=$_SESSION["F_ERRO"]?>');
		popAberto=window.open('scanner_iframe.php?idTemp=<?=$idTemp?>&idIframe=<?=$idIframe?>&arq=<?=$tipo_arq?>&n_arq=<?=$n_arquivos?>&maxSize=<?=$maxSize?>&maxImg=<?=$maxImg?>&desc=<?=$desc?>&funcao=<?=$funcao?>&retornoUrl=<?=$retornoUrl?>&tm_w=<?=$tm_w?>&tm_h=<?=$tm_h?>&mostra=<?=$disp_mostra?>&cVerificador=<?=$cVerificador?>', '<?=$idIframe?>');
		if(popAberto == null){
			window.location='scanner_iframe.php?idTemp=<?=$idTemp?>&idIframe=<?=$idIframe?>&arq=<?=$tipo_arq?>&n_arq=<?=$n_arquivos?>&maxSize=<?=$maxSize?>&maxImg=<?=$maxImg?>&desc=<?=$desc?>&funcao=<?=$funcao?>&retornoUrl=<?=$retornoUrl?>&tm_w=<?=$tm_w?>&tm_h=<?=$tm_h?>&mostra=<?=$disp_mostra?>&cVerificador=<?=$cVerificador?>';
		}
	<?php unset($_SESSION["F_ERRO"]); }?>
	atualizaAlturaIframe();
});
function cancelarScanner(){
	$.doTimeout('vTimerListaArquivos');
	faisher_ajax('verFS<?=$idTemp?>', '0', 'scanner_iframe.php', 'idTemp=<?=$idTemp?>&idIframe=<?=$idIframe?>&arq=<?=$tipo_arq?>&n_arq=<?=$n_arquivos?>&maxSize=<?=$maxSize?>&maxImg=<?=$maxImg?>&desc=<?=$desc?>&funcao=<?=$funcao?>&retornoUrl=<?=$retornoUrl?>&tm_w=<?=$tm_w?>&tm_h=<?=$tm_h?>&mostra=<?=$disp_mostra?>&cancelarScanner=on2&cVerificador=<?=$cVerificador?>');
}
</script>
<?php
	exit(0);
}//if(isset($_GET["listaArquivos"])){





//varia para thumbs
if($tm_w == ""){ $tm_w = "640"; $tm_h = "0"; }else{ if($tm_h == ""){ $tm_h = "0"; } }
		
// Flag que indica se há erro ou não
$erro = null;
$arquivoUP = "";

    // Configurações
	$extensoes = "doc,docx,ppt,pptx,pps,ppsx,xls,xlsx,rtf,txt,pdf,odt,odp,ods,gif,png,jpg,jpeg,flv,mp4,mp3,zip,rar,dwg";
	$extensoes_tipo = $class_fLNG->txt(__FILE__,__LINE__,'Qualquer Arquivo');
	$extensoes_leg = ".doc, .docx, .ppt, .pptx, .pps, .ppsx, .xmls, .xlsx, .rtf, .txt, .pdf, .odt, .ods, .odp, .gif, .png, .jpg, .jpeg, .flv, .mp4, .mp3, .zip, .rar, .dwg";
	if($tipo_arq == "midias"){
    	$extensoes = "doc,docx,ppt,pptx,pps,ppsx,xls,xlsx,rtf,txt,pdf,odt,odp,ods,gif,png,jpg,jpeg,psd,cdr,ai,flv,mp4,mp3,zip,rar";
		$extensoes_leg = $class_fLNG->txt(__FILE__,__LINE__,'Documentos').": <b>.doc, .docx, .ppt, .pptx, .pps, .ppsx, .xmls, .xlsx, .rtf, .txt, .pdf, .odt, .ods, .odp</b><br>".$class_fLNG->txt(__FILE__,__LINE__,'Imagens').": <b>.gif, .png, .jpg, .jpeg, .psd, .cdr, .ai</b><br>".$class_fLNG->txt(__FILE__,__LINE__,'Vídeo/áudio').": <b>.flv, .mp4, .mp3</b><br>".$class_fLNG->txt(__FILE__,__LINE__,'Compactados').": <b>.zip, .rar</b>";
	}
	if($tipo_arq == "videos"){
    	$extensoes = "flv,mp4";
		$extensoes_leg = ".flv, .mp4";
		$extensoes_tipo = $class_fLNG->txt(__FILE__,__LINE__,'Vídeos');
	}
	if($tipo_arq == "audios"){
    	$extensoes = "mp3";
		$extensoes_tipo = $class_fLNG->txt(__FILE__,__LINE__,'Audio');
		$extensoes_leg = ".mp3";
	}
	if($tipo_arq == "imagens"){
    	$extensoes = "gif,png,jpg,jpeg";
		$extensoes_tipo = $class_fLNG->txt(__FILE__,__LINE__,'Imagens');
		$extensoes_leg = ".gif, .png, .jpg, .jpeg";
	}
	if($tipo_arq == "imagensjpg"){
    	$extensoes = "jpg,jpeg";
		$extensoes_tipo = $class_fLNG->txt(__FILE__,__LINE__,'Imagens JPG');
		$extensoes_leg = ".jpg";
	}
	if($tipo_arq == "imagenspng"){
    	$extensoes = "png";
		$extensoes_tipo = $class_fLNG->txt(__FILE__,__LINE__,'Imagens PNG');
		$extensoes_leg = ".png";
	}
	if($tipo_arq == "docs"){
    	$extensoes = "doc,xls,docx,xlsx,rtf,txt,pdf,odt,ods";
		$extensoes_tipo = $class_fLNG->txt(__FILE__,__LINE__,'Documentos');
		$extensoes_leg = ".doc, .docx, .xls, .xlsx, .rtf, .txt, .pdf, .odt, .ods";
	}
	if($tipo_arq == "zips"){
    	$extensoes = "zip,rar";
		$extensoes_tipo = $class_fLNG->txt(__FILE__,__LINE__,'Compactados');
		$extensoes_leg = ".zip, .rar";
	}
	if($tipo_arq == "ret"){
    	$extensoes = "ret,txt";
		$extensoes_tipo = $class_fLNG->txt(__FILE__,__LINE__,'Arquivo Retorno(banco)');
		$extensoes_leg = ".ret, .txt";
	}
	if($tipo_arq == "csvtxt"){
    	$extensoes = "csv,txt,CSV,TXT";
		$extensoes_tipo = $class_fLNG->txt(__FILE__,__LINE__,'Arquivo Texto(CSV e TXT)');
		$extensoes_leg = ".csv, .txt";
	}
	if($tipo_arq == "pdf"){
    	$extensoes = "pdf";
		$extensoes_tipo = $class_fLNG->txt(__FILE__,__LINE__,'Arquivo PDF');
		$extensoes_leg = ".pdf";
	}
	if($tipo_arq == "html"){
    	$extensoes = "html,htm";
		$extensoes_tipo = $class_fLNG->txt(__FILE__,__LINE__,'Arquivo HTML');
		$extensoes_leg = ".html, .htm";
	}
	if($tipo_arq == "pdfimagens"){
    	$extensoes = "gif,png,jpg,jpeg,pdf";
		$extensoes_tipo = $class_fLNG->txt(__FILE__,__LINE__,'PDF ou Imagens');
		$extensoes_leg = ".pdf, .gif, .png, .jpg, .jpeg";
	}



// Quando enviado o formulário -----------------------------------------------------------------------------------------------------------------
if (isset($_FILES['file'])){
    // Configurações
    $caminho = VAR_DIR_FILES."files/temp/";
    // Recuperando informações do arquivo
    //$nome = str_replace("%20", " ", $_FILES['arquivo'.$up_id]['name']);
	$nome = $_FILES['file']['name'];
    $temp = $_FILES['file']['tmp_name'];
    // Verifica se a extensão é permitida
	$ex = minusculo(fGERAL::mostraExtensao($nome));//seprara a extencao
	if(!preg_match("/$ex/", $extensoes)){ 
		$erro = $class_fLNG->txt(__FILE__,__LINE__,'Extensão inválida... Tente novamente').' ('.$extensoes_leg.')!';
	}
	//file_put_contents("DEBUG.txt","VAR: ($ex), $erro");
    // Se não houver erro
    if((!$erro) and ($maxImg != "")){
		//verifica se cria o thumb do arquivo
		$extensoes_img = array(".gif", ".png", ".jpg", ".jpeg", ".png");
		if(in_array(strtolower(strrchr($nome, ".")), $extensoes_img)){
			$d = explode("x",$maxImg);
			$tamanhos = getimagesize("$temp");
			if(($tamanhos[0] != $d["0"]) or ($tamanhos[1] != $d["1"])){ $erro = $class_fLNG->txt(__FILE__,__LINE__,'A imagem enviada está fora do tamanho em pixels solicitado... :O \\n Por favor verifique as dimensões da imagem e tente novamente!').' \\n:)'; }
		}
	}//if((!$erro) and ($maxImg != "")){
		
		
    // Se não houver erro
    if (!$erro) {
        // Gerando um nome aleatório para a imagem
        $nomeAleatorio = md5(uniqid(time())) . minusculo(strrchr($nome, "."));
        
		//colocando a extensao em minusculo
		 $nome = str_replace(strrchr($nome, "."), minusculo(strrchr($nome, ".")), $nome);
		//verifica se cria o thumb do arquivo
		$extensoes_img = array(".gif", ".png", ".jpg", ".jpeg", ".png");
		if (in_array(strtolower(strrchr($nome, ".")), $extensoes_img)) {
			$imge = "ON"; //liga a verificação de thumbs
		}else{ $imge = "OFF"; }
		
        // Movendo arquivo para servidor
        if (!move_uploaded_file($temp, $caminho.$nomeAleatorio)){
            $erro = $class_fLNG->txt(__FILE__,__LINE__,'Não foi possível anexar o arquivo... Tente novamente!');
		}else{
			chmod($caminho.$nomeAleatorio, 0775);
			if($imge == "ON"){
				//verifica o tamanho da imagem enviada
				$foto = $caminho.$nomeAleatorio;
				$tamanhos = getimagesize("$foto");
				//se a imagem for maior reduz o tamanho
				if(($tm_w > "0") and ($tm_h > "0")){//verifica se tem as duas medidas
					if(($tamanhos[0] > $tm_w) or ($tamanhos[1] > $tm_h)){
						imagemMenor($foto, $foto, $tm_w, $tm_h);
					}//fim do if verifica tamanho
				}else{ //else if(($tm_w > "0") and ($tm_h > "0")){//verifica se tem as duas medidas
					if($tamanhos[0] > $tm_w){
						criar_thumbnail($foto, $caminho, $tm_w, "", $ex);
					}//fim do if verifica tamanho
				}//fim else if(($tm_w > "0") and ($tm_h > "0")){//verifica se tem as duas medidas
			}//fim imge
			//file_put_contents("debug.txt","$imge if((".$tamanhos[0]." > $tm_w) or (".$tamanhos[1]." > $tm_h)){");
			
			//ajustes no nome dos arquivos
			$nome_g = $nome; //corrige assentos do nome a gravar
			$nome_g = str_replace("..", ".", $nome_g); $nome_g = str_replace('/', "", $nome_g);//remove possivel caminho no nome
		    //reduz nomes caso utrapasse 150 caracteres
		    $nome_carac = strlen($nome_g);
		    if($nome_carac > "150"){ $nome_g = substr($nome_g,0,140).strtolower(strrchr($nome_g, "."));	}//nome grande
			
			$time_g = time()+18000;//adiciona 5 horas
			//busca ultimo id para insert
			$id_it = fSQL::SQL_SELECT_INSERT("sys_arquivos_temp", "id");
			//VARS insert simples SQL
			$tabela = "sys_arquivos_temp";
			$campos = "id,usuarios_id,acao,form,nome,arquivo,time";
			$valores = array($id_it,$cVLogin->getVarLogin("SYS_USER_ID"),$idTemp,$idIframe,getpost_sql($nome_g),$nomeAleatorio,$time_g);
			$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
			//verifica se comprime PDF
			if(SYS_CONFIG_COMPRESS_PDF == "1"){ 
				$mType = mime_content_type($caminho.$nomeAleatorio);
				if($mType == "application/pdf"){
					fPDF::compressPDF($caminho.$nomeAleatorio);
				}//if($mType == "application/pdf"){
			}//if(SYS_CONFIG_COMPRESS_PDF == "1"){ 
			$arquivoUP = $nomeAleatorio;
		}//fim else if (!move_uploaded_file($temp, $caminho . $nomeAleatorio)){
    }else{ $_SESSION["F_ERRO"] = $erro; }
	exit(0);
}//fim if (isset($_FILES['file'])){// Quando enviado o formulário -----------------------------------------------------------------------------------

//excluir arquivos inativos ou nao utilizados na tabela temp
if (!isset($_FILES['file'])){
//verifica se existem arquivos inutilizados no sistema
	$campos = "id,arquivo";
	$tabela = "sys_arquivos_temp";
	$where = "time <= '".(time())."' and acao <> '".$idTemp."'";
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resu1 = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "");
	while($linha = fSQL::FETCH_ASSOC($resu1)){
		$id_e = $linha["id"];
		$arquivo_e = $linha["arquivo"];
		
		//exclue o arquivo
		if($arquivo_e != ""){
			$arquivoD = VAR_DIR_FILES."files/temp/".$arquivo_e;
			delete($arquivoD);
		}
		
		//exclue o registro
		$tabela = "sys_arquivos_temp";
		$condicao = "id = '$id_e'";
		$resu2 =  fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
	}//fim while fetch
}//fim if (!isset($_FILES['arquivo'])){
	

// Quando a ação for para remover anexo
if(isset($_GET["removeA"])){
    // Recuperando nome do arquivo
    $arquivo = $_GET['removeA'];
	//verifica se existem arquivos inutilizados no sistema
	$campos = "id,arquivo";
	$tabela = "sys_arquivos_temp";
	$where = "id = '$arquivo' AND usuarios_id = '".$cVLogin->getVarLogin("SYS_USER_ID")."'";
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resu1 = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "");
	while($linha = fSQL::FETCH_ASSOC($resu1)){
		$id_e = $linha["id"];
		$arquivo_e = $linha["arquivo"];
		//exclue o arquivo
		if($arquivo_e != ""){
			$arquivoD = VAR_DIR_FILES."files/temp/".$arquivo_e;
			delete($arquivoD);
		}
		//exclue o registro
		$tabela = "sys_arquivos_temp";
		$condicao = "id = '$id_e'";
		$resu2 =  fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
	}//fim while
    // Finaliza a requisição
	
	$cont_arquivo = "0";
	//verifica se existem arquivos inutilizados no sistema
	$tabela = "sys_arquivos_temp";
	$where = "acao = '$idTemp' AND usuarios_id = '".$cVLogin->getVarLogin("SYS_USER_ID")."'";
	$cont_arquivo = fSQL::SQL_CONTAGEM($tabela, $where, "");
?>
<script type="text/javascript">
$(document).ready(function(){
<?php if($cVerificador != ""){?>
	var pai = window.parent.<?=$funcao?>('0');
<?php }//if($cVerificador != ""){?>	
	popAberto=window.open('scanner_iframe.php?idTemp=<?=$idTemp?>&idIframe=<?=$idIframe?>&arq=<?=$tipo_arq?>&n_arq=<?=$n_arquivos?>&maxSize=<?=$maxSize?>&maxImg=<?=$maxImg?>&desc=<?=$desc?>&funcao=<?=$funcao?>&retornoUrl=<?=$retornoUrl?>&tm_w=<?=$tm_w?>&tm_h=<?=$tm_h?>&mostra=<?=$disp_mostra?>&ponto_web=<?=$ponto_web?>&cVerificador=<?=$cVerificador?>', '<?=$idIframe?>');
	if(popAberto == null){
		window.location='scanner_iframe.php?idTemp=<?=$idTemp?>&idIframe=<?=$idIframe?>&arq=<?=$tipo_arq?>&n_arq=<?=$n_arquivos?>&maxSize=<?=$maxSize?>&maxImg=<?=$maxImg?>&desc=<?=$desc?>&funcao=<?=$funcao?>&retornoUrl=<?=$retornoUrl?>&tm_w=<?=$tm_w?>&tm_h=<?=$tm_h?>&mostra=<?=$disp_mostra?>&ponto_web=<?=$ponto_web?>&cVerificador=<?=$cVerificador?>';
	}
});
</script>
<?php
	exit(0);
}//if(isset($_GET["removeA"])){




//caminho dos JS
$cJS = "../";
?>
<!doctype html>
<html><head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	
	<title><?=SYS_TITUADMIN?></title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="<?=$cJS?>css/bootstrap.min.css">
	<!-- Bootstrap responsive -->
	<link rel="stylesheet" href="<?=$cJS?>css/bootstrap-responsive.min.css">
	<!-- jQuery UI -->
	<link rel="stylesheet" href="<?=$cJS?>css/plugins/jquery-ui/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="<?=$cJS?>css/plugins/jquery-ui/smoothness/jquery.ui.theme.css">
	<!-- PageGuide -->
	<link rel="stylesheet" href="<?=$cJS?>css/plugins/pageguide/pageguide.css">
	<!-- Fullcalendar -->
	<link rel="stylesheet" href="<?=$cJS?>css/plugins/fullcalendar/fullcalendar.css">
	<link rel="stylesheet" href="<?=$cJS?>css/plugins/fullcalendar/fullcalendar.print.css" media="print">
	<!-- colorpicker -->
	<link rel="stylesheet" href="<?=$cJS?>css/plugins/colorpicker/colorpicker.css">
	<!-- chosen -->
	<link rel="stylesheet" href="<?=$cJS?>css/plugins/chosen/chosen.css">
	<!-- select2 -->
	<link rel="stylesheet" href="<?=$cJS?>css/plugins/select2/select2.css">
	<!-- icheck -->
	<link rel="stylesheet" href="<?=$cJS?>css/plugins/icheck/all.css">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="<?=$cJS?>css/style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" href="<?=$cJS?>css/themes.css">
	<!-- Notify -->
	<link rel="stylesheet" href="<?=$cJS?>css/plugins/gritter/jquery.gritter.css">


	<!-- jQuery -->
	<script src="<?=$cJS?>js/jquery.min.js"></script>
	
	
	<!-- Nice Scroll -->
	<script src="<?=$cJS?>js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
	<!-- jQuery UI -->
	<script src="<?=$cJS?>js/plugins/jquery-ui/jquery.ui.core.min.js"></script>
	<script src="<?=$cJS?>js/plugins/jquery-ui/jquery.ui.widget.min.js"></script>
	<script src="<?=$cJS?>js/plugins/jquery-ui/jquery.ui.mouse.min.js"></script>
	<script src="<?=$cJS?>js/plugins/jquery-ui/jquery.ui.draggable.min.js"></script>
	<script src="<?=$cJS?>js/plugins/jquery-ui/jquery.ui.resizable.min.js"></script>
	<script src="<?=$cJS?>js/plugins/jquery-ui/jquery.ui.sortable.min.js"></script>
	<!-- Touch enable for jquery UI -->
	<script src="<?=$cJS?>js/plugins/touch-punch/jquery.touch-punch.min.js"></script>
	<!-- slimScroll -->
	<script src="<?=$cJS?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<!-- Bootstrap -->
	<script src="<?=$cJS?>js/bootstrap.min.js"></script>
	<!-- vmap -->
	<script src="<?=$cJS?>js/plugins/vmap/jquery.vmap.min.js"></script>
	<script src="<?=$cJS?>js/plugins/vmap/jquery.vmap.world.js"></script>
	<script src="<?=$cJS?>js/plugins/vmap/jquery.vmap.sampledata.js"></script>
	<!-- Bootbox -->
	<script src="<?=$cJS?>js/plugins/bootbox/jquery.bootbox.js"></script>
	<!-- Bootbox -->
	<script src="<?=$cJS?>js/plugins/form/jquery.form.min.js"></script>
	<!-- Validation -->
	<script src="<?=$cJS?>js/plugins/validation/jquery.validate.min.js"></script>
	<script src="<?=$cJS?>js/plugins/validation/additional-methods.min.js"></script>
	<!-- Masked inputs -->
	<script src="<?=$cJS?>js/plugins/maskedinput/jquery.maskedinput.min.js"></script>
	<!-- TagsInput -->
	<script src="<?=$cJS?>js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
	<!-- Datepicker -->
	<script src="<?=$cJS?>js/plugins/datepicker/bootstrap-datepicker.js"></script>
	<!-- Daterangepicker -->
	<script src="<?=$cJS?>js/plugins/daterangepicker/daterangepicker.js"></script>
	<script src="<?=$cJS?>js/plugins/daterangepicker/moment.min.js"></script>
	<!-- Timepicker -->
	<script src="<?=$cJS?>js/plugins/timepicker/bootstrap-timepicker.min.js"></script>
	<!-- Colorpicker -->
	<script src="<?=$cJS?>js/plugins/colorpicker/bootstrap-colorpicker.js"></script>
	<!-- Chosen -->
	<script src="<?=$cJS?>js/plugins/chosen/chosen.jquery.min.js"></script>
	<!-- MultiSelect -->
	<script src="<?=$cJS?>js/plugins/multiselect/jquery.multi-select.js"></script>
	<!-- CKEditor -->
	<script src="<?=$cJS?>js/plugins/ckeditor/ckeditor.js"></script>
	<!-- PLUpload -->
	<script src="<?=$cJS?>js/plugins/plupload/plupload.full.js"></script>
	<script src="<?=$cJS?>js/plugins/plupload/jquery.plupload.queue.js"></script>
	<!-- Custom file upload -->
	<script src="<?=$cJS?>js/plugins/fileupload/bootstrap-fileupload.min.js"></script>
	<script src="<?=$cJS?>js/plugins/mockjax/jquery.mockjax.js"></script>
	<!-- select2 -->
	<script src="<?=$cJS?>js/plugins/select2/select2.min.js"></script>
	<!-- icheck -->
	<script src="<?=$cJS?>js/plugins/icheck/jquery.icheck.min.js"></script>
	<!-- complexify -->
	<script src="<?=$cJS?>js/plugins/complexify/jquery.complexify-banlist.min.js"></script>
	<script src="<?=$cJS?>js/plugins/complexify/jquery.complexify.min.js"></script>
	<!-- Mockjax -->
	<script src="<?=$cJS?>js/plugins/mockjax/jquery.mockjax.js"></script>
    
	<!-- Flot -->
	<script src="<?=$cJS?>js/plugins/flot/jquery.flot.min.js"></script>
	<script src="<?=$cJS?>js/plugins/flot/jquery.flot.bar.order.min.js"></script>
	<script src="<?=$cJS?>js/plugins/flot/jquery.flot.pie.min.js"></script>
	<script src="<?=$cJS?>js/plugins/flot/jquery.flot.resize.min.js"></script>
	<!-- imagesLoaded -->
	<script src="<?=$cJS?>js/plugins/imagesLoaded/jquery.imagesloaded.min.js"></script>
	<!-- PageGuide -->
	<script src="<?=$cJS?>js/plugins/pageguide/jquery.pageguide.js"></script>
	<!-- FullCalendar -->
	<script src="<?=$cJS?>js/plugins/fullcalendar/fullcalendar.min.js"></script>
	<!-- Chosen -->
	<script src="<?=$cJS?>js/plugins/chosen/chosen.jquery.min.js"></script>
	<!-- select2 -->
	<script src="<?=$cJS?>js/plugins/select2/select2.min.js"></script>
	<!-- icheck -->
	<script src="<?=$cJS?>js/plugins/icheck/jquery.icheck.min.js"></script>
	<!-- Notify -->
	<script src="<?=$cJS?>js/plugins/gritter/jquery.gritter.min.js"></script>

	<!-- Theme framework -->
	<script src="<?=$cJS?>js/eakroko.js"></script>
	<!-- Theme scripts -->
	<script src="<?=$cJS?>js/application.js"></script>
	<!-- Just for demonstration -->
	<script src="<?=$cJS?>js/demonstration.js"></script>
    <!-- faisher -->
    <script type="text/javascript" src="<?=$cJS?>js/ajax_jquery.js"></script>
    <script type="text/javascript" src="<?=$cJS?>js/jquery.ba-dotimeout.js"></script>
	<script src="<?=$cJS?>js/jquery.cookie.js" type="text/javascript"></script> 
	<script language="javascript" type="text/javascript" src="<?=$cJS?>js/plugins/textarea-autogrow.js"></script> 
    <!--picker-->
    <link href="<?=$cJS?>js/plugins/mobiscroll/css/mobiscroll.custom.min.css" rel="stylesheet" type="text/css" />
    <script src="<?=$cJS?>js/plugins/mobiscroll/js/mobiscroll.custom.min.js" type="text/javascript"></script>

	
	<!--[if lte IE 9]>
		<script src="<?=$cJS?>js/plugins/placeholder/jquery.placeholder.min.js"></script>
		<script>
			$(document).ready(function() {
				$('input, textarea').placeholder();
			});
		</script>
	<![endif]-->

	<!-- Favicon -->
	<link rel="shortcut icon" href="<?=$cJS?>img/favicon.ico" />
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="<?=$cJS?>img/apple-touch-icon-precomposed.png" />

<!-- production -->
<script type="text/javascript" src="<?=$cJS?>js/plugins/plupload/js/plupload.full.min.js"></script>
<!-- debug 
<script type="text/javascript" src="plupload/js/moxie.js"></script>
<script type="text/javascript" src="plupload/js/plupload.dev.js"></script>
-->   
<script>
function exibMensagem(v_idEnd,v_tipo,v_msg,v_timer){
	if(v_timer != "" && v_timer != null){ v_timer = v_timer; }else{ v_timer = 10000; }
   	var div_aleat = 'div_aleat'+parseInt(Math.random()*99999);
	$("#"+div_aleat).remove();
	var tipo = "";
	if(v_tipo == "sucesso"){ tipo = "alert-success"; }
	if(v_tipo == "info"){ tipo = "alert-info"; }
	if(v_tipo == "erro"){ tipo = "alert-error"; }
	$('#'+v_idEnd).append('<div class="alert '+tipo+'" style="margin:10px;" id="'+div_aleat+'"><button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>'+v_msg+'</div>');
	//TIMER
	$.doTimeout('vTimer'+div_aleat, v_timer, function(){ $('#'+div_aleat).fadeOut(2000,function(){ $("#"+div_aleat).remove(); }); });//TIMER
}//exibMensagem
</script>
</head>
<body>
<div id="altura_iframe">
<?php
///dados do padrão iframe upload
?>
<?php
$var_UP = "C";//var de ID
?>
        <a id="maxFiles<?=$var_UP?>" href="#" class="btn btn-lime btn-block" onClick="alert('Máximo de arquivos já recebidos!');return false;" style="display:none; text-align:left;"><i class="icon-check"></i> <?php if($n_arquivos > "1"){ echo $class_fLNG->txt(__FILE__,__LINE__,'MÁXIMO DE !!cont!! ARQUIVOS RECEBIDOS COM SUCESSO',array("cont"=>$n_arquivos)); }else{ echo $class_fLNG->txt(__FILE__,__LINE__,'SEU ARQUIVO FOI RECEBIDO COM SUCESSO'); }?>! <i class="icon-arrow-down" style="float:right;"></i></a> 
      <div id="container<?=$var_UP?>" style="margin:5px 0 5px 0;">
        <a id="pickfiles<?=$var_UP?>" href="#" onclick="sinalScan();" class="btn btn-primary btn-large"><i class="icon-folder-open"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'SCANNEAR DOCUMENTO')?></a> 
        <a id="uploadfiles<?=$var_UP?>" href="javascript:;" class="btn" style="display:none;"><?php if($n_arquivos > "1"){ echo $class_fLNG->txt(__FILE__,__LINE__,'CARREGAR ARQUIVOS'); }else{ $class_fLNG->txt(__FILE__,__LINE__,'CARREGAR ARQUIVO'); }?></a>
        </div>
      <pre id="console<?=$var_UP?>" style="display:none;"></pre>
      <div id="msgDiv<?=$var_UP?>"></div>
	  
      <div style="width:1px;" id="verFS<?=$idTemp?>"></div>
      
    
      
<script type="text/javascript">
$(document).ready(function(e) {
<?php if($cVerificador != ""){?>
    val = parent.document.getElementById("<?=$cVerificador?>").value;
	if(val >= '<?=$n_arquivos?>'){
		$("#pickfiles<?=$var_UP?>").hide();
		$("#ext<?=$var_UP?>").hide();
		$("#msgDiv<?=$var_UP?>").html('<span style="font-size:20px;"><b><?=$class_fLNG->txt(__FILE__,__LINE__,'Arquivo já enviado pelo PC!')?></b></span>');
		$("#container<?=$var_UP?>").hide();
	}
<?php }//if($cVerificador >= "1"){?>	
});
function sinalScan(){

<?php if(!isset($_SESSION["scanner_pc"])){?>
	alert('Não foi selecionado scanner, verifique!');
<?php }else{//if($_SESSION["scanner_pc"]{?>
	atualizarLista('<?=$_SESSION["scanner_pc"]?>','insert');

	
	$.doTimeout('vTimerListaArquivos', 1000, function(){  
		if($('#div_aguardandoDoc').is(':visible') == true){
			faisher_ajax('verFS<?=$idTemp?>', '0', 'scanner_iframe.php', 'idTemp=<?=$idTemp?>&idIframe=<?=$idIframe?>&arq=<?=$tipo_arq?>&n_arq=<?=$n_arquivos?>&maxSize=<?=$maxSize?>&maxImg=<?=$maxImg?>&desc=<?=$desc?>&funcao=<?=$funcao?>&retornoUrl=<?=$retornoUrl?>&tm_w=<?=$tm_w?>&tm_h=<?=$tm_h?>&mostra=<?=$disp_mostra?>&verificaScanner=on2&cVerificador=<?=$cVerificador?>');
			return true;
		}else{
			$.doTimeout('vTimerListaArquivos');
		}
	});//TIMER	
<?php }//}else{//if($_SESSION["scanner_pc"]{?>		
}

function atualizarLista(v_pc,v_insert,v_get){
	if(v_insert != null){ v_get = "&insert=1"; }
	v_get += "&v_pc="+v_pc;
	faisher_ajax('listaArquivos<?=$var_UP?>', '0', 'scanner_iframe.php', 'idTemp=<?=$idTemp?>&idIframe=<?=$idIframe?>&arq=<?=$tipo_arq?>&n_arq=<?=$n_arquivos?>&maxSize=<?=$maxSize?>&maxImg=<?=$maxImg?>&desc=<?=$desc?>&funcao=<?=$funcao?>&retornoUrl=<?=$retornoUrl?>&tm_w=<?=$tm_w?>&tm_h=<?=$tm_h?>&mostra=<?=$disp_mostra?>&listaArquivos=on2&cVerificador=<?=$cVerificador?>'+v_get);	
}



function atualizaAlturaIframe(){
	parent.document.getElementById("<?=$idIframe?>").height = document.getElementById("altura_iframe").scrollHeight; //40: Margem Superior e Inferior, somadas
	//alert(document.getElementById("altura_iframe").scrollHeight);
	//parent.document.getElementById("<?=$idIframe?>").height = $('#altura_iframe').height(); //40: Margem Superior e Inferior, somadas
}//atualizaAlturaIframe



</script>
<script type="text/javascript">
$(document).ready(function(){
	atualizaAlturaIframe();
	atualizarLista('<?=$_SESSION["scanner_pc"]?>',null,"&abrir=1");
	//var pai = window.parent.<?=$funcao?>('0');
	//faisher_ajax('listaArquivos<?=$var_UP?>', '0', 'scanner_iframe.php', 'idTemp=<?=$idTemp?>&idIframe=<?=$idIframe?>&arq=<?=$tipo_arq?>&n_arq=<?=$n_arquivos?>&maxSize=<?=$maxSize?>&maxImg=<?=$maxImg?>&desc=<?=$desc?>&funcao=<?=$funcao?>&retornoUrl=<?=$retornoUrl?>&tm_w=<?=$tm_w?>&tm_h=<?=$tm_h?>&mostra=<?=$disp_mostra?>&listaArquivos=on2&cVerificador=<?=$cVerificador?>');

});
</script>
      <style>
.listaFiles<?=$var_UP?>{
	padding:3px;
	border-bottom:#CCC 1px dashed;
}
</style>
      <div id="listaArquivos<?=$var_UP?>"></div>
<?php




?>
<div style="clear:both;"></div>
</div>
<div style="display:none;" id="divoculta"></div>
</body>
</html>
<?php






//REMOVE CONEXAO
//fecha todas as conexoes abertas
$classe_db->FechaConexaoAll($SCRIPTOFF);//fecha conexoes
?>