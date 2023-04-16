<!-- TinyMCE -->
<script type="text/javascript" src="/painel/ckeditor/ckeditor.js"></script>
<script src="/painel/ckeditor/_samples/sample.js" type="text/javascript"></script>
<link href="/painel/ckeditor/_samples/sample.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript">

	tinyMCE.init({

		// General options

		mode : "textareas",

		theme : "advanced",

		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",



		// Theme options

		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect",

		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,link,unlink,anchor,image,cleanup,code,|,insertdate,inserttime,preview",

		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,forecolor,backcolor",

		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,undo,redo,|,cite,abbr,acronym,del,|,print,|,ltr,rtl,|,fullscreen,|,charmap,iespell,media,advhr",

		theme_advanced_toolbar_location : "top",

		theme_advanced_toolbar_align : "left",

		theme_advanced_statusbar_location : "bottom",

		theme_advanced_resizing : true,



		// Example content CSS (should be your site CSS)

		content_css : "css/content.css",



		// Drop lists for link/image/media/template dialogs

		template_external_list_url : "lists/template_list.js",

		external_link_list_url : "lists/link_list.js",

		external_image_list_url : "lists/image_list.js",

		media_external_list_url : "lists/media_list.js",



		// Replace values for the template plugin

		template_replace_values : {

			username : "Some User",

			staffid : "991234"

		}

	});

</script>
<style>
body {
	margin:0;
	padding:0;
	list-style:none;
}
</style>
<div id="barra_title_pagina">
<div id="base_icone_local_pagina">
<div id="icone_local_pagina"></div>
</div>
<div id="base_text_topo_local_pagina" class="text_barra_title_pagina">Dire&ccedil;&atilde;o de conte&uacute;do / Emblemas</div>
<div id="content_title_pagina" class="title_pagina_barra">Emblemas</div>
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
?>
<?php
$nome = $_POST['nome'];
$codigo = $_POST['codigo'];
$imagem = $_POST['imagem'];
$criador = $_SESSION['usuario_admin'];
if($_POST){
	db::Query("INSERT INTO painel_emblemas(nome, codigo, imagem, criador) VALUES ('$nome','$codigo','$imagem','$criador') ");
	echo Site::Alerta('Criado com sucesso!','index.php?cp='.$cp.'&c='.$c.'');
}
?>
<form method="post">
  C&oacute;digo:
  <br>
    <input type="text" name="codigo"><br>
    Sobre:<br>
    <input type="text" name="nome"><br>
    Imagem:<br>
    <input type="text" name="imagem"><br>
    <input type="submit" value="Criar">
</form>
<?php
}elseif($tipo == 'editar'){
	$id = (int) $_GET['id'];
	$nome = $_POST['nome'];
	$codigo = $_POST['codigo'];
	$imagem = $_POST['imagem'];
	if($_POST){
		db::Query("UPDATE painel_emblemas SET nome='$nome', codigo='$codigo', imagem='$imagem' WHERE id='$id'");
		echo Site::Alerta('Editado com sucesso!','index.php?cp='.$cp.'&c='.$c.'');
	}
	$sql = db::Query("SELECT * FROM painel_emblemas WHERE id='$id'");
	$ver = db::FetchArray($sql);
?>
<form method="post">
	C&oacute;digo:<br>
    <input type="text" name="codigo" value="<?php echo $ver['codigo']; ?>"><br>
    Sobre:<br>
    <input type="text" name="nome" value="<?php echo $ver['nome']; ?>"><br>
    Imagem:<br>
    <input type="text" name="imagem" value="<?php echo $ver['imagem']; ?>"><br>
    <input type="submit" value="Criar">
</form>
<?php
}elseif($tipo == 'apagar'){
	$id = (int) $_GET['id'];
	db::Query("DELETE FROM painel_emblemas WHERE id='$id'");
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
	$sql_total = "SELECT id FROM painel_emblemas";
	$pagf_total = mysql_query($sql_total) or die(mysql_error());
	$num_tot = mysql_num_rows($pagf_total);
	$totalpag = ceil($num_tot/$quantidade);
?>
<center>
<a <?php if($pagina>1){  ?>href="index.php?cp=<?php echo $cp; ?>&c=<?php echo $c; ?>&pagina=<?php echo $pagina - 1; ?>"<? }else{;} ?>><?php if($pagina>1){;}else{ ?><? } ?>Anterior </a>
   <a style="text-decoration:underline;"> <?php echo $pagina; ?> </a>
   <a <?php if($pagina<$totalpag){  ?>href="index.php?cp=<?php echo $cp; ?>&c=<?php echo $c; ?>&pagina=<?php echo $pagina + 1; ?>"<? }else{;};?>><?php if($pagina<$totalpag){;}else{?><? }?> Proximo</a></center>
<a href="index.php?cp=<?php echo $cp; ?>&c=<?php echo $c; ?>&tipo=criar"><input type="button" name="btn_form" value="Criar emblema" /></a><br><br>

<table width="100%">
	<tr>
    	<th><img src="imagens/x.png"></th>
        <th><img src="imagens/edit.png"></th>
        <th>Id</th>
        <th>C&oacute;digo</th>
        <th>Sobre</th>
        <th>Criador</th>
        <th>Imagem</th>
    </tr>
    <?php
	$i = 1;
    $sql = db::Query("SELECT * FROM painel_emblemas ORDER BY id DESC LIMIT $inicio, $quantidade");
	while($ver = db::FetchArray($sql)){
		$css = $i%2==0 ? '' : ' style="background:none;"';
	?>
    <tr>
    	<th<?php echo $css; ?>><img src="imagens/x.png" onClick="apagar.sim('<?php echo $ver['id']; ?>');" style="cursor:pointer;"></th>
    	<th<?php echo $css; ?>><a href="index.php?cp=3&c=56&tipo=editar&id=<?php echo $ver['id']; ?>"><img src="imagens/edit.png"></a></th>
        <th<?php echo $css; ?>><?php echo $ver['id']; ?></th>
        <th<?php echo $css; ?>><?php echo $ver['codigo']; ?></th>
        <th<?php echo $css; ?>><?php echo $ver['nome']; ?></th>
        <th<?php echo $css; ?>><?php echo $ver['criador']; ?></th>
        <th<?php echo $css; ?>><img src="<?php echo $ver['imagem']; ?>"></th>
    </tr>
    <?php $i++;} ?>
</table>
<?php } ?>
</div>
</div>