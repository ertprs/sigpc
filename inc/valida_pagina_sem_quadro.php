<?php // Breno Cruvinel - breno.cruvinel09@gmail.com
//valida pagina se aberto separadamente
if(!isset($SYS_VALIDASEMQUADRO)){
   	 //faz um alerta
		print("<script>");
		print("{");
		print("window.location='../index.php';}");
		print("</script>");
		exit(0);
		}
?>