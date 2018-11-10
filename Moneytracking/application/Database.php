<?php  
	class Database extends PDO
	{
		/**
		 * Contruye la ruta de acceso a la base de datos por medio de los valores por defecto
		 * @return type
		 */
		public function __construct()
		{
			parent::__construct(
				'mysql:host='.DB_HOST.';'.
				'dbname='.DB_NAME,
				DB_USER,
				DB_PASS,
				array(
					PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES '.DB_CHAR
				)
			);
		}
	}
?>