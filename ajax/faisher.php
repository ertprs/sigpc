<?php // Breno Cruvinel - breno.cruvinel09@gmail.com
//INCLUDES DE CONTROLE --->>>
include "../config/globalSession.php";//inicia sessao php
include "../config/globalVars.php";//vars padrao
include "../sys/langAction.php";//vars padrao
include "../sys/globalFunctions.php";//funcoes padrao
include "../sys/globalClass.php";//classes padrao
include "../sys/classConexao.php";//classes de conexao
include "../sys/incUpdate.php";//verificador de updates
include "../config/incPacote.php";//vars do pacote de cliente
include "../sys/classValidaAcesso.php";//classes de validação de acesso
include "../sys/cabecalho_ajax.php"; //cabeçalho ajax para correção de acentos e cache
//INCLUDES DE CONTROLE ---<<<
	
//INICIAR ARQUIVO DE LINGUAGEM --->>>
$class_fLNG->loadFile(__FILE__);//incluir o arquivo de linguagem
//INICIAR ARQUIVO DE LINGUAGEM ---<<<	
	
//FUNCOES INICIAIS --->>>
//conexao DB
$classe_db = new classe_DB;//inicia a classe de conexao
$classe_db->AbreConexaoPai();//Abrimos a conexão Pai
$cMSG = new classMSG();//inicia a classe de mensagens
//FUNCOES INICIAIS ---<<< 

	
if(isset($_GET["faisher"])){	$faisher = getpost_sql($_GET["faisher"]);	}else{ 	$faisher = "home";		}
if($faisher == ""){ 			$faisher = "home"; 							}
$INC_FAISHER["include"] = "";

//############################ INCLUDES DE CONTROLE #################################################+++++++++++++++++++++++++++++++



$ajax = "OFF"; //zera a variavel AJAX e nao executa as funcoes ajax
//INCLUDE FAISHER, CONTROLE DE ARQUIVOS
$SYS_VALIDASEMQUADRO = "Jesus te Ama!";
$AJAX_PAG = "ajax/faisher.php";
if(isset($_GET["ajax"])){ $ajax = $_GET["ajax"]; }else{ $ajax = "home"; }//verifia se chamou função AJAX da Pagina
if(isset($_GET["POP"])){ $div_pop = "pop"; }else{ $div_pop = ""; }

//CLASSES PROTEGE PAGINA/LOGIN ---> > >
$cVLogin = new classVLOGIN;//inicia a classe de login
$cVLogin->loginCookie();//verifica o login e cria array de login
$cVLogin->loginSession($faisher);//faz a atualização de session do login atual
$cVLogin->loginVerificaSenhaExpirou();//verifica se a senha de login expirou, redireciona para página de alteração
//CLASSES PROTEGE PAGINA/LOGIN ---< < <	









//echo "FAI: $faisher"; exit(0);

//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ inicio menu - files ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~|||--->>>
//busca dados do MENU FILES
$resu = fSQL::SQL_SELECT_SIMPLES("id,modulo_id,titulo,include,permissao_tag,mapa_guia,mapa_menu,mapa_submenu,mapa_submenuextra", "sys_menu_files", "include = '".$faisher."' OR permissao_tag = '".$faisher."'", "", "1");
while($linha = fSQL::FETCH_ASSOC($resu)){
	
	
	
	$id_F = $linha["id"];
	$modulo_id_F = $linha["modulo_id"];
	$titulo_F = $linha["titulo"];
	$include_F = $linha["include"];
	$permissao_tag_F = $linha["permissao_tag"];
	$mapa_guia_F = $linha["mapa_guia"];
	$mapa_menu_F = $linha["mapa_menu"];
	$mapa_submenu_F = $linha["mapa_submenu"];
	$mapa_submenuextra_F = $linha["mapa_submenuextra"];
	$faisher = $include_F;//faz ajuste do faisher
	
	
	
	//verifica pacote de cliente
	if(!preg_match("/\.".$modulo_id_F."\./i", SYS_PACOTE_MODULOS)){ echo "<script>alert('Opss... Módulo (".$modulo_id_F.") selecionado não está adicionado ao seu SIGPC!\\nVerifique com administrador.');window.location='./';</script>"; exit(0); }

	//%%%%%%%%%%%%%%%%%%%%%%%%%%%% includes de controle %%%%%%%%%%%%%%%%%%%% > > > > > > > > > > > > > > > > > > > >
	$INC_FAISHER["titulo"] = $class_fLNG->txt(__FILE__,__LINE__,$titulo_F);//titulo da pagina	
	//monta nome da permissao verificando o marcador de perfil
	$INC_FAISHER["include"] = $modulo_id_F."/".$include_F."_ajax.php";//caminho da pagina de acesso
	$INC_FAISHER["permissao"] = $permissao_tag_F;//tag
	$INC_FAISHER["mapa"] = '<li><i class="icon-road"></i> <a href="?">'.$class_fLNG->txt(__FILE__,__LINE__,'Home').'</a></li>';
	//legenda de GUIA
	$linhai = fSQL::SQL_SELECT_ONE("nome_min", "sys_menu_guia", "id = '$mapa_guia_F'", "");
	$n_guia_i = $linhai["nome_min"];
	$INC_FAISHER["mapa"] .= '<li><i class="icon-angle-right"></i> <a href="#" onClick="return false;">'.$class_fLNG->txt(__FILE__,__LINE__,$n_guia_i).'</a></li>';

	$INC_FAISHER["menu"] = $mapa_guia_F;//menu ativo
	$INC_FAISHER["aba"] = substr($INC_FAISHER["menu"],0,2)."-".$faisher;//aba ativa
	$INC_FAISHER["div"] = str_replace("-", "", $INC_FAISHER["aba"]).$div_pop;//id rand para divis da pagina
	
	//legenda de MENU
	if($mapa_menu_F >= "1"){
		$resui = fSQL::SQL_SELECT_SIMPLES("nome_max", "sys_menu_guia_menu", "id = '$mapa_menu_F'", "");
		while($linhai = fSQL::FETCH_ASSOC($resui)){
			$n_menu_i = $linhai["nome_max"];
			$INC_FAISHER["mapa"] .= '<li><i class="icon-angle-right"></i> <a href="#" onClick="return false;">'.$class_fLNG->txt(__FILE__,__LINE__,$n_menu_i).'</a></li>';
		}//fim while
	}//if($mapa_menu_F >= "1"){
	//legenda de SUBMENU
	if($mapa_submenu_F >= "1"){
		$resui = fSQL::SQL_SELECT_SIMPLES("nome_max", "sys_menu_guia_menu_submenu", "id = '$mapa_submenu_F'", "");
		while($linhai = fSQL::FETCH_ASSOC($resui)){
			$n_submenu_i = $linhai["nome_max"];
			$INC_FAISHER["mapa"] .= '<li><i class="icon-angle-right"></i> <a href="#" onClick="return false;">'.$class_fLNG->txt(__FILE__,__LINE__,$n_submenu_i).'</a></li>';
		}//fim while
	}//if($mapa_submenu_F >= "1"){
	//legenda SUBMENU EXTRA
	if($mapa_submenuextra_F >= "1"){
		$resui = fSQL::SQL_SELECT_SIMPLES("nome_max", "sys_menu_guia_menu_submenu_submenuextra", "id = '$mapa_submenuextra_F'", "");
		while($linhai = fSQL::FETCH_ASSOC($resui)){
			$n_submenuextra_i = $linhai["nome_max"];
			$INC_FAISHER["mapa"] .= '<li><i class="icon-angle-right"></i> <a href="#" onClick="return false;">'.$class_fLNG->txt(__FILE__,__LINE__,$n_submenuextra_i).'</a></li>';
		}//fim while
	}//if($mapa_submenuextra_F >= "1"){
	//%%%%%%%%%%%%%%%%%%%%%%%%%%%% includes de controle %%%%%%%%%%%%%%%%%%%%< < < < < < < < < < < < < <
	
	
	//verifica se o perfil ainda te acesso ao módulo
	$resu1 = fSQL::SQL_SELECT_SIMPLES("modulos", "sys_perfil", "id = '".$cVLogin->getVarLogin("SYS_USER_PERFIL_ID")."'", "", "1");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		if(!preg_match("/\.".$modulo_id_F."\./i", $linha1["modulos"])){
			$faisher = "home";
			echo "<script>alert('Opss... Módulo (".$modulo_id_F.") não está mais disponível para este perfil!\\nVerifique com administrador.');</script>";
		}
	}//fim while
}//fim while
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ fim menu - files ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~|||---< < <

































//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ inicio menu - GERAL ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~|||--->>>


	//############################# includes de controle ((( INICIO ))) ######################> > > > > > > > > > > > > > > > > > > >
	if($faisher == "home"){//------------------------------------------------++++>>>>
		$INC_FAISHER["titulo"] = $class_fLNG->txt(__FILE__,__LINE__,'TELA INICIAL')." - ".$cVLogin->getVarLogin("SYS_USER_PERFIL_NOME");//titulo da pagina
		if($cVLogin->getVarLogin("SYS_USER_PERFIL_ID") == "10"){ $INC_FAISHER["titulo"] .= " - ".$cVLogin->getVarLogin("SYS_USER_CARGO"); }
		$INC_FAISHER["include"] = "0/home_ajax.php";
		$INC_FAISHER["menu"] = "Inicio";//menu ativo
		$INC_FAISHER["aba"] = substr($INC_FAISHER["menu"],0,2)."-".$faisher;//aba ativa
		$INC_FAISHER["div"] = str_replace("-", "", $INC_FAISHER["aba"]).$div_pop;//id rand para divis da pagina
		$INC_FAISHER["permissao"] = "0";//tag
		$INC_FAISHER["mapa"] = '<li><i class="icon-road"></i> <a href="?">'.$class_fLNG->txt(__FILE__,__LINE__,'Home').'</a></li>';//<i class="icon-angle-right"></i>
	}//home
	//############################# includes de controle ((( INICIO ))) ######################< < < < < < < < < < < < < <
	
	if($faisher == "sys_meusdados"){//---------------------------------------++++>>>>
		$INC_FAISHER["include"] = "sys_meusdados_ajax.php";//caminho da pagina de acesso
		$INC_FAISHER["menu"] = $class_fLNG->txt(__FILE__,__LINE__,'Ajustes');//menu ativo
		$INC_FAISHER["aba"] = substr($INC_FAISHER["menu"],0,2)."-".$faisher;//aba ativa
		$INC_FAISHER["div"] = str_replace("-", "", $INC_FAISHER["aba"]).$div_pop;//id rand para divis da pagina
		$INC_FAISHER["permissao"] = "0";//tag
		$INC_FAISHER["mapa"] = '<li><i class="icon-road"></i> <a href="?">'.$class_fLNG->txt(__FILE__,__LINE__,'Home').'</a></li>';
		$INC_FAISHER["mapa"] .= '<li><i class="icon-angle-right"></i> <a href="#" onClick="return false;">'.$class_fLNG->txt(__FILE__,__LINE__,'Ajustes').'</a></li>';
		$INC_FAISHER["mapa"] .= '<li><i class="icon-angle-right"></i> <a href="?faisher=sys_meusdados">'.$class_fLNG->txt(__FILE__,__LINE__,'Meus Dados').'</a></li>';
	}//sys_meusdados
	if($faisher == "sys_sobre"){//---------------------------------------++++>>>>
		$INC_FAISHER["include"] = "sys_sobre_ajax.php";//caminho da pagina de acesso
		$INC_FAISHER["menu"] = $class_fLNG->txt(__FILE__,__LINE__,'Ajustes');//menu ativo
		$INC_FAISHER["aba"] = substr($INC_FAISHER["menu"],0,2)."-".$faisher;//aba ativa
		$INC_FAISHER["div"] = str_replace("-", "", $INC_FAISHER["aba"]).$div_pop;//id rand para divis da pagina
		$INC_FAISHER["permissao"] = "0";//tag
		$INC_FAISHER["mapa"] = '<li><i class="icon-road"></i> <a href="?">'.$class_fLNG->txt(__FILE__,__LINE__,'Home').'</a></li>';
		$INC_FAISHER["mapa"] .= '<li><i class="icon-angle-right"></i> <a href="#" onClick="return false;">'.$class_fLNG->txt(__FILE__,__LINE__,'Ajustes').'</a></li>';
		$INC_FAISHER["mapa"] .= '<li><i class="icon-angle-right"></i> <a href="?faisher=sys_meusdados">'.$class_fLNG->txt(__FILE__,__LINE__,'Sobre').' - '.SYS_CLIENTE_NOME_RESUMIDO.'</a></li>';
	}//sys_sobre
	//############################# includes de controle ((( AJUSTES ))) ######################< < < < < < < < < < < < < <


//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ fim menu - GERAL ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~|||---< < <











	
	
//verifica vars iniciais
if($INC_FAISHER["include"] == ""){ echo "Opss... erro de acesso, tente novamente do inicio... E($faisher)"; exit(0); }
	


//verifica visualização FULLVIEW
$FULLVIEW = "0"; $FULLVIEW_GET = "";
if((isset($_GET["FULLVIEW"])) and ($ajax != "registro") and ($ajax != "lista")){
	$FULL = fGERAL::jsonArray(fGERAL::cryptoSys(base64_decode($_GET["FULLVIEW"]),"dec"),"dec");
	//echo "DEBUG - TI<br>"; echo json_encode($FULL); echo "<br><br>".base64_decode($_GET["FULLVIEW"]); exit(0);
	if($FULL["1"] >= "10"){
		if(($FULL["0"] == $FULL["1"]) and ($FULL["0"] == date('Ymd'))){
			$FULLVIEW = time(); $FULLVIEW_GET = "FULLVIEW=".$_GET["FULLVIEW"]."&";
		}
	}
}//FULLVIEW

//echo "PER: ".$INC_FAISHER["permissao"]; exit(0);

if($FULLVIEW == "0"){
	//CLASSES PROTEGE PAGINA/LOGIN ---> > >
	//protege a pagina
	$cVLogin->loginAcessoProtege("./",$INC_FAISHER["permissao"]);//verifica a permissao da pagina - PROTEGE
	//CLASSES PROTEGE PAGINA/LOGIN ---< < <	
}//if($FULLVIEW == "0"){




//monta dados de FAISHER_GET - faisher de inclusão padrão de loop
$faisherGet = "faisher=$faisher&".$FULLVIEW_GET.verPop("get");


//adiciona complemento em var DIV para POP if(isset($_GET["POP"])){ $INC_FAISHER["div"] .= "POP"; }


//INCLUDE PRINCIPAL
if($ajax == "home"){ include "../sys/cabecalho_js.php"; }//cabecalho de funcoes JS padrao de pagina home
include $INC_FAISHER["include"];


//fecha todas as conexoes abertas
$classe_db->FechaConexaoAll($SCRIPTOFF);//fecha conexoes
?>