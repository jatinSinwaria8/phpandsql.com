<?php

// include autoload file.
include __DIR__ . "/../vendor/autoload.php";

// using dompdf class.
use Dompdf\Dompdf;

/**
 * * HtmlToPdf class to convert html to pdf.
 */
class HtmlToPdf
{
  /**
   * 
   * @var Dompdf $dompdf Dompdf instance. 
   */
  private $dompdf;

  /**
   *  Constructor to initialize dompdf instance.
   */
  public function __construct()
  {
    $this->dompdf = new Dompdf();
    $this->dompdf->setPaper('A4', 'landscape');
  }

  /**
   * Function to convert html to pdf.
   * 
   * @param mixed $data
   * @param mixed $filename
   * 
   * @return void
   */
  public function write_pdf($data, $filename = 'No_Name.pdf')
  {
    // Load HTML content
    $this->dompdf->load_html($data);

    // Render the HTML as PDF
    $this->dompdf->render();

    // Output the generated PDF to Browser
    $this->dompdf->stream($filename, array("Attachment" => true));
  }

}
