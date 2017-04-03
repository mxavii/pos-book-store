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

		$invoices = $inv->getInvoice($args['no_invoice']);
		
		$data['invoices'] = $invoices;

		foreach ($invoices as $invoice) {
			$data['invoice'] = $invoice;
			$data['invoice']['refund'] = $invoice['be_paid'] - $invoice['total_paid'] ;
		}

		return $this->view->render($response, 'invoices/invoice.twig', $data);
	}

	public function softDelete($request, $response, $args)
	{
		$inv = new Invoices($this->db);
		$inv->softDel($args['id']);

		$this->flash->addMessage('succes', 'Data successfully deleted');

		return $response->withRedirect($this->router->pathFor('invoice'));
	}
}
?>