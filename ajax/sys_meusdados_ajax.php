<?php //Breno Cruvinel - breno.cruvinel09@gmail.com
//valida pagina se aberto separadamente
include "valida_pagina_sem_quadro.php";


//INICIAR ARQUIVO DE LINGUAGEM --->>>
$class_fLNG->loadFile(__FILE__);//incluir o arquivo de linguagem
//INICIAR ARQUIVO DE LINGUAGEM ---<<<




//AJAX (açoes do file) ------------------------------------------------------------------>>>
if($ajax == "fileAcao"){
	$id_a =	$cVLogin->getVarLogin("SYS_USER_ID");

	
	//excluir file
	if(isset($_GET["del"])){
		$del = 	deleteSEG($_GET["del"]);
		$hide = $_GET["hide"];
		if(($id_a >= "1") and ($del != "")){
			delete(VAR_DIR_FILES."files/usuarios/".$id_a."/".$del);
			fBKP::bkpDelFile(VAR_DIR_FILES."files/usuarios/".$id_a."/".$del);//adiciona arquivo em lista de excluídos BACKUP
		}
		//GERA AÇÃO DO USUÁRIO NA TABELA
		$cVLogin->addAcaoUser("sys_usuarios", "excluirfoto", $id_a);//addAcaoUser($TABELA, $ACAO, $REGISTRO)
		echo '<script>$(document).ready(function(){ recarregaIframe(); $("#'.$hide.'").fadeOut(); });</script>';
	}//isset. del
	
	
	
//recebe novca foto
	$array_temp = 	getpost_sql($_GET["array_temp"]);
	$idIframe = 	getpost_sql($_GET["idIframe"]);
	$linha1 = fSQL::SQL_SELECT_ONE("file", "sys_usuarios", "id = '".$cVLogin->getVarLogin("SYS_USER_ID")."'");
	$file_aa = $linha1["file"];
	
	
	
	//cria a pasta de arquivos do usuario
	$file_c = VAR_DIR_FILES."files/usuarios/".$cVLogin->getVarLogin("SYS_USER_ID"); //caminho/nome da pasta
	$cria = cria_pasta($file_c, "0777"); //confere a criação e retona 1
	
//########################################### iFRAME TEMP ####################################>>>>>>>>>>>
	$msg_cont = "";	$cont_arquivo = "0";
	//verifica se existem arquivos temp no sistema
	$upload_dir_temp = VAR_DIR_FILES."files/temp/";
	$campos = "id,titulo,nome,arquivo";
	$tabela = "sys_arquivos_temp";
	$where = "acao = '$array_temp' AND form = 'fotoPerfil".$array_temp."' AND usuarios_id = '".$id_a."'";
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resu1 = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "");
	while($linha = fSQL::FETCH_ASSOC($resu1)){
		$id_e = $linha["id"];
		$titulo_e = $linha["titulo"];
		$nome_e = $linha["nome"];
		$arquivo_e = $linha["arquivo"];
		if(file_exists($upload_dir_temp.$arquivo_e)){
			$cont_arquivo++;//faz contagem de arquivos enviados
			//exclue arquivo atual
			if($file_aa != ""){
				delete($file_c."/fotoperfil.".fGERAL::mostraExtensao($file_aa));
				fBKP::bkpDelFile($file_c."/fotoperfil.".fGERAL::mostraExtensao($file_aa));//adiciona arquivo em lista de excluídos BACKUP
			}
			//preparando o envio do arquivo temp para o definitivo
			$upload_dir = $file_c."/";
			$arquivo_n = "fotoperfil.".fGERAL::mostraExtensao($arquivo_e); //monta nome do novo arquivo
			//move o arquivo para o novo local e exclue o temp
			rename($upload_dir_temp.$arquivo_e, $upload_dir.$arquivo_n);
			fBKP::bkpFile($upload_dir.$arquivo_n);//adiciona arquivo em lista de arquivo BACKUP

			//exclue o registro
			$tabela = "sys_arquivos_temp";
			$condicao = "id = '$id_e'";
			$resu2 =  fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);

			//atualiza dados da tabela no DB
			$campos = "file";
			$tabela = "sys_usuarios";
			$valores = array($nome_e);
			$condicao = "id='".$cVLogin->getVarLogin("SYS_USER_ID")."'";
			fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
			//GERA AÇÃO DO USUÁRIO NA TABELA
			$cVLogin->addAcaoUser("sys_usuarios", "alterarfoto", $cVLogin->getVarLogin("SYS_USER_ID"));//addAcaoUser($TABELA, $ACAO, $REGISTRO)
		}//fim if(file_exists($upload_dir_temp.$arquivo_e)){
	}//fim while
//########################################### iFRAME TEMP ####################################<<<<<<<<<<<
	echo '<script>$(document).ready(function(){ $("#btSalvarF'.$array_temp.'").fadeOut(); });</script>';
	

$file_a = $nome_e;
$caminho_file = VAR_DIR_FILES."files/usuarios/".$id_a."/fotoperfil.".fGERAL::mostraExtensao($file_a);
if(file_exists($caminho_file)){
	$file_del = "fotoperfil.".fGERAL::mostraExtensao($file_a);
?>        
<script>
$(document).ready(function(){
	$("#<?=$idIframe?>").hide();
	$(".sys_imgPerfil").attr('src', "img.php?<?=$cVLogin->imgFile($caminho_file, "200", "200")?>");
});
</script>
								<table class="table table-hover table-nomargin table-bordered" id="tb_files<?=$array_temp?>">
									<thead>
										<tr>
											<th><?=$class_fLNG->txt(__FILE__,__LINE__,'ICO')?></th>
											<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Dados/Arquivo')?></th>
											<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Ação')?></th>
										</tr>
									</thead>
									<tbody>
										<tr id="tr_<?=$id_a?>">
											<td>
											<a href="img.php?<?=$cVLogin->imgFile($caminho_file, "full")?>" rel="prettyPhoto[gallery<?=$cVLogin->getVarLogin("SYS_USER_ID")?>]" id="img_<?=$cVLogin->getVarLogin("SYS_USER_ID")?>"><?=$cVLogin->icoFile($caminho_file, "")?></a></td>
											<td><b><?=$file_a?></b><br><?=fGERAL::tmFile($caminho_file)?></td>
											<td>
												<a href="#" onclick="$('#img_<?=$id_a?>').click();return false;" class="btn" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Visualizar')?>"><i class="icon-search"></i></a>
												<a href="downloads.php?<?=$cVLogin->varsDownalod($caminho_file, $file_a)?>" class="btn" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Download')?>"><i class="icon-download-alt"></i></a>
												<a href="#" onClick="faisher_ajax('div_oculta', '0', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=fileAcao&hide=tb_files<?=$array_temp?>&del=<?=$file_del?>');$('#<?=$idIframe?>').fadeIn();return false;" class="btn" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Remover')?>"><i class="icon-remove"></i></a>
                                          </td>
										</tr>
									</tbody>
								</table>
<?php 
}else{//fim do file 
?>        
<script>
$(document).ready(function(){
	$(".sys_imgPerfil").attr('src', "img.php?<?=$cVLogin->imgFile("img/sem_foto.jpg", "200", "200")?>");
});
</script>
<?php
}//else{//fim do file 

	exit(0);
}//fim ajax -------------------<<<<










































//AJAX (açoes alterar senha) ------------------------------------------------------------------>>>
if($ajax == "senhaAcao"){
	$array_temp = getpost_sql($_POST["array_temp"]);
	$senha_a = getpost_sql($_POST["senha"]);
	$senha1_a = getpost_sql($_POST["senha1"]);
	$senha2_a = getpost_sql($_POST["senha2"]);
	$valida = "1";
	
	$linha1 = fSQL::SQL_SELECT_ONE("senha", "sys_login", "usuarios_id='".$cVLogin->getVarLogin("SYS_USER_ID")."'");
	$senha_aa = $linha1["senha"];
	$senha_a = fGERAL::cryptoSenhaDB($senha_a);
	if($senha_a != $senha_aa){
		echo '<script>$(document).ready(function(){  pmodalHtmlAlerta("'.$class_fLNG->txt(__FILE__,__LINE__,'<b>A senha atual informada está incorreta!</b><br>TENTE NOVAMENTE!').'"); $("#senha").val(""); $("#senha").focus(); });</script>';
		$valida = "0";
	}//if($senha_a != $senha_aa){
	
	if($valida == "1"){
		$senha1_a = fGERAL::cryptoSenhaDB($senha1_a);
		//atualiza dados da tabela no DB
		$campos = "senha,time_s";
		$tabela = "sys_login";
		$valores = array($senha1_a,time());
		$condicao = "usuarios_id='".$cVLogin->getVarLogin("SYS_USER_ID")."'";
		fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
		//GERA AÇÃO DO USUÁRIO NA TABELA
		$cVLogin->addAcaoUser("sys_usuarios", "alterarsenha", $cVLogin->getVarLogin("SYS_USER_ID"));//addAcaoUser($TABELA, $ACAO, $REGISTRO)
		echo '<script>$(document).ready(function(){ pmodalHtmlAlerta("'.$class_fLNG->txt(__FILE__,__LINE__,'Senha alterada com sucesso, <b>utilize a nova senha em seu próximo acesso!</b>').'","'.$class_fLNG->txt(__FILE__,__LINE__,'ALTERADA COM SUCESSO!').'"); $("#senha, #senha1, #senha2").val(""); $("#btSalvarS'.$array_temp.'").fadeOut(); });</script>';
	}//if($valida == "1"){

	exit(0);
}//fim ajax -------------------<<<<













































//AJAX (açoes dsconectar usuario sessao) ------------------------------------------------------------------>>>
if($ajax == "selDesconectar"){
	$desconectar = getpost_sql($_GET["desconectar"]);	
	//exclue o registro
	$tabela = "sys_login_session";
	$condicao = "id = '$desconectar' AND usuarios_id = '".$cVLogin->getVarLogin("SYS_USER_ID")."'";
	$resu2 =  fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
	//GERA AÇÃO DO USUÁRIO NA TABELA
	$cVLogin->addAcaoUser("sys_login_session", "desconectar", $cVLogin->getVarLogin("SYS_USER_ID"));//addAcaoUser($TABELA, $ACAO, $REGISTRO)

	exit(0);
}//fim ajax -------------------<<<<









































//AJAX (açoes remover computador de confiança) ------------------------------------------------------------------>>>
if($ajax == "selPcSeguro"){
	$pc = getpost_sql($_GET["pc"]);	
	//atualiza dados da tabela no DB
	$tabela = "sys_login_computador";
	$campos = "confianca";
	$valores = array("0");
	$condicao = "id='$pc' AND usuarios_id = '".$cVLogin->getVarLogin("SYS_USER_ID")."'";
	fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
	//GERA AÇÃO DO USUÁRIO NA TABELA
	$cVLogin->addAcaoUser("sys_login_computador", "desconectar", $cVLogin->getVarLogin("SYS_USER_ID"));//addAcaoUser($TABELA, $ACAO, $REGISTRO)

	exit(0);
}//fim ajax -------------------<<<<






























?>
<?php






//* ------------------------------------- ##### DADOS DO REGISTRO PADRAO #### --------------------------------------------*//


?>
<?php



















//AJAX QUE EXIBE REGISTRO ------------------------------------------------------------------>>>
if($ajax == "registro"){

    //id temp para registro de array
    $array_temp = time().rand(9,99999).$cVLogin->getVarLogin("SYS_USER_ID");
	$formCadastroPincipal = "formCadastroPincipal".$array_temp;
	


	$cont = "0";
	$campos = "U.id,U.file,U.nome,U.cpf,U.datan,U.sexo,U.fone,U.celular,U.user,U.time,U.user_a,U.sync,L.email,L.time_s,L.status";
	$resu1 = fSQL::SQL_SELECT_DUPLO($campos, "sys_usuarios U, sys_login L", "U.id = '".$cVLogin->getVarLogin("SYS_USER_ID")."' AND U.id = L.usuarios_id", "GROUP BY U.id");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$id_a = $linha1["id"];
		$file_a = $linha1["file"];
		$nome_a = $linha1["nome"];
		$cpf_a = formataCpfj($linha1["cpf"]);
		$datan_a = data_mysql($linha1["datan"]);
		$sexo_a = $linha1["sexo"];
		$fone_a = $linha1["fone"];
		$celular_a = $linha1["celular"];
		$email_a = $linha1["email"];
		$time_s_a = $linha1["time_s"];
		$status_a = $linha1["status"];
		$user_a = $linha1["user"];//quem realizou o cadastro
		$time_a = $linha1["time"]; //quando foi realizado o cadastro
		$user_a_a = $linha1["user_a"];//quel alterou o cadastro
		$sync_a = $linha1["sync"]; //quando foi alterado o cadastro
		$cont++;
	}//fim while
	//verifica se nao encontrou nada
	if($cont == "0"){
		//CRIACAO DE MENSAGEM
		$cMSG->addMSG("ERRO",$class_fLNG->txt(__FILE__,__LINE__,'Erro na localização dos dados, atualize sua janela!<br>Sua permissão foi negada!'));
		//MOSTRAR TODAS AS MENSAGENS CRIADAS -------------------------------- MENSAGENS ------------------------- ||||||||||||||
		$cMSG->imprimirMSG();//imprimir mensagens criadas
		exit(0);
	}//verifica se nao encontrou nada
	
	

?>
<script type="text/javascript">
$(document).ready(function(){
	
	$('#c_id<?=$INC_FAISHER["div"]?>').val('<?=$id_a?>');//alimenta id de abertura
	$('#div_displayTitulo<?=$INC_FAISHER["div"]?>').html("<?=$class_fLNG->txt(__FILE__,__LINE__,'MEUS DADOS - ADMINISTRADOR')?>");
	
	<?php if(isset($_GET["alterasenha"])){?>exibNotificacao("<?=$class_fLNG->txt(__FILE__,__LINE__,'ALERTA!')?>","<?=$class_fLNG->txt(__FILE__,__LINE__,'Informe os dados de senha abaixo para alterar!')?>");<?php }?>
});
<?php if(!isset($_GET["POP"])){ ?>$.doTimeout('vTimerCursor<?=$INC_FAISHER["div"]?>', 500, function(){ ancoraHtml('#ancAcao<?=$INC_FAISHER["div"]?>'); });//TIMER<?php }else{ $anterior="0";$proximo="0";}?>
</script>

<form id="<?=$formCadastroPincipal?>" name="<?=$formCadastroPincipal?>" action="#" method="POST" class='form-horizontal form-bordered form-validate' enctype='multipart/form-data' onsubmit="return false;">

             <input name="id_a" type="hidden" id="id_a" value="<?=$id_a?>" />
             <input name="array_temp" id="array_temp" type="hidden" value="<?=$array_temp?>" />  
             <div style="padding-top:1px;" id="formPrincipalMSG<?=$INC_FAISHER["div"]?>"></div>



                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosenvconvite".$array_temp;//id de controle
						$boxUI_titulo = $class_fLNG->txt(__FILE__,__LINE__,'Meus Dados Pessoais');// titulo
						$boxUI_status = "off";// 1 - aberto, 0 - fechado, off - desligado
						$boxUI_rodape = "- ".$boxUI_titulo;//texto rodape
						?>
							<div class="accordion accordion-widget" id="ac_<?=$boxUI_id?>">
								<div class="accordion-group" style="margin-bottom:0;">
									<div class="accordion-heading">
										<a class="accordion-toggle collapsed" <?php if($boxUI_status != "off"){?>data-toggle="collapse" data-parent="#ac_<?=$boxUI_id?>"<?php }?> href="#acc_<?=$boxUI_id?>" id="a_<?=$boxUI_id?>" onclick="return false;">
											<?=$boxUI_titulo?>
										</a>
									</div>
									<div id="acc_<?=$boxUI_id?>" class="accordion-body collapse <?php if(($boxUI_status == "1") or ($boxUI_status == "off")){?> in" style="height: auto;"<?php }else{ echo '" style="height:0px;"';}?>>
										<div class="accordion-inner" style="padding:0;">
                                        
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Foto perfil')?></label>
											<div class="controls">
                                            <?php
                                            //montar IFRAME
											$idTemp = $array_temp;//id do retorno
											$idIframe = "fotoPerfil".$array_temp;//id do iframe
											$arqTipo = "imagens";//tipos de arquivos
											$n_arqQtd = "1";//quantidade de arquivos maximo
											$desc = "0";//ativar descicao, 1 ligado, 0 desligado
											$funcao = "salavFoto";//ativar funcao java con retorno de QTD enviados
											?>
											  <iframe name="<?=$idIframe?>" style="border:0; overflow:hidden;" src="geral/upload_iframe.php?idTemp=<?=$idTemp?>&idIframe=<?=$idIframe?>&arq=<?=$arqTipo?>&n_arq=<?=$n_arqQtd?>&desc=<?=$desc?>&funcao=<?=$funcao?>" frameborder="0"  scrolling="no"  id="<?=$idIframe?>" width="100%" height="100%"> </iframe>
<script>                                
function salavFoto(v_retorno){
	if(v_retorno >= "1"){ $('#btSalvarF<?=$array_temp?>').fadeIn(); }else{ $('#btSalvarF<?=$array_temp?>').fadeOut(); }
}//salavFoto

function recarregaIframe(){
	$("#<?=$idIframe?>").attr('src', "geral/upload_iframe.php?idTemp=<?=$idTemp?>&idIframe=<?=$idIframe?>&arq=<?=$arqTipo?>&n_arq=<?=$n_arqQtd?>&desc=<?=$desc?>&funcao=<?=$funcao?>");
}//recarregaIframe
</script>
<div id="div_listaFoto">
<?php


$caminho_file = VAR_DIR_FILES."files/usuarios/".$id_a."/fotoperfil.".fGERAL::mostraExtensao($file_a);
if(file_exists($caminho_file)){
	$file_del = "fotoperfil.".fGERAL::mostraExtensao($file_a);
?>        
<script>$(document).ready(function(){ $("#<?=$idIframe?>").hide(); });</script>
								<table class="table table-hover table-nomargin table-bordered" id="tb_files<?=$array_temp?>">
									<thead>
										<tr>
											<th><?=$class_fLNG->txt(__FILE__,__LINE__,'ICO')?></th>
											<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Dados/Arquivo')?></th>
											<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Ação')?></th>
										</tr>
									</thead>
									<tbody>
										<tr id="tr_<?=$id_a?>">
											<td>
											<a href="img.php?<?=$cVLogin->imgFile($caminho_file, "full")?>" rel="prettyPhoto[gallery<?=$id_a?>]" id="img_<?=$id_a?>"><?=$cVLogin->icoFile($caminho_file, "")?></a></td>
											<td><b><?=$file_a?></b><br><?=fGERAL::tmFile($caminho_file)?></td>
											<td>
												<a href="#" onclick="$('#img_<?=$id_a?>').click();return false;" class="btn" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Visualizar')?>"><i class="icon-search"></i></a>
												<a href="downloads.php?<?=$cVLogin->varsDownalod($caminho_file, $file_a)?>" class="btn" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Download')?>"><i class="icon-download-alt"></i></a>
												<a href="#" onClick="faisher_ajax('div_oculta', '0', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=fileAcao&hide=tb_files<?=$array_temp?>&del=<?=$file_del?>');$('#<?=$idIframe?>').fadeIn();return false;" class="btn" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Remover')?>"><i class="icon-remove"></i></a>
                                          </td>
										</tr>
									</tbody>
								</table>
<?php 
}//fim do file 

?>
</div>

											<button type="submit" class="btn btn-large btn-primary" style="display:none; margin-bottom:50px;" id="btSalvarF<?=$array_temp?>" onclick="faisher_ajax('div_listaFoto', 'btSalvarFLoad<?=$array_temp?>', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=fileAcao&array_temp=<?=$array_temp?>&idIframe=<?=$idIframe?>');"><?=$class_fLNG->txt(__FILE__,__LINE__,'Salvar nova foto')?> <img src="img/ajax-qloader-preto-p.gif" width="18" height="18" style="display:none;" id="btSalvarFLoad<?=$array_temp?>" /></button>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Nome')?></label>
											<div class="controls display-plus">
											  <?=$nome_a?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Celular interativo')?></label>
											<div class="controls display-plus">
											  <?=$celular_a?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'CPF')?></label>
											<div class="controls display">
											  <?=$cpf_a?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Data de nascimento')?></label>
											<div class="controls display">
											  <?=$datan_a?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Telefone fixo')?></label>
											<div class="controls display">
											  <?=$fone_a?>
											</div>
										</div>
                                        
										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Expandir/ocultar')?> <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->


            
            

                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosacesso".$array_temp;//id de controle
						$boxUI_titulo = $class_fLNG->txt(__FILE__,__LINE__,'Dados de Acesso ao Sistema (alterar senha de acesso)');// titulo
						$boxUI_status = "0";// 1 - aberto, 0 - fechado, off - desligado
						if(isset($_GET["alterasenha"])){ $boxUI_status = "1"; }
						$boxUI_rodape = "- ".$boxUI_titulo;//texto rodape
						?>
  <div class="accordion accordion-widget" id="ac_<?=$boxUI_id?>">
								<div class="accordion-group" style="margin-bottom:0;">
									<div class="accordion-heading">
										<a class="accordion-toggle collapsed" <?php if($boxUI_status != "off"){?>data-toggle="collapse" data-parent="#ac_<?=$boxUI_id?>"<?php }?> href="#acc_<?=$boxUI_id?>" id="a_<?=$boxUI_id?>" onclick="return false;">
											<?=$boxUI_titulo?>
										</a>
									</div>
									<div id="acc_<?=$boxUI_id?>" class="accordion-body collapse <?php if(($boxUI_status == "1") or ($boxUI_status == "off")){?> in" style="height: auto;"<?php }else{ echo '" style="height:0px;"';}?>>
										<div class="accordion-inner" style="padding:0;">
                                        

										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Email')?></label>
											<div class="controls display">
											  <?=$email_a?>
											</div>
										</div>
                                        
										<div class="control-group">
											<label class="control-label"><b><?=$class_fLNG->txt(__FILE__,__LINE__,'Senha atual')?></b></label>
											<div class="controls">
											  <input type="password" name="senha" id="senha" value="" class="input-xlarge span3">
											</div>
										</div>  
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Nova senha')?></label>
											<div class="controls">
											  <input type="password" name="senha1" id="senha1" value="" class="input-xlarge span3">
											</div>
										</div>    
										<div class="control-group">
											<label class="control-label">&nbsp;</label>
											<div class="controls">
<div id="senha1_forca" class="span3"><span class="badge"><?=$class_fLNG->txt(__FILE__,__LINE__,'informe uma senha difícil')?></span></div>
<input id="senha1_forca_val" name="senha1_forca_val" type="hidden" value="0" />
<style> #senha1_forca span{ width:95%; text-align:center; padding:5px; } </style>
<script type='text/javascript'>//<![CDATA[
$(document).ready(function(){
	$('#senha1').keyup(function(e) {
		 var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
		 var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|(?=.*[&._-`´^~,:;#@!])|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
		 var enoughRegex = new RegExp("(?=.{6,}).*", "g");
		 if ($(this).val().length == 0) {
				 $('#senha1_forca_val').val('0');
				 $('#senha1_forca').html('<span class="badge"><?=$class_fLNG->txt(__FILE__,__LINE__,'informe uma senha difícil')?></span>');
		 }else if(false == enoughRegex.test($(this).val())){
				 $('#senha1_forca_val').val('0');
				 $('#senha1_forca').html('<span class="badge badge-inverse"><?=$class_fLNG->txt(__FILE__,__LINE__,'Precisamos de uma senha maior!')?></span>');
		 }else if(strongRegex.test($(this).val())){
				 $('#senha1_forca_val').val('1');
				 $('#senha1_forca').html('<span class="badge badge-success"><i class="icon-trophy"></i><br><?=$class_fLNG->txt(__FILE__,__LINE__,'Jóia! Muito boa a sua senha')?> :)</span>');
		 }else if(mediumRegex.test($(this).val())){
				 $('#senha1_forca_val').val('1');
				 $('#senha1_forca').html('<span class="badge badge-info"><?=$class_fLNG->txt(__FILE__,__LINE__,'Melhorou, senha já é aceita!<br>Mas, pode melhorar mais se quiser')?> :)</span>');
		 }else{
				 $('#senha1_forca_val').val('0');
				 $('#senha1_forca').html('<span class="badge badge-important"><?=$class_fLNG->txt(__FILE__,__LINE__,'SENHA MUITO SIMPLES<br>Precisamos de uma senha mais forte!!!icon!! Utilize letras e números ou símbolos,<br>uma boa senha protege seu nome digital',array('icon'=>'<br><br><i class="icon-question-sign"></i>'))?> :)</span>');
		 }
		 return true;
	});
});//]]> 
</script>
											</div>
										</div>                                        
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Repetir senha')?></label>
											<div class="controls">
											  <input type="password" name="senha2" id="senha2" value="" class="input-xlarge span3">
											</div>
										</div>
  <div class="form-actions">
											<button type="submit" class="btn btn-large btn-primary" style="display:none; margin-bottom:50px;" id="btSalvarS<?=$array_temp?>" onclick="alterarSenhaAcesso();"><?=$class_fLNG->txt(__FILE__,__LINE__,'Alterar senha de acesso')?> <img src="img/ajax-qloader-preto-p.gif" width="18" height="18" style="display:none;" id="btSalvarSLoad<?=$array_temp?>" /></button>
										</div>

<script>
$('#senha').change(function(){
	if($(this).val() != ""){
		$('#btSalvarS<?=$array_temp?>').fadeIn();
	}else{
		$('#btSalvarS<?=$array_temp?>').hide();
	}
});

function alterarSenhaAcesso(){
	var valida = "1";
	if($("#senha1").val() == "" && valida == "1"){ pmodalHtmlAlerta("<?=$class_fLNG->txt(__FILE__,__LINE__,'Informe nova senha corretamente!')?>"); valida = "0"; }
	if($("#senha1").val().length < "6" && valida == "1"){ pmodalHtmlAlerta("<?=$class_fLNG->txt(__FILE__,__LINE__,'No mínimo 6 caracteres na senha!')?>"); valida = "0"; }
	if($("#senha1").val() != $("#senha2").val() && valida == "1"){ pmodalHtmlAlerta("<?=$class_fLNG->txt(__FILE__,__LINE__,'Repita a nova senha corretamente!')?>"); valida = "0"; }
	if($('#senha1_forca_val').val() != "1" && valida == "1"){ pmodalHtmlAlerta("<?=$class_fLNG->txt(__FILE__,__LINE__,'<b>Precisamos que verifique a senha informada!</b><br>Informe uma senha mais forte, com letras e números ou símbolos')?> :)"); valida = "0"; }
	
	
	if(valida == "1"){
		faisher_ajax('div_oculta', 'btSalvarSLoad<?=$array_temp?>', '<?=$AJAX_PAG?>?faisher=<?=$faisher?>&ajax=senhaAcao', 'array_temp=<?=$array_temp?>&senha='+$("#senha").val()+'&senha1='+$("#senha1").val()+'&senha2='+$("#senha2").val(),'post');
	}
}
</script>
                                        
                                        
									  </div><!-- End .accordion-inner -->
									</div>
	</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Expandir/ocultar')?> <?=$boxUI_rodape?></a><?php }?>
  </div><!-- End .accordion-widget ----------------------------------------------- -->
  
    



                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadossess".$array_temp;//id de controle
						$boxUI_titulo = $class_fLNG->txt(__FILE__,__LINE__,'Usuário Online - Sessões de Acesso');// titulo
						$boxUI_status = "1";// 1 - aberto, 0 - fechado, off - desligado
						$boxUI_rodape = "- ".$boxUI_titulo;//texto rodape
						$cont_exib = "0";//contador para exibicao dos dados
						?>
							<div class="accordion accordion-widget" id="ac_<?=$boxUI_id?>">
								<div class="accordion-group" style="margin-bottom:0;">
									<div class="accordion-heading">
										<a class="accordion-toggle collapsed" <?php if($boxUI_status != "off"){?>data-toggle="collapse" data-parent="#ac_<?=$boxUI_id?>"<?php }?> href="#acc_<?=$boxUI_id?>" id="a_<?=$boxUI_id?>" onclick="return false;">
											<?=$boxUI_titulo?>
										</a>
									</div>
									<div id="acc_<?=$boxUI_id?>" class="accordion-body collapse <?php if(($boxUI_status == "1") or ($boxUI_status == "off")){?> in" style="height: auto;"<?php }else{ echo '" style="height:0px;"';}?>>
										<div class="accordion-inner" style="padding:0;">
                                        

	<table class="table table-hover table-bordered">
		<thead>
			<tr>
				<th><?=$class_fLNG->txt(__FILE__,__LINE__,'SESSÃO/IP')?></th>
				<th><?=$class_fLNG->txt(__FILE__,__LINE__,'TEMPO ONLINE')?></th>
				<th><?=$class_fLNG->txt(__FILE__,__LINE__,'ULTIMA ATIVIDADE')?></th>
				<th><?=$class_fLNG->txt(__FILE__,__LINE__,'ATIVIDADE')?></th>
				<th><?=$class_fLNG->txt(__FILE__,__LINE__,'DESCONECTAR')?></th>
			</tr>
		</thead>
        <tbody>
<?php
	$resu1 = fSQL::SQL_SELECT_SIMPLES("id,time_i,time,ip,origem,faisher", "sys_login_session", "usuarios_id = '".$id_a."'", "ORDER BY time ASC", "100");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$id_i = $linha1["id"];
		$time_i_i = $linha1["time_i"];
		$time_i = $linha1["time"];
		$ip_i = $linha1["ip"];
		$origem_i = $linha1["origem"];
		$faisher_i = $linha1["faisher"];
		
		$cont_exib++; $d["content"] = $class_fLNG->txt(__FILE__,__LINE__,'SESSÃO ATIVA')."[,]".date('d/m/Y H:i',$time_i_i).", Acesso: ".$origem_i; $d["type"] = "text"; $PRINT_ARRAY[] = $d;
?>
            <tr id="trSess<?=$id_i?>">
                <td><?=$origem_i?><BR><?=$ip_i?></td>
                <td><?=difHoraTime($time_i_i)?></td>
                <td><?=difHoraTime($time_i)?></td>
                <td><?=legFaisher($faisher_i)?></td>
                <td><a href="#" onclick="faisher_ajax('div_oculta', '0', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=selDesconectar&array_temp=<?=$array_temp?>&desconectar=<?=$id_i?>');$('#trSess<?=$id_i?>').fadeOut();return false;" class="btn btn-warning" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Desconectar sessão de usuário')?>"><i class="icon-off"></i></a></td>
            </tr>
<?php
	}//fim while
?>
        </tbody>
	</table>

										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Expandir/ocultar')?> <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->

                            


  
    



                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadospcacss".$array_temp;//id de controle
						$boxUI_titulo = $class_fLNG->txt(__FILE__,__LINE__,'Computador de Acesso do Usuário - Utilizado Para Acesso');// titulo
						$boxUI_status = "1";// 1 - aberto, 0 - fechado, off - desligado
						$boxUI_rodape = "- ".$boxUI_titulo;//texto rodape
						$cont_exib = "0";//contador para exibicao dos dados
						?>
							<div class="accordion accordion-widget" id="ac_<?=$boxUI_id?>">
								<div class="accordion-group" style="margin-bottom:0;">
									<div class="accordion-heading">
										<a class="accordion-toggle collapsed" <?php if($boxUI_status != "off"){?>data-toggle="collapse" data-parent="#ac_<?=$boxUI_id?>"<?php }?> href="#acc_<?=$boxUI_id?>" id="a_<?=$boxUI_id?>" onclick="return false;">
											<?=$boxUI_titulo?>
										</a>
									</div>
									<div id="acc_<?=$boxUI_id?>" class="accordion-body collapse <?php if(($boxUI_status == "1") or ($boxUI_status == "off")){?> in" style="height: auto;"<?php }else{ echo '" style="height:0px;"';}?>>
										<div class="accordion-inner" style="padding:0;">


	<table class="table table-hover table-bordered">
		<thead>
			<tr>
				<th><?=$class_fLNG->txt(__FILE__,__LINE__,'COMPUTADOR')?></th>
				<th><?=$class_fLNG->txt(__FILE__,__LINE__,'PRIMEIRO ACESSO')?></th>
				<th><?=$class_fLNG->txt(__FILE__,__LINE__,'ÚLTIMO ACESSO')?></th>
				<th><?=$class_fLNG->txt(__FILE__,__LINE__,'GEOLOCALIZAÇÃO')?></th>
				<th><?=$class_fLNG->txt(__FILE__,__LINE__,'CONFIANÇA')?></th>
			</tr>
		</thead>
        <tbody>
<?php
	$time_delay = time()-5259600;
	$resu1 = fSQL::SQL_SELECT_SIMPLES("id,chave,confianca,time_i,time,agent,ip,geo", "sys_login_computador", "usuarios_id = '".$id_a."' AND time >= '".$time_delay."'", "ORDER BY time DESC","50");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$id_i = $linha1["id"];
		$chave_i = $linha1["chave"];
		$confianca_i = $linha1["confianca"];
		$time_i_i = $linha1["time_i"];
		$time_i = $linha1["time"];
		$agent_i = $linha1["agent"];
		$ip_i = $linha1["ip"];
		$geo_i = $linha1["geo"];
		
		if($geo_i != ""){
			$arrGeo = explode(",",$geo_i);
		}//if($geo_i != ""){
			
			
		
		$cont_exib++; $d["content"] = $class_fLNG->txt(__FILE__,__LINE__,'PC')."[,]".date('d/m/Y H:i',$time_i_i).", ".$class_fLNG->txt(__FILE__,__LINE__,'Acesso IP').": ".$ip_i; $d["type"] = "text"; $PRINT_ARRAY[] = $d;
?>
            <tr id="trPCa<?=$id_i?>">
                <td><?=$class_fLNG->txt(__FILE__,__LINE__,'OS:')?> <?=sistemaOperacional($agent_i)?><br><?=$class_fLNG->txt(__FILE__,__LINE__,'Navegador')?>: <?=ver_navegador($agent_i)?></td>
                <td><?=difHoraTime($time_i_i)?></td>
                <td><?=difHoraTime($time_i)?></td>
                <td><?php if($geo_i != ""){?><a href="#" onclick="verGeoMapaPopup('<?=$arrGeo["0"]?>','<?=$arrGeo["1"]?>');return false;" class="btn" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Ver mapa do local')?>"><i class="icon-map-marker"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Ver')?></a><?php }else{ echo "&nbsp;"; }?></td>
                <td><?php if($confianca_i >= "1"){?><a href="#" onclick="return false;" class="btn btn-success pcSeg<?=$id_i?>" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Computador definido como de confiança, usando token de acesso')?>"><i class="icon-lock"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'CONFIANÇA')?></a><a href="#" onclick="faisher_ajax('div_oculta', '0', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=selPcSeguro&array_temp=<?=$array_temp?>&pc=<?=$id_i?>');$('.pcSeg<?=$id_i?>').fadeOut();return false;" class="btn pcSeg<?=$id_i?>" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Remover COMPUTADOR de CONFIANÇA')?>"><i class="icon-off"></i></a><?php }?>&nbsp;</td>
            </tr>
<?php
	}//fim while
?>
        </tbody>
	</table>

										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Expandir/ocultar')?> <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->

                            



									</form>
<?php














}//fim ajax  -------------------------------------------- <<<




?>
<?php











































//++++++++++++++++++++++AJAX QUE EXIBE [[HOME]] ----------------------------########################################-------------------------------------->>>
if($ajax == "home"){
	$AJAX_GET = "ajax=lista&";
	$TITULO_PAG = $class_fLNG->txt(__FILE__,__LINE__,'Meus Dados');//titulo da pagina
?>
<script>
//TIMER
$.doTimeout('vTimerOnLoad', 0, function(){
	classMenuTop('<?=$INC_FAISHER["menu"]?>');//seleciona o menu ativo
	$('#titulo_principal').html($('#html_titulo-<?=$INC_FAISHER["aba"]?>').html());//titulo principal
	$('#sys_mapa').html($('#html_mapa-<?=$INC_FAISHER["aba"]?>').html());//mapa principal
	
	janelaAcao<?=$INC_FAISHER["div"]?>('registro','id_a=0<?php if(isset($_GET["alterasenha"])){ echo '&alterasenha=1'; }?>');//carrega tela
});//TIMER
</script>
<div style="display:none;" id="html_titulo-<?=$INC_FAISHER["aba"]?>"><?=$TITULO_PAG?></div>
<div style="display:none;" id="html_mapa-<?=$INC_FAISHER["aba"]?>"><?=$INC_FAISHER["mapa"]?></div>


                


<?php /* ---------------------- ########## LISTA DE ACAO ########## ---------------------------------*/ ?>
<script type="text/javascript">          
function displayAcao<?=$INC_FAISHER["div"]?>(v_acao){
	if(v_acao == "abre" || v_acao == "abreHtml"){
		$('#dCentro_acao<?=$INC_FAISHER["div"]?>, .esconder-sendload').show();
		if(v_acao == "abre"){ $('#divAjax_acao<?=$INC_FAISHER["div"]?>').html(''); }
		$('#dCentro_lista<?=$INC_FAISHER["div"]?>').hide();
	}else{
		$('#dCentro_acao<?=$INC_FAISHER["div"]?>').hide();
		if(v_acao == "fecha"){ $('#divAjax_acao<?=$INC_FAISHER["div"]?>').html(''); }
		$('#dCentro_lista<?=$INC_FAISHER["div"]?>').fadeIn();
		ancoraHtml('#ancLista<?=$INC_FAISHER["div"]?>');//ancora
	}
}//displayVisualiza  

function janelaAcao<?=$INC_FAISHER["div"]?>(v_acao,v_get){
	$('.icoOff').hide();
	if(v_acao == "<?=$class_fLNG->txt(__FILE__,__LINE__,'Visualizar')?>"){ $('#icoVisualiza, #bt_visual').show(); }
	if(v_acao == "registro"){ $('#icoRegistro, #bt_edit').show(); }
	displayAcao<?=$INC_FAISHER["div"]?>('abre');
	loaderFoco('dAjax_acao','dAjax_acao_load',' <?=$class_fLNG->txt(__FILE__,__LINE__,'já estamos abrindo o registro...')?>');//cria um loader dinamico
	faisher_ajax('divAjax_acao<?=$INC_FAISHER["div"]?>', 'dAjax_acao_load', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax='+v_acao+'&'+v_get);
}//visualizaRegistro
</script>
        <a name="ancAcao<?=$INC_FAISHER["div"]?>" id="ancAcao<?=$INC_FAISHER["div"]?>"></a>
				<div class="row-fluid" style="display:none;" id="dCentro_acao<?=$INC_FAISHER["div"]?>">
					<div class="span12">

						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="icon-eye-open icoOff" id="icoVisualiza"></i>
									<i class="icon-edit icoOff" id="icoRegistro"></i>
									<i class="icon-exclamation-sign icoOff" id="icoOutro"></i>
									<span id="div_displayTitulo<?=$INC_FAISHER["div"]?>"><?=$class_fLNG->txt(__FILE__,__LINE__,'REGISTRO')?></span>
								</h3>
					  			<input id="c_id<?=$INC_FAISHER["div"]?>" name="c_id<?=$INC_FAISHER["div"]?>" type="hidden" value="0" />
									<div class="actions">
									</div>
							</div>
							<div class="box-content nopadding">

                            
                            <div style="width:100%; min-height:300px;" id="dAjax_acao">
                                <div id="divAjax_acao<?=$INC_FAISHER["div"]?>">
                                    <!-- conteudo --> 
                                </div>
                            </div>
                          <!-- End #dAjax_acao -->

							</div>
						</div>
                        
					</div>
				</div><!-- end .row-fluid -->
                
                
                
<?php




}//fim ajax  -------------------------------------------- <<<


















?>