<div id="barra_title_pagina">
<div id="base_icone_local_pagina">
<div id="icone_local_pagina"></div>
</div>
<div id="base_text_topo_local_pagina" class="text_barra_title_pagina">Extras / Lista negra</div>
<div id="content_title_pagina" class="title_pagina_barra">Lista negra</div>
</div>

<div id="lado_dir_content">
<div id="box_pagina_conteudo">
<div id="content_list_inser_registro">
</div>
<table width="100%">
	<tr>
    	<th>Id</th>
        <th>Usuario</th>
    </tr>
    <?php
	$i = 1;
    $sql = db::Query("SELECT * FROM lista_negra ORDER BY id DESC LIMIT 50");
	while($ver = db::FetchArray($sql)){
		$css = $i%2==0 ? '' : ' style="background:none;"';
	?>
    <tr>
    	<th<?php echo $css; ?>><?php echo $ver['id']; ?></th>
        <th<?php echo $css; ?>><?php echo $ver['usuario']; ?></th>
    </tr>
    <?php $i++;} ?>
</table>
</div>
</div>