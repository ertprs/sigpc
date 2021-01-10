<?php
try {
    if (Config::AXL_INSTALLED) {
        Template::display_error('O AXL já está instalado.');
    }
    else {
        if (Session::getInstance()->exists('AXL_INSTALL_STEP')) {
            phpinfo();
        }
    }
}
catch (Exception $e) {
    Template::display_exception($e);
}
?>
