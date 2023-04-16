<div id="barra_title_pagina">
<div id="base_icone_local_pagina">
<div id="icone_local_pagina"></div>
</div>
<div id="base_text_topo_local_pagina" class="text_barra_title_pagina">Modera&ccedil;&atilde;o / Todas pixel</div>
<div id="content_title_pagina" class="title_pagina_barra"><span class="text_barra_title_pagina">Todas pixel</span></div>
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
$tipo = $_GET['tipo'];
if($tipo == 'editar'){
	$id = (int) $_GET['id'];
	$titulo = $_POST['titulo'];
	$status = $_POST['status'];
	$descricao = $_POST['descricao'];
	if($_POST){
		db::Query("UPDATE pixel SET titulo='$titulo', status='$status', descricao='$descricao' WHERE id='$id'");
		echo Site::Alerta('Editado com sucesso!','index.php?cp='.$cp.'&c='.$c.'');
	}
	$sql = db::Query("SELECT * FROM pixel WHERE id='$id'");
	$ver = db::FetchArray($sql);
?>
<form method="post">
	Titulo:<br>
    <input type="text" name="titulo" value="<?php echo $ver['titulo']; ?>"><br>
    Imagem:<br>
    <img src="/site-habbopega-fwdesign-biel/media/uplouds/pixel/<?php echo $ver['imagem']; ?>" style="max-width:200px; max-height:200px;"><br>
    Descri&ccedil;&atilde;o:<br>
    <input type="text" name="descricao" value="<?php echo $ver['descricao']; ?>"><br>
    Status:<br>
    <select name="status">
    	<option value="sim"<?php if($ver['status'] == 'sim'){echo(' selected');} ?>>Ativo</option>
        <option value="nao"<?php if($ver['status'] == 'nao'){echo(' selected');} ?>>Inativo</option>
    </select><br>
    <input type="submit" value="Editar">
</form>
<?php
}elseif($tipo == 'apagar'){
	$id = (int) $_GET['id'];
	db::Query("DELETE FROM pixel WHERE id='$id'");
	echo('deu');
}else{
	$pagina = $_GET['pagina'];
	if($pagina == 0){
		$pagina = 1;
	}else{
		$pagina = $pagina;
	}
	$quantidade = 20;
	$inicio = ($quantidade * $pagina) - $quantidade;
	$sql_total = "SELECT id FROM pixel";
	$pagf_total = mysql_query($sql_total) or die(mysql_error());
	$num_tot = mysql_num_rows($pagf_total);
	$totalpag = ceil($num_tot/$quantidade);
?>
<center>
<a <?php if($pagina>1){  ?>href="index.php?cp=<?php echo $cp; ?>&c=<?php echo $c; ?>&pagina=<?php echo $pagina - 1; ?>"<? }else{;} ?>><?php if($pagina>1){;}else{ ?><? } ?>Anterior </a>
   <a style="text-decoration:underline;"> <?php echo $pagina; ?> </a>
   <a <?php if($pagina<$totalpag){  ?>href="index.php?cp=<?php echo $cp; ?>&c=<?php echo $c; ?>&pagina=<?php echo $pagina + 1; ?>"<? }else{;};?>><?php if($pagina<$totalpag){;}else{?><? }?> Proximo</a></center>
<table width="100%">
	<tr>
    	<th><img src="imagens/x.png"></th>
        <th><img src="imagens/edit.png"></th>
        <th>ID</th>
        <th>Titulo</th>
        <th>Criador</th>
        <th>Status</th>
        <th>Imagem</th>
        <th>Data</th>
    </tr>
    <?php
	$i = 1;
    $sql = db::Query("SELECT * FROM pixel ORDER BY id DESC LIMIT $inicio, $quantidade");
	while($ver = db::FetchArray($sql)){
		$css = $i%2==0 ? '' : ' style="background:none;"';
	?>
    <tr>
    	<th<?php echo $css; ?>><img src="imagens/x.png" onClick="apagar.sim('<?php echo $ver['id']; ?>');"></th>
        <th<?php echo $css; ?>><a href="index.php?cp=<?php echo $cp; ?>&c=<?php echo $c; ?>&tipo=editar&id=<?php echo $ver['id']; ?>"><img src="imagens/edit.png"></a></th>
        <th<?php echo $css; ?>><?php echo $ver['id']; ?></th>
        <th<?php echo $css; ?>><?php echo $ver['titulo']; ?></th>
        <th<?php echo $css; ?>><?php echo $ver['autor']; ?></th>
        <th<?php echo $css; ?>><?php if($ver['status'] == 'sim'){echo('Ativo');}else{echo('Inativo');} ?></th>
        <th<?php echo $css; ?>><img src="/site-habbopega-fwdesign-biel/media/uplouds/pixel/<?php echo $ver['imagem']; ?>" style="max-width:200px; max-height:200px;"><br></th>
        <th<?php echo $css; ?>><?php echo date('d/m/Y', $ver['data']); ?> &aacute;s <?php echo date('H:i:s', $ver['data']); ?></th>
    </tr>
    <?php $i++;} ?>
</table>
<?php } ?>
</div>
</div>