<?php
include("include/core/main.php");
//variable memall
$memall = new Memall();
	
	if(isSet($_POST['comentario_valor'])){
		$id=time();// Demo Use
		$comment=$_POST['comentario_valor'];
		$id=$_POST['id'];
		
		$memall->registrarComentario($comment, $id);
		//$sql = mysql_query("insert into comments(comment,msg_id_fk)values('$comment','$id')");
		$result = $memall->getComentariosInsertar();
		//$result = mysql_query("select * from comments order by com_id desc");
		$row = mysql_fetch_s($result);
		$com_id = $row['idcomentarios'];
		$comment = $row['descripcionComentario'];	
	}
?>
<div class="conetenedor_comentarios" id="conetenedor_comentarios<?php echo $com_id;?>">
	<img src="Img/comment.png" width="38" height="38" class="imagen" />
	<div class="mostrar_comentario" id="mostrar_comentario<?php echo $com_id;?>"><?php echo $comment;?></div>
	<div class="comentario_borrar"><a href="#" id="<?php echo $com_id; ?>" class="comentario_borrar_actualizar">X</a></div>	
	<div class="enlace_comentar"></div>
</div>