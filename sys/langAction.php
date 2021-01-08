<?php // Breno Cruvinel - breno.cruvinel09@gmail.com
//LINGUAGEM PADRÃO DEFINIDO NO ARQUIVO DE CONFIGURAÇÃO: define("SYS_CONFIG_LANG_DEFAULT", "pt-br");//linguagem padrão do sistema - padrão html: pt-br
//echo "<br>__FILE__: ".__FILE__;
//echo "<br>__LINE__: ".__LINE__;
//ini_set('display_errors',1);ini_set('display_startup_erros',1);error_reporting(E_ALL);
























/* CLASSE DE DEFINIÇÃO DE LINGUAGENS - ( fLNG 1.1 ) ------------------------------------------------------------------>>>*/
/*

*/
class fLNG{
	private $LangDefault = "pt-br";
	private $Lang = "pt-br";	
	private $CaminhoRaiz;		
	private $CaminhoDominio;			
	private $ArrInfo;	
	private $FileLoad;
	private $ArrFileLoad;

	public function __construct($lang_default='pt-br',$caminho_raiz='',$caminho_dominio=''){	
	
		$this->LangDefault = $lang_default;	
		$this->CaminhoRaiz = str_replace('\\', '/', $caminho_raiz);//inverte as barras para verificação
		$this->CaminhoDominio = str_replace('\\', '/', $caminho_dominio);//inverte as barras para verificação		
		$lang = "";
		//verifica se recebeu linguagem
		if(isset($_GET["aLang"])){
			$aLang = str_replace(".", "", $_GET["aLang"]);
			$aLang = str_replace('\\', "", $aLang);
			$aLang = str_replace('/', "", $aLang);
			if(file_exists($this->CaminhoRaiz."LANG/".$aLang)){$lang = $aLang; }
		}//if(isset($_GET["aLang"])){
		//se não recebeu linguagem, verifica opções
		if($lang == ""){
			if(isset($_SESSION["LANG_ACTION"])){
				$lang_action = str_replace(".", "", $_SESSION["LANG_ACTION"]);
				$lang_action = str_replace('\\', "", $lang_action);
				$lang_action = str_replace('/', "", $lang_action);
				if(file_exists($this->CaminhoRaiz."LANG/".$aLang)){$lang = $lang_action; }
			}//if(isset($_GET["aLang"])){			
		}//if($lang == ""){
		//se nao localizou, coloca padrão
		if($lang == ""){ $lang = $this->LangDefault; }
		//monta dados de execução
		//echo "-".$lang;
		define("SYS_CONFIG_LANG_ACTION", $lang);//define a linguagem em uma constante
		$_SESSION["LANG_ACTION"] = $lang;
		$this->Lang = $lang;	
		$this->loadInfo();	
	}//__construct

	public function getLang(){	
		return $this->Lang;
	}//getLang

	public function pastaLang(){
		$pasta = $this->CaminhoRaiz."LANG/".$this->Lang;
		if(!file_exists($pasta)){ $pasta = ""; }	
		return $pasta;
	}//pastaLang

	private function loadInfo(){
		$pastaLang = $this->pastaLang();
		if($pastaLang != ""){
			unset($arrInfo);
			$caminho_info = $pastaLang."/info.php";
			if(file_exists($caminho_info)){
				$arr = explode("\n",file_get_contents($caminho_info));
				$arrInfo["bt"] = $arr["1"];
				$arrInfo["sigla"] = $arr["2"];
				$arrInfo["nome"] = $arr["3"];
				$arrInfo["info"] = $arr["4"];
			}
			$this->ArrInfo = $arrInfo;
		}//if($pastaLang != ""){
	}//loadInfo

	public function getInfo($var){
		return $this->ArrInfo["$var"];
	}//getInfo

	public function getLangs(){
		$pastaLang = $this->CaminhoRaiz."LANG/";
		if($pastaLang != ""){
			unset($arrList);
			$filesArray = scandir($pastaLang);
			unset($filesArray[array_search('', $filesArray)]);
			unset($filesArray[array_search('.', $filesArray)]);
			unset($filesArray[array_search('..', $filesArray)]);
			foreach ($filesArray as $pos => $valor){
				$caminho_info = $pastaLang."/".$valor."/info.php";
				if(file_exists($caminho_info)){
					$arr = explode("\n",file_get_contents($caminho_info));
					$arrI["lang"] = $valor;
					$arrI["bt"] = $arr["1"];
					$arrI["sigla"] = $arr["2"];
					$arrI["nome"] = $arr["3"];
					$arrI["info"] = $arr["4"];
					$arrList[] = $arrI;
				}
			}//fim foreach
			return $arrList;
		}//if($pastaLang != ""){
	}//getLangs

	public function loadFile($caminho_file,$dir_raiz=""){
		$caminho_file = str_replace('\\', '/', $caminho_file);
		//pega o caminho apartir do RAIZ
		if($dir_raiz == ""){ $dir_raiz = $this->CaminhoDominio; }
		if($dir_raiz == ""){ $dir_raiz = $this->CaminhoRaiz; }		
		$code_file = str_replace($dir_raiz, "", $caminho_file);//tira caminho RAIZ
		$this->FileLoad["$caminho_file"] = $code_file;
		//com caminho apartir do RAIZ, vai na pasta LANG/code 
		$pastaLang = $this->pastaLang();
		//echo "<br>".$pastaLang;
		if(($pastaLang != "") and (!isset($this->ArrFileLoad["$caminho_file"]))){
			$_file = $pastaLang."/code/".$code_file;
			if(file_exists($_file)){
				eval(str_replace('<?php', '', file_get_contents($_file)));//define/cria o array de tradução: $aLNG["tag"]
				$this->ArrFileLoad["$caminho_file"] = $aLNG;
			}
		}//if(($pastaLang != "") and ($this->ArrFileLoad == NULL)){
	}//loadFile

	/*<?=$CLASS["fLNG"]->txt(__FILE__,__LINE__,'TEXTO AQUI')?> */
	public function txt($caminho_file,$linha,$var,$array_vars=NULL,$destino=""){// $array_vars = array( 'nome' => $tentativas); -> Olá !!nome!! como vai?
		$caminho_file = str_replace('\\', '/', $caminho_file);
		$txt = "T-LNG - [".$this->FileLoad["$caminho_file"]."]LN($linha)";
		if(isset($this->ArrFileLoad["$caminho_file"])){
			$arr = $this->ArrFileLoad["$caminho_file"];
			if(isset($arr["$var"])){ 
				$locate = ["<b>", "</b>", "<strong>", "</strong>", "<br>", "<br/>"];
				$replace = ["[b]", "[/b]", "[strong]", "[/strong]", "[br]", "[br/]"];				
				$txt = str_replace($locate, $replace, $arr["$var"]);
				$txt = htmlspecialchars($txt, ENT_QUOTES);
				$txt = str_replace($replace, $locate, $arr["$var"]);				
			}
		}
		//verifica alguma var a inserir
		if(is_array($array_vars)){
			$txt = $this->arrayNoTexto($txt, $array_vars);//coloca as variaveis representadas no texto array( 'nome' => $tentativas); -> Olá !!nome!! como vai?
		}//if(is_array($array_vars)){
		//monta retorno
		return $txt;
	}//txt	

	/*<?=$CLASS["fLNG"]->assets(__FILE__,__LINE__,'img/logo.jpg')?> */
	public function assets($caminho_file,$linha,$url,$acao=''){
		$caminho_file = str_replace('\\', '/', $caminho_file);
		$ret = "A-LNG - [".$this->FileLoad["$caminho_file"]."]LN($linha)";
		$url = str_replace('assets/', "", $url); $url = str_replace("../", "", $url);
		//com caminho, vai na pasta LANG/assets 
		$pastaLang = $this->pastaLang();
		if(($pastaLang != "") and ($url != "")){
			$_file = $pastaLang."/assets/".$url;
			if(file_exists($_file)){
				$ret = "LANG/".$this->Lang."/assets/".$url;
				if($acao == "bin"){ $ret = file_get_contents($_file); }
				if($acao == "base64"){ $ret = base64_encode(file_get_contents($_file)); }
			}
		}//if(($pastaLang != "") and ($this->ArrFileLoad == NULL)){
		//monta retorno
		return $ret;
	}//assets
	
	
	
	/*inserir variaveis do array representados dem um texto.
	Exemplo:
	Variaveis representadas: !!NOME DA VARIAVEL!!
	echo arrayNoTexto( 'Olá !!your_name!!, eu sou !!my_function!!!', array( 'your_name' => 'teste', 'my_function' => 'Desenvolvedor')); 
	*/
	private function arrayNoTexto($str, $array){
		if(is_array($array)){
			foreach($array as $k => $v){
				$str = str_replace("!!".$k."!!", $v, $str);
			}
		}
		return $str;
	}//arrayNoTexto
	

	//############################################### FUNÇÕES ESTÁTICAS #############################################################
	static function Lang(){	
		return SYS_CONFIG_LANG_ACTION;
	}//Lang

}//class fLNG /* CLASSE DE DEFINIÇÃO DE LINGUAGENS - ( fLNG 1.1 ) ------------------------------------------------------------------<<<*/



//INICIA A CLASSE DE LINGUAGENS PARA IDENTIFICAÇÃO E UTILIZAÇÃO NO CÓDIGO
global $class_fLNG;//tornar declaração de classe GLOBAL
$class_fLNG = new fLNG(SYS_CONFIG_LANG_DEFAULT,VAR_DIR_RAIZ);//inicia a classe informando a linguagem padrão e o caminho da pasta LANG


/*/INICIA A CLASSE DE LINGUAGENS PARA IDENTIFICAÇÃO E UTILIZAÇÃO NO CÓDIGO
$CLASS["fLNG"] = new fLNG(SYS_CONFIG_LANG_DEFAULT,VAR_DIR_RAIZ);//inicia a classe informando a linguagem padrão e o caminho da pasta LANG
//tornar declaração de classe GLOBAL

//echo "<br>SIGLA: ".$CLASS["fLNG"]->getInfo("sigla");
//echo "<br>NOME: ".$CLASS["fLNG"]->getInfo("nome");
//echo "<br>INFO: ".$CLASS["fLNG"]->getInfo("info");
//echo "<pre>"; print_r($CLASS["fLNG"]->getLangs()); echo "</pre>";//*/
