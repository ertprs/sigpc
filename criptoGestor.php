<?php //Breno Cruvinel - breno.cruvinel09@gmail.com
	//INCLUDES DE CONTROLE --->>>
	include "config/globalSession.php";//inicia sessao php
	include "config/globalVars.php";//vars padrao
	include "sys/langAction.php";//inicia arquivo de linguagens
	include "sys/globalFunctions.php";//funcoes padrao
	include "sys/globalClass.php";//classes padrao
	include "sys/classConexao.php";//classes de conexao
	include "sys/classValidaAcesso.php";//classes de validação de acesso
	$SCRIPTOFF = "0";
	include "gestor/sys/cabecalho_ajax.php"; //cabeçalho ajax para correção de acentos e cache
	//INCLUDES DE CONTROLE ---<<<
	



?>
<?php


//usar pra montar criptografia com a chave inserida


$string = "111111";
$chave = fGERAL::cryptoSenhaDB($string);//codifica senha
?>
CHAVE GERADA: <?=$string?>
<input name="chave" type="text" value="<?=$chave?>" style="width:100%;" />