<div id="barra_title_pagina">
<div id="base_icone_local_pagina">
<div id="icone_local_pagina"></div>
</div>
<div id="base_text_topo_local_pagina" class="text_barra_title_pagina">Locu&ccedil;&atilde;o / Vinhetas</div>
<div id="content_title_pagina" class="title_pagina_barra">Vinhetas</div>
</div>

<div id="lado_dir_content">

<?php
$sql = db::Query("SELECT * FROM painel_vinhetas ORDER BY id DESC");
$total = db::NumRows($sql);
if($total == 0){
?>
<div id="box_pagina_conteudo">
<div id="content_list_inser_registro">
</div>
Nenhuma vinheta postada.
</div>
<?php
}
while($ver = db::FetchArray($sql)){
?>
<div id="aviso-<?php echo $ver['id']; ?>">
<div id="box_pagina_conteudo">
<div id="content_list_inser_registro">
</div>
	<div style="word-wrap:break-word;"><?php echo strip_tags(nl2br($ver['texto'])); ?></div>
<br>
Vinheta postada por: <b><?php echo $ver['criador']; ?></b> no dia: <b><?php echo date('d/m/Y', $ver['data']); ?></b> &aacute;s <b><?php echo date('H:i:s', $ver['data']); ?></b>.
</div>
</div>
<?php } ?>



</div>

