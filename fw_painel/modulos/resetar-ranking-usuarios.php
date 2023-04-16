<div id="barra_title_pagina">
<div id="base_icone_local_pagina">
<div id="icone_local_pagina"></div>
</div>
<div id="base_text_topo_local_pagina" class="text_barra_title_pagina">Administração / Resetar ranking</div>
<div id="content_title_pagina" class="title_pagina_barra">Resetar ranking</div>
</div>

<div id="lado_dir_content">
<div id="box_pagina_conteudo">
<div id="content_list_inser_registro">
</div>
<?php
if($_POST['submit']){
	$sql_limpar = mysql_query("SELECT * FROM usuarios");
	while($ver_limpar = mysql_fetch_array($sql_limpar)){
		mysql_query("UPDATE usuarios SET presenca='0' WHERE id='".$ver_limpar['id']."'");
	}
}					
?>
<form method="POST">
<input type="submit" name="submit" value="Resetar ranking">
</form>
</div>
</div>