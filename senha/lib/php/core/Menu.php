<?php



/**
 * Classe Menu
 * 
 * Para controlar o menu dos modulos do sistema
 * 
 */ 
 class Menu {
 	
	private $id_menu;
	private $nome;
	private $link;
	private $descricao;
	private $ordem;
	
	# construtor
	public function __construct($id, $nome, $link, $descricao, $ordem = 0) {
		$this->set_id_menu($id);
		$this->set_nome($nome);
		$this->set_link($link);
		$this->set_descricao($descricao);
		$this->set_ordem($ordem);
	}
	
	/**
	 * Retorna id do Menu
	 * @return int
	 */
	public function get_id_menu() {
		return $this->id_menu;
	}
	
	/**
	 * Define id do Menu
	 * @param int $id
	 */
	public function set_id_menu($id) {
		if(is_int($id))
			$this->id_menu = $id;
		else
			throw new Exception("O id do Menu deve ser inteiro");
	}
	
	/**
	 * Retorna nome do Menu
	 * @return String
	 */
	public function get_nome() {
		return $this->nome;
	}
	
	/**
	 * Define nome do menu
	 * @param String $nome
	 */
	public function set_nome($nome) {
		$this->nome = $nome;
	}
	
	/**
	 * Retorna o link do Menu
	 * @return String
	 */
	public function get_link() {
		return $this->link;
	}
	
 	/**
	 * Define o link do Menu (pagina a ser aberta)
	 * @param String $link
	 */
	public function set_link($link) {
		$this->link = $link;
	}
	
 
	/**
	 * Retorna a descricao do Menu
	 * @return String
	 */
	public function get_descricao() {
		return $this->descricao;
	}
	
	/**
	 * Define a descricao do Menu
	 * @param String $descricao
	 */
	public function set_descricao($descricao) {
		$this->descricao = $descricao;
	}

	
	/**
	 * Retorna ordem
	 * @return int
	 */
	public function get_ordem() {
		return $this->ordem;
	}
	
	/**
	 * Define prioridade de exibicao
	 * @param int prioridade
	 */
	public function set_ordem($ordem) {
		if(is_int($ordem))
			$this->ordem = $ordem;
		else
			throw new Exception("A ordem deve ser inteiro");
	}
}
 
?>