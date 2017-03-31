<?php

namespace App\Controllers;

use App\Models\Invoices;

class InvoiceController extends AbstractController
{
	public function index($request, $response)
	{
		$inv = new Invoices($this->db);

		$data['invoices'] = $inv->allInvoice();

		return $this->view->render($response, 'invoices/listInvoice.twig', 
			$data);
	}

	public function getInvoice($request, $response, $args)
	{
		$inv = new Invoices($this->db);

		$data['invoices'] = $inv->getInvoice($args['no_invoice']);

		return $this->view->render($response, 'invoices/invoice.twig', $data);
	}
}

?>