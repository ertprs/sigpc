<?php //Breno Cruvinel - breno.cruvinel09@gmail.com
//valida pagina se aberto separadamente
include "valida_pagina_sem_quadro.php";


//INICIAR ARQUIVO DE LINGUAGEM --->>>
$class_fLNG->loadFile(__FILE__);//incluir o arquivo de linguagem
//INICIAR ARQUIVO DE LINGUAGEM ---<<<

	

//DESTROE ARRAY DE CONTROLE DA PAGINA ++++++++++++++++++++++++++++++++++++++++++ | VERIFICAÇÃO DE PERMISSÕES | --
unset($pPER, $CONT);
	


//verificação de permisões exclusivas ------------------------------
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: ver módulo ::::::::::::::::::::::::::::::::::::::::::::::::::::::::
if($cVLogin->loginModuloPerfil("1")){//......................... 1. TI ...........................................................
	///VERIFICA PERMISSÕES DE ACESSO
	$idpermissao = "1_usr_usuarios";
	if($cVLogin->loginAcesso($idpermissao)){ $pPER["$idpermissao"] = "1"; }
	///VERIFICA PERMISSÕES DE ACESSO
	$idpermissao = "1_usr_permissao_grupos";
	if($cVLogin->loginAcesso($idpermissao)){ $pPER["$idpermissao"] = "1"; }
	///VERIFICA PERMISSÕES DE ACESSO
	$idpermissao = "1_usr_permissao_expediente";
	if($cVLogin->loginAcesso($idpermissao)){ $pPER["$idpermissao"] = "1"; }
	///VERIFICA PERMISSÕES DE ACESSO
	$idpermissao = "1_rel_usuariosonline";
	if($cVLogin->loginAcesso($idpermissao)){ $pPER["$idpermissao"] = "1"; }
}//if($cVLogin->loginModuloPerfil("1")){//......................... 1. TI ........................................................
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: ver módulo ::::::::::::::::::::::::::::::::::::::::::::::::::::::::


//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: ver módulo ::::::::::::::::::::::::::::::::::::::::::::::::::::::::
if($cVLogin->loginModuloPerfil("2")){//......................... 2. PADRÃO .......................................................
	///VERIFICA PERMISSÕES DE ACESSO
	$idpermissao = "2_adm_paineldogestor";
	if($cVLogin->loginAcesso($idpermissao)){ $pPER["$idpermissao"] = "1"; }
}//if($cVLogin->loginModuloPerfil("2")){//......................... 2. PADRÃO ....................................................
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: ver módulo ::::::::::::::::::::::::::::::::::::::::::::::::::::::::


//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: ver módulo ::::::::::::::::::::::::::::::::::::::::::::::::::::::::
if($cVLogin->loginModuloPerfil("3")){//..................... 3. BASE CADASTRAL  ................................................
	///VERIFICA PERMISSÕES DE ACESSO
	$idpermissao = "3_con_candidatofisico";
	if($cVLogin->loginAcesso($idpermissao)){ $pPER["$idpermissao"] = "1"; $CONT["$idpermissao"] = fSQL::SQL_CONTAGEM("cad_candidato_fisico", ""); }//loginAcesso
	///VERIFICA PERMISSÕES DE ACESSO
	$idpermissao = "3_con_candidatojuridico";
	if($cVLogin->loginAcesso($idpermissao)){ $pPER["$idpermissao"] = "1"; $CONT["$idpermissao"] = fSQL::SQL_CONTAGEM("cad_candidato_juridico", ""); }//loginAcesso
	///VERIFICA PERMISSÕES DE ACESSO
	$idpermissao = "3_rel_precadastroquantitativo";
	if($cVLogin->loginAcesso($idpermissao)){ $pPER["$idpermissao"] = "1"; }//loginAcesso
}//if($cVLogin->loginModuloPerfil("3")){//..................... 3. BASE CADASTRAL  .............................................
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: ver módulo ::::::::::::::::::::::::::::::::::::::::::::::::::::::::


//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: ver módulo ::::::::::::::::::::::::::::::::::::::::::::::::::::::::
if($cVLogin->loginModuloPerfil("7")){//..................... 7. PROCESSO  ........................................................
	///VERIFICA PERMISSÕES DE ACESSO
	$idpermissao = "7_axl_usuario_verificacao";
	if($cVLogin->loginAcesso($idpermissao)){ $pPER["$idpermissao"] = "1"; } 
	///VERIFICA PERMISSÕES DE ACESSO
	$idpermissao = "7_axl_triagem";
	if($cVLogin->loginAcesso($idpermissao)){ $pPER["$idpermissao"] = "1"; } 
	///VERIFICA PERMISSÕES DE ACESSO
	$idpermissao = "7_axl_iniciaratendimento";
	if($cVLogin->loginAcesso($idpermissao)){ $pPER["$idpermissao"] = "1"; } 
	///VERIFICA PERMISSÕES DE ACESSO
	$idpermissao = "7_axl_backoffice";
	if($cVLogin->loginAcesso($idpermissao)){ $pPER["$idpermissao"] = "1"; } 	
	///VERIFICA PERMISSÕES DE ACESSO
	$idpermissao = "7_axl_auditoria";
	if($cVLogin->loginAcesso($idpermissao)){ $pPER["$idpermissao"] = "1"; } 
	///VERIFICA PERMISSÕES DE ACESSO
	$idpermissao = "7_axl_gestaooperacao";
	if($cVLogin->loginAcesso($idpermissao)){ $pPER["$idpermissao"] = "1"; } 	
	///VERIFICA PERMISSÕES DE ACESSO
	$idpermissao = "7_rel_protocolosquantitativo";
	if($cVLogin->loginAcesso($idpermissao)){ $pPER["$idpermissao"] = "1"; } 		
	///VERIFICA PERMISSÕES DE ACESSO
	$idpermissao = "7_pro_protocolos";
	if($cVLogin->loginAcesso($idpermissao)){ $pPER["$idpermissao"] = "1"; } 
}//if($cVLogin->loginModuloPerfil("7")){//..................... 7. PROCESSO  .....................................................
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: ver módulo ::::::::::::::::::::::::::::::::::::::::::::::::::::::::












//* ------------------------------------- ##### DADOS DO REGISTRO PADRAO #### --------------------------------------------*//
?>
<?php























if($ajax == "imprimirCapaProcesso"){
	$code = getpost_sql($_GET["code"]);

	$qrcode_img = time().".jpeg";
	$html = capaProcesso($code, $qrcode_img); 
	

?>	

<form id="FormReciboii" name="FormReciboii" method="post" class="hide" action="export.php" target="_blank">
  <input name="acao" id="acao" type="hidden" value="pdfhtml" />
  <input name="cabecalho" id="cabecalho" type="hidden" value="1" /> 
  <input name="pg" id="pg" type="hidden" value="0" />  
  <input name="img_apagar" id="img_apagar" type="hidden" value="<?=$qrcode_img?>" />  
  <input name="nome" id="nome" type="hidden" value="capa-processo-<?=$code?>" />
  <input name="titulo" id="titulo" type="hidden" value="PROCESSUS" />
  <input name="html" id="html" type="hidden" value="<?=$html?>" />
</form>	
<script>
//prepara o envio do CSV
function exportarPDF(){
	$("#FormReciboii #html").val("<?=stripslashes($html)?>");
	$('#FormReciboii').submit();
}
$(document).ready(function(e) {
    exportarPDF();
	
});
</script>
<?php
}//imprimirCapaProcesso






































if($ajax == "imprimirProcessoFull"){
	$code = getpost_sql($_GET["code"]);

?>	

<form id="FormReciboii" name="FormReciboii" method="post" class="hide" action="export.php" target="_blank">
  <input name="acao" id="acao" type="hidden" value="processoFull" />
  <input name="cabecalho" id="cabecalho" type="hidden" value="1" /> 
  <input name="titulo" id="titulo" type="hidden" value="PROCESSUS" />
  <input name="code" id="code" type="hidden" value="<?=$code?>" />
</form>	
<script>
//prepara o envio do CSV
function exportarPDF(){
	$('#FormReciboii').submit();
}
$(document).ready(function(e) {
    exportarPDF();
});
</script>
<?php
}//imprimirProcessoFull




























//AJAX QUE EXIBE ITEM DE CANDIDATO FISICO ------------------------------------------------------------------>>>
if($ajax == "candidatofisico"){	
	if(isset($_GET["page_limit"])){ $page_limit = $_GET["page_limit"]; }else{ $page_limit = "30"; }
	if(isset($_GET["user"])){ $user = $_GET["user"]; }else{ $user = ""; }
	$term = ""; if(isset($_GET["term"])){ $term = $_GET["term"]; }
	$sql_busca = "";

		//cria array de retorno
		$return_arr = array();
		$row_array = array();
		$ret = array();
			
	if(strlen($term) <= 1){
		//alimenta array de retorno
		$row_array['id'] = "";
		$row_array['text'] = $class_fLNG->txt(__FILE__,__LINE__,'Comece a digitar para buscar...');
		array_push($return_arr,$row_array);
	}else{

		$sql_busca = " `id` = '".$term."' OR `nome` LIKE '%$term%' OR `code` LIKE '%$term%' OR `sobrenome` LIKE '%$term%' "; //condição
		
		if($user != ""){
			if($sql_busca != ""){ $sql_busca .= " AND "; }
			$sql_busca = " user LIKE '".$user."-%' ";
		}//if($user != ""){
	
		

		
		
	//lista ALERTAS
		$campos = "id,code,nome,sobrenome,rg,passaporte,outro_doc_nome,outro_doc_numero,id_estrangeiro";
		$tabela = "cad_candidato_fisico";
		$where = $sql_busca;
		//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
		$resuM = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "ORDER BY nome ASC",$page_limit);
		while($linha = fSQL::FETCH_ASSOC($resuM)){
			$id = $linha["id"];
			$rg = $linha["rg"];
			$passaporte = $linha["passaporte"];
			$outro_doc_nome = $linha["outro_doc_nome"];
			$outro_doc_numero = $linha["outro_doc_numero"];
			$id_estrangeiro = $linha["id_estrangeiro"];
			$doc = "";
			if($rg != ""){ $doc = $class_fLNG->txt(__FILE__,__LINE__,'Identidade')." ".$rg; }
			if($doc == "" and $passaporte != ""){ $doc = $class_fLNG->txt(__FILE__,__LINE__,'Passaporte')." ".$passaporte; }
			if($doc == "" and $outro_doc_nome != ""){ $doc = $outro_doc_nome." ".$outro_doc_numero; }			
			if($doc == "" and $id_estrangeiro != ""){ $doc = $class_fLNG->txt(__FILE__,__LINE__,'ID Estrangeiro')." ".$id_estrangeiro; }	

			
			//se tiver habilitações ativas ou suspensas
			$qtd = fSQL::SQL_CONTAGEM("axl_processo","candidato_fisico_id = '".$id."' AND servico_id IN ('13','14','15') AND ((status >= '0' AND status <= '5') OR (status = '10'))");
			if($qtd >= "1"){ continue; }//if($qtd_tombamento >= "1"){
			
			
			$code = $linha["code"];
			$legenda = $linha["nome"]." ".$linha["sobrenome"];
			$html = SYS_CONFIG_RM_SIGLA." ".$code." - <b>".$legenda."</b><br>".$doc.'<div style="clear:both; border-top:#E0E0E0 1px solid;"></div>';
			
			
			//alimenta array de retorno
			$row_array['id'] = $id;
			$row_array['text'] = $html;
			//formata amarelo
			if(!isset($java)){ $idRAND = rand().time(); $java = '<script>$(".select2-marca'.$idRAND.'").highlight("'.$term.'");</script>'; }else{ $java = ""; }
			$row_array['text'] = '<div class="select2-marca'.$idRAND.'">'.$row_array['text'].'</div>'.$java;
			array_push($return_arr,$row_array);
	
		}//fim while
	}
	
	//imprime JSON de retorno
    $ret['results'] = $return_arr;
	echo json_encode($ret);

}//fim ajax lista ------------------------------------------------------------------------------------------ <<<






































if($ajax == "novoBackOffice"){
	$tipo_servico_a = getpost_sql($_GET["tipo_servico"]);
	if(isset($_GET["nverificador"])){ $nverificador = getpost_sql($_GET["nverificador"]); }else{ $nverificador = ""; }
	if(isset($_GET["pgto_num"])){ $pgto_num = getpost_sql($_GET["pgto_num"]); }else{ $pgto_num = ""; }
	
    //id temp para registro de array
    $array_temp = time().rand(9,99999).$cVLogin->getVarLogin("SYS_USER_ID");
	$formCadastroSec = "formCadastroSec".$array_temp;	

	if($nverificador != ""){
		$valida = "";
		$arrV = fGERAL::NVerificadorValida($nverificador);
		
		if($arrV == ""){ $nverificador = ""; $valida = $class_fLNG->txt(__FILE__,__LINE__,'Nº Verificador inválido, verifique e tente novamente!'); }
		if($valida == "" and $arrV["tipo_servico"] != $tipo_servico_a){ $nverificador = ""; $valida = $class_fLNG->txt(__FILE__,__LINE__,'Tipo do serviço da papeleta não é equivalente ao tipo selecionado (!!tipo!!), verifique!',array("tipo"=>categoriaServicoLeg($tipo_servico_a))); }//if($arrV["tipo_servico_id"] != $tipo_servico_a){
		if($valida == ""){ 
			$qtd = fSQL::SQL_CONTAGEM("axl_triagem","backoffice = '".$arrV["nverificador"]."'");
			if($qtd >= "1"){ $valida = $class_fLNG->txt(__FILE__,__LINE__,'Processo já foi digitado!'); }
		}//if($valida == ""){
		
		if($valida == ""){ 
			$linha = fSQL::SQL_SELECT_ONE("id,cod_banco,nome,sobrenome,valor,time_deposito","axl_pgto_banco","status = '0' AND numero = '$pgto_num'");
			if($linha["id"] >= "1"){
				$pgto_id = $linha["id"];
				$pgto_info = $linha["nome"]." ".$linha["sobrenome"];
				$pgto_info .= "<br>GNF $ ".formataValor($linha["valor"]);
				$pgto_info .= "<br>".date("d/m/Y H:i", $linha["time_deposito"]);
				$pgto_info .= "<br>".$class_fLNG->txt(__FILE__,__LINE__,'Banco').": ".legBanco($linha["cod_banco"]);
			}else{//if($linha["id"] >= "1"){
				$valida = $class_fLNG->txt(__FILE__,__LINE__,'Não foi encontrado nenhum dado de pagamento com este número')." (".$pgto_num.")";
				$pgto_num = "";
			}//}else{//if($linha["id"] >= "1"){
		}//if($valida == ""){ 
		
		if($valida != ""){
			$cMSG->addMSG("ERRO",$valida); 		
			$cMSG->imprimirMSG();//imprimir mensagens criadas 		
		}//if($valida != ""){
	}//if($nverificador != ""){
		
	if(isset($_GET["irProcesso"]) and $valida == ""){
		$id_a = fSQL::SQL_SELECT_INSERT("axl_triagem");
		$campos = "id,origem_id,pgto_num,pgto_id,tipo_pessoa,tipo_servico,candidato_fisico_id,nome,senha,status,backoffice,user,time,user_a,sync";
		$valores = array($id_a,$cVLogin->getVarLogin("SYS_USER_ORIGEM_ID"),$pgto_num,$pgto_id,"fisico",$tipo_servico_a,"0","NOVO","XXXX","0",$arrV["nverificador"],$cVLogin->userReg(),time(),"0",time());
		fSQL::SQL_INSERT_SIMPLES($campos,"axl_triagem",$valores);
		
		fSQL::SQL_UPDATE_SIMPLES("status,triagem_id,sync","axl_pgto_banco",array("1",$id_a,time()),"id = '$pgto_id'");		
	}//irProcesso		
	

?>
<form id="<?=$formCadastroSec?>" name="<?=$formCadastroSec?>" action="#" method="POST" class='form-horizontal form-bordered form-validate'>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Atendimento')?></label>
											<div class="controls display-plus">
											  <div style='float:left;'><i style='font-size: 40px;' class='<?=categoriaServicoIco($tipo_servico_a)?>'></i></div> <?=maiusculo(categoriaServicoLeg($tipo_servico_a))?>
											</div>
										</div>
                                    <?php if($nverificador == "" || $pgto_num == ""){?>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Nº Verificador')?></label>
											<div class="controls">
												<input type="text" id="nverificador" name="nverificador" value="<?=$nverificador?>" class="mask_nverificador" style="width:98%"/>
											</div>
										</div>  
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Nº Pagamento')?></label>
											<div class="controls">
												<input type="text" id="pgto_num" name="pgto_num" value="<?=$pgto_num?>" style="width:98%"/>
											</div>
										</div>                                         
                                        <div class="form-actions">
                                        	<button type="button" class="btn btn-large btn-primary" onclick="nverificadorBackOffice<?=$INC_FAISHER["div"]?>();return false;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Validar dados')?></button>
                                            <button type="button" class="btn btn-large" data-dismiss="modal"><?=$class_fLNG->txt(__FILE__,__LINE__,'Cancelar')?></button>
                                        </div>
									<?php }else{//if($nverificador == ""){?>                                                
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Nº Verificador')?></label>                                    
                                    		<div class="controls display-plus">
                                        		<?=$nverificador?> <button type="button" class="btn btn-mini" onclick="faisher_ajax('pModalConteudoOn', 'pModalLoader', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=novoBackOffice&tipo_servico=<?=$tipo_servico_a?>', 'get', 'ADD');"><i class="icon-retweet"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'alterar')?></button>
                                                <br><small><i><?=$class_fLNG->txt(__FILE__,__LINE__,'Processo aberto na unidade !!unidade!!, em !!data!!',array("unidade"=>$arrV["origem_id_n"],"data"=>date("d/m/Y H:i", $arrV["time"])))?></i></small>
                                        	</div>
                                        </div>
                                        
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Nº Pagamento')?></label>
											<div class="controls">
												<?=$pgto_info?> <button type="button" class="btn btn-mini" onclick="faisher_ajax('pModalConteudoOn', 'pModalLoader', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=novoBackOffice&tipo_servico=<?=$tipo_servico_a?>', 'get', 'ADD');"><i class="icon-retweet"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'alterar')?></button>
											</div>
										</div>                                          

                                        
                                        <div class="form-actions">
                                        	<button type="button" class="btn btn-large btn-primary" onclick="processoBackOffice<?=$INC_FAISHER["div"]?>();return false;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Ir para processo')?></button>
                                            <button type="button" class="btn btn-large" data-dismiss="modal"><?=$class_fLNG->txt(__FILE__,__LINE__,'Cancelar')?></button>
                                        </div>                                        
                                    <?php }//else{//if($nverificador == ""){?>                                        
                                    
                                  
</form> 
<script>
<?php if(isset($_GET["irProcesso"])){?>
$(document).ready(function(e) {
	pmodalDisplay('fechar');
	faisher_ajaxAba('12', "<?=$class_fLNG->txt(__FILE__,__LINE__,'Iniciar Atendimento')?>", '7_axl_iniciaratendimento', 'id_a=<?=$arrV["nverificador"]?>');
});
<?php }//if(isset($_GET["irProcesso"])){?>
function nverificadorBackOffice<?=$INC_FAISHER["div"]?>(){
	v_nverificador = $("#<?=$formCadastroSec?> #nverificador").val();
	v_pgto_num = $("#<?=$formCadastroSec?> #pgto_num").val();
	valida = "";
	if(v_nverificador == ""){ valida = "<?=$class_fLNG->txt(__FILE__,__LINE__,'Nº verificador deve ser preenchido!')?>"; }
	if(v_pgto_num == ""){ valida = "<?=$class_fLNG->txt(__FILE__,__LINE__,'Nº pagamento deve ser preenchido!')?>"; }	
	
	if(valida != ""){ alert(valida); }else{//if(valida != ""){
		faisher_ajax('pModalConteudoOn', 'pModalLoader', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=novoBackOffice&tipo_servico=<?=$tipo_servico_a?>&nverificador='+v_nverificador+'&pgto_num='+v_pgto_num, 'get', 'ADD');
	}//}else{//if(valida != ""){
}//recarregarBackOffice


function processoBackOffice<?=$INC_FAISHER["div"]?>(){
	faisher_ajax('pModalConteudoOn', 'pModalLoader', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=novoBackOffice&irProcesso=1&tipo_servico=<?=$tipo_servico_a?>&nverificador=<?=$nverificador?>&pgto_num=<?=$pgto_num?>', 'get', 'ADD');
}//recarregarBackOffice

</script>                                       
<?php	
}//novoBackOffice



















if($ajax == "imprimirRecibo"){
	$code = getpost_sql($_GET["code"]);

	$linha = fSQL::SQL_SELECT_ONE("id,candidato_fisico_id,tipo_servico,servico_id,status,pgto_id,time","axl_processo","code = '".$code."'");
	$processo_id = $linha["id"];
	$candidato_fisico_id = $linha["candidato_fisico_id"];
	$tipo_servico = $linha["tipo_servico"];	
	$status = $linha["status"];	
	$servico_id = $linha["servico_id"];
	$pgto_id = $linha["pgto_id"];
	$time = $linha["time"];	
	
	$linha2 = fSQL::SQL_SELECT_ONE("nome","adm_protocolo_tipo","id = '".$servico_id."'");
	$servico_id_n = '<i class="'.categoriaServicoIco($tipo_servico).'"></i> '.$linha2["nome"];
	
	$linha2 = fSQL::SQL_SELECT_ONE("code,nome,sobrenome","cad_candidato_fisico","id = '$candidato_fisico_id'");
	$arrDoc = docPessoaFisica($candidato_fisico_id);

	$html_recibo .= '<table width="100%" border="0" cellspacing="0" cellpadding="1" style="padding:5px;"><tr><td style="padding:5px; font-size:16px; border-bottom:#CCC 2px solid; font-weight:bold;">PROCESSO '.SYS_CONFIG_PROCESSO_SIGLA.' '.$code.'</td></tr></table>';
	$html_recibo .= '<table width="100%" border="0" cellspacing="0" cellpadding="1">';
	$html_recibo .= '<tr><td width="20%" style="color:#666; padding:5px;">'.$class_fLNG->txt(__FILE__,__LINE__,'Tipo de Processo').'</td><td width="65%" style="padding:5px;">'.$servico_id_n.'</td></tr>';
	$html_recibo .= '<tr><td width="20%" style="color:#666; padding:5px;">'.$class_fLNG->txt(__FILE__,__LINE__,'Data de criação').'</td><td width="65%" style="padding:5px;">'.date('d/m/Y H:i', $time).'h</td></tr>';
	$html_recibo .= '<tr><td width="20%" style="color:#666; padding:5px;">'.SYS_CONFIG_RM_SIGLA.'</td><td width="65%" style="padding:5px;">'.$linha2["code"].'</td></tr>';
	$html_recibo .= '<tr><td width="20%" style="color:#666; padding:5px;">'.$class_fLNG->txt(__FILE__,__LINE__,'Nome').'</td><td width="65%" style="padding:5px;">'.$linha2["nome"].'</td></tr>';
	$html_recibo .= '<tr><td width="20%" style="color:#666; padding:5px;">'.$class_fLNG->txt(__FILE__,__LINE__,'Sobrenome').'</td><td width="65%" style="padding:5px;">'.$linha2["sobrenome"].'</td></tr>';

	
	$categorias = "";
	$resu = fSQL::SQL_SELECT_SIMPLES("nome,valor","axl_processo_campos","processo_id = '".$processo_id."' AND tipo_campo = '99'");
	while($linha = fSQL::FETCH_ASSOC($resu)){
		if($categorias != ""){ $categorias .= ", "; }
		$categorias .= $linha["nome"];
	}//fim while
	if($categorias != ""){
		$html_recibo .= '<tr><td width="20%" style="color:#666; padding:5px;">'.$class_fLNG->txt(__FILE__,__LINE__,'Categorias').'</td><td width="65%" style="padding:5px;">'.$categorias.'</td></tr>';
	}//if($categorias != ""){
	
	$html_recibo .= '</table>';


?>	

<form id="FormReciboii" name="FormReciboii" method="post" class="hide" action="export.php" target="_blank">
  <input name="acao" id="acao" type="hidden" value="pdfhtml" />
  <input name="cabecalho" id="cabecalho" type="hidden" value="1" />  
  <input name="orientacao" id="orientacao" type="hidden" value="landscape" />
  <input name="papel" id="papel" type="hidden" value="A5" />  
  <input name="nome" id="nome" type="hidden" value="recibo-<?=$code?>" />
  <input name="titulo" id="titulo" type="hidden" value="RECIBO PROCESSO <?=$code?>" />
  <input name="html" id="html" type="hidden" value="<?=$html_recibo?>" />
</form>	
<script>
//prepara o envio do CSV
function exportarPDF(){
	$("#FormReciboii #html").val('<?=stripslashes($html_recibo)?>');
	$('#FormReciboii').submit();
}
$(document).ready(function(e) {
    exportarPDF();
});
</script>
<?php
}//imprimirRecibo






























if($ajax == "consultaProcessos"){

	if(isset($_GET["tab_id"])){ $tab_id = getpost_sql($_GET["tab_id"]); }else{ $tab_id = "0"; }


	if(isset($_GET["coleta"])) {
		//ini_set('display_errors',1);ini_set('display_startup_erros',1);error_reporting(E_ALL);
		$processo_id = $_GET["coleta"];
		$result = thomasWScoletaBiometricaEnviar($processo_id,$cVLogin->getVarLogin("SYS_USER_ORIGEM_ID"),$cVLogin->getVarLogin("SYS_USER_ID"));
		if($result["codigo_retorno"] == "1"){ 
			//criar eventos do processo
			fPROCESSO::criarEvento($class_fLNG->txt(__FILE__,__LINE__,'Autorização Coleta Biométrica'),$class_fLNG->txt(__FILE__,__LINE__,'Processo autorizado para coleta biométrica'),$cVLogin->userReg(),$cVLogin->getVarLogin("SYS_USER_CARGO"),$processo_id);
		
			$cMSG->addMSG("SUCESSO",$class_fLNG->txt(__FILE__,__LINE__,'Processo autorizado para coleta com sucesso!'));
			$cMSG->imprimirMSG();		
		}else{
			$msg = thomasFiltrarErro($result["descricao_retorno"]);
			$valida = thomasCodRetorno($result["codigo_retorno"]).$msg;			
			$cMSG->addMSG("ERRO",$class_fLNG->txt(__FILE__,__LINE__,'Opss... Ocorreu um erro ao autorizar coleta biométrica!')." (".htmlspecialchars($valida, ENT_QUOTES).")");
			$cMSG->imprimirMSG();			
		}
	}

    //id temp para registro de array
    $array_temp = time().rand(9,99999).$cVLogin->getVarLogin("SYS_USER_ID");
	$formBusca = "formBusc".$array_temp;

	/////////// INCLUDE JS EXCLUSIVO --------------------- 
	$INC_JS = ",icheck,";//informar funcao a usar entre VIRGULAS > ,funcao
	$INC_JSCSS = $INC_FAISHER["div"]."bp";
	include "inc/inc_js-exclusivo.php";		

?>



<script>
$(document).ready(function(){
	//atualiza dados de tabs
	$('.tabs-<?=$INC_FAISHER["div"]?>').removeClass('active');
	$('#tab-<?=$tab_id?>-<?=$INC_FAISHER["div"]?>').addClass('active');
	$('#tab_id<?=$INC_FAISHER["div"]?>').val('<?=$tab_id?>');	
	
//JQUERY executa com ENTER
	/* ao pressionar uma tecla em um campo*/
	$("#<?=$formBusca?>").keypress(function(e){
		var tecla = (e.keyCode?e.keyCode:e.which);
		/* verifica se a tecla pressionada foi o ENTER */
		if(tecla == 13){//codigo a executar	
			bAvancada<?=$INC_FAISHER["div"]?>();
			return false;/* impede o sumbit caso esteja dentro de um form */
		}
	})
//FIM JQUERY executa com ENTER
});
//limpa campos
$('#<?=$formBusca?> .limpaCampo').click(function(){
	$(this).hide();
	content = $(this).parents('#<?=$formBusca?> .input-append').find("input");
	content.val('');
	bAvancada<?=$INC_FAISHER["div"]?>();
});
$("#<?=$formBusca?> .limpaInput").on("change", function(e){	bAvancada<?=$INC_FAISHER["div"]?>(); });
function pCbusca<?=$INC_FAISHER["div"]?>(v_id){
	content = $('#<?=$formBusca?> #'+v_id).parents('#<?=$formBusca?> .input-append').find("button");
	content.fadeIn();
}
function lCbusca<?=$INC_FAISHER["div"]?>(v_id){
	$('#<?=$formBusca?> #'+v_id).val('');
	content = $('#<?=$formBusca?> #'+v_id).parents('#<?=$formBusca?> .input-append').find("button");
	content.hide();
}

//buscas avancada
function bAvancada<?=$INC_FAISHER["div"]?>(){
	var v_get = '&tab_id='+$('#tab_id<?=$INC_FAISHER["div"]?>').val();//pega dados do tabs
	<?php $idCJ = "doc_tipo_b";?>if($("#<?=$formBusca?> input[name='<?=$idCJ?>']:checked").val() != ""){ v_get = v_get+'&<?=$idCJ?>='+$("#<?=$formBusca?> input[name='<?=$idCJ?>']:checked").val(); pCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }
	<?php $idCJ = "datan_b";?>if($("#<?=$formBusca?> #<?=$idCJ?>").val() != ""){ v_get = v_get+'&<?=$idCJ?>='+$("#<?=$formBusca?> #<?=$idCJ?>").val(); pCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }
	<?php $idCJ = "doc_numero_b";?>if($("#<?=$formBusca?> #<?=$idCJ?>").val() != ""){ v_get = v_get+'&<?=$idCJ?>='+$("#<?=$formBusca?> #<?=$idCJ?>").val(); pCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }
	<?php $idCJ = "rnt_b";?>if($("#<?=$formBusca?> #<?=$idCJ?>").val() != ""){ v_get = v_get+'&<?=$idCJ?>='+$("#<?=$formBusca?> #<?=$idCJ?>").val(); pCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }
	<?php $idCJ = "rnc_b";?>if($("#<?=$formBusca?> #<?=$idCJ?>").val() != ""){ v_get = v_get+'&<?=$idCJ?>='+$("#<?=$formBusca?> #<?=$idCJ?>").val(); pCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }

	//loaderFoco('divConteiner_lista<?=$INC_FAISHER["div"]?>','dAjax_lista<?=$INC_FAISHER["div"]?>_load','<?=$class_fLNG->txt(__FILE__,__LINE__,'Filtrando dados...')?>');//cria um loader dinamico
	faisher_ajax('pModalConteudoOn', 'pModalLoader', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=consultaProcessos&'+v_get, 'get', 'ADD');
}//bAvancada

function bAvancada<?=$INC_FAISHER["div"]?>Remove(v_remove){
	<?php $idCJ = "doc_numero_b";?>if(v_remove == "<?=$idCJ?>" || v_remove == "all"){ lCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }
	<?php $idCJ = "datan_b";?>if(v_remove == "<?=$idCJ?>" || v_remove == "all"){ lCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }	
	<?php $idCJ = "rnt_b";?>if(v_remove == "<?=$idCJ?>" || v_remove == "all"){ lCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }
	<?php $idCJ = "rnc_b";?>if(v_remove == "<?=$idCJ?>" || v_remove == "all"){ lCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }

	bAvancada<?=$INC_FAISHER["div"]?>();	
}//bAvancadaRemove
</script>

        <div class="control-group">
            <ul class="tabs tabs-inline tabs-top">
                <li class="tabs-<?=$INC_FAISHER["div"]?>" id="tab-0-<?=$INC_FAISHER["div"]?>"><a href="#" onclick="consultaProcessos<?=$INC_FAISHER["div"]?>('tab_id=0');return false;" data-toggle='tab'><?=$class_fLNG->txt(__FILE__,__LINE__,'Pendentes')?></a></li>
                <li class="tabs-<?=$INC_FAISHER["div"]?>" id="tab-1-<?=$INC_FAISHER["div"]?>"><a href="#" onclick="consultaProcessos<?=$INC_FAISHER["div"]?>('tab_id=1');return false;" data-toggle='tab'><?=$class_fLNG->txt(__FILE__,__LINE__,'Histórico')?></a></li>
                <li class="tabs-<?=$INC_FAISHER["div"]?>" id="tab-2-<?=$INC_FAISHER["div"]?>"><a href="#" onclick="consultaProcessos<?=$INC_FAISHER["div"]?>('tab_id=2');return false;" data-toggle='tab'><?=$class_fLNG->txt(__FILE__,__LINE__,'Processos de Outras Unidades')?></a></li>        
            </ul>
        </div>
							<div class="row-fluid" style="margin-bottom:20px;" id="dDbusca<?=$INC_FAISHER["div"]?>">
                            <?php $idControleGuia = time().rand().rand(); ?>
							<div class="box box-color box-small">
								<div class="box-title" style="margin:0;">
									<h3><i class="icon-search"></i><span id="tituDbusca<?=$INC_FAISHER["div"]?>">Aplicar filtros</span></h3>
								</div>
								<div class="box-content-ax"><div id="divDbusca<?=$INC_FAISHER["div"]?>">
                                <input id="tab_id<?=$INC_FAISHER["div"]?>" name="tab_id<?=$INC_FAISHER["div"]?>" type="hidden" value="<?=$tab_id?>" />
<form action="#" id="<?=$formBusca?>" method="POST" class='form-horizontal form-column form-bordered' onsubmit="return false;">

    
    
	<div class="span6">
        <div class="control-group">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Nº do documento')?></label>
            <div class="controls">
                <div class="input-append"><input type="text" name="doc_numero_b" id="doc_numero_b" placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Informe o nº do documento')?>" class="input-xlarge"><button class="btn limpaCampo" type="button" style="display:none;" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Limpar')?>"><i class="icon-trash"></i></button></div>
            </div>
        </div>    
        <div class="control-group">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Data de nascimento')?></label>
            <div class="controls">
            	<div class="input-append"><input type="text" class="input-xlarge mask_date" id="datan_b" name="datan_b"/><button class="btn limpaCampo" type="button" style="display:none;" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Limpar')?>"><i class="icon-trash"></i></button></div>
            </div>
        </div> 
        <div class="form-actions">
        </div>
        <div class="control-group">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Nº ')?> <?=SYS_CONFIG_RM_SIGLA?></label>
            <div class="controls">
                <div class="input-append"><input type="text" name="rnt_b" id="rnt_b" placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Informe o !!sigla!!',array("sigla"=>SYS_CONFIG_RM_SIGLA))?>" class="input-xlarge"><button class="btn limpaCampo" type="button" style="display:none;" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Limpar')?>"><i class="icon-trash"></i></button></div>
            </div>
        </div>            
	</div><!-- End .span6 -->
    
	<div class="span6">
        <div class="control-group">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Tipo do documento')?></label>
            <div class="controls">
                <div class="check-line">
                    <input name="doc_tipo_b" type="radio" class='<?=$INC_FAISHER["div"]?>bp-icheck' id="doc_tipo1" value="<?=$class_fLNG->txt(__FILE__,__LINE__,'IDENTIDADE')?>" data-skin="square" data-color="blue" checked="checked"> <label class='inline' for="doc_tipo1"><?=$class_fLNG->txt(__FILE__,__LINE__,'Identidade')?></label>
                </div>
                <div class="check-line">
                    <input name="doc_tipo_b" type="radio" class='<?=$INC_FAISHER["div"]?>bp-icheck' id="doc_tipo2" value="<?=$class_fLNG->txt(__FILE__,__LINE__,'PASSAPORTE')?>" data-skin="square" data-color="blue"> <label class='inline' for="doc_tipo2"><?=$class_fLNG->txt(__FILE__,__LINE__,'Passaporte')?></label>
                </div>
                <div class="check-line">
                    <input name="doc_tipo_b" type="radio" class='<?=$INC_FAISHER["div"]?>bp-icheck' id="doc_tipo3" value="<?=$class_fLNG->txt(__FILE__,__LINE__,'ID ESTRANGEIRO')?>" data-skin="square" data-color="blue"> <label class='inline' for="doc_tipo3"><?=$class_fLNG->txt(__FILE__,__LINE__,'ID Estrangeiro')?></label>
                </div>
                <div style="height:5px;"></div>
            </div>
        </div>  
        <div class="form-actions">
        </div>     
        <div class="control-group">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Nº ')?> <?=SYS_CONFIG_PROCESSO_SIGLA?></label>
            <div class="controls">
                <div class="input-append"><input type="text" name="rnc_b" id="rnc_b" placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Informe o !!sigla!!',array("sigla"=>SYS_CONFIG_PROCESSO_SIGLA))?>" class="input-xlarge"><button class="btn limpaCampo" type="button" style="display:none;" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Limpar')?>"><i class="icon-trash"></i></button></div>
            </div>
        </div>                 
        
	</div><!-- End .span6 -->
    
	<div class="span12">
		<div class="form-actions">
			<button type="button" class="btn btn-primary enviaBt" onclick="bAvancada<?=$INC_FAISHER["div"]?>();"><i class="icon-search"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Buscar agora')?></button>
			<button type="button" class="btn" onclick="bAvancada<?=$INC_FAISHER["div"]?>Remove('all');$('#dAbusca<?=$INC_FAISHER["div"]?> .bt_expandebusca').click();"><?=$class_fLNG->txt(__FILE__,__LINE__,'Cancelar/Ocultar')?></button>
		</div>
	</div>
</form>                                
                                </div></div>
							</div>
                            </div>





<?php	




//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||--------------- SQL vars >>>
//vars para consulta no DB referente a paginação abaixo
	$SQL_campos = "P.id,P.code,P.candidato_fisico_id,P.tipo_servico,P.servico_id,P.status,P.pgto_id,P.time,P.coleta_id,C.nome"; //campos da tabela
	$SQL_tabela = "axl_processo P, cad_candidato_fisico C"; //tabela
	$SQL_join = ""; //join
	$SQL_where = "P.candidato_fisico_id = C.id";
	$SQL_varEnvio = "ajax=consultaProcessos&faisher=$faisher&"; //variaveis para a paginacao
	$ORDEM_C = "time";//campo de ordenar
	$ORDEM = "DESC";// ASC ou DESC
	$SQL_group = ""; // agrupar o resultado GROUP BY

//verifica se recebeu ORDEM_C ou seta ORDER padrao ------------ VARS SQL
	if((isset($_GET["ORDEM_C"])) and ($_GET["ORDEM_C"] != "undefined") and ($_GET["ORDEM_C"] != "")){
		$ORDEM_C = getpost_sql($_GET["ORDEM_C"]);
		$ORDEM = getpost_sql($_GET["ORDEM"]);
	}//fim ORDEM_C
	$SQL_order = $SQL_group." ORDER BY $ORDEM_C $ORDEM"; // ordem do resultado
	$AJAX_GET = $SQL_varEnvio;//vars get para reenvio no paginaçao AJAX
	$AJAX_GET_OR = "ORDEM_C=$ORDEM_C&ORDEM=$ORDEM&";//vars get para reenvio no paginaçao AJAX com ORDER
//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL vars <<<

	if($tab_id == "0"){
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= "externo = '1' AND P.user = '".$cVLogin->userReg()."' AND status IN ('0','1','11','12')"; //condição 		
	}else if($tab_id == "1"){
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= "externo = '1' AND P.user = '".$cVLogin->userReg()."'";
	}else{
		//if($SQL_where != ""){ $SQL_where .= " AND "; }
		//$SQL_where .= ""; //condição 		
	}//if($tab_id != "2"){


//pega vars de busca
	unset($filtro_b);
	if(isset($_GET["rapida_b"])){   					 $rapida_b = getpost_sql($_GET["rapida_b"]);   						  }else{ $rapida_b = "";    	    }
	if(isset($_GET["doc_tipo_b"])){       				 $doc_tipo_b = getpost_sql($_GET["doc_tipo_b"]);       		   		  }else{ $doc_tipo_b = "";    		    }
	if(isset($_GET["doc_numero_b"])){       			 $doc_numero_b = getpost_sql($_GET["doc_numero_b"]);       		   	  }else{ $doc_numero_b = "";    		    }
	if(isset($_GET["datan_b"])){       					 $datan_b = getpost_sql($_GET["datan_b"]);       		     		  }else{ $datan_b = "";    		    }
	if(isset($_GET["rnt_b"])){       					 $rnt_b = getpost_sql($_GET["rnt_b"]);       		     		  	  }else{ $rnt_b = "";    		    }
	if(isset($_GET["rnc_b"])){       					 $rnc_b = getpost_sql($_GET["rnc_b"]);       		     		  	  }else{ $rnc_b = "";    		    }



//verifica se recebeu uma solicitação de busca por rapida_b
if($doc_numero_b != ""){ $filtro_marca[] = $doc_numero_b;
		$filtro_b["doc_numero_b"] = $class_fLNG->txt(__FILE__,__LINE__,'Busca por !!doc!! !!num!!',array("doc"=>'<b>'.$doc_tipo_b.'</b>',"num"=>'<b>'.$doc_numero_b.'</b>'));
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$campo = "";
		if($doc_tipo_b == $class_fLNG->txt(__FILE__,__LINE__,'IDENTIDADE')){ $campo = "rg"; }
		if($doc_tipo_b == $class_fLNG->txt(__FILE__,__LINE__,'PASSAPORTE')){ $campo = "passaporte"; }		
		if($doc_tipo_b == $class_fLNG->txt(__FILE__,__LINE__,'ID ESTRANGEIRO')){ $campo = "id_estrangeiro"; }		
		$SQL_where .= " ( C.`".$campo."` = '$doc_numero_b' ) "; //condição 		
		$AJAX_GET .= "doc_numero_b=$doc_numero_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por rapida_b





//verifica se recebeu uma solicitação de busca por rapida_b
if($datan_b != ""){ $filtro_marca[] = $datan_b;
		$filtro_b["datan_b"] = $class_fLNG->txt(__FILE__,__LINE__,'Data de nascimento !!busca!!',array("busca"=>'<b>'.$datan_b.'</b>'));
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " ( C.`datan` = '".data_mysql($datan_b)."' ) "; //condição 
		$AJAX_GET .= "datan_b=$datan_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por rapida_b




//verifica se recebeu uma solicitação de busca por rapida_b
if($rnt_b != ""){ $filtro_marca[] = $rnt_b;
		$filtro_b["rnt_b"] = SYS_CONFIG_RM_SIGLA." <b>".$rnt_b."</b>";
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " ( C.`code` = '".$rnt_b."' ) "; //condição 
		$AJAX_GET .= "rnt_b=$rnt_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por rapida_b






//verifica se recebeu uma solicitação de busca por rapida_b
if($rnc_b != ""){ $filtro_marca[] = $rnc_b;
		$filtro_b["rnc_b"] = SYS_CONFIG_RM_SIGLA." <b>".$rnc_b."</b>";
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " ( P.`code` = '".$rnc_b."' ) "; //condição 
		$AJAX_GET .= "rnc_b=$rnc_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por rapida_b







//echo "filtros (".ceil(count($filtro_b)).")<pre>"; print_r($filtro_b); echo "</pre>";

if($tab_id == "2"){
	$valida = "0";
	if($filtro_b["doc_numero_b"] != "" and $filtro_b["datan_b"] != ""){ $valida = "1"; }
	if($filtro_b["rnc_b"] != ""){ $valida = "1"; }
	if($filtro_b["rnt_b"] != ""){ $valida = "1"; }
	if($valida == "0"){
		$SQL_where .= " AND P.id = '0'";
?>
        <div class="alert alert-warning">
            <b><?=$class_fLNG->txt(__FILE__,__LINE__,'ATENÇÃO!')?></b><br><?=$class_fLNG->txt(__FILE__,__LINE__,'Para buscar é necessário utilizar algum filtro: <br>- Nº documento + data de nascimento <br>- !!rnt!!<br>- !!rnc!!</b>',array("rnt"=>SYS_CONFIG_RM_SIGLA,"rnc"=>SYS_CONFIG_PROCESSO_SIGLA))?>
        </div>
<?php
		exit(0);	
	}//if(ceil(count($filtro_b)) <= "0"){
}//if($tab_id == "2"){

//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL trata dados >>
//trata dados do sql paginação abaixo
			//inicia a montagem das consultas ao DB que farão a paginação
			if(isset($_GET["R_PAGINA"])){ //busca o numero de registros por pagina a exibir
				$R_PAGINA_N = $_GET["R_PAGINA"];
				if($R_PAGINA_N <= "100"){ sessoes("REG_PAG",$R_PAGINA_N); }else{ sessoes("REG_PAG","100"); }//cria a variavel
			}
			if(sessoes_v("REG_PAG") == "1"){ $reg_por_pagina = sessoes_p("REG_PAG"); }else{ $reg_por_pagina = "10"; }
			$max = $reg_por_pagina; //busca o padrao do sistema, registros por pagina
			if(isset($_GET['pagina'])){ $pagina = $_GET['pagina']; }
			if($pagina >= "1"){}else{ $pagina = 1; }
			$comeco = ($pagina*$max) - $max;
			
			//SQL_SELECT_SIMPLES($GLOBAL_VARS_DB, $campos, $tabela, $where='', $order='')
			$QueryListaPag 	= fSQL::SQL_SELECT_SIMPLES($SQL_campos, $SQL_tabela, $SQL_where, "$SQL_order", "$comeco,$max");
			$n_paginas 		= fSQL::SQL_CONTAGEM($SQL_tabela, $SQL_where, "", "$SQL_group");
			$n_reg_pagina	= fSQL::SQL_CONT($QueryListaPag);
			$paginas_total 	= ceil($n_paginas / $max);
//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL trata dados <<<
?>
<?php
//MOSTRAR TODAS AS MENSAGENS CRIADAS -------------------------- CLASSE MENSAGENS ----------------------- ||||||||||||||
$cMSG->imprimirMSG();//imprimir mensagens criadas
?>
<?php
//monta array
$array = $filtro_b;
$cont_ARRAY = ceil(count($array));
//listar item ja cadastrados
if($cont_ARRAY >= "1"){
?>
	<ul class="messages" style="margin-top:0; margin-right:0;">
		<li class="left">
			<div class="image"><img src="img/extras/icoBusca.png" alt=""></div>
			<div class="message"><span class="caret"></span><span class="name"><?=$class_fLNG->txt(__FILE__,__LINE__,'Resultado da busca realizada no(s) iten(s)')?></span>
				<button type="button" style="float:right; margin:3px 3px;" class="btn btn-mini" onclick="bRapida<?=$INC_FAISHER["div"]?>Remove('all');" rel="tooltip" data-placement="left" data-original-title="Remove Busca"><i class="icon-remove"></i></button>
				<p>
<?php
	$listaIDS_a = $array; //nome do cookie
	foreach ($listaIDS_a as $pos => $valor){
?>
	<div class="bg-shadowb15" style="float:left; margin:0 5px 5px 0; padding:5px;"><span style="float:left; padding-right:5px;"><?=$valor?></span> <button type="button" style="float:right;" class="btn btn-mini" rel="tooltip" data-placement="right" data-original-title="Remover Item" onclick="<?php if($pos == "rapida_b"){?>bRapida<?=$INC_FAISHER["div"]?>Remove('<?=$pos?>');<?php }else{?>bAvancada<?=$INC_FAISHER["div"]?>Remove('<?=$pos?>');<?php }?>"><i class="icon-remove"></i></button></div>
<?php
	}//fim foreach
?>
<div style="clear:both;"></div>
</p>
				<span class="time"> <?=$class_fLNG->txt(__FILE__,__LINE__,'!!npaginas!! registros encontrados',array("npaginas"=>'<b>'.$n_paginas.'</b>'))?></span>
			</div>
		</li>
	</ul>
<div style="clear:both;"></div>
<?php
}//fim if($cont_ARRAY >= "1"){
?>
<?php
//paginação
//$REG_TOTAL_INC = "1"; //criar a variavel faz exibir os totais por página
$TIPO_INC = "padraoajax";//tipo de pg
$GET_INC = $AJAX_GET.$AJAX_GET_OR; //vars GET
$PAG_INC = $AJAX_PAG;
$AJAX_PAG_DIV_INC = "pModalConteudoOn";
$AJAX_CARREGANDO_INC = "pModalLoader";
$AJAX_APPEND_INC = "ADD";//funcao ADD ajax faisher
include "../inc_paginacao.php";

?>
<input id="AJAX_GET<?=$INC_FAISHER["div"]?>_OR" name="AJAX_GET<?=$INC_FAISHER["div"]?>_OR" type="hidden" value="<?=$AJAX_GET?>&pagina=1" />
	<table id="tabela_itens<?=$INC_FAISHER["div"]?>" class="table table-hover table-bordered" style="margin-top:0;">
		<thead>
			<tr>
				<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Candidato')?></th>
				<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Serviço')?></th>
				<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Info')?></th>                
				<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Ação')?></th>                
			</tr>
		</thead>
        <tbody>
<?php	

$cont = "0";
	if($n_paginas >= "1"){
while($linha = fSQL::FETCH_ASSOC($QueryListaPag)){ $cont++;
	$processo_id = $linha["id"];
	$code = $linha["code"];
	$tipo_servico = $linha["tipo_servico"];
	$servico_id = $linha["servico_id"];
	$time = $linha["time"];
	$status = $linha["status"];
	$candidato_fisico_id = $linha["candidato_fisico_id"];
	$pgto_id = $linha["pgto_id"];
	$coleta_id = $linha["coleta_id"];
	
	$linha2 = fSQL::SQL_SELECT_ONE("numero,cod_banco","axl_pgto_banco","id = '".$pgto_id."'");
	$pgto_num = $linha2["numero"];
	$banco = $linha2["cod_banco"];	
	
	$linha2 = fSQL::SQL_SELECT_ONE("nome","adm_protocolo_tipo","id = '".$servico_id."'");
	$servico_id_n = "<i class='".categoriaServicoIco($tipo_servico)."'></i> ".$linha2["nome"];
	
	$linha2 = fSQL::SQL_SELECT_ONE("code,nome,sobrenome","cad_candidato_fisico","id = '$candidato_fisico_id'");
	$arrDoc = docPessoaFisica($candidato_fisico_id);
	$pessoa_n = SYS_CONFIG_RM_SIGLA." ".fGERAL::legCode($candidato_fisico_id,$linha2["code"])." - <b>".$linha2["nome"]." ".$linha2["sobrenome"]."</b>";
	
	$info = $class_fLNG->txt(__FILE__,__LINE__,'solicitado em !!data!!',array("data"=>date("d/m/Y", $time)));
	
	$button = "<button type='button' class='btn btn-info'><i class='glyphicon-check'></i> ".$class_fLNG->txt(__FILE__,__LINE__,'Certificado OK')."</button>";
	//certificado
	$qtd = fSQL::SQL_CONTAGEM("axl_processo_campos","processo_id = '".$processo_id."' AND tipo_id = '6'");
	if($qtd <= "0"){
		$button = "<button type='button' class='btn btn-primary' onClick='novaHabilitacao".$INC_FAISHER["div"]."(\"&processo_id=".$processo_id."&candidato_fisico_id=".$candidato_fisico_id."&pgto_id=".$pgto_id."&pgto_num=".$pgto_num."&banco=".$banco."&rnt=".$linha2["code"]."\");'><i class='glyphicon-clock'></i> ".$class_fLNG->txt(__FILE__,__LINE__,'Aguardando Certificado')."</button>";
	}
	
	if($status == "11"){ $button = "<button type='button' class='btn btn-danger'>".$class_fLNG->txt(__FILE__,__LINE__,'Cancelado - laudo médico')."</button>"; }
	if($status == "12"){ $button = "<button type='button' class='btn btn-danger'>".$class_fLNG->txt(__FILE__,__LINE__,'Cancelado - auto escola')."</button>"; }
	

	
	$status_n = "";

?>
			<tr>
            	<td><?=$pessoa_n?></td>
            	<td><?=$servico_id_n?><br><?=SYS_CONFIG_PROCESSO_SIGLA?> <?=$code?></td>                
            	<td><?=$info?></td>                                
                <td>
                	<button type='button' class='btn btn-default' onClick='novaHabilitacao<?=$INC_FAISHER["div"]?>("&processo_id=<?=$processo_id?>&candidato_fisico_id=<?=$candidato_fisico_id?>&pgto_id=<?=$pgto_id?>&pgto_num=<?=$pgto_num?>&banco=<?=$banco?>&rnt=<?=$linha2["code"]?>&visualizar=1");'><i class='icon-search'></i></button>
					<?=$button?>
           <?php if($status == "0"){?>
          			<button type="button" class="btn btn-primary" onclick="autorizarColeta<?=$INC_FAISHER["div"]?>('<?=$processo_id?>');"><i class="fas fa-fingerprint"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Autorizar Coleta')?> <img src="img/ajax-qloader-preto-p.gif" width="18" height="18" style="display:none;" id="btColetaBiometrica<?=$INC_FAISHER["div"]?>_load" />&nbsp;&nbsp;&nbsp;</button>
           <?php }//if($status == "0"){?>
		   			<button type="button" class="btn btn-default" onclick="imprimirRecibo<?=$INC_FAISHER["div"]?>('<?=$code?>');"><i class="icon-print"></i></button>
                </td>
            </tr>
<?php		
	}//fim foreach
}//if($n_paginas >= "1"){
?>        
        </tbody>
	</table>  
<?php
//paginação
$REG_TOTAL_INC = "1"; //criar a variavel faz exibir os totais por página
$TIPO_INC = "padraoajax";//tipo de pg
$GET_INC = $AJAX_GET.$AJAX_GET_OR; //vars GET
$PAG_INC = $AJAX_PAG;
$AJAX_PAG_DIV_INC = "divAjax_lista".$INC_FAISHER["div"];
$AJAX_CARREGANDO_INC = "dAjax_lista".$INC_FAISHER["div"]."_load";
$AJAX_APPEND_INC = "ADD";//funcao ADD ajax faisher
include "../inc_paginacao.php";

?>    
    <div id="resultado"></div>
<script>    
function novaHabilitacao<?=$INC_FAISHER["div"]?>(v_get){
	pmodalHtml('<i class=glyphicon-vcard></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'NOVA HABILITAÇÃO')?>','<?=$AJAX_PAG?>','get','faisher=<?=$faisher?>&ajax=novaHabilitacao&'+v_get);	
}//novaHabilitacao

function autorizarColeta<?=$INC_FAISHER["div"]?>(processo_id){
	//faisher_ajax('div_oculta', 'btColetaBiometrica<?=$INC_FAISHER["div"]?>_load', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=autorizarColeta&processo_id='+processo_id, 'get', 'ADD');	
	consultaProcessos<?=$INC_FAISHER["div"]?>('&coleta='+processo_id);
}//novaHabilitacao
</script>
<?php if($cont == "0"){?>
	<div style="height:150px; padding:20px 0 0 10px; clear:both;"><i class="icon-info-sign"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Não foi encontrado nenhum processo.')?></div>
<?php }//if($cont == "0"){?>    
<?php	
}//consultaProcessos





























if($ajax == "novaHabilitacao"){
//ini_set('display_errors',1);ini_set('display_startup_erros',1);error_reporting(E_ALL);
	if(isset($_GET["processo_id"])){ $processo_id = getpost_sql($_GET["processo_id"]); }else{ $processo_id = ""; }
	if(isset($_GET["candidato_id"])){ $candidato_id = getpost_sql($_GET["candidato_id"]); }else{ $candidato_id = "0"; }
	if(isset($_GET["rnt"])){ $rnt = getpost_sql($_GET["rnt"]); }else{ $rnt = ""; }	
	if(isset($_GET["banco"])){ $banco = getpost_sql($_GET["banco"]); }else{ $banco = ""; }
	if(isset($_GET["pgto_num"])){ $pgto_num = getpost_sql($_GET["pgto_num"]); }else{ $pgto_num = ""; }	
	if(isset($_GET["pgto_id"])){ $pgto_id = getpost_sql($_GET["pgto_id"]); }else{ $pgto_id = ""; }	
	if(isset($_GET["processo_id"])){ $processo_id = getpost_sql($_GET["processo_id"]); }else{ $processo_id = ""; }	
	if(isset($_GET["visualizar"])){ $visualizar = getpost_sql($_GET["visualizar"]); }else{ $visualizar = ""; }	

	if($processo_id >= "1")	{
		$linha = fSQL::SQL_SELECT_ONE("status,suspensao_f","axl_processo","id = '".$processo_id."'");
		if($linha["suspensao_f"] >= time()){
			$valida = $class_fLNG->txt(__FILE__,__LINE__,'Este processo está suspenso até !!data!!. Não é possível realizar atendimento de processo suspenso.',array("data"=>$linha["suspensao_f"]));
			$cMSG->addMSG("ERRO",$valida);
		}//if($arrPro["suspensao_f"] >= time()){
		
		if($linha["status"] >= "6"){
			$valida = $class_fLNG->txt(__FILE__,__LINE__,'Este processo foi cancelado! Não é possível realizar atendimento de processo cancelado.');					
			$cMSG->addMSG("ERRO",$valida);				
		}					
	}//if($processo_id >= "1")	{
	
	if(isset($_GET["salvar"])){
		if(isset($_GET["array_temp"])){ $array_temp = getpost_sql($_GET["array_temp"]); }
		$arrCategorias = array();
		if(isset($_GET["cat_A"])){ $arrCategorias["A"] = "1"; }
		if(isset($_GET["cat_A1"])){ $arrCategorias["A1"] = "1"; }
			
		if(isset($_GET["cat_B"])){ $arrCategorias["B"] = "1"; }		
		//insere o registro na tabela do sistema
		//VARS insert simples SQL
		if($processo_id == ""){
			
			if($valida == ""){
				//pegar anos de cada tipo de habilitação
				$validade_anos = "0";
				foreach($arrCategorias as $categoria => $valor){
					$linha = fSQL::SQL_SELECT_ONE("validade_anos","axl_habilitacao_categorias","categoria = '$categoria'");
					if($validade_anos > $linha["validade_anos"] || $validade_anos == "0"){ $validade_anos = $linha["validade_anos"]; }
					$arrCategorias[$categoria] = $linha["validade_anos"];
				}//fim foreach
	
		
				$ano = date("Y"); $mes = date("m"); $dia = date("d");			
		
				$code = fGERAL::codeRand(11);
				$tabela = "axl_processo";
				$campos = "origem_id,ano,mes,dia,code,tipo_servico,triagem_id,servico_id,pgto_id,candidato_fisico_id,candidato_juridico_id,coleta_id,coleta_time,status,validade_anos,validade_time,cfc,externo,user,time,user_a,sync";
				$valores = array($cVLogin->getVarLogin("SYS_USER_ORIGEM_ID"),$ano,$mes,$dia,$code,"habilitacao","0","14",$pgto_id,$candidato_id,"0","0","0","0",$validade_anos,"0",$cVLogin->getVarLogin("SYS_USER_NOME"),"1",$cVLogin->userReg(),time(),"0",time());
				$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
				$processo_id = fSQL::SQL_INSERT_ID();
				
				foreach($arrCategorias as $categoria => $validade_anos){
					if($categoria != ""){
						$campos = "processo_id,tipo_id,tipo_campo,nome,valor,user,time";
						$valores = array($processo_id,"2","99",$categoria,$validade_anos,$cVLogin->userReg(),time());
						fSQL::SQL_INSERT_SIMPLES($campos,"axl_processo_campos",$valores);
					}//if($categoria != ""){
				}//fim foreach
				
				$upload_dir = VAR_DIR_FILES."files/tabelas/axl_processo/"; $cria = fGERAL::criaPasta($upload_dir, "0775"); //confere a criação e retona 1			
				$upload_dir .= $ano."/"; $cria = fGERAL::criaPasta($upload_dir, "0775"); //confere a criação e retona 1			
				$upload_dir .= completa_zero($mes,"2")."/"; $cria = fGERAL::criaPasta($upload_dir, "0775"); //confere a criação e retona 1						
				$upload_dir .= completa_zero($dia,"2")."/"; $cria = fGERAL::criaPasta($upload_dir, "0775"); //confere a criação e retona 1						
				$upload_dir .= $code."/"; $cria = fGERAL::criaPasta($upload_dir, "0775"); //confere a criação e retona 1									
	
				fPROCESSO::criarEvento($class_fLNG->txt(__FILE__,__LINE__,'Processo Criado'),$class_fLNG->txt(__FILE__,__LINE__,'Processo criado na Auto Escola'),$cVLogin->userReg(),$cVLogin->getVarLogin("SYS_USER_CARGO"),$processo_id,$upload_dir);
	
				$upload_dir .= "files/"; $cria = fGERAL::criaPasta($upload_dir, "0775"); //confere a criação e retona 1					
	
	
				
				//########################################### iFRAME TEMP ####################################>>>>>>>>>>>>
				//verifica se existem arquivos temp no sistema
				$upload_dir_temp = VAR_DIR_FILES."files/temp/";
				$campos = "id,titulo,nome,arquivo";
				$tabela = "sys_arquivos_temp";
				$where = "acao = '".$array_temp."' AND form = 'docPessoal".$array_temp."' AND usuarios_id = '".$cVLogin->getVarLogin("SYS_USER_ID")."'";
				//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
				$resu1 = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "");
				while($linha = fSQL::FETCH_ASSOC($resu1)){
					$id_e = $linha["id"];
					$titulo_e = $linha["titulo"];
					$nome_e = $linha["nome"];
					$arquivo_e = $linha["arquivo"];
					if(file_exists($upload_dir_temp.$arquivo_e)){
		
						//preparando o envio do arquivo temp para o definitivo
						$campos = "processo_id,tipo_id,tipo_campo,nome,valor,user,time";
						$valores = array($processo_id,"33","9","DOCUMENT PERSONNEL AVEC PHOTO",$arquivo_e,$cVLogin->userReg(),time());
						fSQL::SQL_INSERT_SIMPLES($campos,"axl_processo_campos",$valores);					
						
						//move o arquivo para o novo local e exclue o temp
						rename($upload_dir_temp.$arquivo_e, $upload_dir.$arquivo_e);
						//exclue o registro
						$tabela = "sys_arquivos_temp";
						fSQL::SQL_DELETE_SIMPLES($tabela, "id = '$id_e'");
					}//fim if(file_exists($upload_dir_temp.$arquivo_e)){
				}//fim while
				//########################################### iFRAME TEMP ####################################<<<<<<<<<<<		
				
				
				
				
				//########################################### iFRAME TEMP ####################################>>>>>>>>>>>>
				//verifica se existem arquivos temp no sistema
				$upload_dir_temp = VAR_DIR_FILES."files/temp/";
				$campos = "id,titulo,nome,arquivo";
				$tabela = "sys_arquivos_temp";
				$where = "acao = '".$array_temp."' AND form = 'compEnd".$array_temp."' AND usuarios_id = '".$cVLogin->getVarLogin("SYS_USER_ID")."'";
				//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
				$resu1 = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "");
				while($linha = fSQL::FETCH_ASSOC($resu1)){
					$id_e = $linha["id"];
					$titulo_e = $linha["titulo"];
					$nome_e = $linha["nome"];
					$arquivo_e = $linha["arquivo"];
					if(file_exists($upload_dir_temp.$arquivo_e)){
		
						//preparando o envio do arquivo temp para o definitivo
						$campos = "processo_id,tipo_id,tipo_campo,nome,valor,user,time";
						$valores = array($processo_id,"39","9","ADRESSE DU COMPOSANT",$arquivo_e,$cVLogin->userReg(),time());
						fSQL::SQL_INSERT_SIMPLES($campos,"axl_processo_campos",$valores);					
						
						//move o arquivo para o novo local e exclue o temp
						rename($upload_dir_temp.$arquivo_e, $upload_dir.$arquivo_e);
						//exclue o registro
						$tabela = "sys_arquivos_temp";
						fSQL::SQL_DELETE_SIMPLES($tabela, "id = '$id_e'");
					}//fim if(file_exists($upload_dir_temp.$arquivo_e)){
				}//fim while
				//########################################### iFRAME TEMP ####################################<<<<<<<<<<<							
				
				fSQL::SQL_UPDATE_SIMPLES("status,processo_id,processo_code,sync","axl_pgto_banco",array("1",$processo_id,$code,time()),"id = '".$pgto_id."'");
				
				$cMSG->addMSG("SUCESSO",$class_fLNG->txt(__FILE__,__LINE__,'Processo #!!numero!! criado com sucesso!',array("numero"=>$code))." <button type=\'button\' class=\'btn btn-circle btn-small\' onclick=\'imprimirRecibo".$INC_FAISHER["div"]."(\"".$code."\");return false;\'><i class=\'fa fa-print\'></i> LE REÇU</button>");	
			}//if($valida == ""){
			
		}else{//if($processo_id == ""){
			$linha = fSQL::SQL_SELECT_ONE("code,ano,mes,dia,servico_id,coleta_id,origem_id,status,suspensao_f","axl_processo","id = '".$processo_id."'");
			$code = $linha["code"];
			$ano = $linha["ano"];
			$mes = $linha["mes"];
			$dia = $linha["dia"];
			$servico_id = $linha["servico_id"];
			$coleta_id = $linha["coleta_id"];
			$origem_id = $linha["origem_id"];

			$fileCaminho = VAR_DIR_FILES."files/tabelas/axl_processo/".$ano."/".completa_zero($mes,"2")."/".completa_zero($dia,"2")."/".$code."/";

			fPROCESSO::criarEvento($class_fLNG->txt(__FILE__,__LINE__,'Certificado Auto Escola'),$class_fLNG->txt(__FILE__,__LINE__,'Anexado certificado da auta escola'),$cVLogin->userReg(),$cVLogin->getVarLogin("SYS_USER_CARGO"),$processo_id,$fileCaminho);
			
						
			//inserir certificado
			$file = md5(uniqid(time())).".pdf";
			//gerar arquivo >>>
			copy(VAR_DIR_FILES."files/templates/certificado.pdf",$fileCaminho."files/".$file);
			//gerar arquivo <<<
			$campos = "processo_id,tipo_id,tipo_campo,nome,valor,user,time";
			$valores = array($processo_id,"6","9","AGRÉÉ AUTO-ÉCOLE",$file,$cVLogin->userReg(),time());
			fSQL::SQL_INSERT_SIMPLES($campos,"axl_processo_campos",$valores);
			
			fSQL::SQL_UPDATE_SIMPLES("cfc","axl_processo",array($cVLogin->getVarLogin("SYS_USER_NOME")),"id = '".$processo_id."'");
			
			$valida = verificarAutorizacaoProcesso($processo_id);			
			if($valida == 1){
				//verificar se processo completo - autorizar impressão
				$linha = fSQL::SQL_SELECT_ONE("informacoes","adm_protocolo_tipo","id = '".$servico_id."'");
				$informacoes = arrayDB($linha["informacoes"]);
	
	
				//monta array
				unset($array); $array = explode(".",$informacoes);
				$cont_ARRAY = ceil(count($array));
				//listar item ja cadastrados
				if($cont_ARRAY >= "1"){
					foreach ($array as $pos => $tipo_id){
						$linhaxxx = fSQL::SQL_SELECT_ONE("id,obrigatorio","adm_protocolo_tipo_inf","id = '".$tipo_id."'");							
						if($linhaxxx["obrigatorio"] == "1"){
							$cont = fSQL::SQL_CONTAGEM("axl_processo_campos","processo_id = '".$processo_id."' AND tipo_id = '".$tipo_id."'");
							if($cont <= "0"){ $valida = "0"; break; }
						}//if($linhaxxx["obrigatorio"] == "1"){
					}//foreach ($array as $pos => $tipo_id){
				}//if($cont_ARRAY >= "1"){
				if($valida == "1"){
					if($coleta_id <= "0"){ $valida = "0"; }else{//if($coleta_id <= "0"){
						$linha = fSQL::SQL_SELECT_ONE("abis_status","axl_coleta_biometrica","id = '".$coleta_id."'");
						if($linha["abis_status"] != "1"){ $valida = "0"; }
					}//}else{//if($coleta_id <= "0"){
				}//if($valida == "1"){
			}
			//autorizar impressão
			$msg_ws = "";
			if($valida == "1"){
				fSQL::SQL_UPDATE_SIMPLES("status,sync","axl_processo",array("999",time()),"id = '".$processo_id."'");
				fPROCESSO::criarEvento($class_fLNG->txt(__FILE__,__LINE__,'Processo completo!'),$class_fLNG->txt(__FILE__,__LINE__,'Processo completo, aguardando liberação (CADAC).'),$cVLogin->userReg(),$cVLogin->getVarLogin("SYS_USER_CARGO"),$processo_id,$fileCaminho);
				$msg_ws = "<br><br>".$class_fLNG->txt(__FILE__,__LINE__,'PROCESSO COMPLETO, AGUARDANDO LIBERAÇÃO (CADAC)!');
				/*
				$result = thomasWSimpressaoEnviar($processo_id,$origem_id);
				if($result["codigo_retorno"] == "1"){ 
					$msg_ws = "<br><br>".$class_fLNG->txt(__FILE__,__LINE__,'PROCESSO FOI AUTORIZADO PARA IMPRESSÃO!');
					//criar evento
					fPROCESSO::criarEvento($class_fLNG->txt(__FILE__,__LINE__,'Autorização de Impressão'),$class_fLNG->txt(__FILE__,__LINE__,'Processo autorizado para impressão'),$cVLogin->userReg(),$cVLogin->getVarLogin("SYS_USER_CARGO"),$processo_id,$fileCaminho);
				}
				*/
			}//if($valida == "1"){


			$cMSG->addMSG("SUCESSO",$class_fLNG->txt(__FILE__,__LINE__,'Certificado do processo #!!numero!! foi gerado com sucesso.',array("numero"=>$code))).$msg_ws;	
		
		}//}else{//if($processo_id == ""){
		$candidato_id = "0"; $rnt = ""; $banco = ""; $pgto_num = ""; $pgto_id = ""; $processo_id = "";
	}//if(isset($_GET["salvar"])){


		
	$pgto_info = ""; $candidato_id = "0"; $candidato_id_n = ""; $code = "";
	if($rnt != ""){
		$valida = "";
		$linha = fSQL::SQL_SELECT_ONE("code","axl_processo","id = '".$processo_id."'");
		$code = $linha["code"];
		
		$linha = fSQL::SQL_SELECT_ONE("id,nome,sobrenome,suspensao_f","cad_candidato_fisico","code = '".$rnt."'");


		if($linha["suspensao_f"] > time()){
			$valida = $class_fLNG->txt(__FILE__,__LINE__,'Este candidato está suspenso até !!data!!',array("data"=>date("d/m/Y",$linha["suspensao_f"])));
		}//if($linha["suspensao_f"] > time()){	

		if($linha["id"] >= "1"){
			$candidato_id = $linha["id"];
			$arrDoc = docPessoaFisica($candidato_id);
			$candidato_id_n = SYS_CONFIG_RM_SIGLA." ".$rnt." - <b>".$linha["nome"]." ".$linha["sobrenome"]."</b><br><small>".$arrDoc["nome"]." ".$arrDoc["numero"]."</small>";			
		}else{//if($linha["id"] >= "1"){
			$valida .= "- ".$class_fLNG->txt(__FILE__,__LINE__,'Não foi encontrado nenhum candidato com !!sigla!! !!code!!',array("sigla"=>SYS_CONFIG_RM_SIGLA,"code"=>$rnt));
		}
		
		if($pgto_num != ""){
			$condicao = "numero = '$pgto_num' AND cod_banco = '$banco'";
			if($processo_id == ""){ $condicao .= " AND status = '0'"; }
			$linha = fSQL::SQL_SELECT_ONE("id,cod_banco,nome,sobrenome,valor,time_deposito","axl_pgto_banco",$condicao);
		
			if($linha["id"] >= "1"){
				$pgto_id = $linha["id"];
				$pgto_info = $linha["nome"]." ".$linha["sobrenome"];
				$pgto_info .= "<br>GNF $ ".formataValor($linha["valor"]);
				$pgto_info .= "<br>".date("d/m/Y H:i", $linha["time_deposito"]);
				$pgto_info .= "<br>".$class_fLNG->txt(__FILE__,__LINE__,'Banco').": ".legBanco($linha["cod_banco"]);
			}else{//if($linha["id"] >= "1"){
				if($valida != ""){ $valida .= "<br>"; }
				$valida .= "- ".$class_fLNG->txt(__FILE__,__LINE__,'Não foi encontrado nenhum dado de pagamento com este número')." (".$pgto_num.")";
			}//}else{//if($linha["id"] >= "1"){
	
			if($processo_id == "" and $candidato_id >= "1"){
				$condicao = "candidato_fisico_id = '".$candidato_id."' AND servico_id in ('13','14','15') AND status <= '5'";
				$cont_ = fSQL::SQL_CONTAGEM("axl_processo",$condicao);
				if($cont_ >= "1"){
					if($valida != ""){ $valida .= "<br>"; }
					$valida .= "- ".$class_fLNG->txt(__FILE__,__LINE__,'Este candidato já possui processo de habilitação/tombamento aberto, verifique!');				
				}//if($cont_ >= "1"){
			}//if($processo_id == ""){
		}
		
		if($valida != ""){
			$cMSG->addMSG("ERRO",$valida); 		
			$rnt = ""; $candidato_id = ""; $banco = ""; $pgto_num = "";
		}//if($valida != ""){
	}//if($rnt != ""){
	
	
	$cMSG->imprimirMSG("", "20000");//imprimir mensagens criadas	
	
    //id temp para registro de array
    $array_temp = time().rand(9,99999).$cVLogin->getVarLogin("SYS_USER_ID");
	$formCadastroSec = "formCadastroSec".$array_temp;		
	
/////////// INCLUDE JS EXCLUSIVO --------------------- 
$INC_JS = ",icheck,";//informar funcao a usar entre VIRGULAS > ,funcao
$INC_JSCSS = $INC_FAISHER["div"];
include "inc/inc_js-exclusivo.php";	


?>
<form id="<?=$formCadastroSec?>" name="<?=$formCadastroSec?>" action="#" method="POST" class='form-horizontal form-bordered form-validate'>


<?php if($rnt == "" || $pgto_info == ""){?>
    	<div class="control-group">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Candidato')?> - <?=SYS_CONFIG_RM_SIGLA?></label>
            <div class="controls">
            	<input type="text" name="rnt" id="rnt" value="<?=$rnt?>" class="cssFonteMai input-xlarge"/>            
                <button type="button" class="btn btn-info" onclick="consultarCandidato<?=$INC_FAISHER["div"]?>();return false;"><i class="icon-search"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Consultar')?></button>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Banco')?></label>
            <div class="controls">
                <select name="banco" id="banco" style="width:98%">
                    <option value="" <?php if($banco == ""){ echo 'selected'; }?>><?=$class_fLNG->txt(__FILE__,__LINE__,'Selecione o banco...')?></option>
             <?php 
                $cont = "0";
                while(true){ $cont++;
                    $leg = legBanco($cont);
                    if($leg == ""){ break; }
             ?>
                    <option value="<?=$cont?>" <?php if($banco == $cont){ echo 'selected';}?>><?=$leg?></option>
             <?php
                }//while(true){
             ?>
                </select>
            </div>
        </div>  
        <div class="control-group">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Nº Pagamento')?></label>
            <div class="controls">
                <input type="text" id="pgto_num" name="pgto_num" value="<?=$pgto_num?>" style="width:98%"/>
            </div>
        </div>        
        <div class="form-actions">
            <button type="button" class="btn btn-large btn-primary" onclick="validarDados<?=$INC_FAISHER["div"]?>();return false;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Validar dados')?></button>
            <button type="button" class="btn btn-large" data-dismiss="modal"><?=$class_fLNG->txt(__FILE__,__LINE__,'Cancelar')?></button>
        </div>        
<?php }else{//if($rnt == "" || $pgto_info == ""){?>                                     

		<div class="control-group">
            <label class="control-label"><?=SYS_CONFIG_PROCESSO_SIGLA?></label>
            <div class="controls display-plus">
            	<?=$code == '' ? $class_fLNG->txt(__FILE__,__LINE__,'NOVO') : $code ?>
            </div>
        </div>

		<div class="control-group">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Candidato')?></label>
            <div class="controls">
            	<?=$candidato_id_n?>
            </div>
        </div>
        
		<div class="control-group">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Pagamento')?></label>
            <div class="controls">
            	<?=$pgto_info?>
            </div>
        </div> 
	<?php if($processo_id == ""){?>
    
        <div class="control-group">
            <label class="control-label">Document Personnel Avec Photo</label>
            <div class="controls">
            <input name="cont_f1" id="cont_f1" type="hidden" value="0"/>
            <?php
            //montar IFRAME
            $idTemp = $array_temp;//id do retorno
            $idIframe = "docPessoal".$array_temp;//id do iframe
            $arqTipo = "pdf";//tipos de arquivos
            $n_arqQtd = "2";//quantidade de arquivos maximo
            $desc = "0";//ativar descicao, 1 ligado, 0 desligado
            $funcao = "confUp1".$INC_FAISHER["div"];//ativar funcao java con retorno de QTD enviados
            ?>
              <iframe name="<?=$idIframe?>" style="border:0; overflow:hidden;" src="geral/upload_iframe.php?idTemp=<?=$idTemp?>&idIframe=<?=$idIframe?>&arq=<?=$arqTipo?>&n_arq=<?=$n_arqQtd?>&desc=<?=$desc?>&funcao=<?=$funcao?>" frameborder="0"  scrolling="no"  id="<?=$idIframe?>" width="100%" height="100%"> </iframe>
<script>                                
function confUp1<?=$INC_FAISHER["div"]?>(v_retorno){
	if(v_retorno >= "1"){ $('#<?=$formCadastroSec?> #cont_f1').val(v_retorno); }else{ $('#<?=$formCadastroSec?> #cont_f1').val("0"); }
}//confUp1
</script>
            </div>
        </div>  
        
        <div class="control-group">
            <label class="control-label">Adresse Du Composant</label>
            <div class="controls">
            <input name="cont_f2" id="cont_f2" type="hidden" value="0"/>
            <?php
            //montar IFRAME
            $idTemp = $array_temp;//id do retorno
            $idIframe = "compEnd".$array_temp;//id do iframe
            $arqTipo = "pdf";//tipos de arquivos
            $n_arqQtd = "2";//quantidade de arquivos maximo
            $desc = "0";//ativar descicao, 1 ligado, 0 desligado
            $funcao = "confUp2".$INC_FAISHER["div"];//ativar funcao java con retorno de QTD enviados
            ?>
              <iframe name="<?=$idIframe?>" style="border:0; overflow:hidden;" src="geral/upload_iframe.php?idTemp=<?=$idTemp?>&idIframe=<?=$idIframe?>&arq=<?=$arqTipo?>&n_arq=<?=$n_arqQtd?>&desc=<?=$desc?>&funcao=<?=$funcao?>" frameborder="0"  scrolling="no"  id="<?=$idIframe?>" width="100%" height="100%"> </iframe>
<script>                                
function confUp2<?=$INC_FAISHER["div"]?>(v_retorno){
	if(v_retorno >= "1"){ $('#<?=$formCadastroSec?> #cont_f2').val(v_retorno); }else{ $('#<?=$formCadastroSec?> #cont_f2').val("0"); }
}//confUp2
</script>
            </div>
        </div>           
    
		<div class="control-group">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Categorias')?></label>
            <div class="controls">
            	<table id="tabela_categorias<?=$INC_FAISHER["div"]?>" class="table table-hover table-bordered" style="margin-top:0;">
                	<thead>
                    	<tr>
                        	<th></th>
                            <th><?=$class_fLNG->txt(__FILE__,__LINE__,'Categoria')?></th>
                            <!--<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Data de Obtenção')?></th>-->
                        </tr>
                    </thead>
                    <tbody>
						<?php $valor = "A"; ?>
                        <tr>
                        	<td><input name="cat_<?=$valor?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck it_check_css' id="cat_<?=$valor?>" value="<?=$valor?>" data-skin="square" data-color="blue"></td>
                            <td><b><?=$valor?></b></td>
                            <!--<td><span id="cat_data_<?=$valor?>">-</span></td>-->
                        </tr>
						<?php $valor = "A1"; ?>
                        <tr>
                        	<td><input name="cat_<?=$valor?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck it_check_css' id="cat_<?=$valor?>" value="<?=$valor?>" data-skin="square" data-color="blue"></td>
                            <td><b><?=$valor?></b></td>
                            <!--<td><span id="cat_data_<?=$valor?>">-</span></td>-->
                        </tr>                        
						<?php $valor = "B"; ?>
                        <tr>
                        	<td><input name="cat_<?=$valor?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck it_check_css' id="cat_<?=$valor?>" value="<?=$valor?>" data-skin="square" data-color="blue"></td>
                            <td><b><?=$valor?></b></td>
                            <!--<td><span id="cat_data_<?=$valor?>">-</span></td>-->
                        </tr>
                    </tbody>
                </table>
            </div>
        </div> 
<script>
$(document).ready(function(e) {
    $("#<?=$formCadastroSec?> .it_check_css").on("change", function(){
		if($(this).is(':checked')){
			var d = new Date();
			var date = d.getDate() + "/" + d.getMonth() + "/" + d.getFullYear();
			$("#<?=$formCadastroSec?> #cat_data_"+$(this).val()).html(date);
		}else{//if($(this).is(':checked')){
			$("#<?=$formCadastroSec?> #cat_data_"+$(this).val()).html("-");
		}//}else{//if($(this).is(':checked')){
	});
});
</script>                
	<?php }//if($processo_id == ""){?>
    
    
    
    
    
    
    
    
    
<?php 
	if($processo_id != ""){
		$linha = fSQL::SQL_SELECT_ONE("code,ano,mes,dia","axl_processo","id = '".$processo_id."'");
		$caminho_file = VAR_DIR_FILES."files/tabelas/axl_processo/".$linha["ano"]."/".completa_zero($linha["mes"],"2")."/".completa_zero($linha["dia"],"2")."/".$linha["code"]."/files/";
		//pegar documento
		$resu = fSQL::SQL_SELECT_SIMPLES("id,valor,nome","axl_processo_campos","processo_id = '".$processo_id."' AND tipo_id in ('33','39')");
		while($linha = fSQL::FETCH_ASSOC($resu)) {
?>
        <div class="control-group">
            <label class="control-label"><?=$linha["nome"]?></label>
            <div class="controls">
                <a href="img.php?<?=$cVLogin->imgFile($caminho_file.$linha["valor"], "full")?>" rel="prettyPhoto[gallery<?=$linha["id"]?>]" id="iimg_<?=$linha["id"]?>"><?=$cVLogin->icoFile($caminho_file.$linha["valor"], "")?></a>
                <a href="#" onclick="$('#iimg_<?=$linha["id"]?>').click();return false;" class="btn" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Visualizar')?>"><i class="icon-search"></i></a>
            </div>
        </div> 
<?php			
		}//fim while
?> 

		<div class="control-group">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Categorias')?></label>
            <div class="controls">
            	<table id="tabela_categorias<?=$INC_FAISHER["div"]?>" class="table table-hover table-bordered" style="margin-top:0;">
                	<thead>
                    	<tr>
                            <th><?=$class_fLNG->txt(__FILE__,__LINE__,'Categoria')?></th>
                        </tr>
                    </thead>
                    <tbody>
<?php
		$resu = fSQL::SQL_SELECT_SIMPLES("nome,valor","axl_processo_campos","processo_id = '".$processo_id."' AND tipo_campo = '99'");
		while($linha = fSQL::FETCH_ASSOC($resu)){
?>                    
                        <tr>
                        	<td><b><?=$linha["nome"]?></b></td>
                        </tr>
<?php
		}//fim while
?>
                    </tbody>
                </table>
            </div>
        </div>     
    
    
        <?php if($visualizar == ""){?>
        <div class="control-group">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Termo')?></label>
            <div class="controls">                                        
                <div class="check-line">
                    <input name="termo" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="termo" value="1" data-skin="square" data-color="blue"> <label class='inline display' for="termo"><?=$class_fLNG->txt(__FILE__,__LINE__,'Declaro que o candidato realizou todas as aulas e certifico de que o mesmo possui a habilidade necessária para adquirir a permissão de condução.')?></label>
                </div>
            </div>
        </div>         
        <?php }//if($visualizar == ""){?>        
	<?php }//if($processo_id != ""){?>        
    
    
        <div class="form-actions">
            <?php if($visualizar == ""){?>
            	<button type="button" class="btn btn-large btn-primary" onclick="abrirProcesso<?=$INC_FAISHER["div"]?>();return false;"><?php if($processo_id == ""){?><?=$class_fLNG->txt(__FILE__,__LINE__,'Abrir Processo')?><?php }else{?><?=$class_fLNG->txt(__FILE__,__LINE__,'Encaminhar para unidade')?><?php }?></button>
                <button type="button" class="btn btn-large" data-dismiss="modal"><?=$class_fLNG->txt(__FILE__,__LINE__,'Cancelar')?></button>
			<?php }else{//if($visualizar == ""){?>
            	<button type="button" class="btn btn-large btn-primary" onclick="imprimirCapaProcesso<?=$INC_FAISHER["div"]?>('<?=$code?>');return false;"><i class="icon-print"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Capa do Processo')?></button>
                <button type="button" class="btn btn-large btn-primary" onclick="imprimirProcessoFull<?=$INC_FAISHER["div"]?>('<?=$code?>');return false;"><i class="icon-print"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Processo Completo')?></button>
                <button type="button" class="btn btn-large" data-dismiss="modal"><?=$class_fLNG->txt(__FILE__,__LINE__,'Fechar')?></button>
            <?php }//}else{//if($visualizar == ""){?>    
            
        </div> 






<?php }//else{//if($candidato_fisico_id == ""){?>
</form>        
<script>
function consultarCandidato<?=$INC_FAISHER["div"]?>(){
	pmodalHtml('<i class=icon-search></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'CONSULTAR CANDIDATO')?>','<?=$AJAX_PAG?>','get','faisher=<?=$faisher?>&ajax=consultarCandidato&array_temp=<?=$array_temp?>');	    
}

function validarDados<?=$INC_FAISHER["div"]?>(){
	v_rnt = $("#<?=$formCadastroSec?> #rnt").val();
	v_pgto_num = $("#<?=$formCadastroSec?> #pgto_num").val();
	v_banco = $("#<?=$formCadastroSec?> #banco").val();	
	
	valida = "";
	if(v_rnt == ""){ valida = "<?=$class_fLNG->txt(__FILE__,__LINE__,'!!sigla!! do candidato deve ser informado!',array("sigla"=>SYS_CONFIG_RM_SIGLA))?>"; }
	if(v_banco == ""){ valida = "<?=$class_fLNG->txt(__FILE__,__LINE__,'Banco deve ser preenchido!')?>"; }
	if(v_pgto_num == ""){ valida = "<?=$class_fLNG->txt(__FILE__,__LINE__,'Nº pagamento deve ser preenchido!')?>"; }	
	
	if(valida != ""){ alert(valida); }else{//if(valida != ""){
		faisher_ajax('pModalConteudoOn', 'pModalLoader', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=novaHabilitacao&rnt='+v_rnt+'&banco='+v_banco+'&pgto_num='+v_pgto_num, 'get', 'ADD');
	}//}else{//if(valida != ""){
}//validarDados

function abrirProcesso<?=$INC_FAISHER["div"]?>(){
	var v_get = "&candidato_id=<?=$candidato_id?>&banco=<?=$banco?>&pgto_id=<?=$pgto_id?>&pgto_num=<?=$pgto_num?>&processo_id=<?=$processo_id?>&array_temp=<?=$array_temp?>";
	cont_categoria = "0";
	if($("#<?=$formCadastroSec?> #cat_A").is(':checked')){ cont_categoria++; var v_get = v_get+'&cat_A=1'; }
	if($("#<?=$formCadastroSec?> #cat_A1").is(':checked')){ cont_categoria++; var v_get = v_get+'&cat_A1=1'; }	
	if($("#<?=$formCadastroSec?> #cat_B").is(':checked')){ cont_categoria++; var v_get = v_get+'&cat_B=1'; }		
	v_cont_f1 = $("#<?=$formCadastroSec?> #cont_f1").val();
	v_cont_f2 = $("#<?=$formCadastroSec?> #cont_f2").val();
	
	
	
	valida = "";	
<?php 
if($processo_id >= "1"){
?> 
	if(!$("#<?=$formCadastroSec?> #termo").is(':checked')){ valida = "<?=$class_fLNG->txt(__FILE__,__LINE__,'Para abertura do processo, o termo deve ser aceito!')?>"; } 
<?php 
}else{
?>
	if(cont_categoria == "0"){ valida = "<?=$class_fLNG->txt(__FILE__,__LINE__,'Necessário escolher pelo menos uma categoria de condução!')?>"; }
	if(v_cont_f1 <= "0" && valida == ""){ valida = "<?=$class_fLNG->txt(__FILE__,__LINE__,'Necessário enviar o documento pessoal do candidato.')?>"; }	
	if(v_cont_f2 <= "0" && valida == ""){ valida = "<?=$class_fLNG->txt(__FILE__,__LINE__,'Necessário enviar o comprovante de endereço do candidato.')?>"; }	
<?php 
}//else{
?>	
	

	
	if(valida != ""){ alert(valida); }else{//if(valida != ""){
		if(confirm("<?=$class_fLNG->txt(__FILE__,__LINE__,'Confirma abertura do processo utilizando estes dados?')?>")) {	
			
			faisher_ajax('pModalConteudoOn', 'pModalLoader', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=novaHabilitacao&salvar=1'+v_get, 'get', 'ADD');
		}
	}//}else{//if(valida != ""){	
}//abrirProcesso
</script>
<?php	
}//if($ajax == "novaHabilitacao"){





























if($ajax == "consultarCandidato"){
	$array_temp = getpost_sql($_GET["array_temp"]);
	if(isset($_GET["doc_tipo"])){ $doc_tipo = getpost_sql($_GET["doc_tipo"]); }else{ $doc_tipo = ""; }
	if(isset($_GET["doc_numero"])){ $doc_numero = getpost_sql($_GET["doc_numero"]); }else{ $doc_numero = ""; }	
	if(isset($_GET["datan"])){ $datan = getpost_sql($_GET["datan"]); }else{ $datan = ""; }	

	
	
if($doc_numero != ""){

?>
<form class='form-horizontal form-column form-bordered' onsubmit="return false;">
    <div class="col-md-12">
        <table class="table table-hover table-bordered" style="margin-top:0;">
            <thead>
                <tr>
                    <th><?=SYS_CONFIG_RM_SIGLA?></th>
                    <th><?=$class_fLNG->txt(__FILE__,__LINE__,'Candidato')?></th>                
                    <th><?=$class_fLNG->txt(__FILE__,__LINE__,'Ação')?></th>                
                </tr>
            </thead>
            <tbody>
<?php	
	$cont = "0";
	$condicao = "rg = '".$doc_numero."'";
	if($doc_tipo == "PASSAPORTE"){ $condicao = "passaporte = '".$doc_numero."'"; }
	if($doc_tipo == "ID ESTRANGEIRO"){ $condicao = "id_estrangeiro = '".$doc_numero."'"; }
	$condicao .= " AND datan = '".data_mysql($datan)."'";
	$resu = fSQL::SQL_SELECT_SIMPLES("id,code,nome,sobrenome","cad_candidato_fisico",$condicao);
	while($linha = fSQL::FETCH_ASSOC($resu)){ $cont++;
		$id = $linha["id"];
		$code = $linha["code"];		
		$nome = $linha["nome"];
		$sobrenome = $linha["sobrenome"];
?>
                <tr>
                    <td><?=$code?></td>
                    <td><?=$nome?> <?=$sobrenome?><br><small><?=$doc_tipo?> <?=$doc_numero?></small></td>
                    <td><button type="button" class="btn btn-primary" onclick="novaHabilitacao<?=$INC_FAISHER["div"]?>('rnt=<?=$code?>');return false;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Selecionar')?> <i class="icon-chevron-right"></i></button></td>
                </tr>
<?php		
	}//fim while
	if($cont == "0"){
?>
				<tr><td><div style="padding:20px;"><i class="icon-info-sign"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Nenhum candidato localizado com este nº documento e data de nascimento.')?></div></td></tr>
<?php		
	}
?>
            </tbody>
        </table>
    </div>
 	 	<div class="form-actions">
        	<button type="button" class="btn btn-large btn-info" onclick="consultarCandidato<?=$INC_FAISHER["div"]?>();return false;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Tentar novamente')?></button>
            <button type="button" class="btn btn-large" onclick="pmodalDisplay('hide')"><?=$class_fLNG->txt(__FILE__,__LINE__,'Fechar')?></button>
		</div>     
</form>    
<?php
	
}//if($doc_numero != ""){
?>




<?php 
if($doc_numero == ""){

    //id temp para registro de array
	$formSec = "formSec".time().rand(9,99999).$cVLogin->getVarLogin("SYS_USER_ID");;	
		
/////////// INCLUDE JS EXCLUSIVO --------------------- 
$INC_JS = ",icheck,";//informar funcao a usar entre VIRGULAS > ,funcao
$INC_JSCSS = $INC_FAISHER["div"]."bp";
include "inc/inc_js-exclusivo.php";		
?>
<form id="<?=$formSec?>" class='form-horizontal form-column form-bordered' onsubmit="return false;">
        <div class="control-group">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Tipo do documento')?></label>
            <div class="controls">
                <div class="check-line">
                    <input name="doc_tipo" type="radio" class='<?=$INC_FAISHER["div"]?>bp-icheck' id="doc_tipo1" value="<?=$class_fLNG->txt(__FILE__,__LINE__,'IDENTIDADE')?>" data-skin="square" data-color="blue" checked="checked"> <label class='inline' for="doc_tipo1"><?=$class_fLNG->txt(__FILE__,__LINE__,'Identidade')?></label>
                </div>
                <div class="check-line">
                    <input name="doc_tipo" type="radio" class='<?=$INC_FAISHER["div"]?>bp-icheck' id="doc_tipo2" value="<?=$class_fLNG->txt(__FILE__,__LINE__,'PASSAPORTE')?>" data-skin="square" data-color="blue"> <label class='inline' for="doc_tipo2"><?=$class_fLNG->txt(__FILE__,__LINE__,'Passaporte')?></label>
                </div>
                <div class="check-line">
                    <input name="doc_tipo" type="radio" class='<?=$INC_FAISHER["div"]?>bp-icheck' id="doc_tipo3" value="<?=$class_fLNG->txt(__FILE__,__LINE__,'ID ESTRANGEIRO')?>" data-skin="square" data-color="blue"> <label class='inline' for="doc_tipo3"><?=$class_fLNG->txt(__FILE__,__LINE__,'ID Estrangeiro')?></label>
                </div>                
            </div>
        </div>
        <div class="control-group">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Nº do documento')?></label>
            <div class="controls">
            	<input type="text" class="input-medium cssFonteMai" id="doc_numero" name="doc_numero"/>
            </div>
        </div>        
        <div class="control-group">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Data de nascimento')?></label>
            <div class="controls">
            	<input type="text" class="input-small mask_date" id="datan" name="datan"/>
            </div>
        </div>        
 	 	<div class="form-actions">
            <button type="button" class="btn btn-large btn-primary" onclick="buscarCandidato<?=$INC_FAISHER["div"]?>();return false;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Consultar Candidato')?> <img src="img/ajax-qloader-preto-p.gif" width="18" height="18" style="display:none;" id="loadCandidato<?=$INC_FAISHER["div"]?>" /></button>
            <button type="button" class="btn btn-large" onclick="pmodalDisplay('hide')"><?=$class_fLNG->txt(__FILE__,__LINE__,'Fechar')?></button>
		</div> 

</form>
<?php }//if($doc_numero == ""){?>



<script>
function consultarCandidato<?=$INC_FAISHER["div"]?>(){
	pmodalHtml('<i class=icon-search></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'CONSULTAR CANDIDATO')?>','<?=$AJAX_PAG?>','get','faisher=<?=$faisher?>&ajax=consultarCandidato&array_temp=<?=$array_temp?>');	    
}
function buscarCandidato<?=$INC_FAISHER["div"]?>(){
	v_doc_tipo = $("#<?=$formSec?> input[name='doc_tipo']:checked").val();
	v_doc_numero = $("#<?=$formSec?> #doc_numero").val();
	v_datan = $("#<?=$formSec?> #datan").val();
	
	var valida = "";
	if(v_doc_numero == ""){ valida = "<?=$class_fLNG->txt(__FILE__,__LINE__,'É obrigatório informar o nº do documento do candidato!')?>"; }
	if(v_datan == ""){ valida = "<?=$class_fLNG->txt(__FILE__,__LINE__,'É obrigatório informar a data de nascimento do candidato!')?>"; }	
	
	if(valida != ""){ alert(valida); }else{
		faisher_ajax('pModalConteudoOn', 'loadCandidato<?=$INC_FAISHER["div"]?>', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=consultarCandidato&array_temp=<?=$array_temp?>&doc_tipo='+v_doc_tipo+'&doc_numero='+v_doc_numero+'&datan='+v_datan, 'get', 'ADD');		
	}
}//buscarCandidato
</script>    
<?php		
}//consultarCandidato












































if($ajax == "exameMedico"){
	if(isset($_GET["code"])){ $code = getpost_sql($_GET["code"]); }else{ $code = ""; }
	if(isset($_GET["array_temp"])){ $array_temp = getpost_sql($_GET["array_temp"]); }else{ $array_temp = ""; }
	if(isset($_GET["restricoes"])){ $restricoes = getpost_sql($_GET["restricoes"]); }else{ $restricoes = ""; }
	if(isset($_GET["resultado"])){ $resultado = getpost_sql($_GET["resultado"]); }else{ $resultado = ""; }
	
	if($array_temp != ""){
		$linha = fSQL::SQL_SELECT_ONE("id,ano,mes,dia,servico_id,coleta_id,origem_id,externo","axl_processo","code = '".$code."'");
		$processo_id = $linha["id"];
		$servico_id = $linha["servico_id"];
		$coleta_id = $linha["coleta_id"];
		$origem_id = $linha["origem_id"];
		$ano = $linha["ano"];
		$mes = $linha["mes"];
		$dia = $linha["dia"];
		$externo = $linha["externo"];
		
		$upd_campos = "medico";
		$upd_valores = array($cVLogin->getVarLogin("SYS_USER_NOME"));
		
		$evento_msg = $class_fLNG->txt(__FILE__,__LINE__,'Exame médico anexado (APTO)');
		if($resultado == "0"){ //inapto
			$evento_msg = $class_fLNG->txt(__FILE__,__LINE__,'Exame médico anexado (INAPTO)');
			$status = "11";//cancelar processo 
			$upd_campos .= ",status,sync,usar_a";
			$upd_valores[] = $status; $upd_valores[] = time(); $upd_valores[] = $cVLogin->userReg();
		}		

		if($restricoes != ""){
			$evento_msg .= " - ".$class_fLNG->txt(__FILE__,__LINE__,'Com restrições');
			$restricoes = "[,".$restricoes.",]";
			$campos = "processo_id,tipo_id,tipo_campo,nome,valor,user,time";
			$valores = array($processo_id,"7","80","RESTRICTIONS MÉDICALES",$restricoes,$cVLogin->userReg(),time());
			fSQL::SQL_INSERT_SIMPLES($campos,"axl_processo_campos",$valores);			
		}//if($restricoes != ""){

		$upload_dir = VAR_DIR_FILES."files/tabelas/axl_processo/".$ano."/".completa_zero($mes,"2")."/".completa_zero($dia,"2")."/".$code."/";

		//criar evento
		fPROCESSO::criarEvento($class_fLNG->txt(__FILE__,__LINE__,'Exame Médico'),$evento_msg,$cVLogin->userReg(),$cVLogin->getVarLogin("SYS_USER_CARGO"),$processo_id,$upload_dir);				
		//########################################### iFRAME TEMP ####################################>>>>>>>>>>>>
		//verifica se existem arquivos temp no sistema
		
		$upload_dir_temp = VAR_DIR_FILES."files/temp/";
		$campos = "id,titulo,nome,arquivo";
		$tabela = "sys_arquivos_temp";
		$where = "acao = '".$array_temp."' AND form = 'examePDF".$array_temp."' AND usuarios_id = '".$cVLogin->getVarLogin("SYS_USER_ID")."'";
		//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
		$resu1 = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "");
		while($linha = fSQL::FETCH_ASSOC($resu1)){
			$id_e = $linha["id"];
			$titulo_e = $linha["titulo"];
			$nome_e = $linha["nome"];
			$arquivo_e = $linha["arquivo"];
			if(file_exists($upload_dir_temp.$arquivo_e)){

				//preparando o envio do arquivo temp para o definitivo
				$campos = "processo_id,tipo_id,tipo_campo,nome,valor,user,time";
				$valores = array($processo_id,"4","9","RAPPORT D'EXAMEN MÉDICAL",$arquivo_e,$cVLogin->userReg(),time());
				fSQL::SQL_INSERT_SIMPLES($campos,"axl_processo_campos",$valores);					
				
				//move o arquivo para o novo local e exclue o temp
				rename($upload_dir_temp.$arquivo_e, $upload_dir."files/".$arquivo_e);
				//exclue o registro
				$tabela = "sys_arquivos_temp";
				fSQL::SQL_DELETE_SIMPLES($tabela, "id = '$id_e'");
			}//fim if(file_exists($upload_dir_temp.$arquivo_e)){
		}//fim while
		
		
		fSQL::SQL_UPDATE_SIMPLES($upd_campos,"axl_processo",$upd_valores,"id = '".$processo_id."'");
		
		//verificar se processo completo - autorizar impressão
		if($resultado >= "1"){
			$valida = verificarAutorizacaoProcesso($processo_id);
			if($valida == 1){
				$linha = fSQL::SQL_SELECT_ONE("informacoes","adm_protocolo_tipo","id = '".$servico_id."'");
				$informacoes = arrayDB($linha["informacoes"]);
	
				//monta array
				unset($array); $array = explode(".",$informacoes);
				$cont_ARRAY = ceil(count($array));
				//listar item ja cadastrados
				if($cont_ARRAY >= "1"){
					foreach ($array as $pos => $tipo_id){
						$linhaxxx = fSQL::SQL_SELECT_ONE("id,obrigatorio","adm_protocolo_tipo_inf","id = '".$tipo_id."'");							
						if($linhaxxx["obrigatorio"] == "1"){
							$cont = fSQL::SQL_CONTAGEM("axl_processo_campos","processo_id = '".$processo_id."' AND tipo_id = '".$tipo_id."'");
							if($cont <= "0"){ $valida = "0"; break; }
						}//if($linhaxxx["obrigatorio"] == "1"){
					}//foreach ($array as $pos => $tipo_id){
				}//if($cont_ARRAY >= "1"){
			}
			if($valida == "1"){
				if($coleta_id <= "0"){ $valida = "0"; }else{//if($coleta_id <= "0"){
					$linha = fSQL::SQL_SELECT_ONE("abis_status","axl_coleta_biometrica","id = '".$coleta_id."'");
					if($linha["abis_status"] != "1"){ $valida = "0"; }
				}//}else{//if($coleta_id <= "0"){
			}//if($valida == "1"){
				
			
			//autorizar impressão
			$msg_ws = "";
			if($valida == "1"){
				if($externo == 1){
					fSQL::SQL_UPDATE_SIMPLES("status,sync","axl_processo",array("999",time()),"id = '".$processo_id."'");
					fPROCESSO::criarEvento($class_fLNG->txt(__FILE__,__LINE__,'Processo completo!'),$class_fLNG->txt(__FILE__,__LINE__,'Processo completo, aguardando liberação (CADAC).'),$cVLogin->userReg(),$cVLogin->getVarLogin("SYS_USER_CARGO"),$processo_id,$upload_dir);
					$msg_ws = "<br><br>".$class_fLNG->txt(__FILE__,__LINE__,'PROCESSO COMPLETO, AGUARDANDO LIBERAÇÃO (CADAC)!');
				}else{
					$result = thomasWSimpressaoEnviar($processo_id,$origem_id);
					if($result["codigo_retorno"] == "1"){ 
						$msg_ws = "<br><br>".$class_fLNG->txt(__FILE__,__LINE__,'PROCESSO FOI AUTORIZADO PARA IMPRESSÃO!');
						
						fPROCESSO::criarEvento($class_fLNG->txt(__FILE__,__LINE__,'Autorização de Impressão'),$class_fLNG->txt(__FILE__,__LINE__,'Processo foi autorizado para impressão na consulta médica'),$cVLogin->userReg(),$cVLogin->getVarLogin("SYS_USER_CARGO"),$processo_id,$upload_dir);			
					}					
				}
			}//if($valida == "1"){
			
		}else{//if($resultado >= "1"){
			//criar evento
			fPROCESSO::criarEvento($class_fLNG->txt(__FILE__,__LINE__,'Processo Cancelado'),$class_fLNG->txt(__FILE__,__LINE__,'Processo cancelado por inaptidão do candidato'),$cVLogin->userReg(),$cVLogin->getVarLogin("SYS_USER_CARGO"),$processo_id,$upload_dir);			
		}
		
		//########################################### iFRAME TEMP ####################################<<<<<<<<<<<				
		$cMSG->addMSG("SUCESSO",$class_fLNG->txt(__FILE__,__LINE__,'Exame médico anexado ao processo #!!numero!! com sucesso!',array("numero"=>$code))).$msg_ws;
		$code = "";	
	}//if($array_temp != ""){
	
	
	
	if($code != ""){
		$linha = fSQL::SQL_SELECT_ONE("id,candidato_fisico_id,tipo_servico,servico_id,time,status,suspensao_f","axl_processo","code = '".$code."' AND servico_id = '14'");
		$valida = "";
		if($linha["id"] >= "1"){
			$processo_id = $linha["id"];
			$tipo_servico = $linha["tipo_servico"];
			$time = $linha["time"];
			$servico_id = $linha["servico_id"];
			$candidato_fisico_id = $linha["candidato_fisico_id"];
			
			if($linha["suspensao_f"] >= time()){
				$valida = $class_fLNG->txt(__FILE__,__LINE__,'Este processo está suspenso até !!data!!. Não é possível realizar atendimento de processo suspenso.',array("data"=>$linha["suspensao_f"]));
			}//if($arrPro["suspensao_f"] >= time()){
			
			if($linha["status"] >= "6"){
				$valida = $class_fLNG->txt(__FILE__,__LINE__,'Este processo foi cancelado! Não é possível realizar atendimento de processo cancelado.');					
			}					
			
			
			if(!in_array($linha["status"],[0,1])){
				$valida = $class_fLNG->txt(__FILE__,__LINE__,'Este processo não está em fase de realização de exame médico!');					
			}			

			
			$qtd = fSQL::SQL_CONTAGEM("axl_processo_campos","processo_id = '".$processo_id."' AND tipo_id = '4'");
			if($qtd >= "1"){ 
				$valida = $class_fLNG->txt(__FILE__,__LINE__,'Este processo (#!!numero!!) já possui laudo de exame médico.',array("numero"=>$code)); 
				$code = "";
			}
			if($valida == ""){//
				$linha2 = fSQL::SQL_SELECT_ONE("nome","adm_protocolo_tipo","id = '".$servico_id."'");
				$servico_id_n = $linha2["nome"];
				$processo_n = '<ul class="stats"><li class="white"><i class="'.categoriaServicoIco($tipo_servico).'" style="color:black;"></i><div class="details"><span class="big" style="color:black;">'.maiusculo(categoriaServicoLeg($tipo_servico)).' - '.$servico_id_n.'</span><span style="color:black;">'.SYS_CONFIG_PROCESSO_SIGLA." ".$code." - ".$class_fLNG->txt(__FILE__,__LINE__,'solicitado em !!data!!',array("data"=>date("d/m/Y", $time)));
				
				$linha2 = fSQL::SQL_SELECT_ONE("code,nome,sobrenome,datan,nacionalidade,mae,localn","cad_candidato_fisico","id = '$candidato_fisico_id'");
				$arrDoc = docPessoaFisica($candidato_fisico_id);
				$pessoa_n = $cVLogin->popDetalhes("C",$candidato_fisico_id,"3_con_candidatofisico",$class_fLNG->txt(__FILE__,__LINE__,'DETALHES DO CANDIDATO'))."<b>".SYS_CONFIG_RM_SIGLA." ".fGERAL::legCode($candidato_fisico_id,$linha2["code"])."</b><br>".'<div style="clear:both; border-top:#E0E0E0 1px solid;"></div>';
				//$pessoa_n .= "<br>Nome: <b>".$linha2["nome"]."</b>";
				$pessoa_n .= $class_fLNG->txt(__FILE__,__LINE__,'Nome').": <b>".$linha2["nome"]." ".$linha2["sobrenome"]."</b>";			
				$pessoa_n .= "<br>".$class_fLNG->txt(__FILE__,__LINE__,'Data de nascimento').": <b>".data_mysql($linha2["datan"]).", ".calcular_idade($linha2["datan"])." anos</b>";			
				$pessoa_n .= "<br>".$class_fLNG->txt(__FILE__,__LINE__,'Nacionalidade').": <b>".maiusculo($linha2["nacionalidade"])." - ".maiusculo($linha2["localn"])."</b>";
				$pessoa_n .= "<br>".$class_fLNG->txt(__FILE__,__LINE__,'Documento').": <b>".$arrDoc["nome"]." ".$arrDoc["numero"]." (".$class_fLNG->txt(__FILE__,__LINE__,'emitido em !!data!!',array("data"=>data_mysql($arrDoc["data_emissao"]))).")</b>";	
			}//if($valida == ""){//
		}else{//if($linha["id"] >= "1"){
			$code = "";
			$valida = $class_fLNG->txt(__FILE__,__LINE__,'Nº do processo não foi encontrado.');
		}//}else{//if($linha["id"] >= "1"){

		if($valida != ""){ 
			$code = "";
			$cMSG->addMSG("ERRO",$valida); 
		}
	}//if($code != ""){

	$cMSG->imprimirMSG();//imprimir mensagens criadas			

/////////// INCLUDE JS EXCLUSIVO --------------------- 
$INC_JS = ",icheck,";//informar funcao a usar entre VIRGULAS > ,funcao
$INC_JSCSS = $INC_FAISHER["div"]."bp";
include "inc/inc_js-exclusivo.php";	
		
    //id temp para registro de array
    $array_temp = time().rand(9,99999).$cVLogin->getVarLogin("SYS_USER_ID");
	$formCadastroSec = "formCadastroSec".$array_temp;		
?>	
<form id="<?=$formCadastroSec?>" name="<?=$formCadastroSec?>" action="#" method="POST" class='form-horizontal form-bordered form-validate'>
<?php if($code == ""){?>


        <div class="control-group">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Nº Processo')?></label>
            <div class="controls">
                <input type="text" id="code" name="code" class="input-xlarge" value="<?=$code?>"/> <button type="button" class="btn btn-info" onClick="consultarProcessos<?=$INC_FAISHER["div"]?>();return false;"><i class="icon-search"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Consultar')?></button>             
            </div>
        </div>  
        <div class="form-actions">
            <button type="button" class="btn btn-large btn-primary" onclick="validarDados<?=$INC_FAISHER["div"]?>();return false;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Validar Processo')?></button>
            <button type="button" class="btn btn-large" data-dismiss="modal"><?=$class_fLNG->txt(__FILE__,__LINE__,'Cancelar')?></button>
        </div>  
        
        
        
<?php }else{//if($code == "")?>
        <div class="control-group">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Processo')?></label>
            <div class="controls">
                <?=$processo_n?>
            </div>
        </div> 
        <div class="control-group">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Candidato')?></label>
            <div class="controls">
                <?=$pessoa_n?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Exame médico')?></label>
            <div class="controls">
            <input name="cont_f" id="cont_f" type="hidden" value="0"/>
            <?php
            //montar IFRAME
            $idTemp = $array_temp;//id do retorno
            $idIframe = "examePDF".$array_temp;//id do iframe
            $arqTipo = "pdf";//tipos de arquivos
            $n_arqQtd = "1";//quantidade de arquivos maximo
            $desc = "0";//ativar descicao, 1 ligado, 0 desligado
            $funcao = "confUp".$INC_FAISHER["div"];//ativar funcao java con retorno de QTD enviados
            ?>
              <iframe name="<?=$idIframe?>" style="border:0; overflow:hidden;" src="geral/upload_iframe.php?idTemp=<?=$idTemp?>&idIframe=<?=$idIframe?>&arq=<?=$arqTipo?>&n_arq=<?=$n_arqQtd?>&desc=<?=$desc?>&funcao=<?=$funcao?>" frameborder="0"  scrolling="no"  id="<?=$idIframe?>" width="100%" height="100%"> </iframe>
<script>                                
function confUp<?=$INC_FAISHER["div"]?>(v_retorno){
	if(v_retorno >= "1"){ $('#<?=$formCadastroSec?> #cont_f').val(v_retorno); }else{ $('#<?=$formCadastroSec?> #cont_f').val("0"); }
}//confUp
</script>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Resultado')?></label>
            <div class="controls">
                <div class="span4">
                <div class="check-line">
                    <input type="radio" id="apto1" class='<?=$INC_FAISHER["div"]?>bp-icheck' name="resultado" data-skin="square" data-color="blue" data-rule-required="true" value="1"> <label class='inline' for="apto1" style="font-size:30px;"><i class="icon-thumbs-up"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'APTO')?></label>
                </div>
                </div>
                <div class="span4">
                <div class="check-line">
                    <input type="radio" id="apto0" class='<?=$INC_FAISHER["div"]?>bp-icheck' name="resultado" data-skin="square" data-color="blue" data-rule-required="true" value="0"> <label class='inline' for="apto0" style="font-size:30px;"><i class="icon-thumbs-down"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'INAPTO')?></label>
                </div>                
                </div>
                <div class="span12">
                <span class="help-block" style="color:red; display:none;" id="div_obs"><b><i class="fa fa-info-circle"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'ATENÇÃO! Esta ação irá cancelar o processo do candidato por inaptidão')?></b></span>                
                </div>
            </div>
        </div> 
        
        
        <div class="control-group" id="div_restricao" style="display:none;">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Restrições')?></label>
            <div class="controls">
              <input type="hidden" name="restricoes" id="restricoes" value="" class="cssFonteMai" style="width:98%"/>            
<script>
$(document).ready(function(e) {
	//dados de combobox
	$("#<?=$formCadastroSec?> #restricoes").select2({
		maximumSelectionSize: 10,multiple: true,//*/
		placeholder: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Selecionar restrições >> (comece a digitar para buscar)')?>',
		ajax: {
			url: "geral/combo_ajax.php?ajax=selRestricao&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 100,//, // page size
					del: $("#<?=$formCadastroSec?> #restricoes").val()
				};
			},
			results: function (data, page) {
				return { results: data.results };
			}
		},
		formatResult: formatSelect2HTML,
		formatSelection: formatSelect2HTML,
		escapeMarkup: function(m) { return m; }
	});
});	
</script> 
            </div>        
        </div>        
        <div class="form-actions">
            <button type="button" class="btn btn-large btn-primary" onclick="salvarDados<?=$INC_FAISHER["div"]?>();return false;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Concluir')?></button>
            <button type="button" class="btn btn-large" data-dismiss="modal"><?=$class_fLNG->txt(__FILE__,__LINE__,'Cancelar')?></button>
        </div>         
<?php }//else?>




</form>
<script>
$(document).ready(function(e) {
    $("input[name='resultado']").on("change", function(){
		if($(this).val() == "1"){
			$("#div_obs").fadeOut();
			$("#div_restricao").fadeIn();
		}else{
			$("#div_obs").fadeIn();
			$("#div_restricao").fadeOut();			
		}
	});
});
function consultarProcessos<?=$INC_FAISHER["div"]?>(){
	pmodalHtml('<i class=icon-search></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'CONSULTAR PROCESSO DO CANDIDATO')?>','<?=$AJAX_PAG?>','get','faisher=<?=$faisher?>&ajax=consultarProcessos&array_temp=<?=$array_temp?>');	    
}
function validarDados<?=$INC_FAISHER["div"]?>(){
	v_code = $("#<?=$formCadastroSec?> #code").val();
	
	valida = "";
	if(v_code == ""){ valida = "<?=$class_fLNG->txt(__FILE__,__LINE__,'Nº processo deve ser preenchido!')?>"; }
	
	if(valida != ""){ alert(valida); }else{//if(valida != ""){
		faisher_ajax('pModalConteudoOn', 'pModalLoader', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=exameMedico&code='+v_code, 'get', 'ADD');
	}//}else{//if(valida != ""){
}//validarDados

function salvarDados<?=$INC_FAISHER["div"]?>(){
	v_cont_f = $("#<?=$formCadastroSec?> #cont_f").val();
	v_restricoes = $("#<?=$formCadastroSec?> #restricoes").val();
	v_resultado = $("#<?=$formCadastroSec?> input[name='resultado']:checked").val();
	if(v_restricoes == null){ v_restricoes = ""; }
	if(v_resultado == null){ v_resultado = ""; }

	valida = "";
	if(v_resultado == ""){ valida = "<?=$class_fLNG->txt(__FILE__,__LINE__,'Necessário informar o resultado do exame, verifique!')?>"; }
	if(v_cont_f <= "0" && valida == ""){ valida = "<?=$class_fLNG->txt(__FILE__,__LINE__,'Necessário fazer upload do exame médico.')?>"; }

	if(valida != ""){ alert(valida); }else{//if(valida != ""){
		if(confirm("<?=$class_fLNG->txt(__FILE__,__LINE__,'Confirma exame médico utilizando estes dados?')?>")) {			
			faisher_ajax('pModalConteudoOn', 'pModalLoader', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=exameMedico&array_temp=<?=$array_temp?>&code=<?=$code?>&restricoes='+v_restricoes+'&resultado='+v_resultado, 'get', 'ADD');
		}
	}//}else{//if(valida != ""){
	
}//salvarDados
</script>
<?php
}//if($ajax == "exameMedico"){







































if($ajax == "consultarProcessos"){
	$array_temp = getpost_sql($_GET["array_temp"]);
	if(isset($_GET["doc_tipo"])){ $doc_tipo = getpost_sql($_GET["doc_tipo"]); }else{ $doc_tipo = ""; }
	if(isset($_GET["doc_numero"])){ $doc_numero = getpost_sql($_GET["doc_numero"]); }else{ $doc_numero = ""; }	
	if(isset($_GET["datan"])){ $datan = getpost_sql($_GET["datan"]); }else{ $datan = ""; }	
	if(isset($_GET["code"])){ $code = getpost_sql($_GET["code"]); }else{ $code = ""; }	




if($doc_numero != "" || $code != ""){
	$condicao = "";
	if($doc_numero != ""){
		$condicao .= "rg = '".$doc_numero."'";
		if($doc_tipo == "PASSAPORTE"){ $condicao .= "passaporte = '".$doc_numero."'"; }
		$condicao .= " AND datan = '".data_mysql($datan)."'";
	}
	if($code != ""){ 
		if($condicao != ""){ $condicao .= " AND "; }
		$condicao .= " code = '".$code."'"; 
	}

	$candidato = ""; $candidato_id = "0";
	$linha = fSQL::SQL_SELECT_ONE("id,code,nome,sobrenome","cad_candidato_fisico",$condicao);
	if($linha["nome"] != ""){
		$candidato_id = $linha["id"];
		$candidato_code = $linha["code"];
		$candidato_nome = $linha["nome"]." ".$linha["sobrenome"];
	}//if($linha["nome"] != ""){
		
	if($candidato_id <= "0"){
?>
 	 	<div class="control-group">
        	<div class="controls display-plus"><i class="icon-info-sign"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Não foi encontrado candidato com este documento (!!doc!!) e nome (!!nome!!)',array("doc"=>$doc_numero,"nome"=>$datan));?></div>
        </div>
        <div class="form-actions">
        	<button type="button" class="btn btn-large btn-info" onclick="consultarProcessos<?=$INC_FAISHER["div"]?>();return false;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Tentar novamente')?> <img src="img/ajax-qloader-preto-p.gif" width="18" height="18" style="display:none;" id="loadProcessos<?=$INC_FAISHER["div"]?>" /></button>
            <button type="button" class="btn btn-large" onclick="pmodalDisplay('hide')"><?=$class_fLNG->txt(__FILE__,__LINE__,'Fechar')?></button>
		</div>  
<?php		
	}else{//if($candidato_id <= "0"){
		
?>
<form class='form-horizontal form-column form-bordered' onsubmit="return false;">
    <div class="control-group">
		<div class="controls display-plus"><b><?=SYS_CONFIG_RM_SIGLA." ".$candidato_code." - ".$candidato_nome?></b></div>
    </div> 
    <div class="col-md-12">
        <table class="table table-hover table-bordered" style="margin-top:0;">
            <thead>
                <tr>
                    <th><?=$class_fLNG->txt(__FILE__,__LINE__,'Processo')?></th>
                    <th><?=$class_fLNG->txt(__FILE__,__LINE__,'Status')?></th>
                    <th><?=$class_fLNG->txt(__FILE__,__LINE__,'Ação')?></th>                
                </tr>
            </thead>
            <tbody>
<?php	
	$cont = "0"; $pc = "";
	$resu = fSQL::SQL_SELECT_SIMPLES("code,tipo_servico,servico_id,status","axl_processo","candidato_fisico_id = '".$candidato_id."'");
	while($linha = fSQL::FETCH_ASSOC($resu)){ $cont++;
		$code = $linha["code"];
		$tipo_servico = $linha["tipo_servico"];		
		$servico_id = $linha["servico_id"];
		$status = $linha["status"];
		$linhaxxx = fSQL::SQL_SELECT_ONE("nome","adm_protocolo_tipo","id = '".$servico_id."'");
		$servico_id_n = '<i class="'.categoriaServicoIco($tipo_servico).'"></i> '.$linhaxxx["nome"]."<br>".SYS_CONFIG_PROCESSO_SIGLA." ".$code;		
		
?>
                <tr>
                    <td><?=$servico_id_n?></td>
                    <td><?=processoStatusLeg($status)?></td>
                    <td>
                    	
                    		<button type="button" class="btn btn-primary" <?php if(in_array($status,[0,1])){?> onclick="exameMedico<?=$INC_FAISHER["div"]?>('&code=<?=$code?>');return false;" <?php }else{ echo 'disabled'; }?>  ><?=$class_fLNG->txt(__FILE__,__LINE__,'Selecionar')?> <i class="icon-chevron-right"></i> <img src="img/ajax-qloader-preto-p.gif" width="18" height="18" style="display:none;" id="loadCode<?=$INC_FAISHER["div"]?>" /></button>
						<?php if(!in_array($status,[0,1])){?>							                    	                      
                        	<span>*<?=$class_fLNG->txt(__FILE__,__LINE__,'Processo não está em atendimento!')?></span>
                    	<?php }//if(in_array($status,[0,1])){?>                                                
                    </td>
                </tr>
<?php		
	}//fim while
	if($cont == "0"){
?>
				<tr><td><div style="padding:20px;"><i class="icon-info-sign"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Nenhum processo encontrado deste candidato.')?></div></td></tr>
<?php		
	}//if($cont == "0"){
?>
            </tbody>
        </table>
    </div>
 	 	<div class="form-actions">
        	<button type="button" class="btn btn-large btn-info" onclick="consultarProcessos<?=$INC_FAISHER["div"]?>();return false;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Tentar novamente')?></button>
            <button type="button" class="btn btn-large" onclick="pmodalDisplay('hide')"><?=$class_fLNG->txt(__FILE__,__LINE__,'Fechar')?></button>
		</div>     
</form>    
<?php
	}//}else{//if($candidato_id <= "0"){
}//if($doc_numero != ""){
?>




<?php 
if($doc_numero == "" and $code == ""){

    //id temp para registro de array
	$formSec = "formSec".time().rand(9,99999).$cVLogin->getVarLogin("SYS_USER_ID");;	
		
/////////// INCLUDE JS EXCLUSIVO --------------------- 
$INC_JS = ",icheck,";//informar funcao a usar entre VIRGULAS > ,funcao
$INC_JSCSS = $INC_FAISHER["div"]."bp";
include "inc/inc_js-exclusivo.php";		
?>
<form id="<?=$formSec?>" class='form-horizontal form-column form-bordered' onsubmit="return false;">
    <div class="span12">
        <div class="alert alert-warning">
            <b><?=$class_fLNG->txt(__FILE__,__LINE__,'ATENÇÃO!')?></b><br><?=$class_fLNG->txt(__FILE__,__LINE__,'Para buscar é necessário utilizar algum filtro: <br>- Nº documento + data de nascimento <br>- !!rnt!!',array("rnt"=>SYS_CONFIG_RM_SIGLA))?>
        </div>     
    </div>
	<div class="span6">
        <div class="control-group">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Nº do documento')?></label>
            <div class="controls">
            	<input type="text" class="input-medium cssFonteMai" id="doc_numero" name="doc_numero"/>
            </div>
        </div>        
        <div class="control-group">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Data de nascimento')?></label>
            <div class="controls">
            	<input type="text" class="input-small mask_date" id="datan" name="datan"/>
            </div>
        </div> 
		<div class="form-actions">
        </div>
        <div class="control-group">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Nº ')?> <?=SYS_CONFIG_RM_SIGLA?></label>
            <div class="controls">
                <input type="text" name="rnt" id="rnt" placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Informe o !!sigla!!',array("sigla"=>SYS_CONFIG_RM_SIGLA))?>" class="input-xlarge">
            </div>
        </div>          
    </div>
    <div class="span5">
        <div class="control-group">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Tipo do documento')?></label>
            <div class="controls">
                <div class="check-line">
                    <input name="doc_tipo" type="radio" class='<?=$INC_FAISHER["div"]?>bp-icheck' id="doc_tipo1" value="<?=$class_fLNG->txt(__FILE__,__LINE__,'IDENTIDADE')?>" data-skin="square" data-color="blue" checked="checked"> <label class='inline' for="doc_tipo1"><?=$class_fLNG->txt(__FILE__,__LINE__,'Identidade')?></label>
                </div>
                <div class="check-line">
                    <input name="doc_tipo" type="radio" class='<?=$INC_FAISHER["div"]?>bp-icheck' id="doc_tipo2" value="<?=$class_fLNG->txt(__FILE__,__LINE__,'PASSAPORTE')?>" data-skin="square" data-color="blue"> <label class='inline' for="doc_tipo2"><?=$class_fLNG->txt(__FILE__,__LINE__,'Passaporte')?></label>
                </div>
                <div class="check-line">
                    <input name="doc_tipo" type="radio" class='<?=$INC_FAISHER["div"]?>bp-icheck' id="doc_tipo3" value="<?=$class_fLNG->txt(__FILE__,__LINE__,'ID ESTRANGEIRO')?>" data-skin="square" data-color="blue"> <label class='inline' for="doc_tipo3"><?=$class_fLNG->txt(__FILE__,__LINE__,'ID Estrangeiro')?></label>
                </div>
            </div>
        </div>    
    </div> 

    <div class="span12">
 	 	<div class="form-actions">
            <button type="button" class="btn btn-large btn-primary" onclick="buscarProcessos<?=$INC_FAISHER["div"]?>();return false;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Buscar processos')?> <img src="img/ajax-qloader-preto-p.gif" width="18" height="18" style="display:none;" id="loadProcessos<?=$INC_FAISHER["div"]?>" /></button>
            <button type="button" class="btn btn-large" onclick="pmodalDisplay('hide')"><?=$class_fLNG->txt(__FILE__,__LINE__,'Fechar')?></button>
		</div> 
    </div>

</form>
<?php }//if($doc_numero == ""){?>



<script>
function consultarProcessos<?=$INC_FAISHER["div"]?>(){
	pmodalHtml('<i class=icon-search></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'CONSULTAR PROCESSO DO CANDIDATO')?>','<?=$AJAX_PAG?>','get','faisher=<?=$faisher?>&ajax=consultarProcessos&array_temp=<?=$array_temp?>');	    
}
function buscarProcessos<?=$INC_FAISHER["div"]?>(){
	v_doc_tipo = $("#<?=$formSec?> input[name='doc_tipo']:checked").val();
	v_doc_numero = $("#<?=$formSec?> #doc_numero").val();
	v_datan = $("#<?=$formSec?> #datan").val();
	v_rnt = $("#<?=$formSec?> #rnt").val();
	
	var valida = "";
	if(v_rnt == ""){
		if(v_doc_numero == ""){ valida = "<?=$class_fLNG->txt(__FILE__,__LINE__,'É obrigatório informar o nº do documento do candidato!')?>"; }
		if(v_datan == ""){ valida = "<?=$class_fLNG->txt(__FILE__,__LINE__,'É obrigatório informar a data de nascimento do candidato!')?>"; }	
	}//if(v_rnt == ""){

	if((v_doc_numero == "") && (v_datan == "") && (v_rnt == "")){ valida = "<?=$class_fLNG->txt(__FILE__,__LINE__,'Deve ser informado o nº do documento + data de nascimento ou !!sigla!! do candidato.',array("sigla"=>SYS_CONFIG_RM_PROCESSO))?>"; }
	
	if(valida != ""){ alert(valida); }else{
		faisher_ajax('pModalConteudoOn', 'loadProcessos<?=$INC_FAISHER["div"]?>', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=consultarProcessos&array_temp=<?=$array_temp?>&doc_tipo='+v_doc_tipo+'&doc_numero='+v_doc_numero+'&datan='+v_datan+'&code='+v_rnt, 'get', 'ADD');		
	}
}//buscarProcessos
</script>    
<?php	
		
}//if($ajax == "consultarProcessos"){































if ($ajax == "recepcaoProcessos"){
	
	//salvar - atualizar
	if(isset($_GET["processo_id"])) {
		$processo_id = getpost_sql($_GET["processo_id"]);
		$cadac_id = getpost_sql($_GET["cadac_id"]);		
		$pendencia = getpost_sql($_GET["pendencia"]);		
		
		$autorizar = 1; $status = "1"; $status_leg = "OK";
		if ($pendencia != ""){ $autorizar = 0; $status = "0"; $status_leg = $class_fLNG->txt(__FILE__,__LINE__,'Pendente'); }
		
		$msg = "";
		if ($cadac_id >= "1") {
			$campos = "pendencia,status,user_id,sync";
			$valores = array($pendencia,$status,$cVLogin->userReg(),time());
			fSQL::SQL_UPDATE_SIMPLES($campos,"axl_cadac",$valores,"id = '".$cadac_id."'");
			$msg .= $class_fLNG->txt(__FILE__,__LINE__,'Recebimento atualizado!');
		}else{
			$cadac_id = fSQL::SQL_SELECT_INSERT("axl_cadac");
			$campos = "id,processo_id,pendencia,status,user_id,time,sync";
			$valores = array($cadac_id,$processo_id,$pendencia,$status,$cVLogin->userReg(),time(),time());
			fSQL::SQL_INSERT_SIMPLES($campos,"axl_cadac",$valores);
			$msg .= $class_fLNG->txt(__FILE__,__LINE__,'Processo recebido com sucesso!');			
			fSQL::SQL_UPDATE_SIMPLES("cadac_id","axl_processo",array($cadac_id),"id = '".$processo_id."'");
		}
		
		$msg .= "<br><br>".$class_fLNG->txt(__FILE__,__LINE__,'Status da recepção').": ".$status_leg;
		
		if ($autorizar >= "1") {
			$linha = fSQL::SQL_SELECT_ONE("status,servico_id,coleta_id","axl_processo","id = '".$processo_id."'");
			if($linha["status"] <= "2"){
				
				$valida = verificarAutorizacaoProcesso($processo_id);
				if($valida == 1){			
					$servico_id = $linha["servico_id"];
					$coleta_id = $linha["coleta_id"];
					//verificar se processo completo - autorizar impressão
					$linha = fSQL::SQL_SELECT_ONE("informacoes","adm_protocolo_tipo","id = '".$servico_id."'");
					$informacoes = arrayDB($linha["informacoes"]);
		
						//monta array
					unset($array); $array = explode(".",$informacoes);
					$cont_ARRAY = ceil(count($array));
					//listar item ja cadastrados
					if($cont_ARRAY >= "1"){
						foreach ($array as $pos => $tipo_id){
							$linhaxxx = fSQL::SQL_SELECT_ONE("id,obrigatorio","adm_protocolo_tipo_inf","id = '".$tipo_id."'");							
							if($linhaxxx["obrigatorio"] == "1"){
								$cont = fSQL::SQL_CONTAGEM("axl_processo_campos","processo_id = '".$processo_id."' AND tipo_id = '".$tipo_id."'");
								if($cont <= "0"){ $valida = "0"; break; }
							}//if($linhaxxx["obrigatorio"] == "1"){
						}//foreach ($array as $pos => $tipo_id){
					}//if($cont_ARRAY >= "1"){
					if($valida == "1"){
						if($coleta_id <= "0"){ $valida = "0"; }else{//if($coleta_id <= "0"){
							$linha = fSQL::SQL_SELECT_ONE("abis_status","axl_coleta_biometrica","id = '".$coleta_id."'");
							if($linha["abis_status"] != "1"){ $valida = "0"; }
						}//}else{//if($coleta_id <= "0"){
					}//if($valida == "1"){
				}
				
				//autorizar impressão
				$msg_ws = "";
				if($valida == "1"){
					$result = thomasWSimpressaoEnviar($processo_id);
					if($result["codigo_retorno"] == "1"){ 
						$msg .= "<br><br>*".$class_fLNG->txt(__FILE__,__LINE__,'Processo autorizado para impressão')."!";
						fPROCESSO::criarEvento($class_fLNG->txt(__FILE__,__LINE__,'Autorização para Impressão'),$class_fLNG->txt(__FILE__,__LINE__,'Processo autorizado para impressão'),$cVLogin->userReg(),$cVLogin->getVarLogin("SYS_USER_CARGO"),$processo_id,"");	
					}else{
						$msg .= "<br><br>*".$class_fLNG->txt(__FILE__,__LINE__,'Ocorreu um erro ao autorizar o processo para impressão:')." ".thomasCodRetorno($result["codigo_retorno"]).thomasFiltrarErro($result["descricao_retorno"]);
						
						fSQL::SQL_UPDATE_SIMPLES("status","axl_cadac",array("0"), "id = '".$cadac_id."'");
					}
				}
			}
		}
		
		$cMSG->addMSG("INFO",$msg);	
		unset($processo_id,$cadac_id,$pendencia,$msg,$autorizar,$status,$status_leg,$coleta_id,$servico_id);
	}//if(isset($_GET["processo_id"])) {
	
	
	
	
	//abrir processo
	if (isset($_GET["rnc"])){
		$rnc = getpost_sql($_GET["rnc"]);
		
		$linha = fSQL::SQL_SELECT_ONE("id,status,tipo_servico,servico_id,coleta_id,cadac_id,suspensao_i,suspensao_f","axl_processo","code = '".$rnc."'");
		$processo_id = $linha["id"];
		if ($processo_id <= 0) {
			$rnc = "";
			$cMSG->addMSG("ERRO",$class_fLNG->txt(__FILE__,__LINE__,'Processo não encontrado (#!!code!!)',array("code"=>$rnc))."<br><br>".$valida);	
		}else{
			$tipo_servico = $linha["tipo_servico"];		
			$servico_id = $linha["servico_id"];		
			$coleta_id = $linha["coleta_id"];
			$cadac_id = $linha["cadac_id"];	
			$status = $linha["status"];		
			$suspensao_i = $linha["suspensao_i"];		
			$suspensao_f = $linha["suspensao_f"];
			$time = time();
	
			$valida = "";				
			if ($time >= $suspensao_i and $time <= $suspensao_f) {
				$valida = "- ".$class_fLNG->txt(__FILE__,__LINE__,'Processo está suspenso!'); 
			}
			
			if ($status != "999") {
				$valida = "- ".$class_fLNG->txt(__FILE__,__LINE__,'Status atual (!!status!!) do processo não permite entrega no CADAC!',array("status"=>processoStatusLeg($status))).$status; 
			}		
	
			if ($valida == ""){
				$arPendenciaCADAC = [];			
				if ($cadac_id >= "1") {
					$linha = fSQL::SQL_SELECT_ONE("pendencia,status","axl_cadac","id = '".$cadac_id."'");
					$arPendenciaCADAC = explode(",",$linha["pendencia"]);
				}
				
				//busca dados
				$linha2 = fSQL::SQL_SELECT_ONE("nome,informacoes","adm_protocolo_tipo", "id = '".$servico_id."'");	
				$servico_id_n = $linha2["nome"];	
				
				$processo_n = "<div style='float:left;'><i style='font-size: 40px;' class='".categoriaServicoIco($tipo_servico)."'></i></div> ".maiusculo(categoriaServicoLeg($tipo_servico))." - ".$servico_id_n." #".$rnc;			
			}else{
				$processo_id = ""; $rnc = "";
				$cMSG->addMSG("INFO",$class_fLNG->txt(__FILE__,__LINE__,'Processo não pode ser recepcionado!')."<br><br>".$valida);	
			}
		}
	}
	
	$cMSG->imprimirMSG();//imprimir mensagens criadas	
	
    //id temp para registro de array
    $array_temp = time().rand(9,99999).$cVLogin->getVarLogin("SYS_USER_ID");
	$formCadastroSec = "formCadastroSec".$array_temp;		
	
/////////// INCLUDE JS EXCLUSIVO --------------------- 
$INC_JS = ",icheck,";//informar funcao a usar entre VIRGULAS > ,funcao
$INC_JSCSS = $INC_FAISHER["div"];
include "inc/inc_js-exclusivo.php";	


?>
<form id="<?=$formCadastroSec?>" name="<?=$formCadastroSec?>" action="#" method="POST" class='form-horizontal form-bordered form-validate'>


<?php if($processo_id == ""){?>
    	<div class="control-group">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Nº Processo')?> (<?=SYS_CONFIG_PROCESSO_SIGLA?>)</label>
            <div class="controls">
            	<input type="text" name="rnc" id="rnc" value="<?=$rnc?>" class="cssFonteMai input-xlarge"/>            
            </div>
        </div>
        <div class="form-actions">
            <button type="button" class="btn btn-large btn-primary" onclick="carregarProcesso<?=$INC_FAISHER["div"]?>();return false;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Carregar Processo')?></button>
            <button type="button" class="btn btn-large" data-dismiss="modal"><?=$class_fLNG->txt(__FILE__,__LINE__,'Cancelar')?></button>
        </div> 


<?php }else{//else{//if($processo_id == ""){?>



            <div class="control-group">
                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Processo')?></label>
                <div class="controls display-plus">
                  <?=$processo_n?>
                </div>
            </div>
		<div class="control-group">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Requisitos')?></label>
            <div class="controls">
            	<table id="tabela_categorias<?=$INC_FAISHER["div"]?>" class="table table-hover table-bordered" style="margin-top:0;">
                    <tbody>
                        <tr>
                        	<td><input name="req_foto" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck it_check_css' id="req_foto" value="1" data-skin="square" data-color="blue" <?php if($cadac_id >= "1" and !in_array('req_foto', $arPendenciaCADAC)){ echo 'checked="checked" disabled'; } ?>></td>
                            <td><b><?=$class_fLNG->txt(__FILE__,__LINE__,'Foto')?></b></td>                            
                        </tr>
                        <tr>
                        	<td><input name="req_comprovante_endereco" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck it_check_css' id="req_comprovante_endereco" value="1" data-skin="square" data-color="blue" <?php if($cadac_id >= "1" and !in_array('req_comprovante_endereco', $arPendenciaCADAC)){ echo 'checked="checked" disabled'; } ?>></td>
                            <td><b><?=$class_fLNG->txt(__FILE__,__LINE__,'Comprovante de Endereço')?></b></td>
                        </tr>  
<?php if ($servico_id_a == "13"){?>
                        <tr>
                        	<td><input name="req_doc_antigo" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck it_check_css' id="req_doc_antigo" value="1" data-skin="square" data-color="blue" <?php if($cadac_id >= "1" and !in_array('req_doc_antigo', $arPendenciaCADAC)){ echo 'checked="checked" disabled'; } ?>></td>
                            <td><b><?=$class_fLNG->txt(__FILE__,__LINE__,'Documento Antigo')?></b></td>
                        </tr>  
<?php }//if ($servico_id_a == "13"){?>
                    </tbody>
                </table>
            </div>
        </div>     
        
        <div class="control-group">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Termo')?></label>
            <div class="controls">                                        
                <div class="check-line">
                    <input name="termo" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="termo" value="1" data-skin="square" data-color="blue"> <label class='inline display' for="termo"><?=$class_fLNG->txt(__FILE__,__LINE__,'Declaro que todos os documentos indicados acima foram recebidos (pasta física).')?></label>
                </div>
            </div>
        </div>         
        
        <div class="form-actions">
            <button type="button" class="btn btn-large btn-primary" onclick="finalizarRecepcao<?=$INC_FAISHER["div"]?>();return false;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Finalizar recepção')?></button>
            <button type="button" class="btn btn-large" data-dismiss="modal"><?=$class_fLNG->txt(__FILE__,__LINE__,'Cancelar')?></button>
        </div>                 

<?php }//else{//else{//if($processo_id == ""){?>
</form>        
<script>
function carregarProcesso<?=$INC_FAISHER["div"]?>(){
	v_rnc = $("#<?=$formCadastroSec?> #rnc").val();
	
	valida = "";
	if(v_rnc == ""){ valida = "<?=$class_fLNG->txt(__FILE__,__LINE__,'!!sigla!! do processo deve ser informado!',array("sigla"=>SYS_CONFIG_PROCESSO_SIGLA))?>"; }
	
	if(valida != ""){ alert(valida); }else{//if(valida != ""){
		faisher_ajax('pModalConteudoOn', 'pModalLoader', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=recepcaoProcessos&rnc='+v_rnc, 'get', 'ADD');
	}//}else{//if(valida != ""){
}//carregarProcesso

function finalizarRecepcao<?=$INC_FAISHER["div"]?>(){
	v_pendencia = "";
	tipo = 'req_foto'; if(!$("#<?=$formCadastroSec?> #"+tipo).is(':checked')){ if(v_pendencia != "") { v_pendencia += ","; } v_pendencia += tipo; }
	tipo = 'req_comprovante_endereco'; if(!$("#<?=$formCadastroSec?> #"+tipo).is(':checked')){ if(v_pendencia != "") { v_pendencia += ","; } v_pendencia += tipo; }	
<?php if ($servico_id_a == "13"){?>	
	tipo = 'req_doc_antigo'; if(!$("#<?=$formCadastroSec?> #"+tipo).is(':checked')){ if(v_pendencia != "") { v_pendencia += ","; } v_pendencia += tipo; }	
<?php }//if ($servico_id_a == "13"){?>	
	
	valida = "";	
	if(!$("#<?=$formCadastroSec?> #termo").is(':checked')){ valida = "<?=$class_fLNG->txt(__FILE__,__LINE__,'Para recebimento do processo, o termo deve ser aceito!')?>"; } 
	
	if(valida != ""){ alert(valida); }else{//if(valida != ""){
		confirmacao = "<?=$class_fLNG->txt(__FILE__,__LINE__,'CONFIRMA RECEBIMENTO DO PROCESSO?')?>"
		if (v_pendencia != ""){ confirmacao += "\n\n*<?=$class_fLNG->txt(__FILE__,__LINE__,'Processo recebido ficará pendente, até que todos os requisitos sejam satisfeitos.')?>"; }else{ confirmacao += "\n*<?=$class_fLNG->txt(__FILE__,__LINE__,'O processo será autorizado para impressão!')?>" }
		if(confirm(confirmacao)) {	
			faisher_ajax('pModalConteudoOn', 'pModalLoader', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=recepcaoProcessos&cadac_id=<?=$cadac_id?>&processo_id=<?=$processo_id?>&pendencia='+v_pendencia, 'get', 'ADD');
		}
	}//}else{//if(valida != ""){	
}//abrirProcesso
</script>        
<?php        	
}//if ($ajax == "recepcaoProcessos"){



































//++++++++++++++++++++++AJAX QUE EXIBE [[HOME]] ------------------------------------------------------------------>>>
if($ajax == "home"){
	
	







//++++++++++++++++++++++AJAX QUE EXIBE [[HOME]] ----------------------------########################################-------------------------------------->>>

	$TITULO_PAG = $INC_FAISHER["titulo"]." ";//titulo da pagina
?>
<script>
//TIMER
$.doTimeout('vTimerOnLoad', 0, function(){
	classMenuTop('<?=$INC_FAISHER["menu"]?>');//seleciona o menu ativo
	$('#titulo_principal').html($('#html_titulo-<?=$INC_FAISHER["aba"]?>').html());//titulo principal
	
	//da pagina
});//TIMER

<?php /*funções utilizadas junto com itens do bloco de ações para atualizar a janela e pontuação*/?>
function atualizaPainelHoje(){
	faisher_ajaxAba('Inicio', "<?=$class_fLNG->txt(__FILE__,__LINE__,'Hoje')?>", 'home', '');	
}
function atualizaPainelHojeBackground(v_tab_id){
	var aba = 'Inicio'; var faisher = 'home';
	var marcadorAba = aba.substring(0, 2);
	var id_li = marcadorAba+'-'+faisher; 
	$.get("ajax/faisher.php?faisher="+faisher+"&tab_id="+v_tab_id,{ }, function(data){
			$("#content_"+id_li+"").empty().html(data);//carrega dados
	});
}
</script>
<div style="display:none;" id="html_titulo-<?=$INC_FAISHER["aba"]?>"><?=$TITULO_PAG?></div>
<div style="display:none;" id="html_mapa-<?=$INC_FAISHER["aba"]?>"><?=$INC_FAISHER["mapa"]?></div>


<?php /* ---------------------- ########## LISTA DE ACAO ########## ---------------------------------*/ ?>
				<div class="row-fluid">
					<div class="span12">

    
<?php














 //####################################################################### atalhos de acesso rápido #############################################>>> ?>
							<div class="box">
								<div class="box-title">
									<h3>
										<i class="icon-share"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Atalhos rápidos (acesso direto)')?>
									</h3>
								</div>
								<div class="box-content" style="padding-top:0;">
           
<div class="row-fluid">
					<div class="span12">
						<div class="span12">
<?php









///VERIFICA PERMISSÕES DE ACESSO
$idpermissao = "7_axl_triagem";
if($pPER["$idpermissao"] == "1"){ $cont_exib++;//cont exibir SPAN
?>
  <div class="span3" style="margin:5px;">
  <button class="btn btn-blue btn-block btn-large" style="padding-left:3px; padding-right:3px; height:85px;" onclick="<?=$cVLogin->linkMENU($idpermissao,"")?>return false;"><i class="glyphicon-group" style="font-size:25px;"></i> <div style="margin-top:10px; font-size:14px; line-height:normal;"><?=$class_fLNG->txt(__FILE__,__LINE__,'TRIAGEM')?></div></button>
  </div>
<?php }//if($pPER["$idpermissao"] == "1"){


///VERIFICA PERMISSÕES DE ACESSO
$idpermissao = "7_axl_iniciaratendimento";
if($pPER["$idpermissao"] == "1"){ $cont_exib++;//cont exibir SPAN
	$link = $cVLogin->linkMENU($idpermissao,"");
	
?>
  <div class="span3" style="margin:5px;">
  <button class="btn btn-blue btn-block btn-large" style="padding-left:3px; padding-right:3px; height:85px;" onclick="<?=$link?>return false;"><i class="glyphicon-circle_ok" style="font-size:25px;"></i> <div style="margin-top:10px; font-size:14px; line-height:normal;"><?=$class_fLNG->txt(__FILE__,__LINE__,'INICIAR ATENDIMENTO')?></div></button>
  </div>
  
  <div class="span3" style="margin:5px;">
  <button class="btn btn-blue btn-block btn-large" style="padding-left:3px; padding-right:3px; height:85px;" onclick="modalCadCandidato<?=$INC_FAISHER["div"]?>();return false;"><i class="glyphicon-group" style="font-size:25px;"></i> <div style="margin-top:10px; font-size:14px; line-height:normal;"><?=$class_fLNG->txt(__FILE__,__LINE__,'GESTÃO DE CANDIDATOS')?></div></button>
  </div>
<script>
function modalCadCandidato<?=$INC_FAISHER["div"]?>() {
	pmodalHtml('<i class=glyphicon-group></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'GESTÃO DE CANDIDATOS')?>','<?=$AJAX_PAG?>','get','faisher=3_con_candidatofisico&ajax=home&POP=pop');	
}
</script>
<?php 

	$array = explode(",",$_SESSION["SYS_USER_SERVICOS"]);
	foreach($array as $servico){
		if($servico == "5"){//coleta
?>		
  <div class="span3" style="margin:5px;">
  <button class="btn btn-blue btn-block btn-large" style="padding-left:3px; padding-right:3px; height:85px;"><i class="fas fa-fingerprint" style="font-size:25px;"></i> <div style="margin-top:10px; font-size:14px; line-height:normal;"><?=$class_fLNG->txt(__FILE__,__LINE__,'COLETA BIOMÉTRICA')?></div></button>
  </div>	
<?php  	
			break;
		}
	}

}//if($pPER["$idpermissao"] == "1"){
	

///VERIFICA PERMISSÕES DE ACESSO
$idpermissao = "7_axl_backoffice";
if($pPER["$idpermissao"] == "1" and 1==2){ $cont_exib++;//cont exibir SPAN
?>
	<div class="span3" style="margin:5px;">
		<div class="btn-group btn-block">  
			<a class="btn btn-blue btn-block btn-large dropdown-toggle" data-toggle="dropdown" style="padding-left:3px; padding-right:3px; height:85px;"><i class="glyphicon-briefcase" style="font-size:25px;"></i> <div style="margin-top:10px; font-size:14px; line-height:normal;"><?=$class_fLNG->txt(__FILE__,__LINE__,'ATENDIMENTO BACKOFFICE')?> </div></a>
            <ul class="dropdown-menu">
<?php            
	$array = categoriaServicoArrCompleto();
	foreach($array as $servico){
		if($servico["status"] == "0"){ continue; }
?>
                <li><a href="#" onclick="novoBackOffice('<?=$servico["tipo"]?>');return false;"><i class="<?=$servico["ico"]?>"></i> <?=$servico["leg"]?></a></li>
<?php		
	}  
?>	          
            </ul>
<script>
function novoBackOffice(v_tipo){
	pmodalHtml('<i class=glyphicon-briefcase></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'NOVO ATENDIMENTO BACKOFFICE')?>','<?=$AJAX_PAG?>','get','faisher=<?=$faisher?>&ajax=novoBackOffice&tipo_servico='+v_tipo);	
}//novoBackOffice
</script>              
		</div>
	</div>
<?php }//if($pPER["$idpermissao"] == "1"){	


	
///VERIFICA PERMISSÕES DE ACESSO
$idpermissao = "7_axl_auditoria";
if($pPER["$idpermissao"] == "1"){ $cont_exib++;//cont exibir SPAN
?>
  <div class="span3" style="margin:5px;">
  <button class="btn btn-blue btn-block btn-large" style="padding-left:3px; padding-right:3px; height:85px;" onclick="<?=$cVLogin->linkMENU($idpermissao,"")?>return false;"><i class="glyphicon-screenshot" style="font-size:25px;"></i> <div style="margin-top:10px; font-size:14px; line-height:normal;"><?=$class_fLNG->txt(__FILE__,__LINE__,'AUDITORIA')?></div></button>
  </div>
<?php }//if($pPER["$idpermissao"] == "1"){	



///VERIFICA PERMISSÕES DE ACESSO
$idpermissao = "7_axl_usuario_verificacao";
if($pPER["$idpermissao"] == "1"){ $cont_exib++;//cont exibir SPAN
	$qtd = fSQL::SQL_CONTAGEM("sys_login","status = '3'");
?>
  <div class="span3" style="margin:5px;">
  	<button class="btn btn-blue btn-block btn-large" style="padding-left:3px; padding-right:3px; height:85px;" onclick="<?=$cVLogin->linkMENU($idpermissao,"")?>return false;"><i class="glyphicon-unlock" style="font-size:25px;"></i> <div style="margin-top:10px; font-size:14px; line-height:normal;"><?=$class_fLNG->txt(__FILE__,__LINE__,'CREDENCIAMENTO')?> <span class="label label-lightred" id="bt_credenciamento_cont" style="display:none">0</span></div></button>
  </div>
<?php }//if($pPER["$idpermissao"] == "1"){	



///VERIFICA PERMISSÕES DE ACESSO
$idpermissao = "7_axl_gestaooperacao";
if($pPER["$idpermissao"] == "1"){ $cont_exib++;//cont exibir SPAN
?>
  <div class="span3" style="margin:5px;">
  	<button class="btn btn-blue btn-block btn-large" style="padding-left:3px; padding-right:3px; height:85px;" onclick="<?=$cVLogin->linkMENU($idpermissao,"")?>return false;"><i class="icon-exchange" style="font-size:25px;"></i> <div style="margin-top:10px; font-size:14px; line-height:normal;"><?=$class_fLNG->txt(__FILE__,__LINE__,'GESTÃO DE OPERAÇÃO')?> <span class="label label-lightred" id="bt_motivo_cont" style="display:none">0</span></div></button>
  </div>
<?php }//if($pPER["$idpermissao"] == "1"){	





///VERIFICA PERMISSÕES DE ACESSO
if($cVLogin->getVarLogin("SYS_USER_CARGO") == "MANAGER" || $cVLogin->getVarLogin("SYS_USER_CARGO") == "TI"){ $cont_exib++;//cont exibir SPAN
?>
	<div class="span3" style="margin:5px;">
		<div class="btn-group btn-block">  
			<a class="btn btn-blue btn-block btn-large dropdown-toggle" data-toggle="dropdown" style="padding-left:3px; padding-right:3px; height:85px;"><i class="glyphicon-charts" style="font-size:25px;"></i> <div style="margin-top:10px; font-size:14px; line-height:normal;"><?=$class_fLNG->txt(__FILE__,__LINE__,'RELATÓRIOS')?> </div></a>
            <ul class="dropdown-menu">
<?php            
$idpermissao = "3_rel_precadastroquantitativo";
if($pPER["$idpermissao"] == "1"){ ?>
                <li><a href="#" onclick="<?=$cVLogin->linkMENU($idpermissao,"")?>return false;"> <?=$class_fLNG->txt(__FILE__,__LINE__,'Pré-Cadastro')?></a></li>
<?php } ?>
<?php            
$idpermissao = "7_rel_protocolosquantitativo";
if($pPER["$idpermissao"] == "1"){ ?>
                <li><a href="#" onclick="<?=$cVLogin->linkMENU($idpermissao,"")?>return false;"> <?=$class_fLNG->txt(__FILE__,__LINE__,'Processos')?></a></li>
<?php } ?>
            </ul>

</script>              
		</div>
	</div>
<?php }//if($pPER["$idpermissao"] == "1"){	





///VERIFICA PERMISSÕES DE ACESSO
if($cVLogin->getVarLogin("SYS_USER_CARGO") == "AUTO-ÉCOLE" || $cVLogin->getVarLogin("SYS_USER_ID") == 1){ $cont_exib++;//cont exibir SPAN
?>
  <div class="span3" style="margin:5px;">
  <button class="btn btn-blue btn-block btn-large" style="padding-left:3px; padding-right:3px; height:85px;" onclick="<?=$cVLogin->linkMENU("3_con_candidatofisico","id_a=0")?>return false;"><i class="glyphicon-user" style="font-size:25px;"></i> <div style="margin-top:10px; font-size:14px; line-height:normal;"><?=$class_fLNG->txt(__FILE__,__LINE__,'CADASTRAR CANDIDATO')?> </div></button>
  </div>
  
  
    <div class="span3" style="margin:5px;">
  <button class="btn btn-blue btn-block btn-large" style="padding-left:3px; padding-right:3px; height:85px;" onclick="novaHabilitacao<?=$INC_FAISHER["div"]?>();return false;"><i class="glyphicon-vcard" style="font-size:25px;"></i> <div style="margin-top:10px; font-size:14px; line-height:normal;"><?=$class_fLNG->txt(__FILE__,__LINE__,'NOVA HABILITAÇÃO')?> </div></button>
  </div>
  
<div class="span3" style="margin:5px;">
  <button class="btn btn-blue btn-block btn-large" style="padding-left:3px; padding-right:3px; height:85px;" onclick="consultaProcessos<?=$INC_FAISHER["div"]?>();return false;"><i class="glyphicon-search" style="font-size:25px;"></i> <div style="margin-top:10px; font-size:14px; line-height:normal;"><?=$class_fLNG->txt(__FILE__,__LINE__,'CONSULTA PROCESSOS')?> </div></button>
  </div>  
  
 <div id="div_oculta" style="display:none;"></div>
<script>
function imprimirCapaProcesso<?=$INC_FAISHER["div"]?>(v_code){
	faisher_ajax('div_oculta', '', '<?=$AJAX_PAG?>', '<?=$faisherGet?>&ajax=imprimirCapaProcesso&code='+v_code, 'get', 'ADD');
}//imprimirRecibo

function imprimirProcessoFull<?=$INC_FAISHER["div"]?>(v_code){
	faisher_ajax('div_oculta', '', '<?=$AJAX_PAG?>', '<?=$faisherGet?>&ajax=imprimirProcessoFull&code='+v_code, 'get', 'ADD');
}//imprimirRecibo

function imprimirRecibo<?=$INC_FAISHER["div"]?>(v_code){
	faisher_ajax('div_oculta', '', '<?=$AJAX_PAG?>', '<?=$faisherGet?>&ajax=imprimirRecibo&code='+v_code, 'get', 'ADD');
}//imprimirRecibo

function novaHabilitacao<?=$INC_FAISHER["div"]?>(v_get){
	pmodalHtml('<i class=glyphicon-vcard></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'NOVA HABILITAÇÃO')?>','<?=$AJAX_PAG?>','get','faisher=<?=$faisher?>&ajax=novaHabilitacao&'+v_get);	
}//novaHabilitacao

function consultaProcessos<?=$INC_FAISHER["div"]?>(v_get){
	pmodalHtml('<i class=glyphicon-search></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'CONSULTA PROCESSOS')?>','<?=$AJAX_PAG?>','get','faisher=<?=$faisher?>&ajax=consultaProcessos&'+v_get);	
}//consultaProcessos
</script>   
<?php }//if($pPER["$idpermissao"] == "1"){	
















///VERIFICA PERMISSÕES DE ACESSO
if($cVLogin->getVarLogin("SYS_USER_CARGO") == "CLINIQUE MÉDICALE" || $cVLogin->getVarLogin("SYS_USER_ID") == 1){ $cont_exib++;//cont exibir SPAN
?>
  
    <div class="span3" style="margin:5px;">
  <button class="btn btn-blue btn-block btn-large" style="padding-left:3px; padding-right:3px; height:85px;" onclick="exameMedico<?=$INC_FAISHER["div"]?>();return false;"><i class="glyphicon-edit" style="font-size:25px;"></i> <div style="margin-top:10px; font-size:14px; line-height:normal;"><?=$class_fLNG->txt(__FILE__,__LINE__,'ANEXAR EXAME MÉDICO')?> </div></button>
  </div>
  
<script>
function exameMedico<?=$INC_FAISHER["div"]?>(v_get){
	pmodalHtml('<i class=glyphicon-edit></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'ANEXAR EXAME MÉDICO')?>','<?=$AJAX_PAG?>','get','faisher=<?=$faisher?>&ajax=exameMedico&'+v_get);	
}//novoBackOffice
</script>   
<?php }//if($pPER["$idpermissao"] == "1"){	
	






///VERIFICA PERMISSÕES DE ACESSO
if($cVLogin->getVarLogin("SYS_USER_CARGO") == "CADAC" || $cVLogin->getVarLogin("SYS_USER_ID") == 1){ $cont_exib++;//cont exibir SPAN
?>
  
    <div class="span3" style="margin:5px;">
  <button class="btn btn-blue btn-block btn-large" style="padding-left:3px; padding-right:3px; height:85px;" onclick="recepcaoProcessos<?=$INC_FAISHER["div"]?>();return false;"><i class="glyphicon-edit" style="font-size:25px;"></i> <div style="margin-top:10px; font-size:14px; line-height:normal;"><?=$class_fLNG->txt(__FILE__,__LINE__,'RECEBIMENTO DE PROCESSOS')?> </div></button>
  </div>
  
<script>
function recepcaoProcessos<?=$INC_FAISHER["div"]?>(v_get){
	pmodalHtml('<i class=glyphicon-edit></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'RECEBIMENTO DE PROCESSOS')?>','<?=$AJAX_PAG?>','get','faisher=<?=$faisher?>&ajax=recepcaoProcessos&'+v_get);	
}//recepcaoProcessos
</script>   
<?php }//if($pPER["$idpermissao"] == "1"){	
	








///VERIFICA PERMISSÕES DE ACESSO
if($cVLogin->getVarLogin("SYS_USER_NOME") == "TOTEM"){ $cont_exib++;//cont exibir SPAN
?>
  <div class="span3" style="margin:5px;">
  <button class="btn btn-blue btn-block btn-large" style="padding-left:3px; padding-right:3px; height:85px;" onclick="popupCandidato<?=$INC_FAISHER["div"]?>();return false;"><i class="glyphicon-user" style="font-size:25px;"></i> <div style="margin-top:10px; font-size:14px; line-height:normal;"><?=$class_fLNG->txt(__FILE__,__LINE__,'NOVO CADASTRO')?> </div></button>
  </div>
 <script>
function popupCandidato<?=$INC_FAISHER["div"]?>(){
	pmodalHtml('<i class=icon-user></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'CADASTRAR NOVO CANDIDATO')?> <?=maiusculo($tipo_pessoa_a_n)?>','<?=$AJAX_PAG?>','get','faisher=3_con_candidatofisico&ajax=registro&id_a=0&POP=<?=fGERAL::cptoFaisher("inciarTela".$INC_FAISHER["div"]."('{ID}');", "enc")?>');	
}
function inciarTela<?=$INC_FAISHER["div"]?>(v_id){
	pmodalHtmlAlerta("<?=$class_fLNG->txt(__FILE__,__LINE__,'Pré cadastro realizado com sucesso!')?>","<?=$class_fLNG->txt(__FILE__,__LINE__,'INFORMAÇÃO')?>","<?=$class_fLNG->txt(__FILE__,__LINE__,'Ok')?>");
}
 </script>
<?php  
}//if($cVLogin->getVarLogin("SYS_USER_NOME") == "TOTEM"){ $cont_exib++;//cont exibir SPAN










?>
						</div>
						<div class="span3">
<?













?>
						</div>
                    </div>
                    

</div>



								</div>
							</div>
                    
<?php //####################################################################### atalhos de acesso rápido #############################################<<<
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
?>  
<?php






?>

						
                      
                      
                      
                      
                      
                      
    
























                    </div>
                    <!-- .span12 -->
                </div>


<?php


















?>
<?php





	













}//fim ajax  -------------------------------------------- <<<



















?>