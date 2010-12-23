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
$cliente = new Cliente;
//recuperar los datos de la empresa
$result = $cliente->getClientInformation($usuario);
//Saco los resultados
while($row = mysql_fetch_array($result)){
$empresa = $row["nombreEmpresa"];
$imgEmpresa = $row["direccionLogo"];
$descripcionEmpresa = $row["descripcionDetallada"];
$dirUno = $row["direccionUno"];
$dirDos = $row["direccionDos"];
$ciudad = $row["ciudad"];
$ciudadDos = $row["ciudadDos"];
$region =  $row["descripcionRegion"];

$isFabricante = $row["isFabricante"];
$isMayorista = $row["isDistribuidorMayorista"];
$isMinorista = $row["isDistribuidorMinorista"];
$isCooperativa = $row["isCooperativa"];
$isEmpresaEstatal = $row["isEmpresaEstatal"];
$isImportador = $row["isImportador"];
$isMinorista = $row["isServicios"];
$isMinorista = $row["isOtros"];

$vendemos = $row["vendemos"];
$compramos = $row["compramos"];

if($imgEmpresa ==""){
$imgEmpresa = "img/logoDefault.jpg";
}//end if

}//end while

if($isFabricante == 1){
$isFabricante = " Fabricante";
}else{
$isFabricante = "";
}

if($isMayorista==1){
$isMayorista = " Distribuidor Mayorista"; 
}else{
$isMayorista = "";
}

if($isMinorista==1){
$isMinorista = " Distribuidor Minorista";
}else{
$isMinorista = "";
}

if($isCooperativa==1){
$isCooperativa = " Cooperativa";
}else{
$isCooperativa = "";
}

if($isEmpresaEstatal==1){
$isEmpresaEstatal = " Empresa Estatal";
}else{
$isEmpresaEstatal = "";
}

if($isImportador==1){
$isImportador = " Importadora";
}else{
$isImportador = "";
}

if($isServicios==1){
$isServicios = " Servicios";
}else{
$isServicios = "";
}

if($isOtros==1){
$isOtros = " Otros";
}else{
$isOtros = "";
}

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
  <div class="botonIzquierdo posicionBotonUno" align="left"><a class="letradBotonesMenuIzquierdo estilo3" href="editarempresa.php">Editar Empresa</a></div>
  <div class="botonIzquierdo posicionBotonDos botonSeleccionado" align="left"><a class="letradBotonesMenuIzquierdo estilo3" href="empresa.php">Mi Empresa</a></div>
</div>

<div id="navegacionCentral" class="navegacion">
   <div id="centralInside" class="contenedorCentral">
     
     
     <div id="left" style="float:left; width:150px;">
     
     <div id="contenedorPerfilImagen" class="contenedorPerfilImagen"><img id="imgPerfil" src="<?PHP echo $imgEmpresa; ?>"></img></div>
     <div id="contenedorUbicacion" class="contenedorPerfilUbicacion">
       <table width="129" border="0">
         <tr>
           <td><div align="center" class="letrasTituloPerfil">
             <div align="left">Ubicacion</div>
           </div></td>
         </tr>
         <tr>
           <td><div align="left"><strong><?PHP echo $dirUno; ?></strong></div></td>
         </tr>
         <tr>
           <td><div align="left"><strong><?PHP echo $ciudad; ?></strong></div></td>
         </tr>
         <tr>
           <td><div align="left"><strong><?PHP echo $region; ?></strong></div></td>
         </tr>
         <tr>
           <td><div align="left"><strong>Venezuela</strong></div></td>
         </tr>
       </table>
     </div>
     
     </div>
     
     <div id="contenedorInformacion" class="contenedorPerfilInformacion">
       <table width="400" border="0">
         <tr>
           <td width="13" height="33">&nbsp;</td>
           <td width="357"><div align="left"><strong><?PHP echo $empresa; ?></strong></div></td>
           <td width="16">&nbsp;</td>
         </tr>
         <tr>
           <td>&nbsp;</td>
           <td><div align="left"><span class="letrasTituloPerfil">Sobre la Empresa:</span></div></td>
           <td>&nbsp;</td>
         </tr>
         <tr>
           <td>&nbsp;</td>
           <td><div align="justify"><?PHP echo $descripcionEmpresa; ?></div></td>
           <td>&nbsp;</td>
         </tr>
         <tr>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
         </tr>
         <tr>
           <td>&nbsp;</td>
           <td><div align="left"><span class="letrasTituloPerfil">Tipo de Empresa:</span></div></td>
           <td>&nbsp;</td>
         </tr>
         <tr>
           <td>&nbsp;</td>
           <td><div align="justify"><?PHP
			  $tipo = $isFabricante.$isMayorista.$isMinorista.$isCooperativa.$isEmpresaEstatal.$isImportador.$isServicios.$isOtros;
			  echo $tipo;
			?></div></td>
           <td>&nbsp;</td>
         </tr>
         <tr>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
         </tr>
         <tr>
           <td>&nbsp;</td>
           <td class="letrasTituloPerfil"><div align="left">Ofrece</div></td>
           <td>&nbsp;</td>
         </tr>
         <tr>
           <td>&nbsp;</td>
           <td><div align="justify"><?PHP echo $vendemos; ?></div></td>
           <td>&nbsp;</td>
         </tr>
         <tr>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
         </tr>
         <tr>
           <td>&nbsp;</td>
           <td class="letrasTituloPerfil"><div align="left">Compra</div></td>
           <td>&nbsp;</td>
         </tr>
         <tr>
           <td>&nbsp;</td>
           <td><div align="justify"><?PHP echo $compramos; ?></div></td>
           <td>&nbsp;</td>
         </tr>
         <tr>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
         </tr>
         <tr>
           <td>&nbsp;</td>
           <td class="letrasTituloPerfil"><div align="left">Detalles</div></td>
           <td>&nbsp;</td>
         </tr>
         <tr>
           <td>&nbsp;</td>
           <td><div align="justify"><?PHP echo $descripcionEmpresa; ?></div></td>
           <td>&nbsp;</td>
         </tr>
         <tr>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
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
</body>
</html>
<?PHP
}//END IF-ELSE
?>