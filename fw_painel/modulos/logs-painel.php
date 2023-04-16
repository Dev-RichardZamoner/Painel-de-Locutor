<div id="barra_title_pagina">
<div id="base_icone_local_pagina">
<div id="icone_local_pagina"></div>
</div>
<div id="base_text_topo_local_pagina" class="text_barra_title_pagina">Logs / Logs do painel</div>
<div id="content_title_pagina" class="title_pagina_barra">Logs do painel</div>
</div>

<div id="lado_dir_content">
<div id="box_pagina_conteudo">
<div id="content_list_inser_registro">
</div>
<table width="100%">
	<tr>
        <th>Id</th>
        <th>Usuario</th>
        <th>Canal</th>
        <th>Ip</th>
        <th>Data</th>
    </tr>
    <?php
	$i = 1;
    $sql = db::Query("SELECT * FROM logs_painel ORDER BY id DESC LIMIT 150");
	while($ver = db::FetchArray($sql)){
		$css = $i%2==0 ? '' : ' style="background:none;"';
	?>
    <tr>
        <th<?php echo $css; ?>><?php echo $ver['id']; ?></th>
        <th<?php echo $css; ?>><?php echo $ver['usuario']; ?></th>
        <th<?php echo $css; ?>><a href="<?php echo $ver['canal']; ?>" target="_blank"><?php echo $ver['canal']; ?></a></th>
        <th<?php echo $css; ?>><?php echo $ver['ip']; ?></th>
        <th<?php echo $css; ?>><?php echo date('d/m/Y', $ver['data']); ?> &aacute;s <?php echo date('H:i:s', $ver['data']); ?></th>
    </tr>
    <?php $i++;} ?>
</table>
</div>
</div>