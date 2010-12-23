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
//memall
$memall = new Memall();

$result = $cliente->getClientInformation($usuario);
//Saco los resultados
while($row = mysql_fetch_array($result)){
$empresa = $row["nombreEmpresa"];
$codigoRif = $row["codigoRif"];
$dirUno = $row["direccionUno"];
$dirDos = $row["direccionDos"];
$ciudad = $row["ciudad"];
$ciudadDos = $row["ciudadDos"];
//tipo de empresa
$fabricante = $row["isFabricante"];
$mayorista = $row["isDistribuidorMayorista"];
$minorista = $row["isDistribuidorMinorista"];
$cooperativa = $row["isCooperativa"];
$estatal = $row["isEmpresaEstatal"];
$importador = $row["isImportador"];
$servicios = $row["isServicios"];
$otros = $row["isOtros"];
//Vendemos

//Compramos

}//end while

//register
if ($_POST["send"]){

$empresa = mysql_real_escape_string($_POST["txtEmpresa"]);
$codigoRif = mysql_real_escape_string($_POST["txtCodigoRif"]);
$calleEmpresa =  mysql_real_escape_string($_POST["txtCalleEmpresa"]);
$ciudadEmpresa =  mysql_real_escape_string($_POST["txtCalleCiudad"]);
$estadoEmpresa = mysql_real_escape_string($_POST["comboEstadoEmpresa"]);

$calleContacto =  mysql_real_escape_string($_POST["txtCalleContacto"]);
$ciudadContacto =  mysql_real_escape_string($_POST["txtCiudadContacto"]);
$estadoContacto = mysql_real_escape_string($_POST["comboEstadoContacto"]);

$isFabricante = mysql_real_escape_string($_POST["checkbox"]);
$isMayorista  = mysql_real_escape_string($_POST["checkbox2"]);
$isMinorista  = mysql_real_escape_string($_POST["checkbox3"]);
$isCooperativa  = mysql_real_escape_string($_POST["checkbox4"]);
$isEstatal  = mysql_real_escape_string($_POST["checkbox5"]);
$isImportador = mysql_real_escape_string($_POST["checkbox6"]);
$isServicios = mysql_real_escape_string($_POST["checkbox7"]);
$isOtros  = mysql_real_escape_string($_POST["checkbox8"]);
//vendemos
$vendUno = mysql_real_escape_string($_POST["txtVendUno"]);
$vendDos = mysql_real_escape_string($_POST["txtVendDos"]);
$vendTres = mysql_real_escape_string($_POST["txtVendTres"]);
$vendemos =  $vendUno." ".$vendDos." ".$vendTres;
//compramos
$comUno = mysql_real_escape_string($_POST["txtCompUno"]);
$compDos = mysql_real_escape_string($_POST["txtCompDos"]);
$compTres = mysql_real_escape_string($_POST["txtCompTres"]);
$compramos =  $comUno." ".$compDos." ".$compTres;
//tamaño y tiempo empresa
$anos  = mysql_real_escape_string($_POST["comboAnos"]);
$empleados  = mysql_real_escape_string($_POST["comboEmpleados"]);
//medios de envio
$isTransporte = mysql_real_escape_string($_POST["isTransporte"]);
$nivelEnvios = mysql_real_escape_string($_POST["comboEnvios"]);
//region de exportacion
$expAmericaNorte = mysql_real_escape_string($_POST["expAmericaNorte"]);
$expAmericaSur = mysql_real_escape_string($_POST["expAmericaSur"]);
$expEuropa = mysql_real_escape_string($_POST["expEuropa"]);
$expAsia = mysql_real_escape_string($_POST["expAsia"]);
$expAfrica = mysql_real_escape_string($_POST["expAfrica"]);
$expOceania = mysql_real_escape_string($_POST["expOceania"]);
//Logo

//descripcion y logo
$descripcion = mysql_real_escape_string($_POST["txtDescripcion"]);
$sitioWeb =  mysql_real_escape_string($_POST["txtSitioWeb"]);

//deteccion de is
if($isFabricante=="on"){
$isFabricante = 1;
}else{
$isFabricante = 0;
}//end

if($isMayorista=="on"){
$isMayorista = 1;
}else{
$isMayorista = 0;
}//end

if($isMinorista=="on"){
$isMinorista = 1;
}else{
$isMinorista = 0;
}//end

if($isCooperativa=="on"){
$isCooperativa = 1;
}else{
$isCooperativa = 0;
}//end

if($isEstatal=="on"){
$isEstatal = 1;
}else{
$isEstatal = 0;
}//end

if($isImportador=="on"){
$isImportador = 1;
}else{
$isImportador = 0;
}//end

if($isServicios=="on"){
$isServicios = 1;
}else{
$isServicios = 0;
}//end

if($isOtros=="on"){
$isOtros = 1;
}else{
$isOtros = 0;
}//end

if($isTransporte=="on"){
$isTransporte = 1;
}else{
$isTransporte = 0;
}//end

if($expAmericaNorte=="on"){
$expAmericaNorte = 1;
}else{
$expAmericaNorte = 0;
}//end

if($expAmericaSur=="on"){
$expAmericaSur = 1;
}else{
$expAmericaSur = 0;
}//end

if($expEuropa=="on"){
$expEuropa = 1;
}else{
$expEuropa = 0;
}//end

if($expAsia=="on"){
$expAsia = 1;
}else{
$expAsia = 0;
}//end

if($expAfrica=="on"){
$expAfrica = 1;
}else{
$expAfrica = 0;
}//end

if($expOceania=="on"){
$expOceania = 1;
}else{
$expOceania = 0;
}//end

//validar los espacios en blanco
if($empresa==NULL|$codigoRif==NULL|$calleEmpresa==NULL|$ciudadEmpresa==NULL|$calleContacto==NULL|$ciudadContacto|$descripcion==NULL){
$status = "<span class='letrasIncorrecto'><label><strong>Debe llenar todos los campos requeridos.</strong></label></span>";
}else{
//subida de la imagen
 //valido si existe una imagen
//imagen
$nombre_archivo = $_FILES['userfile']['name']; 
$tipo_archivo = $_FILES['userfile']['type']; 
$tamano_archivo = $_FILES['userfile']['size']; 

//si el tamaño es 0, esta vacio
if($tamano_archivo == 0){
$rutaimagen = "img/logoDefault.jpg";
}else{
//compruebo si las características del archivo son las que deseo 
if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg")) && ($tamano_archivo < 200000))) { 
    $status = "<span class='letrasIncorrecto'><label><strong>La extensión o el tamaño de los archivos no es correcta.</strong></label></span>"; 
}else{ 
    if (move_uploaded_file($_FILES['userfile']['tmp_name'], "usuarios/empresas/".$user."_".$nombre_archivo)){ 
       $status = "El archivo ha sido cargado correctamente."; 
	   $fund = new Fundamental();
	   $fund->redimensiona_imagen($user."_".$nombre_archivo, "usuarios/empresas/",  "130", "100");	   
    }else{ 
       $status = "<span class='letrasIncorrecto'><label><strong>Error al almacenar la imagen, revise el formato y tamaño.</strong></label></span>"; 
    }//end if file not uploades
}//end if extension o size problems
//nombre de la imagen
$rutaimagen = "usuarios/empresas/".$user."_".$nombre_archivo;
}//validador imagen
//Actualizar los datos de la empresa
$cliente->updateEmpresa($usuario, $empresa, $codigoRif, $calleEmpresa, $ciudadEmpresa, $estadoEmpresa, $calleContacto, $ciudadContacto, $estadoContacto, $isFabricante, $isMayorista, $isMinorista, $isCooperativa, $isEstatal, $isImportador, $isServicios, $isOtros, $vendemos, $compramos, $anos, $empleados, $isTransporte, $nivelEnvios, $expAmericaNorte, $expAmericaSur, $expEuropa, $expAsia, $expAfrica, $expOceania, $descripcion, $sitioWeb, $rutaimagen);

$status = "<span class='letrasCorrecto'><label><strong>Los datos han sido actualizados correctamente.</strong></label></span>"; 


}//validador de espacios en blanco
}//end post send
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.:Bienvenidos a memall:. es tu mall, es memall.</title>
<link href="css/users.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="pagina" align="center" class="paginaUsuariosEmpresa">

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

<div id="menuIzquierdo" class="menuLateralEditarEmpresa" align="left">
  <div id="contenedorMenu" class="contenedorMenu" align="center">
  <div class="botonIzquierdo posicionBotonUno botonSeleccionado" align="left"><a class="letradBotonesMenuIzquierdo estilo3" href="editarempresa.php">Editar Empresa</a></div>
  <div class="botonIzquierdo posicionBotonDos" align="left"><a class="letradBotonesMenuIzquierdo estilo3" href="empresa.php">Mi Empresa</a></div>
  </div>

<div id="navegacionCentral" class="navegacionEmpresa">
  <form action="editarempresa.php" method="post"  enctype="multipart/form-data" >
   <table width="824" border="0" cellspacing="3">
     <tr>
       <td width="12">&nbsp;</td>
       <td width="212">&nbsp;</td>
       <td width="561">&nbsp;</td>
       <td width="16">&nbsp;</td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td><?PHP echo $status; ?></td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td><div align="right"><strong><span class="asteriscos">*</span>Nombre de la Empresa:</strong></div></td>
       <td><label>
         <div align="left">
           <input name="txtEmpresa" type="text" id="txtEmpresa" size="60" value="<?PHP echo $empresa; ?>" />
           </div>
       </label></td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td><div align="right"><strong><span class="asteriscos">*</span>Numero de RIF:</strong></div></td>
       <td><label>
         <div align="left">
           <input name="txtCodigoRif" type="text" id="txtCodigoRif" value="<?PHP echo $codigoRif; ?>" />
           </div>
       </label></td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td><div align="right"><strong><span class="asteriscos">*</span>Direccion de la Empresa:</strong></div></td>
       <td><label></label>
                <div align="left">
              Calle:
                <label></label>
                <input type="text" name="txtCalleEmpresa" id="txtCalleEmpresa" value="<?PHP echo $dirUno; ?>" />
            Ciudad:
            <input type="text" name="txtCalleCiudad" id="txtCalleCiudad" value="<?PHP echo $ciudad; ?>" />
            Estado:
            <select name="comboEstadoEmpresa" id="comboEstadoEmpresa">
              <?PHP
             $result = $memall->getPaises();
		     //Saco los resultados
             while($row = mysql_fetch_array($result)){
		     $id = $row["idregiones"];
		     $descripcion = $row["descripcionRegion"];
		     ?>
               <option value="<?PHP echo $id; ?>"><?PHP echo $descripcion; ?></option>
              <?PHP
             }
		     ?>
            </select>
            </label>
            </div></td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td><div align="right"><strong><span class="asteriscos">*</span>Direccion de Contacto:</strong></div></td>
       <td><div align="left">
           Calle:
               <label></label>
               <input type="text" name="txtCalleContacto" id="txtCalleContacto" value="<?PHP echo $dirDos; ?>" />
           Ciudad:
  <input type="text" name="txtCiudadContacto" id="txtCiudadContacto" value="<?PHP echo $ciudadDos ?>" />
           Estado:
  <select name="comboEstadoContacto" id="comboEstadoContacto">
             <option value="0">Seleccionar</option>
    <?PHP
             $result = $memall->getPaises();
		     //Saco los resultados
             while($row = mysql_fetch_array($result)){
		     $id = $row["idregiones"];
		     $descripcion = $row["descripcionRegion"];
		     ?>
    <option value="<?PHP echo $id; ?>"><?PHP echo $descripcion; ?></option>
    <?PHP
             }
		     ?> 
  </select>
         </div>
         </label></td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td><div align="right"><strong>Tipo de Empresas:</strong></div></td>
       <td><label>
         <div align="left">
           <?PHP
		   if($fabricante=='1'){
		   ?>
           <input type="checkbox" name="checkbox" id="checkbox" checked="checked"/>
           Fabricante         
		   <?PHP }else{ ?>
           <input type="checkbox" name="checkbox" id="checkbox" />
           Fabricante
           <?PHP }//end if-else?>
           </div>
         <div align="left"></div>
       </label></td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td><label>
           <div align="left">
           <?PHP
		   if($mayorista=='1'){
		   ?>
             <input type="checkbox" name="checkbox2" id="checkbox2" checked="checked" />
             Distribuidor Mayorista 
           <?PHP }else{ ?>
             <input type="checkbox" name="checkbox2" id="checkbox2" />
             Distribuidor Mayorista 
           <?PHP }//end if-else?>           
           </div>
           <div align="left"></div>
       </label></td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td><label>
           <div align="left">
             <?PHP
		     if($minorista=='1'){
		     ?>
             <input type="checkbox" name="checkbox3" id="checkbox3" checked="checked" />
             Distribuidor Minorista           
             <?PHP }else{ ?>
             <input type="checkbox" name="checkbox3" id="checkbox3" />
             Distribuidor Minorista
              <?PHP }//end if-else?>    
             </div>
           <div align="left"></div>
       </label></td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td><label>
           <div align="left">
            <?PHP
		     if($cooperativa=='1'){
		     ?>
             <input type="checkbox" name="checkbox4" id="checkbox4" checked="checked" />
             Cooperativa
            <?PHP }else{ ?>
            <input type="checkbox" name="checkbox4" id="checkbox4" />
             Cooperativa
             <?PHP }//end if-else?>
           </div>
           <div align="left"></div>
       </label></td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td><label>
           <div align="left">
             <?PHP
		     if($estatal=='1'){
		     ?>
             <input type="checkbox" name="checkbox5" id="checkbox5" checked="checked" />
             Empresa Estatal           
             <?PHP }else{ ?>
             <input type="checkbox" name="checkbox5" id="checkbox5" />
             Empresa Estatal 
             <?PHP }//end if-else?>
             </div>
           <div align="left"></div>
       </label></td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td><label>
         <div align="left">
            <?PHP
		     if($importador=='1'){
		    ?>
           <input type="checkbox" name="checkbox6" id="checkbox6" />
           Importador  
          <?PHP }else{ ?>
          <input type="checkbox" name="checkbox6" id="checkbox6" />
           Importador
           <?PHP }//end if-else?>
          </div>
         <div align="left"></div>
       </label></td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td><label>
         <div align="left">
         <?PHP
		   if($servicios=='1'){
		 ?>
          <input type="checkbox" name="checkbox7" id="checkbox7" checked="checked" />
          Servicios para Empresas (Transporte, Administrativos, Limpieza, Publicidad ....)
          <?PHP }else{ ?>
          <input type="checkbox" name="checkbox7" id="checkbox7" />
          Servicios para Empresas (Transporte, Administrativos, Limpieza, Publicidad ....)
		  <?PHP }//end if-else?>
         </div>
         <div align="left"></div>
       </label></td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td><div align="left">
       <?PHP
		   if($otros=='1'){
		 ?>
         <input type="checkbox" name="checkbox8" id="checkbox8" />
         Otros
         <?PHP }else{ ?>
         <input type="checkbox" name="checkbox8" id="checkbox8" />
         Otros
         <?PHP }//end if-else?>
         </div></td>
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
       <td><div align="right"><strong><span class="asteriscos">*</span>Producto/Servicio:</strong></div></td>
       <td><div align="left">Vendemos</div></td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td><div align="left">
         <input type="text" name="txtVendUno" id="txtVendUno" />
         <input type="text" name="txtVendDos" id="txtVendDos" />
         <input type="text" name="txtVendTres" id="txtVendTres" />
</div></td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td><label>
         <div align="left">Compramos         </div>
         <div align="left"></div>
       </label></td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td><div align="left">
         <input type="text" name="txtCompUno" id="txtCompUno" />
         <input type="text" name="txtCompDos" id="txtCompDos" />
         <input type="text" name="txtCompTres" id="txtCompTres" />
       </div></td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td><div align="right"></div></td>
       <td><label>
         <div align="left"></div>
       </label></td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td><div align="right"><strong><span class="asteriscos">*</span>Años en el Mercado:</strong></div></td>
       <td><label>
         <div align="left">
           <select name="comboAnos" id="comboAnos" >
             <option value="0">Seleccionar</option>
             <option value="1">Recien Constituida</option>
             <option value="2">Mas de 6 meses</option>
             <option value="3">Mas de 1 año</option>
             <option value="4">Mas de 3 años</option>
             <option value="5">Mas de 5 años</option>
             <option value="6">Mas de 10 años</option>
           </select>
         </div>
         <div align="left"></div>
       </label></td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td><div align="right"><strong><span class="asteriscos">*</span>Numero de Empleados:</strong></div></td>
       <td><div align="left">
         <select name="comboEmpleados" id="comboEmpleados">
           <option value="0">Seleccionar</option>
           <option value="1">De 1 a 10</option>
           <option value="2">De 10 a 50</option>
           <option value="3">De 100 a 500</option>
           <option value="4">Mas de 500</option>
         </select>
       </div></td>
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
       <td><div align="right"></div></td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td><div align="right"><strong>Posee Transporte:</strong></div></td>
       <td><label>
         <div align="left">
           <input type="checkbox" name="isTransporte" id="isTransporte" />
           </label>
         </div></td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td><div align="right"><strong><span class="asteriscos">*</span>Envios a nivel:</strong></div></td>
       <td><label>
         <div align="left">
           <select name="comboEnvios" id="comboEnvios">
             <option value="0">Seleccionar</option>
             <option value="1">Local</option>
             <option value="2">Nacional</option>
             <option value="3">Internacional</option>
           </select>
         </div>
         <div align="left"></div>
       </label></td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td><div align="right"><strong>Principales Mercados:</strong></div></td>
       <td><label>
         
           <div align="left">
             <input type="checkbox" name="expAmericaNorte" id="expAmericaNorte" />
             America del Norte           </div>
           <div align="left"></div>
       </label></td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td><div align="left">
         <input type="checkbox" name="expAmericaSur" id="expAmericaSur" />
America del Sur </div></td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td><div align="left">
         <input type="checkbox" name="expEuropa" id="expEuropa" />
Europa</div></td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td><label>
         <div align="left">
           <input type="checkbox" name="expAsia" id="expAsia" />
           Asia         </div>
         <div align="left"></div>
       </label></td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td><label>
         <div align="left">
           <input type="checkbox" name="expAfrica" id="expAfrica" />
           Africa         </div>
         <div align="left"></div>
       </label></td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td><div align="left">
         <input type="checkbox" name="expOceania" id="expOceania" />
         Oceania</div></td>
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
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td><div align="right"><strong>Logo de la Empresa:</strong></div></td>
       <td>
         <div align="left">
           <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
           <input type="file" name="userfile" id="userfile" />
         </div>
         <label></label><div align="left"></div></td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td><div align="left"><img src="img/logoDefault.jpg" width="102" height="95" /></div></td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td><div align="left"><span class="letraPequeña">200 Kb max. Formato JPEG o GIF.</span></div></td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td><div align="right"><strong><span class="asteriscos">*</span>Introduccion detallada:</strong></div></td>
       <td><label>
         <div align="left"></div>
       </label></td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td><textarea name="txtDescripcion" id="txtDescripcion" cols="45" rows="5"></textarea></td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td></td>
       <td><label>
         <div align="left"></div>
       </label></td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td><div align="right"><strong>Sitio Web:</strong></div></td>
       <td><input name="txtSitioWeb" type="text" id="txtSitioWeb" size="50" value="http://" /></td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td><label>
         <div align="left"></div>
       </label></td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td><div align="left">
         <input type="submit" name="send" id="send" value="Guardar" />
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
</body>
</html>
<?PHP
}//END IF-ELSE
?>