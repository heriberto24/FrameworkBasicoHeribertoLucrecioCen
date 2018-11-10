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
			$categorias = $this->_db->query("SELECT * FROM categorias INNER JOIN usuarios ON categorias.id_Usuario=usuarios.id");
			foreach (range(0, $categorias->columnCount()-1) as $column_index) {
				$meta[] = $categorias->getColumnMeta($column_index);
			}

			$resultado = $categorias->fetchall(PDO::FETCH_NUM);
			for ($i=0; $i < count($resultado); $i++) { 
				$j=0;
				foreach ($meta as $value) {
					$rows[$i][$value["table"]][$value["name"]] =
					$resultado[$i][$j];
					$j++;
				}
			}
			return $rows;				
	}

	public function getCategoriasTab()
	{
		$categorias = $this->_db->query("SELECT * FROM categorias");
		$categorias->execute();
		return $categorias->fetchall();
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
				(id_Usuario,nombre)
				VALUES
				(:id_Usuario,:nombre)"
			);

			$consulta->bindParam(":id_Usuario",$datos["usuario"]);
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
			nombre=:nombre,
			id_Usuario=:id_Usuario
			WHERE id=:id"
		);
		$consulta->bindParam(":nombre",$datos["nombre"]);
		$consulta->bindParam(":id_Usuario",$datos["usuario"]);
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