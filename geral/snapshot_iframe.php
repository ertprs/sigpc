<?php // Breno Cruvinel - breno.cruvinel09@gmail.com
//INCLUDES DE CONTROLE --->>>
include "../config/globalSession.php";//inicia sessao php
include "../config/globalVars.php";//vars padrao
include "../sys/langAction.php";//inicia arquivo de linguag
include "../sys/globalFunctions.php";//funcoes padrao
include "../sys/globalClass.php";//classes padrao
include "../sys/classConexao.php";//classes de conexao
include "../sys/incUpdate.php";//verificador de updates
include "../config/incPacote.php";//vars do pacote de cliente
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
$cVLogin->loginSession("shot");//faz a atualização de session do login atual
//CLASSES PROTEGE PAGINA/LOGIN ---<<<


//INCLUDE FAISHER, CONTROLE DE ARQUIVOS
$SYS_VALIDASEMQUADRO = "Jesus te Ama!";
	

	

//caminho do fonte iframe
if(isset($_GET["c"])){ $caminho_script = $_GET["c"]; }else{ $caminho_script = "geral/"; }


//grava descricao recebida
if(isset($_GET["gdesc"])){
	$gdesc = getpost_sql($_GET["gdesc"]);
	$tdesc = getpost_sql($_GET["tdesc"]);
	//atualiza dados da tabela no DB
	$campos = "titulo";
	$tabela = "sys_snapshot_temp";
	$valores = array($tdesc);
	$condicao = "id='$gdesc'";
	fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
	exit(0);
}//fim if(isset($_GET["gravadescricao"])){


//vars
$idTemp = $_GET["idTemp"]; //id da acao de resgate dos dados temp
$idIframe = $_GET["idIframe"]; //id iframe e id temp retorno
$tmDISP = $_GET["tmDISP"];//tamanho display WxH > 320x200
$AtmDISP = explode("x",$tmDISP);
$tmIMG = $_GET["tmIMG"];//tamanho arquivo de img WxH > 1280x720
$AtmIMG = explode("x",$tmIMG);
if(isset($_GET["ini"])){  $ini = $_GET["ini"]; }else{ $ini = "0"; } //exibe camera
if(isset($_GET["titu"])){  $titu = $_GET["titu"]; }else{ $titu = "0"; } //exibe o campo para titulo
if(isset($_GET["funcao"])){  $funcao = $_GET["funcao"]; }else{ $funcao = ""; } //funcao javascript executa apos listagem







/* JPEGCam Test Script */
/* Receives JPEG webcam submission and saves to local file. */
/* Make sure your directory has permission to write files as your web server user! */
if(isset($_GET["filename"])){
	$filecaminho = VAR_DIR_FILES."files/temp/snapshot/";// $_GET["filename"];
	$filename = md5(uniqid(time())) . '.jpg';
	if(file_exists($filename)){ $filename = md5(uniqid(time())) . '.jpg'; }
	
	$result = file_put_contents( $filecaminho.$filename, file_get_contents('php://input') );
	if(!$result){
		print "ERROR: Failed to write data to $filename, check permissions\n";
		exit(0);
	}
	
	if(file_exists($filecaminho.$filename)){
		$time_g = time()+18000;//adiciona 5 horas
		//busca ultimo id para insert
		$tabela = "sys_snapshot_temp";
		$id_it = fSQL::SQL_SELECT_INSERT($tabela, "id");
		//VARS insert simples SQL
		$campos = "id,usuarios_id,acao,form,arquivo,time";
		$valores = array($id_it,$cVLogin->getVarLogin("SYS_USER_ID"),$idTemp,$idIframe,$filename,$time_g);
		$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
				
		//$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/' . $filename; print "$url\n";
		echo "1";
	}else{//if(file_exists($filecaminho.$filename)){
		echo "0";
	}//if(file_exists($filecaminho.$filename)){

	//REMOVE CONEXAO
	//fecha todas as conexoes abertas
	$classe_db->FechaConexaoAll($SCRIPTOFF);//fecha conexoes
	exit(0);
}//if(isset($_GET["filename"])){













//excluir arquivos inativos ou nao utilizados na tabela temp
if (!isset($_FILES['file'])){
//verifica se existem arquivos inutilizados no sistema
	$campos = "id,arquivo";
	$tabela = "sys_snapshot_temp";
	$where = "time <= '".time()."'";
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resu1 = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "");
	while($linha = fSQL::FETCH_ASSOC($resu1)){
		$id_e = $linha["id"];
		$arquivo_e = $linha["arquivo"];
		
		//exclue o arquivo
		if($arquivo_e != ""){
			$arquivoD = VAR_DIR_FILES."files/temp/snapshot/".$arquivo_e;
			delete($arquivoD);
		}
		
		//exclue o registro
		$tabela = "sys_snapshot_temp";
		$condicao = "id = '$id_e'";
		$resu2 =  fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
	}//fim while fetch
}//fim if (!isset($_FILES['arquivo'])){





//verifica se já existe arquivo com id gerado	
	$foto_cont = "0";
	//verifica se existem arquivos inutilizados no sistema
	$campos = "id,arquivo";
	$tabela = "sys_snapshot_temp";
	$where = "acao = '$idTemp' AND usuarios_id = '".$cVLogin->getVarLogin("SYS_USER_ID")."'";
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resu1 = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "");
	while($linha = fSQL::FETCH_ASSOC($resu1)){
		$foto_id = $linha["id"];
		$foto_arquivo = $linha["arquivo"];
		$foto_cont++;
	}//fim while


//caminho dos JS
$cJS = "../";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">
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


</head>
<body>


<div id="altura_iframe">
<?php



	

// Quando a ação for para remover anexo
if(isset($_GET["removeA"])){
    // Recuperando nome do arquivo
    $arquivo = $_GET['removeA'];
	//verifica se existem arquivos inutilizados no sistema
	$campos = "id,arquivo";
	$tabela = "sys_snapshot_temp";
	$where = "id = '$arquivo' AND usuarios_id = '".$cVLogin->getVarLogin("SYS_USER_ID")."'";
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resu1 = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "");
	while($linha = fSQL::FETCH_ASSOC($resu1)){
		$id_e = $linha["id"];
		$arquivo_e = $linha["arquivo"];
		//exclue o arquivo
		if($arquivo_e != ""){
			$arquivoD = VAR_DIR_FILES."files/temp/snapshot/".$arquivo_e;
			delete($arquivoD);
		}
		//exclue o registro
		$tabela = "sys_snapshot_temp";
		$condicao = "id = '$id_e'";
		$resu2 =  fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
	}//fim while
    // Finaliza a requisição
?>
<script type="text/javascript">
$(document).ready(function(){
	window.open('snapshot_iframe.php?idTemp=<?=$idTemp?>&idIframe=<?=$idIframe?>&tmDISP=<?=$tmDISP?>&tmIMG=<?=$tmIMG?>&ini=1&titu=<?=$titu?>&funcao=<?=$funcao?>', '<?=$idIframe?>');
});
</script>
<?php

	//REMOVE CONEXAO
	//fecha todas as conexoes abertas
	$classe_db->FechaConexaoAll($SCRIPTOFF);//fecha conexoes
	exit(0);
}//if(isset($_GET["removeA"])){





//lista arquivo
if($foto_cont >= "1"){
	$caminho_file = VAR_DIR_FILES."files/temp/snapshot/".$foto_arquivo;

?>
<div style="width:<?=$AtmDISP["0"]?>px; height:<?=$AtmDISP["1"]+50?>px">
<img src="../img.php?<?=$cVLogin->imgFile($caminho_file, $AtmDISP["0"],$AtmDISP["1"])?>">
<div class="btn btn-danger btn-large" style="width:90%;" onclick="window.open('snapshot_iframe.php?idTemp=<?=$idTemp?>&idIframe=<?=$idIframe?>&tmDISP=<?=$tmDISP?>&tmIMG=<?=$tmIMG?>&ini=<?=$ini?>&titu=<?=$titu?>&funcao=<?=$funcao?>&removeA=<?=$foto_id?>', '<?=$idIframe?>');" rel="tooltip" title="Apagar imagem, novo foto!"><i class="icon-trash" style="font-size:25px;"></i> EXCLUIR FOTO</div>
</div>
<div style="clear:both;"></div>

<?php



}else{//if($foto_cont >= "1"){























//inicia camera
if($ini >= "1"){

?>
<div style="width:<?=$AtmDISP["0"]?>px;">
	<!-- First, include the JPEGCam JavaScript Library -->
	<script type="text/javascript" src="../js/plugins/jpegcam/webcam.js"></script>
	
	<!-- Configure a few settings -->
	<script language="JavaScript">
		webcam.set_api_url( 'snapshot_iframe.php?idTemp=<?=$idTemp?>&idIframe=<?=$idIframe?>&tmDISP=<?=$tmDISP?>&tmIMG=<?=$tmIMG?>&ini=<?=$ini?>&titu=<?=$titu?>&funcao=<?=$funcao?>&filename=files/temp/' );
		webcam.set_quality( 99 ); // JPEG quality (1 - 100)
	</script>
	
	<!-- Next, write the movie to the page at 320x240, but request the final image at 640x480 -->
	<script language="JavaScript">
		document.write( webcam.get_html(<?=$AtmDISP["0"]?>, <?=$AtmDISP["1"]?>, <?=$AtmIMG["0"]?>, <?=$AtmIMG["1"]?>) );
	</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="width:20px;"><div class="btn btn-inverse btn-large" style="width:20px;" onclick="webcam.configure();" rel="tooltip" title="Configurar"><i class="icon-cog" style="font-size:25px;"></i></div></td>
    <td><div class="btn btn-primary btn-large" style="width:89%;" onclick="take_snapshot();" rel="tooltip" title="Capturar imagem"><i class="icon-camera" style="font-size:25px;"></i> TIRAR FOTO</div></td>
    <td style="width:20px;"><div class="btn btn-warning btn-large" style="width:20px;" onclick="window.open('snapshot_iframe.php?idTemp=<?=$idTemp?>&idIframe=<?=$idIframe?>&tmDISP=<?=$tmDISP?>&tmIMG=<?=$tmIMG?>&ini=0&titu=<?=$titu?>&funcao=<?=$funcao?>', '<?=$idIframe?>');" rel="tooltip" title="Fechar WebCam"><i class="icon-remove" style="font-size:25px;"></i></div></td>
  </tr>
</table>
</div>	
	<!-- Code to handle the server response (see test.php) -->
	<script language="JavaScript">
		webcam.set_hook( 'onComplete', 'my_completion_handler' );
		
		function take_snapshot() {
			// take snapshot and upload to server
			//document.getElementById('upload_results').innerHTML = '<h1>Uploading...</h1>';
			webcam.snap();
		}
		
		function my_completion_handler(msg) {
	<?php 	if($funcao != ""){ ?>
			// Definindo página pai
			var pai = window.parent.<?=$funcao?>();
	<?php 	}//if($funcao != ""){ ?>
			window.open('snapshot_iframe.php?idTemp=<?=$idTemp?>&idIframe=<?=$idIframe?>&tmDISP=<?=$tmDISP?>&tmIMG=<?=$tmIMG?>&ini=<?=$ini?>&titu=<?=$titu?>&funcao=<?=$funcao?>', '<?=$idIframe?>');
			// reset camera for another shot
			//webcam.reset();
		}
	</script>
<?php


}else{//if($ini >= "1"){




?>
<div class="btn btn-primary btn-large" style="width:<?=$AtmDISP["0"]?>px;" onclick="window.open('snapshot_iframe.php?idTemp=<?=$idTemp?>&idIframe=<?=$idIframe?>&tmDISP=<?=$tmDISP?>&tmIMG=<?=$tmIMG?>&ini=1&titu=<?=$titu?>&funcao=<?=$funcao?>', '<?=$idIframe?>');" rel="tooltip" title="Iniciar WebCam"><i class="icon-camera" style="font-size:25px;"></i> INICIAR CÂMERA DE FOTO</div>
<?php


}//else{//if($ini >= "1"){


























}//else{//if($foto_cont >= "1"){



?>
</div>

<script type="text/javascript">
$(document).ready(function(){
	atualizaAlturaIframe();
});
function atualizaAlturaIframe(){
	parent.document.getElementById("<?=$idIframe?>").height = document.getElementById("altura_iframe").scrollHeight; //40: Margem Superior e Inferior, somadas
	//alert(document.getElementById("altura_iframe").scrollHeight);
}//atualizaAlturaIframe
</script>
</body>
</html>
<?php






//REMOVE CONEXAO
//fecha todas as conexoes abertas
$classe_db->FechaConexaoAll($SCRIPTOFF);//fecha conexoes
?>