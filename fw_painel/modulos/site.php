<div id="barra_title_pagina">
<div id="base_icone_local_pagina">
<div id="icone_local_pagina"></div>
</div>
<div id="base_text_topo_local_pagina" class="text_barra_title_pagina">Administracao / Editar site</div>
<div id="content_title_pagina" class="title_pagina_barra">Editar site</div>
</div>

<div id="lado_dir_content">
<div id="box_pagina_conteudo">
<div id="content_list_inser_registro">
</div>
<?php
$fundo = $_POST['fundo'];
$fundo_tipo = $_POST['fundotipo'];
$header = $_POST['header'];
$sql = db::Query("SELECT * FROM site LIMIT 1");
$ver = db::FetchArray($sql);
if($_POST){
	mysql_query("UPDATE site SET fundo='$fundo', fundo_tipo='$fundo_tipo', header='$header'");
	echo Site::Alerta('Criado com sucesso!',false);
}
?>
	<form method="post">
    <?php if($ver['fundo_tipo'] == 'imagem'){ ?>
    <div style="width:50px; height:50px; background:url(<?php echo $ver['fundo']; ?>);"></div>
    <?php }else{ ?>
    <div style="width:50px; height:50px; background:<?php echo $ver['fundo']; ?>;"></div>
    <?php } ?>
	Fundo: <span style="font-size:11px;">Clique <a href="index.php?cp=29&c=30" target="_blank">aqui</a> para fazer upload.</span><br>
	<input type="text" name="fundo" value="<?php echo $ver['fundo']; ?>"><br>
    Tipo fundo:<br>
    <select name="fundotipo">
    	<option value="imagem"<?php if($ver['fundo_tipo'] == 'imagem'){echo(' selected');} ?>>Imagem</option>
        <option value="cor"<?php if($ver['fundo_tipo'] == 'cor'){echo(' selected');} ?>>Cor</option>
    </select><br>
    Header: <span style="font-size:11px;">Clique <a href="index.php?cp=29&c=30" target="_blank">aqui</a> para fazer upload. (920 x 257)</span><br>
    <img src="<?php echo $ver['header']; ?>"><br>
	<input type="text" name="header" value="<?php echo $ver['header']; ?>"><br>
	<input type="submit" value="Editar">
</form>
</div>
</div>