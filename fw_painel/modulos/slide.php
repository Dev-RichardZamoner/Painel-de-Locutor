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
<div id="base_text_topo_local_pagina" class="text_barra_title_pagina">Valores / Add mob</div>
<div id="content_title_pagina" class="title_pagina_barra">Add mob</div>
</div>
<div id="lado_dir_content">
<div id="box_pagina_conteudo">
<div id="content_list_inser_registro">
</div>
<?php
$tipo = $_GET['tipo'];
if($tipo == 'criar'){
	$titulo = $_POST['titulo'];
	$subtitulo = $_POST['subtitulo'];
	$imagem = $_POST['imagem'];
	$url = $_POST['url'];
	if($_POST){
		db::Query("INSERT INTO slide(titulo, imagem, url, subtitulo) VALUES ('$titulo','$imagem','$url','$subtitulo') ");
		echo Site::Alerta('Criado com sucesso!','index.php?cp='.$cp.'&c='.$c.'');
				
	}
?>
<form method="post">
     Titulo:<br>
     <input type="text" name="titulo"><br>
     Subtitulo:<br>
     <input type="text" name="subtitulo"><br>
     Imagem:<br>
     <input type="text" name="imagem"><br>
     Url:<br>
     <input type="text" name="url"><br>
    <input type="submit" value="Criar">
</form>
<?php
}elseif($tipo == 'editar'){
	$id = (int) $_GET['id'];
	$titulo = $_POST['titulo'];
	$subtitulo = $_POST['subtitulo'];
	$imagem = $_POST['imagem'];
	$url = $_POST['url'];
	if($_POST){
		db::Query("UPDATE slide SET titulo='$titulo', imagem='$imagem', url='$url', subtitulo='$subtitulo' WHERE id='$id'");
		echo Site::Alerta('Editado com sucesso!','index.php?cp='.$cp.'&c='.$c.'');
	}
	$sql = db::Query("SELECT * FROM slide WHERE id='$id'");
	$ver = db::FetchArray($sql);
?>
<form method="post">
     Titulo:<br>
     <input type="text" name="titulo" value="<?php echo $ver['titulo']; ?>"><br>
     Subtitulo:<br>
     <input type="text" name="subtitulo" value="<?php echo $ver['subtitulo']; ?>"><br>
     Imagem:<br>
     <input type="text" name="imagem" value="<?php echo $ver['imagem']; ?>"><br>
     <img src="<?php echo $ver['imagem']; ?>"><Br>
     Url:<br>
     <input type="text" name="url" value="<?php echo $ver['url']; ?>"><br>
    <input type="submit" value="Editar">
</form>
<?php
}elseif($tipo == 'apagar'){
	$id = (int) $_GET['id'];
	db::Query("DELETE FROM slide WHERE id='$id'");
	echo('deu');
}else{
?>
<a href="index.php?cp=<?php echo $cp; ?>&c=<?php echo $c; ?>&tipo=criar"><input type="button" name="btn_form" value="Criar slide" /></a><br><br>
<table width="100%">
	<tr>
    	<th><img src="imagens/x.png"></th>
	  <th><img src="imagens/edit.png"></th>
        <th>Id</th>
        <th>Titulo</th>
        <th>Imagem</th>
    </tr>
    <?php
	$i = 1;
    $sql = db::Query("SELECT * FROM slide ORDER BY id DESC LIMIT 50");
	while($ver = db::FetchArray($sql)){
		$css = $i%2==0 ? '' : ' style="background:none;"';
	?>
    <tr>
        	<th<?php echo $css; ?>><img src="imagens/x.png" onClick="apagar.sim('<?php echo $ver['id']; ?>');"></th>
      <th<?php echo $css; ?>><a href="index.php?cp=<?php echo $cp; ?>&c=<?php echo $c; ?>&tipo=editar&id=<?php echo $ver['id']; ?>"><img src="imagens/edit.png"></a></th>
        <th<?php echo $css; ?>><?php echo $ver['id']; ?></th>
        <th<?php echo $css; ?>><?php echo $ver['titulo']; ?></th>
        <th<?php echo $css; ?>><img src="<?php echo $ver['imagem']; ?>"></th>
    </tr>
    <?php $i++;} ?>
</table>
<?php } ?>
</div>
</div>