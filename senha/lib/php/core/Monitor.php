<?php



/**
 * Classe Monitor
 * 
 * Para gerar o Monitor
 * 
 */

class Monitor {

	private $menu = array();
	private $servicos = array();
	private $total_senhas = 0;
	
	# construtor
	public function __construct($menu, $servicos, $total) {
		$this->set_menu($menu);
		$this->set_servicos($servicos);
		$this->set_total_senhas($total);
	}

	/**
	 * Retorna o menu do Monitor (array de Menu).
	 *
	 * @return array
	 */
	public function get_menu() {
		return $this->menu;
	}
	
	/**
	 * Define o menu do Monitor
	 *
	 * @param array $menu
	 */
	public function set_menu($menu) {
		if(is_array($menu))
			$this->menu = $menu;
		else
			throw new Exception("Erro ao definir lista de menu. Deve ser um array.");
	}
	
	/**
	 * Retorna a lista dos servicos do Monitor
	 *
	 * @return array
	 */
	public function get_servicos() {
		return $this->servicos;
	}

	/**
	 * Retorna a lista dos servicos do Monitor delimitada pelos parametros
	 * (inicio e fim).
	 *
	 * @param int $ini
	 * @param int $fim
	 * @return array
	 */
	public function get_servicos_at($ini, $fim) {
		$servicos = array();
		$aux = $this->get_servicos();
		$i = 0;
		foreach ($aux as $s) {
			if ($i >= $ini && $i < $fim)
				$servicos[$s->get_id()] = $s;
			elseif ($i >= $fim)
				break;
			$i++;
		}
		return $servicos;
	}
	
	/**
	 * Define os servicos do Monitor
	 *
	 * @param array $servicos
	 */
	public function set_servicos($servicos) {
		if(is_array($servicos))
			$this->servicos = $servicos;
		else
			throw new Exception("Erro ao definir lista de servicos. Deve ser um array.");
	}
	
	/**
	 * Retorna o total de senhas do Menu
	 *
	 * @return int
	 */
	public function get_total_senhas() {
		return $this->total_senhas;
	}
	
	/**
	 * Define o total de senhas do Menu
	 *
	 * @param int $total
	 */
	public function set_total_senhas($total) {
		$total = (int) $total;
		if ($total >= 0)
			$this->total_senhas = $total;
		else
			throw new Exception("Erro ao definir total de senhas. Deve ser um inteiro positivo.");
	}	
}
?>
