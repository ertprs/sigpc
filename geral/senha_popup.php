<?php
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="pt-br">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="../css/plugins/jquery-ui/smoothness/jquery-ui.css">
<link rel="stylesheet" href="../css/plugins/jquery-ui/smoothness/jquery.ui.theme.css">
<!--<link rel="stylesheet" href="/js/jquery/theme/jquery-ui-1.7.1.custom.css" type="text/css" />-->
<!--<link rel="stylesheet" href="themes//css/default.css" type="text/css" />-->
<!--<link rel="stylesheet" href="themes//css/triagem.css" type="text/css" />-->
<style>
/**
	TRIAGEM > IMPRESSÃO
*/
#imprime{
	background: #ffffff;
	margin: 0;
	text-align:center;
	width: 200px;
	height: 170px;
}
#imprime #imp_unid{
	font-family:arial, helvetica, sans-serif;
	font-size: 8pt;
	text-align:center;
}
#imprime #imp_senha{
	font-size:30pt;
	font-weight:bold;
	font-family:arial, helvetica, sans-serif;
}
#imprime #imp_senha #imp_data{
	text-align:center;
	font-family:arial, helvetica, sans-serif;
	font-size:10pt;
}
#imprime #imp_frase{
	font-family:arial, helvetica, sans-serif;
	font-size:8pt;
	text-align:center;
}
</style>
</head>
<body onLoad="window.print();" >
    <div align="center" id="imprime">
        <div align="center" id="imp_unid">
            <?php echo $_GET["nome"];?> <br />
                <?php echo "Type de mot de passe";?>
        </div>
        <div align="center" id="imp_senha">
            <?php echo $_GET["senha"]?>
            <div id="imp_data"><?php echo date("d/m/Y H:i"). $_GET["prioridade"];?></div>
        </div>
        <div align="center" id="imp_frase"><?php echo $_GET["unidade"];?></div>
    </div>
</body>
</html>