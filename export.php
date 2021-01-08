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


	
//verifica se o acesso é do propio servidor - se nao for, ativa acesso com login
if((SYS_IPPUBLICO != $_SERVER["REMOTE_ADDR"]) or (!isset($_GET["get"]))){
	//CLASSES PROTEGE PAGINA/LOGIN --->>>
	//protege a pagina
	$cVLogin = new classVLOGIN;//inicia a classe de login
	$cVLogin->loginCookie();//verifica o login e cria array de login
	$cVLogin->loginSession("expo");//faz a atualização de session do login atual
	//CLASSES PROTEGE PAGINA/LOGIN ---<<<
	$semLogin = "0";
}else{//if((SYS_IPPUBLICO != $_SERVER["REMOTE_ADDR"]) or (!isset($_GET["get"]))){
	$semLogin = "1";
}//else{//if((SYS_IPPUBLICO != $_SERVER["REMOTE_ADDR"]) or (!isset($_GET["get"]))){





//var de acao
	if(isset($_POST["acao"])){ $acao = $_POST["acao"]; }else{ $acao = "off"; }
	if(isset($_GET["a"])){ $acao = $_GET["a"]; }
	//echo "<br>-_POST: <pre>"; print_r($_POST);  echo "</pre>"; exit(0);







//montagem de dados para PDF
if($acao == "pdf"){
	$nome_pdf = $_POST["nome"];
	$titulo = stripslashes($_POST["titulo"]);
	$dados = $_POST["dados"];//decodifica o valor passado pelo link
	if(isset($_POST["dadosJson"])){ $dados = $_POST["dadosJson"]; }
	$dados = urldecode($dados);//decodifica o valor passado pelo link
	if(isset($_POST["dadosJson"])){ $dados = json_decode($dados, true); }else{ $dados = unserialize($dados); }//transforma a string em array
	if(isset($_POST["pg"])){ $numero_pg = $_POST["pg"]; }else{ $numero_pg = "1"; }
	if(isset($_POST["border"])){ $border = $_POST["border"]; }else{ $border = "1"; }
	//echo "DADOS:<pre>"; print_r($dados); echo "</pre>"; echo "_POST:<pre>"; print_r($_POST); echo "</pre>"; exit(0);





//inicia a tabela de dados
$html_class = "";
if($border == "0"){
$html_dados = '
<table width="100%" border="0" cellspacing="0" cellpadding="1" style="margin-top:10px; padding:5px;">
  <tr>
    <td width="35%" height="1"></td>
    <td width="65%"></td>
  </tr>';
}else{//if($border == "0"){
$html_dados = '
<table width="100%" border="0" cellspacing="0" cellpadding="1" style="border:#CCC 1px solid; margin-top:10px; padding:5px;">
  <tr>
    <td width="35%" height="1"></td>
    <td width="65%"></td>
  </tr>';
}//else{//if($border == "0"){


	//monta array
	$array = $dados;
	$cont_ARRAY = ceil(count($array));
	if($cont_ARRAY >= "1"){
		$listaIDS_a = $array; //nome do cookie
		foreach ($listaIDS_a as $pos => $valor){
			//spacer
			if($valor["top"] != ""){
				$html_dados .= '
				  <tr>
					<td colspan="2" height="'.$valor["top"].'">&nbsp;</td>
				  </tr>';
			}//if($valor["top"] != ""){
			//titulo
			if($valor["titulo"] != ""){
				$html_dados .= '
				  <tr>
					<td colspan="2" style="padding:5px; font-size:16px; border-bottom:#CCC 1px solid; font-weight:bold;">'.marcadorBASE64_($valor["titulo"]).'</td>
				  </tr>';
			}//if($valor["titulo"] != ""){
			//spacer
			if($valor["bottom"] != ""){
				$html_dados .= '
				  <tr>
					<td colspan="2" height="'.$valor["bottom"].'">&nbsp;</td>
				  </tr>';
			}//if($valor["bottom"] != ""){
			if(is_array($valor["content"])){
				//monta array secundario
				$arrayS = $valor["content"];
				$cont_ARRAYS = ceil(count($arrayS));
				if($cont_ARRAYS >= "1"){
					$listaIDS_S = $arrayS; //nome do cookie
					foreach ($listaIDS_S as $posS => $valorS){
						if($valorS["type"] == "div"){
							$_dados = str_replace("[,]", "</td><td>", $valorS["content"]);
							$html_dados .= '
							  <tr>
								<td colspan="2">
									<table border="0" cellspacing="0" cellpadding="3">
									  <tr><td>'.marcadorBASE64_($_dados).'</td>
									  </tr>
									</table>
								</td>
							  </tr>';
						}//if($valorS["type"] == ""){
						if($valorS["type"] == "css"){
							$html_class .= ' '.$valorS["content"];
						}//if($valorS["type"] == ""){
						if($valorS["type"] == "text"){
							$d = explode("[,]", $valorS["content"]);
							$html_dados .= '
							  <tr>
								<td style="color:#666; padding:5px;">'.marcadorBASE64_($d["0"]).'</td>
								<td style="padding:5px;">'.marcadorBASE64_($d["1"]).'</td>
							  </tr>';
						}//if($valorS["type"] == ""){
						if($valorS["type"] == "html"){
							$html_dados .= '
							  <tr>
								<td colspan="2">'.marcadorBASE64_($valorS["content"]).'</td>
							  </tr>';
						}//if($valorS["type"] == ""){
						if($valorS["type"] == "borda"){
							$html_dados .= '
							  <tr>
								<td colspan="2" style="height:1px; border-top:#CCC 1px solid; margin:5px 0 5px 0;"></td>
							  </tr>';
						}//if($valorS["type"] == ""){
						if($valorS["type"] == "linha"){
							if($valorS["content"] >= "1"){ $hei = $valorS["content"]; }else{ $hei = "15"; }
							$html_dados .= '
							  <tr>
								<td height="'.$hei.'" colspan="2"></td>
							  </tr>';
						}//if($valorS["type"] == ""){
						if($valorS["type"] == "linhahtml"){
							$html_dados .= '
							  <tr>
								<td colspan="2" style="padding:5px;">'.marcadorBASE64_($valorS["content"]).'</td>
							  </tr>';
						}//if($valorS["type"] == ""){
					}//fim foreach
				}//fim if($cont_ARRAYS >= "1"){
				//fim for exibe array secundario
			}//if(is_array($valor["content"]){
		}//fim foreach
	}//fim if($cont_ARRAY >= "1"){
	//fim for exibe array

//finaliza tabela de dados
$html_dados .= '
</table>';
//verifica se recebeu stilo css
if($html_class != ""){
	$html_dados .= '
	<style>'.$html_class.'</style>';
}
			
	
    $html_load = stripslashes($html_titulo.$html_dados);
    //$html_load = stripslashes(utf8_decode($html_titulo.$html_dados));
	//echo "<textarea>";  echo $html_load; echo "</textarea>"; exit(0);
	//echo $html_load; exit(0);//	if($cVLogin->userId() == "1"){ echo $html_load; exit(0); }
	
	
	
	
	//verifica qual logomarca de impressão usar -------------------------------------------------------------------------->>>
	$caminho_logo_impressao = VAR_DIR_FILES.'files/logos/logo_impressao.png';
	if($semLogin != "1"){ $file_perf = VAR_DIR_FILES.'files/logos/logo_impressao_perfil'.$cVLogin->getVarLogin("SYS_USER_PERFIL_ID").'.png'; }
	if(file_exists($file_perf)){ $caminho_logo_impressao = $file_perf ; }
	//verifica qual logomarca de impressão usar --------------------------------------------------------------------------<<<
	

    
	
	//CLASSES GERAR PDF ---> > >
	$classe_pdf = new fPDF("");//inicia a classe informando o caminho da pasta: sys
	$classe_pdf->nomeFile($nome_pdf);
	if($semLogin == "1"){ 
		$classe_pdf->mostraData("INTEGRAÇÃO WEB SERVICE - ".date('d/m/Y H:i')."h");//mostra data no título
	}else{
		$classe_pdf->mostraData($cVLogin->perfil()." - ".date('d/m/Y H:i')."h");//mostra data no título
	}
	$classe_pdf->cabecalho('<img src="'.$caminho_logo_impressao.'">',$titulo);//colunas de exibição de cabeçalho
	$classe_pdf->cabecalhoW("1","1%"); $classe_pdf->cabecalhoW("2","99%");//largura de coluna 1 e 2 do cabeçalho
	if($numero_pg == "1"){ $classe_pdf->nPagina(); }//ativa exeibição número de páginas
	$classe_pdf->conteudo($html_load);
	if(isset($_GET["DOW"])){
		//gera o pdf - COM DOWNLOAD
		$classe_pdf->gerarPDF("down");	
	}else{
		//gera o pdf - SEM DOWNLOAD
		$classe_pdf->gerarPDF("view");
	}

}//if($acao == "pdf"){













//montagem de dados para PDF em HTML
if($acao == "pdfhtml"){
	//ini_set('display_errors',1);ini_set('display_startup_erros',1);error_reporting(E_ALL);
	$nome_pdf = $_POST["nome"];
	$titulo = stripslashes($_POST["titulo"]);
	$html = stripslashes($_POST["html"]);
	if(isset($_POST["cabecalho"])){ $cabecalho = $_POST["cabecalho"]; }else{ $cabecalho = ""; }
	if(isset($_POST["pg"])){ $numero_pg = $_POST["pg"]; }else{ $numero_pg = "1"; }
	
	//adiciona imagem recebida
	if((isset($_POST["img"])) and ($_POST["img"] != "")){
		$img = fGERAL::cptoFaisher($_POST["img"], "des");
		$html .= '<div style="width:700px; height:900px; background-image:url('.$img.'); background-repeat:no-repeat; background-position:center; background-size:50%;"></div>';
		//se for um arquivo PHP, cancela o download
		$img_e =  fGERAL::mostraExtensao($img);	if($img_e == "php"){ exit(0); }
	}//if((isset($_POST["img"])) and ($_POST["img"] != "")){
	
    $html_load = stripslashes($html);
    //$html_load = stripslashes(utf8_decode($html));
	//echo "<textarea>";  echo $html_load; echo "</textarea>"; exit(0);
	//echo "<br>html:".$html; exit(0);
	
	
	//verifica qual logomarca de impressão usar -------------------------------------------------------------------------->>>
	$caminho_logo_impressao = VAR_DIR_FILES.'files/logos/logo_impressao.png';
	//if($semLogin != "1"){ $file_perf = VAR_DIR_FILES.'files/logos/logo_impressao_perfil'.$cVLogin->getVarLogin("SYS_USER_PERFIL_ID").'.png'; }
	if(file_exists($file_perf)){ $caminho_logo_impressao = $file_perf ; }
	//verifica qual logomarca de impressão usar --------------------------------------------------------------------------<<<
	
		
	//CLASSES GERAR PDF ---> > >
	$classe_pdf = new fPDF("");//inicia a classe informando o caminho da pasta: sys
	$classe_pdf->nomeFile($nome_pdf);
	$classe_pdf->mostraData($cVLogin->perfil()." - ".date('d/m/Y H:i')."h");//mostra data no título
	if($cabecalho != ""){ $classe_pdf->cabecalho('<img src="'.$caminho_logo_impressao.'">',$titulo); }//colunas de exibição de cabeçalho
	$classe_pdf->cabecalhoW("1","1%"); $classe_pdf->cabecalhoW("2","99%");//largura de coluna 1 e 2 do cabeçalho
	if(isset($_POST["legPg"])){ $classe_pdf->legPagina($_POST["legPg"]); }//legenda complementar em númeração de página
	if($numero_pg == "1"){ $classe_pdf->nPagina(); }//ativa exeibição número de páginas
	$classe_pdf->conteudo($html_load);
	if(isset($_GET["SAVE"])){
		//gera o pdf - COM DOWNLOAD
		$classe_pdf->gerarPDF("save");	
	}else if(isset($_GET["DOW"])){
		//gera o pdf - COM DOWNLOAD
		$classe_pdf->gerarPDF("down");	
	}else{
		//gera o pdf - SEM DOWNLOAD
		$classe_pdf->gerarPDF("view");
	}
	
	if(isset($_POST["img_apagar"])){ 
		$img_apagar = $_POST["img_apagar"]; 
		delete(VAR_DIR_FILES.'files/temp/'.$img_apagar);
	}
}//if($acao == "pdfhtml"){




























//montagem de dados para CSV
if($acao == "csv"){
	$nome_csv = $_POST["nome"];
	$titulo = stripslashes($_POST["titulo"]);

	//CLASSES GERAR CSV ---> > >
	$classe_csv = new fCSV();//inicia a classe
	$classe_csv->nomeFile($nome_csv);
	$classe_csv->titulo($titulo);
	$classe_csv->mostraData($cVLogin->perfil()." - ".date('d/m/Y H:i')."h");//mostra data no título
	
	
		//dados post
		$dados = urldecode($_POST["dados"]);//decodifica o valor passado pelo link
		$dados = stripslashes($dados);//limpa a string de \ antes de "
		//monta array
		$array = unserialize($dados);//transforma a string em array
		$cont_ARRAY = ceil(count($array));
		if($cont_ARRAY >= "1"){
			foreach ($array as $pos => $valor){
				//titulo
				if($valor["titulo"] != ""){
					$classe_csv->addLinha();//cria/quebra uma linha
					$classe_csv->addCampo($valor["titulo"]);//cria campo da linha - adicionar varios desse pra formar a linha
					$classe_csv->addCampo("");//cria campo da linha - adicionar varios desse pra formar a linha
					$classe_csv->addLinha();//cria/quebra uma linha
				}//if($valor["titulo"] != ""){
					
				//content lista dados
				if(is_array($valor["content"])){
					//monta array secundario
					$arrayS = $valor["content"];
					$cont_ARRAYS = ceil(count($arrayS));
					if($cont_ARRAYS >= "1"){
						$listaIDS_S = $arrayS; //nome do cookie
						foreach ($listaIDS_S as $posS => $valorS){
							
							if($valorS["type"] == "div"){
								unset($arDiv); $arDiv = explode("[,]", $valorS["content"]);
								//monta array de dados
								$cont_ARRAYDIV = ceil(count($arDiv));
								if($cont_ARRAYDIV >= "1"){
									foreach($arDiv as $pos => $valorDIV){
										$classe_csv->addCampo($valorDIV);//cria campo da linha - adicionar varios desse pra formar a linha
									}//fim foreach
								}//fim if($cont_ARRAYDIV >= "1"){
								$classe_csv->addLinha();//cria/quebra uma linha
							}//if($valorS["type"] == "div"){
								
							if($valorS["type"] == "text"){
								$d = explode("[,]", $valorS["content"]);						
								$classe_csv->addCampo($d["0"].": ");//cria campo da linha - adicionar varios desse pra formar a linha
								$classe_csv->addCampo($d["1"]);//cria campo da linha - adicionar varios desse pra formar a linha
								$classe_csv->addLinha();//cria/quebra uma linha
							}//if($valorS["type"] == "text"){
								
							if($valorS["type"] == "html"){
								$classe_csv->addCampo($valorS["content"]);//cria campo da linha - adicionar varios desse pra formar a linha
								$classe_csv->addLinha();//cria/quebra uma linha
							}//if($valorS["type"] == "html"){
								
							if($valorS["type"] == "linha"){
								$classe_csv->addLinha();//cria/quebra uma linha
							}//if($valorS["type"] == "linha"){
								
							if($valorS["type"] == "linhahtml"){
								$classe_csv->addCampo($valorS["content"]);//cria campo da linha - adicionar varios desse pra formar a linha
								$classe_csv->addLinha();//cria/quebra uma linha
							}//if($valorS["type"] == "linhahtml"){
								
						}//fim foreach
					}//fim if($cont_ARRAYS >= "1"){
					//fim for exibe array secundario
				}//if(is_array($valor["content"]){
					
			}//fim foreach
		}//fim if($cont_ARRAY >= "1"){
		//fim for exibe array
		

		

	//CLASSES GERAR CSV ---> > >
	$classe_csv->gerarCSV();
			

}//if($acao == "csv"){
	
	





















//imprimir HTML
if($acao == "html"){
	$head = stripslashes($_POST["head"]);
	$titulo = stripslashes($_POST["titulo"]);
	$html = stripslashes($_POST["html"]);


	
$html_titulo = '<style type="text/css">
body {
	background-color: #FFF;
	background-image:url();
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.esconder-impressao{
	display:none;
}
</style>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-bottom:#000 1px solid;">
  <tr>
    <td style="font-size:10px; color:#333; text-align:right;">Data de emissão '.date('d/m/Y H:i').'h</td>
  </tr>
  <tr>
    <td style="font-size:18px; text-align:center;">'.$titulo.'</td>
  </tr>
</table>
<div style="border:#CCC 1px solid; margin-top:10px; padding:5px;">';
	
	
	
	echo $head;
	echo $html_titulo;
?>
<?php
}//if($acao == "html"){
	
	
	
	














//montagem de visualização de pdf TEMP
if($acao == "viewTempPdf"){
	$temp = getpost_sql($_GET["temp"]);
	$temp  = str_replace("..", "", $temp );
	$upload_dir_temp = VAR_DIR_FILES."files/temp/".$temp;
	if(file_exists($upload_dir_temp)){
		$mType = mime_content_type($upload_dir_temp);
		if($mType == "application/pdf"){
			//exibir no navegador
			header("Content-Type: application/pdf");					
			header('Content-Disposition: inline; filename="'.$temp.'"');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			echo file_get_contents($upload_dir_temp);
		}//if($mType == "application/pdf"){
		
	}else{
		echo "404... <br>Arquivo não localizado :O";
	}

}//if($acao == "viewTempPdf"){
	
	
	
	
	
	
	
//montagem de visualização de pdf TEMP
if($acao == "viewPdf"){
	$caminho_file = fGERAL::cptoFaisher(getpost_sql($_GET["caminho_file"]),"des");
	if(file_exists($caminho_file)){
		$mType = mime_content_type($caminho_file);
		if($mType == "application/pdf"){
			//exibir no navegador
			header("Content-Type: application/pdf");					
			header('Content-Disposition: inline; filename="'.basename($caminho_file).PHP_EOL.'"');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			echo file_get_contents($caminho_file);
		}//if($mType == "application/pdf"){
		
	}else{
		echo "404... <br>Arquivo não localizado :O";
	}

}//if($acao == "viewTempPdf"){	





































//montagem de dados para PDF em HTML
if($acao == "processoFull"){
	//ini_set('display_errors',1);ini_set('display_startup_erros',1);error_reporting(E_ALL);
	$titulo = stripslashes($_POST["titulo"]);
	$code = getpost_sql($_POST["code"]);
	
	$qrcode_img = time().$cVLogin->getVarLogin("SYS_USER_ID").".jpeg";
	$html = capaProcesso($code, $qrcode_img, ''); 

	if(isset($_POST["cabecalho"])){ $cabecalho = $_POST["cabecalho"]; }else{ $cabecalho = ""; }
	
	//adiciona imagem recebida
	if((isset($_POST["img"])) and ($_POST["img"] != "")){
		$img = fGERAL::cptoFaisher($_POST["img"], "des");
		$html .= '<div style="width:700px; height:900px; background-image:url('.$img.'); background-repeat:no-repeat; background-position:center; background-size:50%;"></div>';
		//se for um arquivo PHP, cancela o download
		$img_e =  fGERAL::mostraExtensao($img);	if($img_e == "php"){ exit(0); }
	}//if((isset($_POST["img"])) and ($_POST["img"] != "")){
	
    $html_load = stripslashes($html);
    //$html_load = stripslashes(utf8_decode($html));
	//echo "<textarea>";  echo $html_load; echo "</textarea>"; exit(0);
	//echo "<br>html:".$html; exit(0);
	
	
	//verifica qual logomarca de impressão usar -------------------------------------------------------------------------->>>
	$caminho_logo_impressao = VAR_DIR_FILES.'files/logos/logo_impressao.png';
	if($semLogin != "1"){ $file_perf = VAR_DIR_FILES.'files/logos/logo_impressao_perfil'.$cVLogin->getVarLogin("SYS_USER_PERFIL_ID").'.png'; }
	if(file_exists($file_perf)){ $caminho_logo_impressao = $file_perf ; }
	//verifica qual logomarca de impressão usar --------------------------------------------------------------------------<<<
	
	$file = md5(uniqid(time())).".pdf";
	$caminho_pdf = VAR_DIR_FILES."files/temp/".$file;
	//CLASSES GERAR PDF ---> > >
	$classe_pdf = new fPDF("");//inicia a classe informando o caminho da pasta: sys
	$classe_pdf->nomeFile($caminho_pdf);
	$classe_pdf->mostraData($cVLogin->perfil()." - ".date('d/m/Y H:i')."h");//mostra data no título
	if($cabecalho != ""){ $classe_pdf->cabecalho('<img src="'.$caminho_logo_impressao.'">',$titulo); }//colunas de exibição de cabeçalho
	$classe_pdf->cabecalhoW("1","1%"); $classe_pdf->cabecalhoW("2","99%");//largura de coluna 1 e 2 do cabeçalho
	$classe_pdf->conteudo($html_load);

	$classe_pdf->gerarPDF("save");	
	$arrPDF[] = $caminho_pdf;
	$arrPDFApagar[] = $caminho_pdf;
	
	delete(VAR_DIR_FILES."files/temp/".$qrcode_img);
	
	$linha = fSQL::SQL_SELECT_ONE("id,ano,mes,dia","axl_processo","code = '".$code."'");

	$processo_id = $linha["id"];
	$caminho_file = VAR_DIR_FILES."files/tabelas/axl_processo/".$linha["ano"]."/".completa_zero($linha["mes"],"2")."/".completa_zero($linha["dia"],"2")."/".$code."/files/";

	$resu = fSQL::SQL_SELECT_SIMPLES("valor","axl_processo_campos","processo_id = '".$processo_id."' AND tipo_campo = '9'");
	while($linha = fSQL::FETCH_ASSOC($resu)){
		$arrPDF[] = $caminho_file.$linha["valor"];
	}
	
	require_once('sys/fpdi/tcpdf/tcpdf.php');
	require_once('sys/fpdi/fpdf/fpdf.php');
	require_once('sys/fpdi/fpdi.php');
	require_once('sys/fpdi/fpdf_tpl.php');
	require_once('sys/fpdi/rotate.php');//FPDI_ROTATE
	require_once('sys/fpdi/concat.php');//FPDI_CONCAT		

	// initiate FPDI usando a rotação FPDI_ROTATE
	$pdf = new FPDI_ROTATE('L', 'mm', array(602,338), true, 'UTF-8');
	$pdf->setPrintHeader(false); $pdf->setPrintFooter(false);//++AJUSTE (margens e espaçamento)
	$pdf->SetMargins(0, 0, 0); $pdf->SetAutoPageBreak(true, 0);//++AJUSTE (margens e espaçament
	
	foreach($arrPDF as $file){
		$pageCount = $pdf->setSourceFile($file);
		// iterate through all pages
		for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) { $cont_files++;
		
			// import a page
			$templateId = $pdf->importPage($pageNo);	
			// get the size of the imported page
			$size = $pdf->getTemplateSize($templateId);
			//pega largura e altura maximo
			$pgW = (int)$size['w']; $pgH = (int)$size['h'];			
			$pdf->AddPage('P', array($pgW,$pgH)); 
			
			// use the imported page
			$pdf->useTemplate($templateId,0,0, $pgW, $pgH);	
		}//fim for
		//delete($file);
	}

	// Output the new PDF
	$bin = $pdf->Output("", "S");
	
	foreach($arrPDFApagar as $file){
		delete($file);
	}
	
	if($bin != ""){
		// Configuramos os headers que serão enviados para o browser
		header('Content-Description: File Transfer');
		header('Content-Disposition: attachment; filename="processus_'.str_replace(" ","_",$code).'.pdf"');
		header('Content-Type: application/octet-stream');
		header('Content-Transfer-Encoding: binary');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Expires: 0');
		echo $bin;	
	}//if($bin != ""){	
	
}//if($acao == "pdfhtml"){











	
	























	
	
	









//REMOVE CONEXAO
//fecha todas as conexoes abertas
$classe_db->FechaConexaoAll($SCRIPTOFF);//fecha conexoes
?>