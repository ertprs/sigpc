<?php
if(!isset($_GET["unidade_id"])){ echo "Unité non définie!"; exit(0); }else{ $unidade_id = $_GET["unidade_id"]; }

//fuso horário
/*$timezones = array(
'AC' => 'America/Rio_branco',   'AL' => 'America/Maceio',
'AP' => 'America/Belem',        'AM' => 'America/Manaus',
'BA' => 'America/Bahia',        'CE' => 'America/Fortaleza',
'DF' => 'America/Sao_Paulo',    'ES' => 'America/Sao_Paulo',
'GO' => 'America/Sao_Paulo',    'MA' => 'America/Fortaleza',
'MT' => 'America/Cuiaba',       'MS' => 'America/Campo_Grande',
'MG' => 'America/Sao_Paulo',    'PR' => 'America/Sao_Paulo', - Etc/GMT+3
'PB' => 'America/Fortaleza',    'PA' => 'America/Belem',
'PE' => 'America/Recife',       'PI' => 'America/Fortaleza',
'RJ' => 'America/Sao_Paulo',    'RN' => 'America/Fortaleza',
'RS' => 'America/Sao_Paulo',    'RO' => 'America/Porto_Velho',
'RR' => 'America/Boa_Vista',    'SC' => 'America/Sao_Paulo',
'SE' => 'America/Maceio',       'SP' => 'America/Sao_Paulo',
'TO' => 'America/Araguaia',     
);*/
setlocale(LC_ALL, 'ptb', 'portuguese-brazil', 'pt-br', 'bra', 'brazil');
date_default_timezone_set('Etc/GMT+3');//setar fuso horário

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Panneau de Mot de Passe</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="css/all.css" rel="stylesheet"> <!--load all styles -->
  <link rel="stylesheet" href="css/boostrap-3.3.7.min.css">
	<!-- css para biblioteca de icones -->
  <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
  <script src="js/jquery-3.1.1.min.js"></script>
  <script src="js/bootstrap-3.3.7.min.js"></script>  
  <!-- função bcm_ajax -->
  <script src="js/ajax_jquery.js"></script>    
  <script src="js/jquery.ba-dotimeout.js"></script>
</head>
<?php
$cor_bg = "#E6E6E6";
$cor_senha = "#F0AA00";
$cor_bloco = "#026146";
$cor_titus = "white";
?>
<style>
.table-geral { width:100%; height:100%; background-color:<?=$cor_bloco?>; color:<?=$cor_titus?>; text-align: center; font-weight:bold; border-radius: 25px; }
.border-bottom { border-bottom:1px white solid; }
.border-right { border-right:1px white solid; }
.div_principal {        
	
}
</style>


<body style="background-color:<?=$cor_bg?>;">
   

	
	<div class="container" style="height:100%; width:100%;">
   <div class="d-flex align-items-center justify-content-center">
	<div class="col-md-7">
            <table class="table-geral" style="margin-top:10px;">
              <tbody id="corpo_tabela">
					<tr>
                    	<td><!--<img src="img/bandeira-1.png" style="max-width:251px; position:absolute; left:30px;">--><span style="font-size:6vw;">MOT DE PASSE</span></td>
                    </tr>
					<tr>
                    	<td><span style="font-size: 12vw; color:<?=$cor_senha?>;" id="senha"><button type="button" class="btn btn-primary" id="btIniciar" style="z-index:9999;" onclick="carregaLista();"><span style="padding:10px; font-size:60px;"><i class="fa fa-play"></i> PANNEAU DE DÉMARRAGE</span></button>   </span></td>
                    </tr>                    
					<tr>
                    	<td><span style="font-size:6vw;">GUICHET</span></td>
                    </tr>
					<tr>
                    	<td><span style="font-size:12vw; color:<?=$cor_senha?>;" id="guiche">-</span></td>
                    </tr>                    	
              </tbody>
            </table>            
   </div>
   <div class="col-md-5">
            <table class="table-geral" style="margin-top:10px;">
            	<thead>
                	<tr class="border-bottom">
                    	<th colspan="3" style="text-align:center; font-size:2vw;">HISTORIQUE</th>
                    </tr>
                	<tr class="border-bottom">
                    	<th class="border-right" style="text-align:center; font-size:2vw;">MOT DE PASSE</th>
                    	<th class="border-right" style="text-align:center; font-size:2vw;">GUICHET</th>
                        <th style="text-align:center; font-size:2vw;">HEURE</th>                        
                    </tr>
                </thead>
              	<tbody id="tabela_historico">
					<tr style="margin-top:10px;">
                    	<td class="border-right"><span style="font-size:3vw; color:<?=$cor_senha?>;" id="hist_senha_1">-</span></td>
                        <td class="border-right"><span style="font-size:3vw; color:<?=$cor_senha?>;" id="hist_guiche_1">-</span></td>
                        <td><span style="font-size:3vw; color:<?=$cor_senha?>;" id="hist_time_1">-</span></td>
                    </tr>
					<tr style="margin-top:10px;">
                    	<td class="border-right"><span style="font-size:3vw; color:<?=$cor_senha?>;" id="hist_senha_2">-</span></td>
                        <td class="border-right"><span style="font-size:3vw; color:<?=$cor_senha?>;" id="hist_guiche_2">-</span></td>
                        <td><span style="font-size:3vw; color:<?=$cor_senha?>;" id="hist_time_2">-</span></td>                        
                    </tr>
					<tr style="margin-top:10px;">
                    	<td class="border-right"><span style="font-size:3vw; color:<?=$cor_senha?>;" id="hist_senha_3">-</span></td>
                        <td class="border-right"><span style="font-size:3vw; color:<?=$cor_senha?>;" id="hist_guiche_3">-</span></td>
                        <td><span style="font-size:3vw; color:<?=$cor_senha?>;" id="hist_time_3">-</span></td>                        
                    </tr>
					<tr style="margin-top:10px;">
                    	<td class="border-right"><span style="font-size:3vw; color:<?=$cor_senha?>;" id="hist_senha_4">-</span></td>
                        <td class="border-right"><span style="font-size:3vw; color:<?=$cor_senha?>;" id="hist_guiche_4">-</span></td>
                        <td><span style="font-size:3vw; color:<?=$cor_senha?>;" id="hist_time_4">-</span></td>                        
                    </tr>
					<tr style="margin-top:10px;">
                    	<td class="border-right"><span style="font-size:3vw; color:<?=$cor_senha?>;" id="hist_senha_5">-</span></td>
                        <td class="border-right"><span style="font-size:3vw; color:<?=$cor_senha?>;" id="hist_guiche_5">-</span></td>
                        <td ><span style="font-size:3vw; color:<?=$cor_senha?>;" id="hist_time_5">-</span></td>                        
                    </tr>   
					<tr style="margin-top:10px;">
                    	<td class="border-right"><span style="font-size:3vw; color:<?=$cor_senha?>;" id="hist_senha_6">-</span></td>
                        <td class="border-right"><span style="font-size:3vw; color:<?=$cor_senha?>;" id="hist_guiche_6">-</span></td>
                        <td ><span style="font-size:3vw; color:<?=$cor_senha?>;" id="hist_time_6">-</span></td>                        
                    </tr> 
					<tr style="margin-top:10px;">
                    	<td class="border-right"><span style="font-size:3vw; color:<?=$cor_senha?>;" id="hist_senha_7">-</span></td>
                        <td class="border-right"><span style="font-size:3vw; color:<?=$cor_senha?>;" id="hist_guiche_7">-</span></td>
                        <td ><span style="font-size:3vw; color:<?=$cor_senha?>;" id="hist_time_7">-</span></td>                        
                    </tr> 
					<tr style="margin-top:10px;">
                    	<td class="border-right"><span style="font-size:3vw; color:<?=$cor_senha?>;" id="hist_senha_8">-</span></td>
                        <td class="border-right"><span style="font-size:3vw; color:<?=$cor_senha?>;" id="hist_guiche_8">-</span></td>
                        <td ><span style="font-size:3vw; color:<?=$cor_senha?>;" id="hist_time_8">-</span></td>                        
                    </tr> 
					<tr style="margin-top:10px;">
                    	<td class="border-right"><span style="font-size:3vw; color:<?=$cor_senha?>;" id="hist_senha_9">-</span></td>
                        <td class="border-right"><span style="font-size:3vw; color:<?=$cor_senha?>;" id="hist_guiche_9">-</span></td>
                        <td ><span style="font-size:3vw; color:<?=$cor_senha?>;" id="hist_time_9">-</span></td>                        
                    </tr>    
					<tr style="margin-top:10px;">
                    	<td class="border-right"><span style="font-size:3vw; color:<?=$cor_senha?>;" id="hist_senha_10">-</span></td>
                        <td class="border-right"><span style="font-size:3vw; color:<?=$cor_senha?>;" id="hist_guiche_10">-</span></td>
                        <td ><span style="font-size:3vw; color:<?=$cor_senha?>;" id="hist_time_10">-</span></td>                        
                    </tr>
              	</tbody>
            </table>  
            
            <div style="text-align:center;">
            	<!--<h1 style=" text-align:center;">
                	<img src="img/logo-big.png" alt="" class='retina-ready' style="margin-right:0;" width="200" height="200">
                    <img src="img/bandeira-2.png" alt="" class='retina-ready' style="margin-right:0;" width="178" height="200">
                </h1>
                <br />-->
            	<span style="font-size:40px; margin-top:20px; color:<?=$cor_bloco?>;"><b> <i class="fa fa-calendar"></i> <span id="data_atual"><?=date("d/m/Y")?></span> <i class="fa fa-clock-o"></i> <span id="hora_atual"><?=date("H:i")?></span></b></span>
            </div> 	
   </div>
   </div>
   </div>
   

   


            <!--
            <div class="box">
            	<div>SENHA<br />F0079</div>
            </div>
            -->

















<audio id="notificacao_sound">
  <source src="notification1.mp3" type="audio/mpeg">
  Your browser does not support the audio element.
</audio>


<script type="text/javascript">
//$(document).ready(function(){ carregaLista(); });	

function carregaLista(){ 
	$("#senha").html("-");
	carregaListaSync();
}

function carregaListaSync(){
	$.get("atualizar.php?atualizar=1&unidade_id=<?=$unidade_id?>&senha_atual="+$("#senha").html(), function(data, status){
		if(status == "success"){
			var json = JSON.parse(data);
			var senha = $("#senha").html();
			var guiche = $("#guiche").html();			
			//console.log(json);
			if(json["senha"] != "0"){ 
				var media = document.getElementById("notificacao_sound");
				const playPromise = media.play();
				if (playPromise !== null){
					playPromise.catch(() => { media.play(); })
				}
				media.currentTime=0;		
				$("#senha").html(json["senha"]); 
				$("#guiche").html(json["guiche"]); 
			}
			
			var cont = "0";
			cont++; 
			if(json[cont] != null){ 
				$("#hist_senha_"+cont).html(json[cont]["senha"]); 
				$("#hist_guiche_"+cont).html(json[cont]["guiche"]); 
				$("#hist_time_"+cont).html(json[cont]["time"]); 
			}else{ $("#hist_senha_"+cont).html("-"); $("#hist_guiche_"+cont).html("-"); $("#hist_time_"+cont).html("-"); }
			
			cont++; 
			if(json[cont] != null){ 
				$("#hist_senha_"+cont).html(json[cont]["senha"]); 
				$("#hist_guiche_"+cont).html(json[cont]["guiche"]); 
				$("#hist_time_"+cont).html(json[cont]["time"]); 
			}else{ $("#hist_senha_"+cont).html("-"); $("#hist_guiche_"+cont).html("-"); $("#hist_time_"+cont).html("-"); }
			
			cont++; 
			if(json[cont] != null){ 
				$("#hist_senha_"+cont).html(json[cont]["senha"]); 
				$("#hist_guiche_"+cont).html(json[cont]["guiche"]); 
				$("#hist_time_"+cont).html(json[cont]["time"]); 
			}else{ $("#hist_senha_"+cont).html("-"); $("#hist_guiche_"+cont).html("-"); $("#hist_time_"+cont).html("-"); }
			
			cont++; 
			if(json[cont] != null){ 
				$("#hist_senha_"+cont).html(json[cont]["senha"]); 
				$("#hist_guiche_"+cont).html(json[cont]["guiche"]); 
				$("#hist_time_"+cont).html(json[cont]["time"]); 
			}else{ $("#hist_senha_"+cont).html("-"); $("#hist_guiche_"+cont).html("-"); $("#hist_time_"+cont).html("-"); }
			
			cont++; 
			if(json[cont] != null){ 
				$("#hist_senha_"+cont).html(json[cont]["senha"]); 
				$("#hist_guiche_"+cont).html(json[cont]["guiche"]); 
				$("#hist_time_"+cont).html(json[cont]["time"]); 
			}else{ $("#hist_senha_"+cont).html("-"); $("#hist_guiche_"+cont).html("-"); $("#hist_time_"+cont).html("-"); }									
			
			cont++; 
			if(json[cont] != null){ 
				$("#hist_senha_"+cont).html(json[cont]["senha"]); 
				$("#hist_guiche_"+cont).html(json[cont]["guiche"]); 
				$("#hist_time_"+cont).html(json[cont]["time"]); 
			}else{ $("#hist_senha_"+cont).html("-"); $("#hist_guiche_"+cont).html("-"); $("#hist_time_"+cont).html("-"); }	
			
			cont++; 
			if(json[cont] != null){ 
				$("#hist_senha_"+cont).html(json[cont]["senha"]); 
				$("#hist_guiche_"+cont).html(json[cont]["guiche"]); 
				$("#hist_time_"+cont).html(json[cont]["time"]); 
			}else{ $("#hist_senha_"+cont).html("-"); $("#hist_guiche_"+cont).html("-"); $("#hist_time_"+cont).html("-"); }	
			
			cont++; 
			if(json[cont] != null){ 
				$("#hist_senha_"+cont).html(json[cont]["senha"]); 
				$("#hist_guiche_"+cont).html(json[cont]["guiche"]); 
				$("#hist_time_"+cont).html(json[cont]["time"]); 
			}else{ $("#hist_senha_"+cont).html("-"); $("#hist_guiche_"+cont).html("-"); $("#hist_time_"+cont).html("-"); }	
			
			cont++; 
			if(json[cont] != null){ 
				$("#hist_senha_"+cont).html(json[cont]["senha"]); 
				$("#hist_guiche_"+cont).html(json[cont]["guiche"]); 
				$("#hist_time_"+cont).html(json[cont]["time"]); 
			}else{ $("#hist_senha_"+cont).html("-"); $("#hist_guiche_"+cont).html("-"); $("#hist_time_"+cont).html("-"); }	
			
			cont++; 
			if(json[cont] != null){ 
				$("#hist_senha_"+cont).html(json[cont]["senha"]); 
				$("#hist_guiche_"+cont).html(json[cont]["guiche"]); 
				$("#hist_time_"+cont).html(json[cont]["time"]); 
			}else{ $("#hist_senha_"+cont).html("-"); $("#hist_guiche_"+cont).html("-"); $("#hist_time_"+cont).html("-"); }																
			
			//atualizar hora
			var date = new Date();
			$("#data_atual").html(String(date.getDate()).padStart(2,'0')+"/"+String(date.getMonth()).padStart(2,'0')+"/"+date.getFullYear());
			$("#hora_atual").html(String(date.getHours()).padStart(2,'0')+":"+String(date.getMinutes()).padStart(2,'0'));
		}
	});			
	$.doTimeout('vTimerOPENList', 3000, function(){ carregaListaSync();	return false; });//TIMER
}//carregaListaSync


</script>













</body>
</html>
