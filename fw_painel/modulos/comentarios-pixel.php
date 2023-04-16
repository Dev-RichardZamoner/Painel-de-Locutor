<div id="barra_title_pagina">
<div id="base_icone_local_pagina">
<div id="icone_local_pagina"></div>
</div>
<div id="base_text_topo_local_pagina" class="text_barra_title_pagina">Modera&ccedil;&atilde;o / Comentarios pixel</div>
<div id="content_title_pagina" class="title_pagina_barra"><span class="text_barra_title_pagina">Comentarios pixel</span></div>
</div>
<script>
var apagar = {
	sim:function(id){
		if(confirm('Tem certeza que deseja apagar ?')){
			$.ajax({
				type:'GET',
				url:'index.php?cp=<?php echo $cp; ?>&c=<?php echo $c; ?>&tipo=apagar&id='+id,
				data:{'id':id},
				success:function(html){
					alert('Apagado com sucesso!');
					location.reload();
				}
			});
		}
	}
}
</script>
<div id="lado_dir_content">
<div id="box_pagina_conteudo">
<div id="content_list_inser_registro">
</div>
<?php
if($tipo == 'apagar'){
	$id = (int) $_GET['id'];
	db::Query("DELETE FROM pixel_comentarios WHERE id='$id'");
	echo('deu');
}else{
?>
<table width="100%">
	<tr>
    	<th><img src="imagens/x.png"></th>
        <th>ID</th>
        <th>Id do pixel</th>
        <th>Autor</th>
        <th>Comentario</th>
        <th>Data</th>
    </tr>
    <?php
	$i = 1;
    $sql = db::Query("SELECT * FROM pixel_comentarios ORDER BY id DESC LIMIT 50");
	while($ver = db::FetchArray($sql)){
		$css = $i%2==0 ? '' : ' style="background:none;"';
	?>
    <tr>
    	<th<?php echo $css; ?>><img src="imagens/x.png" onClick="apagar.sim('<?php echo $ver['id']; ?>');"></th>
        <th<?php echo $css; ?>><?php echo $ver['id']; ?></th>
        <th<?php echo $css; ?>><?php echo $ver['id_pixel']; ?></th>
        <th<?php echo $css; ?>><?php echo $ver['autor']; ?></th>
        <th<?php echo $css; ?>><?php echo $ver['comentario']; ?></th>
        <th<?php echo $css; ?>><?php echo date('d/m/Y', $ver['data']); ?> &aacute;s <?php echo date('H:i:s', $ver['data']); ?></th>
    </tr>
    <?php $i++;} ?>
</table>
<?php } ?>
</div>
</div>