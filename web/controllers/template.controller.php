<?php 

class TemplateController{

	/*=============================================
	Traemos la Vista Principal de la plantilla
	=============================================*/

	public function index(){

		include "views/template.php";
	}

	/*=============================================
	Función Reducir texto
	=============================================*/

	static public function reduceText($value, $limit){

		if(strlen($value) > $limit){

			$value = substr($value, 0, $limit);
			
		}

		return $value;
	}

}
