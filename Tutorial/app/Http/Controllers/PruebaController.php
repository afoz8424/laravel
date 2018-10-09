<?php

namespace Tutorial\Http\Controllers;

use Tutorial\Http\Controllers\Controller;

class PruebaController extends Controller {

	public function prueba($param){
		return 'Estoy dentro de pruebaController y recibi este parametro: '.$param;
	}

}