<?php  
class UsuarioModel extends AppModel
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
	 * Obtiene de la base de datos todas las usuarios existentes
	 * @return type
	 */
	public function getUsuarios()
	{
		$tareas = $this->_db->query("SELECT * FROM usuarios");
		$tareas->execute();
		return $tareas->fetchall();				
	}
	/**
	 * Inserta en la base de datos una nueva usuario
	 * @param type|array $datos 
	 * @return type
	 */
	public function agregar($datos = array())
	{
		$consulta=$this->_db->prepare(
			"INSERT INTO usuarios
			(nombre,apellidos,email)
			VALUES
			(:nombre,:apellidos,:email)"
		);
		$consulta->bindParam(":nombre",$datos["nombre"]);
		$consulta->bindParam(":apellidos",$datos["apellidos"]);
		$consulta->bindParam(":email",$datos["email"]);

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
			"UPDATE usuarios SET
			nombre=:nombre,
			apellidos=:apellidos,
			email=:email
			WHERE id=:id"
		);
		$consulta->bindParam(":nombre",$datos["nombre"]);
		$consulta->bindParam(":apellidos",$datos["apellidos"]);
		$consulta->bindParam(":email",$datos["email"]);
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
	 * Busca en la base de datos una usuario que tenga la id seleccionada
	 * @param type $id 
	 * @return type
	 */
	public function buscarPorId($id)
	{
		$usuario = $this->_db->prepare("SELECT * FROM usuarios WHERE id=:id");
		$usuario->bindParam(":id",$id);
		$usuario->execute();
		$registro = $usuario->fetch();

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
	 * Elimina de la base de datos una usuario que tenga la id seleccionada
	 * @param type $id 
	 * @return type
	 */
	public function eliminarPorId($id){
		$consulta = $this->_db->prepare("DELETE FROM usuarios WHERE id=:id");
		$consulta->bindParam(":id",$id);
		if ($consulta->execute())
			return true;
		else
			return false;
	}
}
?>