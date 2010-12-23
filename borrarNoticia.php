<?php
	if($_POST['msg_id']){
		$id=$_POST['msg_id'];
		$id = mysql_escape_String($id);
		$sql = $memall->eliminarMensajes($id);
		//$sql = mysql_query("delete from messages where msg_id='$id'");
		//$sql1 =  mysql_query("delete from comments where msg_id_fk='$id'");
		if($sql)
			return true;
		else
			return false;
	}
?>