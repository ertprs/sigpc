<?php



/**
 * Classe Grupo
 * 
 * Atraves do grupo e definido o acesso do Usuario
 * 
 */
class Grupo {

	private $id = 0;
	private $nome = '';
	private $descricao = '';
	private $is_raiz;
	private $pai;
    private $filhos = array();
	
	public function __construct($id, $nome, $descricao, $is_raiz = false) {
		$this->set_id($id);
		$this->set_nome($nome);
		$this->set_descricao($descricao);
		$this->set_raiz($is_raiz);
	}

	/**
	 * Define o id do Grupo
	 *
	 * @param int $id
	 */
	public function set_id($id) {
		$this->id = $id;
	}

	/**
	 * Retorna o id do Grupo
	 *
	 * @return int
	 */
	public function get_id() {
		return $this->id;
	}

	/**
	 * Define o nome do Grupo
	 *
	 * @param String $nome
	 */
	public function set_nome($nome) {
		$this->nome = $nome;
	}
	
	/**
	 * Retorna a descrição do Grupo
	 *
	 * @return int
	 */
	public function get_descricao() {
		return $this->descricao;
	}

	/**
	 * Define a descrição do Grupo
	 *
	 * @param String $nome
	 */
	public function set_descricao($descricao) {
		$this->descricao = $descricao;
	}

	/**
	 * Retorna o nome do Grupo
	 *
	 * @return String
	 */
	public function get_nome() {
		return $this->nome;
	}
	
	/**
	 * Define se o grupo é a raiz da arvore de grupos
	 *
	 * @param boolean $b
	 */
	public function set_raiz($b) {
		$this->is_raiz = $b;
	}

	/**
	 * Retorna se o grupo é a raiz da arvore de grupos
	 *
	 * @return bool
	 */
	public function is_raiz() {
			return $this->is_raiz;
	}

	/**
	 * Define o pai do Grupo
	 *
	 * @param String $nome
	 */
	public function set_pai($pai) {
		$this->pai = $pai;
	}

	/**
	 * Retorna o nome do Grupo
	 *
	 * @return String
	 */
	public function get_pai() {
		// Instancia o pai sob demanda
		if ($this->pai == null) {
			$this->set_pai(DB::getInstance()->get_grupo_pai_by_id($this->get_id()));
		}
		return $this->pai;
	}

	/**
	 * Adiciona filho
     * @param $grupo
     * @return none
	 */
    public function add_filho(Grupo $grupo) {
        $this->filhos[] = $grupo;
    }

    /**
     * Retorna arra de filhos
     * @return $filhos array
     */
    public function get_filhos() {
        return $this->filhos;
    }

    /**
     * Retorna arra de filhos
     * @return $filhos array
     */
    public function clear_filhos() {
        $this->filhos = array();
    }
}

?>
