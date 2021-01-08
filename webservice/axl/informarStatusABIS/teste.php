<?php

//INCLUDES DE CONTROLE --->>>
include "../../../config/globalVars.php";//vars padrao
include "../../../sys/langAction.php";//vars padrao
include "../../../sys/globalFunctions.php";//funcoes padrao
include "../../../sys/globalClass.php";//classes padrao
include "../../../sys/classConexao.php";//classes de conexao
//INCLUDES DE CONTROLE ---<<<



$result = thomasWSabisProblema("193");
echo "<pre>"; print_r($result); echo "</pre>";

?>