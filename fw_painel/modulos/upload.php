<div id="barra_title_pagina">
<div id="base_icone_local_pagina">
<div id="icone_local_pagina"></div>
</div>
<div id="base_text_topo_local_pagina" class="text_barra_title_pagina">Extras / Uploads</div>
<div id="content_title_pagina" class="title_pagina_barra">Uploads</div>
</div>
<div id="lado_dir_content">
<div id="box_pagina_conteudo">
<div id="content_list_inser_registro">
</div>
<?php
$tipo = $_GET['tipo'];
$criador = $_SESSION['usuario_admin'];
if($tipo == 'criar'){
	$foto = $_FILES["imagem"];
	if(!empty($foto["name"])){
		// Tamanho máximo do arquivo em bytes
		$tamanho = 1000000;
		// Verifica se o arquivo é uma imagem
		if(!eregi("^image\/(pjpeg|jpeg|png|gif|bmp)$", $foto["type"])){
			$error[1] = "Isso n&atilde;o &eacute; uma imagem.";
		}
		// Verifica se o tamanho da imagem é maior que o tamanho permitido
		if($foto["size"] > $tamanho) {
			$error[2] = "A imagem deve ter no máximo ".$tamanho." bytes";
		}
		// Se não houver nenhum erro
		if(count($error) == 0) {
			preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
			$nome_imagem = md5(uniqid(time())) . "." . $ext[1];
        	$caminho_imagem = "uplouds/".$nome_imagem;
			move_uploaded_file($foto["tmp_name"], $caminho_imagem);
			if($caminho_imagem){
				mysql_query("INSERT INTO uploads(imagem, criador) VALUES ('$nome_imagem','$criador') ");
				echo Site::Alerta('Hospedado com sucesso!','index.php?cp='.$cp.'&c='.$c.'');
			}
		}else{
			foreach ($error as $erro){
				echo $erro;
			}
		}
	}
?>
<form method="post" enctype="multipart/form-data">
	Imagem:<br>
	<input type="file" name="imagem" /><br>
	<input type="submit" value="Enviar" />
</form>
<?php }else{
		$pagina = $_GET['pagina'];
	if($pagina == 0){
		$pagina = 1;
	}else{
		$pagina = $pagina;
	}
	$quantidade = 20;
	$inicio = ($quantidade * $pagina) - $quantidade;
	$sql_total = "SELECT id FROM uploads";
	$pagf_total = mysql_query($sql_total) or die(mysql_error());
	$num_tot = mysql_num_rows($pagf_total);
	$totalpag = ceil($num_tot/$quantidade);
?>
<center>
<a <?php if($pagina>1){  ?>href="index.php?cp=<?php echo $cp; ?>&c=<?php echo $c; ?>&pagina=<?php echo $pagina - 1; ?>"<? }else{;} ?>><?php if($pagina>1){;}else{ ?><? } ?>Anterior </a>
   <a style="text-decoration:underline;"> <?php echo $pagina; ?> </a>
   <a <?php if($pagina<$totalpag){  ?>href="index.php?cp=<?php echo $cp; ?>&c=<?php echo $c; ?>&pagina=<?php echo $pagina + 1; ?>"<? }else{;};?>><?php if($pagina<$totalpag){;}else{?><? }?> Proximo</a></center>
<a href="index.php?cp=<?php echo $cp; ?>&c=<?php echo $c; ?>&tipo=criar"><input type="button" name="btn_form" value="Fazer upload" /></a><br><br>
<table width="100%">
	<tr>
    	<th>Id</th>
        <th>Imagem</th>
        <th>Link</th>
        <th>Criador</th>
    </tr>
    <?php
	$i = 1;
    $sql = db::Query("SELECT * FROM uploads ORDER BY id DESC LIMIT $inicio, $quantidade");
	while($ver = db::FetchArray($sql)){
		$css = $i%2==0 ? '' : ' style="background:none;"';
	?>
    <tr>
    	<th<?php echo $css; ?>><?php echo $ver['id']; ?></th>
        <th<?php echo $css; ?>><a href="uplouds/<?php echo $ver['imagem']; ?>" rel="shadowbox"><img src="uplouds/<?php echo $ver['imagem']; ?>" style="max-width:200px;"></a></th>
        <th<?php echo $css; ?>><a href="uplouds/<?php echo $ver['imagem']; ?>" target="_blank">Ver imagem</a></th>
        <th<?php echo $css; ?>><?php echo $ver['criador']; ?></th>
    </tr>
    <?php $i++;} ?>
</table>
<?php } ?>
</div>
</div>