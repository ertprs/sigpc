<?php



/**
 * 
 * Classe Cliente
 *
 * Contem informacoes sobre o Cliente a ser atendido
 *
 * @author dataprev
 *
 */

class Cliente {

	private $nome;
	private $ident;
	private $senha;

	public function __construct($nome='', $senha = '', $ident = '') {
		$this->set_nome($nome);
		$this->set_senha($senha);
		$this->set_ident($ident);
	}

	/**
	* Define o nome do Cliente
	* @param String $nome
	*/
	public function set_nome($nome) {
		$this->nome = $nome;
	}

	/**
	* Retorna o nome do Cliente
	* @return String
	*/
	public function get_nome() {
		return $this->nome;
	}
	
	/**
	* Define a identidade do Cliente
	* @param String $ident
	*/
	public function set_ident($ident) {
		$this->ident = $ident;
	}

	/**
	* Retorna a identidade do Cliente
	* @return String
	*/
	public function get_ident() {
		return $this->ident;
	}

	/**
	* Define a senha do Cliente
	* @param Senha $senha
	*/
	public function set_senha($senha) {
		$this->senha = $senha;
	}

	/**
	* Retorna a senha do Cliente
	* @return Senha
	*/
	public function get_senha() {
		return $this->senha;
	}

	/**
	 * Retorna String com senha, prioridade e nome do cliente
	 * @return String
	 */
	public function tostring() {
		$pri = ($this->senha->get_prioridade())?"***":"";
		return "{$this->get_senha()->tostring()} - $pri {$this->get_nome()}";
	}
	
	/**
	 * Retorna resultado do método tostring
	 * @return String
	 */
	public function __tostring() {
		return $this->tostring();
	}

}



?>
