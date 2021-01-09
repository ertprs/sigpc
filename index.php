<?php // Breno Cruvinel - breno.cruvinel09@gmail.com
//ini_set('display_errors',1);ini_set('display_startup_erros',1);error_reporting(E_ALL);
//INCLUDES DE CONTROLE --->>>
include "config/globalSession.php";//inicia sessao php
include "config/globalVars.php";//vars padrao
include "sys/langAction.php";//inicia arquivo de linguage
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



forceHttps();//@@@@@@ FORÇAR O HTTPS +++++

//verifica se recebeu link de confirmação de email
if(isset($_GET["v"])){
	echo "<script>window.location='./login.php?v=".$_GET["v"]."';</script>";
	exit(0);
}//if(isset($_GET["v"])){
if(isset($_GET["l"])){
	echo "<script>window.location='./login.php?l=".$_GET["l"]."';</script>";
    exit(0);
}//if(isset($_GET["l"])){

//caminho do arquivo de tradução do menu
$_FILE_M = __DIR__.DIRECTORY_SEPARATOR.'ajax'.DIRECTORY_SEPARATOR.'faisher.php';
//INICIAR ARQUIVO DE LINGUAGEM --->>>
$class_fLNG->loadFile($_FILE_M);//incluir o arquivo de linguagem
//INICIAR ARQUIVO DE LINGUAGEM ---<<<

	
//INICIAR CLASSES DE CONTROLE --->>>
//conexao DB
$classe_db = new classe_DB;//inicia a classe de conexao
$classe_db->AbreConexaoPai();//Abrimos a conexão Pai
$cMSG = new classMSG();//inicia a classe de mensagens
//INICIAR CLASSES DE CONTROLE ---<<<
















//echo "<pre>"; print_r(unserialize($cVLogin->getVarLogin("SYS_USER_TAGS"))); echo "</pre>";
?>
<!doctype html>
<html><head>
<?php

//INCLUDE FAISHER, CONTROLE DE ARQUIVOS
$SYS_VALIDASEMQUADRO = "Jesus te Ama!";



//include HEAD html
$INC_FUNCTION_INDEX = "ON";//FUNÇÃO PG INDEX
include "index_head.php";//classes de conexao


//CLASSES PROTEGE PAGINA/LOGIN --->>>
//protege a pagina
$cVLogin = new classVLOGIN;//inicia a classe de login
$cVLogin->loginCookie();//verifica o login e cria array de login
$cVLogin->loginSession("0");//faz a atualização de session do login atual
$cVLogin->loginVerificaSenhaExpirou();//verifica se a senha de login expirou, redireciona para página de alteração
//CLASSES PROTEGE PAGINA/LOGIN ---<<<













?>
<style>
.cssFonteMai{ text-transform:uppercase; }
.cssFonteMin{ text-transform:lowercase; }
</style>
</head>
<body class="<?php if((fGERAL::getKookies("CONF_BODY_COLOR")) and (fGERAL::getKookies("CONF_BODY_COLOR") != "")){ echo fGERAL::getKookies("CONF_BODY_COLOR"); }else{ echo 'theme-satgreen';}?>">
	<div id="navigation">
		<div class="container-fluid" style="padding:0px;">
			<a href="?" id="brand" style="background-color:#FFF !important; height:40px; left:0px; margin-right:5px;"><img src="../img/logo.png"/></a>
			<a href="#" class="toggle-nav" rel="tooltip" id="recuardiv" data-placement="bottom" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Ocultar/Exibir Janelas')?>"><i class="icon-reorder"></i></a>
<script>
$(document).ready(function(e) {
    $('#recuardiv').click();
	$('#recuardiv').hide();
});
</script>            
			<ul class='main-nav' id="menu_principalTop">
				<li class='active' id="li_topInicio">
					<a href="#" onClick="faisher_ajaxAba('Inicio', '<?=$class_fLNG->txt(__FILE__,__LINE__,'Hoje (meus afazeres)')?>', 'home', '');">
						<span><?=$class_fLNG->txt(__FILE__,__LINE__,'Início')?></span>
					</a>
				</li>



<?php
//----------------------------------------------------ini CLASS
$cMenu = new classMENU;//inicia a classe de MENU

//busca dados do MENU GUIA
$resu = fSQL::SQL_SELECT_SIMPLES("id,nome_max,nome_min,file_id,varget", "sys_menu_guia", "", "ORDER BY ordem ASC");
while($linha = fSQL::FETCH_ASSOC($resu)){
	$id_G = $linha["id"];
	$nome_max_G = $class_fLNG->txt($_FILE_M,__LINE__,$linha["nome_max"]);
	$nome_min_G = $class_fLNG->txt($_FILE_M,__LINE__,$linha["nome_min"]);
	$file_id_G = $linha["file_id"];
	$varget_G = $linha["varget"];
	//GUIA
	$cMenu->addMENU($id_G,$nome_max_G,$nome_min_G);//guia

	//busca dados do GUIA > MENU
	$resu1 = fSQL::SQL_SELECT_SIMPLES("id,nome_max,nome_min,file_id,varget", "sys_menu_guia_menu", "guia_id = '".$id_G."'", "ORDER BY ordem ASC");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$id_M = $linha1["id"];
		$nome_max_M = $class_fLNG->txt($_FILE_M,__LINE__,$linha1["nome_max"]);
		$nome_min_M = $class_fLNG->txt($_FILE_M,__LINE__,$linha1["nome_min"]);
		$file_id_M = $linha1["file_id"];
		$varget_M = $linha1["varget"];
		$include_M = ""; $tag_M = ""; $exib_M = "1";
		if($file_id_M >= "1"){
			$resui = fSQL::SQL_SELECT_SIMPLES("include,permissao_tag", "sys_menu_files", "id = '$file_id_M'", "");
			while($linhai = fSQL::FETCH_ASSOC($resui)){
				$include_M = $linhai["include"];
				$tag_M = $linhai["permissao_tag"];
			}//fim while
			if($cVLogin->loginAcesso($tag_M)){ $exib_M = "1"; }else{ $exib_M = "0"; }
		}//if($file_id_M >= "1"){

		//MENU
		if($exib_M == "1"){
			$cMenu->addItemMENU($id_G,$id_M,$nome_max_M,$nome_min_M,$include_M,$varget_M);//menu	
			//busca dados do GUIA > MENU > SUBMENU
			$resu2 = fSQL::SQL_SELECT_SIMPLES("id,nome_max,nome_min,file_id,varget", "sys_menu_guia_menu_submenu", "guia_menu_id = '".$id_M."'", "ORDER BY ordem ASC");
			while($linha2 = fSQL::FETCH_ASSOC($resu2)){
				$id_SM = $linha2["id"];
				
				if($id_SM == "140" and $cVLogin->getVarLogin("SYS_USER_ID") != "1"){ continue; }//Tipos de Solicitação de Processo
				if($id_SM == "555" and $cVLogin->getVarLogin("SYS_USER_ID") != "1"){ continue; }//Gerenciar Perfils de Gestão			
				
				$nome_max_SM = $class_fLNG->txt($_FILE_M,__LINE__,$linha2["nome_max"]);
				$nome_min_SM = $class_fLNG->txt($_FILE_M,__LINE__,$linha2["nome_min"]);
				$file_id_SM = $linha2["file_id"];
				$varget_SM = $linha2["varget"];
				$include_SM = ""; $tag_SM = ""; $exib_SM = "1";
				
				if($file_id_SM >= "1"){
					$resui = fSQL::SQL_SELECT_SIMPLES("include,permissao_tag", "sys_menu_files", "id = '$file_id_SM'", "");
					while($linhai = fSQL::FETCH_ASSOC($resui)){
						$include_SM = $linhai["include"];
						$tag_SM = $linhai["permissao_tag"];
					}//fim while
					if($cVLogin->loginAcesso($tag_SM)){ $exib_SM = "1"; }else{ $exib_SM = "0"; }
				}//if($file_id_SM >= "1"){
				//SUBMENU
				if($exib_SM == "1"){
					$valida = "1";
					if($cVLogin->getVarLogin("SYS_USER_ID") != "1" and $file_id_SM == "28"){ $valida = "0"; }//departamentos internos
					if($cVLogin->getVarLogin("SYS_USER_ID") != "1" and $file_id_SM == "705"){ $valida = "0"; }//perfils de gestão
					if($cVLogin->getVarLogin("SYS_USER_ID") != "1" and $id_SM == "187"){ $valida = "0"; }//parametros de candidato
					if($valida == "1"){ 
						$cMenu->addItemSUBMENU($id_G,$id_M,$id_SM,$nome_max_SM,$nome_min_SM,$include_SM,$varget_SM);// submenu 
					}
				
					//busca dados do GUIA > MENU > SUBMENU > SUBMENU EXTRA
					$resu3 = fSQL::SQL_SELECT_SIMPLES("id,nome_max,nome_min,file_id,varget", "sys_menu_guia_menu_submenu_submenuextra", "guia_menu_submenu_id = '".$id_SM."'", "ORDER BY ordem ASC");
					while($linha3 = fSQL::FETCH_ASSOC($resu3)){
						$id_SMEX = $linha3["id"];
						$nome_max_SMEX = $class_fLNG->txt($_FILE_M,__LINE__,$linha3["nome_max"]);
						$nome_min_SMEX = $class_fLNG->txt($_FILE_M,__LINE__,$linha3["nome_min"]);
						$file_id_SMEX = $linha3["file_id"];
						$varget_SMEX = $linha3["varget"];
						$include_SMEX = ""; $tag_SMEX = ""; $exib_SMEX = "1";
						if($file_id_SMEX >= "1"){
							$resui = fSQL::SQL_SELECT_SIMPLES("include,permissao_tag", "sys_menu_files", "id = '$file_id_SMEX'", "");
							while($linhai = fSQL::FETCH_ASSOC($resui)){
								$include_SMEX = $linhai["include"];
								$tag_SMEX = $linhai["permissao_tag"];
							}//fim while
							if($cVLogin->loginAcesso($tag_SMEX)){ $exib_SMEX = "1"; }else{ $exib_SMEX = "0"; }
						}//if($file_id_SMEX >= "1"){
						//SUBMENU EXTRA
						if(($exib_SMEX == "1") and ($include_SMEX != "")){
							$valida = "1";
							if($cVLogin->getVarLogin("SYS_USER_ID") != "1" and $file_id_SMEX == "1"){ $valida = "0"; }//grupos de acesso
							if($cVLogin->getVarLogin("SYS_USER_ID") != "1" and $file_id_SMEX == "60"){ $valida = "0"; }//expediente
							if($valida == "1"){
								$cMenu->addItemSUBMENUEXTRA($id_G,$id_M,$id_SM,$id_SMEX,$nome_max_SMEX,$nome_min_SMEX,$include_SMEX,$varget_SMEX);// submenuextra
							}
						}//if($exib_SMEX == "1"){
							
					}//fim while SUBMENU EXTRA
				}//if($exib_SM == "1"){
					
			}//fim while SUBMENU
		}//if($exib_M == "1"){
			
	}//fim while MENU
}//fim while GUIA





/*/~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ inicio menu - perfil ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~|||--->>>
$idPM = "1";// id de perfil: TI
if($cVLogin->loginAcessoPerfil($idPM)){
//MENU
$idM = "Cadastro"; $cMenu->addMENU($idM,"Cadastros","Cadastro");
	//MENULIST
	$idiM = "CadastroUsuarios";	$cMenu->addItemMENU($idM,$idiM,"Gerenciar Acessos ao Sistema","Gestão Acessos","","");//menulist
		//SUBMENU
		$idPer = "1_adm_permissao_grupos"; $idiSM = "CadastroGrupoAcesso"; $cMenu->addItemSUBMENU($idM,$idiM,$idiSM,"Gerenciar Grupos de Acessos","Grupos de Acesso",$idPer,"");// submenu
		$idPer = "1_adm_usuarios"; if($cVLogin->loginAcesso($idPer)){
			$idiSM = "CadastroUsuarios"; $cMenu->addItemSUBMENU($idM,$idiM,$idiSM,"Gerenciar Usuários do Sistema","Gestão Usuários",$idPer,"");// submenu
		}



}//fim if($cVLogin->loginAcessoPerfil($idPM)){ */
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ fim menu - perfil ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~|||---<<<
















//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ inicio menu - PADRAO ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~|||--->>>
//GUIA
$idM = "Ajustes"; $cMenu->addMENU($idM,$class_fLNG->txt(__FILE__,__LINE__,'Ajustes'),$class_fLNG->txt(__FILE__,__LINE__,'Ajuste'));
	//MENU
	$idiM = "AjustesMeusDados";	$cMenu->addItemMENU($idM,$idiM,$class_fLNG->txt(__FILE__,__LINE__,'Meus Dados'),$class_fLNG->txt(__FILE__,__LINE__,'Meus Dados'),"","");//menu
		//SUBMENU
		$idiSM = "AjustesMeusDadosEdit"; $cMenu->addItemSUBMENU($idM,$idiM,$idiSM,$class_fLNG->txt(__FILE__,__LINE__,'Editar Meus Dados'),$class_fLNG->txt(__FILE__,__LINE__,'Meus Dados'),"sys_meusdados","");// submenu
		$idiSM = "AjustesMeusDadosSenha"; $cMenu->addItemSUBMENU($idM,$idiM,$idiSM,$class_fLNG->txt(__FILE__,__LINE__,'Alterar Minha Senha'),$class_fLNG->txt(__FILE__,__LINE__,'Alterar Senha'),"sys_meusdados","alterasenha=1");// submenu
	//MENU
	$idiM = "AjustesSobreSistema";	$cMenu->addItemMENU($idM,$idiM,$class_fLNG->txt(__FILE__,__LINE__,'Sobre')." ".SYS_CLIENTE_NOME_RESUMIDO,$class_fLNG->txt(__FILE__,__LINE__,'Sobre'),"sys_sobre","");//menu



//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ fim menu - PADRAO ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~|||---<<<




/*/####################### item MENU ######################|||||||||>>>>
//GUIA
$idM = "Cadastro";			$cMenu->addMENU($idM,"Cadastros","Cadastro");//menu
	//MENU
	$idiM = "CadastroPessoas";	$cMenu->addItemMENU($idM,$idiM,"Cadastro Geral de Pessoas","Cadastro Pessoas","faisherID","nome=ok&sobrenome=okk");//item do menulist
	$idiM = "CadastroAnimais";	$cMenu->addItemMENU($idM,$idiM,"Cadastro Geral de Animais","Cadastro Animais","","");//item para guia de submenu
		//SUBMENU
		$idiSM = "Mamifero"; 		$cMenu->addItemSUBMENU($idM,$idiM,$idiSM,"Animal Mamifero","Mamífero","fmamifero","super=mamifero");// submenu
			//SUBMENUEXTRA
			$idiSMEX = "AjustesMeusDadosEditOn"; $cMenu->addItemSUBMENUEXTRA($idM,$idiM,$idiSM,$idiSMEX,"Ligar ON","On","sys_meusdados","");// submenu
			$idiSMEX = "AjustesMeusDadosEditOff"; $cMenu->addItemSUBMENUEXTRA($idM,$idiM,$idiSM,$idiSMEX,"Desligar OFF","Off","sys_meusdados","alterasenha=1");// submenu
//####################### FIM item MENU ######################|||||||||<<<<<*/



//----------------------------------------------------print CLASS
//imprime menu montado
echo $cMenu->imprimirMENU();
?>


<?php if($cVLogin->getVarLogin("SYS_USER_PERFIL") > "1"){
	$linha = fSQL::SQL_SELECT_ONE("id","sys_login_pacote","usuarios_id = '".$cVLogin->getVarLogin("SYS_USER_ID")."' and perfil_id = '2'");
	$pacote_perfil_2 = $linha["id"];
	$linha = fSQL::SQL_SELECT_ONE("id","sys_login_pacote","usuarios_id = '".$cVLogin->getVarLogin("SYS_USER_ID")."' and perfil_id = '1'");
	$pacote_perfil_1 = $linha["id"];	
	?>                        
	<?php if($cVLogin->getVarLogin("SYS_USER_PERFIL_ID") == "1"){?>
    	<?php if($cVLogin->getVarLogin("SYS_USER_CARGO") != "AUTO-ÉCOLE" and $cVLogin->getVarLogin("SYS_USER_CARGO") != "CLINIQUE MÉDICALE"){?>
				<li>
					<!--<a href="#" onClick="window.location='./pacote.php?perfil_sel_index=<?=$pacote_perfil_2?>';">-->
                    <a href="#" onClick="faisher_ajax('div_pacote', 'pacoteLoader', 'pacote.php', 'perfil_sel=<?=fGERAL::cptoFaisher($pacote_perfil_2, "enc")?>');">
						<span><?=$class_fLNG->txt(__FILE__,__LINE__,'ADMINISTRAÇÃO PROCESSOS')?> <img src="img/ajax-qloader-preto-p.gif" id="pacoteLoader" style="display:none;"/></span>
					</a>
				</li> 
    	<?php }//if($cVLogin->getVarLogin("SYS_USER_CARGO") != "AUTO-ÉCOLE" and $cVLogin->getVarLogin("SYS_USER_CARGO") != "CLINIQUE MÉDICALE"){?>
	<?php }else{//if($cVLogin->getVarLogin("SYS_USER_PERFIL_ID") == "1"){?>                                
				<li>
					<a href="#" onClick="faisher_ajax('div_pacote', 'pacoteLoader', 'pacote.php', 'perfil_sel=<?=fGERAL::cptoFaisher($pacote_perfil_1, "enc")?>');">
						<span><?=$class_fLNG->txt(__FILE__,__LINE__,'ADMINISTRAÇÃO TI')?></span>
					</a>
				</li>
    
	<?php }//}else{//if($cVLogin->getVarLogin("SYS_USER_PERFIL_ID") == "1"){?>                                                            
<?php }//if($cVLogin->getVarLogin("SYS_USER_PERFIL") > "1"){?>    





			</ul>
			<div class="user">
				<ul class="icon-nav">
					<li class='dropdown colo'>
						
						<a href="#" class='dropdown-toggle' data-toggle="dropdown"><i class="icon-tint"></i></a>
						<ul class="dropdown-menu pull-right theme-colors">
							<li class="subtitle">
								<?=$class_fLNG->txt(__FILE__,__LINE__,'Cor das janelas')?>
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
                    <!--<li class='dropdown colo'>
						<a href="#" onClick="$('#div_mapamenugeral').fadeIn(function(){ ajustaDivFull(); });return false;"><i class="icon-sitemap"></i></a>
					</li>-->

				</ul>
                


				<div class="dropdown">
					<a href="#" class='dropdown-toggle' data-toggle="dropdown"><?=sentenca(primeiro_nome($cVLogin->getVarLogin("SYS_USER_NOME")))?> <img src="img.php?<?=$cVLogin->imgUser($cVLogin->getVarLogin("SYS_USER_ID"), "27", "27")?>" class="sys_imgPerfil" alt="" width="27" height="27"></a>
					<ul class="dropdown-menu pull-right">
						<li>
							<a href="#" onClick="bloqSession();return false;"><i class="glyphicon-lock"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Bloquear Sessão')?></a>
						</li>
						<li>
							<a href="#" onClick="faisher_ajaxAba('Ajustes', '<?=$class_fLNG->txt(__FILE__,__LINE__,'Meus Dados')?>', 'sys_meusdados', '');return false;"><i class="glyphicon-user"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Meu Perfil (alterar foto)')?></a>
						</li>
						<li>
							<a href="#" onClick="faisher_ajaxAba('Ajustes', '<?=$class_fLNG->txt(__FILE__,__LINE__,'Meus Dados')?>', 'sys_meusdados', 'alterasenha=1');return false;"><i class="glyphicon-keys"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Alterar Minha Senha')?></a>
						</li>
						<li>
							<a href="login.php?sair=1"><i class="icon-off"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Sair do Sistema')?></a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
    <button class="btn" style="width:100%; text-align:left; display:none;" <?php if($cVLogin->getVarLogin("SYS_USER_PERFIL") > "1"){?>onClick="window.location='pacote.php';" <?php }?>id="btAlteraOrgao"><i class="<?=fGERAL::icoPerfil($cVLogin->getVarLogin("SYS_USER_PERFIL_ID"))?>"></i> <?=maiusculo($cVLogin->getVarLogin("SYS_USER_PERFIL_NOME"))?> &nbsp;&nbsp;&nbsp;<?php if($cVLogin->getVarLogin("SYS_USER_PERFIL_ID") > "1"){?><i class="icon-caret-down"></i><?php }?></button>
	<div class="container-fluid" id="content">
		<div style="position:fixed;" id="left">
        	<div style="height:40px; background:#999; cursor:pointer;" onClick="$('html,body').stop().animate({scrollTop:0},800);" rel="tooltip" data-placement="bottom" data-original-title="Subir ao topo">
            	<div style="width:144px; height:37px; background:url(img/logo.png) no-repeat; margin-left:20px; float:left;"></div>
                <i class="icon-circle-arrow-up" style="font-size:36px; color:#FFF; float:right; margin-right:5px;"></i>
                <div style="clear:both;"></div>
            </div>
			<h4 style="text-align:center;">
				Janelas Abertas (<span id="abaQTD">0</span>)
			</h4>
			<div class="subnav" id="abaInicio">
				<div class="subnav-title">
					<a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span><?=$class_fLNG->txt(__FILE__,__LINE__,'Início')?></span></a>
				</div>
				<ul class="subnav-menu" id="ul_abaInicio">
					<li class="menuTab menuTab-ativo" data-id="Inicio" id="In-home"><a href="#" onClick="selecAba('In-home');return false;"><span class="glyphicon-imac"></span>&nbsp;<?=$class_fLNG->txt(__FILE__,__LINE__,'Hoje (meus afazeres)')?> </a></li>
				</ul>
			</div>
<?php


//####################### item abas MENU ######################|||||||||>>>>
//continua a classe de MENU
$cMenu->imprimirAbasMENU();
//####################### FIM item abas MENU ######################|||||||||<<<<<

?>
			<div style="position:absolute; left:0; bottom:0; width:100%; z-index:999999999;"><div style="font-size:9px; height:10px;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Perfil')?>: </div><?=SYS_CLIENTE_NOME_RESUMIDO?></div>
			
		</div>
		<div id="main">
			<div class="container-fluid">
            
				<div class="page-header">
					<div class="pull-left">
						<h1 id="titulo_principal"><?=$class_fLNG->txt(__FILE__,__LINE__,'Início')?></h1>
					</div>
					<div class="pull-right">
						<ul class="stats">
                        	<li class='white' style="display:none" id="div_pacote">
							</li>
						</ul>
					</div>                    
				</div>
                
				<div class="breadcrumbs" id="div_sys_mapa">
					<ul id="sys_mapa">
                   <!-- carrega mapa -->
					</ul>
					<div class="fechar-bread" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Fechar Aba Atual')?>" data-placement="left">
						<a href="#" onClick="fechaAba($('#abaActive').val());return false;"><i class="icon-remove"></i></a>
					</div>
				</div>

				<div class="row-fluid" style="min-height:400px;" id="div_principalContent">
					<!-- conteudo principal -->
			       <div class="principalContent" id="content_In-home"><br><br><?=$class_fLNG->txt(__FILE__,__LINE__,'Montando seu painel, aguarde...')?> :)</div>

				</div>

			</div>
		</div></div>


<div id="pModal" class="modal hide fade" style="overflow:hidden;" tabindex="-1" role="dialog" aria-labelledby="pModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-header">
        <button type="button" class="close esconde-pModal icon-remove-sign" data-dismiss="modal" aria-hidden="true" style="margin:0; font-size:32px;" rel="tooltip" data-placement="left" data-original-title="Fechar"></button>
        <h3 id="pModalTitulo" style="cursor:move;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Titulo')?></h3>
    </div>
    <div id="pModalLoader" style="text-align:center; padding:20px; display:none;"><img src="img/ajax-p-loader.gif"> <span id="pModalLoadermsg"></span></div>
    <div class="modal-body" id="pModalConteudo">
       <!-- conteudo -->
    </div>
    <div class="modal-footer" id="pModalRodape">
        <button class="btn" data-dismiss="modal"><?=$class_fLNG->txt(__FILE__,__LINE__,'Sair')?></button>
    </div>
    <input id="pModalPage" name="pModalPage" type="hidden" value=""><input id="pModalGet" name="pModalGet" type="hidden" value=""><input id="pModalClass" name="pModalClass" type="hidden" value="">
</div>
<div class="fulldiv" id="pModalLock" onClick="exibMensagem('pModalLock','info','<?=$class_fLNG->txt(__FILE__,__LINE__,'AGUARDE O CARREGAMENTO COMPLETO DOS DADOS, NÃO FECHA A JANELA!')?>',3000);" style="position:absolute; top:0; left:0; z-index:99999; display:none;"></div>
<!-- End #pModal --> 

<div class="fulldiv" id="pFullContent" style="position:fixed; top:0; left:0; z-index:999; background:#FFF; display:none;">
    <div class="visible-phone" style="padding:10px; background:#368ee0; color:#FFF; border-bottom:#333 3px solid; width:100%;">
        <div class="pFullContent_ico" style="float:left; font-size:36px;"><i class="icon-pushpin"></i></div>
        <div style="float:left; margin:5px 0 0 10px; font-size:18px;"><b><?=$class_fLNG->txt(__FILE__,__LINE__,'DETALHES')?></b></div>
        <button type="button" style="margin:5px 20px 5px 5px; float:right;" onClick="pfullcontentDisplay('hide');" class="btn btn-primary"><i class="icon-remove"></i></button>
        <div style="clear:both;"></div>
    </div>
    <div class="hidden-phone" style="padding:20px 10px 20px 10px; background:#368ee0; color:#FFF; border-bottom:#333 3px solid; width:100%;" id="pFullContent_header">
        <div class="pFullContent_ico" style="float:left; font-size:46px;"><i class="icon-pushpin"></i></div>
        <div style="float:left; margin-left:10px; font-size:18px;" id="pFullContent_titu"><?=$class_fLNG->txt(__FILE__,__LINE__,'TÍTULO')?></div>
        <button type="button" style="margin:5px 35px 5px 5px; float:right;" onClick="pfullcontentDisplay('hide');" class="btn btn-primary" rel="tooltip" data-placement="left" data-original-title="Sair"><?=$class_fLNG->txt(__FILE__,__LINE__,'fechar')?> <i class="icon-remove"></i></button>
        <div style="clear:both;"></div>
    </div>
    <div class="fulldiv_w" style="width:100%; text-align:center; background:#FFF; display:none;" id="pFullContent_loader">
    	<div style="height:20%;"></div><img src="img/ajax-p-loader.gif"> <span id="pFullContent_loadermsg"><?=$class_fLNG->txt(__FILE__,__LINE__,'aguarde carregando...')?></span>
    </div>
    <div class="fulldiv_w" style="width:100%; background:#FFF; overflow:auto;" id="pFullContent_content"></div>
</div><!-- End #pFullContent --> 

<div id="pModalAlerta" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="pModalTituloAlerta"><?=$class_fLNG->txt(__FILE__,__LINE__,'ALERTA')?></h3>
	</div>
	<div class="modal-body"><p id="pModalConteudoAlerta"></p></div>
	<div class="modal-footer"><button class="btn btn-primary" data-dismiss="modal" id="pModalBtAlerta"><?=$class_fLNG->txt(__FILE__,__LINE__,'Ok')?></button></div>
</div><!-- End #pModalAlerta --> 


<div id="aModalAssinatura" class="modal hide fade" style="overflow:hidden;" tabindex="-1" role="dialog" aria-labelledby="aModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-header" style="padding-top:3px; padding-bottom:3px; padding-left:10px; padding-right:5px;">
        <button type="button" class="close icon-remove-sign" data-dismiss="modal" aria-hidden="true" style="margin:0; font-size:32px;" rel="tooltip" data-placement="left" data-original-title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Fechar')?>"></button>
        <h3 id="aModalAssinaturaTitulo" style="cursor:move; font-size:18px;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Titulo')?></h3>
    </div>
    <div class="modal-body" style="padding:0; margin:0; overflow:hidden;" id="aModalAssinaturaConteudo"><!-- conteudo --></div>
    <div class="modal-footer" style="padding:10px; display:none; min-height:50px;" id="aModalAssinaturaRodape"></div>
</div>
<!-- End #aModalAssinatura -->
<div style="position:fixed; display:none; left:0; top:0; width:100%; height:6px; background:#FFF; z-index:999;" class="fulldiv" id="divFlash"></div>
<script type="text/javascript">
$(document).ready(function(){
	faisher_ajaxAba('Inicio', "<?=$class_fLNG->txt(__FILE__,__LINE__,'Hoje')?>", 'home', '<?php if(isset($_GET["rm"])){ echo 'rm='.$_GET["rm"].'&'; }?>');
});
function popupSenha(v_tipo,v_campo){
    
	pmodalDisplay('hide'); 
	var v_titu = "";
	v_titu = "<i class=icon-tag></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'SENHA')?>";
	if(v_titu != ""){
		var ht_rodape = ''; i_height = $(window).height()-235;
		var v_w = Number($(window).width()); 
		if($(window).width() >= "1500"){
			$('#aModalAssinatura').css('width','1500'); $('#aModalAssinatura').css('margin-left','-760px');
		}else if($(window).width() >= "1400"){
			$('#aModalAssinatura').css('width','1400'); $('#aModalAssinatura').css('margin-left','-700px');
		}else if($(window).width() >= "1300"){
			$('#aModalAssinatura').css('width','1300'); $('#aModalAssinatura').css('margin-left','-660px');
		}else if($(window).width() >= "1100"){
			$('#aModalAssinatura').css('width','1100px'); $('#aModalAssinatura').css('margin-left','-570px');
		}else if($(window).width() >= "1100"){
			$('#aModalAssinatura').css('width','1100px'); $('#aModalAssinatura').css('margin-left','-570px');
		}else if($(window).width() >= "900"){
			$('#aModalAssinatura').css('width','980px'); $('#aModalAssinatura').css('margin-left','-470px');
		}else if($(window).width() >= "765"){
			$('#aModalAssinatura').css('width','840px'); $('#aModalAssinatura').css('margin-left','-370px');
		}else{ i_height = 450; v_m = v_w-15;
			$('#aModalAssinatura').css('width',v_m+'px'); $('#aModalAssinatura').css('margin','0px');
		}

		var v_url = '<?=SYS_URLSENHA?>';
		if(v_tipo == "atendimento"){ v_url = v_url + '?mod=axl.atendimento'; }
		
		var v_html = '<div id="popAssina_load" style="color:rgb(255, 255, 255); background:url(img/shadows/b50.png) repeat; text-align:center; width:100%; height:'+i_height+'px;"><br><br><br><img src="img/ajax-loader.gif"><br><?=$class_fLNG->txt(__FILE__,__LINE__,'Senha')?><br><br><?=$class_fLNG->txt(__FILE__,__LINE__,'já estamos carregando, aguarde...')?></div><iframe name="popAssina" style="border:0; overflow-x:hidden; display:none;" src="'+v_url+'" frameborder="0"  scrolling="yes"  id="popAssina" width="100%" height="'+i_height+'"> </iframe>';
		//monta popup para abertura
		$('#aModalAssinaturaConteudo').show();
		$("[rel=tooltip]").tooltip('hide');
		$("#aModalAssinatura").draggable({ handle: "#aModalAssinaturaTitulo" }); 
    	$('#aModalAssinaturaTitulo').html(v_titu);
		$('#aModalAssinaturaConteudo').html(v_html);
		
		$('#aModalAssinaturaRodape').html('<div><button type="button" class="btn btn-blue btn-large" onclick="getSenha(\''+v_campo+'\');"><?=$class_fLNG->txt(__FILE__,__LINE__,'ABRIR PROCESSO COM SENHA')?> <i class="glyphicon-circle_arrow_right"></i></button></div>');
		$('#aModalAssinaturaRodape').show();
		//ativa verificação de hide rolagem
		$("body").css("overflow", "hidden");
		var cont = 0;
		$.doTimeout('vTimeraModalA', 500, function(){
			if(cont == 0){ var divView = true; }else{ divView = $('#aModalAssinatura').is(':visible'); } cont++;
			if(divView == true){ return true; }else{ $.doTimeout('vTimeraModalA'); $("body").css("overflow", "auto"); }
		});//TIMER
		$('#aModalAssinatura').modal('show');
        $('#popAssina').on('load', function () {
            $('#popAssina_load').hide();
            $('#popAssina').fadeIn();
        });
	}
}//popupAssinaturas

function getSenha(v_campo){
	var senha = document.getElementById('popAssina').contentWindow.document.getElementById('num_senha');
	senha = $(senha).html();
	senha = senha.split(": ");
	senha = senha[1];
	senha = replaceAll(senha,"\t","");
	senha = replaceAll(senha," ","");	
	$(v_campo).val(senha);
	$("#aModalAssinatura").modal('hide')
}//getSenha

function replaceAll(str, find, replace) {
  return str.replace(new RegExp(find, 'g'), replace);
}

function alertUpdate(){
	$("#divUpdateAlert").fadeIn();
	$("#divUpdateAlert").draggable({ containment: "window", scroll: false, handle: "#divUpdateAlert" });
}


function getSelectionText() {
    var text = "";
    if (window.getSelection) {
        text = window.getSelection().toString();
    } else if (document.selection && document.selection.type != "Control") {
        text = document.selection.createRange().text;
    }
    return text;
}

function getIframeSelectionText(iframe) {
  var win = iframe.contentWindow;
  var doc = win.document;

  if (win.getSelection) {
    return win.getSelection().toString();
  } else if (doc.selection && doc.selection.createRange) {
    return doc.selection.createRange().text;
  }
}

<?php

?>

</script>


<div style="position:fixed; display:none; right:1%; bottom:1%; width:320px; height:100px; padding:10px 10px 10px 20px; cursor:pointer; background:url(img/fig_alert.jpg) repeat; z-index:19999999; -moz-border-radius:7px; -webkit-border-radius:7px; border-radius:7px;" onClick="alertUpdate();" id="divUpdateAlert"></div>

<div class="locked" id="divLoginBloq">
<img src="img/bandeira-1.png" style="max-width:251px; position:absolute; top:0; left:30px;">
<img src="img/bandeira-2.png" style="max-width:311px; position:absolute; bottom:10px; left:20px;">
	<div class="wrapper">
    	<h1 style=" text-align:center;"><a href="../" style=" text-align:center;"><img src="img/logo-big.png" alt="" class='retina-ready' style="margin-right:0;" width="180" height="180"></a></h1>
		<div class="pull-left">
			<img src="img.php?<?=$cVLogin->imgUser($cVLogin->getVarLogin("SYS_USER_ID"), "200", "200")?>" class="sys_imgPerfil" alt="" width="200" height="200">
			<a href="login.php?sair=1"><?=$class_fLNG->txt(__FILE__,__LINE__,'Mudar de Usuário? / Sair')?></a>
		</div>
		<div class="right">
			<div class="upper">
				<h2><?=sentenca(primeiro_nome($cVLogin->getVarLogin("SYS_USER_NOME"),"2"))?></h2>
				<span class="divload"<?=$class_fLNG->txt(__FILE__,__LINE__,'Bloqueado')?>></span>
			</div>
			<form method='get' onSubmit="return false;" autocomplete="off" style="margin:2px;" class="form-horizontal form-bordered">
                <div class="input-append">
				<input id="bloqPassFull" name="bloqPassFull" type="password" autocomplete="off" placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Sua senha de acesso')?>" style="width:63%; padding:5px;">
					<input type="submit" value="<?=$class_fLNG->txt(__FILE__,__LINE__,'Desbloquear')?>" onClick="$('#divLoginBloq .divload').html('<?=$class_fLNG->txt(__FILE__,__LINE__,'Verificando...')?>');faisher_ajax('divLoginBloqOculta', '0', 'ajax/login_ajax.php?ajax=desbloqsession&inicio=1', 'bloqpass='+$('#bloqPassFull').val(),'post');return false;" class='btn btn-inverse'>
				</div>
			</form>
            <div style="width:1px; height:1px; display:none;" id="divLoginBloqOculta"></div>
                        

		</div>
	</div>
  
</div>   
<div style="position:fixed; bottom:0; right:5px; font-size:12px; color:#026146; text-transform:uppercase; opacity:0.7;" id="divTimeActive">----, --:--</div>
<div style="width:1px; height:1px; position:absolute;" id="div_auxiliar"></div>
<div style="width:1px; height:1px; display:none;" id="div_oculta"><img src="img/fig_ajaxerro.png"></div>
<input id="abaActive" name="abaActive" type="hidden" value="In-home">
<input id="timeActive" name="timeActive" type="hidden" value="<?=time()+60?>">
	</body>
	</html>
<?php









//REMOVE CONEXAO
//fecha todas as conexoes abertas
$classe_db->FechaConexaoAll($SCRIPTOFF);//fecha conexoes
?>