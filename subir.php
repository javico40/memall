<?PHP
session_start();
include("include/core/main.php");
include("include/connection.php");
include("include/config.php");

if(!isset($_SESSION['validate'])){
header("location: entrar.php");
}else{
//variable usuario en session
$usuario = $_SESSION['validate'];
//create client
$cliente = new Cliente;
$result = $cliente->getClientInformation($usuario);
//Saco los resultados
while($row = mysql_fetch_array($result)){
$email = $row["email"];
$emailAlt = $row["emailAlternativo"];
$telefono = $row["telefono"];
$cargo = $row["cargo"];
$sexo = $row["sexo"];
$login = $row["login"];
$nombreApellido = $row["nombreApellido"];
}//end while


if($sexo==1){
$mujer = "checked = 'checked'";
$hombre = "";
}else if($sexo==0){
$hombre = "checked = 'checked'";
$mujer = "";
}else{
$hombre = "checked = 'checked'";
$mujer = "";
}//end if-else

$status = "";

if ($_POST["send"]){

$nombreApellido = mysql_real_escape_string($_POST["txtNombreApellido"]);
$genero =  mysql_real_escape_string($_POST["radio"]);
$emailAlternativo = mysql_real_escape_string($_POST["txtEmailAlt"]);
$telefono = mysql_real_escape_string($_POST["txtTelefono"]);
$cargo = mysql_real_escape_string($_POST["txtCargoEmpresa"]);

if($nombreApellido==NULL|$genero==NULL|$emailAlternativo==NULL|$telefono==NULL|$cargo==NULL){
$status = "<span class='letrasIncorrecto'><label><strong>Debe llenar todos los campos requeridos.</strong></label></span>";
}else{
//create client
$cliente = new Cliente;
//Actualizar los usuarios
$cliente->updateCuenta($usuario, $nombreApellido, $genero, $emailAlternativo, $telefono, $cargo);
//Confirmar al usuario la actualizacion de datos
$status = "<span class='letrasCorrecto'><label><strong>Los datos han sido actualizados correctamente.</strong></label></span>";


}//end validator espacio

//$ciudadEmpresa =  mysql_real_escape_string($_POST["txtCalleCiudad"]);
}//end post send

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.:Bienvenidos a memall:. es tu mall, es memall.</title>
<link href="css/users.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.letrasCorrecto{color: #00CC00}
.letrasIncorrecto{color:#FF0000}
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
  <div class="botonIzquierdo posicionBotonUno botonSeleccionado" align="left"><a class="letradBotonesMenuIzquierdo estilo3" href="subir.php">Subir mi Foto</a></div>
  <div class="botonIzquierdo posicionBotonDos" align="left"><a class="letradBotonesMenuIzquierdo estilo3" href="cuenta.php">Editar Perfil</a></div>
  <div class="botonIzquierdo posicionBotonTres" align="left"><a class="letradBotonesMenuIzquierdo estilo3" href="cambiar.php">Cambiar Email</a></div>
  <div class="botonIzquierdo posicionBotonCuatro" align="left"><a class="letradBotonesMenuIzquierdo estilo3" href="contrasena.php">Cambiar Contraseña</a></div>
  <div class="botonIzquierdo posicionBotonCuatro" align="left"><a class="letradBotonesMenuIzquierdo estilo3" href="contrasena.php">Cambiar Contraseña</a></div>
</div>

<div id="navegacionCentral" class="navegacion">

<div id="titulo" class="tituloContenedorVender letrasTituloContenedor" align="left">Subir foto</div>
<div id="formul" style="float:left;">
<form action="cuenta.php" method="post" >
  <table width="816" border="0">
    <tr>
      <td width="16">&nbsp;</td>
      <td width="258">&nbsp;</td>
      <td width="484">&nbsp;</td>
      <td width="40">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div align="right"><strong><span class="asteriscos">*</span>Nombre y Apellido:</strong></div></td>
      <td><label>
        <div align="left">
          <input name="txtNombreApellido" type="text" id="txtNombreApellido" value="<?PHP echo $nombreApellido; ?>" size="30" />
          </div>
      </label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div align="right"><strong><span class="asteriscos">*</span>Genero:</strong></div></td>
      <td><label>
        <div align="left">
          <input name="radio" type="radio" id="radio" value="0" <?PHP echo $hombre; ?> />
          Masulino
          <input type="radio" name="radio" id="radio2" value="1" <?PHP echo $mujer; ?> />
          Femenino      </div>
      </label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div align="right"><strong><span class="asteriscos">*</span>Email:</strong></div></td>
      <td><label>
        <div align="left">
          <input name="txtEmail" type="text" id="txtEmail" size="30" value="<?PHP echo $email; ?>" readonly="readonly"/>
          </div>
      </label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div align="right"><strong><span class="asteriscos">*</span>Email Alternativo:</strong></div></td>
      <td><label>
        <div align="left">
          <input name="txtEmailAlt" type="text" id="txtEmailAlt" size="30" value="<?PHP echo $emailAlt; ?>" />
          </div>
      </label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div align="right"><strong><span class="asteriscos">*</span>Telefono:</strong></div></td>
      <td><label>
        <div align="left">
          <input type="text" name="txtTelefono" id="txtTelefono" value="<?PHP echo $telefono; ?>" />
          </div>
      </label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div align="right"><strong>Cargo en la Empresa:</strong></div></td>
      <td><label>
        <div align="left">
          <input type="text" name="txtCargoEmpresa" id="txtCargoEmpresa" value="<?PHP echo $cargo; ?>" />
          </div>
      </label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div align="right"><strong><span class="asteriscos">*</span>Usuario:</strong></div></td>
      <td><label>
        <div align="left">
          <input type="text" name="txtNombreUsuario" id="txtNombreUsuario" value="<?PHP echo $login; ?>" readonly="readonly" />
          </div>
      </label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><div align="left"><?PHP echo $status; ?></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><div align="left">
        <input type="submit" name="send" id="send" value="Enviar" />
      </div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  </form>
  </div>
</div>


</div>

</div>
</body>
</html>
<?PHP
}//END IF-ELSE
?>
