<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//Github link https://github.com/hanzzame/ci3-pdf-generator-library

require_once(dirname(__FILE__) . '/dompdf/autoload.inc.php');

use Dompdf\Dompdf;
use Dompdf\Options;

class Pdf extends Dompdf { 
    public function __construct() { 
        parent::__construct();
    } 
	
	public function create($html,$filename)
	{
		// Added this for displaying image in https sites
	    $options = new Options();
	    $options->set('isRemoteEnabled', TRUE);
	    $dompdf = new Dompdf($options);
	    $context = stream_context_create([ 
	    	'ssl' => [ 
	    		'verify_peer' => FALSE, 
	    		'verify_peer_name' => FALSE,
	    		'allow_self_signed'=> TRUE 
	    	] 
	    ]);
	    $dompdf->setHttpContext($context);
		
		// Without https
	    $dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'landscape');
	    $dompdf->render();
	    $dompdf->stream($filename.'.pdf',array("Attachment"=>0)); // 1 - Downlaod 0 - View
	}
	
	public function generate($html,$filename)
	{
		// Added this for displaying image in https sites
	    $options = new Options();
	    $options->set('isRemoteEnabled', TRUE);
	    $dompdf = new Dompdf($options);
	    $context = stream_context_create([ 
	    	'ssl' => [ 
	    		'verify_peer' => FALSE, 
	    		'verify_peer_name' => FALSE,
	    		'allow_self_signed'=> TRUE 
	    	] 
	    ]);
	    $dompdf->setHttpContext($context);
		
		// Without https
	    $dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'portrait');
	    $dompdf->render();
	    $dompdf->stream($filename.'.pdf',array("Attachment"=>0)); // 1 - Downlaod 0 - View
	}

	public function download($html,$filename)
	{
		// Added this for displaying image in https sites
	    $options = new Options();
	    $options->set('isRemoteEnabled', TRUE);
	    $dompdf = new Dompdf($options);
	    $context = stream_context_create([ 
	    	'ssl' => [ 
	    		'verify_peer' => FALSE, 
	    		'verify_peer_name' => FALSE,
	    		'allow_self_signed'=> TRUE 
	    	] 
	    ]);
	    $dompdf->setHttpContext($context);
		
		// Without https
	    $dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'portrait');
	    $dompdf->render();
	    $dompdf->stream($filename.'.pdf',array("Attachment"=>1)); // 1 - Downlaod 0 - View
	}
} 
?>
