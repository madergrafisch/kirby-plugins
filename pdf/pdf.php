<?php

require 'vendor/autoload.php';

class PDF extends FPDI
{
  public function __construct () {
    call_user_func_array('parent::__construct', func_get_args());
    $this->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT, 30);  
  }

  function Header()
  {
  }

  function Footer()
  {
  }
}

class mgfPDF extends PDF
{
  private $template_mgf_id;
  private $mfg_css;

  public function __construct () {
    call_user_func_array('parent::__construct', func_get_args());

    $this->setSourceFile(__DIR__ . "/mgf.pdf");
    $this->template_mgf_id = $this->importPage(1);
    $this->mfg_css = file_get_contents(__DIR__ . "/mgf.css");

    $this->SetMargins(18, 50, 18, 30);  
    $this->SetAutoPageBreak(true, 30);
    $this->SetFont('ubuntu', '', 8);

    $tagvs = array(
      'h1' => array(
        0 => array(
          'h' => 10, 
          'n' => 1
        ), 
        1 => array(
          'h' => 5, 
          'n' => 1
        )
      ),
      'h2' => array(
        0 => array(
          'h' => 7, 
          'n' => 1
        ), 
        1 => array(
          'h' => 2, 
          'n' => 1
        )
      ),
      'p' => array(
        0 => array(
          'h' => 0, 
          'n' => 0
        ), 
        1 => array(
          'h' => 5, 
          'n' => 1
        )
      ),
    );
    $this->setHtmlVSpace($tagvs);  
  }

  public function WriteHTML ($html, $ln = true, $fill = false, $reseth = false, $cell = false, $align = ''){
    $args = func_get_args();
    $args[0] = '<style>' . $this->mfg_css . '</style>' . $args[0];
    call_user_func_array('parent::WriteHTML', $args);
  }

  public function addPage ($orientation = '', $format = '', $keepmargins = false, $tocpage = false) {
    call_user_func_array('parent::addPage', func_get_args());
    $this->useTemplate($this->template_mgf_id);
  }

}