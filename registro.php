<?PHP
include("include/core/main.php");
include("include/connection.php");
include("include/config.php");

//variable de mensaje
$status = "";
 //create client
$cliente = new Cliente;
//memall
$memall = new Memall();

//register
if ($_POST["send"]){

//get the variables
$provincia =  mysql_real_escape_string($_POST["countrySelect"]);
$nombreApellidos = mysql_real_escape_string($_POST["txtNombres"]);
$empresa = mysql_real_escape_string($_POST["txtEmpresa"]);
$industria = mysql_real_escape_string($_POST["selectIndustria"]);
$telPais = mysql_real_escape_string($_POST["txtCodigoPais"]);
$telRegion = mysql_real_escape_string($_POST["txtCodigoRegion"]);
$telCiudad = mysql_real_escape_string($_POST["txtCodigoCiudad"]);
$email = mysql_real_escape_string($_POST["txtEmail"]);
$usuario = mysql_real_escape_string($_POST["txtUsuario"]);
$contrasena = mysql_real_escape_string($_POST["txtContrasena"]);
$recontrasena = mysql_real_escape_string($_POST["txtReContrasena"]);

$tipo = "4";
$codigo = "";

if($provincia==NULL|$nombreApellidos==NULL|$empresa==NULL|$industria==NULL|$telPais==NULL|$telRegion==NULL|$telCiudad==NULL|$email==NULL|$usuario==NULL|$contrasena==NULL|$recontrasena==NULL){
$status = "<strong>Debe llenar todos los campos requeridos.</strong>";
}else{
//validar si las contraseñas son iguales
if($contrasena!=$recontrasena){
$status = "<strong>Las contraseñas no coinciden.</strong>";
}else{
//varifico si el usuario ya esta registrado
 $validate = $cliente->validate($email, $contrasena);
 //si usuario esta registrado
 if($validate > 0){
 $status = "<strong>La direccion de  email ya esta registrada</strong>";
 }else{
      //Verifico si selecciono una region
	 if($provincia == "0"){
	 $status = "<strong>Debe seleccionar una ubicacion.</strong>";
	 }else if($industria == "0"){
	 $status = "<strong>Debe seleccionar una industria.</strong>";
	 }else{ 
     //guardo en una variable el codigo de activacion
	 $code = $cliente->genera_random(10);
	 //fecha actual del registro
	 $fecha = date("Y-m-d");  
	 //telefono del pais
	 $telefono = $telPais."-".$telRegion."-".$telCiudad;
	 // guardo en una variable el resultado de la creacion de un nuevo usuario
	  $cliente->register($provincia, $nombreApellidos, $empresa, $industria, $telefono, $email, $usuario, $contrasena, $tipo, $fecha, $codigo);
	  //obtiene el id del usuario registrado
	 $idUser = $cliente->getId($email);
	  //inserto a memall como primer contacto
	  //$memall->contactoMemall($idUser);
	  //inserto el mensaje de bienvenida de memall
	  //$memall->contactoMemallBienvenida($empresa);
	 //envio el email de registro al cliente
	 
	 //redirecciono a la pagina de registro
	 //$time=0;
     //$url= "final.php";
     //echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"$time;URL=$url\">";  
	 header("location: final.php");
	 }//End verifico una region
	 
 }//end validate usuario
}//end validar contraseñas coinciden 
}//end validate campos vacios
}//end metodos

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/index.css" rel="stylesheet" type="text/css" />
<link href="css/visual.css" rel="stylesheet" type="text/css" />
<script src="scripts/jquery-1.4.2.min.js" type="text/javascript"></script> 
<script src="scripts/jquery.validate.js" type="text/javascript"></script>
<title>.:Bienvenidos a memall:. es tu mall, es memall.</title>
<style type="text/css">
<!--
.style4 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #999999;
}
.style5 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
}
-->
</style>

<script type="text/javascript"><!--  
$().ready(function() {  
$("#formulario").validate();  
});  
// --></script> 
</head>
<body>
<div id="pagina" align="center" class="pagina">

<div id="header" class="header">
    <?PHP
      include("header.php");
    ?>
</div>
<div id="tablaOfertas" class="tablaRegistro">
  <p>
  <div align="center"><span class="style4">Selecciona la ubicacion de tu Empresa y el tipo de Cuenta</span> </div>
  </p>
  <p></p>
  <form id="formulario" method="post" action="registro.php">
  <table width="543" border="0">
    <tr>
      <td width="218"><div align="left"><span class="style5">Ubicacion de la Empresa:</span></div></td>
      <td width="315"><label>
        <div align="left">
          <select name="countrySelect" id="countrySelect">
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
    </tr>
    <tr>
      <td><div align="left"><span class="style5">Tipo de cuenta:</span></div></td>
      <td><label class="style5">
        <div align="left">
          <input type="radio" name="radio" id="radio" checked="checked"/>
          Proveedor
          <input type="radio" name="radio" id="radio"  />
          Comprador
          <input type="radio" name="radio" id="radio" />
          Ambos</div>
      </label></td>
    </tr>
  </table>
  <p>
  <div align="center"><span class="style4">Informacion de Contacto</span> </div>
  </p>
  <p></p>
  <table width="543" border="0">
    <tr>
      <td width="187" class="style5"><div align="left">Nombres y Apellidos:</div></td>
      <td width="346"><label>
        <div align="left">
          <input class="tb10" name="txtNombres" type="text" class="required" id="txtNombres" size="30" />
        </div>
      </label></td>
    </tr>
    <tr>
      <td class="style5"><div align="left">Nombre de la Empresa:</div></td>
      <td><label>
        <div align="left">
          <input class="tb10" name="txtEmpresa" type="text" class="required" id="txtEmpresa" size="50" />
        </div>
      </label></td>
    </tr>
    <tr>
      <td class="style5"><div align="left">Industria:</div></td>
      <td><label>
        <label>
        <div align="left">
          <select name="selectIndustria" id="selectIndustria">
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
        </label>
        <div align="left"></div>
      </label></td>
    </tr>
    <tr>
      <td class="style5"><div align="left">Telefono:</div></td>
      <td><div align="left">
        <input name="txtCodigoPais" type="text"  class="required"  id="txtCodigoPais" value="+58" size="2" />
        -
        <input name="txtCodigoRegion" type="text"  class="required"  id="txtCodigoRegion" size="2" />
        -
  <input name="txtCodigoCiudad" type="text"  class="required"  id="txtCodigoCiudad" size="10" />
      </div></td>
    </tr>
  </table>
  <p>
  <div align="center"><span class="style4">Datos de la Cuenta</span></div>
  </p>
  <p></p>
  
  <table width="540" border="0">
    <tr>
      <td width="187" class="style5"><div align="left">Email:</div></td>
      <td width="343"><label>
        <div align="left">
          <input class="tb10" type="text" name="txtEmail"  class="email"  id="txtEmail" />
        </div>
      </label></td>
    </tr>
    <tr>
      <td class="style5"><div align="left">Usuario:</div></td>
      <td><label>
        <div align="left">
          <input class="tb10" type="text" name="txtUsuario"  class="required"  id="txtUsuario" />
        </div>
      </label></td>
    </tr>
    <tr>
      <td class="style5"><div align="left">Contraseña:</div></td>
      <td><label>
        <div align="left">
          <input class="tb10" type="password" name="txtContrasena"  class="required"  id="txtContrasena" />
          </div>
      </label></td>
    </tr>
    <tr>
      <td class="style5"><div align="left">Repetir-Contraseña:</div></td>
      <td><label>
        <div align="left">
          <input class="tb10" type="password" name="txtReContrasena"  class="required"  id="txtReContrasena" />
          </div>
      </label></td>
    </tr>
    <tr>
      <td class="style5">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td class="style5"><div align="left">Ingrese el Codigo</div></td>
      <td><label>
        <div align="left">
          <input class="tb10" type="text" name="txtCodigo"  class="required"  id="txtCodigo" />
        </div>
      </label></td>
    </tr>
    <tr>
      <td class="style5">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td class="style5">&nbsp;</td>
      <td><div align="left">
        <input  class="fb8" type="submit" name="send" id="send" value="Enviar" />
      </div></td>
    </tr>
  </table>
 </form> 
</div>
</div>
</body>
</html>
