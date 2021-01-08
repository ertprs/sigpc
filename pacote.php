<?php // Breno Cruvinel - breno.cruvinel09@gmail.com
//ini_set('display_errors',1);ini_set('display_startup_erros',1);error_reporting(E_ALL);
//INCLUDES DE CONTROLE --->>>
include "config/globalSession.php";//inicia sessao php
include "config/globalVars.php";//vars padrao
include "sys/langAction.php";//vars padrao
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
$cVLogin->loginCookie("OFF");//verifica o login e cria array de login
$cVLogin->loginSession("perfil","OFF");//faz a atualização de session do login atual
$cVLogin->loginVerificaSenhaExpirou();//verifica se a senha de login expirou, redireciona para página de alteração
//CLASSES PROTEGE PAGINA/LOGIN ---<<<


//INCLUDE FAISHER, CONTROLE DE ARQUIVOS
$SYS_VALIDASEMQUADRO = "Jesus te Ama!";









//faz seleção do perfil
if(isset($_GET["perfil_sel"])){
	$perfil_sel = fGERAL::cptoFaisher($_GET["perfil_sel"], "dec");
	if($cVLogin->selecionarPacote($perfil_sel)){
		//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
		$cMSG->addMSG("SUCESSO","Tudo certo! Aguarde, já estamos montando o seu painel!");
?><script>
$.doTimeout('vTimerDefalt', 500, function(){
	$('#div_principalContent_loadD').fadeIn();	
	$.doTimeout('vTimerDefalt', 1000, function(){ window.location='./?seja_bem_vindo'; });//TIMER
});//TIMER
</script>
<?php
	}else{
?><script>
$.doTimeout('vTimerDefalt', 500, function(){
exibNotificacao('Opss... Algo errado!','Verifique se selecionou corretamente abaixo as opções disponíveis para você!');
exibMensagem('titulo_principal','erro','Pacote não encontrado para este usuário!');
});//TIMER
</script>
<?php
	}//if($cVLogin->selecionarPacote($sel)){*/
		

	//MOSTRAR TODAS AS MENSAGENS CRIADAS -------------------------- CLASSE MENSAGENS ----------------------- ||||||||||||||
	$cMSG->imprimirMSG();//imprimir mensagens criadas

	//REMOVE CONEXAO
	//fecha todas as conexoes abertas
	$classe_db->FechaConexaoAll($SCRIPTOFF);//fecha conexoes
	exit(0);
}//fim if(isset($_GET["perfil_sel"])){




















?>
<!doctype html>
<html><head>
<?php

//include HEAD html
include "index_head.php";//classes de conexao


?>

<script>
$(document).ready(function() {
	loaderFoco('content','div_principalContent_loadD','Verificando...');
	if(getCookieF('SYS_LOGIN_BLOQ') != "0"){ setCookieF('SYS_LOGIN_BLOQ', '<?=time()+300?>'); }
});
</script>
</head>

<body class="<?php if((fGERAL::getKookies("CONF_BODY_COLOR")) and (fGERAL::getKookies("CONF_BODY_COLOR") != "")){ echo fGERAL::getKookies("CONF_BODY_COLOR"); }else{ echo 'theme-satgreen';}?>">
	<div id="navigation">
		<div class="container-fluid">
			<a href="./" id="brand"><!-- LOGO --></a>
			<ul class='main-nav' id="menu_principalTop">
				<li class='active' id="li_topInicio">
					<a href="?">
						<span>Perfil de Acesso</span>
					</a>
				</li>



			</ul>
			<div class="user">
				<ul class="icon-nav">
					<li class='dropdown colo'>
						<a href="#" class='dropdown-toggle' data-toggle="dropdown"><i class="icon-tint"></i></a>
						<ul class="dropdown-menu pull-right theme-colors">
							<li class="subtitle">
								Cor das janelas
							</li>
							<li>
								<span class='red'></span>
								<span class='orange'></span>
								<span class='green'></span>
								<span class="brown"></span>
								<span class="blue"></span>
								<span class='lime'></span>
								<span class="teal"></span>
								<span class="purple"></span>
								<span class="pink"></span>
								<span class="magenta"></span>
								<span class="grey"></span>
								<span class="darkblue"></span>
								<span class="lightred"></span>
								<span class="lightgrey"></span>
								<span class="satblue"></span>
								<span class="satgreen"></span>
							</li>
						</ul>
					</li>
				</ul>
				<div class="dropdown">
					<a href="#" class='dropdown-toggle' data-toggle="dropdown"><?=sentenca(primeiro_nome($cVLogin->getVarLogin("SYS_USER_NOME")))?> <img src="img.php?<?=$cVLogin->imgUser($cVLogin->getVarLogin("SYS_USER_ID"), "27", "27")?>" class="sys_imgPerfil" alt=""></a>
					<ul class="dropdown-menu pull-right">
						<li>
							<a href="login.php?sair=1">Sair do Sistema</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid" id="content">

		<div id="main">
<?php

$exibir_lista_perfil = "1"; $aviso = "";
//verifica período de atividade
$time_15dias = strtotime("+15 days");	
if((isset($_SESSION["SYS_PERIODO_ATIVIDADE"])) and ($_SESSION["SYS_PERIODO_ATIVIDADE"] < $time_15dias)){
	$aviso = '<span class="badge badge-warning">SEU PERÍODO DE ATIVIDADE FINALIZA EM'.difHoraTime(time(), $_SESSION["SYS_PERIODO_ATIVIDADE"],0,"").'</span>';
	if($_SESSION["SYS_PERIODO_ATIVIDADE"] < time()){
		$exibir_lista_perfil = "0";
?>
			<div class="container-fluid" style="margin-top:10%;">
							<div class="box box-color box-bordered red span12">
								<div class="box-title">
									<h3><i class="icon-bell"></i> SEU PERÍODO DE ATIVIDADE CHEGOU AO FIM!</h3>
								</div>
								<div class="box-content">
									<p></p>
                                    <h2>Olá <?=sentenca(primeiro_nome($cVLogin->getVarLogin("SYS_USER_NOME")))?>, desculpe! :)</h2>
                                    <h4>
										<p></p>
										<p>Seu período de atividade (duração do seu acesso) ao sistema, chegou ao fim!</p>
                                        <p>SEU ACESSO AO SISTEMA FOI "PAUSADO" ATÉ QUE A EQUIPE DE TI REALIZE UMA NOVA ATIVAÇÃO!</p>
                                        <p></p>
	                                    <h3>*Entre em contato com a equipe de TI para solicitar a renovação do período.</h3>
                                    </h4>
                                </div>
							</div>
			</div>
<?php	
	}//if($_SESSION["SYS_PERIODO_ATIVIDADE"] < time()){
}//if((isset($_SESSION["SYS_PERIODO_ATIVIDADE"])) and ($_SESSION["SYS_PERIODO_ATIVIDADE"] < $time_15dias)){
//echo "PER: ".$_SESSION["SYS_PERIODO_ATIVIDADE"];


if($exibir_lista_perfil == "1"){
?>


			<div class="container-fluid">
            
				<div class="page-header">
					<div class="pull-left">
						<h1 id="titulo_principal"><i class="icon-angle-right"></i> Selecione um perfil de acesso disponível: <?=$aviso?></h1>
					</div>					
				</div>
				<div class="page-header" id="divPacote"> </div>
                
				<div class="row-fluid" style="min-height:400px;" id="div_principalContent">
					<!-- conteudo principal -->
			       <div class="principalContent" id="content_In-home">
                   
<?php

$perfil_login = "0";
//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
$resu1 = fSQL::SQL_SELECT_SIMPLES("P.id,P.perfil_id,P.permissao_grupo_id,O.nome,O.apelido,O.status", "sys_login_pacote P, sys_perfil O", "P.usuarios_id = '".$cVLogin->getVarLogin("SYS_USER_ID")."' AND P.perfil_id = O.id", "GROUP BY P.id ORDER BY O.id ASC", "100");
while($linha = fSQL::FETCH_ASSOC($resu1)){
	$id_login = $linha["id"];
	$perfil_id_login = $linha["perfil_id"];
	$perfil_nome_login = $linha["nome"];
	$perfil_apelido_login = $linha["apelido"];
	$perfil_status_login = $linha["status"];
	$permissao_grupo_id_login = $linha["permissao_grupo_id"];
	$perfil_login++;

?>

				<div class="row-fluid">
					<div class="span9">
								<ul class="stats" style="cursor:pointer; width:95%;" onClick="<?php
                                if($perfil_status_login == "1"){
									?>faisher_ajax('divPacote', 'div_principalContent_loadD', 'pacote.php', 'perfil_sel=<?=fGERAL::cptoFaisher($id_login, "enc")?>');<?php
                                }elseif($perfil_status_login == "2"){
									?>faisher_ajax('divPacote', 'div_principalContent_loadD', 'pacote.php', 'perfil_sel=<?=fGERAL::cptoFaisher($id_login, "enc")?>');<?php
                                }else{
									echo "alert('Entre em contato com a equipe de gestão de tecnologia...')";
								}?>">
									<li class='<?php if($perfil_status_login == "1"){ echo 'blue';  }elseif($perfil_status_login == "2"){ echo 'orange'; }else{ echo 'grey'; }?>' style="cursor:pointer; width:95%;">
										<i class="<?=fGERAL::icoPerfil($perfil_id_login)?>" <?php if(preg_match("/glyphicon/", fGERAL::icoPerfil($perfil_id_login))){echo 'style="margin-top:10px;"'; }?>></i>
										<div class="details">
											<span class="big"><?=$perfil_apelido_login?></span>
											<span><?=$perfil_id_login.". ".$perfil_nome_login?></span>
										</div>
									</li>
								</ul>
                                <?php if($perfil_status_login == "0"){?><button class="btn btn-inverse">PERFIL BLOQUEADO PELO ADMINISTRADOR DE TI :)</button><?php }?>
                                <?php if($perfil_status_login == "2"){?><button class="btn btn-orange">PERFIL COM ACESSO LIMITADO :)</button><?php }?>
					</div>
				</div>
                <div style="height:50px;"></div>

<?php

}//fim while


if($perfil_login == "0"){
	
?>
				<div class="row-fluid">
					<div class="span9">
								<ul class="stats" style="width:95%;">
									<li class='orange' style="width:95%;">
										<i class="icon-question-sign"></i>
										<div class="details">
											<span class="big">Sem permissões de acesso</span>
											<span>Contate o administrador de seu departamento</span>
										</div>
									</li>
								</ul>
					</div>
				</div>
                <div style="height:50px;"></div>
<?php
}//fim if $perfil_login

?>                   
                   
                   </div>

				</div>

			</div>
<?php

}//if($exibir_lista_perfil == "1"){



?>
		</div></div>
<div id="div_principalContent_load" style="line-height:250px; width:400px; height:250px; margin:-125px 0 0 -200px; position:fixed; top:50%; left:50%; z-index:9999; background:url(img/shadows/b30.png) repeat; text-align:center; color:#FFF; border:#000 2px solid; display:none;"><img src="img/ajax-loader.gif">&nbsp;&nbsp;<span id="div_principalContent_loadmsg">Filtrando dados...</span></div>



 

       
<div style="width:1px; height:1px; position:absolute;" id="div_auxiliar"></div>
<div style="width:1px; height:1px; display:none;" id="div_oculta"></div>
<input id="abaActive" name="abaActive" type="hidden" value="In-home">
	</body>
	</html>
<?php






//REMOVE CONEXAO
//fecha todas as conexoes abertas
$classe_db->FechaConexaoAll($SCRIPTOFF);//fecha conexoes
?>