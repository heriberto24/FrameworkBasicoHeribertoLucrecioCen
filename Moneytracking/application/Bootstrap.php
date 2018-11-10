<?php  
	class Bootstrap
	{
		/**
		 * Carga los controladores requeridos segun la pagina que se esta llamando. por medio de la peticion construye la ruta del controlador.
		 * @param Request $peticion 
		 * @return type
		 */
		public static function run(Request $peticion)
		{
			$controller = $peticion->getController()."Controller";
			$ruta_Controlador = ROOT."controllers".DS.$controller.".php";
			$metodo = $peticion->getMethod();
			$args = $peticion->getArgs();

			if(is_readable($ruta_Controlador))
			{
				require_once $ruta_Controlador;
				$controller = new $controller;

				if(is_callable(array($controller,$metodo)))
				{
					$metodo = $peticion->getMethod();
				}
				else
				{
					$metodo = "index";
				}

				if(isset($args))
				{
					call_user_func_array(array($controller,$metodo),$peticion->getArgs());
				}
				else
				{
					call_user_func(array($controller,$metodo));
				}
			}
			else
			{
				throw new Exception("<br>Controlador no encontrado");
				
			}
		}
	}
?>
