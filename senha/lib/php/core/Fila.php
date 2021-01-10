<?php



/**
 * Classe Fila
 * 
 * Responsavel pelo controle da fila (Cliente e Servico)
 * 
 */
class Fila {
	
	private $atendimentos = array();
	
	public function __construct($atendimentos) {
		$this->set_atendimentos($atendimentos);
	}	
	
	/**
	 * @param array $atendimentos 
	 * 	  
	 */
	private function set_atendimentos($atendimentos) {
		$this->atendimentos = $atendimentos;
	}
	
	/**
	 * Retorna o Atendimento contido na posicao especifica da fila
	 * 
	 * @param int $i (index)
	 * @return Atendimento
	 */
	public function get($i) {
		return $this->atendimentos[$i];
	}
	
	/**
	 * Retorna todos Atendimentos da fila
	 * 
	 * @return array
	 */
	public function get_atendimentos() {
		return $this->atendimentos;
	}

	/**
	 * Define o Atendimento contido na posicao especifica da fila
	 * 
	 * @param int $i (index)
	 * @param Atendimento $atendimento
	 * @return bool
	 */
	public function set($i, $atendimento) {
		if (isset($this->atendimentos[$i])) {
			$this->atendimentos[i] = $atendimento;
			return true;
		}
		return false;
	}	
	
	/**
	 * Adiciona na fila um Atendimento
	 */
	public function add($atendimento) {
		if (is_a($cliente,"Atendimento")) {
			array_push($this->fila, $atendimento);
		} else {
			throw new Exception("Erro ao adicionar Atendimento na fila, tipo invalido.");
		}
	}
	
	/**
	 * Remove o Atendimento da posicao especifica da fila
	 * 
	 * @param int $i (index)
	 * @return bool
	 */
	public function remove($i) {
		if (isset($this->atendimentos[$i])) {
			unset($this->atendimentos[$i]);
			return true;
		}
		return false;
	}
	
	/**
	 * Retorna a quantidade de Atendimentos na fila
	 * 
	 * @return int
	 */
	public function size() {
		return sizeof($this->atendimentos);
	}
	
	
	/**
	 * Retorna se tem ou nao gente na fila
	 * @return bool
	 */
	public function has_fila() {
		return ($this->size() > 0);
	}
	
	/**
	 * Retorna quantidade total da fila
	 * @return String
	 */
	public function toString() {
		return "Fila_Object_TOTAL:" . $this->size();
	}
	
	/**
	 * Retorna resultado do método toString
	 * @return String
	 */
	public function __tostring() {
		return $this->toString(); 
	}
	
}

?>
