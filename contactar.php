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
//id de contacto
$ct = $_GET["ct"];

$result = $memall->getContactInfo($ct);
 //Saco los resultados
while($row = mysql_fetch_array($result)) {
    $empresa =  $row["nombreEmpresa"];
	$logo = $row["direccionLogo"];
	if($logo==""){
	  $logo = "img/logoDefault.jpg";
	}//end validator
}//end while

/*Procesamiento del send*/
if($_POST["send"]){
//registro la solicitud
$memall->registrarSolicitud($idCliente, $ct);
//redireccionar a la pantalla de finalizado el contacto
header("location: contactado.php");
}//end post
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.:Bienvenidos a memall:. es tu mall, es memall.</title>
<link href="css/users.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.Estilo1 {
	font-family: "Times New Roman", Times, serif
}
-->
</style>
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
    
    <div id="contenedorPerfilImagen" class="contenedorPerfilImagen"><img src="<?PHP echo $logo; ?>" width="130" height="100" id="imgPerfil"></img></div>
    <div id="contenedorInformacion" class="contenedorPerfilInformacion">
    <form id="formulario" action="contactar.php?ct=<?PHP echo $ct; ?>" method="post">
      <table width="400" height="296" border="0">
        <tr>
          <td height="35"> <div align="left" class="letrasTituloPerfil">Agregar a <?PHP echo $empresa; ?> como Contacto</div></td>
        </tr>
        <tr>
          <td height="21"><p align="justify">Esta accion notificara a la empresa que deseas entrar en su red de negocio.</p>
          <p align="justify"> Si la empresa <strong><?PHP echo $empresa; ?></strong> acepta tu invitacion de contacto, podras visualizar sus publicaciones en el muro, recibir y enviar mensajes a la empresa, ver los productos en venta y realizar pedidos, igualmente <strong><?PHP echo $empresa; ?></strong> tendra acceso a tu red de negocio.</p></td>
        </tr>
        <tr>
          <td height="23"><div align="justify" class="Estilo1">
            <p>&nbsp;</p>
            </div></td>
        </tr>
        <tr>
          <td height="25">
            <div align="center">
              <input type="submit" name="send" id="send" value="Continuar" />
          </div></td>
        </tr>
        <tr>
          <td height="26">            <label>
            <div align="center"></div>
          </label></td>
        </tr>
      </table>
    </form>
    </div>
 </div>
</div>


</div>

</div>
</body>
</html>
<?PHP
}//end header validator
?>