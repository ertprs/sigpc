<?php // Breno Cruvinel - breno.cruvinel09@gmail.com
//INCLUDES DE CONTROLE --->>>
include "config/globalSession.php";//inicia sessao php
include "config/globalVars.php";//vars padrao
include "sys/langAction.php";
include "sys/globalFunctions.php";//funcoes padrao
include "sys/globalClass.php";//classes padrao
include "sys/classConexao.php";//classes de conexao
include "sys/incUpdate.php";//verificador de updates
include "config/incPacote.php";//vars do pacote de cliente
include "sys/classValidaAcesso.php";//classes de validação de acesso
//include "sys/cabecalho_ajax.php";//classes de conexao
//INCLUDES DE CONTROLE ---<<<

//INICIAR ARQUIVO DE LINGUAGEM --->>>
$class_fLNG->loadFile(__FILE__);//incluir o arquivo de linguagem
//INICIAR ARQUIVO DE LINGUAGEM ---<<<



	
//INICIAR CLASSES DE CONTROLE --->>>
//conexao DB
$classe_db = new classe_DB;//inicia a classe de conexao
$classe_db->AbreConexaoPai();//Abrimos a conexão Pai
$cMSG = new classMSG();//inicia a classe de mensagens
//INICIAR CLASSES DE CONTROLE ---<<<


//CLASSES PROTEGE PAGINA/LOGIN --->>>
//protege a pagina
$cVLogin = new classVLOGIN;//inicia a classe de login
$cVLogin->loginCookie();//verifica o login e cria array de login
$cVLogin->loginSession("0");//faz a atualização de session do login atual
$cVLogin->loginVerificaSenhaExpirou();//verifica se a senha de login expirou, redireciona para página de alteração
//CLASSES PROTEGE PAGINA/LOGIN ---<<<


//INCLUDE FAISHER, CONTROLE DE ARQUIVOS
$SYS_VALIDASEMQUADRO = "Jesus te Ama!";



//vars de montagem
	$vars_p = getpost_sql($_POST["vars"]);	
	$ajax_p = getpost_sql($_POST["ajax"]);
	
?>
<!doctype html>
<html><head>
<?php

//include HEAD html
include "index_head.php";//classes de conexao




?>
<script>
$(document).ready(function() {
	faisher_ajax('divPrincipalRelatorio', 'div_load', 'ajax/faisher.php', 'ajax=<?=$ajax_p?>&<?=$vars_p?>');	
	
	// Radialize the colors
    Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
        return {
            radialGradient: { cx: 0.5, cy: 0.3, r: 0.7 },
            stops: [
                [0, color],
                [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
            ]
        };
    });//*/
});
$(window).resize(function(){ ajustaDivWin(); });
function ajustaDivWin(){
	pg_w = $(window).width();
	pg_h = $(window).height();
	$(".windiv").width(pg_w);
	$(".windiv").height(pg_h);
	$(".windivIn").height(pg_h-20);
}


$.doTimeout('vTimerTimeActive', 5000, function(){
	faisher_ajax('div_auxiliar', '0', 'geral/index_time_ajax.php', 'ajax=time&hide=1', 'get', 'ADD');
	return true;
});//TIMER

//acoes de sessao ativa
$(document).keyup(function(e){ ativarSession(); });
$(document).click(function(){ ativarSession(); });
$(document).scroll(function(){ ativarSession(); });
$(document).mousemove(function(event){ ativarSession(); });
</script>
<style>
.cssFonteMai{ text-transform:uppercase; }
.cssFonteMin{ text-transform:lowercase; }
</style>
</head>
<body style="overflow:hidden;">
<div id="divPrincipalRelatorio">
</div>

<div class="locked" id="divLoginBloq">
	<div class="wrapper">
		<div class="pull-left">
			<img src="img.php?<?=$cVLogin->imgUser($cVLogin->getVarLogin("SYS_USER_ID"), "200", "200")?>" alt="" width="200" height="200">
			<a href="login.php?<?=$class_fLNG->txt(__FILE__,__LINE__,'sair')?>=1"><?=$class_fLNG->txt(__FILE__,__LINE__,'Mudar de Usuário?')?></a>
		</div>
		<div class="right">
			<div class="upper">
				<h2><?=sentenca(primeiro_nome($cVLogin->getVarLogin("SYS_USER_NOME"),"2"))?></h2>
				<span class="divload"><?=$class_fLNG->txt(__FILE__,__LINE__,'Bloqueado')?></span>
			</div>
			<form method='get' onSubmit="return false;" autocomplete="off">
				<input id="bloqPassFull" name="bloqPassFull" type="password" autocomplete="off" placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Sua senha de acesso')?>">
				<div>
					<input type="submit" value="<?=$class_fLNG->txt(__FILE__,__LINE__,'Desbloquear')?>" onClick="$('#divLoginBloq .divload').html('<?=$class_fLNG->txt(__FILE__,__LINE__,'Verificando...')?>');faisher_ajax('divLoginBloqOculta', '0', 'ajax/login_ajax.php?ajax=desbloqsession', 'bloqpass='+$('#bloqPassFull').val(),'post');return false;" class='btn btn-inverse'>
				</div>
			</form>
            <div style="width:1px; height:1px; display:none;" id="divLoginBloqOculta"></div>
		</div>
	</div>	
</div>   

<div class="fulldiv" id="div_load" style="position:absolute; line-height:500px; color:#FFF; top:0; left:0; z-index:9999; background:url(img/shadows/b30.png) repeat; text-align:center;"><img src="img/ajax-loader.gif">&nbsp;&nbsp;<?=$class_fLNG->txt(__FILE__,__LINE__,'Aguarde, estamos organizando os dados...')?></div>
<div style="width:1px; height:1px; display:none;" id="div_auxiliar"></div>
<div style="width:1px; height:1px; display:none;" id="div_oculta"></div>
<input id="abaActive" name="abaActive" type="hidden" value="In-home">
<input id="timeActive" name="timeActive" type="hidden" value="<?=time()+10?>">
	</body>
	</html>
<?php






//REMOVE CONEXAO
//fecha todas as conexoes abertas
$classe_db->FechaConexaoAll($SCRIPTOFF);//fecha conexoes
?>