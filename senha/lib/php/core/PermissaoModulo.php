<?php



class PermissaoModulo
{
	private $modulo;
	
	public function __construct($modulo) {
		$this->set_modulo($modulo);
	}
	
	/**
	 * Define o modulo ao qual a permissão se refere
	 * 
	 * @param $modulo 
	 * @return void
	 */
	public function set_modulo(Modulo $modulo) {
		$this->modulo = $modulo;
	}
	
	/**
	 * 
	 * @return Modulo O modulo ao qual esta permissão se refere
	 */
	public function get_modulo() {
		return $this->modulo;
	}
}
?>