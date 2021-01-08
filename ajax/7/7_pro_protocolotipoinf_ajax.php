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
	var v_get = '&tab_id='+$('#tab_id<?=$INC_FAISHER["div"]?>').val();//pega dados do tabs
	<?php $idCJ = "nome_b";?>if($("#<?=$formBusca?> #<?=$idCJ?>").val() != ""){ v_get = v_get+'&<?=$idCJ?>='+$("#<?=$formBusca?> #<?=$idCJ?>").val(); pCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }
	<?php $idCJ = "datai_b";?>if($("#<?=$formBusca?> #<?=$idCJ?>").val() != ""){ v_get = v_get+'&<?=$idCJ?>='+$("#<?=$formBusca?> #<?=$idCJ?>").val(); pCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }
	<?php $idCJ = "dataf_b";?>if($("#<?=$formBusca?> #<?=$idCJ?>").val() != ""){ v_get = v_get+'&<?=$idCJ?>='+$("#<?=$formBusca?> #<?=$idCJ?>").val(); pCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }

	loaderFoco('divConteiner_lista<?=$INC_FAISHER["div"]?>','dAjax_lista<?=$INC_FAISHER["div"]?>_load','Filtrando dados...');//cria um loader dinamico
	faisher_ajax('divAjax_lista<?=$INC_FAISHER["div"]?>', 'dAjax_lista<?=$INC_FAISHER["div"]?>_load', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=lista&'+v_get, 'get', 'ADD');
}//bAvancada

function bAvancada<?=$INC_FAISHER["div"]?>Remove(v_remove){
	<?php $idCJ = "nome_b";?>if(v_remove == "<?=$idCJ?>" || v_remove == "all"){ lCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }
	<?php $idCJ = "data_b";?>if(v_remove == "<?=$idCJ?>" || v_remove == "all"){ lCbusca<?=$INC_FAISHER["div"]?>('datai_b'); lCbusca<?=$INC_FAISHER["div"]?>('dataf_b'); }

	bAvancada<?=$INC_FAISHER["div"]?>();	
}//bAvancadaRemove
</script>
<form action="#" id="<?=$formBusca?>" method="POST" class='form-horizontal form-column form-bordered' onsubmit="return false;">
	<div class="span6">
		<div class="control-group">
			<label class="control-label">Nome</label>
			<div class="controls">
				<div class="input-append"><input type="text" name="nome_b" id="nome_b" placeholder="Informe nome ou parte do nome" class="input-xlarge limpaInput"><button class="btn limpaCampo" type="button" style="display:none;" rel="tooltip" title="Limpar"><i class="icon-trash"></i></button></div>
			</div>
		</div>
	</div><!-- End .span6 -->
    
	<div class="span6">
		<div class="control-group">
			<label class="control-label">Data de cadastro</label>
			<div class="controls">
				<div class="input-append"><input type="text" name="datai_b" id="datai_b" placeholder="Data inicial" class="input-medium mask_date datepick limpaInput"><button class="btn limpaCampo" type="button" style="display:none;" rel="tooltip" title="Limpar"><i class="icon-trash"></i></button></div> até 
				<div class="input-append"><input type="text" name="dataf_b" id="dataf_b" placeholder="Data final" class="input-medium mask_date datepick limpaInput"><button class="btn limpaCampo" type="button" style="display:none;" rel="tooltip" title="Limpar"><i class="icon-trash"></i></button></div>
			</div>
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


















































//AJAX (lista/preenche combox lista de grupos) ------------------------------------------------------------------>>>
if($ajax == "selGrupo"){
	if(isset($_GET["page_limit"])){ $page_limit = $_GET["page_limit"]; }else{ $page_limit = "30"; }
	//verifica se recebeu uma solicitação de busca por nome
	if((isset($_GET['term']) && strlen($_GET['term']) > 0)){
		$term = getpost_sql($_GET["term"]);
		$sql_busca = " ( `id` = '$term' OR `legenda` LIKE '%$term%' ) "; //condição
	}//fim da busca por nome

	
	//cria array de retorno
	$return_arr = array();
	$row_array = array();
	$ret = array();	

	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES("id,nome", "adm_protocolo_tipo_inf_grupo", "");
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id = $linha["id"];
		$legenda = $linha["nome"];
		//alimenta array de retorno
		$row_array['id'] = $id;
		$row_array['text'] = "<b>".$legenda."</b>";
		array_push($return_arr,$row_array);
	}//while				

	//imprime JSON de retorno
    $ret['results'] = $return_arr;
	echo json_encode($ret);


}//fim ajax -------------------<<<<








































//* ------------------------------------- ##### DADOS DO REGISTRO PADRAO #### --------------------------------------------*//





//AJAX QUE VISUALIZA REGISTRO ------------------------------------------------------------------>>>
if($ajax == "visualizar"){
	$id_a = $_GET["id_a"];
	$tab_id = $_GET["tab_id"];
	$cont_encontrou = "0";

    //id temp para registro de array
    $array_temp = time().rand(9,99999).$cVLogin->getVarLogin("SYS_USER_ID");
	$formVisualizaPincipal = "formVisualizaPincipal".$array_temp;
	//definir tab de busca
	if($tab_id == "0"){
		$tabela_lerLog = "adm_protocolo_tipo_inf";
		$titu_ = "VISUALIZAR DADOS DE CAMPO DE INFORMAÇÃO COMPLEMENTAR";
		$titu_print = "Campos Tipo";
	}else{//if($tab_id == "0"){
		$tabela_lerLog = "adm_protocolo_tipo_inf_grupo";
		$titu_ = "VISUALIZAR DADOS DE GRUPO DE CAMPO DE INFORMAÇÃO";
		$titu_print = "Grupos de Campos";
	}//else{//if($tab_id == "0"){

	//faz o proximo e anterior
	$anterior = "0";
	$resu1 = fSQL::SQL_SELECT_SIMPLES("id", $tabela_lerLog, "id < '$id_a'", "ORDER BY id DESC", "1");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){ $anterior = $linha1["id"]; }//fim while
	$proximo = "0";
	$resu1 = fSQL::SQL_SELECT_SIMPLES("id", $tabela_lerLog, "id > '$id_a'", "ORDER BY id ASC", "1");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){ $proximo = $linha1["id"]; }//fim while





	//definir tab de busca
	if($tab_id == "0"){
if($id_a != "0"){
	$campos = "*";
	$resu1 = fSQL::SQL_SELECT_SIMPLES($campos, "adm_protocolo_tipo_inf", "id = '$id_a'", "");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
	$id_a = $linha1["id"];
	$grupo_id_a = $linha1["grupo_id"];
	$nome_a = $linha1["nome"];
	$tipo_campo_a = $linha1["tipo_campo"];
	$obrigatorio_a = $linha1["obrigatorio"];
	$opcoes_a = $linha1["opcoes"];
	$mascara_a = $linha1["mascara"];
	$user_a = $linha1["user"];//quem realizou o cadastro
	$time_a = $linha1["time"]; //quando foi realizado o cadastro
	$user_a_a = $linha1["user_a"];//quel alterou o cadastro
	$sync_a = $linha1["sync"]; //quando foi alterado o cadastro
	$cont_encontrou++;
	}//fim while
}//fim do if if($id_a != "0"){

	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES("nome", "adm_protocolo_tipo_inf_grupo", "id = '".$grupo_id_a."'");
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$grupo_id_n = "<b>".$linha["nome"]."</b>";
	}//while	
	
	if($tipo_campo_a == "1"){ $tipo_campo_n = "CAMPO DE OPÇÕES"; }
	if($tipo_campo_a == "2"){ $tipo_campo_n = "CAMPO NUMÉRICO"; }
	if($tipo_campo_a == "3"){ $tipo_campo_n = "CAMPO DE TEXTO"; }
	if($tipo_campo_a == "9"){ $tipo_campo_n = "CAMPO DE ARQUIVO"; }

	$obrigatorio_n = "NÃO"; if($obrigatorio_a == "1"){ $obrigatorio_n = "SIM"; }
	

	}else{//if($tab_id == "0"){
if($id_a != "0"){
	$campos = "*";
	$resu1 = fSQL::SQL_SELECT_SIMPLES($campos, "adm_protocolo_tipo_inf_grupo", "id = '$id_a'", "");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
	$id_a = $linha1["id"];
	$nome_grupo_a = $linha1["nome"];
	$user_a = $linha1["user"];//quem realizou o cadastro
	$time_a = $linha1["time"]; //quando foi realizado o cadastro
	$user_a_a = $linha1["user_a"];//quel alterou o cadastro
	$sync_a = $linha1["sync"]; //quando foi alterado o cadastro
	$cont_encontrou++;
	}//fim while
}//fim do if if($id_a != "0"){
	
	}//else{//if($tab_id == "0"){
		
			







//verifica se nao encontrou nada
if($cont_encontrou == "0"){
	//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
	$cMSG->addMSG("SUCESSO","Erro na localização dos dados, atualize sua janela!<br>Sua permissão foi negada!");
	//MOSTRAR TODAS AS MENSAGENS CRIADAS -------------------------- CLASSE MENSAGENS ----------------------- ||||||||||||||
	$cMSG->imprimirMSG();//imprimir mensagens criadas
	exit(0);
}//verifica se nao encontrou nada
	
	
	




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
	$('#div_displayTitulo<?=$INC_FAISHER["div"]?>').html('<?=$titu_?> #<?=$id_a?>');

});
<?php if(!isset($_GET["POP"])){ ?>$.doTimeout('vTimerCursor<?=$INC_FAISHER["div"]?>', 500, function(){ ancoraHtml('#ancAcao<?=$INC_FAISHER["div"]?>'); });//TIMER<?php }else{ $anterior="0";$proximo="0";}?>
</script>
<form nome="<?=$formVisualizaPincipal?>" id="<?=$formVisualizaPincipal?>" method="post" class="form-horizontal form-column form-bordered form-validate" action="export.php" target="_blank">
             <div style="padding-top:1px;" id="formVisualizarMSG<?=$INC_FAISHER["div"]?>"></div>


<?php if($tab_id == "0"){ ?>

                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosger".$array_temp;//id de controle
						$boxUI_titulo = "Dados Pra Criação de Campo de Informações";// titulo
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
                                        
										<?php $cont_exib++; $d["content"] = "ID registro[,]".$id_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">ID registro</label>
                                            <div class="pagination pagination-large">
                                                <ul>
                                                    <?php if($anterior >= "1"){?><li><a href="#" onclick="janelaAcao<?=$INC_FAISHER["div"]?>('visualizar','id_a=<?=$anterior?>');return false;" style="border:0;" rel="tooltip" data-placement="left" data-original-title="Anterior"><i class="icon-arrow-left"></i></a></li><?php }?>
                                                    <li><a href="#" id="selc<?=$INC_FAISHER["div"]?>" onclick="SelectText('selc<?=$INC_FAISHER["div"]?>');return false;" style="border:0; font-size:28px;" rel="tooltip" data-placement="bottom" data-original-title="Registro atual (clique para selecionar)"><?=$id_a?></a></li>
                                                    <?php if($proximo >= "1"){?><li><a href="#" onclick="janelaAcao<?=$INC_FAISHER["div"]?>('visualizar','id_a=<?=$proximo?>');return false;" style="border:0;" rel="tooltip" data-placement="right" data-original-title="Próximo"><i class="icon-arrow-right"></i></a></li><?php }?>
                                                </ul>
                                            </div>
										</div>
										<?php $cont_exib++; $d["content"] = "Grupo[,]".$grupo_id_n; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Grupo (organizar)</label>
											<div class="controls display">
											  <?=$grupo_id_n?>
											</div>
										</div>
										<?php $cont_exib++; $d["content"] = "Nome na tela[,]".$nome_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Nome na tela</label>
											<div class="controls display">
											  <?=$nome_a?>
											</div>
										</div>
										<?php $cont_exib++; $d["content"] = "Tipo de campo[,]".$tipo_campo_n; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Tipo de campo</label>
											<div class="controls display">
											  <?=$tipo_campo_n?>
											</div>
										</div>
										<?php $cont_exib++; $d["content"] = "Obrigatório[,]".$obrigatorio_n; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Obrigatório</label>
											<div class="controls display">
											  <?=$obrigatorio_n?>
											</div>
										</div>
										<?php if($mascara_a != ""){ $cont_exib++; $d["content"] = "Máscara de entrada[,]".$mascara_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Máscara de entrada</label>
											<div class="controls">
											  <div class="display"><?=$mascara_a?></div>
												a - Representa um caractere alfa (AZ, az)
                                                <br>9 - Representa um caractere numérico (0-9)
                                                <br>* - Representa um caractere alfanumérico (AZ, az, 0-9)
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
                        $boxUI_id = "dadoscampoopcao".$array_temp;//id de controle
						$boxUI_titulo = "Lista de Opções Para o Campo";// titulo
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
                                        
										
										<div class="control-group">
											<label class="control-label">Opções para o campo</label>
											<div class="controls">

	<table id="tabela_itens_opcoes<?=$INC_FAISHER["div"]?>" class="table table-hover table-bordered" style="margin-top:0;">
		<thead>
			<tr>
				<th style="width:90px;">Nº de Ordem</th>
				<th>Descrição</th>
			</tr>
		</thead>
        <tbody>
<?php

$i_cont = "0";

if($tipo_campo_a == "1"){ 

	//monta array de dados
	$array = unserialize($opcoes_a);
	$cont_ARRAY = ceil(count($array));
	if($cont_ARRAY >= "1"){
		foreach ($array as $pos => $valor){
			if($valor != ""){
				$i_cont++;
				$cont_exib++; $d["content"] = "Ordem ".$i_cont."[,]Opção: ".$valor; $d["type"] = "text"; $PRINT_ARRAY[] = $d;

?>
            <tr id="tr<?=$i_cont?>"> 
                <td><?=$i_cont?></td>
                <td><?=$valor?></td>
            </tr>
<?php

			}//if($valor != ""){
		}//fim foreach
	}//fim if($cont_ARRAY >= "1"){

}//if($tipo_campo_a == "1"){ 
?>
    
        </tbody>
	</table>
                                            <span class="help-block"><i class="icon-info-sign"></i> Será disponibilizado ao usuário selecionar uma dessas opções.</span>

											</div>
										</div>

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

<?php }else{//if($tab_id == "0"){ ?>

                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosger".$array_temp;//id de controle
						$boxUI_titulo = "Informações do Grupo de Campos";// titulo
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
                                        
										<?php $cont_exib++; $d["content"] = "ID registro[,]".$id_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">ID registro</label>
                                            <div class="pagination pagination-large">
                                                <ul>
                                                    <?php if($anterior >= "1"){?><li><a href="#" onclick="janelaAcao<?=$INC_FAISHER["div"]?>('visualizar','id_a=<?=$anterior?>');return false;" style="border:0;" rel="tooltip" data-placement="left" data-original-title="Anterior"><i class="icon-arrow-left"></i></a></li><?php }?>
                                                    <li><a href="#" id="selc<?=$INC_FAISHER["div"]?>" onclick="SelectText('selc<?=$INC_FAISHER["div"]?>');return false;" style="border:0; font-size:28px;" rel="tooltip" data-placement="bottom" data-original-title="Registro atual (clique para selecionar)"><?=$id_a?></a></li>
                                                    <?php if($proximo >= "1"){?><li><a href="#" onclick="janelaAcao<?=$INC_FAISHER["div"]?>('visualizar','id_a=<?=$proximo?>');return false;" style="border:0;" rel="tooltip" data-placement="right" data-original-title="Próximo"><i class="icon-arrow-right"></i></a></li><?php }?>
                                                </ul>
                                            </div>
										</div>
										<?php $cont_exib++; $d["content"] = "Nome do grupo[,]".$nome_grupo_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Nome do grupo</label>
											<div class="controls display">
											  <?=$nome_grupo_a?>
											</div>
										</div>

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

<?php }//else{//if($tab_id == "0"){ ?>


            
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
                                        <?php }//if($time_a_a != ""){?>
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
  <input name="nome" id="nome" type="hidden" value="cadastro_protocolotipocampos_<?=$id_a?>-<?=date('d-m-Y')?>" />
  <input name="titulo" id="titulo" type="hidden" value="Processo - <?=$titu_print?>" />
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
	$tab_id = $_GET["tab_id"];

    //id temp para registro de array
    $array_temp = time().rand(9,99999).$cVLogin->getVarLogin("SYS_USER_ID");
	$formCadastroPincipal = "formCadastroPincipal".$array_temp;
	//definir tab de busca
	if($tab_id == "0"){
		$tabela_lerLog = "adm_protocolo_tipo_inf";
		$titu_nov = "CADASTRAR NOVO CAMPO DE INFORMAÇÃO COMPLEMENTAR";
		$titu_edt = "EDITAR CADASTRO DE CAMPO DE INFORMAÇÃO COMPLEMENTAR";
	}else{//if($tab_id == "0"){
		$tabela_lerLog = "adm_protocolo_tipo_inf_grupo";
		$titu_nov = "CADASTRAR NOVO GRUPO DE CAMPOS INFORMAÇÃO";
		$titu_edt = "EDITAR CADASTRO DE GRUPO DE CAMPO DE INFORMAÇÃO";
	}//else{//if($tab_id == "0"){

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


	//definir tab de busca
	if($tab_id == "0"){
if($id_a != "0"){
	$cont = "0";
	$campos = "*";
	$resu1 = fSQL::SQL_SELECT_SIMPLES($campos, "adm_protocolo_tipo_inf", "id = '$id_a'", "");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
	$id_a = $linha1["id"];
	$grupo_id_a = $linha1["grupo_id"];
	$nome_a = $linha1["nome"];
	$tipo_campo_a = $linha1["tipo_campo"];
	$obrigatorio_a = $linha1["obrigatorio"];
	$opcoes_a = $linha1["opcoes"];
	$mascara_a = $linha1["mascara"];
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
	
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES("nome", "adm_protocolo_tipo_inf_grupo", "id = '".$grupo_id_a."'");
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$grupo_id_data .= '{id: "'.$grupo_id_a.'", text: "<b>'.$linha["nome"].'</b>"}';
	}//while	

	//monta array
	$restricoes_deptos_data = "[";
	$array = explode(".",$restricoes_deptos_a);
	$cont_ARRAY = ceil(count($array));
	//listar item ja cadastrados
	if($cont_ARRAY >= "1"){
		foreach ($array as $pos => $valor){
			if($valor != ""){
				$linha2 = fSQL::SQL_SELECT_ONE("code,nome,obs", "sys_perfil_deptos", "id = '".$valor."'", "");
				$code = $linha2["code"];
				$legenda = $linha2["nome"];
				$obs = $linha2["obs"];
				if($restricoes_deptos_data != "["){ $restricoes_deptos_data .= ","; }
				$restricoes_deptos_data .= '{id: "'.$valor.'", text: "<b>'.$legenda.'</b> ('.SYS_CONFIG_RM_SIGLA.' '.fGERAL::legCode($valor,$code).')<br>'.$obs.'"}';
			}//if($valor != ""){
		}//fim foreach
	}//fim if($cont_ARRAY >= "1"){
	if($restricoes_deptos_data != "["){ $restricoes_deptos_data .= "]"; }else{ $restricoes_deptos_data = ""; }
	
}//fim do if if($id_a != "0"){


	}else{//if($tab_id == "0"){
if($id_a != "0"){
	$cont = "0";
	$campos = "*";
	$resu1 = fSQL::SQL_SELECT_SIMPLES($campos, "adm_protocolo_tipo_inf_grupo", "id = '$id_a'", "");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
	$id_a = $linha1["id"];
	$nome_grupo_a = $linha1["nome"];
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
}//fim do if if($id_a != "0"){
	
	}//else{//if($tab_id == "0"){


//limpa campos se o registro e novo
if($id_a == "0"){
	$nome_a = ""; $nome_grupo_a = "";
	$tipo_campo_a = "3";
	$obrigatorio_a = "0";
	$opcoes_a = "";
	$mascara_a = "";
	
//zera as vars de data
	$user_a = $cVLogin->getVarLogin("SYS_USER_NOME");//quem realizou o cadastro
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
		/* ao pressionar uma tecla em um campo*/
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
		$('#div_displayTitulo<?=$INC_FAISHER["div"]?>').html('<?=$titu_nov?>');
		$('#bt_edit<?=$INC_FAISHER["div"]?>, #bt_visual<?=$INC_FAISHER["div"]?>').hide();
		<?php }else{ ?>
		$('#div_displayTitulo<?=$INC_FAISHER["div"]?>').html('<?=$titu_edt?> #<?=$id_a?>');
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

             <input name="tab_id" type="hidden" id="tab_id" value="<?=$tab_id?>" />
                                    <?php if($id_a == "0"){ ?>
									<ul class="tabs tabs-inline tabs-top">
										<li <?php if($tab_id == "0"){ echo 'class="active"'; }?>>
											<a href="#tbcampos<?=$INC_FAISHER["div"]?>" data-toggle="tab" onClick="$('#<?=$formCadastroPincipal?> #tab_id').val('0');"><i class="icon-list"></i> Novo Campo de Informações</a>
										</li>
										<li <?php if($tab_id != "0"){ echo 'class="active"'; }?>>
											<a href="#tbgrupos<?=$INC_FAISHER["div"]?>" data-toggle="tab" onClick="$('#<?=$formCadastroPincipal?> #tab_id').val('1');"><i class="icon-tags"></i> Novo Grupo de Campos</a>
										</li>
									</ul>
									<div class="tab-content padding tab-content-inline tab-content-bottom" style="padding-left:0; padding-right:0;">
										<div class="tab-pane <?php if($tab_id == "0"){ echo 'active'; }?>" id="tbcampos<?=$INC_FAISHER["div"]?>">
                                    <?php }//if($id_a == "0"){ ?>

<?php if((($id_a >= "1") and ($tab_id == "0")) or ($id_a == "0")){ ?>
                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosgerais".$array_temp;//id de controle
						$boxUI_titulo = "Dados Pra Criação de Campo de Informações";// titulo
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
											<label class="control-label">ID registro</label>
											<div class="controls" id="div_idred<?=$INC_FAISHER["div"]?>">
												<div class="input-append input-prepend">
												  <button class="btn" type="button" onclick="regAnt<?=$INC_FAISHER["div"]?>($('#id_inc<?=$INC_FAISHER["div"]?>').val());" rel="tooltip" data-placement="left" data-original-title="Registro anterior"><i class="icon-arrow-left"></i></button>
													<input type="text" class='input-medium' id="id_inc<?=$INC_FAISHER["div"]?>" placeholder="<?php if($id_a >= "1"){ echo $id_a; }else{ echo "NOVO REGISTRO"; }?>" style="text-align:center;" value="<?php if($id_a >= "1"){ echo $id_a; }?>" rel="tooltip" data-placement="bottom" data-original-title="Informe para buscar [Enter]">
													<button class="btn" type="button" onclick="regPro<?=$INC_FAISHER["div"]?>($('#id_inc<?=$INC_FAISHER["div"]?>').val());" rel="tooltip" data-placement="right" data-original-title="Próximo registro"><i class="icon-arrow-right"></i></button>
												</div>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Grupo (organizar)</label>
											<div class="controls select2-full">
                                            	<input type='hidden' value="" name='grupo_id' id='grupo_id' style="width:100%;"/>
<script type="text/javascript">
$(document).ready(function(){
	$('#<?=$formCadastroPincipal?> #grupo_id').select2({
		/*maximumSelectionSize: 1,multiple: true,//*/
		placeholder: 'Selecionar grupo de organização',
		ajax: {
			url: "<?=$AJAX_PAG?>?faisher=<?=$faisher?>&ajax=selGrupo&add&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 50 // page size
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
	<?php if($grupo_id_data != ""){ ?>$("#<?=$formCadastroPincipal?> #grupo_id").select2("data", <?=$grupo_id_data?>);<?php }?>
});
</script>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Nome na tela</label>
											<div class="controls">
											  <input type="text" name="nome" id="nome" value="<?=$nome_a?>" class="input-xlarge span9 cssFonteMai" maxlength="120" data-rule-required="true">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Tipo de campo</label>
											<div class="controls">
                                                <select name="tipo_campo" id="tipo_campo" class="select2-me span12">
                                                	<option value="1" <?php if($tipo_campo_a == "1"){ echo'selected="selected"'; }?>>CAMPO DE OPÇÕES</option>
                                               		<option value="2" <?php if($tipo_campo_a == "2"){ echo'selected="selected"'; }?>>CAMPO NUMÉRICO</option>
                                                	<option value="3" <?php if($tipo_campo_a == "3"){ echo'selected="selected"'; }?>>CAMPO DE TEXTO (possível uso de máscaras)</option>
                                                	<option value="9" <?php if($tipo_campo_a == "9"){ echo'selected="selected"'; }?>>CAMPO DE ARQUIVO (cria trâmite de arquivo)</option>
                                                </select>

<script>
$(document).ready(function(){
	$("#<?=$formCadastroPincipal?> #tipo_campo").on("change", function(e){
		if($(this).val() == "1"){
			$("#<?=$formCadastroPincipal?> #listaOpcpes<?=$array_temp?>").fadeIn();
		}else{
			$("#<?=$formCadastroPincipal?> #listaOpcpes<?=$array_temp?>").hide();
		}
		if($(this).val() == "3"){
			$("#<?=$formCadastroPincipal?> #campoMascara<?=$array_temp?>").fadeIn();
		}else{
			$("#<?=$formCadastroPincipal?> #campoMascara<?=$array_temp?>").hide();
		}
	});
});
</script>
											</div>
										</div>
										<div class="control-group"<?php if($tipo_campo_a != "3"){ echo' style="display:none;"'; }?> id="campoMascara<?=$array_temp?>">
											<label class="control-label">Máscara de entrada</label>
											<div class="controls">
											  <input type="text" name="mascara" id="mascara" value="<?=$mascara_a?>" class="input-xlarge span9" maxlength="100">
                                            	<span class="help-block"><i class="icon-info-sign"></i> *Opcional. Criar entrada de dados "forçada", exemplo: Entrada de (62) 7887-4544 a máscara de entrada seria (99) 9999-9999
                                                    <br>a - Representa um caractere alfa (AZ, az)
                                                    <br>9 - Representa um caractere numérico (0-9)
                                                    <br>* - Representa um caractere alfanumérico (AZ, az, 0-9)
                                                </span>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Campo obrigatório</label>
											<div class="controls">
												<div class="span4">
													<div class="check-line">
														<input name="obrigatorio" type="radio" class='<?=$INC_FAISHER["div"]?>-icheck' id="obrigatorio1" value="1" data-skin="square" data-color="red" <?php if($obrigatorio_a == "1"){ echo 'checked="checked"'; }?>> <label class='inline' for="obrigatorio1">Sim (preenchimento obrigatório)</label>
												  </div>
												</div>
												<div class="span4">
													<div class="check-line">
														<input name="obrigatorio" type="radio" class='<?=$INC_FAISHER["div"]?>-icheck' id="obrigatorio2" value="0" data-skin="square" data-color="green" <?php if($obrigatorio_a != "1"){ echo 'checked="checked"'; }?>> <label class='inline' for="obrigatorio2">Não</label>
												  </div>
												</div>
											</div>
										</div>
                                        
										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
            
            





<div id="listaOpcpes<?=$array_temp?>" <?php if($tipo_campo_a != "1"){ echo'style="display:none;"'; }?>>
                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosopcoes".$array_temp;//id de controle
						$boxUI_titulo = "Lista de Opções Para o Campo";// titulo
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
											<label class="control-label">Opções para o campo</label>
											<div class="controls">

	<table id="tabela_itens_opcoes<?=$INC_FAISHER["div"]?>" class="table table-hover table-bordered" style="margin-top:0;">
		<thead>
			<tr>
				<th style="width:90px;">Nº de Ordem</th>
				<th>Descrição</th>
				<th style="width:20px;">Ação</th>
			</tr>
		</thead>
        <tbody>
<?php

$i_cont = "0";

if(($id_a >= "1") and ($opcoes_a != "")){

	//monta array de dados
	$array = unserialize($opcoes_a);
	$cont_ARRAY = ceil(count($array));
	if($cont_ARRAY >= "1"){
		foreach ($array as $pos => $valor){
			if($valor != ""){
				$i_cont++
?>
            <tr id="tr<?=$i_cont?>"> 
                <td><input type="text" name="opcoes_ordem<?=$i_cont?>" id="opcoes_ordem<?=$i_cont?>" maxlength="2" value="<?=$i_cont?>" class="span11 so_numero"></td>
                <td><input type="text" name="opcoes_texto<?=$i_cont?>" id="opcoes_texto<?=$i_cont?>" maxlength="120" value="<?=$valor?>" class="span11 cssFonteMai"></td>
                <td><button type="button" class="btn" onclick="delLinhaOpcoes<?=$INC_FAISHER["div"]?>('<?=$i_cont?>');"><i class="icon-trash"></i></button></td>
            </tr>
<?php

			}//if($valor != ""){
		}//fim foreach
	}//fim if($cont_ARRAY >= "1"){

}//if($id_a >= "1"){
?>

    
<?php $i_cont++; ?>
            <tr id="tr<?=$i_cont?>">
                <td><input type="text" name="opcoes_ordem<?=$i_cont?>" id="opcoes_ordem<?=$i_cont?>" maxlength="2" value="<?=$i_cont?>" class="span11 so_numero"></td>
                <td><input type="text" name="opcoes_texto<?=$i_cont?>" id="opcoes_texto<?=$i_cont?>" maxlength="120" value="" class="span11 cssFonteMai"></td>
                <td><button type="button" class="btn" onclick="delLinhaOpcoes<?=$INC_FAISHER["div"]?>('<?=$i_cont?>');"><i class="icon-trash"></i></button></td>
            </tr>
    
        </tbody>
	</table>
<input id="opcoes_cont" name="opcoes_cont" type="hidden" value="<?=$i_cont?>" />
<script>
function addLinhaOpcoes<?=$INC_FAISHER["div"]?>(){
	var cont = Number($('#<?=$formCadastroPincipal?> #opcoes_cont').val());
	cont = cont+1;
    $("#tabela_itens_opcoes<?=$INC_FAISHER["div"]?> tbody").append('<tr id="tr'+cont+'"><td><input type="text" name="opcoes_ordem'+cont+'" id="opcoes_ordem'+cont+'" maxlength="2" value="'+cont+'" class="span11"></td><td><input type="text" name="opcoes_texto'+cont+'" id="opcoes_texto'+cont+'" maxlength="120" value="" class="span11 cssFonteMai"></td><td><button type="button" class="btn" onclick="delLinhaOpcoes<?=$INC_FAISHER["div"]?>(\''+cont+'\');"><i class="icon-trash"></i></button></td></tr>');

	$("#<?=$formCadastroPincipal?> #opcoes_ordem"+cont).keypress(verificaNumero);
    $("#<?=$formCadastroPincipal?> #opcoes_texto"+cont).bind("blur change paste", function(e) {
		 var el = $(this);
		 setTimeout(function(){
		 var text = $(el).val();
		 el.val(text.toUpperCase());
		 }, 100);
    });	
	
	$('#<?=$formCadastroPincipal?> #opcoes_texto'+cont).focus();
	$('#<?=$formCadastroPincipal?> #opcoes_cont').val(cont);
}//addLinhaOpcoes


function delLinhaOpcoes<?=$INC_FAISHER["div"]?>(v_tr){
	$('#<?=$formCadastroPincipal?> #tabela_itens_opcoes<?=$INC_FAISHER["div"]?> #tr'+v_tr).remove();
}//delLinhaOpcoes
</script>

											<div style="padding-top:10px;">
												<button type="button" class="btn" onclick="addLinhaOpcoes<?=$INC_FAISHER["div"]?>();"><i class="icon-plus-sign"></i> Adicionar outra linha </button>
                                            </div>
                                            <span class="help-block"><i class="icon-info-sign"></i> Será disponibilizado ao usuário selecionar uma dessas opções.</span>

											</div>
										</div>
                                        
										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
</div>
            
<?php }//if((($id_a >= "1") and ($tab_id == "0")) or ($id_a == "0")){ ?>
            
            

                                        <?php if($id_a == "0"){ ?>
										</div><!-- Fim #tbcampos-->
										<div class="tab-pane <?php if($tab_id != "0"){ echo 'active'; }?>" id="tbgrupos<?=$INC_FAISHER["div"]?>">
                                        <?php }//if($id_a == "0"){ ?>
                                        
<?php if((($id_a >= "1") and ($tab_id != "0")) or ($id_a == "0")){ ?>

                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosgeraisgrupo".$array_temp;//id de controle
						$boxUI_titulo = "Informações do Grupo de Campos";// titulo
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
											<label class="control-label">ID registro</label>
											<div class="controls" id="div_idred<?=$INC_FAISHER["div"]?>">
												<div class="input-append input-prepend">
												  <button class="btn" type="button" onclick="regAnt<?=$INC_FAISHER["div"]?>($('#id_inc<?=$INC_FAISHER["div"]?>').val());" rel="tooltip" data-placement="left" data-original-title="Registro anterior"><i class="icon-arrow-left"></i></button>
													<input type="text" class='input-medium' id="id_inc<?=$INC_FAISHER["div"]?>" placeholder="<?php if($id_a >= "1"){ echo $id_a; }else{ echo "NOVO REGISTRO"; }?>" style="text-align:center;" value="<?php if($id_a >= "1"){ echo $id_a; }?>" rel="tooltip" data-placement="bottom" data-original-title="Informe para buscar [Enter]">
													<button class="btn" type="button" onclick="regPro<?=$INC_FAISHER["div"]?>($('#id_inc<?=$INC_FAISHER["div"]?>').val());" rel="tooltip" data-placement="right" data-original-title="Próximo registro"><i class="icon-arrow-right"></i></button>
												</div>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Nome do grupo</label>
											<div class="controls">
											  <input type="text" name="nome_grupo" id="nome_grupo" value="<?=$nome_grupo_a?>" class="input-xlarge span9 cssFonteMai" maxlength="120" data-rule-required="true">
											</div>
										</div>
                                        
										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
<?php }//if((($id_a >= "1") and ($tab_id == "0")) or ($id_a == "0")){ ?>
                                        
                                   <?php if($id_a == "0"){ ?>
										</div><!-- Fim #tbgrupos-->
									</div><!-- Fim .tab-content-->
                                    <?php }//if($id_a == "0"){ ?>


            
            
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
                                        <?php }//if($user_a_a != ""){?>

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
	if(isset($_GET["tab_id"])){			$tab_id = getpost_sql($_GET["tab_id"]);		}else{ $tab_id = "0";		}





//################################### EXCLUIR DO REGISTRO - SQL EXCLUIR ||||||||||||||||>
if(isset($_GET["id_excluir"])){
	$id_excluir = getpost_sql($_GET["id_excluir"]);
	if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"exc","0",$cVLogin->getVarLogin("SYS_USER_PERFIL_STATUS"))){
		//verifica se já existem registros utilizando o item
		$conta_ver = fSQL::SQL_CONTAGEM("adm_protocolo_tipo", "informacoes LIKE '%.".$id_excluir.".%' AND perfil_id = '".$cVLogin->getVarLogin("SYS_USER_PERFIL_ID")."'");
		//verifica se existe registros vinculados
		if($conta_ver == "0"){//verifica permissão	
			//exclue o registro
			$tabela = "adm_protocolo_tipo_inf";
			$condicao = "id = '$id_excluir' AND perfil_id = '".$cVLogin->getVarLogin("SYS_USER_PERFIL_ID")."'";
			$resu2 =  fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
			fGERAL::delRegistroLog("adm_protocolo_tipo_inf",$id_excluir,$cVLogin->userReg());//salvar/gerar log de exclusao				
			//GERA AÇÃO DO USUÁRIO NA TABELA
			$cVLogin->addAcaoUser("adm_protocolo_tipo_inf", "excluir", $id_excluir);//addAcaoUser($TABELA, $ACAO, $REGISTRO)
			//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
			$cMSG->addMSG("SUCESSO","Registro de campo excluido com sucesso!");
		}else{ $cMSG->addMSG("ERRO","Existem $conta_ver registro(s) vinculados ao item! Não é possível remover."); }//fim else //excluir
	}else{
		//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
		$cMSG->addMSG("ERRO","Erro nas permissões de seu usuário!");
	}//if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"edi")){//verifica permissão
	$tab_id = "0";
}//fim if(isset($_GET["id_excluir"])){
	
if(isset($_GET["id_excluir_grupo"])){
	$id_excluir_grupo = getpost_sql($_GET["id_excluir_grupo"]);
	if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"edg","0",$cVLogin->getVarLogin("SYS_USER_PERFIL_STATUS"))){
		//verifica se já existem registros utilizando o item
		$conta_ver = fSQL::SQL_CONTAGEM("adm_protocolo_tipo_inf", "grupo_id = '".$id_excluir_grupo."' AND perfil_id = '".$cVLogin->getVarLogin("SYS_USER_PERFIL_ID")."'");
		//verifica se existe registros vinculados
		if($conta_ver == "0"){//verifica permissão	
			//exclue o registro
			$tabela = "adm_protocolo_tipo_inf_grupo";
			$condicao = "id = '$id_excluir_grupo' AND perfil_id = '".$cVLogin->getVarLogin("SYS_USER_PERFIL_ID")."'";
			$resu2 =  fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
			fGERAL::delRegistroLog("adm_protocolo_tipo_inf_grupo",$id_excluir_grupo,$cVLogin->userReg());//salvar/gerar log de exclusao				
			//GERA AÇÃO DO USUÁRIO NA TABELA
			$cVLogin->addAcaoUser("adm_protocolo_tipo_inf_grupo", "excluir", $id_excluir_grupo);//addAcaoUser($TABELA, $ACAO, $REGISTRO)
			//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
			$cMSG->addMSG("SUCESSO","Registro  de Grupo excluido com sucesso!");
		}else{ $cMSG->addMSG("ERRO","Existem $conta_ver registro(s) de campos vinculados ao item! Não é possível remover."); }//fim else //excluir
	}else{
		//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
		$cMSG->addMSG("ERRO","Erro nas permissões de seu usuário!");
	}//if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"edg")){//verifica permissão
	$tab_id = "1";
}//fim if(isset($_GET["id_excluir_grupo"])){
//################################### EXCLUIR DO REGISTRO - SQL EXCLUIR ||||||||||||||||<








 







//################################# VARIAVEIS DE VALIDACAO DO REGISTRO ||||||||||||||||>
$verificaRegistro = "0";
if(isset($_POST["id_a"])){
	$verifica_erro = "0"; //zera variavel de verificacao de erros
	//recebe vars - padrao
	$id_a = getpost_sql($_POST["id_a"]);
	$array_temp = getpost_sql($_POST["array_temp"]);
	//recebe vars - geral
	$tab_id = $_POST["tab_id"];
	$grupo_id_a = getpost_sql($_POST["grupo_id"]);
	$nome_a = getpost_sql($_POST["nome"],"MAIUSCULO");
	$tipo_campo_a = getpost_sql($_POST["tipo_campo"]);
	$obrigatorio_a = getpost_sql($_POST["obrigatorio"]);
	$opcoes_cont_a = getpost_sql($_POST["opcoes_cont"]);
	$mascara_a = getpost_sql($_POST["mascara"]);
	if($tipo_campo_a != "3"){ $mascara_a = ""; }
		
	$nome_grupo_a = getpost_sql($_POST["nome_grupo"],"MAIUSCULO");
		
		


//VALIDAÇÔES ------------------------------**********
	//verifica TAB
	if($tab_id == "0"){
		//valida campo grupo_id_a -- XXX
		if($grupo_id_a == ""){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
			$verifica_erro .= "- Campo Grupo é importante para organização não pode estar vazio, preencha corretamete!";//msg
		}//fim if valida campo
		//valida campo nome_a -- XXX
		if($nome_a == ""){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
			$verifica_erro .= "- Campo Nome não pode estar vazio, preencha corretamete!";//msg
		}//fim if valida campo
		
		//verifica se já existe no sistem
		$sql_complemto = " AND id != '$id_a'";	
		if($id_a == "0"){ $sql_complemto = ""; }//if($id_a == "0"){
		$cont_ = "0";
		$resu1 = fSQL::SQL_SELECT_SIMPLES("id", "adm_protocolo_tipo_inf", "perfil_id = '".$cVLogin->getVarLogin("SYS_USER_PERFIL_ID")."' AND nome = '$nome_a' $sql_complemto", "");
		while($linha1 = fSQL::FETCH_ASSOC($resu1)){
			$cont_++;
		}//fim while
		if($cont_ >= "1"){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
			$verifica_erro .= "- O nome ($nome_a) está em uso, não pode ser utilizados nomes iguais! Utilize outro nome.";//msg
		}//fim if valida campo
		
		//lista de opções
		$opcoes_a = "";
		if($tipo_campo_a == "1"){
			//monta array de opcoes_cont_a
			$cont = "0"; unset($i_ARRAY);
			while($cont <= $opcoes_cont_a){
				$cont++;
				if((isset($_POST["opcoes_texto".$cont])) and ($_POST["opcoes_texto".$cont] != "")){
					$opcoes_ordem = $_POST["opcoes_ordem".$cont];
					if(isset($i_ARRAY["$opcoes_ordem"])){ $opcoes_ordem++; }
					if(isset($i_ARRAY["$opcoes_ordem"])){ $opcoes_ordem++; }
					if(isset($i_ARRAY["$opcoes_ordem"])){ $opcoes_ordem++; }
					if(isset($i_ARRAY["$opcoes_ordem"])){ $opcoes_ordem++; }
					if(isset($i_ARRAY["$opcoes_ordem"])){ $opcoes_ordem++; }
					if(isset($i_ARRAY["$opcoes_ordem"])){ $opcoes_ordem++; }
					if(isset($i_ARRAY["$opcoes_ordem"])){ $opcoes_ordem++; }
					if(isset($i_ARRAY["$opcoes_ordem"])){ $opcoes_ordem++; }
					if(isset($i_ARRAY["$opcoes_ordem"])){ $opcoes_ordem++; }
					if(isset($i_ARRAY["$opcoes_ordem"])){ $opcoes_ordem++; }
					if(isset($i_ARRAY["$opcoes_ordem"])){ $opcoes_ordem++; }
					if(isset($i_ARRAY["$opcoes_ordem"])){ $opcoes_ordem++; }
					if(isset($i_ARRAY["$opcoes_ordem"])){ $opcoes_ordem++; }
					$i_ARRAY["$opcoes_ordem"] = getpost_sql($_POST["opcoes_texto".$cont],"MAIUSCULO");
				}//isset
			}//fim while
			if(!isset($i_ARRAY)){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
				$verifica_erro .= "- Informe no mínimo duas opções para o campo.";//msg
			}else{
				if(fGERAL::repetidoItemArray($i_ARRAY)){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
					$verifica_erro .= "- Existem opções repetidas na lista, verifique corretamente!.";//msg
				}else{
					ksort($i_ARRAY);
					unset($i_ARRAYn);
					//monta array de dados
					$array = $i_ARRAY;
					$cont_ARRAY = ceil(count($array));
					if($cont_ARRAY >= "1"){
						foreach ($array as $pos => $valor){
							if($valor != ""){
								$i_ARRAYn[] = $valor;
							}//if($valor != ""){
						}//fim foreach
					}//fim if($cont_ARRAY >= "1"){
					unset($i_ARRAY);
					if(isset($i_ARRAYn)){ $opcoes_a = serialize($i_ARRAYn); }
				}//else
			}//else
		}//if($tipo_campo_a == "1"){

	}else{//if($tab_id == "0"){
		//valida campo nome_grupo_a -- XXX
		if($nome_grupo_a == ""){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
			$verifica_erro .= "- Campo Nome do Grupo não pode estar vazio, preencha corretamete!";//msg
		}//fim if valida campo
		
		//verifica se já existe no sistem
		$sql_complemto = " AND id != '$id_a'";	
		if($id_a == "0"){ $sql_complemto = ""; }//if($id_a == "0"){
		$cont_ = "0";
		$resu1 = fSQL::SQL_SELECT_SIMPLES("id", "adm_protocolo_tipo_inf_grupo", "perfil_id = '".$cVLogin->getVarLogin("SYS_USER_PERFIL_ID")."' AND nome = '$nome_grupo_a' $sql_complemto", "");
		while($linha1 = fSQL::FETCH_ASSOC($resu1)){
			$cont_++;
		}//fim while
		if($cont_ >= "1"){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
			$verifica_erro .= "- O nome do grupo ($nome_grupo_a) está em uso, não pode ser utilizados nomes iguais! Utilize outro nome.";//msg
		}//fim if valida campo
		
	}//else{//if($tab_id == "0"){



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


	//verifica TAB
	if($tab_id == "0"){
		///VERIFICA PERMISSÕES DE ACESSO
		if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"cad","0",$cVLogin->getVarLogin("SYS_USER_PERFIL_STATUS"))){ $verificaRegistro = "0";
			//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
			$cMSG->addMSG("ERRO","Usuário sem permissão de acesso! Verifique com administrador.");
		}//loginAcesso
		if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"edi","0",$cVLogin->getVarLogin("SYS_USER_PERFIL_STATUS"))){ $verificaRegistro = "0";
			//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
			$cMSG->addMSG("ERRO","Usuário sem permissão de acesso! Verifique com administrador.");
		}//loginAcesso
	}else{//if($tab_id == "0"){
		///VERIFICA PERMISSÕES DE ACESSO
		if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"edg","0",$cVLogin->getVarLogin("SYS_USER_PERFIL_STATUS"))){ $verificaRegistro = "0";
			//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
			$cMSG->addMSG("ERRO","Usuário sem permissão de acesso! Verifique com administrador.");
		}//loginAcesso
	}//else{//if($tab_id == "0"){

}//fim isset if(isset($_POST["id_a"])){
	
//################################################################ VERIFICACOES ALTERA/GRAVA O REGISTRO ||||||||||||||||>
if($verificaRegistro == "1"){


	
	
	
//execulta as ! consultas SQL ! consultas SQL ! consultas SQL ! consultas SQL ! consultas SQL ! consultas SQL ! consultas SQL
unset($ARRAY_LOG);//destroe array de log auditoria
//verifica se grava novo registro
if($id_a == "0"){ //############# IF - GRAVA NOVO REGISTRO |-----> SQL CADASTRO

	//verifica TAB
	if($tab_id == "0"){
		//insere o registro na tabela do sistema
		//VARS insert simples SQL
		$tabela = "adm_protocolo_tipo_inf";
		//busca ultimo id para insert
		$id_a = fSQL::SQL_SELECT_INSERT($tabela, "id");
		$campos = "id,perfil_id,grupo_id,nome,tipo_campo,obrigatorio,opcoes,mascara,user,time,user_a,sync";
		$valores = array($id_a,$cVLogin->getVarLogin("SYS_USER_PERFIL_ID"),$grupo_id_a,$nome_a,$tipo_campo_a,$obrigatorio_a,$opcoes_a,$mascara_a,$cVLogin->userReg(),time(),"0",time());
		$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
		$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria
		
		//GERA AÇÃO DO USUÁRIO NA TABELA
		$cVLogin->addAcaoUser("adm_protocolo_tipo_inf", "adicionar", $id_a);//addAcaoUser($TABELA, $ACAO, $REGISTRO)
		//GERA LOGS DE TABELAS
		if(isset($ARRAY_LOG)){//gerar log de auditoria	
			fGERAL::gravaLog("adm_protocolo_tipo_inf",$id_a,$ARRAY_LOG,$cVLogin->userReg());
		}//if(isset($ARRAY_LOG)){
		//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
		$cMSG->addMSG("SUCESSO","Nova informação complementar cadastrada com sucesso!$msg_cont <a href=\"#\" onclick=\"janelaAcao".$INC_FAISHER["div"]."(\\'visualizar\\',\\'id_a=".$id_a."\\');return false;\" class=\"btn sAcao\" rel=\"tooltip\" title=\"Visualizar\"><i class=\"icon-search\"></i></a>");

	}else{//if($tab_id == "0"){
		//insere o registro na tabela do sistema
		//VARS insert simples SQL
		$tabela = "adm_protocolo_tipo_inf_grupo";
		//busca ultimo id para insert
		$id_a = fSQL::SQL_SELECT_INSERT($tabela, "id");
		$campos = "id,perfil_id,nome,user,time,user_a,sync";
		$valores = array($id_a,$cVLogin->getVarLogin("SYS_USER_PERFIL_ID"),$nome_grupo_a,$cVLogin->userReg(),time(),"0",time());
		$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
		$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria
		
		//GERA AÇÃO DO USUÁRIO NA TABELA
		$cVLogin->addAcaoUser("adm_protocolo_tipo_inf_grupo", "adicionar", $id_a);//addAcaoUser($TABELA, $ACAO, $REGISTRO)
		//GERA LOGS DE TABELAS
		if(isset($ARRAY_LOG)){//gerar log de auditoria	
			fGERAL::gravaLog("adm_protocolo_tipo_inf_grupo",$id_a,$ARRAY_LOG,$cVLogin->userReg());
		}//if(isset($ARRAY_LOG)){
		//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
		$cMSG->addMSG("SUCESSO","Novo grupo de campos cadastrado com sucesso!$msg_cont <a href=\"#\" onclick=\"janelaAcao".$INC_FAISHER["div"]."(\\'visualizar\\',\\'id_a=".$id_a."\\');return false;\" class=\"btn sAcao\" rel=\"tooltip\" title=\"Visualizar\"><i class=\"icon-search\"></i></a>");
		
	}//else{//if($tab_id == "0"){

}else{  //############# ELSE - ALTERA REGISTRO |-


	
	//verifica TAB
	if($tab_id == "0"){	
		//atualiza dados da tabela no DB
		$campos = "grupo_id,nome,tipo_campo,obrigatorio,opcoes,mascara,user_a,sync";
		$tabela = "adm_protocolo_tipo_inf";
		$valores = array($grupo_id_a,$nome_a,$tipo_campo_a,$obrigatorio_a,$opcoes_a,$mascara_a,$cVLogin->userReg(),time());
		$condicao = "id='$id_a' AND perfil_id = '".$cVLogin->getVarLogin("SYS_USER_PERFIL_ID")."'";
		fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
		$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria
		
		//GERA AÇÃO DO USUÁRIO NA TABELA
		$cVLogin->addAcaoUser("adm_protocolo_tipo_inf", "editar", $id_a);//addAcaoUser($TABELA, $ACAO, $REGISTRO)
		//GERA LOGS DE TABELAS
		if(isset($ARRAY_LOG)){//gerar log de auditoria	
			fGERAL::gravaLog("adm_protocolo_tipo_inf",$id_a,$ARRAY_LOG,$cVLogin->userReg());
		}//if(isset($ARRAY_LOG)){
		//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
		$cMSG->addMSG("SUCESSO","Registro atualizado com sucesso.$msg_cont <a href=\"#\" onclick=\"janelaAcao".$INC_FAISHER["div"]."(\\'visualizar\\',\\'id_a=".$id_a."\\');return false;\" class=\"btn sAcao\" rel=\"tooltip\" title=\"Visualizar\"><i class=\"icon-search\"></i></a>");
		
	}else{//if($tab_id == "0"){
		//atualiza dados da tabela no DB
		$campos = "nome,user_a,sync";
		$tabela = "adm_protocolo_tipo_inf_grupo";
		$valores = array($nome_grupo_a,$cVLogin->userReg(),time());
		$condicao = "id='$id_a' AND perfil_id = '".$cVLogin->getVarLogin("SYS_USER_PERFIL_ID")."'";
		fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
		$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria
		
		//GERA AÇÃO DO USUÁRIO NA TABELA
		$cVLogin->addAcaoUser("adm_protocolo_tipo_inf_grupo", "editar", $id_a);//addAcaoUser($TABELA, $ACAO, $REGISTRO)
		//GERA LOGS DE TABELAS
		if(isset($ARRAY_LOG)){//gerar log de auditoria	
			fGERAL::gravaLog("adm_protocolo_tipo_inf_grupo",$id_a,$ARRAY_LOG,$cVLogin->userReg());
		}//if(isset($ARRAY_LOG)){
		//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
		$cMSG->addMSG("SUCESSO","Registro atualizado com sucesso.$msg_cont <a href=\"#\" onclick=\"janelaAcao".$INC_FAISHER["div"]."(\\'visualizar\\',\\'id_a=".$id_a."\\');return false;\" class=\"btn sAcao\" rel=\"tooltip\" title=\"Visualizar\"><i class=\"icon-search\"></i></a>");
	
	}//else{//if($tab_id == "0"){
	
}//fim do else if($id_a == "0"){ //############# FIM ELSE - ALTERA REGISTRO |-

//se veio cadastro de um POPUP para execução do script
if(verPop("isset")){
	$POP = $_GET["POP"];
	if($POP == "1"){ $POP = ""; }else{
		if($tipo_campo_a == "1"){ $tipo_campo_n = "OPÇÃO"; }
		if($tipo_campo_a == "2"){ $tipo_campo_n = "NUMÉRICO"; }
		if($tipo_campo_a == "3"){ $tipo_campo_n = "TEXTO"; }
		if($tipo_campo_a == "9"){ $tipo_campo_n = "ARQUIVO"; }
	
		$id = $id_a;
		$texto = $id." - <b>".$nome_a."</b><br><i>".$tipo_campo_n."</i>";
		
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
//verifica tab_id
	if($tab_id == "0"){
		$SQL_campos = "C.id,C.nome,C.tipo_campo,C.obrigatorio,C.mascara,C.sync,G.nome AS grupo"; //campos da tabela
		$SQL_tabela = "adm_protocolo_tipo_inf C, adm_protocolo_tipo_inf_grupo G"; //tabela
		$SQL_where = "C.grupo_id = G.id"; //condição
	}else{
		$SQL_campos = "C.id,C.nome,C.sync"; //campos da tabela
		$SQL_tabela = "adm_protocolo_tipo_inf_grupo C"; //tabela
		$SQL_where = ""; //condição		
	}
	$SQL_varEnvio = "ajax=lista&faisher=$faisher&tab_id=$tab_id&"; //variaveis para a paginacao
	$ORDEM_C = "C.nome";//campo de ordenar
	$ORDEM = "ASC";// ASC ou DESC
	$SQL_group = "GROUP BY C.id"; // agrupar o resultado GROUP BY

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






//verifica se recebeu uma solicitação de busca por rapida_b
if($rapida_b != ""){  $filtro_marca[] = $rapida_b;
		$filtro_b["rapida_b"] = "Busca rápida por <b>$rapida_b</b>";
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " ( C.`id` = '$rapida_b' OR C.`nome` LIKE '%$rapida_b%' ) "; //condição 
		$AJAX_GET .= "rapida_b=$rapida_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por rapida_b





//verifica se recebeu uma solicitação de busca por data de cadastro
if(($datai_b != "") or ($dataf_b != "")){  $filtro_marca[] = $datai_b;  $filtro_marca[] = $dataf_b;
		if($datai_b == ""){ $datai_b = $dataf_b; } if($dataf_b == ""){ $dataf_b = $datai_b; }
		$timei_a = time_data_hora("$datai_b 0:0"); //converte data/hora em time UNIX "04/03/2011 10:11"
		$timef_a = time_data_hora("$dataf_b 23:59"); //converte data/hora em time UNIX "04/03/2011 10:11"
		$filtro_b["data_b"] = "De <b>$datai_b</b> até <b>$dataf_b</b>";
		if($timei_a > $timef_a){ $timef_a = $timei_a; $filtro_b["data_b"] = "De <b>$datai_b</b> até <b>$datai_b</b> (data foi ajustada)"; }
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " C.time >= '$timei_a' AND C.time <= '$timef_a' "; //condição
		$AJAX_GET .= "datai_b=$datai_b&dataf_b=$dataf_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por data cadastro



//verifica se recebeu uma solicitação de busca por nome
if($nome_b != ""){  $filtro_marca[] = $nome_b;
		$filtro_b["nome_b"] = "Busca por <b>$nome_b</b>";
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " ( C.`nome` LIKE '%$nome_b%' ) "; //condição 
		$AJAX_GET .= "nome_b=$nome_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por nome










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
	
	//atualiza dados de tabs
	$('.tabs-<?=$INC_FAISHER["div"]?>').removeClass('active');
	$('#<?=$tab_id?>-<?=$INC_FAISHER["div"]?>').addClass('active');
	$('#tab_id<?=$INC_FAISHER["div"]?>').val('<?=$tab_id?>');
	//conta registros aba
	$('#cont-0<?=$INC_FAISHER["div"]?>').html('(<?=fSQL::SQL_CONTAGEM("adm_protocolo_tipo_inf", "perfil_id = '".$cVLogin->getVarLogin("SYS_USER_PERFIL_ID")."'")?>)');
	$('#cont-1<?=$INC_FAISHER["div"]?>').html('(<?=fSQL::SQL_CONTAGEM("adm_protocolo_tipo_inf_grupo", "perfil_id = '".$cVLogin->getVarLogin("SYS_USER_PERFIL_ID")."'")?>)');
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
				<?php $c_or = "C.id"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>">#ID</th>
<?php
//verifica tab_id
	if($tab_id == "0"){
?>
				<?php $c_or = "G.nome"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>">Grupo</th>
				<?php $c_or = "C.nome"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>">Nome/Tipo Campo</th>
				<?php $c_or = "C.obrigatorio"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>">Obrigatório/Entrada</th>
<?php }else{?>
				<?php $c_or = "C.nome"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>">Nome/Grupo</th>
<?php }//else{?>
				<th>EM USO</th>
				<th>Ação</th>
			</tr>
		</thead>
	<tbody>
<?php



//verifica tab_id
	if($tab_id == "0"){
		///VERIFICA PERMISSÕES DE ACESSO
		if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"edi","0",$cVLogin->getVarLogin("SYS_USER_PERFIL_STATUS"))){ $pEdit = "1"; }else{ $pEdit = "0"; }//loginAcesso
		if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"exc","0",$cVLogin->getVarLogin("SYS_USER_PERFIL_STATUS"))){ $pExc = "1"; }else{ $pExc = "0"; }//loginAcesso
	}else{//if($tab_id == "0"){
		if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"edg","0",$cVLogin->getVarLogin("SYS_USER_PERFIL_STATUS"))){ $pEdit = "1"; $pExc = "1"; }else{ $pEdit = "0"; $pExc = "0"; }//loginAcesso
	}//else{//if($tab_id == "0"){


	

//vars adicionais ao SQL ----------------------------------- Vars SQL
//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL Listagem
//inicia a listagem do SQL de paginação
//se a contagem de zerado nao ativa o if que percorre as linhas
	if($n_paginas >= "1"){
while($linha1 = fSQL::FETCH_ASSOC($QueryListaPag)){
	$id_a = $linha1["id"];
	$nome = $linha1["nome"];
	//verifica tab_id
	if($tab_id == "0"){
		$tipo_campo = $linha1["tipo_campo"];
		$obrigatorio = $linha1["obrigatorio"];
		$mascara = $linha1["mascara"];
		$sync = $linha1["sync"];
		$grupo = $linha1["grupo"];
		$obrigatorio_leg = "NÃO"; if($obrigatorio == "1"){ $obrigatorio_leg = "SIM"; }
		if($tipo_campo == "1"){ $tipo_campo_n = "OPÇÃO"; }
		if($tipo_campo == "2"){ $tipo_campo_n = "NUMÉRICO"; }
		if($tipo_campo == "3"){ $tipo_campo_n = "TEXTO"; }
		if($tipo_campo == "9"){ $tipo_campo_n = "ARQUIVO"; }
		//busca dados
		$contTotal = fSQL::SQL_CONTAGEM("adm_protocolo_tipo", "informacoes LIKE '%.".$id_a.".%'");
		$var_excluir = "id_excluir";
	}else{//if($tab_id == "0"){
		//busca dados
		$contTotal = fSQL::SQL_CONTAGEM("adm_protocolo_tipo_inf", "grupo_id = '".$id_a."'");
		$var_excluir = "id_excluir_grupo";
	}//else{//if($tab_id == "0"){
?>
										<tr>
											<td class="sVisu"><b>#<?=$id_a?></b></td>
<?php
//verifica tab_id
	if($tab_id == "0"){
?>
											<td class="sVisu"><?=$grupo?></td>
											<td class="sVisu"><b><?=maiusculo($nome)?></b><br>CAMPO <?=$tipo_campo_n?></td>
											<td class='sVisu'><b><?=$obrigatorio_leg?></b><?php if($mascara != ""){ echo "<br>".$mascara; }?></td>
<?php }else{?>
											<td class="sVisu"><b><?=maiusculo($nome)?></b></td>
<?php }//else{?>
											<td class='sVisu'><?=$contTotal?> item(s)</td>
											<td>
												<a href="#" onclick="janelaAcao<?=$INC_FAISHER["div"]?>('visualizar','id_a=<?=$id_a?>&tab_id=<?=$tab_id?>');return false;" class="btn sAcao" rel="tooltip" title="Visualizar"><i class="icon-search"></i></a>
												<?php if($pEdit == "1"){?><a href="#" onclick="janelaAcao<?=$INC_FAISHER["div"]?>('registro','id_a=<?=$id_a?>&tab_id=<?=$tab_id?>');return false;" class="btn" rel="tooltip" title="Editar"><i class="icon-edit"></i></a><?php }?>
												<?php if($pExc == "1"){?><a href="#" onclick="if(confirm('Gostaria realmete de remover \'<?=$nome?>\'?')) { carregaLista<?=$INC_FAISHER["div"]?>('ajax=lista&<?=$var_excluir?>=<?=$id_a?>&'+$('#AJAX_GET<?=$INC_FAISHER["div"]?>').val());ancoraHtml('#ancAcao<?=$INC_FAISHER["div"]?>'); }return false;" class="btn" rel="tooltip" title="Remover"><i class="icon-remove"></i></a><?php }?>
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
	if(isset($_GET["tab_id"])){ $tab_id = $_GET["tab_id"]; }else{ $tab_id = "0"; }
	
	
	///VERIFICA PERMISSÕES DE ACESSO
	if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"cad","0",$cVLogin->getVarLogin("SYS_USER_PERFIL_STATUS"))){ $pCadastro = "OFF"; }//loginAcesso
	
	//include de padrao
	$INC_VAR["tabSel"] = $tab_id;//adicionar array de guias [tab]
	$INC_VAR["tabs"][] = '0[,]<i class="icon-list"></i> Campos de Informação <span id="cont-0'.$INC_FAISHER["div"].'"></span>';//adicionar array de guias [tab], onde ID[,]TEXTO
	$INC_VAR["tabs"][] = '1[,]<i class="icon-tags"></i> Grupos <span id="cont-1'.$INC_FAISHER["div"].'"></span>';//adicionar array de guias [tab], onde ID[,]TEXTO
	$INC_VAR["buscaAvancada"] = "ON";//ON - OFF > Busca avançãda, retorno ajax [buscaAvancada]
	include "inc/inc_lista-padrao.php";
	
	

}//fim ajax  -------------------------------------------- <<<














?>