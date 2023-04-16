<div id="barra_title_pagina">
<div id="base_icone_local_pagina">
<div id="icone_local_pagina"></div>
</div>
<div id="base_text_topo_local_pagina" class="text_barra_title_pagina">Noticiario / Postar notícia</div>
<div id="content_title_pagina" class="title_pagina_barra">Postar notícia</div>
</div>

<div id="lado_dir_content">

<div id="box_pagina_conteudo">
<div id="content_list_inser_registro">
</div>
<?php
	$texto = $_POST['texto'];
	$data = time();
	$criador = $_SESSION['usuario_admin'];
	if($_POST){
		if(empty($texto)){
			echo Site::Alerta('Preencha todos os campos!',false);
		}else{
			db::Query("INSERT INTO timeline(texto, criador, data) VALUES ('$texto','$criador','$data') ");
			echo Site::Alerta('Criado com sucesso!',false);
		}
	}
?>
<form method="post">
    Texto:<br>
    <textarea name="texto"></textarea>
    <input type="submit" value="Postar">
</form>
</div>
</div>

