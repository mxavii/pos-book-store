<?php

namespace App\Controllers;

use App\Models\Invoice;

class InvoiceController extends AbstractController
{
	public function getInvoice($request, $response, $args)
	{
		$inv = new Invoice($this->db);

		$data['invoice'] = $inv->invoice($args['no_invoice']);

		return $this->view->render($response, 'sale/partials/invoice.twig', $data);
	}
}

?>