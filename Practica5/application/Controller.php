<?php
	abstract class AppController
	{
		protected $_view;

		/**
		 * Construye la vista
		 * @return type
		 */

		public function __construct()
		{
			$this->_view = new View(new Request);
		}

		abstract function index();		
		/**
		 * Carga el modelo que se solicita con el nombre de la vista que se intenta cargar contruye la ruta del modelo para que este se cargue
		 * @param type $modelo 
		 * @return type $modelo
		 */
		protected function loadModel($modelo)
		{
			$modelo = $modelo."Model";
			$rutaModelo = ROOT."models".DS.$modelo.".php";

			if(is_readable($rutaModelo))
			{
				require_once($rutaModelo);
				$modelo = new $modelo;
				return $modelo;
			}
			else
			{
				throw new Exception("Error al cargar el modelo");
				
			}
		}
		/**
		 * Redirige al usuario a la ruta requerida, carga los controladores y si se esta pidiendo alguna accion envia a este metodo.
		 * @param type|array $url 
		 * @return type
		 */
		public function redirect($url = array())
		{
			$path = "";
			if ($url["controller"]) {
				$path .= $url["controller"];
			}

			if ($url["action"]) {
				$path .="/".$url["action"];
			}

			header("LOCATION: ".APP_URL.$path);
		}
	}
?>