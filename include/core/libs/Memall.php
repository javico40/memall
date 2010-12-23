<?PHP
/* 
 * Javier Portilla
 * Lider Business Software 2010
 */
 
 class Memall{
 
 /*
 * Este metodo retorna el listado de industrias que estan disponibles
 */
  function getIndustrias(){
    // creo el objeto de base de datos
    $sql = new DataBase();
    //Selecciono las industrias
    $query = "SELECT idindustria, descripcionIndustria FROM industria ORDER BY descripcionIndustria ASC;";
   // ejecuto la consultta
   $result = $sql->check($query);
    return $result;
  } // fin del metodo
  
  /*
 * Este metodo retorna el listado de los productos que estan disponibles en memall
 */
  function getProductosActivos(){
    // creo el objeto de base de datos
    $sql = new DataBase();
    //Selecciono las industrias
    $query = "SELECT  productos.idproductos, productos.nombreProducto, productos.rutaImagen, usuarios.nombreEmpresa, regiones.descripcionRegion FROM productos, usuarios, regiones WHERE productos.estado = '1' AND  productos.usuarios_idusuarios = usuarios.idusuarios AND usuarios.provincia = regiones.idregiones ORDER BY productos.idproductos ASC;";
   // ejecuto la consultta
   $result = $sql->check($query);
    return $result;
  } // fin del metodo
  
  /*
 * Este metodo retorna el listado de industrias que estan disponibles
 */
  function getPaises(){
    // creo el objeto de base de datos
    $sql = new DataBase();
    //Selecciono las industrias
    $query = "SELECT idregiones, descripcionRegion FROM regiones ORDER BY idregiones;";
   // ejecuto la consultta
   $result = $sql->check($query);
    return $result;
  } // fin del metodo
  
 /*
 * Este metodo retorna las categorias de las industrias disponibles
 */
  function getCategorias($idCategoria){
    // creo el objeto de base de datos
    $sql = new DataBase();
    //Selecciono las industrias
    $query = "SELECT idcategorias, descripcionCategoria, industria_idindustria  FROM categorias WHERE industria_idindustria  = '$idCategoria' ORDER BY descripcionCategoria ASC;";
   // ejecuto la consultta
   $result = $sql->check($query);
    return $result;
  } // fin del metodo
  
  /*
  Este metodo valida si existen productos en determinada Industria
  */
  function validateIndustria($idIndustria){
     // creo un nuevo objeto de base de datos
      $sql = new DataBase;
    // estructuro la consulta
      $query = "SELECT idproductos FROM productos WHERE industria_idindustria = '$idIndustria';";
     // guardo en la variable el retorno de la funcion
	 $validate = $sql->validate($query);
     return $validate;
}//end method
  
  /*
  Este metodo valida si existen productos en una categoria, perteneciente a una industria
  */
  
  function validateCategoria($idIndustria, $idCategoria){
     // creo un nuevo objeto de base de datos
      $sql = new DataBase;
    // estructuro la consulta
      $query = "SELECT idproductos FROM productos WHERE industria_idindustria = '$idIndustria' AND categorias_idcategorias = '$idCategoria';";
     // guardo en la variable el retorno de la funcion
	 $validate = $sql->validate($query);
     return $validate;
}//end method
  
  /*
  Este metodo retorna los productos de toda una industria
  */
  function getProductosPorIndustria($idIndustria){
    // creo el objeto de base de datos
    $sql = new DataBase();
    //Selecciono las industrias
    $query = "SELECT productos.idproductos, productos.nombreProducto, productos.descripcionCorta, productos.rutaImagen, productos.cantidadMinimaOrdenar, usuarios.nombreEmpresa, usuarios.ciudad FROM productos, usuarios WHERE productos.usuarios_idusuarios = usuarios.idusuarios AND productos.industria_idindustria = '$idIndustria' ORDER BY idproductos;";
   // ejecuto la consultta
   $result = $sql->check($query);
    return $result;
  } // fin del metodo
  
   /*
  Este metodo retorna los productos de toda una industria
  */
  function getProductosPorCategoria($idIndustria, $idategoria){
    // creo el objeto de base de datos
    $sql = new DataBase();
    //Selecciono las industrias
    $query = "SELECT productos.idproductos, productos.nombreProducto, productos.descripcionCorta, productos.rutaImagen, productos.cantidadMinimaOrdenar, usuarios.nombreEmpresa, usuarios.ciudad FROM productos, usuarios WHERE productos.usuarios_idusuarios = usuarios.idusuarios AND productos.industria_idindustria = '$idIndustria' AND productos.categorias_idcategorias = '$idategoria' ORDER BY idproductos;";
   // ejecuto la consultta
   $result = $sql->check($query);
    return $result;
  } // fin del metodo
  
  /*
  Este metodo retorna los productos de una categoria especifica
  */
 
 
 /*
 * Este metodo retorna los producto del cliente
 */
  function getProductos($idUsuario){
    // creo el objeto de base de datos
    $sql = new DataBase();
    //Selecciono las industrias
    $query = "SELECT productos.idproductos, productos.nombreProducto, industria.descripcionIndustria, categorias.descripcionCategoria, productos.estado FROM productos, industria, categorias WHERE productos.usuarios_idusuarios = '$idUsuario' AND productos.industria_idindustria = industria.idindustria AND productos.categorias_idcategorias = categorias.idcategorias ORDER BY productos.idproductos DESC;";
   // ejecuto la consultta
   $result = $sql->check($query);
    return $result;
  } // fin del metodo


 /*
 * Este metodo retorna las compras del cliente
 */
  function getCompras($idUsuario){
    // creo el objeto de base de datos
    $sql = new DataBase();
    //Selecciono las industrias
    $query = "SELECT compra.idcompra, compra.descripcionCorta, industria.descripcionIndustria, categorias.descripcionCategoria, compra.estado FROM compra, industria, categorias WHERE compra.usuarios_idusuarios = '$idUsuario' AND compra.industria_idindustria = industria.idindustria AND compra.categorias_idcategorias = categorias.idcategorias ORDER BY compra.idcompra DESC;";
   // ejecuto la consultta
   $result = $sql->check($query);
    return $result;
  } // fin del metodo
  
  
 /*
 * Este metodo retorna los contactos del cliente
 */
  function getContactos($idUsuario){
    // creo el objeto de base de datos
    $sql = new DataBase();
    //Selecciono las industrias
    $query = "SELECT usuarios.idusuarios, usuarios.nombreApellido, usuarios.nombreEmpresa, usuarios.login, regiones.descripcionRegion FROM contactos, usuarios, regiones WHERE contactos.idUsuario = '$idUsuario' AND contactos.idContacto = usuarios.idusuarios AND usuarios.provincia = regiones.idregiones ORDER BY usuarios.nombreApellido;";
   // ejecuto la consultta
   $result = $sql->check($query);
    return $result;
  } // fin del metodo
  
  /*Este metodo valida si el cliente tiene contactos*/
  
  function clientHasContacts($idUsuario){
    // creo el objeto de base de datos
    $sql = new DataBase();
    // estructuro la consulta
     $query = "SELECT idcontactos FROM contactos WHERE idUsuario = '$idUsuario' LIMIT 1;";
     // guardo en la variable el retorno de la funcion
	 $validate = $sql->validate($query);
     return $validate;
  }//end method
  
  /*
 * Este metodo retorna los mensajes del cliente
 */
  function getMensajes($idUsuario){
    // creo el objeto de base de datos
    $sql = new DataBase();
	//Selecciono las industrias
   $query = "SELECT mensajes.idmensajes, mensajes.descripcionMensaje, usuarios.nombreEmpresa, usuarios.direccionLogo FROM mensajes, contactos, usuarios WHERE usuarios.idusuarios = '2' AND mensajes.usuarios_idusuarios = '2' OR  mensajes.usuarios_idusuarios = contactos.idContacto AND mensajes.usuarios_idusuarios = usuarios.idusuarios GROUP BY idmensajes ORDER BY idmensajes DESC LIMIT 5;";
   // ejecuto la consultta
   $result = $sql->check($query);
    return $result;
  } // fin del metodo
  
  /*Este metodo retorna los mensajes del usuario cuando no tiene contactos, solo vera sus mensajes*/
   function getMensajesNoContactos($idUsuario){
    // creo el objeto de base de datos
    $sql = new DataBase();
    //Selecciono las industrias
    $query = "SELECT mensajes.idmensajes, mensajes.descripcionMensaje, usuarios.nombreEmpresa, usuarios.direccionLogo FROM mensajes, usuarios WHERE mensajes.usuarios_idusuarios = '$idUsuario' AND mensajes.usuarios_idusuarios = usuarios.idusuarios GROUP BY idmensajes ORDER BY idmensajes DESC;";
   // ejecuto la consultta
   $result = $sql->check($query);
    return $result;
  } // fin del metodo
  
  
    /*
 * Este metodo retorna comentarios de un mensaje
 */
  function getComentarios($idMensaje){
    // creo el objeto de base de datos
    $sql = new DataBase();
    //Selecciono las industrias
    $query = "SELECT idcomentarios, descripcionComentario FROM comentarios WHERE mensajes_idmensajes = '$idMensaje';";
   // ejecuto la consultta
   $result = $sql->check($query);
    return $result;
  } // fin del meto
  
    /*
 * Este metodo retorna comentarios de un mensaje, segundo metodo
 */
  function getComentariosPequeño($idMensaje, $totalComments){
    // creo el objeto de base de datos
    $sql = new DataBase();
    //Selecciono las industrias
    $query = "SELECT idcomentarios, descripcionComentario FROM comentarios WHERE mensajes_idmensajes = '$idMensaje' ORDER BY idcomentarios LIMIT $totalComments, 2;";
   // ejecuto la consultta
   $result = $sql->check($query);
    return $result;
  } // fin del metodo
  
  
     /*
 * Este metodo retorna comentarios de un mensaje
 */
  function getComentariosInsertar(){
    // creo el objeto de base de datos
    $sql = new DataBase();
    //Selecciono las industrias
    $query = "SELECT idcomentarios, descripcionComentario FROM comentarios ORDER BY idcomentarios DESC;";
   // ejecuto la consultta
   $result = $sql->check($query);
    return $result;
  } // fin del meto
  
   /*
	 * registrar Comentarios
	 */ 
	 function registrarComentario($descripcion, $idMensaje){
	 // creo un nuevo objeto de base de datos
        $sql = new DataBase;
     // limpio el query
        $query="";
	 // Estructuro un nuevo query para agregar el cliente a la base de datos
 $query = "INSERT INTO comentarios (idcomentarios, descripcionComentario, mensajes_idmensajes)VALUES( NULL, '$descripcion', '$idMensaje');";
     // ejecuto la consulta
	 $sql->check_noreturn($query);
	 }//end method
	 
	  /*
	 * registrar Mensajes
	 */ 
	 function registrarMensaje($descripcion, $idUsuarios){
	 // creo un nuevo objeto de base de datos
        $sql = new DataBase;
     // limpio el query
        $query="";
	 // Estructuro un nuevo query para agregar el cliente a la base de datos
       $query = "INSERT INTO mensajes (idmensajes, descripcionMensaje, usuarios_idusuarios )VALUES(NULL, '$descripcion', '$idUsuarios');";
	 // ejecuto la consulta
	    $sql->check_noreturn($query);
	 }//end method
	 
	 
	  /*
 * Este metodo retorna los mensajes del cliente
 */
  function getMensajesRegistrar(){
    // creo el objeto de base de datos
    $sql = new DataBase();
    //Selecciono las industrias
    $query = "SELECT idmensajes, descripcionMensaje FROM mensajes ORDER BY idmensajes DESC;";
   // ejecuto la consultta
   $result = $sql->check($query);
    return $result;
  } // fin del metodo
	 
 
   /*
   Este metodo elimina los mensajes realizados por el cliente
   */
   
   function eliminarMensajes($idMensaje){
      // creo un nuevo objeto de base de datos
       $sql = new DataBase;
      // limpio el query
       $query="";
	 // Estructuro un nuevo query para agregar el cliente a la base de datos
       $query = "DELETE FROM mensajes WHERE idmensajes = '"+$idMensaje+"';";
	 // ejecuto la consulta
	    $sql->check_noreturn($query);
     //elimino los comentarios que haya en el sistema
	 // Estructuro un nuevo query para agregar el cliente a la base de datos
       $query = "DELETE FROM comentarios WHERE mensajes_idmensajes = '"+$idMensaje+"';";
	 // ejecuto la consulta
	    $sql->check_noreturn($query);
		
		return true;
   }//end method
   
   /*
   * Este metodo elimina los comentarios realizados por un cliente
   */
 
   function eliminarComentarios(){
   // creo un nuevo objeto de base de datos
        $sql = new DataBase;
     // limpio el query
        $query="";
	 // Estructuro un nuevo query para agregar el cliente a la base de datos
       $query = "INSERT INTO mensajes (idmensajes, descripcionMensaje, usuarios_idusuarios )VALUES(NULL, '$descripcion', '$idUsuarios');";
	 // ejecuto la consulta
	    $sql->check_noreturn($query);
   }
   
   /*
   * Este metodo busca empresas para iniciar contacto
   */
 
   function buscarContactos($estado, $tipo, $suscripcion, $idUsuario){
   $varWhere = "";
   $tipoCampo = "";
   //asigando el campo
   if($tipo=='1'){
   $tipoCampo = "isFabricante";
   }else if($tipo=='2'){
   $tipoCampo = "isDistribuidorMayorista ";
   }else if($tipo=='3'){
   $tipoCampo = "isDistribuidorMinorista";
   }else if($tipo=='4'){
   $tipoCampo = "isCooperativa";
   }else if($tipo=='5'){
   $tipoCampo = "isEmpresaEstatal";
   }else if($tipo=='6'){
   $tipoCampo = "isImportador ";
   }else if($tipo=='7'){
   $tipoCampo = "isServicios";
   }else if($tipo=='8'){
   $tipoCampo = "isOtros";
   }
    
   //validando los datos
   //sin estado
   if($estado=='0'){
       //sin tipo
	   if($tipo=='0'){
	      //sin suscripcion
	      if($suscripcion=='0'){
		     $varWhere = "provincia = '$estado'";
		  //con suscripcion
		  }else{
		     $varWhere = "industria_idindustria = '$suscripcion'";
		  }//end if-else
	   //si tiene tipo y sin estado
	   }else{
	      //tiene suscripcion
	      if($suscripcion=='0'){
		    $varWhere = $tipoCampo." = '1' AND industria_idindustria = '$suscripcion'";
		  //no tiene suscripcion
		  }else{
		    $varWhere = $tipoCampo." ='1'";
		  }//end if-else
	   }//end if-else
	 //tiene estado
   }else{
       //tiene estado y no tipo
       if($tipo=='0'){
	     //tiene estado, no tipo, no suscripcion
	      if($suscripcion=='0'){
		    $varWhere = "provincia = '$estado'";
		  //estado si, no tipo, si suscripcion
		  }else{
		    $varWhere = "provincia = '$estado' AND industria_idindustria = '$suscripcion'";
		  }//end if-else
	   //tiene estado y tipo
	   }else{
	      //estado si, tipo si, suscripcion no
	      if($suscripcion=='0'){
		        $varWhere = "provincia = '$estado' AND ".$tipoCampo." = '1'";
		  //estado si, tipo si, suscripcion si
		  }else{
		        $varWhere = "provincia = '$estado' AND ".$tipoCampo." = '1' AND industria_idindustria = '$suscripcion'";
		  }//end if-else
	   }//end if-else
   }//end if-else
   
   // creo el objeto de base de datos
    $sql = new DataBase();
    //Selecciono las industrias
    $query = "SELECT idusuarios, nombreEmpresa, descripcionDetallada, vendemos, direccionLogo FROM usuarios WHERE ".$varWhere." AND idusuarios != '$idUsuario' ORDER BY idusuarios;";
   // ejecuto la consultta
    $result = $sql->check($query);
    return $result;
   }
   
   /*Informacion de contacto, agregar contacto*/
   
    function getContactInfo($idContact){
    // creo el objeto de base de datos
    $sql = new DataBase();
    //Selecciono las industrias
    $query = "SELECT nombreEmpresa, direccionLogo FROM usuarios WHERE idusuarios = '$idContact' LIMIT 1;";
   // ejecuto la consultta
   $result = $sql->check($query);
    return $result;
  } // fin del metodo
  
  function isContacto($idUser, $idContacto){
    // creo un nuevo objeto de base de datos
      $sql = new DataBase;
    // estructuro la consulta
      $query = "SELECT idcontactos FROM contactos WHERE idUsuario = '$idUser' AND idContacto = '$idContacto';";
     // guardo en la variable el retorno de la funcion
	 $validate = $sql->validate($query);
     return $validate;
  }//end function
  
  /*Solicitudes*/
   
   function registrarSolicitud($solicitante, $solicitado){
	 // creo un nuevo objeto de base de datos
        $sql = new DataBase;
     // limpio el query
        $query="";
	 // Estructuro un nuevo query para agregar el cliente a la base de datos
       $query = "INSERT INTO  solicitudes (idsolicitudes, solicitante, solicitado, estado)VALUES(NULL, '$solicitante', '$solicitado', '0');";
	 // ejecuto la consulta
	    $sql->check_noreturn($query);
	 }//end method
	 
	 function getSolicitudes($idUsuario){
    // creo el objeto de base de datos
    $sql = new DataBase();
    //Selecciono las industrias
    $query = "SELECT solicitudes.idsolicitudes, solicitudes.estado, usuarios.nombreApellido, usuarios.nombreEmpresa, usuarios.login, regiones.descripcionRegion FROM solicitudes, usuarios, regiones WHERE solicitudes.solicitado = '$idUsuario' AND solicitudes.estado = '0' AND solicitudes.solicitante = usuarios.idusuarios AND usuarios.provincia = regiones.idregiones ORDER BY usuarios.nombreApellido;";
   // ejecuto la consultta
   $result = $sql->check($query);
    return $result;
  } // fin del metodo
  
   /*Funcion que devuelve el estado de una solicitud*/
    
	function getSolicitudStatus($idContact){
    // creo el objeto de base de datos
    $sql = new DataBase();
    //Selecciono las industrias
    $query = "SELECT nombreEmpresa, direccionLogo FROM usuarios WHERE idusuarios = '$idContact' AND estado = '0' LIMIT 1;";
   // ejecuto la consultta
   $result = $sql->check($query);
    return $result;
  } // fin del metodo
  
  /*Funcion que añade un contacto a un usuario*/
    function addContacto($idSolicitud, $idUser){
	 // creo un nuevo objeto de base de datos
        $sql = new DataBase;
		//consulto la solicitud sacando los datos de los usuarios
     // limpio el query
        $query="";
     // estructuro el query
	    $query = "SELECT solicitante, solicitado FROM solicitudes WHERE idsolicitudes = '$idSolicitud' AND $idUser;";
		$result = $sql->check($query);
		//Saco los resultados
        while($row = mysql_fetch_array($result)){
           $solicitante = $row["solicitante"];
           $solicitado = $row["solicitado"];
		   }//end while
	 // Estructuro un nuevo query para agregar el cliente a la base de datos
        $query = "INSERT INTO contactos (idcontactos, idUsuario, idContacto)VALUES( NULL, '$solicitante', '$solicitado');";
     // ejecuto la consulta
	    $sql->check_noreturn($query);
	 // Estructuro un nuevo query para agregar el cliente a la base de datos
        $query = "INSERT INTO contactos (idcontactos, idUsuario, idContacto)VALUES( NULL, '$solicitado', '$solicitante');";
     // ejecuto la consulta
	    $sql->check_noreturn($query);
     //actualizo el estado de la solicitud
	    $query = "UPDATE solicitudes SET estado = '2' WHERE idsolicitudes = '$idSolicitud';";
		// ejecuto la consulta
	    $sql->check_noreturn($query);
	 }//end method
	 
	 /*funcion para enviar un mensaje*/
	 
	 function enviarMensaje($idUsuario, $idPara, $asunto, $mensaje){
	 //fecha actual del registro
     $fecha = date("Y-m-d"); 
	 // creo un nuevo objeto de base de datos
     $sql = new DataBase;
	 // limpio el query
     $query="";
	 // Estructuro un nuevo query para agregar el cliente a la base de datos
     $query = "INSERT INTO  email (idemail, enviadopor, recibidopor, asunto, mensaje, fecha, estado)VALUES( NULL, '$idUsuario', '$idPara', '$asunto', '$mensaje', '$fecha', '0');";
	 // ejecuto la consulta
	    $sql->check_noreturn($query); 
	 }//end method
   
   /*Sistemas automaticos de memall*/
    /*
	 * registrar contacto a memall
	 */ 
	 function contactoMemall($idUser){
	 // creo un nuevo objeto de base de datos
        $sql = new DataBase;
     // limpio el query
        $query="";
	 // Estructuro un nuevo query para agregar el cliente a la base de datos
        $query = "INSERT INTO contactos (idcontactos, idUsuario, idContacto)VALUES( NULL, '1', '$idUser');";
     // ejecuto la consulta
	    $sql->check_noreturn($query);
	 // Estructuro un nuevo query para agregar el cliente a la base de datos
        $query = "INSERT INTO contactos (idcontactos, idUsuario, idContacto)VALUES( NULL, '$idUser', '1');";
     // ejecuto la consulta
	    $sql->check_noreturn($query);
	 }//end method
	 
	 /*
	 * registrar Bienvenida
	 */ 
	 function contactoMemallBienvenida($empresa){
	 // creo un nuevo objeto de base de datos
        $sql = new DataBase;
     // limpio el query
        $query="";
	 // Estructuro un nuevo query para agregar el cliente a la base de datos
        $query = "INSERT INTO mensajes (idmensajes, descripcionMensaje, usuarios_idusuarios)VALUES( NULL, 'Bienvenido $empresa a MeMall, de negocio a negocio el primer portal b2b hispano.', '1');";
     // ejecuto la consulta
	    $sql->check_noreturn($query);
	 }//end method
	 
	 /*Revisar estado de los emails y cambiarlo*/
	 
	 function getEmailStatus($idEmail){
     // creo el objeto de base de datos
     $sql = new DataBase();
     //Selecciono las industrias
     $query = "SELECT estado FROM email WHERE idemail = '$idEmail' LIMIT 1;";
     // ejecuto la consultta
     $result = $sql->check($query);
     //Saco los resultados
     while($row = mysql_fetch_array($result)){
     $estado = $row["estado"];
	 }//end while
	 //reviso el estado y actualizo de ser nesesario
	 if($estado == '0'){
	   // limpio el query
        $query="";
	   // Estructuro un nuevo query para agregar el cliente a la base de datos
        $query = "UPDATE email SET estado = '1' WHERE idemail = '$idEmail';";
		// ejecuto la consulta
	    $sql->check_noreturn($query);
	 }//end
	} // fin del metodo
	
	//Informacion de un producto
	
	/*
 * Este metodo retorna la informacion de un producto
 */
  function getInformacionProducto($idProducto){
    // creo el objeto de base de datos
    $sql = new DataBase();
    //Selecciono las industrias
    $query = "SELECT productos.nombreProducto, industria.descripcionIndustria, categorias.descripcionCategoria, productos.estado, productos.marcaProducto, productos.modeloProducto, productos.rutaImagen, productos.descripcionDetallada, productos.cantidadMinimaOrdenar, productos.precioPorMayor, productos.precioPorProducto, productos.precioOtraDivisa FROM productos, industria, categorias WHERE productos.idproductos = '$idProducto' AND productos.industria_idindustria = industria.idindustria AND productos.categorias_idcategorias = categorias.idcategorias ORDER BY productos.idproductos DESC;";
   // ejecuto la consultta
   $result = $sql->check($query);
    return $result;
  } // fin del metodo

	 
  
  
 }//end class
?>