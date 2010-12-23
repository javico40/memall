<?php
/**
 * search is the searcher class
 *
 * @author Javier Portilla
 */
class search {
    
    function ShopSimpleSearch($categoria){
    $sql = new DataBase();
    $query = "SELECT id_tie, nombre_tie, slogan_tie, logo_tie FROM tienda WHERE categoria_id_cat = '$categoria' ORDER BY  prestigio_tie;";
    $validate = $sql->validate($query);
    if($validate > 0){
    $result = $sql->check($query);
    }else{
    $result = "no found";
    }
    return $result;
    }
}
?>
