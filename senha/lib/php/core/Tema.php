<?php



/**
 * Classe Tema
 * 
 * Tema (visual) aplicado no sistema
 * 
 */
class Tema {

	private $id;
	private $nome;	
	private $descricao;
	private $autor;
	private $dir;

	public function __construct($id, $nome, $descricao, $autor, $dir) {
		$this->set_id($id);
		$this->set_nome($nome);
		$this->set_descricao($descricao);
		$this->set_autor($autor);
		$this->set_dir($dir);
	}

	/**
	 * Define o id do Tema
	 *
	 * @param int $id
	 */
	public function set_id($id) {
		$this->id = $id;
	}

	/**
	 * Retorna o id do Tema
	 *
	 * @return int
	 */
	public function get_id() {
		return $this->id;
	}

	/**
	 * Define o nome do Tema
	 *
	 * @param String $nome
	 */
	public function set_nome($nome) {
		$this->nome = $nome;
	}

	/**
	 * Retorna o nome do Tema
	 *
	 * @return String
	 */
	public function get_nome() {
		return $this->nome;
	}

	/**
	 * Define a descricao do Tema
	 *
	 * @param String $descricao
	 */
	public function set_descricao($descricao) {
		$this->descricao = $descricao;
	}

	/**
	 * Retorna a descricao do Tema
	 *
	 * @return String
	 */
	public function get_descricao() {
		return $this->descricao;
	}
	
	/**
	 * Define o autor do Tema
	 *
	 * @param String $autor
	 */
	public function set_autor($autor) {
		$this->autor = $autor;
	}

	/**
	 * Retorna o autor do Tema
	 *
	 * @return String
	 */
	public function get_autor() {
		return $this->autor;
	}

	/**
	 * Define o diretorio do Tema
	 *
	 * @param String $dir
	 */
	public function set_dir($dir) {
		$this->dir = $dir;
	}

	/**
	 * Retorna o diretorio do Tema
	 *
	 * @return String
	 */
	public function get_dir() {
		return $this->dir;
	}
	
	/**
	 * Retorna String com nome e autor do tema
	 * @return String
	 */
	public function toString() {
		return "Tema_Object_name:{$this->get_nome()}_author:{$this->get_autor()}";
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