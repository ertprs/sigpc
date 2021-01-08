<?php // Breno Cruvinel - breno.cruvinel09@gmail.com

/*
<?php
//include de script jQuery de envio de forms
//VARIAVEIS DE CONTROLE GERAL DO INCLUDE
$AJAX_CONFIRMA_MARCADOR_INC = "registro".$INC_FAISHER["div"];//marcador de mensagem confirma
$AJAX_FORM_INC = "";//id do formulario de trabalho
$AJAX_METODO_INC = "post";//metodo de envio get, post
$AJAX_GET_INC = "";//vars GET de envio URL
$AJAX_DADOS_INC = "";//nome dos campos de retorno, {'campo='+$('#campo').val()+'&campo2='+$('#campo2').val()} (opcional)
$AJAX_IDFUNCAO_INC = "valida_";//nome da funcao de retorno [nome funcao]();
$AJAX_URL_INC = ""; //url de envio
$AJAX_LOAD_INC = ""; //define se esconde o conteudo com load - ADD
$AJAX_CARREGANDO_INC = "0"; //div de carregando
$AJAX_HIDE_INC = ".esconder-sendload";//esconder ao carregar
$AJAX_SHOW_INC = ".esconder-sendload";//mostrar ao carregar
$AJAX_PAG_DIV_INC = ""; //div de dados
$AJAX_COD_INC = ""; //if java validacao - valedaform = "0";
$AJAX_COD_SUCESS_INC = ""; //cod java on sucess
$AJAX_JAVASEND_INC = ""; //cod java on SEND, AO INICIAR ENVIO
include "sys/inc_sendForms.php";
?>
*/

//VARIAVEIS DE CONTROLE GERAL
if(!isset($AJAX_CONFIRMA_MARCADOR_INC)){ $AJAX_CONFIRMA_MARCADOR_INC = time().rand(1,999999); }
if(!isset($AJAX_FORM_INC)){ $AJAX_FORM_INC = time().rand(1,999999); }
if(!isset($AJAX_METODO_INC)){ $AJAX_METODO_INC = "post"; }
if(!isset($AJAX_GET_INC)){ $AJAX_GET_INC = ""; }
if(!isset($AJAX_DADOS_INC)){ $AJAX_DADOS_INC = ""; }
if(!isset($AJAX_IDFUNCAO_INC)){ $AJAX_IDFUNCAO_INC = "valida_".$AJAX_FORM_INC; }
if(!isset($AJAX_URL_INC)){ $AJAX_URL_INC = ""; }
if(!isset($AJAX_LOAD_INC)){ $AJAX_LOAD_INC = ""; }
if(!isset($AJAX_CARREGANDO_INC)){ $AJAX_CARREGANDO_INC = "0"; }
if(!isset($AJAX_HIDE_INC)){ $AJAX_HIDE_INC = "0"; }
if(!isset($AJAX_SHOW_INC)){ $AJAX_SHOW_INC = "0"; }
if(!isset($AJAX_PAG_DIV_INC)){ $AJAX_PAG_DIV_INC = ""; }
if(!isset($AJAX_COD_INC)){ $AJAX_COD_INC = ""; }
if(!isset($AJAX_COD_SUCESS_INC)){ $AJAX_COD_SUCESS_INC = ""; }
if(!isset($AJAX_ERRO_INC)){ $AJAX_ERRO_INC = "Erro ao carregar a pagina!"; }
if(!isset($AJAX_JAVASEND_INC)){ $AJAX_JAVASEND_INC = ""; }
//confirma
if(!isset($AJAX_SCROLL_INC)){ $AJAX_SCROLL_INC = ""; }//informe TOP para subir rolagem ao enviar - STOP para a funcionalizade
if(!isset($AJAX_CONFIRMA_CONTEUDO_INC)){ $AJAX_CONFIRMA_CONTEUDO_INC = ""; }//informe o HTML de mensagem do confirma
if(!isset($AJAX_CONFIRMA_BT_INC)){ $AJAX_CONFIRMA_BT_INC = ""; }//informe o texto do botão de confirma
if(!isset($AJAX_CONFIRMA_APPEND_INC)){ $AJAX_CONFIRMA_APPEND_INC = ""; }//mantem os dados junto com botao confirma


//verifica a div de load para subir a rolagem
if(($AJAX_CARREGANDO_INC != "0") and ($AJAX_SCROLL_INC == "")){
	$dload = str_replace(" ", "", $AJAX_CARREGANDO_INC);
	unset($d); $d = explode(",", $dload);
	if((isset($d["1"])) and ($d["1"] != "")){ $AJAX_SCROLL_INC = $d["1"]."msg"; }
}//if($AJAX_CARREGANDO_INC != "0"){
?>
<script>
<?php
//ação confirma
if($AJAX_CONFIRMA_CONTEUDO_INC != ""){
?>
if(getCookieF("aviso<?=$AJAX_CONFIRMA_MARCADOR_INC?>") == "2"){  }else{ setCookieF("aviso<?=$AJAX_CONFIRMA_MARCADOR_INC?>", "1"); }
function avisoOff<?=$AJAX_IDFUNCAO_INC?>(){ setCookieF("avisosForm", ",aviso<?=$AJAX_CONFIRMA_MARCADOR_INC?>"); setCookieF("aviso<?=$AJAX_CONFIRMA_MARCADOR_INC?>", "2"); }
<?php
}//if($AJAX_CONFIRMA_CONTEUDO_INC != ""){//ação confirma

?>
var frm<?=$AJAX_FORM_INC?> = "1";
function <?=$AJAX_IDFUNCAO_INC?>(v_confirma){	
	if(v_confirma != "" && v_confirma != null){}else{ v_confirma = ""; }
	if(frm<?=$AJAX_FORM_INC?> == "1"){
		var valedaform = "1";
		var valedaformConfirma = "1";
		<?=$AJAX_COD_INC?>
<?php
//ação confirma
if($AJAX_CONFIRMA_CONTEUDO_INC != ""){
?>
	if(valedaform == "1" && valedaformConfirma == "1" && v_confirma != "OFF" && getCookieF("aviso<?=$AJAX_CONFIRMA_MARCADOR_INC?>") == "1"){
		pmodalHtml('<i class="icon-warning-sign" style="color:#F90;"></i> AVISO IMPORTANTE!','<?=$AJAX_CONFIRMA_CONTEUDO_INC?>','html'<?php if($AJAX_CONFIRMA_APPEND_INC == "1"){ echo ",'append'"; }?>);
		$('#pModalRodape').html('<button class="btn btn-lightgrey btn-large" style="float:left;border-radius:25px;" onclick="avisoOff<?=$AJAX_IDFUNCAO_INC?>();<?=$AJAX_IDFUNCAO_INC?>Send(1);">Não Exibir Aviso Novamente</button> <button class="btn btn-success btn-large" onclick="<?=$AJAX_IDFUNCAO_INC?>Send(1);"><?=$AJAX_CONFIRMA_BT_INC?></button> <button class="btn btn-large" data-dismiss="modal">Voltar Edição</button>');
		valedaform = "0";
	}
<?php
}//if($AJAX_CONFIRMA_CONTEUDO_INC != ""){//ação confirma

?>
		if(valedaform == "1"){ <?=$AJAX_IDFUNCAO_INC?>Send("1"); }
	}//fim if frm
}//function ini
function <?=$AJAX_IDFUNCAO_INC?>Send(v_envia){
	<?php if(($AJAX_CONFIRMA_CONTEUDO_INC != "") and ($AJAX_CONFIRMA_APPEND_INC != "1")){?>pmodalDisplay('hide');<?php }?>
	if(v_envia == "1" && frm<?=$AJAX_FORM_INC?> == "1"){
		<?=$AJAX_JAVASEND_INC?>
		frm<?=$AJAX_FORM_INC?> = "0";
		<?php if($AJAX_SCROLL_INC == "TOP"){ ?>$('html,body').stop().animate({scrollTop:0},500);<?php } ?>
		<?php if(($AJAX_SCROLL_INC != "") and ($AJAX_SCROLL_INC != "TOP") and ($AJAX_SCROLL_INC != "STOP")){ ?>ancoraHtml('<?=$AJAX_SCROLL_INC?>','300');<?php } ?>
		$.ajax({
		   type: '<?=$AJAX_METODO_INC?>', //Tipo do envio das informações GET ou POST
		   url: '<?=$AJAX_URL_INC?>?<?=$AJAX_GET_INC?>&<?=rand(99,99999)?>', //url para onde será enviada as informações digitadas
		   data: <?php if($AJAX_DADOS_INC == ""){ ?>$("#<?=$AJAX_FORM_INC?>").serialize()<?php }else{ echo $AJAX_DADOS_INC; } ?>, 
		   cache: false,
		   async: true,		
		   beforeSend: function(){
			  //Ação que será executada após o envio, no caso, chamei um gif loading para dar a impressão de garregamento na página
			  <?php if($AJAX_CARREGANDO_INC != "0"){ //nao mostra o carregando ?>
				$("#<?=$AJAX_CARREGANDO_INC?>").show();
				<?php if($AJAX_LOAD_INC != "ADD"){ ?>$("#<?=$AJAX_PAG_DIV_INC?>").hide();<?php } ?>
			  <?php } //fim nao mostra carregando ?>
			   <?php if($AJAX_HIDE_INC != "0"){ //esconde ao carregar ?>$("<?=$AJAX_HIDE_INC?>").fadeOut();<?php } ?>
		   },
		   //function(data) vide item 4 em $.get $.post
		   success: function(data){
			   setTimeout(function(){ frm<?=$AJAX_FORM_INC?> = "1"; }, 1000);
			  //Tratamento dos dados de retorno.
			    <?php if($AJAX_SHOW_INC != "0"){ //esconde ao carregar ?>$("<?=$AJAX_SHOW_INC?>").show();<?php } ?>
				<?php if($AJAX_CARREGANDO_INC != "0"){ //nao mostra o carregando ?>$("#<?=$AJAX_CARREGANDO_INC?>").hide();<?php } //fim nao mostra carregando ?>
				$("#<?=$AJAX_PAG_DIV_INC?>").fadeIn();
				$("#<?=$AJAX_PAG_DIV_INC?>").empty().html(data);
				<?=$AJAX_COD_SUCESS_INC?>
		   },		
		   // Se acontecer algum erro é executada essa função
		   error: function(erro){
			   setTimeout(function(){ frm<?=$AJAX_FORM_INC?> = "1"; }, 1000);
			    <?php if($AJAX_SHOW_INC != "0"){ //esconde ao carregar ?>$("<?=$AJAX_SHOW_INC?>").show();<?php } ?>
				<?php if($AJAX_LOAD_INC == "ADD"){ ?>
				loaderFoco('<?=$AJAX_PAG_DIV_INC?>','<?=$AJAX_PAG_DIV_INC?>erroload','','0');//cria um loader dinamico
				$("#<?=$AJAX_PAG_DIV_INC?>erroload").html('<div style="line-height:normal; margin-top:10%;"><img src="img/fig_ajaxerro.png"><div style="font-size:16px; padding:20px;"><i class="icon-chevron-left"></i> ERRO DE CONEXÃO <i class="icon-chevron-right"></i></div><a href="#" class="btn btn-large btn-lightred" onclick="$(\'#<?=$AJAX_CARREGANDO_INC?>\').html(\'<img src=img/ajax-loader.gif>&nbsp;&nbsp;aguarde, enviando novamente...\');<?=$AJAX_IDFUNCAO_INC?>(\'OFF\');return false;"><i class="icon-refresh"></i> TENTAR NOVAMENTE</a></div>');
				$("#<?=$AJAX_PAG_DIV_INC?>erroload").fadeIn();
				<?php }else{ if($AJAX_CARREGANDO_INC != "0"){ //nao mostra o carregando ?>
				$("#<?=$AJAX_CARREGANDO_INC?>").html('<div style="line-height:normal; margin-top:10%;"><img src="img/fig_ajaxerro.png"><div style="font-size:16px; padding:20px;"><i class="icon-chevron-left"></i> ERRO DE CONEXÃO <i class="icon-chevron-right"></i></div><a href="#" class="btn btn-large btn-lightred" onclick="$(\'#<?=$AJAX_CARREGANDO_INC?>\').html(\'<img src=img/ajax-loader.gif>&nbsp;&nbsp;aguarde, enviando novamente...\');<?=$AJAX_IDFUNCAO_INC?>(\'OFF\');return false;"><i class="icon-refresh"></i> TENTAR NOVAMENTE</a></div>');	<?php } } ?>	
		   }
		});		
	}//valedaform
	return false;
}//function send
</script>
<?php
	




//destroe as variaveis criadas
unset($AJAX_CAMPOS_INC, $AJAX_METODO_INC, $AJAX_IDFUNCAO_INC, $AJAX_URL_INC, $AJAX_CARREGANDO_INC, $AJAX_DADOS_INC);
unset($AJAX_PAG_DIV_INC, $AJAX_ERRO_INC, $AJAX_GET_INC, $AJAX_COD_INC, $AJAX_LOAD_INC, $AJAX_COD_SUCESS_INC, $AJAX_HIDE_INC, $AJAX_SHOW_INC);
unset($AJAX_CONFIRMA_CONTEUDO_INC, $AJAX_CONFIRMA_BT_INC, $AJAX_SCROLL_INC);

?>