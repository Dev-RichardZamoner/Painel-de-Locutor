<div id="barra_title_pagina">
<div id="base_icone_local_pagina">
<div id="icone_local_pagina"></div>
</div>
<div id="base_text_topo_local_pagina" class="text_barra_title_pagina">Modera&ccedil;&atilde;o / Editar/Apagar timeline</div>
<div id="content_title_pagina" class="title_pagina_barra">Editar/Apagar timeline</div>
</div>
<script>
var apagar = {
	sim:function(id){
		if(confirm('Tem certeza que deseja apagar ?')){
			$.ajax({
				type:'GET',
				url:'index.php?cp=7&c=19&tipo=apagar&id='+id,
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
?>
<?php
$titulo = $_POST['titulo'];
$texto = $_POST['texto'];
$data = time();
$criador = $_SESSION['usuario_admin'];
if($_POST){
	db::Query("INSERT INTO painel_avisos(titulo, texto, data, criador, status) VALUES ('$titulo','$texto','$data','$criador','ativo') ");
	echo Site::Alerta('Criado com sucesso!','index.php?cp=7&c=19');
}
?>
<form method="post">
	Titulo:<br>
    <input type="text" name="titulo"><br>
    Conteudo:<br>
    <textarea name="texto"></textarea><br>
    <input type="submit" value="Criar">
</form>
<?php
}elseif($tipo == 'editar'){
	$id = (int) $_GET['id'];
	$texto = $_POST['texto'];
	if($_POST){
		db::Query("UPDATE timeline SET texto='$texto' WHERE id='$id'");
		echo Site::Alerta('Editado com sucesso!','index.php?cp=7&c=19');
	}
	$sql = db::Query("SELECT * FROM timeline WHERE id='$id'");
	$ver = db::FetchArray($sql);
?>
<form method="post">
	texto:<br>
    <input type="text" name="texto" value="<?php echo $ver['texto']; ?>"><br>
    <input type="submit" value="Editar">
</form>
<?php
}elseif($tipo == 'apagar'){
	$id = (int) $_GET['id'];
	db::Query("DELETE FROM painel_avisos WHERE id='$id'");
	echo('deu');
}else{
?>
<table width="100%">
	<tr>
    	<th><img src="imagens/x.png"></th>
        <th><img src="imagens/edit.png"></th>
        <th>Criador</th>
        <th>Texto</th>
        <th>Data</th>
    </tr>
    <?php
	$i = 1;
    $sql = db::Query("SELECT * FROM timeline ORDER BY id DESC LIMIT 50");
	while($ver = db::FetchArray($sql)){
		$css = $i%2==0 ? '' : ' style="background:none;"';
	?>
    <tr>
    	<th<?php echo $css; ?>><img src="imagens/x.png"></th>
    	<th<?php echo $css; ?>><a href="index.php?cp=7&c=19&tipo=editar&id=<?php echo $ver['id']; ?>"><img src="imagens/edit.png"></a></th>
        <th<?php echo $css; ?>><?php echo $ver['criador']; ?></th>
        <th<?php echo $css; ?>><?php echo $ver['texto']; ?></th>
        <th<?php echo $css; ?>><?php echo date('d/m/Y', $ver['data']); ?> &aacute;s <?php echo date('H:i:s', $ver['data']); ?></th>
    </tr>
    <?php $i++;} ?>
</table>
<?php } ?>
</div>
</div>