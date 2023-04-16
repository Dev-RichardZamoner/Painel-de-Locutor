<div id="barra_title_pagina">
<div id="base_icone_local_pagina">
<div id="icone_local_pagina"></div>
</div>
<div id="base_text_topo_local_pagina" class="text_barra_title_pagina">Administra&ccedil;&atilde;o / Postar lista negra</div>
<div id="content_title_pagina" class="title_pagina_barra">Postar lista negra</div>
</div>

<div id="lado_dir_content">
<div id="box_pagina_conteudo">
<div id="content_list_inser_registro">
</div>
<?php
$usuario = $_POST['usuario'];
if($_POST){
	mysql_query("INSERT INTO lista_negra(usuario) VALUES ('$usuario') ");
	echo Site::Alerta('Criado com sucesso!',false);
}
?>
<form method="post">
	Usuario:<br>
	<input type="text" name="usuario"><br>
	<input type="submit" value="Postar">
</form>
</div>
</div>