<?php

namespace App\Interfaces;

interface iOrderable{
	public function cartName();
	public function removeLink(\App\Order $order);
}