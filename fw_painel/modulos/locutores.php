<div id="barra_title_pagina">
<div id="base_icone_local_pagina">
<div id="icone_local_pagina"></div>
</div>
<div id="base_text_topo_local_pagina" class="text_barra_title_pagina">Administração / Locutores</div>
<div id="content_title_pagina" class="title_pagina_barra">Locutores</div>
</div>

<div id="lado_dir_content">
<div id="box_pagina_conteudo">
<div id="content_list_inser_registro">
</div>
<?php if($tipo == 'editar'){
		$id = $_GET['id'];
		$sql_1 = mysql_num_rows(mysql_query("SELECT * FROM painel_usuario_rel WHERE usr_id='".$id."' AND tp_usr_id='1'"));
		$eu_1 = mysql_num_rows(mysql_query("SELECT * FROM painel_usuario_rel WHERE usr_id='".$_SESSION['usuario_id_admin']."' AND tp_usr_id='1'"));
		if($sql_1 == 999999999999999999999999999999999999999999999999999999999999999999999999999999){
			echo('Você não pode editar esse usuario');
		}else{
		$sql = mysql_query("SELECT * FROM painel_usuarios WHERE id='$id'");
		$ver = mysql_fetch_array($sql);	
		$advertencia = $_POST['advertencia'];
		if($_POST){
			mysql_query("UPDATE painel_usuarios SET advertencia='$advertencia' WHERE id='$id'");
		echo Site::Alerta('Editado com sucesso!','index.php?cp='.$cp.'&c='.$c.'');
		}
	?>
	<form method="post">
    	Usuario:<br>
        <input type="text" name="usuario" value="<?php echo $ver['usuario']; ?>"><br>
        Advertencias: <span style="font-size:11px;">(<?php echo $ver['advertencia']; ?>)</span><br>
        <select name="advertencia">
        	<option value="0"<?php if($ver['advertencia'] == 0){echo(' selected="selected"');} ?>>0</option>
        	<option value="1"<?php if($ver['advertencia'] == 1){echo(' selected="selected"');} ?>>1</option>
            <option value="2"<?php if($ver['advertencia'] == 2){echo(' selected="selected"');} ?>>2</option>
            <option value="3"<?php if($ver['advertencia'] == 3){echo(' selected="selected"');} ?>>3</option>
        </select><br>
        <input type="submit" value="Editar">
	</form>
   <?php } ?>
<?php
}else{ ?>
<table width="100%">
	<tr>
    	<th><img src="imagens/edit.png"></th>
        <th>Id</th>
        <th>Usuario</th>
        <th>Advertencias</th>
    </tr>
    <?php
	$i = 1;
	$id = 7;
    $sql = db::Query("SELECT * FROM painel_usuarios u, painel_cargos t, painel_usuario_rel r WHERE t.tp_usr_id=r.tp_usr_id AND u.id=r.usr_id AND r.tp_usr_id='$id' ORDER BY r.tp_usr_id, u.usuario");
	while($ver = db::FetchArray($sql)){
		$css = $i%2==0 ? '' : ' style="background:none;"';
	?>
    <tr<?php if($ver['ativo'] == 'nao'){echo(' style="opacity:0.5;"');}?>>
    	<th<?php echo $css; ?>><a href="<?php if($ver['ativo'] == 'sim'){?>index.php?cp=<?php echo $cp; ?>&c=<?php echo $c; ?>&tipo=editar&id=<?php echo $ver['id']; ?><?php } ?>#"><img src="imagens/edit.png"></a></th>
        <th<?php echo $css; ?>><?php echo $ver['id']; ?></th>
        <th<?php echo $css; ?>><?php echo $ver['usuario']; ?></th>
        <th<?php echo $css; ?>><?php echo $ver['advertencia']; ?></th>
    </tr>
    <?php $i++;} ?>
</table>
<?php } ?>
</div>
</div>