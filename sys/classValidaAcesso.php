<?php // Breno Cruvinel - breno.cruvinel09@gmail.com

//INICIAR ARQUIVO DE LINGUAGEM --->>>
$class_fLNG->loadFile(__FILE__);//incluir o arquivo de linguagem
//INICIAR ARQUIVO DE LINGUAGEM ---<<<

//classe de LOGIN PRINCIPAL
class  classLOGIN {
	//VARS  ------------------------------------------------------------------->>>>
	private $login;
	private $senha;
	private $forceCaptcha = "0";
	private $forceCaptchaUrl = "";
	
	//SET GET VARS ------------------------------------------------------------>>>>
	public function setLogin($var){				$this->login = fGERAL::getpost_sql($var); }
	public function setSenha($var){				$this->senha = fGERAL::getpost_sql($var); }
	public function setForceCaptcha($var){		$this->forceCaptcha = fGERAL::getpost_sql($var); }
	public function setForceCaptchaUrl($var){	$this->forceCaptchaUrl = fGERAL::getpost_sql($var); }
	public function getLogin(){	return $this->login; }
	public function getSenha(){	return $this->senha; }
	
	
	//METODOS ----------------------------------------------------------------->>>>
	public function logar(){
		global $class_fLNG;//DECLARAÇÃO DE CLASSE fLNG GLOBAL
		//verifica se existe usuarios no ID selecionado
		$valida = "1";
		$cont_u = "0"; $senha_erro_max = "4";
		$msg = ""; $msg_alert = "";
		$foto_login = "img/sem_foto.jpg";
		$where = "L.email = '".$this->getLogin()."' AND L.senha_erro < '".$senha_erro_max."' AND L.status in ('1','2','3') AND L.usuarios_id = U.id";

		//SQL_SELECT_DUPLO($campos, $tabela, $where='', $order='')
		$resu1 = fSQL::SQL_SELECT_DUPLO("L.id,L.usuarios_id,L.dispositivo_id,L.senha,L.senha_expira,L.senha_erro,L.time_u,L.time_atividade,L.status,U.code,U.fisico_id,U.nome,U.cargo,U.file,U.segundos_session,U.num_guiche,U.servicos", "sys_login L, sys_usuarios U", $where, "GROUP BY L.usuarios_id", "1");
		while($linha = fSQL::FETCH_ASSOC($resu1)){
			$id_user = $linha["id"];
			$usuarios_id_user = $linha["usuarios_id"];
			$dispositivo_id_user = $linha["dispositivo_id"];
			$senha_expira_user = $linha["senha_expira"];
			$senha_erro_user = $linha["senha_erro"];
			$senha_user = $linha["senha"];
			$time_u_user = $linha["time_u"];
			$time_atividade_user = $linha["time_atividade"];
			$status_user = $linha["status"];
			$code_user = $linha["code"];
			$fisico_id_user = $linha["fisico_id"];
			$nome_user = $linha["nome"];
			$cargo_user = $linha["cargo"];
			$file_user = $linha["file"];
			$num_guiche_user = $linha["num_guiche"];			
			$servicos_user = $linha["servicos"];			
			$segundos_session_user = $linha["segundos_session"];
			$caminho_file = VAR_DIR_FILES."files/usuarios/".$usuarios_id_user."/fotoperfil.".fGERAL::mostraExtensao($file_user);
			if(file_exists($caminho_file)){ $foto_login = $caminho_file; }
			$rm_user = fGERAL::legCode($usuarios_id_user,$code_user);
			$cont_u++;
		}//fim while
		if($cont_u == "0"){ $valida = "0"; $msg = $class_fLNG->txt(__FILE__,__LINE__,'Usuário não cadastrado!'); }
		
		//inicia verificacao de login ja encontrado
		if(($valida == "1") and ($cont_u == "1")){
			//verifica se existe o force captcha
			if(($this->forceCaptcha == "1") and ($this->forceCaptchaUrl != "")){
				if($this->getSenha() != $senha_user){
					$valida = "0";
					$msg = $class_fLNG->txt(__FILE__,__LINE__,'Usuário e senha não conferem! <br><b>Registramos essa atividade, vamos avisar o usuário...')." :)</b>";
					if(file_exists($this->forceCaptchaUrl)){
						$contForceCaptchaUser = (int)file_get_contents($this->forceCaptchaUrl);
					}else{ $contForceCaptchaUser = "0"; }//if(file_exists()){
					$contForceCaptchaUser++;
					file_put_contents($this->forceCaptchaUrl,$contForceCaptchaUser);
					fBKP::bkpFile($this->forceCaptchaUrl);//adiciona arquivo em lista de arquivo BACKUP
				}//if($this->getSenha() != $senha_user){
			}else{//if(($this->forceCaptcha == "1") and ($this->forceCaptchaUrl != "")){
				if($this->getSenha() != $senha_user){
					$valida = "0";
					$senha_erro_user++;
					$tentativas = $senha_erro_max-$senha_erro_user;
					//atualiza dados do ultimo login
					$campos = "senha_erro";
					$tabela = "sys_login";
					$valores = array($senha_erro_user,$var_SESSAO,time());
					$condicao = "id='$id_user'";
					fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
					if($tentativas == "0"){
						$msg = $class_fLNG->txt(__FILE__,__LINE__,'Usuário bloqueado! <b>Procure o administrador do sistema!</b>');
					}else{//if($tentativas == "1"){
						if($senha_erro_user <= "1"){
							$msg = $class_fLNG->txt(__FILE__,__LINE__,'Usuário e senha não conferem!');
						}else{
							if($tentativas == "1"){
								$msg = $class_fLNG->txt(__FILE__,__LINE__,'Usuário e senha não conferem! <b>Se errar novamente sua senha é bloqueada!</b>');
							}else{
								$msg = $class_fLNG->txt(__FILE__,__LINE__,'Usuário e senha não conferem! Restam !!cont!! tentativas.',array("cont"=>"<b>".$tentativas."</b>"));
							}
						}
					}//else{//if($tentativas == "1"){
				}//if($this->getSenha() != $senha_user){
			}//else{//if(($this->forceCaptcha == "1") and ($this->forceCaptchaUrl != "")){
		}//if(($valida == "1") and ($cont_u == "1")){
			
					
		
		//inicia verificacao de login ja encontrado		
		if(($valida == "1") and ($cont_u == "1")){
			$perfil_login = "0";
			//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
			$resu1 = fSQL::SQL_SELECT_SIMPLES("P.id,P.perfil_id,P.permissao_grupo_id,O.origem_id,O.apelido,O.modulos,O.status", "sys_login_pacote P, sys_perfil O", "P.usuarios_id = '$usuarios_id_user' AND P.perfil_id = O.id AND ( O.status = '1' OR O.status = '2' )", "GROUP BY P.id", "2");
			while($linha = fSQL::FETCH_ASSOC($resu1)){
				$id_login = $linha["id"];
				$perfil_id_login = $linha["perfil_id"];
				$perfil_nome_login = $linha["apelido"];
				$perfil_modulos_login = $linha["modulos"];
				$permissao_grupo_id_login = $linha["permissao_grupo_id"];
				$perfil_status_login = $linha["status"];
				$perfil_origem_id_login = $linha["origem_id"];				
				$perfil_login++;
			}//fim while
			if($perfil_login > "1"){ 
				$perfil_id_login = "0";
				$permissao_grupo_id_login = "0";
			}				
			if($perfil_login == "0"){ 
				$valida = "0"; $msg = $class_fLNG->txt(__FILE__,__LINE__,'Opss... <br>Perfil de acesso do usuário está sem acesso! <br>Entre em contato com administrador do sistema.<br>Solicite ativação de seu acesso')." :)";
			}
		}else{ $valida = "0"; }
				
		//verifica email de confirmação ---------------------------------------------------------------------
		if(($valida == "1") and ($status_user == "2")){
			$valida = "0";
			$msgConfirma = $this->enviarEmailConfirma($usuarios_id_user);
			$msg = $class_fLNG->txt(__FILE__,__LINE__,'Olá, você ainda é novo aqui...<br>Seu acesso ainda está bloqueado, aguardando a confirmação de seu email.<br>ACESSE SEU EMAIL PARA VERIFICAR!')."<br>".$msgConfirma;
		}//if(($valida == "1") and ($status_user == "2")){	
		
		//aguardando análise --------------------------------------------------------------------------------
		if(($valida == "1") and ($status_user == "3")){
			$valida = "0";
			$msg = $class_fLNG->txt(__FILE__,__LINE__,'Olá, sua solicitação de acesso ainda está pendente de análise. Aguarde o resultado da análise, será enviado para o seu e-mail!');
		}//if(($valida == "1") and ($status_user == "3")){						
		
		//aguardando negado --------------------------------------------------------------------------------
		if(($valida == "1") and ($status_user == "4")){
			$valida = "0";
			$msg = $class_fLNG->txt(__FILE__,__LINE__,'Olá, sua solicitação de acesso foi negada! Para mais informações, procure a administração').' '.SYS_CLIENTE_NOME_RESUMIDO;
		}//if(($valida == "1") and ($status_user == "4")){								

		//acesso revogado --------------------------------------------------------------------------------
		if(($valida == "1") and ($status_user == "5")){
			$valida = "0";
			$msg = $class_fLNG->txt(__FILE__,__LINE__,'Olá, seu acesso foi revogado! Para mais informações, procure a administração').' '.SYS_CLIENTE_NOME_RESUMIDO;
		}//if(($valida == "1") and ($status_user == "5")){										
				
		//cria sessao de autenticação e variaveis -----------------------------------------------------------
		if($valida == "1"){
			$origem_login = "WEB";
			$smart_login = "0";
			$var_IP = $_SERVER['REMOTE_ADDR']; 
			$var_AGENT = $_SERVER['HTTP_USER_AGENT']; 
			if(fGERAL::getKookies("SYS_GEO_DATA")){ $var_GEO = fGERAL::getKookies("SYS_GEO_DATA"); }else{ $var_GEO = ""; } 
			//cria informações do computador 
			$var_PC = $this->criaCookieDispositivoUID();//verifica id para o PC
			$id_pc = "0";
			$resu1 = fSQL::SQL_SELECT_SIMPLES("id,confianca", "sys_login_computador", "usuarios_id = '".$usuarios_id_user."' AND chave = '$var_PC'", "", "1");
			while($linha = fSQL::FETCH_ASSOC($resu1)){
				$id_pc = $linha["id"];
				$confianca_pc = $linha["confianca"];
			}//fim while
			//informações do token de login
			if(fGERAL::getKookies("SYS_LOGIN_TOKEN".$usuarios_id_user."_".$var_PC)){
				$token_i = getpost_sql(fGERAL::logFile(fGERAL::getKookies("SYS_LOGIN_TOKEN".$usuarios_id_user."_".$var_PC),"get"));
				if(strlen($token_i) != "6"){ $token_i = fGERAL::gerarChave(6,"numerico"); }
				if($confianca_pc != "1"){ $token_i = fGERAL::gerarChave(6,"numerico"); }
			}else{ $token_i = fGERAL::gerarChave(6,"numerico"); }
			if($id_pc >= "1"){
				//atualiza dados da tabela no DB
				$tabela = "sys_login_computador";
				$campos = "time,token,ip,geo";
				$valores = array(time(),$token_i,$var_IP,$var_GEO);
				$condicao = "id='$id_pc'";
				fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);				
			}else{//if($id_pc >= "1"){
				//VARS insert simples SQL
				$tabela = "sys_login_computador";
				//busca ultimo id para insert
				$id_pc = fSQL::SQL_SELECT_INSERT($tabela, "id");
				$campos = "id,usuarios_id,chave,time_i,time,token,agent,ip,geo";
				$valores = array($id_pc,$usuarios_id_user,$var_PC,time(),time(),$token_i,$var_AGENT,$var_IP,$var_GEO);
				fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);				
			}//else{//if($id_pc >= "1"){				
									
			//cria informações de sessão
			$remember = "0";//lembrar login - nao
			$var_SESSAO = fGERAL::gerarChave(20).$usuarios_id_user;
			fGERAL::kookies("SYS_USER_SESSAO",$var_SESSAO, $remember);
			fGERAL::kookies("SYS_USER_ID",$usuarios_id_user, $remember);
			$_SESSION["SYS_DISPOSITIVO_ID".SYS_COOKIE_ID] = $dispositivo_id_user;
			fGERAL::kookies("SYS_USER_FISICO_ID",$fisico_id_user, $remember);
			fGERAL::kookies("SYS_USER_RM",$rm_user, $remember);
			fGERAL::kookies("SYS_USER_TIPO","U", $remember);
			fGERAL::kookies("SYS_USER_NOME",$nome_user, $remember);
			fGERAL::kookies("SYS_USER_CARGO",$cargo_user, $remember);
			fGERAL::kookies("SYS_USER_FOTO",$foto_login, $remember);
			fGERAL::kookies("SYS_USER_PERFIL",$perfil_login, $remember);
			fGERAL::kookies("SYS_USER_PERFIL_ID",$perfil_id_login, $remember);
			fGERAL::kookies("SYS_USER_ORIGEM_ID",$perfil_origem_id_login, $remember);			
			fGERAL::kookies("SYS_USER_SERVICOS",$servicos_user, $remember);						
			fGERAL::kookies("SYS_USER_PERFIL_NOME",$perfil_nome_login, $remember);
			fGERAL::kookies("SYS_USER_PERFIL_MODULOS",$perfil_modulos_login, $remember);
			fGERAL::kookies("SYS_USER_PERFIL_STATUS",$perfil_status_login, $remember);
			fGERAL::kookies("SYS_USER_GRUPO",$permissao_grupo_id_login, $remember);
			fGERAL::kookies("SYS_USER_GRUPO_EXPEDIENTE","OFF", $remember);
			fGERAL::kookies("SYS_TIME_U",$time_u_user, $remember);
			fGERAL::kookies("SYS_SENHA_EXPIRA",$senha_expira_user, $remember);
			fGERAL::kookies("SYS_LOGIN_BLOQ",time()+300, $remember);
			fGERAL::kookies("SYS_SMART_LOGIN",$smart_login, $remember);			
			$msg = $class_fLNG->txt(__FILE__,__LINE__,'Login realizado com sucesso!');
			
			//verifica período de atividade
			unset($_SESSION["SYS_PERIODO_ATIVIDADE"]);
			$time_15dias = strtotime("+15 days");	
			if($time_atividade_user < $time_15dias){
				$_SESSION["SYS_PERIODO_ATIVIDADE"] = $time_atividade_user;//liga aviso página inicial de fimde período de atividade
			}
			
			//atualiza dados do ultimo login
			$campos = "senha_erro,sessao,time_u";
			$tabela = "sys_login";
			$valores = array("0",$var_SESSAO,time());
			$condicao = "id='$id_user'";
			fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
			
			//VARS insert simples SQL
			$tabela = "sys_login_session";
			//busca ultimo id para insert
			$id_se = fSQL::SQL_SELECT_INSERT($tabela, "id");
			$campos = "id,usuarios_id,computador_id,session,time_i,time,segundos,token,agent,ip,geo,origem,perfil_id,faisher";
			$valores = array($id_se,$usuarios_id_user,$id_pc,$var_SESSAO,time(),time(),$segundos_session_user,$token_i,$var_AGENT,$var_IP,$var_GEO,$origem_login,$perfil_id_login,"0");
			$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
			/*echo "<script>alert('sessa:".fGERAL::getKookies("SYS_USER_SESSAO")."');</script>";//*/
			$this->addStatsLogin($usuarios_id_user, $id_pc, $id_se);//adiciona stats de login
			classLOGIN::limparSession();//limpa registros de sessão atigos
			
			//verifica se existe o force captcha para limpar
			if($this->forceCaptchaUrl != ""){
				if(file_exists($this->forceCaptchaUrl)){
					if(($this->forceCaptchaUrl != "/") and ($this->forceCaptchaUrl != "./")){
						delete($this->forceCaptchaUrl);
						fBKP::bkpDelFile($this->forceCaptchaUrl);//adiciona arquivo em lista de excluídos BACKUP
					}
					$msg_alert = $class_fLNG->txt(__FILE__,__LINE__,'ATENÇÃO!\\nHouve algumas tentativas de acesso ao seu login informando a senha incorreta, acompanhe isso e em caso de dúvidas troque sua senha por uma nova senha...')." :)";
				}//if(file_exists()){
			}//if($this->forceCaptchaUrl != ""){
		}//if(($valida == "1")){
		
		//retorno
		$array_ret["valida"] = $valida;
		$array_ret["msg"] = $msg;
		$array_ret["msg_alert"] = $msg_alert;
		return $array_ret;
	}//fim function logar
	
	
	
	private function criaCookieDispositivoUID(){
		//cria informações do computador 
		if(fGERAL::getKookies("SYS_INTEGRADOR_PC_CHAVE")){ $var_PC = getpost_sql(fGERAL::getKookies("SYS_INTEGRADOR_PC_CHAVE")); }else{ $var_PC = time().fGERAL::gerarChave(5,"numerico"); } 
		fGERAL::kookies("SYS_INTEGRADOR_PC_CHAVE",$var_PC, 1);
		return $var_PC;
	}//fim function criaCookieDispositivoUID
	
	
	
	static function limparSession(){
		$timeoff = time()-SYS_SESSION_TIME;		
		//varifica sessão expirada
		$resu1 = fSQL::SQL_SELECT_SIMPLES("id,time_i,time", "sys_login_session", "time < '".$timeoff."' AND ( origem = 'WEB' OR origem = 'WEB-SMART' )", "ORDER BY time ASC", "10");
		while($linha = fSQL::FETCH_ASSOC($resu1)){
			$id_s = $linha["id"];
			$time_i_s = $linha["time_i"];
			$time_s = $linha["time"];
			if($time_i_s > "100000"){
				$segundos_online = $time_s-$time_i_s;
				//atualiza dados da tabela no DB
				$tabela = "sys_stats_login_".date('Y', $time_i_s);
				$campos = "time,segundos_online,session_id";
				$valores = array($time_s,$segundos_online,"NULL");
				$condicao = "session_id='$id_s'";
				fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
			}//if($time_i_s > "100000"){				
			//exclue o registro
			$tabela = "sys_login_session";
			$condicao = "id = '".$id_s."'";
			fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
		}//fim while
	}//fim function limparSession
	
	
	
	public function deslogar(){
		//limpa sessao
		$iSYS_USER_SESSAO = fGERAL::getKookies("SYS_USER_SESSAO");
		$iSYS_USER_ID = fGERAL::getKookies("SYS_USER_ID");
		if(($iSYS_USER_SESSAO != "") and ($iSYS_USER_ID >= "1")){
			$resu1 = fSQL::SQL_SELECT_SIMPLES("id,time_i", "sys_login_session", "usuarios_id = '".$iSYS_USER_ID."' AND session = '".$iSYS_USER_SESSAO."'", "", "1");
			while($linha = fSQL::FETCH_ASSOC($resu1)){
				$id_s = $linha["id"];
				$time_i_s = $linha["time_i"];
				if($time_i_s > "100000"){
					$segundos_online = time()-$time_i_s;
					//atualiza dados da tabela no DB
					$tabela = "sys_stats_login_".date('Y', $time_i_s);
					$campos = "time,segundos_online,session_id";
					$valores = array(time(),$segundos_online,"NULL");
					$condicao = "session_id='$id_s'";
					fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
				}//if($time_i_s > "100000"){				
				//exclue o registro
				$tabela = "sys_login_session";
				$condicao = "id = '".$id_s."'";
				fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
			}//fim while
		}
		fGERAL::kookies_OFF("SYS_USER_SESSAO");
		fGERAL::kookies_OFF("SYS_USER_ID");
		unset($_SESSION["SYS_DISPOSITIVO_ID".SYS_COOKIE_ID]);
		fGERAL::kookies_OFF("SYS_USER_FISICO_ID");
		fGERAL::kookies_OFF("SYS_USER_RM");
		fGERAL::kookies_OFF("SYS_USER_TIPO");
		fGERAL::kookies_OFF("SYS_USER_NOME");
		fGERAL::kookies_OFF("SYS_USER_CARGO");
		fGERAL::kookies_OFF("SYS_USER_FOTO");
		fGERAL::kookies_OFF("SYS_USER_PERFIL");
		fGERAL::kookies_OFF("SYS_USER_PERFIL_ID");
		fGERAL::kookies_OFF("SYS_USER_ORIGEM_ID");		
		fGERAL::kookies_OFF("SYS_USER_SERVICOS");		
		fGERAL::kookies_OFF("SYS_USER_PERFIL_NOME");
		fGERAL::kookies_OFF("SYS_USER_PERFIL_MODULOS");
		fGERAL::kookies_OFF("SYS_USER_PERFIL_STATUS");
		fGERAL::kookies_OFF("SYS_USER_GRUPO");
		fGERAL::kookies_OFF("SYS_USER_GRUPO_EXPEDIENTE");
		fGERAL::kookies_OFF("SYS_TIME_U");
		fGERAL::kookies_OFF("SYS_SENHA_EXPIRA");
		fGERAL::kookies_OFF("SYS_LOGIN_BLOQ");
		fGERAL::kookies_OFF("SYS_SMART_LOGIN");
		unset($_SESSION["SYS_PERIODO_ATIVIDADE"]);
		unset($_SESSION["SYS_FAVORITO_DATA"]);
		unset($_SESSION["guiche"]);
		unset($_SESSION["impressora_pc"]);
		unset($_SESSION["scanner_pc"]);		
		return 1;
	}//fim function deslogar
	
	
		
	//adicionar stats de login
	public function addStatsLogin($usuarios_id, $computador_id, $session_id){
		$ano = date('Y'); $mes = date('m'); $dia = date('d');
		$cont_ativo = fSQL::SQL_CONTAGEM("sys_stats_login_anos", "ano = '$ano'", "1");
		if($cont_ativo == "0"){
			//VARS insert simples SQL
			$tabela = "sys_stats_login_anos";
			//busca ultimo id para insert
			$id_a = fSQL::SQL_SELECT_INSERT($tabela, "id");
			$campos = "id,ano";
			$valores = array($id_a,$ano);
			$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);						
			//SQL LIVRE					
			$result = fSQL::SQL_GERAL("CREATE TABLE IF NOT EXISTS `sys_stats_login_".$ano."` ( `id` BIGINT NOT NULL AUTO_INCREMENT, `usuarios_id` INT NULL, `computador_id` INT NULL, `time_i` INT NOT NULL, `time` INT NOT NULL, `segundos_online` INT NOT NULL,  `session_id` BIGINT NULL, PRIMARY KEY (`id`), KEY `usuarios_id` (`usuarios_id`), KEY `computador_id` (`computador_id`), KEY `session_id` (`session_id`));");	
		}//if($cont_ativo == "0"){
		//VARS insert simples SQL
		$tabela = "sys_stats_login_".$ano;
		//busca ultimo id para insert
		$id_a = fSQL::SQL_SELECT_INSERT($tabela, "id");
		$campos = "id,usuarios_id,computador_id,time_i,session_id";
		$valores = array($id_a,$usuarios_id,$computador_id,time(),$session_id);
		$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);	
	}//fim addAcaoUser($TABELA, $ACAO, $REGISTRO){
	
	
	public function enviarEmailConfirma($id_fisico){
		global $class_fLNG;//DECLARAÇÃO DE CLASSE fLNG GLOBAL
		$retMsg = $class_fLNG->txt(__FILE__,__LINE__,'Conta já verificada!');
		$resu1 = fSQL::SQL_SELECT_SIMPLES("C.nome,L.id,L.email,L.confirma,L.status", "sys_usuarios C, sys_login L", "C.id = '$id_fisico' AND C.id = L.usuarios_id", "GROUP BY C.id", "1");
		while($linha = fSQL::FETCH_ASSOC($resu1)){
			$nome_i = $linha["nome"];
			$id_i = $linha["id"];
			$email_i = $linha["email"];
			$confirma_i = $linha["confirma"];
			$status_i = $linha["status"];
			if($status_i == "2"){
				if($confirma_i == ""){ $chave = fGERAL::gerarChave(15)."_".$id_fisico."_".rand(1,9)."1"; }else{ $chave = $confirma_i; }
				$link_ver = SYS_URLRAIZ."?v=".base64_encode($chave);
				$html_template = file_get_contents(VAR_DIR_FILES."files/templates/email/email-confirma.html");
				//monta mensagem template
				$html_template = str_replace("!url_raiz!",SYS_URLRAIZ,$html_template);
				$html_template = str_replace("!nome_fisico!",$nome_i,$html_template);
				$html_template = str_replace("!link_verificar!",$link_ver,$html_template);
				
				//atualiza dados da tabela no DB
				$campos = "confirma";
				$tabela = "sys_login";
				$valores = array($chave);
				$condicao = "id='$id_i'";
				fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
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
						'SEND_NOME' => primeiro_nome($nome_i),
						'SEND_EMAIL' => $email_i,
						'SEND_ASSUNTO' => primeiro_nome($nome_i).", ".$class_fLNG->txt(__FILE__,__LINE__,'Confirmação de email').' - '.SYS_CLIENTE_NOME_RESUMIDO,
						'SEND_BODY' => $html_template
						))),"ssl"=>array("verify_peer"=>false,"verify_peer_name"=>false)
				); $context = stream_context_create($opts);
				//informações do retorno: 0 - bloqueado acesso, 1 - sucesso, 2 - erros de configuração, 3 - erro de classe
				//echo SYS_URLRAIZ.'sys/http_send_email.php?JesusTeAma=1';
				//print_r($opts);
				$contentResp = file_get_contents(SYS_URLRAIZ.'sys/http_send_email.php?JesusTeAma=1', false, $context);
				echo $contentResp;
				if($contentResp != "1"){
					$retMsg = '<br><br>'.$class_fLNG->txt(__FILE__,__LINE__,'Opss... Ouve um problema ao enviar o email de confirmação!').' :O <br><br><b>'.$class_fLNG->txt(__FILE__,__LINE__,'Por favor, tente novamente mais tarde!').' ;)</b>';
					echo 'Mailer Error: ' . $mail->ErrorInfo;
				} else {
					$retMsg = '<br><br>'.$class_fLNG->txt(__FILE__,__LINE__,'Foi enviado um email de confirmação para').': <b>'.$email_i.'</b>, '.$class_fLNG->txt(__FILE__,__LINE__,'verifique sua caixa de span caso não localize o email!');
				}
				//#################### FIM ENVIA EMAIL ##################<<<<<<<<<<<<<<
			}//if($status_i == "2"){
		}//fim while	
		
		return $retMsg;		
	}//enviarEmailConfirma
	
	
	
	
	public function emailConfirma($chave_link){
		$chave_link = getpost_sql($chave_link);
		$retEmail = "";
		$resu1 = fSQL::SQL_SELECT_SIMPLES("id,email", "sys_login", "confirma = '$chave_link' AND status = '2'", "", "1");
		while($linha = fSQL::FETCH_ASSOC($resu1)){
			$id_i = $linha["id"];
			$retEmail = $linha["email"];			
			//atualiza dados da tabela no DB
			$campos = "confirma,status";
			$tabela = "sys_login";
			$valores = array(time(),"3");
			$condicao = "id='$id_i'";
			fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
		}//fim while			
		return $retEmail;		
	}//emailConfirma	
	
	
} //fim class  classLOGIN 









//classe valida dados de SESSAO ATIVA
class  classVLOGIN{
	//VARS  ------------------------------------------------------------------->>>>
	private $arrayLogin;
	
	//SET GET VARS ------------------------------------------------------------>>>>
	private function setArrayLogin($var){	$this->arrayLogin = $var; }//seta array interno de login
	public function getArrayLogin(){	return $this->arrayLogin; }//resgata array de login
	public function getVarLogin($var){
		if($var == "SYS_DISPOSITIVO_ID"){ $var = "SYS_DISPOSITIVO_ID".SYS_COOKIE_ID; }//ajusta var
		return $this->arrayLogin["$var"];
	}//resgata item do array de login
	public function setTokenLogin($computador_id,$token,$grava="0"){
		$id_user = fGERAL::getKookies("SYS_USER_ID");
		$pc = getpost_sql(fGERAL::getKookies("SYS_INTEGRADOR_PC_CHAVE"));
		$token_i = fGERAL::logFile($token,"send");
		fGERAL::kookies("SYS_LOGIN_TOKEN".$id_user."_".$pc,$token_i, $grava);
		if($grava == "1"){
			//atualiza dados da tabela no DB
			$tabela = "sys_login_computador";
			$campos = "confianca";
			$valores = array("1");
			$condicao = "id='$computador_id'";
			fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);	
		}
	}//seta token de login
	public function getTokenLogin(){
		$id_user = fGERAL::getKookies("SYS_USER_ID");
		$pc = getpost_sql(fGERAL::getKookies("SYS_INTEGRADOR_PC_CHAVE"));
		if(fGERAL::getKookies("SYS_LOGIN_TOKEN".$id_user."_".$pc)){ $token_i = getpost_sql(fGERAL::logFile(fGERAL::getKookies("SYS_LOGIN_TOKEN".$id_user."_".$pc),"get")); }else{ $token_i = rand().time().time()-rand(); }
		return $token_i;
	}//resgata token de login
	
	
	//METODOS ----------------------------------------------------------------->>>>
	
	//verifica se encontrou login - true e false
	public function loginConfirma(){
		if((fGERAL::getKookies("SYS_USER_SESSAO")) and (fGERAL::getKookies("SYS_USER_ID") >= "1")){
			return true;
		}else{
			return false;
		}
	}//fim function loginConfirma
	
	//verifica se a senha de acesso ao login expirou
	public function loginVerificaSenhaExpirou($caminhoRaiz="./"){
		if($caminhoRaiz == "OFF"){
			$arrayPermissao = $this->getArrayLogin();
			$cont_u = "0";
			$resu1 = fSQL::SQL_SELECT_SIMPLES("senha_expira", "sys_login", "usuarios_id = '".$arrayPermissao["SYS_USER_ID"]."'", "", "1");
			while($linha = fSQL::FETCH_ASSOC($resu1)){
				$senha_expira_user = $linha["senha_expira"];
				$cont_u++;
			}//fim while
			if($cont_u == "0"){
				return true;
			}else{			
				if($senha_expira_user > time()){
					return true;
				}else{ return false; }	
			}
			
		}else{//if($caminhoRaiz == "OFF"){
			if(fGERAL::getKookies("SYS_SENHA_EXPIRA") >= time()){
			}else{
				if(fGERAL::getKookies("SYS_SMART_LOGIN") != "1"){
					print("<script> parent.location='".$caminhoRaiz."senha.php'; </script>");//*/
					exit(0);
				}
			}
		}//else{//if($caminhoRaiz == "OFF"){
	}//fim function loginVerificaSenhaExpirou
	
	
		
	
	//verifica expediente de acesso
	public function loginExpediente($caminhoRaiz=""){
		global $class_fLNG;//DECLARAÇÃO DE CLASSE fLNG GLOBAL
		$arrRet["tela"] = ""; $arrRet["status"] = "ativo";
		if(($this->getVarLogin("SYS_USER_PERFIL_ID") >= "1") and ($this->getVarLogin("SYS_USER_PERFIL_NOME") != "")){
			$resu1 = fSQL::SQL_SELECT_SIMPLES("expediente_id", "sys_permissao_grupos", "id = '".$this->getVarLogin("SYS_USER_GRUPO")."' AND perfil_id = '".$this->getVarLogin("SYS_USER_PERFIL_ID")."'", "", "1");
			while($linha = fSQL::FETCH_ASSOC($resu1)){
				$expediente_id = $linha["expediente_id"];
				$arrRet["tela"] = "expediente";
			}//fim while
			if($expediente_id >= "1"){					
				$resu1 = fSQL::SQL_SELECT_SIMPLES("hora_ativo,hora_segunda,hora_terca,hora_quarta,hora_quinta,hora_sexta,hora_sabado,hora_domingo,ip,geo_ativo,token_ativo", "sys_permissao_expediente", "id = '$expediente_id'", "", "1");
				while($linha = fSQL::FETCH_ASSOC($resu1)){
					//verifica bloqueio por horario
					if($linha["hora_ativo"] >= "1"){
						$hora = date('H');
						$dados_horas = $linha["hora_".minusculo(semacentos(nome_diasemana("","2")))];
						if(preg_match("/\.".$hora."\./i", $dados_horas)){
							if($arrRet["tela"] == "expediente"){ $arrRet["tela"] = "hora"; }
						}else{
							$horas_leg = str_replace("[.","",$dados_horas); $horas_leg = str_replace(".]","h ",$horas_leg); $horas_leg = str_replace(".","h, ",$horas_leg);
							if($horas_leg == ""){ $horas_leg = "Hoje sem horários disponíveis!"; }
							$arrRet["tela"] = "hora";
							$arrRet["msg"] = $class_fLNG->txt(__FILE__,__LINE__,'Desculpe, seu acesso !!diasemana!! só é permitido nos horários',array("diasemana"=>nome_diasemana())).": ".$horas_leg;
							$arrRet["status"] = "bloqueado";
						}
					}//if($linha["hora_ativo"] >= "1"){
						
					//verifica bloqueio por IP
					if($linha["ip"] != ""){
						$var_IP = $_SERVER['REMOTE_ADDR']; 
						$uIP = explode(".", $var_IP);
						$sIP = explode(".", $linha["ip"]);
						$valIP = "1";
						if(($sIP["0"] != $uIP["0"]) and ($sIP["0"] != "*") and ($valIP == "1")){ $valIP = "0"; }
						if(($sIP["1"] != $uIP["1"]) and ($sIP["1"] != "*") and ($valIP == "1")){ $valIP = "0"; }
						if(($sIP["2"] != $uIP["2"]) and ($sIP["2"] != "*") and ($valIP == "1")){ $valIP = "0"; }
						if(($sIP["3"] != $uIP["3"]) and ($sIP["3"] != "*") and ($valIP == "1")){ $valIP = "0"; }
						if($valIP == "1"){
							if($arrRet["tela"] == "expediente"){ $arrRet["tela"] = "ip"; }
						}else{
							$arrRet["tela"] = "ip";
							$arrRet["msg"] = $class_fLNG->txt(__FILE__,__LINE__,'Desculpe, seu acesso não é permitido no seu IP atual').": $var_IP";
							$arrRet["status"] = "bloqueado";						
						}						
					}//if($linha["ip"] != ""){
						
					//verifica bloqueio por geo localizacao não informada
					if($linha["geo_ativo"] >= "1"){
						$geo = "";
						$resu2 = fSQL::SQL_SELECT_SIMPLES("geo", "sys_login_session", "usuarios_id = '".fGERAL::getKookies("SYS_USER_ID")."' AND session = '".fGERAL::getKookies("SYS_USER_SESSAO")."'", "", "1");
						while($linha2 = fSQL::FETCH_ASSOC($resu2)){
							$geo = $linha2["geo"];
						}//fim while
						if($geo != ""){
							if($arrRet["tela"] == "expediente"){ $arrRet["tela"] = "geo"; }
						}else{
							$arrRet["tela"] = "geo";
							$arrRet["msg"] = $class_fLNG->txt(__FILE__,__LINE__,'Desculpe, sua localização não foi compartilhada com o sistema!');
							$arrRet["status"] = "bloqueado";
						}
					}//if($linha["geo_ativo"] >= "1"){
						
					//verifica bloqueio por token sms
					if($linha["token_ativo"] >= "1"){
						$token_atual = $this->getTokenLogin();
						$geo = "";
						$resu1 = fSQL::SQL_SELECT_SIMPLES("S.token AS token_s,C.token AS token_c", "sys_login_session S, sys_login_computador C", "S.usuarios_id = '".fGERAL::getKookies("SYS_USER_ID")."' AND S.session = '".fGERAL::getKookies("SYS_USER_SESSAO")."' AND S.computador_id = C.id", "GROUP BY S.id", "1");
						while($linha = fSQL::FETCH_ASSOC($resu1)){
							$token_s = $linha["token_s"];
							$token_c = $linha["token_c"];
						}//fim while
						if(($token_s == $token_atual) and ($token_c == $token_atual)){
							if($arrRet["tela"] == "expediente"){ $arrRet["tela"] = "token"; }
						}else{
							$arrRet["tela"] = "token";
							$arrRet["msg"] = $class_fLNG->txt(__FILE__,__LINE__,'Desculpe, seu computador atual não foi definido como confiável!');
							$arrRet["status"] = "bloqueado";
						}
					}//if($linha["token_ativo"] >= "1"){
						
				}//fim while
			}//if($expediente_id >= "1"){
		}//if(($this->getVarLogin("SYS_USER_PERFIL_ID") >= "1") and ($this->getVarLogin("SYS_USER_PERFIL_NOME") != "")){
		if($arrRet["tela"] == ""){
			print("<script> parent.location='".$caminhoRaiz."pacote.php'; </script>");//*/
			exit(0);					
		}else{
			if($arrRet["status"] == "ativo"){
				$remember = "0";
				fGERAL::kookies("SYS_USER_GRUPO_EXPEDIENTE",$expediente_id, $remember);
			}			
		}
		return $arrRet;
	}//fim function loginExpediente
	
	
	
	
	//resgata dados dos cookies de login
	public function loginCookie($perfil="ON",$caminhoRaiz=""){
		global $class_fLNG;//tornar declaração de classe GLOBAL
		if($this->loginConfirma()){
			$var = "SYS_USER_SESSAO";			if(fGERAL::getKookies("$var"))  { $SYS_USER["$var"] = fGERAL::getKookies("$var");   }else{ $SYS_USER["$var"] = ""; }
			$var = "SYS_USER_ID"; 				if(fGERAL::getKookies("$var"))  { $SYS_USER["$var"] = fGERAL::getKookies("$var");   }else{ $SYS_USER["$var"] = ""; }
			$var = "SYS_DISPOSITIVO_ID".SYS_COOKIE_ID; 		if(isset($_SESSION["$var"]))	{ $SYS_USER["$var"] = $_SESSION["$var"];			}else{ $SYS_USER["$var"] = ""; }
			$var = "SYS_USER_FISICO_ID"; 		if(fGERAL::getKookies("$var"))  { $SYS_USER["$var"] = fGERAL::getKookies("$var");   }else{ $SYS_USER["$var"] = ""; }
			$var = "SYS_USER_RM"; 				if(fGERAL::getKookies("$var"))  { $SYS_USER["$var"] = fGERAL::getKookies("$var");   }else{ $SYS_USER["$var"] = ""; }
			$var = "SYS_USER_TIPO"; 			if(fGERAL::getKookies("$var"))  { $SYS_USER["$var"] = fGERAL::getKookies("$var");   }else{ $SYS_USER["$var"] = ""; }
			$var = "SYS_USER_NOME";				if(fGERAL::getKookies("$var"))  { $SYS_USER["$var"] = fGERAL::getKookies("$var");   }else{ $SYS_USER["$var"] = ""; }
			$var = "SYS_USER_CARGO";			if(fGERAL::getKookies("$var"))  { $SYS_USER["$var"] = fGERAL::getKookies("$var");   }else{ $SYS_USER["$var"] = ""; }
			$var = "SYS_USER_FOTO";				if(fGERAL::getKookies("$var"))  { $SYS_USER["$var"] = fGERAL::getKookies("$var");   }else{ $SYS_USER["$var"] = ""; }
			$var = "SYS_USER_PERFIL";			if(fGERAL::getKookies("$var"))  { $SYS_USER["$var"] = fGERAL::getKookies("$var");   }else{ $SYS_USER["$var"] = ""; }
			$var = "SYS_USER_PERFIL_ID";		if(fGERAL::getKookies("$var"))  { $SYS_USER["$var"] = fGERAL::getKookies("$var");   }else{ $SYS_USER["$var"] = ""; }
			$var = "SYS_USER_ORIGEM_ID";		if(fGERAL::getKookies("$var"))  { $SYS_USER["$var"] = fGERAL::getKookies("$var");   }else{ $SYS_USER["$var"] = ""; }			
			$var = "SYS_USER_SERVICOS";			if(fGERAL::getKookies("$var"))  { $SYS_USER["$var"] = fGERAL::getKookies("$var");   }else{ $SYS_USER["$var"] = ""; }						
			$var = "SYS_USER_PERFIL_NOME";		if(fGERAL::getKookies("$var"))  { $SYS_USER["$var"] = fGERAL::getKookies("$var");   }else{ $SYS_USER["$var"] = ""; }
			$var = "SYS_USER_PERFIL_MODULOS";	if(fGERAL::getKookies("$var"))  { $SYS_USER["$var"] = fGERAL::getKookies("$var");   }else{ $SYS_USER["$var"] = ""; }
			$var = "SYS_USER_PERFIL_STATUS";	if(fGERAL::getKookies("$var"))  { $SYS_USER["$var"] = fGERAL::getKookies("$var");   }else{ $SYS_USER["$var"] = ""; }
			$var = "SYS_USER_GRUPO";			if(fGERAL::getKookies("$var"))  { $SYS_USER["$var"] = fGERAL::getKookies("$var");   }else{ $SYS_USER["$var"] = ""; }
			$var = "SYS_USER_GRUPO_EXPEDIENTE";	if(fGERAL::getKookies("$var"))  { $SYS_USER["$var"] = fGERAL::getKookies("$var");   }else{ $SYS_USER["$var"] = ""; }
			$var = "SYS_TIME_U";				if(fGERAL::getKookies("$var"))  { $SYS_USER["$var"] = fGERAL::getKookies("$var");   }else{ $SYS_USER["$var"] = ""; }
			$var = "SYS_SENHA_EXPIRA";			if(fGERAL::getKookies("$var"))  { $SYS_USER["$var"] = fGERAL::getKookies("$var");   }else{ $SYS_USER["$var"] = ""; }
			$var = "SYS_LOGIN_BLOQ";			if(fGERAL::getKookies("$var"))  { $SYS_USER["$var"] = fGERAL::getKookies("$var");   }else{ $SYS_USER["$var"] = ""; }
			$this->setArrayLogin($SYS_USER);
			if($perfil == "ON"){
				if(($this->getVarLogin("SYS_USER_PERFIL_ID") >= "1") and ($this->getVarLogin("SYS_USER_PERFIL_NOME") != "")){
					//monta tags no array do usuario
					$resu1 = fSQL::SQL_SELECT_SIMPLES("expediente_id,permissao_tags", "sys_permissao_grupos", "id = '".$this->getVarLogin("SYS_USER_GRUPO")."' AND perfil_id = '".$this->getVarLogin("SYS_USER_PERFIL_ID")."'", "", "1");
					while($linha = fSQL::FETCH_ASSOC($resu1)){
						$expediente_id = $linha["expediente_id"];
						$permissao_tags = $linha["permissao_tags"];
					}//fim while
					$var = "SYS_USER_TAGS";			if(isset($permissao_tags))  { $SYS_USER["$var"] = $permissao_tags;   }else{ $SYS_USER["$var"] = ""; }
					$this->setArrayLogin($SYS_USER);	
					//verifica informações de expediente
					if(($expediente_id >= "1") and ($expediente_id != $this->getVarLogin("SYS_USER_GRUPO_EXPEDIENTE"))){
						print("<script> parent.location='".$caminhoRaiz."bloqueio.php'; </script>");//*/
						exit(0);
					}//if($expediente_id >= "1"){
				}else{
					$linha = fSQL::SQL_SELECT_ONE("id","sys_login_pacote","usuarios_id = '".$this->getVarLogin("SYS_USER_ID")."' and perfil_id = '2'");
					$pacote_perfil_2 = $linha["id"];
					$linha = fSQL::SQL_SELECT_ONE("id","sys_login_pacote","usuarios_id = '".$this->getVarLogin("SYS_USER_ID")."' and perfil_id = '1'");
					$pacote_perfil_1 = $linha["id"];					
					
					if($pacote_perfil_2 >= "1"){
						if($this->selecionarPacote($pacote_perfil_2)){
							print("<script>faisher_ajax('div_pacote', 'pacoteLoader', 'pacote.php', 'perfil_sel=".fGERAL::cptoFaisher($pacote_perfil_2, "enc")."');</script>");
						}
					}elseif($pacote_perfil_1 >= "1"){
						if($this->selecionarPacote($pacote_perfil_1)){
							print("<script>faisher_ajax('div_pacote', 'pacoteLoader', 'pacote.php', 'perfil_sel=".fGERAL::cptoFaisher($pacote_perfil_1, "enc")."');</script>");
						}						
					}else{
						print("<script> parent.location='".$caminhoRaiz."pacote.php'; </script>");//*/
						exit(0);					
					}//if($pacote_perfil_2 <= "0" and $pacote_perfil_1 <= "0"){ 
				}
			}//if($perfil == "ON"){
		}else{
			print("<script> parent.location='".$caminhoRaiz."login.php?sair=1'; </script>");//*/
			exit(0);
		}
	}//fim function loginCookie
	
	
	
	
	//verifica se o perfil atual tem acesso a um determinado módulo
	public function loginModuloPerfil($modulo_id){		
		$modulo_ = false;
		if(preg_match("/\.".$modulo_id."\./i", SYS_PACOTE_MODULOS)){//VERIFICA SE CLIENTE TEM O MÓDULO NOS PACOTE
			if(preg_match("/\.".$modulo_id."\./i", $this->getVarLogin("SYS_USER_PERFIL_MODULOS"))){//VERIFICA SE PERFIL TEM O MÓDULO
				$modulo_ = true;
			}//if(preg_match("/\.".$modulo_id."\./i", $this->getVarLogin("SYS_USER_PERFIL_MODULOS"))){
		}//if(preg_match("/\.".$modulo_id."\./i", SYS_PACOTE_MODULOS)){
		return $modulo_;
	}//fim function loginModuloPerfil
	
	
	
	//mantem sessão de login ativa
	public function loginSession($faisher="",$parar="ON"){
		global $class_fLNG;//tornar declaração de classe GLOBAL
		if($this->loginConfirma()){
			$iSYS_USER_SESSAO = fGERAL::getKookies("SYS_USER_SESSAO");
			$iSYS_USER_ID = fGERAL::getKookies("SYS_USER_ID");
			$iSYS_LOGIN_BLOQ = fGERAL::getKookies("SYS_LOGIN_BLOQ");
			$cont = "0";
			//monta tags no array do usuario
			$resu1 = fSQL::SQL_SELECT_SIMPLES("S.id,S.segundos,S.time_i,L.dispositivo_id,L.time_atividade", "sys_login_session S, sys_login L", "S.usuarios_id = '".$iSYS_USER_ID."' AND S.session = '".$iSYS_USER_SESSAO."' AND S.usuarios_id = L.usuarios_id", "GROUP BY L.usuarios_id", "1");
			while($linha = fSQL::FETCH_ASSOC($resu1)){
				$ses_id = $linha["id"];
				$ses_segundos = $linha["segundos"];
				$ses_time_i = $linha["time_i"];
				$ses_atividade = $linha["time_atividade"];
				$_SESSION["SYS_DISPOSITIVO_ID".SYS_COOKIE_ID] = $linha["dispositivo_id"];//atualiza cookie de informação sobre app integrador
				$cont++;
			}//fim while
			if($cont >= "1"){
				//verifica o período de atividade
				$time_15dias = strtotime("+15 days");	
				if($ses_atividade < $time_15dias){
					$_SESSION["SYS_PERIODO_ATIVIDADE"] = $ses_atividade;//liga aviso página inicial de fimde período de atividade		
				}//if($ses_atividade <= time()){
				//verifica segundos de bloqueio de sessão
				$ret = "0";
				$resto = time()-$iSYS_LOGIN_BLOQ;
				if($resto > $ses_segundos){
					if($parar == "ON"){
						//se a sessao expirou, sai do login testtt
						?>
						<script>
							$.doTimeout('vTimerLOGINBloq', 200, function(){ bloqSession(); });//TIMER
						</script>
						<?php
						if($faisher != "0"){ exit(0); }
					}//if($parar == "ON"){
					
				}else{//if($resto <= $ses_segundos){
					$ret = "1";
					$var_IP = $_SERVER['REMOTE_ADDR'];
					//atualiza informações de sessao de login
					//atualiza dados da tabela no DB
					$tabela = "sys_login_session";
					$campos = "time,ip";
					$valores = array(time(),$var_IP);
					if($faisher != ""){ $campos .= ",faisher"; $valores[] = $faisher; }
					fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, "id='$ses_id'");					
					//atualiza tempo online
					$segundos_online = time()-$ses_time_i;
					//atualiza dados da tabela no DB
					$campos = "segundos_online";
					$valores = array($segundos_online);
					fSQL::SQL_UPDATE_SIMPLES($campos, "sys_stats_login_".date('Y',$ses_time_i), $valores, "session_id='$ses_id'");
					
					
					//verifica o período de atividade - redireciona
					if($ses_atividade <= time()){
						if($parar == "ON"){
							print("<script> parent.location='pacote.php'; </script>");//*/
							exit(0);		
						}//if($parar == "ON"){		
					}//if($ses_atividade <= time()){
					
					//limpa session inativos
					classLOGIN::limparSession();
				}//else{//if($resto <= $ses_segundos){
				return $ret;
			}else{
				print("<script> parent.location='login.php?sair=1'; </script>");//*/
				exit(0);
			}
		}else{
			print("<script> parent.location='login.php?sair=1'; </script>");//*/
			exit(0);
		}
	}//fim function loginSession
	
	
	
	//desbloqueia loginde acesso bloqueado
	public function loginSessionUnlock($senha){
		global $class_fLNG;//tornar declaração de classe GLOBAL
		if($this->loginConfirma()){
			$iSYS_USER_SESSAO = fGERAL::getKookies("SYS_USER_SESSAO");
			$iSYS_USER_ID = fGERAL::getKookies("SYS_USER_ID");
			$senha = fGERAL::getpost_sql($senha);
			$origem_login = "WEB";
			$cont = "0"; $msg = "";
			//monta tags no array do usuario
			$resu1 = fSQL::SQL_SELECT_SIMPLES("id,segundos", "sys_login_session", "usuarios_id = '".$iSYS_USER_ID."' AND session = '".$iSYS_USER_SESSAO."'", "", "1");
			while($linha = fSQL::FETCH_ASSOC($resu1)){
				$ses_id = $linha["id"];
				$ses_segundos = $linha["segundos"];
				$cont++;
			}//fim while
			if($cont >= "1"){
				$cont_u = "0";
				$resu1 = fSQL::SQL_SELECT_SIMPLES("id", "sys_login", "usuarios_id = '".$iSYS_USER_ID."' AND senha = '".$senha."'", "", "1");
				while($linha = fSQL::FETCH_ASSOC($resu1)){
					$cont_u++;
				}//fim while
				if($cont_u == "0"){
					$msg = "Senha não está correta!";
				}else{
					//reativa login de acesso
					$msg = "ON";
					fGERAL::kookies("SYS_LOGIN_BLOQ",time()+60, 0);
					$var_IP = $_SERVER['REMOTE_ADDR'];
					//atualiza informações de sessao de login
					//atualiza dados da tabela no DB
					$tabela = "sys_login_session";
					$campos = "time,ip,origem";
					$valores = array(time(),$var_IP,$origem_login);
					fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, "id='$ses_id'");
				}
				
				//retorno
				return $msg;
			}else{
				print("<script> parent.location='login.php?sair=1'; </script>");//*/
				exit(0);
			}
		}else{
			print("<script> parent.location='login.php?sair=1'; </script>");//*/
			exit(0);
		}
	}//fim function loginSessionUnlock
	
	
	//altera senha expirada de usuario
	public function novaSenhaExpirada($nova_senha){
		global $class_fLNG;//tornar declaração de classe GLOBAL
		$id_u = getpost_sql(fGERAL::getKookies("SYS_USER_ID"));//id  do usuario
		if(($id_u >= "1") and ($nova_senha != "")){
		//if(($this->loginConfirma()) and ($nova_senha != "")){
			$nova_senha = fGERAL::cryptoSenhaDB($nova_senha);
			$cont_u = "0";
			$resu1 = fSQL::SQL_SELECT_SIMPLES("id", "sys_login", "usuarios_id = '".$id_u."'", "", "1");
			while($linha = fSQL::FETCH_ASSOC($resu1)){
				$id_user = $linha["id"];
				$cont_u++;
			}//fim while
			if($cont_u == "1"){
				//monta data de vencimento
				$duam_data_venc = date('d/m/Y', strtotime("+9 month"));
				//converte data de senha em time UNIX
				$senha_expira_a = time_data_hora($duam_data_venc." 00:00");
				fGERAL::kookies("SYS_SENHA_EXPIRA",$senha_expira_a, 0);
				
				//atualiza dados da tabela no DB
				$campos = "senha,senha_expira,time_s";
				$tabela = "sys_login";
				$valores = array($nova_senha,$senha_expira_a,time());
				$condicao = "id='$id_user'";
				fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
				//retorno
				return 1;				
			}else{ return 0; }
		}else{
			print("<script> parent.location='login.php?sair=1'; </script>");//*/
			exit(0);
		}
	}//fim function novaSenhaExpirada
	
	
	//altera pacote do usuario
	public function selecionarPacote($pacote_id){
		global $class_fLNG;//tornar declaração de classe GLOBAL
		if($this->loginConfirma()){
			//verifica se existe pacote no ID selecionado
			$valida = false;
			$pacote_login = "0";
			//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
			$resu1 = fSQL::SQL_SELECT_SIMPLES("P.perfil_id,P.permissao_grupo_id,O.origem_id,O.apelido,O.modulos,O.status", "sys_login_pacote P, sys_perfil O", "P.id = '".$pacote_id."' AND P.usuarios_id = '".$this->getVarLogin("SYS_USER_ID")."' AND P.perfil_id = O.id", "GROUP BY P.id", "1");
			while($linha = fSQL::FETCH_ASSOC($resu1)){
				$perfil_id_login = $linha["perfil_id"];
				$perfil_apelido_login = $linha["apelido"];
				$perfil_modulos_login = $linha["modulos"];
				$perfil_origem_id_login = $linha["origem_id"];				
				$permissao_grupo_id_login = $linha["permissao_grupo_id"];
				$status_login = $linha["status"];
				$pacote_login++;
			}//fim while
			if($pacote_login == "1"){
				$remember = "0";
				fGERAL::kookies("SYS_USER_PERFIL_ID",$perfil_id_login, $remember);
				fGERAL::kookies("SYS_USER_ORIGEM_ID",$perfil_origem_id_login, $remember);				
				fGERAL::kookies("SYS_USER_PERFIL_NOME",$perfil_apelido_login, $remember);
				fGERAL::kookies("SYS_USER_PERFIL_MODULOS",$perfil_modulos_login, $remember);
				fGERAL::kookies("SYS_USER_PERFIL_STATUS",$status_login, $remember);
				fGERAL::kookies("SYS_USER_GRUPO",$permissao_grupo_id_login, $remember);
				fGERAL::kookies("SYS_USER_GRUPO_EXPEDIENTE","OFF", $remember);
				$valida = true;
				
				//atualiza dados da session ativa
				$iSYS_USER_SESSAO = fGERAL::getKookies("SYS_USER_SESSAO");
				$iSYS_USER_ID = fGERAL::getKookies("SYS_USER_ID");
				//atualiza dados da tabela no DB
				$tabela = "sys_login_session";
				$campos = "perfil_id";
				$valores = array($perfil_id_login);
				fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, "usuarios_id = '".$iSYS_USER_ID."' AND session = '".$iSYS_USER_SESSAO."'");
			}
			return $valida;
		}else{
			print("<script> parent.location='login.php?sair=1'; </script>");//*/
			exit(0);
			return $valida;
		}
	}//fim function selecionarPacote
	
	
	
	//verifica geolocalização da sessão e adiciona a base de dados
	public function selecionarGeo(){
		$contRet = "0";
		if(fGERAL::getKookies("SYS_GEO_DATA")){ $var_GEO = fGERAL::getKookies("SYS_GEO_DATA"); }else{ $var_GEO = ""; } 
		if(($this->getVarLogin("SYS_USER_PERFIL_ID") >= "1") and ($this->getVarLogin("SYS_USER_PERFIL_NOME") != "") and ($var_GEO != "")){
			$resu1 = fSQL::SQL_SELECT_SIMPLES("id,computador_id", "sys_login_session", "usuarios_id = '".getpost_sql(fGERAL::getKookies("SYS_USER_ID"))."' AND session = '".getpost_sql(fGERAL::getKookies("SYS_USER_SESSAO"))."'", "", "1");
			while($linha = fSQL::FETCH_ASSOC($resu1)){
				$id = $linha["id"];
				$computador_id = $linha["computador_id"];
				//atualiza dados da tabela no DB
				$tabela = "sys_login_session";
				$campos = "geo";
				$valores = array($var_GEO);
				fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, "id='$id'");	
				//atualiza dados da tabela no DB
				$tabela = "sys_login_computador";
				$campos = "geo";
				$valores = array($var_GEO);
				fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, "id='$computador_id'");	
				$contRet = "1";	
			}//fim while
		}//if(($this->getVarLogin("SYS_USER_PERFIL_ID") >= "1") and ($this->getVarLogin("SYS_USER_PERFIL_NOME") != "") and ($var_GEO != "")){
		return $contRet;
	}//fim function selecionarGeo
	
	
	
	//enviar token SMS de acesso
	public function enviarTokenAcesso(){
		$celRet = ""; 
		if(($this->getVarLogin("SYS_USER_PERFIL_ID") >= "1") and ($this->getVarLogin("SYS_USER_PERFIL_NOME") != "")){
			$resu1 = fSQL::SQL_SELECT_SIMPLES("S.id,S.computador_id,S.token,U.celular,U.cpf,U.datan,U.sexo", "sys_login_session S, sys_usuarios U", "S.usuarios_id = '".getpost_sql(fGERAL::getKookies("SYS_USER_ID"))."' AND S.session = '".getpost_sql(fGERAL::getKookies("SYS_USER_SESSAO"))."' AND S.usuarios_id = U.id", "GROUP BY S.id", "1");
			while($linha = fSQL::FETCH_ASSOC($resu1)){
				$id = $linha["id"];
				$computador_id = $linha["computador_id"];
				$token = $linha["token"];
				$celular = $linha["celular"];
				$cpf = $linha["cpf"];
				$datan = $linha["datan"];
				$sexo = $linha["sexo"]; if($sexo == "M"){ $sexo = "1"; }else{ $sexo = "0"; }
				//atualiza dados da tabela no DB
				$tabela = "sys_login_session";
				$campos = "geo";
				$valores = array($var_GEO);
				fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, "id='$id'");	
				//atualiza dados da tabela no DB
				$tabela = "sys_login_computador";
				$campos = "geo";
				$valores = array($var_GEO);
				fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, "id='$computador_id'");
				//faz envio do SMS
				if(isset($_SESSION["TOKEN_SPAN"])){ $tSpan = $_SESSION["TOKEN_SPAN"]; }else{ $tSpan = "0"; }
				if($tSpan >= time()){}else{
					$_SESSION["TOKEN_SPAN"] = time()+45;//adiciona tempo de controle de span
					//classe de envio de TORPEDOS/SMS --------------------------------------------------------->>>>>>>>>>>>>>
					//dados de envio de SMS/TORPEDOS
					$nome_res = maiusculo(primeiro_nome($this->getVarLogin("SYS_USER_NOME"),"1","11"));
					$texto_torpedo = $this->enviarTokenAcessoTorpedo($nome_res,$token);
					$texto_torpedo .= "\n\n:)\n".$class_fLNG->txt(__FILE__,__LINE__,'SEGURANÇA: <u>Importante sempre proteja sua senha e seu celular!</u>');
					$parametros = "";
					$texto_sms = " ".$class_fLNG->txt(__FILE__,__LINE__,'TOKEN DE ACESSO').": ".$token;
					//classe de envio de TORPEDOS (mensagens,SMS)
					$classTORPEDO = new fTORPEDOS(VAR_DIR_RAIZ."sys/");
					$classTORPEDO->updatePessoa($this->getVarLogin("SYS_USER_NOME"),$cpf,$datan,$sexo);
					$smsRet = $classTORPEDO->sendTorpedo($cpf,$celular,$texto_sms,$texto_torpedo,$parametros);						
					//classe de envio de TORPEDOS/SMS ---------------------------------------------------------<<<<<<<<<<<<<<	
				}//if($tSpan >= time()){}else{
				$celRet = $celular;	
			}//fim while
		}//if(($this->getVarLogin("SYS_USER_PERFIL_ID") >= "1") and ($this->getVarLogin("SYS_USER_PERFIL_NOME") != "") and ($var_GEO != "")){
		return $celRet;
	}//fim function enviarTokenAcesso		
	
	/* enviarTokenAcessoTorpedo
	Funcao utilizada para enviar legenda de mensagem de torpedos no token
	*/
	private function enviarTokenAcessoTorpedo($nome,$token){
		//PROCESSA DADOS DE RETORNO
		$cnt = "0";
		$cnt++; $arrInfo[$cnt] = "Olha ".$nome.", existe uma tentativa de login no sistema agora ".date('d/m/Y H:i:s')."! \n\nTOKEN DE ACESSO: \n<b>".$token."</b>";
		$cnt++; $arrInfo[$cnt] = "Eu tenho uma informação de login no sistema ".$nome.", agora ".date('d/m/Y H:i:s')."! \n\nTOKEN DE ACESSO: \n<b>".$token."</b>";
		$cnt++; $arrInfo[$cnt] = "Opa ".$nome.", pra login no sistema agora ".date('d/m/Y H:i:s')."! \n\nTOKEN DE ACESSO: \n<b>".$token."</b>";
		$cnt++; $arrInfo[$cnt] = $nome.", pra realizar seu login no sistema agora ".date('d/m/Y H:i:s')."! \n\nTOKEN DE ACESSO: \n<b>".$token."</b>";
		$cnt++; $arrInfo[$cnt] = "Tenho uma mensagem pra você ".$nome.", pra login no sistema agora ".date('d/m/Y H:i:s')."! \n\nTOKEN DE ACESSO: \n<b>".$token."</b>";
		$cnt++; $arrInfo[$cnt] = $nome.", existe uma tentativa de login no sistema agora ".date('d/m/Y H:i:s')."! \n\nTOKEN DE ACESSO: \n<b>".$token."</b>";
		$cnt++; $arrInfo[$cnt] = "Vamos lá ".$nome.", pra realizar login no sistema agora ".date('d/m/Y H:i:s')."! \n\nTOKEN DE ACESSO: \n<b>".$token."</b>";
		$cnt++; $arrInfo[$cnt] = $nome.", vai ai a informação para login no sistema agora ".date('d/m/Y H:i:s')."! \n\nTOKEN DE ACESSO: \n<b>".$token."</b>";
		$info = $arrInfo[rand(1,$cnt)];
		return $info;
	}//enviarTokenAcessoTorpedo
	  
	  
	  
	  
	  

	
	
	//seleciona token SMS de acesso
	public function selecionaTokenAcesso($tokenSel,$grava="0"){
		$contRet = ""; if($tokenSel == ""){ $tokenSel = "GBGJjghhjFGFGHFGDH"; }
		if(($this->getVarLogin("SYS_USER_PERFIL_ID") >= "1") and ($this->getVarLogin("SYS_USER_PERFIL_NOME") != "")){
			$resu1 = fSQL::SQL_SELECT_SIMPLES("computador_id,token", "sys_login_session", "usuarios_id = '".getpost_sql(fGERAL::getKookies("SYS_USER_ID"))."' AND session = '".getpost_sql(fGERAL::getKookies("SYS_USER_SESSAO"))."'", "", "1");
			while($linha = fSQL::FETCH_ASSOC($resu1)){
				$computador_id = $linha["computador_id"];
				$token = $linha["token"];
				if($token == $tokenSel){
					$this->setTokenLogin($computador_id,$tokenSel,$grava);
					$contRet++;
				}//if($token == $tokenSel){
			}//fim while
		}//if(($this->getVarLogin("SYS_USER_PERFIL_ID") >= "1") and ($this->getVarLogin("SYS_USER_PERFIL_NOME") != "") and ($var_GEO != "")){
		return $contRet;
	}//fim function selecionaTokenAcesso
	  
	  

	/*FUNCAO verifica array de login: $TAGS_ARRAY[] = $TAG; $TAGSEXTRA_ARRAY["$TAG"] = $TAGEXTRA; */
	public function loginAcesso($PERMISSAO,$EXTRA="",$SEM_MARCADOR="0",$PERFIL_STATUS="0"){
		if($SEM_MARCADOR != "1"){
			//monta nome da permissao removendo marcador de perfil
			$d = explode("_", "[.".$PERMISSAO); if($d["0"] == "[.0"){ $PERMISSAO = fGERAL::getKookies("SYS_USER_PERFIL_ID").str_replace($d["0"], "", "[.".$PERMISSAO); }
		}//if($SEM_MARCADOR != "1"){
		$vPERMISSAO = $PERMISSAO;
		$vEXTRA = $EXTRA;
		$arrayPermissao = $this->getArrayLogin();
		$arrayPermissao = unserialize($arrayPermissao["SYS_USER_TAGS"]);
		$arrayPermissaoTAGS = $arrayPermissao["tags"];
		$arrayPermissaoTAGSEXTRA = $arrayPermissao["tagsextra"];
		$RET = false;
		if(in_array($vPERMISSAO, $arrayPermissaoTAGS)){
			$where = "( F.include = '".$vPERMISSAO."' OR F.permissao_tag = '".$vPERMISSAO."' ) AND F.modulo_id = M.modulo_id AND M.perfil_id = '".fGERAL::getKookies("SYS_USER_PERFIL_ID")."'";
			$resu1 = fSQL::SQL_SELECT_SIMPLES("M.modulo_id", "sys_menu_files F, sys_perfil_modulos M", $where, "GROUP BY F.id", "1");
			while($linha1 = fSQL::FETCH_ASSOC($resu1)){
				//verifica pacote de cliente
				if(preg_match("/\.".$linha1["modulo_id"]."\./i", SYS_PACOTE_MODULOS)){
					if($vEXTRA != ""){
						if(($this->getVarLogin("SYS_USER_PERFIL_STATUS") == "1") or ($vEXTRA == "tds") or ($PERFIL_STATUS != "0")){//libera só em perfil ativo
							$aExtra = explode(",", $arrayPermissaoTAGSEXTRA["$vPERMISSAO"]);
							if(in_array($vEXTRA, $aExtra)){ $RET = true; }//confirma
						}
					}else{
						$RET = true;//confirma
					}
				}//preg_match
			}//while
		}//in_array
		return $RET;
	}//fim loginAcesso 
	  


	/*FUNCAO valida array de login para redirecionar, protege paginas */
	public function loginAcessoProtege($URL,$PERMISSAO,$EXTRA=""){
		$vPERMISSAO = $PERMISSAO;
		$vEXTRA = $EXTRA;
		if(($this->loginAcesso($vPERMISSAO,$vEXTRA)) or ($vPERMISSAO == "") or ($vPERMISSAO == "0")){}else{
			print("<script> parent.location='".$URL."'; </script>");//*/
			exit(0);
		}//if($this->loginAcesso
	}//fim loginAcesso  
	  


	/*FUNCAO verifica array de login: tem o id de perfil verificado */
	public function loginAcessoPerfil($PERFIL){
		$arrayPermissao = $this->getArrayLogin();
		$RET = false;
		if($arrayPermissao["SYS_USER_PERFIL_ID"] == $PERFIL){
			$RET = true;//confirma
		}//in_array
		return $RET;
	}//fim loginAcessoPerfil 
	  


	/*FUNCAO retorna array de departamentos do grupo de permissoes do usuário $ARRAY["principal"] $ARRAY["adicional"][]
	Exemplo para validação se um departamento pertence ao usuario de login pelo ID do departamento
	Exemplo: $ret = $cVLogin->loginDeptos("todos","1"); $ret é igual a 1 ou 0, 1 == sim
	*/
	public function loginDeptos($acao="",$id_ver="0"){
		$arrayPermissao = $this->getArrayLogin();
		//busca grupo
		$linha1 = fSQL::SQL_SELECT_ONE("perfil_depto_id,perfil_deptos", "sys_permissao_grupos", "id = '".$arrayPermissao["SYS_USER_GRUPO"]."'");
		if($acao == "principal"){
			$ARRAY = $linha1["perfil_depto_id"];
		}else{
			if($acao == "array"){
				$linha1["perfil_deptos"] = arrayDB($linha1["perfil_deptos"]);
				$ARRAY = $linha1;
			}else{
				$ARRAY["principal"] = $linha1["perfil_depto_id"];
				$perfil_deptos = arrayDB($linha1["perfil_deptos"]);
				//busca lista departamentos auxiliares
				$perfil_deptos_n = "";
				if(($perfil_deptos != "") and ($perfil_deptos != " ") and ($perfil_deptos != ".") and ($perfil_deptos != "[.]")){
					//monta array de dados
					$ARRAY["adicional"] = explode(".", $perfil_deptos);
				}//if($perfil_deptos != ""){
			}
		}//if($acao == "principal"){
		if(($acao == "lista") or ($acao == "cont")){
			if(is_array($ARRAY)){
				if(isset($ARRAY["adicional"])){
					$lsita_ = $ARRAY["adicional"];
				}
				$lsita_[] = $ARRAY["principal"];
			}else{
				$lsita_[] = $ARRAY;
			}
			unset($ARRAY); $ARRAY = $lsita_;
			if($acao == "cont"){ $ARRAY = ceil(count($ARRAY)); }
		}//if(($acao == "lista") or ($acao == "cont")){
		//verifica se tem ID recebido na lista
		if($id_ver >= "1"){
			if(is_array($ARRAY)){
				if(isset($ARRAY["adicional"])){
					$lsita_ = $ARRAY["adicional"];
				}
				$lsita_[] = $ARRAY["principal"];
			}else{
				$lsita_[] = $ARRAY;
			}
			//verifica em array
			if(in_array($id_ver, $lsita_)){ $ARRAY = "1"; }else{ $ARRAY = "0"; }
		}//if($id_ver >= "1"){
		return $ARRAY;
	}//fim loginDeptos 



//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
	
	//monta id de usuario para verificações ou registros
	public function userId(){
		return $this->getVarLogin("SYS_USER_ID");
	}//fim function userId
	
	public function userFisicoId(){
		return $this->getVarLogin("SYS_USER_FISICO_ID");
	}//fim function userFisicoId
	
	//monta nome do perfil de seleção
	public function perfil(){
		return $this->getVarLogin("SYS_USER_PERFIL_NOME");
	}//fim function perfil
	
	//monta nome de usuario para registros
	public function userReg($acao="todos"){
		$nome_user = fGERAL::limpaCode($this->getVarLogin("SYS_USER_ID"))."- ".primeiro_nome($this->getVarLogin("SYS_USER_NOME"),"2");
		if($acao == "nome"){
			$nome_user = primeiro_nome($this->getVarLogin("SYS_USER_NOME"),"2");
		}
		return $nome_user;
	}//fim function userReg

	
	/*Função monta o icone de Arquivo
	Exempplode USO:
	$nome = "imagem.jpg";
	$caminho_file = "uploads/temp/";//caminho para buscat o thumb
	echo mostra_ico_upload($nome, $caminho_file);*/
	//mostra_ico_upload($nome, $caminho_file)
	public function icoFile($nome, $file_thumb=''){
		global $class_fLNG;//DECLARAÇÃO DE CLASSE fLNG GLOBAL
			$extensao = fGERAL::mostraExtensao($nome);
			//busca a ICO
			//se for DOC gera thumb de exibicao
			$extensoes_doc = array("doc", "docx", "rtf", "txt", "odt");
			if(in_array($extensao, $extensoes_doc)){ $imagem_exib = "img/file_icons/ico_doc.png"; }
	
			//se for POWERPOINT gera thumb de exibicao
			$extensoes_doc = array("ppsx", "pptx", "pps", "ppt", "odp");
			if(in_array($extensao, $extensoes_doc)){ $imagem_exib = "img/file_icons/ico_ppt.png"; }
			
			//se for EXEL gera thumb de exibicao
			$extensoes_doc = array("xls", "xlsx", "ods");
			if(in_array($extensao, $extensoes_doc)){ $imagem_exib = "img/file_icons/ico_xls.png"; }
			
			//se for PDF gera thumb de exibicao
			$extensoes_doc = array("pdf");
			if(in_array($extensao, $extensoes_doc)){ $imagem_exib = "img/file_icons/ico_pdf.png"; }
			
			//se for ZIP gera thumb de exibicao
			$extensoes_doc = array("zip");
			if(in_array($extensao, $extensoes_doc)){ $imagem_exib = "img/file_icons/ico_zip.png"; }
			
			//se for RAR gera thumb de exibicao
			$extensoes_doc = array("rar");
			if(in_array($extensao, $extensoes_doc)){ $imagem_exib = "img/file_icons/ico_rar.png"; }
			
			//se for VIDEO gera thumb de exibicao
			$extensoes_doc = array("flv", "mp4");
			if(in_array($extensao, $extensoes_doc)){ $imagem_exib = "img/file_icons/ico_video.png"; }
			
			//se for MP3 gera thumb de exibicao
			$extensoes_doc = array("mp3");
			if(in_array($extensao, $extensoes_doc)){ $imagem_exib = "img/file_icons/ico_mp3.png"; }
			
			//se for CDR COREL gera thumb de exibicao
			$extensoes_doc = array("cdr");
			if(in_array($extensao, $extensoes_doc)){ $imagem_exib = "img/file_icons/ico_cdr.png"; }
			
			//se for AI ILUSTRATOR gera thumb de exibicao
			$extensoes_doc = array("ai");
			if(in_array($extensao, $extensoes_doc)){ $imagem_exib = "img/file_icons/ico_ai.png"; }
			
			//se for PSD PHOTOSHOP gera thumb de exibicao
			$extensoes_doc = array("psd");
			if(in_array($extensao, $extensoes_doc)){ $imagem_exib = "img/file_icons/ico_psd.png"; }
			
			//se for imagem gera thumb de exibicao
			$extensoes_img = array("gif", "png", "jpg", "jpeg");
			if(in_array($extensao, $extensoes_img)){ $imagem_exib = $nome; }
	
			if($file_thumb != "RETORNAURL"){
				$imagem_exib = "<img src=\"".$file_thumb."img.php?".$this->imgFile($imagem_exib,'58','58')."\" style=\"padding:1px; border:#FFF 1px solid; width:58px; height:58px;\" />";			
			}
			return $imagem_exib;//retorna o valor
	}//fim icoFile($nome, $caminho_file);



	//Função monta imagem
	public function imgFile($file, $w='58', $h='58', $varget=''){
		global $class_fLNG;//DECLARAÇÃO DE CLASSE fLNG GLOBAL
		$file_ico = $this->icoFile($file, "RETORNAURL");
		if($varget != ""){ $varget = "&".$varget; }
		$arrayPermissao = $this->getArrayLogin();
		//echo "<br>file_ico:".$file_ico."||file:".$file;
		if((($file_ico == "img/file_icons/ico_pdf.png") and ($w == "full")) or ($w == "REGISTRO")){//verifica se é PDF
			if($h != "58"){ $title = $h; }else{ $title = $class_fLNG->txt(__FILE__,__LINE__,'Visualizar PDF'); }
			return 'p='.fGERAL::cptoFaisher($arrayPermissao["SYS_USER_ID"]."[,]".time().rand(), "enc")."&pdf=".fGERAL::cptoFaisher($file, "enc").$varget."&".rand(9,9999).'&iframe=true&width=100%&height=100%" title="'.$title.'"';
		}else{//if($file == "img/file_icons/ico_pdf.png"){
			return 'i='.fGERAL::cptoFaisher($arrayPermissao["SYS_USER_ID"]."[,]".time().rand(), "enc")."&imagem=".fGERAL::cptoFaisher($file_ico, "enc")."&w=".$w."&h=".$h.$varget."&".rand(9,9999);
		}//else{//if($file == "img/file_icons/ico_pdf.png"){
	}//fim imgFile($nome, $caminho_file);



	//Função monta imagem usar: classVLOGIN::imgFileSys()
	public function imgFileSys($file, $w='58', $h='58'){
		$file = classVLOGIN::icoFile($file, "RETORNAURL");
		return "i=".fGERAL::cptoFaisher("0[,]".time().rand(), "enc")."&imagem=".fGERAL::cptoFaisher($file, "enc")."&w=".$w."&h=".$h."&".rand(9,9999);
	}//fim imgFileSys($nome, $caminho_file);



	//Função monta imagem de foto de usuario
	public function imgUser($USER, $w='58', $h='58'){
		$arrayPermissao = $this->getArrayLogin();
		$file = "img/sem_foto.jpg";
		//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
		$resu1 = fSQL::SQL_SELECT_SIMPLES("file", "sys_usuarios", "id = '".$USER."'", "", "1");
		while($linha = fSQL::FETCH_ASSOC($resu1)){
			$file_user = $linha["file"];
			if($file_user != ""){
				$caminho_file = VAR_DIR_FILES."files/usuarios/".$USER."/fotoperfil.".fGERAL::mostraExtensao($file_user);
				if(file_exists($caminho_file)){ $file = $caminho_file; }				
			}
		}//fim while
		if($w == "RETORNO"){
			if($file != "img/sem_foto.jpg"){ return 1; }else{ return 0; }
		}else{
			return "i=".fGERAL::cptoFaisher($arrayPermissao["SYS_USER_ID"]."[,]".time().rand(), "enc")."&imagem=".fGERAL::cptoFaisher($file, "enc")."&w=".$w."&h=".$h."&".rand(9,9999);
		}
	}//fim imgUser($IDUSER, TAMANHO, TAMANHO);


  


	/*FUNCAO verifica arquivo de download */
	public function varsDownalod($URL,$FILE){
		$arrayPermissao = $this->getArrayLogin();
		return "i=".fGERAL::cptoFaisher($arrayPermissao["SYS_USER_ID"]."[,]".time().rand(), "enc")."&f=".fGERAL::cptoFaisher($URL, "enc")."&n=".$FILE;
	}//fim varsDownalod 
	
	


		


	//função de montagem de POP de detalhes
	public function popDetalhes($tipo,$id_a,$faisher,$titulo,$acao="0",$text="",$pop="1"){
		global $class_fLNG;//DECLARAÇÃO DE CLASSE fLNG GLOBAL
		//monta nome da permissao removendo marcador de perfil - $d = explode("_", "[.".$faisher); if($d["0"] == "0"){ $faisher = fGERAL::getKookies("SYS_USER_PERFIL_ID").str_replace($d["0"], "", "[.".$faisher); }
		$AJAX_PAG = "ajax/faisher.php";	 $var = "";
		//executa com permissao EDIT
		if($acao == "edit"){
			///VERIFICA PERMISSÕES DE ACESSO
			if($this->getVarLogin("SYS_USER_PERFIL_STATUS") == "1"){//libera só em perfil ativo
				if(($faisher != "") and ($this->loginAcesso($faisher))){
					if($tipo == "V"){//EXIBIR NA VISUALIZAÇÃO
						$var = "<button type=\"button\" class=\"btn icon-edit\" rel=\"tooltip\" data-placement=\"right\" data-original-title=\"".$class_fLNG->txt(__FILE__,__LINE__,'Editar')."\" onclick=\"pmodalHtml('<i class=icon-external-link></i> ".$titulo."','".$AJAX_PAG."','get','faisher=".$faisher."&ajax=registro&id_a=".$id_a."&POP=".$pop."');\">".$text."</button> ";
					}
					if($tipo == "N"){
						$var = "<button type=\"button\" class=\"btn icon-search\" rel=\"tooltip\" data-placement=\"left\" data-original-title=\"".$class_fLNG->txt(__FILE__,__LINE__,'Editar')."\" onclick=\"pmodalHtml('<i class=icon-search></i> ".$titulo."','".$AJAX_PAG."','get','faisher=".$faisher."&ajax=registro&id_a=".$id_a."&POP=".$pop."');\" style=\"float:right;\">".$text."</button> ";
					}
					if($tipo == "S"){//USAR EM SCRIPTS COM TRANSFERENCIA DE HTML DENTRO DE ''
						$var = '<button type="button" class="btn btn-inverse icon-external-link" rel="tooltip" data-placement="left" data-original-title="'.$class_fLNG->txt(__FILE__,__LINE__,'Editar').'" onclick="pmodalHtml(\\\'<i class=icon-external-link></i> '.$titulo.'\\\',\\\''.$AJAX_PAG.'\\\',\\\'get\\\',\\\'faisher='.$faisher.'&ajax=registro&id_a='.$id_a.'&POP='.$pop.'\\\');\">'.$text.'</button> ';
					}
					if($tipo == "C"){//USAR NO PRENCHIMENTO DO COMBO JSON
						$var = '<button type="button" class="btn icon-edit" rel="tooltip" data-placement="left" data-original-title="'.$class_fLNG->txt(__FILE__,__LINE__,'Editar').'" onclick="pmodalHtml(\'<i class=icon-external-link></i> '.$titulo.'\',\''.$AJAX_PAG.'\',\'get\',\'faisher='.$faisher.'&ajax=registro&id_a='.$id_a.'&POP='.$pop.'\');" style="float:right;">'.$text.'</button> ';
					}
					if($tipo == "P"){//USAR NA ABERTURA DE POPUP
						$var = '<button type="button" class="btn icon-edit" rel="tooltip" data-placement="left" data-original-title="'.$class_fLNG->txt(__FILE__,__LINE__,'Editar').'" onclick=pmodalHtml("<i class=icon-external-link></i> '.$titulo.'","'.$AJAX_PAG.'","get","faisher='.$faisher.'&ajax=registro&id_a='.$id_a.'&POP='.$pop.'");" style="float:right;">'.$text.'</button> ';
					}
				}//if(($faisher != "") and ($this->loginAcesso($faisher))){
			}//if($this->getVarLogin("SYS_USER_PERFIL_STATUS") == "1"){//libera só em perfil ativo
			
		}elseif($acao == "onclick"){
			///VERIFICA PERMISSÕES DE ACESSO
			if(($faisher != "") and ($this->loginAcesso($faisher))){
				$var = "pmodalHtml('<i class=icon-external-link></i> ".$titulo."','".$AJAX_PAG."','get','faisher=".$faisher."&ajax=visualizar&id_a=".$id_a."&POP=".$pop."');";
			}//if(($faisher != "") and ($this->loginAcesso($faisher))){
		}else{//if($acao == "onclick"){
			//executa com permissao FULLVIEW
			if($acao == "fullview"){
				$d["0"] = date('Ymd'); $d["1"] = $d["0"]; $FULL = base64_encode((fGERAL::cryptoSys(fGERAL::jsonArray($d,"enc"))));
				if($tipo == "V"){//EXIBIR NA VISUALIZAÇÃO
					$var = "<button type=\"button\" class=\"btn icon-external-link\" rel=\"tooltip\" data-placement=\"right\" data-original-title=\"".$class_fLNG->txt(__FILE__,__LINE__,'Detalhar')."\" onclick=\"pmodalHtml('<i class=icon-external-link></i> ".$titulo."','".$AJAX_PAG."','get','faisher=".$faisher."&ajax=visualizar&id_a=".$id_a."&FULLVIEW=".$FULL."&POP=".$pop."');\">".$text."</button> ";
				}
				if($tipo == "N"){
					$var = '<button type=\"button\" class=\"btn icon-external-link\" rel=\"tooltip\" data-placement=\"left\" data-original-title=\"'.$class_fLNG->txt(__FILE__,__LINE__,'Detalhar').'\" onclick=\"pmodalHtml(\'<i class=icon-external-link></i> '.$titulo.'\',\''.$AJAX_PAG.'\',\'get\',\'faisher='.$faisher.'&ajax=visualizar&id_a='.$id_a.'&FULLVIEW='.$FULL.'&POP='.$pop.'\');\" style=\"float:right;\">'.$text.'</button> ';
				}
				if($tipo == "C"){//USAR NO PRENCHIMENTO DO COMBO JSON
					$var = '<button type="button" class="btn icon-external-link" rel="tooltip" data-placement="left" data-original-title="'.$class_fLNG->txt(__FILE__,__LINE__,'Detalhar').'" onclick="pmodalHtml(\'<i class=icon-external-link></i> '.$titulo.'\',\''.$AJAX_PAG.'\',\'get\',\'faisher='.$faisher.'&ajax=visualizar&id_a='.$id_a.'&FULLVIEW='.$FULL.'&POP='.$pop.'\');" style="float:right;">'.$text.'</button> ';
				}
				if($tipo == "P"){//USAR NA ABERTURA DE POPUP
					$var = '<button type="button" class="btn icon-external-link" rel="tooltip" data-placement="left" data-original-title="'.$class_fLNG->txt(__FILE__,__LINE__,'Detalhar').'" onclick=pmodalHtml("<i class=icon-external-link></i> '.$titulo.'","'.$AJAX_PAG.'","get","faisher='.$faisher.'&ajax=visualizar&id_a='.$id_a.'&FULLVIEW='.$FULL.'&POP='.$pop.'");" style="float:right;">'.$text.'</button> ';
				}
				if($tipo == "O"){//USAR NO ONCLICK
					$var = 'pmodalHtml(\'<i class=icon-external-link></i> '.$titulo.'\',\''.$AJAX_PAG.'\',\'get\',\'faisher='.$faisher.'&ajax=visualizar&id_a='.$id_a.'&FULLVIEW='.$FULL.'&POP='.$pop.'\');';
				}
				
			}else{//if($fullview == "1"){
				///VERIFICA PERMISSÕES DE ACESSO
				if(($faisher != "") and ($this->loginAcesso($faisher))){
					if($tipo == "V"){//EXIBIR NA VISUALIZAÇÃO
						$var = "<button type=\"button\" class=\"btn icon-external-link\" rel=\"tooltip\" data-placement=\"right\" data-original-title=\"".$class_fLNG->txt(__FILE__,__LINE__,'Detalhar')."\" onclick=\"pmodalHtml('<i class=icon-external-link></i> ".$titulo."','".$AJAX_PAG."','get','faisher=".$faisher."&ajax=visualizar&id_a=".$id_a."&POP=".$pop."');\">".$text."</button> ";
					}
					if($tipo == "N"){
						$var = '<button type=\"button\" class=\"btn icon-external-link\" rel=\"tooltip\" data-placement=\"left\" data-original-title=\"'.$class_fLNG->txt(__FILE__,__LINE__,'Detalhar').'\" onclick=\"pmodalHtml(\'<i class=icon-external-link></i> '.$titulo.'\',\''.$AJAX_PAG.'\',\'get\',\'faisher='.$faisher.'&ajax=visualizar&id_a='.$id_a.'&POP='.$pop.'\');\" style=\"float:right;\">'.$text.'</button> ';
					}
					if($tipo == "C"){//USAR NO PRENCHIMENTO DO COMBO JSON
						$var = '<button type="button" class="btn icon-external-link" rel="tooltip" data-placement="left" data-original-title="'.$class_fLNG->txt(__FILE__,__LINE__,'Detalhar').'" onclick="pmodalHtml(\'<i class=icon-external-link></i> '.$titulo.'\',\''.$AJAX_PAG.'\',\'get\',\'faisher='.$faisher.'&ajax=visualizar&id_a='.$id_a.'&POP='.$pop.'\');" style="float:right;">'.$text.'</button> ';
					}
					if($tipo == "P"){//USAR NA ABERTURA DE POPUP
						$var = '<button type="button" class="btn icon-external-link" rel="tooltip" data-placement="left" data-original-title="'.$class_fLNG->txt(__FILE__,__LINE__,'Detalhar').'" onclick=pmodalHtml("<i class=icon-external-link></i> '.$titulo.'","'.$AJAX_PAG.'","get","faisher='.$faisher.'&ajax=visualizar&id_a='.$id_a.'&POP='.$pop.'");" style="float:right;">'.$text.'</button> ';
					}
				}//if(($faisher != "") and ($this->loginAcesso($faisher))){
			}//else{//if($fullview == "1"){
				
		}//else{//if($acao == "edit"){
		return $var;
	}//popDetalhes
	
	
	
	
	
	
	public function linkMENU($var_include,$varget="",$acao="include"){
		$sql_inc = "include = '$var_include'";
		//monta nome da permissao removendo marcador de perfil
		$d = explode("_", "[.".$var_include); if($d["0"] == "[.0"){
			$var_tag = fGERAL::getKookies("SYS_USER_PERFIL_ID").str_replace($d["0"], "", "[.".$var_include);
			$sql_inc = "( include = '$var_tag' OR include = '$var_include' )";
		}
		$resui = fSQL::SQL_SELECT_SIMPLES("include,permissao_tag,mapa_guia,mapa_menu,mapa_submenu,mapa_submenuextra", "sys_menu_files", "$sql_inc", "");
		while($linhai = fSQL::FETCH_ASSOC($resui)){
			if($this->loginAcesso($linhai["permissao_tag"],"","1")){ $leg = "";
				if(($linhai["mapa_submenuextra"] >= "1") and ($leg == "")){ $linham = fSQL::SQL_SELECT_ONE("nome_min", "sys_menu_guia_menu_submenu_submenuextra", "id = '".$linhai["mapa_submenuextra"]."'"); $leg = $linham["nome_min"]; }
				if(($linhai["mapa_submenu"] >= "1") and ($leg == "")){ $linham = fSQL::SQL_SELECT_ONE("nome_min", "sys_menu_guia_menu_submenu", "id = '".$linhai["mapa_submenu"]."'"); $leg = $linham["nome_min"]; }
				if(($linhai["mapa_menu"] >= "1") and ($leg == "")){ $linham = fSQL::SQL_SELECT_ONE("nome_min", "sys_menu_guia_menu", "id = '".$linhai["mapa_menu"]."'"); $leg = $linham["nome_min"]; }
				if($acao == "popup"){
					$varRet = "faisher_ajaxAba('".$linhai["mapa_guia"]."', '".htmlspecialchars($leg, ENT_QUOTES)."', '".$linhai["include"]."', '".$varget."');pmodalDisplay('hide');";
				}elseif($acao == "popup-java"){
					$varRet = "faisher_ajaxAba(\'".$linhai["mapa_guia"]."\', \'".htmlspecialchars($leg, ENT_QUOTES)."\', \'".$linhai["include"]."\', \'".$varget."\');pmodalDisplay(\'hide\');";
				}else{//include
					$varRet = "faisher_ajaxAba('".$linhai["mapa_guia"]."', '".htmlspecialchars($leg, ENT_QUOTES)."', '".$linhai["include"]."', '".$varget."');";
				}
			}
		}//fim while
		return $varRet;
	}//linkMENU
	
	
	
	
	
	//Função monta ações do usuário usuario, funcções auxiliar para referencia de dados: fTBL::numeroTabela($TABELA),fTBL::idAcaoTabela($ACAO)
	public function addAcaoUser($TABELA, $ACAO, $REGISTRO){
		$ano = date('Y'); $mes = date('m'); $dia = date('d');
		$cont_ativo = fSQL::SQL_CONTAGEM("sys_stats_usuarios_anos", "ano = '$ano'", "1");
		if($cont_ativo == "0"){
			//VARS insert simples SQL
			$tabela = "sys_stats_usuarios_anos";
			//busca ultimo id para insert
			$id_a = fSQL::SQL_SELECT_INSERT($tabela, "id");
			$campos = "id,ano";
			$valores = array($id_a,$ano);
			$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);						
			//SQL LIVRE					
			$result = fSQL::SQL_GERAL("CREATE TABLE IF NOT EXISTS `sys_stats_usuarios_".$ano."` ( `id` BIGINT NOT NULL AUTO_INCREMENT, `perfil_id` INT NULL, `usuarios_id` INT NULL, `ano` INT(4) NOT NULL, `mes` INT(2) NOT NULL, `dia` INT(2) NOT NULL, `tabela_num` INT NULL, `acao_id` INT NULL, `registro` VARCHAR(50) NULL, `time` INT NULL, PRIMARY KEY (`id`), KEY `perfil_id` (`perfil_id`), KEY `usuarios_id` (`usuarios_id`), KEY `acao_id` (`acao_id`));");	
		}//if($cont_ativo == "0"){
		//VARS insert simples SQL
		$tabela = "sys_stats_usuarios_".$ano;
		//busca ultimo id para insert
		$id_a = fSQL::SQL_SELECT_INSERT($tabela, "id");
		$campos = "id,perfil_id,usuarios_id,ano,mes,dia,tabela_num,acao_id,registro,time";
		$valores = array($id_a,$this->getVarLogin("SYS_USER_PERFIL_ID"),$this->getVarLogin("SYS_USER_ID"),$ano,$mes,$dia,fTBL::numeroTabela($TABELA),fTBL::idAcaoTabela($ACAO),fGERAL::limpaCode($REGISTRO),time());
		$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);	
	}//fim addAcaoUser($TABELA, $ACAO, $REGISTRO){
	

	
	  
} //fim class  classVLOGIN 


?>