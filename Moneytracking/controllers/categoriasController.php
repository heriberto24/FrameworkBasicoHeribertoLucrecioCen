<?php  
	class categoriasController extends AppController
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
		 * Carga la vista index de categorias con el modelo categoria y obtiene todas las categorias existentes en la base de datos
		 * @return type
		 */
		public function index()
		{
			$usuarios = $this->loadModel("usuario");
			$categorias = $this->loadModel("categoria");
			$this->_view->usuarios=$usuarios->getUsuarios();
			$this->_view->categorias=$categorias->getCategorias();
			$this->_view->titulo="Pagina principal";
			$this->_view->renderizar("index");
		}
		/**
		 * carga la funcion agregar categorias y contruye la vista agregar categorias
		 * @return type
		 */
		public function agregar()
		{
			if($_POST)
			{
				$categorias = $this->loadModel("categoria");
				$this->_view->categorias = $categorias->agregar($_POST);
				$this->redirect(array("controller"=>"categorias"));
			}
			$usuarios = $this->loadModel("usuario");
			$this->_view->usuarios=$usuarios->getUsuarios();
			$this->_view->titulo="Agregar categorias";
			$this->_view->renderizar("agregar");

		}
		/**
		 * carga la vista editar con la id de la categoria seleccionada y carga la funcion editar
		 * @param type $id 
		 * @return type
		 */
		public function editar($id)
		{
			if($_POST)
			{
				$categorias = $this->loadModel("categoria");
				$categorias->actualizar($_POST);
				$this->redirect(array("controller"=>"categorias"));

			}
			$categorias = $this->loadModel("categoria");
			$this->_view->categoria = $categorias->buscarPorId($id);

			$usuarios = $this->loadModel("usuario");
			$this->_view->usuarios=$usuarios->getUsuarios();

			$this->_view->titulo="Editar categoria";
			$this->_view->renderizar("editar");
		}
		/**
		 * carga los metodos buscar por id para encontrar en la base de datos la categoria solicitada y eliminar por id para borrarla seguidamente recarga la pagina index de categorias
		 * @param type $id 
		 * @return type
		 */
		public function eliminar($id){
			$categoria = $this->loadModel("categoria");
			$registro=$categoria->buscarPorId($id);
			if (!empty($registro)) {
				$categoria->eliminarPorId($id);
				$this->redirect(array("controller"=>"categorias"));
			}
		}

	}
?>