<?php  
	class usuariosController extends AppController
	{
		/**
		 * Hereda del metodo construct
		 * @return type
		 */
		public function __construct()
		{
			parent::__construct();
		}
		/**
		 * Carga la vista index de usuarios con el modelo usuario y obtiene todas las usuarios existentes en la base de datos
		 * @return type
		 */
		public function index()
		{
			$usuarios = $this->loadModel("usuario");
			$this->_view->usuarios=$usuarios->getUsuarios();
			$this->_view->titulo="Pagina principal";
			$this->_view->renderizar("index");
		}
		/**
		 * carga la funcion agregar usuarios y contruye la vista agregar usuarios
		 * @return type
		 */
		public function agregar()
		{
			if($_POST)
			{
				$usuarios = $this->loadModel("usuario");
				$this->_view->usuarios = $usuarios->agregar($_POST);
				$this->redirect(array("controller"=>"usuarios"));
			}
			$this->_view->titulo="Agregar usuarios";
			$this->_view->renderizar("agregar");

		}
		/**
		 * carga la vista editar con la id de la usuario seleccionada y carga la funcion editar
		 * @param type $id 
		 * @return type
		 */
		public function editar($id)
		{
			if($_POST)
			{
				$usuarios = $this->loadModel("usuario");
				$usuarios->actualizar($_POST);
				$this->redirect(array("controller"=>"usuarios"));

			}
			$usuarios = $this->loadModel("usuario");
			$this->_view->usuario = $usuarios->buscarPorId($id);

			$this->_view->titulo="Editar usuario";
			$this->_view->renderizar("editar");
		}
		/**
		 * carga los metodos buscar por id para encontrar en la base de datos la usuario solicitada y eliminar por id para borrarla seguidamente recarga la pagina index de usuarios
		 * @param type $id 
		 * @return type
		 */
		public function eliminar($id){
			$usuario = $this->loadModel("usuario");
			$registro=$usuario->buscarPorId($id);
			if (!empty($registro)) {
				$usuario->eliminarPorId($id);
				$this->redirect(array("controller"=>"usuarios"));
			}
		}

	}
?>