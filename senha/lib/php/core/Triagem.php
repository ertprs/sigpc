<?php



/**
*
*	Classe para gerar a Triagem
* 
* 	Possui o Usuario e os Servicos disponiveis
*
*/
class Triagem {
		
	private $usuario;
	private $servicos;

	public function __construct($usuario, $servicos) {
		$this->set_usuario($usuario);
		$this->set_servicos($servicos);
	}
	
	/**
	 * Retorna o Usuario da Triagem
	 *
	 * @return Usuario
	 */
	public function get_usuario() {
		return $this->usuario;
	}
	
	/**
	 * Define o Usuario da Triagem
	 *
	 * @param Usuario $usuario
	 */
	public function set_usuario($usuario) {
		$this->usuario = $usuario;
	}
	
	/**
	 * Retorna os Servicos da Triagem
	 *
	 * @return array
	 */
	public function get_servicos() {
		return $this->servicos;
	}	
	
	/**
	 * Define os Servicos da Triagem 
	 *
	 * @param array $servicos
	 */
	public function set_servicos($servicos) {
		$this->servicos= $servicos;
	}	

}

?>