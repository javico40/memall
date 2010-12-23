<?PHP
session_start();
include("include/core/main.php");
include("include/connection.php");
include("include/config.php");

if(!isset($_SESSION['validate'])){
header("location: entrar.php");
}else{

//variable memall
$memall = new Memall();
$cliente = new Cliente();
//variable de mensaje
$status = "";
$user = $_SESSION['validate'];
$idUser = $cliente->getId($user);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.:Bienvenidos a memall:. es tu mall, es memall.</title>
<link href="css/users.css" rel="stylesheet" type="text/css" />
<link href="css/estilo.css" rel="stylesheet" type="text/css" />
<link href="css/index.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="scripts/jqueryFunctions.js"></script>
</head>
<body>
<div id="pagina" align="center" class="paginaUsuarios">
<div id="header" class="header">
<?PHP
include("header.php");
?>
</div>
<div id="menuSuperior" style="float:left;">
<?PHP
include("menuSuperior.php");
?>
</div>

<div id="menuIzquierdo" class="menuLateral" align="left">
   <div id="contenedorMenu" class="contenedorMenuHome" align="center">
       <div class="botonIzquierdo" align="left"><a class="letradBotonesMenuIzquierdo estilo3" href="mensajes.php">Revisar Nuevos Mensajes</a></div>
       <div class="botonIzquierdo" align="left"><a class="letradBotonesMenuIzquierdo estilo3" href="publicar.php">Publicar Nuevos Productos</a></div>
       <div class="botonIzquierdo" align="left"><a class="letradBotonesMenuIzquierdo estilo3" href="enviados.php">Publicar Nuevas Compras</a></div>
       <div class="botonIzquierdo" align="left"><a class="letradBotonesMenuIzquierdo estilo3" href="spam.php">Revisar Transacciones</a></div>
       <div class="botonIzquierdo" align="left"><a class="letradBotonesMenuIzquierdo estilo3" href="spam.php">Promocionar Productos</a></div>
       <div class="botonIzquierdo" align="left"><a class="letradBotonesMenuIzquierdo estilo3" href="spam.php">Configurar Mi Cuenta</a></div>
</div>

<div id="navegacionCentral" class="navegacion">
   <div id="centralInside" class="contenedorCentralHome">
     
      <div id="divisorDePosicion" class="contenedorCentralDivision"></div>
   
      <div id="contenedorMuro" class="contenedorMuro">
          <div class="contenedor_noticias">
	         <form name="form" method="post">
		       <textarea cols="30" rows="2" name="textarea_noticia" class="textarea_noticia" id="textarea_noticia">Que ha pasado?</textarea><br />
		       <input type="submit" value="Compartir" class="enviar_noticia" />
	         </form>
          </div>
     <div id="cargando"></div>
     <div id="mostrar"></div>
     <?PHP
     include("comentarios.php");
     ?>
     </div>
    
     </div>
     
<div id="leftInside" class="contenedorCentralBanners"></div>
</div>



</div>


</div>
</body>
</html>
<?PHP
}//END IF-ELSE
?>
