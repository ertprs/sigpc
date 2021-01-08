<?php // Breno Cruvinel - breno.cruvinel09@gmail.com
include "valida_pagina_sem_quadro.php";//inicia sessao php

if(!isset($INC_HEAD_SRC)){ $INC_HEAD_SRC = ""; }//CAMINHO BASE DOS ARQUIVOS
if(!isset($INC_FUNCTION_INDEX)){ $INC_FUNCTION_INDEX = "OFF"; }//FUNÇÃO PG INDEX

?>
	<meta http-equiv="Content-Language" content="pt-br">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	<title><?=SYS_TITUADMIN?></title>
	<!-- Bootstrap -->
	<link rel="stylesheet" href="<?=$INC_HEAD_SRC?>css/bootstrap.min.css">
	<!-- Bootstrap responsive -->
	<link rel="stylesheet" href="<?=$INC_HEAD_SRC?>css/bootstrap-responsive.min.css">
	<!-- jQuery UI -->
	<link rel="stylesheet" href="<?=$INC_HEAD_SRC?>css/plugins/jquery-ui/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="<?=$INC_HEAD_SRC?>css/plugins/jquery-ui/smoothness/jquery.ui.theme.css">
	<!-- PageGuide -->
	<link rel="stylesheet" href="<?=$INC_HEAD_SRC?>css/plugins/pageguide/pageguide.css">
	<!-- Fullcalendar -->
	<link rel="stylesheet" href="<?=$INC_HEAD_SRC?>css/plugins/fullcalendar/fullcalendar.css">
	<link rel="stylesheet" href="<?=$INC_HEAD_SRC?>css/plugins/fullcalendar/fullcalendar.print.css" media="print">
	<!-- colorpicker -->
	<link rel="stylesheet" href="<?=$INC_HEAD_SRC?>css/plugins/colorpicker/colorpicker.css">
	<!-- chosen -->
	<link rel="stylesheet" href="<?=$INC_HEAD_SRC?>css/plugins/chosen/chosen.css">
	<!-- select2 -->
	<link rel="stylesheet" href="<?=$INC_HEAD_SRC?>css/plugins/select2/select2.css">
	<!-- icheck -->
	<link rel="stylesheet" href="<?=$INC_HEAD_SRC?>css/plugins/icheck/all.css">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="<?=$INC_HEAD_SRC?>css/style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" href="<?=$INC_HEAD_SRC?>css/themes.css">
	<!-- Notify -->
	<link rel="stylesheet" href="<?=$INC_HEAD_SRC?>css/plugins/gritter/jquery.gritter.css">
	<!-- Easy pie  -->
	<link rel="stylesheet" href="<?=$INC_HEAD_SRC?>css/plugins/easy-pie-chart/jquery.easy-pie-chart.css">
	<!-- Extra icons -->
	<link rel="stylesheet" href="<?=$INC_HEAD_SRC?>css/line-awesome/css/line-awesome.min.css">
    
	<!-- jQuery -->
	<script src="<?=$INC_HEAD_SRC?>js/jquery.min.js"></script>
	
	<!-- Nice Scroll -->
	<script src="<?=$INC_HEAD_SRC?>js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
	<!-- jQuery UI -->
	<script src="<?=$INC_HEAD_SRC?>js/plugins/jquery-ui/jquery.ui.core.min.js"></script>
	<script src="<?=$INC_HEAD_SRC?>js/plugins/jquery-ui/jquery.ui.widget.min.js"></script>
	<script src="<?=$INC_HEAD_SRC?>js/plugins/jquery-ui/jquery.ui.mouse.min.js"></script>
	<script src="<?=$INC_HEAD_SRC?>js/plugins/jquery-ui/jquery.ui.draggable.min.js"></script>
	<script src="<?=$INC_HEAD_SRC?>js/plugins/jquery-ui/jquery.ui.resizable.min.js"></script>
	<script src="<?=$INC_HEAD_SRC?>js/plugins/jquery-ui/jquery.ui.sortable.min.js"></script>
	<script src="<?=$INC_HEAD_SRC?>js/plugins/jquery-ui/jquery.ui.spinner.js"></script>
	<!-- Touch enable for jquery UI -->
	<script src="<?=$INC_HEAD_SRC?>js/plugins/touch-punch/jquery.touch-punch.min.js"></script>
	<!-- slimScroll -->
	<script src="<?=$INC_HEAD_SRC?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<!-- Bootstrap -->
	<script src="<?=$INC_HEAD_SRC?>js/bootstrap.min.js"></script>
	<!-- vmap -->
	<script src="<?=$INC_HEAD_SRC?>js/plugins/vmap/jquery.vmap.min.js"></script>
	<script src="<?=$INC_HEAD_SRC?>js/plugins/vmap/jquery.vmap.world.js"></script>
	<script src="<?=$INC_HEAD_SRC?>js/plugins/vmap/jquery.vmap.sampledata.js"></script>
	<!-- Bootbox -->
	<script src="<?=$INC_HEAD_SRC?>js/plugins/bootbox/jquery.bootbox.js"></script>
	<!-- Bootbox -->
	<script src="<?=$INC_HEAD_SRC?>js/plugins/form/jquery.form.min.js"></script>
	<!-- Validation -->
	<script src="<?=$INC_HEAD_SRC?>js/plugins/validation/jquery.validate.min.js"></script>
	<script src="<?=$INC_HEAD_SRC?>js/plugins/validation/additional-methods.min.js"></script>
	<!-- Masked inputs -->
	<script src="<?=$INC_HEAD_SRC?>js/plugins/maskedinput/jquery.maskedinput.min.js"></script>
	<!-- TagsInput -->
	<script src="<?=$INC_HEAD_SRC?>js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
	<!-- Datepicker -->
	<script src="<?=$INC_HEAD_SRC?>js/plugins/datepicker/bootstrap-datepicker.js"></script>
	<!-- Daterangepicker -->
	<script src="<?=$INC_HEAD_SRC?>js/plugins/daterangepicker/daterangepicker.js"></script>
	<script src="<?=$INC_HEAD_SRC?>js/plugins/daterangepicker/moment.min.js"></script>
	<!-- Timepicker -->
	<script src="<?=$INC_HEAD_SRC?>js/plugins/timepicker/bootstrap-timepicker.min.js"></script>
	<!-- Colorpicker -->
	<script src="<?=$INC_HEAD_SRC?>js/plugins/colorpicker/bootstrap-colorpicker.js"></script>
	<!-- Chosen -->
	<script src="<?=$INC_HEAD_SRC?>js/plugins/chosen/chosen.jquery.min.js"></script>
	<!-- masonry -->
	<script src="<?=$INC_HEAD_SRC?>js/plugins/masonry/jquery.masonry.min.js"></script>
	<!-- MultiSelect -->
	<script src="<?=$INC_HEAD_SRC?>js/plugins/multiselect/jquery.multi-select.js"></script>
	<!-- CKEditor -->
	<script src="<?=$INC_HEAD_SRC?>js/plugins/ckeditor/ckeditor.js"></script>
	<!-- PLUpload -->
	<script src="<?=$INC_HEAD_SRC?>js/plugins/plupload/plupload.full.js"></script>
	<script src="<?=$INC_HEAD_SRC?>js/plugins/plupload/jquery.plupload.queue.js"></script>
	<!-- Custom file upload -->
	<script src="<?=$INC_HEAD_SRC?>js/plugins/fileupload/bootstrap-fileupload.min.js"></script>
	<script src="<?=$INC_HEAD_SRC?>js/plugins/mockjax/jquery.mockjax.js"></script>
	<!-- select2 -->
	<script src="<?=$INC_HEAD_SRC?>js/plugins/select2/select2.min.js"></script>
	<!-- icheck -->
	<script src="<?=$INC_HEAD_SRC?>js/plugins/icheck/jquery.icheck.min.js"></script>
	<!-- complexify -->
	<script src="<?=$INC_HEAD_SRC?>js/plugins/complexify/jquery.complexify-banlist.min.js"></script>
	<script src="<?=$INC_HEAD_SRC?>js/plugins/complexify/jquery.complexify.min.js"></script>
	<!-- Mockjax -->
	<script src="<?=$INC_HEAD_SRC?>js/plugins/mockjax/jquery.mockjax.js"></script>
	<!-- Easy pie -->
	<script src="<?=$INC_HEAD_SRC?>js/plugins/easy-pie-chart/jquery.easy-pie-chart.min.js"></script>
    
	<!-- imagesLoaded -->
	<script src="<?=$INC_HEAD_SRC?>js/plugins/imagesLoaded/jquery.imagesloaded.min.js"></script>
	<!-- PageGuide -->
	<script src="<?=$INC_HEAD_SRC?>js/plugins/pageguide/jquery.pageguide.js"></script>
	<!-- FullCalendar -->
	<script src="<?=$INC_HEAD_SRC?>js/plugins/fullcalendar/fullcalendar.min.js"></script>
	<!-- Chosen -->
	<script src="<?=$INC_HEAD_SRC?>js/plugins/chosen/chosen.jquery.min.js"></script>
	<!-- icheck -->
	<script src="<?=$INC_HEAD_SRC?>js/plugins/icheck/jquery.icheck.min.js"></script>
	<!-- Notify -->
	<script src="<?=$INC_HEAD_SRC?>js/plugins/gritter/jquery.gritter.min.js"></script>
	<script src="<?=$INC_HEAD_SRC?>js/js.cookie.js" type="text/javascript"></script> 
    <script src="<?=$INC_HEAD_SRC?>js/fas-fingerprint.js" type="text/javascript"></script> 
	<script>
		//funções de cookie
		function delCookieF(v_nome){
			Cookies.remove(v_nome+"<?=SYS_COOKIE_ID?>", { path: '/' });
			Cookies.remove(v_nome+"<?=SYS_COOKIE_ID?>", { path: '' });
		}	
		function setCookieF(v_nome, v_var){
			delCookieF(v_nome);
			Cookies.set(v_nome+"<?=SYS_COOKIE_ID?>", v_var, { path: '/', domain: '<?=fGERAL::kookiesUrl()?>' }); //removed!
		}
		function getCookieF(v_nome){
			var arr = Cookies.get();
			return arr[v_nome+"<?=SYS_COOKIE_ID?>"];
		}
	</script>
	<!-- Theme framework -->
	<script src="<?=$INC_HEAD_SRC?>js/eakroko.js"></script>
	<!-- Theme scripts -->
	<script src="<?=$INC_HEAD_SRC?>js/application.js"></script>
	<!-- Just for demonstration -->
	<script src="<?=$INC_HEAD_SRC?>js/demonstration.js"></script>
    <!-- faisher -->
    <script type="text/javascript" src="<?=$INC_HEAD_SRC?>js/ajax_jquery.js"></script>
    <script type="text/javascript" src="<?=$INC_HEAD_SRC?>js/jquery.ba-dotimeout.js"></script>
    <script type="text/javascript" src="<?=$INC_HEAD_SRC?>js/jquery.limit-1.2.source.js"></script>
	<script type="text/javascript" src="<?=$INC_HEAD_SRC?>js/plugins/shortcut.js"></script>
	<script language="javascript" type="text/javascript" src="<?=$INC_HEAD_SRC?>js/plugins/textarea-autogrow.js"></script> 
    <link rel="stylesheet" href="<?=$INC_HEAD_SRC?>js/plugins/prettyPhoto/prettyPhoto.css" type="text/css" media="screen" charset="utf-8" />
    <script src="<?=$INC_HEAD_SRC?>js/plugins/prettyPhoto/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?=$INC_HEAD_SRC?>js/plugins/jquery.highlight.js"></script>
	<script src="<?=$INC_HEAD_SRC?>js/plugins/jquery.price_format.min.js"></script>
	<script src="<?=$INC_HEAD_SRC?>js/plugins/jquery.filter_input.js"></script>
	<script src='<?=$INC_HEAD_SRC?>js/plugins/scrollreveal.min.js'></script>
	<script src="<?=$INC_HEAD_SRC?>js/funcao.base.js"></script>
	<?php if($INC_FUNCTION_INDEX == "ON"){?><script src="<?=$INC_HEAD_SRC?>js/funcao.index.js?123"></script><?php }?>
    <!--pulsate-->
	<script type="text/javascript" src="<?=$INC_HEAD_SRC?>js/plugins/jquery.pulsate.min.js"></script>
	<!-- the mousewheel plugin -->
	<script type="text/javascript" src="<?=$INC_HEAD_SRC?>js/plugins/jscrollpane/jquery.mousewheel.js"></script>
	<link type="text/css" href="<?=$INC_HEAD_SRC?>js/plugins/jscrollpane/jquery.jscrollpane.css" rel="stylesheet" media="all" />
	<script type="text/javascript" src="<?=$INC_HEAD_SRC?>js/plugins/jscrollpane/jquery.jscrollpane.min.js"></script>
    <!--picker-->
    <link href="<?=$INC_HEAD_SRC?>js/plugins/mobiscroll/css/mobiscroll.custom.min.css" rel="stylesheet" type="text/css" />
    <script src="<?=$INC_HEAD_SRC?>js/plugins/mobiscroll/js/mobiscroll.custom.min.js" type="text/javascript"></script>

    
    <!-- inicio graficos -->
    <script type="text/javascript" src="<?=$INC_HEAD_SRC?>js/plugins/highcharts/highcharts.js"></script>
    <script type="text/javascript" src="<?=$INC_HEAD_SRC?>js/plugins/highcharts/highcharts-more.js"></script>
    <script type="text/javascript" src="<?=$INC_HEAD_SRC?>js/plugins/highcharts/highcharts-3d.js"></script>    
    <script type="text/javascript" src="<?=$INC_HEAD_SRC?>js/plugins/highcharts/modules/networkgraph.js"></script>
    <script type="text/javascript" src="<?=$INC_HEAD_SRC?>js/plugins/highcharts/modules/exporting.src.js"></script>
    <script>
	$(function () {
	Highcharts.setOptions({
		lang: {
			months: ['<?=$class_fLNG->txt(__FILE__,__LINE__,'Janeiro')?>', '<?=$class_fLNG->txt(__FILE__,__LINE__,'Fevereiro')?>', '<?=$class_fLNG->txt(__FILE__,__LINE__,'Março')?>', '<?=$class_fLNG->txt(__FILE__,__LINE__,'Abril')?>', '<?=$class_fLNG->txt(__FILE__,__LINE__,'Maio')?>', '<?=$class_fLNG->txt(__FILE__,__LINE__,'Junho')?>', '<?=$class_fLNG->txt(__FILE__,__LINE__,'Julho')?>', '<?=$class_fLNG->txt(__FILE__,__LINE__,'Agosto')?>', '<?=$class_fLNG->txt(__FILE__,__LINE__,'Setembro')?>', '<?=$class_fLNG->txt(__FILE__,__LINE__,'Outubro')?>', '<?=$class_fLNG->txt(__FILE__,__LINE__,'Novembro')?>', '<?=$class_fLNG->txt(__FILE__,__LINE__,'Dezembro')?>'],
			shortMonths: ['<?=$class_fLNG->txt(__FILE__,__LINE__,'Jan')?>', '<?=$class_fLNG->txt(__FILE__,__LINE__,'Fev')?>', '<?=$class_fLNG->txt(__FILE__,__LINE__,'Mar')?>', '<?=$class_fLNG->txt(__FILE__,__LINE__,'Abr')?>', '<?=$class_fLNG->txt(__FILE__,__LINE__,'Mai')?>', '<?=$class_fLNG->txt(__FILE__,__LINE__,'Jun')?>', '<?=$class_fLNG->txt(__FILE__,__LINE__,'Jul')?>', '<?=$class_fLNG->txt(__FILE__,__LINE__,'Ago')?>', '<?=$class_fLNG->txt(__FILE__,__LINE__,'Set')?>', '<?=$class_fLNG->txt(__FILE__,__LINE__,'Out')?>', '<?=$class_fLNG->txt(__FILE__,__LINE__,'Nov')?>', '<?=$class_fLNG->txt(__FILE__,__LINE__,'Dez')?>'],
			weekdays: ['<?=$class_fLNG->txt(__FILE__,__LINE__,'Domingo')?>', '<?=$class_fLNG->txt(__FILE__,__LINE__,'Segunda')?>', '<?=$class_fLNG->txt(__FILE__,__LINE__,'Terça')?>', '<?=$class_fLNG->txt(__FILE__,__LINE__,'Quarta')?>', '<?=$class_fLNG->txt(__FILE__,__LINE__,'Quinta')?>', '<?=$class_fLNG->txt(__FILE__,__LINE__,'Sexta')?>', '<?=$class_fLNG->txt(__FILE__,__LINE__,'Sábado')?>'],
			loading: ['<?=$class_fLNG->txt(__FILE__,__LINE__,'Atualizando o gráfico, aguarde...')?>'],
			contextButtonTitle: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Exportar gráfico')?>',
			decimalPoint: ',',
			thousandsSep: '.',
			downloadJPEG: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Baixar imagem JPEG')?>',
			downloadPDF: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Baixar arquivo PDF')?>',
			downloadPNG: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Baixar imagem PNG')?>',
			downloadSVG: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Baixar vetor SVG')?>',
			viewFullscreen: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Ver tela cheia')?>',
			printChart: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Imprimir gráfico')?>',
			rangeSelectorFrom: '<?=$class_fLNG->txt(__FILE__,__LINE__,'De')?>',
			rangeSelectorTo: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Para')?>',
			rangeSelectorZoom: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Zoom')?>',
			resetZoom: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Limpar Zoom')?>',
			resetZoomTitle: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Voltar Zoom para nível 1:1')?>',
		}
	});
	});
	</script>
    <!-- fim graficos -->  
    <!-- cripto -->
    <script src="js/cripto/rijndael.js"></script>
    <script src="js/cripto/mcrypt.js"></script>
    <script src="js/cripto/base64-convert.js"></script>
	
	<!--[if lte IE 9]>
		<script src="<?=$INC_HEAD_SRC?>js/plugins/placeholder/jquery.placeholder.min.js"></script>
		<script>
			$(document).ready(function() {
				$('input, textarea').placeholder();
			});
		</script>
	<![endif]-->

	<!-- Favicon -->
	<link rel="shortcut icon" href="<?=$INC_HEAD_SRC?>img/favicon.png" />
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="<?=$INC_HEAD_SRC?>img/apple-touch-icon-precomposed.png" />