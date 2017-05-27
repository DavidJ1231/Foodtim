<?php
class ProductoModel
{
	private $pdo;

	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = new PDO('mysql:host=localhost;dbname=aplicacion', 'root', '');
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM productos");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$vo = new Producto();

				$vo->__SET('idProductos', $r->idProductos);
				$vo->__SET('nombre', $r->nombre);
				$vo->__SET('descripcion', $r->descripcion);
				$vo->__SET('precio', $r->precio);
				$vo->__SET('Categoria_idCategoria', $r->Categoria_idCategoria);

				$result[] = $vo;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($idProductos)
	{
		try
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM productos WHERE idProductos = ?");


			$stm->execute(array($idProductos));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$vo = new Producto();

			$vo->__SET('idProductos', $r->idProductos);
			$vo->__SET('nombre', $r->nombre);
			$vo->__SET('descripcion', $r->descripcion);
			$vo->__SET('precio', $r->precio);
			$vo->__SET('Categoria_idCategoria', $r->Categoria_idCategoria);

			return $vo;
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($idProductos)
	{
		try
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM productos WHERE idProductos = ?");

			$stm->execute(array($idProductos));
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Producto $data)
	{
		try
		{
			$sql = "UPDATE productos SET
						nombre          = ?,
						descripcion        = ?,
						precio            = ?,
						Categoria_idCategoria = ?
				    WHERE idProductos = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('nombre'),
					$data->__GET('descripcion'),
					$data->__GET('precio'),
					$data->__GET('Categoria_idCategoria'),
					$data->__GET('idProductos')
					)
				);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Producto $data)
	{
		try
		{
		$sql = "INSERT INTO productos (nombre,descripcion,precio,Categoria_idCategoria)
		        VALUES (?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('nombre'),
				$data->__GET('descripcion'),
				$data->__GET('precio'),
				$data->__GET('Categoria_idCategoria')
				)
			);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}
}
