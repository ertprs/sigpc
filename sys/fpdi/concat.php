<?php

class FPDI_CONCAT extends FPDI
{
    public $files = array();

    public function setFiles($files)
    {
        $this->files = $files;
    }

    public function concat()
    {	$pageCount_total = 0;
        foreach($this->files AS $file) {
            $pageCount = $this->setSourceFile($file);
						$pageCount_total = $pageCount_total+$pageCount;
            for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                 $tplIdx = $this->ImportPage($pageNo);
                 $s = $this->getTemplatesize($tplIdx);
                 $this->AddPage($s['w'] > $s['h'] ? 'L' : 'P', array($s['w'], $s['h']));
                 $this->useTemplate($tplIdx);
            }
        }
			return $pageCount_total;
    }
}

?>