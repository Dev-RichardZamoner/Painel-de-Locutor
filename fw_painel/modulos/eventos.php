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
<div id="base_text_topo_local_pagina" class="text_barra_title_pagina">Direção de conteúdo / Todas eventos</div>
<div id="content_title_pagina" class="title_pagina_barra">Todas eventos</div>
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
$id = (int) $_GET['id'];
if($tipo == 'editar'){
	$sql = db::Query("SELECT * FROM noticias WHERE id='$id' AND categoria='3'");
	$ver = db::FetchArray($sql);
	$titulo = $_POST['titulo'];
	$resumo = $_POST['resumo'];
	$status = $_POST['status'];
	$revisado = $_POST['revisado'];
	$texto = $_POST['texto'];
	$data_evento = $_POST['tempo'];
	$dia_evento = strtotime($data_evento);
	$foto = $_FILES['imagem'];
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
					db::Query("UPDATE noticias SET titulo='$titulo', resumo='$resumo', status='$status', revisado='$revisado', texto='$texto', data_evento='$data_evento', dia_evento='$dia_evento', imagem='$nome_imagem' WHERE id='$id'");
					echo Site::Alerta('Editado com sucesso!','index.php?cp='.$cp.'&c='.$c.'');
				}else{
					foreach($error as $erro){
						echo $erro;
					}
				}
		}else{
			db::Query("UPDATE noticias SET titulo='$titulo', resumo='$resumo', status='$status', revisado='$revisado', texto='$texto', data_evento='$data_evento', dia_evento='$dia_evento' WHERE id='$id'");
		echo Site::Alerta('Editado com sucesso!','index.php?cp='.$cp.'&c='.$c.'');
		}
	}
?>
<style>
.ui-timepicker-div .ui-widget-header { margin-bottom: 8px; }
.ui-timepicker-div dl { text-align: left; }
.ui-timepicker-div dl dt { height: 25px; margin-bottom: -25px; }
.ui-timepicker-div dl dd { margin: 0 10px 10px 65px; }
.ui-timepicker-div td { font-size: 90%; }
.ui-tpicker-grid-label { background: none; border: none; margin: 0; padding: 0; }

.ui-timepicker-rtl{ direction: rtl; }
.ui-timepicker-rtl dl { text-align: right; }
.ui-timepicker-rtl dl dd { margin: 0 65px 10px 10px; }
</style> 
<link rel="stylesheet" media="all" type="text/css" href="http://code.jquery.com/ui/1.8.23/themes/smoothness/jquery-ui.css" />
<link rel="stylesheet" media="all" type="text/css" href="media/css/jquery-ui-timepicker-addon.css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.8.24/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="js/jquery-ui-sliderAccess.js"></script>
<form method="post">
	Titulo:<br>
    <input type="text" name="titulo" value="<?php echo $ver['titulo'] ;?>"><br>
    Resumo:<br>
    <input type="text" name="resumo" value="<?php echo $ver['resumo'] ;?>"><br>
    Data do evento:<br>
    <input type="text" name="tempo" id="tempo" value="<?php echo $ver['data_evento'] ;?>" /><br>
    <script>
	$('#tempo').datetimepicker({
		addSliderAccess: true,
		sliderAccessArgs: { touchonly: false }
	});
    </script>
    Status:<br>
    <select name="status">
    	<option value="ativo"<?php if($ver['status'] == 'ativo'){echo(' selected');} ?>>Ativo</option>
        <option value="inativo"<?php if($ver['status'] == 'inativo'){echo(' selected');} ?>>Inativo</option>
    </select><br>
    Revisado por:<br>
    <input type="text" name="revisado" placeholder value="<?php echo $_SESSION['usuario_admin']; ?>"><br>
    Imagem: <span style="font-size:11px;">(Evento 61 x 55)</span><br>
    <a href="uplouds/<?php echo $ver['imagem']; ?>" rel="shadowbox" onMouseOver="tooltip.show('Ampliar');" onMouseOut="tooltip.hide();"><img src="uplouds/<?php echo $ver['imagem']; ?>" width="210" height="114"></a><br>
    <input type="file" name="imagem"><br>
    Texto completo:<br>
    <textarea name="texto" class="ckeditor" style="width:100%;"><?php echo $ver['texto']; ?></textarea>
    <input type="submit" value="Postar">
</form>
<?php
}elseif($tipo == 'apagar'){
	$id = (int) $_GET['id'];
	db::Query("DELETE FROM noticias WHERE id='$id' AND categoria='3'");
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
	$sql_total = "SELECT id FROM noticias WHERE categoria='3'";
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
        <th>Id</th>
        <th>Titulo</th>
        <th>Criador</th>
        <th>Data de postagem</th>
        <th>Data do evento</th>
        <th>Status</th>
    </tr>
    <?php
	$i = 1;
    $sql = db::Query("SELECT * FROM noticias WHERE categoria='3' ORDER BY id DESC LIMIT $inicio, $quantidade");
	while($ver = db::FetchArray($sql)){
		$css = $i%2==0 ? '' : ' style="background:none;"';
	?>
    <tr>
        <th<?php echo $css; ?>><img src="imagens/x.png" onClick="apagar.sim('<?php echo $ver['id']; ?>');" style="cursor:pointer;"></th>
        <th<?php echo $css; ?>><a href="index.php?cp=<?php echo $cp; ?>&c=<?php echo $c; ?>&tipo=editar&id=<?php echo $ver['id']; ?>"><img src="imagens/edit.png"></a></th>
        <th<?php echo $css; ?>><?php echo $ver['id']; ?></th>
        <th<?php echo $css; ?>><?php echo $ver['titulo']; ?></th>
        <th<?php echo $css; ?>><?php echo $ver['criador']; ?></th>
        <th<?php echo $css; ?>><?php echo date('d/m/Y', $ver['data_evento']); ?> &aacute;s <?php echo date('H:i:s', $ver['data']); ?></th>
        <th<?php echo $css; ?>><?php echo date('d/m/Y', $ver['data_evento']); ?> ás <?php echo date('H:i:s', $ver['data']); ?></th>
        <th<?php echo $css; ?>><?php echo $ver['status']; ?></th>
    </tr>
    <?php $i++;} ?>
</table>
<?php } ?>
</div>
</div>