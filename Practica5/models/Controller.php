<?php  
	abstract class AppController
	{
		protected $_view;
		/**
		 * contruye una vista segun la variable request
		 * @return type
		 */
		public function __construct()
		{
			$this->_view = new View(new Request);
		}

		abstract function index();		
		/**
		 * Redirije la vista y carga las acciones
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