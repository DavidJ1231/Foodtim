<?php
class Producto
{
	private $idProductos;
	private $nombre;
	private $descripcion;
	private $precio;
	private $Categoria_idCategoria;

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}
