<?php



class PermissaoGrupo {
	
	private $grupo;
	private $permissao;
	
	// Permissões devem ser multiplos de 2: 1, 2, 4, 8, 16...
	const PERMISSAO_LEITURA = 1;
	const PERMISSAO_ESCRITA = 2;
	
	const PERMISSAO_LEITURA_ESCRITA = 3; //PermissaoModuloGrupo::PERMISSAO_LEITURA | PermissaoModuloGrupo::PERMISSAO_ESCRITA;
	
	public function __construct(Grupo $grupo, $permissao) {
		$this->set_grupo($grupo);
		$this->set_permissao($permissao);
	}
	
	/**
	 * Define a unidade a qual a permissão se refere
	 * 
	 * @param $unidade 
	 * @return void
	 */
	public function set_grupo(Grupo $grupo) {
		$this->grupo = $grupo;
	}
	
	/**
	 * 
	 * @return Unidade A unidade a qual esta permissão se refere
	 */
	public function get_grupo() {
		return $this->grupo;
	}
	
	/**
	 * Define a permissao
	 * 
	 * @param $permissao Um booleano definindo a permissão
	 * @return void
	 */
	public function set_permissao($permissao) {
		$this->permissao = $permissao;
	}
	
	/**
	 * @return boolean true caso positiva, false caso contrário. 
	 */
	public function get_permissao() {
		return $this->permissao;
	}
	
	/**
	 * Retorna permissão para leitura
	 * @return boolean
	 */
	public function allows_read() {
		return ($this->get_permissao() & PermissaoGrupo::PERMISSAO_LEITURA) == PermissaoGrupo::PERMISSAO_LEITURA;
	}
	
	/**
	 * Retorna permissão para escrita
	 * @return boolean
	 */
	public function allows_write() {
		return ($this->get_permissao() & PermissaoGrupo::PERMISSAO_ESCRITA) == PermissaoGrupo::PERMISSAO_ESCRITA;
	}
	
	/**
	 * Retorna permissão para leitura e escrita
	 * @return boolean
	 */
	public function allows_read_write() {
		return $this->allows_read() && $this->allows_write();
	}
	
	/**
	 * Retorna String com permissão
	 * @return String
	 */
	public function toString() {
	    return "Permissão: ".$this->get_permissao();
	}
	
	/**
	 * Retorna o resultado do método toString
	 * @return String
	 */
	public function __tostring() {
		return $this->toString(); 
	}
}
?>