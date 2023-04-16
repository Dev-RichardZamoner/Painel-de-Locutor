<div id="barra_title_pagina">
<div id="base_icone_local_pagina">
<div id="icone_local_pagina"></div>
</div>
<div id="base_text_topo_local_pagina" class="text_barra_title_pagina">Extras / Top Tocadas</div>
<div id="content_title_pagina" class="title_pagina_barra">Top Tocadas</div>
</div>

<div id="lado_dir_content">
<div id="box_pagina_conteudo">
<div id="content_list_inser_registro">
</div>
<?php
$tipo = $_GET['tipo'];
$id = (int) $_GET['id'];
if($tipo == 'editar'){
	$sql = db::Query("SELECT * FROM top_tocadas WHERE id='$id'");
	$ver = db::FetchArray($sql);
	$cantor = $_POST['cantor'];
	$musica = $_POST['musica'];
	$descricao = $_POST['descricao'];
	$foto = $_FILES['imagem'];
	$audio = $_POST['audio'];
	$sobe = $_POST['sobe'];
	if($_POST){
		if(!empty($foto["name"])){
				// Verifica se o arquivo é uma imagem
				if(!eregi("^image\/(pjpeg|jpeg|png|gif|bmp)$", $foto["type"])){
					$error[1] = "Isso n&atilde;o &eacute; uma imagem.";
				}
				// Se não houver nenhum erro
				if(count($error) == 0) {
					preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
					$nome_imagem = md5(uniqid(time())) . "." . $ext[1];
					$caminho_imagem = "uplouds/".$nome_imagem;
					move_uploaded_file($foto["tmp_name"], $caminho_imagem);
					mysql_query("UPDATE top_tocadas SET cantor='$cantor', musica='$musica', descricao='$descricao', imagem='$nome_imagem', audio='$audio', sobe='$sobe' WHERE id='$id'");
					echo Site::Alerta('Editado com sucesso!','index.php?cp='.$cp.'&c='.$c.'');
				}else{
					foreach($error as $erro){
						echo $erro;
					}
				}
		}else{
			mysql_query("UPDATE top_tocadas SET cantor='$cantor', musica='$musica', descricao='$descricao', audio='$audio', sobe='$sobe' WHERE id='$id'");
			echo Site::Alerta('Editado com sucesso!','index.php?cp='.$cp.'&c='.$c.'');
		}
	}
?>
<form method="post" enctype="multipart/form-data">
	Cantor:<br>
    <input type="text" name="cantor" value="<?php echo $ver['cantor'] ;?>"><br>
    Musica:<br>
    <input type="text" name="musica" value="<?php echo $ver['musica']; ?>"><br>
    Imagem:<br>
    <a href="uplouds/<?php echo $ver['imagem']; ?>" rel="shadowbox"><img src="uplouds/<?php echo $ver['imagem']; ?>" style="max-width:200px;"></a><br>
    <input type="file" name="imagem"><br>
    Descri&ccedil;&atilde;o:<br>
    <input type="text" name="descricao" value="<?php echo $ver['descricao']; ?>"><br>
    Audio: <span style="font-size:11px;">(link do youtube)</span><br>
    <input type="text" name="audio" value="<?php echo $ver['audio']; ?>"><br>
    Sobe: <span style="font-size:11px;">(Continuara fazendo sucesso)</span><br>
    <select name="sobe">
    	<option value="sim"<?php if($ver['sobe'] == 'sim'){echo(' selected');} ?>>Sim</option>
        <option value="nao"<?php if($ver['sobe'] == 'nao'){echo(' selected');} ?>>N&atilde;o</option>
    </select><br>
    <input type="submit" value="Postar">
</form>
<?php }else{ ?>
<table width="100%">
	<tr>
    	<th><img src="imagens/edit.png"></th>
    	<th>Posi&ccedil;&atilde;o</th>
    	<th>Imagem</th>
    	<th>Cantor</th>
        <th>Musica</th>
        <th>Ouvir</th>
    </tr>
    <?php
	$i = 1;
    $sql = db::Query("SELECT * FROM top_tocadas LIMIT 10");
	while($ver = db::FetchArray($sql)){
		$css = $i%2==0 ? '' : ' style="background:none;"';
	?>
    <tr>
    	<th<?php echo $css; ?>><a href="index.php?cp=<?php echo $cp; ?>&c=<?php echo $c; ?>&tipo=editar&id=<?php echo $ver['id']; ?>"><img src="imagens/edit.png"></a></th>
    	<th<?php echo $css; ?>><?php echo $ver['id']; ?></th>
        <th<?php echo $css; ?>><a href="uplouds/<?php echo $ver['imagem']; ?>" rel="shadowbox"><img src="uplouds/<?php echo $ver['imagem']; ?>" style="max-width:200px;"></a></th>
        <th<?php echo $css; ?>><?php echo $ver['cantor']; ?></th>
        <th<?php echo $css; ?>><?php echo $ver['musica']; ?></th>
        <th<?php echo $css; ?>><a href="<?php echo $ver['audio']; ?>" target="_blank">Ouvir musica</a></th>
    </tr>
    <?php $i++;} ?>
</table>
<?php } ?>
</div>
</div>