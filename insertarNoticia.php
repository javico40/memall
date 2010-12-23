<?PHP
    session_start();
	include("include/core/main.php");
	// si se ha enviado contenido
	if(isset($_POST["textarea_noticia"])){
		$msg = $_POST["textarea_noticia"];
		//variable memall 
        $memall = new Memall();
	    $cliente = new Cliente();
	    $user = $_SESSION['validate'];
        $idUser = $cliente->getId($user);
		// Insertar la informacion
		$memall->registrarMensaje($msg, $idUser);
		//$sql = mysql_query("INSERT INTO messages(message)values('$msg')");
		$result = $memall->getMensajesRegistrar();
		//$result = mysql_query("SELECT * FROM messages order by msg_id desc");
		$row = mysql_fetch_assoc($result);
		$id = $row["idmensajes"];
		$msg = $row["descripcionMensaje"];
		
	}
?>
<div class="bar<?php echo $id;?>">
	<div class="post_box">
		<img src="omg/user.png" width="38" height="38" class="imagen" />
		<div class="noticia"><?php echo $msg; ?></div>
		<div class="eliminar_noticia"><a href="javaScript:void(0)" id="<?php echo $id;?>" class="eliminar_noticia_actualizado estilo4">x</a></div>
		<div class="enlace_comentar"><a href="javaScript:void(0)" id="<?php echo $id;?>" class="comentar estilo4">Comentar</a></div>
		
		<div id="contenedor_textarea_comentario" class="contenedor_textarea_comentario<?php echo $id;?>">
			<div class="comentario_caja" id="comentario_caja<?php echo $id;?>">
				<form name="<?php echo $id;?>" method="post">
					<textarea class="text_area" name="comentario_valor" id="textarea<?php echo $id;?>"></textarea>
					<br />
					<input type="submit" value="Enviar" class="enviar_comentario" id="<?php echo $id;?>" />
				</form>
			</div>
			<!-- Div donde se añadiran los comentarios -->
			<div id="comentario_cargado<?php echo $id;?>"></div>
		</div>
	</div>
</div>