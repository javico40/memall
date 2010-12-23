<?PHP
include("include/core/main.php");
include("include/connection.php");
include("include/config.php");

//login
if ($_POST["send"]){
//get the variables
$nombre =  mysql_real_escape_string($_POST["username"]);
$contrasena = mysql_real_escape_string($_POST["password"]);

if($nombre==NULL|$contrasena==NULL){
$status = "<strong>Debe llenar todos los campos requeridos.</strong>";
}else{
//create client
$cliente = new Cliente;
//verifico si el usuario ya esta registrado por email
 $validate = $cliente->validate($nombre, $contrasena);
//verifico si el usuario esta registrado por nombre de usuario
 $validateUsr = $cliente->validateUsuario($nombre, $contrasena);
 //Verificar y entrar
 if($validate > 0){
       //recupero el nombre de usuario usando el email
       //$name = $cliente->getName($nombre);
		session_start(); // empezamos la session
        //$_SESSION["name"]=$nombre; // damos nombre a la sesion
        $_SESSION["validate"]=$nombre;
		header("location: home.php");
 }else if($validateUsr > 0){
        // obtengo el email de usuario
		$email = $cliente->getEmailName($nombre);
        //inicio la session
		session_start(); // empezamos la session
        $_SESSION["validate"]=$email;
		header("location: home.php");
 }else{
        $status = "<strong>El nombre de usuario o email no existe.</strong>"; 
 }//end if-else
}//end validate blank spaces
}//end login

if(!isset($_SESSION['validate'])){
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
	font-size: 24px;
	color: #006699;
}

-->
</style>
</head>
<body>
<div id="pagina" align="center" class="paginaEntrar">

<div id="header" class="header">
<?PHP
include("header.php");
?>
</div>

<div id="tablaLogin" class="tablaEntrar">
<form id="formulario" method="post" action="entrar.php">
  <table width="302" height="264" border="0">
    <tr>
      <td width="128" height="21">&nbsp;</td>
    </tr>
    <tr>
      <td><div align="left"><span class="style4">Bienvenido</span></div></td>
    </tr>
    <tr>
      <td height="21">&nbsp;</td>
    </tr>
    <tr>
      <td height="21" class="letrasFiltrado"><div align="left">Email o nombre de usuario:</div></td>
    </tr>
    <tr>
      <td class="letrasFiltrado"><label>
        <div align="left">
          <input class="tb10" name="username"  class="required" type="text" id="username" size="40"  onfocus="this.style.backgroundColor='#fcf1df'" onblur="this.style.backgroundColor='#ffffff'" />
          </div>
      </label></td>
    </tr>
    <tr>
      <td class="letrasFiltrado"><div align="left">Contraseña:</div></td>
    </tr>
    <tr>
      <td height="21"><label>
        <div align="left">
          <input class="tb10" name="password"  class="required" type="password" id="password" size="40"  onfocus="this.style.backgroundColor='#fcf1df'" onblur="this.style.backgroundColor='#ffffff'" />
        </div>
      </label></td>
    </tr>
    <tr>
      <td><div align="left"><span class="style3"><a href="recuperar.php">¿Olvido su contraseña?</a></span></div></td>
    </tr>
    <tr>
      <td><div align="center">
        <label></label>
        <div align="center"><?PHP echo $status; ?></div>
      </div></td>
    </tr>
    <tr>
      <td><div align="center">
        <input  class="fb8" type="submit" name="send" id="send" value="Entrar" />
      </div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </table>
  </form>
</div>

</div>
</body>
</html>
<?PHP
}else{
  header("location: home.php");
}//End session
?>
