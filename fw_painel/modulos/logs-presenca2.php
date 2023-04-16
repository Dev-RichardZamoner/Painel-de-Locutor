<div id="barra_title_pagina">
<div id="base_icone_local_pagina">
<div id="icone_local_pagina"></div>
</div>
<div id="base_text_topo_local_pagina" class="text_barra_title_pagina">Logs / Logs presen&ccedil;a gerado</div>
<div id="content_title_pagina" class="title_pagina_barra">Logs presen&ccedil;a gerado</div>
</div>

<div id="lado_dir_content">
<div id="box_pagina_conteudo">
<div id="content_list_inser_registro">
</div>
<table width="100%">
	<tr>
        <th>Id</th>
        <th>Codigo</th>
        <th>Usuario</th>
        <th>Locutor</th>
    </tr>
    <?php
	$i = 1;
    $sql = db::Query("SELECT * FROM presenca_usado ORDER BY id DESC LIMIT 50");
	while($ver = db::FetchArray($sql)){
		$css = $i%2==0 ? '' : ' style="background:none;"';
		$sql_2 = db::Query("SELECT * FROM logs_presenca WHERE id='$ver[id_cod]'");
		$ver_2 = db::FetchArray($sql_2);
	?>
    <tr>
        <th<?php echo $css; ?>><?php echo $ver['id']; ?></th>
        <th<?php echo $css; ?>><?php echo $ver_2['codigo']; ?></th>
        <th<?php echo $css; ?>><?php echo $ver['usuario']; ?></th>
        <th<?php echo $css; ?>><?php echo $ver_2['usuario']; ?></th>
    </tr>
    <?php $i++;} ?>
</table>
</div>
</div>
</div>
</div>