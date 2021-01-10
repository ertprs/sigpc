<?php 

//classe de conexao ao banco de dados
class  classe_DB {
	//conexao banco pai
	var $ip = VAR_DBPAI_HOST;
	var $user = VAR_DBPAI_USER;
	var $pass = VAR_DBPAI_PASS;
	var $database = VAR_DBPAI_BASE;
	//conexao banco pai
	function AbreConexaoPai() {
		$this->connPai = mysql_connect ($this->ip,$this->user,$this->pass); // aqui declaramos a var conn como variável da classe
		mysql_set_charset('utf8', $this->connPai);
		mysql_select_db( $this->database, $this->connPai); 
		// esse "$this->" ele e utilizado para referenciar uma variável da classe
	}
	function FechaConexaoPai() {
		if($this->connPai){
			mysql_close($this->connPai); // aqui fecho a conexão se baseando na variável acima declarada
		}
	}
	  
	//fechar todas as conexoes abertas 
	function FechaConexaoAll($SCRIPTOFF) {
		if($this->connPai){
			mysql_close ($this->connPai); // aqui fecho a conexão se baseando na variável acima declarada
		}
		//inicia VAR de debug time arquivo: include "../config/globalSession.php";
		if((defined('VAR_DEBUG_TIME')) and ($SCRIPTOFF != "0")){
			// Calcula o microtime atual
			$mtime = microtime(); // Pega o microtime
			$mtime = explode(' ',$mtime); // Quebra o microtime
			$mtime = $mtime[1] + $mtime[0]; // Soma as partes montando um valor inteiro
			// Exibimos uma mensagem
			echo '<div style="background:#CCC; color:#666; border:#666 1px solid; padding:3px;" onclick="$(this).hide();">[HIDE] - ';
			echo 'Tempo de execucao: ', round($mtime - VAR_DEBUG_TIME, 4), ' seg. Memoria usada: ', round(((memory_get_peak_usage(true) / 1024) / 1024), 2), 'Mb</div>';
		}//fim if VAR_DEBUG_TIME //*/
	} 
	  
	  
} //fim class  classe_DB 




?>