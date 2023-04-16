<div id="barra_title_pagina">
<div id="base_icone_local_pagina">
<div id="icone_local_pagina"></div>
</div>
<div id="base_text_topo_local_pagina" class="text_barra_title_pagina">Dire&ccedil;&atilde;o de conteudo / Gerar codigo</div>
<div id="content_title_pagina" class="title_pagina_barra">Gerar codigo</div>
</div>
<div id="lado_dir_content">
<div id="box_pagina_conteudo">
<div id="content_list_inser_registro">
</div>
<?php
$valor = $_POST['valor'];
$codigo = substr(md5(time().$valor), 0, 6);
if($_POST){
	db::Query("INSERT INTO codigos(valor, codigo) VALUES ('$valor','$codigo')");
	db::Query("INSERT INTO logs_codigos(valor, usuario, codigo, data) VALUES ('$valor','".$_SESSION['usuario_admin']."','$codigo','".time()."')");
	echo 'Seu codigo: '.$codigo.'<br>Valor: '.$valor.'';
}
?>
<form method="post">
    Valor:<br>
    <input type="text" name="valor"><br>
    <input type="submit" value="Criar">
</form>
</div>
</div>