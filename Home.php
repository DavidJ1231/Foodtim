<?php
 ob_start();
 session_start();
 require_once 'dbconnect.php';

 // if session is not set this will redirect to login page
 if( !isset($_SESSION['user']) ) {
  header("Location: index.php");
  exit;
 }
 // select loggedin usuarios detail
 $res=mysql_query("SELECT * FROM clientes WHERE idCliente=".$_SESSION['user']);
 $userRow=mysql_fetch_array($res);
?>

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
<html>

    <head>
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
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
    </head>

    <body>

        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="row">
                <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">Pacman 2.0</a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav main-nav  clear navbar-right ">
                            <li><a class="navactive color_animation" href="#top">BIENVENIDO</a></li>
                            <li><a class="color_animation" href="#story">ACERCA DE</a></li>
                            <li><a class="color_animation" href="#pricing">PRODUCTOS</a></li>
                            <li><a class="color_animation" href="#contact">CONTACTO</a></li>
                            <li><a href="logout.php?logout" class="color_animation">SALIR</a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div>
            </div><!-- /.container-fluid -->
        </nav>

        <div id="top" class="starter_container bg">
            <div class="follow_container">
                <div class="col-md-6 col-md-offset-3">
                    <h2 class="top-title"> F o o d T i m</h2>
                    <h2 class="white second-title">"La mejor app para el consumidor "</h2>
                    <hr>
                </div>
            </div>
        </div>

        <!-- ============ About Us ============= -->

        <section id="story" class="description_content">
            <div class="text-content container">
                <div class="col-md-6">
                    <h1>Quienes Somos</h1>
                    <div class="fa fa-cutlery fa-2x"></div>
                    <p class="desc-text">Somos una aplicación que permitirá que los usuarios de las franquicias de fastfood tengan una mejor experiencia en su consumo, cortando el tiempo de espera en las colas para hacer el pedido.  </p>
                </div>
                <div class="col-md-6">
                    <div class="img-section">
                       <img src="images/logo.jpg" width="500" height="440">
                       <div class="img-section-space"></div>
                    </div>
                </div>
            </div>
        </section>


       <!-- ============ Pricing  ============= -->


        <section id ="pricing" class="description_content">
             <div class="pricing background_content">
                <!--<style #000000-->
                <h1 style='color:black'> Nuestros productos</h1>
                <div class="pure-g">
                  <div class="col-md-6 col-md-offset-3">
                   <div class="pure-u-1-1">

                     <div class="form-group">
                      <a class="navbar-brand" href="producto.php">Editar</a>
                     </div>

                       <table class="pure-table pure-table-horizontal" style="width:125%">
                           <thead>
                               <tr>
                                   <th style="text-align:left;">Nombre</th>
                                   <th style="text-align:left;">Descripcion</th>
                                   <th style="text-align:left;">Precio</th>
                                   <th style="text-align:left;">Categoria</th>
                               </tr>
                           </thead>
                           <tbody id="scroll">
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
                               </tr>
                              <div class="form-group">
                             </div>
                           <?php endforeach; ?>
                           </tbody>
                       </table>
                     </div>
                    </div>
                  </div>

            <!-- Contact Section -->
      <section id="contact">
          <div class="container">
              <div class="row">
                  <div class="col-lg-12 text-center">
                      <h2>Contactanos</h2>
                      <hr class="star-primary">
                  </div>
              </div>
              <div class="row">
                  <div class="col-lg-8 col-lg-offset-2">
                      <!-- To configure the contact form email, go to mail/contact_me.php and update the email in the PHP file on line 19. -->
                      <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
                      <form nombre="sentMensaje" id="contactForm" novalidate>
                          <div class="row control-group">
                              <div class="form-group col-xs-12 floating-label-form-group controls">
                                  <label for="nombre">Nombre</label>
                                  <input type="text" class="form-control" placeholder="Nombre" id="nombre" required data-validation-required-mensaje="Please enter your nombre.">
                                  <p class="help-block text-danger"></p>
                              </div>
                          </div>
                          <div class="row control-group">
                              <div class="form-group col-xs-12 floating-label-form-group controls">
                                  <label for="email">Email</label>
                                  <input type="email" class="form-control" placeholder="Email" id="email" required data-validation-required-mensaje="Please enter your email.">
                                  <p class="help-block text-danger"></p>
                              </div>
                          </div>
                          <div class="row control-group">
                              <div class="form-group col-xs-12 floating-label-form-group controls">
                                  <label for="mensaje">Mensaje</label>
                                  <textarea rows="5" class="form-control" placeholder="Mensaje" id="mensaje" required data-validation-required-mensaje="Please enter a mensaje."></textarea>
                                  <p class="help-block text-danger"></p>
                              </div>
                          </div>
                          <br>
                          <div id="success"></div>
                          <div class="row">
                              <div class="form-group col-xs-12">
                                  <button type="submit" class="btn btn-success btn-lg">Enviar</button>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </section>


        <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

        <!-- ============ Social Section  ============= -->

        <section class="social_connect">
            <div class="text-content container">
                <div class="col-md-12">
                    <span class="social_heading">CONTACTO</span>
                    <span class="social_info"><a class="color_animation" href="tel:997154182">+51 997-154-182</a></span>
                </div>
            </div>
        </section>





        <!-- ============ Footer Section  ============= -->

        <footer class="sub_footer">
            <div class="container">
                <div class="col-md-4"><p class="sub-footer-text text-center">&copy; Pacman 2.0 2014, Theme by <a href="https://themewagon.com/">ThemeWagon</a></p></div>
                <div class="col-md-4"><p class="sub-footer-text text-center">Back to <a href="#top">TOP</a></p>
                </div>
                <div class="col-md-4"><p class="sub-footer-text text-center">Built With Care By <a href="#" target="_blank">Us</a></p></div>
            </div>
        </footer>
</section>

        <script type="text/javascript" src="js/jquery-1.10.2.min.js"> </script>
        <script type="text/javascript" src="js/bootstrap.min.js" ></script>
        <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="js/jquery.mixitup.min.js" ></script>
        <script type="text/javascript" src="js/main.js" ></script>
    </body>
</html>
<?php ob_end_flush(); ?>
