<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ActorClass
 *
 * @author Javier Portilla
 */
abstract class Actor{

abstract function add($nombre, $apellido, $email, $telefono, $contrasena, $nivel, $code, $status);

abstract function delete();

abstract function validate($email, $contraseña);

}
?>
