<?PHP
include("include/core/main.php");
//Crear objeto
$memall = new Memall();
//tomar la industria
$industria = $_GET['im'];
$categoria = $_GET['ct'];
//validar industria y categoria
if($industria==""){
$tipo = "0";
}else if($categoria==""){
$tipo = "1";
$valid = $memall->validateIndustria($industria);
}else{
$tipo = "2";
$valid = $memall->validateCategoria($industria, $categoria);
}//end if-else
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/index.css" rel="stylesheet" type="text/css" />
<title>.:Bienvenidos a memall:. es tu mall, es memall.</title>
<style type="text/css">
<!--
.style4 {color: #666666}
.style5 {
	font-size: 14px
}
.style6 {
	color: #339900;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
}
.style7 {
	font-size: 12px;
	font-weight: bold;
}
.style8 {color: #000000}
-->
</style>
</head>
<body>
<div id="pagina" align="center" class="pagina">
 <div id="header" class="header">
    <?PHP
      include("header.php");
    ?>
  </div>

<div id="Filtrado" class="tablaFiltrar letrasFiltrado">
  <table width="1004" border="0">
    <tr>
      <td width="231">Por Ubicacion:
        <select name="region" id="region">
          <option value="0">Seleccionar</option>
        </select></td>
      <td width="693">Por Precio:
      <select name="select" id="select">
        <option value="0">Seleccionar</option>
        <option value="1">Menor Precio</option>
        <option value="2">Mayor Precio</option>
      </select></td>
      <td width="23">&nbsp;</td>
      <td width="23">&nbsp;</td>
      <td width="12">&nbsp;</td>
    </tr>
  </table>
</div>
<?PHP
if($tipo=="0"){
//si es una busqueda por industria
}else if($tipo=="1"){
  //si existen productos
  if($valid > 0){
     $result = $memall->getProductosPorIndustria($industria);
	 //int incremeter
     $inc = 180;
	 //Saco los resultados
     while($row = mysql_fetch_array($result)){
       $id = $row["idproductos"];
       $nombre = $row["nombreProducto"];
	   $descripcion = $row["descripcionCorta"];
	   $imagen = $row["rutaImagen"];
       $cantMinima = $row["cantidadMinimaOrdenar"];
	   $empresa = $row["nombreEmpresa"];
	   $ciudad = $row["ciudad"];
	   
   ?>
   <div id="buscador" class="tablaBuscar" style="float:left; margin-top:10px; top: <?PHP echo $inc; ?>px; width: 740px; height: 140px; z-index: 14; vertical-align: middle;">
<div id="imgProducto" align="left" style="float:left; width: 130px; height: 100px;">
<img src="<?PHP echo $imagen; ?>" width="130" height="100" />
</div>
<div id="datosProducto" align="left" style="float:left; margin-left:10px; margin-right:10px; width: 350px; height: 110px;">
<table width="349" height="114" border="0">
  <tr>
    <td width="343" class="letrasFiltrado"><a href="productos.php?pid=<?PHP echo $id; ?>"><?PHP echo $nombre; ?></a></td>
  </tr>
  <tr>
    <td height="21"><span class="style4"><?PHP echo $valid; ?> Productos Similares</span></td>
  </tr>
  <tr>
    <td height="19" class="letrasFiltrado style5"><?PHP echo $descripcion; ?></td>
  </tr>
  <tr>
    <td class="style3">Orden minima: <?PHP echo $cantMinima; ?></td>
  </tr>
</table>
</div>
<div id="datosEmpresa"  align="left" style="float:left; width: 220px; height: 100px;">
  <table width="221" border="0">
    <tr>
      <td width="215"><span class="style6"><?PHP echo $empresa; ?></span></td>
    </tr>
    <tr>
      <td><span class="style7">RIF: J-321547858-9</span></td>
    </tr>
    <tr>
      <td class="style3"><?PHP echo $ciudad; ?>, Edo Zulia</td>
    </tr>
    <tr>
      <td class="style3">Proveedor Dorado</td>
    </tr>
    <tr>
      <td><div id="contacto" class="botonContacto" align="center"><a href="contactar.php">Contactar</a></div></td>
    </tr>
  </table>
</div>
</div>
<?PHP
$inc = $inc + 150;
    }//end while
  }//end validacion existen productos
//si es una busqueda por categorias
}else if($tipo=="2"){
  //si existen productos
  if($valid > 0){
    $result = $memall->getProductosPorCategoria($industria, $categoria);
  //int incremeter
     $inc = 180;
	 //Saco los resultados
     while($row = mysql_fetch_array($result)){
       $id = $row["idproductos"];
       $nombre = $row["nombreProducto"];
	   $descripcion = $row["descripcionCorta"];
	   $imagen = $row["rutaImagen"];
       $cantMinima = $row["cantidadMinimaOrdenar"];
	   $empresa = $row["nombreEmpresa"];
	   $ciudad = $row["ciudad"];
	   
   ?>
   <div id="buscador" class="tablaBuscar" style="float:left; margin-left:10px; margin-top:10px; top: <?PHP echo $inc; ?>px; width: 740px; height: 140px; z-index: 14; vertical-align: middle;">
<div id="imgProducto" align="left" style="float:left; width: 130px; height: 100px;">
   <img src="<?PHP echo $imagen; ?>" width="130" height="100" />
</div>
<div id="datosProducto" align="left" style="float:left;  margin-left:10px; margin-right:10px; width: 350px; height: 110px;">
<table width="349" height="114" border="0">
  <tr>
    <td width="343" class="letrasFiltrado"><a href="productos.php?id=<?PHP echo $id; ?>"><?PHP echo $nombre; ?></a></td>
  </tr>
  <tr>
    <td height="21"><span class="style4"><?PHP echo $valid; ?> Productos Similares</span></td>
  </tr>
  <tr>
    <td height="19" class="letrasFiltrado style5"><?PHP echo $descripcion; ?></td>
  </tr>
  <tr>
    <td class="style3">Orden minima: <?PHP echo $cantMinima; ?></td>
  </tr>
</table>
</div>
<div id="datosEmpresa"  align="left" style="float:left; margin-left:10px; margin-right:10px; width: 220px; height: 100px;">
  <table width="221" border="0">
    <tr>
      <td width="215"><span class="style6"><?PHP echo $empresa; ?></span></td>
    </tr>
    <tr>
      <td><span class="style7">RIF: J-321547858-9</span></td>
    </tr>
    <tr>
      <td class="style3"><?PHP echo $ciudad; ?>, Edo Zulia</td>
    </tr>
    <tr>
      <td class="style3">Proveedor Dorado</td>
    </tr>
    <tr>
      <td><div id="contacto" class="botonContacto" align="center"><a href="contactar.php">Contactar</a></div></td>
    </tr>
  </table>
</div>
</div>
<?PHP
$inc = $inc + 150;
    }//end while
  }//end validacion existen productos
}//end busqueda
?>
</div>
</body>
</html>
