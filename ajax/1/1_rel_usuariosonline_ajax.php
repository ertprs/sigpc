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
































































//AJAX (gráfico de comparação de tempo de sessao de usuarios online) ------------------------------------------------------------------>>>
if($ajax == "graficoTempo"){
	///VERIFICA PERMISSÕES DE ACESSO
	if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"gra")){ echo "Opss... sem premissão!"; exit(0); }//loginAcesso


//pega vars de busca
	if(isset($_GET["rapida_b"])){   					 $rapida_b = getpost_sql($_GET["rapida_b"]);   						  }else{ $rapida_b = "";    	    }
	if(isset($_GET["nome_b"])){       					 $nome_b = getpost_sql($_GET["nome_b"]);       		     			  }else{ $nome_b = "";    		    }
	if(isset($_GET["datai_b"])){       					 $datai_b = getpost_sql($_GET["datai_b"]);       		   			  }else{ $datai_b = "";    		    }
	if(isset($_GET["dataf_b"])){       					 $dataf_b = getpost_sql($_GET["dataf_b"]);       		   			  }else{ $dataf_b = "";    		    }
	if(isset($_GET["perfil_b"])){      					 $perfil_b = getpost_sql($_GET["perfil_b"]);      		   			  }else{ $perfil_b = "";   		    }
	



//verifica se recebeu uma solicitação de busca por rapida_b
if($rapida_b != ""){ 
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " ( S.`session` = '$rapida_b' OR S.`usuarios_id` = '$rapida_b' OR U.`nome` LIKE '%$rapida_b%' OR U.`celular` LIKE '%$rapida_b%' OR P.`nome` LIKE '%$rapida_b%' OR P.`apelido` LIKE '%$rapida_b%' ) "; //condição 
		$AJAX_GET .= "rapida_b=$rapida_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por rapida_b




//verifica se recebeu uma solicitação de busca por data de cadastro
if(($datai_b != "") or ($dataf_b != "")){
		if($datai_b == ""){ $datai_b = $dataf_b; } if($dataf_b == ""){ $dataf_b = $datai_b; }
		$timei_a = time_data_hora("$datai_b 0:0"); //converte data/hora em time UNIX "04/03/2011 10:11"
		$timef_a = time_data_hora("$dataf_b 23:59"); //converte data/hora em time UNIX "04/03/2011 10:11"
		if($timei_a > $timef_a){ $timef_a = $timei_a; }
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " S.time_i >= '$timei_a' AND S.time_i <= '$timef_a' "; //condição
		$AJAX_GET .= "datai_b=$datai_b&dataf_b=$dataf_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por data cadastro



//verifica se recebeu uma solicitação de busca por nome
if($nome_b != ""){
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " ( U.`nome` LIKE '%$nome_b%' OR U.`cpf` LIKE '%$nome_b%' ) "; //condição 
		$AJAX_GET .= "nome_b=$nome_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por nome



//verifica se recebeu uma solicitação de busca por perfil
if($perfil_b != ""){
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= "S.perfil_id = '$perfil_b'"; //condição 
		$AJAX_GET .= "perfil_b=$perfil_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por perfil




	
//monta dados do grafico
$java = ""; $min_width = "940";
$cont_reg = "0";
//dados da tabela
$table_colspan = "2";//quantidade de colunas
$table_titu = '<tr><th>USUÁRIO ONLINE</th><th>MINUTOS</th></tr>';//título das colunas
$table_dados = '';//inicia a linha que recebe os dados

//inicia a busca dos dados
if($SQL_where != ""){ $SQL_where = " AND ".$SQL_where; }
$resu1 = fSQL::SQL_SELECT_SIMPLES("S.time_i,U.nome", "sys_login_session S, sys_usuarios U, sys_perfil P", "S.usuarios_id = U.id AND S.perfil_id = P.id $SQL_where", "GROUP BY S.id ORDER BY U.nome ASC");
while($linha1 = fSQL::FETCH_ASSOC($resu1)){
	$time_i_i = $linha1["time_i"];
	$nome_i = sentenca(primeiro_nome($linha1["nome"],"2"));
	$soma = (int)(time()-$time_i_i)/60;
	$soma = formataValor($soma,"",".","","0");
	if($java != ""){ $java .= " , "; } $java .= "['".$nome_i."', ".$soma."]";
	 $min_width =  $min_width+20;//incrementa largura
	 $cont_reg++;
	 //tabela
	 $table_dados .= '<tr><td>'.$nome_i.'</td><td><b>'.$soma.'</b></td></tr>';//inicia a linha que recebe os dados
}//while
		

//config controle ids html/js
$ids_hmtl = "Tempo";
$info_titu = "Comparativo de Tempo Online";//título de exibição
$info_titusub = "Localizados ".$cont_reg." sessões no filtro selecionado.";//subtítulo de exibição
?>
<script type="text/javascript">
	//recarrega se mudar tamanho da pagina
	var rezi = window.onresize = grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>;
	function graficoTempo<?=$INC_FAISHER["div"]?>(){
		$("#grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>").css("min-width", "<?=$min_width?>px");				
        $('#grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: '<?=$info_titu?>',
				align: 'left',
				x: 10,
				y: 0,
				style: {
					fontSize: '14px',
					fontFamily: 'Verdana, sans-serif'
				}
            },
            subtitle: {
                text: '<?=$info_titusub?>',
				align: 'left',
				x: 10,
				y: 15,
				floating: true,
				style: {
					fontSize: '9px'
				}
            },
			xAxis: {
				type: 'category',
				labels: {
					rotation: -45,
					style: {
						fontSize: '13px',
						fontFamily: 'Verdana, sans-serif'
					}
				}
			},
			yAxis: {
				min: 0,
				title: {
					text: 'Tempo online (minutos)'
				}
			},
			legend: {
				enabled: false
			},
			tooltip: {
				pointFormat: 'Tempo da sessão: <b>{point.y} minutos</b>'
			},
            credits: {
                enabled: false
            },
			series: [{
				name: 'Tempo',
				data: [<?=$java?>],
				dataLabels: {
					enabled: true,
					rotation: -90,
					color: '#FFFFFF',
					align: 'right',
					format: '{point.y}',
					y: 10, // 10 pixels down from the top
					style: {
						fontSize: '13px',
						fontFamily: 'Verdana, sans-serif'
					}
				}
			}],
			exporting: {
				sourceWidth: $("#grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>").width(),
				sourceHeight: $("#grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>").height(),
				// scale: 2 (default)
			},
			navigation: {
				buttonOptions: {
					align: 'left',
					verticalAlign: 'bottom',
					y: -20
				}
			}
        });
		$(".highcharts-button").show();//volta botao de export
	}
	$.doTimeout('vTimerOnLoadgrafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>', 0, function(){ ajustaDivWin(); grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>(); });//TIMER	
	function btlista<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>(v_exibe){
		$("#div_grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>").hide(); $("#div_lista<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>").hide();
		$("#div_"+v_exibe+"<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>").fadeIn();
	}
	function export_<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>() {
		var htmlPlanilha = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>PlanilhaTeste</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>' + document.getElementById("table_lista<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>").innerHTML + '</table></body></html>';	 
		var htmlBase64 = btoa(htmlPlanilha);
		window.location="data:application/vnd.ms-excel;base64," + htmlBase64;
	}
</script>
<div style="width:100%; overflow:auto; overflow-y:hidden;" class="windiv" id="div_grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>">
	<button class="btn btn-orange btn-large" style="position:absolute; z-index:9; right:0px; margin:10px; border-radius:20px;" onclick="btlista<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>('lista');"><i class="icon-list"></i> EXIBIR EM LISTA</button>
	<div id="grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>" style="width:100%; min-height:250px; margin: 0 auto; padding-top:20px;" class="windivIn"></div>
</div>

<div style="width:100%; height:100%; overflow:auto; overflow-x:hidden; display:none;" class="windiv" id="div_lista<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>">
	<button class="btn btn-orange btn-large" style="position:absolute; z-index:9; margin:10px 0 0 10px; border-radius:20px;" onclick="btlista<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>('grafico');"><i class="glyphicon-charts"></i> EXIBIR EM GRÁFICO</button>    
    <div style="padding:15px; text-align:right;">Exportar dados Excel <button class="btn btn-primary" onclick="export_<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>();"><i class="icon-download-alt"></i> DOWNLOAD</button></div>    
	<table class="table table-hover table-bordered table-nomargin table-striped" id="table_lista<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>">
		<thead>
			<tr>
				<th colspan="<?=$table_colspan?>" style="text-align:center; font-size:18px; text-transform:uppercase;"><?=$info_titu?></th>
			</tr>
			<tr>
				<th colspan="<?=$table_colspan?>" style="text-align:right; font-weight:normal;"><?=$info_titusub?></th>
			</tr>
            <?=$table_titu?>
		</thead>
        <tbody>
            <?=$table_dados?>
        </tbody>
	</table>
    <div style="clear:both; height:50px;"></div>
</div>
<?php

}//fim ajax -------------------<<<<










































































//AJAX (gráfico de comparação de quantidades de usuários por perfil de acesso) ------------------------------------------------------------------>>>
if($ajax == "graficoPerfil"){
	///VERIFICA PERMISSÕES DE ACESSO
	if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"gra")){ echo "Opss... sem premissão!"; exit(0); }//loginAcesso


//pega vars de busca
	if(isset($_GET["rapida_b"])){   					 $rapida_b = getpost_sql($_GET["rapida_b"]);   						  }else{ $rapida_b = "";    	    }
	if(isset($_GET["nome_b"])){       					 $nome_b = getpost_sql($_GET["nome_b"]);       		     			  }else{ $nome_b = "";    		    }
	if(isset($_GET["datai_b"])){       					 $datai_b = getpost_sql($_GET["datai_b"]);       		   			  }else{ $datai_b = "";    		    }
	if(isset($_GET["dataf_b"])){       					 $dataf_b = getpost_sql($_GET["dataf_b"]);       		   			  }else{ $dataf_b = "";    		    }
	if(isset($_GET["perfil_b"])){      					 $perfil_b = getpost_sql($_GET["perfil_b"]);      		   			  }else{ $perfil_b = "";   		    }
	


//verifica se recebeu uma solicitação de busca por rapida_b
if($rapida_b != ""){ 
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " ( S.`session` = '$rapida_b' OR S.`usuarios_id` = '$rapida_b' OR U.`nome` LIKE '%$rapida_b%' OR U.`celular` LIKE '%$rapida_b%' OR P.`nome` LIKE '%$rapida_b%' OR P.`apelido` LIKE '%$rapida_b%' ) "; //condição 
		$AJAX_GET .= "rapida_b=$rapida_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por rapida_b



//verifica se recebeu uma solicitação de busca por data de cadastro
if(($datai_b != "") or ($dataf_b != "")){
		if($datai_b == ""){ $datai_b = $dataf_b; } if($dataf_b == ""){ $dataf_b = $datai_b; }
		$timei_a = time_data_hora("$datai_b 0:0"); //converte data/hora em time UNIX "04/03/2011 10:11"
		$timef_a = time_data_hora("$dataf_b 23:59"); //converte data/hora em time UNIX "04/03/2011 10:11"
		if($timei_a > $timef_a){ $timef_a = $timei_a; }
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " S.time_i >= '$timei_a' AND S.time_i <= '$timef_a' "; //condição
		$AJAX_GET .= "datai_b=$datai_b&dataf_b=$dataf_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por data cadastro



//verifica se recebeu uma solicitação de busca por nome
if($nome_b != ""){
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " ( U.`nome` LIKE '%$nome_b%' OR U.`cpf` LIKE '%$nome_b%' ) "; //condição 
		$AJAX_GET .= "nome_b=$nome_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por nome



//verifica se recebeu uma solicitação de busca por perfil
if($perfil_b != ""){
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= "S.perfil_id = '$perfil_b'"; //condição 
		$AJAX_GET .= "perfil_b=$perfil_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por perfil






	
//monta dados do grafico
$java = "";
$cont_reg = "0";
$cont_regT = "0";
//dados da tabela
$table_colspan = "2";//quantidade de colunas
$table_titu = '<tr><th>PERFIL</th><th>QTD USUÁRIOS</th></tr>';//título das colunas
$table_dados = '';//inicia a linha que recebe os dados

//inicia a busca dos dados
if($SQL_where != ""){ $SQL_where = " AND ".$SQL_where; }
$resu1 = fSQL::SQL_SELECT_SIMPLES("P.nome, SUM(1) AS soma", "sys_login_session S, sys_usuarios U, sys_perfil P", "S.usuarios_id = U.id AND S.perfil_id = P.id $SQL_where", "GROUP BY S.perfil_id ORDER BY U.nome ASC");
while($linha1 = fSQL::FETCH_ASSOC($resu1)){
	$nome_i = sentenca($linha1["nome"]);
	$soma = $linha1["soma"];
	$cont_regT = $cont_regT+$soma;
	if($java != ""){ 
		$java .= ", ['".$nome_i."',   ".valorGrafico($soma)."]";
	}else{
		$java .= "{ name: '".$nome_i."', y: ".valorGrafico($soma).", sliced: true, selected: true }";
	}
	 $cont_reg++;
	 //tabela
	 $table_dados .= '<tr><td>'.$nome_i.'</td><td><b>'.$soma.'</b></td></tr>';//inicia a linha que recebe os dados
}//while
if($cont_reg == "1"){ $java = "['".$nome_i."', ".valorGrafico($soma)."]"; }
		


//config controle ids html/js
$ids_hmtl = "Perfil";
$info_titu = "Quantidade de Usuários Por Perfil Online";//título de exibição
$info_titusub = "Localizados ".$cont_reg." perfils e ".$cont_regT." usuários no filtro selecionado.";//subtítulo de exibição
?>
<script type="text/javascript">
	//recarrega se mudar tamanho da pagina
	var rezi = window.onresize = grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>;
	function grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>(){				
        $('#grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>').highcharts({
			chart: {
				plotBackgroundColor: null,
				plotBorderWidth: null,
				plotShadow: false
			},
			credits: {
				enabled: false
			},
			title: {
				text: '<?=$info_titu?>'
			},
			subtitle: {
				text: '<?=$info_titusub?>'
			},
			tooltip: {
				pointFormat: '{series.name}: <b>{point.y}</b>'
			},
			plotOptions: {
				pie: {
					allowPointSelect: true,
					cursor: 'pointer',
					dataLabels: {
						enabled: true,
						format: '<b>{point.name}</b>: {point.y}',
						style: {
							color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
						},
						connectorColor: 'silver'
					}
				}
			},
			series: [{
				type: 'pie',
				name: 'Quantidade por perfil',
				data: [<?=$java?>]
			}],
			exporting: {
				sourceWidth: $("#grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>").width(),
				sourceHeight: $("#grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>").height(),
				// scale: 2 (default)
			},
			navigation: {
				buttonOptions: {
					align: 'left',
					verticalAlign: 'bottom',
					y: -20
				}
			}
		});
		$(".highcharts-button").show();//volta botao de export
	}
	$.doTimeout('vTimerOnLoadgrafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>', 0, function(){ ajustaDivWin(); grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>(); });//TIMER	
	function btlista<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>(v_exibe){
		$("#div_grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>").hide(); $("#div_lista<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>").hide();
		$("#div_"+v_exibe+"<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>").fadeIn();
	}
	function export_<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>() {
		var htmlPlanilha = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>PlanilhaTeste</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>' + document.getElementById("table_lista<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>").innerHTML + '</table></body></html>';	 
		var htmlBase64 = btoa(htmlPlanilha);
		window.location="data:application/vnd.ms-excel;base64," + htmlBase64;
	}
</script>
<div style="width:100%; overflow:auto; overflow-y:hidden;" class="windiv" id="div_grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>">
	<button class="btn btn-orange btn-large" style="position:absolute; z-index:9; right:0px; margin:10px; border-radius:20px;" onclick="btlista<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>('lista');"><i class="icon-list"></i> EXIBIR EM LISTA</button>
	<div id="grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>" style="width:100%; min-height:250px; margin: 0 auto; padding-top:20px;" class="windivIn"></div>
</div>

<div style="width:100%; height:100%; overflow:auto; overflow-x:hidden; display:none;" class="windiv" id="div_lista<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>">
	<button class="btn btn-orange btn-large" style="position:absolute; z-index:9; margin:10px 0 0 10px; border-radius:20px;" onclick="btlista<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>('grafico');"><i class="glyphicon-charts"></i> EXIBIR EM GRÁFICO</button>    
    <div style="padding:15px; text-align:right;">Exportar dados Excel <button class="btn btn-primary" onclick="export_<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>();"><i class="icon-download-alt"></i> DOWNLOAD</button></div>    
	<table class="table table-hover table-bordered table-nomargin table-striped" id="table_lista<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>">
		<thead>
			<tr>
				<th colspan="<?=$table_colspan?>" style="text-align:center; font-size:18px; text-transform:uppercase;"><?=$info_titu?></th>
			</tr>
			<tr>
				<th colspan="<?=$table_colspan?>" style="text-align:right; font-weight:normal;"><?=$info_titusub?></th>
			</tr>
            <?=$table_titu?>
		</thead>
        <tbody>
            <?=$table_dados?>
        </tbody>
	</table>
    <div style="clear:both; height:50px;"></div>
</div>
<?php

}//fim ajax -------------------<<<<


































































//AJAX (gerar arquivo exportar/donwload) ------------------------------------------------------------------>>>
if($ajax == "exportaLista"){
	///VERIFICA PERMISSÕES DE ACESSO
	if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"exp")){ echo "Opss... sem premissão!"; exit(0); }//loginAcesso
	if(isset($_GET["fileTipo"])){	$fileTipo = getpost_sql($_GET["fileTipo"]);	}else{ $fileTipo = "LISTA";	}
	if(isset($_GET["fileCont"])){	$fileCont = getpost_sql($_GET["fileCont"]);	}else{ $fileCont = "1";	}
	if($fileTipo == "LISTA_PDF"){ $reg_por_pagina = SYS_CONFIG_TOTALEXPORT_PDF; }else{ $reg_por_pagina = SYS_CONFIG_TOTALEXPORT; }
	$fileContTotal = "1";
	$nome_file_download = "lista-usuarios-online";
	$titulo_file_donwload = "Sessões de Usuários Online";
	
	//tempo de execução
	if($reg_por_pagina >= "1000"){ set_time_limit(60); }//aumenta tempo de execução PHP
	if($reg_por_pagina >= "5000"){ set_time_limit(120); }//aumenta tempo de execução PHP
	if($reg_por_pagina >= "10000"){ set_time_limit(240); }//aumenta tempo de execução PHP
	
	
	
	
	//INICIA SQL DE MONTAGEM DE DADOS

//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||--------------- SQL vars >>>
//vars para consulta no DB referente a paginação abaixo
	$SQL_campos = "S.time_i,S.time,S.ip,S.origem,S.perfil_id,S.faisher,U.nome,U.celular,P.apelido AS perfil"; //campos da tabela
	$SQL_tabela = "sys_login_session S, sys_usuarios U, sys_perfil P"; //tabela
	$SQL_where = "S.usuarios_id = U.id AND S.perfil_id = P.id"; //condição
	$SQL_varEnvio = "faisher=$faisher&"; //variaveis para a paginacao
	$ORDEM_C = "S.time";//campo de ordenar
	$ORDEM = "ASC";// ASC ou DESC
	$SQL_group = "GROUP BY S.id"; // agrupar o resultado GROUP BY

//verifica se recebeu ORDEM_C ou seta ORDER padrao ------------ VARS SQL
	if((isset($_GET["ORDEM_C"])) and ($_GET["ORDEM_C"] != "undefined") and ($_GET["ORDEM_C"] != "")){
		$ORDEM_C = getpost_sql($_GET["ORDEM_C"]);
		$ORDEM = getpost_sql($_GET["ORDEM"]);
	}//fim ORDEM_C
	$SQL_order = $SQL_group." ORDER BY $ORDEM_C $ORDEM"; // ordem do resultado
	$AJAX_GET = $SQL_varEnvio;//vars get para reenvio no paginaçao AJAX
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
		$filtro_b["rapida_b"] = "Busca rápida por <b>$rapida_b</b>";
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " ( S.`session` = '$rapida_b' OR S.`usuarios_id` = '$rapida_b' OR U.`nome` LIKE '%$rapida_b%' OR U.`celular` LIKE '%$rapida_b%' OR P.`nome` LIKE '%$rapida_b%' OR P.`apelido` LIKE '%$rapida_b%' ) "; //condição 
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
		$SQL_where .= " S.time_i >= '$timei_a' AND S.time_i <= '$timef_a' "; //condição
		$AJAX_GET .= "datai_b=$datai_b&dataf_b=$dataf_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por data cadastro



//verifica se recebeu uma solicitação de busca por nome
if($nome_b != ""){  $filtro_marca[] = $nome_b;
		$filtro_b["nome_b"] = "Busca por <b>$nome_b</b>";
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " ( U.`nome` LIKE '%$nome_b%' OR U.`cpf` LIKE '%$nome_b%' ) "; //condição 
		$AJAX_GET .= "nome_b=$nome_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por nome



//verifica se recebeu uma solicitação de busca por perfil
if($perfil_b != ""){
		$linha1 = fSQL::SQL_SELECT_ONE("nome,apelido", "sys_perfil", "id = '$perfil_b'");
		$perfil_bb = $linha1["nome"]."(".$linha1["apelido"].")";
		$filtro_b["perfil_b"] = "Busca perfil <b>$perfil_bb</b>";   $filtro_marca[] = $linha1["apelido"];
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= "S.perfil_id = '$perfil_b'"; //condição 
		$AJAX_GET .= "perfil_b=$perfil_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por perfil














//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL trata dados >>
//trata dados do sql paginação abaixo
			$max = $reg_por_pagina; //busca o padrao do sistema, registros por pagina
			$pagina = $fileCont;
			if($pagina >= "1"){}else{ $pagina = 1; }
			$fileContTotal = fSQL::SQL_CONTAGEM($SQL_tabela, $SQL_where, "", "$SQL_group");
			$paginas_total = ceil($fileContTotal / $max);
			if(($fileTipo != "LISTA_CSV") and ($fileTipo != "LISTA_PDF")){
				$comeco = ($pagina*$max) - $max;			
				$QueryListaPag 	= fSQL::SQL_SELECT_SIMPLES($SQL_campos, $SQL_tabela, $SQL_where, "$SQL_order", "$comeco,$max");
			}//if($fileTipo != "OFF"){
//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL trata dados <<<







	//download PDF ------------------------------------------------------------------------------------------ || PDF || >>>
	if($fileTipo == "PDF"){
		//css
		$html_dados = '<style> .bordasimples{border-collapse:collapse; empty-cells:show;} .bordasimples tr td { border:#CCC 1px solid; margin-top:10px; padding:5px;} </style>';
		//inicia a tabela de dados
		$html_dados .= '<table width="100%" border="0" cellspacing="0" cellpadding="1" class="bordasimples">';
  
		//titulos dos dados
		$html_dados .= '<tr> <td>Cont</td> <td>Nome Usuário</td> <td>Perfil</td> <td>Sessão/IP</td> <td>Tempo Online</td> <td>Ultima Atividade</td> <td>Atividade</td> </tr>';		
		
		//faz a contagem de registro e da continuidade
		if($fileCont >= "2"){ $soma = $fileCont-1; $cont = $soma*$reg_por_pagina; }else{ $cont = "0"; }
//vars adicionais ao SQL ----------------------------------- Vars SQL
//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL Listagem
//inicia a listagem do SQL de paginação
//se a contagem de zerado nao ativa o if que percorre as linhas
if($fileContTotal >= "1"){
while($linha1 = fSQL::FETCH_ASSOC($QueryListaPag)){
	$time_i = $linha1["time_i"];
	$time = $linha1["time"];
	$ip = $linha1["ip"];
	$origem = $linha1["origem"];
	$faisher = $linha1["faisher"];
	$nome = $linha1["nome"];
	$celular = $linha1["celular"];
	$perfil_id = $linha1["perfil_id"];
	$perfil = $linha1["perfil"];
  	$cont++;
		//tabela de dados
		$html_dados .= '<tr> <td><b>'.$cont.'</td> <td><b>'.sentenca(primeiro_nome($nome,2)).'</b><BR><i>('.$celular.')</i></td> <td>'.$perfil.'</td> <td>'.$origem.'<br>'.$ip.'</td> <td>'.difHoraTime($time_i).'</td> <td>'.difHoraTime($time).'</td> <td>'.legFaisher($faisher).'</td> </tr>';	

}//fim do while de padinação SQL
}//fim do if($fileContTotal >= "1"){ de paginacao SQL
		
		

		//finaliza tabela de dados
		$html_dados .= '</table>';	
    	$html_load = stripslashes($html_dados);
		//CLASSES GERAR PDF ---> > >
		$classe_pdf = new fPDF("../");//inicia a classe informando o caminho da pasta: sys
		$classe_pdf->nomeFile($nome_file_download."_CONT-".$fileCont."-".$paginas_total);
		$classe_pdf->mostraData($cVLogin->perfil()." - ".date('d/m/Y H:i')."h");//mostra data no título
		$classe_pdf->orientacao("paisagem");//mudar papel para paisagem
		$classe_pdf->cabecalho('<img src="'.VAR_DIR_FILES.'files/logos/logo_impressao.png">',$titulo_file_donwload." ".$fileCont." de ".$paginas_total);//colunas de exibição de cabeçalho
		$classe_pdf->cabecalhoW("1","1%"); $classe_pdf->cabecalhoW("2","99%");//largura de coluna 1 e 2 do cabeçalho
		$classe_pdf->nPagina();//ativa exeibição número de páginas
		$classe_pdf->conteudo($html_load);
		//gera o pdf - COM DOWNLOAD
		$classe_pdf->gerarPDF("down");	

	}//if($fileTipo == "PDF"){ ------------------------------------------------------------------------------------------ || PDF || <<<
	
	
	
	
	
	
	
	







	//download CSV ------------------------------------------------------------------------------------------ || CSV || >>>
	if($fileTipo == "CSV"){
		
		//CLASSES GERAR CSV ---> > >
		$classe_csv = new fCSV();//inicia a classe
		$classe_csv->nomeFile($nome_file_download."_CONT-".$fileCont."-".$paginas_total);
		$classe_csv->titulo($titulo_file_donwload." ".$fileCont." de ".$paginas_total);
		$classe_csv->mostraData($cVLogin->perfil()." - ".date('d/m/Y H:i')."h");//mostra data no título
  
		//titulos das colunas
		$classe_csv->addCampo("Cont");//cria campo da linha - adicionar varios desse pra formar a linha
		$classe_csv->addCampo("Nome Usuário");//cria campo da linha - adicionar varios desse pra formar a linha
		$classe_csv->addCampo("Celular");//cria campo da linha - adicionar varios desse pra formar a linha
		$classe_csv->addCampo("Perfil");//cria campo da linha - adicionar varios desse pra formar a linha
		$classe_csv->addCampo("Sessão");//cria campo da linha - adicionar varios desse pra formar a linha
		$classe_csv->addCampo("IP");//cria campo da linha - adicionar varios desse pra formar a linha
		$classe_csv->addCampo("Tempo Online");//cria campo da linha - adicionar varios desse pra formar a linha
		$classe_csv->addCampo("Ultima Atividade");//cria campo da linha - adicionar varios desse pra formar a linha
		$classe_csv->addCampo("Atividade");//cria campo da linha - adicionar varios desse pra formar a linha
		$classe_csv->addLinha();//cria/quebra uma linha

		
		//faz a contagem de registro e da continuidade
		if($fileCont >= "2"){ $soma = $fileCont-1; $cont = $soma*$reg_por_pagina; }else{ $cont = "0"; }
//vars adicionais ao SQL ----------------------------------- Vars SQL
//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL Listagem
//inicia a listagem do SQL de paginação
//se a contagem de zerado nao ativa o if que percorre as linhas
if($fileContTotal >= "1"){
while($linha1 = fSQL::FETCH_ASSOC($QueryListaPag)){
	$time_i = $linha1["time_i"];
	$time = $linha1["time"];
	$ip = $linha1["ip"];
	$origem = $linha1["origem"];
	$faisher = $linha1["faisher"];
	$nome = $linha1["nome"];
	$celular = $linha1["celular"];
	$perfil_id = $linha1["perfil_id"];
	$perfil = $linha1["perfil"];
  	$cont++;
		//tabela de dados
		$classe_csv->addCampo($cont);//cria campo da linha - adicionar varios desse pra formar a linha
		$classe_csv->addCampo(sentenca($nome));//cria campo da linha - adicionar varios desse pra formar a linha
		$classe_csv->addCampo($celular);//cria campo da linha - adicionar varios desse pra formar a linha
		$classe_csv->addCampo($perfil);//cria campo da linha - adicionar varios desse pra formar a linha
		$classe_csv->addCampo($origem);//cria campo da linha - adicionar varios desse pra formar a linha
		$classe_csv->addCampo($ip);//cria campo da linha - adicionar varios desse pra formar a linha
		$classe_csv->addCampo(difHoraTime($time_i));//cria campo da linha - adicionar varios desse pra formar a linha
		$classe_csv->addCampo(difHoraTime($time));//cria campo da linha - adicionar varios desse pra formar a linha
		$classe_csv->addCampo(legFaisher($faisher));//cria campo da linha - adicionar varios desse pra formar a linha
		$classe_csv->addLinha();//cria/quebra uma linha	

}//fim do while de padinação SQL
}//fim do if($fileContTotal >= "1"){ de paginacao SQL
		
		

		//CLASSES GERAR CSV ---> > >
		$classe_csv->gerarCSV();	

	}//if($fileTipo == "CSV"){ ------------------------------------------------------------------------------------------ || CSV || <<<
	
	
	
	
	
	
	
	
	
	
	
	
	
	
// ### LISTA DE BOTOES  ------------------------------------------------------------------------------------------ || >>>
if(($fileTipo == "LISTA_PDF") or ($fileTipo == "LISTA_CSV")){
?>
<?php if($filtro_b != ""){ ?><div style="padding:0 5px 0 10px;">FILTROS: <b><?=$filtro_b?></b></div><?php }?>
<div style="padding:5px 5px 5px 10px;">Clique no arquivo para download: <?php if($paginas_total >= "2"){?><b>*Muitos registros, dividimos em partes... :)</b><?php if($fileTipo == "LISTA_PDF"){?><br>**O PDF NÃO CONSEGUE AGRUPAR MUITOS REGISTROS COMO NO CSV CONSEGUE ;)<?php }}?></div>
	<table class="table table-hover table-bordered table-nomargin table-striped" id="tableExport<?=$INC_FAISHER["div"]?>">
		<thead>
			<tr>
				<th>Parte(s)</th>
				<?php if($fileTipo == "LISTA_PDF"){?><th>Baixar em PDF (documento) &nbsp;&nbsp;&nbsp;</th><?php }?>
				<?php if($fileTipo == "LISTA_CSV"){?><th>Baixar em CSV (excel) &nbsp;&nbsp;&nbsp;</th><?php }?>
			</tr>
		</thead>
        <tbody>
<?php

//parte única
if($paginas_total == "1"){
?>
            <tr>
                <td>Parte única</td>
                <?php if($fileTipo == "LISTA_PDF"){?><td><button type="button" onclick="enviaExportIframe<?=$INC_FAISHER["div"]?>('PDF','1');" style="margin:5px;" class="btn btn-primary" rel="tooltip" data-original-title="Clique para download"><i class=" icon-cloud-download"></i> PDF com <?=$fileContTotal?> registro(s) </button></td><?php }?>
                <?php if($fileTipo == "LISTA_CSV"){?><td><button type="button" onclick="enviaExportIframe<?=$INC_FAISHER["div"]?>('CSV','1');" style="margin:5px;" class="btn btn-primary" rel="tooltip" data-original-title="Clique para download"><i class=" icon-cloud-download"></i> CSV com <?=$fileContTotal?> registro(s) </button></td><?php }?>
            </tr>
<?php
}//if($paginas_total == "1"){
//parte única



			
//partes do arquivo
if($paginas_total >= "2"){
	$cont = "0"; $total = $fileContTotal;
	while($paginas_total > $cont){
		$cont++;
		if($total >= $reg_por_pagina){ $reg = $reg_por_pagina; }else{ $reg = $total; }
		$total = $total-$reg_por_pagina;
?>
            <tr>
                <td><?=$cont?>ª parte</td>
                <?php if($fileTipo == "LISTA_PDF"){?><td><button type="button" onclick="enviaExportIframe<?=$INC_FAISHER["div"]?>('PDF','<?=$cont?>');" style="margin:5px;" class="btn btn-primary" rel="tooltip" data-original-title="Clique para download"><i class=" icon-cloud-download"></i> PDF com <?=$reg?> registro(s) </button></td><?php }?>
                <?php if($fileTipo == "LISTA_CSV"){?><td><button type="button" onclick="enviaExportIframe<?=$INC_FAISHER["div"]?>('CSV','<?=$cont?>');" style="margin:5px;" class="btn btn-primary" rel="tooltip" data-original-title="Clique para download"><i class=" icon-cloud-download"></i> CSV com <?=$reg?> registro(s) </button></td><?php }?>
            </tr>
<?php
	}//fim while
}//if($paginas_total >= "2"){
//partes do arquivo



//sem resultados
if($paginas_total == "0"){
?>
            <tr>
                <td>Vazio</td>
                <td>Sem resultados</td>
            </tr>
<?php
}//if($paginas_total == "0"){
//sem resultados


?>
        </tbody>
	</table>
<?php if($paginas_total >= "2"){ ?><span class="help-block"><i class="icon-info-sign"></i> Devido a grande quantidade de dados, o sistema separou em partes o resultado.</span><?php }?>
<iframe src="" style="width:0px; height:0px; overflow:hidden; border:0; display:none;" name="export<?=$INC_FAISHER["div"]?>" id="export<?=$INC_FAISHER["div"]?>"></iframe>
<script type="text/javascript">
function enviaExportIframe<?=$INC_FAISHER["div"]?>(v_tipo,v_file){
	loaderFoco('tableExport<?=$INC_FAISHER["div"]?>','exportload<?=$INC_FAISHER["div"]?>','Montado '+v_tipo+' pode demorar um pouco :) Aguarde...');//cria um loader dinamico
	$('#exportload<?=$INC_FAISHER["div"]?>').show();
	//create form to send request 
	$('<form action="<?=$AJAX_PAG?>?scriptoff&<?=$AJAX_GET?>&ajax=<?=$ajax?>&fileTipo='+v_tipo+'&fileCont='+v_file+'" method="post" target="export<?=$INC_FAISHER["div"]?>"></form>').appendTo('#export<?=$INC_FAISHER["div"]?>').submit().remove();
	//detecnta evento de retorno e desliga evento
	$(window).bind("focus",function(event){ $('#exportload<?=$INC_FAISHER["div"]?>').fadeOut(); $(this).unbind("focus"); });
}//enviaExportIframe
</script>
<?php
}//if(($fileTipo == "LISTA_PDF") or ($fileTipo == "LISTA_CSV")){
// ### LISTA DE BOTOES  ------------------------------------------------------------------------------------------ || <<<


}//fim ajax -------------------<<<<




























































//* ------------------------------------- ##### DADOS DO REGISTRO PADRAO #### --------------------------------------------*//




?>
<?php





























//AJAX QUE EXIBE LISTA DE ITENS ------------------------------------------------------------------>>>
if($ajax == "lista"){






























//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||--------------- SQL vars >>>
//vars para consulta no DB referente a paginação abaixo
	$SQL_campos = "S.time_i,S.time,S.ip,S.geo,S.origem,S.perfil_id,S.faisher,U.nome,U.celular,P.apelido AS perfil"; //campos da tabela
	$SQL_tabela = "sys_login_session S, sys_usuarios U, sys_perfil P"; //tabela
	$SQL_where = "S.usuarios_id = U.id AND S.perfil_id = P.id"; //condição
	$SQL_varEnvio = "ajax=lista&faisher=$faisher&"; //variaveis para a paginacao
	$ORDEM_C = "S.time";//campo de ordenar
	$ORDEM = "ASC";// ASC ou DESC
	$SQL_group = "GROUP BY S.id"; // agrupar o resultado GROUP BY

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
		$filtro_b["rapida_b"] = "Busca rápida por <b>$rapida_b</b>";
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " ( S.`session` = '$rapida_b' OR S.`usuarios_id` = '$rapida_b' OR U.`nome` LIKE '%$rapida_b%' OR U.`celular` LIKE '%$rapida_b%' OR P.`nome` LIKE '%$rapida_b%' OR P.`apelido` LIKE '%$rapida_b%' ) "; //condição 
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
		$SQL_where .= " S.time_i >= '$timei_a' AND S.time_i <= '$timef_a' "; //condição
		$AJAX_GET .= "datai_b=$datai_b&dataf_b=$dataf_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por data cadastro



//verifica se recebeu uma solicitação de busca por nome
if($nome_b != ""){  $filtro_marca[] = $nome_b;
		$filtro_b["nome_b"] = "Busca por <b>$nome_b</b>";
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " ( U.`nome` LIKE '%$nome_b%' OR U.`cpf` LIKE '%$nome_b%' ) "; //condição 
		$AJAX_GET .= "nome_b=$nome_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por nome



//verifica se recebeu uma solicitação de busca por perfil
if($perfil_b != ""){
		$linha1 = fSQL::SQL_SELECT_ONE("nome,apelido", "sys_perfil", "id = '$perfil_b'");
		$perfil_bb = $linha1["nome"]."(".$linha1["apelido"].")";
		$filtro_b["perfil_b"] = "Busca perfil <b>$perfil_bb</b>";   $filtro_marca[] = $linha1["apelido"];
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= "S.perfil_id = '$perfil_b'"; //condição 
		$AJAX_GET .= "perfil_b=$perfil_b&"; //incrementa variaveis para a paginacao AJAX
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
  
  
  
<form action="relatorio.php" target="tar<?=$INC_FAISHER["div"]?>" id="relatorio<?=$INC_FAISHER["div"]?>" name="relatorio<?=$INC_FAISHER["div"]?>" method="POST" onsubmit="openWindow('relatorio.php', 'tar<?=$INC_FAISHER["div"]?>', '980', '800', 'yes', 'yes');">
<input type='hidden' value="<?=str_replace('ajax=lista&', '', $AJAX_GET)?>" name='vars' id='vars<?=$INC_FAISHER["div"]?>' />
<input type='hidden' value="" name='ajax' id='ajax<?=$INC_FAISHER["div"]?>' />
</form>
<script type="text/javascript">
function enviaRelatorio<?=$INC_FAISHER["div"]?>(v_ajax){
	$('#ajax<?=$INC_FAISHER["div"]?>').val(v_ajax);
	$('#relatorio<?=$INC_FAISHER["div"]?>').submit();
}//enviaRelatorio

function enviaExporta<?=$INC_FAISHER["div"]?>(v_tipo){
	pmodalHtml(v_tipo+' - ARQUIVO(S) GERADO(S)','<?=$AJAX_PAG?>','get','scriptoff&faisher=<?=$faisher?>&ajax=exportaLista&fileTipo=LISTA_'+v_tipo+'&'+$('#vars<?=$INC_FAISHER["div"]?>').val());
}//enviaExporta
</script>
<?php


	///VERIFICA PERMISSÕES DE ACESSO
	if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"gra")){
?>
<div <?php if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"exp")){ echo 'class="span6"'; }?> style="margin-left:0;">
	<ul class="messages" style="margin-top:0; margin-right:0;">
		<li class="left">
			<div class="image"><img src="img/extras/icoGrafico.png" alt=""></div>
			<div class="message"><span class="caret"></span><span class="name">RELATÓRIOS GRÁFICOS/LISTA DISPONÍVEIS NO FILTRO</span>
				<p style="padding:10px 10px 0 0;"><?php $cont_bt = "0";?>
				<button type="button" onclick="enviaRelatorio<?=$INC_FAISHER["div"]?>('graficoTempo');" style="margin:5px; text-align:left;" class="btn btn-primary btn-block" rel="tooltip" data-original-title="Compara sessões de usuários online"><?php $cont_bt++; echo $cont_bt;?>. <i class="glyphicon-charts"></i> Comparativo de Tempo Online</button>
				<button type="button" onclick="enviaRelatorio<?=$INC_FAISHER["div"]?>('graficoPerfil');" style="margin:5px; text-align:left;" class="btn btn-primary btn-block" rel="tooltip" data-original-title="Compara sessões online por perfil"><?php $cont_bt++; echo $cont_bt;?>. <i class="glyphicon-pie_chart"></i> Comparativo de Perfil</button>
				</p>
			</div>
		</li>
	</ul>
</div>
<?php
	}//loginAcesso

	///VERIFICA PERMISSÕES DE ACESSO
	if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"exp")){
?>
<div <?php if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"gra")){ echo 'class="span6"'; }else{ echo 'style="margin-left:0;"';}?>>
	<ul class="messages" style="margin-top:0; margin-right:0;">
		<li class="left">
			<div class="image"><img src="img/extras/icoExporta.png" alt=""></div>
			<div class="message"><span class="caret"></span><span class="name">EXPORTAR/DOWNLOAD <?=$n_paginas?> RESULTADOS</span>
				<p style="padding:10px 10px 0 0;"><?php $cont_bt = "0";?>
				<button type="button" onclick="enviaExporta<?=$INC_FAISHER["div"]?>('CSV');" style="margin:5px; text-align:left;" class="btn btn-primary btn-block" rel="tooltip" data-original-title="Gerar lista em CSV/Planilha"><?php $cont_bt++; echo $cont_bt;?>. <i class="icon-magic"></i> Gerar Lista de Arquivos CSV</button>
				<button type="button" onclick="enviaExporta<?=$INC_FAISHER["div"]?>('PDF');" style="margin:5px; text-align:left;" class="btn btn-primary btn-block" rel="tooltip" data-original-title="Gerar lista em PDF"><?php $cont_bt++; echo $cont_bt;?>. <i class="icon-magic"></i> Gerar Lista de Arquivos PDF</button>
				</p>
			</div>
		</li>
	</ul>
</div>
<?php
	}//loginAcesso


?>
<div style="clear:both;"></div>
  
  
  
  
  
  
  
    
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
$id_Rolagem = "RelaUserOnli".$INC_FAISHER["div"];
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
				<?php $c_or = "U.nome"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>">Nome Usuário</th>
				<?php $c_or = "P.nome"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>">Perfil</th>
				<?php $c_or = "S.ip"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>">Sessão/IP</th>
				<?php $c_or = "S.time_i"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>">Tempo Online</th>
				<?php $c_or = "S.time"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>">Ultima Atividade</th>
				<?php $c_or = "S.faisher"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>">Atividade</th>
				<th>GEO</th>
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
	$time_i = $linha1["time_i"];
	$time = $linha1["time"];
	$ip = $linha1["ip"];
	$geo = $linha1["geo"];
	$origem = $linha1["origem"];
	$faisher = $linha1["faisher"];
	$nome = $linha1["nome"];
	$celular = $linha1["celular"];
	$perfil_id = $linha1["perfil_id"];
	$perfil = $linha1["perfil"];

	if($geo != ""){
		$arrGeo = explode(",",$geo);
	}//if($geo != ""){
	
?>
	<tr>
		<td class="sVisu"><b><?=sentenca(primeiro_nome($nome,2))?></b><BR><i>(<?=$celular?>)</i></td>
		<td class="sVisu"><i class="<?=fGERAL::icoPerfil($perfil_id)?>"></i> <?=$perfil?></td>
		<td class='sVisu'><?=$origem?><BR><?=$ip?></td>
		<td class='sVisu'><?=difHoraTime($time_i)?></td>
		<td class='sVisu'><?=difHoraTime($time)?></td>
		<td class='sVisu'><?=legFaisher($faisher)?></td>
		<td class='sVisu'><?php if($geo != ""){?><a href="#" onclick="verGeoMapaPopup('<?=$arrGeo["0"]?>','<?=$arrGeo["1"]?>');return false;" class="btn" rel="tooltip" title="Ver mapa do local"><i class="icon-map-marker"></i> Ver</a><?php }else{ echo "&nbsp;"; }?></td>
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
	
	
	///DESATIVA O BOTÃO NOVO
	$pCadastro = "OFF";
	
	//include de padrao
	$INC_VAR["buscaAvancada"] = "ON";//ON - OFF > Busca avançãda, retorno ajax [buscaAvancada]
	//$INC_VAR["varget"] = ""; //vars GET para adicionar no start
	include "inc/inc_lista-padrao.php";
	
	

}//fim ajax  -------------------------------------------- <<<














?>