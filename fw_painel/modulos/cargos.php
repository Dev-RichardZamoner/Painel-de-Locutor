<div id="barra_title_pagina">
<div id="base_icone_local_pagina">
<div id="icone_local_pagina"></div>
</div>
<div id="base_text_topo_local_pagina" class="text_barra_title_pagina">Administra&ccedil;&atilde;o / Cargos da equipe</div>
<div id="content_title_pagina" class="title_pagina_barra">Cargos da equipe</div>
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
if($tipo == 'criar'){
	$id = (int) $_GET['id'];
	$nome = $_POST['nome'];
	$resumo = $_POST['resumo'];
	$status = $_POST['status'];
	if($_POST){
		db::Query("INSERT INTO painel_cargos (tp_usr_nome, tp_usr_comentario, status, tp_usr_ordem) VALUES('$nome','$resumo','$status','0') ");
		echo Site::Alerta('Criador com sucesso!','index.php?cp='.$cp.'&c='.$c.'');
	}
?>
<form method="post">
	Nome:<br>
    <input type="text" name="nome"><br>
    Resumo do cargo:<br>
    <input type="text" name="resumo"><br>
    Status:<br>
    <select name="status">
    	<option value="ativo">Ativo</option>
        <option value="inativo">Inativo</option>
    </select><br>
    <input type="submit" value="Editar">
</form>
<?php
}elseif($tipo == 'editar'){
	$id = (int) $_GET['id'];
	$nome = $_POST['nome'];
	$resumo = $_POST['resumo'];
	$status = $_POST['status'];
	if($_POST){
		db::Query("UPDATE painel_cargos SET tp_usr_nome='$nome', tp_usr_comentario='$resumo', status='$status' WHERE tp_usr_id='$id'");
		echo Site::Alerta('Editado com sucesso!','index.php?cp='.$cp.'&c='.$c.'');
	}
	$sql = db::Query("SELECT * FROM painel_cargos WHERE tp_usr_id='$id'");
	$ver = db::FetchArray($sql);
?>
<form method="post">
	Nome:<br>
    <input type="text" name="nome" value="<?php echo $ver['tp_usr_nome']; ?>"><br>
    Resumo do cargo:<br>
    <input type="text" name="resumo" value="<?php echo $ver['tp_usr_comentario']; ?>"><br>
    Status:<br>
    <select name="status">
    	<option value="ativo"<?php if($ver['status'] == 'ativo'){echo(' selected');} ?>>Ativo</option>
        <option value="inativo"<?php if($ver['status'] == 'inativo'){echo(' selected');} ?>>Inativo</option>
    </select><br>
    <input type="submit" value="Editar">
</form>
<?php
}elseif($tipo == 'apagar'){
	$id = (int) $_GET['id'];
	db::Query("DELETE FROM painel_avisos WHERE id='$id'");
	echo('deu');
}else{
?>
<a href="index.php?cp=<?php echo $cp; ?>&c=<?php echo $c; ?>&tipo=criar"><input type="button" name="btn_form" value="Criar cargo" /></a><br><br>

<table width="100%">
	<tr>
        <th><img src="imagens/edit.png"></th>
        <th>Id</th>
        <th>Nome</th>
        <th>Resumo do cargo</th>
        <th>Status</th>
    </tr>
    <?php
	$i = 1;
    $sql = db::Query("SELECT * FROM painel_cargos");
	while($ver = db::FetchArray($sql)){
		$css = $i%2==0 ? '' : ' style="background:none;"';
	?>
    <tr>
    	<th<?php echo $css; ?>><a href="index.php?cp=<?php echo $cp; ?>&c=<?php echo $c; ?>&tipo=editar&id=<?php echo $ver['tp_usr_id']; ?>"><img src="imagens/edit.png"></a></th>
        <th<?php echo $css; ?>><?php echo $ver['tp_usr_id']; ?></th>
        <th<?php echo $css; ?>><?php echo $ver['tp_usr_nome']; ?></th>
        <th<?php echo $css; ?>><?php echo $ver['tp_usr_comentario']; ?></th>
        <th<?php echo $css; ?>><?php echo $ver['status']; ?></th>
    </tr>
    <?php $i++;} ?>
</table>
<?php } ?>
</div>
</div>