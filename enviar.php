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
//envio del mensaje
if($_POST["send"]){
//get the variables
$para =  mysql_real_escape_string($_POST["comboPara"]);
$asunto =  mysql_real_escape_string($_POST["txtAsunto"]);
$mensaje =  mysql_real_escape_string($_POST["txtMensaje"]);
//enviar el mensaje
$memall->enviarMensaje($idCliente, $para, $asunto, $mensaje);
$final = "Mensaje enviado correctamente.";
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
.Estilo1 {color: #009900}
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
  <div class="botonIzquierdo posicionBotonUno botonSeleccionado" align="left"><a class="letradBotonesMenuIzquierdo estilo3" href="enviar.php">Enviar Mensaje</a></div>
  <div class="botonIzquierdo posicionBotonDos" align="left"><a class="letradBotonesMenuIzquierdo estilo3" href="mensajes.php">Bandeja de Entrada</a></div>
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
    <td><div align="left"><strong>Para:</strong></div></td>
    <td><label>
      <div align="left">
        <select name="comboPara" id="comboPara">
          <?PHP
		  if($validate == 0){
		  ?>
		    <option value="0">Seleccionar</option>
		  <?PHP
		  }else{
		     ?>
			 <option value="0">Seleccionar</option>
			 <?PHP
			 $result = $memall->getContactos($idCliente);
			 //Saco los resultados
             while($row = mysql_fetch_array($result)){
                $id = $row["idusuarios"];
                $empresa = $row["nombreEmpresa"];
			   ?>
			  <option value="<?PHP echo $id; ?>"><?PHP echo $empresa; ?></option>	
				<?PHP 
              }//end while
		  }//end if-else
		  ?>
        </select>
      </div>
      <label></label>
      <div align="left"></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><div align="left"><strong>Asunto:</strong></div></td>
    <td><label>
      <div align="left">
        <input name="txtAsunto" type="text" id="txtAsunto" size="80" />
        </div>
    </label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><span class="Estilo1"><?PHP echo $final; ?></span></td>
    <td>&nbsp;</td>
  </tr>
</table>

<table width="818" height="93" border="0">
  <tr>
    <td><label>
      <textarea name="txtMensaje" id="txtMensaje" cols="100" rows="15"></textarea>
    </label></td>
    </tr>
  <tr>
    <td><div align="left">
      <input type="submit" name="send" id="send" value="Enviar" />
    </div></td>
  </tr>
</table>
</form>
</div>

</div>

</div>
</body>
</html>
<?PHP
}//END IF-ELSE
?>