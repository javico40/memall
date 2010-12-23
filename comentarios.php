<?php
    //validar si el usuario tiene contactos
	 $isContacts = $memall->clientHasContacts($idUser); 
	 //cliente no tiene contactos
	 if($isContacts==0){
	   $query = $memall->getMensajesNoContactos($idUser);
	 }else{
	   $query = $memall->getMensajes($idUser);
	 }//end validatos de contactos
	// Hacer consulta para recuperar noticias
	while($result = mysql_fetch_assoc($query)){
		$id = $result["idmensajes"];
		$message = $result["descripcionMensaje"];
		$usuario_mensaje = $result["nombreEmpresa"];
		$direccionLogo = $result["direccionLogo"];
		//verificar si hay informacion sobre un logo
		if($direccionLogo==""){
		 $direccionLogo = "img/logoDefault.jpg";
		}
		// Comprobar que alguna noticia tenga comentarios
		$comment_query = $memall->getComentarios($id); 
		//$comment_query = mysql_query("SELECT * FROM comments WHERE msg_id_fk=".$result["msg_id"]);
		//omg/user.png
		?>
		<div class="bar<?php echo $id;?>">
			<!-- Contenedor que mostrar las noticias -->
			<div class="post_box">
				<img src="<?PHP echo $direccionLogo; ?>" width="38" height="38" class="imagen" />
				<div class="noticia"><?php echo "<strong>".$usuario_mensaje."</strong> ".$message;?></div>
				<div class="eliminar_noticia"><a href="#" id="<?php echo $id;?>" class="eliminar_noticia_actualizado estilo4">x</a></div>
				<div class="enlace_comentar"><a href="#"  id="<?php echo $id;?>" class="comentar estilo4">Comentar</a></div>
				
				<!-- Mostrar caja de texto para el comentario -->
				<div id="contenedor_textarea_comentario" class="contenedor_textarea_comentario<?php echo $id;?>">
					<div class="comentario_caja" id="comentario_caja<?php echo $id;?>">
						<form name="<?php echo $id;?>" method="post">
							<textarea class="text_area" name="comentario_valor" id="textarea<?php echo $id;?>"></textarea>
							<br />
							<input type="submit" value="Enviar" class="enviar_comentario" id="<?php echo $id;?>" />
						</form>
					</div>
				</div>					
				<?php
					$numero_comentarios = mysql_num_rows($comment_query);
					if($numero_comentarios>2){
						$totalComments = $numero_comentarios - 2;
						?>
						<div class="comment_ui" id="view<?php echo $id; ?>">
							<div>
								<a href="#" class="view_comments" id="<?php echo $id; ?>">Ver los <?php echo $numero_comentarios; ?> comentarios</a>
							</div>
						</div>
						<?php
					} else {
						$totalComments = 0;
					}
					
					$small = $memall->getComentariosPequeño($id, $totalComments);
					//$small = mysql_query("select * from comments where msg_id_fk='$id' order by com_id limit $totalComments,2 ");
					
					?>
					<!-- Div donde se añadiran los comentarios -->
					<div id="comentario_cargado<?php echo $id;?>"></div>
					<!-- Aqui se motraran todos los comentarios cuando el usuario pulse ver todos los comentarios-->
					<div id="view_comments<?php echo $id; ?>"></div>
					<!-- Contenedor donde se agrupan los comentarios de cada noticia -->
					<div id="two_comments<?php echo $id; ?>">
					<?php
					while($row = mysql_fetch_assoc($small)){
						$com_id = $row["idcomentarios"];
						$comment = $row["descripcionComentario"];
						?>
						<!-- Contenedor donde se mostraran los comentarios -->	
						<div class="conetenedor_comentarios" id="conetenedor_comentarios<?php echo $com_id;?>">
							<img src="omg/comment.png" width="38" height="38" class="imagen" />
							<div class="mostrar_comentario" id="mostrar_comentario<?php echo $com_id;?>"><?php echo $comment;?></div>
							<div class="comentario_borrar"><a href="#" id="<?php echo $com_id; ?>" class="comentario_borrar_actualizar">X</a></div>	
							<div class="enlace_comentar"></div>
						</div>
						<?php
					} // Fin comentarios					
				?>
				</div>				
			</div>			
		</div>
		<?php
	}
?>