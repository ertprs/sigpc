<?php //Breno Cruvinel - breno.cruvinel09@gmail.com
//discrimina a paginacao

//INICIAR ARQUIVO DE LINGUAGEM --->>>
$class_fLNG->loadFile(__FILE__);//incluir o arquivo de linguagem
//INICIAR ARQUIVO DE LINGUAGEM ---<<<

//busca o numero de registros por pagina
if(sessoes_v("REG_PAG") == "1"){ $reg_por_pagina = sessoes_p("REG_PAG"); }else{ $reg_por_pagina = "10"; }





//vars padrao ..>
if(!isset($ID_INC)){ $ID_INC = "pg".rand(9,99999999); }//tipo de exibicao
if(!isset($TIPO_INC)){ $TIPO_INC = "padraoajax"; }//tipo de exibicao
if(!isset($GET_INC)){ $GET_INC = ""; }//vars get
if(!isset($SELECTREG_OFF_INC)){ $SELECTREG_OFF_INC = "0"; }//select
if(!isset($SELECT_OFF_INC)){ $SELECT_OFF_INC = "0"; }//select
if(!isset($PAG_INC)){ $PAG_INC = ""; }//arquivo/pagina do link 
if(!isset($AJAX_PAG_DIV_INC)){ $AJAX_PAG_DIV_INC = ""; }//div de conteudo ajax
if(!isset($AJAX_CARREGANDO_INC)){ $AJAX_CARREGANDO_INC = ""; }//div loader ajax 
if(!isset($AJAX_APPEND_INC)){ $AJAX_APPEND_INC = "off"; }//funcao ADD ajax faisher
if(!isset($AJAX_HIDE_INC)){ $AJAX_HIDE_INC = "off"; }//esconde se não tiver - ON


//desliga se o esconde estivar ativo
if(($paginas_total <= "1") and ($AJAX_HIDE_INC == "ON")){ $TIPO_INC = "off"; unset($REG_TOTAL_INC); }




	
	
	
	











//tipo de exibicao
if($TIPO_INC == "padraoajax"){
?>
<script>
$("#pgRR<?=$ID_INC?>, #pgS<?=$ID_INC?>").select2();
$(document).ready(function(){
	$("#pgRR<?=$ID_INC?>").on("change", function(e){
		faisher_ajax('<?=$AJAX_PAG_DIV_INC?>', '<?=$AJAX_CARREGANDO_INC?>', '<?=$PAG_INC?>', '<?=$GET_INC?>&pagina=1&R_PAGINA='+e.val, 'get', '<?=$AJAX_APPEND_INC?>');
	});
	$("#pgS<?=$ID_INC?>").on("change", function(e){
		faisher_ajax('<?=$AJAX_PAG_DIV_INC?>', '<?=$AJAX_CARREGANDO_INC?>', '<?=$PAG_INC?>', '<?=$GET_INC?>&pagina='+e.val, 'get', '<?=$AJAX_APPEND_INC?>');
	});
	largPag<?=$ID_INC?>();
	$(window).resize(function() { largPag<?=$ID_INC?>(); });
});
function largPag<?=$ID_INC?>(){
	v_wDIV = $("#pgL<?=$ID_INC?>").width();	
	if(v_wDIV >= "850"){ $('#pgCP<?=$ID_INC?>').show(); }else{ $('#pgCP<?=$ID_INC?>').hide(); }
}
</script>
<div class="row-fluid" id="pgL<?=$ID_INC?>">
    <div class="hidden-768 span4">
<?php if(($SELECTREG_OFF_INC == "0") and ($n_paginas > "1")){ ?>
      <div class="pull-left" style="padding:5px 5px 0;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Exibindo')?></div>
      <div class="controls inline input-large pull-left " style="width:70px;"> 
        <select data-placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Selecione')?> " class="select-padrao" style="width:65px;" id="pgRR<?=$ID_INC?>">
<?php if($n_reg_pagina < "5"){?><option value="5" selected><?=$n_reg_pagina?></option><?php } ?>
<?php if($n_paginas >= "5"){?><option value="5" <?php if($reg_por_pagina == "5"){ echo "selected"; } ?>>05</option><?php } ?>
<?php if(($n_paginas > "5") or ($n_paginas >= "10")){ ?>
<option value="10" <?php if($reg_por_pagina == "10"){ echo "selected"; } ?>>10</option><?php } ?>

<?php if(($n_paginas > "10") or ($n_paginas >= "20")){ ?>
<option value="20" <?php if($reg_por_pagina == "20"){ echo "selected"; } ?>>20</option><?php } ?>

<?php if(($n_paginas > "20") or ($n_paginas >= "50")){ ?>
<option value="50" <?php if($reg_por_pagina == "50"){ echo "selected"; } ?>>50</option><?php } ?>

<?php if(($n_paginas > "50") or ($n_paginas >= "100")){ ?>
<option value="100" <?php if($reg_por_pagina == "100"){ echo "selected"; } ?>>100</option><?php } ?>
        </select>
      </div>
      <div class="pull-left" style="padding:5px 0 0 0;"> <?=$class_fLNG->txt(__FILE__,__LINE__,'por página')?></div>
<?php }//if($SELECTREG_OFF_INC == "1"){ ?>
    </div>

    <div class="span8">
    
  <div class="hidden-480" style="padding:5px 0 5px 0; float:right;">
<?php if($SELECT_OFF_INC == "0"){ ?>
      <div class="controls inline input-large pull-left " id="pgCP<?=$ID_INC?>">
        <select data-placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Selecione')?> " class="select-padrao input-large" id="pgS<?=$ID_INC?>">
<?php
$cont_p = "0";
while ($cont_p < $paginas_total){
$cont_p++;
		if($cont_p == $pagina){
		  echo ("<option value=\"$cont_p\" selected>".$class_fLNG->txt(__FILE__,__LINE__,'página')." $cont_p/$paginas_total</option>");
		  }else{
		  echo ("<option value=\"$cont_p\">".$class_fLNG->txt(__FILE__,__LINE__,'página')." $cont_p/$paginas_total</option>");
		  }
}
?>
        </select>
      </div>
<?php }//if($SELECT_OFF_INC == "1"){ ?>
  </div>
    

      <div class="table-pagination" style="float:right;" id="pgN<?=$ID_INC?>">
<?php
$maximo_paginas = 2;
if($pagina < $maximo_paginas) {
	$pagina_min = $pagina;
}else{
	if($pagina == $maximo_paginas) {
		$pagina_min = $pagina - 1;
	}else{
		$pagina_min = $pagina - $maximo_paginas;
	}
}						
//primeira pagina	
		if($pagina > 1){
				$ante_pagina = $pagina - 1;
?>
        <a href="#" onclick="faisher_ajax('<?=$AJAX_PAG_DIV_INC?>', '<?=$AJAX_CARREGANDO_INC?>', '<?=$PAG_INC?>', '<?=$GET_INC?>&pagina=1', 'get', '<?=$AJAX_APPEND_INC?>');return false;" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Primeira')?>"><i class="icon-backward"></i></a>
<?php
				}else{
?>
		<a href="#" onclick="return false;" class='disabled' rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Primeira')?>"><i class="icon-backward"></i></a>
<?php
		}
		
?>
<span>
<?php
		

//Paginas.
		if($paginas_total <= $maximo_paginas) {
//			echo("<font color=\"#999999\">P&aacute;ginas:</font>&nbsp;&nbsp;");
			for($j = 1; $j <= $paginas_total; $j++) {
				if($j == $pagina){
?>
        <a href="#" onclick="return false;" class='active' rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Página')?> <?=$j?>"><?=$j?></a>
<?php
				}else{
?>
        <a href="#" onclick="faisher_ajax('<?=$AJAX_PAG_DIV_INC?>', '<?=$AJAX_CARREGANDO_INC?>', '<?=$PAG_INC?>', '<?=$GET_INC?>&pagina=<?=$j?>', 'get', '<?=$AJAX_APPEND_INC?>');return false;" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Página')?> <?=$j?>"><?=$j?></a>
<?php

				}
			}//for
		}else{
//			echo("<font color=\"#999999\">P&aacute;ginas:</font>&nbsp;&nbsp;");
			if($paginas_total > $pagina) {
				$pagina_prox = $pagina + 1;
				if($pagina == $pagina_min) {
/*?>
        <li class="active"><a href="#" onclick="return false;">Ant</a></li>
<?php //*/
				}else{
?>
        <a href="#" onclick="faisher_ajax('<?=$AJAX_PAG_DIV_INC?>', '<?=$AJAX_CARREGANDO_INC?>', '<?=$PAG_INC?>', '<?=$GET_INC?>&pagina=<?=$ante_pagina?>', 'get', '<?=$AJAX_APPEND_INC?>');return false;" class='disabled' rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Anterior')?>"><i class="icon-caret-left"></i></a>
<?php
				}
				for($pagina_min; $pagina_min <= $pagina_prox; $pagina_min++) {
					if($pagina_min == $pagina) {
?>
        <a href="#" onclick="return false;" class='active' rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Página')?> <?=$pagina_min?>"><?=$pagina_min?></a>
<?php
					}else{
?>
        <a href="#" onclick="faisher_ajax('<?=$AJAX_PAG_DIV_INC?>', '<?=$AJAX_CARREGANDO_INC?>', '<?=$PAG_INC?>', '<?=$GET_INC?>&pagina=<?=$pagina_min?>', 'get', '<?=$AJAX_APPEND_INC?>');return false;" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Página')?> <?=$pagina_min?>"><?=$pagina_min?></a>
<?php

					}
				}//for
				
				
		$_inc_span = "1";//informa impressao de span abaixo
?>
		</span>
        <a href="#" onclick="faisher_ajax('<?=$AJAX_PAG_DIV_INC?>', '<?=$AJAX_CARREGANDO_INC?>', '<?=$PAG_INC?>', '<?=$GET_INC?>&pagina=<?=$pagina_prox?>', 'get', '<?=$AJAX_APPEND_INC?>');return false;" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Próxima')?>"><i class="icon-caret-right"></i></a>
<?php
			}else{
?>
        <a href="#" onclick="faisher_ajax('<?=$AJAX_PAG_DIV_INC?>', '<?=$AJAX_CARREGANDO_INC?>', '<?=$PAG_INC?>', '<?=$GET_INC?>&pagina=<?=$ante_pagina?>', 'get', '<?=$AJAX_APPEND_INC?>');return false;" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Anterior')?>"><i class="icon-caret-left"></i></a>
<?php
				for($pagina_min; $pagina_min <= $pagina; $pagina_min++) {
					if($pagina_min == $pagina) {
?>
        <a href="#" onclick="return false;" class='active' rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Página')?> <?=$pagina_min?>"><?=$pagina_min?></a>
<?php

					}else{
?>
        <a href="#" onclick="faisher_ajax('<?=$AJAX_PAG_DIV_INC?>', '<?=$AJAX_CARREGANDO_INC?>', '<?=$PAG_INC?>', '<?=$GET_INC?>&pagina=<?=$pagina_min?>', 'get', '<?=$AJAX_APPEND_INC?>');return false;" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Página')?> <?=$pagina_min?>"><?=$pagina_min?></a>
<?php
					}
				}//for
/*?>
        <li class="active"><a href="#" onclick="return false;" rel="tooltip" data-placement="top" data-original-title="Próxima página">Próx</a></li>
<?php //*/
			}
		}

//inprime span de layout caso nao tenha
if(!isset($_inc_span)){ echo "</span>"; }
unset($_inc_span);

		if($pagina < ($paginas_total)) {
				$prox_pagina = $pagina + 1;
?>
        <a href="#" onclick="faisher_ajax('<?=$AJAX_PAG_DIV_INC?>', '<?=$AJAX_CARREGANDO_INC?>', '<?=$PAG_INC?>', '<?=$GET_INC?>&pagina=<?=$paginas_total?>', 'get', '<?=$AJAX_APPEND_INC?>');return false;" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Última')?>"><i class="icon-forward"></i>&nbsp;</a>
<?php
		} else {
?>
        <a href="#" onclick="return false;" class='disabled' rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Última')?>"><i class="icon-forward"></i>&nbsp;</a>
<?php
		}
?>
      </div>

 
    </div>
  
</div>
<!-- End row-fluid --> 


<?php		



}//if($TIPO_INC == "padraoajax"){





	
	



?>
<?php




//exibir dados de totais encontrados
if(isset($REG_TOTAL_INC)){
?>
    <div class="row-fluid" style="font-size:12px; background:#EFEFEF; color:#999; text-align:right; clear:both;">
    <?=$class_fLNG->txt(__FILE__,__LINE__,'!!cont!! registros na página selecionada, em um total de !!total!! registros encontrados',array("cont"=>"<b>".$n_reg_pagina."</b>","total"=>"<b>".$n_paginas."</b>"))?> &nbsp;&nbsp;</div>
<?php



}//fim if(isset($REG_TOTAL_INC)){
	
	
	
	
	
	
?>
<?php







//destroe vars
unset($ID_INC,$GET_INC,$REG_TOTAL_INC,$AJAX_APPEND_INC);
?>