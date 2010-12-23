<?PHP
session_start();
if(!isset($_SESSION['validate'])){
header("location: entrar.php");
}else{
include("include/core/main.php");
$usuario = $_SESSION['validate'];
//create client
$cliente = new Cliente();
$memall = new Memall();
$idCliente = $cliente->getId($usuario);

if($_POST["buscar"]){
$estado = mysql_real_escape_string($_POST["comboEstado"]);
$tipo = mysql_real_escape_string($_POST["comboTipo"]);
$suscripcion = mysql_real_escape_string($_POST["comboindustria"]);
}//end if-else
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.:Bienvenidos a memall:. es tu mall, es memall.</title>
<link href="css/users.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {font-family: Arial, Helvetica, sans-serif}
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
<form id="formulario" action="agregar.php" method="post">
  <table width="815" border="0" bgcolor="#e4e9ff">
    <tr>
      <td width="14">&nbsp;</td>
      <td width="56">&nbsp;</td>
      <td width="146">&nbsp;</td>
      <td width="47">&nbsp;</td>
      <td width="179">&nbsp;</td>
      <td width="69">&nbsp;</td>
      <td width="162">&nbsp;</td>
      <td width="86">&nbsp;</td>
      <td width="18">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div align="left"><strong>Estado:</strong></div></td>
      <td><label>
        <div align="left">
          <select name="comboEstado" id="comboEstado">
          <option value="0">Seleccionar</option>
          <option value="1">Amazonas</option>
          <option value="2">Anzoategui</option>
          <option value="3">Apure</option>
          <option value="4">Aragua</option>
          <option value="5">Barinas</option>
          <option value="6">Bolivar</option>
          <option value="7">Carabobo</option>
          <option value="8">Cojedes</option>
          <option value="9">Delta Amacuro</option>
          <option value="10">Dtto. Federal</option>
          <option value="11">Falcon</option>
          <option value="12">Guarico</option>
          <option value="13">Lara</option>
          <option value="14">Merida</option>
          <option value="15">Miranda</option>
          <option value="16">Monagas</option>
          <option value="17">Nueva Esparta</option>
          <option value="18">Portuguesa</option>
          <option value="19">Sucre</option>
          <option value="20">Tachira</option>
          <option value="21">Trujillo</option>
          <option value="22">Vargas</option>
          <option value="23">Yaracuy</option>
          <option value="24">Zulia</option>
          </select>
          </div>
      </label></td>
      <td><div align="left"><strong>Tipo:</strong></div></td>
      <td><label>
        <div align="left">
          <select name="comboTipo" id="comboTipo">
            <option value="0">Seleccionar</option>
            <option value="1">Fabricante</option>
            <option value="2">Distribuidor Mayorista</option>
            <option value="3">Distribuidor Minorista</option>
            <option value="4">Cooperativa</option>
            <option value="5">Empresa Estatal</option>
            <option value="6">Importador</option>
            <option value="7">Servicios</option>
            <option value="8">Otros</option>
          </select>
          </div>
      </label></td>
      <td><div align="left"><strong>Industria:</strong></div></td>
      <td><label>
        <div align="left">
          <select name="comboindustria" id="comboindustria">
            <option value="0">Seleccionar</option>
            <?PHP
             $result = $memall->getIndustrias();
		     //Saco los resultados
             while($row = mysql_fetch_array($result)) {
                 $id =  $row["idindustria"];
			     $industria = $row["descripcionIndustria"];
             ?>
             <option value="<?PHP echo $id; ?>"><?PHP echo $industria; ?></option>
             <?PHP
              }//end while 
		     ?>
          </select>
          </div>
      </label></td>
      <td><label>
        <div align="left">
          <input type="submit" name="buscar" id="buscar" value="Buscar"s />
          </div>
      </label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  </form>
  <table width="816" height="62" border="0">
  <tr>
      <td width="10">&nbsp;</td>
      <td width="79"><div align="left"><strong>Logo</strong></div></td>
      <td width="149"><div align="left"><strong>Empresa</strong></div></td>
      <td width="243"><div align="left"><strong>Descripcion</strong></div></td>
      <td width="220"><div align="left"><strong>Vendemos</strong></div></td>
      <td width="75">&nbsp;</td>
      <td width="10">&nbsp;</td>
   </tr>
   <?PHP
  if($estado==NULL|$tipo==NULL|$industria==NULL){
   ?>
   <tr>
      <td width="10">&nbsp;</td>
      <td width="79"><div align="center"></div></td>
      <td width="149"><div align="left" class="letrasTituloPerfil"></div></td>
      <td width="243"><div align="left"></div></td>
      <td width="220"><div align="left"></div></td>
      <td width="75">&nbsp;</td>
      <td width="10">&nbsp;</td>
   </tr>
   <?PHP
   }else{
	$result = $memall->buscarContactos($estado, $tipo, $suscripcion, $idCliente);
	$contador = "0";
	//Saco los resultados
    while($row = mysql_fetch_array($result)){  
	$ctId =  $row["idusuarios"]; 	
	$empresa = $row["nombreEmpresa"];
    $descripcion = $row["descripcionDetallada"];
    $vende = $row["vendemos"];
	$logo = $row["direccionLogo"];
	//validador de logo
	if($logo==""){
	  $logo = "img/logoDefault.jpg";
	}//end validator
	
	//validador de si es contacto
	$isContacto = $memall->isContacto($idCliente, $ctId);
	
	if($contador=='0'){
	  $contador='1'
	?>
    <tr>
      <td width="10">&nbsp;</td>
      <td width="79"><div align="left"><img src="<?PHP echo $logo; ?>" width="73" height="71" /></div></td>
      <td width="149"><div align="left" class="letrasTituloPerfil"><?PHP echo $empresa; ?></div></td>
      <td width="243"><div align="left"><?PHP echo $descripcion; ?></div></td>
      <td width="220"><div align="left"><?PHP echo $vende; ?></div></td>
      <td width="50">
      <?PHP
      if($isContacto=="0"){
	  ?>
      <label>
        <div align="center">
          <a href="contactar.php?ct=<?PHP echo $ctId; ?>" class="button">
            <span class="add">Contactar</span>
          </a>
        </div>
      </label>
      <?PHP
      }else{
	  ?>
      &nbsp;
      <?PHP
      }//end if-else
	  ?>
      </td>
      <td width="10">&nbsp;</td>
    </tr>
    <?PHP
    }else{
	  $contador='0'
	?>
	<tr bgcolor="#edf0f9">
      <td width="10">&nbsp;</td>
      <td width="79"><div align="center"><img src="<?PHP echo $logo; ?>" width="73" height="71" /></div></td>
      <td width="149"><div align="left" class="letrasTituloPerfil"><?PHP echo $empresa; ?></div></td>
      <td width="243"><div align="left"><?PHP echo $descripcion; ?></div></td>
      <td width="220"><div align="left"><?PHP echo $vende; ?></div></td>
      <td width="50">
      <?PHP
      if($isContacto=="0"){
	  ?>
      <label>
        <div align="center">
          <a href="contactar.php?ct=<?PHP echo $ctId; ?>" class="button">
            <span class="add">Contactar</span>
          </a>
        </div>
      </label>
      <?PHP
      }else{
	  ?>
      &nbsp;
      <?PHP
      }//end if-else
	  ?>
      </td>
      <td width="10">&nbsp;</td>
    </tr>
	<?PHP
	 }//end if-else contador
	  }//end while
	}//end if-else  
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