<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart {
	

	public function addItem($sn, $qty = 1)
	{
		echo $sn.', '.$qty;
	}
}