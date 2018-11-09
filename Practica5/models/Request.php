<?php  
	class Request
	{
		private $_controlador;
		private $_metodo;
		private $_argumentos;
		/**
		 * construye url de las vistas
		 * @return type
		 */
		public function __construct()
		{			
				$url = filter_input(INPUT_GET,'url',FILTER_SANITIZE_URL);
				$url = explode("/", $url);
				$url = array_filter($url);

				$this->_controlador=strtolower(array_shift($url));
				$this->_metodo=strtolower(array_shift($url));
				$this->_argumentos = $url;

				if(!$this->_controlador)
				{
					$this->_controlador = DEFAULT_CONTROLLER;
				}

				if(!$this->_metodo)
				{
					$this->_metodo = "index";
				}

				if(!$this->_argumentos)
				{
					$this->_argumentos = array();
				}
		}
		/**
		 * Obtiene el controlador de la vista
		 * @return type
		 */
		public function getController()
		{			
			return $this->_controlador;
		}
		/**
		 * Obtiene los metodos del controlador
		 * @return type
		 */
		public function getMethod()
		{
			return $this->_metodo;
		}
		/**
		 * Obtiene los argumentos de los metodos
		 * @return type
		 */
		public function getArgs()
		{
			return $this->_argumentos;
		}
	}
?>