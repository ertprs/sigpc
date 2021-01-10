<?php



abstract class Relatorio
{
	private $m_titulo;
	private $m_subTitulo;
	private $m_componentes = array();
    private $m_startTime;
    private $m_endTime;

    public function  __construct() {
        $this->m_startTime = time();
    }

	/**
	 * Altera o titulo do Relatório
	 * 
	 * @param $titulo O novo titulo do relatório
	 * @return void
	 */
	public function setTitulo($titulo)
	{
		$this->m_titulo = $titulo;
	}

	/**
	 * Obtem o titulo do relatório.
	 * 
	 * @return string o titulo do relatório.
	 */
	public function getTitulo()
	{
		return $this->m_titulo;
	}
	
	/**
	 * Altera o subtitulo do Relatório
	 * 
	 * @param $titulo O novo subtitulo do relatório
	 * @return void
	 */
	public function setSubTitulo($titulo)
	{
		$this->m_subTitulo = $titulo;
	}

	/**
	 * Obtem o subtitulo do relatório.
	 * 
	 * @return string o subtitulo do relatório.
	 */
	public function getSubTitulo()
	{
		return $this->m_subTitulo;
	}
	
	public function addComponente($componente)
	{
		return $this->m_componentes[] = $componente;
	}
	
	public function getComponentes()
	{
		return $this->m_componentes;
	}

	public function relstrip($html)
	{
		return strip_tags(str_ireplace('<br>', "\n", $html));
	}

    public function getTimeSinceStart() {
        return time() - $this->m_startTime;
    }

    public static function get_seconds_as_time($secs) {
        $h = floor($secs / 3600);
        $i = floor(($secs % 3600) / 60);
        $s = $secs % 60;
        $h = str_pad($h, 2, '0', STR_PAD_LEFT);
        $i = str_pad($i, 2, '0', STR_PAD_LEFT);
        $s = str_pad($s, 2, '0', STR_PAD_LEFT);

        return "$h:$i:$s";
    }

    public abstract function output();
}
?>
