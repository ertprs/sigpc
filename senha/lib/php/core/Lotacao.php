<?php



class Lotacao {
	
	private $usuario;
	private $grupo;
	private $cargo;
	
	public function __construct(Usuario $usuario, Grupo $grupo, Cargo $cargo) {
		$this->set_usuario($usuario);
		$this->set_grupo($grupo);
		$this->set_cargo($cargo);
	}
	
	/**
	 * Modifica usuario
	 * @param $usuario
	 * @return none
	 */
	public function set_usuario(Usuario $usuario) {
		$this->usuario = $usuario;
	}
	
	/**
	 * Retorna objeto usuario
	 * @return Usuario $usuario
	 */
	public function get_usuario() {
		return $this->usuario;
	}
	
	/**
	 * Modifica grupo
	 * @param $grupo
	 * @return none
	 */
	public function set_grupo(Grupo $grupo) {
		$this->grupo = $grupo;
	}
	
	/**
	 * Retorna objeto Grupo
	 * @return Grupo $grupo
	 */
	public function get_grupo() {
		return $this->grupo;
	}
	
	/**
	 * Modifica cargo
	 * @param $cargo
	 * @return none
	 */
	public function set_cargo(Cargo $cargo) {
		$this->cargo = $cargo;
	}
	
	/**
	 * Retorna objeto Cargo
	 * @return Cargo $cargo
	 */
	public function get_cargo() {
		return $this->cargo;
	}
}
?>