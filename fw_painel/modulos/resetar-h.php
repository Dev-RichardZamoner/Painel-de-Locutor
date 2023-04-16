<div id="barra_title_pagina">
<div id="base_icone_local_pagina">
<div id="icone_local_pagina"></div>
</div>
<div id="base_text_topo_local_pagina" class="text_barra_title_pagina">Administração / Resetar horarios</div>
<div id="content_title_pagina" class="title_pagina_barra">Resetar horarios</div>
</div>

<div id="lado_dir_content">
<div id="box_pagina_conteudo">
<div id="content_list_inser_registro">
</div>
<?php
$resetar = mysql_query("SELECT * from painel_horarios ;");
$resetar = mysql_fetch_array($resetar);
if(!$_POST['submit']) {
echo("<form method=\"POST\"><input type=submit name=submit value=\"Resetar Hor&aacute;rios\"></form>");
}else{
mysql_query("UPDATE `painel_horarios` SET `usr_id` = 0 ;");
echo("<script>alert('Horarios Restados com sucesso.')</script>");
}
?>
</div>
</div>