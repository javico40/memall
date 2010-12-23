<?PHP
session_start();
if(!isset($_SESSION['validate'])){
header("location: entrar.php");
}else{
include("include/core/main.php");
$usuario = $_SESSION['validate'];
//create client
$cliente = new Cliente;
$memall = new Memall();
$idCliente = $cliente->getId($usuario);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.:Bienvenidos a memall:. es tu mall, es memall.</title>
<link href="css/users.css" rel="stylesheet" type="text/css" />
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

<div id="contenedorMenu" class="contenedorMenu" align="center">
  <div class="botonIzquierdo posicionBotonUno botonSeleccionado" align="left"><a class="letradBotonesMenuIzquierdo estilo3" href="agregar.php">Agregar Nuevo Contacto</a></div>
  <div class="botonIzquierdo posicionBotonDos" align="left"><a class="letradBotonesMenuIzquierdo estilo3" href="contactos.php">Contactos</a></div>
  <div class="botonIzquierdo posicionBotonTres" align="left"><a class="letradBotonesMenuIzquierdo estilo3" href="solicitud.php">Solicitudes</a></div>
  <div class="botonIzquierdo posicionBotonCuatro" align="left"><a class="letradBotonesMenuIzquierdo estilo3" href="eliminar.php">Eliminar Contacto</a></div>
</div>

<div id="navegacionCentral" class="navegacion">
 <div id="centralInside" class="contenedorCentral">
 <div id="contenedorPerfilImagen" class="contenedorPerfilImagen"><img src="img/logoDefault.jpg" name="imgPerfil" width="102" height="95" id="imgPerfil"></img></div>
    <div id="contenedorInformacion" class="contenedorPerfilInformacion">
      <table width="400" height="152" border="0">
        <tr>
          <td><div align="left"><span class="letrasTituloPerfil">La solicitud ha sido enviada</span></div></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><div align="justify">Hemos enviado la solicitud a la empresa que deseas contactar, si acepta la invitacion recibiras un mensaje de aceptacion en la seccion Mensajes.</div></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
    </div>
</div>
</div>

</div>

</div>
</body>
</html>
<?PHP
}
?>
