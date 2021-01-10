<?php 

//vars de conexao banco de daddos pai
define("VAR_DBPAI_HOST", "172.16.250.40");
define("VAR_DBPAI_USER", "suporte");
define("VAR_DBPAI_PASS", "Eg+KIS$.Zfh");
define("VAR_DBPAI_BASE", "axlsenha");








//fuso horário
/*$timezones = array(
'AC' => 'America/Rio_branco',   'AL' => 'America/Maceio',
'AP' => 'America/Belem',        'AM' => 'America/Manaus',
'BA' => 'America/Bahia',        'CE' => 'America/Fortaleza',
'DF' => 'America/Sao_Paulo',    'ES' => 'America/Sao_Paulo',
'GO' => 'America/Sao_Paulo',    'MA' => 'America/Fortaleza',
'MT' => 'America/Cuiaba',       'MS' => 'America/Campo_Grande',
'MG' => 'America/Sao_Paulo',    'PR' => 'America/Sao_Paulo', - Etc/GMT+3
'PB' => 'America/Fortaleza',    'PA' => 'America/Belem',
'PE' => 'America/Recife',       'PI' => 'America/Fortaleza',
'RJ' => 'America/Sao_Paulo',    'RN' => 'America/Fortaleza',
'RS' => 'America/Sao_Paulo',    'RO' => 'America/Porto_Velho',
'RR' => 'America/Boa_Vista',    'SC' => 'America/Sao_Paulo',
'SE' => 'America/Maceio',       'SP' => 'America/Sao_Paulo',
'TO' => 'America/Araguaia',     
);*/
setlocale(LC_ALL, 'ptb', 'portuguese-brazil', 'pt-br', 'bra', 'brazil');
date_default_timezone_set('Etc/GMT+3');//setar fuso horário
