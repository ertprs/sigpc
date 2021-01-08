<?php /*classe de aplicação PHP
NOME CLASSE: clientefWS
VERSAO: 1.0
AUTOR: Breno Cruvinel - breno.cruvinel09@gmail.com
UPDATE AUTOR:
UPDATE DATA:
DEPENDENCIAS: fCriptoJs
DESCICAO: CLASSE DE CLIENTE PARA WEB SERVICE fWS FIMDESCRICAO
OBS: OBRITATÓRIO INCLUDE DE CLASSE (class.fCriptoJs) FIMOBS
*///INICIO CLASSE :::...
/* ------------------------------------------------ ( clientefWS 1.0 ) ------------------------------------------------------------------>>>*/
if(!defined('clientefWS')){
	define("clientefWS", "1.0");

class clientefWS{
	private $Url;//URL DE COMUNICAÇÃO GET/POST COM O SERVIDOR - HTTP:// OU HTTPS://
	private $Fws_id;//ID DO fWS NO SERVIDOR (número inteiro)
	private $Login;//INFORMAÇÕES DE LOGIN DO CLIENTE
	private $Senha;//INFORMAÇÕES DE SENHA DO CLIENTE
	private $CompressFiles = "";//DEFINE METODO DE COMPRESSÃO (opcional) PADRÃO SEM COMPRESSÃO
	private $Chave = "";//CRAVE DE CRIPTOGRAFIA
	private $TmPost = "0";//TAMANHO DA STRING ENVIADA NA REQUISIÇÃO
	private $MaxPost = "20000000";//TAMANHO MÁXIMO DA STRING POST DE ENVIO - BYTE
	private $fCriptoJs;//VARIAVEL DE  CLASSE FCRIPTOJS
	private $Debug = "0";//VARIAVEL ATIVA DEBUG, RETORNO DOS DADOS SEM TRATAMENTO

	public function __construct($url){
		$this->Url = $url;
	}
	
	public function setFWS($fws_id){ $this->Fws_id = $fws_id; }
	public function setLogin($login){ $this->Login = $login; }
	public function setSenha($senha){ $this->Senha = $senha; }
	public function setCompressFiles($compress){ $this->CompressFiles = $compress; }
	public function setDebug($debug="1"){ $this->Debug = $debug; }
	public function setMaxPost($tm){ if($tm >= "1"){ $this->MaxPost = $tm; } }
	public function setChave($chave){
		if(strlen($chave) >= 32){
			$this->fCriptoJs = new fCriptoJs($chave);
			$this->Chave = $chave;
		}
	}
	public function getTmPost($tipo='MB'){ if($tipo == "MB"){ return round((($this->TmPost / 1024) / 1024), 2); }else{ return $this->TmPost; } }
	
	//FUNÇÃO QUE RECEBE O RETORNO DOS DADOS PARA DESCRIPTOGRAFIA E MONTAGEM DE JSON PARA ARRAY
	private function retDados($dados){
		if($this->Debug == "1"){
			return "DEBUG: ".$dados;
		}else{//if($this->Debug == "1"){
		//echo "<br>-dados1:<pre>"; print_r($dados);  echo "</pre>";
			//verifica se usa ou nao criptografia
			if($this->Chave != ""){
				//ENCRIPTAR
				$dados = $this->fCriptoJs->Decrypt($dados);			
			}
			$ret = json_decode($dados, true);
			if(is_array($ret)){ return $ret; }else{ return $dados; }
		}//else{//if($this->Debug == "1"){
	}
	
	//FUNÇÃO QUE REALIZA A BUSCA DE DADOS NO SERVIDOR fWS
	public function getWS($metodo,$dados){
		//monat array json de comunicação
		$jsonArr["login"] = $this->Login;
		$jsonArr["senha"] = $this->Senha;
		$jsonArr["metodo"] = $metodo;
		$jsonArr["dados_do_metodo"] = $dados;		
		//monta cabeçalho do web service para requisição
		$arrPost["fws_id"] = $this->Fws_id;
		$jsonString = json_encode($jsonArr);//tranforma array em string json de comunicação
		//echo "<br>-jsonString:<pre>"; print_r($jsonString);  echo "</pre>";
		//verifica se aplica compressão em arquivos BASE64
		if($this->CompressFiles == "gz"){ $arrPost["gz"] =  "1";	}
		if($this->CompressFiles == "deflate"){ $arrPost["deflate"] =  "1"; }
		//verifica se usa ou nao criptografia
		if($this->Chave != ""){
			//ENCRIPTAR
			$jsonString = $this->fCriptoJs->Encrypt($jsonString);
		}
		$arrPost["bloco_de_dados"] = $jsonString;	
		//verifica se a string de envio post não utrapassou o máximo de envio post
		$this->TmPost = mb_strlen($jsonString);
		if($this->TmPost <= $this->MaxPost){	
			//monta dados de envio
			$opts = array(
			  'http'=>array(
					'header'=>"Content-type: application/x-www-form-urlencoded",
					'method'=>'POST',
					'content'=>http_build_query($arrPost)
					)
			);
			$context = stream_context_create($opts);
			if($this->Debug == "1"){ $url = $this->Url."?debug"; }else{ $url = $this->Url; }//verifica se ativa o debug, mostrar dados direto
			return $this->retDados(trim(file_get_contents($url, false, $context)));
		}else{//if($tmString <= $this->MaxPost){
			//monta retorno de erro para tamanho máximo post atingido
			$arr["valida"] = "0";
			$arr["msg"] = "FOI ATINGIDO O TAMANHO, MÁXIMO DEFINIDO (".round((($this->MaxPost / 1000) / 1000), 2)."MB), ESTÁ TENTANDO ENVIAR: ".round((($this->TmPost / 1024) / 1024), 2)."MB";
			return $arr;
		}//else{//if($tmString <= $this->MaxPost){
	}

	//FUNÇÃO QUE RECEBE OS ARQUIVOS/APLICA A DESCOMPRESSÃO E DESCODIFICA O BASE64 PARA BINÁRIO
	public function getFile($dados){
		$dados = base64_decode($dados);
		//verifica se aplica compressão
		if($this->CompressFiles == "gz"){ $dados = @gzuncompress($dados); }//descompacta
		if($this->CompressFiles == "deflate"){ $dados = @gzinflate($dados); }//descompacta
		return $dados;
	}

	//FUNÇÃO QUE ENVIA OS ARQUIVOS/APLICA A COMPRESSÃO E ENCODIFICA PARA BASE64
	public function sendFile($dados){
		//verifica se aplica compressão
		if($this->CompressFiles == "gz"){ $dados = gzcompress($dados,9); }//compacta
		if($this->CompressFiles == "deflate"){ $dados = gzdeflate($dados,9); }//compacta
		$dados = base64_encode($dados);
		return $dados;
	}
}//class clientefWS
}//if(!defined('clientefWS'){
/* ------------------------------------------------ ( clientefWS 1.0 ) ------------------------------------------------------------------<<<*/