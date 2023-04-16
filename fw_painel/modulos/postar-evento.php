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
<!-- /TinyMCE -->
<div id="barra_title_pagina">
<div id="base_icone_local_pagina">
<div id="icone_local_pagina"></div>
</div>
<div id="base_text_topo_local_pagina" class="text_barra_title_pagina">Noticiario / Postar evento</div>
<div id="content_title_pagina" class="title_pagina_barra">Postar evento</div>
</div>

<div id="lado_dir_content">

<div id="box_pagina_conteudo">
<div id="content_list_inser_registro">
</div>
<?php
$tipo = $_GET['tipo'];
if($tipo == 'criar'){
	$titulo = $_POST['titulo'];
	$resumo = $_POST['resumo'];
	$categoria = 3;
	$texto = $_POST['texto'];
	$data = time();
	$criador = $_SESSION['usuario_admin'];
	$url = Site::LimparUrl($titulo);
	$foto = $_FILES['imagem'];
	$data_evento = $_POST['tempo'];
	$dia_evento = strtotime($data_evento);
	if($_POST){
		if(empty($texto)){
			echo Site::Alerta('Preencha todos os campos!',false);
		}else{
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
					db::Query("INSERT INTO noticias(titulo, resumo, texto, categoria, imagem, criador, data, status, url, data_evento, dia_evento, evento) VALUES ('$titulo','$resumo','$texto','$categoria','$nome_imagem','$criador','$data','inativo','$url','$data_evento','$dia_evento','sim') ");
					echo Site::Alerta('Criado com sucesso!','index.php?cp='.$cp.'&c='.$c.'');
				}else{
					foreach($error as $erro){
						echo $erro;
					}
				}
			}
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
<form method="post" enctype="multipart/form-data">
	Titulo:<br>
    <input type="text" name="titulo"><br>
    Resumo:<br>
    <input type="text" name="resumo"><br>
    Data do evento:<br>
    <input type="text" name="tempo" id="tempo" /><br>
    <script>
	$('#tempo').datetimepicker({
		addSliderAccess: true,
		sliderAccessArgs: { touchonly: false }
	});
    </script>
    Imagem: <span style="font-size:11px;">(61 x 55)</span><br>
    <input type="file" name="imagem"><br>
    Texto completo:<br>
    <textarea name="texto" class="ckeditor" style="width:100%;"></textarea>
    <input type="submit" value="Postar">
</form>
<?php }else{ ?>
<a href="index.php?cp=<?php echo $cp; ?>&c=<?php echo $c; ?>&tipo=criar"><input type="button" name="btn_form" value="Criar evento" /></a><br><br>

<table width="100%">
	<tr>
    	<th><img src="imagens/edit.png"></th>
        <th>Id</th>
        <th>Titulo</th>
        <th>Criador</th>
        <th>Data</th>
        <th>Status</th>
    </tr>
    <?php
	$i = 1;
    $sql = db::Query("SELECT * FROM noticias WHERE criador='".$_SESSION['usuario_admin']."' ORDER BY id DESC LIMIT 50");
	while($ver = db::FetchArray($sql)){
		$css = $i%2==0 ? '' : ' style="background:none;"';
	?>
    <tr>
    	<th<?php echo $css; ?>><a href="index.php?cp=<?php echo $cp; ?>&c=<?php echo $c; ?>&tipo=editar&id=<?php echo $ver['id']; ?>"><img src="imagens/edit.png"></a></th>
        <th<?php echo $css; ?>><?php echo $ver['id']; ?></th>
        <th<?php echo $css; ?>><?php echo $ver['titulo']; ?></th>
        <th<?php echo $css; ?>><?php echo $ver['criador']; ?></th>
        <th<?php echo $css; ?>><?php echo date('d/m/Y', $ver['data']); ?> ás <?php echo date('H:i:s', $ver['data']); ?></th>
        <th<?php echo $css; ?>><?php echo $ver['status']; ?></th>
    </tr>
    <?php $i++;} ?>
</table>
<?php } ?>
</div>
</div>

