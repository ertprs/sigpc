<?php



class Separador {
	
	private static $instance;
	
	private function __contruct() {
		
	}
	
	public static function getInstance() {
		if (Separador::$instance == null) {
			Separador::$instance = new Separador();
		}
		return Separador::$instance;
	}
}
?>