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
<div id="base_text_topo_local_pagina" class="text_barra_title_pagina">Valores / Categoria</div>
<div id="content_title_pagina" class="title_pagina_barra">Categoria</div>
</div>
<div id="lado_dir_content">
<div id="box_pagina_conteudo">
<div id="content_list_inser_registro">
</div>
<?php
$tipo = $_GET['tipo'];
if($tipo == 'criar'){
	$nome = $_POST['nome'];
	$foto = $_FILES['imagem'];
	if($_POST){
		if(empty($nome)){
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
					$caminho_imagem = "../media/uplouds/valores/".$nome_imagem;
					move_uploaded_file($foto["tmp_name"], $caminho_imagem);
					db::Query("INSERT INTO valores_cat(nome, imagem) VALUES ('$nome','$nome_imagem') ");
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
<form method="post" enctype="multipart/form-data">
    Nome:<br>
    <input type="text" name="nome"><br>
     Imagem:<br>
     <input type="file" name="imagem"><br>
    <input type="submit" value="Criar">
</form>
<?php }else{ ?>
<a href="index.php?cp=<?php echo $cp; ?>&c=<?php echo $c; ?>&tipo=criar"><input type="button" name="btn_form" value="Criar categoria" /></a><br><br>
<table width="100%">
	<tr>
        <th>Id</th>
        <th>Nome</th>
        <th>Icone</th>
    </tr>
    <?php
	$i = 1;
    $sql = db::Query("SELECT * FROM valores_cat ORDER BY id DESC LIMIT 50");
	while($ver = db::FetchArray($sql)){
		$css = $i%2==0 ? '' : ' style="background:none;"';
	?>
    <tr>
        <th<?php echo $css; ?>><?php echo $ver['id']; ?></th>
        <th<?php echo $css; ?>><?php echo $ver['nome']; ?></th>
        <th<?php echo $css; ?>><img src="/media/uplouds/valores/<?php echo $ver['imagem']; ?>"></th>
    </tr>
    <?php $i++;} ?>
</table>
<?php } ?>
</div>
</div>