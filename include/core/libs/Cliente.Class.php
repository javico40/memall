<?PHP
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require('DataBase.Class.php');
require('Actor.Class.php');

class Cliente{

/*
METODOS PARA EL CLIENTE
*/

	 /*
	 *Este metodo ha sido diseñado para registrar un nuevo cliente
	 *Autor: Javier portilla
	 * Revisado: Junio - 2010
	 */ 
	 function register($provincia, $nombreApellidos, $empresa, $industria, $telefono, $email, $usuario, $contrasena, $tipo, $fecha, $codigo){
	 // creo un nuevo objeto de base de datos
        $sql = new DataBase;
     // limpio el query
        $query="";
	 // Estructuro un nuevo query para agregar el cliente a la base de datos
 $query = "INSERT INTO usuarios (idusuarios, login, password, email, nombreApellido, provincia, telefono, estado, nombreEmpresa, industria_idindustria, Roles_idRoles, fechaRegistro, activacion)VALUES( NULL, '$usuario', '$contrasena', '$email', '$nombreApellidos', '$provincia', '$telefono', '0', '$empresa', '$industria', '$tipo', '$fecha', '$codigo');";
     // ejecuto la consulta
	 $sql->check_noreturn($query);
	 }//end method
	 
	 /*
	 * Este metodo sirve para actualizar los datos de la cuenta del cliente
	 */
	 function update($nombre, $apellido, $direccion, $telefono, $ciudad, $user, $usuario, $codigo, $rif){
	 // creo un nuevo objeto de base de datos
        $sql = new DataBase;
     // limpio el query
        $query="";
	 // Estructuro un nuevo query para agregar el cliente a la base de datos
        $query = "UPDATE usuarios SET nombreUsuario = '$nombre', apellidoUsuarios = '$apellido', direccionUsuarios = '$direccion', telefonoUsuarios = '$telefono', ciudadUsuarios = '$ciudad', nombreEmpresa = '$codigo', rifEmpresa = '$rif' WHERE loginIDusuarios = '$usuario';";
		//echo $query;
     // ejecuto la consulta
	 $sql->check_noreturn($query);
	 }//end method
	 
	 /*Este metodo actualiza los datos de la cuenta del usuario*/
	 
	 function updateCuenta($usuario, $nombreApellido, $genero, $emailAlternativo, $telefono, $cargo){
	 // creo un nuevo objeto de base de datos
        $sql = new DataBase;
     // limpio el query
        $query="";
	 // Estructuro un nuevo query para agregar el cliente a la base de datos
        $query = "UPDATE usuarios SET nombreApellido = '$nombreApellido', sexo = '$genero', emailAlternativo = '$emailAlternativo', telefono  = '$telefono', cargo = '$cargo' WHERE email = '$usuario';";
		//echo $query;
     // ejecuto la consulta
	 $sql->check_noreturn($query);
	 }//end method
	 
	 
	  /*Este metodo actualiza los datos de la empresa*/
	 
	 function updateEmpresa($usuario, $empresa, $codigoRif, $calleEmpresa, $ciudadEmpresa, $estadoEmpresa, $calleContacto, $ciudadContacto, $estadoContacto, $isFabricante, $isMayorista, $isMinorista, $isCooperativa, $isEstatal, $isImportador, $isServicios, $isOtros, $vendemos, $compramos, $anos, $empleados, $isTransporte, $nivelEnvios, $expAmericaNorte, $expAmericaSur, $expEuropa, $expAsia, $expAfrica, $expOceania, $descripcion, $sitioWeb, $rutaimagen){
	 // creo un nuevo objeto de base de datos
        $sql = new DataBase;
     // limpio el query
        $query="";
	 // Estructuro un nuevo query para agregar el cliente a la base de datos
        $query = "UPDATE usuarios SET  nombreEmpresa = '$empresa', codigoRif = '$codigoRif', direccionUno = '$calleEmpresa', ciudad = '$ciudadEmpresa', provincia = '$estadoEmpresa', direccionDos = '$calleContacto', ciudadDos = '$ciudadContacto', provinciaDos = '$estadoContacto', isFabricante = '$isFabricante', isDistribuidorMayorista = '$isMayorista', isDistribuidorMinorista = '$isMinorista', isCooperativa = '$isCooperativa', isEmpresaEstatal = '$isEstatal', isImportador = '$isImportador', isServicios = '$isServicios', isOtros = '$isOtros', vendemos = '$vendemos', compramos = '$compramos', anosMercado = '$anos',  numeroEmpleados = '$empleados', isTransporte  = '$isTransporte', distanciaEnvio = '$nivelEnvios', expAmericaNorte = '$expAmericaNorte',  expAmericaSur = '$expAmericaSur', expEuropa = '$expEuropa', expAsia = '$expAsia', expAfrica = '$expAfrica', expOceania = '$expOceania', direccionLogo = '$rutaimagen', descripcionDetallada = '$descripcion', sitioWeb = '$sitioWeb'  WHERE email = '$usuario';";
		//echo $query;
     // ejecuto la consulta
	 $sql->check_noreturn($query);
	 }//end method
	 
	 
	 /*
	 Este metodo obtiene la informacion de el usuario basado en su email
	 */
	 function getClientInformation($email){
      $sql = new DataBase;
      $query= "SELECT usuarios.nombreEmpresa, usuarios.codigoRif, usuarios.descripcionDetallada, usuarios.isFabricante, usuarios.isDistribuidorMayorista, usuarios.isDistribuidorMinorista, usuarios.isCooperativa, usuarios.isEmpresaEstatal, usuarios.isImportador, usuarios.isServicios, usuarios.isOtros, usuarios.vendemos, usuarios.compramos, usuarios.direccionLogo, usuarios.login, usuarios.email, usuarios.emailAlternativo, usuarios.nombreApellido, usuarios.sexo, usuarios.telefono, usuarios.cargo, usuarios.direccionUno, usuarios.direccionDos, usuarios.ciudad, regiones.descripcionRegion, usuarios.ciudadDos FROM usuarios, regiones WHERE email  = '$email' AND usuarios.provincia = regiones.idregiones LIMIT 1;";
      $result = $sql->check($query);
      return $result;
	}//end method
	 /*
	 FIN DE LOS METODOS PARA EL CLIENTE
	 */
	 
	 /*
	 METODO PARA LOS PRODUCTOS
	 */
	 
	 /*
	 *Este metodo ha sido diseñado para registrar un nuevo producto
	 *Autor: Javier portilla
	 * Revisado: Junio - 2010
	 */
	 
	 function registrarProducto($producto, $usuario, $industria, $categoria, $marca, $modelo, $estado, $descripcionCorta, $descripcionDetallada, $Grupo,$cantidadMinima, $unidadCantidadMinima, $precioAlPorMayor, $divisaPrecioAlPorMayor, $precioProducto, $divisaPrecioProducto, $precioOtraDivisa,  $divisaPrecioOtraDivisa, $capacidadProduccion, $unidadCapacidadProduccion, $tiempoCapacidadProduccion, $tiempoEntrega, $detallesEmpaque, $rutaimagen, $metodoPagoDeposito, $metodoPagoCheque, $metodoPagoIntercambio, $metodoPagoWestern, $metodoPagoMoney, $metodoPagoOtros){

$canMin =  $cantidadMinima." ".$unidadCantidadMinima;
$porMayor = $precioAlPorMayor." ".$divisaPrecioAlPorMayor;
$porProducto =  $precioProducto." ".$divisaPrecioProducto;
$porOtra =  $precioOtraDivisa." ".$divisaPrecioOtraDivisa;

$capProd = $capacidadProduccion." ".$unidadCapacidadProduccion." ".$tiempoCapacidadProduccion;

// creo un nuevo objeto de base de datos
$sql = new DataBase;
// limpio el query
$query="";
		// Estructuro un nuevo query para agregar el cliente a la base de datos
 $query = "INSERT INTO productos (idproductos, usuarios_idusuarios, nombreProducto, industria_idindustria, categorias_idcategorias, marcaProducto, modeloProducto, estado, rutaImagen, descripcionCorta, descripcionDetallada, cantidadMinimaOrdenar, precioPorMayor, precioPorProducto, precioOtraDivisa, aceptaDeposito, aceptaCheques, aceptaIntercambio, aceptaWesterUnion, aceptaMoneyGram, aceptaOtros, capacidadProduccion, tiempoEntrega, detallesEmpacado)VALUES(NULL, $usuario, '$producto', '$industria', '$categoria', '$marca', '$modelo', '$estado', '$rutaimagen', '$descripcionCorta', '$descripcionDetallada', '$canMin', '$porMayor', '$porProducto', '$porOtra', '$metodoPagoDeposito', '$metodoPagoCheque', '$metodoPagoIntercambio', '$metodoPagoWestern', '$metodoPagoMoney', '$metodoPagoOtros', '$capProd', '$tiempoEntrega', '$detallesEmpaque');";
      // ejecuto la consulta
      $sql->check_noreturn($query);
 }//end method
	
 /*
	 *Este metodo ha sido diseñado para registrar una nueva Compra
	 *Autor: Javier portilla
	 * Revisado: Noviembre - 2010
	 */
	 
	 function registrarCompra($usuario, $descripcionCorta, $industria, $categoria, $palabrasClave, $estado, $rutaImagen, $descripcionDetallada, $divisaRango, $deRango, $hastaRango, $cantidadRequerida, $unidadRequerida, $certificacion){

$cantidad =  $cantidadRequerida." ".$unidadRequerida;
 //fecha actual del registro
$fecha = date("Y-m-d");
// creo un nuevo objeto de base de datos
$sql = new DataBase;
// limpio el query
$query="";
		// Estructuro un nuevo query para agregar el cliente a la base de datos
 $query = "INSERT INTO compra (idcompra, usuarios_idusuarios, descripcionCorta, industria_idindustria, categorias_idcategorias, palabrasClave, estado, rutaImagen, descripcionLarga, monedaRangoPrecios, desdeRangoPrecios, hastaRangoPrecios, cantidadRequerida, certificacionRequerida, privacidad_idprivacidad, fechaDeInicio)VALUES(NULL, $usuario, '$descripcionCorta', '$industria', '$categoria', '$palabrasClave', '$estado', '$rutaImagen', '$descripcionDetallada', '$divisaRango', '$deRango', '$hastaRango', '$cantidad', '$certificacion', '1', '$fecha');";
      // ejecuto la consulta
      $sql->check_noreturn($query);
 }//end method
	 
	 /*
	 * Este metodo sirve para actualizar el estado de un Producto
	 */
	 function updateProduct($idUsuario, $idProducto, $estado, $email, $codigoProducto){
	 // creo un nuevo objeto de base de datos
        $sql = new DataBase;
     // limpio el query
        $query="";
	 // Estructuro un nuevo query para agregar el cliente a la base de datos
        $query = "UPDATE producto_has_usuarios SET estadosEnvio_idestadosEnvio = '$estado', linkDescarga = 'products/download/productor/$email/$codigoProducto/' WHERE producto_idpproducto = '$idProducto' AND usuarios_idusuarios = '$idUsuario'";
		//echo $query;
     // ejecuto la consulta
	 $sql->check_noreturn($query);
	 }//end method
	 
	 
	  /*
  * Metodo para eliminar los productos del cliente
  */
	 function deleteProductosCliente($idUsuario, $prodList){
	    // creo un nuevo objeto de base de datos
        $sql = new DataBase;
        // limpio el query
        $query="";
	    // Estructuro un nuevo query para agregar el cliente a la base de datos
        $query = "DELETE FROM productos WHERE usuarios_idusuarios = '$idUsuario' AND idproductos IN (".implode(',',$prodList).");";
		//echo $query;
        // ejecuto la consulta
	    $sql->check_noreturn($query);
	 }//end method
	 
	  /*
	 FIN DE LOS METODOS PARA LOS PRODUCTOS
	 */
	 
	 
	 /*
	 *Este metodo ha sido diseñado para registrar un Pago en el sistema
	 *Autor: Javier portilla
	 * Revisado: Junio - 2010
	 */
	 
	 function registerPayment($code, $fecha, $monto, $tipo, $idUser, $idProducto, $idLicencia){
	   // creo un nuevo objeto de base de datos
        $sql = new DataBase;
     // limpio el query
        $query="";
		// Estructuro un nuevo query para agregar el cliente a la base de datos
 $query = "INSERT INTO pago (idpago, codigoPago, fechaPago, montoPago, tipoDePago, usuarios_idusuarios, producto_idpproducto, licencia_idlicencia, estadoPago)VALUES(NULL, '$code', '$fecha', '$monto', '$tipo', '$idUser', '$idProducto', '0', '0');";
      // ejecuto la consulta
      $sql->check_noreturn($query);
     }//end method
	 
	 /*
	 * Este metodo es usado para registrar las facturas provenientes de los pagos de los usuarios 
	 */
	  function registerInvoice($idUsuario, $idProducto, $descripcionBanco, $numeroDeposito, $fecha){
	   // creo un nuevo objeto de base de datos
        $sql = new DataBase;
     // limpio el query
        $query="";
		// Estructuro un nuevo query para agregar el cliente a la base de datos
 $query = "INSERT INTO facturas (id, idUsuario, idProducto, descripcionBanco, numeroDeposito, fecha, estado)VALUES(NULL, '$idUsuario', '$idProducto', '$descripcionBanco', '$numeroDeposito', '$fecha', '0');";
      // ejecuto la consulta
      $sql->check_noreturn($query);
     }//end method
	 
	 /*
	 * Este metodo sirve para actualizar el estado de un pago
	 */
	 function updatePago($idPago, $idUsuario, $idProducto, $estado){
	 // creo un nuevo objeto de base de datos
        $sql = new DataBase;
     // limpio el query
        $query="";
	 // Estructuro un nuevo query para agregar el cliente a la base de datos
        $query = "UPDATE pago SET estadoPago = '$estado' WHERE idpago = '$idPago' AND usuarios_idusuarios = '$idUsuario' AND producto_idpproducto = '$idProducto';";
		//echo $query;
     // ejecuto la consulta
	 $sql->check_noreturn($query);
	 }//end method
	 
	 /*
	 * Este metodo sirve para actualizar el estado de una factura
	 */
	 function updateFactura($idUsuario, $idProducto, $estado){
	 // creo un nuevo objeto de base de datos
        $sql = new DataBase;
     // limpio el query
        $query="";
	 // Estructuro un nuevo query para agregar el cliente a la base de datos
        $query = "UPDATE facturas SET estado  = '$estado' WHERE idpago = '$idPago' AND usuarios_idusuarios = '$idUsuario' AND producto_idpproducto = '$idProducto';";
		//echo $query;
     // ejecuto la consulta
	 $sql->check_noreturn($query);
	 }//end method
	 
	 
	 /*
	 *Este metodo retorna informacion sobre una factura asociada a un determinado producto, metodo usado por el administrador
	 */
	 
   function getInfofactura($idProducto, $idCliente){
   $sql = new DataBase;
   $query= "SELECT numeroDeposito, descripcionBanco FROM facturas WHERE idUsuario = '$idProducto' AND $idCliente = '$idCliente' LIMIT 1;";
   $result = $sql->check($query);
   return $result;
   }//end method
	 
/*
 * Este metodo valida si el cliente existe
 * retorna un numero que determina si existe el usuario
 */
function validate($user, $pass){
     // creo un nuevo objeto de base de datos
      $sql = new DataBase;
    // estructuro la consulta
      $query = "SELECT idusuarios  FROM usuarios WHERE email = '$user' AND password = '$pass' LIMIT 1;";
     // guardo en la variable el retorno de la funcion
	 $validate = $sql->validate($query);
     return $validate;
}//end method

/*
 * Este metodo valida si el cliente existe
 * retorna un numero que determina si existe el usuario
 */
function validateUsuario($user, $pass){
     // creo un nuevo objeto de base de datos
      $sql = new DataBase;
    // estructuro la consulta
      $query = "SELECT idusuarios  FROM usuarios WHERE login = '$user' AND password = '$pass' LIMIT 1;";
     // guardo en la variable el retorno de la funcion
	 $validate = $sql->validate($query);
     return $validate;
}//end method



/*
 * Este metodo valida si el administrados existe
 * retorna un numero que determina si existe el usuario
 */
function validateAdmin($user, $pass){
     // creo un nuevo objeto de base de datos
      $sql = new DataBase;
    // estructuro la consulta
      $query = "SELECT idAdmin FROM admin WHERE loginId = '$user' AND passwordAdmin = '$pass' LIMIT 1;";
     // guardo en la variable el retorno de la funcion
	 $validate = $sql->validate($query);
     return $validate;
}//end method

function getNivel($email){
    $sql = new DataBase;
    $query= "SELECT nivel FROM cliente WHERE email_cli = '$email';";
    $result = $sql->check($query);
    while($row = mysql_fetch_array($result)) {
     $nivel = $row["nivel"];
    }//end while
   return $nivel;   
 }//end method
 

function getName($email){
    $sql = new DataBase;
    $query= "SELECT nombreUsuario FROM usuarios WHERE loginIDusuarios = '$email';";
    $result = $sql->check($query);
    while($row = mysql_fetch_array($result)) {
     $nombre = $row["nombreUsuario"];
    }//end while
   return $nombre;
 }//end method
 

function getId($email){
    $sql = new DataBase;
    $query= "SELECT idusuarios FROM usuarios WHERE email  = '$email';";
    $result = $sql->check($query);
    while($row = mysql_fetch_array($result)) {
     $idCli = $row["idusuarios"];
    }//end while
   return $idCli;
  }//end method
  
  
  
  function getEmail($idUser){
    $sql = new DataBase;
    $query= "SELECT loginIDusuarios FROM usuarios WHERE idusuarios = '$idUser';";
    $result = $sql->check($query);
    while($row = mysql_fetch_array($result)) {
     $idCli = $row["loginIDusuarios"];
    }//end while
   return $idCli;
  }//end method

/*Recupera el email utilizando el nombre de usuario*/

 function getEmailName($userName){
    $sql = new DataBase;
    $query= "SELECT email FROM usuarios WHERE login  = '$userName';";
    $result = $sql->check($query);
    while($row = mysql_fetch_array($result)) {
     $userEmail = $row["email"];
    }//end while
   return $userEmail;
  }//end method


     // funcion que se encargara de generar un numero aleatorio
function genera_random($longitud){
    $exp_reg="[^A-Z0-9]";
    return substr(eregi_replace($exp_reg, "", md5(rand())) .
       eregi_replace($exp_reg, "", md5(rand())) .
       eregi_replace($exp_reg, "", md5(rand())), 0, $longitud);
}//end method

function validateProductosCliente($idUser){
$sql = new DataBase;
$query= "SELECT producto_idpproducto FROM producto_has_usuarios WHERE usuarios_idusuarios = '$idUser' LIMIT 1;";
// guardo en la variable el retorno de la funcion
$validate = $sql->validate($query);
//retorno la variables
return $validate;
}//end method

/*
* Devuelve si hay productos de los clientes, metodo usado por el administrador
*/

function validateProductosClientes($idUser){
$sql = new DataBase;
$query= "SELECT producto_idpproducto FROM producto_has_usuarios LIMIT 1;";
// guardo en la variable el retorno de la funcion
$validate = $sql->validate($query);
//retorno la variables
return $validate;
}//end method

/*
* Devuelve todos los productos que han sido solicitados por los clientes, incluyendo su estado, metodo usado por el administrador
*/

function getProductosClientes($idUser){
$sql = new DataBase;
$query= "SELECT producto.idpproducto, producto.nombreProducto, estadosenvio.descripcionEstado, producto_has_usuarios.metodoPago,  producto_has_usuarios.metodoEnvio, producto_has_usuarios.fecha, producto_has_usuarios.usuarios_idusuarios FROM producto_has_usuarios, producto, estadosenvio WHERE producto_has_usuarios.producto_idpproducto = producto.idpproducto AND producto_has_usuarios.estadosEnvio_idestadosEnvio = estadosenvio.idestadosEnvio ORDER BY producto.idpproducto DESC;";
$result = $sql->check($query);
return $result;
}//end method


function getProductosCliente($idUser){
$sql = new DataBase;
$query= "SELECT producto.idpproducto, producto.nombreProducto, estadosenvio.descripcionEstado, producto_has_usuarios.metodoPago,  producto_has_usuarios.metodoEnvio, producto_has_usuarios.fecha FROM producto_has_usuarios, producto, estadosenvio WHERE producto_has_usuarios.producto_idpproducto = producto.idpproducto AND producto_has_usuarios.estadosEnvio_idestadosEnvio = estadosenvio.idestadosEnvio AND producto_has_usuarios.usuarios_idusuarios = '$idUser' ORDER BY producto.idpproducto DESC;";
$result = $sql->check($query);
return $result;
}//end method

function getInfoProductos($idProducto){
$sql = new DataBase;
$query= "SELECT nombreProducto, versionProducto, fechaLanzamientoProducto, costoProducto FROM producto WHERE idpproducto = '$idProducto' LIMIT 1;";
$result = $sql->check($query);
return $result;
}//end method

function validateClienteProduct($idProducto, $idCliente){
$sql = new DataBase;
$query= "SELECT estadosEnvio_idestadosEnvio, numeroDescargas, linkDescarga FROM producto_has_usuarios WHERE producto_idpproducto = '$idProducto' AND usuarios_idusuarios = '$idCliente' LIMIT 1;";
$result = $sql->check($query);
return $result;
}//end method

/*
* Metodo para obtener los datos del cliente
*/

function getInfoCliente($idCliente){
$sql = new DataBase;
$query= "SELECT loginIDusuarios, passwordIDusuarios, nombreUsuario, apellidoUsuarios, direccionUsuarios, paisUsuarios, ciudadUsuarios, telefonoUsuarios, nombreEmpresa, rifEmpresa FROM usuarios WHERE idusuarios = '$idCliente' LIMIT 1;";
$result = $sql->check($query);
return $result;
}//end method


/*
* Metodo para obtener los pagos de los clientes
*/
function validatePagosCliente($idUser){
$sql = new DataBase;
$query= "SELECT idpago FROM pago WHERE usuarios_idusuarios  = '$idUser' LIMIT 1;";
// guardo en la variable el retorno de la funcion
$validate = $sql->validate($query);
//retorno la variables
return $validate;
}//end method

function getPagosCliente($idUser){
$sql = new DataBase;
$query= "SELECT  pago.idpago, producto.nombreProducto, pago.montoPago, pago.fechaPago FROM pago, producto WHERE pago.producto_idpproducto = producto.idpproducto AND pago.usuarios_idusuarios  = '$idUser' ORDER BY pago.idpago DESC;";
$result = $sql->check($query);
return $result;
}//end method


/*
*Metodo para validar pagos de los clientes
*/

function validatePagosClientes($idUser){
$sql = new DataBase;
$query= "SELECT idpago FROM pago LIMIT 1;";
// guardo en la variable el retorno de la funcion
$validate = $sql->validate($query);
//retorno la variables
return $validate;
}//end method

/*
* Metodo para obtener los pagos de los clientes, metodo usado por el administrador
*/

function getPagosClientes($idUser){
$sql = new DataBase;
$query= "SELECT  pago.idpago, producto.nombreProducto, pago.montoPago, pago.fechaPago, pago.usuarios_idusuarios FROM pago, producto WHERE pago.producto_idpproducto = producto.idpproducto ORDER BY pago.idpago DESC;";
$result = $sql->check($query);
return $result;
}//end method


/*
* End metodo de pago de los clientes
*/

/*
* Id del Producto basado en su codigo
*/

function getIdProducto($varCodigoProducto){
$sql = new DataBase;
$query= "SELECT idpproducto FROM producto WHERE codigoProducto = '$varCodigoProducto' LIMIT 1;";
$result = $sql->check($query);
while($row = mysql_fetch_array($result)) {
$idProd = $row["idpproducto"];
}//end while
return $idProd;
}//end method

/*
* Costo del Producto Basado en su codigo
*/

function getCostoProducto($varCodigoProducto){
$sql = new DataBase;
$query= "SELECT costoProducto FROM producto WHERE codigoProducto = '$varCodigoProducto' LIMIT 1;";
$result = $sql->check($query);
while($row = mysql_fetch_array($result)) {
$costoProd = $row["costoProducto"];
}//end while
return $costoProd;
}//end method

/*
* Id del Producto basado en Pagos
*/

function getIdProductoPagos($idPago){
$sql = new DataBase;
$query= "SELECT producto_idpproducto FROM pago WHERE idpago = '$idPago' LIMIT 1;";
$result = $sql->check($query);
while($row = mysql_fetch_array($result)) {
$idProd = $row["producto_idpproducto"];
}//end while
return $idProd;
}//end method

/*
* Estado del Pago
*/
function getEstadoPago($idPago, $idUser, $idProducto){
$sql = new DataBase;
$query= "SELECT estadoPago FROM pago WHERE idpago = '$idPago' AND usuarios_idusuarios = '$idUser' AND producto_idpproducto = '$idProducto' LIMIT 1;";
$result = $sql->check($query);
while($row = mysql_fetch_array($result)) {
$estado = $row["estadoPago"];
}//end while
return $estado;
}//end method

function getDownloadLink($producto, $usuario){
$sql = new DataBase;
$query= "SELECT linkDescarga FROM producto_has_usuarios WHERE producto_idpproducto = '$producto' AND usuarios_idusuarios = '$usuario' LIMIT 1;";
$result = $sql->check($query);
while($row = mysql_fetch_array($result)) {
$link = $row["linkDescarga"];
}//end while
return $link;
}//end method

function registerDownload($producto, $usuario, $fecha){
 // creo un nuevo objeto de base de datos
 $sql = new DataBase;
 // limpio el query
 $query="";
 // Estructuro un nuevo query para agregar el cliente a la base de datos
 $query = "INSERT INTO descargas (id, idUsuario, idProducto, fecha)VALUES(NULL, '$usuario', '$producto', '$fecha');";
 // ejecuto la consulta
 $sql->check_noreturn($query);
}//end method

function decrementDouwnloadCount($producto, $usuario){
// creo un nuevo objeto de base de datos
$sql = new DataBase;
// limpio el query
$query = "";
// Estructuro un nuevo query para agregar el cliente a la base de datos
$query="UPDATE producto_has_usuarios SET numeroDescargas  = numeroDescargas-1 WHERE producto_idpproducto = '$producto' AND usuarios_idusuarios = '$usuario';";
// ejecuto la consulta
$sql->check_noreturn($query);
}

function detect_browser($var) {
		if(eregi("(msie) ([0-9]{1,2}.[0-9]{1,3})", $var)) {
			$str = "ie";
		} else {
			$str = "nn";
		}
	return $str;
}

/*
*Funcion para validar los mensajes de Email del Usuario
*/

function validateMessages($idUser){
$sql = new DataBase;
$query= "SELECT id FROM mensajes WHERE para = '$idUser' LIMIT 1;";
// guardo en la variable el retorno de la funcion
$validate = $sql->validate($query);
//retorno la variables
return $validate;
}//end method

function getMensajesCliente($idUser){
$sql = new DataBase;
$query= "SELECT id, de, asunto, fecha FROM mensajes WHERE para = '$idUser' ORDER BY id DESC;";
$result = $sql->check($query);
return $result;
}//end method

function getMensajes($idUser, $idMensaje){
$sql = new DataBase;
$query= "SELECT mensajes.de, usuarios.nombreUsuario, mensajes.asunto, mensajes.mensaje FROM mensajes, usuarios WHERE mensajes.para = usuarios.idusuarios AND mensajes.id = '$idMensaje' AND mensajes.para = '$idUser' LIMIT 1;";
$result = $sql->check($query);
return $result;
}//end method

function registerMensajes($de, $para, $asunto, $mensaje, $fecha){
 // creo un nuevo objeto de base de datos
 $sql = new DataBase;
 // limpio el query
 $query="";
 // Estructuro un nuevo query para agregar el cliente a la base de datos
 $query = "INSERT INTO mensajes (id, de, para, asunto, mensaje, fecha )VALUES(NULL, '$de', '$para', '$asunto', '$mensaje', '$fecha');";
 // ejecuto la consulta
 $sql->check_noreturn($query);
}//end method


function validateProductoRegistrado($idUser, $idProducto){
$sql = new DataBase;
$query= "SELECT producto_idpproducto  FROM producto_has_usuarios WHERE producto_idpproducto = '$idProducto' AND usuarios_idusuarios  = '$idUser' LIMIT 1;";
// guardo en la variable el retorno de la funcion
$validate = $sql->validate($query);
//retorno la variables
return $validate;
}//end method

/*Funcion para enviar mails*/

function enviarEmails($destinatario, $asunto, $cuerpo){

//para el envío en formato HTML
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 

//dirección del remitente
$headers .= "From: Lider Business Software <support@liderbs.com>\r\n"; 

//dirección de respuesta, si queremos que sea distinta que la del remitente
//$headers .= "Reply-To: support@liderbs.com\r\n";

//ruta del mensaje desde origen a destino
$headers .= "Return-path: support@liderbs.com\r\n";

//direcciones que recibián copia
//$headers .= "Cc: maria@desarrolloweb.com\r\n";

//direcciones que recibirán copia oculta
//$headers .= "Bcc: pepe@pepe.com,juan@juan.com\r\n";

mail($destinatario,$asunto,$cuerpo,$headers);

}//end method

function getClienteCountry($idUser){
$sql = new DataBase;
$query= "SELECT paisUsuarios FROM usuarios WHERE idusuarios  = '$idUser' LIMIT 1;";
$result = $sql->check($query);
while($row = mysql_fetch_array($result)) {
$pais = $row["paisUsuarios"];
}//end while
return $pais;
}


function getCodigoProducto($idProducto){
$sql = new DataBase;
$query= "SELECT codigoProducto FROM producto WHERE idpproducto  = '$idProducto' LIMIT 1;";
$result = $sql->check($query);
while($row = mysql_fetch_array($result)) {
$producto = $row["codigoProducto"];
}//end while
return $producto;
}

function getTipoPagoCliente($idCliente, $idProducto){
$sql = new DataBase;
$query= "SELECT metodoPago FROM producto_has_usuarios WHERE usuarios_idusuarios = '$idCliente' AND producto_idpproducto  = '$idProducto' LIMIT 1;";
$result = $sql->check($query);
while($row = mysql_fetch_array($result)) {
$metodo = $row["metodoPago"];
}//end while
return $metodo;
}


/*Emails memall*/

/*
* Metodo para validar los emails que envia el cliente
*/

function getValidateEmailsCliente($idCliente){
$sql = new DataBase;
$query= "SELECT idemail FROM email WHERE recibidopor = '$idCliente';";
// guardo en la variable el retorno de la funcion
$validate = $sql->validate($query);
//retorno la variables
return $validate;
}//end method

function getValidateEmailsClienteSent($idCliente){
$sql = new DataBase;
$query= "SELECT idemail FROM email WHERE enviadopor = '$idCliente';";
// guardo en la variable el retorno de la funcion
$validate = $sql->validate($query);
//retorno la variables
return $validate;
}//end method


/*
* Metodo para obtener los emails del cliente
*/

function getEmailsCliente($idCliente){
$sql = new DataBase;
$query= "SELECT email.idemail, email.asunto, usuarios.nombreEmpresa, email.estado, email.fecha FROM email, usuarios  WHERE email.enviadopor = usuarios.idusuarios AND email.recibidopor = '$idCliente' ORDER BY email.idemail DESC;";
$result = $sql->check($query);
return $result;
}//end method

/*
* Metodo para obtener los emails enviados del cliente
*/

function getEmailsClienteSent($idCliente){
$sql = new DataBase;
$query= "SELECT email.idemail, email.asunto, usuarios.nombreEmpresa, email.estado, email.fecha FROM email, usuarios  WHERE email.enviadopor = usuarios.idusuarios AND email.enviadopor = '$idCliente' ORDER BY email.idemail DESC;";
$result = $sql->check($query);
return $result;
}//end method


/*Metodo para obtener los datos de un email*/

function getEmailClienteSingle($idEmail, $idCliente){
$sql = new DataBase;
$query= "SELECT email.asunto, email.mensaje, usuarios.nombreEmpresa FROM email, usuarios  WHERE email.enviadopor = usuarios.idusuarios AND email.idemail = '$idEmail' ORDER BY email.idemail DESC;";
$result = $sql->check($query);
return $result;
}//end method


 /*
  * Metodo para eliminar los emails que el cliente no desea
  */
	 function deleteEmailsCliente($idUsuario, $emailList){
	 // creo un nuevo objeto de base de datos
        $sql = new DataBase;
     // limpio el query
        $query="";
	 // Estructuro un nuevo query para agregar el cliente a la base de datos
        $query = "DELETE FROM tabla WHERE id IN (".implode(',',$aLista).")";
		//echo $query;
     // ejecuto la consulta
	 $sql->check_noreturn($query);
	 }//end method


/*Contactos Memall*/

/*
* Metodo para validar los emails que envia el cliente
*/

function getValidateContactos($idCliente){
$sql = new DataBase;
$query= "SELECT idcontactos FROM contactos WHERE idUsuario = '$idCliente' LIMIT 1;";
// guardo en la variable el retorno de la funcion
$validate = $sql->validate($query);
//retorno la variables
return $validate;
}//end method

/* Metodo para validar los productos de un cliente */

function getValidateProductos($idCliente){
$sql = new DataBase;
$query= "SELECT idproductos FROM productos WHERE usuarios_idusuarios = '$idCliente'  LIMIT 1;";
// guardo en la variable el retorno de la funcion
$validate = $sql->validate($query);
//retorno la variables
return $validate;
}//end method

/* Metodo para validar las compras de un cliente */

function getValidateCompras($idCliente){
$sql = new DataBase;
$query= "SELECT idcompra  FROM compra WHERE usuarios_idusuarios = '$idCliente'  LIMIT 1;";
// guardo en la variable el retorno de la funcion
$validate = $sql->validate($query);
//retorno la variables
return $validate;
}//end method

/* Metodo para validar las compras de un cliente */

function getValidateSolicitudes($idCliente){
$sql = new DataBase;
$query= "SELECT idsolicitudes  FROM solicitudes WHERE solicitado = '$idCliente' AND estado = '0'  LIMIT 1;";
// guardo en la variable el retorno de la funcion
$validate = $sql->validate($query);
//retorno la variables
return $validate;
}//end method





}//end class
?>
