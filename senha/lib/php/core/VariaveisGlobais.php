<?php



class VariaveisGlobais {
    // static
    private static $instance;

    // fields
    private $vars;

    /**
     * @return VariaveisGlobais Retorna o gerenciador de variaveis globais
     */
    public static function getInstance() {
        if (VariaveisGlobais::$instance == null) {
            VariaveisGlobais::$instance = new VariaveisGlobais();
        }
        return VariaveisGlobais::$instance;
    }

    private function __construct() {
        $this->vars = DB::getInstance()->get_variaveis_globais();
    }

    public function get($chave) {
        return $this->vars[$chave];
    }

    public function set($chave, $valor) {
        $this->vars[$chave] = $valor;
        DB::getInstance()->salvar_variavel_global($chave, $valor);
    }

    public function exists($chave) {
        return isset($this->var[$chave]);
    }
}
?>
