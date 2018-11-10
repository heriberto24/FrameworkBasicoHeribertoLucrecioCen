<?php  
	class transaccionesController extends AppController
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
		 * Carga la vista index de transacciones con el modelo transaccion y obtiene todas las transacciones existentes en la base de datos
		 * @return type
		 */
		public function index()
		{
			$categorias = $this->loadModel("categoria");
			$transacciones = $this->loadModel("transaccion");
			$usuarios = $this->loadModel("usuario");
			$this->_view->categorias=$categorias->getCategorias();
			$this->_view->transacciones=$transacciones->getTransacciones();
			$this->_view->usuarios=$usuarios->getUsuarios();
			$this->_view->titulo="Pagina principal";
			$this->_view->renderizar("index");
		}
		/**
		 * carga la funcion agregar transacciones y contruye la vista agregar transacciones
		 * @return type
		 */
		public function agregar()
		{
			if($_POST)
			{
				$transacciones = $this->loadModel("transaccion");
				$this->_view->transacciones = $transacciones->agregar($_POST);
				$this->redirect(array("controller"=>"transacciones"));
			}
			$categorias = $this->loadModel("categoria");
			$usuarios = $this->loadModel("usuario");
			$this->_view->categorias=$categorias->getcategoriasTab();
			$this->_view->usuarios=$usuarios->getUsuarios();
			$this->_view->titulo="Agregar transacciones";
			$this->_view->renderizar("agregar");

		}
		/**
		 * carga la vista editar con la id de la transaccion seleccionada y carga la funcion editar
		 * @param type $id 
		 * @return type
		 */
		public function editar($id)
		{
			if($_POST)
			{
				$transacciones = $this->loadModel("transaccion");
				$transacciones->actualizar($_POST);
				$this->redirect(array("controller"=>"transacciones"));

			}
			$transacciones = $this->loadModel("transaccion");
			$this->_view->transaccion = $transacciones->buscarPorId($id);

			$categorias = $this->loadModel("categoria");
			$this->_view->categorias=$categorias->getcategoriasTab();

			$this->_view->titulo="Editar transaccion";
			$this->_view->renderizar("editar");
		}
		/**
		 * carga los metodos buscar por id para encontrar en la base de datos la transaccion solicitada y eliminar por id para borrarla seguidamente recarga la pagina index de transacciones
		 * @param type $id 
		 * @return type
		 */
		public function eliminar($id){
			$transaccion = $this->loadModel("transaccion");
			$registro=$transaccion->buscarPorId($id);
			if (!empty($registro)) {
				$transaccion->eliminarPorId($id);
				$this->redirect(array("controller"=>"transacciones"));
			}
		}
		public function cambiarEstado($id, $estado){
			$transaccion = $this->loadModel("transaccion");
			if ($estado==0) {
				$estado=1;
			}
			else{
				$estado=0;
			}
			$transaccion->estado($id, $estado);
			$this->redirect(array("controller"=>"transacciones"));
		}

	}
?>