<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('assets/dompdf/autoload.inc.php');
use Dompdf\Dompdf;

class Mypdf {
    
    protected $ci;

    public function __construct(){
    	$this->ci =& get_instance();
    }

    public function generate($view, $paper = "A4", $orientation = "portrait", $filename = "Laporan", $data = array()){
    	$html = $this->ci->load->view($view, $data, TRUE);
    	$dompdf = new Dompdf();

    	$dompdf->loadHtml($html);
      $dompdf->set_option('isRemoteEnabled', TRUE);
  		// (Optional) Setup the paper size and orientation
  		$dompdf->setPaper($paper, $orientation);

  		// Render the HTML as PDF
  		$dompdf->render();
  	    ob_clean();
	    $dompdf->stream($filename.".pdf", array("Attachment" => FALSE));
    }
}


/* End of file pdf.php */
/* Location: ./application/libraries/pdf.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-14 06:05:01 */
/* http://harviacode.com */