<div id="barra_title_pagina">
<div id="base_icone_local_pagina">
<div id="icone_local_pagina"></div>
</div>
<div id="base_text_topo_local_pagina" class="text_barra_title_pagina">Locução / Gerar presen&ccedil;a</div>
<div id="content_title_pagina" class="title_pagina_barra">Gerar presen&ccedil;a</div>
</div>
<div id="lado_dir_content">
<div id="box_pagina_conteudo">
<div id="content_list_inser_registro">
</div>
<?php
$codigo = substr(md5(time().$valor), 0, 6);
$verifica = $_POST['verifica'];
if($_POST){
	db::Query("INSERT INTO presenca(criador, ativo, codigo, data) VALUES ('".$_SESSION['usuario_admin']."','s','$codigo','".time()."')");
	db::Query("INSERT INTO logs_presenca(usuario, codigo, data) VALUES ('".$_SESSION['usuario_admin']."','$codigo','".time()."')");
	echo 'Presença gerada com sucesso!<br>codigo: '.$codigo.'<br>Seu codigo irá se inativar daqui 5 minutos!';
}
?>
<form method="post">
	<input type="hidden" name="verifica" value="sim">
    <input type="submit" value="Gerar presença">
</form>
</div>
</div>