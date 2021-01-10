<?php



define('MODULO', 'LOGIN');

if (!Session::getInstance()->exists(AXL::K_CURRENT_MODULE)) {
	// TODO módulo padrão deve ser configuravel
	header("Location:?mod=axl.inicio");
}

if (AXL::is_logged()) {
    header("Location:?mod=" . Session::getInstance()->get(AXL::K_CURRENT_MODULE)->get_chave());
}

// JS Login
$misc = '<script>
            AXL.addOnLoadListener( function() { $("#login_usu").get(0).focus(); } );
         </script>';

Template::display_header("AXL Livre", $misc);
Template::display_login_header();
if (Session::getInstance()->get(AXL::K_LOGIN_ERROR)) {
	Template::display_error(Session::getInstance()->get(AXL::K_LOGIN_ERROR));
	Session::getInstance()->del(AXL::K_LOGIN_ERROR);
}
Template::display_login_form('Enviar', '?reg_log');
Template::display_footer();
?>