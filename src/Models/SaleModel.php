<?php

namespace App\Models;

class SaleModel extends AbstractModel
{
	protected $table = 'product';
	protected $column =  ['id', 'title', 'price', 'image'];
}

?>