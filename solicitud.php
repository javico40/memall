<?PHP
session_start();
if(!isset($_SESSION['validate'])){
header("location: entrar.php");
}else{
include("include/core/main.php");
//variable memall
$memall = new Memall();
$cliente = new Cliente();
//variable de mensaje
$status = "";
$user = $_SESSION['validate'];
$idUser = $cliente->getId($user);
/*Procesamiento de una solicitud*/
$idSolicitud = $_GET["sd"];
//id solicitud
if($idSolicitud!=""){
//validar que la solicitud pertenezca al usuario

//ejecutar la solicitud
$memall->addContacto($idSolicitud, $idUser);
?>
<script language="javascript">
alert("Ha aceptado el contacto correctamente.");
</script>
<?PHP
header("location: solicitud.php");
}//end vacio
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.:Bienvenidos a memall:. es tu mall, es memall.</title>
<link href="css/users.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.letrasContacto{
color: #4f545a;
font-family: Arial, Helvetica, sans-serif;
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
   <div class="botonIzquierdo posicionBotonUno" align="left"><a class="letradBotonesMenuIzquierdo estilo3" href="agregar.php">Agregar Nuevo Contacto</a></div>
  <div class="botonIzquierdo posicionBotonDos" align="left"><a class="letradBotonesMenuIzquierdo estilo3" href="contactos.php">Contactos</a></div>
  <div class="botonIzquierdo posicionBotonTres botonSeleccionado" align="left"><a class="letradBotonesMenuIzquierdo estilo3" href="solicitud.php">Solicitudes</a></div>
  <div class="botonIzquierdo posicionBotonCuatro" align="left"><a class="letradBotonesMenuIzquierdo estilo3" href="eliminar.php">Eliminar Contacto</a></div>
</div>

<div id="navegacionCentral" class="navegacion">
<table width="815" border="0" bgcolor="#e4e9ff">
    <tr>
      <td width="8">&nbsp;</td>
      <td width="63"><label>
        <div align="center">
          <input type="submit" name="edit" id="edit" value="Editar" />
          </div>
      </label></td>
      <td width="699"><label>
        <div align="left">
          <input type="submit" name="delete" id="delete" value="Eliminar" />
          </div>
      </label></td>
      <td width="27">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  
  <table width="817" border="0">
  <tr>
    <td width="29">&nbsp;</td>
    <td width="177"><div align="center" class="letrasContacto">
      <div align="left">Nombre de Contacto</div>
    </div></td>
    <td width="169"><div align="center" class="letrasContacto">
      <div align="left">Empresa</div>
    </div></td>
    <td width="125"><div align="center" class="letrasContacto">
      <div align="left">Usuario</div>
    </div></td>
    <td width="98"><div align="center" class="letrasContacto">
      <div align="left">Estado</div>
    </div></td>
    <td width="193">&nbsp;</td>
  </tr>
 <?PHP
 $validate = $cliente->getValidateSolicitudes($idUser);
 
if($validate==0){
?>
<tr class="mensajeLeido">
    <td width="29">&nbsp;</td>
    <td width="177"><div align="center" class="letrasContacto">
      <div align="left"></div>
    </div></td>
    <td width="169"><div align="center" class="letrasContacto">
      <div align="center">No existen Solicitudes</div>
    </div></td>
    <td width="125">&nbsp;</td>
    <td width="98">&nbsp;</td>
    <td width="193">&nbsp;</td>
  </tr>  
<?PHP
}else{
 
 $result = $memall->getSolicitudes($idUser);
 //contador
 $contador = 0;
 //Saco los resultados
 while($row = mysql_fetch_array($result)){
   $idSol = $row["idsolicitudes"];
   $estado = $row["estado"];
   $nombre = $row["nombreApellido"];
   $empresa = $row["nombreEmpresa"];
   $login = $row["login"];
   $region = $row["descripcionRegion"];
   
   if($contador=='0'){
    ?>
 <tr class="mensajeLeido">
    <td><label>
      <div align="center">
        <input type="checkbox" name="arrProductos[]" value="<?PHP echo $idSol; ?>" />
        </div>
    </label></td>
    <td><div align="left"><a class="default" href="detalle.php?pd=<?PHP echo $idSol; ?>"><?PHP echo $nombre; ?></a></div></td>
    <td><div align="left"><?PHP echo $empresa; ?></div></td>
    <td><div align="left"><?PHP echo $login; ?></div></td>
    <td><div align="left"><?PHP echo $region; ?></div></td>
    <td><a href="solicitud.php?sd=<?PHP echo $idSol; ?>" class="button"><span class="add">Aceptar Solicitud</span></a></td>
  </tr> 
 <?PHP
    $contador = '1';
   }else{
     ?>
 <tr class="mensajeSinLeer">
    <td><label>
      
            <div align="left">
              <input type="checkbox" name="arrProductos[]" value="<?PHP echo $idSol; ?>" />
              </label>
              </div></td>
    <td><div align="left"><a class="default" href="detalle.php?pd=<?PHP echo $idSol; ?>"><?PHP echo $nombre; ?></a></div></td>
    <td><div align="left"><?PHP echo $empresa; ?></div></td>
    <td><div align="left"><?PHP echo $login; ?></div></td>
    <td><div align="left"><?PHP echo $region; ?></div></td>
    <td><div align="left"><a href="solicitud.php?sd=<?PHP echo $idSol; ?>" class="button"><span class="add">Aceptar Solicitud</span></a></div></td>
  </tr> 
 <?PHP
     $contador = '0';
   }//end if-else    
 }//end while
 }//end validator
 ?>
</table>

</div>
</div>

</div>
</body>
</html>
<?PHP
}//END IF-ELSE
?>