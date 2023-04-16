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
}
</style>
<div id="barra_title_pagina">
<div id="base_icone_local_pagina">
<div id="icone_local_pagina"></div>
</div>
<div id="base_text_topo_local_pagina" class="text_barra_title_pagina">Modera&ccedil;&atilde;o / Todos topicos</div>
<div id="content_title_pagina" class="title_pagina_barra"><span class="text_barra_title_pagina">Todos topicos</span></div>
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
	$texto = strip_tags($_POST['texto']);
	$fixo = $_POST['fixo'];
	$vip = $_POST['vip'];
	$moderado = $_POST['moderado'];
	$moderador = $_POST['moderador'];
	if($_POST){
		db::Query("UPDATE forum SET titulo='$titulo', fixo='$fixo', status='$status', moderado='$moderado', moderador='$moderador', texto='$texto' WHERE id='$id'");
		echo Site::Alerta('Editado com sucesso!','index.php?cp='.$cp.'&c='.$c.'');
	}
	$sql = db::Query("SELECT * FROM forum WHERE id='$id'");
	$ver = db::FetchArray($sql);
?>
<form method="post">
	Titulo:<br>
    <input type="text" name="titulo" value="<?php echo $ver['titulo']; ?>"><br>
    Autor:<br>
    <input type="text" value="<?php echo $ver['autor']; ?>"><br>
    Moderador:<br>
    <input type="text" name="moderador" readonly value="<?php echo $_SESSION['usuario_admin']; ?>"><br>
    Fixo:<br>
    <select name="fixo">
    	<option value="sim"<?php if($ver['fixo'] == 'sim'){echo(' selected');} ?>>Sim</option>
        <option value="nao"<?php if($ver['fixo'] == 'nao'){echo(' selected');} ?>>N&atilde;o</option>
    </select><br>
    Status:<br>
    <select name="status">
    	<option value="ativo"<?php if($ver['status'] == 'ativo'){echo(' selected');} ?>>Ativo</option>
        <option value="inativo"<?php if($ver['status'] == 'inativo'){echo(' selected');} ?>>Inativo</option>
    </select><br>
    Moderado:<br>
    <select name="moderado">
    	<option value="moderado"<?php if($ver['moderado'] == 'moderado'){echo(' selected');} ?>>Moderado</option>
        <option value="fechado"<?php if($ver['moderado'] == 'fechado'){echo(' selected');} ?>>Fechado</option>
        <option value="normal"<?php if($ver['moderado'] == 'normal'){echo(' selected');} ?>>Normal</option>
    </select><br>
    Texto:<br>
    <textarea name="texto" style="height:200px;"><?php echo nl2br($ver['texto']); ?></textarea><br>
    <input type="submit" value="Editar">
</form>
<?php
}elseif($tipo == 'apagar'){
	$id = (int) $_GET['id'];
	db::Query("DELETE FROM forum WHERE id='$id'");
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
	$sql_total = "SELECT id FROM forum";
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
        <th>Data</th>
    </tr>
    <?php
	$i = 1;
    $sql = db::Query("SELECT * FROM forum ORDER BY id DESC LIMIT $inicio, $quantidade");
	while($ver = db::FetchArray($sql)){
		$css = $i%2==0 ? '' : ' style="background:none;"';
	?>
    <tr>
    	<th<?php echo $css; ?>><img src="imagens/x.png" onClick="apagar.sim('<?php echo $ver['id']; ?>');"></th>
        <th<?php echo $css; ?>><a href="index.php?cp=<?php echo $cp; ?>&c=<?php echo $c; ?>&tipo=editar&id=<?php echo $ver['id']; ?>"><img src="imagens/edit.png"></a></th>
        <th<?php echo $css; ?>><?php echo $ver['id']; ?></th>
        <th<?php echo $css; ?>><?php echo $ver['titulo']; ?></th>
        <th<?php echo $css; ?>><?php echo $ver['autor']; ?></th>
        <th<?php echo $css; ?>><?php if($ver['status'] == 'ativo'){echo('Ativo');}else{echo('Inativo');} ?></th>
        <th<?php echo $css; ?>><?php echo date('d/m/Y', $ver['data']); ?> &aacute;s <?php echo date('H:i:s', $ver['data']); ?></th>
    </tr>
    <?php $i++;} ?>
</table>
<?php } ?>
</div>
</div>