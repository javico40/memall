<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AppClass
 *
 * @author Javier Portilla
 */
class AppClass {
   
   function add(){
       
   }

   function getAllApp($idTienda){
   $sql = new DataBase();
   }
   
   function addToClient($email){
//creo un objeto tipo cliente
$cli = new Cliente();
// obtengo el id de el cliente
    $idCli = $cli->getId($email);
    $sql = new DataBase();
    $query= "INSERT INTO app_cli (
idAPC,
id_cli,
idApp
)VALUES(
NULL,
'$idCli',
'1',
);";
$sql->check_noreturn($query);
   }

   function getId($name){

   }

   function delete(){

   }
}
?>
