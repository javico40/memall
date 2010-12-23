<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Tienda{
    
    private $error="";

   function add($email, $nombre, $nacion, $ofrece, $slogan, $categoria){
      //limpieza de variables
    $valido="";
    // creo el objeto de base de datos
    $sql = new DataBase();
    //valido el cliente
    $query = "SELECT id_cli FROM cliente WHERE email_cli = '$email' LIMIT 0 , 30;";
    // ejecuto la validacion
    $valido = $sql->validate($query);// el metodo validate solo devuelve el numero de filas
    // hago una consulta simple sobre la informacion del usuario
    $result =$sql->check($query);// sentencia que retorna un arreglo
    // si el cliente es valido
    if($valido > 0){
    // guardo en una variable su id para usarla luego
     while($row = mysql_fetch_array($result)) {
     $idCliente = $row["id_cli"];
       }
    //limpieza de variables
    $valido="";
    $query="";
    // valido que no tenga una tienda creada
    //creo el query para validar
    $query= "SELECT id_tie FROM tienda WHERE cliente_id_cli = '$idCliente' LIMIT 0 , 30;";
   // ejecuto la validacion
   $valido = $sql->validate($query);
    // si el usuario no tiene tienda
    if($valido==0){
        // estructuro el query
    $query = "INSERT INTO tienda (
id_tie,
nombre_tie,
slogan_tie,
logo_tie,
nacion_tie,
cliente_id_cli,
categoria_id_cat,
prestigio_tie
)VALUES(
NULL,
'$nombre',
'$slogan',
'',
'$nacion',
'$idCliente',
'$categoria',
'100'
);";
// ejecuto la consulta
$sql->check_noreturn($query);
// redirecciono al home
$time=0;
$url= "index.php";
 echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"$time;URL=$url\">";
// si el usuario ya tiene tienda
}else{
$error="Ya tiene una tienda registrada";
    }// fin de la validacion de la tienda
        // si no es un cliente valido
   }else{
        $error="Debe estar registrado para crear una tienda";
    }// fin de la validacion del cliente
    
    return $error;
    }   
        
    function delete(){
    }

/*
 * Este metodo determina si el cliente posee una tienda
 * ademas lo valida
 */
    function validate($email){
    //limpieza de variables
    $valido="";
    // creo el objeto de base de datos
    $sql = new DataBase();
    //valido el cliente
    $query = "SELECT id_cli FROM cliente WHERE email_cli = '$email' LIMIT 0 , 30; ";
    // ejecuto la validacion
    $valido = $sql->validate($query);// el metodo validate solo devuelve el numero de filas
    // hago una consulta simple sobre la informacion del usuario
    $result =$sql->check($query);// sentencia que retorna un arreglo
    // si el cliente es valido
    if($valido > 0){
    // guardo en una variable su id para usarla luego
     while($row = mysql_fetch_array($result)) {
     $idCliente = $row["id_cli"];
       }
    //limpieza de variables
    $valido="";
    $query="";
    // valido que no tenga una tienda creada
    //creo el query para validar
    $query= "SELECT id_tie FROM tienda WHERE cliente_id_cli = '$idCliente' LIMIT 0 , 30; ";
   // ejecuto la validacion
   $valido = $sql->validate($query);
    // si el usuario no tiene tienda
    if($valido==0){
        //devolver valos 0
        $tiendas = 0;
    }else{
        $tiendas =1;
    }
    // si el cliente no es valido
    }else{
        //reportar acceso ilegal
    }
    return $tiendas;
    }
/*
 * Este metodo retorna toda la informacion de una tienda, esta diseñada para
 * ser usada por el sistema, retorna toda la informacion de una tienda
 */
    function get($email){
    //limpieza de variables
    $valido="";
    // creo el objeto de base de datos
    $sql = new DataBase();
    //valido el cliente
    $query = "SELECT id_cli FROM cliente WHERE email_cli = '$email' LIMIT 0 , 30; ";
    // ejecuto la validacion
    $valido = $sql->validate($query);// el metodo validate solo devuelve el numero de filas
    // hago una consulta simple sobre la informacion del usuario
    $result =$sql->check($query);// sentencia que retorna un arreglo
    // si el cliente es valido
    if($valido > 0){
    // guardo en una variable su id para usarla luego
     while($row = mysql_fetch_array($result)) {
     $idCliente = $row["id_cli"];
       }
    //limpieza de variables
    $result="";
    $query="";
    // valido que no tenga una tienda creada
    //creo el query para validar
    $query= "SELECT * FROM tienda WHERE cliente_id_cli = '$idCliente' LIMIT 0 , 30; ";
   // ejecuto la validacion
   $result = $sql->check($query);
    // si el cliente no es valido
    }else{
        //reportar acceso ilegal
    }
    return $result;
    } // fin del metodo
}

?>
