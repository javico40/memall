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

if($_POST["delete"]){
if(!empty($_POST['arrProductos'])){
//get the variables
$prodList = $_POST['arrProductos'];
//eliminar productos
$cliente->deleteProductosCliente($idUser, $prodList);
}else{
echo "No ha seleccionado un producto";
}//end validator empty
}//end if-else

if($_POST["edit"]){
 if(!empty($_POST['arrProductos'])){
  //variable
  $counter = 0;
  //get the variables
  $prodList = $_POST['arrProductos'];
  foreach($prodList as $iId) {
    //echo $iId;
	$counter++;
  }//end for each
  
  if($counter == 1){
    echo "iniciando la edicion del producto";
  }else{
    echo "Solo puede editar un producto a la vez.";
  }//end
  
 }//end validator empty
}//end
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
  
  <div class="botonIzquierdo posicionBotonUno" align="left"><a class="letradBotonesMenuIzquierdo estilo3" href="publicar.php">Publicar un nuevo Producto</a></div>
  <div class="botonIzquierdo posicionBotonDos botonSeleccionado" align="left"><a class="letradBotonesMenuIzquierdo estilo3" href="vender.php">Productos</a></div>
  <div class="botonIzquierdo posicionBotonTres" align="left"><a class="letradBotonesMenuIzquierdo estilo3" href="promociones.php">Promocionar mis Productos</a></div>
</div>

<div id="navegacionCentral" class="navegacion">
<!--<div id="titulo" class="tituloContenedorVender letrasTituloContenedor" align="left">Lista de Productos</div> -->
<form method="post" action="vender.php">
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
    <td width="30">&nbsp;</td>
    <td width="270"><div align="center" class="letrasContacto">
      <div align="left">Nombre del Producto</div>
    </div></td>
    <td width="178"><div align="center" class="letrasContacto">
      <div align="left">Industria</div>
    </div></td>
    <td width="135"><div align="center" class="letrasContacto">
      <div align="left">Categoria</div>
    </div></td>
    <td width="150"><div align="center" class="letrasContacto">
      <div align="left">Estado</div>
    </div></td>
    <td width="28">&nbsp;</td>
  </tr>
 <?PHP
 $validate = $cliente->getValidateProductos($idUser);
 
if($validate==0){
?>
<tr class="mensajeLeido">
    <td width="30">&nbsp;</td>
    <td width="270"><div align="center" class="letrasContacto">
      <div align="left"></div>
    </div></td>
    <td width="178"><div align="center" class="letrasContacto">
      <div align="center">No existen Productos</div>
    </div></td>
    <td width="135">&nbsp;</td>
    <td width="150">&nbsp;</td>
    <td width="28">&nbsp;</td>
  </tr>  
<?PHP
}else{
 
 $result = $memall->getProductos($idUser);
 //contador
 $contador = 0;
 //Saco los resultados
 while($row = mysql_fetch_array($result)){
   $idPd = $row["idproductos"];
   $nombre = $row["nombreProducto"];
   $industria = $row["descripcionIndustria"];
   $categoria = $row["descripcionCategoria"];
   $estado = $row["estado"];
   
   if($estado == '1'){
   $estado = "Activo";
   }else{
   $estado = "Inactivo";
   }  
   
   if($contador=='0'){
    ?>
 <tr class="mensajeLeido">
    <td><label>
      <div align="center">
        <input type="checkbox" name="arrProductos[]" value="<?PHP echo $idPd; ?>" />
        </div>
    </label></td>
    <td><div align="left"><a class="default" href="detalle.php?pd=<?PHP echo $idPd; ?>"><?PHP echo $nombre; ?></a></div></td>
    <td><div align="left"><?PHP echo $industria; ?></div></td>
    <td><div align="left"><?PHP echo $categoria; ?></div></td>
    <td><div align="left"><?PHP echo $estado; ?></div></td>
    <td>&nbsp;</td>
  </tr> 
 <?PHP
    $contador = '1';
   }else{
     ?>
 <tr class="mensajeSinLeer">
    <td><label>
      <div align="center">
        <input type="checkbox" name="arrProductos[]" value="<?PHP echo $idPd; ?>" />
        </div>
    </label></td>
    <td><div align="left"><a class="default" href="detalle.php?pd=<?PHP echo $idPd; ?>"><?PHP echo $nombre; ?></a></div></td>
    <td><div align="left"><?PHP echo $industria; ?></div></td>
    <td><div align="left"><?PHP echo $categoria; ?></div></td>
    <td><div align="left"><?PHP echo $estado; ?></div></td>
    <td>&nbsp;</td>
  </tr> 
 <?PHP
     $contador = '0';
   }//end if-else    
 }//end while
 }//end validator
 ?>
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
>