<?php //Breno Cruvinel - breno.cruvinel09@gmail.com
//valida pagina se aberto separadamente
include "valida_pagina_sem_quadro.php";












//++++++++++++++++++++++AJAX QUE EXIBE [[BUSCA AVANÇADA]] ----------------------------########################################-------------------------------------->>>
if($ajax == "buscaAvancada"){
    //id temp para registro de array
    $array_temp = time().rand(9,99999).$cVLogin->getVarLogin("SYS_USER_ID");
	$formBusca = "formBusc".$array_temp;
	
?>
<script>
$(document).ready(function(){
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
	var v_get = '';
	<?php $idCJ = "nome_b";?>if($("#<?=$formBusca?> #<?=$idCJ?>").val() != ""){ v_get = v_get+'&<?=$idCJ?>='+$("#<?=$formBusca?> #<?=$idCJ?>").val(); pCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }
	<?php $idCJ = "datai_b";?>if($("#<?=$formBusca?> #<?=$idCJ?>").val() != ""){ v_get = v_get+'&<?=$idCJ?>='+$("#<?=$formBusca?> #<?=$idCJ?>").val(); pCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }
	<?php $idCJ = "dataf_b";?>if($("#<?=$formBusca?> #<?=$idCJ?>").val() != ""){ v_get = v_get+'&<?=$idCJ?>='+$("#<?=$formBusca?> #<?=$idCJ?>").val(); pCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }
	<?php $idCJ = "perfil_b";?>if($("#<?=$formBusca?> #<?=$idCJ?>").val() != ""){ v_get = v_get+'&<?=$idCJ?>='+$("#<?=$formBusca?> #<?=$idCJ?>").val(); }
	
	<?php $idCJ = "perfil_f";?>if($("#<?=$formBusca?> #<?=$idCJ.$INC_FAISHER["div"]?>").val() != ""){ v_get = v_get+'&<?=$idCJ?>='+$("#<?=$formBusca?> #<?=$idCJ.$INC_FAISHER["div"]?>").val(); }

	loaderFoco('divConteiner_lista<?=$INC_FAISHER["div"]?>','dAjax_lista<?=$INC_FAISHER["div"]?>_load','Filtrando dados...');//cria um loader dinamico
	faisher_ajax('divAjax_lista<?=$INC_FAISHER["div"]?>', 'dAjax_lista<?=$INC_FAISHER["div"]?>_load', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=lista&'+v_get, 'get', 'ADD');
}//bAvancada

function bAvancada<?=$INC_FAISHER["div"]?>Remove(v_remove){
	<?php $idCJ = "nome_b";?>if(v_remove == "<?=$idCJ?>" || v_remove == "all"){ lCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }
	<?php $idCJ = "data_b";?>if(v_remove == "<?=$idCJ?>" || v_remove == "all"){ lCbusca<?=$INC_FAISHER["div"]?>('datai_b'); lCbusca<?=$INC_FAISHER["div"]?>('dataf_b'); }
	<?php $idCJ = "perfil_b";?>if(v_remove == "<?=$idCJ?>" || v_remove == "all"){ $('#<?=$formBusca?> #<?=$idCJ?>').select2("data", ''); }

	bAvancada<?=$INC_FAISHER["div"]?>();	
}//bAvancadaRemove
</script>
<form action="#" id="<?=$formBusca?>" method="POST" class='form-horizontal form-column form-bordered' onsubmit="return false;">
<input type='hidden' value="" name='perfil_f<?=$INC_FAISHER["div"]?>' id='perfil_f<?=$INC_FAISHER["div"]?>' class="limpaInput" />

	<div class="span6">
		<div class="control-group">
			<label for="textfield" class="control-label">Nome</label>
			<div class="controls">
				<div class="input-append"><input type="text" name="nome_b" id="nome_b" placeholder="Informe nome ou parte do nome" class="input-xlarge limpaInput"><button class="btn limpaCampo" type="button" style="display:none;" rel="tooltip" title="Limpar"><i class="icon-trash"></i></button></div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">Perfil de acesso</label>
			<div class="controls">
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#<?=$formBusca?> #perfil_b').select2({
		maximumSelectionSize: 1,//*/
   		multiple: true,
		placeholder: 'Perfil de acesso >> (comece a digitar para buscar)',
		ajax: {
			url: "geral/combo_ajax.php?ajax=perfilAcesso&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 100 // page size
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
	$("#<?=$formBusca?> #perfil_b").on("change", function(e){ bAvancada<?=$INC_FAISHER["div"]?>(); });	
});
</script>
<input type='hidden' value="" name='perfil_b' id='perfil_b' style=" width:100%;"/>
			</div>
		</div>
	</div><!-- End .span6 -->
    
	<div class="span6">
		<div class="control-group">
			<label for="textfield" class="control-label">Data de cadastro</label>
			<div class="controls">
				<div class="input-append"><input type="text" name="datai_b" id="datai_b" placeholder="Data inicial" class="input-medium mask_date datepick limpaInput"><button class="btn limpaCampo" type="button" style="display:none;" rel="tooltip" title="Limpar"><i class="icon-trash"></i></button></div> até 
				<div class="input-append"><input type="text" name="dataf_b" id="dataf_b" placeholder="Data final" class="input-medium mask_date datepick limpaInput"><button class="btn limpaCampo" type="button" style="display:none;" rel="tooltip" title="Limpar"><i class="icon-trash"></i></button></div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">&nbsp;</label>
			<div class="controls">&nbsp;</div>
		</div>
	</div><!-- End .span6 -->
    
	<div class="span12">
		<div class="form-actions">
			<button type="button" class="btn btn-primary enviaBt" onclick="bAvancada<?=$INC_FAISHER["div"]?>();"><i class="icon-search"></i> Buscar agora</button>
			<button type="button" class="btn" onclick="bAvancada<?=$INC_FAISHER["div"]?>Remove('all');$('#dAbusca<?=$INC_FAISHER["div"]?> .bt_expandebusca').click();">Cancelar/Ocultar</button>
		</div>
	</div>
</form>
<?php	
	

}//fim ajax  -------------------------------------------- <<<



























































































//AJAX (lista/preenche combox logradouro) ------------------------------------------------------------------>>>
if($ajax == "selLogradouro"){
	if(isset($_GET["page_limit"])){ $page_limit = $_GET["page_limit"]; }else{ $page_limit = "30"; }
	$sql_busca = "";
	//verifica se recebeu uma solicitação de busca por nome
	if((isset($_GET['term']) && strlen($_GET['term']) > 0)){
		$term = $_GET["term"];
		$sql_busca = " `logradouro` LIKE '%$term%'"; //condição
	}//fim da busca por nome

	
	//cria array de retorno
	$return_arr = array();
	$row_array = array();
	$ret = array();
	
	
	
	//verifica selecao de cidade
	if(isset($_GET["cidade"])){
		$cidade_id_b = $_GET["cidade"];
		if($sql_busca != ""){$sql_busca .= " AND ";}
		$sql_busca .= "`cidade_id` = '".$cidade_id_b."'";
		if($cidade_id_b == ""){
			//alimenta array de retorno
			$row_array['id'] = "0";
			$row_array['text'] = "Selecione primeiro uma cidade";
			array_push($return_arr,$row_array);
			
			//imprime JSON de retorno
			$ret['results'] = $return_arr;
			echo json_encode($ret);
			exit(0);
		}
	}//if(isset($_GET["cidade"])){
	
	if(strlen($term) <= 1){
		//alimenta array de retorno
		$row_array['id'] = "";
		$row_array['text'] = "Comece a digitar para buscar ou adicionar novo...";
		array_push($return_arr,$row_array);
	}else{
	
		//verifica se adiciona itens
		if((isset($_GET["add"])) and strlen($_GET['term']) > 0){
			if(ereg('[^0-9]',$term)){//so imprime se nao for numero
				//alimenta array de retorno
				$row_array['id'] = maiusculo($_GET['term']);
				$row_array['text'] = "NOVO: <b>".maiusculo($_GET['term'])."</b>";
				array_push($return_arr,$row_array);
			}
		}
		
//lista ALERTAS
	$campos = "logradouro";
	$tabela = "sys_perfil_deptos";
	$where = $sql_busca;
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "GROUP BY logradouro ORDER BY logradouro ASC",$page_limit);
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$legenda = $linha["logradouro"];
		
		//alimenta array de retorno
		$row_array['id'] = $legenda;
		$row_array['text'] = $legenda;
		array_push($return_arr,$row_array);

	}//fim while
	
	}//fim if(strlen($id) == 0){
	

	//imprime JSON de retorno
    $ret['results'] = $return_arr;
	echo json_encode($ret);

}//fim ajax -------------------<<<<
















































































//* ------------------------------------- ##### DADOS DO REGISTRO PADRAO #### --------------------------------------------*//





//AJAX QUE VISUALIZA REGISTRO ------------------------------------------------------------------>>>
if($ajax == "visualizar"){
	$id_a = $_GET["id_a"];
	$cont_encontrou = "0";

    //id temp para registro de array
    $array_temp = time().rand(9,99999).$cVLogin->getVarLogin("SYS_USER_ID");
	$formVisualizaPincipal = "formVisualizaPincipal".$array_temp;
	$tabela_lerLog = "sys_perfil_deptos";

	//faz o proximo e anterior
	$anterior = "0";
	$resu1 = fSQL::SQL_SELECT_SIMPLES("id", $tabela_lerLog, "id < '$id_a'", "ORDER BY id DESC", "1");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){ $anterior = $linha1["id"]; }//fim while
	$proximo = "0";
	$resu1 = fSQL::SQL_SELECT_SIMPLES("id", $tabela_lerLog, "id > '$id_a'", "ORDER BY id ASC", "1");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){ $proximo = $linha1["id"]; }//fim while
	

if($id_a != "0"){
	$campos = "*";
	$resu1 = fSQL::SQL_SELECT_SIMPLES($campos, "sys_perfil_deptos", "id = '$id_a'", "");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
	$id_a = $linha1["id"];
	$code_a = $linha1["code"];
	$perfil_id_a = $linha1["perfil_id"];
	$nome_a = $linha1["nome"];
	$fone1_a = $linha1["fone1"];
	$fone2_a = $linha1["fone2"];
	$obs_a = $linha1["obs"];
	$uf_a = $linha1["uf"];
	$cidade_id_a = $linha1["cidade_id"];
	$bairro_a = $linha1["bairro"];
	$logradouro_a = $linha1["logradouro"];
	$quadra_a = $linha1["quadra"];
	$lote_a = $linha1["lote"];
	$numero_a = $linha1["numero"];
	$complemento_a = $linha1["complemento"];
	$bloco_a = $linha1["bloco"];
	$sala_a = $linha1["sala"];
	$cep_a = $linha1["cep"];
	$lat_a = $linha1["lat"];
	$long_a = $linha1["long"];
	$status_a = $linha1["status"];
	$user_a = $linha1["user"];//quem realizou o cadastro
	$time_a = $linha1["time"]; //quando foi realizado o cadastro
	$user_a_a = $linha1["user_a"];//quel alterou o cadastro
	$sync_a = $linha1["sync"]; //quando foi alterado o cadastro
	$cont_encontrou++;
	}//fim while
}//fim do if if($id_a != "0"){





//verifica se nao encontrou nada
if($cont_encontrou == "0"){
	//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
	$cMSG->addMSG("SUCESSO","Erro na localização dos dados, atualize sua janela!<br>Sua permissão foi negada!");
	//MOSTRAR TODAS AS MENSAGENS CRIADAS -------------------------- CLASSE MENSAGENS ----------------------- ||||||||||||||
	$cMSG->imprimirMSG();//imprimir mensagens criadas
	exit(0);
}//verifica se nao encontrou nada
	
	
	
	
	//verifica se já existem usuarios utilizando
	$conta_users = fSQL::SQL_CONTAGEM("sys_permissao_grupos G, sys_login_pacote P, sys_login L", "( G.perfil_depto_id = '$id_a' OR G.perfil_deptos LIKE ',%".$id_a."%,' ) AND G.id = P.permissao_grupo_id AND P.usuarios_id = L.id AND L.status = '1'","","GROUP BY P.usuarios_id");
	if($conta_users >= "1"){
		$conta_users_n = "Em uso por $conta_users usuários(s)";
		$conta_users_n .= ' <a href="#" onclick="'.$cVLogin->linkMENU("1_usr_usuarios","VARS=DIV&depto_b=".$id_a).'return false;" class="btn"><i class="icon-group"></i> Ver</a>';
	}
	
	//verifica se já existem grupos utilizando
	$conta_grupos = fSQL::SQL_CONTAGEM("sys_permissao_grupos", "perfil_depto_id = '$id_a' OR perfil_deptos LIKE ',%".$id_a."%,'");
	if($conta_grupos >= "1"){
		$conta_grupos_n = "Em uso por $conta_grupos grupo(s) de acessos";
		$conta_grupos_n .= ' <a href="#" onclick="'.$cVLogin->linkMENU("1_usr_permissao_grupos","VARS=DIV&depto_b=".$id_a).'return false;" class="btn"><i class="icon-lock"></i> Ver</a>';
	}

	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES("id,nome,apelido", "sys_perfil", "id = '$perfil_id_a'", "");
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id = $linha["id"];
		$legenda = $linha["nome"];
		$apelido = $linha["apelido"];
		$perfil_id_n = '<b><i class="'.fGERAL::icoPerfil($id).'"></i> '.$legenda.'</b> ('.$apelido.')';
	}//fim while
	
	

	//busca UF
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES("uf_sigla,uf_nome", "combo_uf", "uf_sigla = '$uf_a'");
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id_i = $linha["uf_sigla"];
		$legenda_i = $linha["uf_nome"];
		$uf_a_n = $legenda_i;
	}//fim while

	//busca CIDADE
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES("id,cidade_nome,uf", "combo_cidades", "id = '$cidade_id_a'");
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id_i = $linha["id"];
		$legenda_i = $linha["cidade_nome"];
		$uf_i = $linha["uf"];
		$cidade_id_a_n = $legenda_i.'/'.$uf_i;
	}//fim while	


	$status_a_n = "ATIVO";
	if($status_a != "1"){
		$status_a_n = "<b>BLOQUEADO</b><br><i>Em ".date('d/m/Y H:i',$time_a)."h</i>";
	}


?>

<script type="text/javascript">
$(document).ready(function(){
	//JQUERY executa com ESC
    $(document).keyup(function(e){
        var tecla = (e.keyCode?e.keyCode:e.which);
        /* verifica se a tecla pressionada foi o ESC */
        if(tecla == 27){ if($('#idFaisher').val() == "<?=$INC_FAISHER["permissao"]?>"){ displayAcao<?=$INC_FAISHER["div"]?>('fecha'); }	}
    });
	//FIM JQUERY executa com ESC
	
	$('#c_id<?=$INC_FAISHER["div"]?>').val('<?=$id_a?>');//alimenta id de abertura
	$('#bt_visual<?=$INC_FAISHER["div"]?>').hide();
	$('#div_displayTitulo<?=$INC_FAISHER["div"]?>').html("VISUALIZAR DADOS DO DEPARTAMENTO #<?=fGERAL::legCode($id_a,$code_a)?>");

});
<?php if(!isset($_GET["POP"])){ ?>$.doTimeout('vTimerCursor<?=$INC_FAISHER["div"]?>', 500, function(){ ancoraHtml('#ancAcao<?=$INC_FAISHER["div"]?>'); });//TIMER<?php }else{ $anterior="0";$proximo="0";}?>
</script>

<form nome="<?=$formVisualizaPincipal?>" id="<?=$formVisualizaPincipal?>" method="post" class="form-horizontal form-column form-bordered form-validate" action="export.php" target="_blank">
             <div style="padding-top:1px;" id="formVisualizarMSG<?=$INC_FAISHER["div"]?>"></div>



                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadoscad".$array_temp;//id de controle
						$boxUI_titulo = "Dados de Identificação";// titulo
						$boxUI_status = "off";// 1 - aberto, 0 - fechado, off - desligado
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
            
										<?php $cont_exib++; $d["content"] = SYS_CONFIG_RM_LEG."[,]".fGERAL::legCode($id_a,$code_a); $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label"><?=SYS_CONFIG_RM_LEG_HTML?></label>
                                            <div class="pagination pagination-large">
                                                <ul>
                                                    <?php if($anterior >= "1"){?><li><a href="#" onclick="janelaAcao<?=$INC_FAISHER["div"]?>('visualizar','id_a=<?=$anterior?>');return false;" style="border:0;" rel="tooltip" data-placement="left" data-original-title="Anterior"><i class="icon-arrow-left"></i></a></li><?php }?>
                                                    <li><a href="#" id="selc<?=$INC_FAISHER["div"]?>" onclick="SelectText('selc<?=$INC_FAISHER["div"]?>');return false;" style="border:0; font-size:28px;" rel="tooltip" data-placement="bottom" data-original-title="Registro atual (clique para selecionar)"><?=fGERAL::legCode($id_a,$code_a)?></a></li>
                                                    <?php if($proximo >= "1"){?><li><a href="#" onclick="janelaAcao<?=$INC_FAISHER["div"]?>('visualizar','id_a=<?=$proximo?>');return false;" style="border:0;" rel="tooltip" data-placement="right" data-original-title="Próximo"><i class="icon-arrow-right"></i></a></li><?php }?>
                                                </ul>
                                            </div>
										</div>
										<?php $cont_exib++; $d["content"] = "Nome do departamento[,]".$nome_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Nome do departamento</label>
											<div class="controls display">
											  <?=$nome_a?>
											</div>
										</div>
                                        
                                        <div class="control-group row-fluid">            
										<?php if($fone1_a != ""){ $cont_exib++; $d["content"] = "Telefone principal[,]".$fone1_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
                                        <div class="<?php if($fone2_a != ""){echo "span6";}?>">
                                            <div class="control-group">
                                                <label class="control-label">Telefone principal</label>
                                                <div class="controls display">
                                                  <?=$fone1_a?>
                                                </div>
                                            </div>
										</div>
                                        <?php }?>                                           
										<?php if($fone2_a != ""){ $cont_exib++; $d["content"] = "Outro telefone[,]".$fone2_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
                                        <div class="<?php if($fone1_a != ""){echo "span6";}?>">
                                            <div class="control-group">
                                                <label class="control-label">Outro telefone</label>
                                                <div class="controls display">
                                                  <?=$fone2_a?>
                                                </div>
                                            </div>
										</div>
                                        <?php }?>     
										</div>
                                        <?php $cont_exib++; $d["content"] = "Perfil de acesso[,]".$perfil_id_n; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Perfil de acesso</label>
											<div class="controls display">
											  <?=$perfil_id_n?>
											</div>
										</div>
										<?php if($obs_a != ""){ $cont_exib++; $d["content"] = "Observações[,]".imprime_enter($obs_a); $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Observações</label>
											<div class="controls display">
											  <?=imprime_enter($obs_a)?>
											</div>
										</div>
                                        <?php }?> 
										<?php $cont_exib++; $d["content"] = "Status[,]".$status_a_n; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Status</label>
											<div class="controls display">
											  <?=$status_a_n?>
											</div>
										</div>
										<?php if($conta_users_n != ""){ $cont_exib++; $d["content"] = "Utilização por usuário[,]".$conta_users_n; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Utilização por usuário</label>
											<div class="controls display">
											  <?=$conta_users_n?>
											</div>
										</div>
                                        <?php }?>
										<?php if($conta_grupos_n != ""){ $cont_exib++; $d["content"] = "Utilização por grupo[,]".$conta_grupos_n; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Utilização por grupo</label>
											<div class="controls display">
											  <?=$conta_grupos_n?>
											</div>
										</div>
                                        <?php }?>

										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
<?php
//esconde accordion-group acima
if($cont_exib == "0"){ echo "<script> $(document).ready(function(){ $('#ac_".$boxUI_id."').hide(); }); </script>"; }else{
unset($d); $d["content"] = $PRINT_ARRAY; $d["titulo"] = $boxUI_titulo; $PRINT_DATA[] = $d; unset($PRINT_ARRAY); }






?>    

      







                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosender".$array_temp;//id de controle
						$boxUI_titulo = "Endereço do Local (é importante e disponível para candidato)";// titulo
						$boxUI_status = "0";// 1 - aberto, 0 - fechado, off - desligado
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
                                         
                                        <div class="control-group row-fluid">                                        
										<?php $cont_exib++; $d["content"] = "Estado/UF[,]".$uf_a_n; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label">Estado/UF</label>
                                                <div class="controls display">
                                                  <?=$uf_a_n?>
                                                </div>
                                            </div>
										</div>                        
										<?php $cont_exib++; $d["content"] = "Cidade[,]".$cidade_id_a_n; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label">Cidade</label>
                                                <div class="controls display">
                                                  <?=$cidade_id_a_n?>
                                                </div>
                                            </div>
										</div>
										</div>
                                        
                                        <div class="control-group row-fluid">                                        
										<?php $cont_exib++; $d["content"] = "Logradouro[,]".$logradouro_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label">Logradouro</label>
                                                <div class="controls display">
                                                  <?=$logradouro_a?>
                                                </div>
                                            </div>
										</div>                        
										<?php $cont_exib++; $d["content"] = "Bairro[,]".$bairro_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label">Bairro</label>
                                                <div class="controls display">
                                                  <?=$bairro_a?>
                                                </div>
                                            </div>
										</div>
										</div>
                                        
                                        <div class="control-group row-fluid">            
										<?php if($numero_a != ""){ $cont_exib++; $d["content"] = "Número[,]".$numero_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
                                        <div class="<?php if($complemento_a != ""){echo "span6";}?>">
                                            <div class="control-group">
                                                <label class="control-label">Número</label>
                                                <div class="controls display">
                                                  <?=$numero_a?>
                                                </div>
                                            </div>
										</div>
                                        <?php }?>                                           
										<?php if($complemento_a != ""){ $cont_exib++; $d["content"] = "Complemento[,]".$complemento_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
                                        <div class="<?php if($numero_a != ""){echo "span6";}?>">
                                            <div class="control-group">
                                                <label class="control-label">Complemento</label>
                                                <div class="controls display">
                                                  <?=$complemento_a?>
                                                </div>
                                            </div>
										</div>
                                        <?php }?>     
										</div>
                                        
                                        <div class="control-group row-fluid">            
										<?php if($quadra_a != ""){ $cont_exib++; $d["content"] = "Quadra[,]".$quadra_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
                                        <div class="<?php if($lote_a != ""){echo "span6";}?>">
                                            <div class="control-group">
                                                <label class="control-label">Quadra</label>
                                                <div class="controls display">
                                                  <?=$quadra_a?>
                                                </div>
                                            </div>
										</div>
                                        <?php }?>                                           
										<?php if($lote_a != ""){ $cont_exib++; $d["content"] = "Lote[,]".$lote_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
                                        <div class="<?php if($quadra_a != ""){echo "span6";}?>">
                                            <div class="control-group">
                                                <label class="control-label">Lote</label>
                                                <div class="controls display">
                                                  <?=$lote_a?>
                                                </div>
                                            </div>
										</div>
                                        <?php }?>     
										</div>
                                        
										<?php if($sala_a != ""){ $cont_exib++; $d["content"] = "Sala[,]".$sala_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Sala</label>
											<div class="controls display">
											  <?=$sala_a?>
											</div>
										</div>
                                        <?php }?>  
										<?php if($cep_a != ""){ $cont_exib++; $d["content"] = "CEP[,]".$cep_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">CEP</label>
											<div class="controls display">
											  <?=$cep_a?>
											</div>
										</div>
                                        <?php }?>     
                                        
                                        <div class="control-group">            
										<?php if($lat_a != ""){ $cont_exib++; $d["content"] = "Latitude[,]".$lat_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
                                        <div class="<?php if($long_a != ""){echo "span6";}?>">
                                            <div class="control-group">
                                                <label class="control-label">Latitude</label>
                                                <div class="controls display">
                                                  <?=$lat_a?>
                                                </div>
                                            </div>
										</div>
                                        <?php }?>                                           
										<?php if($long_a != ""){ $cont_exib++; $d["content"] = "Longitude[,]".$long_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
                                        <div class="<?php if($lat_a != ""){echo "span6";}?>">
                                            <div class="control-group">
                                                <label class="control-label">Longitude</label>
                                                <div class="controls display">
                                                  <?=$long_a?>
                                                </div>
                                            </div>
										</div>
                                        <?php }?>     
										</div> 
                                        
                                        <?php if(($lat_a != "") and ($long_a != "")){ $cont_exib++; $d["content"] = "Latitude/Longitude[,]".$lat_a.", ".$long_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>

<script type="text/javascript">

function btMapa<?=$INC_FAISHER["div"]?>(v_cao){
	if(v_cao == "fecha"){
		$('#<?=$formVisualizaPincipal?> #div_mapa').fadeOut();
		$('#<?=$formVisualizaPincipal?> #bt_mmapa').show();
	}else{
		$('#<?=$formVisualizaPincipal?> #bt_mmapa').hide();
		$('#<?=$formVisualizaPincipal?> #div_mapa').fadeIn(function(){ alinharMapa<?=$INC_FAISHER["div"]?>(); });		
	}
}//btMapa




function alinharMapa<?=$INC_FAISHER["div"]?>(){
	var zoom = 18;
	var position = [<?=$lat_a?>,<?=$long_a?>];
	$('#<?=$formVisualizaPincipal?> #mapa_alinha').gmap3({clear:{id:"marcaMapa"}});
	$("#<?=$formVisualizaPincipal?> #mapa_alinha").gmap3({
	  marker:{
		id:"marcaMapa",
		latLng: position,
		options:{
		  draggable:false
		}
	  },
	  map:{
		options:{
		  center: [<?=$lat_a?>,<?=$long_a?>],
		  zoom: zoom, 
      	  mapTypeId: google.maps.MapTypeId.HYBRID,
          streetViewControl: true
		}
	  }
	});
	$('#<?=$formVisualizaPincipal?> #mapa_alinha').gmap3({trigger:"resize"});
}//alinharMapa
function zoomMap<?=$INC_FAISHER["div"]?>(v_zoom){
	var zoom = Number(v_zoom);
	var position = [<?=$lat_a?>,<?=$long_a?>];
	$("#<?=$formVisualizaPincipal?> #mapa_alinha").gmap3({ map:{ options:{ center: position, zoom: zoom }}});
	$('#<?=$formVisualizaPincipal?> #mapa_alinha').gmap3({trigger:"resize"});

}//zoomMap
</script>
<style>
/* Bootstrap Css Map Fix*/
#mapa_alinha img { max-width: none; }
#mapa_alinha label { width: auto; display:inline; } 
</style>
										<div class="control-group">
											<label class="control-label">Mapa</label>
											<div class="controls">
<div class="row-fluid" id="bt_mmapa">
	<span class="help-block"><i class="icon-info-sign"></i> Latitude e longitude é a marcação da fachada de entrada.</span>
	<button type="button" class="btn" onclick="btMapa<?=$INC_FAISHER["div"]?>('abre');"><i class="icon-map-marker"></i> Abrir marcação no mapa</button>
</div>                                              

<div class="row-fluid" style="display:none;" id="div_mapa">
	<div>
    	<div style="float:left;" rel="tooltip" title="Ampliar/reduzir imagem do mapa!">
            <button type="button" class="btn" onclick="zoomMap<?=$INC_FAISHER["div"]?>('12');"><i class="icon-zoom-in"></i>12</button>
            <button type="button" class="btn" onclick="zoomMap<?=$INC_FAISHER["div"]?>('13');"><i class="icon-zoom-in"></i>13</button>
            <button type="button" class="btn" onclick="zoomMap<?=$INC_FAISHER["div"]?>('14');"><i class="icon-zoom-in"></i>14</button>
            <button type="button" class="btn" onclick="zoomMap<?=$INC_FAISHER["div"]?>('16');"><i class="icon-zoom-in"></i>16</button>
            <button type="button" class="btn" onclick="zoomMap<?=$INC_FAISHER["div"]?>('17');"><i class="icon-zoom-in"></i>17</button>
            <button type="button" class="btn" onclick="zoomMap<?=$INC_FAISHER["div"]?>('18');"><i class="icon-zoom-in"></i>18</button>
            <button type="button" class="btn" onclick="zoomMap<?=$INC_FAISHER["div"]?>('19');"><i class="icon-zoom-in"></i>19</button>
        </div>
    	<div style="float:right;"><button type="button" class="btn" onclick="btMapa<?=$INC_FAISHER["div"]?>('fecha');"><i class="icon-ok-sign"></i> Ocultar mapa</button></div>
    </div>
	<div style="width:100%; height:500px; border:#CCC 1px solid; clear:both;" id="mapa_alinha"></div>
    <div><button type="button" class="btn" style="width:100%;" onclick="btMapa<?=$INC_FAISHER["div"]?>('fecha');"><i class="icon-ok-sign"></i> FECHAR MARCAÇÃO NO MAPA</button></div>
</div>
											</div>
										</div> 
                                        <?php }?> 

										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
<?php
//esconde accordion-group acima
if($cont_exib == "0"){ echo "<script> $(document).ready(function(){ $('#ac_".$boxUI_id."').hide(); }); </script>"; }else{
unset($d); $d["content"] = $PRINT_ARRAY; $d["titulo"] = $boxUI_titulo; $PRINT_DATA[] = $d; unset($PRINT_ARRAY); }






?>             
            
                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "infregistro".$array_temp;//id de controle
						$boxUI_titulo = "Informações do Registro";// titulo
						$boxUI_status = "0";// 1 - aberto, 0 - fechado, off - desligado
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
                                        
										
										<?php $cont_exib++; $d["content"] = "Data de cadastro[,]".$user_a.", ".date("d/m/Y H:i",$time_a)."h"; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Data de cadastro</label>
											<div class="controls display">
											  <?=$user_a?>, <?=date("d/m/Y H:i",$time_a)?>h
											</div>
										</div>
                                        <?php if(($user_a_a != "") and ($user_a_a != "0")){ $cont_exib++; $d["content"] = "Data de alteração[,]".$user_a_a.", ".date("d/m/Y H:i",$sync_a)."h"; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Data de alteração</label>
											<div class="controls display">
											  <?=$user_a_a?>, <?=date("d/m/Y H:i",$sync_a)?>h
											</div>
										</div>
                                        <?php }//if($time_a_a >= "1"){?>
  
                                        <?php if($id_a >= "1"){ ?>
										<div class="control-group">
											<label class="control-label">Log</label>
                                            <div class="controls divLerLog<?=$INC_FAISHER["div"]?>_oculta">
                                            <button type="button" class="btn btn-large" onclick="lerLog('divLerLog<?=$INC_FAISHER["div"]?>','<?=$tabela_lerLog?>','<?=$id_a?>');"><i class="icon-magic"></i> Carregar histórico de alterações do registro <img src="img/ajax-qloader-preto-p.gif" width="18" height="18" style="display:none;" id="divLerLog<?=$INC_FAISHER["div"]?>_load" /></button></div>
                                            <div class="controls divLerLog<?=$INC_FAISHER["div"]?>_exibe" style="display:none;">
                                            <a href="#" onclick="$('.divLerLog<?=$INC_FAISHER["div"]?>_exibe, #divLerLog<?=$INC_FAISHER["div"]?>').hide();$('.divLerLog<?=$INC_FAISHER["div"]?>_oculta').fadeIn();return false;" class="btn btn-large" rel="tooltip" title="Visualizar"><i class="icon-eye-close"></i> Ocultar</a></div>
											<div class="controls" id="divLerLog<?=$INC_FAISHER["div"]?>"></div>
										</div>
                                        <?php }//if($id_a >= "1"){?>


									  </div><!-- End .accordion-inner -->
									</div>
                            </div>
                                                    <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
                          </div><!-- End .accordion-widget ----------------------------------------------- -->
<?php
//esconde accordion-group acima
unset($d); $d["content"] = $PRINT_ARRAY; $d["titulo"] = $boxUI_titulo; $PRINT_DATA[] = $d; unset($PRINT_ARRAY);





?>  



  									<div class="form-actions">
											<?php if(isset($_GET["POP"])){ ?>
                                            <button type="button" class="btn btn-large" rel="tooltip" data-original-title="Ocultar Janela" onclick="pmodalDisplay('hide');">Fechar Detalhes</button>
                                            <script> $.doTimeout('vTimerCursor<?=$INC_FAISHER["div"]?>', 1000, function(){ $("#pModalConteudo").scrollTop(0); }); </script>
											<?php }else{//if(isset($_GET["POP"])){ ?>
                                            <button type="button" class="btn btn-large btn-primary" rel="tooltip" data-original-title="Exportar PDF" onclick="enviaPDF<?=$INC_FAISHER["div"]?>();">Gerar PDF(imprimir)</button>&nbsp;<button type="button" class="btn btn-large btn-primary" rel="tooltip" data-original-title="Exportar CSV" onclick="enviaCSV<?=$INC_FAISHER["div"]?>();">Gerar CSV</button>&nbsp;<button type="button" class="btn btn-large esconder-sendload<?=$INC_FAISHER["div"]?>" onclick="displayAcao<?=$INC_FAISHER["div"]?>('fecha');">Fechar</button>
											<?php }//if(isset($_GET["POP"])){ ?>
										</div>

  <input name="acao" id="acao" type="hidden" value="print" />
  <input name="nome" id="nome" type="hidden" value="cadastro_departamentos_<?=$id_a?>-<?=date('d-m-Y')?>" />
  <input name="titulo" id="titulo" type="hidden" value="Departamentos" />
  <input name="dados" id="dados" type="hidden" value="<?=urlencode(serialize($PRINT_DATA))?>" />
  <input name="head" id="head" type="hidden" value="" /><input name="html" id="html" type="hidden" value="" />
</form>
<script type="text/javascript">
//prepara o envio do CSV
function enviaCSV<?=$INC_FAISHER["div"]?>(){
	$('#<?=$formVisualizaPincipal?> #acao').val('csv');
	$('#<?=$formVisualizaPincipal?> #head').val('');
	$('#<?=$formVisualizaPincipal?> #html').val('');
	$('#<?=$formVisualizaPincipal?>').submit();
}
//prepara o envio do PDF
function enviaPDF<?=$INC_FAISHER["div"]?>(){
	$('#<?=$formVisualizaPincipal?> #acao').val('pdf');
	$('#<?=$formVisualizaPincipal?> #head').val('');
	$('#<?=$formVisualizaPincipal?> #html').val('');
	$('#<?=$formVisualizaPincipal?>').submit();
}
</script>
<?php




}//fim ajax  -------------------------------------------- <<<
?>
<?php



















//AJAX QUE EXIBE REGISTRO ------------------------------------------------------------------>>>
if($ajax == "registro"){
	$id_a = $_GET["id_a"];

    //id temp para registro de array
    $array_temp = time().rand(9,99999).$cVLogin->getVarLogin("SYS_USER_ID");
	$formCadastroPincipal = "formCadastroPincipal".$array_temp;
	$tabela_lerLog = "sys_perfil_deptos";

	//faz o proximo e anterior
	if(isset($_GET["anterior"])){ $id_a = "0";
		$anterior = getpost_sql($_GET["anterior"]); if($anterior == ""){ $anterior = "9999999999999999999999"; }
		$resu1 = fSQL::SQL_SELECT_SIMPLES("id", $tabela_lerLog, "id < '$anterior'", "ORDER BY id DESC", "1");
		while($linha1 = fSQL::FETCH_ASSOC($resu1)){ $id_a = $linha1["id"]; }//fim while
	}//anterior
	if(isset($_GET["proximo"])){ $id_a = "0";
		$proximo = getpost_sql($_GET["proximo"]); if($proximo == ""){ $proximo = "0"; }
		$resu1 = fSQL::SQL_SELECT_SIMPLES("id", $tabela_lerLog, "id > '$proximo'", "ORDER BY id ASC", "1");
		while($linha1 = fSQL::FETCH_ASSOC($resu1)){ $id_a = $linha1["id"]; }//fim while
	}//anterior
	if(isset($_GET["code"])){ $id_a = "0";
		$aCode = fGERAL::codeRandRetorno(getpost_sql($_GET["code"]));
		$resu1 = fSQL::SQL_SELECT_SIMPLES("id", $tabela_lerLog, "id = '".$aCode["id"]."'", "ORDER BY id ASC", "1");
		while($linha1 = fSQL::FETCH_ASSOC($resu1)){ $id_a = $linha1["id"]; }//fim while
	}//code


if($id_a != "0"){
	$cont = "0";
	$campos = "*";
	$resu1 = fSQL::SQL_SELECT_SIMPLES($campos, "sys_perfil_deptos", "id = '$id_a'", "");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
	$id_a = $linha1["id"];
	$code_a = $linha1["code"];
	$perfil_id_a = $linha1["perfil_id"];
	$nome_a = $linha1["nome"];
	$fone1_a = $linha1["fone1"];
	$fone2_a = $linha1["fone2"];
	$obs_a = $linha1["obs"];
	$uf_a = $linha1["uf"];
	$cidade_id_a = $linha1["cidade_id"];
	$bairro_a = $linha1["bairro"];
	$logradouro_a = $linha1["logradouro"];
	$quadra_a = $linha1["quadra"];
	$lote_a = $linha1["lote"];
	$numero_a = $linha1["numero"];
	$complemento_a = $linha1["complemento"];
	$bloco_a = $linha1["bloco"];
	$sala_a = $linha1["sala"];
	$cep_a = $linha1["cep"];
	$lat_a = $linha1["lat"];
	$long_a = $linha1["long"];
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
		$cMSG->addMSG("ERRO","Erro na localização dos dados, atualize sua janela!<br>Sua permissão foi negada!");
		//MOSTRAR TODAS AS MENSAGENS CRIADAS -------------------------------- MENSAGENS ------------------------- ||||||||||||||
		$cMSG->imprimirMSG();//imprimir mensagens criadas
		exit(0);
	}//verifica se nao encontrou nada
	
	//verifica se já existem grupos utilizando
	$conta_grupos = fSQL::SQL_CONTAGEM("sys_permissao_grupos", "perfil_depto_id = '$id_a' OR perfil_deptos LIKE ',%".$id_a."%,'");

	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES("id,nome,apelido", "sys_perfil", "id = '$perfil_id_a'", "");
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id = $linha["id"];
		$legenda = $linha["nome"];
		$apelido = $linha["apelido"];
		$perfil_id_data = '{id: "'.$id.'", text: "<b><i class=\''.fGERAL::icoPerfil($id).'\'></i> '.$legenda.'</b> ('.$apelido.')"}';
	}//fim while


		
	//busca UF
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES("uf_sigla,uf_nome", "combo_uf", "uf_sigla = '$uf_a'");
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id_i = $linha["uf_sigla"];
		$legenda_i = $linha["uf_nome"];
		$uf_a_data = '{id: "'.$id_i.'", text: "'.$legenda_i.'"}';
	}//fim while

	//busca CIDADE
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES("id,cidade_nome,uf", "combo_cidades", "id = '$cidade_id_a'");
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id_i = $linha["id"];
		$legenda_i = $linha["cidade_nome"];
		$uf_i = $linha["uf"];
		$cidade_id_a_data = '{id: "'.$id_i.'", text: "'.$legenda_i.'/'.$uf_i.'"}';
	}//fim while	

	//preenche campo bairro livre
	if($bairro_a != ""){
		$bairro_a_data = '{id: "'.$bairro_a.'", text: "'.$bairro_a.'"}';		
	}//if($bairro_a != ""){

	//preenche campo logradouro livre
	if($logradouro_a != ""){
		$logradouro_a_data = '{id: "'.$logradouro_a.'", text: "'.$logradouro_a.'"}';		
	}//if($logradouro_a != ""){
		
			
		
		

}//fim do if if($id_a != "0"){




//limpa campos se o registro e novo
if($id_a == "0"){
	$nome_a = "";
	$fone1_a = "";
	$fone2_a = "";
	$obs_a = "";
	$uf_a = "";
	$cidade_id_a = "";
	$bairro_a = "";
	$logradouro_a = "";
	$quadra_a = "";
	$lote_a = "";
	$numero_a = "";
	$complemento_a = "";
	$bloco_a = "";
	$sala_a = "";
	$cep_a = "";
	$status_a = "1";
	
//zera as vars de data
	$user_a = $cVLogin->userReg();//quem realizou o cadastro
	$time_a = time(); //quando foi realizado o cadastro
	$user_a_a = "";//quel alterou o cadastro
	$sync_a = time(); //quando foi alterado o cadastro

}//limpa os campos se o registro e novo

?>

<script type="text/javascript">
<?php if(isset($_GET["POP"])){ ?>
	$(document).ready(function(){ $('#<?=$formCadastroPincipal?> #div_idred<?=$INC_FAISHER["div"]?>').html('<b><?php if($id_a >= "1"){ echo $id_a; }else{ echo "NOVO REGISTRO";}?></b>'); });
	$.doTimeout('vTimerCursor<?=$INC_FAISHER["div"]?>', 1000, function(){ $("#pModalConteudo").scrollTop(0); });//TIMER
<?php }else{ //if(isset($_GET["POP"])){ ?>
	$(document).ready(function(){
		//JQUERY executa com ESC
		$(document).keyup(function(e){
			var tecla = (e.keyCode?e.keyCode:e.which);
			/* verifica se a tecla pressionada foi o ESC */
			if(tecla == 27){ if($('#idFaisher').val() == "<?=$INC_FAISHER["permissao"]?>"){ displayAcao<?=$INC_FAISHER["div"]?>('fecha'); }	}
		});
		//FIM JQUERY executa com ESC
		//JQUERY executa com ENTER
			/* ao pressionar uma tecla em um campo*/
			$("#id_inc<?=$INC_FAISHER["div"]?>").keypress(function(e){
				var tecla = (e.keyCode?e.keyCode:e.which);
				var val = Number($(this).val());
				/* verifica se a tecla pressionada foi o ENTER */
				if((tecla == 13) && (val >= "1")){//codigo a executar	
					janelaAcao<?=$INC_FAISHER["div"]?>('registro','id_a='+val);
					return false;/* impede o sumbit caso esteja dentro de um form */
				}
			})
		//FIM JQUERY executa com ENTER
		
		$('#c_id<?=$INC_FAISHER["div"]?>').val('<?=$id_a?>');//alimenta id de abertura
		<?php if($id_a == "0"){ ?>
		$('#div_displayTitulo<?=$INC_FAISHER["div"]?>').html("CADASTRAR NOVO DEPARTAMENTO NO SISTEMA");
		$('#bt_edit<?=$INC_FAISHER["div"]?>, #bt_visual<?=$INC_FAISHER["div"]?>').hide();
		<?php }else{ ?>
		$('#div_displayTitulo<?=$INC_FAISHER["div"]?>').html("EDITAR CADASTRO DEPARTAMENTO NO SISTEMA #<?=fGERAL::legCode($id_a,$code_a)?>");
		$('#bt_edit<?=$INC_FAISHER["div"]?>').hide();
		<?php }?>
	
	});
	<?php if($id_a == "0"){ ?>
	$.doTimeout('vTimerCursor<?=$INC_FAISHER["div"]?>', 500, function(){ ancoraHtml('#ancAcao<?=$INC_FAISHER["div"]?>'); $('#<?=$formCadastroPincipal?> #nome').focus(); });//TIMER
	<?php }?>
<?php }//else{ //if(isset($_GET["POP"])){ ?>
</script>
<?php

/////////// INCLUDE JS EXCLUSIVO --------------------- 
$INC_JS = ",icheck,";//informar funcao a usar entre VIRGULAS > ,funcao
$INC_JSCSS = $INC_FAISHER["div"];
include "inc/inc_js-exclusivo.php";



?>

<div id="divContent_loader<?=$array_temp?>">
<form id="<?=$formCadastroPincipal?>" name="<?=$formCadastroPincipal?>" action="#" method="POST" class='form-horizontal form-bordered form-validate' enctype='multipart/form-data' onsubmit="sendFormCadastroPincipal<?=$array_temp?>();return false;">

             <input name="id_a" type="hidden" id="id_a" value="<?=$id_a?>" />
             <input name="array_temp" id="array_temp" type="hidden" value="<?=$array_temp?>" />  
             <div style="padding-top:1px;" id="formPrincipalMSG<?=$INC_FAISHER["div"].$array_temp?>"></div>



                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadoscontrole".$array_temp;//id de controle
						$boxUI_titulo = "Dados de Identificação";// titulo
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
											<label class="control-label"><?=SYS_CONFIG_RM_LEG_HTML?></label>
											<div class="controls" id="div_idred<?=$INC_FAISHER["div"]?>">
												<div class="input-append input-prepend">
												  <button class="btn" type="button" onclick="regAnt<?=$INC_FAISHER["div"]?>($('#id_inc<?=$INC_FAISHER["div"]?>').val());" rel="tooltip" data-placement="left" data-original-title="Registro anterior"><i class="icon-arrow-left"></i></button>
													<input type="text" class='input-medium' id="id_inc<?=$INC_FAISHER["div"]?>" placeholder="<?php if($id_a >= "1"){ echo fGERAL::legCode($id_a,$code_a); }else{ echo "NOVO REGISTRO"; }?>" style="text-align:center;" value="<?php if($id_a >= "1"){ echo fGERAL::legCode($id_a,$code_a); }?>" rel="tooltip" data-placement="bottom" data-original-title="Informe para buscar [Enter]">
													<button class="btn" type="button" onclick="regPro<?=$INC_FAISHER["div"]?>($('#id_inc<?=$INC_FAISHER["div"]?>').val());" rel="tooltip" data-placement="right" data-original-title="Próximo registro"><i class="icon-arrow-right"></i></button>
												</div>
											</div>
										</div>                                      
										<div class="control-group">
											<label class="control-label">Nome do departamento</label>
											<div class="controls">
											  <input type="text" name="nome" id="nome" value="<?=$nome_a?>" class="input-xlarge span9 cssFonteMai" data-rule-required="true">
											</div>
										</div>
										<div class="control-group row-fluid">
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label">Telefone principal</label>
                                                <div class="controls">
                                                  <input type="text" name="fone1" id="fone1" value="<?=$fone1_a?>" class="span6 mask_phone">
                                                </div>
                                            </div>
										</div>
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label">RAMAL</label>
                                                <div class="controls">
                                                  <input type="text" name="fone2" id="fone2" value="<?=$fone2_a?>" class="span6 mask_phone">
                                                </div>
                                            </div>
										</div>
										</div>
										<div class="control-group">
											<label class="control-label"> Perfil/setor</label>
											<div class="controls">
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#<?=$formCadastroPincipal?> #perfil_id').select2({
		maximumSelectionSize: 1,//*/
   		multiple: true,
		placeholder: 'Selecione um perfil/setor >> (comece a digitar para buscar)',
		ajax: {
			url: "geral/combo_ajax.php?ajax=perfilAcesso&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 100 // page size
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
	<?php if($perfil_id_data != ""){ ?>$("#<?=$formCadastroPincipal?> #perfil_id").select2("data", <?=$perfil_id_data?>);<?php }?>
	$("#<?=$formCadastroPincipal?> #perfil_id").on("change", function(e){
		if(($(this).val() == "0") || ($(this).val() == "")){ $('#<?=$formCadastroPincipal?> #perfil_depto_id').select2("data", ''); }
		listaPermissoes<?=$INC_FAISHER["div"]?>('');
	});
	<?php if($conta_grupos >= "1"){?>$("#<?=$formCadastroPincipal?> #perfil_id").select2("readonly", true);<?php }?>
	
	
	
});
</script>
<input type='hidden' value="" name='perfil_id' id='perfil_id' style=" width:100%;"/>
                                              <span class="help-block"><i class="icon-info-sign"></i> Perfil/setor responsável pelo departamento.</span>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Observações</label>
											<div class="controls">
												<textarea name="obs" id="obs" rows="3" class="input-block-level cssFonteMai" placeholder="Observações"><?=$obs_a?></textarea>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Status da utilização no sistema</label>
											<div class="controls">
												<div class="check-demo-col">
													<div class="check-line">
														<input name="status" type="radio" class='<?=$INC_FAISHER["div"]?>-icheck' id="status1" value="1" data-skin="square" data-color="green" <?php if($status_a == "1"){ echo 'checked="checked"'; }?>> <label class='inline' for="status1">Ativo (disponível)</label>
												  </div>
												</div>
												<div class="check-demo-col">
													<div class="check-line">
														<input name="status" type="radio" class='<?=$INC_FAISHER["div"]?>-icheck' id="status2" value="0" data-skin="square" data-color="red" <?php if($status_a != "1"){ echo 'checked="checked"'; }?>> <label class='inline' for="status2">Bloqueado (indisponível<?php if(($status_a != "1") and ($time_a >= "10")){ echo " ".date("d/m/Y H:i",$time_a)."h"; }?>)</label>
												  </div>
												</div>
											</div>
										</div>
                                        
                                        <?php if($conta_grupos >= "1"){ ?>
										<div class="control-group">
											<label class="control-label">Utilização</label>
											<div class="controls display">
											  Já em uso por <?=$conta_grupos?> grupo(s) de acessos
											</div>
										</div>
                                        <?php }//if($conta_grupos >= "1"){ ?>
                                        
										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
            
            
            




            
            





                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosender".$array_temp;//id de controle
						$boxUI_titulo = "Endereço do Local (é obrigatório e importante)";// titulo
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
                                        
  
										<div class="control-group row-fluid">
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label">Subdivisão</label>
                                                <div class="controls">
<input type='hidden' value="" name='uf' id='uf' style="width:98%;"/>
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#<?=$formCadastroPincipal?> #uf').select2({
		/*maximumSelectionSize: 1,multiple: true,//*/
		placeholder: 'Selecionar um subdivisão >> (comece a digitar para buscar)',
		ajax: {
			url: "geral/combo_ajax.php?ajax=uf&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 100 // page size
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
	<?php if($uf_a_data != ""){?>$("#<?=$formCadastroPincipal?> #uf").select2("data", <?=$uf_a_data?>);<?php }?>
	$("#<?=$formCadastroPincipal?> #uf").on("change", function(e){ $('#<?=$formCadastroPincipal?> #cidade_id').select2("data", ''); });	
});
</script>
                                                </div>
                                            </div>
										</div>
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label">Prefeitura</label>
                                                <div class="controls">
<input type='hidden' value="" name='cidade_id' id='cidade_id' style="width:98%;"/>
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#<?=$formCadastroPincipal?> #cidade_id').select2({
		/*maximumSelectionSize: 1,multiple: true,//*/
		placeholder: 'Selecionar uma prefeitura >> (comece a digitar para buscar)',
		ajax: {
			url: "geral/combo_ajax.php?ajax=cidade&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 100, // page size
					uf: $("#<?=$formCadastroPincipal?> #uf").val()
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
	<?php if($cidade_id_a_data != ""){?>$("#<?=$formCadastroPincipal?> #cidade_id").select2("data", <?=$cidade_id_a_data?>);<?php }?>
});
</script>
                                                </div>
                                            </div>
										</div>
										</div>
										<div class="control-group row-fluid">
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label">Logradouro</label>
                                                <div class="controls">
<input type='hidden' value="" name='logradouro' id='logradouro' style="width:98%;"/>
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#<?=$formCadastroPincipal?> #logradouro').select2({
		/*maximumSelectionSize: 1,multiple: true,//*/
		placeholder: 'Selecionar um logradouro >> (comece a digitar para buscar/adicionar)',
		ajax: {
			url: "<?=$AJAX_PAG?>?faisher=<?=$faisher?>&ajax=selLogradouro&add&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 50, // page size
					cidade: $("#<?=$formCadastroPincipal?> #cidade_id").val()
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
	<?php if($logradouro_a_data != ""){?>$("#<?=$formCadastroPincipal?> #logradouro").select2("data", <?=$logradouro_a_data?>);<?php }?>
});
</script>
                                                </div>
                                            </div>
										</div>
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label">Bairro</label>
                                                <div class="controls">
<input type='hidden' value="" name='bairro' id='bairro' style="width:98%;"/>
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#<?=$formCadastroPincipal?> #bairro').select2({
		/*maximumSelectionSize: 1,multiple: true,//*/
		placeholder: 'Selecionar um bairro >> (comece a digitar para buscar)',
		ajax: {
			url: "geral/combo_ajax.php?ajax=comboBairros&add&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 100, // page size
					cidade: $("#<?=$formCadastroPincipal?> #cidade_id").val()
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
	<?php if($bairro_a_data != ""){?>$("#<?=$formCadastroPincipal?> #bairro").select2("data", <?=$bairro_a_data?>);<?php }?>
});
</script>
                                                </div>
                                            </div>
										</div>
										</div>
										<div class="control-group row-fluid">
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label">Número</label>
                                                <div class="controls">
                                                  <input type="text" name="numero" id="numero" value="<?=$numero_a?>" class="span6 cssFonteMai">
                                                </div>
                                            </div>
										</div>
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label">Complemento</label>
                                                <div class="controls">
                                                  <input type="text" name="complemento" id="complemento" value="<?=$complemento_a?>" class="span6 cssFonteMai">
                                                </div>
                                            </div>
										</div>
										</div>
										<div class="control-group row-fluid">
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label">Referência</label>
                                                <div class="controls">
                                                  <input type="text" name="quadra" id="quadra" value="<?=$quadra_a?>" class="span6 cssFonteMai">
                                                </div>
                                            </div>
										</div>
										</div>
										<div class="control-group">
											<label class="control-label">Sala</label>
											<div class="controls">
											  <input type="text" name="sala" id="sala" value="<?=$sala_a?>" class="span6 cssFonteMai">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">CEP</label>
											<div class="controls">
											  <input type="text" name="cep" id="cep" value="<?=$cep_a?>" class="span3 mask_cep">
											</div>
										</div>
										<div class="control-group row-fluid">
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label">Latitude</label>
                                                <div class="controls">
                                                    <div class="input-append">
                                                        <input type="text" name="lat" id="lat" value="<?=$lat_a?>" class="span10" data-rule-required="true">
                                                        <span class="add-on"><i class="icon-map-marker"></i></span>
                                                    </div>
                                                </div>
                                            </div>
										</div>
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label">Longitude</label>
                                                <div class="controls">
                                                    <div class="input-append">
                                                        <input type="text" name="long" id="long" value="<?=$long_a?>" class="span10" data-rule-required="true">
                                                        <span class="add-on"><i class="icon-map-marker"></i></span>
                                                    </div>
                                                </div>
                                            </div>
										</div>
										</div>   
                                        

<script type="text/javascript">

function btMapa<?=$INC_FAISHER["div"]?>(v_cao){
	if(v_cao == "fecha"){
		$('#<?=$formCadastroPincipal?> #div_mapa').fadeOut();
		$('#<?=$formCadastroPincipal?> #bt_mmapa').show();
	}else{
		$('#<?=$formCadastroPincipal?> #bt_mmapa').hide();
		$('#<?=$formCadastroPincipal?> #div_mapa').fadeIn(function(){ alinharMapa<?=$INC_FAISHER["div"]?>(); });		
	}
}//btMapa




function alinharMapa<?=$INC_FAISHER["div"]?>(){
	var zoom = 17;
	var position = [<?=SYS_CLIENTE_CIDADEGEO?>];
	if($("#<?=$formCadastroPincipal?> #lat").val() != "" && $("#<?=$formCadastroPincipal?> #long").val() != ""){
		var position = [$("#<?=$formCadastroPincipal?> #lat").val(),$("#<?=$formCadastroPincipal?> #long").val()];
		zoom = 14;
	}	
	$('#<?=$formCadastroPincipal?> #mapa_alinha').gmap3({clear:{id:"marcaMapa"}});
	$("#<?=$formCadastroPincipal?> #mapa_alinha").gmap3({
	  marker:{
		id:"marcaMapa",
		latLng: position,
		options:{
		  draggable:true
		},
		events:{
		  dragend:function(marker, event){
			  $('#<?=$formCadastroPincipal?> #lat').val( marker.position.lat() );
			  $('#<?=$formCadastroPincipal?> #long').val( marker.position.lng() );
			  $(this).gmap3({ map:{ options:{ center: [marker.position.lat(),marker.position.lng()],animation: google.maps.Animation.DROP}}});
			}
		}
	  },
	  map:{
		options:{
		  center: [<?=SYS_CLIENTE_CIDADEGEO?>],
		  zoom: zoom, 
      	  mapTypeId: google.maps.MapTypeId.HYBRID,
          streetViewControl: true
		}
	  }
	});
	$('#<?=$formCadastroPincipal?> #mapa_alinha').gmap3({trigger:"resize"});
}//alinharMapa
function zoomMap<?=$INC_FAISHER["div"]?>(v_zoom){
	var zoom = Number(v_zoom);
	var position = [<?=SYS_CLIENTE_CIDADEGEO?>];
	if($("#<?=$formCadastroPincipal?> #lat").val() != "" && $("#<?=$formCadastroPincipal?> #long").val() != ""){
		var position = [$("#<?=$formCadastroPincipal?> #lat").val(),$("#<?=$formCadastroPincipal?> #long").val()];
	}
	$("#<?=$formCadastroPincipal?> #mapa_alinha").gmap3({ map:{ options:{ center: position, zoom: zoom }}});
	$('#<?=$formCadastroPincipal?> #mapa_alinha').gmap3({trigger:"resize"});

}//zoomMap
</script>
<style>
/* Bootstrap Css Map Fix*/
#mapa_alinha img { max-width: none; }
#mapa_alinha label { width: auto; display:inline; } 
</style>
										<div class="control-group">
											<label class="control-label">Mapa</label>
											<div class="controls">
<div class="row-fluid" id="bt_mmapa">
	<span class="help-block"><i class="icon-info-sign"></i> Latitude e longitude é a marcação da fachada/porta de entrada principal.<br>MESMO NÃO CONSEGUINDO A LOCALIZAÇÃO EXATA, ESSA LOCALIZAÇÃO VAI AUXILIAR O CANDIDATO.<br></span>
	<button type="button" class="btn" onclick="btMapa<?=$INC_FAISHER["div"]?>('abre');"><i class="icon-map-marker"></i> Abrir marcação no mapa</button>
</div>                                              

<div class="row-fluid" style="display:none;" id="div_mapa">
	<div>
    	<div style="float:left;" rel="tooltip" title="Ampliar/reduzir imagem do mapa!">
            <button type="button" class="btn" onclick="zoomMap<?=$INC_FAISHER["div"]?>('12');"><i class="icon-zoom-in"></i>12</button>
            <button type="button" class="btn" onclick="zoomMap<?=$INC_FAISHER["div"]?>('13');"><i class="icon-zoom-in"></i>13</button>
            <button type="button" class="btn" onclick="zoomMap<?=$INC_FAISHER["div"]?>('14');"><i class="icon-zoom-in"></i>14</button>
            <button type="button" class="btn" onclick="zoomMap<?=$INC_FAISHER["div"]?>('16');"><i class="icon-zoom-in"></i>16</button>
            <button type="button" class="btn" onclick="zoomMap<?=$INC_FAISHER["div"]?>('17');"><i class="icon-zoom-in"></i>17</button>
            <button type="button" class="btn" onclick="zoomMap<?=$INC_FAISHER["div"]?>('18');"><i class="icon-zoom-in"></i>18</button>
            <button type="button" class="btn" onclick="zoomMap<?=$INC_FAISHER["div"]?>('19');"><i class="icon-zoom-in"></i>19</button>
        </div>
    	<div style="float:left; padding-left:20px;"><i class="icon-map-marker" style="font-size:15px;"></i> Alinhar no mapa (arraste o marcador abaixo até o ponto desejado)</div>
    	<div style="float:right;"><button type="button" class="btn" onclick="btMapa<?=$INC_FAISHER["div"]?>('fecha');"><i class="icon-ok-sign"></i> Ocultar mapa</button></div>
    </div>
	<div style="width:100%; height:500px; border:#CCC 1px solid; clear:both;" id="mapa_alinha"></div>
    <div><button type="button" class="btn" style="width:100%;" onclick="btMapa<?=$INC_FAISHER["div"]?>('fecha');"><i class="icon-ok-sign"></i> FINALIZAR MARCAÇÃO NO MAPA</button></div>
</div>
											</div>
										</div>
                                        
										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
            
            

            
            
            
            
                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "infcadastrais".$array_temp;//id de controle
						$boxUI_titulo = "Informações do Registro";// titulo
						$boxUI_status = "0";// 1 - aberto, 0 - fechado, off - desligado
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
											<label class="control-label">Data de cadastro</label>
											<div class="controls display">
											  <?=$user_a?>, <?=date("d/m/Y H:i",$time_a)?>h
											</div>
										</div>
                                        <?php if(($user_a_a != "") and ($user_a_a != "0")){ ?>
										<div class="control-group">
											<label class="control-label">Data de alteração</label>
											<div class="controls display">
											  <?=$user_a_a?>, <?=date("d/m/Y H:i",$sync_a)?>h
											</div>
										</div>
                                        <?php }//if($user_a_a >= "1"){?>

                                        <?php if($id_a >= "1"){ ?>
										<div class="control-group">
											<label class="control-label">Log</label>
                                            <div class="controls divLerLog<?=$INC_FAISHER["div"]?>_oculta">
                                            <button type="button" class="btn btn-large" onclick="lerLog('divLerLog<?=$INC_FAISHER["div"]?>','<?=$tabela_lerLog?>','<?=$id_a?>');"><i class="icon-magic"></i> Carregar histórico de alterações do registro <img src="img/ajax-qloader-preto-p.gif" width="18" height="18" style="display:none;" id="divLerLog<?=$INC_FAISHER["div"]?>_load" /></button></div>
                                            <div class="controls divLerLog<?=$INC_FAISHER["div"]?>_exibe" style="display:none;">
                                            <a href="#" onclick="$('.divLerLog<?=$INC_FAISHER["div"]?>_exibe, #divLerLog<?=$INC_FAISHER["div"]?>').hide();$('.divLerLog<?=$INC_FAISHER["div"]?>_oculta').fadeIn();return false;" class="btn btn-large" rel="tooltip" title="Visualizar"><i class="icon-eye-close"></i> Ocultar</a></div>
											<div class="controls" id="divLerLog<?=$INC_FAISHER["div"]?>"></div>
										</div>
                                        <?php }//if($id_a >= "1"){?>
                                        
                                        
									  </div><!-- End .accordion-inner -->
									</div>
	</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
  </div><!-- End .accordion-widget ----------------------------------------------- -->                            





  <div class="form-actions">
											<button type="submit" class="btn btn-large btn-primary"><?php if($id_a >= "1"){ echo "Salvar alterações"; }else{?>Adicionar Novo<?php }?> <img src="img/ajax-qloader-preto-p.gif" width="18" height="18" style="display:none;" id="btSalvar<?=$array_temp?>" /></button>
											<button type="button" class="btn btn-large esconder-sendload<?=$INC_FAISHER["div"]?>" onclick="<?php if(isset($_GET["POP"])){ echo "pmodalDisplay('hide');"; }else{?>displayAcao<?=$INC_FAISHER["div"]?>('fecha');<?php }?>">Cancelar</button>
										</div>
									</form>
                                    
</div>
<div id="divContent_oculto<?=$array_temp?>" style="display:none;"></div>                                   
<?php
if(isset($_GET["POP"])){ $loaderFoco = "1"; }else{ $loaderFoco = "0"; }
//VALIDA FORM AJAX
$AJAX_COD_INC = "
	if($('#".$formCadastroPincipal."').validate().form() == false){ valedaform = \"0\"; }
	if(valedaform == \"1\"){
		loaderFoco('divContent_loader".$array_temp."','divContent_loader_load".$array_temp."',' já estamos salvando o registro...','".$loaderFoco."');//cria um loader dinamico	
	}";

//include de script jQuery de envio de forms
//VARIAVEIS DE CONTROLE GERAL DO INCLUDE
$AJAX_METODO_INC = "post";//metodo de envio get, post
$AJAX_GET_INC = "ajax=lista&faisher=$faisher&'+$('#AJAX_GET".$INC_FAISHER["div"]."').val()+'";//vars GET de envio URL
$AJAX_FORM_INC = $formCadastroPincipal;//id do formulario de trabalho
$AJAX_DADOS_INC = "";//nome dos campos de retorno, {'campo='+$('#campo').val()+'&campo2='+$('#campo2').val()} (opcional)
$AJAX_IDFUNCAO_INC = "sendFormCadastroPincipal".$array_temp;//nome da funcao de retorno [nome funcao]();
$AJAX_URL_INC = $AJAX_PAG; //url de envio
$AJAX_LOAD_INC = "ADD"; //define se esconde o conteudo com load - ADD
$AJAX_CARREGANDO_INC = "btSalvar".$array_temp.", #divContent_loader_load".$array_temp; //div de carregando
$AJAX_HIDE_INC = ".esconder-sendload".$INC_FAISHER["div"];//esconder ao carregar
$AJAX_SHOW_INC = ".esconder-sendload".$INC_FAISHER["div"];//mostrar ao carregar
$AJAX_PAG_DIV_INC = "divAjax_lista".$INC_FAISHER["div"]; //div de dados
$AJAX_COD_SUCESS_INC = "displayAcao".$INC_FAISHER["div"]."('fechaHtml');"; //cod java on sucess
if(isset($_GET["POP"])){ $AJAX_PAG_DIV_INC = "divContent_oculto".$array_temp; $AJAX_GET_INC = "ajax=lista&faisher=$faisher&POP=".$_GET["POP"]; $AJAX_COD_SUCESS_INC = ""; }
include "../sys/inc_sendForms.php";
?>
<?php




}//fim ajax  -------------------------------------------- <<<
?>
<?php





























//AJAX QUE EXIBE LISTA DE ITENS ------------------------------------------------------------------>>>
if($ajax == "lista"){
	if(isset($_GET["perfil_f"])){      					 $perfil_f = getpost_sql($_GET["perfil_f"]);      		   			  }else{ $perfil_f = "";   		    }





//################################### EXCLUIR DO REGISTRO - SQL EXCLUIR ||||||||||||||||>
if(isset($_GET["id_excluir"])){
	$id_excluir = getpost_sql($_GET["id_excluir"]);

	if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"edi")){
		//verifica se já existem registros utilizando o item
		$valida_msg = "";
		//verifica processos .....................................................
		$conta_ver = fSQL::SQL_CONTAGEM("protocolo_executando", "depto_a = '$id_excluir'");
		if($conta_ver >= "1"){ $valida_msg .= "<br>PROCESSOS:<br> - ".$conta_ver." processo(s) em execução no depto!"; }
		$conta_leg = ""; $cont_encontrou = "0"; $resu1 = fSQL::SQL_SELECT_SIMPLES("nome", "adm_protocolo_tipo", "mapa_tramitacao LIKE '%-".$id_excluir.",%' AND status = '1'", "ORDER BY nome ASC","30");
		while($linha1 = fSQL::FETCH_ASSOC($resu1)){
			$cont_encontrou++;
			if($conta_leg != ""){ $conta_leg .= "<br>"; } $conta_leg .= " - ".$linha1["nome"];
			if($cont_encontrou == "30"){ if($conta_leg != ""){ $conta_leg .= "<br>"; } $conta_leg .= " ***Mais de 30..."; }
		}//fim while
		if($conta_leg != ""){ $valida_msg .= "<br>NO MAPA DE TRAMITAÇÃO DE TIPO DE PROCESSO:<br> ".$conta_leg; }
		//..........................................................................
		//verifica ofícios .....................................................
		$conta_ver = fSQL::SQL_CONTAGEM("oficio_executando", "depto_a = '$id_excluir'");
		if($conta_ver >= "1"){ $valida_msg .= "<br>OFÍCIOS:<br> - ".$conta_ver." processo(s) em execução no depto!"; }
		$conta_leg = ""; $cont_encontrou = "0"; $resu1 = fSQL::SQL_SELECT_SIMPLES("nome", "adm_oficio_tipo", "mapa_tramitacao LIKE '%-".$id_excluir.",%' AND status = '1'", "ORDER BY nome ASC","30");
		while($linha1 = fSQL::FETCH_ASSOC($resu1)){
			$cont_encontrou++;
			if($conta_leg != ""){ $conta_leg .= "<br>"; } $conta_leg .= " - ".$linha1["nome"];
			if($cont_encontrou == "30"){ if($conta_leg != ""){ $conta_leg .= "<br>"; } $conta_leg .= " ***Mais de 30..."; }
		}//fim while
		if($conta_leg != ""){ $valida_msg .= "<br>NO MAPA DE TRAMITAÇÃO DE TIPO DE OFÍCIO:<br> ".$conta_leg; }
		//..........................................................................
		//verifica notificação .....................................................
		$conta_ver = fSQL::SQL_CONTAGEM("notificacao_executando", "depto_a = '$id_excluir'");
		if($conta_ver >= "1"){ $valida_msg .= "<br>NOTIFICAÇÕES:<br> - ".$conta_ver." processo(s) em execução no depto!"; }
		$conta_leg = ""; $cont_encontrou = "0"; $resu1 = fSQL::SQL_SELECT_SIMPLES("nome", "adm_notificacao_tipo", "mapa_tramitacao LIKE '%-".$id_excluir.",%' AND status = '1'", "ORDER BY nome ASC","30");
		while($linha1 = fSQL::FETCH_ASSOC($resu1)){
			$cont_encontrou++;
			if($conta_leg != ""){ $conta_leg .= "<br>"; } $conta_leg .= " - ".$linha1["nome"];
			if($cont_encontrou == "30"){ if($conta_leg != ""){ $conta_leg .= "<br>"; } $conta_leg .= " ***Mais de 30..."; }
		}//fim while
		if($conta_leg != ""){ $valida_msg .= "<br>NO MAPA DE TRAMITAÇÃO DE TIPO DE NOTIFICAÇÃO:<br> ".$conta_leg; }
		//..........................................................................
		//verifica se existe registros vinculados
		if($valida_msg == ""){//verifica permissão
			//atualiza dados da tabela no DB
			$campos = "time,status";
			$tabela = "sys_perfil_deptos";
			$valores = array(time(),"0");
			$condicao = "id='$id_excluir'";
			fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
					
			//GERA AÇÃO DO USUÁRIO NA TABELA
			$cVLogin->addAcaoUser("sys_perfil_deptos", "bloquear", $id_excluir);//addAcaoUser($TABELA, $ACAO, $REGISTRO)
			//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
			$cMSG->addMSG("SUCESSO","Registro bloqueado com sucesso!");
		}else{ $cMSG->addMSG("ERRO","<b>Existem registros vinculados ao depto:</b> $valida_msg<br><b>*Não é possível bloqeuar até liberar o depto das pendências.</b>",40000); }//fim else //excluir
	}else{
		//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
		$cMSG->addMSG("ERRO","Erro nas permissões de seu usuário!");
	}//if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"edi")){//verifica permissão

}//fim if(isset($_GET["id_excluir"])){
//################################### EXCLUIR DO REGISTRO - SQL EXCLUIR ||||||||||||||||<























//################################# VARIAVEIS DE VALIDACAO DO REGISTRO ||||||||||||||||>
$verificaRegistro = "0";
if(isset($_POST["id_a"])){
	$verifica_erro = "0"; //zera variavel de verificacao de erros
	//recebe vars - padrao
	$id_a = getpost_sql($_POST["id_a"]);
	$array_temp = getpost_sql($_POST["array_temp"]);
	//recebe vars - geral
	$nome_a = getpost_sql($_POST["nome"],"MAIUSCULO");
	$fone1_a = getpost_sql($_POST["fone1"]);
	$fone2_a = getpost_sql($_POST["fone2"]);
	$perfil_id_a = getpost_sql($_POST["perfil_id"]);
	$obs_a = getpost_sql($_POST["obs"]);
	$status_a = getpost_sql($_POST["status"]);
	$uf_a = getpost_sql($_POST["uf"]);
	$cidade_id_a = getpost_sql($_POST["cidade_id"]);
	$bairro_a = getpost_sql($_POST["bairro"],"MAIUSCULO");
	$logradouro_a = getpost_sql($_POST["logradouro"],"MAIUSCULO");
	$quadra_a = getpost_sql($_POST["quadra"],"MAIUSCULO");
	$lote_a = getpost_sql($_POST["lote"],"MAIUSCULO");
	$numero_a = getpost_sql($_POST["numero"],"MAIUSCULO");
	$complemento_a = getpost_sql($_POST["complemento"],"MAIUSCULO");
	$bloco_a = getpost_sql($_POST["bloco"],"MAIUSCULO");
	$sala_a = getpost_sql($_POST["sala"],"MAIUSCULO");
	$cep_a = getpost_sql($_POST["cep"],"MAIUSCULO");
	$lat_a = getpost_sql($_POST["lat"]);
	$long_a = getpost_sql($_POST["long"]);	
		
	$perfil_f = $perfil_id_a; 



//VALIDAÇÔES ------------------------------**********
	//valida campo nome -- XXX
	if($nome_a == ""){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- Campo nome não pode estar vazio, preencha corretamente!";//msg
	}//fim if valida campo
	//valida campo perfil_id_a -- XXX
	if($perfil_id_a == ""){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- Campo perfil de acesso não pode estar vazio, preencha corretamente!";//msg
	}//fim if valida campo
	//valida campo uf_a -- XXX
	if($uf_a == ""){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- Informe o estado/UF não pode estar vazio, preencha corretamente!";//msg
	}//fim if valida campo
	//valida campo cidade_id_a -- XXX
	if($cidade_id_a == ""){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- Informe a cidade não pode estar vazio, preencha corretamente!";//msg
	}//fim if valida campo
	//valida campo logradouro_a -- XXX
	if($logradouro_a == ""){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- Informe o logradouro não pode estar vazio, preencha corretamente!";//msg
	}//fim if valida campo
	//valida campo bairro_a -- XXX
	if($bairro_a == ""){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- Informe o bairro não pode estar vazio, preencha corretamente!";//msg
	}//fim if valida campo
	//valida campo lat_a long_a -- XXX
	if(($lat_a == "") or ($long_a == "")){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- Informe latitude e longitude não pode estar vazio, utilize ABRIR MARCAÇÃO NO MAPA, preencha corretamente!";//msg
	}//fim if valida campo
	
	if($nome_a != ""){
		//verifica se já existe no sistem
		$sql_complemto = " AND id != '$id_a'";	
		if($id_a == "0"){ $sql_complemto = ""; }//if($id_a == "0"){
		$cont_ = "0";
		$resu1 = fSQL::SQL_SELECT_SIMPLES("nome", "sys_perfil_deptos", "perfil_id = '$perfil_id_a' AND nome = '$nome_a' $sql_complemto", "");
		while($linha1 = fSQL::FETCH_ASSOC($resu1)){
			$nome_aa = $linha1["nome"];
			$cont_++;
		}//fim while
		if($cont_ >= "1"){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
			$verifica_erro .= "- Nome ($nome_aa) já existe no perfil/secretaria em uso, não pode ser utilizados nomes iguais no mesmo perfil/secretaria!";//msg
		}//fim if valida campo
	}//if(nome_a != ""){
	
		

	//VERIFICA SE ESTÁ BLOQUEANDO O DEPTO
	if(($status_a != "1") and ($id_a >= "1")){
		if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"edi")){
			//verifica se já existem registros utilizando o item
			$valida_msg = "";
			//verifica processos .....................................................
			$conta_ver = fSQL::SQL_CONTAGEM("protocolo_executando", "depto_a = '$id_a'");
			if($conta_ver >= "1"){ $valida_msg .= "<br>PROCESSOS:<br> - ".$conta_ver." processo(s) em execução no depto!"; }
			$conta_leg = ""; $cont_encontrou = "0"; $resu1 = fSQL::SQL_SELECT_SIMPLES("nome", "adm_protocolo_tipo", "mapa_tramitacao LIKE '%-".$id_a.",%' AND status = '1'", "ORDER BY nome ASC","30");
			while($linha1 = fSQL::FETCH_ASSOC($resu1)){
				$cont_encontrou++;
				if($conta_leg != ""){ $conta_leg .= "<br>"; } $conta_leg .= " - ".$linha1["nome"];
				if($cont_encontrou == "30"){ if($conta_leg != ""){ $conta_leg .= "<br>"; } $conta_leg .= " ***Mais de 30..."; }
			}//fim while
			if($conta_leg != ""){ $valida_msg .= "<br>NO MAPA DE TRAMITAÇÃO DE TIPO DE PROCESSO:<br> ".$conta_leg; }
			//..........................................................................
			//verifica ofícios .....................................................
			$conta_ver = fSQL::SQL_CONTAGEM("oficio_executando", "depto_a = '$id_a'");
			if($conta_ver >= "1"){ $valida_msg .= "<br>OFÍCIOS:<br> - ".$conta_ver." processo(s) em execução no depto!"; }
			$conta_leg = ""; $cont_encontrou = "0"; $resu1 = fSQL::SQL_SELECT_SIMPLES("nome", "adm_oficio_tipo", "mapa_tramitacao LIKE '%-".$id_a.",%' AND status = '1'", "ORDER BY nome ASC","30");
			while($linha1 = fSQL::FETCH_ASSOC($resu1)){
				$cont_encontrou++;
				if($conta_leg != ""){ $conta_leg .= "<br>"; } $conta_leg .= " - ".$linha1["nome"];
				if($cont_encontrou == "30"){ if($conta_leg != ""){ $conta_leg .= "<br>"; } $conta_leg .= " ***Mais de 30..."; }
			}//fim while
			if($conta_leg != ""){ $valida_msg .= "<br>NO MAPA DE TRAMITAÇÃO DE TIPO DE OFÍCIO:<br> ".$conta_leg; }
			//..........................................................................
			//verifica notificação .....................................................
			$conta_ver = fSQL::SQL_CONTAGEM("notificacao_executando", "depto_a = '$id_a'");
			if($conta_ver >= "1"){ $valida_msg .= "<br>NOTIFICAÇÕES:<br> - ".$conta_ver." processo(s) em execução no depto!"; }
			$conta_leg = ""; $cont_encontrou = "0"; $resu1 = fSQL::SQL_SELECT_SIMPLES("nome", "adm_notificacao_tipo", "mapa_tramitacao LIKE '%-".$id_a.",%' AND status = '1'", "ORDER BY nome ASC","30");
			while($linha1 = fSQL::FETCH_ASSOC($resu1)){
				$cont_encontrou++;
				if($conta_leg != ""){ $conta_leg .= "<br>"; } $conta_leg .= " - ".$linha1["nome"];
				if($cont_encontrou == "30"){ if($conta_leg != ""){ $conta_leg .= "<br>"; } $conta_leg .= " ***Mais de 30..."; }
			}//fim while
			if($conta_leg != ""){ $valida_msg .= "<br>NO MAPA DE TRAMITAÇÃO DE TIPO DE NOTIFICAÇÃO:<br> ".$conta_leg; }
			//..........................................................................
			//verifica se existe registros vinculados
			if($valida_msg != ""){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
				$verifica_erro .= "- <b>BLOQUEIO DE DEPTO - Existem registros vinculados ao depto:</b> $valida_msg<br><b>*Não é possível bloqeuar até liberar o depto das pendências.</b>";
			}
		}else{
			if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
			$verifica_erro .= "- Suas permissões não permitem bloquear departamentos!";//msg
		}//if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"edi")){//verifica permissão
	}//if(($status_a != "1") and ($id_a >= "1")){



	//verifica a existencia de erro ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !
	if($verifica_erro != "0"){//verifica se existe erro
		$verificaRegistro = "0";//reabre form
		?>
		<script>
			//TIMER
			$.doTimeout('vTimerOPENList', 500, function(){
				exibMensagem('formPrincipalMSG<?=$INC_FAISHER["div"].$array_temp?>','erro','<i class="icon-ban-circle"></i> <b>Erros encontrados!</b><br><?=$verifica_erro?>',60000);
				<?php if(isset($_GET["POP"])){ ?>$("#pModalConteudo").scrollTop(0);<?php }?>
				<?php if(!isset($_GET["POP"])){ ?>displayAcao<?=$INC_FAISHER["div"]?>('abreHtml');<?php }//fim else if(isset($_GET["POP"])){ ?>
			});//TIMER
		</script>
		<?php
		if(isset($_GET["POP"])){ exit(0); }
	}else{//verificado a existencia de erros ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !
		$verificaRegistro = "1";
	}




	///VERIFICA PERMISSÕES DE ACESSO
	if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"cad")){ $verificaRegistro = "0";
		//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
		$cMSG->addMSG("ERRO","Usuário sem permissão de acesso! Verifique com administrador.");
	}//loginAcesso
	if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"edi")){ $verificaRegistro = "0";
		//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
		$cMSG->addMSG("ERRO","Usuário sem permissão de acesso! Verifique com administrador.");
	}//loginAcesso

}//fim isset if(isset($_POST["id_a"])){
	

//################################################################ VERIFICACOES ALTERA/GRAVA O REGISTRO ||||||||||||||||>
if($verificaRegistro == "1"){


	

	
	
//execulta as ! consultas SQL ! consultas SQL ! consultas SQL ! consultas SQL ! consultas SQL ! consultas SQL ! consultas SQL
unset($ARRAY_LOG);//destroe array de log auditoria
//verifica se grava novo registro
if($id_a == "0"){ //############# IF - GRAVA NOVO REGISTRO |-----> SQL CADASTRO
	$code_a = fGERAL::codeRand(4).fTBL::idTabela("sys_perfil_deptos");


	//insere o registro na tabela do sistema
	//VARS insert simples SQL
	$tabela = "sys_perfil_deptos";
	//busca ultimo id para insert
	$id_a = fSQL::SQL_SELECT_INSERT($tabela, "id");
	$campos = "id,code,perfil_id,nome,fone1,fone2,obs,uf,cidade_id,bairro,logradouro,quadra,lote,numero,complemento,sala,cep,lat,long,status,user,time,user_a,sync";
	$valores = array($id_a,$code_a,$perfil_id_a,$nome_a,$fone1_a,$fone2_a,$obs_a,$uf_a,$cidade_id_a,$bairro_a,$logradouro_a,$quadra_a,$lote_a,$numero_a,$complemento_a,$sala_a,$cep_a,$lat_a,$long_a,$status_a,$cVLogin->userReg(),time(),"0",time());
	$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
	$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria
	
		
	
	
	//GERA AÇÃO DO USUÁRIO NA TABELA
	$cVLogin->addAcaoUser("sys_perfil_deptos", "adicionar", $id_a);//addAcaoUser($TABELA, $ACAO, $REGISTRO)
	//GERA LOGS DE TABELAS
	if(isset($ARRAY_LOG)){//gerar log de auditoria	
		fGERAL::gravaLog("sys_perfil_deptos",$id_a,$ARRAY_LOG,$cVLogin->userReg());
	}//if(isset($ARRAY_LOG)){
	//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
	$cMSG->addMSG("SUCESSO","Departamento cadastrado com sucesso! <a href=\"#\" onclick=\"janelaAcao".$INC_FAISHER["div"]."(\\'visualizar\\',\\'id_a=".$id_a."\\');return false;\" class=\"btn sAcao\" rel=\"tooltip\" title=\"Visualizar\"><i class=\"icon-search\"></i></a>");



}else{  //############# ELSE - ALTERA REGISTRO |-


		
	//atualiza dados da tabela no DB
	$tabela = "sys_perfil_deptos";
	$campos = "perfil_id,nome,fone1,fone2,obs,uf,cidade_id,bairro,logradouro,quadra,lote,numero,complemento,sala,cep,lat,long,status,user_a,sync";
	$valores = array($perfil_id_a,$nome_a,$fone1_a,$fone2_a,$obs_a,$uf_a,$cidade_id_a,$bairro_a,$logradouro_a,$quadra_a,$lote_a,$numero_a,$complemento_a,$sala_a,$cep_a,$lat_a,$long_a,$status_a,$cVLogin->userReg(),time());
	$condicao = "id='$id_a'";
	fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
	$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria
	



	//GERA AÇÃO DO USUÁRIO NA TABELA
	$cVLogin->addAcaoUser("sys_perfil_deptos", "editar", $id_a);//addAcaoUser($TABELA, $ACAO, $REGISTRO)
	//GERA LOGS DE TABELAS
	if(isset($ARRAY_LOG)){//gerar log de auditoria	
		fGERAL::gravaLog("sys_perfil_deptos",$id_a,$ARRAY_LOG,$cVLogin->userReg());
	}//if(isset($ARRAY_LOG)){
	//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
	$cMSG->addMSG("SUCESSO","Registro atualizado com sucesso. <a href=\"#\" onclick=\"janelaAcao".$INC_FAISHER["div"]."(\\'visualizar\\',\\'id_a=".$id_a."\\');return false;\" class=\"btn sAcao\" rel=\"tooltip\" title=\"Visualizar\"><i class=\"icon-search\"></i></a>");
	
	
}//fim do else if($id_a == "0"){ //############# FIM ELSE - ALTERA REGISTRO |-

//se veio cadastro de um POPUP para execução do script
if(verPop("isset")){
	$POP = $_GET["POP"];
	if($POP == "1"){ $POP = ""; }else{	
		$id = $id_a;
		$texto = "<b>".$nome_a."</b><br>".$obs_a;
		
		//adiciona vars POP
		$POP = fGERAL::cptoFaisher($_GET["POP"], "dec");
		$POP = str_replace("{ID}", $id, $POP);
		$POP = str_replace("{TXT}", $texto, $POP);	
	}//if($POP == "1"){
?>
	<script>
	//TIMER
	$.doTimeout('vTimerOPENListPOP', 500, function(){
		<?=$POP?>
		pmodalDisplay('hide');
	});//TIMER
	</script>
<?php
	exit(0);
}











}//fim if($verificaRegistro == "1"){//############################################################### FIM VERIFICACOES||<
































//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||--------------- SQL vars >>>
//vars para consulta no DB referente a paginação abaixo
	$SQL_campos = "D.id,D.code,D.perfil_id,D.nome,D.logradouro,D.status,D.time,P.nome AS perfil,P.apelido AS perfil_apelido"; //campos da tabela
	$SQL_tabela = "sys_perfil_deptos D, sys_perfil P"; //tabela
	$SQL_where = "D.perfil_id = P.id"; //condição
	$SQL_varEnvio = "ajax=lista&faisher=$faisher&"; //variaveis para a paginacao
	$ORDEM_C = "D.nome";//campo de ordenar
	$ORDEM = "ASC";// ASC ou DESC
	$SQL_group = "GROUP BY D.id"; // agrupar o resultado GROUP BY

//verifica se recebeu ORDEM_C ou seta ORDER padrao ------------ VARS SQL
	if((isset($_GET["ORDEM_C"])) and ($_GET["ORDEM_C"] != "undefined") and ($_GET["ORDEM_C"] != "")){
		$ORDEM_C = getpost_sql($_GET["ORDEM_C"]);
		$ORDEM = getpost_sql($_GET["ORDEM"]);
	}//fim ORDEM_C
	$SQL_order = $SQL_group." ORDER BY $ORDEM_C $ORDEM"; // ordem do resultado
	$AJAX_GET = $SQL_varEnvio;//vars get para reenvio no paginaçao AJAX
	$AJAX_GET_OR = "ORDEM_C=$ORDEM_C&ORDEM=$ORDEM&";//vars get para reenvio no paginaçao AJAX com ORDER
//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL vars <<<




//pega vars de busca
	unset($filtro_b);
	if(isset($_GET["rapida_b"])){   					 $rapida_b = getpost_sql($_GET["rapida_b"]);   						  }else{ $rapida_b = "";    	    }
	if(isset($_GET["nome_b"])){       					 $nome_b = getpost_sql($_GET["nome_b"]);       		     			  }else{ $nome_b = "";    		    }
	if(isset($_GET["datai_b"])){       					 $datai_b = getpost_sql($_GET["datai_b"]);       		   			  }else{ $datai_b = "";    		    }
	if(isset($_GET["dataf_b"])){       					 $dataf_b = getpost_sql($_GET["dataf_b"]);       		   			  }else{ $dataf_b = "";    		    }
	if(isset($_GET["perfil_b"])){      					 $perfil_b = getpost_sql($_GET["perfil_b"]);      		   			  }else{ $perfil_b = "";   		    }
	






//verifica se recebeu uma solicitação de busca por rapida_b
if($rapida_b != ""){  $filtro_marca[] = $rapida_b;
		$aCode = fGERAL::codeRandRetorno($rapida_b);
		$filtro_b["rapida_b"] = "Busca rápida por <b>$rapida_b</b>";
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " ( D.`id` = '".$aCode["id"]."' OR D.`nome` LIKE '%$rapida_b%' OR P.`apelido` LIKE '%$rapida_b%' ) "; //condição 
		$AJAX_GET .= "rapida_b=$rapida_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por rapida_b





//verifica se recebeu uma solicitação de busca por code_b
if($code_b != ""){  $filtro_marca[] = $code_b;
		$aCode = fGERAL::codeRandRetorno($code_b);
		$filtro_b["code_b"] = "Busca ".SYS_CONFIG_RM_SIGLA." <b>$code_b</b>";
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " ( D.`id` = '".$aCode["id"]."' AND D.`code` = '".$aCode["code"]."' ) "; //condição 
		$AJAX_GET .= "code_b=$code_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por code_b




//verifica se recebeu uma solicitação de busca por data de cadastro
if(($datai_b != "") or ($dataf_b != "")){  $filtro_marca[] = $datai_b;  $filtro_marca[] = $dataf_b;
		if($datai_b == ""){ $datai_b = $dataf_b; } if($dataf_b == ""){ $dataf_b = $datai_b; }
		$timei_a = time_data_hora("$datai_b 0:0"); //converte data/hora em time UNIX "04/03/2011 10:11"
		$timef_a = time_data_hora("$dataf_b 23:59"); //converte data/hora em time UNIX "04/03/2011 10:11"
		$filtro_b["data_b"] = "De <b>$datai_b</b> até <b>$dataf_b</b>";
		if($timei_a > $timef_a){ $timef_a = $timei_a; $filtro_b["data_b"] = "De <b>$datai_b</b> até <b>$datai_b</b> (data foi ajustada)"; }
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " D.time >= '$timei_a' AND D.time <= '$timef_a' "; //condição
		$AJAX_GET .= "datai_b=$datai_b&dataf_b=$dataf_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por data cadastro



//verifica se recebeu uma solicitação de busca por nome
if($nome_b != ""){  $filtro_marca[] = $nome_b;
		$filtro_b["nome_b"] = "Busca por <b>$nome_b</b>";
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " ( D.`nome` LIKE '%$nome_b%' OR P.`apelido` LIKE '%$nome_b%' ) "; //condição 
		$AJAX_GET .= "nome_b=$nome_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por nome



//verifica se recebeu uma solicitação de busca por perfil
if($perfil_b != ""){
		$linha1 = fSQL::SQL_SELECT_ONE("nome,apelido", "sys_perfil", "id = '$perfil_b'");
		$perfil_bb = $linha1["nome"]."(".$linha1["apelido"].")";
		$filtro_b["perfil_b"] = "Busca perfil <b>$perfil_bb</b>";   $filtro_marca[] = $linha1["apelido"];
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= "D.perfil_id = '$perfil_b'"; //condição 
		$AJAX_GET .= "perfil_b=$perfil_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por perfil








//verifica se recebeu uma solicitação de busca por perfil
if($perfil_f != ""){
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= "D.perfil_id = '$perfil_f'"; //condição 
		$AJAX_GET .= "perfil_f=$perfil_f&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por perfil








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
			<div class="message"><span class="caret"></span><span class="name">Resultado da busca realizada no(s) iten(s)</span>
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
				<span class="time"> <b><?=$n_paginas?></b> registros encontrados</span>
			</div>
		</li>
	</ul>
<div style="clear:both;"></div>
<?php
}//fim if($cont_ARRAY >= "1"){
?>
<?php




//filtrar ------------------------------
if($perfil_f != ""){
	$linha1 = fSQL::SQL_SELECT_ONE("id,nome,apelido", "sys_perfil", "id = '$perfil_f'");
	$perfil_b_data = '{id: "'.$perfil_f.'", text: \'<i class="'.fGERAL::icoPerfil($perfil_f).'"></i> <b>'.$perfil_f.'. '.$linha1["nome"].'</b> ('.$linha1["apelido"].')\'}';
	$filtro_marca[] = $linha1["nome"];
	$filtro_marca[] = $linha1["apelido"];
}else{ $perfil_b_data = ""; }//if($perfil_f != ""){
?>
<div style="background:#<?php if($perfil_b_data != ""){ echo '666'; }else{ echo 'CCC'; }?>; color:#FFF; padding:5px; margin:15px 0 25px 0;">
	<label class="control-label"> PERFIL/SECRETARIA (filtro da listagem)</label>
	<div class="controls select2-full">
		<input type='hidden' value="" name='perfil_b<?=$INC_FAISHER["div"]?>' id='perfil_b<?=$INC_FAISHER["div"]?>' style=" width:100%;"/>
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#perfil_b<?=$INC_FAISHER["div"]?>').select2({
		maximumSelectionSize: 1,//*/
   		multiple: true,
		placeholder: 'Selecione um perfil/secretaria >> (comece a digitar para buscar)',
		ajax: {
			url: "geral/combo_ajax.php?ajax=perfilAcesso&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 100 // page size
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
	<?php if($perfil_b_data != ""){ ?>$("#perfil_b<?=$INC_FAISHER["div"]?>").select2("data", <?=$perfil_b_data?>);<?php }?>
	$("#perfil_b<?=$INC_FAISHER["div"]?>").on("change", function(e){
		$('#perfil_f<?=$INC_FAISHER["div"]?>').val($(this).val());
		bAvancada<?=$INC_FAISHER["div"]?>();
	});
	
});
</script>
	</div>
</div>
    
<?php
//paginação
//$REG_TOTAL_INC = "1"; //criar a variavel faz exibir os totais por página
$TIPO_INC = "padraoajax";//tipo de pg
$GET_INC = $AJAX_GET.$AJAX_GET_OR; //vars GET
$PAG_INC = $AJAX_PAG;
$AJAX_PAG_DIV_INC = "divAjax_lista".$INC_FAISHER["div"];
$AJAX_CARREGANDO_INC = "dAjax_lista".$INC_FAISHER["div"]."_load";
$AJAX_APPEND_INC = "ADD";//funcao ADD ajax faisher
include "../inc_paginacao.php";

?>
<script type="text/javascript">
$(document).ready(function(){
<?=fGERAL::marcaBusca($filtro_marca,"datatable_principal".$INC_FAISHER["div"])?>
	$('#contTitu<?=$INC_FAISHER["div"]?>').html(' (<?=$n_paginas?>)');
	$('#datatable_principal<?=$INC_FAISHER["div"]?> tbody tr').click(function() {
		var idClick = $(this).find('.sAcao');
		$(this).find(".sVisu").click(function() {
			if($('#dCentro_acao<?=$INC_FAISHER["div"]?>').is(':visible')){}else{
				idClick.click();
			}
		});

	});
	$('#datatable_principal<?=$INC_FAISHER["div"]?> thead tr th').click(function() {
		var idClick = $(this).attr("id");
		if($('#dCentro_acao<?=$INC_FAISHER["div"]?>').is(':visible')){}else{
			if((idClick != "") && (idClick != null)){ carregaLista<?=$INC_FAISHER["div"]?>($('#AJAX_GET<?=$INC_FAISHER["div"]?>_OR').val()+'&ORDEM_C='+idClick); }
		}

	});
	$('#AJAX_GET<?=$INC_FAISHER["div"]?>').val('<?=$AJAX_GET.$AJAX_GET_OR?>&pagina=<?=$pagina?>');//salva vars get
	<?php /*filtrar perfil*/ if($perfil_f != ""){ ?>$('#perfil_f<?=$INC_FAISHER["div"]?>').val('<?=$perfil_f?>');<?php } ?>
});





<?php
//ID de controle ---  ########### rolagem faisher ################# ++++
$id_Content = "divAjax_lista".$INC_FAISHER["div"];
$id_Rolagem = "Lista".$INC_FAISHER["div"];
?>
//ao redimencionar a pagina
function resize_Tela<?=$id_Rolagem?>() {
	var v_largura = $("#<?=$id_Content?>").width();	$("#divRol<?=$id_Rolagem?>").css('width',v_largura+'px');
	//atualiza rolagem da caixa
	rolagemFaisher('divRol<?=$id_Rolagem?>','setasH');//rolagem
}//resize_TelaRelato
$(window).resize(function(){ resize_Tela<?=$id_Rolagem?>(); });
$.doTimeout('vTimerRol<?=$id_Rolagem?>', 500, function(){ resize_Tela<?=$id_Rolagem?>(); });//TIMER
$("#acao<?=$INC_FAISHER["div"]?>").click(function(){ resize_Tela<?=$id_Rolagem?>(); });
</script>
<div id="divRol<?=$id_Rolagem?>" style="width:100%; overflow:auto;">
<div id="divRol<?=$id_Rolagem?>Cont" style="width:100%; min-width:980px; padding-top:20px;">
<input id="AJAX_GET<?=$INC_FAISHER["div"]?>_OR" name="AJAX_GET<?=$INC_FAISHER["div"]?>_OR" type="hidden" value="<?=$AJAX_GET?>&pagina=1" />
	<table id="datatable_principal<?=$INC_FAISHER["div"]?>" class="table table-hover table-nomargin table-bordered dataTable">
		<thead>
			<tr>
				<?php $c_or = "D.nome"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>">Nome Departamento</th>
				<?php $c_or = "P.apelido"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>">Perfil/secretaria</th>
				<th>Usuários</th>
				<th>Grupos</th>
				<?php $c_or = "D.status"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>">Status</th>
				<th>Ação</th>
			</tr>
		</thead>
	<tbody>
<?php

	
///VERIFICA PERMISSÕES DE ACESSO
if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"edi")){ $pEdit = "1"; }else{ $pEdit = "0"; }//loginAcesso
if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"exc")){ $pExc = "1"; }else{ $pExc = "0"; }//loginAcesso


//vars adicionais ao SQL ----------------------------------- Vars SQL
//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL Listagem
//inicia a listagem do SQL de paginação
//se a contagem de zerado nao ativa o if que percorre as linhas
	if($n_paginas >= "1"){
while($linha1 = fSQL::FETCH_ASSOC($QueryListaPag)){
	$id_a = $linha1["id"];
	$code = $linha1["code"];
	$perfil_id = $linha1["perfil_id"];
	$nome = $linha1["nome"];
	$logradouro = $linha1["logradouro"];
	$status = $linha1["status"];
	$perfil = $linha1["perfil"];
	$perfil_apelido = $linha1["perfil_apelido"];
	$time = $linha1["time"];
	

	$status_n = "ATIVO";
	if($status != "1"){
		$status_n = "<b>BLOQUEADO</b><br><i>Em ".date('d/m/Y H:i',$time)."h</i>";
	}
	
	//verifica se já existem usuarios utilizando
	$conta_users = fSQL::SQL_CONTAGEM("sys_permissao_grupos G, sys_login_pacote P, sys_login L", "( G.perfil_depto_id = '$id_a' OR G.perfil_deptos LIKE ',%".$id_a."%,' ) AND G.id = P.permissao_grupo_id AND P.usuarios_id = L.id AND L.status = '1'","","GROUP BY P.usuarios_id");
	//verifica se já existem grupos utilizando
	$conta_grupos = fSQL::SQL_CONTAGEM("sys_permissao_grupos", "perfil_depto_id = '$id_a' OR perfil_deptos LIKE ',%".$id_a."%,'");
	
?>
										<tr>
											<td class="sVisu"><b><?=SYS_CONFIG_RM_SIGLA?> <?=fGERAL::legCode($id_a,$code)?><br><?=maiusculo($nome)?></b></td>
											<td class="sVisu"><i class="<?=fGERAL::icoPerfil($perfil_id)?>"></i> <?=$perfil?> (<?=$perfil_apelido?>)<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i><?=$logradouro?></i></td>
											<td class='sVisu'><?=$conta_users?></td>
											<td class='sVisu'><?=$conta_grupos?></td>
											<td class='sVisu'><?=$status_n?></td>
											<td>
												<a href="#" onclick="janelaAcao<?=$INC_FAISHER["div"]?>('visualizar','id_a=<?=$id_a?>');return false;" class="btn sAcao" rel="tooltip" title="Visualizar"><i class="icon-search"></i></a>
												<?php if($pEdit == "1"){?><a href="#" onclick="janelaAcao<?=$INC_FAISHER["div"]?>('registro','id_a=<?=$id_a?>');return false;" class="btn" rel="tooltip" title="Editar"><i class="icon-edit"></i></a><?php }?>
												<?php if($pExc == "1"){?><?php if($status == "1"){?><a href="#" onclick="if(confirm('Gostaria realmete de bloquear \'<?=$nome?>\'?')) { carregaLista<?=$INC_FAISHER["div"]?>('ajax=lista&id_excluir=<?=$id_a?>&'+$('#AJAX_GET<?=$INC_FAISHER["div"]?>').val());ancoraHtml('#ancAcao<?=$INC_FAISHER["div"]?>'); }return false;" class="btn" rel="tooltip" title="Bloquear"><i class="icon-remove"></i></a><?php }?><?php }?>
                                          </td>
										</tr>
<?php 

}//fim do while de padinação SQL
	}//fim do if($n_paginas >= "1"){ de paginacao SQL

?>
									</tbody>
								</table>
<?php if($n_paginas <= "0"){?>
	<div style="height:150px; padding:20px 0 0 10px; clear:both;"><i class="icon-info-sign"></i> Não foi encontrado nenhum resultado correspondente à sua pesquisa.</div>
<?php }?>
</div>
</div><!-- #fim rolagem faisher -->
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
<?php




}//fim ajax  -------------------------------------------- <<<
?>
<?php









































//++++++++++++++++++++++AJAX QUE EXIBE [[HOME]] ----------------------------########################################-------------------------------------->>>
if($ajax == "home"){
	
	
	///VERIFICA PERMISSÕES DE ACESSO
	if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"cad")){ $pCadastro = "OFF"; }//loginAcesso
	
	//include de padrao
	$INC_VAR["buscaAvancada"] = "ON";//ON - OFF > Busca avançãda, retorno ajax [buscaAvancada]
	$INC_VAR["varget"] = "perfil_f=1&"; //vars GET para adicionar no start
	include "inc/inc_lista-padrao.php";
	
	

}//fim ajax  -------------------------------------------- <<<














?>