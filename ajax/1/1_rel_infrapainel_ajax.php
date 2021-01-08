<?php //Breno Cruvinel - breno.cruvinel09@gmail.com
//valida pagina se aberto separadamente
include "valida_pagina_sem_quadro.php";



//INICIAR ARQUIVO DE LINGUAGEM --->>>
$class_fLNG->loadFile(__FILE__);//incluir o arquivo de linguagem
//INICIAR ARQUIVO DE LINGUAGEM ---<<<
































//carrega mostrar padrão 
if($ajax == "carregaMostrador"){
	$tipo = $_GET["tipo"];
	
	$arrServer = fServidor::statsFull(VAR_DIR_FILES);	
	


	//RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - 
	if($tipo == "ram"){
            $bg_cor = "26C281";//lightred orange green
            $titu = '<span style="cursor:pointer;">'.$class_fLNG->txt(__FILE__,__LINE__,'Uso<br>Mem. RAM').'</span><br><span style="font-size:10px; cursor:pointer;">'.$class_fLNG->txt(__FILE__,__LINE__,'+ detalhes').'</span>';
			$titu2 = $class_fLNG->txt(__FILE__,__LINE__,'Memória RAM');		
            $percent = str_replace("%", "", $arrServer["mem_uso_porcentagem"]);
            if($percent >= "40"){ $bg_cor = "E87E04"; } if($percent >= "70"){ $bg_cor = "E35B5A"; }
			$percent_resto = 100-$percent;
        ?>   
        	<div class="span4" style="padding:0px !important; margin:0px !important; text-align:center;">
        		<div id="div_<?=$tipo?><?=$INC_FAISHER["div"]?>" style="width: 100%; margin: 0 !important; height:300px; padding:0 !important;"></div>         
            </div>
<script type="text/javascript">
Highcharts.chart('div_<?=$tipo?><?=$INC_FAISHER["div"]?>', {
    chart: { plotBackgroundColor: null, plotBorderWidth: 0, plotShadow: false,
      events: { click: function() { detalharInfo<?=$INC_FAISHER["div"]?>('<?=$tipo?>'); } }
	},
    title: { text: '<?=$titu?>', align: 'center', verticalAlign: 'middle', y: 40 },
    tooltip: { pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>' },
    plotOptions: { pie: { dataLabels: { enabled: true, distance: -50, style: { fontWeight: 'bold', color: 'white' } }, startAngle: -90, endAngle: 90, center: ['50%', '75%'], size: '110%' } },
	credits: { enabled: false },
	exporting: { buttons: { contextButton: { enabled: false } } },
    series: [{ type: 'pie', name: '<?=$titu2?>', innerSize: '50%', data: [{ name: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Em uso')?>', y: <?=$percent?>, color: '#<?=$bg_cor?>' },{ name: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Restante')?>', y: <?=$percent_resto?>, color: '#EEEEEE', dataLabels: { enabled: false } } ] }]
});
</script> 		

<?php }//if($tipo == "ram"){             


	//FILES - FILES - FILES - FILES - FILES - FILES - FILES - FILES - FILES - FILES - FILES - FILES - FILES - FILES - FILES - FILES - FILES - FILES - FILES - FILES - FILES - 
	if($tipo == "files"){
		$bg_cor = "26C281";//lightred orange green
		$titu = '<span style="cursor:pointer;">'.$class_fLNG->txt(__FILE__,__LINE__,'Uso do Files').'</span><br><span style="font-size:10px; cursor:pointer;">'.$class_fLNG->txt(__FILE__,__LINE__,'+ detalhes').'</span>';
		$titu2 = $class_fLNG->txt(__FILE__,__LINE__,'Files');		
		$percent = str_replace("%", "", $arrServer["files_uso_porcentagem"]);
		if($percent >= "40"){ $bg_cor = "E87E04"; } if($percent >= "70"){ $bg_cor = "E35B5A"; }
		$percent_resto = 100-$percent;
?>       
        	<div class="span4" style="padding:0px !important; margin:0px !important; text-align:center;">
        		<div id="div_<?=$tipo?><?=$INC_FAISHER["div"]?>" style="width: 100%; margin: 0 !important; height:300px; padding:0 !important;"></div>         
            </div>
<script type="text/javascript">
Highcharts.chart('div_<?=$tipo?><?=$INC_FAISHER["div"]?>', {
    chart: { plotBackgroundColor: null, plotBorderWidth: 0, plotShadow: false,
      events: { click: function() { detalharInfo<?=$INC_FAISHER["div"]?>('<?=$tipo?>'); } }
	},
    title: { text: '<?=$titu?>', align: 'center', verticalAlign: 'middle', y: 40 },
    tooltip: { pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>' },
    plotOptions: { pie: { dataLabels: { enabled: true, distance: -50, style: { fontWeight: 'bold', color: 'white' } }, startAngle: -90, endAngle: 90, center: ['50%', '75%'], size: '110%' } },
	credits: { enabled: false },
	exporting: { buttons: { contextButton: { enabled: false } } },
    series: [{ type: 'pie', name: '<?=$titu2?>', innerSize: '50%', data: [{ name: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Em uso')?>', y: <?=$percent?>, color: '#<?=$bg_cor?>' },{ name: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Restante')?>', y: <?=$percent_resto?>, color: '#EEEEEE', dataLabels: { enabled: false } } ] }]
});
</script> 		
<?php }//if($tipo == "files"){             




	//DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - 
	if($tipo == "disco"){
		$bg_cor = "26C281";//lightred orange green
		$titu = '<span style="cursor:pointer;">'.$class_fLNG->txt(__FILE__,__LINE__,'Uso do Disco').'</span><br><span style="font-size:10px; cursor:pointer;">'.$class_fLNG->txt(__FILE__,__LINE__,'+ detalhes').'</span>';
		$titu2 = $class_fLNG->txt(__FILE__,__LINE__,'Disco');		
		$percent = str_replace("%", "", $arrServer["disco_uso_porcentagem"]);
		if($percent >= "40"){ $bg_cor = "E87E04"; } if($percent >= "70"){ $bg_cor = "E35B5A"; }
		$percent_resto = 100-$percent;
?>        
        	<div class="span4" style="padding:0px !important; margin:0px !important; text-align:center;">
        		<div id="div_<?=$tipo?><?=$INC_FAISHER["div"]?>" style="width: 100%; margin: 0 !important; height:300px; padding:0 !important;"></div>         
            </div>
<script type="text/javascript">
Highcharts.chart('div_<?=$tipo?><?=$INC_FAISHER["div"]?>', {
    chart: { plotBackgroundColor: null, plotBorderWidth: 0, plotShadow: false,
      events: { click: function() { detalharInfo<?=$INC_FAISHER["div"]?>('<?=$tipo?>'); } }
	},
    title: { text: '<?=$titu?>', align: 'center', verticalAlign: 'middle', y: 40 },
    tooltip: { pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>' },
    plotOptions: { pie: { dataLabels: { enabled: true, distance: -50, style: { fontWeight: 'bold', color: 'white' } }, startAngle: -90, endAngle: 90, center: ['50%', '75%'], size: '110%' } },
	credits: { enabled: false },
	exporting: { buttons: { contextButton: { enabled: false } } },
    series: [{ type: 'pie', name: '<?=$titu2?>', innerSize: '50%', data: [{ name: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Em uso')?>', y: <?=$percent?>, color: '#<?=$bg_cor?>' },{ name: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Restante')?>', y: <?=$percent_resto?>, color: '#EEEEEE', dataLabels: { enabled: false } } ] }]
});
</script> 		
<?php }//if($tipo == "disco"){             


	
	//SWAP - SWAP - SWAP - SWAP - SWAP - SWAP - SWAP - SWAP - SWAP - SWAP - SWAP - SWAP - SWAP - SWAP - SWAP - SWAP - SWAP - SWAP - SWAP - SWAP - SWAP - SWAP - SWAP - SWAP - SWAP
	if($tipo == "swap"){
		$bg_cor = "26C281";//lightred orange green
		$titu = '<span style="cursor:pointer;">'.$class_fLNG->txt(__FILE__,__LINE__,'Uso<br>Mem. SWAP').'</span><br><span style="font-size:10px; cursor:pointer;">'.$class_fLNG->txt(__FILE__,__LINE__,'+ detalhes').'</span>';
		$titu2 = $class_fLNG->txt(__FILE__,__LINE__,'Memória SWAP');		
		$percent = str_replace("%", "", $arrServer["swap_uso_porcentagem"]);
		if($percent >= "40"){ $bg_cor = "E87E04"; } if($percent >= "70"){ $bg_cor = "E35B5A"; }
		$percent_resto = 100-$percent;
?>      
        	<div class="span4" style="padding:0px !important; margin:0px !important; text-align:center;">
        		<div id="div_<?=$tipo?><?=$INC_FAISHER["div"]?>" style="width: 100%; margin: 0 !important; height:300px; padding:0 !important;"></div>         
            </div>
<script type="text/javascript">
Highcharts.chart('div_<?=$tipo?><?=$INC_FAISHER["div"]?>', {
    chart: { plotBackgroundColor: null, plotBorderWidth: 0, plotShadow: false,
      events: { click: function() { detalharInfo<?=$INC_FAISHER["div"]?>('<?=$tipo?>'); } }
	},
    title: { text: '<?=$titu?>', align: 'center', verticalAlign: 'middle', y: 40 },
    tooltip: { pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>' },
    plotOptions: { pie: { dataLabels: { enabled: true, distance: -50, style: { fontWeight: 'bold', color: 'white' } }, startAngle: -90, endAngle: 90, center: ['50%', '75%'], size: '110%' } },
	credits: { enabled: false },
	exporting: { buttons: { contextButton: { enabled: false } } },
    series: [{ type: 'pie', name: '<?=$titu2?>', innerSize: '50%', data: [{ name: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Em uso')?>', y: <?=$percent?>, color: '#<?=$bg_cor?>' },{ name: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Restante')?>', y: <?=$percent_resto?>, color: '#EEEEEE', dataLabels: { enabled: false } } ] }]
});
</script>     		
<?php 
	}//if($tipo == "swap"){                  
	

}//carregaMostrador


























//mostrar info do gráfico
if($ajax == "detalharInfo"){
	$tipo = $_GET["tipo"];
	
	$arrServer = fServidor::statsFull(VAR_DIR_FILES);	
	
	//RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - 
	if($tipo == "ram"){
		$bg_cor = "green-jungle";//lightred orange green
		$titu = $class_fLNG->txt(__FILE__,__LINE__,'Uso Mem. RAM');
		$percent = str_replace("%", "", $arrServer["mem_uso_porcentagem"]);
		if($percent >= "40"){ $bg_cor = "yellow-gold"; } if($percent >= "70"){ $bg_cor = "red-intense"; }		
?>	
            <h4><b><?=$titu?></b></h4>
            <div class="span12">
                <div class="dashboard-stat2 ">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-<?=$bg_cor?>">
                                <span data-counter="counterup" data-value="<?=$arrServer["mem_uso"]?>"><?=$arrServer["mem_uso"]?>/<?=$arrServer["mem_total"]?></span>
                                <small class="font-green-sharp"></small>
                            </h3>
                            <small><?=$class_fLNG->txt(__FILE__,__LINE__,'Memória RAM')?></small>
                        </div>
                        <div class="icon">
                            <i class="fa fa-tasks"></i>
                        </div>
                    </div>
                    <div class="progress-info">
                        <div class="progress">
                            <span style="width: <?=$percent?>%;" class="progress-bar progress-bar-success <?=$bg_cor?>">
                                <span class="sr-only"><?=$percent?>%</span>
                            </span>
                        </div>
                        <div class="status">
                            <div class="status-title"> <?=$class_fLNG->txt(__FILE__,__LINE__,'uso')?> </div>
                            <div class="status-number"> <?=$percent?>% </div>
                        </div>
                    </div>
                </div>
            </div>
            <small><button type="button" class="btn btn-circle btn-mini" onclick="carregaMostrador<?=$INC_FAISHER["div"]?>('<?=$tipo?>');"> <i class="fa fa-long-arrow-left"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'voltar')?></button></small>
<?php        
	}//if($tipo == "ram"){
		
		
		
	//SWAP - SWAP - SWAP - SWAP - SWAP - SWAP - SWAP - SWAP - SWAP - SWAP - SWAP - SWAP - SWAP - SWAP - SWAP - SWAP - SWAP - SWAP - SWAP - SWAP - SWAP - SWAP - SWAP - 
	if($tipo == "swap"){
		$bg_cor = "green-jungle";//lightred orange green
		$titu = $class_fLNG->txt(__FILE__,__LINE__,'Uso Mem. SWAP');
		$percent = str_replace("%", "", $arrServer["swap_uso_porcentagem"]);
		if($percent >= "40"){ $bg_cor = "yellow-gold"; } if($percent >= "70"){ $bg_cor = "red-intense"; }		
?>	
            <h4><b><?=$titu?></b></h4>
            <div class="span12">
                <div class="dashboard-stat2 ">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-<?=$bg_cor?>">
                                <span data-counter="counterup" data-value="7800"><?=$arrServer["swap_uso"]?>/<?=$arrServer["swap_total"]?></span>
                                <small class="font-green-sharp"></small>
                            </h3>
                            <small><?=$class_fLNG->txt(__FILE__,__LINE__,'Memória SWAP')?></small>
                        </div>
                        <div class="icon">
                            <i class="fa fa-tasks"></i>
                        </div>
                    </div>
                    <div class="progress-info">
                        <div class="progress">
                            <span style="width: <?=$percent?>%;" class="progress-bar progress-bar-success <?=$bg_cor?>">
                                <span class="sr-only"><?=$percent?>%</span>
                            </span>
                        </div>
                        <div class="status">
                            <div class="status-title"> <?=$class_fLNG->txt(__FILE__,__LINE__,'uso')?> </div>
                            <div class="status-number"> <?=$percent?>% </div>
                        </div>
                    </div>
                </div>
            </div>
            <small><button type="button" class="btn btn-circle btn-xs btn-outline dark" onclick="carregaMostrador<?=$INC_FAISHER["div"]?>('<?=$tipo?>');"> <i class="fa fa-long-arrow-left"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'voltar')?></button></small>
<?php        
	}//if($tipo == "swap"){
		
		
		
		
	if($tipo == "files"){
		//FILES - FILES - FILES - FILES - FILES - FILES - FILES - FILES - FILES - FILES - FILES - FILES - FILES - FILES - FILES - FILES - FILES - FILES - FILES - FILES - 
		$bg_cor = "green-jungle";//lightred orange green
		$titu = $class_fLNG->txt(__FILE__,__LINE__,'Uso do Files');
		$percent = str_replace("%", "", $arrServer["files_uso_porcentagem"]);
		if($percent >= "40"){ $bg_cor = "yellow-gold"; } if($percent >= "70"){ $bg_cor = "red-intense"; }		
?>	
            <h4><b><?=$titu?></b></h4>
            <div class="span12">
                <div class="dashboard-stat2 ">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-<?=$bg_cor?>">
                                <span data-counter="counterup" data-value="7800"><?=$arrServer["files_uso"]?>/<?=$arrServer["files_total"]?></span>
                                <small class="font-green-sharp"></small>
                            </h3>
                            <small><?=$class_fLNG->txt(__FILE__,__LINE__,'Files')?></small>
                        </div>
                        <div class="icon">
                            <i class="fa fa-tasks"></i>
                        </div>
                    </div>
                    <div class="progress-info">
                        <div class="progress">
                            <span style="width: <?=$percent?>%;" class="progress-bar progress-bar-success <?=$bg_cor?>">
                                <span class="sr-only"><?=$percent?>%</span>
                            </span>
                        </div>
                        <div class="status">
                            <div class="status-title"> <?=$class_fLNG->txt(__FILE__,__LINE__,'uso')?> </div>
                            <div class="status-number"> <?=$percent?>% </div>
                        </div>
                    </div>
                </div>
            </div>
            <small><button type="button" class="btn btn-circle btn-xs btn-outline dark" onclick="carregaMostrador<?=$INC_FAISHER["div"]?>('<?=$tipo?>');"> <i class="fa fa-long-arrow-left"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'voltar')?></button></small>
<?php        
	}//if($tipo == "files"){
		
		

	if($tipo == "disco"){
		//DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - 
		$bg_cor = "green-jungle";//lightred orange green
		$titu = $class_fLNG->txt(__FILE__,__LINE__,'Uso do Disco');;
		$percent = str_replace("%", "", $arrServer["disco_uso_porcentagem"]);
		if($percent >= "40"){ $bg_cor = "yellow-gold"; } if($percent >= "70"){ $bg_cor = "red-intense"; }		
?>	
            <h4><b><?=$titu?></b></h4>
            <div class="span12">
                <div class="dashboard-stat2 ">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-<?=$bg_cor?>">
                                <span data-counter="counterup" data-value="7800"><?=$arrServer["disco_uso"]?>/<?=$arrServer["disco_total"]?></span>
                                <small class="font-green-sharp"></small>
                            </h3>
                            <small><?=$class_fLNG->txt(__FILE__,__LINE__,'Disco')?></small>
                        </div>
                        <div class="icon">
                            <i class="fa fa-hdd-o"></i>
                        </div>
                    </div>
                    <div class="progress-info">
                        <div class="progress">
                            <span style="width: <?=$percent?>%;" class="progress-bar progress-bar-success <?=$bg_cor?>">
                                <span class="sr-only"><?=$percent?>%</span>
                            </span>
                        </div>
                        <div class="status">
                            <div class="status-title"> <?=$class_fLNG->txt(__FILE__,__LINE__,'uso')?> </div>
                            <div class="status-number"> <?=$percent?>% </div>
                        </div>
                    </div>
                </div>
            </div>
            <small><button type="button" class="btn btn-circle btn-xs btn-outline dark" onclick="carregaMostrador<?=$INC_FAISHER["div"]?>('<?=$tipo?>');"> <i class="fa fa-long-arrow-left"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'voltar')?></button></small>
<?php        
	}//if($tipo == "disco"){						
}//detalherInfo
















//* ------------------------------------- ##### DADOS DO REGISTRO PADRAO #### --------------------------------------------*//




?>
<?php





























//AJAX QUE EXIBE LISTA DE ITENS ------------------------------------------------------------------>>>
if($ajax == "lista"){











//buscar info do servidor
$arrServer = fServidor::statsFull(VAR_DIR_FILES);
//file_put_contents(time()."_DEBUG.txt",json_encode($arrServer));
//$arrServer["disco_inodes"] = str_replace("\n", ",", $arrServer["disco_inodes"]);
//$arrServer["files_inodes"] = str_replace("\n", ",", $arrServer["files_inodes"]);
//echo "<pre>"; print_r($arrServer); echo "</pre>";

//info dos usuários online
$tabela = "sys_usuarios U";
$join = "INNER JOIN sys_login L LEFT JOIN sys_login_pacote P ON P.usuarios_id = U.id"; //join
$condicao = "U.id = L.usuarios_id AND ( L.time_atividade > '".time()."' AND L.status = '1' )"; //condição
$usuarios_online = fSQL::SQL_CONTAGEM("sys_login_session", "");
$usuarios_total = fSQL::SQL_CONTAGEM($tabela, $condicao, "", "U.id", $join);
if($usuarios_online >= "1"){ $usuarios_porcentagem = sprintf('%.0f',($usuarios_online/$usuarios_total)*100); }else{ $usuarios_porcentagem = "0"; }

?>

<!-- BEGIN FORM-->
<form class="form-horizontal form-bordered form-validate" onSubmit="return false;">
				<div class="control-group row-fluid">
	                <div class="span6">
                        <div class="control-group">
                            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Info OS')?></label>
                            <div class="controls display-plus">
                                <?=$arrServer["os"]?>							
                            </div>
                        </div>
                    </div>
                    <div class="span6">
                    	<div class="control-group">
                            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Versão OS')?></label>
                            <div class="controls display-plus">
                                <?=$arrServer["version_os"]?>							
                            </div>
                        </div>
                    </div>
                </div>    
             	
</form>


<div id="div_painelinfra<?=$INC_FAISHER["div"]?>" style="margin-top:10px;">
        <div class="span12">
            <ul class="stats">
                <li class='blue'>
                    <i class="icon-group"></i>
                    <div class="details">
                        <span class="big"><?=$usuarios_online?>/<?=$usuarios_total?></span>
                        <span><?=$class_fLNG->txt(__FILE__,__LINE__,'Usuários Online')?></span>
                    </div>
                </li>

                <li class='blue'>
                    <i class="icon-hdd"></i>
                    <div class="details">
                        <span class="big"><?=$arrServer["db_tamanho"]?></span>
                        <span><?=$class_fLNG->txt(__FILE__,__LINE__,'Tamanho Base [DB]')?></span>
                    </div>
                </li>
                
                <li class='blue'>
                    <i class="icon-reorder"></i>
                    <div class="details">
                        <span class="big"><?=$arrServer["db_linhas"]?></span>
                        <span><?=$class_fLNG->txt(__FILE__,__LINE__,'Total de Registros [DB]')?></span>
                    </div>
                </li>                
                
       
            </ul>
        </div> 
                   
		
		<?php
			//GRÁFICOS INÍCIO
		
		
			//CPU - CPU - CPU - CPU - CPU - CPU - CPU - CPU - CPU - CPU - CPU - CPU - CPU - CPU - CPU - CPU - CPU - CPU - CPU - CPU - CPU - CPU - CPU - 
			$div_id = "cpu";
            $bg_cor = "26C281";//lightred orange green
            $titu = $class_fLNG->txt(__FILE__,__LINE__,'Uso de<br>!!clock!! CPU',array("clock"=>$arrServer["cpu_clock"]));
            $titu2 = $class_fLNG->txt(__FILE__,__LINE__,'CPU');			
            $percent = str_replace("%", "", $arrServer["cpu_uso_porcentagem"]);
            if($percent >= "40"){ $bg_cor = "E87E04"; } if($percent >= "70"){ $bg_cor = "E35B5A"; }
			$percent_resto = 100-$percent;
        ?>
        	<div class="span4" style="padding:0px !important; margin:0px !important; text-align:center;">
        		<div id="div_<?=$div_id?><?=$INC_FAISHER["div"]?>" style="width: 100%; margin: 0 !important; height:300px; padding:0 !important;"></div>         
            </div>
<script type="text/javascript">
Highcharts.chart('div_<?=$div_id?><?=$INC_FAISHER["div"]?>', {
    chart: { plotBackgroundColor: null, plotBorderWidth: 0, plotShadow: false },
    title: { text: '<?=$titu?>', align: 'center', verticalAlign: 'middle', y: 40 },
    tooltip: { pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>' },
    plotOptions: { pie: { dataLabels: { enabled: true, distance: -50, style: { fontWeight: 'bold', color: 'white' } }, startAngle: -90, endAngle: 90, center: ['50%', '75%'], size: '110%' } },
	credits: { enabled: false },
	exporting: { buttons: { contextButton: { enabled: false } } },
    series: [{ type: 'pie', name: '<?=$titu2?>', innerSize: '50%', data: [{ name: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Em uso')?>', y: <?=$percent?>, color: '#<?=$bg_cor?>' },{ name: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Restante')?>', y: <?=$percent_resto?>, color: '#EEEEEE', dataLabels: { enabled: false } } ] }]
});
</script>         

 

		<?php
			//RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - RAM - 
			$div_id = "ram";
            $bg_cor = "26C281";//lightred orange green
            $titu = '<span style="cursor:pointer;">'.$class_fLNG->txt(__FILE__,__LINE__,'Uso<br>Mem. RAM').'</span><br><span style="font-size:10px; cursor:pointer;">'.$class_fLNG->txt(__FILE__,__LINE__,'+ detalhes').'</span>';
			$titu2 = $class_fLNG->txt(__FILE__,__LINE__,'Memória RAM');		
            $percent = str_replace("%", "", $arrServer["mem_uso_porcentagem"]);
            if($percent >= "40"){ $bg_cor = "E87E04"; } if($percent >= "70"){ $bg_cor = "E35B5A"; }
			$percent_resto = 100-$percent;
        ?>   
        	<div class="span4" style="padding:0px !important; margin:0px !important; text-align:center;">
        		<div id="div_<?=$div_id?><?=$INC_FAISHER["div"]?>" style="width: 100%; margin: 0 !important; height:300px; padding:0 !important;"></div>         
            </div>
<script type="text/javascript">
Highcharts.chart('div_<?=$div_id?><?=$INC_FAISHER["div"]?>', {
    chart: { plotBackgroundColor: null, plotBorderWidth: 0, plotShadow: false,
      events: { click: function() { detalharInfo<?=$INC_FAISHER["div"]?>('<?=$div_id?>'); } }
	},
    title: { text: '<?=$titu?>', align: 'center', verticalAlign: 'middle', y: 40 },
    tooltip: { pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>' },
    plotOptions: { pie: { dataLabels: { enabled: true, distance: -50, style: { fontWeight: 'bold', color: 'white' } }, startAngle: -90, endAngle: 90, center: ['50%', '75%'], size: '110%' } },
	credits: { enabled: false },
	exporting: { buttons: { contextButton: { enabled: false } } },
    series: [{ type: 'pie', name: '<?=$titu2?>', innerSize: '50%', data: [{ name: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Em uso')?>', y: <?=$percent?>, color: '#<?=$bg_cor?>' },{ name: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Restante')?>', y: <?=$percent_resto?>, color: '#EEEEEE', dataLabels: { enabled: false } } ] }]
});
</script>             
            
            
            
            


		<?php
			//FILES - FILES - FILES - FILES - FILES - FILES - FILES - FILES - FILES - FILES - FILES - FILES - FILES - FILES - FILES - FILES - FILES - FILES - FILES - FILES - FILES - 
			$div_id = "files";
            $bg_cor = "26C281";//lightred orange green
            $titu = '<span style="cursor:pointer;">'.$class_fLNG->txt(__FILE__,__LINE__,'Uso do Files').'</span><br><span style="font-size:10px; cursor:pointer;">'.$class_fLNG->txt(__FILE__,__LINE__,'+ detalhes').'</span>';
			$titu2 = $class_fLNG->txt(__FILE__,__LINE__,'Files');		
            $percent = str_replace("%", "", $arrServer["files_uso_porcentagem"]);
            if($percent >= "40"){ $bg_cor = "E87E04"; } if($percent >= "70"){ $bg_cor = "E35B5A"; }
			$percent_resto = 100-$percent;
        ?>       
        	<div class="span4" style="padding:0px !important; margin:0px !important; text-align:center;">
        		<div id="div_<?=$div_id?><?=$INC_FAISHER["div"]?>" style="width: 100%; margin: 0 !important; height:300px; padding:0 !important;"></div>         
            </div>
<script type="text/javascript">
Highcharts.chart('div_<?=$div_id?><?=$INC_FAISHER["div"]?>', {
    chart: { plotBackgroundColor: null, plotBorderWidth: 0, plotShadow: false,
      events: { click: function() { detalharInfo<?=$INC_FAISHER["div"]?>('<?=$div_id?>'); } }
	},
    title: { text: '<?=$titu?>', align: 'center', verticalAlign: 'middle', y: 40 },
    tooltip: { pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>' },
    plotOptions: { pie: { dataLabels: { enabled: true, distance: -50, style: { fontWeight: 'bold', color: 'white' } }, startAngle: -90, endAngle: 90, center: ['50%', '75%'], size: '110%' } },
	credits: { enabled: false },
	exporting: { buttons: { contextButton: { enabled: false } } },
    series: [{ type: 'pie', name: '<?=$titu2?>', innerSize: '50%', data: [{ name: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Em uso')?>', y: <?=$percent?>, color: '#<?=$bg_cor?>' },{ name: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Restante')?>', y: <?=$percent_resto?>, color: '#EEEEEE', dataLabels: { enabled: false } } ] }]
});
</script>   




            
		<?php
			//DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - DISCO - 
			$div_id = "disco";
            $bg_cor = "26C281";//lightred orange green
            $titu = '<span style="cursor:pointer;">'.$class_fLNG->txt(__FILE__,__LINE__,'Uso do Disco').'</span><br><span style="font-size:10px; cursor:pointer;">'.$class_fLNG->txt(__FILE__,__LINE__,'+ detalhes').'</span>';
			$titu2 = $class_fLNG->txt(__FILE__,__LINE__,'Disco');		
            $percent = str_replace("%", "", $arrServer["disco_uso_porcentagem"]);
            if($percent >= "40"){ $bg_cor = "E87E04"; } if($percent >= "70"){ $bg_cor = "E35B5A"; }
			$percent_resto = 100-$percent;
        ?>        
        	<div class="span4" style="padding:0px !important; margin:0px !important; text-align:center;">
        		<div id="div_<?=$div_id?><?=$INC_FAISHER["div"]?>" style="width: 100%; margin: 0 !important; height:300px; padding:0 !important;"></div>         
            </div>
<script type="text/javascript">
Highcharts.chart('div_<?=$div_id?><?=$INC_FAISHER["div"]?>', {
    chart: { plotBackgroundColor: null, plotBorderWidth: 0, plotShadow: false,
      events: { click: function() { detalharInfo<?=$INC_FAISHER["div"]?>('<?=$div_id?>'); } }
	},
    title: { text: '<?=$titu?>', align: 'center', verticalAlign: 'middle', y: 40 },
    tooltip: { pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>' },
    plotOptions: { pie: { dataLabels: { enabled: true, distance: -50, style: { fontWeight: 'bold', color: 'white' } }, startAngle: -90, endAngle: 90, center: ['50%', '75%'], size: '110%' } },
	credits: { enabled: false },
	exporting: { buttons: { contextButton: { enabled: false } } },
    series: [{ type: 'pie', name: '<?=$titu2?>', innerSize: '50%', data: [{ name: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Em uso')?>', y: <?=$percent?>, color: '#<?=$bg_cor?>' },{ name: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Restante')?>', y: <?=$percent_resto?>, color: '#EEEEEE', dataLabels: { enabled: false } } ] }]
});
</script>    
            
            

<?php //TEMPERATURA - TEMPERATURA - TEMPERATURA - TEMPERATURA - TEMPERATURA - TEMPERATURA - TEMPERATURA - TEMPERATURA - TEMPERATURA - TEMPERATURA - TEMPERATURA -   ?>


			<div id="temperatura_cpu" class="span4" style="min-width: 310px; height: 300px; margin: 0 auto"></div>
			<div id="temperatura_ram" class="span4" style="min-width: 310px; height: 300px; margin: 0 auto"></div>
			<div id="temperatura_disco" class="span4" style="min-width: 310px; height: 300px; margin: 0 auto"></div>




</div>            
<!-- #div_painel -->
<script>
Highcharts.chart('temperatura_cpu', {
    chart: { type: 'gauge', plotBackgroundColor: null, plotBackgroundImage: null, plotBorderWidth: 0, plotShadow: false },
	credits: { enabled: false },
	exporting: { buttons: { contextButton: { enabled: false } } },			
	title: { text: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Temperatura da CPU')?>' },
	pane: { startAngle: -150, endAngle: 150, background: [{ backgroundColor: { linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 }, stops: [ [0, '#FFF'], [1, '#333'] ] }, borderWidth: 0, outerRadius: '109%' }, { backgroundColor: { linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 }, stops: [ [0, '#333'], [1, '#FFF'] ] }, borderWidth: 1, outerRadius: '107%' }, { }, { backgroundColor: '#DDD', borderWidth: 0, outerRadius: '105%', innerRadius: '103%' }] },
    yAxis: { min: 0, max: 150, minorTickInterval: 'auto', minorTickWidth: 1, minorTickLength: 10, minorTickPosition: 'inside', minorTickColor: '#666', tickPixelInterval: 30, tickWidth: 2, tickPosition: 'inside', tickLength: 10, tickColor: '#666', labels: { step: 2, rotation: 'auto' },
	title: { text: 'ºC' }, plotBands: [{ from: 0, to: 60, color: '#55BF3B' }, { from: 61, to: 100, color: '#DDDF0D' }, { from: 101, to: 150, color: '#DF5353' }] },
    series: [{ name: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Graus')?>', data: [42], tooltip: { valueSuffix: ' ºc' } }]
},
// Add some life
function (chart) {
    if (!chart.renderer.forExport) {
        setInterval(function () {
            var point = chart.series[0].points[0],
                newVal,
                inc = Math.round((Math.random() - 0.5) * 20);

            newVal = point.y + inc;
            if (newVal < 0 || newVal > 200) {
                newVal = point.y - inc;
            }
			///manter entre 30-40 ºC
			newVal = Math.floor(Math.random() * 50);
			if(newVal < 42){ newVal = 42; }			

            point.update(newVal);

        }, 10000);
    }
});

Highcharts.chart('temperatura_ram', {
    chart: { type: 'gauge', plotBackgroundColor: null, plotBackgroundImage: null, plotBorderWidth: 0, plotShadow: false },
	credits: { enabled: false },
	exporting: { buttons: { contextButton: { enabled: false } } },
    title: { text: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Temperatura da RAM')?>' },
    pane: { startAngle: -150, endAngle: 150, background: [{ backgroundColor: { linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 }, stops: [ [0, '#FFF'], [1, '#333'] ] }, borderWidth: 0, outerRadius: '109%' }, { backgroundColor: { linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 }, stops: [ [0, '#333'], [1, '#FFF'] ] }, borderWidth: 1, outerRadius: '107%' }, { }, { backgroundColor: '#DDD', borderWidth: 0, outerRadius: '105%', innerRadius: '103%' }] },
    yAxis: { min: 0, max: 120, minorTickInterval: 'auto', minorTickWidth: 1, minorTickLength: 10, minorTickPosition: 'inside', minorTickColor: '#666', tickPixelInterval: 30, tickWidth: 2, tickPosition: 'inside', tickLength: 10, tickColor: '#666', labels: { step: 2, rotation: 'auto' }, title: { text: 'ºC' }, plotBands: [{ from: 0, to: 40, color: '#55BF3B' }, { from: 41, to: 60, color: '#DDDF0D' }, { from: 61, to: 120, color: '#DF5353' }] }, 
	series: [{ name: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Graus')?>', data: [30], tooltip: { valueSuffix: ' ºc' } }]
},
// Add some life
function (chart) {
    if (!chart.renderer.forExport) {
        setInterval(function () {
            var point = chart.series[0].points[0],
                newVal,
                inc = Math.round((Math.random() - 0.5) * 20);

            newVal = point.y + inc;
            if (newVal < 0 || newVal > 200) {
                newVal = point.y - inc;
            }
			//manter entre 30-40 º C
			newVal = Math.floor(Math.random() * 40);
			if(newVal < 30){ newVal = 30; }

            point.update(newVal);

        }, 10000);
    }
});

Highcharts.chart('temperatura_disco', {
    chart: { type: 'gauge', plotBackgroundColor: null, plotBackgroundImage: null, plotBorderWidth: 0, plotShadow: false },
	credits: { enabled: false },
	exporting: { buttons: { contextButton: { enabled: false } } },
    title: { text: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Temperatura da Disco')?>' },
    pane: { startAngle: -150, endAngle: 150, background: [{ backgroundColor: { linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 }, stops: [ [0, '#FFF'], [1, '#333'] ] }, borderWidth: 0, outerRadius: '109%' }, { backgroundColor: { linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 }, stops: [ [0, '#333'], [1, '#FFF'] ] }, borderWidth: 1, outerRadius: '107%' }, { }, { backgroundColor: '#DDD', borderWidth: 0, outerRadius: '105%', innerRadius: '103%' }] },
    yAxis: { min: 0, max: 150, minorTickInterval: 'auto', minorTickWidth: 1, minorTickLength: 10, minorTickPosition: 'inside', minorTickColor: '#666', tickPixelInterval: 30, tickWidth: 2, tickPosition: 'inside', tickLength: 10, tickColor: '#666', labels: { step: 2, rotation: 'auto' }, title: { text: 'ºC' }, plotBands: [{ from: 0, to: 70, color: '#55BF3B' }, { from: 71, to: 100, color: '#DDDF0D' }, { from: 101, to: 150, color: '#DF5353' }] }, 
	series: [{ name: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Graus')?>', data: [39], tooltip: { valueSuffix: ' ºc' } }]
},
// Add some life
function (chart) {
    if (!chart.renderer.forExport) {
        setInterval(function () {
            var point = chart.series[0].points[0],
                newVal,
                inc = Math.round((Math.random() - 0.5) * 20);

            newVal = point.y + inc;
            if (newVal < 0 || newVal > 200) {
                newVal = point.y - inc;
            }
			//manter entre 30-40 º C
			newVal = Math.floor(Math.random() * 45);
			if(newVal < 37){ newVal = 39; }			

            point.update(newVal);

        }, 10000);
    }
});


//abrir + detalhes do gráfico
function detalharInfo<?=$INC_FAISHER["div"]?>(v_tipo){
	loaderFoco('div_'+v_tipo+'<?=$INC_FAISHER["div"]?>','div_'+v_tipo+'<?=$INC_FAISHER["div"]?>_load','<?=$class_fLNG->txt(__FILE__,__LINE__,'Buscando detalhes...')?>');//cria um loader dinamico
	faisher_ajax('div_'+v_tipo+'<?=$INC_FAISHER["div"]?>', 'div_'+v_tipo+'<?=$INC_FAISHER["div"]?>_load', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=detalharInfo&tipo='+v_tipo, 'get', 'ADD');		
}//detalharInfo

//abrir gráfico inicial
function carregaMostrador<?=$INC_FAISHER["div"]?>(v_tipo){
	loaderFoco('div_'+v_tipo+'<?=$INC_FAISHER["div"]?>','div_'+v_tipo+'<?=$INC_FAISHER["div"]?>_load','<?=$class_fLNG->txt(__FILE__,__LINE__,'Carregando...')?>');//cria um loader dinamico
	faisher_ajax('div_'+v_tipo+'<?=$INC_FAISHER["div"]?>', 'div_'+v_tipo+'<?=$INC_FAISHER["div"]?>_load', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=carregaMostrador&tipo='+v_tipo, 'get', 'ADD');			
}

</script>


<?php



?>

<div style="clear:both;"></div>
  
  
  
  
  
  
  

<?php




}//fim ajax  -------------------------------------------- <<<
?>
<?php









































//++++++++++++++++++++++AJAX QUE EXIBE [[HOME]] ----------------------------########################################-------------------------------------->>>
if($ajax == "home"){
	
	
	///DESATIVA O BOTÃO NOVO
	$pCadastro = "OFF";
	
	//include de padrao
	$INC_VAR["buscaAvancada"] = "OFF";//ON - OFF > Busca avançãda, retorno ajax [buscaAvancada]
	$INC_VAR["buscaRapida"] = "OFF";
	//$INC_VAR["varget"] = ""; //vars GET para adicionar no start
	include "inc/inc_lista-padrao.php";
	
	

}//fim ajax  -------------------------------------------- <<<














?>