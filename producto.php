<?php
require_once 'producto.entidad.php';
require_once 'producto.model.php';

// Logica
$alm = new Producto();
$model = new ProductoModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$alm->__SET('idProductos',              $_REQUEST['idProductos']);
			$alm->__SET('nombre',          $_REQUEST['nombre']);
			$alm->__SET('descripcion',        $_REQUEST['descripcion']);
			$alm->__SET('precio',            $_REQUEST['precio']);
			$alm->__SET('Categoria_idCategoria', $_REQUEST['Categoria_idCategoria']);

			$model->Actualizar($alm);
			break;

		case 'registrar':
			$alm->__SET('nombre',          $_REQUEST['nombre']);
			$alm->__SET('descripcion',        $_REQUEST['descripcion']);
			$alm->__SET('precio',            $_REQUEST['precio']);
			$alm->__SET('Categoria_idCategoria', $_REQUEST['Categoria_idCategoria']);

			$model->Registrar($alm);
			break;

		case 'eliminar':
			$model->Eliminar($_REQUEST['idProductos']);
			break;

		case 'editar':
			$alm = $model->Obtener($_REQUEST['idProductos']);
			break;
	}
}

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Editor de Productos</title>
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
				<meta charset="UTF-8">
        <title>Pacman 2.0</title>
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css" media="screen" type="text/css">
        <link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Playball' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/style-portfolio.css">
        <link rel="stylesheet" href="css/picto-foundry-food.css" />
        <link rel="stylesheet" href="css/jquery-ui.css">
        <meta nombre="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link rel="icon" href="favicon-1.ico" type="image/x-icon">
	</head>
    <body style="padding:15px;">

<!--Titulo-->
<div style="color:#00000">
						<h2 style="text-align:center;"> FoodTim</h2>
</div>
<div class="col-md-3">
		<div class="img-section">
			 <img src="images/logo.jpg" width="400" height="300">
		</div>
</div>


			<div class="pure-g">
				<div class="col-md-6 col-md-offset-3">
				 <div class="pure-u-1-1">

							<form action="?action=<?php echo $alm->idProductos > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
									<input type="hidden" name="idProductos" value="<?php echo $alm->__GET('idProductos'); ?>" />

									<table style="width:500px;">
											<tr>
													<th style="text-align:left;">Nombre</th>
													<td><input type="text" name="nombre" value="<?php echo $alm->__GET('nombre'); ?>" style="width:100%;" /></td>
											</tr>
											<tr>
													<th style="text-align:left;">Descripcion</th>
													<td><input type="text" name="descripcion" value="<?php echo $alm->__GET('descripcion'); ?>" style="width:100%;" /></td>
											</tr>
											<tr>
													<th style="text-align:left;">Precio</th>
													<td><input type="float" name="precio" value="<?php echo $alm->__GET('precio'); ?>" style="width:100%;" /></td>
											</tr>
											<tr>
												<tr>
														<th style="text-align:left;">Categoria</th>
														<td>
																<select name="Categoria_idCategoria" style="width:100%;">
																		<option value="1" <?php echo $alm->__GET('Categoria_idCategoria') == 1 ? 'selected' : 'Sandwich de Pollo'; ?>>Sandwich de Pollo</option>
																		<option value="2" <?php echo $alm->__GET('Categoria_idCategoria') == 2 ? 'selected' : 'Sandwich de Carne'; ?>>Sandwich de Carne</option>
																		<option value="3" <?php echo $alm->__GET('Categoria_idCategoria') == 3 ? 'selected' : 'Bebidas'; ?>>Bebidas</option>
																		<option value="4" <?php echo $alm->__GET('Categoria_idCategoria') == 4 ? 'selected' : 'Papas'; ?>>Papas</option>

																</select>
														</td>
												</tr>
													<td colspan="2">
															<button type="submit" class="pure-button pure-button-primary">Guardar</button>
													</td>
											</tr>
									</table>
							</form>

                <table class="pure-table pure-table-horizontal" style="width:150%;">
                    <thead>
                        <tr>
                            <th style="text-align:left;">Nombre</th>
                            <th style="text-align:left;">Descripcion</th>
                            <th style="text-align:left;">Precio</th>
                            <th style="text-align:left;">Categoria</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('nombre'); ?></td>
                            <td><?php echo $r->__GET('descripcion'); ?></td>
                            <td><?php echo $r->__GET('precio'); ?></td>
														<td><?php
														if ($r->__GET('Categoria_idCategoria') == 1)
														{
															  echo "Sandwich de Pollo";
														}
														elseif ($r->__GET('Categoria_idCategoria')== 2)
														{
															    echo "Sandwich de Carne";
														}
														elseif ($r->__GET('Categoria_idCategoria') == 3)
														{
															echo "Bebidas";
														}
														elseif ($r->__GET('Categoria_idCategoria') == 4)
														{
															echo 'Papas';
														}
														?></td>
                            <td>
                                <a href="?action=editar&idProductos=<?php echo $r->idProductos; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&idProductos=<?php echo $r->idProductos; ?>">Eliminar</a>
                            </td>
                        </tr>

												<div class="form-group">
 	                     </div>
                    <?php endforeach; ?>
                </table>

								<div class="fa fa-cutlery fa-2x">
								 <a href="home.php">Regresar</a>
								</div>

            </div>
        </div>
     </div>

    </body>
</html>
