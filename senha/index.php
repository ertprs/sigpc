<?php



define("PATH", "");
require('lib/environ.php');

function exception_handler(Exception $exception) {
  echo "<pre><h1>AXL Fatal Exception</h1>\nUncaught exception:\n" , $exception->getMessage(), "\n\nTrace:\n".$exception->getTraceAsString().'</pre>	';
}
set_exception_handler('exception_handler');

Session::getInstance();
// error handler function
/*function error_handler()
{
    $error = error_get_last();
    if ($error) {
        echo '<pre>';
        print_r($error);
        echo '</pre>';
    }
}
register_shutdown_function("error_handler");*/

//$a=lol();

// Workaround para Magic Quotes Enabled
// Magic Quotes esta depreciado a partir do PHP 5.3.0 e será removido no PHP 6
// mas ainda vem ativado por padrão no 5.2.x
if (get_magic_quotes_gpc()) {
    function stripslashes_deep($value)
    {
        $value = is_array($value) ?
                    array_map('stripslashes_deep', $value) :
                    stripslashes($value);

        return $value;
    }

    $_POST = array_map('stripslashes_deep', $_POST);
    $_GET = array_map('stripslashes_deep', $_GET);
    $_COOKIE = array_map('stripslashes_deep', $_COOKIE);
    $_REQUEST = array_map('stripslashes_deep', $_REQUEST);
}

if (!Config::AXL_INSTALLED) {
	if (isset($_GET['inst_redir'])) {
		$value = $_GET['inst_redir'];
		if (!empty($value) && ($path = AXL::is_install_path($value))) {
	    	AXL::_include($path);
	    }
	}
	else {
		AXL::_include('install/install.php');
	}
	exit();
}

if (sizeof($_GET) == 0) {
	// redirecionar para o modulo padrão
	// TODO modulo padrão deve ser configuravel
	if ($path = AXL::is_module_path('axl.inicio')) {
		AXL::_include($path);
	}
}
else {
	foreach ($_GET as $key => $value) {
	
	    switch ($key) {
	    case AXL::K_NEED_LOGIN:
	    	
	        AXL::_include("login/index.php?mod=".$_GET['dest']);
	        break;
	    case AXL::K_REG_LOGIN:
	        AXL::_include("login/reg_log.php");
	        break;
	    case AXL::K_NEED_UNIDADE:
	        AXL::_include("unidade/index.php");
	        break;
	    case AXL::K_SET_UNIDADE:
	        AXL::_include("unidade/set_unidade.php");
	        break;
	    case AXL::K_LOGOUT:
	        AXL::_include("logout/index.php");
	        break;
	    case AXL::K_RED_MOD:
	        if (!empty($value) && ($path = AXL::is_module_path($value))) {
	        	AXL::_include($path);
	        }
	        break;
	    case AXL::K_DIALOG:
	    	if (!empty($value) && ($path = AXL::is_dialog_path($value))) {
	            AXL::_include($path);
	        }
	        break;
	    case AXL::K_RED_UNI:
	    	
	    	break;
	    case AXL::K_RED_ONLY:
	        if (!empty($value)) {
	            AXL::_include($value);
	        }
	        break;
	    default:
	    	
	    }
	}    
}



?>
