<?php
	include("db.php");
	if(isset($_POST['msg_id'])) {
		$id=$_POST['msg_id'];
		$com=mysql_query("select * from comments where msg_id_fk='$id' order by com_id");
		while($r=mysql_fetch_array($com)) {
			$com_id=$r['com_id'];
			$comment=$r['comment'];
			?>
			<div class="conetenedor_comentarios" id="conetenedor_comentarios<?php echo $com_id;?>">
				<img src="../test/comentarios/Img/comment.png" width="38" height="38" class="imagen" />
				<div class="mostrar_comentario" id="mostrar_comentario<?php echo $com_id;?>"><?php echo $comment;?></div>
				<div class="comentario_borrar"><a href="#" id="<?php echo $com_id; ?>" class="comentario_borrar_actualizar">X</a></div>	
				<div class="enlace_comentar"></div>
			</div>
			<?php 
		} 
	}
?>