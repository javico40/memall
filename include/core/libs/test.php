<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require('Fundamental.Class.php');

$fundament = new Fundamental();
$res = $fundament->getNations();

//Llenas el combo

if ($row = mysql_fetch_array($res)){
echo '<select name= "nombreDelCombo">';
do {
       echo '<option value= "'.$row["PAI_ISO3"].'">'.$row["PAI_NOMBRE"].'</option>';
} while ($row = mysql_fetch_array($res));
echo '</select>';
}
?>
