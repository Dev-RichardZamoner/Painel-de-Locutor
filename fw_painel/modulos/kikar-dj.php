<div id="barra_title_pagina">
<div id="base_icone_local_pagina">
<div id="icone_local_pagina"></div>
</div>
<div id="base_text_topo_local_pagina" class="text_barra_title_pagina">Locução / Kikar Dj</div>
<div id="content_title_pagina" class="title_pagina_barra">Kikar Dj</div>
</div>

<div id="lado_dir_content">
<div id="box_pagina_conteudo">
<div id="content_list_inser_registro">
</div>
<h1>Basta clicar no botão para iniciar sua locução.</h1>
<?php
$sql = mysql_query("SELECT * FROM dados_radio");
$ver = mysql_fetch_array($sql);
$kikar = $_POST['kikar'];
if($_POST){
	mysql_query("INSERT INTO logs_radio(usuario, ip, data) VALUES ('".$_SESSION['usuario_admin']."','".$_SERVER['REMOTE_ADDR']."','".time()."') ");
	$scfp = fsockopen($ver['ip'], $ver['porta']);
	if($scfp){
		fputs($scfp,"GET /admin.cgi?pass=".$ver['senha_kick']."&mode=kicksrc HTTP/1.0\r\nUser-Agent: SHOUTcast Song Status (Mozilla Compatible)\r\n\r\n");
		while(!feof($scfp)) {
			$page .= fgets($scfp, 1000);
		}
		fclose($scfp);
	}
	echo "<script>alert('Boa sorte. Processo feito com sucesso.')</script>";
}
?>
<form method="post">
<input type="hidden" name="kikar" value="sim">
<input type="submit" value="Kikar Dj">
</form>
</div>
</div>