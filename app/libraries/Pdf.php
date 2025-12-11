<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * CodeIgniter PDF Library
 *
 * @package			CodeIgniter
 * @subpackage		Libraries
 * @category		Libraries
 * @author			Muhanz
 * @license			MIT License
 * @link			https://github.com/hanzzame/ci3-pdf-generator-library
 *
 */

require_once APPPATH . 'third_party/dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

class Pdf
{
	public function create($html, $filename)
	{
		$options = new Options();
		$options->set('isRemoteEnabled', TRUE);
		$options->set('isHtml5ParserEnabled', true);
		$options->set('defaultFont', 'Arial');
		$options->set('isPhpEnabled', true);

		$dompdf = new Dompdf($options);
		$context = stream_context_create([
			'ssl' => [
				'verify_peer' => FALSE,
				'verify_peer_name' => FALSE,
				'allow_self_signed' => TRUE
			]
		]);
		$dompdf->setHttpContext($context);
		$dompdf->loadHtml($html);

		$dompdf->setPaper('legal', 'landscape');
		$dompdf->render();
		$dompdf->stream($filename . '.pdf');
	}
}
