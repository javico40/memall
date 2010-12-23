<?PHP
include("include/core/main.php");

//get variables
$idProducto = $_GET['pid'];

//Crear objeto
$memall = new Memall();
//obtener info del producto
$result = $memall->getInformacionProducto($idProducto);
//Saco los resultados
while($row = mysql_fetch_array($result)){
$nombre = $row["nombreProducto"];
$imagen = $row["rutaImagen"];
$descripcion = $row["descripcionDetallada"];
}//end while

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.:Bienvenidos a memall:. es tu mall, es memall.</title>
<link href="css/index.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.Estilo1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 24px;
}
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

<div id="leftProductContainer" class="leftProductContainer">
  <table width="251" height="277" border="0">
    <tr>
      <td height="30"><div id="imagenProducto" align="center" style="border-right:1px solid #d2d2d2;border-left:1px solid #d2d2d2;border-top:1px solid #d2d2d2;border-bottom:1px solid #d2d2d2; height:200px;">
        
        <img style="margin-top:20px;" src="<?PHP echo $imagen; ?>" width="177" height="149" />
        
        </div></td>
    </tr>
    <tr>
        <td height="41">        </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>

<div id="centerProductoContainer" class="centerProductoContainer">
  <table width="519" height="205" border="0">
    <tr>
      <td height="51"><div align="justify"><span class="Estilo1"><?PHP echo $nombre; ?></span></div></td>
    </tr>
    <tr>
      <td height="28"><div align="left"></div></td>
    </tr>
    <tr>
      <td height="30"><div align="left" style="float:left; margin-top:10px;">
	  <?PHP
        echo $descripcion; 
	  ?>
      </div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>

<div id="rightProductContainer" class="rightProductoContainer">

</div>


</div>
</body>
</html>
