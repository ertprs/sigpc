<?php //Breno Cruvinel - breno.cruvinel09@gmail.com
$ajax = "OFF"; //zera a variavel AJAX e nao executa as funcoes ajax
if(isset($_GET["ajax"])){//verifia se chamou função AJAX da Pagina
	$ajax = $_GET["ajax"];

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
	$SCRIPTOFF = "0";
	include "../sys/cabecalho_ajax.php"; //cabeçalho ajax para correção de acentos e cache
	//INCLUDES DE CONTROLE ---<<<
	
//INICIAR ARQUIVO DE LINGUAGEM --->>>
$class_fLNG->loadFile(__FILE__);//incluir o arquivo de linguagem
//INICIAR ARQUIVO DE LINGUAGEM ---<<<

	
	
	//FUNCOES INICIAIS --->>>
	//conexao DB
	$classe_db = new classe_DB;//inicia a classe de conexao
	$classe_db->AbreConexaoPai();//Abrimos a conexão Pai
	$SISTEMA_CONF = unserialize(VAR_SYS_CONF);//resgata variaveis de configuracao vindas da conexao pai
	//FUNCOES INICIAIS ---<<<


}//fim else - if(isset($_GET["ajax"])){//verifia se chamou função AJAX da Pagina

?>
<?php

//ini_set('display_errors',1); ini_set('display_startup_erros',1); error_reporting(E_ALL);







//AJAX QUE VERIFICA CADASTRO ---------------------------------------------------------->>>
if($ajax == "verificarcadastro"){
	$c_acao = getpost_sql($_POST["acao"]);
	$c_array_temp = getpost_sql($_POST["array_temp"]);
	$cnome = getpost_sql($_POST["cnome"],"MAIUSCULO");
	$csexo = getpost_sql($_POST["csexo"]);
	$cdatan = getpost_sql($_POST["cdatan"],"DATA");
	$cdoc_nome = getpost_sql($_POST["cdoc_nome"],"MAIUSCULO");
	$cdoc_numero = getpost_sql($_POST["cdoc_numero"],"DOC");
	$cmae = getpost_sql($_POST["cmae"],"MAIUSCULO");
	$ccelular = getpost_sql($_POST["ccelular"]);
	$ccargo = getpost_sql($_POST["ccargo"]);
	$cont_upload1 = getpost_sql($_POST["cont_upload1"]);
	$cpais = getpost_sql($_POST["cpais"]);
	$cuf = getpost_sql($_POST["cuf"]);
	$ccidade_id = getpost_sql($_POST["ccidade_id"]);
	$cbairro = getpost_sql($_POST["cbairro"]);
	$clogradouro = getpost_sql($_POST["clogradouro"]);
	$creferencia = getpost_sql($_POST["creferencia"]);
	$ccodigo_energia = getpost_sql($_POST["ccodigo_energia"]);
	$cemail = getpost_sql($_POST["cemail"]);
	$csenha1 = getpost_sql($_POST["csenha1"]);
	$csenha2 = getpost_sql($_POST["csenha2"]);
	$captcha_t = getpost_sql($_POST["captcha_t"]);
	if($cemail == ""){$uemail = "bhjghjghjgggjgj"; }
	$valida = "1";
	$valida_captcha = "1"; $msg_captcha = $class_fLNG->txt(__FILE__,__LINE__,'O código de verificação está incorreto!');
	//verifica qual captcha esta usando ...............................................................................
	if((isset($_SESSION["codigo_SEG_LOG"])) and ($captcha_t == "captcha")){//CAPTCHA NUMÉRICO
		$segFig = getpost_sql($_POST["segFig"]);
		//verifica se expirou
		$tseg = $_SESSION["time_SEG_LOG"]+90;
		if($tseg < time()){
				$valida_captcha = "0";
				$msg_captcha = $class_fLNG->txt(__FILE__,__LINE__,'<b>IMAGEM DE SEGURANÇA EXPIROU!</b><br>Informe a imagem de segurança novamente!')." :)";			
		}else{//if($tseg < time()){
			if($_SESSION["codigo_SEG_LOG"] == $segFig && !empty($_SESSION["codigo_SEG_LOG"])){ unset($_SESSION["codigo_SEG_LOG"]); }else{
				$valida_captcha = "0";
				$msg_captcha = $class_fLNG->txt(__FILE__,__LINE__,'<b>Desculpe!<br>Não conseguimos verificar se você não é um robô...</b><br>Informe a imagem de segurança corretamente!')." :) ";
			}//fim if imagem de seguranca
		}//else{//if($tseg < time()){	
	
	}else{//if((isset($_SESSION["codigo_SEG_LOG"])) and ($captcha_t == "captcha")){//CAPTCHA NUMÉRICO
		//valida sessão de registro servidor
		if($_SESSION["RE_".str_replace('.','',$_SERVER["SERVER_NAME"])] != date('dmY')){ $valida_captcha = "0"; }//validação extra sessão do form
		//valida recaptcha google
		if(isset($_POST['g-recaptcha-response'])){ $captcha_data = $_POST['g-recaptcha-response']; }
		if(!$captcha_data){ $valida_captcha = "0"; }
		if($valida_captcha == "1"){
			$respReCaptcha = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".SYS_CONFIG_RECAPTCHA."&response=".$captcha_data."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
			if($respReCaptcha["success"] != "true"){ $valida_captcha = "0"; }
			if(($respReCaptcha["challenge_ts"] == "") or ($respReCaptcha["challenge_ts"] == "null") or ($respReCaptcha["challenge_ts"] == "NULL")){ $valida_captcha = "0"; }
			if($valida_captcha == "1"){ if(isset($_SESSION["RE_".str_replace('-','',str_replace(':','',$respReCaptcha["challenge_ts"]))])){ $valida_captcha = "0"; }}
		}//if($valida_captcha == "1"){
		if($valida_captcha == "1"){ $_SESSION["RE_".str_replace('-','',str_replace(':','',$respReCaptcha["challenge_ts"]))] = $respReCaptcha["challenge_ts"]; }//reg. ultimo não aceita novamente
		if($valida_captcha != "1"){
			$msg_captcha = $class_fLNG->txt(__FILE__,__LINE__,'<b>Desculpe!<br>Não conseguimos verificar se você não é um robô...</b><br>Selecione corretamente no item anterior')." :) ";
		}//if($valida_captcha != "1"){		
		
	}//else{//if((isset($_SESSION["codigo_SEG_LOG"])) and ($captcha_t == "captcha")){//CAPTCHA NUMÉRICO
	
	
	if($valida_captcha != "1"){
		$valida = "0";
?>
<script>
	//TIMER
	$.doTimeout( 'vTimerLOGIN', 200, function(){
		$('#div_cadastro_load').fadeOut();
		$('#modal_alerta .conteudo').html("<?=$msg_captcha?>");
		$('#modal_alerta').modal('show');
		sysCaptcha3();
		return false;//controla o laco
	});//TIMER
</script>
<?php
			exit(0);
	}//if($valida_captcha != "1"){
	
	

	//realiza validações
	//if(($cont_upload1 != "3") and ($valida == "1")){ $valida = "0";  $msg = "Necessário o envio de 03 documentos!"; }
	if(($cnome == "") and ($valida == "1")){ $valida = "0";  $msg = $class_fLNG->txt(__FILE__,__LINE__,'Informe seu nome completo!'); }
	if(($cdoc_nome == "") and ($valida == "1")){ $valida = "0";  $msg = $class_fLNG->txt(__FILE__,__LINE__,'Informe nome do documento utilizado!'); }
	if(($cdoc_numero == "") and ($valida == "1")){ $valida = "0";  $msg = $class_fLNG->txt(__FILE__,__LINE__,'Informe nº do documento!'); }
	if(($cmae == "") and ($valida == "1")){ $valida = "0";  $msg = $class_fLNG->txt(__FILE__,__LINE__,'Precisamos do nome completo de sua mãe!'); }
	if(($ccidade_id == "") and ($valida == "1")){ $valida = "0";  $msg = $class_fLNG->txt(__FILE__,__LINE__,'Informe sua cidade!'); }
	if(($cbairro == "") and ($valida == "1")){ $valida = "0";  $msg = $class_fLNG->txt(__FILE__,__LINE__,'Informe bairro/setor!'); }
	if(($cemail == "") and ($valida == "1")){ $valida = "0";  $msg = $class_fLNG->txt(__FILE__,__LINE__,'Informe seu email de acesso!'); }
	if((strlen($csenha1) < "6") and ($valida == "1")){ $valida = "0";  $msg = "Sua senha deve conter no mínimo 6 caracteres!"; }
	if(($csenha1 == "123456") and ($valida == "1")){ $valida = "0";  $msg = $class_fLNG->txt(__FILE__,__LINE__,'Sua senha deve ser mais segura! Senha: !!senha!! é muito simples.',array("senha"=>$csenha1)); }
	if(($csenha1 == "654321") and ($valida == "1")){ $valida = "0";  $msg = $class_fLNG->txt(__FILE__,__LINE__,'Sua senha deve ser mais segura! Senha: !!senha!! é muito simples.',array("senha"=>$csenha1)); }
	if(($csenha1 == "123123") and ($valida == "1")){ $valida = "0";  $msg = $class_fLNG->txt(__FILE__,__LINE__,'Sua senha deve ser mais segura! Senha: !!senha!! é muito simples.',array("senha"=>$csenha1)); }
	if(($csenha1 == "321321") and ($valida == "1")){ $valida = "0";  $msg = $class_fLNG->txt(__FILE__,__LINE__,'Sua senha deve ser mais segura! Senha: !!senha!! é muito simples.',array("senha"=>$csenha1)); }
	if(($csenha1 == "000000") and ($valida == "1")){ $valida = "0";  $msg = $class_fLNG->txt(__FILE__,__LINE__,'Sua senha deve ser mais segura! Senha: !!senha!! é muito simples.',array("senha"=>$csenha1)); }
	if(($csenha1 == "111111") and ($valida == "1")){ $valida = "0";  $msg = $class_fLNG->txt(__FILE__,__LINE__,'Sua senha deve ser mais segura! Senha: !!senha!! é muito simples.',array("senha"=>$csenha1)); }
	if(($csenha1 == "222222") and ($valida == "1")){ $valida = "0";  $msg = $class_fLNG->txt(__FILE__,__LINE__,'Sua senha deve ser mais segura! Senha: !!senha!! é muito simples.',array("senha"=>$csenha1)); }
	if(($csenha1 == "333333") and ($valida == "1")){ $valida = "0";  $msg = $class_fLNG->txt(__FILE__,__LINE__,'Sua senha deve ser mais segura! Senha: !!senha!! é muito simples.',array("senha"=>$csenha1)); }
	if(($csenha1 == "444444") and ($valida == "1")){ $valida = "0";  $msg = $class_fLNG->txt(__FILE__,__LINE__,'Sua senha deve ser mais segura! Senha: !!senha!! é muito simples.',array("senha"=>$csenha1)); }
	if(($csenha1 == "555555") and ($valida == "1")){ $valida = "0";  $msg = $class_fLNG->txt(__FILE__,__LINE__,'Sua senha deve ser mais segura! Senha: !!senha!! é muito simples.',array("senha"=>$csenha1)); }
	if(($csenha1 == "666666") and ($valida == "1")){ $valida = "0";  $msg = $class_fLNG->txt(__FILE__,__LINE__,'Sua senha deve ser mais segura! Senha: !!senha!! é muito simples.',array("senha"=>$csenha1)); }
	if(($csenha1 == "777777") and ($valida == "1")){ $valida = "0";  $msg = $class_fLNG->txt(__FILE__,__LINE__,'Sua senha deve ser mais segura! Senha: !!senha!! é muito simples.',array("senha"=>$csenha1)); }
	if(($csenha1 == "888888") and ($valida == "1")){ $valida = "0";  $msg = $class_fLNG->txt(__FILE__,__LINE__,'Sua senha deve ser mais segura! Senha: !!senha!! é muito simples.',array("senha"=>$csenha1)); }
	if(($csenha1 == "999999") and ($valida == "1")){ $valida = "0";  $msg = $class_fLNG->txt(__FILE__,__LINE__,'Sua senha deve ser mais segura! Senha: !!senha!! é muito simples.',array("senha"=>$csenha1)); }


	//verifica base de dados .....................................................................................
	//verifica se já existe no sistema
	if($valida == "1"){
		$cont_ = fSQL::SQL_CONTAGEM("sys_usuarios", "doc_nome = '$cdoc_nome' AND doc_numero = '$cdoc_numero' AND status <> '2'");
		if($cont_ >= "1"){ $valida = "0";  $msg = "- ".$class_fLNG->txt(__FILE__,__LINE__,'Nº documento (!!doc!!) já cadastrado!<br><b>Utilize lembrar senha para recuperar o acesso.</b>',array("doc"=>$cdoc_nome." ".$cdoc_numero)); }//fim if valida campo
	}
	//verifica se já existe no sistema
	if($valida == "1"){
		$cont_ = fSQL::SQL_CONTAGEM("sys_login", "email = '$cemail' AND status <> '4'");
		if($cont_ >= "1"){ $valida = "0";  $msg = "- ".$class_fLNG->txt(__FILE__,__LINE__,'E-mail Já cadastrado! Utilize lembrar senha.'); }//fim if valida campo
	}




		
	if($valida == "1"){
		$cbairro = str_replace("NOVO:","",$cbairro);
		
		$var_IP = $_SERVER['REMOTE_ADDR']; 
		$cad_id = $_SESSION["LOGIN_ACAO_FORM_ARRAY"]["id"];
		$csexo = ($csexo == "1" ? "M" : "F");
		//VARS insert simples SQL
		$tabela = "sys_usuarios";
		//busca ultimo id para insert
		$id_a = fSQL::SQL_SELECT_INSERT($tabela, "id");
		$campos = "id,nome,cargo,sexo,datan,doc_nome,doc_numero,mae,celular,segundos_session,ip,user,time,user_a,sync";
		$valores = array($id_a,$cnome,$ccargo,$csexo,$cdatan,$cdoc_nome,$cdoc_numero,$cmae,$ccelular,"600",$var_IP,"AUTOCADASTRO",time(),"0",time());
		fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
		if($id_a >= "1"){
			//########################################### iFRAME TEMP ####################################>>>>>>>>>>>
			//verifica se existem arquivos temp no sistema
			$upload_dir_temp = VAR_DIR_FILES."files/temp/";
			$cont_f = "0";
			$campos = "id,nome,arquivo";
			$tabela = "sys_arquivos_temp";
			$where = "acao = '$c_array_temp' AND form = 'pdfDOC".$c_array_temp."' AND usuarios_id = '".$cad_id."'";
			//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
			$resu1 = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "");
			while($linha = fSQL::FETCH_ASSOC($resu1)){
				$id_e = $linha["id"];
				$nome_e = $linha["nome"];
				$arquivo_e = $linha["arquivo"];
				if(file_exists($upload_dir_temp.$arquivo_e)){ $cont_f++;
					$upload_dir = VAR_DIR_FILES."files/tabelas/usuarios/"; if(!file_exists($upload_dir)){ cria_pasta($upload_dir); }
					$upload_dir .= $id_a; if(!file_exists($upload_dir)){ cria_pasta($upload_dir); }
					//define os dados a gravar
					$file_name = "doc-rccm.pdf";//define nome
					rename($upload_dir_temp.$arquivo_e,$upload_dir."/".$file_name);
					delete($upload_dir_temp.$arquivo_e);//excluir arquivo de residuo		
					//exclue o registro
					$tabela = "sys_arquivos_temp";
					$condicao = "id = '$id_e'";
					fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
				}//fim if(file_exists($upload_dir_temp.$arquivo_e)){
			}//fim while
			
			
			//verifica se existem arquivos temp no sistema
			$upload_dir_temp = VAR_DIR_FILES."files/temp/";
			$cont_f = "0";
			$campos = "id,nome,arquivo";
			$tabela = "sys_arquivos_temp";
			$where = "acao = '$c_array_temp' AND form = 'pdfDOC2".$c_array_temp."' AND usuarios_id = '".$cad_id."'";
			//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
			$resu1 = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "");
			while($linha = fSQL::FETCH_ASSOC($resu1)){
				$id_e = $linha["id"];
				$nome_e = $linha["nome"];
				$arquivo_e = $linha["arquivo"];
				if(file_exists($upload_dir_temp.$arquivo_e)){ $cont_f++;
					$upload_dir = VAR_DIR_FILES."files/tabelas/usuarios/"; if(!file_exists($upload_dir)){ cria_pasta($upload_dir); }
					$upload_dir .= $id_a; if(!file_exists($upload_dir)){ cria_pasta($upload_dir); }
					//define os dados a gravar
					$file_name = "doc.pdf";//define nome
					rename($upload_dir_temp.$arquivo_e,$upload_dir."/".$file_name);
					delete($upload_dir_temp.$arquivo_e);//excluir arquivo de residuo		
					//exclue o registro
					$tabela = "sys_arquivos_temp";
					$condicao = "id = '$id_e'";
					fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
				}//fim if(file_exists($upload_dir_temp.$arquivo_e)){
			}//fim while
			
										
			//########################################### iFRAME TEMP ####################################<<<<<<<<<<<
						
			//GRAVA DADOS DO ENDEREÇO _--------------------------------------------------------------------------------------------------------
			//busca ultimo id para insert
			$id_end_a = fSQL::SQL_SELECT_INSERT("sys_usuarios_endereco", "id");
			//insere o registro na tabela do sistema
			//VARS insert simples SQL
			$tabela = "sys_usuarios_endereco";
			$campos = "id,usuario_id,pais,uf,cidade_id,bairro,logradouro,codigo_energia,referencia,user,time,user_a,sync";
			$valores = array($id_end_a,$id_a,$cpais,$cuf,$ccidade_id,$cbairro,$clogradouro,$ccodigo_energia,$creferencia,"AUTOCADASTRO",time(),"0",time());
			fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
			
			$csenha1C = fGERAL::cryptoSenhaDB($csenha1);//codifica senha
			//converte data de senha em time UNIX
			$senha_expira = time_data_hora(date('d/m/Y', strtotime("+6 month"))." 00:00");
			//VARS insert simples SQL
			$tabela = "sys_login";
			//busca ultimo id para insert
			$id_l = fSQL::SQL_SELECT_INSERT($tabela, "id");
			$campos = "id,usuarios_id,email,senha,senha_expira,senha_erro,time_s,time_u,time,time_atividade,confirma,status";
			$valores = array($id_l,$id_a,$cemail,$csenha1C,$senha_expira,"0",time(),"0",time(),strtotime("+24 months"),"","2");
			fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
			
			
			//VARS insert simples SQL
			$tabela = "sys_login_pacote";
			//busca ultimo id para insert
			$id_l = fSQL::SQL_SELECT_INSERT($tabela, "id");
			$campos = "id,usuarios_id,perfil_id,permissao_grupo_id,user,time";
			$valores = array($id_l,$id_a,"10","3","AUTOCADASTRO",time());
			fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);			
				
			//enviar email de confirmação
			$cLogin = new classLOGIN;//inicia a classe de login
			$msg_email = $cLogin->enviarEmailConfirma($id_a);//faz envio de email de confirmação
			$_SESSION["MSG_CONFIRMAEMAIL"] = $class_fLNG->txt(__FILE__,__LINE__,'<b>SERÁ NECESSÁRIO CONFIRMAR SEU EMAIL!</b><br>!!msg!!<br>Acesse o seu email e siga as instruções de ativação! <br>Precisamos confirmar que você tem acesso ao email...',array("msg"=>$msg_email))." :)";
?>
<script>
	$.doTimeout( 'vTimerCAD', 1000, function(){
		$('#div_cadastro_loadmsg').html('<?=$class_fLNG->txt(__FILE__,__LINE__,'Cadastro realizado com sucesso!<br><b>SERÁ NECESSÁRIO CONFIRMAR SEU EMAIL!</b>')?>');
		$('#div_cadastro_load').fadeIn();
		return false;//controla o laco
	});//TIMER
	$.doTimeout( 'vTimerCADOK', 4000, function(){
		window.location='./login.php?aguardando_confirmacao_email';
		return false;//controla o laco
	});//TIMER
</script>
<?php
			exit(0);
		}else{ $valida = "0"; $msg = $class_fLNG->txt(__FILE__,__LINE__,'Erro inesperado! Atualize a janela e tente novamente.'); }//if($id_a >= "1"){
	}//if(($valida == "1")){




//retorna erro de login
		if($valida == "0"){
?>
<script>
	//TIMER
	$.doTimeout( 'vTimerCAD', 200, function(){
		$('#div_cadastro_load').fadeOut();
		$('#modal_alerta .conteudo').html("<?=$msg?>");
		$('#modal_alerta').modal('show');
		sysCaptcha3();
		return false;//controla o laco
	});//TIMER
</script>
<?php
			exit(0);
		}//fim if($valida == "0"){








	exit(0);

}//fim ajax  -------------------------------------------- <<<









if ($ajax == "testeemail"){
	//enviar email de confirmação
	$cLogin = new classLOGIN;//inicia a classe de login
	$msg_email = $cLogin->enviarEmailConfirma("24");//faz envio de email de confirmação
	echo $msg_email;
}










































//AJAX QUE DE LEMBRAR SENHA ---------------------------------------------------------->>>
if($ajax == "lembrarsenha"){
	$l_acao = getpost_sql($_POST["acao"]);
	$doc_nome = getpost_sql($_POST["doc_nome"]);
	$doc_numero = getpost_sql($_POST["doc_numero"]);	
	$ldatan = getpost_sql($_POST["ldatan"],"DATA");	
	$captcha_t = getpost_sql($_POST["captcha_t"]);
	$valida = "1";
	$valida_captcha = "1"; $msg_captcha = $class_fLNG->txt(__FILE__,__LINE__,'O código de verificação está incorreto!');
	//verifica qual captcha esta usando ...............................................................................
	if((isset($_SESSION["codigo_SEG_LOG"])) and ($captcha_t == "captcha")){//CAPTCHA NUMÉRICO
		$segFig = getpost_sql($_POST["segFig"]);
		//verifica se expirou
		$tseg = $_SESSION["time_SEG_LOG"]+90;
		if($tseg < time()){
				$valida_captcha = "0";
				$msg_captcha = $class_fLNG->txt(__FILE__,__LINE__,'<b>IMAGEM DE SEGURANÇA EXPIROU!</b><br>Informe a imagem de segurança novamente!')." :)";			
		}else{//if($tseg < time()){
			if($_SESSION["codigo_SEG_LOG"] == $segFig && !empty($_SESSION["codigo_SEG_LOG"])){ unset($_SESSION["codigo_SEG_LOG"]); }else{
				$valida_captcha = "0";
				$msg_captcha = $class_fLNG->txt(__FILE__,__LINE__,'<b>Desculpe!<br>Não conseguimos verificar se você não é um robô...</b><br>Informe a imagem de segurança corretamente!')." :) ";
			}//fim if imagem de seguranca
		}//else{//if($tseg < time()){	
	
	}else{//if((isset($_SESSION["codigo_SEG_LOG"])) and ($captcha_t == "captcha")){//CAPTCHA NUMÉRICO
		//valida sessão de registro servidor
		if($_SESSION["RE_".str_replace('.','',$_SERVER["SERVER_NAME"])] != date('dmY')){ $valida_captcha = "0"; }//validação extra sessão do form
		//valida recaptcha google
		if(isset($_POST['g-recaptcha-response'])){ $captcha_data = $_POST['g-recaptcha-response']; }
		if(!$captcha_data){ $valida_captcha = "0"; }
		if($valida_captcha == "1"){
			$respReCaptcha = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".SYS_CONFIG_RECAPTCHA."&response=".$captcha_data."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
			if($respReCaptcha["success"] != "true"){ $valida_captcha = "0"; }
			if(($respReCaptcha["challenge_ts"] == "") or ($respReCaptcha["challenge_ts"] == "null") or ($respReCaptcha["challenge_ts"] == "NULL")){ $valida_captcha = "0"; }
			if($valida_captcha == "1"){ if(isset($_SESSION["RE_".str_replace('-','',str_replace(':','',$respReCaptcha["challenge_ts"]))])){ $valida_captcha = "0"; }}
		}//if($valida_captcha == "1"){
		if($valida_captcha == "1"){ $_SESSION["RE_".str_replace('-','',str_replace(':','',$respReCaptcha["challenge_ts"]))] = $respReCaptcha["challenge_ts"]; }//reg. ultimo não aceita novamente
		if($valida_captcha != "1"){
			$msg_captcha = $class_fLNG->txt(__FILE__,__LINE__,'<b>Desculpe!<br>Não conseguimos verificar se você não é um robô...</b><br>Selecione corretamente no item anterior')." :) ";
		}//if($valida_captcha != "1"){		
		
	}//else{//if((isset($_SESSION["codigo_SEG_LOG"])) and ($captcha_t == "captcha")){//CAPTCHA NUMÉRICO
		
	
	
	
	if($valida_captcha != "1"){
		$valida = "0";
?>
<script>
	//TIMER
	$.doTimeout( 'vTimerLOGIN', 200, function(){
		$('#div_lembrar_load').fadeOut();
		$('#modal_alerta .conteudo').html("<?=$msg_captcha?>");
		$('#modal_alerta').modal('show');
		sysCaptcha2();
		return false;//controla o laco
	});//TIMER
</script>
<?php
			exit(0);
	}//if($valida_captcha != "1"){
	
	
	

	//realiza validações
	if(($doc_numero == "") and ($valida == "1")){ $valida = "0";  $msg = $class_fLNG->txt(__FILE__,__LINE__,'Informe seu nº documento corretamente!'); }
	if(($ldatan == "") and ($valida == "1")){ $valida = "0";  $msg = $class_fLNG->txt(__FILE__,__LINE__,'Informe sua data de nascimento!'); }


	//verifica base de dados .....................................................................................
	if($valida == "1"){
		$cont_cad = "0";
		$campos = "id,nome";
		$resuM = fSQL::SQL_SELECT_SIMPLES("id,nome,datan", "sys_usuarios", "doc_nome = '".$doc_nome."' AND doc_numero = '".$doc_numero."' AND status <> '2'", "", "1");
		while($linha = fSQL::FETCH_ASSOC($resuM)){
			$cad_id = $linha["id"];
			$cad_nome = $linha["nome"];
			$cad_datan = $linha["datan"];
			if($ldatan == $cad_datan){ $cont_cad++; }
		}//fim while
		if($cont_cad == "0"){
			$valida = "0";  $msg = $class_fLNG->txt(__FILE__,__LINE__,'As informações inseridas não correspondem ao que temos aqui! <br>VERIFIQUE OS DADOS E TENTE NOVAMENTE.');
		}
	}//if($valida == "1"){



	//vrealiza o cadatro se tudo estiver ok .....................................................................
	if($valida == "1"){
		$retMsg = 'Erro no envio!';
		$resu1 = fSQL::SQL_SELECT_SIMPLES("email,status", "sys_login", "usuarios_id = '$cad_id'", "", "1");
		while($linha = fSQL::FETCH_ASSOC($resu1)){
			$email_i = $linha["email"];
			$status_i = $linha["status"];
			//excluir solicitações anteriores
			fSQL::SQL_DELETE_SIMPLES("sys_usuarios_login_lembrar", "usuario_id = '$cad_id'");
			//insere o registro na tabela do sistema
			$chave = fGERAL::gerarChave(14)."_".$cad_id."_".rand(1,9)."1";
			$nova_senha = fGERAL::gerarChave(8);			
			//$senhaDB = fGERAL::cryptoSenhaDB($nova_senha);//codifica senha
			//VARS insert simples SQL
			$tabela = "sys_usuarios_login_lembrar";
			//busca ultimo id para insert
			$id_a = fSQL::SQL_SELECT_INSERT($tabela, "id");
			$campos = "usuario_id,chave,nova_senha,time";
			$valores = array($cad_id,$chave,$nova_senha,time());
			fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
			//prepara envio de email
			$link_ver = SYS_URLRAIZ."?l=".base64_encode($chave);
			$html_template = file_get_contents(VAR_DIR_FILES."files/templates/email/email-lembrar-senha.html");
			//monta mensagem template
			$html_template = str_replace("!url_raiz!",SYS_URLRAIZ,$html_template);
			$html_template = str_replace("!nome_fisico!",$cad_nome,$html_template);
			$html_template = str_replace("!link_verificar!",$link_ver,$html_template);
							
			//$email_i = "breno.cruvinel09@gmail.com";
			//#################### INICIO ENVIA EMAIL ##################>>>>>>>>>>>>>>>>
			$opts = array(
				'http'=>array('header'=>"Content-type: application/x-www-form-urlencoded", 'method'=>'POST', 'content'=>http_build_query(array(
					//CONFIGURAÇÕES
					'MAIL_HOST' => SYS_MAIL_HOST,
					'MAIL_TIPO' => SYS_MAIL_TIPO,// SMTP ("","ssl","tls")
					'MAIL_PORTA' => SYS_MAIL_PORTA,//465
					'MAIL_USER' => SYS_MAIL_USER,
					'MAIL_PASS' => SYS_MAIL_PASS,
					'MAIL_NOME' => SYS_MAIL_NOME,
					'MAIL_EMAIL' => SYS_MAIL_EMAIL,
					'MAIL_DEBUG' => "0",//ativar debug -- 1 = Erros e mensagens, 2 = Apenas mensagens, SMTP::DEBUG_SERVER
					//DADOS DO ENVIO
					'SEND_NOME' => primeiro_nome($cad_nome),
					'SEND_EMAIL' => $email_i,
					'SEND_ASSUNTO' => $class_fLNG->txt(__FILE__,__LINE__,'!!nome!!, nova senha',array("nome"=>primeiro_nome($cad_nome))).' - '.SYS_CLIENTE_NOME_RESUMIDO,
					'SEND_BODY' => $html_template
					))),"ssl"=>array("verify_peer"=>false,"verify_peer_name"=>false)
			); $context = stream_context_create($opts);
			//informações do retorno: 0 - bloqueado acesso, 1 - sucesso, 2 - erros de configuração, 3 - erro de classe
			$contentResp = file_get_contents(SYS_URLRAIZ.'sys/http_send_email.php?JesusTeAma=1', false, $context);
			if($contentResp != "1"){
				$retMsg = '<br><br>'.$class_fLNG->txt(__FILE__,__LINE__,'Opss... Ouve um problema ao enviar o email de lembrete de senha agora! :O <br><br><b>Por favor, tente novamente mais tarde! ;)<b>');
				//echo 'Mailer Error: ' . $mail->ErrorInfo;
			}else{
				if($status_i == "1"){
					//esconde parcialmente email
					$d = explode("@",$email_i);
					$rest = substr($d["0"], 0, 3);
					$email_n = $rest."*********@".$d["1"];
					$retMsg = '<br><br>'.$class_fLNG->txt(__FILE__,__LINE__,'Foi enviado um email de confirmação para: !!email!!, verifique sua caixa de spam caso não localize o email!',array("email"=>'<b>'.$email_n.'</b>'));
					//$retMsg .= '<br><br><b>CASO NÃO TENHA MAIS ACESSO A SEU EMAIL</b><br>Pode nos solicitar uma alteração de seu email atual, <b>tenha em mão um documento pessoal com foto! <br><b>Gostaria de abrir uma solicitação para alterar seu email em seu cadastro?<br><button class="btn" onClick="tabAcaoauxiliar(\\\'ajusteEmail\\\');">SIM, Abrir solicitação de suporte <i class="icon-pencil"></i></button>';
					$_SESSION["LOGIN_ACAO_FORM"] = "ajusteEmail";
				}else{
					$retMsg = '<br>'.$class_fLNG->txt(__FILE__,__LINE__,'Foi enviado um email de confirmação para: !!email!!, verifique sua caixa de spam caso não localize o email!<br>*Siga as intruções de ativação nesse email...',array("email"=>'<b>'.$email_i.'</b>'));
					//$retMsg .= '<br><br><b>OPA... PERCEBI QUE AINDA NEM CONFIRMOU SEU EMAIL!</b> <br>Como ainda não realizou seu primeiro acesso, se não tem mais acesso ao email acima, podemos ainda permitir que altere o email acima... <br><b>Gostaria de alterar esse email em seu cadastro?</b><br><button class="btn" onClick="tabAcaoauxiliar(\\\'ajusteInicial\\\');">SIM, Alterar meu email agora <i class="icon-pencil"></i></button>';
					//criar vars de permissão de email
					$_SESSION["LOGIN_ACAO_FORM"] = "ajusteInicial";
				}
			}
			//#################### FIM ENVIA EMAIL ##################<<<<<<<<<<<<<<
		}//fim while	
		
		if(!isset($_SESSION["SEG_SMS_TIME_L".$cad_id])){ $_SESSION["SEG_SMS_TIME_L".$cad_id] = time()-1800; }
		/*
		//envia SMS de alerta
		$resu1 = fSQL::SQL_SELECT_SIMPLES("celular", "cad_fisico_celular", "fisico_id = '".$cad_id."' AND principal = '1'", "", "1");
		while($linha = fSQL::FETCH_ASSOC($resu1)){
			$celular_n = $linha["celular"];			
			if($_SESSION["SEG_SMS_TIME_L".$cad_id] <= time()){
				//classe de envio de SMS --------------------------------------------------------->>>>>>>>>>>>>>
				$classSMS = new fSMS("token");
				$smsRet = $classSMS->setConfirma("OFF");//desliga a confirmação de reenvio automático
				$smsRet = $classSMS->enviaSMS($celular_n, $texto_sms,$time_envio="0");//enviaSMS($numero,$texto,$time_envio="0"){
				$classSMS->statsSms("GERAL");//cria stats
				//classe de envio de SMS ---------------------------------------------------------<<<<<<<<<<<<<<
				$_SESSION["SEG_SMS_TIME_L".$cad_id] = time()+120;
			}
		}//while
		*/
		
?>
<script>
	$.doTimeout( 'vTimerLEM', 1000, function(){
		$('#div_lembrar_load').fadeOut();
		$('#modal_alerta .conteudo').html("<?=$class_fLNG->txt(__FILE__,__LINE__,'Dados aceitos com sucesso!')?><br<?=$retMsg?>");
		$('#modal_alerta').modal('show');
		$('#lcpf, #ldatan').val('');
		tabLogin();
		return false;//controla o laco
	});//TIMER
</script>
<?php
	}//if(($valida == "1")){




//retorna erro de login
		if($valida == "0"){
?>
<script>
	//TIMER
	$.doTimeout( 'vTimerCAD', 200, function(){
		$('#div_lembrar_load').fadeOut();
		$('#modal_alerta .conteudo').html("<?=$msg?>");
		$('#modal_alerta').modal('show');	
		sysCaptcha2();
		return false;//controla o laco
	});//TIMER
</script>
<?php
			exit(0);
		}//fim if($valida == "0"){








	exit(0);

}//fim ajax  -------------------------------------------- <<<







//AJAX QUE VERIFICA LOGIN ---------------------------------------------------------->>>
if($ajax == "verificarlogin"){
	$c_acao = getpost_sql($_POST["acao"]);
	$uemail = getpost_sql($_POST["uemail"]);
	$upw = getpost_sql($_POST["upw"]);
	$captcha_t = getpost_sql($_POST["captcha_t"]);
	if($uemail == ""){$uemail = "bhjghjghjgggjgj"; }
	$valida = "1";
	//verifica qual captcha esta usando ...............................................................................
	//VERIFICA FORCE CAPTCHA
	$caminhoForceCaptcha = VAR_DIR_FILES.'files/captcha_login';
	$cria = fGERAL::criaPasta($caminhoForceCaptcha, "0775"); //confere a criação e retona 1
	if($cria == 1){ fBKP::bkpAddFolder($caminhoForceCaptcha); }//(confirma a criação da pasta)adiciona criação de pasta em lista de BACKUP
	$uCaptcha = str_replace("/","",$uemail); $uCaptcha = str_replace("\\","",$uCaptcha); $uCaptcha = str_replace("@","AA",$uCaptcha);
	$caminhoForceCaptchaUser = $caminhoForceCaptcha."/".$uCaptcha;
	$forceCaptchaUser = "1";//ativa o force captcha na class login
	$contForceCaptchaUser = "0";
	$forceCaptcha = "1"; $valida_captcha = "1";
	if(file_exists($caminhoForceCaptchaUser)){
		$contForceCaptchaUser = (int)file_get_contents($caminhoForceCaptchaUser);
		if($contForceCaptchaUser >= "2"){
			$valida_captcha = "0"; $forceCaptcha = "0";
			$msg_captcha = "<br>".$class_fLNG->txt(__FILE__,__LINE__,'<b>Percebemos que houve tentativas de acesso não finalizada com seu login!</b><br>Por isso, temos que verificar se você não é um robô...<br><b>CONFIRME SE NÃO É UM ROBÔ :) </b>');
			if(!isset($_POST["captcha_t"])){ $forceCaptcha = "1"; }//se nao recebeu o captcha comum lança aviso de transferência
		}
	}//if(file_exists($caminhoForceCaptchaUser)){
		
	//se nao tem force captcha
	if($forceCaptcha != "1"){
		$forceCaptchaUser = "0";//desativa o force captcha na class login
		$valida_captcha = "1"; $js_captcha = ""; $msg_captcha = $class_fLNG->txt(__FILE__,__LINE__,'O código de verificação está incorreto!');	
		if((isset($_SESSION["codigo_SEG_LOG"])) and ($captcha_t == "captcha")){//CAPTCHA NUMÉRICO
			$segFig = getpost_sql($_POST["segFig"]);
			//verifica se expirou
			$tseg = $_SESSION["time_SEG_LOG"]+90;
			if($tseg < time()){
					$valida_captcha = "0";
					$msg_captcha = $class_fLNG->txt(__FILE__,__LINE__,'<b>IMAGEM DE SEGURANÇA EXPIROU!</b><br>Informe a imagem de segurança novamente!')." :)";			
			}else{//if($tseg < time()){
				if($_SESSION["codigo_SEG_LOG"] == $segFig && !empty($_SESSION["codigo_SEG_LOG"])){ unset($_SESSION["codigo_SEG_LOG"]); }else{
					$valida_captcha = "0";
					$msg_captcha = $class_fLNG->txt(__FILE__,__LINE__,'<b>Desculpe!<br>Não conseguimos verificar se você não é um robô...</b><br>Informe a imagem de segurança corretamente!')." :) ";
				}//fim if imagem de seguranca
			}//else{//if($tseg < time()){	
		
		}else{//if((isset($_SESSION["codigo_SEG_LOG"])) and ($captcha_t == "captcha")){//CAPTCHA NUMÉRICO
			//valida sessão de registro servidor
			if($_SESSION["RE_".str_replace('.','',$_SERVER["SERVER_NAME"])] != date('dmY')){ $valida_captcha = "0"; }//validação extra sessão do form
			//valida recaptcha google
			if(isset($_POST['g-recaptcha-response'])){ $captcha_data = $_POST['g-recaptcha-response']; }
			if(!$captcha_data){ $valida_captcha = "0"; }
			if($valida_captcha == "1"){
				$respReCaptcha = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".SYS_CONFIG_RECAPTCHA."&response=".$captcha_data."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
				if($respReCaptcha["success"] != "true"){ $valida_captcha = "0"; }
				if(($respReCaptcha["challenge_ts"] == "") or ($respReCaptcha["challenge_ts"] == "null") or ($respReCaptcha["challenge_ts"] == "NULL")){ $valida_captcha = "0"; }
				if($valida_captcha == "1"){ if(isset($_SESSION["RE_".str_replace('-','',str_replace(':','',$respReCaptcha["challenge_ts"]))])){ $valida_captcha = "0"; }}
			}//if($valida_captcha == "1"){
			if($valida_captcha == "1"){ $_SESSION["RE_".str_replace('-','',str_replace(':','',$respReCaptcha["challenge_ts"]))] = $respReCaptcha["challenge_ts"]; }//reg. ultimo não aceita novamente
			if($valida_captcha != "1"){
				$msg_captcha = $class_fLNG->txt(__FILE__,__LINE__,'<b>Desculpe!<br>Não conseguimos verificar se você não é um robô...</b><br>Selecione corretamente no item anterior')." :) ";
			}//if($valida_captcha != "1"){		
			
		}//else{//if((isset($_SESSION["codigo_SEG_LOG"])) and ($captcha_t == "captcha")){//CAPTCHA NUMÉRICO
	}//if($forceCaptcha != "1"){
	
	
	
	if($valida_captcha != "1"){
		$valida = "0";
?>
<script>
	//TIMER
	$.doTimeout( 'vTimerLOGIN', 200, function(){
		$('#div_login_load').fadeOut();
		$('#modal_alerta .conteudo').html("<?=$msg_captcha?>");
		$('#modal_alerta').modal('show');
		sysCaptcha1('semrobo=1');
		return false;//controla o laco
	});//TIMER
</script>
<?php
			exit(0);
	}//if($valida_captcha != "1"){
		
	



	//verifica se existe usuarios no ID selecionado
	if($valida == "1"){
		$upw = fGERAL::cryptoSenhaDB($upw);//codifica senha
		//verifica login
		$cLogin = new classLOGIN;//inicia a classe de login
		$cLogin->setLogin($uemail);//seta variavel
		$cLogin->setSenha($upw);//seta variavel
		$cLogin->setForceCaptcha($forceCaptchaUser);//seta ativação de force captcha
		$cLogin->setForceCaptchaUrl($caminhoForceCaptchaUser);//seta caminho force captcha
		$arrayLoginRet = $cLogin->logar();
		
		//inicia verificacao de login ja encontrado		
		if($arrayLoginRet["valida"] == "1"){
			unset($_SESSION["LOGIN_ACAO_FORM_ARRAY"]);//destroe array de temp
?>
<script>
	$.doTimeout( 'vTimerLOGIN', 1000, function(){
		setCookieF('SYS_LOGIN_BLOQ', '<?=time()+300?>');
		$('#div_login_loadmsg').html('<?=$class_fLNG->txt(__FILE__,__LINE__,'Dados aceitos! montando painel...')?>');
		$('#div_login_load').fadeIn();
		<?php if($arrayLoginRet["msg_alert"] != ""){ echo 'alert("'.$arrayLoginRet["msg_alert"].'");'; }?>
		window.location='./?<?=$class_fLNG->txt(__FILE__,__LINE__,'seja_bem_vindo')?>';
		return false;//controla o laco
	});//TIMER
</script>
<?php
			exit(0);
		}else{ $valida = "0"; $msg = $arrayLoginRet["msg"]; }//if($loginRetorno == "1"){
	}//if(($valida == "1")){




//retorna erro de login
		if($valida == "0"){
?>
<script>
	//TIMER
	$.doTimeout( 'vTimerLOGIN', 200, function(){
		$('#div_login_load').fadeOut();
		$('#modal_alerta .conteudo').html("<?=$msg?>");
		$('#modal_alerta').modal('show');
		sysCaptcha1('<?php if($forceCaptchaUser == "0"){ echo 'semrobo=1'; }?>');
		$('#uemail, #upw').val('');
		return false;//controla o laco
	});//TIMER
</script>
<?php
			exit(0);
		}//fim if($valida == "0"){








	exit(0);

}//fim ajax  -------------------------------------------- <<<





































//AJAX QUE MONTA ALTERAR SENHA EXPIRADA ---------------------------------------------------------->>>
if($ajax == "alterarsenhaexpirada"){
	$valida = "1"; $msg = ""; $arrayLoginRet["reload"] = "0";
	$c_nupw = getpost_sql($_POST["nupw"]);
	$c_nupw2 = getpost_sql($_POST["nupw2"]);
	if($c_nupw != $c_nupw2){ $valida = "0"; $msg = $class_fLNG->txt(__FILE__,__LINE__,'Senhas informadas são diferentes, informe novamente!'); }
	if(strlen($c_nupw) < "6"){ $valida = "0"; $msg = $class_fLNG->txt(__FILE__,__LINE__,'Desculpe, mas sua senha deve conter no mínimo 6 caracteres!<br><b>Informe uma senha maior.</b>'); }
	
	if($valida == "1"){
		//$id_user = $cVLogin->userId();//id  do usuario
		$id_user = getpost_sql(fGERAL::getKookies("SYS_USER_ID"));//id  do usuario
		$cont_u = "0"; $reload = "0";
		$resu1 = fSQL::SQL_SELECT_SIMPLES("id,senha", "sys_login", "usuarios_id = '".$id_user."'", "", "1");
		while($linha = fSQL::FETCH_ASSOC($resu1)){
			$id_user = $linha["id"];
			$senha_user = $linha["senha"];
			$cont_u++;
			$nova_senha = fGERAL::cryptoSenhaDB($c_nupw);
			if($senha_user == $nova_senha){
				$valida = "0"; $msg = $class_fLNG->txt(__FILE__,__LINE__,'Sua senha não pode ser igual a senha anterior, utilize outra!');
			}else{//if($senha_user == $nova_senha){
				$valida = "1"; $reload = "0"; $msg = $class_fLNG->txt(__FILE__,__LINE__,'Senha alterada com sucesso!');
			}//else{//if($senha_user == $nova_senha){
		}//fim while
		if($cont_u == "0"){ $valida = "0"; $msg = $class_fLNG->txt(__FILE__,__LINE__,'Usuário não encontrado! Feche a janela e tente novamente.'); }
	}//if($valida == "1"){
	
	
	//verifica se existe usuarios no ID selecionado
	if($valida == "1"){		
		$achave = fGERAL::cptoFaisher($c_nupw."[,]".date('d/m/Y')."[,]".$id_user."[,]".rand().time(),"enc");
		
?>
<script>
	//TIMER
	$.doTimeout('vTimerLOGIN', 500, function(){
		$('#content_loadmsg').html(' <?=$class_fLNG->txt(__FILE__,__LINE__,'Senha localizada! Alterando senha, aguarde...')?>');
		$('#content_load').fadeIn();	
		faisher_ajax('div_oculta', '0', 'ajax/login_ajax.php?ajax=alterarsenha', 'nusspw=<?=$achave?>','post');
	});//TIMER
</script>
<?php
			//exit(0);
		//}else{ $valida = "0"; }//if($loginRetorno == "1"){
	}else{//if(($valida == "1")){
		
	//verifica se nao encontrou usuario
?>
<script>
	//TIMER
	$.doTimeout('vTimerLOGIN', 200, function(){
		$('#content_load').fadeOut();
		$('#modal_alerta .conteudo').html("<?=$msg?>");
		$('#modal_alerta').modal('show');
		$('#nupw, #nupw2').val('');
	});//TIMER
</script>
<?php
		//exit(0);
	}//else{//if(($valida == "1")){

}//fim ajax  -------------------------------------------- <<<





//AJAX QUE MONTA ALTERAR SENHA EXPIRADA ---------------------------------------------------------->>>
if($ajax == "alterarsenha"){
	$valida = "1";
	$c_nupw = $_POST["nusspw"];
	$d = explode("[,]",fGERAL::cptoFaisher($c_nupw,"dec"));
	$novaSenha = getpost_sql($d["0"]);
	$chave = $d["1"];
	
	
	if(($valida == "1") and ($chave != "")){	
		$cd = explode("[,]",$chave);
		if($cd["0"] != date('d/m/Y')){ $valida = "0"; }	
	}else{ $valida = "0"; }//if($valida == "1"){
	
	//verifica se existe usuarios no ID selecionado
	if(($valida == "1") and ($novaSenha != "")){		
		//verifica login
		$cVLogin = new classVLOGIN;//inicia a classe de login
		$cVLogin->loginCookie("OFF");//verifica o login e cria array de login
		$cVLogin->loginSession("senh");//faz a atualização de session do login atual
		
		//verifica a senha e realiza a alteração
		$alteraSenhaRet = $cVLogin->novaSenhaExpirada($novaSenha);//verifica validade
		//echo "<pre>"; print_r($arrayLoginRet);
		//exit(0);
		
?>
<script>
	//TIMER
	$.doTimeout('vTimerLOGIN', 500, function(){
		$('#modal_alerta #modal_alertaLabel').html('SUCESSO');
		$('#modal_alerta .modal-footer').html('<button onclick="window.location=\'./?<?=$class_fLNG->txt(__FILE__,__LINE__,'seja_bem_vindo')?>\';" class="btn btn-primary" data-dismiss="modal"><?=$class_fLNG->txt(__FILE__,__LINE__,'Ok')?></button>');
		$('#modal_alerta .conteudo').html("<?=$class_fLNG->txt(__FILE__,__LINE__,'Senha alterada com sucesso!<br><b>Utilize a nova senha no próximo aceso.</b>')?>");
		$('#content_load').fadeIn();
		$('#modal_alerta').modal('show');
		$('#content_loadmsg').html("<?=$class_fLNG->txt(__FILE__,__LINE__,'Dados aceitos! montando painel..')?>.");
		
		//TIMER
		$.doTimeout('vTimerLOGINr', 5000, function(){
			window.location='./?<?=$class_fLNG->txt(__FILE__,__LINE__,'seja_bem_vindo')?>';
		});//TIMER	
	});//TIMER
</script>
<?php
			//exit(0);
	}else{//if(($valida == "1")){
?>
<script>
	//TIMER
	$.doTimeout('vTimerLOGIN', 200, function(){
			window.location='./?<?=$class_fLNG->txt(__FILE__,__LINE__,'seja_bem_vindo')?>';
	});//TIMER
</script>
<?php
		//exit(0);
	}//else{//if(($valida == "1")){

}//fim ajax  -------------------------------------------- <<<




























//AJAX QUE MONTA DESLOQUEIA SESSION ---------------------------------------------------------->>>
if($ajax == "desbloqsession"){
	$c_nupw = getpost_sql($_POST["bloqpass"]);
	$aRet = $class_fLNG->txt(__FILE__,__LINE__,'Informe a senha corretamente!');
	//verifica login
	$cVLogin = new classVLOGIN;//inicia a classe de login
	$cVLogin->loginCookie("OFF");//verifica o login e cria array de login
	
	if($c_nupw != ""){
		$upw = fGERAL::cryptoSenhaDB($c_nupw);//codifica senha
		//verifica a senha
		$aRet = $cVLogin->loginSessionUnlock($upw);//verifica validade
	}//if($c_nupw != ""){

?>
<script>
	$.doTimeout('vTimerLOGINb', 500, function(){
<?php if($aRet == "ON"){ ?>
	setCookieF('SYS_LOGIN_BLOQ', '<?=time()+30?>');
	$("#divLoginBloq .divload").html("<?=$class_fLNG->txt(__FILE__,__LINE__,'Desbloqueado com sucesso!')?>");
	$("#divLoginBloq").fadeOut(1000);
	<?php if(isset($_GET['inicio'])){?>faisher_ajaxAba('Inicio', "<?=$class_fLNG->txt(__FILE__,__LINE__,'Hoje')?>", 'home', '');<?php }?>
<?php }else{//if($aRet == "ON"){ ?>
	$("#divLoginBloq").fadeIn();
	$("#divLoginBloq .divload").html("<?=$class_fLNG->txt(__FILE__,__LINE__,'Bloqueado, informe sua senha!')?>");
	$("#divLoginBloq #bloqPassFull").val('');
	$("#divLoginBloq #bloqPassFull").focus();
	alert('<?=$aRet?>');
<?php }//if($aRet == "ON"){ ?>
	});//TIMER
</script>
<?php


}//fim ajax  -------------------------------------------- <<<





























//fecha todas as conexoes abertas
$classe_db->FechaConexaoAll($SCRIPTOFF);//fecha conexoes
