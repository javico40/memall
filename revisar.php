<?PHP
session_start();
if(!isset($_SESSION['validate'])){
header("location: entrar.php");
}else{
include("include/core/main.php");
include("include/connection.php");
include("include/config.php");

$usuario = $_SESSION['validate'];
//create client
$cliente = new Cliente();
$memall = new Memall();
$idCliente = $cliente->getId($usuario);
$validate = $cliente->getValidateContactos($idCliente);
//Get del id Mensaje
$em = $_GET["em"];
//actualizar estado del mensaje
$memall->getEmailStatus($em);
//consultar
$result = $cliente->getEmailClienteSingle($em, $idCliente);
  //Saco los resultados
  while($row = mysql_fetch_array($result)){
    $asunto = $row["asunto"];
    $mensaje = $row["mensaje"];
    $empresa = $row["nombreEmpresa"];
  }//end while
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
  <div class="botonIzquierdo posicionBotonUno" align="left"><a class="letradBotonesMenuIzquierdo estilo3" href="enviar.php">Enviar Mensaje</a></div>
  <div class="botonIzquierdo posicionBotonDos botonSeleccionado" align="left"><a class="letradBotonesMenuIzquierdo estilo3" href="mensajes.php">Bandeja de Entrada</a></div>
  <div class="botonIzquierdo posicionBotonTres" align="left"><a class="letradBotonesMenuIzquierdo estilo3" href="enviados.php">Enviados</a></div>
  <div class="botonIzquierdo posicionBotonCuatro" align="left"><a class="letradBotonesMenuIzquierdo estilo3" href="spam.php">Spam</a></div>
</div>

<div id="navegacionCentral" class="navegacion">

<form action="enviar.php" method="post">
<table width="816" border="0" bgcolor="#e4e9ff">
  <tr>
    <td width="15">&nbsp;</td>
    <td width="60">&nbsp;</td>
    <td width="713">&nbsp;</td>
    <td width="10">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><div align="left"><strong>De:</strong></div></td>
    <td><label>
      <label>
      <div align="left">
        <input type="text" name="textfield" id="textfield" value="<?PHP echo $empresa; ?>" />
      </div>
      </label>
      <div align="left"></div>
      <label></label>
      <div align="left"></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><div align="left"><strong>Asunto:</strong></div></td>
    <td><label>
      <div align="left">
        <input name="txtAsunto" type="text" id="txtAsunto" size="80" value="<?PHP echo $asunto; ?>" readonly="readonly"/>
        </div>
    </label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<table width="818" height="93" border="0">
  <tr>
    <td><label>
      <textarea name="txtMensaje" id="txtMensaje" cols="100" rows="15"><?PHP echo $mensaje; ?></textarea>
    </label></td>
    </tr>
  <tr>
    <td><div align="left"></div></td>
  </tr>
</table>
</form>
</div>

</div>

</div>
</body>
</html>
<?PHP
}//end if-else
?>