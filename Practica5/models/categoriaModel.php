<?php  
class CategoriaModel extends AppModel
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
	 * Obtiene de la base de datos todas las categorias existentes
	 * @return type
	 */
	public function getCategorias()
	{
		$tareas = $this->_db->query("SELECT * FROM categorias");
		$tareas->execute();
		return $tareas->fetchall();				
	}
	/**
	 * Inserta en la base de datos una nueva categoria
	 * @param type|array $datos 
	 * @return type
	 */
	public function agregar($datos = array())
	{
		$consulta=$this->_db->prepare(
			"INSERT INTO categorias
			(nombre)
			VALUES
			(:nombre)"
		);
		$consulta->bindParam(":nombre",$datos["nombre"]);

		if($consulta->execute())
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	/**
	 * Por medio de la id actualiza una tarea en la base de datos
	 * @param type|array $datos 
	 * @return type
	 */
	public function actualizar($datos = array())
	{
		$consulta=$this->_db->prepare(
			"UPDATE categorias SET
			nombre=:nombre
			WHERE id=:id"
		);
		$consulta->bindParam(":nombre",$datos["nombre"]);
		$consulta->bindParam(":id",$datos["id"]);
		if($consulta->execute())
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	/**
	 * Busca en la base de datos una categoria que tenga la id seleccionada
	 * @param type $id 
	 * @return type
	 */
	public function buscarPorId($id)
	{
		$categoria = $this->_db->prepare("SELECT * FROM categorias WHERE id=:id");
		$categoria->bindParam(":id",$id);
		$categoria->execute();
		$registro = $categoria->fetch();

		if ($registro) 
		{
			return $registro;
		}
		else
		{
			return false;
		}
	}
	/**
	 * Elimina de la base de datos una categoria que tenga la id seleccionada
	 * @param type $id 
	 * @return type
	 */
	public function eliminarPorId($id){
		$consulta = $this->_db->prepare("DELETE FROM categorias WHERE id=:id");
		$consulta->bindParam(":id",$id);
		if ($consulta->execute())
			return true;
		else
			return false;
	}
}
?>