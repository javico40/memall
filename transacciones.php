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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.:Bienvenidos a memall:. es tu mall, es memall.</title>
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
     <div class="botonIzquierdo posicionBotonUno" align="left"><a class="letradBotonesMenuIzquierdo estilo3" href="comprando.php">Todas las Ordenes</a></div>
  <div class="botonIzquierdo posicionBotonDos botonSeleccionado" align="left"><a class="letradBotonesMenuIzquierdo estilo3" href="transacciones.php">Ordenes Actuales</a></div>
  </div>

<div id="navegacionCentral" class="navegacion">
   <form id="formulario" action="mensajes.php" method="post">
  <table width="814" border="0" bgcolor="#e4e9ff">
    <tr>
      <td width="9">&nbsp;</td>
      <td width="64"><label>
        <div align="center">
          <input type="submit" name="delete" id="delete" value="Eliminar" />
          </div>
      </label></td>
      <td width="711"><label>
        <div align="left">
          <input type="submit" name="spam" id="spam" value="Es Spam" />
          </div>
      </label></td>
      <td width="12">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <table width="815" border="0" bordercolor="#c9c6cd">
  <?PHP
  if($validate==0){
  ?>
 <tr class="mensajeLeido">
    <td width="94">&nbsp;</td>
    <td width="85">&nbsp;</td>
    <td width="558"><div align="center">No existen Ordenes Actuales</div></td>
    <td width="60">&nbsp;</td>
  </tr> 
  <?PHP
  }else{
  $result = $cliente->getEmailsCliente($idCliente);
  //Saco los resultados
  while($row = mysql_fetch_array($result)){
    $idemail = $row["idemail"];  
    $asunto = $row["asunto"];
    $mensaje = $row["mensaje"];
    $empresa = $row["nombreEmpresa"];
    $estado = $row["estado"];
	$fecha = $row["fecha"];
	
	//si el mensaje no ha sido leido
	if($estado==0){
	?>
	<tr class="mensajeSinLeer">
    <td><label>
      <div align="center">
        <input type="checkbox" name="mensaje[$idemail]" />
        </div>
    </label></td>
    <td><div align="left"><a class="estilo4" href="revisar.php?em=<?PHP echo $idemail; ?>"><?PHP echo $empresa; ?></a></div></td>
    <td><div align="left"><a class="estilo4" href="revisar.php?em=<?PHP echo $idemail; ?>"><?PHP echo $asunto; ?></a></div></td>
    <td><div align="left"><a class="estilo4" href="revisar.php?em=<?PHP echo $idemail; ?>"><?PHP echo $fecha; ?></a></div></td>
    </tr>
	<?PHP
	//si el mensaje ha sido leido
	}else{
	?>
	<tr class="mensajeLeido">
    <td><label>
      <div align="center">
        <input type="checkbox" name="mensaje[$idemail]" />
        </div>
    </label></td>
    <td><div align="left"><a class="estilo4" href="revisar.php?em=<?PHP echo $idemail; ?>"><?PHP echo $empresa; ?></a></div></td>
    <td><div align="left"><a class="estilo4" href="revisar.php?em=<?PHP echo $idemail; ?>"><?PHP echo $asunto; ?></a></div></td>
    <td><div align="left"><a class="estilo4" href="revisar.php?em=<?PHP echo $idemail; ?>"><?PHP echo $fecha; ?></a></div></td>
  </tr>
	<?PHP
   	}//end if-else
   }//end while
 }//validando numero de emails
 ?> 
</table>
</form>
</div>

</div>

</div>
</body>
</html>
<?PHP
}
?>